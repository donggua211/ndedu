<div id="nav">
	<div id="nav_left">
		<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
		<span class="action-span"> » <a href="<?php echo site_url('admin/staff') ?>" target="main-frame">员工管理</a></span>
		 » <?php echo $staff['name'] ?>
	</div>
	<div id="nav_right">
		所在校区: <span><?php echo $staff['branch_name'] ?></span>
	</div>
</div>
<div style="clear:both"></div>
<div id="main">
	<div id="main_navbar">
		<p>
			<span class="navbar-back"><a href="<?php echo site_url('admin/staff/one/'.$staff['staff_id']) ?>">基本信息</a></span>
			
			<span class="navbar-back"><a href="<?php echo site_url('admin/staff/one/'.$staff['staff_id'].'/schedule') ?>">时间表</a></span>
			
			<span class="navbar-front"><a href="<?php echo site_url('admin/staff/one/'.$staff['staff_id'].'/timetable') ?>">课程表</a></span>
			
			<?php
			//access control
			$CI = & get_instance();
			if($CI->admin_ac_staff->view_staff_one_sms()):
			?>
			<span class="navbar-back"><a href="<?php echo site_url('admin/staff/one/'.$staff['staff_id'].'/sms') ?>">短信记录</a></span>
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
					<th width="14%">星期日</th>
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
				foreach($time_table as $key => $val)
				{
					usort($time_table[$key], "cmp");
					if(count($val) > $max)
						$max = count($val);
				}
				
				for($i = 0; $i < $max; $i++)
				{
					echo '<tr>';
					for($j = 1; $j <= 8; $j++)
					{
						echo '<td style="background-color:#'.($i % 2 == 0 ? 'FFFFFF' : 'FFFFC8').'">';
						if(isset($time_table[$j][$i]))
						{
							echo '<div class="' . (($time_table[$j][$i]['is_suspend'] == 0) ? 'timetable' : 'timetable_suspend') . '">';
							echo '<span class="subject">' . substr($time_table[$j][$i]['start_time'], 0, -3) . ' 至 ' . substr($time_table[$j][$i]['end_time'], 0, -3).'<br/>';
							echo '<span class="subject">' . $time_table[$j][$i]['subject_name'] . '</span><br/>';
							echo '<span class="name">' . $time_table[$j][$i]['name'] . '</span>';
							echo '</div>';
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