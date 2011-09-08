<?php

class School extends Controller {

	function School()
	{
		$this->top_right_tags = array(1,2,3,4);
		
		$this->num_sidebar_articles = 7;
		$this->num_sidebar_recommand = 6;
		$this->articles_per_page = 18;
		$this->dangdang_per_page = 15;
		parent::Controller();
		$this->load->helper('string');
		$this->load->model('Article_model');
		$this->load->model('ArticleCat_model');
		$this->load->model('Dangdang_model');
		$this->load->model('Tags_model');
		
		//$this->output->enable_profiler(TRUE);
	}
	
	function article($cat_id, $tags = '0-0', $page = 1)
	{
		if( !$this->avaliableTag( $tags ) )
			$tags = '0-0';
		
		list($left_tag, $right_tag) = explode('-', $tags);
		
		//获取置顶文章
		$data['num_sidebar_recommand'] = $this->num_sidebar_recommand;
		$data['recommand'] = $this->Article_model->getRecommandArticle($cat_id, $this->num_sidebar_recommand);
		//获取侧边按点击排序的文章.
		$data['num_sidebar_articles'] = $this->num_sidebar_articles;
		$data['sidebar_articles'] = $this->Article_model->getArticleByCatTag($cat_id, $tags, 'count', $this->num_sidebar_articles);
		
		//获取分页信息
		$recommand_num = count($data['recommand']);
		$data['article_nav']['totle_articles'] =  $this->Article_model->getTotleArticleNumByCatTag($cat_id,$tags);
		$data['article_nav']['totle_page'] = ceil(($data['article_nav']['totle_articles']+$recommand_num)/$this->articles_per_page);
		$data['article_nav']['articles_per_page'] = $this->articles_per_page;	
		if($page > $data['article_nav']['totle_page'])
			$page = 1;
		$data['article_nav']['current_page'] = $page;
		
		
		$star = $this->articles_per_page * ($page-1);
		if($star>0)
			$star -= $recommand_num;
		$limit = ($page == 1) ? ($this->articles_per_page - $recommand_num ): $this->articles_per_page;
		$data['article_nav']['star'] = $star;
		$data['article_nav']['limit'] = $limit;
		$data['articles'] = $this->Article_model->getArticleByCatTag($cat_id, $tags, 'time', $limit, $star);
				
		$data['cat'] = $this->ArticleCat_model->getOneCategory($cat_id);
		
		$data['tags'] = $this->Tags_model->getAllTags();
		$data['tag_article_num'] = $this->Tags_model->getNumByTags($cat_id, 'article');
		$data['top_right_tags'] = $this->top_right_tags;
		$data['left_tag'] = $left_tag;
		$data['right_tag'] = $right_tag;
		$data_header['meta_title'] = '教育文章 - 尼德学堂';
		$data_header['nav_menu_id'] = 6;
		
		$this->load->view('header', $data_header);
		$this->load->view('school/education', $data);
		$this->load->view('footer');
	}
	
	function dangdang($cat_id, $tags = '0-0', $page = 1)
	{
		if( !$this->avaliableTag( $tags ) )
			$tags = '0-0';
		
		list($left_tag, $right_tag) = explode('-', $tags);
		
		//获取置顶文章
		$data['num_sidebar_recommand'] = $this->num_sidebar_recommand;
		$data['recommand'] = $this->Dangdang_model->getRecommandDangdang($cat_id, $this->num_sidebar_recommand);
		//获取侧边按点击排序的文章.
		$data['num_sidebar_articles'] = $this->num_sidebar_articles;
		$data['sidebar_articles'] = $this->Dangdang_model->getDangdangByCatTag($cat_id, $tags, 'count', $this->num_sidebar_articles);
		
		//获取分页信息
		$recommand_num = count($data['recommand']);
		$data['article_nav']['totle_articles'] =  $this->Dangdang_model->getTotleDangdangNumByCat($cat_id,$tags);
		$data['article_nav']['totle_page'] = ceil(($data['article_nav']['totle_articles']+$recommand_num)/$this->dangdang_per_page);
		$data['article_nav']['dangdang_per_page'] = $this->dangdang_per_page;	
		if($page > $data['article_nav']['totle_page'])
			$page = 1;		
		$data['article_nav']['current_page'] = $page;

		$star = $this->dangdang_per_page * ($page-1);
		if($star>0)
			$star -= $recommand_num;
		$limit = ($page == 1) ? ($this->dangdang_per_page - $recommand_num ): $this->dangdang_per_page;
		$data['article_nav']['star'] = $star;
		$data['article_nav']['limit'] = $limit;
		$data['articles'] = $this->Dangdang_model->getDangdangByCatTag($cat_id, $tags, 'time', $limit, $star);

		
		
		$data['tags'] = $this->Tags_model->getAllTags();
		$data['tag_article_num'] = $this->Tags_model->getNumByTags($cat_id, 'dangdang');
		$data['top_right_tags'] = $this->top_right_tags;
		$data['left_tag'] = $left_tag;
		$data['right_tag'] = $right_tag;
		
		switch($cat_id)
		{
			case 10:
				$data['type'] = 'book';
				$data_header['meta_title'] = '精品图书 - 尼德学堂';
				break;
			case 11:
				$data['type'] = 'vedio';
				$data_header['meta_title'] = '教育影视 - 尼德学堂';
				break;
			case 12:
				$data['type'] = 'software';
				$data_header['meta_title'] = '教育软件 - 尼德学堂';
				break;
		}
		$data_header['nav_menu_id'] = 6;
		$data['cat_id'] = $cat_id;
		
		$this->load->view('header', $data_header);
		$this->load->view('school/dangdang', $data);
		$this->load->view('footer');
	}
	
	function avaliableTag($tags){
		return ( preg_match( "/^\d{1,2}-\d{1,2}$/", $tags ) === 1 ) ? TRUE : FALSE;
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */