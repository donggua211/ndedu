<div id="nav">
	<div id="nav_left">
		<span class="action-span"><a href="<?php echo site_url('ics') ?>"  target="_top">尼德内部咨询系统</a></span>
		<?php 
			foreach ($path_info as $path)
				echo '» '.$path['category_name'];
		?>
	</div>
	<div id="nav_right">
		<form action="<?php echo site_url('ics/ics/search')?>" method="POST" name="searchForm">
			<select name="grade_id">
				<option value='0'>全部学阶</option>
				<?php
					foreach($grades as $grade)
						echo '<option value="'.$grade['grade_id'].'">'.$grade['grade_name'].'</option>';
				?>
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