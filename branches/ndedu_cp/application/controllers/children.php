<?php

class children extends Controller {

	function children()
	{
		parent::Controller();
		
		$this->load->model('Article_model');
		
		$this->load->helper('common');
		$this->load->helper('string');
	}

	function index()
	{
		$data['header']['meta_title'] = '首页 - 尼德早教';
		$data['main']['news'] = $this->Article_model->getArticleByCat(1, 'time', 6);
		$data['main']['advantage'] = $this->Article_model->getArticleByCat(15, 'article_id', 6);
		
		$this->_load_children_view('cd_index', $data);
	}
	
	function advantage()
	{
		$this->article(613);
	}
	
	function parrent()
	{
		$article_info = $this->Article_model->getOneArticle(612);
		$data['main']['single'] = true;
		$this->_article($article_info, $data);
	}
	
	function course()
	{
		$this->article(618);
	}
	
	function aboutus()
	{
		$article_info['title'] = '关于我们';
		$article_info['content'] = $this->load->view('children/aboutus.php', array(), true);
		$data['main']['single'] = true;
		$data['header']['load_google_map'] = TRUE;
		
		$this->_article($article_info, $data);
	}
	
	function article($article_id)
	{
		$article_info = $this->Article_model->getOneArticle($article_id);
		
		$sidebar_articles = $this->Article_model->getArticleByCat($article_info['cat_id'], 'article_id', 6);
		
		foreach($sidebar_articles as $key => $val)
		{
			$data['main']['left_bar'][$key]['text'] = $val['title'];
			$data['main']['left_bar'][$key]['url'] = 'children/article/'.$val['article_id'];
		}
		$this->_article($article_info, $data);
	}
	
	function _article($article_info, $data = array())
	{
		$data['header']['meta_title'] = $article_info['title'].' - 尼德早教';
		$data['main']['article_info'] = $article_info;
		$this->_load_children_view('cd_article', $data);
	
	}
	
	function _load_children_view($template, $data = array())
	{
		$data['header']['no_header'] = 1;
		$data['footer']['no_footer'] = 1;
		$data['header']['css_file'] = 'children.css';
				
		$template_arr = array('children/cd_header', 'children/'.$template, 'children/cd_footer');
				
		_load_viewer($template_arr, $data);
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */