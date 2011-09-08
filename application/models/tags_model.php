<?php
class Tags_model extends Model {

	function Tags_model()
	{
		parent::Model();
	}

	function getAllTags()
	{
		$this->db->select('tag_id, tag_name');
		$this->db->from('tags');
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
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
	
	function addArtileTag($article_id, $tags){
		if(!$tags)
		{
			return false;
		}
		$sql = 'INSERT INTO '.$this->db->dbprefix('tag_article').' (tag_id, article_id) VALUES ';
		foreach( $tags as $tag ) 
		{
			$sql .=' ("'.$tag.'", "'.$article_id.'"),';
		}
		$sql = trim($sql, ',');
		$this->db->query($sql);
	}
	
	function addDangdangTag($dangdang_id, $tags){
		if(!$tags)
		{
			return false;
		}
		$sql = 'INSERT INTO '.$this->db->dbprefix('tag_dangdang').' (tag_id, dangdang_pid) VALUES ';
		foreach( $tags as $tag ) 
		{
			$sql .=' ("'.$tag.'", "'.$dangdang_id.'"),';
		}
		$sql = trim($sql, ',');
		$this->db->query($sql);
	}
	
	function addTag($tag){
		$data['tag_name'] = $tag['tag_name'];
		$data['add_time'] = $tag['add_time'];
		$data['is_deleted'] = 0;
		
		if($this->db->insert('tags', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function getNumByTags($cat_id, $table)
	{
		$sql = "SELECT tag_id, count(*) as num
				FROM ".$this->db->dbprefix('tag_'.$table)." AS tag, ".$this->db->dbprefix($table)." AS a
				WHERE  a.cat_id =$cat_id
				AND rank=99 ";
		if($table == 'dangdang')
			$sql .= "AND tag.dangdang_pid = a.pid";
		elseif($table == 'article')
			$sql .= "AND tag.article_id = a.article_id";
		$sql .=	" GROUP BY tag_id ";
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{	
				$result[$row['tag_id']] = $row['num'];
			}
			return $result;
		}
		else
		{
			return array();
		}
	}
	
	function update($tag_id, $update_field)
	{
		if(empty($update_field))
			return true;
		
		//更新student表
		foreach($update_field as $key => $val)
		{
				$data[$key] = $val;
		}
		
		$this->db->where('tag_id', $tag_id);
		return $this->db->update('tags', $data);
	}
	
	function delete($tag_id)
	{
		$this->db->where('tag_id', $tag_id);
		$this->db->delete('tags'); 
		return ($this->db->affected_rows() > 0 ) ? TRUE : FALSE;
	}
	
	function get_one($tag_id)
	{
		$query = $this->db->get_where('tags', array('tag_id ' => $tag_id));
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}
}
?>