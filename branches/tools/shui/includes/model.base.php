<?php 
class base_model
{
	var $db;
	
	public function __construct()
	{
		global $db;
		$this->db = $db;
	}
	
	function add($table, $data)
	{
		return $this->db->insert($table, $data);
	}
}


?>