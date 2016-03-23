<div id="nav">
	<div id="nav_left">
		<span class="action-span"><a href="<?php echo site_url('ics') ?>"  target="_top">你的内部咨询系统</a></span>
		<?php 
			foreach ($path_info as $path)
				echo '» '.$path['category_name'];
		?>
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