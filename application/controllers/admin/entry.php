<?php
/* 
  默认显示页.
  公共权限
 */
class Entry extends Controller {

	function Entry()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->model('Guestbook_model');
		$this->load->helper('admin_authority');
		
		//$this->allowed_group = array(1);
		
		//如果没有经登录, 就跳转到admin/login登陆页
		if (!has_login())
		{
			goto_login();
		}
		
		/*
		//检查权限.
		if(!check_role($this->allowed_group))
		{
			//show_access_deny_page();
		}
		*/
	}
	
	function index()
	{
		$this->load->view('admin/admin');
	}
	
	function menu()
	{
		$group_id = get_group_id();
		$data['group_id'] = $group_id;
		$this->load->view('admin/menu', $data);
	}
	
	function top()
	{
		$this->load->view('admin/top');
	}
	
	function info()
	{
		$data["new_messages"] = $this->Guestbook_model->getLast10NewGuestBook();
		$this->load->view('admin/info', $data);
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */