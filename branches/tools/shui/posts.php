<?php
require_once 'includes/header.php'; 
require_once 'includes/model.post.php';

$post_model = new post_model();
$posts = $post_model->list_site_posts();

//整形 posts
$post_arr = array();
foreach ($posts as $val)
{
	if( !isset($post_arr[$val['site_id']]['site_name']))
	{
		$post_arr[$val['site_id']]['site_name'] = $val['site_name'];
		$post_arr[$val['site_id']]['type'] = $val['type'];
	}
	
	if(empty($val['block_id']))
		$post_arr[$val['site_id']]['post'][] = $val;
	else
	{
		if( !isset($post_arr[$val['site_id']]['block'][$val['block_id']]['block_name']))
		{
			$post_arr[$val['site_id']]['block'][$val['block_id']]['block_name'] = $val['block_name'];
		}
		$post_arr[$val['site_id']]['block'][$val['block_id']]['post'][] = $val;
	}
	
	//排序
	ksort($post_arr);
}

$smarty->assign('POST_SITE_STATUS_AVAILABLE', POST_SITE_STATUS_AVAILABLE);

$smarty->assign('title', 'posts 列表');
$smarty->assign('posts', $post_arr);
$smarty->display('posts.tpl');
?>



