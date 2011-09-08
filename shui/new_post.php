<?php
require_once 'includes/header.php'; 
require_once 'includes/model.post.php';
$post_model = new post_model();
	
if(isset($_POST) && !empty($_POST))
{	
	$type = isset($_POST['type']) ? $_POST['type'] : 'bbs';
	
	//添加post
	$post_id = $_POST['post_id'];
	
	if($post_id <= 0)
	{
		$post['post_title'] = trim($_POST['post_title']);
		$post['status'] = 1;
		$post['add_time'] = date('Y-m-d H:i:s');
		$post_id = $post_model->add_post($post);
		
		if(empty($post_id))
			show_result('post 添加失败', 'new_post.php?type='.$type, 'error');
	}
	
	//添加到 post site
	$result = '';
	$site_post = $_POST['site_post'];
	foreach ($site_post as $val)
	{
		$post_site['post_id'] = $post_id;
		$post_site['site_id'] = $val['site_id'];
		$post_site['block_id'] = $val['block_id'];
		$post_site['post_url'] = trim($val['post_url']);
		$post_site['status'] = 1;
		$post_site['add_time'] = date('Y-m-d H:i:s');
		
		$result .= 'site_id: '.$val['site_id'].' ';
		$result .= empty($post_site['post_url']) ? '<span class="color_y">跳过添加</span>' : (($post_model->add_post_site($post_site)) ? '<span class="color_g">添加成功</span>' : '<span class="color_r">添加失败</span>');
		$result .= '<br/><br/>';
	}
	
	show_result($result, 'posts.php');
}
else
{
	require_once 'includes/model.site.php';
	$site_model = new site_model();
	
	$type = isset($_GET['type']) ? $_GET['type'] : 'bbs';
	
	//获取所有站点
	$sites = $site_model->list_site($type);
	
	//如果是bbs, 载入block
	if($type == 'bbs')
	{
		$smarty->assign('blocks', $site_model->list_block(array_keys($sites)));
	}
	
	$smarty->assign('posts', $post_model->list_posts());
	$smarty->assign('sites', $sites);
	$smarty->assign('type', $type);
	$template = 'new_post.tpl';	
}

$smarty->assign('title', '新帖子');
$smarty->display($template);
?>