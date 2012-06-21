<div id="nav">
	<div id="nav_left">
		<span class="action-span"><a href="<?php echo site_url('ics') ?>"  target="_top">你的内部咨询系统</a></span>
		» 搜索
		» <?php echo $keyword; ?>
	</div>
	<div id="nav_right">
		<form action="<?php echo site_url('ics/ics/search')?>" method="POST" name="searchForm">
			<select name="category_id">
				<option value="0">请选择分类</option>
					<?php 
					show_category_options($categories, $category_id); ?>
			</select>
			<select name="grade_id">
				<option value='0'>全部学阶</option>
				<?php
					foreach($grades as $grade)
						echo '<option value="'.$grade['grade_id'].'" '.($grade['grade_id'] == $grade_id ? 'SELECTED' : '').'>'.$grade['grade_name'].'</option>';
				?>
			</select>
			<input type="text" name="keyword" value="<?php echo $keyword; ?>" size="15" />
			<input type="submit" value=" 搜索 " class="button" />
		</form>
	</div>
	
	
</div>
<div style="clear:both"></div>
<div id="main">
	<?php if(isset($notification) && !empty($notification)): ?>
	<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
		<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
	</div>
	<?php endif;?>
	
	<?php foreach($documents as $document)
	{
		echo '<div id="main_body">';
		echo str_replace($keyword, '<font color="red">'.$keyword.'</font>', $document['document']);
		echo '</div>';
	}
	?>
</div>