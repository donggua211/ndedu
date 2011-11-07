<?php
class CP_comment_model extends Model {

	function CP_comment_model()
	{
		parent::Model();
	}
	
	function add($comment)
	{
		$data['cat_id'] = $comment['cat_id'];
		$data['name'] = $comment['name'];
		$data['comment'] = $comment['comment'];
		
		$data['status'] = CP_ORDER_STATUS_NEW;
		$data['add_time'] = date('Y-m-d H:i:s');

		if($this->db->insert('cp_comment', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}
	
	function all_comments($filter, $offset = 0, $row_count = 0, $order_by = '', $order = 'ASC')
	{
		$where = '';
		//评论的开始时间
		if (isset($filter['add_time_a']) && $filter['add_time_a'])
        {
            $where .= " AND comment.add_time >= '{$filter['add_time_a']}' ";
        }
		//评论的结束时间
		if (isset($filter['add_time_b']) && $filter['add_time_b'])
        {
            $where .= " AND comment.add_time <= '{$filter['add_time_b']}' ";
        }
		//测评分类
		if (isset($filter['cat_id']) && $filter['cat_id'])
        {
            $where .= " AND comment.cat_id = {$filter['cat_id']} ";
        }
		//是否通过审核.
		if (isset($filter['status']) && $filter['status'])
        {
            $where .= " AND comment.status = {$filter['status']} ";
        }
		
		//card基本信息
		$sql = "SELECT comment.*, cat.cat_name FROM ".$this->db->dbprefix('cp_comment')." as comment
				LEFT JOIN ".$this->db->dbprefix('cp_cat')." as cat ON cat.cat_id = comment.cat_id";
		
		if(!empty($where))
			$sql .= substr_replace($where, ' WHERE ', 0, strpos($where, 'AND') + 3);
		
		//ORDER BY
		if (!empty($order_by))
        {
            $sql .= " ORDER BY $order_by $order ";
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
	
	function all_comments_count($filter)
	{
		$where = '';
		//评论的开始时间
		if (isset($filter['add_time_a']) && $filter['add_time_a'])
        {
            $where .= " AND comment.add_time >= '{$filter['add_time_a']}' ";
        }
		//评论的结束时间
		if (isset($filter['add_time_b']) && $filter['add_time_b'])
        {
            $where .= " AND comment.add_time <= '{$filter['add_time_b']}' ";
        }
		//测评分类
		if (isset($filter['cat_id']) && $filter['cat_id'])
        {
            $where .= " AND comment.cat_id = {$filter['cat_id']} ";
        }
		//是否通过审核.
		if (isset($filter['status']) && $filter['status'])
        {
            $where .= " AND comment.status = {$filter['status']} ";
        }
		
		//card基本信息
		$sql = "SELECT count(DISTINCT comment.comment_id) as total FROM ".$this->db->dbprefix('cp_comment')." as comment";
		
		if(!empty($where))
			$sql .= substr_replace($where, ' WHERE ', 0, strpos($where, 'AND') + 3);
		
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row['total'];
	}
	
	function get_one($comment_id)
	{
		$sql = "SELECT *
				FROM " . $this->db->dbprefix('cp_comment') . "
				WHERE comment_id = $comment_id
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
	function update($comment_id, $update_field = array())
	{
		if(empty($update_field))
			return true;
		
		//更新 comment 表
		foreach($update_field as $key => $val)
		{
				$data[$key] = $val;
		}
		
		$this->db->where('comment_id', $comment_id);
		return $this->db->update('cp_comment', $data);
	}
	
	function delete($comment_id)
	{
		$this->db->where('comment_id', $comment_id);
		$this->db->delete('cp_comment'); 
		return ($this->db->affected_rows() > 0 ) ? TRUE : FALSE;
	}
}
?>
