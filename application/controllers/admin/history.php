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
		
		$this->types = array('learning', 'contact', 'callback', 'consult', 'suyang');
	}
	
	function _check_history_type($history_type)
	{
		//判断history type.
		return in_array($history_type, $this->types);
	}
	
	function edit($type = '', $history_id = 0)
	{
		if(!$this->_check_history_type($type))
		{
			show_error_page('您输入的历史种类不合法, 请返回重试.');
			return false;
		}
		//判断history_id是否合法.
		$history_id = intval($history_id);
		if($history_id <= 0)
		{
			show_error_page('您输入的历史ID不合法, 请返回重试.');
			return false;
		}
		
		$history_info = $this->CRM_History_model->_get_one_history($history_id, $type);
		
		//检查权限.
		if(empty($history_info))
		{
			show_error_page('您所查询的学员不存在!', 'admin/student');
			return false;
		}
		switch($this->staff_info['group_id'])
		{
			case GROUP_ADMIN: //admin管理有权限
			case GROUP_SCHOOLADMIN: //shooladmin只有查看本小区学员的权限
				break;
			default:
				if($history_info['staff_id'] != $this->staff_info['staff_id'])
				{
					show_error_page('您没有权限修改别人的历史记录: 这条记录不是您添加的!', 'admin/student/one/'.$student_id.'/history');
					return false;
				}
				break;
				return false;
		}
		
		//执行编辑
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//必填信息.
			$history_text = $this->input->post('history_text');
			$student_id = $this->input->post('student_id');
			
			if(empty($history_text))
			{
				$notify = '历史记录不能为空!';
				$this->_load_history_edit_view($notify, $type, $history_info);
			}
			//检查修改项
			$update_field = array();
			if(!empty($history_text) && ($history_text != $history_info['history_text']))
			{
				$update_field['history_'.$type] = $history_text;
			}
			
			if($this->CRM_History_model->_update($history_id, $type, $update_field))
			{
				show_result_page('历史记录已经更新成功! ', 'admin/student/one/'.$student_id.'/history');
			}
			else
			{
				$notify = '更新失败, 请重试.';
				$this->_load_history_edit_view($notify, $type, $history_info);
			}
		}
		else
		{
			$this->_load_history_edit_view('', $type, $history_info);
		}
	}
	
	function _load_history_edit_view($notify, $type, $history_info)
	{
		$data['header']['meta_title'] = '已学完课程 - 合同信息 - 管理学员';
		$data['main']['history_info'] =$history_info;
		$data['main']['student_info'] = $this->CRM_Student_model->getOne($history_info['student_id']);
		$data['main']['type'] = $type;
		$data['main']['notification'] = $notify;
		_load_viewer($this->staff_info['group_id'], 'history_edit', $data);
	
	}
	
	function delete($type = '', $history_id = 0)
	{
		if(!$this->_check_history_type($type))
		{
			show_error_page('您输入的历史种类不合法, 请返回重试.');
			return false;
		}
		
		//判断history_id是否合法.
		$history_id = intval($history_id);
		if($history_id <= 0)
		{
			show_error_page('您输入的历史ID不合法, 请返回重试.');
			return false;
		}
		
		$history_info = $this->CRM_History_model->_get_one_history($history_id, $type);
		
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
			default:
				if($history_info['staff_id'] != $this->staff_info['staff_id'])
				{
					show_error_page('您没有权限修改别人的历史记录: 这条记录不是您添加的!', 'admin/student');
					return false;
				}
				break;
		}
		
		$update_field['is_delete'] = 1;
		if($this->CRM_History_model->_update($history_id, $type, $update_field))
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