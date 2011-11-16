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
			<span class="navbar-back"><a href="<?php echo site_url('admin/student/one/'.$student['student_id'].'/contract') ?>">合同信息</a></span>
			<?php endif; ?>
			<span class="navbar-front"><a href="<?php echo site_url('admin/student/one/'.$student['student_id'].'/timetable') ?>">课程表</a></span>
			<?php
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
		<div class="list-div">
			<table cellspacing='1' id="list-table">
				<tr>
					<th width="14%">星期一</th>
					<th width="14%">星期二</th>
					<th width="14%">星期三</th>
					<th width="14%">星期四</th>
					<th width="14%">星期五</th>
					<th width="14%">星期六</th>
					<th width="16%">星期日</th>
				</tr>
				
				<?php
				function cmp($a, $b)
				{
					if ($a['start_time'] == $b['start_time']) {
						return 0;
					}
					return ($a['start_time'] < $b['start_time']) ? -1 : 1;
				}
				
				//计算出最长的day
				$max = 0;
				foreach($student['time_table'] as $key => $val)
				{
					usort($student['time_table'][$key], "cmp");
					if(count($val) > $max)
						$max = count($val);
				}
				
				for($i = 0; $i < $max; $i++)
				{
					echo '<tr>';
					for($j = 1; $j <= 8; $j++)
					{
						echo '<td onmouseover="show_operation(\'' . $i.$j . '\')" onmouseout="hidden_operation(\'' . $i.$j . '\')" style="background-color:#'.($i % 2 == 0 ? 'FFFFFF' : 'FFFFC8').'">';
						if(isset($student['time_table'][$j][$i]))
						{
							echo '<div class="' . (($student['time_table'][$j][$i]['is_suspend'] == 0) ? 'timetable' : 'timetable_suspend') . '">';
							echo substr($student['time_table'][$j][$i]['start_time'], 0, -3) . ' 至 ' . substr($student['time_table'][$j][$i]['end_time'], 0, -3).'<br/>';
							echo $student['time_table'][$j][$i]['subject_name'] . '<br/>';
							echo $student['time_table'][$j][$i]['name'];
							
							if($CI->admin_ac_timetable->show_mobile_sms_button())
								echo '（'.$student['time_table'][$j][$i]['phone'].'）';
							
							//编辑区域
							echo '<div class="operation">';
							if($CI->admin_ac_timetable->view_student_timetable_opt($student['time_table'][$j][$i]['subject_id']))
							{
								echo '<div id="'. $i.$j.'" class="operation_inner">';
								
								if($CI->admin_ac_timetable->show_mobile_sms_button())
									echo '	<a href="'.site_url('admin/staff/one/'.$student['time_table'][$j][$i]['staff_id'].'/sms').'"><img src="images/icon/sms.png" title="发短信"></a>';
								
								echo '	<a href="'.site_url('admin/timetable/edit/'.$student['time_table'][$j][$i]['timetable_id']).'"><img src="images/icon/edit.png" title="编辑"></a>';
								
								/*
								if($student['time_table'][$j][$i]['is_suspend'] == 0)
									echo '<a href="'.site_url('admin/timetable/suspend/'.$student['time_table'][$j][$i]['timetable_id']).'"><img src="images/icon/suspend.png" title="暂停课程" onclick="return confirm(\'确定要暂停课程?\');" ></a>';
								else
									echo '<a href="'.site_url('admin/timetable/unsuspend/'.$student['time_table'][$j][$i]['timetable_id']).'"><img src="images/icon/unsuspend.png" title="取消暂停" onclick="return confirm(\'确定要取消暂停?\');" ></a>';
								*/
								
								if($student['time_table'][$j][$i]['is_suspend'] == 0)
									echo '<a href="javascript:void(0);" onclick="suspend_course('.$student['time_table'][$j][$i]['timetable_id'].');"><img src="images/icon/suspend.png" title="暂停课程"></a>';
								else
									echo '<a href="javascript:void(0);" onclick="unsuspend_course('.$student['time_table'][$j][$i]['timetable_id'].');"><img src="images/icon/unsuspend.png" title="暂停课程"></a>';
								
								
								
								echo '<a href="'.site_url('admin/timetable/delete/'.$student['time_table'][$j][$i]['timetable_id']).'"><img src="images/icon/del.png" title="删除" onclick="return confirm(\'确定要删除?\');" ></a>
									</div>';
							}
							echo '</div>';
							
							echo '</div>';
						}
						echo '</td>';
					}
					echo '</tr>';
				}
				?>
			</table>
		</div>
		
		<!--备注 -->
		<div style="margin-top:10px;">
			<b>备注：</b><br/>
			<?php echo (isset($student['timetable_remark'])) ? $student['timetable_remark'] : ''; ?>
		</div>
		
		<?php
		if($CI->admin_ac_timetable->add_timetable())
		{
		?>
			<!-- 添加框 -->
			<div>
				<div class="title margin_top">
					<span>添加课程表</span>
				</div>
				<form action="<?php echo site_url('admin/timetable/add')?>" method="post" id="form">
				<table width="90%">
					<tr>
						<td class="label" valign="top">学员：</td>
						<td><?php echo $student['name'] ?></td>
					</tr>
					<tr>
						<td class="label" valign="top"><span class="notice-star"> * </span>科目：</td>
						<td>
							<select name="subject_id">
								<option value='0'>请选择...</option>
								<?php
									foreach($subjects as $subject)
										echo '<option value="'.$subject['subject_id'].'">'.$subject['subject_name'].'</option>';
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
										echo '<option value="'.$staff['staff_id'].'">'.$staff['name'].'</option>';
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="label" valign="top"><span class="notice-star"> * </span>上课时间: </td>
						<td>
							<select name="day">
								<option value='1'>星期一</option>
								<option value='2'>星期二</option>
								<option value='3'>星期三</option>
								<option value='4'>星期四</option>
								<option value='5'>星期五</option>
								<option value='6'>星期六</option>
								<option value='7'>星期日</option>
							</select>
							时间：<?php echo show_hour_options('start_hour', '9') ?>： <?php echo show_mins_options('start_mins', '00') ?> 到 <?php echo show_hour_options('end_hour', '11') ?> ： <?php echo show_mins_options('end_mins', '00') ?>
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
			<div>
				<div class="title margin_top">
					<span>编辑备注</span>
				</div>
				<form action="<?php echo site_url('admin/student/update_timetable_remark')?>" method="post" id="form">
				<table width="90%">
					<tr>
						<td class="label" valign="top">备注: </td>
						<td><textarea name="timetable_remark" cols="50" rows="5"><?php echo (isset($student['timetable_remark'])) ? $student['timetable_remark'] : ''; ?></textarea></td>
					</tr>
				</table>
				<div class="button-div">
					<input type="hidden" value="<?php echo $student['student_id']; ?>" name="student_id">
					<input type="submit" class="button" value=" 确定 " name="submit">
					<input type="reset" class="button" value=" 重置 " name="reset">
				</div>
				</form>
			</div>
		<?php 
		}
		
		//分配老师
		if($CI->admin_ac_timetable->assign_teacher_to_student())
		{
		?>
			<div class="title margin_top" style="margin-bottom:10px">
				<span>分配学员</span>
			</div>
			<table cellpadding="0" align="center" border="0" cellspacing="0">
				<tr>
					<th align="center">未分配的老师</th>
					<th></th>
					<th align="center">已分配的老师</th>
				</tr>
				<tr>
					<td class="black" width="30%" align="center" height="150">
						<select id="fb_list" multiple="multiple" style="text-align:center;width:300px;height:150px;">
						<?php
						$student_teacher_ids = array_keys($student_teacher);
						foreach($teachers as $val)
						{
							if(in_array($val['staff_id'], $student_teacher_ids))
								continue;
							
							echo '<option value="'.$val['staff_id'].'">'.$val['name'].'</option>';
						}
						?>
						</select>
					</td>
					<td align="center">
						<input type="button" id="add" value="分配老师-->" /><br/>
						<input type="button" id="delete" value="<--取消分配老师 " />
					</td>
					<td class="black" width="30%" align="center">
						<select id="select_list" multiple="multiple" style=" text-align:center;width:300px;height:150px;">
						<?php
						foreach($student_teacher as $val)
							echo '<option value="'.$val['staff_id'].'">'.$val['name'].'</option>';
						?>
						</select>
					</td>
				</tr>
			</table>
		<?php
		}
		?>
	</div>
</div>

<div id="dialog-modal" title="Basic modal dialog" style="display:none"></div>

<script type="text/javascript">
	function show_operation(id)
	{
		$("#"+id).removeClass("operation_inner");
	}
	
	function hidden_operation(id)
	{
		$("#"+id).addClass("operation_inner");
	}
	
	//表单选项检查
	$("#form").submit(function(){
		//科目
		if($("select[name='subject_id'] option:selected").val() == 0)
		{
			alert('请选择科目');
			return false;
		}
		
		//上课老师
		if($("select[name='staff_id'] option:selected").val() == 0)
		{
			alert('请选择上课老师');
			return false;
		}
		
		//上课时间
		var s_h = $("select[name='start_hour'] option:selected").val();
		var s_m = $("select[name='start_mins'] option:selected").val();
		var e_h = $("select[name='end_hour'] option:selected").val();
		var e_m = $("select[name='end_mins'] option:selected").val();
		
		if(parseInt(s_h, 10) > parseInt(e_h, 10))
		{
			alert('上课的结束时间须大于开始时间');
			return false;
		}
		else if(parseInt(s_h, 10) == parseInt(e_h, 10) && parseInt(s_m, 10) >= parseInt(e_m, 10))
		{
			alert('上课的结束时间须大于开始时间');
			return false;
		}
		
		//检查学生和老师的时间冲突。
		//素养课
		var subject_id = $("select[name='subject_id'] option:selected").val();
		var day = $("select[name='day'] option:selected").val();
		var staff_id = $("select[name='staff_id'] option:selected").val();
		var student_id = $("input[name='student_id']").val();
		
		$.ajax({
			async: false,
			type: "POST",
			url: site_url+"admin/ajax/check_timetable",
			data: "subject_id"+subject_id+"&day="+day+"&staff_id="+staff_id+"&student_id="+student_id+"&s_t="+s_h+':'+s_m+"&e_t="+e_h+':'+e_m,
			success: function(msg){
				result = msg;
			}
		});
		
		if(result == 'OK')
			return true;
		else
		{
			alert(result);
			return false;
		}
		
		return false;
	});
	
	function check_days()
	{
		if($("input[name='days']").val() > 0)
		{
			return true;
		}
		else
		{
			$("#warning").html('<img src="images/icon/warning.gif" style="vertical-align:middle">请填写时间');
			$("input[name='days']").focus();
			return false;
		}
	}
	
	
	function suspend_course(timetable_id)
	{
		$( "#dialog-modal" ).html('<div style="margin:10px"><form action="<?php echo site_url('admin/timetable/suspend/')?>" method="post" id="suspend_form" onSubmit="return check_days()">共暂停 <input type="text" name="days"> 天<input type="hidden" name="timetable_id" value="'+timetable_id+'"></form><div id="warning" style="margin:10px;color:red"></div></div>');
		
		$( "#dialog-modal" ).dialog({
			title: '暂停课程',
			width: 350,
			modal: true,
			show: 'slide',
			hide: 'fade',
			buttons: {
				"确定": function() {
					$( "#suspend_form" ).submit();
				},
				"取消": function() {
					$( this ).dialog( "close" );
				},
			},
		});
	}
	
	function unsuspend_course(timetable_id)
	{
		$( "#dialog-modal" ).html('<div style="margin:10px">确定要取消暂停该课程？<form action="<?php echo site_url('admin/timetable/unsuspend/')?>" method="post" id="unsuspend_form"><input type="hidden" name="timetable_id" value="'+timetable_id+'"></form></div>');
		
		$( "#dialog-modal" ).dialog({
			title: '取消暂停课程',
			width: 350,
			modal: true,
			show: 'slide',
			hide: 'fade',
			buttons: {
				"确定": function() {
					$( "#unsuspend_form" ).submit();
				},
				"取消": function() {
					$( this ).dialog( "close" );
				},
			},
		});
	}
	
	
	$(function(){
		$("#add").click(function(){
			$( "#dialog-modal" ).html('<img src="images/icon/wait.gif" alt="Loading..." />');
			$( "#dialog-modal" ).dialog({
				title: '请等待',
				width: 500,
				modal: true,
				show: 'slide',
				hide: 'fade',
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
						url: site_url+"admin/ajax/update_student_teacher",
						data: "student_id="+<?php echo $student['student_id']; ?>+"&staff_id="+$(this).val()+"&type="+<?php echo $student['student_teacher_type'] ?>+"&action=add",
						success: function(data)
						{
							if(data != 'OK')
								result = false;
						}
					});
					
					if(result)
					{
						$("#select_list").append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option");
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
				hide: 'fade',
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
						url: site_url+"admin/ajax/update_student_teacher",
						data: "student_id="+<?php echo $student['student_id']; ?>+"&staff_id="+$(this).val()+"&type="+<?php echo $student['student_teacher_type'] ?>+"&action=del",
						success: function(msg){
							if(data != 'OK')
								result = false;
						}
					});
					
					if(result)
					{
						$("#fb_list").append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option");
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
</script>