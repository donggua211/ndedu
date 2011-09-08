<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<base href="<?php echo base_url() ?>" />
	<link href="images/admin.css" rel="stylesheet" type="text/css" />
	<title>administrator's control panel</title>
</head>
<div>
<?php
	if(!empty($notification))
	{
		echo '<font color="green">';			
		echo $notification;			
		echo '</font>';
	}
?>
</div>
<div>
	点击这里：<a href="<?php echo site_url($page) ?>">返回</a>
</div>