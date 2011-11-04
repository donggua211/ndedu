<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/ticket') ?>" target="main-frame">内部评论</a></span>
	<span class="action-span"> » 添加评论</span>
	<div style="clear:both"></div>
</div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		<form action="<?php echo site_url('admin/ticket/add') ?>" method="post">
		<table width="90%" id="shop_info-table">
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>标题: </td>
				<td>
					<input name="ticket_title" type="text" value="<?php echo (isset($ticket['ticket_title'])) ? $ticket['ticket_title'] :''; ?>" size="50" />
					</span>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>内容: </td>
				<td><textarea name="ticket_content" cols="60" rows="10"><?php echo (isset($ticket['ticket_content'])) ? $ticket['ticket_content'] :''; ?></textarea></td>
			</tr>			
		</table>
		<div class="button-div">
			<input type="submit" class="button" value=" 确定 " name="submit">
			<input type="reset" class="button" value=" 重置 " name="reset">
		</div>
		</form>
	</div>
</div>