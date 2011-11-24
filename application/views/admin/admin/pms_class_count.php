<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/pms') ?>" target="main-frame">工资管理系统 </a></span>
	 » 课时统计系统
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
		
		 <form action="<?php echo site_url('admin/pms/class_count')?>" method="POST" name="searchForm">
			<img src="images/admin/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
			<select name="year">
				<?php
					for($i = 2010; $i <= date('Y'); $i++)
						echo '<option value="'.$i.'" '.($i == $filter['year'] ? 'SELECTED' : '').'>'.$i.'</option>';
				?>
			</select>
			
			<select name="month">
				<?php
					for($i = 1; $i <= 12; $i++)
						echo '<option value="'.$i.'" '.($i == $filter['month'] ? 'SELECTED' : '').'>'.$i.'月</option>';
				?>
			</select>
			
			<select name="week">
				<option value="0">不选择</option>
				<?php
					for($i = 1; $i <= 6; $i++)
						echo '<option value="'.$i.'" '.($i == $filter['week'] ? 'SELECTED' : '').'>第'.$i.'周</option>';
				?>
			</select>
			
			<input type="submit" value=" 搜索 " class="button" />
		  </form>
		
		<div id="listDiv" class="list-div">
			<div style="margin:10px; font-size:16px; color:#333; text-align:center">
				<?php echo '查询时间是：'.$filter['start_date'].'至'.$filter['end_date'];?>
			</div>
			<table cellspacing='1' id="list-table" style="width:600px; text-align:center" align="center">
				<tr>
					<th></th>
					<th></th>
					<th>课程表数据源</th>
					<th>课时单数据源</th>
					<th>比较结果</th>
					<th>教案数据源</th>
				</tr>
				
				<?php
				foreach($tt_res_arr as $staff_id => $one_teacher_tt)
				{
					echo '<tr><td rowspan="'.(count($one_teacher_tt)+1).'">'.$staff_info[$staff_id].'</td></tr>';
					
					foreach($one_teacher_tt as $student_id => $one_student_tt)
					{
						echo '<tr><td>'.$student_info[$student_id].'</td>';
						
						//课程表数据
						$tt_hour = 0;
						$tt_mins = 0;
						if(isset($one_student_tt) && !empty($one_student_tt))
							foreach($one_student_tt as $val)
							{
								list($s_h, $s_m) = explode(':', $val['start_time']);
								list($e_h, $e_m) = explode(':', $val['end_time']);
								$tt_hour += $e_h - $s_h;
								$tt_mins += $e_m - $s_m;
								
								$pop_window_data[$staff_id][$student_id][$val['class_date']][$val['start_time']]['tt'] = $val;
							
							}
						$tt_hour += (floor($tt_hour / 60) > 0) ? (floor($tt_hour / 60)) : 0;
						$tt_mins = $tt_mins % 60;
						
						
						//课时单数据
						$cf_hour = 0;
						$cf_mins = 0;
						if(isset($cf_res_arr[$staff_id][$student_id]) && !empty($cf_res_arr[$staff_id][$student_id]))
							foreach($cf_res_arr[$staff_id][$student_id] as $val)
							{
								$cf_hour += $val['finished_hours'];
								
								list($class_date, $start_time) = explode(' ', $val['start_time']);
								$has_used = false;
								if(isset($pop_window_data[$staff_id][$student_id][$class_date]))
									foreach($pop_window_data[$staff_id][$student_id][$class_date] as $time => $temp)
									{
										if(abs($start_time - $time) <= 1)
										{
											$pop_window_data[$staff_id][$student_id][$class_date][$time]['cf'] = $val;
											$has_used = true;
											break 1;
										}
									}
								if(!$has_used)
									$pop_window_data[$staff_id][$student_id][$class_date][$start_time]['cf'] = $val;
							}
						
						$cf_mins = floor(($cf_hour - floor($cf_hour)) * 6);
						$cf_hour = floor($cf_hour);
						
						
						//教案数据
						$history_count = 0;
						if(isset($history_res_arr[$staff_id][$student_id]) && !empty($history_res_arr[$staff_id][$student_id]))
							foreach($history_res_arr[$staff_id][$student_id] as $val)
							{
								$history_count ++;
							}
						
						$cf_mins = floor(($cf_hour - floor($cf_hour)) * 6);
						$cf_hour = floor($cf_hour);
						
						
						
						echo '<td><a href="javascript:void(0)" onclick="show_detail('.$staff_id.', '.$student_id.')">'.$tt_hour.'小时'.(($tt_mins > 0) ? $tt_mins.'分钟' : '').'</a></td>';
						echo '<td><a href="javascript:void(0)" onclick="show_detail('.$staff_id.', '.$student_id.')">'.$cf_hour.'小时'.(($cf_mins > 0) ? $cf_mins.'分钟' : '').'</a></td>';
						
						echo '<td>'.abs($tt_hour - $cf_hour).'小时'.'</td>';
						echo '<td>'.$history_count.'次'.'</td>';
						
						echo '</tr>'; 
					}
				}
				?>
			</table>
		</div>
	</div>
</div>
<?php
if(isset($pop_window_data) && !empty($pop_window_data))
foreach($pop_window_data as $staff_id => $student_data)
{
	foreach($student_data as $student_id => $one_student)
	{
		echo '
		<div id="dialog-modal-'.$staff_id.$student_id.'" title="Basic modal dialog" style="display:none">
			<div style="margin:5px; color:#333; text-align:center">
				学员：'.$student_info[$student_id].' 
				<span style="margin-left:30px">老师：'.$staff_info[$staff_id].'</span>
			</div>
			<table cellspacing="1" class="list-div">
				<tr>
					<th>日期</th>
					<th>学科</th>
					<th>课程表数据</th>
					<th>课时单数据源</th>
				</tr>';
		
		foreach($one_student as $date => $time)
		{
			echo '<tr><td rowspan="'.(count($time)+1).'">'.$date.'</td></tr>';
			
			foreach($time as $one)
			{
				echo '<tr>';
				echo '<td>'.$subject_info[$staff_id.$student_id].'</td>';
				
				if(isset($one['tt']))
				{
					list($s_hour, $s_mins,) = explode(':', $one['tt']['start_time']);
					list($e_hour, $e_mins,) = explode(':', $one['tt']['end_time']);
					echo '<td>'.$s_hour.':'.$s_mins.'至'.$e_hour.':'.$e_mins.'</td>';
				}
				else
					echo '<td></td>';
				
				if(isset($one['cf']))
				{
					list($s_day, $s_time) = explode(' ', $one['cf']['start_time']);
					list($e_day, $e_time) = explode(' ', $one['cf']['end_time']);
					
					list($s_hour, $s_mins,) = explode(':', $s_time);
					list($e_hour, $e_mins,) = explode(':', $e_time);
					
					echo '<td>'.$s_hour.':'.$s_mins.'至'.$e_hour.':'.$e_mins.'</td>';
				}
				else
					echo '<td></td>';
				
				echo '</tr>';
			}
		}
		
		echo '
			</table>
		</div>';
	}
}

?>

<script type="text/javascript">
	function show_detail(staff_id, student_id)
	{
		$( "#dialog-modal-"+staff_id+student_id ).dialog({
			title: '课程表',
			width: 500,
			modal: true,
			show: 'slide',
			hide: 'fade',
		});
	}
</script>