<div id="nav">
	<div id="nav_left">
		<span class="action-span"><a href="<?php echo site_url('ics') ?>"  target="_top">你的内部咨询系统</a></span>
		<?php 
			foreach ($path_info as $path)
				echo '» '.$path['category_name'];
		?>
	</div>
	<div id="nav_right">
		<form action="<?php echo site_url('ics/ics/search')?>" method="POST" name="searchForm">
			<select name="category_id">
				<option value="0">请选择分类</option>
					<?php 
					print_r($categories);
					show_category_options($categories, 0); ?>
			</select>
			<input type="text" name="keyword" size="15" />
			<input type="submit" value=" 搜索 " class="button" />
		</form>
	</div>
	
	
</div>
<div style="clear:both"></div>
<div id="main">
	<?php foreach($documents as $document)
	{
		echo '<div id="main_body">';
		echo $document['document'];
		echo '</div>';
	}
	?>
</div>