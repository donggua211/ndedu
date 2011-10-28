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
			
			<span class="navbar-front"><a href="<?php echo site_url('admin/staff/one/'.$staff['staff_id'].'/schedule') ?>">时间表</a></span>
			
			<span class="navbar-back"><a href="<?php echo site_url('admin/staff/one/'.$staff['staff_id'].'/timetable') ?>">课程表</a></span>
			
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
					<th width="12.5%"></th>
					<?php 
					$days = array('星期一', '星期二', '星期三', '星期四', '星期五', '星期六', '星期日');
					foreach($days as $key => $val)
					{
						echo '<th width="12.5%" align="left"><span style="float:left">'.$val.'</span>';
						if($CI->admin_ac_timetable->show_schedule_opts())
						{
							echo '<div class="schedule_opt operation_inner">';
							echo '	<a href="javascript:void(0);" onClick="change_schedule(\'day\', '.($key+1).', 1)"><img src="images/icon/unsuspend.png" title="有空"></a>';
							echo '	<a href="javascript:void(0);" onClick="change_schedule(\'day\', '.($key+1).', 0)"><img src="images/icon/suspend.png" title="没空"></a>
								 </div>';
						}
						echo '</th>';
					}
					?>
				</tr>
				
				<?php
				for($hour = 8; $hour <= 22; $hour++)
				{
					echo '<tr>';
					echo '<td style="background-color:#'.($hour % 2 == 0 ? 'FFFFFF' : 'FFFFC8').'" ><span>'.str_pad ($hour, 2, '0', STR_PAD_LEFT).'点</span>';
					if($CI->admin_ac_timetable->show_schedule_opts())
					{
						echo '<div class="schedule_opt operation_inner">';
						echo '	<a href="javascript:void(0);" onClick="change_schedule(\'hour\', '.$hour.', 1)"><img src="images/icon/unsuspend.png" title="有空"></a>';
						echo '	<a href="javascript:void(0);" onClick="change_schedule(\'hour\', '.$hour.', 0)"><img src="images/icon/suspend.png" title="没空"></a>
							 </div>';
					}
					echo '</td>';
					
					for($day = 1; $day <=7; $day++)
					{
						echo '<td style="background-color:#'.($schedule[$day][$hour] == SCHEDULE_UNAVAILABLE ? ($hour % 2 == 0 ? 'FFFFFF' : 'FFFFC8') : ($schedule[$day][$hour] == SCHEDULE_AVAILABLE ? '00FF33' : 'FF0000')).'" id="'.$day.$hour.'"> ';
						if($CI->admin_ac_timetable->show_schedule_opts())
						{
							echo '<div class="schedule_opt operation_inner">';
							echo '	<a href="javascript:void(0);" onClick="change_schedule(\'day_hour\', \''.$day.'_'.$hour.'\', 1)"><img src="images/icon/unsuspend.png" title="有空"></a>';
							echo '	<a href="javascript:void(0);" onClick="change_schedule(\'day_hour\', \''.$day.'_'.$hour.'\', 0)"><img src="images/icon/suspend.png" title="没空"></a>
								 </div>';
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

<script type="text/javascript">
	$(document).ready(function(){
		$("table tr td span").css('margin-left', '35%');
		$("table tr th span").css('margin-left', '20%');
		
		$.each( $("table th:gt(0)"), function(i, n){
			$(n).mouseover(function(){
				$(n).children("div").removeClass("operation_inner");
			});
			$(n).mouseout(function(){
				$(n).children("div").addClass("operation_inner");
			});
		});
		
		$.each( $("table tr td"), function(i, n){
			$(n).mouseover(function(){
				$(n).children("div").removeClass("operation_inner");
			});
			$(n).mouseout(function(){
				$(n).children("div").addClass("operation_inner");
			});
		});
	});
	
	function change_schedule(type, schedule, status)
	{
		var staff_id = <?php echo $staff['staff_id']; ?>
		
		$.post(site_url+"admin/ajax/update_schedule", { staff_id: staff_id, type: type, schedule: schedule, status: status},
		function (data, textStatus){
			alert(data);		
		}, "text");
	}
</script>
