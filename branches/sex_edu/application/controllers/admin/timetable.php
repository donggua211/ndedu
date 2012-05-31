<?php
/* 
  合同模块. 查看单个合同.
  admin权限.
 */
class Timetable extends Controller {

	function Timetable()
	{
		parent::Controller();
		$this->load->library('session');
		
		$this->load->model('CRM_Subject_model');
		$this->load->model('CRM_Staff_model');
		$this->load->model('CRM_Timetable_model');
		
		$this->load->helper('admin');
		$this->load->helper('calendar');
			
		//如果没有经登录, 就跳转到admin/login登陆页
		if (!has_login())
		{
			goto_login();
		}
		
		//获取员工基本信息
		$this->staff_info = get_staff_info();
		
		/*检查权限.
		$this->allowed_group = array(GROUP_ADMIN, GROUP_SCHOOLADMIN);
		if(!check_role($this->allowed_group, $this->staff_info['group_id']))
		{
			//show_access_deny_page();
		}
		*/
		
		//加载权限控制类
		$this->load->library('admin_ac/Admin_Ac_Timetable', array('group_id' => $this->staff_info['group_id']));
	}
	
	function index()
	{
		$staff_id = $this->staff_info['staff_id'];
		$data['main']['time_table'] = $this->CRM_Timetable_model->get_staff_timetable($staff_id);
		
		$data['header']['meta_title'] = '课程表 - 日程管理';
		
		_load_viewer($this->staff_info['group_id'], 'timetable_index', $data);
	}
	
