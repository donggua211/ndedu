<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		
		<form action="<?php echo site_url('admin/sms/check')?>" method="post">
		<table width="90%">
			<tr>
				<td class="label" valign="top">短信内容(请保持在70字以内): </td>
				<td>
					<textarea onkeyup="javascript:ContentChange()" onpaste="javascript:ContentChange()" id="content" name="content" cols="40" rows="5"><?php echo (isset($content) ? $content : ''); ?></textarea>
					<div id="content_Info"></div>
				</td>
			</tr>
		</table>
		<div class="button-div">
			<input type="submit" class="button" value=" 检查 " name="submit">
			<input type="reset" class="button" value=" 重置 " name="reset">
		</div>
		</form>
	</div>
</div>