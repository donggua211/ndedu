<?php
class Test_model extends Model {

	function Test_model()
	{
		parent::Model();
	}
	
	function getArticleByCatTag($cat, $tags)
	{
		$sql = "SELECT DISTINCT ndedu_article.`article_id`, `title`, `add_time`, `count`, `rank`
				FROM `ndedu_article`, `ndedu_tag_article` as a, `ndedu_tag_article` as b
				WHERE `is_open` = '1'
				AND `cat_id` = '$cat'
				AND ndedu_article.article_id = a.article_id
				AND a.article_id = b.article_id
				AND rank=99 ";
		
		list($left_tag, $right_tag) = explode('-', $tags);
		if( $left_tag != 0 )
			$sql .= ' AND a.tag_id ='.$left_tag;
		if( $right_tag != 0 )
			$sql .= ' AND b.tag_id ='.$right_tag;

		$sql .= " ORDER BY `rank` ASC, `add_time` DESC ";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$result = array();
			
			foreach ($query->result_array() as $row)
			{
				$row['add_time'] = date('Y-m-d', $row['add_time']);
				$result[] = $row;
			}
			return $result;
		}
		else
		{
			return array();
		}
	}
	
	function getArticleByCatTag2($cat, $tags)
	{
		list($left_tag, $right_tag) = explode('-', $tags);
		if( $left_tag != 0 )
			$sql = ' AND a.tag_id ='.$left_tag;
		if( $right_tag != 0 )
			$sql = ' AND b.tag_id ='.$right_tag;
		
		$sql = "SELECT ndedu_article.`article_id`, `title`, `add_time`, `count`, `rank`
				FROM ndedu_article,
					(SELECT R1.article_id from 
						(select tag_id,article_id from ndedu_tag_article AS T1 WHERE T1.tag_id = 1) AS R1,
						(select tag_id,article_id from ndedu_tag_article AS T2 WHERE T2.tag_id = 2) AS R2 
					WHERE R1.article_id = R2.article_id) AS R3
				WHERE ndedu_article.article_id = R3.article_id
				AND ndedu_article.`cat_id` = '$cat'
				GROUP BY ndedu_article.article_id,ndedu_article.title
				ORDER BY `rank` ASC, `add_time` DESC ";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$result = array();
			
			foreach ($query->result_array() as $row)
			{
				$row['add_time'] = date('Y-m-d', $row['add_time']);
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