<?php
/* 
  测评管理
  admin权限.
 */
class cp_card extends Controller {

	function cp_card()
	{
		parent::Controller();
		$this->load->library('session');
		
		$this->load->model('CP_card_model');
		$this->load->model('CP_category_model');
		
		$this->load->helper('admin');
		$this->load->helper('cp');
			
		//如果没有经登录, 就跳转到admin/login登陆页
		if (!has_login())
		{
			goto_login();
		}
		
		$this->staff_info = get_staff_info();
		//检查权限.
		if(!check_role(array(GROUP_ADMIN), $this->staff_info['group_id']))
		{
			show_access_deny_page();
		}
		
		//$this->output->enable_profiler(TRUE);
	}
	
	function index($filter_string = '')
	{
		//默认值
		$filter['page'] = 1;
		$filter['cat_id'] = $this->input->post('cat_id');
		$filter['level'] = $this->input->post('level');
		$filter['status'] = $this->input->post('status');
			
		$filter = $this->_parse_filter($filter_string, $filter);
				
		//Page Nav
		$total = $this->CP_card_model->getAll_count($filter);
		$page_nav = page_nav($total, CP_CARD_PER_PAGE, $filter['page']);
		$page_nav['base_url'] = 'admin/cp_card/index';
		$page_nav['filter'] = $filter;
		$data['main']['page_nav'] = $this->load->view('admin/common_page_nav', $page_nav, true);
		
		$cards = $this->CP_card_model->getAll($filter, $page_nav['start'], CP_CARD_PER_PAGE, 'card.cat_id, card.status');
		
		$data['header']['meta_title'] = '查看密码卡 - 测评系统管理';
		$data['main']['category'] = $this->CP_category_model->get_all_category();
		$data['main']['filter'] = $filter;
		$data['main']['cards'] = $cards;
		_load_viewer($this->staff_info['group_id'], 'cp_card_all', $data);
	}
	
	function one($card_id)
	{
		//判断cart_id是否合法. card_id 需要转换成浮点数
		$card_id = floatval($card_id);
		if($card_id <= 0)
		{
			show_error_page('您输入的测评卡ID不合法, 请返回重试.', 'admin/cp_card');
			return false;
		}
		
		//获取 card 信息.
		$card_info = $this->CP_card_model->get_one_card_detailed($card_id);
		
		//检查权限
		if(empty($card_info))
		{
			show_error_page('您所查询的测评卡不存在!', 'admin/cp_card');
			return false;
		}
		
		$data['header']['meta_title'] = $card_id . ' - 密码卡详情 - 测评系统管理';
		$data['main']['card_info'] = $card_info;
		_load_viewer($this->staff_info['group_id'], 'cp_card_one', $data);
	}
	
	function generate()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$generate['confirm_add'] = $this->input->post('confirm_add');
			$generate['cat_id'] = (array)$this->input->post('cat_id');
			$generate['level'] = (array)$this->input->post('level');
			$generate['batch'] = intval($this->input->post('batch'));
			$generate['number'] = intval($this->input->post('number'));
			
