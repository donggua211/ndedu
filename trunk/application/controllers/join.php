<?php

class join extends Controller {

	function join()
	{
		parent::Controller();
		
		$this->load->model('join_model');
		$this->load->model('CRM_Region_model');
		
		$this->load->helper('common');
	}
	
	function index()
	{
		$this->agreement();
	}
	
	//Step 1
	function agreement()
	{
		$data['header']['meta_title'] = '申请须知';
		$data['main']['current'] = 'agreement';
		$this->_load_join_view('agreement', $data);
	}
	
	//Step 2
	function personal()
	{
		//处理 agreement 的提交
		if(isset($_POST['next_action']) && ($_POST['next_action'] == 'personal'))
		{
			$this->_load_personal_view();
		}
		else
		{
			//没有提交操作, 重定向到agreement
			redirect('join/agreement');
			return false;
		}
	}
	
	//Step 3
	function survey()
	{
		//处理 personal 的提交
		if(isset($_POST['next_action']) && ($_POST['next_action'] == 'survey'))
		{
			$personal['name'] = trim($this->input->post('name'));
			$personal['gender'] = $this->input->post('gender');
			$personal['birthday'] = $this->input->post('birthday');
			$personal['province_id'] = $this->input->post('province_id');
			$personal['city_id'] = $this->input->post('city_id');
			$personal['postcode'] = trim($this->input->post('postcode'));
			$personal['address'] = trim($this->input->post('address'));
			$personal['duration'] = trim($this->input->post('duration'));
			$personal['family_phone'] = trim($this->input->post('family_phone'));
			$personal['work_phone'] = trim($this->input->post('work_phone'));
			$personal['mobile'] = trim($this->input->post('mobile'));
			$personal['email'] = trim($this->input->post('email'));
			$personal['available_time'] = trim($this->input->post('available_time'));
			$personal['provide_count'] = trim($this->input->post('provide_count'));
			$personal['provide_peaple'] = trim($this->input->post('provide_peaple'));
			$personal['join_provice'] = $this->input->post('join_provice');
			$personal['join_city'] = $this->input->post('join_city');
			
			//都是必填项.
			foreach($personal as $one)
			{
				if(empty($one))
				{
					$this->_load_personal_view($personal, '请填写完整的个人信息!');
					return false;
				}
			}		
			
			$join_id = $this->join_model->new_join($personal);
			
			//插入 join 表失败
			if(!$join_id)
			{
				$this->_load_personal_view($personal, '操作失败, 请重试!');
				return false;
			}
			
			//插入 join_detail 表失败
			if($this->join_model->new_join_detail($join_id, $personal))
			{
				$this->_load_survey_view($join_id);
			}
			else
			{
				$this->_load_personal_view($personal, '操作失败, 请重试!');
				return false;
			}
		}
		else
		{
			//没有提交操作, 重定向到agreement
			redirect('join/agreement');
			return false;
		}
	}
	
	//Step 4
	function cv()
	{
		//处理 survey 的提交
		if(isset($_POST['next_action']) && ($_POST['next_action'] == 'cv'))
		{
			$join_id = intval($this->input->post('join_id'));
			//判断 join id 是否合法
			$status = $this->check_join_id($join_id);
			if(!$status)
			{
				redirect('join/agreement');
				return false;
			}
			elseif( $status == JOIN_STATUS_SURVEY )
			{
				$this->_load_cv_view($join_id);
				return false;
			}
			
			$survey = $survey_other = array();
			for($i = 1; $i <= 20; $i++)
			{
				$survey[$i] = $this->input->post('q'.$i);
				if($this->input->post('q'.$i.'_othor'))
					$survey_other[$i] = $this->input->post('q'.$i.'_othor');
			}
			
			//插入 join_survey 表
			if($this->join_model->new_join_survey($join_id, $survey, $survey_other))
			{
				//更新 join 表 status
				$update_field = array('status' => JOIN_STATUS_SURVEY);
				$this->join_model->update($join_id, $update_field);
				
				$this->_load_cv_view($join_id);
			}
		}
		else
		{
			//没有提交操作, 重定向到agreement
			redirect('join/agreement');
			return false;
		}
	}
	
