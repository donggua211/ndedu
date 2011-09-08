<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class product extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Article_model');

		$this->load->helper('common');
	}
	
	function index()
	{
		$data['main']['sidebar1'] = $this->Article_model->getArticleByCat(1, 'time', 6);
		$this->_load_product_view('product_index', $data);
	}
	
	function _load_product_view($template, $data = array())
	{
		$data['header']['css_file'] = 'product.css';
		$data['header']['nav_menu_id'] = '2';
						
		_load_viewer($template, $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */