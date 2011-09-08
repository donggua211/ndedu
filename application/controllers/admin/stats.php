<?php
/* 
  ���¹���
  adminȨ��.
 */
class Stats extends Controller {

	function Stats()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->model('Stats_model');
		$this->load->helper('admin_authority');
		
		$this->allowed_group = array(1);
		
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
		$this->keywords;
	}
	
		
	function keywords()
	{
		$data['keyword_stats'] = $this->Stats_model->getKeywordStats();
		$this->load->view('admin/stats_keyword.php', $data);
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */