<?php

class StaticPage extends Controller {

	function StaticPage()
	{
		parent::Controller();
	}

	function contactus()
	{
		$data_header['nav_menu_id'] = 7;
		$data_header['meta_title'] = '联系我们';
		$data_header['load_google_map'] = TRUE;
		
		$this->load->view('header', $data_header);
		$this->load->view('contactus');
		$this->load->view('footer');
	}
	
	function siteMap()
	{
		$data_header['meta_title'] = '网站地图';
		$data_header['no_header'] = TRUE;
		$this->load->view('header', $data_header);
		$this->load->view('sitemap');
		$this->load->view('footer');
	}
	
	function goldenLearningPlan(){
		$data['cat_url'] = 'goldenLearningPlan';
		$data_header['nav_menu_id'] = 2;
		$data_header['meta_title'] = '学习规划-一对一访谈-学动力测评-成长档案-师资';
		$data_header['meta_keywords'] = '学习规划-一对一访谈-学动力测评-成长档案-师资';
		
		$this->load->view('header', $data_header);
		$this->load->view('contactus', $data);
		$this->load->view('footer');
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */