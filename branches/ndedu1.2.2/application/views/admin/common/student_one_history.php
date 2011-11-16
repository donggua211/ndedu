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
			<span class="navbar-front"><a href="<?php echo site_url('admin/student/one/'.$student['student_id'].'/history') ?>">详细信息</a></span>
			<?php if(is_admin() || is_school_admin() || is_consultant() || is_supervisor()): //权限: 超级管理员, 校区管理员, 咨询师可以查看/编辑合同信息?>
			<span class="navbar-back"><a href="<?php echo site_url('admin/student/one/'.$student['student_id'].'/contract') ?>">合同信息</a></span>
			<?php endif; ?>
		</p>
	</div>
	
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		<?php if(is_admin() || is_school_admin() || is_consultant() || is_cs()): //权限: 超级管理员, 校区管理员, 咨询师可以查看/编辑联系历员工?>
		<div class="title">
			<span>联系历史</span>
		</div>
		<div id="listDiv" class="list-div">
			<table cellspacing='1' id="list-table">
				<tr>
					<th>联系历史</th>
					<th>添加时间</th>
					<th>咨询师</th>
					<th>操作</th>
				</tr>
				<?php foreach($student['history_contact'] as $contact): ?>
				<tr>
					<td class="first-cell" ><span onclick="listTable.edit(this,'edit_name', 1)"><?php echo $contact['history_contact'] ?></span></td>
					<td align="center"><span onclick="listTable.edit(this,'edit_order', 1)"><?php echo $contact['add_time'] ?></span></td>
					<td align="center"><span onclick="listTable.edit(this,'edit_order', 1)"><?php echo $contact['name'] ?></span></td>
					<td align="center">
						<a href="<?php echo site_url('admin/history/edit_contact/'.$contact['history_contact_id']) ?>">编辑</a>
						<a onclick="return confirm('确定要删除?');" href="<?php echo site_url('admin/history/delete_contact/'.$contact['history_contact_id']) ?>">删除</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
		
		<!-- 添加框 -->
		<div class="margin_top">
			<input type="button" value="添加新纪录" onclick="add_form_switch(this, 'add_contact')">
		</div>
		<div id="add_contact" style="display:none">
			<div class="title margin_top">
				<span>添加联系历史</span>
			</div>
			<table>
				<tr><td>
					<form action="<?php echo site_url('admin/student/history_add')?>" method="post">
						<textarea name="history" cols="80" rows="5"></textarea>
						<input type="hidden" name="history_type" value="contact">
						<input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>"><br/>
						<input type="checkbox" name="add_calendar" value="1" <?php echo (isset($student['add_calendar']) && !empty($student['add_calendar'])) ? 'CHECKED' :''; ?>>同时添加到日程: 
						<input type="text" name="start_date" readonly="readonly" id="start_date" size="12" value="<?php echo (isset($student['start_date'])) ? $student['start_date'] :''; ?>" onclick="showCalendar('start_date', '%Y-%m-%d', false, false, 'start_date');" />
						<?php echo show_hour_options('start_hour', $student['start_hour']) ?> : 
						<?php echo show_mins_options('start_mins', $student['start_mins']) ?>
						到
						<input type="text" name="end_date" readonly="readonly" id="end_date" size="12" value="<?php echo (isset($student['end_date'])) ? $student['end_date'] :''; ?>" onclick="showCalendar('end_date', '%Y-%m-%d', false, false, 'end_date');" />
						<?php echo show_hour_options('end_hour', $student['end_hour']) ?> : 
						<?php echo show_mins_options('end_mins', $student['end_mins']) ?><br/>
					<input type="submit" class="button" value="添加" name="submit">
					</form>
				</td></tr>
			</table>
		</div>
		<?php endif; ?>
		<?php if(is_admin() || is_school_admin() || is_supervisor()): //权限: 超级管理员, 校区管理员, 咨询师可以查看/编辑联系历员工?>
		<div class="title margin_top">
			<span>学习历史</span>
		</div>
		<div id="listDiv" class="list-div">
			<table cellspacing='1' id="list-table">
				<tr>
					<th>学习历史</th>
					<th>添加时间</th>
					<th>班主任</th>
					<th>操作</th>
				</tr>
				<?php foreach($student['history_learning'] as $learning): ?>
				<tr>
					<td class="first-cell" ><span onclick="listTable.edit(this,'edit_name', 1)"><?php echo $learning['history_learning'] ?></span></td>
					<td align="center"><span onclick="listTable.edit(this,'edit_order', 1)"><?php echo $learning['add_time'] ?></span></td>
					<td align="center"><span onclick="listTable.edit(this,'edit_order', 1)"><?php echo $learning['name'] ?></span></td>
					<td align="center">
						<a href="<?php echo site_url('admin/history/edit_learning/'.$learning['history_learning_id']) ?>">编辑</a>
						<a onclick="return confirm('确定要删除?');" href="<?php echo site_url('admin/history/delete_learning/'.$learning['history_learning_id']) ?>">删除</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
		
		<!-- 添加框 -->
		<div class="margin_top">
			<input type="button" value="添加新纪录" onclick="add_form_switch(this, 'add_learning')">
		</div>
		<div id="add_learning" style="display:none">
			<div class="title margin_top">
				<span>添加学习历史</span>
			</div>
			<table>
				<tr><td colspan="4">
					<form action="<?php echo site_url('admin/student/history_add')?>" method="post">
						<textarea name="history" cols="80" rows="5"></textarea>
						<input type="hidden" name="history_type" value="learning">
						<input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>"><br/>
						<input type="checkbox" name="add_calendar" value="1" <?php echo (isset($student['add_calendar']) && !empty($student['add_calendar'])) ? 'CHECKED' :''; ?>>同时添加到日程:
						<input type="text" name="start_date" readonly="readonly" id="start_date" size="12" value="<?php echo (isset($student['start_date'])) ? $student['start_date'] :''; ?>" onclick="showCalendar('start_date', '%Y-%m-%d', false, false, 'start_date');" />
						<?php echo show_hour_options('start_hour', $student['start_hour']) ?> : 
						<?php echo show_mins_options('start_mins', $student['start_mins']) ?>
						到
						<input type="text" name="end_date" readonly="readonly" id="end_date" size="12" value="<?php echo (isset($student['end_date'])) ? $student['end_date'] :''; ?>" onclick="showCalendar('end_date', '%Y-%m-%d', false, false, 'end_date');" />
						<?php echo show_hour_options('end_hour', $student['end_hour']) ?> : 
						<?php echo show_mins_options('end_mins', $student['end_mins']) ?><br/>
						<input type="submit" class="button" value="添加" name="submit">
					</form>
				</td></tr>
			</table>
		</div>
		<?php endif; ?>
	</div>
</div>