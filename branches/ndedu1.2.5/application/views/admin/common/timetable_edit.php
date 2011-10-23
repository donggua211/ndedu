<div id="nav">
	<div id="nav_left">
		<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
		<span class="action-span"> » <a href="<?php echo site_url('admin/student') ?>" target="main-frame">学员管理</a></span>
		<span class="action-span"> » <a href="<?php echo site_url('admin/student/one/'.$timetable_info['student_id'].'/timetable') ?>" target="main-frame"><?php echo $timetable_info['name'] ?></a></span>
		 » 课程表
	</div>
</div>
<div style="clear:both"></div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		
		<div>
			<form action="<?php echo site_url('admin/timetable/edit/'.$timetable_info['timetable_id'])?>" method="post">
			<table width="90%">
				<tr>
					<td class="label" valign="top">学员：</td>
					<td><?php echo $timetable_info['name'] ?></td>
				</tr>
				<tr>
					<td class="label" valign="top"><span class="notice-star"> * </span>科目：</td>
					<td>
						<select name="subject_id">
							<option value='0'>请选择...</option>
							<?php
								foreach($subjects as $subject)
									echo '<option value="'.$subject['subject_id'].'" '.((isset($timetable_info['subject_id'])) ? ( ($timetable_info['subject_id'] == $subject['subject_id']) ? 'SELECTED' : '' ) : '').'>'.$subject['subject_name'].'</option>';
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="label" valign="top"><span class="notice-star"> * </span>上课老师：</td>
					<td>
						<select name="staff_id">
							<option value='0'>请选择...</option>
							<?php
								foreach($teachers as $staff)
									echo '<option value="'.$staff['staff_id'].'" '.((isset($timetable_info['staff_id'])) ? ( ($timetable_info['staff_id'] == $staff['staff_id']) ? 'SELECTED' : '' ) : '').'>'.$staff['name'].'</option>';
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="label" valign="top"><span class="notice-star"> * </span>上课时间: </td>
					<td>
						<select name="day">
							<option value='1' <?php echo ((isset($timetable_info['day'])) ? ( ($timetable_info['day'] == 1) ? 'SELECTED' : '' ) : '') ?>>星期一</option>
							<option value='2' <?php echo ((isset($timetable_info['day'])) ? ( ($timetable_info['day'] == 2) ? 'SELECTED' : '' ) : '') ?>>星期二</option>
							<option value='3' <?php echo ((isset($timetable_info['day'])) ? ( ($timetable_info['day'] == 3) ? 'SELECTED' : '' ) : '') ?>>星期三</option>
							<option value='4' <?php echo ((isset($timetable_info['day'])) ? ( ($timetable_info['day'] == 4) ? 'SELECTED' : '' ) : '') ?>>星期四</option>
							<option value='5' <?php echo ((isset($timetable_info['day'])) ? ( ($timetable_info['day'] == 5) ? 'SELECTED' : '' ) : '') ?>>星期五</option>
							<option value='6' <?php echo ((isset($timetable_info['day'])) ? ( ($timetable_info['day'] == 6) ? 'SELECTED' : '' ) : '') ?>>星期六</option>
							<option value='7' <?php echo ((isset($timetable_info['day'])) ? ( ($timetable_info['day'] == 7) ? 'SELECTED' : '' ) : '')?>>星期日</option>
						</select>
						时间：<?php list($s_h, $s_m,) = explode(':', $timetable_info['start_time']); list($e_h, $e_m,) = explode(':', $timetable_info['end_time']); echo show_hour_options('start_hour', $s_h) ?>： <?php echo show_mins_options('start_mins', $s_m) ?> 到 <?php echo show_hour_options('end_hour', $e_h) ?> ： <?php echo show_mins_options('end_mins', $e_m) ?>
					</td>
				</tr>	
			</table>
			<div class="button-div">
				<input type="hidden" value="<?php echo $timetable_info['timetable_id']; ?>" name="timetable_id">
				<input type="submit" class="button" value=" 确定 " name="submit">
				<input type="reset" class="button" value=" 重置 " name="reset">
			</div>
			</form>
	</div>
</div>