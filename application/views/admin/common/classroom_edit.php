<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/classroom') ?>" target="main-frame">班级管理</a></span>
	 » <?php echo $class['classroom_name'] ?>
	<div style="clear:both"></div>
</div>
<div style="clear:both"></div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		
		<form action="<?php echo site_url('admin/classroom/edit') ?>" method="post">
		<table width="90%" id="shop_info-table">
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>班级名: </td>
				<td><input name="classroom_name" type="text" value="<?php echo (isset($class['classroom_name'])) ? $class['classroom_name'] :''; ?>" size="40" /></td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>任课老师: </td>
				<td>
					<select name="subject_id" id="subject_id">
						<?php
							foreach($subjects as $subject)
							{
								echo '<option value="'.$subject['subject_id'].'" '. (($subject['subject_id'] == $class['subject_id']) ? 'SELECTED' : '' ) .'>'.$subject['subject_name'].'</option>';
							}
						?>
					</select>
					
					<select name="staff_id" id="staff_id">
						<?php
							foreach($teachers as $staff)
								echo '<option value="'.$staff['staff_id'].'" '. (($staff['staff_id'] == $class['staff_id']) ? 'SELECTED' : '' ) .'>'.$staff['name'].'</option>';
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
						时间：<?php list($s_h, $s_m,) = explode(':', $class['start_time']); list($e_h, $e_m,) = explode(':', $class['end_time']); echo show_hour_options('start_hour', $s_h) ?>： <?php echo show_mins_options('start_mins', $s_m) ?> 到 <?php echo show_hour_options('end_hour', $e_h) ?> ： <?php echo show_mins_options('end_mins', $e_m) ?>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top">开班时间: </td>
				<td>
					<input type="text" name="start_date" readonly="readonly" id="start_date" size="12" value="<?php echo (isset($class['start_date'])) ? $class['start_date'] :''; ?>" onclick="showCalendar('start_date', '%Y-%m-%d', false, false, 'start_date');" />
				</td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>导入学员: </td>
				<td>
					<table cellpadding="0" align="center" border="0" cellspacing="0">
						<tr>
							<th align="center">未分配的学员</th>
							<th></th>
							<th align="center">已分配的学员</th>
						</tr>
						<tr>
							<td class="black" width="30%" align="center" height="150">
								<select id="fb_list" multiple="multiple" style="text-align:center;width:300px;height:150px;">
								<?php
								if(is_array($class['classroom_student']))
									$student_ids = array_keys($class['classroom_student']);
								
								foreach($student as $val)
								{
									if(isset($student_ids) && is_array($student_ids) && in_array($val['student_id'], $student_ids))
										continue;
									
									echo '<option value="'.$val['student_id'].'">'.$val['name'].'</option>';
								}
								?>
								</select>
							</td>
							<td align="center">
								<input type="button" id="add" value="添加-->" /><br/>
								<input type="button" id="delete" value="<--删除 " />
							</td>
							<td class="black" width="30%" align="center">
								<select id="select_list" multiple="multiple" style=" text-align:center;width:300px;height:150px;">
								<?php
								if(is_array($class['classroom_student']))
								{
									foreach($class['classroom_student'] as $val)
										echo '<option value="'.$val['student_id'].'">'.$val['name'].'</option>';
								}
								?>
								</select>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<div class="button-div">
			<input type="hidden" value="<?php echo $class['classroom_id'] ?>" name="classroom_id">
			<input type="submit" class="button" value=" 确定 " name="submit">
			<input type="reset" class="button" value=" 重置 " name="reset">
		</div>
		</form>
	</div>
</div>

<div id="dialog-modal" title="Basic modal dialog" style="display:none"></div>

<script type="text/javascript">
	
	$(function(){
		$("#add").click(function(){
			$( "#dialog-modal" ).html('<img src="images/icon/wait.gif" alt="Loading..." />');
			$( "#dialog-modal" ).dialog({
				title: '请等待',
				width: 500,
				modal: true,
				show: 'slide',
				hide: 'fade'
			});
			$( "#dialog-modal" ).dialog("enable");
			
			if($("#fb_list option:selected").length>0)
			{
				var msg = '';
				
				$("#fb_list option:selected").each(function()
				{
					var result = true;
					$.ajax({
						async: false,
						type: "POST",
						url: site_url+"admin/ajax/update_classroom_student",
						data: "classroom_id="+<?php echo $class['classroom_id']; ?>+"&student_id="+$(this).val()+"&action=add",
						success: function(data)
						{
							if(data != 'OK')
								result = false;
						}
					});
					
					if(result)
					{
						$("#select_list").append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");
						$(this).remove();
					}
					else
						msg += $(this).text()+', ';
					
				})
				
				if(msg != '')
					$( "#dialog-modal" ).html('<img src="images/icon/warning.gif" style="vertical-align:middle"> 部分老师没有更新成功：'+msg);
				else
					$( "#dialog-modal" ).html('<img src="images/icon/ok.gif" style="vertical-align:middle"> 更新成功');
				
			}
			else
			{
				$( "#dialog-modal" ).html('<img src="images/icon/warning.gif" style="vertical-align:middle"> 请选择老师！');
			}
		})
	})

	$(function(){
		$("#delete").click(function(){
			$( "#dialog-modal" ).html('<img src="images/icon/wait.gif" alt="Loading..." />');
			$( "#dialog-modal" ).dialog({
				title: '处理中..',
				width: 500,
				modal: true,
				show: 'slide',
				hide: 'fade'
			});
			$( "#dialog-modal" ).dialog("enable");
			
			if($("#select_list option:selected").length>0)
			{
				var msg = '';
				
				$("#select_list option:selected").each(function()
				{
					var result = true;
					$.ajax({
						async: false,
						type: "POST",
						url: site_url+"admin/ajax/update_classroom_student",
						data: "classroom_id="+<?php echo $class['classroom_id']; ?>+"&student_id="+$(this).val()+"&action=del",
						success: function(data){
							if(data != 'OK')
								result = false;
						}
					});
					
					if(result)
					{
						$("#fb_list").append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");
						$(this).remove();
					}
					else
						msg += $(this).text()+', ';
				})
				
				if(msg != '')
					$( "#dialog-modal" ).html('<img src="images/icon/warning.gif" style="vertical-align:middle"> 部分老师没有更新成功：'+msg);
				else
					$( "#dialog-modal" ).html('<img src="images/icon/ok.gif" style="vertical-align:middle"> 更新成功');
			}
			else
			{
				$( "#dialog-modal" ).html('<img src="images/icon/warning.gif" style="vertical-align:middle"> 请选择老师！');
			}
		})
	})
	
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
					var select_staff = <?php echo $class['staff_id']; ?>;
					$.each(data, function(i, field){
						var html = '';
						html += "<option value='"+field.staff_id+"' ";
						if(select_staff == field.staff_id)
							html += " SELECTED='SELECTED' ";
						
						html += ">"+field.name+"</option>";
						
						$("#staff_id").append(html);
					});
				}
			});
				
		})
	})
	
</script>