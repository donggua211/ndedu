<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/cp') ?>" target="main-frame">测评系统管理</a></span>
	 » 查看分类
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
					<th>分类名称</th>
					<th>评分</th>
					<th>高级版定价</th>
					<th>高级版描述</th>
					<th>豪华版定价</th>
					<th>豪华版描述</th>
					<th>操作</th>
				</tr>
				<?php foreach($categories as $value): ?>
				<tr>
					<td><?php echo $value['cat_name'] ?></td>
					<td align="center"><?php echo $value['star'] ?></td>
					<td align="center"><?php echo $value['price_advanced'] ?></td>
					<td><?php echo nl2br($value['des_advanced']); ?></td>
					<td align="center"><?php echo $value['price_luxury'] ?></td>
					<td><?php echo nl2br($value['des_luxury']); ?></td>
					<td align="center">
						<a href="<?php echo site_url('admin/cp/category_edit/'.$value['cat_id']) ?>">编辑</a>
						<a onclick="return confirm(\'确定要删除\');" href="<?php echo site_url('admin/cp/category_delete/'.$value['cat_id']) ?>">删除</a>
					</td>
				<tr>
				<?php endforeach;?>
			</table>
		</div>
	</div>
</div>