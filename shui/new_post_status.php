<?php
require_once 'includes/header.php'; 
require_once 'includes/model.post.php';
$post_model = new post_model();
	
if(isset($_POST) && !empty($_POST))
{	
	$post_status['post_site_id'] = $_POST['post_site_id'];
	$post_status['view_num'] = trim($_POST['view_num']);
	$post_status['reply_num'] = trim($_POST['reply_num']);
	$post_status['add_time'] = date('Y-m-d H:i:s');
	
	if($post_model->add_post_status($post_status))
	{
		show_result('新记录发表成功!', 'posts.php', 'result');
	}
	else 
	{
		show_result('新记录发表失败!', 'posts.php', 'error');
	}
	
}
else
{
	$post_id = isset($_GET['post']) ? $_GET['post'] : 0;
		
	//获取所有站点
	$post_site_info = $post_model->one_site_posts($post_id);
	
	//如果是bbs, 载入block
	if(empty($post_site_info))
	{
		show_result('post 不存在', 'posts.php', 'error');
	}
	
	$smarty->assign('post_site_info', $post_site_info);
	$template = 'new_post_status.tpl';	
}

$smarty->assign('title', '新记录');
$smarty->display($template);
?>