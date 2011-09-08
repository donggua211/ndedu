<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<base href="<?php echo base_url() ?>" />
	<link href="images/admin.css" rel="stylesheet" type="text/css" />
	<title>administrator's control panel</title>
</head>
<body>
<?php

	$CI =& get_instance();
	$page = $CI->uri->segment(3);
	if ($page === FALSE || !in_array($page, array('inbox', 'draft', 'search')))
	{
		$page = 'inbox';
	}
?>
<div id="navigation" class="navigation">
	<a href="<?php echo site_url().'/admin/entry/info'?>">admin</a> &nbsp;»&nbsp; <a href="<?php echo site_url().'/admin/article/index'?>">文章管理</a> &nbsp;»&nbsp; 
	<?php
		if($page == 'inbox')
			echo '查看文章';
		elseif($page == 'draft')
			echo '草稿箱';
		elseif($page == 'search')
			echo '搜索';
	?>
</div>
<?php
if(!empty($articles)):
?>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr align="center" bgcolor="#FF6600">
		<td>ID</td>
		<td>标题</td>
		<td>分类</td>
		<td>添加时间</td>
		<td>最后修改时间</td>
		<td>管理</td>
	</tr>
<?php
	foreach($articles as $article_id => $article_info):
?>
	<tr align="center">
		<td><?php echo $article_info['article_id']?></td>
		<td align="left"><a href="<?php echo site_url().'/article/'.$article_info['article_id'] ?>"><span style="color:blue;text-decoration:underline"><?php echo $article_info['title']?></font></a></td>
		<td align="left"><?php echo $article_info['cat_name']?></td>
		<td><?php echo $article_info['add_time']?></td>
		<td><?php echo $article_info['modified_time']?></td>
		<td>
			<a href="<?php echo site_url().'/admin/article/edit/'.$article_info['article_id'] ?>">编辑</a> / 
			<a href="<?php echo site_url().'/admin/article/delete/'.$article_info['article_id'] ?>">删除</a>
		</td>
	</tr>
<?php
	endforeach;
?>
</table>
<?php
else:
	if($page == 'inbox')
		echo '<span style="color:red; font-size:25px">还没有文章，请先添加文章: <a href="'.site_url().'/admin/article/add">添加文章</a></span>';
	elseif($page == 'draft')
		echo '<span style="color:red; font-size:25px">暂没有草稿</span>';
	

endif;
?>
</body>
</html>