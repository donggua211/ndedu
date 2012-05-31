<?php

class Article extends Controller {

	function Article()
	{
		$this->article_separator = '#!PAGESEPARATOR!#';
		$this->special_cat = array(2, 3, 4, 5, 6, 18);
		$this->num_sidebar_articles = 11;
		$this->articles_per_page = 15;
		
		parent::Controller();		
		$this->load->helper('ip');
		$this->load->helper('string');
		$this->load->model('Article_model');
		$this->load->model('Stats_model');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index($article_id, $page = 1, $field_id = '')
	{
		if(!empty($field_id))
		{
			$click['field_id'] = $field_id;
			$click['ip'] = real_ip();
			$click['date'] = date('Y-m-d H:i:s');	
			$this->Stats_model->addClick($click);
		}
		$data['article'] = $this->Article_model->getOneArticle($article_id);
		
		if($data['article']['cat_id'] == 1)
		{
			$data_header['nav_menu_id'] = 1;
			$data['cat_url'] = 'news';
		}
		elseif($data['article']['cat_id'] == 2)
		{
			$data_header['nav_menu_id'] = 2;
			$data['cat_url'] = 'goldenLearningPlan';
		}	
		elseif($data['article']['cat_id'] == 3)
		{
			$data_header['nav_menu_id'] = 3;
			$data['cat_url'] = 'multiSubjectTutorial';
		}
		elseif($data['article']['cat_id'] == 4)
		{
			$data_header['nav_menu_id'] = 4;
			$data['cat_url'] = 'planEffect';
		}
		elseif($data['article']['cat_id'] == 5)
		{
			$data_header['nav_menu_id'] = 5;
			$data['cat_url'] = 'synBasis';
		}
		elseif($data['article']['cat_id'] == 6)
		{
			$data_header['nav_menu_id'] = 7;
			$data['cat_url'] = 'aboutUs';
		}
		elseif($data['article']['cat_id'] == 9)
		{
			$data_header['nav_menu_id'] = 1;
			$data['cat_url'] = 'school';
		}
		elseif($data['article']['cat_id'] == 18)
		{
			$data_header['nav_menu_id'] = 9;
			$data['cat_url'] = 'teacher';
		}
		else
		{
			$data_header['nav_menu_id'] = 1;
			$data['cat_url'] = 'articleCat/'.$data['article']['cat_id'];
		}
		
		if( empty( $data['article']['meta_title'] ) )
		{
			$data['article']['meta_title'] = $data['article']['title'] . ' - ' . $data['article']['cat_name'];
		}
		$data_header['meta_title'] = $data['article']['meta_title'];
		
		$this->load->view('header', $data_header);
		
		if(in_array($data['article']['cat_id'], $this->special_cat))
		{
			$this->load->view('article_special', $data);
		}
		else
		{
			$data['num_sidebar_articles'] = $this->num_sidebar_articles;
			$data['sidebar_articles'] = $this->Article_model->getArticleByCat($data['article']['cat_id'], 'count', $this->num_sidebar_articles);
			
			//Nav part
			$data['article']['content'] = str_replace( $this->article_separator, '', $data['article']['content'] );		
			$this->load->view('article', $data);
		}
		
		$this->load->view('footer');
	}
	
	function search($page = 1)
	{
		if(isset($_POST['keyword']) && !empty($_POST['keyword']))
		{
			$keyword = $this->input->myPost('keyword');
			
			$this->Article_model->addStats($keyword);
			
			$data['articles'] = $this->Article_model->searchArticle($keyword);
			$data['keyword'] = $keyword;
			
			$data['num_sidebar_articles'] = $this->num_sidebar_articles;
			$data['sidebar_articles'] = $this->Article_model->getArticleByCat(1, 'count', $this->num_sidebar_articles);
			
			$data['article_nav']['totle_articles'] =  count($data['articles']);
			$data['article_nav']['totle_page'] = ceil($data['article_nav']['totle_articles']/$this->articles_per_page);
			$data['article_nav']['articles_per_page'] = $this->articles_per_page;
						
			if($page > $data['article_nav']['totle_page'])
				$page = 1;

			$data['article_nav']['current_page'] = $page;
			
			$this->load->view('header');
			$this->load->view('search', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect("index.php");
		}
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */