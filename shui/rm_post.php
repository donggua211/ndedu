<?php
require_once 'includes/header.php'; 
require_once 'includes/model.post.php';
$post_model = new post_model();


$site_post_id = isset($_GET['post']) ? $_GET['post'] : 0;
		
//获取所有站点
$post_site_info = $post_model->one_site_posts($site_post_id);

if(empty($post_site_info))
{
	show_result('帖子不存在!', 'posts.php', 'error');
}

$data['status'] = POST_SITE_STATUS_RM;


if($post_model->update_post_site($data, $site_post_id))
{
	show_result('post删除成功!', 'posts.php', 'result');
}
else 
{
	show_result('post删除失败!', 'posts.php', 'error');
}
?>