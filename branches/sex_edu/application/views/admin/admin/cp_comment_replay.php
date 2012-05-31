<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/cp') ?>" target="main-frame">测评系统管理</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/cp/comments') ?>" target="main-frame">评论</a></span>
	 » 添加回复
	<div style="clear:both"></div>
</div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		<form action="<?php echo site_url('admin/cp/comment_replay') ?>" method="post" name="addstaff">
		<table width="90%" id="shop_info-table">
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>回复: </td>
				<td><textarea name="reply" cols="50" rows="5"><?php echo (isset($ceping['cp_des'])) ? $ceping['cp_des']  :''; ?></textarea></td>
			</tr>
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>添加链接请注意: </td>
				<td>
					格式: #url|文字#, url为链接(www.baidu.com), 文字为显示的文字(百度)
				</td>
			</tr>
		</table>
		<div class="button-div">
			<input type="hidden" value="<?php echo $comment_id; ?>" name="comment_id">
			<input type="submit" class="button" value=" 确定 " name="submit">
			<input type="reset" class="button" value=" 重置 " name="reset">
		</div>
		</form>
	</div>
</div>