	function all($type='count', $show = 'active')
	{
		//access_control
		if(!$this->admin_ac_timetable->all_timetable())
		{
			show_access_deny_page();
		}
		
		$time_table = $this->CRM_Timetable_model->get_all_timetable(array('all' => 'all'));
		
		$all_time_table = array();
		foreach($time_table as $day => $t_t)
		{
			foreach($t_t as $one)
			{
				if($show == 'active' && $one['is_suspend'] == 1)
					continue;
				if($show == 'suspend' && $one['is_suspend'] == 0)
					continue;
				
				//上午
				if('00:00:00' <= $one['start_time'] && $one['start_time'] < '12:00:00')
					$all_time_table[1][$day][] = $one;
				//中午
				elseif('12:00:00' <= $one['start_time'] && $one['start_time'] < '18:00:00')
					$all_time_table[2][$day][] = $one;
				//晚上
				else
					$all_time_table[3][$day][] = $one;
			}
		}
		
		$data['main']['show'] = $show;
		$data['main']['all_time_table'] = $all_time_table;
		
		$data['header']['meta_title'] = '所有学员的课程表 - 日程管理';
		
		if($type == 'list')
			$template = 'timetable_all_list';
		else
			$template = 'timetable_all_count';
		
		_load_viewer($this->staff_info['group_id'], $template, $data);
	}
	
	
	function add()
	{
		//access_control
		if(!$this->admin_ac_timetable->add_timetable())
		{
			show_access_deny_page();
		}
		
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//必填信息.
			$timetable['staff_id'] = $this->input->post('staff_id');
			$timetable['subject_id'] = $this->input->post('subject_id');
			$timetable['day'] = $this->input->post('day');
			$timetable['student_id'] = $this->input->post('student_id');
			
			$start_hour = $this->input->post('start_hour');
			$start_mins = $this->input->post('start_mins');
			$end_hour = $this->input->post('end_hour');
			$end_mins = $this->input->post('end_mins');
			
			$timetable['start_time'] = $start_hour.':'.$start_mins.':00';
			$timetable['end_time'] = $end_hour.':'.$end_mins.':00';			
			
			if(empty($timetable['subject_id']) || empty($timetable['staff_id']) || empty($timetable['day']) || empty($timetable['student_id']))
			{
				$notify = '您所填写的信息不完整，请返回重试！';
				show_error_page($notify, 'admin/student/one/'.$timetable['student_id'].'/timetable');
			}
			else
			{
				//add into DB
				if($this->CRM_Timetable_model->add($timetable))
				{
					show_result_page('新课程表已经添加成功! ', 'admin/student/one/'.$timetable['student_id'].'/timetable');
				}
				else
				{
					$notify = '添加失败, 请重试.';
					show_error_page($notify, 'admin/student/one/'.$timetable['student_id'].'/timetable');
				}
			}
		}
	}
	
	function suspend()
	{
		//access_control
		if(!$this->admin_ac_timetable->edit_timetable())
		{
			show_access_deny_page();
		}
		
		//判断staff_id是否合法.
		$timetable_id = intval($this->input->post('timetable_id'));
		$days = intval($this->input->post('days'));
		if($timetable_id <= 0)
		{
			show_error_page('您输入的课程表ID不合法, 请返回重试.', '');
			return false;
		}
		
		$days = intval($this->input->post('days'));
		if(empty($days))
		{
			show_error_page('请输入要暂定的天数, 请返回重试.', '');
			return false;
		}
		
		$timetable_info = $this->CRM_Timetable_model->get_one_timetable($timetable_id);
		
		if(empty($timetable_info))
		{
			show_error_page('您所查询的课程表不存在!', '');
			return false;
		}
		
		$update_field['is_suspend'] = 1;
		if($this->CRM_Timetable_model->update($timetable_id, $update_field))
		{
			//添加暂停记录
			$days = intval($this->input->post('days'));
			$this->CRM_Timetable_model->add_timetable_suspend_log(array('timetable_id' => $timetable_id, 'days' => $days, 'staff_id' => $this->staff_info['staff_id']));
			
			//发送报警email
			//sent_mail('【timetable, suspend】有课程暂停：timetable_id:'.$timetable_id, '【timetable, suspend】有课程暂停：timetable_id:'.$timetable_id);
			
			show_result_page('课程已经成功暂停! ', 'admin/student/one/'.$timetable_info['student_id'].'/timetable');
		}
		else
		{
			show_error_page('暂停课程失败, 请重试.', 'admin/student/one/'.$timetable_info['student_id'].'/timetable');
		}
	}
	
	function unsuspend()
	{
		//access_control
		if(!$this->admin_ac_timetable->edit_timetable())
		{
			show_access_deny_page();
		}
		
		//判断staff_id是否合法.
		$timetable_id = intval($this->input->post('timetable_id'));
		if($timetable_id <= 0)
		{
			show_error_page('您输入的课程表ID不合法, 请返回重试.', '');
			return false;
		}
		
		$timetable_info = $this->CRM_Timetable_model->get_one_timetable($timetable_id);
		
		if(empty($timetable_info))
		{
			show_error_page('您所查询的课程表不存在!', '');
			return false;
		}
		
		$update_field['is_suspend'] = 0;
		if($this->CRM_Timetable_model->update($timetable_id, $update_field))
		{
			//添加取消的暂停记录
			$days = intval($this->input->post('days'));
			$this->CRM_Timetable_model->update_timetable_suspend_log($timetable_id);
			
			show_result_page('课程已经成功取消暂停! ', 'admin/student/one/'.$timetable_info['student_id'].'/timetable');
		}
		else
		{
			show_error_page('取消暂停课程失败, 请重试.', 'admin/student/one/'.$timetable_info['student_id'].'/timetable');
		}
	}
	
	function delete($timetable_id)
	{
		//access_control
		if(!$this->admin_ac_timetable->edit_timetable())
		{
			show_access_deny_page();
		}
		
		//判断staff_id是否合法.
		$timetable_id = intval($timetable_id);
		if($timetable_id <= 0)
		{
			show_error_page('您输入的课程表ID不合法, 请返回重试.', '');
			return false;
		}
		
		$timetable_info = $this->CRM_Timetable_model->get_one_timetable($timetable_id);
		
		if(empty($timetable_info))
		{
			show_error_page('您所查询的课程表不存在!', '');
			return false;
		}
		
		if($this->CRM_Timetable_model->delete($timetable_id))
		{
			show_result_page('课程表已经删除! ', 'admin/student/one/'.$timetable_info['student_id'].'/timetable');
		}
		else
		{
			show_error_page('删除失败, 请重试.', 'admin/student/one/'.$timetable_info['student_id'].'/timetable');
		}
	}
	
	function edit($timetable_id = 0)
	{
		//access_control
		if(!$this->admin_ac_timetable->edit_timetable())
		{
			show_access_deny_page();
		}
		
		//判断staff_id是否合法.
		$timetable_id = intval($timetable_id);
		if($timetable_id <= 0)
		{
			show_error_page('您输入的课程表ID不合法, 请返回重试.', '');
			return false;
		}
		
		$timetable_info = $this->CRM_Timetable_model->get_one_timetable($timetable_id);
		
		if(empty($timetable_info))
		{
			show_error_page('您所查询的课程表不存在!', '');
			return false;
		}
		
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$timetable['staff_id'] = $this->input->post('staff_id');
			$timetable['subject_id'] = $this->input->post('subject_id');
			$timetable['day'] = $this->input->post('day');
			
			$start_hour = $this->input->post('start_hour');
			$start_mins = $this->input->post('start_mins');
			$end_hour = $this->input->post('end_hour');
			$end_mins = $this->input->post('end_mins');
			
			$timetable['start_time'] = $start_hour.':'.$start_mins.':00';
			$timetable['end_time'] = $end_hour.':'.$end_mins.':00';		
			
			//检查修改项
			$update_field = array();
			foreach($timetable as $key => $val)
			{
				if(!empty($val) && ($val != $timetable_info[$key]))
					$update_field[$key] = $val;
			}
			
			if($this->CRM_Timetable_model->update($timetable_id, $update_field))
			{
				show_result_page('课程表已经更新成功! ', 'admin/student/one/'.$timetable_info['student_id'].'/timetable');
			}
			else
			{
				$notify = '更新失败, 请重试.';
				$this->_load_timetable_edit_view($notify, $timetable_info);
			}
		}
		else
		{
			$this->_load_timetable_edit_view('', $timetable_info);
		}
	}
	
	
	function _load_timetable_edit_view($notify='', $timetable_info )
	{
		$data['header']['meta_title'] = '编辑 - 课程表 - 管理学员';
		$data['main']['teachers'] = $this->_get_teachers();
		$data['main']['subjects'] = $this->_get_subjects();
		$data['main']['timetable_info'] = $timetable_info;
		$data['main']['notification'] = $notify;
		_load_viewer($this->staff_info['group_id'], 'timetable_edit', $data);
	}
	
	function _get_teachers()
	{
		if($this->staff_info['group_id'] == GROUP_CONSULTANT_D)
			$group = array(GROUP_CONSULTANT_D, GROUP_CONSULTANT, GROUP_CONSULTANT_PARTTIME);
		elseif($this->staff_info['group_id'] == GROUP_SUYANG_D)
			$group = array(GROUP_SUYANG_D, GROUP_SUYANG);
		elseif($this->staff_info['group_id'] == GROUP_TEACHER_D)
			$group = array(GROUP_TEACHER_D, GROUP_TEACHER_PARTTIME, GROUP_TEACHER_FULL);
		else
			$group = array(GROUP_CONSULTANT, GROUP_CONSULTANT_PARTTIME, GROUP_TEACHER_PARTTIME, GROUP_TEACHER_FULL, GROUP_SUYANG, GROUP_TEACHER_D, GROUP_CONSULTANT_D, GROUP_SUYANG_D);
		
		return $this->CRM_Staff_model->get_all_by_group($group);
	}
	
	function _get_subjects()
	{
		if($this->staff_info['group_id'] == GROUP_CONSULTANT_D)
			$parrent_id = SUBJECT_ZIXUN;
		elseif($this->staff_info['group_id'] == GROUP_SUYANG_D)
			$parrent_id = SUBJECT_SUYANG;
		elseif($this->staff_info['group_id'] == GROUP_TEACHER_D)
			$parrent_id = SUBJECT_XUEKE;
		else
			$parrent_id = 0;
		
		return $this->CRM_Subject_model->getAll($parrent_id);
	}
}
/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */