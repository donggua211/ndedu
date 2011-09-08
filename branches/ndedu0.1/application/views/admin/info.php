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
	<a href="<?php echo site_url().'/admin/entry/info'?>">admin</a> &nbsp;»&nbsp; 后台首页
</div>
<?php
if(!empty($new_messages)):
?>
<div style="float:left;padding-left:10px">
	最新留言：
</div>
<div style="padding-left:500px">
	<a href="<?php echo site_url().'/admin/guestbook/inbox'?>">更多留言</a>
</div>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr align="center" bgcolor="#FF6600">
		<td> </td>
		<td>ID</td>
		<td>新留言</td>
		<td>姓名</td>
		<td>电话</td>
		<td>grade</td>
		<td>留言时间</td>
		<td>ip</td>
		<td>内容</td>
		<td>来源页</td>
		<td>管理</td>
	</tr>
<?php
	foreach($new_messages as $key => $message):
?>
	<tr align="center">
		<td><input type="checkbox" name="msg_ids[]" value="<?php echo $message['msg_id']?>" /></td>
		<td><?php echo $message['msg_id']?></td>
		<td><?php echo $message['is_new'] == 1 ? '是' : '否' ?></td>
		<td><?php echo $message['user_name']?></td>
		<td><?php echo $message['phone']?></td>
		<td>
			<?php
				switch($message['grade'])
				{
					case 'preschool':
						echo '学前班';
						break;
					case 'primary_school':
						echo '小学';
						break;
					case 'junior_middle_school':
						echo '初中';
						break;
					case 'high_school':
						echo '高中';
						break;
				}
			?>
		</td>
		<td><?php echo $message['add_time']?></td>
		<td><?php echo $message['ip_address']?></td>
		<td><?php echo $message['message']?></td>
		<td><?php echo $message['from_page']?></td>
		<td>
			<a href="<?php echo site_url().'/admin/guestbook/one/'.$key.'/' ?>">查看</a> / 
			<?php 
				if($message['is_deleted'] == 1):
			?>
			<a href="<?php echo site_url().'/admin/guestbook/available/'.$message['msg_id'].'/' ?>">取消删除</a> / 
			<a href="<?php echo site_url().'/admin/guestbook/delete/'.$message['msg_id'].'/' ?>">彻底删除</a>
			<?php
				else:
			?>
			<a href="<?php echo site_url().'/admin/guestbook/unavailable/'.$message['msg_id'].'/' ?>">删除</a>
			<?php 
				endif;
			?>
		</td>
	</tr>
<?php
	endforeach;
?>
</table>
<?php
endif;
?>

</body>
</html>