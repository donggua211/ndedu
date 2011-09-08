<?php
/* 
  班主任管理模块
  admin权限.
 */
class History extends Controller {

	function History()
	{
		parent::Controller();
		$this->load->library('session');
		
		$this->load->model('CRM_Student_model');
		$this->load->model('CRM_History_model');
		
		$this->load->helper('admin');
		
		$this->type = 'contact';
		
		//如果没有经登录, 就跳转到admin/login登陆页
		if (!has_login())
		{
			goto_login();
		}
		
		/* No need to check, becouse, all groups could access this class.
		$this->allowed_group = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_CONSULTANT);
		//检查权限.
		if(!check_role($this->allowed_group))
		{
			show_access_deny_page();
		}
		*/
		//$this->output->enable_profiler(TRUE);
		
		$this->staff_info = get_staff_info();
	}
	
	function edit_contact($history_id = 0)
	{
		$history_id = (empty($history_id))? $this->input->post('history_id') : intval($history_id);
		$this->_edit('contact', $history_id);
	}
	function edit_learning($history_id = 0)
	{
		$history_id = (empty($history_id))? $this->input->post('history_id') : intval($history_id);
		$this->_edit('learning', $history_id);
	}
	
	function _edit($type, $history_id)
	{
		$this->type = $type;
		//判断history_id是否合法.
		$history_id = intval($history_id);
		if($history_id <= 0)
		{
			show_error_page('您输入的历史ID不合法, 请返回重试.');
			return false;
		}
		
		$history_info = $this->CRM_History_model->_get_one_history($history_id, $this->type);
		$student_info = $this->CRM_Student_model->getOne($history_info['student_id']);
		
		//检查权限.
		if(empty($history_info) || empty($history_info))
		{
			show_error_page('您所查询的学员不存在!', 'admin/student');
			return false;
		}
		switch($this->staff_info['group_id'])
		{
			case GROUP_ADMIN: //admin管理有权限
			case GROUP_SCHOOLADMIN: //shooladmin只有查看本小区学员的权限
				break;
			case GROUP_CONSULTANT:
			case GROUP_SUPERVISOR:
				if($history_info['staff_id'] != $this->staff_info['staff_id'])
				{
					show_error_page('您没有权限修改别人的历史记录: 这条记录不是您添加的!', 'admin/student');
					return false;
				}
				break;
			default:
				show_error_page('您没有权限查看该学员: 请重新登录或者联系管理员!', 'admin/student');
				return false;
		}
		
		//执行编辑
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//必填信息.
			$history_text = $this->input->post('history_text');
			
			if(empty($history_text))
			{
				$notify = '历史记录不能为空!';
				$this->_load_history_edit_view($notify, $history_info, $student_info);
			}
			//检查修改项
			$update_field = array();
			if(!empty($history_text) && ($history_text != $history_info['history_text']))
			{
				switch($this->type)
				{
					case 'contact':
						$update_field['history_contact'] = $history_text;
						break;
					case 'learning':
						$update_field['history_learning'] = $history_text;
						break;
					default:
						break;
				}
			}
			
			if($this->CRM_History_model->_update($history_id, $this->type, $update_field))
			{
				show_result_page('历史记录已经更新成功! ', 'admin/student/one/'.$student_info['student_id'].'/history');
			}
			else
			{
				$notify = '更新失败, 请重试.';
				$this->_load_history_edit_view($notify, $history_info, $student_info);
			}
		}
		else
		{
			$this->_load_history_edit_view('', $history_info, $student_info);
		}
	}
	
	function _load_history_edit_view($notify, $history_info, $student_info)
	{
		$data['header']['meta_title'] = '已学完课程 - 合同信息 - 管理学员';
		$data['main']['history_info'] =$history_info;
		$data['main']['student_info'] =$student_info;
		$data['main']['type'] = $this->type;
		$data['main']['notification'] = $notify;
		_load_viewer($this->staff_info['group_id'], 'history_edit', $data);
	
	}
	
	function delete_contact($history_id)
	{
		$this->_delete('contact', $history_id);
	}
	function delete_learning($history_id)
	{
		$this->_delete('learning', $history_id);
	}
	
	function _delete($type, $history_id)
	{
		$this->type = $type;
		//判断history_id是否合法.
		$history_id = intval($history_id);
		if($history_id <= 0)
		{
			show_error_page('您输入的历史ID不合法, 请返回重试.');
			return false;
		}
		
		$history_info = $this->CRM_History_model->_get_one_history($history_id, $this->type);
		
		//检查权限.
		if(empty($history_info))
		{
			show_error_page('您所查询的历史不存在!', 'admin/student');
			return false;
		}
		switch($this->staff_info['group_id'])
		{
			case GROUP_ADMIN: //admin管理有权限
			case GROUP_SCHOOLADMIN: //shooladmin只有查看本小区学员的权限
				break;
			case GROUP_CONSULTANT:
			case GROUP_SUPERVISOR:
				if($history_info['staff_id'] != $this->staff_info['staff_id'])
				{
					show_error_page('您没有权限修改别人的历史记录: 这条记录不是您添加的!', 'admin/student');
					return false;
				}
				break;
			default:
				show_error_page('您没有权限查看该学员: 请重新登录或者联系管理员!', 'admin/student');
				return false;
		}
		
		$update_field['is_delete'] = 1;
		if($this->CRM_History_model->_update($history_id, $this->type, $update_field))
		{
			show_result_page('历史记录已经添加删除! ', 'admin/student/one/'.$history_info['student_id'].'/history');
		}
		else
		{
			show_error_page('删除失败, 请重试.', 'admin/student/one/'.$history_info['student_id'].'/history');
		}
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */