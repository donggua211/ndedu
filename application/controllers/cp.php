<?php

class cp extends Controller {

	function cp()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->library('cp_score');
		
		$this->load->model('Article_model');
		$this->load->model('CP_Category_model');
		$this->load->model('CP_comment_model');
		$this->load->model('CP_ceping_model');
		
		$this->load->helper('common');
		$this->load->helper('cp');
	}
	
	function index()
	{
		/*
		$data['header']['meta_title'] = '尼德教育全方位测试系统';
		$data['footer']['js_file'] = 'cp.js';
		$data['main']['cat_list'] = $this->CP_Category_model->get_all_category();
		$data['main']['sidebar1'] = $this->Article_model->getArticleByCat(13, 'time', 6);
		$data['main']['sidebar2'] = $this->CP_comment_model->all_comments(array('status' => CP_COMMENT_STATUS_REVIEWED), 0, 6, 'comment.add_time', 'DESC');
		
		_load_cp_viewer('cp_index', $data, false, false, true);
		*/
		$this->detail(1);
	}
	
	function marquee()
	{
		$this->load->view('cp/cp_marquee.php');
	}
	
	function detail($cat_id = 1, $page = 1)
	{
		$cat_id = intval($cat_id);
		$cat_info = $this->CP_Category_model->get_one($cat_id);
		$page = intval($this->input->post('page')) > 0 ? intval($this->input->post('page')) : ( intval($page) > 0 ? intval($page) : 1 );
		
		if(empty($cat_info))
			$cat_info = $this->CP_Category_model->get_one(1);
		
		//Page Nav
		$filter = array('cat_id' => $cat_id, 'status' => CP_COMMENT_STATUS_REVIEWED);
		$total = $this->CP_comment_model->all_comments_count($filter);
		$page_nav = cp_page_nav($total, CP_COMMENTS_PER_CAT, $page);
		$comments =  $this->CP_comment_model->all_comments($filter , $page_nav['start'], CP_COMMENTS_PER_CAT, 'comment.add_time', 'DESC');
		
		$sidebar2 = array(
			array( 'title' => '高中应试豪华版', 'count' => 66),
			array( 'title' => '高考专业选择豪华版', 'count' => 50),
			array( 'title' => '高考状态豪华版', 'count' => 49),
			array( 'title' => '高考专业选择高级版', 'count' => 48),
			array( 'title' => '初中应试豪华版', 'count' => 30),
			array( 'title' => '小学生学习素养豪华版', 'count' => 28),
			array( 'title' => '小学生高级版', 'count' => 22),
		);
		
		$data['header']['meta_title'] = $cat_info['cat_name'].' - 尼德教育全方位测试系统';
		$data['header']['nav_menu_id'] = 8;
		$data['footer']['js_file'] = 'cp.js';
		$data['main']['cat_info'] = $cat_info;
		$data['main']['sidebar1'] = $this->Article_model->getArticleByCat(13, 'time', 6);
		$data['main']['sidebar2'] = $sidebar2;
		$data['main']['comments'] = $comments;
		$data['main']['page_nav'] = $page_nav;
		$data['footer']['js_file'] = 'cp.js';
		
		_load_cp_viewer('cp_detail', $data,  false, false, false, false, true);
	}
	
	function example()
	{
		$cat_id = 2;
		$card_info['cat_name'] = '中学生应试能力测评（初中）';
		$card_info['cat_id'] = $cat_id;
		$card_info['level'] = CP_LEVEL_LUXURY;
		$card_info['user_info']['name'] = '尼德教育';
		
		$result['result'] = '1,2,3,1,2,1,0,1,3,2,4,1,2,1,3,0,1,1,1,3,0,0,1,0,4,0,2,0,3,2;1,0,2,2,0,0,2,2,0,0,0,2,1,1,0,1;0,0,0,1,1,2,0,1,1,0,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1;1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1;1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1;0,0,0,0,0,0,0,0,0,0,1,1,1,1,1,1,1,1;0,0,0,1,0,1,1,0,1,0,1,0,0,2,2,2,2,2,1,2,2,1,2,2,2;1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1;1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0;0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0;0,0,0,0,0,0,0,0,0,0,0;0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0;0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0';
		
		$cp_list = $this->CP_ceping_model->get_all_by_cat($cat_id);
		
		//显示结果
		$answer_arr = explode(';', $result['result']);
		
		//载入测评
		$this->config->load('cp/'.$cat_id.'/result.php');
		
		/*载入豪华版说明
		if($this->card_info['level'] == CP_LEVEL_LUXURY)
			$this->config->load('cp/'.$cat_id.'/luxury_text.php');
		*/
		
		$data['meta_title'] = '报告样例 - 尼德全方位测评系统';
		$data['answer_arr'] = $answer_arr;
		$data['cp_list'] = $cp_list;
		$data['card_info'] = $card_info;
		$this->load->view('cp/result.php', $data);
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */