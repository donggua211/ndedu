<?php

class GrowthPlan extends Controller {

	function GrowthPlan()
	{
		parent::Controller();
	}
	
	function index( $key = 'study' )
	{
		$this->config->load('text/growth_plan');
		
		if( !array_key_exists( $key,  $this->config->config['growth_plan'] ) ) 
		{
			$key = 'study';
		}
		
		$data = $this->config->config['growth_plan'][$key];
		$data_header['meta_title'] = $data['page_title'];
		$data_header['meta_keywords'] = $data['meta_keywords'];
		$data_header['meta_description'] = $data['meta_description'];
		$data_header['css_file'] = 'growth_plan.css';
		$data_header['no_header'] = TRUE;
		
		$this->load->view('header', $data_header);
		$this->load->view('static/growth_plan_frame.php', $data);
		$this->load->view('footer');
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */