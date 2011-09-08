<?php
class join_model extends Model {

	function join_model()
	{
		parent::Model();
	}
	
	function getAll($filter, $offset = 0, $row_count = 0, $order_by = '', $order = 'ASC')
	{
		$where = '';
		//订单添加的开始时间
		if (isset($filter['add_time_a']) && $filter['add_time_a'])
        {
            $where .= " AND nd_join.add_time >= '{$filter['add_time_a']}' ";
        }
		//订单添加的结束时间
		if (isset($filter['add_time_b']) && $filter['add_time_b'])
        {
            $where .= " AND nd_join.add_time <= '{$filter['add_time_b']}' ";
        }
		//状态
		if (isset($filter['status']) && $filter['status'])
        {
            $where .= " AND nd_join.status = {$filter['status']} ";
        }
		
		//card基本信息
		$sql = "SELECT nd_join.*,province.region_name as province_name, city.region_name as city_name
				FROM ".$this->db->dbprefix('join')." as nd_join
				LEFT JOIN ".$this->db->dbprefix('crm_region')." as province ON province.region_id = nd_join.join_provice 
				LEFT JOIN ".$this->db->dbprefix('crm_region')." as city ON city.region_id = nd_join.join_city ";
		
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
            $where .= " AND nd_join.add_time >= '{$filter['add_time_a']}' ";
        }
		//订单添加的结束时间
		if (isset($filter['add_time_b']) && $filter['add_time_b'])
        {
            $where .= " AND nd_join.add_time <= '{$filter['add_time_b']}' ";
        }
		//状态
		if (isset($filter['status']) && $filter['status'])
        {
            $where .= " AND nd_join.status = {$filter['status']} ";
        }
		
		//card基本信息
		$sql = "SELECT count(nd_join.join_id) as total FROM ".$this->db->dbprefix('join')." as nd_join";
			
		if(!empty($where))
			$sql .= substr_replace($where, ' WHERE ', 0, strpos($where, 'AND') + 3);
		
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row['total'];
	}
	
	function get_all_unfinish()
	{
		//card基本信息
		$sql = "SELECT nd_join.join_id
				FROM ".$this->db->dbprefix('join')." as nd_join
				WHERE nd_join.status != ".JOIN_STATUS_FINISHED."
				AND add_time < '".date('Y-m-d H:i:s', strtotime("-1 month"))."'";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$result = array();
			foreach($query->result_array() as $row)
			{
				$result[] = $row['join_id'];
			}
			return $result;
		}
		else
		{
			return array();
		}
	}
	
	function delete_join($join_ids)
	{
		if(!is_array($join_ids))
			$join_ids = array($join_ids);
		
		foreach($join_ids as $join_id)
		{
			$this->db->where('join_id', $join_id);
			$this->db->delete(array('join', 'join_cv', 'join_detail', 'join_survey'));
		}
	}
	
	function get_one_join_detailed($join_id)
	{
		//join 基本信息
		$sql = "SELECT nd_join.*, detail.*, join_province.region_name as join_province_name, join_city.region_name as join_city_name, province.region_name as province_name, city.region_name as city_name
				FROM " . $this->db->dbprefix('join') . " as nd_join
				LEFT JOIN ".$this->db->dbprefix('crm_region')." as join_province ON join_province.region_id = nd_join.join_provice 
				LEFT JOIN ".$this->db->dbprefix('crm_region')." as join_city ON join_city.region_id = nd_join.join_city
				LEFT JOIN " . $this->db->dbprefix('join_detail') . " as detail ON detail.join_id = nd_join.join_id
				LEFT JOIN ".$this->db->dbprefix('crm_region')." as province ON province.region_id = detail.province_id
				LEFT JOIN ".$this->db->dbprefix('crm_region')." as city ON city.region_id = detail.city_id
				WHERE nd_join.join_id = $join_id
				LIMIT 1";
		
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0)
		{
			$result['info'] = $query->row_array();
			
			//survey
			$sql = "SELECT survey.survey_index, survey.survey_value, survey.survey_text
					FROM " . $this->db->dbprefix('join_survey') . " as survey
					WHERE survey.join_id = $join_id ";
			
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0)
			{
				foreach($query->result_array() as $row)
					$result['survey'][$row['survey_index']] = $row;
			}
			
			//cv
			$sql = "SELECT cv.*
					FROM " . $this->db->dbprefix('join_cv') . " as cv
					WHERE cv.join_id = $join_id
					LIMIT 1 ";
			
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0)
			{
				$result['cv'] = $query->row_array();
			}
			
			return $result;
			
		}
		else
		{
			return array();
		}
	}
	
	function new_join($join_info)
	{
		/*
		 * 插入 join 表
		*/
		$data['name'] = $join_info['name'];
		$data['join_provice'] = $join_info['join_provice'];
		$data['join_city'] = $join_info['join_city'];
		$data['status'] = JOIN_STATUS_START;
		$data['add_time'] = date('Y-m-d H:i:s');
		if($this->db->insert('join', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}
	
	function new_join_detail($join_id, $join_info)
	{
		/*
		 * 插入 join detail 表
		*/
		$data['join_id'] = $join_id;
		$data['birthday'] = $join_info['birthday'];
		$data['gender'] = $join_info['gender'];
		$data['province_id'] = $join_info['province_id'];
		$data['city_id'] = $join_info['city_id'];
		$data['postcode'] = $join_info['postcode'];
		$data['address'] = $join_info['address'];
		$data['duration'] = $join_info['duration'];
		$data['family_phone'] = $join_info['family_phone'];
		$data['work_phone'] = $join_info['work_phone'];
		$data['mobile'] = $join_info['mobile'];
		$data['email'] = $join_info['email'];
		$data['available_time'] = $join_info['available_time'];
		$data['provide_count'] = $join_info['provide_count'];
		$data['provide_peaple'] = $join_info['provide_peaple'];
		if($this->db->insert('join_detail', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function new_join_cv($join_id, $cv)
	{
		/*
		 * 插入 join cv 表
		*/
		$cv['join_id'] = $join_id;
		if($this->db->insert('join_cv', $cv))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function new_join_survey($join_id, $survey, $survey_other)
	{
		$sql_arr = array();
		foreach($survey as $index => $val)
		{
			if(is_array($val))
				$val = implode(';', $val);
			
			$text = (isset($survey_other[$index])) ? $survey_other[$index] : '';
			$sql_arr[] = "($join_id, $index, '$val', '$text')";
		}
		
		
		$sql = "INSERT INTO ".$this->db->dbprefix('join_survey')." (join_id, survey_index, survey_value, survey_text) 
				VALUES ".implode(' , ', $sql_arr);
		$this->db->query($sql);
		return ($this->db->affected_rows() > 0 ) ? TRUE : FALSE;
	}
	
	function get_one_join($join_id)
	{
		$sql = "SELECT nd_join.*
				FROM ".$this->db->dbprefix('join')." as nd_join
				WHERE nd_join.join_id = $join_id
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
	
	function update($join_id, $update_field = array())
	{
		if(empty($update_field))
			return true;
		
		//更新card表
		foreach($update_field as $key => $val)
		{
				$data[$key] = $val;
		}
		
		$this->db->where('join_id', $join_id);
		return $this->db->update('join', $data);
	}
}
?>
