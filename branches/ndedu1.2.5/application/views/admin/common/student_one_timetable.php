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
						echo '<td onmouseover="show_operation(\'' . $i.$j . '\')" onmouseout="hidden_operation(\'' . $i.$j . '\')">';
						if(isset($student['time_table'][$j][$i]))
						{
							echo '<div class="' . (($student['time_table'][$j][$i]['is_suspend'] == 0) ? 'timetable' : 'timetable_suspend') . '">';
							echo substr($student['time_table'][$j][$i]['start_time'], 0, -3) . ' 至 ' . substr($student['time_table'][$j][$i]['end_time'], 0, -3).'<br/>';
							echo $student['time_table'][$j][$i]['subject_name'] . '<br/>';
							echo $student['time_table'][$j][$i]['name'];
							
							//编辑区域
							echo '<div class="operation">';
							if($CI->admin_ac_timetable->view_student_timetable_opt($student['time_table'][$j][$i]['subject_id']))
							{
								echo '<div id="'. $i.$j.'" class="operation_inner">
										<a href="'.site_url('admin/timetable/edit/'.$student['time_table'][$j][$i]['timetable_id']).'"><img src="images/icon/edit.png" title="编辑"></a>';
								
								if($student['time_table'][$j][$i]['is_suspend'] == 0)
									echo '<a href="'.site_url('admin/timetable/suspend/'.$student['time_table'][$j][$i]['timetable_id']).'"><img src="images/icon/suspend.png" title="暂停课程" onclick="return confirm(\'确定要暂停课程?\');" ></a>';
								else
									echo '<a href="'.site_url('admin/timetable/unsuspend/'.$student['time_table'][$j][$i]['timetable_id']).'"><img src="images/icon/unsuspend.png" title="取消暂停" onclick="return confirm(\'确定要取消暂停?\');" ></a>';
								
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
		
		<?php
		if($CI->admin_ac_timetable->add_timetable()):
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
		<?php endif; ?>
	</div>
</div>

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
		var s_h = parseInt($("select[name='start_hour'] option:selected").val());
		var s_m = parseInt($("select[name='start_mins'] option:selected").val());
		var e_h = parseInt($("select[name='end_hour'] option:selected").val());
		var e_m = parseInt($("select[name='end_mins'] option:selected").val());
		
		if(s_h > e_h)
		{
			alert('上课的结束时间须大于开始时间');
			return false;
		}
		else if(s_h == e_h && s_m >= e_m)
		{
			alert('上课的结束时间须大于开始时间');
			return false;
		}
		
		return true;
	});
</script>