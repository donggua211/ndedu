<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<base href="<?php echo base_url() ?>" />
	<link href="css/admin/admin.css" rel="stylesheet" type="text/css" />
	<title>administrator's control panel</title>
</head>
<body>
<div id="navigation" class="navigation">
	<a href="<?php echo site_url().'/admin/entry/info'?>">admin</a> &nbsp;»&nbsp; 查看搜索关键字
</div>
<?php
if(!empty($keyword_stats)):
?>
<table border="0" width="60%" cellspacing="0" cellpadding="0">
	<tr align="center" bgcolor="#FF6600">
		<td><b>Keyword</b></td>
		<td><b>点击次数</b></td>
	</tr>
	<?php
	foreach($keyword_stats as $keyword_stat):
		echo '<tr align="center">';
		echo '<td>'.$keyword_stat['keyword'].'</td>';
		echo '<td>'.$keyword_stat['counter'].'</td>';
		echo '</tr>';
	endforeach;
	?>
</table>
<?php
else:
?>
<div>
	<b>尚无记录</b>
</div>
<?php
endif;
?>
</body>
</html>