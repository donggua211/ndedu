<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<TITLE>Administrator's Control Panel</TITLE>
<script type="text/javascript" src="../ckeditor.js"></script>
</HEAD>
<body>

<div>

	<form action="" method="post" enctype="multipart/form-data">
		标题: <input id="title" name="title" type="text" size="50" value="" />&nbsp;*<br/>
		关键字: <input id="keywords" name="keywords" size="50" type="text" value="" />&nbsp;*<br/>
		正文: <textarea cols="80" id="content" name="content"></textarea>
		<script type="text/javascript"> 
			CKEDITOR.replace('content');   
		</script>
		

		<input type="file" name="image" id="image" />上传图片<br/>
		图片在文章现实的位置：
		<select name="image_align">
			<option value="above">居上</option>
			<option value="below">居下</option>
			<option value="left">居左</option>
			<option value="right">居右</option>
		</select><br/>
		<input type="submit" value="添加" name="submit"> <input type="reset" value="重写" name="reset"><br/>
	</form>

</div>
</body>
</html>