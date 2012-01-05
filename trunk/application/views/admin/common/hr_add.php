<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/hr') ?>" target="main-frame">HR系统</a></span>
	<span class="action-span"> » 添加新面试</span>
	<div style="clear:both"></div>
</div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		
		<form action="<?php echo site_url('admin/hr/add') ?>" method="post">
		<table width="90%" id="shop_info-table">
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>姓名: </td>
				<td>
					<input name="name" type="text" value="<?php echo (isset($interviewer['name'])) ? $interviewer['name'] :''; ?>"/>
					</span>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>电话: </td>
				<td>
					<input name="mobile" type="text" value="<?php echo (isset($interviewer['mobile'])) ? $interviewer['mobile'] :''; ?>"/>
					</span>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>email: </td>
				<td>
					<input name="email" type="text" value="<?php echo (isset($interviewer['email'])) ? $interviewer['email'] :''; ?>"/>
					</span>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>职位: </td>
				<td>
					<select name="position_id">
						<option value='0'>请选择...</option>
						<?php
							foreach($positions as $position)
							{
								echo '<option value="'.$position['position_id'].'" '.((isset($interviewer['position_id'])) ? ( ($position['position_id'] == $interviewer['position_id']) ? 'SELECTED' : '' ) : '').'>'.$position['position_name'].'</option>';
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>备注: </td>
				<td><textarea name="remark" cols="40" rows="5"><?php echo (isset($interviewer['remark'])) ? $interviewer['remark'] :''; ?></textarea></td>
			</tr>
		</table>
		<div class="button-div">
			<input type="submit" class="button" value=" 确定 " name="submit">
			<input type="reset" class="button" value=" 重置 " name="reset">
		</div>
		</form>
	</div>
</div>