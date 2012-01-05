<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/hr') ?>" target="main-frame">HR系统 </a></span>
	 » 职位列表
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
					<th>职位名称</th>
					<th>部门</th>
					<th>操作</th>
				</tr>
				<?php foreach($positions as $val): ?>
				<tr>
					<td><?php echo $val['position_name']; ?></td>
					<td><?php echo str_replace('主管', '组', $val['group_name']); ?></td>
					
					<td align="center">
						<a href="<?php echo site_url('admin/hr_position/edit/'.$val['position_id']) ?>">编辑</a>
						<a onclick="return confirm('确定要删除?');" href="<?php echo site_url('admin/hr_position/delete/'.$val['position_id']) ?>">删除</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		  </form>
		</div>
	</div>
</div>