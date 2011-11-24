<div id="nav">
	<div id="nav_left">
		<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
		<span class="action-span"> » <a href="<?php echo site_url('admin/calendar') ?>" target="main-frame">日程管理</a></span>
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
		
		<div id="listDiv" class="list-div">
			<table cellspacing='1' id="list-table">
				<tr>
					<th width="9%"></th>
					<th width="13%">星期一</th>
					<th width="13%">星期二</th>
					<th width="13%">星期三</th>
					<th width="13%">星期四</th>
					<th width="13%">星期五</th>
					<th width="13%">星期六</th>
					<th width="13%">星期日</th>
				</tr>
				
				<?php
				function cmp($a, $b)
				{
					if ($a['start_time'] == $b['start_time']) {
						return 0;
					}
					return ($a['start_time'] < $b['start_time']) ? -1 : 1;
				}
					
				ksort($all_time_table);
				foreach($all_time_table as $time_q => $time_table)
				{
					echo '<tr><th>';
					switch($time_q)
					{
						case 1:
							echo '上午';
							break;
						case 2:
							echo '下午';
							break;
						case 3:
							echo '晚上';
							break;
					}
					echo '</th>';
					
					for($i = 1; $i <= 7; $i++)
					{
						echo '<td>';
						
						if(isset($time_table[$i]))
						{
							$suspend_hour = 0;
							$suspend_mins = 0;
							$hour = 0;
							$mins = 0;
							foreach($time_table[$i] as $val)
							{
								list($s_h, $s_m) = explode(':', $val['start_time']);
								list($e_h, $e_m) = explode(':', $val['end_time']);
								
								if($val['is_suspend'] == 1)
								{
									$suspend_hour += $e_h - $s_h;
									$suspend_mins += $e_m - $s_m;
								}
								
								$hour += $e_h - $s_h;
								$mins += $e_m - $s_m;
							}
							
							$hour += (floor($mins / 60) > 0) ? (floor($mins / 60)) : 0;
							$mins = $mins % 60;
							
							echo '<a href="javascript:void(0)" onclick="show_timetable('.$time_q.', '.$i.')">共: <b>'.$hour.'</b> 小时'.(($mins > 0) ? '<b>'.$mins.'</b>分钟' : '').'课时。';
							if($suspend_hour >0 || $suspend_mins > 0)
								echo '<br/>已暂停的课时：<b>'.$suspend_hour.'</b> 小时'.(($suspend_mins > 0) ? '<b>'.$suspend_mins.'</b>分钟' : '').'课时。';
							echo '</a>';
						}
						echo '</td>';
					}
					echo '</tr>';
				}
				?>
			</table>
		</div>
		
	</div>
</div>
<?php
foreach($all_time_table as $time_q => $time_table)
{
	for($i = 1; $i <= 7; $i++)
	{
		if(isset($time_table[$i]))
		{
			echo '
			<div id="dialog-modal-'.$time_q.$i.'" title="Basic modal dialog" style="display:none">
				<table cellspacing="1" class="list-div">
					<tr>
						<th>学员</th>
						<th>老师</th>
						<th>学科</th>
						<th>上课时间</th>
					</tr>';
					foreach($time_table[$i] as $val)
					{
						echo '<tr>';
							echo '<td '.(($val['is_suspend'] == 1) ? 'style="background:#666;color:#FFF"' : '').'>'.$val['name'].'</td>';
							echo '<td '.(($val['is_suspend'] == 1) ? 'style="background:#666;color:#FFF"' : '').'>'.$val['staff_name'].'</td>';
							echo '<td '.(($val['is_suspend'] == 1) ? 'style="background:#666;color:#FFF"' : '').'>'.$val['subject_name'].'</td>';
							echo '<td '.(($val['is_suspend'] == 1) ? 'style="background:#666;color:#FFF"' : '').'>'.$val['start_time'].'至'.$val['end_time'].'</td>';
						echo '</tr>';
					}
			echo '
				</table>
			</div>';
		}
	}
}
?>

<script type="text/javascript">
	function show_timetable(time_q, day)
	{
		$( "#dialog-modal-"+time_q+day ).dialog({
			title: '课程表',
			width: 500,
			modal: true,
			show: 'slide',
			hide: 'fade'
		});
	}
</script>