<?php
/* 
  班主任管理模块
  admin权限.
 */
class Status_History extends Controller {

	function Status_History()
	{
		parent::Controller();
		$this->load->library('session');
		
		$this->load->model('CRM_Student_model');
		$this->load->model('CRM_Status_history_model');
		
		$this->load->helper('admin');
		
		//如果没有经登录, 就跳转到admin/login登陆页
		if (!has_login())
		{
			goto_login();
		}
		
		$this->staff_info = get_staff_info();
		//检查权限.
		if(!check_role(array(GROUP_ADMIN, GROUP_SCHOOLADMIN), $this->staff_info['group_id']))
		{
			show_access_deny_page();
		}
		
		//$this->output->enable_profiler(TRUE);
	}
	
	function delete()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$status_history_id = $this->input->post('status_history_id');
			
			$status_history_info = $this->CRM_Status_history_model->getOne($status_history_id);
			$student_info = $this->CRM_Student_model->getOne($status_history_info['student_id']);
			
			if(empty($status_history_info) || empty($student_info))
			{
				show_error_page('您所删除的记录不存在!', '');
				return false;
			}
			
			//检查权限.
			switch($this->staff_info['group_id'])
			{
				case GROUP_ADMIN: //admin管理有权限
					break;
				case GROUP_SCHOOLADMIN: //shooladmin只有查看本校区员工的权限
					if($student_info['branch_id'] != $this->staff_info['branch_id'])
					{
						show_error_page('您没有权限删除该记录: 他/她不在您所在的校区!', '');
						return false;
					}
					break;
				default:
					show_error_page('您没有权限删除该记录: 请重新登录或者联系管理员!', '');
					return false;
			}
			
			if($this->CRM_Status_history_model->delete($status_history_id))
			{
				$notify = '记录已经成功删除!';
				
				//将student表的status回复
				$update_field['status'] = $status_history_info['from_status'];
				if($this->CRM_Student_model->update($status_history_info['student_id'], $update_field))
				{
					$notify .= '学员的状态已经回复!';
				}
				else
				{
					$notify .= '但是学员的状态没有回复, 请联系管理员, 手动恢复!';
				}
				show_result_page($notify, 'admin/student/one/'.$status_history_info['student_id']);
			}
			else
			{
				$notify = '记录已经成功删除, 请重试.';
				show_error_page($notify, 'admin/student/one/'.$status_history_info['student_id']);
			}
		}
		else
		{
			show_error_page('您无权访问该页面', '');
		}
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */