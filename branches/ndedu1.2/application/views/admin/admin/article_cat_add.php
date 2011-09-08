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
	<a href="<?php echo site_url().'/admin/entry/info'?>">admin</a> &nbsp;»&nbsp; <a href="<?php echo site_url().'/admin/articleCat/index'?>">分类管理</a> &nbsp;»&nbsp; 添加分类
</div>
<div>
	<span style="color:#FF0000;font-size:20px">添加分类</span>
	<form action="<?php echo site_url().'/admin/articleCat/add'?>" method="post">
		分类名称: <input id="name" name="name" type="text" value="" />&nbsp;*<br/>
		分类描述: <input id="description" name="description" type="text" value="" />&nbsp;*<br/>
		<input type="radio" id="type" name="type" value="super" />添加新的大分类 &nbsp;*<br/>
		<?php
			if(isset($parrent_cat) && is_array($parrent_cat)):
		?>
		<input type="radio" id="type" name="type" value="sub" />添加新的子分类 &nbsp;* <br/>
		<select name="parent">
			<?php
				foreach($catetories['parrent_cat'] as $parrent_id => $parrent_cat):
			?>
			<option value="<?php echo $parrent_id ?>"><?php echo $parrent_cat['cat_name'] ?></option>
			<?php
				endforeach;
			?>
		</select><br/>
		<?php
			endif;
		?>

		<input type="submit" value="添加分类" name="submit"><br/>
		<input type="reset" value="重写" name="reset"><br/>
	</form>
</div>

</body>
</html>