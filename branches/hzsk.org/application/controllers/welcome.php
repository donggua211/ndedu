<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Article_model');

		$this->load->helper('common');
	}
	function index()
	{
		$data['header']['show_flash'] = 1;
		$data['main']['sidebar1'] = $this->Article_model->getArticleByCat(1, 'time', 6);
		$this->_load_index_view('index', $data);
	}
	
	function _load_index_view($template, $data = array())
	{
		$data['header']['css_file'] = 'index.css';
						
		_load_viewer($template, $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */