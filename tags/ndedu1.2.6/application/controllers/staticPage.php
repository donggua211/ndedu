<?php

class StaticPage extends Controller {

	function StaticPage()
	{
		parent::Controller();
		
		$this->load->helper('common');
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
	
	function teacher()
	{
		$this->config->load('text/teacher');
		$data['teachers'] = $this->config->config['teacher'];
		
		$data_header['nav_menu_id'] = 9;
		$data_header['meta_title'] = '尼德师资';
		
		$this->load->view('header', $data_header);
		$this->load->view('teacher', $data);
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
	
	function oo1()
	{
		$data_header['css_file'] = 'promo0901.css';
		$data_header['meta_title'] = '尼德教育九大理由保障成绩提高，成功规划学业，成就完美人生！';
		$data_header['no_header'] = TRUE;
		$this->load->view('header', $data_header);
		$this->load->view('promo0901');
		$this->load->view('footer');
	}
	
	function _load_viewer($template)
	{
		$template_arr = array('header', $template, 'footer');
		_load_viewer($template_arr, $data);
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */