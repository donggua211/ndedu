<?php
/* 
  文章管理
  admin权限.
 */
class Stats extends Controller {

	function Stats()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->model('Stats_model');
		$this->load->helper('admin');
		
		//如果没有经登录, 就跳转到admin/login登陆页
		if (!has_login())
		{
			goto_login();
		}
		
		$this->staff_info = get_staff_info();
		//检查权限.
		if(!check_role(array(GROUP_ADMIN), $this->staff_info['group_id']))
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
		$data['header']['meta_title'] = '查看搜索关键字 - 统计';
		$data['main']['keyword_stats'] = $this->Stats_model->getKeywordStats();
		_load_viewer($this->staff_info['group_id'], 'stats_keyword', $data);
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */