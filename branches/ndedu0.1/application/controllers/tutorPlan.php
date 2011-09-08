<?php

class TutorPlan extends Controller {

	function TutorPlan()
	{
		parent::Controller();
	}
	
	function index( $key = 'golden' )
	{
		$this->config->load('text/tutor_plan');
		
		if( !array_key_exists( $key,  $this->config->config['tutor_plan'] ) ) 
		{
			$key = 'golden';
		}
		
		$data = $this->config->config['tutor_plan'][$key];
		$data_header['meta_title'] = $data['page_title'];
		$data_header['meta_keywords'] = $data['meta_keywords'];
		$data_header['meta_description'] = $data['meta_description'];
		$data_header['css_file'] = 'tutor_plan.css';
		$data_header['no_header'] = TRUE;
		
		$this->load->view('header', $data_header);
		$this->load->view('static/tutor_plan_frame.php', $data);
		$this->load->view('footer');
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */