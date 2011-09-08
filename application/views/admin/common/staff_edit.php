<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/staff') ?>" target="main-frame">员工管理</a></span>
	<span class="action-span"> » 编辑员工</span>
	<div style="clear:both"></div>
</div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		<form action="<?php echo site_url('admin/staff/edit') ?>" method="post">
		<table width="90%" id="shop_info-table">
			<tr>
				<td class="label" valign="top">员工名: </td>
				<td><?php echo (isset($staff['username'])) ? $staff['username'] :''; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">密码: </td>
				<td><input name="password" type="text" value="" size="30" /></td>
			</tr>
			<tr>
				<td class="label" valign="top">确认密码: </td>
				<td><input name="password_c" type="text" value="" size="30" /></td>
			</tr>
			<tr>
				<td class="label" valign="top">姓名: </td>
				<td><input name="name" type="text" value="<?php echo (isset($staff['name'])) ? $staff['name'] :''; ?>" size="30" /></td>
			</tr>
			<tr>
				<td class="label" valign="top">称谓: </td>
				<td><input name="title" type="text" value="<?php echo (isset($staff['title'])) ? $staff['title'] :''; ?>" size="30" /></td>
			</tr>
			<tr>
				<td class="label" valign="top">用户角色: </td>
				<td>
					<select name="group_id">
						<option value='0'>请选择...</option>
						<?php
							foreach($groups as $group)
								echo '<option value="'.$group['group_id'].'" '.((isset($staff['group_id'])) ? ( ($group['group_id'] == $staff['group_id']) ? 'SELECTED' : '' ) : '').'>'.$group['group_name'].'</option>';
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top">学阶: </td>
				<td>
					<select name="grade_id">
						<option value='0'>请选择...</option>
						<?php 
							foreach($grades as $grade)
								echo '<option value="'.$grade['grade_id'].'" '.((isset($staff['grade_id'])) ? ( ($grade['grade_id'] == $staff['grade_id']) ? 'SELECTED' : '' ) : '').'>'.$grade['grade_name'].'</option>';
						?>
					</select><br/>					
					<span class="notice-span" style="display:block"  id="noticeskype">员工所在的学阶</span>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top">校区: </td>
				<td>
					<select name="branch_id">
						<option value='0'>请选择...</option>
						<?php
							foreach($branches['branch'] as $branch)
								echo '<option value="'.$branch['branch_id'].'" '.((isset($staff['branch_id'])) ? ( ($branch['branch_id'] == $staff['branch_id']) ? 'SELECTED' : '' ) : '').'>'.$branch['branch_name'].'</option>';
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top">电话: </td>
				<td>
					<input name="phone" type="text" value="<?php echo (isset($staff['phone'])) ? $staff['phone'] :''; ?>" size="40" />
				</td>
			</tr>
			<tr>
				<td class="label" valign="top">QQ: </td>
				<td>
					<input name="qq" type="text" value="<?php echo (isset($staff['qq'])) ? $staff['qq'] :''; ?>" size="40" />
				</td>
			</tr>
			<tr>
				<td class="label" valign="top">电子邮箱: </td>
				<td><input name="email" type="text" value="<?php echo (isset($staff['email'])) ? $staff['email'] :''; ?>" size="40" /></td>
			</tr>
			<tr>
				<td class="label" valign="top">居住地: </td>
				<td><input name="address" type="text" value="<?php echo (isset($staff['address'])) ? $staff['address'] :''; ?>" size="40" /></td>
			</tr>
			<tr>
				<td class="label" valign="top">备注: </td>
				<td><textarea name="remark" cols="40" rows="5"></textarea></td>
			</tr>			
		</table>
		<div class="button-div">
			<input type="hidden" value="<?php echo $staff['staff_id'] ?>" name="staff_id">
			<input type="submit" class="button" value=" 确定 " name="submit">
			<input type="reset" class="button" value=" 重置 " name="reset">
		</div>
		</form>
	</div>
</div>

</body>
</html>