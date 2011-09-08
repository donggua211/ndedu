<?php

class TopGrowth extends Controller {

	function TopGrowth()
	{
		parent::Controller();
	}
	
	function index()
	{
		$name = 'index';
		$page_title = '精英学习计划是什么';
		$this->load_view( $name, $page_title );
	}
	
	function mszj()
	{
		$name = 'mszj';
		$page_title = '名师专家诊断';
		$this->load_view( $name, $page_title );
	}

	function qwxy()
	{
		$name = 'qwxy';
		$page_title = '权威学业指导方案';
		$this->load_view( $name, $page_title );
	}
	
	function jczy()
	{
		$name = 'jczy';
		$page_title = '及时获取京城优质教育资源';
		$this->load_view( $name, $page_title );
	}
	
	function jzjl()
	{
		$name = 'jzjl';
		$page_title = '全国家长共同分享交流孩子成长';
		$this->load_view( $name, $page_title );
	}
	
	function jxjlp()
	{
		$name = 'jxjlp';
		$page_title = '评选丰厚奖学金、礼品';
		$this->load_view( $name, $page_title );
	}
	
	function hygs()
	{
		$name = 'hygs';
		$page_title = '精英会员感受';
		$this->load_view( $name, $page_title );
	}
	
	function load_view( $name, $page_title ){
		$data['name'] = $name;
		$data['page_title'] = $page_title;
		$this->load->view('top_growth/header', $data);
		$this->load->view('top_growth/'.$name);
		$this->load->view('top_growth/footer');
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */