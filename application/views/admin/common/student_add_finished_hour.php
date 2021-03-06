<div id="nav">
	<div id="nav_left">
		<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
		<span class="action-span"> » <a href="<?php echo site_url('admin/student') ?>" target="main-frame">学员管理</a></span>
		 » 添加完成课时
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
		<form action="<?php echo site_url('admin/contract/finished_add')?>" method="post">
		<table width="90%">
			<!-- 学员 -->
			<tr><td class="label" valign="top"><span class="notice-star"> * </span>学员: </td>
				<td>
				<select name="student_id" id="student_id">
					<option value='0'>请选择...</option>
					<?php
						foreach($student as $val)
							echo '<option value="'.$val['student_id'].'">'.$val['name'].'</option>';
					?>
				</select>
				</td>
			</tr>
			
			<!-- 合同 -->
			<tr><td class="label" valign="top"><span class="notice-star"> * </span>合同: </td>
				<td>
				<select name="contract_id" id="contract_id">
					<option value='0'>请选择...</option>
				</select>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>课时数: </td>
				<td>
					<input name="finished_hours" type="text" value="<?php echo (!empty($new_finished['finished_hours'])) ? $new_finished['finished_hours'] :''; ?>" size="20" /> 小时
				</td>
			</tr><tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>上课时间: </td>
				<td>
					日期：<input type="text" name="date" maxlength="60" size="10" value="" readonly="readonly" id="date" />，时间：从 <?php echo show_hour_options('start_hour', '9') ?>： <?php echo show_mins_options('start_mins', '00') ?> 到 <?php echo show_hour_options('end_hour', '11') ?> ： <?php echo show_mins_options('end_mins', '00') ?>
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
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>科目: </td>
				<td>
					<select name="subject_id">
						<option value='0'>请选择...</option>
						<?php
							foreach($subjects as $subject)
								echo '<option value="'.$subject['subject_id'].'" '.((isset($new_finished['subject_id'])) ? ( ($subject['subject_id'] == $new_finished['subject_id']) ? 'SELECTED' : '' ) : '').'>'.$subject['subject_name'].'</option>';
						?>
					</select>
				</td>
			</tr>
		</table>
		<div class="button-div">
			<input type="hidden" value="0" name="supervisor_id" id="supervisor_id">
			<input type="submit" class="button" value=" 确定 " name="submit">
			<input type="reset" class="button" value=" 重置 " name="reset">
		</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	function change_student(student_id){
		$("#contract_id").empty();
		
		//更新 supervisor_id 
		update_supervisor_id(student_id);
		
		//ajax获取合同信息
		$.post(site_url+"admin/ajax/get_contracts", { student_id: student_id},
			function (data, textStatus){
				$.each(data, function(i, field){
					$("#contract_id").append("<option value='"+field.contract_id+"'>从"+field.start_time+"到"+field.end_time+"</option>");
				});
		}, "json");
	}
	
	function update_supervisor_id(student_id)
	{
		var student_consultant = new Array();
		<?php
		foreach($student as $val)
			echo "student_consultant[{$val['student_id']}] = '{$val['supervisor_id']}';\n";
		?>
		$("#supervisor_id").val(student_consultant[student_id]);
	}
	
	$(document).ready(function(){
		//更新用户名的事件
		$("#student_id").change(function(){
			var student_id = $("#student_id option:selected").val();
			if(student_id > 0)
				change_student(student_id);
		});
		
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