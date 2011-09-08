<script type="text/javascript" src="<?php echo base_url() ?>js/ckeditor/ckeditor.js"></script>
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
	<form action="<?php echo site_url().'/admin/article/edit/' ?>" method="post" enctype="multipart/form-data">
		标题: <input id="title" name="title" type="text" size="50" value="<?php echo !empty($artcle_info['title'])? $artcle_info['title'] : '' ?>" />&nbsp;*<br/>
		关键字: <input id="keywords" name="keywords" size="50" type="text" value="<?php echo !empty($artcle_info['keywords'])? $artcle_info['keywords'] : '' ?>" />&nbsp;*<br/>
		正文: 
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
		添加时间: <input id="addtime" name="addtime" type="text" size="30" value="" />&nbsp;* 时间格式: 2010-02-02 12:00:00，留空则默认为现在时间 <br/>
		
		<input type="hidden" value="<?php echo $article_id ?>" name="article_id">
		<input type="submit" value="更新" name="submit"> <input type="reset" value="重写" name="reset"><br/>
	</form>
</div>