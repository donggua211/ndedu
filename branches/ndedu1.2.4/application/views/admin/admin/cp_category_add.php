<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/cp') ?>" target="main-frame">测评系统管理</a></span>
	 » 添加测评分类
	<div style="clear:both"></div>
</div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		<form action="<?php echo site_url('admin/cp/category_add') ?>" method="post" name="addstaff">
		<table width="90%" id="shop_info-table">
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>分类名称: </td>
				<td><input size="30" type="text" name="cat_name" value="<?php echo (isset($category['cat_name'])) ? $category['cat_name'] : '';?>"></td>
			</tr>
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>评分: </td>
				<td><input type="text" name="star" value="<?php echo (isset($category['star'])) ? $category['star'] : '4.5';?>"></td>
			</tr>
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>高级版定价: </td>
				<td><input type="text" name="price_advanced" value="<?php echo (isset($category['price_advanced'])) ? $category['price_advanced'] : '';?>"></td>
			</tr>
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>高级版描述: </td>
				<td><textarea name="des_advanced" cols="50" rows="5"><?php echo (isset($category['des_advanced'])) ? $category['des_advanced'] :''; ?></textarea></td>
			</tr>
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>豪华版定价: </td>
				<td><input type="text" name="price_luxury" value="<?php echo (isset($category['price_luxury'])) ? $category['price_luxury'] : '';?>"></td>
			</tr>
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>豪华版描述: </td>
				<td><textarea name="des_luxury" cols="50" rows="5"><?php echo (isset($category['des_luxury'])) ? $category['des_luxury']  :''; ?></textarea></td>
			</tr>
		</table>
		<div class="button-div">
			<input type="submit" class="button" value=" 确定 " name="submit">
			<input type="reset" class="button" value=" 重置 " name="reset">
		</div>
		</form>
	</div>
</div>