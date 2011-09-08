<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<base href="<?php echo base_url() ?>" />
	<link href="css/admin/admin.css" rel="stylesheet" type="text/css" />
	<title>administrator's control panel</title>
</head>
<body>

<div id="navigation" class="navigation">
	<a href="<?php echo site_url().'/admin/entry/info'?>">admin</a> &nbsp;»&nbsp; <a href="<?php echo site_url().'/admin/article/index'?>">文章管理</a> &nbsp;»&nbsp; 
	<?php
		if($article['is_open'] == '1')
			echo '<a href="'.site_url().'/admin/article">查看文章</a>';
		else
			echo '<a href="'.site_url().'/admin/draft">草稿箱</a>';
	?>
</div>
<div>
	<div align="center"><h1><?php echo $article['title'] ?></h3></div>
<?php
	if(!empty($article['image_url']) && ($article['image_align'] == 'left'|| $article['image_align'] == 'right')):
?>
	<div style="float:<?php echo $article['image_align'] ?>"><img src="<?php echo base_url().'/images/uploads/'.$article['image_url'] ?>" alt=""></div>
<?php
	elseif(!empty($article['image_url']) && $article['image_align'] == 'above'):
?>
	<div><img src="<?php echo base_url().'/images/uploads/'.$article['image_url'] ?>" alt=""></div>
<?php
	endif;
?>
	<div><?php echo $article['content'] ?></div>
	<div style="text-align:left;clear:both">关键字: <?php echo $article['keywords'] ?></h6></div>
	<div style="text-align:left">类别: <?php echo $article['cat_name'] ?></h6></div>
</div>
</body>
</html>