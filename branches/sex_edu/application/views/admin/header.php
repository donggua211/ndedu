<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<base href="<?php echo base_url() ?>" />
	<title><?php echo (isset($meta_title) && !empty($meta_title)) ? $meta_title . ' - administrator control panel': 'administrator control panel'; ?></title>
	<link href="css/admin/admin.css" rel="stylesheet" type="text/css" />
	<link href="css/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
	<?php if(isset($css_file) && $css_file):
		if(is_array($css_file)): 
			foreach($css_file as $css)
				echo '<link href="css/admin/'.$css.'" rel="stylesheet" type="text/css" />';
		else: ?>
			<link href="css/admin/<?php echo $css_file ?>" rel="stylesheet" type="text/css" />
		<?php endif; ?>
	<?php endif;?>
	<script type="text/javascript" src="js/jquery-1.6.2.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
	<script type="text/javascript" src="js/admin/admin.common.js"></script>
	<?php if(isset($js_file_header) && !empty($js_file_header)):?>
		<?php 
		if(is_array($js_file_header)): 
			foreach($js_file_header as $js)
				echo '<script type="text/javascript" src="js/admin/'.$js.'"></script>';
		else: ?>
		<script type="text/javascript" src="js/admin/<?php echo $js_file_header ?>"></script>
		<?php endif; ?>
	<?php endif;?>
	<script>
	<!--
	site_url = '<?php echo site_url();?>';
	base_url = '<?php echo base_url();?>';
	thisURL = '<?php echo $_SERVER['REQUEST_URI'];?>';
	-->
	</script>
</head>
<body>