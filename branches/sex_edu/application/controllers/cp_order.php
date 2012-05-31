<?php

class cp_order extends Controller {

	function cp_order()
	{
		parent::Controller();
		$this->load->library('session');
		
		$this->load->model('CP_order_model');
		$this->load->model('CP_card_model');
		$this->load->model('CP_quan_model');
		$this->load->model('CP_category_model');
		$this->load->model('CRM_Region_model');
		
		$this->load->helper('common');
		$this->load->helper('cp');
	}
	
	function index($cat_id = 0, $level = 0)
	{
		//判断 cat_id 是否合法.
		$cat_id = (empty($cat_id))? intval($this->input->post('cat_id')) : intval($cat_id);
		$orderinfo['cat_id'] = ($cat_id > 0) ? $cat_id : 1;
		$level = (empty($level))? intval($this->input->post('level')) : intval($level);
		$orderinfo['level'] = ($level > 0) ? $level : 1;
				
		$category_info = $this->CP_category_model->get_one($cat_id);
		$orderinfo['order_num'] = intval($this->input->post('order_num'));
		//检查权限
		if(empty($category_info))
		{
			redirect('cp');
			return false;
		}
		
		//处理提交
		if(isset($_POST) && count($_POST) > 0)
		{
			/*
			 * 获取基本信息
			 */
			//发货地址.
			$orderinfo['name'] = trim($this->input->post('name'));
			$orderinfo['province_id'] = $this->input->post('province_id');
			$orderinfo['city_id'] = $this->input->post('city_id');
			$orderinfo['district_id'] = $this->input->post('district_id');
			$orderinfo['address'] = trim($this->input->post('address'));
			$orderinfo['postcode'] = intval($this->input->post('postcode'));
			$orderinfo['phone'] = trim($this->input->post('phone'));
			$orderinfo['mobile'] = trim($this->input->post('mobile'));
			
			//订单信息
			$orderinfo['delivery_type'] = $this->input->post('delivery_type');
			$orderinfo['message'] = $this->input->post('message');
			$orderinfo['quan'] = trim($this->input->post('quan'));
			
			//操作
			$orderinfo['action'] = $this->input->post('action');
			$orderinfo['order_type'] = $this->input->post('order_type') ? $this->input->post('order_type') : CP_ORDER_TYPE_NORMAL;
			
			if($orderinfo['action'] == 'step2')
			{
				if(empty($orderinfo['name']) || empty($orderinfo['province_id']) || empty($orderinfo['city_id']) || empty($orderinfo['district_id']) || empty($orderinfo['address']) || empty($orderinfo['postcode']) || empty($orderinfo['order_num']) || empty($orderinfo['delivery_type']))
				{
					$notify = '请填写完整的信息';
					$this->_load_step1_view($category_info, $orderinfo, $notify);
					return false;
				}
				elseif( empty($orderinfo['phone']) && empty($orderinfo['mobile']) )
				{
					$notify = '手机或座机必须二填其一';
					$this->_load_step1_view($category_info, $orderinfo, $notify);
					return false;
				}
				else
				{
					//计算费用
					$orderinfo['goods_fee'] = ( $orderinfo['level'] == CP_LEVEL_ADVANCED ?  $category_info['price_advanced'] : $category_info['price_luxury'] ) * $orderinfo['order_num'];
					$orderinfo['ship_fee'] = get_ship_fee($orderinfo['province_id'], $orderinfo['delivery_type']);
					$this->_load_step2_view($category_info, $orderinfo);
				}
				
			}
			elseif($orderinfo['action'] == 'step3')
			{
				//计算优惠券
				if(!empty($orderinfo['quan']))
					$quan_info = $this->CP_quan_model->get_one_quan($orderinfo['quan'], true);
				$orderinfo['quan_info'] = isset($quan_info) && !empty($quan_info) ? $quan_info : array();
				
				$orderinfo['level'] = ($level > 0 && $level <= CP_LEVEL_LUXURY) ? $level : CP_LEVEL_LUXURY;
				
				$orderinfo['goods_fee'] = ( $orderinfo['level'] == CP_LEVEL_ADVANCED ?  $category_info['price_advanced'] : $category_info['price_luxury'] ) * $orderinfo['order_num'];
				$orderinfo['ship_fee'] = get_ship_fee($orderinfo['province_id'], $orderinfo['delivery_type']);
				$orderinfo['total_price'] = $orderinfo['goods_fee'] + $orderinfo['ship_fee'] - (!empty($orderinfo['quan_info']) ? $orderinfo['quan_info']['value'] : 0);
								
				//add into DB
				$order_id = $this->CP_order_model->new_order($orderinfo);
				if($order_id > 0)
				{
					//插入student_status_history一条记录
					$this->CP_order_model->order_action_history($order_id, 0, CP_ORDER_STATUS_NEW);
					
					//优惠券记录
					if(!empty($orderinfo['quan_info']))
					{
						$update_field = array(
							'order_id' => $order_id,
							'status' => CP_QUAN_STATUS_USED,
							'used_at' => CP_QUAN_USED_AT_NDEDU,
							'used_time' => date('Y-m-d H:i:s'),
						
						);
						$this->CP_quan_model->update($orderinfo['quan'], $update_field);
					}
					
					$this->_load_step3_view($category_info, $orderinfo);
				}
				else
				{
					$notify = '对不起, 提交失败, 请重试.';
					$this->_load_step1_view($category_info, $orderinfo, $notify);
				}
			}
			else //默认操作
			{
				$this->_load_step1_view($category_info, $orderinfo);
			}
		}
		else
		{
			$this->_load_step1_view($category_info, $orderinfo);
		}
	}
	
	function update($cat_id = 0)
	{
		//判断 cat_id 是否合法.
		$cat_id = (empty($cat_id))? intval($this->input->post('cat_id')) : intval($cat_id);
		$orderinfo['cat_id'] = ($cat_id > 0) ? $cat_id : 1;
						
		$category_info = $this->CP_category_model->get_one($cat_id);
			
		//检查权限
		if(empty($category_info))
		{
			redirect('cp');
			return false;
		}
		
		//处理提交
		if(isset($_POST) && count($_POST) > 0)
		{
			/*
			 * 获取基本信息
			 */
			$orderinfo['card_id'] = trim($this->input->post('card_id'));
			$card_info = $this->CP_card_model->get_one_card_detailed($orderinfo['card_id']);
			
			//发货地址.
			$orderinfo['name'] = trim($this->input->post('name'));
			$orderinfo['phone'] = trim($this->input->post('phone'));
			$orderinfo['mobile'] = trim($this->input->post('mobile'));
			$orderinfo['province_id'] = $this->input->post('province_id');
			$orderinfo['city_id'] = $this->input->post('city_id');
			$orderinfo['district_id'] = $this->input->post('district_id');
			$orderinfo['address'] = '';
			$orderinfo['postcode'] = 0;
			$orderinfo['order_num'] = 1;
			$orderinfo['level'] = CP_LEVEL_LUXURY;
			$orderinfo['delivery_type'] = 0;
			
			//订单信息
			$orderinfo['message'] = $this->input->post('message');
			$orderinfo['quan'] = trim($this->input->post('quan'));
			
			//操作
			$orderinfo['action'] = $this->input->post('action');
			$orderinfo['order_type'] = $this->input->post('order_type') ? $this->input->post('order_type') : CP_ORDER_TYPE_NORMAL;
			
			if($orderinfo['action'] == 'step2')
			{
				if(empty($orderinfo['name']))
				{
					$notify = '请填写完整的信息';
					$this->_load_update_step1_view($category_info, $orderinfo, $card_info, $notify);
					return false;
				}
				elseif( empty($orderinfo['phone']) && empty($orderinfo['mobile']) )
				{
					$notify = '手机或座机必须二填其一';
					$this->_load_update_step1_view($category_info, $orderinfo, $card_info, $notify);
					return false;
				}
				else
				{
					//计算费用
					$orderinfo['goods_fee'] =  update_fee($card_info['price_luxury'], $card_info['price_advanced']);
					$orderinfo['ship_fee'] = 0;
					$this->_load_update_step2_view($category_info, $orderinfo, $card_info);
				}
				
			}
			elseif($orderinfo['action'] == 'step3')
			{
				//计算优惠券
				if(!empty($orderinfo['quan']))
					$quan_info = $this->CP_quan_model->get_one_quan($orderinfo['quan'], true);
				$orderinfo['quan_info'] = isset($quan_info) && !empty($quan_info) ? $quan_info : array();
								
				$orderinfo['goods_fee'] = update_fee($card_info['price_luxury'], $card_info['price_advanced']);
				$orderinfo['ship_fee'] = 0;
				$orderinfo['total_price'] = $orderinfo['goods_fee'] + $orderinfo['ship_fee'] - (!empty($orderinfo['quan_info']) ? $orderinfo['quan_info']['value'] : 0);
				//升级金额减去优惠券金额 有可能为负数.
				$orderinfo['total_price'] = ($orderinfo['total_price'] > 0) ? $orderinfo['total_price'] : 0;
				
				$orderinfo['message'] = "卡号: ".$card_info['card_id']."\n".$orderinfo['message'];
				
				//add into DB
				$order_id = $this->CP_order_model->new_order($orderinfo);
				if($order_id > 0)
				{
					//插入student_status_history一条记录
					$this->CP_order_model->order_action_history($order_id, 0, CP_ORDER_STATUS_NEW);
					
					//优惠券记录
					if(!empty($orderinfo['quan_info']))
					{
						$update_field = array(
							'order_id' => $order_id,
							'status' => CP_QUAN_STATUS_USED,
							'used_at' => CP_QUAN_USED_AT_NDEDU,
							'used_time' => date('Y-m-d H:i:s'),
						
						);
						$this->CP_quan_model->update($orderinfo['quan'], $update_field);
					}
					$this->_load_update_step3_view($category_info, $orderinfo, $card_info);
				}
				else
				{
					$notify = '对不起, 提交失败, 请重试.';
					$this->_load_update_step1_view($category_info, $orderinfo, $card_info, $notify);
				}
			}
			else //默认操作
			{
				$this->_load_update_step1_view($category_info, $orderinfo, $card_info);
			}
		}
		else
		{
			$this->_load_update_step1_view($category_info, $orderinfo, $card_info);
		}
	}
	
	function _load_step1_view($category_info, $orderinfo = array(), $notify = '')
	{
		$data['header']['meta_title'] = '填写订单 - 尼德全方位测评系统';
		$data['footer']['js_file'][] = 'cp.js';
		$data['footer']['js_file'][] = 'admin/region.js';
		$data['footer']['js_file'][] = 'admin/transport.js';
		$data['main']['provinces'] = $this->CRM_Region_model->get_regions();
		$data['main']['cities'] = (isset($orderinfo['province_id']) && $orderinfo['province_id'] > 0 ) ? $this->CRM_Region_model->get_regions(REGION_CITY, $orderinfo['province_id']) : array();
		$data['main']['districts'] = (isset($orderinfo['city_id']) && $orderinfo['city_id'] > 0 ) ? $this->CRM_Region_model->get_regions(REGION_DISTRICT, $orderinfo['city_id']) : array();
		$data['main']['notification'] = $notify;
		$data['main']['orderinfo'] = $orderinfo;
		$data['main']['category_info'] = $category_info;
		_load_cp_viewer('order_step1', $data);
	}
	
	function _load_step2_view($category_info, $orderinfo = array(), $notify = '')
	{
		$data['header']['meta_title'] = '填写订单 - 尼德全方位测评系统';
		$data['footer']['js_file'][] = 'cp.js';
		$data['main']['notification'] = $notify;
		$data['main']['orderinfo'] = $orderinfo;
		$data['main']['province_name'] = $this->CRM_Region_model->get_one_region($orderinfo['province_id']);
		$data['main']['city_name'] = $this->CRM_Region_model->get_one_region($orderinfo['city_id']);
		$data['main']['district_name'] = $this->CRM_Region_model->get_one_region($orderinfo['district_id']);
		$data['main']['category_info'] = $category_info;
		_load_cp_viewer('order_step2', $data);
	}
	
	function _load_step3_view($category_info, $orderinfo = array(), $notify = '')
	{
		$data['header']['meta_title'] = '订单成功 - 尼德全方位测评系统';
		$data['main']['notification'] = $notify;
		$data['main']['orderinfo'] = $orderinfo;
		$data['main']['category_info'] = $category_info;
		_load_cp_viewer('order_step3', $data);
	}
	
	function _load_update_step1_view($category_info, $orderinfo = array(), $card_info = array(), $notify = '')
	{
		$data['header']['meta_title'] = '填写订单 - 尼德全方位测评系统';
		$data['footer']['js_file'][] = 'cp.js';
		$data['footer']['js_file'][] = 'admin/region.js';
		$data['footer']['js_file'][] = 'admin/transport.js';
		$data['main']['provinces'] = $this->CRM_Region_model->get_regions();
		$data['main']['cities'] = (isset($orderinfo['province_id']) && $orderinfo['province_id'] > 0 ) ? $this->CRM_Region_model->get_regions(REGION_CITY, $orderinfo['province_id']) : array();
		$data['main']['districts'] = (isset($orderinfo['city_id']) && $orderinfo['city_id'] > 0 ) ? $this->CRM_Region_model->get_regions(REGION_DISTRICT, $orderinfo['city_id']) : array();
		$data['main']['notification'] = $notify;
		$data['main']['orderinfo'] = $orderinfo;
		$data['main']['card_info'] = $card_info;
		$data['main']['category_info'] = $category_info;
		_load_cp_viewer('order_update_step1', $data);
	}
	
	function _load_update_step2_view($category_info, $orderinfo = array(), $card_info = array(), $notify = '')
	{
		$data['header']['meta_title'] = '填写订单 - 尼德全方位测评系统';
		$data['footer']['js_file'][] = 'cp.js';
		$data['main']['notification'] = $notify;
		$data['main']['orderinfo'] = $orderinfo;
		$data['main']['card_info'] = $card_info;
		$data['main']['province_name'] = $this->CRM_Region_model->get_one_region($orderinfo['province_id']);
		$data['main']['city_name'] = $this->CRM_Region_model->get_one_region($orderinfo['city_id']);
		$data['main']['district_name'] = $this->CRM_Region_model->get_one_region($orderinfo['district_id']);
		$data['main']['category_info'] = $category_info;
		_load_cp_viewer('order_update_step2', $data);
	}
	
	function _load_update_step3_view($category_info, $orderinfo = array(), $card_info = array(), $notify = '')
	{
		$data['header']['meta_title'] = '订单成功 - 尼德全方位测评系统';
		$data['main']['notification'] = $notify;
		$data['main']['orderinfo'] = $orderinfo;
		$data['main']['card_info'] = $card_info;
		$data['main']['category_info'] = $category_info;
		_load_cp_viewer('order_update_step3', $data);
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */