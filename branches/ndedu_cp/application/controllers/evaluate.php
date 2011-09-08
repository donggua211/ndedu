<?php

class Evaluate extends Controller {

	function Evaluate()
	{
		parent::Controller();
		
		//检查登陆
		$this->load->library('session');
		$this->user_id = $this->session->userdata("user_id");
		if (!($this->user_id>0))
		{
			redirect("user/login/evaluate-index");
		}
		
		$this->load->model('Evaluate_model');
		$this->load->model('User_model');
		//获取用户信息
		$this->user_info = $this->User_model->getUserInfo($this->user_id);
	}
	
	function index()
	{
		$data['evaluates'] = $this->Evaluate_model->getAllEvaluate();
		$data['evaluate_cat'] = $this->Evaluate_model->getAllEvaluateCat();
		
		$data_header['meta_title'] = '尼德测评';
		$data_header['no_header'] = true;
		$data['user_info'] = $this->user_info;
		$this->load->view('header', $data_header);
		$this->load->view('evaluate/evaluate_header');
		$this->load->view('evaluate/evaluate_index', $data);
		$this->load->view('footer');
	}
	
	function doEvaluate($evaluate_id)
	{
		if(!file_exists(APPPATH.'config/evaluate/'.$evaluate_id.'.php'))
		{
			$data['error']= '对不起, 您访问的测评不存在. <a href="'.site_url('evaluate').'">返回</a>';
		}
		else
		{
			$this->config->load('evaluate/'.$evaluate_id);
			$data['evaluate_data'] =  $this->config->config['evaluate_data'];

			//判断是否需要VIP
			if($data['evaluate_data']['is_vip'] && !$this->user_info['is_vip'])
			{
				$data['error']= '对不起, 本测试只对VIP用户开放. <a href="'.site_url('evaluate').'">返回</a>';
			}
		}
			
		$data['begin_time'] = date('Y-m-d H:m:s');
		$data['evaluate'] = $this->Evaluate_model->getOneEvaluate($evaluate_id);
			
		$data_header['meta_title'] = $data['evaluate']['name'].' - 尼德测评';
		$data_header['no_header'] = true;
		
		$data_footer['no_baidu'] = true;
		
		$data['user_info'] = $this->user_info;
		$this->load->view('header', $data_header);
		$this->load->view('evaluate/evaluate_header');
		$this->load->view('evaluate/evaluate', $data);
		$this->load->view('footer', $data_footer);
	
	}
	
	function result()
	{
		if(empty($_POST))
		{
			$data['error']= '对不起, 您还未提交答案. <a href="'.site_url('evaluate').'">开始做题</a>';
		}
		else
		{
			//获取POST数据.
			$result['evaluate_id'] = $this->input->post('evaluate_id');
			$result['begin_time'] = $this->input->post('begin_time');
			$result['answer'] = $this->input->post('question');
			
			//获取测评数据
			if(!file_exists(APPPATH.'config/evaluate/'.$result['evaluate_id'].'.php'))
			{
				$data['error']= '对不起, 您访问的测评不存在. <a href="'.site_url('evaluate').'">返回</a>';
			}
			else
			{
				$this->config->load('evaluate/'.$result['evaluate_id']);
				$data['evaluate_data'] =  $this->config->config['evaluate_data'];
			}
			$data['evaluate'] = $this->Evaluate_model->getOneEvaluate($result['evaluate_id']);
			$data['answer'] = $result['answer'];
			$data['begin_time'] = $result['begin_time'];
			$data['end_time'] = date('Y-m-d H:m:s');
			
			//计算用户得分
			if(isset($data['evaluate_data']['has_score']) && $data['evaluate_data']['has_score'])
			{
				$fanal_score = 0;
				foreach( $data['answer'] as $key => $answer ) {
					//如果是答对就得分模式：
					if(isset($data['evaluate_data']['questions'][$key]['score']) && !empty($data['evaluate_data']['questions'][$key]['score']))
					{
						$correct = explode(',', $data['evaluate_data']['questions'][$key]['correct']);
						//如果本题有大于一个答案。
						if(count($answer) > 1)
						{
							$temp = array_intersect($answer, $correct);
							$fanal_score += ceil((count($temp)/count($correct)) * $data['evaluate_data']['questions'][$key]['score']);
						}
						else
						{
							if(in_array($answer[0], $correct))
								$fanal_score += $data['evaluate_data']['questions'][$key]['score'];
						}
					}
					else
					{
						if(isset($data['evaluate_data']['questions'][$key]['options'][$answer[0]]['score']))
							$fanal_score += $data['evaluate_data']['questions'][$key]['options'][$answer[0]]['score'];					
					}
				}
				$data['fanal_score'] = $fanal_score;
			}

			//将用户答案存入数据库
			$answer['evaluate_id'] = $result['evaluate_id'];
			$answer['user_id'] = $this->user_id;
			$answer['answer'] = serialize($result['answer']);
			$answer['begin_time'] = $data['begin_time'];
			$answer['end_time'] = $data['end_time'];
			$this->Evaluate_model->addEvaluateResult($answer);
		}
		$data_header['meta_title'] = $data['evaluate']['name'].' - 尼德测评';
		$data_header['no_header'] = true;
		$data['user_info'] = $this->user_info;
		$this->load->view('header', $data_header);
		$this->load->view('evaluate/evaluate_header');
		$this->load->view('evaluate/evaluate_result', $data);
		$this->load->view('footer');
	}
	
	function my()
	{
		$data['evaluate_list'] = $this->Evaluate_model->getMyEvaluatelist($this->user_id);
		
		$data_header['meta_title'] = '我的测评 - 尼德测评';
		$data_header['no_header'] = true;
		$data['user_info'] = $this->user_info;
		$this->load->view('header', $data_header);
		$this->load->view('evaluate/evaluate_header');
		$this->load->view('evaluate/evaluate_my_list', $data);
		$this->load->view('footer');
	}
	
	function myEvaluate($result_id)
	{
		$evaluate = $this->Evaluate_model->getMyEvaluate($result_id);
			
		//获取测评数据
		if(!file_exists(APPPATH.'config/evaluate/'.$evaluate['evaluate_id'].'.php'))
		{
			$data['error']= '对不起, 您访问的测评不存在. <a href="'.site_url('evaluate').'">返回</a>';
		}
		else
		{
			$this->config->load('evaluate/'.$evaluate['evaluate_id']);
			$data['evaluate_data'] =  $this->config->config['evaluate_data'];
		
			$data['evaluate'] = $evaluate;
			$data['answer'] = unserialize($evaluate['answer']);
			$data['begin_time'] = $evaluate['begin_time'];
			$data['end_time'] = $evaluate['end_time'];
			$data['my_evaluate'] = true;
		}
		$data_header['meta_title'] = $evaluate['name'].' - 尼德测评';
		$data_header['no_header'] = true;
		$data['user_info'] = $this->user_info;
		$this->load->view('header', $data_header);
		$this->load->view('evaluate/evaluate_header');
		$this->load->view('evaluate/evaluate_result', $data);
		$this->load->view('footer');
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */