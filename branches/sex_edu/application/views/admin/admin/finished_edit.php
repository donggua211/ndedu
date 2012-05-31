<div id="nav">
	<div id="nav_left">
		<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
		<span class="action-span"> » <a href="<?php echo site_url('admin/student') ?>" target="main-frame">学员管理</a></span>
		<span class="action-span"> » <a href="<?php echo site_url('admin/student/one/'.$student['student_id']) ?>" target="main-frame"><?php echo $student['name'] ?></a></span>
		<span class="action-span"> » <a href="<?php echo site_url('admin/student/one/'.$student['student_id'].'/contract') ?>" target="main-frame">合同详细信息</a></span>
		 » 编辑已完成课时
	</div>
	<div id="nav_right">
		所在校区: <span><?php echo $student['branch_name'] ?></span>
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
		<div class="title margin_top">
			<span>添加已完成课时</span>
		</div>
		<form action="<?php echo site_url('admin/contract/finished_edit')?>" method="post">
		<table width="90%">
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>课时数: </td>
				<td>
					<input name="finished_hours" type="text" value="<?php echo (!empty($finished_info['finished_hours'])) ? $finished_info['finished_hours'] :''; ?>" size="20" /> 小时
				</td>
			</tr><tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>上课时间: </td>
				<td>
					<?php 
					list($s_date, $s_time) = explode(' ', $finished_info['start_time']);
					list($e_date, $e_time) = explode(' ', $finished_info['end_time']);
					list($s_h, $s_m, ) = explode(':', $s_time);
					list($e_h, $e_m, ) = explode(':', $e_time);
					
					?>
					日期：<input type="text" name="date" maxlength="60" size="10" value="<?php echo $s_date ?>" readonly="readonly" id="date" />，时间：从 <?php echo show_hour_options('start_hour', $s_h) ?>： <?php echo show_mins_options('start_mins', $s_m) ?> 到 <?php echo show_hour_options('end_hour', $e_h) ?> ： <?php echo show_mins_options('end_mins', $e_m) ?>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>上课老师: </td>
				<td>
					<select name="teacher_id">
						<option value='0'>请选择...</option>
						<?php
							foreach($staffs as $staff)
								echo '<option value="'.$staff['staff_id'].'" '.((isset($finished_info['teacher_id'])) ? ( ($staff['staff_id'] == $finished_info['teacher_id']) ? 'SELECTED' : '' ) : '').'>'.$staff['name'].'</option>';
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>科目: </td>
				<td>
					<select name="subject_id">
						<option value='0'>请选择...</option>
						<?php
							foreach($subjects as $subject)
								echo '<option value="'.$subject['subject_id'].'" '.((isset($finished_info['subject_id'])) ? ( ($subject['subject_id'] == $finished_info['subject_id']) ? 'SELECTED' : '' ) : '').'>'.$subject['subject_name'].'</option>';
						?>
					</select>
				</td>
			</tr>
		</table>
		<div class="button-div">
			<input type="hidden" value="<?php echo $student['student_id'] ?>" name="student_id">
			<input type="hidden" value="<?php echo $finished_info['finished_id'] ?>" name="finished_id">
			<input type="submit" class="button" value=" 确定 " name="submit">
			<input type="reset" class="button" value=" 重置 " name="reset">
		</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		//日期选择的事件
		$("#date").click(function(){
			showCalendar('date', '%Y-%m-%d', false, false, 'date');
		});
		
		//录课时，选择时间后，自动显示上课的时长
		 $("select[name='start_hour']").change(function(){ update_hours()});
		 $("select[name='start_mins']").change(function(){ update_hours()});
		 $("select[name='end_hour']").change(function(){ update_hours()});
		 $("select[name='end_mins']").change(function(){ update_hours()});
		 
		 //变更老师，显示科目
		 $("select[name='teacher_id']").change(function(){
			var teacher_id = parseInt($("select[name='teacher_id'] option:selected").val());
			$.post(site_url+"admin/ajax/get_subject_by_teacher", { staff_id: teacher_id},
			function (data, textStatus){
					$("select[name='subject_id'] option[value="+data+"]").attr("selected", "selected");
				
			}, "text");
		});
	});
	
	function update_hours()
	{
		var start_mins = parseInt($("select[name='start_mins'] option:selected").val());
		var end_mins = parseInt($("select[name='end_mins'] option:selected").val());
		
		var start_hour = $("select[name='start_hour'] option:selected").val();
		var end_hour = $("select[name='end_hour'] option:selected").val();
		if(start_hour.substring(0,1) == '0') {
			start_hour = parseInt(start_hour.substring(1));
		} else {
			start_hour = parseInt(start_hour);
		}
		if(end_hour.substring(0,1) == '0') {
			end_hour = parseInt(end_hour.substring(1));
		} else {
			end_hour = parseInt(end_hour);
		}
		
		if(start_hour > end_hour)
			return false;
		
		
		if(start_mins > end_mins)
		{
			end_hour = end_hour - 1;
			end_mins += 60;
		}
		
		var hour = (end_hour - start_hour) + round((end_mins - start_mins) / 60, 2);
		
		$("input[name='finished_hours']").val(hour);
	}
	
	function round(num,dec)
	{
		var sNum = num + ''; 
		var idx = sNum.indexOf("."); 
		if(idx<0)
			return num; 

		var n = sNum.length - idx -1; 
		
		if(dec < n){ 
			var e = Math.pow(10,dec); 
			return Math.round(num * e) / e; 
		}else{ 
			return num; 
		} 
	} 
</script>