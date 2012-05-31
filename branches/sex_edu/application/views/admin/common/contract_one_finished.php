<div id="nav">
	<div id="nav_left">
		<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
		<span class="action-span"> » <a href="<?php echo site_url('admin/student') ?>" target="main-frame">学员管理</a></span>
		<span class="action-span"> » <a href="<?php echo site_url('admin/student') ?>" target="main-frame">查看学员</a></span>
		<span class="action-span"> » <a href="<?php echo site_url('admin/student/one/'.$student['student_id'].'/contract') ?>" target="main-frame"><?php echo $student['name'] ?></a></span>
		 » 合同详细信息
	</div>
	<div id="nav_right">
		所在校区: <span><?php echo $student['branch_name'] ?></span>
	</div>
</div>
<div style="clear:both"></div>
<div id="main">
	<div id="main_navbar">
		<p>
			<span class="navbar-front"><a href="<?php echo site_url('admin/contract/one/'.$contract['contract_id'].'/finished') ?>">已学完课程</a></span>
			<span class="navbar-back"><a href="<?php echo site_url('admin/contract/one/'.$contract['contract_id'].'/refund') ?>">退费信息</a></span>
		</p>
	</div>
	
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		<div class="title">
			<span>合同基本信息</span>
		</div>
		<table width="90%">
			<tr>
				<td class="label" valign="top">合同时间: </td>
				<td>从: <?php echo $contract['start_time'] ?>到: <?php echo $contract['end_time'] ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">课程变化: </td>
				<td>共: <?php echo $contract['total_hours'] ?>小时</td>
			</tr>
			<tr>
				<td class="label" valign="top">合同金额: </td>
				<td>定金: <?php echo $contract['deposit'] ?>元, 全额: <?php echo $contract['contact_value'] ?>元</td>
			</tr>
			<tr>
				<td class="label" valign="top">签署者: </td>
				<td><?php echo $contract['name'] ?> </td>
			</tr>
		</table>
		<div class="title margin_top">
			<span>已学完课程</span>
		</div>
		<div id="listDiv" class="list-div">
			<table cellspacing='1' id="list-table">
				<tr>
					<th>上课老师</th>
					<th>课时</th>
					<th>科目</th>
					<th>时间</th>
					<?php
					//access control
					$CI = & get_instance();
					if($CI->admin_ac_contract->contract_finished_manage()):
					?>
					<th>时间</th>
					<?php endif; ?>
				</tr>
				<?php 
				$total_hour = 0;
				foreach($contract['finished'] as $finished): ?>
				<tr>
					<td align="center"><?php echo $finished['teacher_name'] ?></td>
					<td align="center"><?php echo $finished['finished_hours']; $total_hour += $finished['finished_hours']; ?>小时</td>
					<td align="center"><?php echo $finished['subject_name'] ?></td>
					<td align="center">
						<?php 
							list($start_date, $start_time) = explode(' ', $finished['start_time']);
							list($end_date, $end_time) = explode(' ', $finished['end_time']);
							
							if($start_date == $end_date)
								echo '<b>'.$start_date.'</b> '.$start_time.' 至 '.$end_time;
							else
								echo $start_date.' '.$start_time.' 至 '.$end_date.' '.$end_time;
						?>
					</td>
					<?php
					//access control
					$CI = & get_instance();
					if($CI->admin_ac_contract->contract_finished_manage()):
					?>
					<td align="center">
						<a href="<?php echo site_url('admin/contract/finished_edit/'.$finished['finished_id'].'/'.$student['student_id']); ?>">编辑</a>
						<a onclick="return confirm('确定要删除?');" href="<?php echo site_url('admin/contract/finished_del/'.$finished['finished_id'].'/'.$student['student_id']); ?>">删除</a>
					</td>
					<?php endif; ?>
				</tr>
				<?php endforeach; ?>
				
				<tr>
					<td align="right"><b>总计：</b></td>
					<td align="center"><b><?php echo $total_hour ?>小时</b></td>
					<td colspan="2"></td>
				</tr>
				
			</table>
		</div>
	</div>
</div>