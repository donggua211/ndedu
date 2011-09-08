<?php

class ceping extends Controller {

	function ceping()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->library('cp_score');
		
		$this->load->model('CRM_Region_model');
		$this->load->model('CRM_Grade_model');
		$this->load->model('CP_card_model');
		$this->load->model('CP_ceping_model');
		
		$this->load->helper('common');
		$this->load->helper('cp');
		
		$this->card_id = _getauthcookie('card_id');
		//如果没有经登录, 就跳转到admin/login登陆页
		if(!$this->card_id)
		{
			goto_login();
		}
		
		//初始化
		$this->_initialize();
	}
	
	function _initialize()
	{
		$this->card_info = $this->CP_card_model->get_one_card($this->card_id);
		//如果用户已经同意. 跳转至
		if($this->card_info['status'] == CP_CARD_STATUS_UNUSED && $this->uri->rsegment(2) != 'agreement')
		{
			redirect('ceping/agreement');
		}
		elseif($this->card_info['status'] == CP_CARD_STATUS_AGREED && $this->uri->rsegment(2) != 'userinfo')
		{
			redirect('ceping/userinfo');
		}
		elseif($this->card_info['status'] == CP_CARD_STATUS_STARTED && $this->uri->rsegment(2) != 'cp')
		{
			redirect('ceping/cp');
		}
		elseif($this->card_info['status'] == CP_CARD_STATUS_FINISHED && !($this->uri->rsegment(2) == 'finished' || $this->uri->rsegment(2) == 'result' || $this->uri->rsegment(2) == 'result2'))
		{
			redirect('ceping/finished');
		}
	}
	
	function index()
	{
		
	}
	
	function agreement()
	{
		//处理同意
		if(isset($_POST) && count($_POST) > 0)
		{
			$date['status'] = CP_CARD_STATUS_AGREED;
			if(!$this->CP_card_model->update($this->card_id, $date))
			{
				$data['main']['notification'] = '对不起, 由于网络原因, 请您再试一次!';
			}
			else
			{
				//成功
				redirect('ceping/userinfo');
			}
		}
		
		$cp_count_array = array(
			1 => array( 'title' => 16, 'question' => 416 ),
			2 => array( 'title' => 13, 'question' => 413 ),
			3 => array( 'title' => 13, 'question' => 413 ),
			4 => array( 'title' => 7, 'question' => 47 ),
			5 => array( 'title' => 4, 'question' => 44 ),
		);
		
		$data['header']['meta_title'] = '条约 - 尼德全方位测评系统';
		$data['footer']['no_baidu'] = 1;
		$data['main']['total_title'] = $cp_count_array[$this->card_info['cat_id']]['title'];
		$data['main']['total_question'] = $cp_count_array[$this->card_info['cat_id']]['question'];
		_load_cp_viewer('agreement', $data, false);
	}
	
	function userinfo()
	{
		//处理提交
		if(isset($_POST) && count($_POST) > 0)
		{
			//必填信息.
			$userinfo['name'] = $this->input->post('name');
			$userinfo['phone'] = $this->input->post('phone');
			$userinfo['email'] = $this->input->post('email');
			$userinfo['school'] = $this->input->post('school');
			
			//数字的必填信息
			$userinfo['grade_id'] = $this->input->post('grade_id');
			$userinfo['province_id'] = $this->input->post('province_id');
			$userinfo['city_id'] = $this->input->post('city_id');
			$userinfo['district_id'] = $this->input->post('district_id');
			
			if(empty($userinfo['name']) || empty($userinfo['phone']) || empty($userinfo['email']) || empty($userinfo['school']) || empty($userinfo['grade_id']) || empty($userinfo['province_id']) || empty($userinfo['city_id']) || empty($userinfo['district_id']))
			{
				$notify = '请填写完整的信息';
				$this->_load_userinfo_view($notify, $userinfo);
			}
			else
			{
				$userinfo['card_id'] = $this->card_id;
				$date['status'] = CP_CARD_STATUS_STARTED;
				$date['start_time'] = date('Y-m-d H:i:s');
				//add into DB
				if($this->CP_card_model->add_userinfo($userinfo) && $this->CP_card_model->update($this->card_id, $date))
				{
					//成功
					redirect('ceping/cp');
				}
				else
				{
					$notify = '由于网络原因, 添加失败, 请您再试一次.';
					$this->_load_userinfo_view($notify, $userinfo);
				}
			}
		}
		else
		{
			$this->_load_userinfo_view();
		}
	}
	
	function cp()
	{
		//处理上回的结果.
		$pre_answer = $this->input->post('answer') ? $this->input->post('answer') : array();
		$pre_answer = $pre_answer ? implode(',', $pre_answer) : '';
		$answer_arr = $this->input->post('answer_arr') ? $this->input->post('answer_arr') : '';
		$answer_arr = $answer_arr ? explode(';', $answer_arr) : array();
		if(!empty($pre_answer))
			$answer_arr[] = $pre_answer;
		$answer_arr = implode(';', $answer_arr);
		
		//获取测评列表
		$cp_list = $this->CP_ceping_model->get_all_by_cat($this->card_info['cat_id']);
		//n当前测评的index, 从0开始
		$current_cp_index = $this->input->post('cp_index') === false ? 0 : $this->input->post('cp_index') + 1;
			
		//如果是最后一个测评, 添加到数据库, 跳转到result页
		if($current_cp_index >= count($cp_list))
		{
			//添加记录, 更新status
			$date['status'] = CP_CARD_STATUS_FINISHED;
			$date['finished_time'] = date('Y-m-d H:i:s');
			if($this->card_info['status'] != CP_CARD_STATUS_FINISHED && $this->CP_ceping_model->add_result($this->card_id, $answer_arr) && $this->CP_card_model->update($this->card_id, $date))
			{
				redirect('ceping/finished');
			}
			else
			{
				$data['main']['notification'] = '对不起, 由于网络原因, 提交失败, 请重试.';
				$current_cp_index--;
			}
			return false;
		}
		
		//当前测评的基本信息
		$current_cp_info =  $cp_list[$current_cp_index];
		//载入测评
		$this->config->load('cp/'.$this->card_info['cat_id'].'/ceping'.$current_cp_index.'.php');
				
		$data['header']['meta_title'] = $current_cp_info['cp_name'].' - '.$this->card_info['cat_name'].' - 尼德全方位测评系统';
		$data['footer']['js_file'] = 'cp.js';
		$data['footer']['no_baidu'] = 1;
		$data['main']['cp_info'] = $this->config->config['cp_info'];
		$data['main']['current_cp_info'] = $current_cp_info;
		$data['main']['cat_name'] = $this->card_info['cat_name'];
		$data['main']['answer_arr'] = $answer_arr;
		$data['main']['current_cp_index'] = $current_cp_index;
		$data['main']['count_cp'] = count($cp_list);
		_load_cp_viewer ('ceping', $data, false, true, false, true);
		
	}
	
	function finished()
	{
		$data['header']['meta_title'] = '测评完成 - 尼德全方位测评系统';
		$data['footer']['no_baidu'] = 1;
		$data['main']['cat_name'] = $this->card_info['cat_name'];
		_load_cp_viewer('ceping_finish', $data, false);
	}
	
	function result()
	{
		$cp_list = $this->CP_ceping_model->get_all_by_cat($this->card_info['cat_id']);
		
		//显示结果
		$result = $this->CP_ceping_model->get_result($this->card_id);
		$answer_arr = explode(';', $result['result']);
		
		//载入测评
		$this->config->load('cp/'.$this->card_info['cat_id'].'/result.php');
		
		//载入豪华版说明
		if($this->card_info['level'] == CP_LEVEL_LUXURY)
			$this->config->load('cp/'.$this->card_info['cat_id'].'/luxury_text.php');
		
		$data['meta_title'] = '测评结果 - 尼德全方位测评系统';
		$data['answer_arr'] = $answer_arr;
		$data['cp_list'] = $cp_list;
		$data['card_info'] = $this->CP_card_model->get_one_card_detailed($this->card_id);
		$this->load->view('cp/result.php', $data);
	}
	
	function result2()
	{
		$cp_list = $this->CP_ceping_model->get_all_by_cat($this->card_info['cat_id']);
		
		//显示结果
		$result = $this->CP_ceping_model->get_result($this->card_id);
		$answer_arr = explode(';', $result['result']);
		
		header("Content-type: text/html; charset=utf-8");
		
		//载入测评
		foreach($cp_list as $key => $cp)
		{
			//答案
			$this_ansr_arr = explode(',', $answer_arr[$key]);
			
			$this->config->load('cp/'.$this->card_info['cat_id'].'/ceping'.$key.'.php');
			$cp_info = $this->config->config['cp_info'];
			
			echo '<h1>'.$cp['cp_name'].'</h1>';
			echo '<ol>';
			foreach($cp_info['questions'] as $index => $qst)
			{
				echo '<li>';
				if($cp_info['same_answer'] == 1)
				{
					echo $qst.'<br/>';
					echo '答案： '.$cp_info['answers'][$this_ansr_arr[$index]].'<br/>'.'<br/>';
				}
				else
				{
					echo $qst['name'].'<br/>';
					echo '答案： '.$qst['answers'][$this_ansr_arr[$index]].'<br/>'.'<br/>';
				}
				echo '</li>';
			}
			echo '</ol>';
		}
	}
	
	function _load_userinfo_view($notify = '', $userinfo = array())
	{
		$data['header']['meta_title'] = '条约 - 尼德全方位测评系统';
		$data['footer']['no_baidu'] = 1;
		$data['footer']['js_file'][] = 'cp.js';
		$data['footer']['js_file'][] = 'admin/region.js';
		$data['footer']['js_file'][] = 'admin/transport.js';
		$data['main']['provinces'] = $this->CRM_Region_model->get_regions();
		$data['main']['grades'] = $this->CRM_Grade_model->get_grades(GRADE_CHILDREN);
		$data['main']['notification'] = $notify;
		$data['main']['userinfo'] = $userinfo;
		_load_cp_viewer('userinfo', $data, false);
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */