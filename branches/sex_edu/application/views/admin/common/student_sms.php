<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		
		<form action="<?php echo site_url('admin/sms/send')?>" method="post">
		<table width="90%">
			<?php if(isset($student['name'])): ?>
			<tr>
				<td class="label" valign="top">姓名: </td>
				<td><?php echo $student['name'] ?></td>
			</tr>
			<?php endif;?>
			<tr>
				<td class="label" valign="top">电话: </td>
				<td>
					<textarea name="mobile" cols="40" rows="5"><?php echo (isset($sms_mobile) ? $sms_mobile : ''); ?></textarea>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top">短信内容(请保持在64字以内): </td>
				<td>
					<textarea onkeyup="javascript:ContentChange()" onpaste="javascript:ContentChange()" id="content" name="content" cols="40" rows="5"><?php echo (isset($content) ? $content : ''); ?></textarea>
					<br/>请保持在64字以内
					<div id="content_Info"></div>
				</td>
			</tr>
		</table>
		<div class="button-div">
			<input type="hidden" name="back_url" value="<?php echo 'admin/student/'; ?>">
			<input type="submit" class="button" value=" 确定 " name="submit">
			<input type="reset" class="button" value=" 重置 " name="reset">
		</div>
		</form>
	</div>
</div>