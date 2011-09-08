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
	<a href="<?php echo site_url().'/admin/entry/info'?>">admin</a> &nbsp;»&nbsp; <a href="<?php echo site_url().'/admin/dangdang'?>">当当网内容挂历</a> &nbsp;»&nbsp; 添加文章
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
	<span style="color:#FF0000;font-size:20px">添加当当网内容</span>
	<form action="<?php echo site_url().'/admin/dangdang/add'?>" method="post">
		当当网单品PID: <input id="name" name="pid" type="text" value="" />&nbsp;*<br/>
		所在分类: <select name="cat">
			<option value="10">精品图书</option>
			<option value="11">教育影视</option>
			<option value="12">教育软件</option>
		</select>&nbsp;*<br/>
		标签:
		<?php foreach($tags as $tag): ?>
			<input type="checkbox" name="tags[]" value="<?php echo $tag['tag_id'] ?>"><?php echo $tag['tag_name'] ?>
		<?php endforeach;?>
		<br/>
		<input type="submit" value="添加" name="submit"><input type="reset" value="重写" name="reset"><br/>
	</form>
</div>
</body>
</html>