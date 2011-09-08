<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/articleCat') ?>"  target="main-frame">分类管理 </a></span>
	 » 添加分类
	<div style="clear:both"></div>
</div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		<form action="<?php echo site_url('admin/ArticleCat/add') ?>" method="post">
		<table width="90%" id="shop_info-table">
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>分类名称: </td>
				<td><input type="text" name="name" value="<?php echo (isset($category['name'])) ? $category['name'] : '';?>"></td>
			</tr>
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>分类描述: </td>
				<td><input type="text" name="description" value="<?php echo (isset($category['description'])) ? $category['description'] : '';?>"></td>
			</tr>
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>上级分类: </td>
				<td>
					<select name="parent_id">
						<option value="0">顶级分类</option>
						<?php 
						function show_category_options($category, $selected_id = 0)
						{
							foreach($category as $value)
							{
								echo '<option value="'.$value['cat_id'].'" '.(($value['cat_id'] == $selected_id) ? 'SELECTED' : '').'>';
								
								for($i = 0; $i < $value['level']; $i++)
									echo '&nbsp;&nbsp;';
								
								if($value['level'] > 0)
									echo '└─';
								
								echo $value['cat_name'].'</option>';
								
								if(isset($value['sub_cat']) && !empty($value['sub_cat']))
									show_category_options($value['sub_cat'], $selected_id);
							}
						}
						show_category_options($categories);
						?>
					</select>
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