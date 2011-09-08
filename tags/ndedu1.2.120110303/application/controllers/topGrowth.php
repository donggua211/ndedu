<?php

class TopGrowth extends Controller {

	function TopGrowth()
	{
		parent::Controller();
	}
	
	function index()
	{
		$name = 'index';
		$page_title = '精英成长计划';
		$this->load_view( $name, $page_title );
	}
	
	function mszj()
	{
		$name = 'mszj';
		$page_title = '孩子学习问题名师诊断';
		$this->load_view( $name, $page_title );
	}

	function qwxy()
	{
		$name = 'qwxy';
		$page_title = '学业指导方案';
		$this->load_view( $name, $page_title );
	}
	
	function jczy()
	{
		$name = 'jczy';
		$page_title = '优质教育资源';
		$this->load_view( $name, $page_title );
	}
	
	function jzjl()
	{
		$name = 'jzjl';
		$page_title = '交流分享孩子成长';
		$this->load_view( $name, $page_title );
	}
	
	function jxjlp()
	{
		$name = 'jxjlp';
		$page_title = '奖学金';
		$this->load_view( $name, $page_title );
	}
	
	function hygs()
	{
		$name = 'hygs';
		$page_title = '精英成长会员感受';
		$this->load_view( $name, $page_title );
	}
	
	function load_view( $name, $page_title ){
		$data_header['name'] = $name;
		$data_header['meta_title'] = $page_title;
		$data_header['meta_keywords'] = '精英成长计划,'.$page_title;
		$data_header['meta_description'] = '精英成长计划,'.$page_title;
		$data_header['css_file'] = 'top_growth_style.css';
		$data_header['no_header'] = TRUE;
		
		$this->load->view('header', $data_header);
		$this->load->view('top_growth/header', $data_header);
		$this->load->view('top_growth/'.$name);
		$this->load->view('top_growth/footer');
		$this->load->view('footer');
	}
	
	function fee()
	{
		$data_header['meta_title'] = '精英学习计划资费';
		$data_header['meta_keywords'] = '精英成长计划, 精英学习计划资费';
		$data_header['meta_description'] = '精英成长计划, 精英学习计划资费';
		$data_header['css_file'] = 'top_growth_style.css';
		$data_header['no_header'] = TRUE;
		
		$this->load->view('header', $data_header);
		$this->load->view('top_growth/fee');
		//$this->load->view('top_growth/footer');
		$this->load->view('footer');
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */