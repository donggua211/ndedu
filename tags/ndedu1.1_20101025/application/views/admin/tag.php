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
	<a href="<?php echo site_url().'/admin/entry/info'?>">admin</a> &nbsp;»&nbsp; tag管理
</div>

<?php 
	if(!empty($notification))
	{
?>
		<div>
			<b><?php echo $notification ?></b>
		</div>
<?php
	}

if(isset($tags) && is_array($tags)):
?>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr align="center" bgcolor="#FF6600">
		<td>ID</td>
		<td>tag名称</td>
		<td>管理</td>
	</tr>
<?php
	foreach($tags as $tags):
?>
	<tr align="center">
		<td><?php echo $tags['tag_id']?></td>
		<td align="left"><?php echo $tags['tag_name']?></td>
		<td>
			<a href="<?php echo site_url().'/admin/tags/edit/'.$tags['tag_id'] ?>">编辑</a> / 
			<a href="<?php echo site_url().'/admin/tags/delete/'.$tags['tag_id'] ?>">彻底删除</a>
		</td>
	</tr>
<?php
	endforeach;
?>
<tr><td><br/></td></tr>
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
	<span style="color:#FF0000;font-size:20px">添加tag</span>
	<form action="<?php echo site_url().'/admin/tags/add'?>" method="post">
		tag名称: <input id="name" name="name" type="text" value="" />&nbsp;*<br/>
		<input type="submit" value="添加tag" name="submit"><br/>
		<input type="reset" value="重写" name="reset"><br/>
	</form>
</div>

</body>
</html>