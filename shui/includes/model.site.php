<?php 
class site_model extends base_model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	function list_site($type='')
	{
		$sql = 'SELECT * from '.$this->db->table_name('site');
		
		if(!empty($type))
			$sql .= " WHERE type='".$type."'";
		
		$temp = $this->db->query($sql);
		
		$result = array();
		foreach($temp as $row)
		{
			if(empty($type))
				$result[$row['type']][$row['site_id']] = $row;
			else
				$result[$row['site_id']] = $row;
		}
		return $result;
	}
	
	function one_site($site_id)
	{
		$sql = 'SELECT * from '.$this->db->table_name('site').'
				WHERE site_id = '.$site_id.'
				LIMIT 1';

		return $this->db->query($sql, 'row');
	}
	
	function list_block($site_arr = array())
	{
		$sql = 'SELECT * from '.$this->db->table_name('site_block');
		if(!empty($type))
			$sql .= " WHERE site_id IN (".implode(',',$site_arr).")";
		
		$temp = $this->db->query($sql);
		$result = array();
		foreach($temp as $row)
		{
			$result[$row['site_id']][$row['site_block_id']] = $row;
		}
		return $result;
	}
}


?>