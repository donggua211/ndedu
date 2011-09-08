<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/ics') ?>" target="main-frame">咨询系统管理</a></span>
	 » 查看文档
	<div style="clear:both"></div>
</div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		
		<div id="listDiv" class="list-div">
			<table cellspacing='1' id="list-table">
				<tr>
					<th>内容</th>
					<th>分类</th>
					<th>标签</th>
					<th>年级</th>
					<th>添加者</th>
					<th>添加时间</th>
					<th width="60">操作</th>
				</tr>
				<?php foreach($documents as $document): ?>
				<tr>
					<td><?php echo utf_substr( $document['document'], 150); ?></td>
					<td><?php echo $document['category_name'] ?></td>
					<td><?php echo $document['tags'] ?></td>
					<td><?php echo $document['grade_name'] ?></td>
					<td><?php echo $document['name'] ?></td>
					<td><?php echo $document['add_time'] ?></td>
					<td align="center">
						<a href="<?php echo site_url('admin/ics/document_edit/'.$document['document_id']) ?>">编辑</a>
						<a onclick="return confirm('确定要删除?');" href="<?php echo site_url('admin/ics/document_delete/'.$document['document_id']) ?>">删除</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<!-- 分页 -->
		<?php echo $page_nav; ?>
	</div>
</div>