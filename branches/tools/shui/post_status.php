<?php
require_once 'includes/header.php'; 
require_once 'includes/model.post.php';

$post_model = new post_model();

$post_id = isset($_GET['post']) ? $_GET['post'] : 0;

//获取所有站点
$post_site_info = $post_model->one_site_posts($post_id);

//如果是bbs, 载入block
if(empty($post_site_info))
{
	show_result('post 不存在', 'posts.php', 'error');
}

$smarty->assign('title', 'posts 列表');
$smarty->assign('post_site_info', $post_site_info);
$smarty->assign('post_status', $post_model->list_post_status($post_id));
$smarty->display('post_status.tpl');
?>