	//Step 5
	function finish()
	{
		//处理 cv 的提交
		if(isset($_POST['next_action']) && ($_POST['next_action'] == 'finish'))
		{
			$join_id = intval($this->input->post('join_id'));
			//判断 join id 是否合法
			$status = $this->check_join_id($join_id);
			if(!$status)
			{
				redirect('join/agreement');
				return false;
			}
			elseif( $status == JOIN_STATUS_FINISHED )
			{
				$this->_load_finish_view($join_id);
				return false;
			}
			
			$cv['cv_name'] = trim($this->input->post('cv_name'));
			$cv['cv_gendar'] = $this->input->post('cv_gendar');
			$cv['cv_birthday'] = $this->input->post('cv_birthday');
			$cv['home'] = trim($this->input->post('home'));
			$cv['political'] = trim($this->input->post('political'));
			$cv['marriage'] = $this->input->post('marriage');
			$cv['education_type'] = $this->input->post('education_type');
			$cv['situation'] = $this->input->post('situation');
			$cv['graduated_school'] = trim($this->input->post('graduated_school'));
			$cv['major'] = trim($this->input->post('major'));
			$cv['cv_mobile'] = trim($this->input->post('cv_mobile'));
			$cv['cv_email'] = trim($this->input->post('cv_email'));
			$cv['cv_address'] = trim($this->input->post('cv_address'));
			$cv['cv_postcode'] = trim($this->input->post('cv_postcode'));
			$cv['education_exp'] = trim($this->input->post('education_exp'));
			$cv['working_exp'] = trim($this->input->post('working_exp'));
			$cv['family_infor'] = trim($this->input->post('family_infor'));
			$cv['personal_intro'] = trim($this->input->post('personal_intro'));
			
			//都是必填项.
			foreach($cv as $one)
			{
				if(empty($one))
				{
					$this->_load_cv_view($join_id, array(), '请填写完整的个人信息!');
					return false;
				}
			}		
			
			//处理上传文件
			$cv['has_attachment'] = 0;
			$cv['attachment_name'] = '';
			if (isset($_FILES['upfile']))
			{
				//Upload file
				$config['upload_path'] = './upload/cv/';
				$config['allowed_types'] = 'word|doc|docx';
				$config['file_name']  = $join_id;
				$this->load->library('upload', $config);
				if ( $this->upload->do_upload('upfile'))
				{
					$upload_data = $this->upload->data();
					$cv['has_attachment'] = 1;
					$cv['attachment_name'] = $upload_data['file_name'];
				}
			}
			
			//插入 join_cv 表失败
			if($this->join_model->new_join_cv($join_id, $cv))
			{
				//更新 join 表 status
				$update_field = array('status' => JOIN_STATUS_FINISHED);
				$this->join_model->update($join_id, $update_field);
				
				$this->_load_finish_view($join_id);
			}
			else
			{
				$this->_load_cv_view($join_id, array(), '操作失败, 请重试!');
				return false;
			}
		}
		else
		{
			//没有提交操作, 重定向到agreement
			redirect('join/agreement');
			return false;
		}
	}
	
	function _load_personal_view($personal = array(), $notify = '')
	{
		$data['header']['meta_title'] = '个人信息';
		$data['footer']['js_file'][] = 'join.js';
		$data['footer']['js_file'][] = 'webcalendar.js';
		$data['footer']['js_file'][] = 'admin/region.js';
		$data['footer']['js_file'][] = 'admin/transport.js';
		$data['main']['current'] = 'personal';
		$data['main']['personal'] = $personal;
		$data['main']['provinces'] = $this->CRM_Region_model->get_regions();
		$data['main']['cities'] = (isset($personal['province_id']) && $personal['province_id'] > 0 ) ? $this->CRM_Region_model->get_regions(REGION_CITY, $personal['province_id']) : array();
		$data['main']['join_cities'] = (isset($personal['join_provice']) && $personal['join_provice'] > 0 ) ? $this->CRM_Region_model->get_regions(REGION_CITY, $personal['join_provice']) : array();
		$data['main']['districts'] = (isset($personal['city_id']) && $personal['city_id'] > 0 ) ? $this->CRM_Region_model->get_regions(REGION_DISTRICT, $personal['city_id']) : array();
		$data['main']['notification'] = $notify;
		
		$this->_load_join_view('personal', $data);
	}
	
	function _load_survey_view($join_id, $survey = array(), $notify = '')
	{
		$this->config->load('join/survey.php');
		
		$data['header']['meta_title'] = '个人信息';
		$data['footer']['js_file'] = 'join.js';
		$data['main']['current'] = 'survey';
		$data['main']['join_id'] = $join_id;
		$data['main']['survey'] = $survey;
		$data['main']['survey_info'] = $this->config->config['survey_info'];
		$data['main']['notification'] = $notify;
		
		$this->_load_join_view('survey', $data);
	}
	
	function _load_cv_view($join_id, $cv = array(), $notify = '')
	{
		$data['header']['meta_title'] = '个人简历';
		$data['footer']['js_file'][] = 'join.js';
		$data['footer']['js_file'][] = 'webcalendar.js';
		$data['main']['current'] = 'cv';
		$data['main']['join_id'] = $join_id;
		$data['main']['cv'] = $cv;
		$data['main']['notification'] = $notify;
		
		$this->_load_join_view('cv', $data);
	}
	
	function _load_finish_view($join_id, $notify = '')
	{
		$data['header']['meta_title'] = '申请完毕';
		$data['main']['current'] = 'finish';
		$data['main']['join_id'] = $join_id;
		$data['main']['notification'] = $notify;
		
		$this->_load_join_view('finish', $data);
	}
	
	function _load_join_view($template, $data = array())
	{
		$data['header']['meta_title'] = $data['header']['meta_title'].' - 加入尼德';
		$data['header']['no_header'] = 1;
		$data['footer']['no_baidu'] = 1;
		
		if(isset($data['header']['css_file']))
		{
			$data['header']['css_file'] = array($data['header']['css_file'], 'join.css');
		}
		else
		{
			$data['header']['css_file'] = 'join.css';
		}
		
		$template_arr = array('join/join_header', 'join/'.$template, 'join/join_footer');
		_load_viewer($template_arr, $data);
	}
	
	function check_join_id($join_id)
	{
		if(empty($join_id))
			return false;
		else
		{
			$join_info = $this->join_model->get_one_join($join_id);
			if(isset($join_info['status']))
				return $join_info['status'];
			else
				return false;
		}
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php*/