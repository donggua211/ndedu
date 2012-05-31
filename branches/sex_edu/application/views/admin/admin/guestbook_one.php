<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/guestbook') ?>"  target="main-frame">留言管理</a></span>
	 » 留言详情
	<div style="clear:both"></div>
</div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		
		<table width="90%">
			<tr>
				<td class="label" valign="top">姓名: </td>
				<td><?php echo $message_info['user_name'] ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">电话: </td>
				<td><?php echo (isset($message_info['phone'])) ? $message_info['phone'] :'';?></td>
			</tr>
			<tr>
				<td class="label" valign="top">年级: </td>
				<td><?php echo (isset($message_info['grade_name'])) ? $message_info['grade_name'] :''; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">留言时间: </td>
				<td><?php echo (isset($message_info['add_time'])) ? $message_info['add_time'] :''; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">ip: </td>
				<td><?php echo (isset($message_info['ip_address'])) ? $message_info['ip_address'] : ''; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">来源页: </td>
				<td><?php echo (isset($message_info['from_page'])) ? $message_info['from_page'] :''; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">内容: </td>
				<td><?php echo (isset($message_info['message'])) ? $message_info['message'] :''; ?></td>
			</tr>
			<tr align="center">
				<td colspan="2"><a href="javascript:void(0);" onclick="history.back(-1)">返回</a></td>
			</tr>	
		</table>
	</div>
</div>