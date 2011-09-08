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
	
	function getMessages($page, $num_message_per_page, $message_stats)
	{
		$this->db->order_by("is_new", 'DESC');
		
		if($message_stats == 'available')
		{
			$this->db->where('is_deleted', '0');
		}
		elseif($message_stats == 'unavailable')
		{
			$this->db->where('is_deleted', '1');
		}
		
		$query = $this->db->get('guestbook', $num_message_per_page, $num_message_per_page*($page-1));
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$row['add_time'] = date('Y-m-d h:i:s', $row['add_time']);
				
				$result[$row['msg_id']] = $row;
			}
			return $result;
		}
		else
		{
			return array();
		}
	}

	function countMessage($message_stats)
	{
		if($message_stats == 'available')
		{
			$this->db->where('is_deleted', '0');
		}
		elseif($message_stats == 'unavailable')
		{
			$this->db->where('is_deleted', '1');
		}

		$query = $this->db->get('guestbook');
		return $query->num_rows();
	}
	
	function getOneMessage($message_id)
	{
		$query = $this->db->get_where('guestbook', array('msg_id ' => $message_id));
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
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
	
	function deleteMessage($message_id)
	{
		if(!is_array($message_id))
			$msg_ids[] = $message_id;
		else
			$msg_ids = $message_id;
		
		$this->db->where_in('msg_id', $msg_ids);
		$result = $this->db->delete('guestbook');
		return $result;
	}
	
	function getLast10NewGuestBook()
	{
		$query = $this->db->get_where('guestbook', array('is_new' => '1', 'is_deleted' => '0'), 10);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$row['add_time'] = date('Y-m-d h:i:s', $row['add_time']);
				
				$result[$row['msg_id']] = $row;
			}
			return $result;
		}
		else
		{
			return array();
		}
	
	}
}
?>