<?php

class Test extends Controller {

	function Test()
	{
		set_time_limit(0);
		parent::Controller();
		$this->load->model('Article_model');
		$this->load->model('ArticleCat_model');
		$this->load->model('Dangdang_model');
		$this->load->model('Tags_model');
		$this->load->model('Test_model');
	}
	
	function index($time = 1)
	{
		
		$this->benchmark->mark('old_sql_start');
		for($i = 0; $i < $time; $i++)
			$this->Test_model->getArticleByCatTag(9, '1-2');
			
		$this->benchmark->mark('old_sql_end');
		$this->benchmark->mark('new_sql_start');
		for($i = 0; $i < $time; $i++)
			$this->Test_model->getArticleByCatTag2(9, '1-2');
		$this->benchmark->mark('new_sql_end');
		
		echo 'old_sql_start : '.$this->benchmark->elapsed_time('old_sql_start', 'old_sql_end');
		echo '<br/>';
		echo 'new_sql_start : '.$this->benchmark->elapsed_time('new_sql_start', 'new_sql_end');
	}
	
	function benchAddArticle($index_start=0)
	{
		for($i = 0; $i < 1000; $i++)
		{
			$this->addArticle(($index_start+$i));
		}
	}
	
	function addArticle($index)
	{
		$new_article['title'] = '测试文章'.$index;
		$new_article['catagory'] = '9';
		$new_article['content'] = '测试文章';
		$new_article['keywords'] = '测试文章';
		$new_article['short_description'] = '';
		$new_article['short_description_img'] = '';
		$new_article['image_align'] = '';
		

		$new_article['add_time'] = time();
		$new_article['is_open'] = '1';
		$new_article['image_url'] = '';
		$new_article['image_align'] = '';
		
		
		$article_id = $this->Article_model->addArticle($new_article);
		if($article_id != FALSE)
		{
			$count = rand(1, 3);
			$range = range(5, 14);
			$cat_id = array_rand($range, $count);

			foreach((array)$cat_id as $value)
				$cat[] = $range[$value];

			$class = array(rand(1, 4));
			$tags = array_merge($class, $cat);
			$this->Tags_model->addArtileTag($article_id, $tags);
			$data['notification'] = 'category_successful';
		}
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */