<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/cp') ?>" target="main-frame">测评系统管理</a></span>
	 » 编辑测评
	<div style="clear:both"></div>
</div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		<form action="<?php echo site_url('admin/cp/ceping_edit') ?>" method="post" name="addstaff">
		<table width="90%" id="shop_info-table">
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>测评名称: </td>
				<td><input size="30" type="text" name="cp_name" value="<?php echo (isset($ceping['cp_name'])) ? $ceping['cp_name'] : '';?>"></td>
			</tr>
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>测评分类: </td>
				<td>
					<select name="cat_id">
						<option value="0">请选择分类</option>
						<?php
						foreach($category as $value)
						{
							echo '<option value="'.$value['cat_id'].'" '.((isset($ceping['cat_id']) && $ceping['cat_id'] == $value['cat_id']) ? 'SELECTED' : '').'>'.$value['cat_name'].'</option>';
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>描述: </td>
				<td><textarea name="cp_des" cols="50" rows="5"><?php echo (isset($ceping['cp_des'])) ? $ceping['cp_des']  :''; ?></textarea></td>
			</tr>
		</table>
		<div class="button-div">
			<input type="hidden" value="<?php echo $ceping['cp_id'];?>" name="cp_id">
			<input type="submit" class="button" value=" 确定 " name="submit">
			<input type="reset" class="button" value=" 重置 " name="reset">
		</div>
		</form>
	</div>
</div>