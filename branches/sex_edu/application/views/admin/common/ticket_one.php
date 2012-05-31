<div id="nav">
	<div id="nav_left">
		<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
		<span class="action-span"> » <a href="<?php echo site_url('admin/ticket') ?>" target="main-frame">内部评论</a></span>
		 » <?php echo $ticket_info['ticket_title'] ?>
	</div>
</div>
<div style="clear:both"></div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		
		<table width="90%">
			<tr>
				<td class="label" valign="top">标题: </td>
				<td><?php echo $ticket_info['ticket_title'] ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">添加人: </td>
				<td><?php echo $ticket_info['name'] ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">添加时间: </td>
				<td><?php echo $ticket_info['add_time'] ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">提案是什么: </td>
				<td><?php echo nl2br($ticket_info['ticket_content']) ?></td>
			</tr>	
			<tr>
				<td class="label" valign="top">为什么提出该提案: </td>
				<td><?php echo nl2br($ticket_info['ticket_why']) ?></td>
			</tr>	
			<tr>
				<td class="label" valign="top">如何执行这个提案: </td>
				<td><?php echo nl2br($ticket_info['ticket_how']) ?></td>
			</tr>		
		</table>
		<div class="button-link-div">
			<?php if($this_staff_id == $ticket_info['staff_id']): ?>
			<a href="<?php echo site_url('admin/ticket/edit/'.$ticket_info['ticket_id']) ?>">编辑</a>
			<?php endif; ?>
			<a href="javascript:void(0);" onclick="history.back(-1)">返回</a>
		</div>
	</div>
</div>