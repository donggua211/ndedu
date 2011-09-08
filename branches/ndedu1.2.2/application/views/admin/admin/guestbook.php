<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/guestbook') ?>"  target="main-frame">留言管理</a></span>
	 » <?php echo $page_name; ?>
	<div style="clear:both"></div>
</div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		
		<div id="listDiv" class="list-div">
			<table cellspacing='1' id="list-table">
				<tr>
					<th>姓名</th>
					<th>电话</th>
					<th width="45px">年级</th>
					<th width="100px">留言时间</th>
					<th>内容</th>
					<th width="90px">状态</th>
					<th width="90px">操作</th>
				</tr>
				<?php foreach($messages as $key => $message): ?>
				<tr>
					<td <?php echo $message['is_new'] == 1 ? 'style="font-weight:bold"' : '' ?>><?php echo $message['user_name']?></td>
					<td <?php echo $message['is_new'] == 1 ? 'style="font-weight:bold"' : '' ?>><?php echo $message['phone']?></td>
					<td <?php echo $message['is_new'] == 1 ? 'style="font-weight:bold"' : '' ?> align="center"><?php echo $message['grade_name']?></td>
					<td <?php echo $message['is_new'] == 1 ? 'style="font-weight:bold"' : '' ?>><?php echo $message['add_time']?></td>
					<td><?php echo $message['message']?></td>
					<td>
						<input id="status3_<?php echo $message['msg_id']?>" type="radio" value="3" name="status_<?php echo $message['msg_id']?>" <?php echo ($message['status'] == 3) ? 'CHECKED' : '' ?> OnClick="change_status(this.value,<?php echo $message['msg_id']?>)">
						<label id="st3_<?php echo $message['msg_id']?>" for="status3_<?php echo $message['msg_id']?>" style="color:#<?php echo ($message['status'] == 3) ? '000' : 'CCCCCC' ?>">联系成功</label><br/>
						
						<input id="status2_<?php echo $message['msg_id']?>" type="radio" value="2" name="status_<?php echo $message['msg_id']?>" <?php echo ($message['status'] == 2) ? 'CHECKED' : '' ?> OnClick="change_status(this.value,<?php echo $message['msg_id']?>)">
						<label id="st2_<?php echo $message['msg_id']?>" for="status2_<?php echo $message['msg_id']?>" style="color:#<?php echo ($message['status'] == 2) ? '000' : 'CCCCCC' ?>">无法联系</label><br/>
						
						<input id="status1_<?php echo $message['msg_id']?>" type="radio" value="1" name="status_<?php echo $message['msg_id']?>" <?php echo ($message['status'] == 1) ? 'CHECKED' : '' ?> OnClick="change_status(this.value,<?php echo $message['msg_id']?>)">
						<label id="st1_<?php echo $message['msg_id']?>" for="status1_<?php echo $message['msg_id']?>" style="color:#<?php echo ($message['status'] == 1) ? '000' : 'CCCCCC' ?>">尚未联系</label>
					</td>
					<td align="center">
						<a href="<?php echo site_url().'/admin/guestbook/one/'.$key ?>">查看</a> / 
						<?php 
						if($message['is_deleted'] == 0) 
							echo '<a onclick="return confirm(\'确定要删除?\');" href="'.site_url('/admin/guestbook/unavailable/'.$message['msg_id']).'">删除</a>';
						else
							echo '<a onclick="return confirm(\'确定要取消删除?\');" href="'.site_url('/admin/guestbook/available/'.$message['msg_id']).'">取消删除</a>';
						?>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<!-- 分页 -->
		<?php echo $page_nav; ?>
	</div>
</div>