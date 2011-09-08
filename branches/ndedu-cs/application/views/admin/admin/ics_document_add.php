<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/ics') ?>" target="main-frame">咨询系统管理</a></span>
	 » 增加文档
	<div style="clear:both"></div>
</div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		<form action="<?php echo site_url('admin/ics/document_add') ?>" method="post" name="addstaff">
		<table width="100%" id="shop_info-table">
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>文档内容: </td>
				<td></td>
			</tr>
			<tr>
				<td colspan="2">
					<textarea name="document"><?php echo (isset($document['document'])) ? $document['document'] : '';?></textarea>
					<script type="text/javascript"> 
						CKEDITOR.replace('document');   
					</script>
				</td>
			</tr>
			<tr>
				<td class="narrow-label">tags: </td>
				<td>
					<input type="text" name="tags" size="50" value="<?php echo (isset($document['tags'])) ? $document['tags'] : '';?>"> <span class="notice-span">请用空格 ' ' 或者半角逗号 ',' 隔开</span>
				</td>
			</tr>
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>分类: </td>
				<td>
					<select name="category_id">
						<option value="0">请选择分类</option>
						<?php show_category_options($categories, $document['category_id']); ?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>年级: </td>
				<td>
					<select name="grade_id">
						<option value="0">请选择年级</option>
					<?php
					foreach($grades as $grade)
						echo '<option value="'.$grade['grade_id'].'" '.(($grade['grade_id'] == $document['grade_id']) ? 'SELECTED' : '').'>'.$grade['grade_name'].'</option>';
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>请选择来源: </td>
				<td>
					<select name="source_id">
						<option value="0">请选择来源</option>
					<?php
					foreach($sources as $source)
						echo '<option value="'.$source['source_id'].'" '.(($source['source_id'] == $document['source_id']) ? 'SELECTED' : '').'>'.$source['source_desc'].'</option>';
					?>
					</select>
					<span class="notice-span">或者添加新的来源: </span><input type="text" name="source" value="<?php echo (isset($document['source'])) ? $document['source'] : '';?>">
				</td>
			</tr>
			<tr>
				<td class="narrow-label"><span class="notice-star"> * </span>提供该来源的员工: </td>
				<td>
					<select name="staff_id">
					<?php
					foreach($staffs as $staff)
						echo '<option value="'.$staff['staff_id'].'" '.(($staff['staff_id'] == $document['provider_id']) ? 'SELECTED' : '').'>'.$staff['name'].'</option>';
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