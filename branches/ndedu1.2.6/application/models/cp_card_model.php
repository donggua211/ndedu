<?php
class CP_card_model extends Model {

	function CP_card_model()
	{
		parent::Model();
	}
	
	function add($card)
	{
		$data['card_id'] = $card['card_id'];
		$data['level'] = $card['level'];
		$data['password'] = $card['password'];

		$data['add_time'] = date('Y-m-d H:i:s');

		if($this->db->insert('cp_ceping', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}
	
	function get_status($filter)
	{
		$where = '';
		//测评卡添加的开始时间
		if (isset($filter['add_time_a']) && $filter['add_time_a'])
        {
            $where .= " AND card.add_time >= '{$filter['add_time_a']}' ";
        }
		//测评卡添加的结束时间
		if (isset($filter['add_time_b']) && $filter['add_time_b'])
        {
            $where .= " AND card.add_time <= '{$filter['add_time_b']}' ";
        }
				
		//card基本信息
		$sql = "SELECT card.cat_id, card.level, card.status, cat.cat_name, COUNT(card.card_id) as num FROM ".$this->db->dbprefix('cp_card')." as card 
		LEFT JOIN ".$this->db->dbprefix('cp_cat')." as cat ON cat.cat_id = card.cat_id ";
					
		if(!empty($where))
			$sql .= substr_replace($where, ' WHERE ', 0, strpos($where, 'AND') + 3);
		
		$sql .= "GROUP BY card.cat_id,card.level, card.status";
		
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
	
	function getAll($filter, $offset = 0, $row_count = 0, $order_by = '', $order = 'ASC')
	{
		$where = '';
		//测评分类
		if (isset($filter['cat_id']) && $filter['cat_id'])
        {
            $where .= " AND card.cat_id = {$filter['cat_id']} ";
        }
		//测评的级别.
		if (isset($filter['level']) && $filter['level'])
        {
            $where .= " AND card.level = {$filter['level']} ";
        }
		//状态
		if (isset($filter['status']) && $filter['status'])
        {
            $where .= " AND card.status = {$filter['status']} ";
        }
		
		//card基本信息
		$sql = "SELECT card.*, cat.cat_name FROM ".$this->db->dbprefix('cp_card')." as card
				LEFT JOIN ".$this->db->dbprefix('cp_cat')." as cat ON cat.cat_id = card.cat_id";
					
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
		//测评分类
		if (isset($filter['cat_id']) && $filter['cat_id'])
        {
            $where .= " AND card.cat_id = {$filter['cat_id']} ";
        }
		//测评的级别.
		if (isset($filter['level']) && $filter['level'])
        {
            $where .= " AND card.level = {$filter['level']} ";
        }
		//状态
		if (isset($filter['status']) && $filter['status'])
        {
            $where .= " AND card.status = {$filter['status']} ";
        }
		
		//card基本信息
		$sql = "SELECT count(DISTINCT card.card_id) as total FROM ".$this->db->dbprefix('cp_card')." as card";
					
		if(!empty($where))
			$sql .= substr_replace($where, ' WHERE ', 0, strpos($where, 'AND') + 3);
		
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row['total'];
	}
	
	function get_batch_info($batch_id)
	{
		$sql = "SELECT *
				FROM " . $this->db->dbprefix('cp_card_batch') . "
				WHERE batch_id = $batch_id
				LIMIT 1";
		
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return array();
		}
	}
	
	function check_card_ids_exist($card_ids)
	{
		$card_id_str = implode(',', $card_ids);
		$sql = "SELECT card_id
				FROM " . $this->db->dbprefix('cp_card') . "
				WHERE card_id IN ( $card_id_str )";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return array();
		}
	}
	
	function add_cards($cards)
	{
		$insert = '';
		foreach($cards as $val)
		{
			$insert .= "('$val[card_id]', '$val[cat_id]', $val[level], '".md5($val['password'])."', '".date('Y-m-d H:i:s')."', '".CP_CARD_STATUS_UNUSED."', '0000-00-00 00:00:00', '0000-00-00 00:00:00') , ";
		}
		
		$sql = "INSERT INTO " . $this->db->dbprefix('cp_card') . " (card_id, cat_id, level, password, add_time, status, start_time, finished_time) 
				VALUES ".trim($insert, ', ');
		
		$query = $this->db->query($sql);
		return ($this->db->affected_rows() > 0 ) ? TRUE : FALSE;
	}
	
	function update_batch($batch_info)
	{
		$sql = "INSERT INTO " . $this->db->dbprefix('cp_card_batch') . " (batch_id, last_sn, add_time, update_time) 
				VALUES ($batch_info[batch_id], $batch_info[last_sn], '".date('Y-m-d H:i:s')."', '".date('Y-m-d H:i:s')."') 
				ON DUPLICATE KEY UPDATE last_sn=$batch_info[last_sn], update_time='".date('Y-m-d H:i:s')."'";
		
		$query = $this->db->query($sql);
		return ($this->db->affected_rows() > 0 ) ? TRUE : FALSE;
	}
	
	function check_batch_exist($batch_id)
	{
		$sql = "SELECT *
				FROM " . $this->db->dbprefix('cp_card_batch') . "
				WHERE batch_id = $batch_id
				LIMIT 1";
		
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_last_batch()
	{
		$sql = "SELECT *
				FROM " . $this->db->dbprefix('cp_card_batch') . "
				ORDER BY update_time DESC
				LIMIT 1";
		
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			$result = $query->row_array();
			return $result['batch_id'];
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_one_card($card_id)
	{
		$sql = "SELECT card.*, cat.cat_name
				FROM " . $this->db->dbprefix('cp_card') . " as card
				LEFT JOIN " . $this->db->dbprefix('cp_cat') . " as cat ON cat.cat_id = card.cat_id
				WHERE card.card_id = $card_id
				LIMIT 1";
		
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return array();
		}
	}
	
	function get_one_card_detailed($card_id)
	{
		//card 基本信息
		$sql = "SELECT card.*, cat.cat_name, card.add_time as card_add_time, cat.price_advanced, cat.price_luxury
				FROM " . $this->db->dbprefix('cp_card') . " as card
				LEFT JOIN " . $this->db->dbprefix('cp_cat') . " as cat ON cat.cat_id = card.cat_id
				WHERE card.card_id = $card_id
				LIMIT 1";
		
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			$result = $query->row_array();
			
			//userinfo
			$sql = "SELECT userinfo.*, grade.grade_name, province.region_name as province_name, city.region_name as city_name, district.region_name as district_name 
					FROM " . $this->db->dbprefix('cp_userinfo') . " as userinfo
					LEFT JOIN ".$this->db->dbprefix('crm_grade')." as grade ON grade.grade_id =  userinfo.grade_id
					LEFT JOIN ".$this->db->dbprefix('crm_region')." as province ON province.region_id = userinfo.province_id
					LEFT JOIN ".$this->db->dbprefix('crm_region')." as city ON city.region_id = userinfo.city_id
					LEFT JOIN ".$this->db->dbprefix('crm_region')." as district ON district.region_id = userinfo.district_id
					WHERE userinfo.card_id = $card_id
					LIMIT 1";
			
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0)
			{
				$result['user_info'] = $query->row_array();
			}
			
			return $result;
			
		}
		else
		{
			return array();
		}
	}
	
	function update($card_id, $update_field = array())
	{
		if(empty($update_field))
			return true;
		
		//更新card表
		foreach($update_field as $key => $val)
		{
				$data[$key] = $val;
		}
		
		$this->db->where('card_id', $card_id);
		return $this->db->update('cp_card', $data);
	}
	
	function add_userinfo($userinfo)
	{
		$sql = "INSERT INTO " . $this->db->dbprefix('cp_userinfo') . " (card_id, name, phone, email, school, grade_id, province_id, city_id, district_id, add_time) 
				VALUES ($userinfo[card_id], '$userinfo[name]', '$userinfo[phone]', '$userinfo[email]', '$userinfo[school]', $userinfo[grade_id], $userinfo[province_id], $userinfo[city_id], $userinfo[district_id], '".date('Y-m-d H:i:s')."') 
				ON DUPLICATE KEY UPDATE add_time='".date('Y-m-d H:i:s')."'";
				
		$query = $this->db->query($sql);
		return ($this->db->affected_rows() > 0 ) ? TRUE : FALSE;
	}
}
?>
