<?php
class CRM_History_model extends Model {

	function CRM_History_model()
	{
		parent::Model();
		
		$this->types = array('learning', 'contact', 'callback', 'consult', 'suyang');
	}
	
	function _check_history_type($history_type)
	{
		//判断history type.
		return in_array($history_type, $this->types);
	}
	
	function add_history($history, $history_type)
	{
		if(!$this->_check_history_type($history_type))
			return false;
		
		$table = 'crm_history_'.$history_type;
		
		//必填项
		$data['student_id'] = $history['student_id'];
		$data['staff_id'] = $history['staff_id'];
		$data['history_'.$history_type] = $history['history'];
		
		//4种历史的表结构各不相同。
		switch($history['history_type'])
		{
			case 'learning':
				$data['history_learning_subject'] = $history['learning_subject'];
				$data['history_learning_period'] = $history['learning_period'];
				$data['history_learning_date'] = $history['learning_date'];
				$data['history_learning_version'] = $history['learning_version'];
				break;
			case 'consult':
			case 'suyang':
				$data['history_'.$history_type.'_target'] = $history['target'];
				break;
			case 'contact':
				break;
			case 'callback':
				switch($history['callback_history_type'])
				{
					case 'consult':
						$data['history_callback_type'] = HISTORY_TYPE_CONSULT;
						break;
					case 'suyang':
						$data['history_callback_type'] = HISTORY_TYPE_SUYANG;
						break;
					case 'learning':
						$data['history_callback_type'] = HISTORY_TYPE_LEARNING;
						break;
				}
				$data['history_callback_history_id'] = $history['callback_history_id'];
				break;
		}
		
		$data['is_delete'] = 0;
		$data['add_time'] = date('Y-m-d H:i:s');
		$data['update_time'] = date('Y-m-d H:i:s');
		
		if($this->db->insert($table, $data))
		{
			$insert_id = $this->db->insert_id();
			
			//更新crm_student的update_time
			$this->_update_student_updatetime($history['student_id']);
			return $insert_id;
		}
		else
		{
			return false;
		}
	}
	
	function add_history_attachment($history_attachment)
	{
		//必填项
		$data['history_id'] = $history_attachment['history_id'];
		$data['attachment_name'] = $history_attachment['attachment_name'];
		$data['file_ext'] = $history_attachment['file_ext'];
		
		$data['add_time'] = date('Y-m-d H:i:s');
		$data['update_time'] = date('Y-m-d H:i:s');
		
		if($this->db->insert('crm_history_attachment', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function get_histories($student_id)
	{
		foreach($this->types as $type)
			$result['history_'.$type] = $this->_get_history($student_id, $type);
		
		//处理callback历史		
		foreach($result['history_callback'] as $val)
		{
			switch($val['history_callback_type'])
			{
				case HISTORY_TYPE_CONSULT:
					$history_callback_type = 'consult';
					break;
				case HISTORY_TYPE_SUYANG:
					$history_callback_type = 'suyang';
					break;
				case HISTORY_TYPE_LEARNING:
					$history_callback_type = 'learning';
					break;
			}
			if(isset($result['history_'.$history_callback_type][$val['history_callback_history_id']]))
				$result['history_'.$history_callback_type][$val['history_callback_history_id']]['callback_history'][] = $val;
		}
		
		return $result;
	}
	
	function get_history_learning($student_id)
	{
		return $this->_get_history($student_id, 'learning');
	}
	
	function get_history_contact($student_id)
	{
		return $this->_get_history($student_id, 'contact');
	}
	
	function _get_history($student_id, $history_type)
	{
		if(!$this->_check_history_type($history_type))
			return false;
		
		$table = 'crm_history_'.$history_type;
		
		$sql = "SELECT history.*, staff.name, attachment.history_attachment_id, attachment.attachment_name  FROM " . $this->db->dbprefix($table) . " as history
				LEFT JOIN " . $this->db->dbprefix('crm_staff') . " as staff ON  staff.staff_id = history.staff_id
				LEFT JOIN " . $this->db->dbprefix('crm_history_attachment') . " as attachment ON  attachment.history_id = history.history_{$history_type}_id
				WHERE student_id = $student_id	
				AND history.is_delete = 0
				ORDER BY history.add_time DESC";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$result = array();
			foreach($query->result_array() as $val)
			{
				$result[$val['history_'.$history_type.'_id']] = $val;
			}
			return $result;
		}
		else
		{
			return array();
		}
	}
	
	function get_one_history_learning($history_id)
	{
		return $this->_get_one_history($history_id, 'learning');
	}
	
	function get_one_history_contact($history_id)
	{
		return $this->_get_one_history($history_id, 'contact');
	}
	
	function _get_one_history($history_id, $history_type)
	{
		if(!$this->_check_history_type($history_type))
			return false;
		
		$primary_key = 'history_'.$history_type.'_id';
		$history_text = 'history_'.$history_type;
		$table = 'crm_history_'.$history_type;
		
		$sql = "SELECT history.* FROM " . $this->db->dbprefix($table) . " as history
				WHERE $primary_key = $history_id	
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
	
	function get_one_history_attachment($history_attachment_id)
	{
		$sql = "SELECT history_id, attachment_name, file_ext FROM " . $this->db->dbprefix('crm_history_attachment') . " as history_attachment
				WHERE history_attachment_id = $history_attachment_id
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
	
	function _update($history_id, $history_type, $update_field = array())
	{
		if(empty($update_field))
			return true;
		
		if(!$this->_check_history_type($history_type))
			return false;
		
		$primary_key = 'history_'.$history_type.'_id';
		$table = 'crm_history_'.$history_type;
		
		//更新student表
		foreach($update_field as $key => $val)
		{
			$data[$key] = $val;
		}
		$data['update_time'] = date('Y-m-d H:i:s');
		
		$this->db->where($primary_key, $history_id);
		if(!$this->db->update($table, $data))
		{
			return false;
		}
		return true;
	}
	
	function _update_student_updatetime($student_id)
	{
		$data['update_time'] = date('Y-m-d H:i:s');
		
		$this->db->where('student_id', $student_id);
		if(!$this->db->update('crm_student', $data))
		{
			return false;
		}
		
		return true;
	
	}
	
	function get_last3_contact_history($student_id)
	{
		$table = 'crm_history_contact';
		
		$sql = "SELECT history.* FROM " . $this->db->dbprefix($table) . " as history
				WHERE student_id = $student_id	
				AND history.is_delete = 0
				ORDER BY add_time DESC
				LIMIT 3";
		
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
	
	function get_all_xueke_history($filter = '')
	{
		$xueke_history = array('learning', 'consult', 'suyang');
		$result = array();
		foreach($xueke_history as $history_type)
		{
			$sql = "SELECT history.student_id, history.staff_id, history.add_time FROM " . $this->db->dbprefix('crm_history_'.$history_type) . " as history
				WHERE history.is_delete = 0 ";
			
			if (isset($filter['start_date']) && $filter['start_date'])
			{
				$sql .= " AND history.add_time >= '{$filter['start_date']}' ";
			}
			if (isset($filter['end_date']) && $filter['end_date'])
			{
				$sql .= " AND history.add_time <= '{$filter['end_date']}' ";
			}
			
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0)
			{
				foreach($query->result_array() as $val)
					$result[$val['staff_id']][$val['student_id']][] = $val;
			}
		}
		return $result;
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */