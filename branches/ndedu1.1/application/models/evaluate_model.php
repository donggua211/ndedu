<?php
class Evaluate_model extends Model {

	function Evaluate_model()
	{
		parent::Model();
	}
	
	function getAllEvaluate()
	{
		$this->db->select('evaluate_id, cat_id, name, type');
		$query = $this->db->get('evaluate');
		
		if ($query->num_rows() > 0)
		{
			$result = array();
			
			foreach ($query->result_array() as $row)
			{
				$result[$row['cat_id']][] = $row;
			}
			return $result;
		}
		else
		{
			return array();
		}
	}
	
	function getOneEvaluate($evaluate_id)
	{
		$query = $this->db->where('evaluate_id', $evaluate_id);
		$query = $this->db->get('evaluate', 1);

		if ($query->num_rows() > 0)
		{		
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}
	
	function getAllEvaluateCat()
	{
		$this->db->select('cat_id, name');
		$query = $this->db->get('evaluate_cat');
		
		if ($query->num_rows() > 0)
		{
			$result = array();
			
			foreach ($query->result_array() as $row)
			{
				$result[$row['cat_id']] = $row['name'];
			}
			return $result;
		}
		else
		{
			return array();
		}
	}
	
	function addEvaluateResult($evaluate_result)
	{
		$data['evaluate_id'] = $evaluate_result['evaluate_id'];
		$data['user_id'] = $evaluate_result['user_id'];
		$data['answer'] = $evaluate_result['answer'];
		$data['begin_time'] = $evaluate_result['begin_time'];
		$data['end_time'] = $evaluate_result['end_time'];
						
		if($this->db->insert('evaluate_result', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}
	
	function getMyEvaluatelist($user_id)
	{
		$sql = 'SELECT t1.result_id, t1.begin_time, t2.evaluate_id, t2.name
				FROM '.$this->db->dbprefix('evaluate_result').' AS t1, '.$this->db->dbprefix('evaluate').' as t2
				WHERE t1.evaluate_id = t2.evaluate_id
				AND t1.user_id='.$user_id.'
				ORDER BY t1.begin_time';
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$result = array();
			
			foreach ($query->result_array() as $row)
			{
				$result[] = $row;
			}
			return $result;
		}
		else
		{
			return array();
		}
	}
	
	function getMyEvaluate($result_id)
	{
		$sql = 'SELECT t1.evaluate_id, t1.begin_time, t1.end_time, t1.answer, t2.type, t2.name
				FROM '.$this->db->dbprefix('evaluate_result').' AS t1, '.$this->db->dbprefix('evaluate').' as t2
				WHERE t1.result_id = '.$result_id.'
				LIMIT 1';
		$query = $this->db->query($sql);			
		$row = $query->row_array();
		return $row;
	}
}
?>