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
			<?php
			//access control
			$CI = & get_instance();
			if($CI->admin_ac_student->view_student_one_contract()):
			?>
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
		
		<?php
		//循环输出历史
		$history = array('contact' => '联系历史', 'learning' => '学习历史', 'consult' => '咨询历史', 'suyang' => '素养历史', 'callback' => '回访历史');
		foreach($history as $history_type => $history_text):
			if($CI->admin_ac_student->history_ac($history_type, $student['status']) >= HISTORY_R ): //可读 
		?>
			<div class="title margin_top">
				<span><?php echo $history_text; ?></span>
			</div>
			<div id="listDiv" class="list-div">
				<table cellspacing='1' id="list-table">
					<tr>
						<th><?php echo $history_text; ?></th>
						<th>添加时间</th>
						<th>添加员工</th>
						<th>操作</th>
					</tr>
					<?php foreach($student['history_'.$history_type] as $history): ?>
					<tr>
						<td class="first-cell" ><?php echo $history['history_'.$history_type] ?></td>
						<td align="center"><?php echo $history['add_time'] ?></td>
						<td align="center"><?php echo $history['name'] ?></td>
						<td align="center">
						<?php if($history['staff_id'] == $student['this_staff_id']): ?>
							<a href="<?php echo site_url('admin/history/edit/'.$history_type.'/'.$history['history_'.$history_type.'_id']) ?>">编辑</a>
							<a onclick="return confirm('确定要删除?');" href="<?php echo site_url('admin/history/delete/'.$history_type.'/'.$history['history_'.$history_type.'_id']) ?>">删除</a>
						<?php endif; ?>
						</td>
					</tr>
					<?php endforeach; ?>
				</table>
			</div>
			<!-- 添加框 -->
			<?php if($CI->admin_ac_student->history_ac($history_type, $student['status']) >= HISTORY_WR ): //可读 ?>
			<div class="margin_top">
				<input type="button" value="添加新<?php echo $history_text; ?>" onclick="add_form_switch(this, 'add_<?php echo $history_type; ?>')">
			</div>
			<div id="add_<?php echo $history_type; ?>" style="display:none">
				<div class="title margin_top">
					<span>添加<?php echo $history_text; ?></span>
				</div>
				<table>
					<tr><td>
						<form action="<?php echo site_url('admin/student/history_add')?>" method="post">
							<textarea name="history" cols="80" rows="5"></textarea>
							<input type="hidden" name="history_type" value="<?php echo $history_type; ?>">
							<input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>"><br/>
							<input type="checkbox" name="add_calendar" value="1" <?php echo (isset($student['add_calendar']) && !empty($student['add_calendar'])) ? 'CHECKED' :''; ?>>同时添加到日程: 
							<input type="text" name="start_date" readonly="readonly" id="start_date_<?php echo $history_type; ?>" size="12" value="<?php echo (isset($student['start_date'])) ? $student['start_date'] :''; ?>" onclick="showCalendar('start_date_<?php echo $history_type; ?>', '%Y-%m-%d', false, false, 'start_date');" />
							<?php echo show_hour_options('start_hour', $student['start_hour']) ?> : 
							<?php echo show_mins_options('start_mins', $student['start_mins']) ?>
							到
							<input type="text" name="end_date" readonly="readonly" id="end_date_<?php echo $history_type; ?>" size="12" value="<?php echo (isset($student['end_date'])) ? $student['end_date'] :''; ?>" onclick="showCalendar('end_date_<?php echo $history_type; ?>', '%Y-%m-%d', false, false, 'end_date');" />
							<?php echo show_hour_options('end_hour', $student['end_hour']) ?> : 
							<?php echo show_mins_options('end_mins', $student['end_mins']) ?><br/>
						<input type="submit" class="button" value="添加" name="submit">
						</form>
					</td></tr>
				</table>
			</div>
			<?php endif; ?>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div>