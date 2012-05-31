<?php
/* 
  pms: payroll management system
  admin权限.
 */
class Pms extends Controller {

	function Pms()
	{
		parent::Controller();
		$this->load->library('session');
		
		$this->load->model('CRM_Staff_model');
		$this->load->model('CRM_Branch_model');
		$this->load->model('CRM_Group_model');
		$this->load->model('CRM_Contract_model');
		$this->load->model('CRM_Timetable_model');
		$this->load->model('CRM_History_model');
		
		$this->load->helper('admin');
			
		//如果没有经登录, 就跳转到admin/login登陆页
		if (!has_login())
		{
			goto_login();
		}
		
		$this->staff_info = get_staff_info();
		
		//检查权限.
		if(!check_role(array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_JIAOWU, GROUP_JIAOWU_D), $this->staff_info['group_id']))
		{
			show_access_deny_page();
		}
		
		//$this->output->enable_profiler(TRUE);
		
		//课时费标准
		$this->fee_starder = array(
			'xueke' => array(
				'fee' => array(
					2 => 40,	//小学
					3 => 60,	//初中
					4 => 80,	//高中
				),
				'level' => array(
					1 => 1,		//1星级
					3 => 1.2,	//3星级
					5 => 1.5,	//5星级
				),
			),
			'zixun' => array(
				'fee' => array(
					2 => 30,	//小学
					3 => 40,	//初中
					4 => 50,	//高中
				),
				'level' => array(
					1 => 1,		//1星级
					3 => 1.2,	//3星级
					5 => 1.5,	//5星级
				),
			),
			'suyang' => array(
				'fee' => array(
					2 => 30,	//小学
					3 => 40,	//初中
					4 => 50,	//高中
				),
				'level' => array(
					1 => 1,		//1星级
					3 => 1.2,	//3星级
					5 => 1.5,	//5星级
				),
				'factor' => array(
					1 => 1,
					2 => 1.5,
					3 => 2,
					4 => 2.3,
					5 => 2.8,
					6 => 2.9,
					7 => 3,
				)
			),
		);
	}
	
	function index($filter_string = '')
	{
		$this->class_count($filter_string);
	}
	
	function class_count($filter_string = '')
	{
		switch($this->staff_info['group_id'])
		{
			case GROUP_ADMIN: //admin管理有权限
				break;
			case GROUP_SCHOOLADMIN: //shooladmin只有查看本校区员工的权限
			default:
				$filter['branch_id'] = $this->staff_info['branch_id'];
				break;
		}
		
		//处理时间
		$filter['year'] = $this->input->post('year') ? $this->input->post('year') : date('Y');
		$filter['month'] = $this->input->post('month') ? $this->input->post('month') : date('m');
		$filter['week'] = $this->input->post('week');
		
		if(!empty($filter['week']))
		{
			$start_end_st = get_week_start_end_day($filter['year'], $filter['month'], $filter['week']);
			$filter['start_date'] = date('Y-m-d 00:00:00', $start_end_st['start_date_ts']);
			$filter['end_date'] = date('Y-m-d 23:59:59', $start_end_st['end_date_ts']);
		}
		else
		{
			$filter['start_date'] = date('Y-m-d 00:00:00', mktime(0, 0, 0, $filter['month'], 1, $filter['year']));
			$filter['end_date'] = date('Y-m-d 23:59:59', mktime(0, 0, 0, $filter['month'], date('t', strtotime($filter['start_date'])), $filter['year']));
		}
		
		//获取课程表数据源。
		$time_table = $this->CRM_Timetable_model->get_all_timetable($filter);
		$tt_suspend_log = $this->CRM_Timetable_model->get_all_suspend_log($filter);
		//处理数据
		$tt_res_arr = array();
		$student_info = array();
		$staff_info = array();
		$subject_info = array();
		$start_ts = strtotime($filter['start_date']);
		$end_ts = strtotime($filter['end_date']);
		
		for($i = $start_ts; $i <= $end_ts; $i += 60 * 60 * 24)
		{
			$this_day = date('N', $i);
			if(isset($time_table[$this_day]))
				foreach($time_table[$this_day] as $val)
				{
					$val['class_date'] = date('Y-m-d', $i);
					
					//判断 课程的添加时间
					if($val['class_date'].' 00:00:00' <= $val['add_time'])
						continue 2;
					
					//判断 暂停的 log
					if(isset($tt_suspend_log[$val['timetable_id']]))
						foreach($tt_suspend_log[$val['timetable_id']] as $one_log)
						{
							if($one_log['suspend_date'] <= $val['class_date'] 
								&& ($one_log['unsuspend_date'] == '0000-00-00' || $one_log['unsuspend_date'] >= $val['class_date'] ))
								continue 2;
						}
					
					$tt_res_arr[$val['staff_id']][$val['student_id']][] = $val;
					
					//学生，老师，科目的信息
					$subject_info[$val['staff_id'].$val['student_id']] = $val['subject_name'];
					if(!isset($student_info[$val['student_id']]))
						$student_info[$val['student_id']] = $val['name'];
					if(!isset($staff_info[$val['staff_id']]))
						$staff_info[$val['staff_id']] = $val['staff_name'];
				}
		
		}
		
		//获取课时单数据源。
		$finished = $this->CRM_Contract_model->get_all_finished($filter);
		$cf_res_arr = array();
		foreach($finished as $val)
		{
			$cf_res_arr[$val['teacher_id']][$val['student_id']][] = $val;
			
			//对课程表数据进行补充
			if(!isset($tt_res_arr[$val['teacher_id']][$val['student_id']]))
			{
				$tt_res_arr[$val['teacher_id']][$val['student_id']] = array();
				
				//学生，老师，科目的信息
				if(!isset($subject_info[$val['teacher_id'].$val['student_id']]))
					$subject_info[$val['teacher_id'].$val['student_id']] = $val['subject_name'];
				if(!isset($staff_info[$val['teacher_id']]))
					$staff_info[$val['teacher_id']] = $val['staff_name'];
				if(!isset($student_info[$val['student_id']]))
						$student_info[$val['student_id']] = $val['name'];
			}
		}
		
		
		//教案数据源
		$history_res_arr = $this->CRM_History_model->get_all_xueke_history($filter);
		
		$data['header']['meta_title'] = '课时统计系统 - 员工工资管理系统';
		$data['main']['tt_res_arr'] = $tt_res_arr;
		$data['main']['cf_res_arr'] = $cf_res_arr;
		$data['main']['history_res_arr'] = $history_res_arr;
		
		$data['main']['student_info'] = $student_info;
		$data['main']['staff_info'] = $staff_info;
		$data['main']['subject_info'] = $subject_info;
		$data['main']['filter'] = $filter;
		
		_load_viewer($this->staff_info['group_id'], 'pms_class_count', $data);
	}
	
	function class_fee($filter_string = '')
	{
		//默认值
		$filter['page'] = 1;
		$filter['class_start_time'] = $this->input->post('class_start_time');
		$filter['class_end_time'] = $this->input->post('class_end_time');
		$filter['branch_id'] = $this->input->post('branch_id');
		$filter['grade_id'] = $this->input->post('grade_id');
		$filter['group_id'] = $this->input->post('group_id');
		$filter['name'] = $this->input->post('name');
		$filter['is_active'] = 1;
		$filter['is_delete'] = 0;
	
		$filter = $this->_parse_filter($filter_string, $filter);
		
		switch($this->staff_info['group_id'])
		{
			case GROUP_ADMIN: //admin管理有权限
				break;
			case GROUP_SCHOOLADMIN: //shooladmin只有查看本校区员工的权限
				$filter['branch_id'] = $this->staff_info['branch_id'];
				break;
			default:
				show_error_page('您没有权限查看员工列表: 请重新登录或者联系管理员!', 'admin');
				return false;
		}
		
		//Page Nav
		$total = $this->CRM_Staff_model->getAll_count($filter);
		$page_nav = page_nav($total, STAFF_PER_PAGE, $filter['page']);
		$page_nav['base_url'] = 'admin/pms/class_fee';
		$page_nav['filter'] = $filter;
		$data['main']['page_nav'] = $this->load->view('admin/common_page_nav', $page_nav, true);
		
		$staffs = $this->CRM_Staff_model->getAll($filter, $page_nav['start'], STAFF_PER_PAGE);
		
		foreach($staffs as $key => $staff)
		{
			if($this->_is_teacher($staff['group_id']))
				$staffs[$key]['class_fee'] = $this->_cal_class_fee($staff, $filter);
			else
				$staffs[$key]['class_fee'] = '--';
		}
		
		$data['header']['meta_title'] = '课时费 - 员工工资管理系统';
		$data['header']['css_file'] = '../calendar.css';
		$data['footer']['js_file'] = '../calendar.js';
		$data['main']['staffs'] = $staffs;
		$data['main']['branches'] = $this->_get_branch();
		$data['main']['groups'] = $this->_get_groups();
		$data['main']['filter'] = $filter;
		_load_viewer($this->staff_info['group_id'], 'pms_class_fee', $data);
	}
	
	function one($staff_id)
	{
		//判断student_id是否合法.
		$staff_id = intval($staff_id);
		if($staff_id <= 0)
		{
			show_error_page('您输入的员工ID不合法, 请返回重试.', 'admin/staff');
			return false;
		}
		
		//获取 staff 信息.
		$staff_info = $this->CRM_Staff_model->getOne($staff_id);
		
		//检查权限
		if(empty($staff_info))
		{
			show_error_page('您所查询的员工不存在!', 'admin/student');
			return false;
		}
		
		$data['header']['meta_title'] = $staff_info['name'].' -查看员工 - 管理员工';
		$data['main']['staff'] = $staff_info;
		
		_load_viewer($this->staff_info['group_id'], 'staff_one', $data);
	}
	
	function _cal_class_fee($staff_info, $filter = array())
	{
		//判断student_id是否合法.
		$staff_id = intval($staff_info['staff_id']);
		if($staff_id <= 0)
		{
			show_error_page('您输入的员工ID不合法, 请返回重试.', 'admin/staff');
			return false;
		}
		
		//获取上课的记录
		$finish_class = $this->CRM_Contract_model->get_one_finished_class_detail($staff_id, $filter);
		
		//计算课时
		$class_suyang = array();
		$class_xueke = array();
		foreach($finish_class as $val)
		{
			if($val['subject_id'] == SUBJECT_SUYANG)
				$class_suyang[] = $val;
			else
				$class_xueke[] = $val;
		}
		
		$suyang_fee = $this->_cal_suyang_fee($staff_info, $class_suyang);
		$xueke_fee = $this->_cal_xueke_fee($staff_info, $class_xueke);
		
		return array('suyang' => $suyang_fee, 'xueke' => $xueke_fee);
	}
	
	//计算学科课时费
	function _cal_xueke_fee($staff_info, $class_xueke)
	{
		if(empty($class_xueke))
			return array('total_hours' => 0, 'total_fee' => 0);
		
		$total_hours = 0;
		$total_fee = 0;
		foreach($class_xueke as $val)
		{
			$total_hours += $val['finished_hours'];
			
			//计算公式： 课时费（F） = 课时数（N）* 基准课时费（S）* 教师星级系数(L)
			$N = $val['finished_hours'];
			$S = $this->fee_starder['xueke']['fee'][$val['grade']];
			$L = $this->fee_starder['xueke']['level'][$staff_info['level']];
			$F = $N * $S * $L;
			$total_fee += $F;
		}
		
		return array('total_hours' => $total_hours, 'total_fee' => $total_fee);
	}
	
	//计算素养课时费
	function _cal_suyang_fee($staff_info, $class_suyang)
	{
		if(empty($class_suyang))
			return array('total_hours' => 0, 'total_fee' => 0);
		
		//按上课开始时间分类。
		$suyang = array();
		foreach($class_suyang as $val)
		{
			$suyang[$val['start_time']][] = $val;
		}
		
		$total_hours = 0;
		$total_fee = 0;
		foreach($suyang as $val)
		{
			$person = count($val);
			$total_hours += $val[0]['finished_hours'] * $person;
			
			//计算公式： 课时费（F） = 课时数（N）* 基准课时费（S）* 教师星级系数(L) * 上课总人数系数（T）
			//如果上课人数对于标准的最多人数，则按照标准的最多人数计算
			$max_person = end(array_keys($this->fee_starder['suyang']['factor']));
			$T = $this->fee_starder['suyang']['factor'][(($person > $max_person) ? $max_person : $person)];
			$N = $val[0]['finished_hours'];  //取第一个记录的完成小时数
			$L = $this->fee_starder['suyang']['level'][$staff_info['level']];
			//如果是小学，初中，高中混合班的话，则算出平均标准课时费，等于总标准课时费除以总人数。
			$total_stander_fee = 0;
			foreach($val as $v)
				$total_stander_fee += $this->fee_starder['suyang']['fee'][$v['grade']];
			$S = $total_stander_fee / $person;
			
			$F = $N * $S * $L * $T;
			$total_fee += $F;
		}
		
		return array('total_hours' => $total_hours, 'total_fee' => $total_fee);
	}
	
	function _get_branch()
	{
		$result = array();
		if($this->staff_info['group_id'] == GROUP_ADMIN)
		{
			$result['show_branch_list'] = true;
			$result['branch'] = $this->CRM_Branch_model->get_branches();
		}
		else
		{
			$result['show_branch_list'] = false;
			$result['branch'] = $this->CRM_Branch_model->get_one_branch($this->staff_info['branch_id']);
		}
		return $result;		
	}
	
	function _get_groups()
	{
		switch($this->staff_info['group_id'])
		{
			case GROUP_ADMIN: //admin管理有权限
				$from_group = GROUP_ADMIN;
				break;
			case GROUP_SCHOOLADMIN: //shooladmin只有查看本校区员工的权限
				$from_group = GROUP_CONSULTANT;
				break;
			default:
				return array();
		}
		return $this->CRM_Group_model->get_groups($from_group);
	}
	
	function _is_teacher($group_id)
	{
		return check_role(array(GROUP_SUYANG, GROUP_SUYANG_D, GROUP_CONSULTANT_D, GROUP_CONSULTANT, GROUP_TEACHER_PARTTIME, GROUP_CONSULTANT_PARTTIME,GROUP_TEACHER_FULL, GROUP_TEACHER_D), $group_id);
	}
	
	function _parse_filter($filter_string, $filter)
	{
		$input_filter = parse_filter($filter_string);
		foreach($filter as $key => $value)
		{
			if(!isset($input_filter[$key]))
				continue;
			
			switch($key)
			{
				case 'class_start_time':
				case 'class_end_time':
				case 'start_time':
				case 'end_time':
					if(!check_valid_date($input_filter[$key]))
						continue;
					$filter[$key] = $input_filter[$key];
					break;
				case 'page':
				case 'branch_id':
				case 'grade_id':
				case 'group_id':
				case 'is_active':
				case 'is_delete':
				case 'in_trial':
					$input_filter[$key] = intval($input_filter[$key]);
					break;
				case 'name':
				default:
					break;
			}
			
			if(empty($input_filter[$key]) && $input_filter[$key] !== 0)
				continue;
			
			$filter[$key] = $input_filter[$key];
		}
		return $filter;
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */