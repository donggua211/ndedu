<?php
class Stats_model extends Model {

	function Stats_model()
	{
		parent::Model();
	}
		
	function addClick($click)
	{
		$data['field_id'] = $click['field_id'];
		$data['ip'] = $click['ip'];
		$data['date'] = $click['date'];
		
		if($this->db->insert('field_click', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function getAllFields()
	{
		$query = $this->db->get('field');
		if ($query->num_rows() > 0)
		{
			$result = array();
			
			foreach ($query->result_array() as $row)
			{
				$result[$row['id']] = $row['description'];
			}
			return $result;
		}
		else
		{
			return array();
		}
	}
	
	function getStatsByDay($field_id, $day)
	{
		$query = "SELECT count(id) AS num, left(date, 13) AS dates
					FROM `".$this->db->dbprefix('field_click')."`
					WHERE field_id='".$field_id."'
					AND date BETWEEN '".$day." 00:00:00' AND '".$day." 23:59:59'	
						GROUP BY left( date , 13 )
						ORDER BY left( date , 13 )";
		
		$query = $this->db->query($query);
		if ($query->num_rows() > 0)
		{
			$result = array();
			
			foreach ($query->result_array() as $row)
			{
				list(, $row['dates']) = explode(' ', $row['dates']);
				$result[$row['dates']] = $row['num'];
			}
			return $result;
		}
		else
		{
			return array();
		}
	}
	
	function getStats()
	{
		$this->db->join('field', 'field.id= field_click.field_id', 'INNER');
		$query = $this->db->get('field_click');
		if ($query->num_rows() > 0)
		{
			$result = array();
			
			foreach ($query->result_array() as $row)
			{
				$result[$row['field_id']][] = $row;
			}
			return $result;
		}
		else
		{
			return array();
		}
	}
	
	function getKeywordStats()
	{
		$query = $this->db->get('search_keyworks');
		if ($query->num_rows() > 0)
		{
			$result = array();
			
			foreach ($query->result_array() as $row)
			{
				$result[$row['id']] = $row;
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