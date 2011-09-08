<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/tags') ?>"  target="main-frame">tag管理</a></span>
	 » 查看tag
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
					<th>tag名称</th>
					<th>管理</th>
				</tr>
				<?php foreach($tags as $tag): ?>
					<tr>
						<td class="first-cell" align="left"><?php echo $tag['tag_name'] ?></td>
						<td align="center">
							<a href="<?php echo site_url('/admin/tags/edit/'.$tag['tag_id']) ?>">编辑</a> / 
							<a onclick="return confirm('确定要删除, 删除后将无法回复?');" href="<?php echo site_url('/admin/tags/delete/'.$tag['tag_id']) ?>">彻底删除</a>
						</td>
					</tr>
				<?php endforeach;?>
			</table>
		</div>
	</div>
</div>