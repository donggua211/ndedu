<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class article extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Article_model');
		$this->load->model('ArticleCat_model');

		$this->load->helper('common');
	}
	
	function index($article_id = 0)
	{
		$article_id = intval($article_id);
		$article_info = $this->Article_model->getOneArticle($article_id);
		
		$data['main']['article_info'] = $article_info;
		$data['main']['sidebar1'] = $this->Article_model->getArticleByCat($article_info['cat_id'], 'count', 6);
		$this->_load_article_view('article', $data);
	}
	
	function cat($article_cat = 0)
	{
		$article_cat = intval($article_cat);
		
		$cat_info = $this->ArticleCat_model->getOneCategory($article_cat, 'time');
		
		$article_list = $this->Article_model->getArticleByCat($article_cat, 'time');
		
		$data['main']['article_list'] = $article_list;
		$data['main']['cat_info'] = $cat_info;
		$this->_load_article_view('article_cat', $data);
	}
	
	function _load_article_view($template, $data = array())
	{
		$data['header']['css_file'] = 'article.css';
						
		_load_viewer($template, $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */