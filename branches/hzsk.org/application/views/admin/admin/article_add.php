<script type="text/javascript" src="<?php echo base_url() ?>js/ckeditor/ckeditor.js"></script>
<div id="navigation" class="navigation">
	<a href="<?php echo site_url().'/admin/welcome/info'?>">admin</a> &nbsp;»&nbsp; <a href="<?php echo site_url().'/admin/article/index'?>">文章管理</a> &nbsp;»&nbsp; 添加文章
</div>
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
<?php
	if(!empty($categories_list) && is_array($categories_list)):
?>
	<form action="<?php echo site_url().'/admin/article/add' ?>" method="post" enctype="multipart/form-data">
		标题: <input id="title" name="title" type="text" size="50" value="<?php echo !empty($article['title'])? $article['title'] : '' ?>" />&nbsp;*<br/>
		关键字: <input id="keywords" name="keywords" size="50" type="text" value="<?php echo !empty($article['keywords'])? $article['keywords'] : '' ?>" />&nbsp;*<br/>
		正文: 
		<textarea cols="80" id="content" name="content"><?php echo !empty($article['content'])? $article['content'] : '' ?></textarea>
		<script type="text/javascript"> 
			CKEDITOR.replace('content');   
		</script>
		
		新闻类别:
		<select name="catagory">
			<?php
				foreach($categories_list as $cat_id => $cat_info):
			?>
			<option value="<?php echo $cat_info['cat_id'] ?>">
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
			?>
		</select> &nbsp;* <br/>
		
		是否存为草稿: <input type="checkbox" name="draft" value="1"><br/>
		添加时间: <input id="addtime" name="addtime" type="text" size="30" value="" />&nbsp;* 时间格式: 2010-02-02 12:00:00，留空则默认为现在时间 <br/>
		<input type="submit" value="添加" name="submit"> <input type="reset" value="重写" name="reset"><br/>
	</form>

<?php
	else:
?>
	<span style="color:red; font-size:25px">没有分类，请先添加分类: <a href="<?php echo site_url().'/admin/articleCat/add'?>">添加分类</a></span>
<?php
	endif;
?>
</div>