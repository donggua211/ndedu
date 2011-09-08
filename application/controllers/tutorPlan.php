<?php

class TutorPlan extends Controller {

	function TutorPlan()
	{
		parent::Controller();
	}
	
	function index( $key = 'golden' )
	{
		$this->config->load('tutor_plan');
		
		if( !array_key_exists( $key,  $this->config->config['tutor_plan'] ) ) 
		{
			$key = 'golden';
		}
		
		$data = $this->config->config['tutor_plan'][$key];
		$this->load->view('tutor_plan/frame.php', $data);
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */