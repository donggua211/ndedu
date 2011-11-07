<?php
class CP_order_model extends Model {

	function CP_order_model()
	{
		parent::Model();
	}
	
	function getAll($filter, $offset = 0, $row_count = 0, $order_by = '', $order = 'ASC')
	{
		$where = '';
		//订单添加的开始时间
		if (isset($filter['add_time_a']) && $filter['add_time_a'])
        {
            $where .= " AND cporder.add_time >= '{$filter['add_time_a']}' ";
        }
		//订单添加的结束时间
		if (isset($filter['add_time_b']) && $filter['add_time_b'])
        {
            $where .= " AND cporder.add_time <= '{$filter['add_time_b']}' ";
        }
		//状态
		if (isset($filter['status']) && $filter['status'])
        {
            $where .= " AND cporder.status = {$filter['status']} ";
        }
		
		//card基本信息
		$sql = "SELECT cporder.*,detail.*,province.region_name as province_name, city.region_name as city_name, district.region_name as district_name, quan.quan_id, quan.value as quan_value
				FROM ".$this->db->dbprefix('cp_order')." as cporder
				LEFT JOIN  ".$this->db->dbprefix('cp_order_detail')." as detail on detail.order_id = cporder.order_id
				LEFT JOIN ".$this->db->dbprefix('crm_region')." as province ON province.region_id = detail.province_id
				LEFT JOIN ".$this->db->dbprefix('crm_region')." as city ON city.region_id = detail.city_id
				LEFT JOIN ".$this->db->dbprefix('crm_region')." as district ON district.region_id = detail.district_id 
				LEFT JOIN ".$this->db->dbprefix('cp_quan')." as quan ON quan.order_id = cporder.order_id ";
		
		if(!empty($where))
			$sql .= substr_replace($where, ' WHERE ', 0, strpos($where, 'AND') + 3);
		
		//ORDER BY
		if (!empty($order_by))
        {
            $sql .= " ORDER BY $order_by $order ";
        }
		
		//LIMIT
		if (!empty($row_count))
        {
            $sql .= " LIMIT $offset, $row_count";
        }
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
	}
	
	function getAll_count($filter)
	{
		$where = '';
		//订单添加的开始时间
		if (isset($filter['add_time_a']) && $filter['add_time_a'])
        {
            $where .= " AND cporder.add_time >= '{$filter['add_time_a']}' ";
        }
		//订单添加的结束时间
		if (isset($filter['add_time_b']) && $filter['add_time_b'])
        {
            $where .= " AND cporder.add_time <= '{$filter['add_time_b']}' ";
        }
		//状态
		if (isset($filter['status']) && $filter['status'])
        {
            $where .= " AND cporder.status = {$filter['status']} ";
        }
		
		//card基本信息
		$sql = "SELECT count(cporder.order_id) as total FROM ".$this->db->dbprefix('cp_order')." as cporder";
			
		if(!empty($where))
			$sql .= substr_replace($where, ' WHERE ', 0, strpos($where, 'AND') + 3);
		
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row['total'];
	}
	
	function new_order($order_info)
	{
		//开始事务.
		$this->db->trans_begin();
		
		/*
		 * 插入student表
		*/
		//必填项
		$data['total_price'] = $order_info['total_price'];
		$data['status'] = CP_ORDER_STATUS_NEW;
		$data['order_type'] = $order_info['order_type'];
		$data['add_time'] = date('Y-m-d H:i:s');
		$data['update_time'] = date('Y-m-d H:i:s');
		if($this->db->insert('cp_order', $data))
		{
			$order_id = $this->db->insert_id();
		}
		else
		{
			$this->db->trans_rollback();
			return false;
		}
		/*
		 * 插入 cp_order_detail 表.
		 */
		$data = array();
		$data['order_id'] = $order_id;
		$data['name'] = $order_info['name'];
		$data['province_id'] = $order_info['province_id'];
		$data['city_id'] = $order_info['city_id'];
		$data['district_id'] = $order_info['district_id'];
		$data['address'] = $order_info['address'];
		$data['postcode'] = $order_info['postcode'];
		$data['mobile'] = $order_info['mobile'];
		$data['phone'] = $order_info['phone'];
		$data['delivery_type'] = $order_info['delivery_type'];
		$data['message'] = $order_info['message'];
		$data['add_time'] = date('Y-m-d H:i:s');
		if(!$this->db->insert('cp_order_detail', $data))
		{
			$this->db->trans_rollback();
			return false;
		}
		/*
		 * 插入 cp_order_list 表.
		 */
		$data = array();
		$data['order_id'] = $order_id;
		$data['cat_id'] = $order_info['cat_id'];
		$data['cat_level'] = $order_info['level'];
		$data['quantity'] = $order_info['order_num'];
		$data['add_time'] = date('Y-m-d H:i:s');
		if(!$this->db->insert('cp_order_list', $data))
		{
			$this->db->trans_rollback();
			return false;
		}
		
		/*
		 * 提交事务
		*/
		if ($this->db->trans_status() !== FALSE)
		{
			$this->db->trans_commit();
			return $order_id;
		}
		else
			return false;
	}
	
	function update($order_id, $update_field = array())
	{
		if(empty($update_field))
			return true;
		
		//更新student表
		foreach($update_field as $key => $val)
		{
				$data[$key] = $val;
		}
		$data['update_time'] = date('Y-m-d H:i:s');
		
		$this->db->where('order_id', $order_id);
		return $this->db->update('cp_order', $data);
	}
	
	function get_one($order_id)
	{
		$sql = "SELECT cporder.*,detail.*,province.region_name as province_name, city.region_name as city_name, district.region_name as district_name, cporder.add_time as order_add_time, quan.quan_id, quan.value as quan_value
				FROM ".$this->db->dbprefix('cp_order')." as cporder
				LEFT JOIN  ".$this->db->dbprefix('cp_order_detail')." as detail on detail.order_id = cporder.order_id
				LEFT JOIN ".$this->db->dbprefix('crm_region')." as province ON province.region_id = detail.province_id
				LEFT JOIN ".$this->db->dbprefix('crm_region')." as city ON city.region_id = detail.city_id
				LEFT JOIN ".$this->db->dbprefix('crm_region')." as district ON district.region_id = detail.district_id
				LEFT JOIN ".$this->db->dbprefix('cp_quan')." as quan ON quan.order_id = cporder.order_id 
				WHERE cporder.order_id = $order_id
				LIMIT 1";
		
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			$order = $query->row_array();
			
			//获取order list
			$sql = "SELECT order_list.*, cat.cat_name, cat.price_luxury, cat.price_advanced
					FROM ".$this->db->dbprefix('cp_order_list')." as order_list
					LEFT JOIN  ".$this->db->dbprefix('cp_cat')." as cat on cat.cat_id = order_list.cat_id
					WHERE order_list.order_id = $order_id";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0)
			{
				$order['order_list'] = $query->result_array();
			}
			
			//获取order action list
			$sql = "SELECT order_action.*
					FROM ".$this->db->dbprefix('cp_order_action')." as order_action
					WHERE order_action.order_id = $order_id";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0)
			{
				$order['order_action'] = $query->result_array();
			}
			
			return $order;
		}
		else
		{
			return array();
		}
	}
	
	function order_action_history($order_id, $from_status, $to_status, $action_notes='')
	{
		//必填信息.
		$data['order_id'] = $order_id;
		$data['from_status'] = $from_status;
		$data['to_status'] = $to_status;
		$data['action_notes'] = $action_notes;
		
		$data['add_time'] = date('Y-m-d H:i:s');
		
		if($this->db->insert('cp_order_action', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}
	
	function get_order_action($order_action_id)
	{
		$sql = "SELECT action.*
				FROM ".$this->db->dbprefix('cp_order_action')." as action
				WHERE action.action_id = $order_action_id
				LIMIT 1";
		
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{			
			return $query->row_array();;
		}
		else
		{
			return array();
		}
	}
	
	function delete_action($order_action_id)
	{
		$this->db->where('action_id', $order_action_id);
		$this->db->delete('cp_order_action'); 
		return ($this->db->affected_rows() > 0 ) ? TRUE : FALSE;
	}
}
?>
