<?php
class Article_model extends Model {

	function Article_model()
	{
		parent::Model();
	}

	function getCategoriesList()
	{
		$this->db->select('cat_id, cat_name, parent_id');
		$this->db->from('article_cat');
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			$temp_list['parrent_cat'] = $temp_list['sub_cat'] = $result = array();
			
			foreach ($query->result_array() as $row)
			{	
				if($row['parent_id'] == 0)
				{
					$temp_list['parrent_cat'][$row['cat_id']] = $row;
				}
				else
				{
					$temp_list['sub_cat'][$row['parent_id']][] = $row;
				}
			}
			
			foreach($temp_list['parrent_cat'] as $parrent_id => $parrent_info)
			{
				$result[] = $parrent_info;
				if(isset($temp_list['sub_cat'][$parrent_id]) && !empty($temp_list['sub_cat'][$parrent_id]))
				{
					foreach($temp_list['sub_cat'][$parrent_id] as $sub_cat_id => $sub_cat_info)
					{
						$result[] = $sub_cat_info;
					}
				}
			}
			return $result;
		}
		else
		{
			return array();
		}
	}
	
	function addArticle($article)
	{
		$data['cat_id'] = $article['catagory'];
		$data['title'] = $article['title'];
		$data['content'] = $article['content'];
		$data['keywords'] = $article['keywords'];
		$data['short_description'] = $article['short_description'];
		$data['short_description_img'] = $article['short_description_img'];
		
		$data['image_align'] = $article['image_align'];
		$data['image_url'] = $article['image_url'];
		
		$data['is_open'] = $article['is_open'];
		
		$data['add_time'] = $article['add_time'];
		$data['modified_time'] = $article['add_time'];
		
		if($this->db->insert('article', $data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}

	function addStats($keyword)
	{
		$data['keyword'] = $keyword;
		
		$this->db->select('id');
		$query = $this->db->get_where('search_keyworks', $data, 1);
		
		if ($query->num_rows() > 0)
		{			
			$row = $query->row_array();
			
			$query = "UPDATE `".$this->db->dbprefix('search_keyworks')."` SET `counter` = `counter`+1 WHERE `id` = '".$row['id']."'";
			$this->db->query($query);
		}
		else
		{
			$data['counter'] = 1;
			$this->db->insert('search_keyworks', $data);
		}
		
		

	}
		
	function getArticle($article_stats = 'public')
	{
		if($article_stats == 'public')
		{
			$this->db->where('is_open', '1');
		}
		elseif($article_stats == 'draft')
		{
			$this->db->where('is_open', '0');
		}
		
		$this->db->where( $this->db->dbprefix('article_cat') . '.cat_id = ' . $this->db->dbprefix('article') . '.cat_id');
		
		$this->db->order_by("article.article_id", 'ASC');
		
		$query = $this->db->get('article_cat, article');
		
		if ($query->num_rows() > 0)
		{
			$result = array();
			
			foreach ($query->result_array() as $row)
			{
				$row['add_time'] = date('Y-m-d h:i:s', $row['add_time']);
				$row['modified_time'] = date('Y-m-d h:i:s', $row['modified_time']);
				$result[] = $row;
			}
			return $result;
		}
		else
		{
			return array();
		}
	}
	
	function getOneArticle($article_id)
	{
		$this->db->where( $this->db->dbprefix('article_cat') . '.cat_id = ' . $this->db->dbprefix('article') . '.cat_id');
		$query = $this->db->where( $this->db->dbprefix('article') . '.article_id = "' . $article_id . '"');
		$query = $this->db->get('article_cat, article', 1);

		if ($query->num_rows() > 0)
		{
			$sql = "UPDATE `".$this->db->dbprefix('article')."` SET `count` = `count`+1 WHERE `article_id` = '".$article_id."'";
			$this->db->query($sql);			
			$row = $query->row_array();
			$row['add_time'] = date('Y-m-d', $row['add_time']);
			return $row;
		}
		else
		{
			return false;
		}
	}
	
	function updateArticle($article_id, $article)
	{
		if(!is_array($article)) 
			return false;
		
		if(!is_array($article_id))
			$article_ids[] = $article_id;
		else
			$article_ids = $article_id;
		
		$data['cat_id'] = $article['catagory'];
		$data['title'] = $article['title'];
		$data['content'] = $article['content'];
		$data['keywords'] = $article['keywords'];
		$data['is_open'] = $article['is_open'];
		$data['modified_time'] = $article['modified_time'];
		$data['short_description'] = $article['short_description'];
		$data['short_description_img'] = $article['short_description_img'];

		if(isset($article['image_align'])) $data['image_align'] = $article['image_align'];
		if(isset($article['image_url'])) $data['image_url'] = $article['image_url'];
		
		$this->db->where_in('article_id', $article_ids);
		$result = $this->db->update('article', $data);

		return $result;
	}
	
	function deleteMessage($article_id)
	{
		if(!is_array($article_id))
			$article_ids[] = $article_id;
		else
			$article_ids = $article_id;
		
		$this->db->where_in('article_id', $article_ids);
		$result = $this->db->delete('article');
		return $result;
	}
	
	function searchArticle($keyword)
	{
		if(empty($keyword))
		{
			return $this->getArticle('all');
		}
		else
		{
			$this->db->like('title', $keyword); 
			$this->db->or_like('content', $keyword); 
			$this->db->or_like('keywords', $keyword); 

			$this->db->join('article_cat', 'article_cat.cat_id= article.cat_id', 'INNER');

			$query = $this->db->get('article');
			if ($query->num_rows() > 0)
			{
				$result = array();
				
				foreach ($query->result_array() as $row)
				{
					$row['add_time'] = date('Y-m-d', $row['add_time']);
					$row['modified_time'] = date('Y-m-d', $row['modified_time']);
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
	
	function getArticleByCat($cat, $order_by='time', $limit = 0, $offset = 0, $time_formate = 'Y-m-d')
	{

		$this->db->where('is_open', '1');		
		$this->db->where('cat_id', $cat);	
		$this->db->select('article_id, title, add_time, count, content');
		
		if($order_by == 'time')	
			$this->db->order_by("add_time", 'DESC');
		elseif($order_by == 'count')	
			$this->db->order_by("count", 'DESC');
		
		if($limit > 0)
			$this->db->limit($limit, $offset);
		
		$query = $this->db->get('article');
		if ($query->num_rows() > 0)
		{
			$result = array();
			
			foreach ($query->result_array() as $row)
			{
				$row['add_time'] = date($time_formate, $row['add_time']);
				$result[] = $row;
			}
			return $result;
		}
		else
		{
			return array();
		}
	}
	
	function getArticleByCatTag($cat, $tags, $order_by='time', $limit = 0, $offset = 0)
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
		elseif($order_by == 'time')	
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
				$result[] = $row;
			}
			return $result;
		}
		else
		{
			return array();
		}
	}
	
	function getTotleArticleNumByCat($cat)
	{
		$this->db->where('is_open', '1');		
		$this->db->where('cat_id', $cat);	
		return $this->db->count_all_results('article');
		
	}
	function getTotleArticleNumByCatTag($cat, $tags)
	{	
		$sql = "SELECT DISTINCT ndedu_article.*
				FROM `ndedu_article`, `ndedu_tag_article` as a, `ndedu_tag_article` as b
				WHERE `cat_id` = '$cat'
				AND ndedu_article.article_id = a.article_id
				AND a.article_id = b.article_id 
				AND rank=99 ";
		
		list($left_tag, $right_tag) = explode('-', $tags);
		if( $left_tag != 0 )
			$sql .= ' AND a.tag_id ='.$left_tag;
		if( $right_tag != 0 )
			$sql .= ' AND b.tag_id ='.$right_tag;
		
		$query = $this->db->query($sql);
		return $query->num_rows();
		
	}
	
	function getRecommandArticle($cat_id, $limit = 0, $offset = 0, $time_formate = 'Y-m-d')
	{
		$this->db->where('is_open', '1');		
		$this->db->where('cat_id', $cat_id);	
		$this->db->where('rank <', 99);	
		$this->db->select('article_id, title, add_time');
		$this->db->order_by("rank", 'ASC');
		
		if($limit > 0)
			$this->db->limit($limit, $offset);
		
		$query = $this->db->get('article');
		if ($query->num_rows() > 0)
		{
			$result = array();
			
			foreach ($query->result_array() as $row)
			{
				$row['add_time'] = date($time_formate, $row['add_time']);
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