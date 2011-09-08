<?php
/* 
  �����ι���ģ��
  adminȨ��.
 */
class Teacher extends Controller {

	function Teacher()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->model('Student_model');
		$this->load->helper('admin_authority');
		
		$this->allowed_group = array(1, 2);
		
		//���û�о���¼, ����ת��admin/login��½ҳ
		if (!has_login())
		{
			goto_login();
		}
		
		//���Ȩ��.
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