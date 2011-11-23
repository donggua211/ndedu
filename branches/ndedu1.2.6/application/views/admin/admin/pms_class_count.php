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
		
		<div id="listDiv" class="list-div">
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
								$pop_window_data[$staff_id][$student_id][$class_date][$start_time]['cf'] = $val;
							}
						$cf_mins = floor(($cf_hour - floor($cf_hour)) * 6);
						$cf_hour = floor($cf_hour);
						
						echo '<td><a href="javascript:void(0)" onclick="show_detail('.$staff_id.', '.$student_id.')">'.$tt_hour.'小时'.(($tt_mins > 0) ? $tt_mins.'分钟' : '').'</a></td>';
						echo '<td><a href="javascript:void(0)" onclick="show_detail('.$staff_id.', '.$student_id.')">'.$cf_hour.'小时'.(($cf_mins > 0) ? $cf_mins.'分钟' : '').'</a></td>';
						
						echo '<td>'.($tt_hour - $cf_hour).'小时'.'</td>';
						echo '<td>0</td>';
						
						echo '</tr>'; 
					}
				}
				?>
				
			</table>
		</div>
		
	</div>
</div>
<?php
foreach($pop_window_data as $staff_id => $student_data)
{
	foreach($student_data as $student_id => $one_student)
	{
		echo '
		<div id="dialog-modal-'.$staff_id.$student_id.'" title="Basic modal dialog" style="display:none">
			学员：'.$student_info[$student_id].'<br/>
			老师：'.$staff_info[$staff_id].'<br/>
			<table cellspacing="1" class="list-div">
				<tr>
					<th>学科</th>
					<th>课程表数据</th>
					<th>课时单数据源</th>
				</tr>';
		
		foreach($one_student as $date => $val)
		{
			var_dump($val);
			
		
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