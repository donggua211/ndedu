<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/staff') ?>" target="main-frame">员工管理</a></span>
	 » 查看投诉
	<div style="clear:both"></div>
</div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		<div class="title margin_top">
			<span>"<?php echo $staff_info['name'] ?>"的投诉</span>
		</div>
		<div id="listDiv" class="list-div">
			<table cellspacing='1' id="list-table">
				<tr>
					<th>投诉时间</th>
					<th>投诉原因</th>
					<th>操作</th>
				</tr>
				<?php foreach($complains as $complain): ?>
				<tr>
					<td><?php echo $complain['add_time'] ?></td>
					<td><?php echo $complain['complain_reason'] ?></td>
					<td align="center">
						<a href="<?php echo site_url('admin/complain/edit/'.$complain['complain_id']) ?>">编辑</a>
						<a onclick="return confirm('确定要删除?');" href="<?php echo site_url('admin/complain/delete/'.$complain['complain_id']) ?>">删除</a>
					</td>
				<?php endforeach; ?>
				</tr>
			</table>
		</div>
		
		<div class="title margin_top">
			<span>添加投诉</span>
		</div>
		<form action="<?php echo site_url('admin/complain/add')?>" method="post">
		<table width="90%">
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>投诉员工: </td>
				<td>
					<?php echo $staff_info['name']; ?>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>投诉原因: </td>
				<td>
					<textarea name="complain_reason" cols="50" rows="5"><?php echo (isset($complain['complain_reason'])) ? $complain['complain_reason'] :''; ?></textarea>
				</td>
			</tr>	
		</table>
		<div class="button-div">
			<input type="hidden" value="<?php echo $staff_info['staff_id']; ?>" name="staff_id">
			<input type="submit" class="button" value=" 确定 " name="submit">
			<input type="reset" class="button" value=" 重置 " name="reset">
		</div>
		</form>
	</div>
</div>