			if(empty($generate['cat_id']) || empty($generate['level']) || empty($generate['batch']) || empty($generate['number']))
			{
				$notify = '请填写完整信息!';
				$this->_load_generate_view($notify, $generate);
			}
			elseif( count($generate['cat_id']) * count($generate['level']) * $generate['number'] > CP_GEN_CARD_MAX) //判断是否生长张数大于要求
			{
				$notify = '张数大于'.CP_GEN_CARD_MAX.'张! 请重新选择!';
				$this->_load_generate_view($notify, $generate);
			}
			elseif(strlen($generate['batch']) != 4) //检查批次号的位数, 必须为4位数.
			{
				$notify = '批次号必须为4位! 请重新选择!';
				$this->_load_generate_view($notify, $generate);
			}
			else
			{
				//获取批次号, 冲击力批次号.
				$batch_info = $this->CP_card_model->get_batch_info($generate['batch']);
				
				if(!empty($batch_info) && !$generate['confirm_add']) //如果批号已经存在, 就提示确认.
				{
					//显示批次号.
					$notify = '您输入的批号已重复, 以下是该批号信息, 请点击确定以继续, 返回以';
					$this->_load_batch_duplicate_confirm_view($notify, $batch_info, $generate);
					return false;
				}
				
				// 如果为空的话, 自动生成一个.
				if(empty($batch_info))
				{
					$batch_info['batch_id'] = $generate['batch'];
					$batch_info['last_sn'] = 10001;
				}
				
				$cards = array();
				foreach($generate['level'] as $one_level)
				{
					foreach($generate['cat_id'] as $one_cat_id)
					{
						for($i = 0; $i < $generate['number']; $i++)
						{
							$card_id = $one_level.$batch_info['batch_id'].str_pad($batch_info['last_sn'], 5, '0', STR_PAD_LEFT);
							$cards[$card_id]['card_id'] = $card_id;
							$cards[$card_id]['cat_id'] = $one_cat_id;
							$cards[$card_id]['level'] = $one_level;
							$cards[$card_id]['password'] = $this->_gen_password();
							
							//控制字段.
							$batch_info['last_sn']++;
						}
					}
				}
				//验证本批 card ids 是否有重复的.
				$exist_card_id = $this->CP_card_model->check_card_ids_exist(array_keys($cards));
				if($exist_card_id)
				{
					foreach($exist_card_id as $card_id)
					{
						unset($cards[$card_id]);
					}
				}
				
				//插入数据库: card 表
				if($this->CP_card_model->add_cards($cards))
				{
					echo "<h1>card成功</h1>\n";
					echo "<table>";
					foreach($cards as $card)
					{
						echo "<tr>";
						echo "<td>".$card['card_id'].'</td><td>'.$card['password'].'</td>';
						echo "</tr>";
					}
					echo "</table>";
				}
				
				//更新数据库: card_batch 表
				if($this->CP_card_model->update_batch($batch_info))
				{
					echo "<h1>card batch成功</h1>\n";
					print_r($batch_info);
				}
			}
		}
		else
		{
			$this->_load_generate_view();
		}
	}
	
	function status($filter_string = '')
	{
		//默认值
		$filter['add_time_a'] = $this->input->post('add_time_a');
		$filter['add_time_b'] = $this->input->post('add_time_b');
			
		$filter = $this->_parse_filter($filter_string, $filter);
				
		//分析结果
		$status = array();
		$rows = $this->CP_card_model->get_status($filter);
		foreach($rows as $row)
		{
			$status[$row['cat_id'].$row['level']]['cat_name'] = $row['cat_name'].'-'.get_cp_level_text($row['level']);
			$status[$row['cat_id'].$row['level']][$row['status']] = $row['num'];
		}
		
		$data['header']['css_file'] = '../calendar.css';
		$data['header']['meta_title'] = '密码卡统计 - 测评系统管理';
		$data['footer']['js_file'][] = '../calendar.js';
		$data['main']['filter'] = $filter;
		$data['main']['status'] = $status;
		_load_viewer($this->staff_info['group_id'], 'cp_card_status', $data);
	}
	
	function _gen_password($length = 6)
	{
		$pool = '23456789ABCDEFGHIJKLMNPQRSTUVWXYZ';

		$str = '';
		for ($i = 0; $i < $length; $i++)
		{
			$str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
		}
		
		return $str;
	}
	
	function _load_generate_view($notify = '', $gen_info = array())
	{
		$data['header']['meta_title'] = '增加测评分类 - 咨询系统管理';
		$data['footer']['js_file'][] = '../ajax.js';
		$data['footer']['js_file'][] = 'cp.js';
		$data['main']['notification'] = $notify;
		$data['main']['category'] = $this->CP_category_model->get_all_category();
		$data['main']['gen_info'] = $gen_info;
		_load_viewer($this->staff_info['group_id'], 'cp_card_gen', $data);
	}
	
	function _load_batch_duplicate_confirm_view($notify = '', $batch_info = array(), $generate = array())
	{
		$data['header']['meta_title'] = '批号重复确认 - 咨询系统管理';
		$data['main']['notification'] = $notify;
		$data['main']['batch_info'] = $batch_info;
		$data['main']['generate'] = $generate;
		_load_viewer($this->staff_info['group_id'], 'cp_card_batch_dupli_confirm', $data);
	}
	
	function _parse_filter($filter_string, $filter)
	{
		$input_filter = parse_filter($filter_string);
		foreach($filter as $key => $value)
		{
			if(!isset($input_filter[$key]))
				continue;
			
			switch($key)
			{
				case 'add_time_a':
				case 'add_time_b':
					if(!check_valid_date($input_filter[$key]))
						continue;
					$filter[$key] = $input_filter[$key];
					break;
				case 'page':
				case 'cat_id':
				case 'level':
				case 'status':
					$input_filter[$key] = intval($input_filter[$key]);
					break;
				default:
					break;
			}
			
			if(empty($input_filter[$key]) && $input_filter[$key] !== 0)
				continue;
			
			$filter[$key] = $input_filter[$key];
		}
		return $filter;
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */