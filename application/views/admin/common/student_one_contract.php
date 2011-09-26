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
			<?php
			//access control
			$CI = & get_instance();
			if($CI->admin_ac_student->view_student_one_contract()):
			?>
			<span class="navbar-front"><a href="<?php echo site_url('admin/student/one/'.$student['student_id'].'/contract') ?>">合同信息</a></span>
			<?php endif; ?>
			<?php
			//access control
			$CI = & get_instance();
			if($CI->admin_ac_student->view_student_one_sms()):
			?>
			<span class="navbar-back"><a href="<?php echo site_url('admin/student/one/'.$student['student_id'].'/sms') ?>">短信记录</a></span>
			<?php endif; ?>
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
					<th>合同金额</th>
					<th>签署者</th>
					<th>操作</th>
				</tr>
				<?php foreach($student['contract'] as $contract): ?>
				<tr>
					<td>从: <?php echo $contract['start_time'] ?>到: <?php echo $contract['end_time'] ?></td>
					<td align="left">共: <?php echo $contract['total_hours'] ?>小时, 已学完<?php echo $contract['finished_hours'] ?>小时</td>
					<td align="left">剩余: <?php echo ($contract['total_hours'] - $contract['finished_hours'] - $contract['refund_hours']) ?>小时, 退费 <?php echo $contract['refund_hours'] ?>小时</td>
					<td align="left">定金: <?php echo $contract['deposit'] ?>元, 全额: <?php echo $contract['contact_value'] ?>元, 退费额: <?php echo $contract['refund_value'] ?></a></td>
					<td align="center"><?php echo $contract['name'] ?></a></td>
					<td align="center">
						<a href="<?php echo site_url('admin/contract/one/'.$contract['contract_id']) ?>">查看详情</a>
						<a href="<?php echo site_url('admin/contract/edit/'.$contract['contract_id']) ?>">编辑</a><br/>
						<?php
						//access control
						$CI = & get_instance();
						if($CI->admin_ac_student->view_student_one_contract_operation()):
						?>
						<a href="<?php echo site_url('admin/contract/one/'.$contract['contract_id'].'/refund/') ?>">添加退费</a>
						<a href="<?php echo site_url('admin/student/add_finished_hour/') ?>">添加完成课时</a>
						<?php endif; ?>
						
					</td>
				<?php endforeach; ?>
				</tr>
			</table>
		</div>
		<!-- 添加框 -->
		<div class="margin_top">
			<input type="button" value="添加新纪录" onclick="add_form_switch(this, 'add_contract')">
		</div>
		<div id="add_contract" style="display:none">
			<div class="title margin_top">
				<span>添加合同</span>
			</div>
			<form action="<?php echo site_url('admin/student/contract_add')?>" method="post">
			<table width="90%">
				<tr>
					<td class="label" valign="top"><span class="notice-star"> * </span>合同时间: </td>
					<td>
						从 <input type="text" name="start_time" maxlength="60" size="20" value="<?php echo (isset($new_contract['start_time'])) ? $new_contract['start_time'] :''; ?>" readonly="readonly" id="start_time_id" onclick="return showCalendar('start_time_id', '%Y-%m-%d', false, false, 'start_time_id');"/> 到 <input type="text" name="end_time" maxlength="60" size="20" value="<?php echo (isset($new_contract['end_time'])) ? $new_contract['end_time'] :''; ?>" readonly="readonly" id="end_time_id" onclick="return showCalendar('end_time_id', '%Y-%m-%d', false, false, 'end_time_id');" />

					</td>
				</tr>
				<tr>
					<td class="label" valign="top"><span class="notice-star"> * </span>详细信息: </td>
					<td>
						总时间为: <input name="total_hours" type="text" value="<?php echo (isset($new_contract['total_hours'])) ? $new_contract['total_hours'] :''; ?>" size="20" /> 小时<br/>
						总金额为: <input name="contact_value" type="text" value="<?php echo (isset($new_contract['contact_value'])) ? $new_contract['contact_value'] :''; ?>" size="20" /> 元. 其中押金: <input name="deposit" type="text" value="<?php echo (isset($new_contract['deposit'])) ? $new_contract['deposit'] :''; ?>" size="20" /> 元<br/>
						
					</td>
				</tr>	
			</table>
			<div class="button-div">
				<input type="hidden" value="<?php echo $student['student_id']; ?>" name="student_id">
				<input type="submit" class="button" value=" 确定 " name="submit">
				<input type="reset" class="button" value=" 重置 " name="reset">
			</div>
			</form>
		</div>
	</div>
</div>