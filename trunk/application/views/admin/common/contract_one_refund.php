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
			<span class="navbar-back"><a href="<?php echo site_url('admin/contract/one/'.$contract['contract_id'].'/finished') ?>">已学完课程</a></span>
			<span class="navbar-front"><a href="<?php echo site_url('admin/contract/one/'.$contract['contract_id'].'/refund') ?>">退费信息</a></span>
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
			<span>退费信息</span>
		</div>
		<div id="listDiv" class="list-div">
			<table cellspacing='1' id="list-table">
				<tr>
					<th>所退课时</th>
					<th>所退金额</th>
					<th>退费原因</th>
					<th>退费时间</th>
					<th>退费责任人</th>
				</tr>
				<?php foreach($contract['refund'] as $refund): ?>
				<tr>
					<td align="center"><?php echo $refund['refund_hours'] ?>小时</td>
					<td align="center"><?php echo $refund['refund_value'] ?>元</td>
					<td align="center"><?php echo $refund['refund_reason'] ?></td>
					<td align="center"><?php echo $refund['add_time'] ?></td>
					<td align="center">
						<?php
							echo (!empty($refund['consultant_name'])) ? '<b>咨询师:</b> '.$refund['consultant_name'].'<br/>': '';
							echo (!empty($refund['supervisor_name'])) ? '<b>班主任:</b> '.$refund['supervisor_name'].'<br/>': '';
							echo (!empty($refund['teacher_name'])) ? '<b>任课老师:</b> '.$refund['teacher_name'].'<br/>': '';
						?>
					</td>
				<?php endforeach; ?>
				</tr>
			</table>
		</div>
		<div class="title margin_top">
			<span>添加退费</span>
		</div>
		<form action="<?php echo site_url('admin/contract/refund_add')?>" method="post">
		<table width="90%">
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>退费金额: </td>
				<td>
					<input name="refund_value" type="text" value="<?php echo (!empty($new_refund['refund_value'])) ? $new_refund['refund_value'] :''; ?>" size="20" /> 元
				</td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>课时数: </td>
				<td>
					<input name="refund_hours" type="text" value="<?php echo (!empty($new_refund['refund_hours'])) ? $new_refund['refund_hours'] :''; ?>" size="20" /> 小时
				</td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>退费原因: </td>
				<td><textarea name="refund_reason" cols="40" rows="5"><?php echo (isset($new_refund['refund_reason'])) ? $new_refund['refund_reason'] :''; ?></textarea></td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>咨询师老师: </td>
				<td>
					<?php echo $student['consultant']['name'];?>
					<input type="hidden" name="consultant_id" value="<?php echo $student['consultant']['staff_id'];?>">
					<br/><input type="checkbox" name="consultant" value="1"><font color="red">追求为退费责任人</font>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>班主任老师: </td>
				<td>
					<?php echo $student['supervisor']['name'];?>
					<input type="hidden" name="supervisor_id" value="<?php echo $student['supervisor']['staff_id'];?>">
					<br/><input type="checkbox" name="supervisor" value="1"><font color="red">追求为退费责任人</font>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>任课老师: </td>
				<td>
					<select name="teacher_id">
						<option value='0'>请选择...</option>
						<?php
							foreach($teachers as $teacher)
								echo '<option value="'.$teacher['staff_id'].'" '.((isset($new_refund['teacher_id'])) ? ( ($teacher['staff_id'] == $new_refund['teacher_id']) ? 'SELECTED' : '' ) : '').'>'.$teacher['name'].'</option>';
						?>
					</select>
					<br/><input type="checkbox" name="teacher" value="1"><font color="red">追求为退费责任人</font>
				</td>
			</tr>
		</table>
		<div class="button-div">
			<input type="hidden" value="<?php echo $contract['contract_id']; ?>" name="contract_id">
			<input type="hidden" value="<?php echo $contract['staff_id']; ?>" name="contract_staff_id">
			<input type="submit" class="button" value=" 确定 " name="submit">
			<input type="reset" class="button" value=" 重置 " name="reset">
		</div>
		</form>
	</div>
</div>