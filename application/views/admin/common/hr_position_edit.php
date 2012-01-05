<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/hr') ?>" target="main-frame">HR系统</a></span>
	<span class="action-span"> » 编辑职位</span>
	<div style="clear:both"></div>
</div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		<form action="<?php echo site_url('admin/hr_position/edit') ?>" method="post">
		<table width="90%" id="shop_info-table">
			<tr>
				<td class="label" valign="top">位置名称: </td>
				<td><input name="position_name" type="text" value="<?php echo (isset($position['position_name'])) ? $position['position_name'] :''; ?>" size="50" /></td>
			</tr>
			<tr>
				<td class="label" valign="top">部门: </td>
				<td>
					<select name="group_id">
						<option value='0'>请选择...</option>
						<?php
							foreach($groups as $group)
								echo '<option value="'.$group['group_id'].'" '.((isset($position['group_id'])) ? ( ($group['group_id'] == $position['group_id']) ? 'SELECTED' : '' ) : '').'>'.str_replace('主管', '组', $group['group_name']).'</option>';
						?>
					</select>
				</td>
			</tr>			
		</table>
		<div class="button-div">
			<input type="hidden" value="<?php echo $position['position_id'] ?>" name="position_id">
			<input type="submit" class="button" value=" 确定 " name="submit">
			<input type="reset" class="button" value=" 重置 " name="reset">
		</div>
		</form>
	</div>
</div>

</body>
</html>