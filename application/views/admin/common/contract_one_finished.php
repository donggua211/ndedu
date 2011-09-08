<div id="nav">
	<div id="nav_left">
		<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
		<span class="action-span"> » <a href="<?php echo site_url('admin/student') ?>" target="main-frame">学员管理</a></span>
		<span class="action-span"> » <a href="<?php echo site_url('admin/student') ?>" target="main-frame">查看学员</a></span>
		<span class="action-span"> » <a href="<?php echo site_url('admin/student/one/'.$student['student_id'].'/contract') ?>" target="main-frame"><?php echo $student['name'] ?></a></span>
		 » 合同详细信息
	</div>
	<div id="nav_right">
		所在校区: <span><?php echo $student['branch_name'] ?></span>
	</div>
</div>
<div style="clear:both"></div>
<div id="main">
	<div id="main_navbar">
		<p>
			<span class="navbar-front"><a href="<?php echo site_url('admin/contract/one/'.$contract['contract_id'].'/finished') ?>">已学完课程</a></span>
			<span class="navbar-back"><a href="<?php echo site_url('admin/contract/one/'.$contract['contract_id'].'/refund') ?>">退费信息</a></span>
		</p>
	</div>
	
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		<div class="title">
			<span>合同基本信息</span>
		</div>
		<table width="90%">
			<tr>
				<td class="label" valign="top">合同时间: </td>
				<td>从: <?php echo $contract['start_time'] ?>到: <?php echo $contract['end_time'] ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">课程变化: </td>
				<td>共: <?php echo $contract['total_hours'] ?>小时</td>
			</tr>
			<tr>
				<td class="label" valign="top">合同金额: </td>
				<td>定金: <?php echo $contract['deposit'] ?>元, 全额: <?php echo $contract['contact_value'] ?>元</td>
			</tr>
			<tr>
				<td class="label" valign="top">签署者: </td>
				<td><?php echo $contract['name'] ?> </td>
			</tr>
		</table>
		<div class="title margin_top">
			<span>已学完课程</span>
		</div>
		<div id="listDiv" class="list-div">
			<table cellspacing='1' id="list-table">
				<tr>
					<th>上课老师</th>
					<th>班主任</th>
					<th>课时</th>
					<th>添加时间</th>
				</tr>
				<?php foreach($contract['finished'] as $finished): ?>
				<tr>
					<td align="center"><?php echo $finished['teacher_name'] ?></td>
					<td align="center"><?php echo $finished['supervisor_name'] ?></td>
					<td align="center"><?php echo $finished['finished_hours'] ?></td>
					<td align="center"><?php echo $finished['add_time'] ?></td>
				<?php endforeach; ?>
				</tr>
			</table>
		</div>
		<div class="title margin_top">
			<span>添加已完成课时</span>
		</div>
		<form action="<?php echo site_url('admin/contract/finished_add')?>" method="post">
		<table width="90%">
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>课时数: </td>
				<td>
					<input name="finished_hours" type="text" value="<?php echo (!empty($new_finished['finished_hours'])) ? $new_finished['finished_hours'] :''; ?>" size="20" /> 小时
				</td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>班主任: </td>
				<td>
					<?php echo $student['supervisor']['name'];?>
					<input type="hidden" name="supervisor_id" value="<?php echo $student['supervisor']['staff_id'];?>">
				</td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>上课老师: </td>
				<td>
					<select name="teacher_id">
						<option value='0'>请选择...</option>
						<?php
							foreach($staffs as $staff)
								echo '<option value="'.$staff['staff_id'].'" '.((isset($new_finished['teacher_id'])) ? ( ($staff['staff_id'] == $new_finished['teacher_id']) ? 'SELECTED' : '' ) : '').'>'.$staff['name'].'</option>';
						?>
					</select>
				</td>
			</tr>
		</table>
		<div class="button-div">
			<input type="hidden" value="<?php echo $contract['contract_id']; ?>" name="contract_id">
			<input type="submit" class="button" value=" 确定 " name="submit">
			<input type="reset" class="button" value=" 重置 " name="reset">
		</div>
		</form>
	</div>
</div>