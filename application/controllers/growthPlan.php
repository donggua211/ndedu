<?php

class GrowthPlan extends Controller {

	function GrowthPlan()
	{
		parent::Controller();
	}
	
	function index( $key = 'study' )
	{
		$this->config->load('growth_plan');
		
		if( !array_key_exists( $key,  $this->config->config['growth_plan'] ) ) 
		{
			$key = 'study';
		}
		
		$data = $this->config->config['growth_plan'][$key];
		$this->load->view('growth_plan/frame.php', $data);
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */