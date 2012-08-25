<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/classroom') ?>" target="main-frame">班级管理</a></span>
	» 添加班级
	<div style="clear:both"></div>
</div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		
		<form action="<?php echo site_url('admin/classroom/add') ?>" method="post">
		<table width="90%" id="shop_info-table">
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>班级名: </td>
				<td><input name="classroom_name" type="text" value="<?php echo (isset($class['classroom_name'])) ? $class['classroom_name'] :''; ?>" size="40" /></td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>任课老师: </td>
				<td>
					<select id="subject_id" name="subject_id">
						<?php
							foreach($subjects as $subject)
							{
								echo '<option value="'.$subject['subject_id'].'" '. (($subject['subject_id'] == SUBJECT_SUYANG) ? 'SELECTED' : '' ) .'>'.$subject['subject_name'].'</option>';
							}
						?>
					</select>
					
					<select id="staff_id" name="staff_id">
						<?php
							foreach($teachers as $staff)
								echo '<option value="'.$staff['staff_id'].'">'.$staff['name'].'</option>';
						?>
					</select>
					
				</td>
			</tr>
			<tr>
				<td class="label" valign="top">上课时间: </td>
				<td>
					<select name="day">
							<option value='1' <?php echo ((isset($class['day'])) ? ( ($class['day'] == 1) ? 'SELECTED' : '' ) : '') ?>>星期一</option>
							<option value='2' <?php echo ((isset($class['day'])) ? ( ($class['day'] == 2) ? 'SELECTED' : '' ) : '') ?>>星期二</option>
							<option value='3' <?php echo ((isset($class['day'])) ? ( ($class['day'] == 3) ? 'SELECTED' : '' ) : '') ?>>星期三</option>
							<option value='4' <?php echo ((isset($class['day'])) ? ( ($class['day'] == 4) ? 'SELECTED' : '' ) : '') ?>>星期四</option>
							<option value='5' <?php echo ((isset($class['day'])) ? ( ($class['day'] == 5) ? 'SELECTED' : '' ) : '') ?>>星期五</option>
							<option value='6' <?php echo ((isset($class['day'])) ? ( ($class['day'] == 6) ? 'SELECTED' : '' ) : '') ?>>星期六</option>
							<option value='7' <?php echo ((isset($class['day'])) ? ( ($class['day'] == 7) ? 'SELECTED' : '' ) : '')?>>星期日</option>
						</select>
						时间：<?php echo show_hour_options('start_hour', '') ?>： <?php echo show_mins_options('start_mins', '00') ?> 到 <?php echo show_hour_options('end_hour', '') ?> ： <?php echo show_mins_options('end_mins', '00') ?>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top">开班时间: </td>
				<td>
					<input type="text" name="start_date" readonly="readonly" id="start_date" size="12" value="<?php echo (isset($class['start_date'])) ? $class['start_date'] :''; ?>" onclick="showCalendar('start_date', '%Y-%m-%d', false, false, 'start_date');" />
				</td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>添加学员: </td>
				<td>
					<b>未报名学员:</b><br/>
					<?php foreach($student_signup as $one): ?>
						<input type="checkbox" name="student_id[]" value="<?php echo $one['student_id'] ?>" checked="checked"><?php echo $one['name'] ?>
					<?php endforeach;?>
					<hr/>
					<b>已报名学员:</b><br/>
					<?php foreach($student_learning as $one): ?>
						<input type="checkbox" name="student_id[]" value="<?php echo $one['student_id'] ?>" checked="checked"><?php echo $one['name'] ?>
					<?php endforeach;?>
				</td>
			</tr>
		</table>
		<div class="button-div">
			<input type="submit" class="button" value=" 确定 " name="submit">
			<input type="reset" class="button" value=" 重置 " name="reset">
		</div>
		</form>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$("#subject_id").change(function(){
			$.ajax({
				async: false,
				type: "POST",
				url: site_url+"admin/ajax/get_staff_by_subject",
				data: "subject_id="+$(this).val(),
				dataType: 'json',
				success: function(data){
					$("#staff_id").empty();
					$.each(data, function(i, field){
						var html = '';
						html += "<option value='"+field.staff_id+"' ";						
						html += ">"+field.name+"</option>";
						
						$("#staff_id").append(html);
					});
				}
			});
				
		})
	})
	
</script>