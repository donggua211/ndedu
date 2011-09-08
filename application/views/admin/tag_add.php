<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<TITLE>Administrator's Control Panel</TITLE>
<base href="<?php echo base_url() ?>" />
<script type="text/javascript" src="<?php echo base_url() ?>js/ckeditor/ckeditor.js"></script>
<link href="images/admin.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>
<div id="navigation" class="navigation">
	<a href="<?php echo site_url().'/admin/entry/info'?>">admin</a> &nbsp;»&nbsp; <a href="<?php echo site_url().'/admin/tags'?>">tag管理</a> &nbsp;»&nbsp; 添加tag
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