<?php
class CRM_Ticket_model extends Model {

	function CRM_Ticket_model()
	{
		parent::Model();
	}
	
	function getAll($filter, $offset = 0, $row_count = 0, $order_by = '', $order = 'ASC')
	{
		//student基本信息
		$sql = "SELECT ticket.*, staff.name FROM ".$this->db->dbprefix('crm_ticket')." as ticket 
				LEFT JOIN ".$this->db->dbprefix('crm_staff')." as staff ON ticket.staff_id = staff.staff_id";
		
		//order by
		if (!empty($order_by))
        {
            $sql .= " ORDER BY $order_by $order";
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
		//student基本信息
		$sql = "SELECT COUNT(ticket.ticket_id) as total FROM ".$this->db->dbprefix('crm_ticket')." as ticket ";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row['total'];
	}
	
	
	function getOne($ticket_id)
	{
		//staff基本信息
		$sql = "SELECT ticket.*, staff.name FROM ".$this->db->dbprefix('crm_ticket')." as ticket 
				LEFT JOIN ".$this->db->dbprefix('crm_staff')." as staff ON ticket.staff_id = staff.staff_id
				WHERE ticket_id = $ticket_id";
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
	
	function add($new_ticket)
	{
		//必填信息.
		$data['ticket_title'] = $new_ticket['ticket_title'];
		$data['ticket_content'] = $new_ticket['ticket_content'];
		$data['staff_id'] = $new_ticket['staff_id'];
		
		//选填信息.
		$data['add_time'] = date('Y-m-d H:i:s');
		$data['update_time'] = date('Y-m-d H:i:s');
		
		if($this->db->insert('crm_ticket', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function update($ticket_id, $update_field = array())
	{
		if(empty($update_field))
			return true;
		
		//更新student表
		foreach($update_field as $key => $val)
		{
				$data[$key] = $val;
		}
		$data['update_time'] = date('Y-m-d H:i:s');
		
		$this->db->where('ticket_id', $ticket_id);
		return $this->db->update('crm_ticket', $data);
	}
	
	function delete($ticket_id)
	{
		$this->db->where('ticket_id', $ticket_id);
		$this->db->delete('crm_ticket'); 
		return ($this->db->affected_rows() > 0 ) ? TRUE : FALSE;
	}
}
?>