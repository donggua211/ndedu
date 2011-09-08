<?php

class ArticleCat extends Controller {

	function ArticleCat()
	{
		$this->num_sidebar_articles = 11;
		$this->articles_per_page = 15;
		
		parent::Controller();
		$this->load->helper('string');
		$this->load->model('Article_model');
		$this->load->model('ArticleCat_model');
	}
	
	function index($cat_id, $page = 1)
	{
		$data['article_nav']['totle_articles'] =  $this->Article_model->getTotleArticleNumByCat($cat_id);
		$data['article_nav']['totle_page'] = ceil($data['article_nav']['totle_articles']/$this->articles_per_page);
		$data['article_nav']['articles_per_page'] = $this->articles_per_page;
						
		if($page > $data['article_nav']['totle_page'])
			$page = 1;
		
		$data['article_nav']['current_page'] = $page;
		
		$data['articles'] = $this->Article_model->getArticleByCat($cat_id, 'time', $this->articles_per_page, $this->articles_per_page * ($page-1));
		
		$data['num_sidebar_articles'] = $this->num_sidebar_articles;
		$data['sidebar_articles'] = $this->Article_model->getArticleByCat($cat_id, 'count', $this->num_sidebar_articles);
		
		$data['cat'] = $this->ArticleCat_model->getOneCategory($cat_id);
		
		$data_header['meta_title'] = $data['cat']['cat_name'];
		
		$this->load->view('header', $data_header);
		$this->load->view('articleCat', $data);
		$this->load->view('footer');
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */