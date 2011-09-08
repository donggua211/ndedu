<?php
/* 
  班主任管理模块
  admin权限.
 */
class Teacher extends Controller {

	function Teacher()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->model('Student_model');
		$this->load->helper('admin_authority');
		
		$this->allowed_group = array(1, 2);
		
		//如果没有经登录, 就跳转到admin/login登陆页
		if (!has_login())
		{
			goto_login();
		}
		
		//检查权限.
		if(!check_role($this->allowed_group))
		{
			show_access_deny_page();
		}
	}
	
	function index()
	{
		
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */