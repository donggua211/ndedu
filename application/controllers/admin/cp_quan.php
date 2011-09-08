<?php
/* 
  测评管理
  admin权限.
 */
class cp_quan extends Controller {

	function cp_quan()
	{
		parent::Controller();
		$this->load->library('session');
		
		$this->load->model('CP_quan_model');
		$this->load->model('CP_order_model');
		
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
		$filter['used_at'] = $this->input->post('used_at');
		$filter['status'] = $this->input->post('status');
			
		$filter = $this->_parse_filter($filter_string, $filter);
				
		//Page Nav
		$total = $this->CP_quan_model->getAll_count($filter);
		$page_nav = page_nav($total, CP_CARD_PER_PAGE, $filter['page']);
		$page_nav['base_url'] = 'admin/cp_quan/index';
		$page_nav['filter'] = $filter;
		$data['main']['page_nav'] = $this->load->view('admin/common_page_nav', $page_nav, true);
		
		$quans = $this->CP_quan_model->getAll($filter, $page_nav['start'], CP_CARD_PER_PAGE);
		
		$data['header']['meta_title'] = '查看优惠券 - 测评系统管理';
		$data['main']['filter'] = $filter;
		$data['main']['quans'] = $quans;
		_load_viewer($this->staff_info['group_id'], 'cp_quan_all', $data);
	}
		
	function generate()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$generate['confirm_add'] = $this->input->post('confirm_add');
			$generate['values'] = (array)$this->input->post('values');
			$generate['batch'] = intval($this->input->post('batch'));
			$generate['number'] = intval($this->input->post('number'));
			
			if(empty($generate['values']) || empty($generate['batch']) || empty($generate['number']))
			{
				$notify = '请填写完整信息!';
				$this->_load_generate_view($notify, $generate);
			}
			elseif( count($generate['values']) * $generate['number'] > CP_GEN_CARD_MAX) //判断是否生长张数大于要求
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
				$batch_info = $this->CP_quan_model->get_batch_info($generate['batch']);
				
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
					$batch_info['last_sn'] = 1;
				}
				
				$quans = array();
				foreach($generate['values'] as $value)
				{
					for($i = 0; $i < $generate['number']; $i++)
					{
						$quan_id = $this->_gen_quan_id($batch_info['batch_id']);
						$quans[$quan_id]['quan_id'] = $quan_id;
						$quans[$quan_id]['value'] = $value;
						
						//控制字段.
						$batch_info['last_sn']++;
					}
				}
				
				//验证本批 card ids 是否有重复的.
				$exist_quan_id = $this->CP_quan_model->check_quan_ids_exist(array_keys($quans));
				if($exist_quan_id)
				{
					foreach($exist_quan_id as $quan_id)
					{
						unset($quans[$quan_id]);
					}
				}
				
				//插入数据库: card 表
				if($this->CP_quan_model->add_quans($quans))
				{
					echo "<h1>card成功</h1>\n";
					echo '<table>';
					foreach($quans as $quan)
					{
						echo '<tr><td>'.$quan['quan_id'].'</td></tr>';
					}
					echo '</table>';
				}
				
				//更新数据库: card_batch 表
				if($this->CP_quan_model->update_batch($batch_info))
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
	
	//quan长度为: 16位.
	function _gen_quan_id($batch_id)
	{
		$key = 'ndedu_'.uniqid(mt_rand(), true);
		return $batch_id.str_pad(substr(hexdec(md5($key)),2,12), 12, '0', STR_PAD_LEFT);
	}
	
	function use_quan()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$quan = $this->input->post("quan");
			$order_id = $this->input->post("order_id");
			
			$quan_info = $this->CP_quan_model->get_one_quan($quan, true);
			$order_info = $this->CP_order_model->get_one($order_id);
			
			if(empty($quan_info) || empty($order_info))
			{
				show_error_page('您输入的优惠券ID不对, 请返回重试.', 'admin/cp_order/one/'.$order_id);
				return false;
			}
			
			$total_price = $order_info['total_price'] - $quan_info['value'];
			//升级金额减去优惠券金额 有可能为负数.
			$update_field['total_price'] = $total_price = ($total_price > 0) ? $total_price : 0;
			if(!$this->CP_order_model->update($order_id, $update_field))
			{
				show_error_page('更新订单总价失败, 请返回重试.', 'admin/cp_order/one/'.$order_id);
				return false;
			}
			
			$update_field = array();
			//优惠券记录
			$update_field = array(
				'order_id' => $order_id,
				'status' => CP_QUAN_STATUS_USED,
				'used_at' => CP_QUAN_USED_AT_TAOBAO,
				'used_time' => date('Y-m-d H:i:s'),
			
			);
			$this->CP_quan_model->update($quan, $update_field);
			
			show_result_page('优惠券的金额为: '.$quan_info['value'].'<br/>该订单的总价从: '.$order_info['total_price'].'改为: '.$total_price, 'admin/cp_order/one/'.$order_id);
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
		$rows = $this->CP_quan_model->get_status($filter);
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
		
		//return $str;
		return '123';
	}
	
	function _load_generate_view($notify = '', $gen_info = array())
	{
		$data['header']['meta_title'] = '增加测评分类 - 咨询系统管理';
		$data['footer']['js_file'][] = '../ajax.js';
		$data['footer']['js_file'][] = 'cp.js';
		$data['main']['notification'] = $notify;
		$data['main']['gen_info'] = $gen_info;
		_load_viewer($this->staff_info['group_id'], 'cp_quan_gen', $data);
	}
	
	function _load_batch_duplicate_confirm_view($notify = '', $batch_info = array(), $generate = array())
	{
		$data['header']['meta_title'] = '批号重复确认 - 咨询系统管理';
		$data['main']['notification'] = $notify;
		$data['main']['batch_info'] = $batch_info;
		$data['main']['generate'] = $generate;
		_load_viewer($this->staff_info['group_id'], 'cp_quan_batch_dupli_confirm', $data);
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
				case 'used_at':
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