<?php
class Guestbook_model extends Model {

	function Guestbook_model()
	{
		parent::Model();
	}
	
	function intertGuestbook($message)
	{
		$data['user_name'] = $message['username'];
		$data['phone'] = $message['phone'];
		$data['grade'] = $message['grade'];
		$data['message'] = $message['message'];
		$data['add_time'] = $message['add_time'];
		$data['ip_address'] = $message['ip_address'];
		$data['from_page'] = $message['from_page'] ;
		$data['is_new'] = 1;
		
		if($this->db->insert('guestbook', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function getAll($filter, $offset = 0, $row_count = 0)
	{
		$where = '';
		//是否为新的
        if (isset($filter['is_new']) && $filter['is_new']!= 2)
        {
            $where .= " AND is_new = {$filter['is_new']} ";
        }
		//是否为删除的
		if (isset($filter['is_deleted']) && $filter['is_deleted']!= 2)
        {
            $where .= " AND is_deleted = {$filter['is_deleted']} ";
        }
		
		$sql = "SELECT * FROM ".$this->db->dbprefix('guestbook')." ";
		
		//WHERE
		if(!empty($where))
		{
			$pos = strpos($where, 'AND');
			$sql .= substr_replace($where, ' WHERE', 0, $pos+3);
		}
		$sql .= " ORDER BY add_time DESC ";
		//LIMIT
		if (!empty($row_count))
        {
            $sql .= " LIMIT $offset, $row_count";
        }
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$row['add_time'] = date('Y-m-d H:i', $row['add_time']);
				
				switch($row['grade'])
				{
					case 'preschool':
						$row['grade_name'] = '学前班';
						break;
					case 'primary_school':
						$row['grade_name'] = '小学';
						break;
					case 'junior_middle_school':
						$row['grade_name'] = '初中';
						break;
					case 'high_school':
						$row['grade_name'] = '高中';
						break;
					default:
						$row['grade_name'] = '';
						break;
				}
				
				$result[$row['msg_id']] = $row;
			}
			return $result;
		}
		else
		{
			return array();
		}
	}
	
	function getAll_count($filter)
	{
		$where = '';
		//是否为新的
        if (isset($filter['is_new']) && $filter['is_new']!= 2)
        {
            $where .= " AND is_new = {$filter['is_new']} ";
        }
		//是否为删除的
		if (isset($filter['is_deleted']) && $filter['is_deleted']!= 2)
        {
            $where .= " AND is_deleted = {$filter['is_deleted']} ";
        }
				
		//student基本信息
		$sql = "SELECT COUNT(msg_id) AS total FROM ".$this->db->dbprefix('guestbook')." ";
		if(!empty($where))
		{
			$pos = strpos($where, 'AND');
			$sql .= substr_replace($where, ' WHERE', 0, $pos+3);
		}

		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row['total'];
	}
	
	function getOneMessage($message_id)
	{
		$query = $this->db->get_where('guestbook', array('msg_id ' => $message_id));
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();
			$row['add_time'] = date('Y-m-d H:i', $row['add_time']);
			switch($row['grade'])
			{
				case 'preschool':
					$row['grade_name'] = '学前班';
					break;
				case 'primary_school':
					$row['grade_name'] = '小学';
					break;
				case 'junior_middle_school':
					$row['grade_name'] = '初中';
					break;
				case 'high_school':
					$row['grade_name'] = '高中';
					break;
				default:
					$row['grade_name'] = '';
					break;
			}
			return $row;
		}
		else
		{
			return false;
		}	
	}
	
	function updataMessage($message_id, $data)
	{
		if(!is_array($data)) 
			return false;
		
		if(!is_array($message_id))
			$msg_ids[] = $message_id;
		else
			$msg_ids = $message_id;
		
		$this->db->where_in('msg_id', $msg_ids);
		$result = $this->db->update('guestbook', $data);

		return $result;
	}
}
?>