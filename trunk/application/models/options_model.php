<?php
class Options_model extends Model {

	function Options_model()
	{
		parent::Model();
	}
	
	function getOption($option_name)
	{
		$this->db->select('option_value');
		$query = $this->db->get_where('options', array('option_name' => $option_name), 1);
		if ($query->num_rows() > 0)
		{
			$result = $query->row_array();
			return $result['option_value'];
		}
		else
		{
			return false;
		}
	}
	
	function getOptions($option_names)
	{
		$this->db->select('option_name, option_value');
		
		$i = 1;
		foreach($option_names as $option_name)
		{
			if($i == 1)
				$this->db->where('option_name', $option_name);
			else
				$this->db->or_where('option_name', $option_name);
				
			$i++;
		}
		
		$query = $this->db->get('options');

		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$result[$row['option_name']] = $row['option_value'];
			}
			return $result;
		}
		else
		{
			return array();
		}
	}
	
	function updateOption($option_name, $option_value)
	{
		$this->db->where('option_name', $option_name);
		$result = $this->db->update('options', array('option_value' => $option_value));
		return $result;
	}
}
?>