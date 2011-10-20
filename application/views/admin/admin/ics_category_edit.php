<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/ics') ?>" target="main-frame">咨询系统管理</a></span>
	 » 编辑分类
	<div style="clear:both"></div>
</div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		<form action="<?php echo site_url('admin/ics/category_edit') ?>" method="post" name="addstaff">
		<table width="90%" id="shop_info-table">
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>分类名称: </td>
				<td><input type="text" name="name" value="<?php echo (isset($category['category_name'])) ? $category['category_name'] : '';?>"></td>
			</tr>
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>上级分类: </td>
				<td>
					<select name="parent">
						<option value="0">顶级分类</option>
						<?php show_category_options($categories, $category['parent_id']); ?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>排序: </td>
				<td><input type="text" name="order" value="<?php echo (isset($category['order'])) ? $category['order'] : '50';?>"></td>
			</tr>
		</table>
		<div class="button-div">
			<input type="hidden" value="<?php echo $category['category_id'];?>" name="category_id">
			<input type="submit" class="button" value=" 确定 " name="submit">
			<input type="reset" class="button" value=" 重置 " name="reset">
		</div>
		</form>
	</div>
</div>