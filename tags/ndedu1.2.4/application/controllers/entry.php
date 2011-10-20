<?php

class Entry extends Controller {

	function Entry()
	{
		parent::Controller();
		$this->load->helper('string');
		$this->load->model('Article_model');
		$this->load->model('Dangdang_model');
	}
	
	function index()
	{
		//尼德新闻
		$data['news_num'] = 6;
		$data['news'] = $this->Article_model->getArticleByCat(1, 'time', $data['news_num']);
		$data['news_file_id'] = array(
		);
		
		//尼德学堂文章
		$data['school_articles_num'] = 12;
		$data['school_articles'] = $this->Article_model->getArticleByCat(9, 'time', $data['school_articles_num']);
		
		//精品图书
		$data['school_dangdang_num'] = 6;
		$data['school_book'] = $this->Dangdang_model->getRecommandDangdang('10', $data['school_dangdang_num']);
		$data['school_vedio'] = $this->Dangdang_model->getRecommandDangdang('11', $data['school_dangdang_num']);
		$data['school_software'] = $this->Dangdang_model->getRecommandDangdang('12', $data['school_dangdang_num']);
		
		$this->load->view('header');
		$this->load->view('index', $data);
		$this->load->view('footer');
	}
	
	function oo1()
	{
		$data_header['css_file'] = 'promo0901.css';
		$data_header['meta_title'] = '尼德教育九大理由保障成绩提高，成功规划学业，成就完美人生！';
		$data_header['no_header'] = TRUE;
		$this->load->view('header', $data_header);
		$this->load->view('promo0901');
		$this->load->view('footer');
	}
	
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */