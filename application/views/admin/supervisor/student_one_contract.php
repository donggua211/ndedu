<div id="nav">
	<div id="nav_left">
		<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
		<span class="action-span"> » <a href="<?php echo site_url('admin/student') ?>" target="main-frame">学员管理</a></span>
		 » <?php echo $student['name'] ?>
	</div>
	<div id="nav_right">
		所在校区: <span><?php echo $student['branch_name'] ?></span>
	</div>
</div>
<div style="clear:both"></div>
<div id="main">
	<div id="main_navbar">
		<p>
			<span class="navbar-back"><a href="<?php echo site_url('admin/student/one/'.$student['student_id']) ?>">基本信息</a></span>
			<span class="navbar-back"><a href="<?php echo site_url('admin/student/one/'.$student['student_id'].'/history') ?>">详细信息</a></span>
			<span class="navbar-front"><a href="<?php echo site_url('admin/student/one/'.$student['student_id'].'/contract') ?>">合同信息</a></span>
		</p>
	</div>
	
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		<div id="listDiv" class="list-div">
			<table cellspacing='1' id="list-table">
				<tr>
					<th>合同时间</th>
					<th>课程变化</th>
					<th>目前状态</th>
					<th>操作</th>
				</tr>
				<?php foreach($student['contract'] as $contract): ?>
				<tr>
					<td>从: <?php echo $contract['start_time'] ?>到: <?php echo $contract['end_time'] ?></td>
					<td align="left">共: <?php echo $contract['total_hours'] ?>小时, 已学完<?php echo $contract['finished_hours'] ?>小时</td>
					<td align="left">剩余: <?php echo ($contract['total_hours'] - $contract['finished_hours'] - $contract['refund_hours']) ?>小时, 退费 <?php echo $contract['refund_hours'] ?>小时</td>
					<td align="center">
						<a href="<?php echo site_url('admin/contract/one/'.$contract['contract_id']) ?>">查看详情</a>
					</td>
				<?php endforeach; ?>
				</tr>
			</table>
		</div>
	</div>
</div>