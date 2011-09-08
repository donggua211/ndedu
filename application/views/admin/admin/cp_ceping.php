<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/cp') ?>" target="main-frame">测评系统管理</a></span>
	 » 查看测评
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
			
			<?php foreach($cepings as $cat): ?>
			<div class="margin_top">
				<div class="title">
					<span><?php echo $cat[0]['cat_name'] ?></span>
				</div>
			</div>
			<table cellspacing='1' id="list-table">
				<tr>
					<th>序号</th>
					<th>测评名称</th>
					<th>测评描述</th>
					<th width="60px">操作</th>
				</tr>
				<?php foreach($cat as $key => $value): ?>
				<tr>
					<td><?php echo $key ?></td>
					<td><?php echo $value['cp_name'] ?></td>
					<td><?php echo nl2br($value['cp_des']); ?></td>
					<td align="center">
						<a href="<?php echo site_url('admin/cp/ceping_edit/'.$value['cp_id']) ?>">编辑</a>
						<a onclick="return confirm(\'确定要删除\');" href="<?php echo site_url('admin/cp/ceping_delete/'.$value['cat_id']) ?>">删除</a>
					</td>
				<tr>
				<?php endforeach;?>
			</table>
			<?php endforeach;?>
		</div>
	</div>
</div>