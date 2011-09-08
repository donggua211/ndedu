<?php 
class post_model extends base_model
{
	public function __construct()
	{
		parent::__construct();
	}
	function list_site_posts()
	{
		$sql = 'SELECT post_site.*, post.post_title, site.site_name, site.type, block.block_name from '.$this->db->table_name('post_site').' as post_site
				LEFT JOIN '.$this->db->table_name('post').' as post ON post.post_id = post_site.post_id
				LEFT JOIN '.$this->db->table_name('site').' as site ON site.site_id = post_site.site_id
				LEFT JOIN '.$this->db->table_name('site_block').' as block ON block.site_block_id = post_site.block_id';

		return $this->db->query($sql);
	}
	
	function one_site_posts($site_post_id)
	{
		$sql = 'SELECT post_site.*, post.post_title, site.site_name, block.block_name from '.$this->db->table_name('post_site').' as post_site
				LEFT JOIN '.$this->db->table_name('post').' as post ON post.post_id = post_site.post_id
				LEFT JOIN '.$this->db->table_name('site').' as site ON site.site_id = post_site.site_id
				LEFT JOIN '.$this->db->table_name('site_block').' as block ON block.site_block_id = post_site.block_id
				WHERE post_site.post_site_id='.$site_post_id.'
				LIMIT 1';

		return $this->db->query($sql, 'row');
	}
	
	function list_posts()
	{
		$sql = 'SELECT * from '.$this->db->table_name('post');
		return $this->db->query($sql);
	}
	
	function list_post_status($post_site_id)
	{
		$sql = 'SELECT * from '.$this->db->table_name('post_status').'
				WHERE post_site_id='.$post_site_id;
		return $this->db->query($sql);
	}
	
	function add_post($data)
	{
		return $this->add('post', $data);
	}
	
	function add_post_site($data)
	{
		return $this->add('post_site', $data);
	}
	
	function add_post_status($data)
	{
		return $this->add('post_status', $data);
	}
	
	function update_post_site($values, $site_post_id)
	{
		$where = array('post_site_id' => $site_post_id);
		return $this->db->update('post_site', $values, $where);
	}
}
?>