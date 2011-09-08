<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<base href="<?php echo base_url() ?>" />
	<link href="css/admin/admin.css" rel="stylesheet" type="text/css" />
	<title>administrator's control panel</title>
</head>
<body>
<?php

	$CI =& get_instance();
	$page = $CI->uri->segment(3);
	if ($page === FALSE || !in_array($page, array('inbox', 'trash', 'all')))
	{
		$page = 'inbox';
	}
?>
<div id="navigation" class="navigation">
	<a href="<?php echo site_url().'/admin/entry/info'?>">admin</a> &nbsp;»&nbsp; <a href="<?php echo site_url().'/admin/guestbook/inbox'?>">留言本</a>  &nbsp;»&nbsp; 
	<?php
		if($page == 'inbox')
			echo '查看留言';
		elseif($page == 'trash')
			echo '废件箱';
		elseif($page == 'all')
			echo '全部留言';	

	?>
</div>
<form method="post" action="<?php echo site_url('/admin/guestbook/batch/') ?>">
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
	$all_msg_ids = '';
	foreach($messages as $key => $message):
		$all_msg_ids .= $key.',';
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
			<a href="<?php echo site_url().'/admin/guestbook/one/'.$key.'/'.$page ?>">查看</a> / 
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
<?php
	endforeach;
?>
</table>
<div>
<?php
$totle_page = ceil($count_message/$num_message_per_page);

if($totle_page > 1)
{
	$previous_page = '<a href="'.site_url().'/admin/guestbook/'.$page.'/'.($current_page - 1).'">上一页</a>';
	$next_page = '<a href="'.site_url().'/admin/guestbook/'.$page.'/'.($current_page + 1).'">下一页</a>';
	
	if($current_page == 1)
		$previous_page = '上一页';
	elseif($current_page == $totle_page)
		$next_page = '下一页';
	
	echo $previous_page;
	
	for($i = 1; $i <= $totle_page; $i++)
	{
		if($current_page == $i)
			echo $i;
		else
			echo '<a href="'.site_url().'/admin/guestbook/'.$page.'/'.$i.'">'.$i.'</a>';
	}
	
	echo $next_page;
}

if($totle_page == 0 || $current_page == $totle_page)
	$current_num = $count_message;
else
	$current_num = $num_message_per_page * $current_page;

echo $current_num.' / '.$count_message;
?>
</div>
<div>
	<input type="hidden" name="page" value="<?php echo $page ?>"/>
	<input type="hidden" name="all_msg_ids" value="<?php echo trim($all_msg_ids, ' ,') ?>"/>
	批量: 
	<select name="action">
		<option value="read">
			设置为已读
		</option>
	<?php
		if($page == 'inbox' || $page == 'all'):
	?>
		<option value="unavailable">
			删除所选
		</option>
	<?php
		endif;
		if($page == 'trash' || $page == 'all'):
	?>
		<option value="available">
			取消删除所选
		</option>
	<?php
		endif;
		if($page == 'trash'):
	?>
		<option value="delete">
			删除所选
		</option>
	<?php
		endif;
	?>
	</select>
	<input type="submit" name="doAction" value="执行"/>	
	<input type="submit" name="readAll" value="本页全部设为已读"/>
	<?php
		if($page == 'inbox' || $page == 'all'):
	?>
		<input type="submit" name="unavailableAll" value="本页全部删除"/>
	<?php
		endif;
		if($page == 'trash' || $page == 'all'):
	?>
		<input type="submit" name="availableAll" value="本页全部取消删除"/>
		
	<?php
		endif;
		if($page == 'trash'):
	?>
		<input type="submit" name="deleteAll" value="本页全部彻底删除"/>
	<?php
		endif;
	?>
</div>

</form>

</body>
</html>