<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/hr') ?>" target="main-frame">HR系统</a></span>
	<span class="action-span"> » 编辑面试时间</span>
	<div style="clear:both"></div>
</div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		
		<form action="<?php echo site_url('admin/hr/edit_interview_time') ?>" method="post">
		<table width="90%" id="shop_info-table">
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>面试时间: </td>
				<td>
					<?php
					list($date, $time) = explode(' ', $interview_time['interviewer_time']);
					list($hour, $mins, ) = explode(':', $time);
					
					?>
					日期: <input name="interviewer_date" id="interviewer_date" type="text" value="<?php echo (isset($date)) ? $date :''; ?>" size='10'/> 小时: <?php echo show_hour_options('hour', $hour) ?>： <?php echo show_mins_options('mins', $mins) ?>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>通知方式: </td>
				<td>
					<select name="notice_method">
						<option value='<?php echo HR_NOTICE_METHOD_MOBILE ?>' <?php echo (isset($interview_time['notice_method']) && $interview_time['notice_method'] == HR_NOTICE_METHOD_MOBILE) ? 'SELECTED="SELETED"' :''; ?>><?php echo get_hr_interview_notice_mothed_text(HR_NOTICE_METHOD_MOBILE) ?></option>
						<option value='<?php echo HR_NOTICE_METHOD_SMS ?>' <?php echo (isset($interview_time['notice_method']) && $interview_time['notice_method'] == HR_NOTICE_METHOD_SMS) ? 'SELECTED="SELETED"' :''; ?>><?php echo get_hr_interview_notice_mothed_text(HR_NOTICE_METHOD_SMS) ?></option>
						<option value='<?php echo HR_NOTICE_METHOD_EMAIL ?>' <?php echo (isset($interview_time['notice_method']) && $interview_time['notice_method'] == HR_NOTICE_METHOD_EMAIL) ? 'SELECTED="SELETED"' :''; ?>><?php echo get_hr_interview_notice_mothed_text(HR_NOTICE_METHOD_EMAIL) ?></option>
						<option value='<?php echo HR_NOTICE_METHOD_SELF ?>' <?php echo (isset($interview_time['notice_method']) && $interview_time['notice_method'] == HR_NOTICE_METHOD_SELF) ? 'SELECTED="SELETED"' :''; ?>><?php echo get_hr_interview_notice_mothed_text(HR_NOTICE_METHOD_SELF) ?></option>
					</select>
				</td>
			</tr>
		</table>
		<div class="button-div">
			<input type="hidden" value="<?php echo $interview_time['interview_time_id'] ?>" name="interview_time_id">
			<input type="submit" class="button" value=" 确定 " name="submit">
			<input type="reset" class="button" value=" 重置 " name="reset">
		</div>
		</form>
	</div>
</div>