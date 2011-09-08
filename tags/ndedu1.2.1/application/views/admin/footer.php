	<?php if(isset($js_file) && !empty($js_file)):?>
		<?php 
		if(is_array($js_file)): 
			foreach($js_file as $js)
				echo '<script type="text/javascript" src="js/admin/'.$js.'"></script>';
		else: ?>
		<script type="text/javascript" src="js/admin/<?php echo $js_file ?>"></script>
		<?php endif; ?>
	<?php endif;?>
	<script type="text/javascript" src="js/admin/common.js"></script>
	<script type="text/javascript" src="js/admin/utils.js"></script>
	<script type="text/javascript" src="js/admin/transport.js"></script>
</body>
</html>