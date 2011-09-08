
<?php

class primaryEdu22 extends Controller {

	function primaryEdu22()
	{
		parent::Controller();
		$this->controller= 'primaryEdu22';
	}
	
	function index( $key = 'index' )
	{
		//todo
		$this->config->load('text/'.$this->controller);
		
		if( !array_key_exists( $key,  $this->config->config[$this->controller] ) )  //todo
		{
			$key = 'index';
		}		
		$data = $this->config->config[$this->controller][$key];
		$data['list'] = $this->config->config[$this->controller];
		$data['controller'] = $this->controller;
		$data_header['meta_title'] = $this->config->config[$this->controller][$key]['page_title'];
		$data_header['meta_keywords'] = $this->config->config[$this->controller][$key]['meta_keywords'];
		$data_header['meta_description'] = $this->config->config[$this->controller][$key]['meta_description'];
		$data_header['css_file'] = 'growth_plan.css';
		$data_header['no_header'] = TRUE;
		
		$this->load->view('header', $data_header);
		$this->load->view('static/promo_common_frame', $data);
		$this->load->view('footer');
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */