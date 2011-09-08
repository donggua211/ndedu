<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/dangdang') ?>"  target="main-frame">当当网内容管理</a></span>
	 » 查看当当网内容
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
					<th>图片</th>
					<th width="60px">pid</th>
					<th>名称</th>
					<th>作者</th>
					<th width="60px">分类</th>
					<th>rank</th>
					<th width="100px">管理</th>
				</tr>
				<?php foreach($dangdangs as $dangdang): ?>
					<tr>
						<td><img src="<?php echo $dangdang['image_url'] ?>" /></td>
						<td><?php echo $dangdang['pid'] ?></td>
						<td><?php echo $dangdang['product_name'] ?></td>
						<td><?php echo $dangdang['author'] ?></td>
						<td><?php echo $dangdang['cat_name'] ?></td>
						<td><?php echo $dangdang['rank'] ?></td>
						<td align="center">
							<a onclick="return confirm('确定要删除, 删除后将无法回复?');" href="<?php echo site_url('/admin/dangdang/delete/'.$dangdang['pid']) ?>">彻底删除</a>
						</td>
					</tr>
				<?php endforeach;?>
			</table>
		</div>
	</div>
</div>