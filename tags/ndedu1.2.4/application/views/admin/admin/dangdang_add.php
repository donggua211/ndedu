<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/dangdang') ?>"  target="main-frame">当当网内容管理</a></span>
	 » 添加
	<div style="clear:both"></div>
</div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		<form action="<?php echo site_url('admin/dangdang/add') ?>" method="post">
		<table width="90%" id="shop_info-table">
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>当当网单品PID: </td>
				<td><input id="name" name="pid" type="text" value="" /></td>
			</tr>
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>所在分类: </td>
				<td>
					<select name="cat_id">
						<option value="<?php echo DANGDANG_BOOK_CAT_ID ?>">精品图书</option>
						<option value="<?php echo DANGDANG_VIDEO_CAT_ID ?>">教育影视</option>
						<option value="<?php echo DANGDANG_SOFTWARE_CAT_ID ?>">教育软件</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>标签: </td>
				<td>
				<?php foreach($tags as $tag): ?>
					<input type="checkbox" name="tags[]" value="<?php echo $tag['tag_id'] ?>"><?php echo $tag['tag_name'] ?>
				<?php endforeach;?>
				</td>
			</tr>
		</table>
		<div class="button-div">
			<input type="submit" class="button" value=" 确定 " name="submit">
			<input type="reset" class="button" value=" 重置 " name="reset">
		</div>
		</form>
	</div>
</div>