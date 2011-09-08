<?php 
class db
{
	var $username;
	var $password;
	var $hostname;
	var $database;
	var $dbprefix		= 'shui';
	var $char_set		= 'utf8';
	var $dbcollat		= 'utf8_general_ci';
	var $conn_id		= false;
	var $result_id		= false;
	
	public function __construct()
	{
		global $db_config;
		$this->hostname = $db_config['hostname'];
		$this->username = $db_config['username'];
		$this->password = $db_config['password'];
		$this->database = $db_config['database'];
		$this->dbprefix = $db_config['dbprefix'].'_';
		
		//连接数据库
		$this->conn_id = $this->db_connect();
		
		if($this->conn_id === false)
			die('Can not Connct to DB');
			
		//选择数据库
		if($this->db_select() === false)
			die('Can not select DB');
		
		//设置 charset
		if($this->db_set_charset($this->char_set, $this->dbcollat) === false)
			die('Can not select DB');
	}
	
	function db_connect()
	{
		return @mysql_connect($this->hostname, $this->username, $this->password, TRUE);
	}
	
	function db_select()
	{
		return @mysql_select_db($this->database, $this->conn_id);
	}

	function db_set_charset($charset, $collation)
	{
		return @mysql_query("SET NAMES '".$this->escape_str($charset)."' COLLATE '".$this->escape_str($collation)."'", $this->conn_id);
	}
	
	function _execute($sql)
	{
		return @mysql_query($sql, $this->conn_id);
	}
	
	function simple_query($sql)
	{
		if ( ! $this->conn_id)
		{
			$this->__construct();
		}

		return $this->_execute($sql);
	}
	
	//result type: array, row.
	function query($sql, $result = 'array')
	{
		if ($sql == '')
		{
			return FALSE;
		}
		
		//escape sql query
		$sql = $this->escape_str($sql);
		
		// Run the Query
		if (FALSE === ($this->result_id = $this->simple_query($sql)))
		{
			die('Failed to exec sql: '.$sql);
			return FALSE;
		}
		
		$result_array = array();
		if($this->affected_rows() > 0)
		{
			switch($result)
			{
				case 'array':
					while(($row = $this->_fetch_assoc()) != false )
					{
						$result_array[] = $row;
					}
					break;
				case 'row':
					$result_array = $this->_fetch_assoc();
					break;
				case 'none':
					$result_array = true;
					break;
			}
		}
		
		return $result_array;
		
	}

	function insert($table, $data)
	{
		$sql = 'INSERT INTO  '.$this->table_name($table).' SET ';
		
		foreach($data as $key => $val)
			$sql .= $key.' = "'.$val.'", ';
		
		$sql = trim($sql, ', ');
		
		$this->query($sql, 'none');
		
		return $this->insert_id();
		
	}

	function update($table, $values, $where = '')
	{
		foreach ($values as $key => $val)
		{
			$valstr[] = $key . ' = "' . $val. '"';
		}

		$sql = 'UPDATE '.$this->table_name($table).' SET '.implode(', ', $valstr);

		if($where != '' AND count($where) >=1)
		{
			foreach ($where as $key => $val)
			{
				$wherestr[] = $key . ' = "' . $val. '"';
			}
			
			$sql .= " WHERE ".implode(" ", $wherestr);
		}
		
		$this->query($sql, 'none');
		return $this->affected_rows() > 0 ? TRUE : FALSE;
	}

	function _fetch_assoc()
	{
		return mysql_fetch_assoc($this->result_id);
	}
	
	function escape_str($str)
	{	
		if (is_array($str))
		{
			foreach($str as $key => $val)
	   		{
				$str[$key] = $this->escape_str($val);
	   		}
   		
	   		return $str;
	   	}

		
				
		return $str;
	}
	
	function affected_rows()
	{
		return @mysql_affected_rows($this->conn_id);
	}
	
	function insert_id()
	{
		return @mysql_insert_id($this->conn_id);
	}
	
	function table_name($table)
	{
		return $this->dbprefix.$table;
	}
}


?>