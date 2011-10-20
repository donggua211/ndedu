<?php
class CRM_Calendar_model extends Model {

	function CRM_Calendar_model()
	{
		parent::Model();
	}
	
	function add($calendar, $staff_id)
	{
		//±ØÌîÏî
		$data['start_time'] = $calendar['start_time'];
		$data['end_time'] = $calendar['end_time'];
		$data['calendar_content'] = $calendar['calendar_content'];
		$data['staff_id'] = $staff_id;
		
		//×´Ì¬×Ö¶Î
		$data['is_delete'] = 0;
		$data['add_time'] = date('Y-m-d H:i:s');
		$data['update_time'] = date('Y-m-d H:i:s');
		if($this->db->insert('crm_calendar', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function get_calendar($staff_id, $first_day, $last_day)
	{
		$sql = "SELECT * FROM ".$this->db->dbprefix('crm_calendar')." as calendar
				WHERE calendar.staff_id = $staff_id
				AND calendar.is_delete = 0
				AND (calendar.start_time <= '$last_day 23:59:59' AND calendar.end_time >= '$first_day 00:00:00')
				ORDER BY calendar.start_time";
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
	
	function get_one_calendar($calendar_id)
	{
		$sql = "SELECT * FROM ".$this->db->dbprefix('crm_calendar')." as calendar
				WHERE calendar.calendar_id = $calendar_id
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
	
	function update($calendar_id, $update_field = array())
	{
		if(empty($update_field))
			return true;
		
		foreach($update_field as $key => $val)
		{
				$data[$key] = $val;
		}
		$data['update_time'] = date('Y-m-d H:i:s');
		
		$this->db->where('calendar_id', $calendar_id);
		if($this->db->update('crm_calendar', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>