<div id="nav">
	<div id="nav_left">
		<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
		<span class="action-span"> » <a href="<?php echo site_url('admin/staff') ?>" target="main-frame">员工管理</a></span>
		 » <?php echo $staff['name'] ?>
	</div>
	<div id="nav_right">
		所在校区: <span><?php echo $staff['branch_name'] ?></span>
	</div>
</div>
<div style="clear:both"></div>
<div id="main">
	<div id="main_navbar">
		<p>
			<span class="navbar-back"><a href="<?php echo site_url('admin/staff/one/'.$staff['staff_id']) ?>">基本信息</a></span>
			
			<span class="navbar-back"><a href="<?php echo site_url('admin/staff/one/'.$staff['staff_id'].'/timetable') ?>">时间表</a></span>
			
			<?php
			//access control
			$CI = & get_instance();
			if($CI->admin_ac_staff->view_staff_one_sms()):
			?>
			<span class="navbar-front"><a href="<?php echo site_url('admin/staff/one/'.$staff['staff_id'].'/sms') ?>">短信记录</a></span>
			<?php endif; ?>
		</p>
	</div>
	
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		
		<form action="<?php echo site_url('admin/sms/send')?>" method="post">
		<table width="90%">
			<tr>
				<td class="label" valign="top">电话: </td>
				<td>
					<textarea name="mobile" id="mobile" cols="40" rows="2"><?php echo (isset($sms_mobile) ? $sms_mobile : ''); ?></textarea>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top">短信内容(请保持在64字以内): </td>
				<td>
					<textarea onkeyup="javascript:ContentChange();update_resend()" onpaste="javascript:ContentChange(); update_resend()" id="content" name="content" cols="40" rows="5"><?php echo (isset($content) ? $content : ''); ?></textarea>
					<br/>请保持在64字以内
					<div id="content_Info"></div>
				</td>
			</tr>
		</table>
		<div class="button-div">
			<input type="hidden" name="resend" value="0">
			<input type="hidden" name="sms_history_id" value="0">
			<input type="submit" class="button" value=" 确定 " name="submit">
			<input type="reset" class="button" value=" 重置 " name="reset">
		</div>
		</form>
		
		<div id="listDiv" class="list-div">
			<table cellspacing='1' id="list-table">
				<tr>
					<th>短信内容</th>
					<th>电话</th>
					<th>发送时间</th>
					<th>状态</th>
					<th>操作</th>
				</tr>
				<?php foreach($sms_history as $history): ?>
				<tr>
					<td><span id="sms_text_<?php echo $history['sms_history_id']; ?>"><?php echo $history['sms_text'] ?></span></td>
					<td width="80px"><span id="mobile_<?php echo $history['sms_history_id']; ?>"><?php echo $history['mobile'] ?></span></td>
					<td width="150px" align="center" ><?php echo $history['update_time'] ?></td>
					<td width="100px" align="center">
						<?php echo $history['status'] == 1 ? '发送成功' : '状态码：'.$history['status']; ?>
					</td>
					<td width="50px" align="center">
					<?php if($history['staff_id'] == $this_staff_id): ?>
						<a href="javascript:void(0);" onClick="javascript:resend(<?php echo $history['sms_history_id']; ?>)">重发</a>
					<?php endif; ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<!-- 分页 -->
		<?php echo $page_nav; ?>
	</div>
</div>


<script type="text/javascript">
	function resend(sms_history_id)
	{
		sms_text = $("#sms_text_"+sms_history_id).html();
		mobile = $("#mobile_"+sms_history_id).html();
		
		$("#mobile").val(mobile);
		$("#content").val(sms_text);
		
		$("input[name='resend']").val('1');
		$("input[name='sms_history_id']").val(sms_history_id);
	}
	
	function update_resend()
	{
		$("input[name='resend']").val('0');
		$("input[name='sms_history_id']").val('0');
	}
</script>
