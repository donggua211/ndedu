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
	<a href="<?php echo site_url().'/admin/entry/info'?>">admin</a> &nbsp;»&nbsp; <a href="<?php echo site_url().'/admin/guestbook/inbox'?>">留言</a>  &nbsp;»&nbsp;  <?php echo $message['user_name']?>
</div>
<?php

	$CI =& get_instance();
	$page = $CI->uri->segment(5);
	if ($page === FALSE)
	{
		$page = 'inbox';
	}
?>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr align="center" bgcolor="#FF6600">
		<td>ID</td>
		<td>姓名</td>
		<td>电话</td>
		<td>grade</td>
		<td>留言时间</td>
		<td>ip</td>
		<td>内容</td>
		<td>管理</td>
	</tr>
	<tr align="center">
		<td><?php echo $message['msg_id']?></td>
		<td><?php echo $message['user_name']?></td>
		<td><?php echo $message['phone']?></td>
		<td><?php echo $message['grade']?></td>
		<td><?php echo $message['add_time']?></td>
		<td><?php echo $message['ip_address']?></td>
		<td><?php echo $message['message']?></td>
		<td>
			<?php
				if($message['is_deleted'] == 1):
			?>
			<a href="<?php echo site_url().'/admin/guestbook/available/'.$message['msg_id'].'/'.$page ?>">取消删除</a> / 
			<a href="<?php echo site_url().'/admin/guestbook/delete/'.$message['msg_id'].'/'.$page ?>">彻底删除</a>
			<?php
				else:
			?>
			<a href="<?php echo site_url().'/admin/guestbook/unavailable/'.$message['msg_id'].'/'.$page ?>">删除</a>
			<?php 
				endif;
			?>
		</td>
	</tr>
</table>

</body>
</html>