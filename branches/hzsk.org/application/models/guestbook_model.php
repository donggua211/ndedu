<?php
class Guestbook_model extends CI_Model {

	function __construct()
	{
		parent::__construct();	
	}
	
	function intertGuestbook($message)
	{
		$data['user_name'] = $message['username'];
		$data['phone'] = $message['phone'];
		$data['email'] = $message['email'];
		$data['type'] = $message['type'];
		$data['message'] = $message['message'];
		$data['add_time'] = $message['add_time'];
		$data['ip_address'] = $message['ip_address'];
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