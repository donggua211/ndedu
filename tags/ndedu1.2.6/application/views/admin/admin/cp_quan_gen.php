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
		<form action="<?php echo site_url('admin/cp_quan/generate') ?>" method="post" name="addstaff">
		<table width="90%" id="shop_info-table">
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>面额: </td>
				<td>
					<input type="checkbox" name="values[]" value="20" <?php echo ((isset($gen_info['values']) && in_array('20', $gen_info['values'])) ? 'CHECKED' : ''); ?>>20<br/>
					<input type="checkbox" name="values[]" value="50" <?php echo ((isset($gen_info['values']) && in_array('50', $gen_info['values'])) ? 'CHECKED' : ''); ?>>50<br/>
					<input type="checkbox" name="values[]" value="100" <?php echo ((isset($gen_info['values']) && in_array('50', $gen_info['values'])) ? 'CHECKED' : ''); ?>>100<br/>
				</td>
			</tr>
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>批号: </td>
				<td>
					<input id="batch" maxlength="4" size="5" type="text" name="batch" value="<?php echo (isset($gen_info['batch'])) ? $gen_info['batch']  :''; ?>"> 
					<a href="javascript:void(0)" onclick="gen_batch();">随机生成</a>
					<a href="javascript:void(0)" onclick="last_quan_batch();">上次的随机码</a>
					
					<span id="batch_notice"></span>
				</td>
			</tr>
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>每种卡生成张数: </td>
				<td><input type="text" name="number" value="<?php echo (isset($gen_info['number'])) ? $gen_info['number']  :''; ?>"> <span class="notice-span">总共生成张数不要超过500张.</span></td>
			</tr>
		</table>
		<div class="button-div">
			<input type="submit" class="button" value=" 确定 " name="submit">
			<input type="reset" class="button" value=" 重置 " name="reset">
		</div>
		</form>
	</div>
</div>