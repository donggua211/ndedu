<?php

class RSS extends Controller {

	function RSS()
	{
		parent::Controller();
		$this->load->helper('string');
		$this->load->model('Article_model');
		$this->load->model('ArticleCat_model');
	}
	
	function index($cat_id = 1)
	{
		$data['articles'] = $this->Article_model->getArticleByCat($cat_id, 'time');
		$this->load->view('rss', $data);
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */