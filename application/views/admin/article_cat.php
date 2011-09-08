<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<base href="<?php echo base_url() ?>" />
	<link href="images/admin.css" rel="stylesheet" type="text/css" />
	<title>administrator's control panel</title>
</head>
<body>
<div id="navigation" class="navigation">
	<a href="<?php echo site_url().'/admin/entry/info'?>">admin</a> &nbsp;»&nbsp; 分类管理
</div>

<?php 
	if(!empty($notification))
	{
?>
		<div>
			<b><?php echo get_language('article_category', 'cn', $notification) ?></b>
		</div>
<?php
	}

if(isset($catetories['parrent_cat']) && is_array($catetories['parrent_cat'])):
?>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr align="center" bgcolor="#FF6600">
		<td>ID</td>
		<td>分类</td>
		<td>描述</td>
		<td>添加时间</td>
		<td>最后修改时间</td>
		<td>管理</td>
	</tr>
<?php
	foreach($catetories['parrent_cat'] as $parrent_id => $parrent_cat):
?>
	<tr align="center" bgcolor="#0099FF">
		<td><?php echo $parrent_cat['cat_id']?></td>
		<td align="left"><?php echo $parrent_cat['cat_name']?></td>
		<td align="left"><?php echo $parrent_cat['cat_desc']?></td>
		<td><?php echo $parrent_cat['add_time']?></td>
		<td><?php echo $parrent_cat['modified_time']?></td>
		<td>
			<a href="<?php echo site_url().'/admin/articleCat/edit/'.$parrent_cat['cat_id'] ?>">编辑</a> / 
			<?php 
				if($parrent_cat['is_deleted'] == 1):
			?>
			<a href="<?php echo site_url().'/admin/articleCat/available/'.$parrent_cat['cat_id'] ?>">取消删除</a> / 
			<a href="<?php echo site_url().'/admin/articleCat/delete/'.$parrent_cat['cat_id'] ?>">彻底删除</a>
			<?php
				else:
			?>
			<a href="<?php echo site_url().'/admin/articleCat/unavailable/'.$parrent_cat['cat_id'] ?>">删除</a>
			<?php 
				endif;
			?>
		</td>
	</tr>
	
	<?php
		if(isset($catetories['sub_cat'][$parrent_id]) && is_array($catetories['sub_cat'][$parrent_id])):
			foreach($catetories['sub_cat'][$parrent_id] as $key => $sub_cat):
		?>
			<tr align="center">
				<td><?php echo $sub_cat['cat_id']?></td>
				<td align="left"><?php echo $sub_cat['cat_name']?></td>
				<td align="left"><?php echo $sub_cat['cat_desc']?></td>
				<td><?php echo $sub_cat['add_time']?></td>
				<td><?php echo $sub_cat['modified_time']?></td>
				<td>
					<a href="<?php echo site_url().'/admin/articleCat/edit/'.$sub_cat['cat_id'] ?>">编辑</a> / 
					<?php 
						if($sub_cat['is_deleted'] == 1):
					?>
					<a href="<?php echo site_url().'/admin/articleCat/available/'.$sub_cat['cat_id'] ?>">取消删除</a> / 
					<a href="<?php echo site_url().'/admin/articleCat/delete/'.$sub_cat['cat_id'] ?>">彻底删除</a>
					<?php
						else:
					?>
					<a href="<?php echo site_url().'/admin/articleCat/unavailable/'.$sub_cat['cat_id'] ?>">删除</a>
					<?php 
						endif;
					?>
				</td>
			</tr>
		<?php
			endforeach;
		endif;
	?>
	<tr><td><br/></td></tr>
<?php
	endforeach;
?>
</table>
<?php
else:
?>
<div>
	<b>尚无分类，请创建</b>
</div>
<hr/>
<?php

endif;

if(!empty($message))
{
?>
	<div>
		<b><?php echo $message?></b>
	</div>
<?php
}
?>
<div>
	<span style="color:#FF0000;font-size:20px">添加分类</span>
	<form action="<?php echo site_url().'/admin/articleCat/add'?>" method="post">
		分类名称: <input id="name" name="name" type="text" value="" />&nbsp;*<br/>
		关键字: <input id="keywords" name="keywords" type="text" value="" />&nbsp;*<br/>
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