<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/cp') ?>" target="main-frame">测评系统管理</a></span>
	 » 生成测评密码卡
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
				<td class="label" valign="top">批号: </td>
				<td><?php echo $batch_info['batch_id'] ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">顺序号: </td>
				<td><?php echo $batch_info['last_sn']?></td>
			</tr>
		</table>
		
		<form action="<?php echo site_url('admin/cp_quan/generate') ?>" method="post" name="addstaff">
		<?php
		foreach($generate['values'] as $value)
		{
			echo '<input type="hidden" name="values[]" value="'.$value.'">';
		}
		?>
		<input type="hidden" name="batch" value="<?php echo (isset($generate['batch'])) ? $generate['batch']  :''; ?>">
		<input type="hidden" name="number" value="<?php echo (isset($generate['number'])) ? $generate['number']  :''; ?>">
		<input type="hidden" value="1" name="confirm_add">
		<div class="button-div">
			<input type="submit" class="button" value=" 确定 " name="submit">
			<input type="reset" class="button" value=" 返回 " name="reset">
		</div>
		</form>
	</div>
</div>