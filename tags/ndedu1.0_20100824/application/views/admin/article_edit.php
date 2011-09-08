<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<TITLE>Administrator's Control Panel</TITLE>
<base href="<?php echo base_url() ?>" />
<script type="text/javascript" src="<?php echo base_url() ?>js/ckeditor/ckeditor.js"></script>
<link href="images/admin.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>
<?php
	if(!empty($notification))
	{
?>
		<div>
			<b><?php echo get_language('article', 'cn', $notification) ?></b>
		</div>
<?php
	}
?>
<div>
	<form action="<?php echo site_url().'/admin/article/edit/'.$artcle_info['article_id'] ?>" method="post" enctype="multipart/form-data">
		标题: <input id="title" name="title" type="text" size="50" value="<?php echo !empty($artcle_info['title'])? $artcle_info['title'] : '' ?>" />&nbsp;*<br/>
		关键字: <input id="keywords" name="keywords" size="50" type="text" value="<?php echo !empty($artcle_info['keywords'])? $artcle_info['keywords'] : '' ?>" />&nbsp;*<br/>
		简短描述: (没有的话，可以不填)<br/>
		<textarea cols="120" id="short_description" name="short_description"><?php echo !empty($artcle_info['short_description'])? $artcle_info['short_description'] : '' ?></textarea><br/>
		简短描述下侧的图片, 请输入图片名称: <input id="short_description_img" name="short_description_img" size="50" type="text" value="<?php echo !empty($artcle_info['short_description_img'])? $artcle_info['short_description_img'] : '' ?>" /> (没有的话，可以不填)<br/>
		正文:  分页，请输入： #!PAGESEPARATOR!# 
		<textarea cols="80" id="content" name="content"><?php echo !empty($artcle_info['content'])? $artcle_info['content'] : '' ?></textarea>
		<script type="text/javascript"> 
			CKEDITOR.replace('content');   
		</script>
		
		
		新闻类别:
		<?php
			if(isset($categories_list) && is_array($categories_list)):
		?>
		<select name="catagory">
			<?php
				foreach($categories_list as $cat_id => $cat_info):
			?>
			<option value="<?php echo $cat_info['cat_id'] ?>" <?php if($artcle_info['cat_id'] == $cat_info['cat_id']) echo "SELECTED" ?>>
			<?php 
				if($cat_info['parent_id'] == 0) 
					echo '*';
				else
					echo '&nbsp;&nbsp;-';
				echo $cat_info['cat_name'] 
			?>
			</option>
			<?php
				endforeach;
			endif;
			?>
		</select> &nbsp;* <br/>
		是否存为草稿: <input type="checkbox" name="draft" value="1"><br/>
		添加时间: <input id="addtime" name="addtime" type="text" size="30" value="" />&nbsp;* 时间格式：2010-02-02 12:00:00，留空则默认为现在时间 <br/>
		
		<input type="file" name="image" id="image" />上传图片<br/>
		图片在文章现实的位置：
		<select name="image_align">
			<option value="above" <?php if($artcle_info['image_align'] == 'above') echo "SELECTED" ?>>居上</option>
			<option value="below" <?php if($artcle_info['image_align'] == 'below') echo "SELECTED" ?>>居下</option>
			<option value="left" <?php if($artcle_info['image_align'] == 'left') echo "SELECTED" ?>>居左</option>
			<option value="right" <?php if($artcle_info['image_align'] == 'right') echo "SELECTED" ?>>居右</option>
		</select><br/>
		
		<input type="submit" value="更新" name="submit"> <input type="reset" value="重写" name="reset"><br/>
	</form>
</div>
</body>
</html>