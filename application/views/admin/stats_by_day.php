<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<base href="<?php echo base_url() ?>" />
	<link href="images/admin.css" rel="stylesheet" type="text/css" />
	<title>administrator's control panel</title>
</head>
<body>
<div id="navigation" class="navigation">
	<a href="<?php echo site_url().'/admin/entry/info'?>">admin</a> &nbsp;»&nbsp; <a href="<?php echo site_url().'/admin/stats/'?>">查看点击率</a> &nbsp;»&nbsp; 按天查看
</div>
<?php
$data1['year_stats_from'] = '2008';
$CI =& get_instance();
$CI->load->view('admin/stats_time_selector.php', $data1);	
?>
<pre>
<?php
if(isset($fields) && is_array($fields)):
?>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr align="center" bgcolor="#FF6600">
		<td>&nbsp;</td>
	<?php
	foreach($fields as $field):
		echo '<td>'.$field.'</td>';
	endforeach;
	?>
	</tr>
<?php
	for($i = 0; $i < 24; $i++):
?>
	<tr align="center">
		<td><?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?>:00 - <?php echo str_pad($i+1, 2, '0', STR_PAD_LEFT) ?>:00</td>
<?php
		foreach($fields_stats as $fields_stat):
	?>
			<td>
				<?php
					if(isset($fields_stat[$i]))
						echo $fields_stat[$i];
					else
						echo '0';				
				?>
			</td>
	<?php
		endforeach;
	?>
	</tr>
<?php
	endfor;
?>
</table>
<?php
else:
?>
<div>
	<b>尚无分类，请创建</b>
</div>
<?php
endif;
?>
</body>
</html>