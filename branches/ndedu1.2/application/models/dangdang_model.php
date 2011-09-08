<?php
class Dangdang_model extends Model {

	function Dangdang_model()
	{
		parent::Model();
	}
	
	function addDangdang($product_info)
	{
		$data['pid'] = $product_info['bookid'];
		$data['cat_id'] = $product_info['cat'];
		$data['product_name'] = $product_info['name'];
		$data['author'] = empty($product_info['author'])?'':$product_info['author'];
		$data['add_time'] = time();
		$data['count'] = 0;
				
		if($this->db->insert('dangdang', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	
	}
	function addCount($pid)
	{
		$sql = "UPDATE `".$this->db->dbprefix('dangdang')."` SET `count` = `count`+1 WHERE `pid` = '".$pid."'";
		$this->db->query($sql);		
	}
	
	function getDangdangByCatTag($cat, $tags, $order_by='time', $limit = 0, $offset = 0)
	{
		$sql = "SELECT DISTINCT ndedu_dangdang.*
				FROM `ndedu_dangdang`, `ndedu_tag_dangdang` as a, `ndedu_tag_dangdang` as b
				WHERE `cat_id` = '$cat'
				AND ndedu_dangdang.pid = a.dangdang_pid
				AND a.dangdang_pid = b.dangdang_pid
				AND rank=99  ";
		
		list($left_tag, $right_tag) = explode('-', $tags);
		if( $left_tag != 0 )
			$sql .= ' AND a.tag_id ='.$left_tag;
		if( $right_tag != 0 )
			$sql .= ' AND b.tag_id ='.$right_tag;
		/*
		if($left_tag != 0 || $right_tag != 0) {
			$tag = '';
			if( $left_tag != 0 )
				$tag .= $left_tag.','; 
			if( $right_tag != 0 )
				$tag .= $right_tag.',';
			
			$sql .= ' AND ndedu_tag_article.tag_id in ('.trim($tag, ',').')';
		}
		*/
		if($order_by == 'rank')
			$sql .= " ORDER BY `rank` ASC, `add_time` DESC ";
		if($order_by == 'time')
			$sql .= " ORDER BY `add_time` DESC ";
		elseif($order_by == 'count')
			$sql .= " ORDER BY `count` DESC ";
		
		if($limit > 0)
			$sql .= " LIMIT $offset, $limit";					
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$result = array();
			
			foreach ($query->result_array() as $row)
			{
				$row['add_time'] = date('Y-m-d', $row['add_time']);
				$row['image_url'] = $this->get_imageurl($row['pid'],'p');
				$result[] = $row;
			}
			return $result;
		}
		else
		{
			return array();
		}
	}
	
	function getTotleDangdangNumByCat($cat, $tags)
	{	
		$sql = "SELECT DISTINCT ndedu_dangdang.*
				FROM `ndedu_dangdang`, `ndedu_tag_dangdang` as a, `ndedu_tag_dangdang` as b
				WHERE `cat_id` = '$cat'
				AND ndedu_dangdang.pid = a.dangdang_pid
				AND a.dangdang_pid = b.dangdang_pid
				AND rank=99 ";
		
		list($left_tag, $right_tag) = explode('-', $tags);
		if( $left_tag != 0 )
			$sql .= ' AND a.tag_id ='.$left_tag;
		if( $right_tag != 0 )
			$sql .= ' AND b.tag_id ='.$right_tag;
		
		$query = $this->db->query($sql);
		return $query->num_rows();
		
	}
	function get_imageurl( $pid, $size_id )
	{
		//$size : { '出版品(图书+音像)' : {54x54=>x; 70x70=>s; 90x90=>m; 200x200=>b; 原图=>o}, 
		//          '百货'              : {54x54=>x; 100x100=>s; 120x120=>m; 150x150=>l; 200x200=>b, 原图=>o},
		//          '虚拟商品'          : {90x90=>m; 200x200=>b}
		//        }
		$size_array = array( 'x', 'p', 'l' );
		$size_id = in_array( $size_id, $size_array ) ? $size_id : 'x';	//默认给小图
		return "http://img3".($pid%10).".dangdang.com/".($pid%99)."/".($pid%37)."/{$pid}-1_{$size_id}.jpg";

	}
	
	function getRecommandDangdang($cat_id, $limit = 0, $offset = 0, $time_formate = 'Y-m-d')
	{	
		$this->db->where('cat_id', $cat_id);	
		$this->db->where('rank <', 99);	
		$this->db->select('pid, product_name, author, add_time');
		$this->db->order_by("rank", 'ASC');
		
		if($limit > 0)
			$this->db->limit($limit, $offset);
		
		$query = $this->db->get('dangdang');
		if ($query->num_rows() > 0)
		{
			$result = array();
			
			foreach ($query->result_array() as $row)
			{
				$row['add_time'] = date($time_formate, $row['add_time']);
				$row['image_url'] = $this->get_imageurl($row['pid'],'p');
				$result[] = $row;
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