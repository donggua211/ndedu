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
			<span class="navbar-front"><a href="<?php echo site_url('admin/student/one/'.$student['student_id'].'/history') ?>">详细信息</a></span>
			<?php
			//access control
			$CI = & get_instance();
			if($CI->admin_ac_student->view_student_one_contract()):
			?>
			<span class="navbar-back"><a href="<?php echo site_url('admin/student/one/'.$student['student_id'].'/contract') ?>">合同信息</a></span>
			<?php endif; ?>
			
			<?php if($CI->admin_ac_student->view_student_one_timetable()): ?>
			<span class="navbar-back"><a href="<?php echo site_url('admin/student/one/'.$student['student_id'].'/timetable') ?>">课程表</a></span>
			<?php endif; ?>
			
			<?php if($CI->admin_ac_student->view_student_one_sms()): ?>
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
		
		<div id="listDiv" class="list-div">
			<?php
			//循环输出历史
			$history = array('contact' => '联系历史', 'learning' => '学习历史', 'consult' => '咨询历史', 'suyang' => '素养历史', 'callback' => '回访历史');
			
			foreach($history as $history_type => $history_text)
			{
				if($CI->admin_ac_student->history_ac($history_type, $student['status']) >= HISTORY_R )
				{ //可读 
			?>
					<div class="title margin_top">
						<span><?php echo $history_text; ?></span>
					</div>
					<?php 
					//回访历史 单独处理。
					if($history_type == 'callback')
					{ 
					?>
						<?php
						$callback_history = array('consult' => '咨询历史', 'suyang' => '素养历史'); 
						foreach($callback_history as $callback_history_type => $callback_history_text)
						{
						?>
						<table cellspacing='1' id="list-table">
							<tr>
								<th colspan="4"><?php echo $callback_history_text; ?></th>
							</tr>
						<?php
						if(!empty($student['history_'.$callback_history_type]))
						{
							$show_history_title = true;
							foreach($student['history_'.$callback_history_type] as $one_history)
							{
								if($show_history_title == true)
								{
									echo '
									<tr>
										<th>'.$callback_history_text.'</th>
										<th>添加时间</th>
										<th>添加员工</th>
										<th>操作</th>
									</tr>';
								}
							?>
								<tr>
									<td>
										<?php
											echo '<b>教学目标：</b><br/>'.nl2br($one_history['history_'.$callback_history_type.'_target']).'<br/>';
										?>
									</td>
									<td align="center"><?php echo $one_history['add_time'] ?></td>
									<td align="center"><?php echo $one_history['name'] ?></td>
									<td></td>
									</td>
								</tr>
							<?php
								$show_history_title = false;
								if(isset($one_history['callback_history']))
								{
									echo '<tr><th>回访历史</th><th></th><th></th><th></th></tr>';
									
									foreach($one_history['callback_history'] as $one_callback_history)
									{
										echo '
										<tr>
											<td>'.nl2br($one_callback_history['history_callback']).'</td>
											<td align="center">'.$one_callback_history['add_time'].'</td>
											<td align="center">'.$one_callback_history['name'].'</td>
											<td align="center">';
											
										if($one_callback_history['staff_id'] == $student['this_staff_id'])
										{
												echo '<a href="'.site_url('admin/history/edit/'.$history_type.'/'.$one_callback_history['history_'.$history_type.'_id']).'">编辑</a>
												<a onclick="return confirm(\'确定要删除?\');" href="'.site_url('admin/history/delete/'.$history_type.'/'.$one_callback_history['history_'.$history_type.'_id']).'">删除</a>';
										}
										
										echo '
											</td>
										</tr>';
									}
									
									$show_history_title = true;
								}
							}
							
							if($CI->admin_ac_student->history_ac($history_type, $student['status']) >= HISTORY_WR )//可读写
							{
							?>
								<form action="<?php echo site_url('admin/student/history_add')?>" method="post" enctype="multipart/form-data">
								<tr>
									<td colspan="4">
										<b>添加回访记录：</b><br/><textarea name="history" cols="100" rows="5"><?php echo (isset($student['history']) ? $student['history'] : '')?></textarea><br/>
										<span style="color:red">教学目标、教学氛围、老师评价、家长期望（尽可能用陈述性语句记录，避免个人情绪）</span>
										<input type="hidden" name="callback_history_type" value="<?php echo $callback_history_type; ?>">
										<input type="hidden" name="callback_history_id" value="<?php echo $one_history['history_'.$callback_history_type.'_id']; ?>">
										<input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>">
										<input type="hidden" name="history_type" value="callback">
										<input type="hidden" name="add_calendar" value="0">
									</td>
								</tr>
								<tr>
									<td colspan="4" align="center">
										<input type="submit" class="button" value="添加" name="submit">
									</td>
								</tr>
								</form>
						<?php
							}
						}
						else
						{
							echo '<tr><td colspan="3">暂无记录</td></tr>';
						}
						?>
						</table>
					<?php 
						}
					}
					//回访历史 处理结束
					//其他历史
					else
					{
					?>
						<table cellspacing='1' id="list-table">
							<tr>
								<th><?php echo $history_text; ?></th>
								<th>添加时间</th>
								<th>添加员工</th>
								<th>操作</th>
							</tr>
							<?php
							foreach($student['history_'.$history_type] as $history)
							{
							?>
							<tr>
								<td>
									<?php
									if($history_type == 'learning')
									{ 
										echo '<b>科目：</b>'.$history['history_learning_subject'].'<br/>';
										echo '<b>课时：</b>'.$history['history_learning_period'].'<br/>';
										echo '<b>日期：</b>'.$history['history_learning_date'].'<br/>';
										echo '<b>教材版本：</b>'.$history['history_learning_version'].'<br/>';
										echo '<b>授课描述和总结：</b><br/>'.nl2br($history['history_'.$history_type]);
									}
									elseif(in_array($history_type, array('consult', 'suyang')))
									{
										echo '<b>教学目标：</b><br/>'.nl2br($history['history_'.$history_type.'_target']).'<br/>';
										echo '<b>教学内容：</b><br/>'.nl2br($history['history_'.$history_type]);
										
										if(!empty($history['history_attachment_id']))
											echo '<b>附件：</b><a href="'.site_url('admin/history/download/'.$history['history_attachment_id'].'/'.$history_type).'" target="_blank">'.$history['attachment_name'].'</a>';
									}
									else
									{
										echo nl2br($history['history_'.$history_type]);
									}
									?>
								</td>
								<td align="center"><?php echo $history['add_time'] ?></td>
								<td align="center"><?php echo $history['name'] ?></td>
								<td align="center">
									<?php
									if($history['staff_id'] == $student['this_staff_id'])
									{
										echo '<a href="'.site_url('admin/history/edit/'.$history_type.'/'.$history['history_'.$history_type.'_id']).'">编辑</a>
										<a onclick="return confirm(\'确定要删除?\');" href="'.site_url('admin/history/delete/'.$history_type.'/'.$history['history_'.$history_type.'_id']).'">删除</a>';
									}
									?>
								</td>
							</tr>
							<?php } ?>
						</table>
						
						<!-- 添加框 -->
						<?php 
						if($CI->admin_ac_student->history_ac($history_type, $student['status']) >= HISTORY_WR )//可读写
						{
						?>
						<div class="margin_top">
							<input type="button" value="添加新<?php echo $history_text; ?>" onclick="add_form_switch(this, 'add_<?php echo $history_type; ?>', '<?php echo $history_text; ?>')">
						</div>
						<div id="add_<?php echo $history_type; ?>" style="display:none">
							<div class="title margin_top">
								<span>添加<?php echo $history_text; ?></span>
							</div>
							<table>
								<tr><td>
									<form action="<?php echo site_url('admin/student/history_add')?>" method="post" enctype="multipart/form-data">
									<?php 
									if($history_type == 'learning')
									{ 
									?>
										<table>
											<tr><td><b>科目：</b></td><td><input type="text" name="learning_subject" value="<?php  echo (isset($student['learning_subject']) ? $student['learning_subject'] : '')?>"></td></tr>
											<tr><td><b>课时：</b></td><td><input type="text" name="learning_period" value="<?php  echo (isset($student['learning_period']) ? $student['learning_period'] : '')?>" size="4"> 小时</td></tr>
											<tr><td><b>日期：</b></td><td><input type="text" name="learning_date" readonly="readonly" id="learning_date" size="12" value="<?php  echo (isset($student['learning_date']) ? $student['learning_date'] : '0000-00-00')?>" onclick="showCalendar('learning_date', '%Y-%m-%d', false, false, 'learning_date');" /></td></tr>
											<tr><td><b>教材版本：</b></td><td><input type="text" name="learning_version" value="<?php  echo (isset($student['learning_version']) ? $student['learning_version'] : '')?>"></td></tr>
											<tr><td><span class="notice-star"> * </span><b>授课描述和总结：</b><br/><span style="color:#000">（上课的情况、<br/>发现的问题、<br/>感悟与反思等）</span></td><td><textarea name="history" cols="80" rows="5"><?php echo (isset($student['history']) ? $student['history'] : '')?></textarea></td></tr>
											<input type="hidden" name="add_calendar" value="0">
										</table>
									<?php
									}
									elseif(in_array($history_type, array('consult', 'suyang')))
									{
									?>
										<table>
											<tr><td><span class="notice-star"> * </span><b>教学目标：</b></td><td><textarea name="target" cols="80" rows="5"></textarea></td></tr>
											<tr><td><span class="notice-star"> * </span><b>教学内容：</b></td><td><textarea name="history" cols="80" rows="5"><?php echo (isset($student['history']) ? $student['history'] : '')?></textarea></td></tr>
											<tr><td><b>添加附件：</b>（2M之内）</td><td><input type="file" name="upload"> </td></tr>
											<input type="hidden" name="add_calendar" value="0">
										</table>							
									<?php 
									}
									else
									{
									?>
										<textarea name="history" cols="80" rows="5"><?php echo (isset($student['history']) ? $student['history'] : '')?></textarea><br/>
										<input type="checkbox" name="add_calendar" value="1" <?php echo (isset($student['add_calendar']) && !empty($student['add_calendar'])) ? 'CHECKED' :''; ?>>同时添加到日程: 
										<input type="text" name="start_date" readonly="readonly" id="start_date_<?php echo $history_type; ?>" size="12" value="<?php  echo date('Y-m-d')?>" onclick="showCalendar('start_date_<?php echo $history_type; ?>', '%Y-%m-%d', false, false, 'start_date_<?php echo $history_type; ?>');" />
										<?php echo show_hour_options('start_hour', date('H')) ?> : 
										<?php echo show_mins_options('start_mins', floor(date('i')/10) * 10) ?>
										到
										<input type="text" name="end_date" readonly="readonly" id="end_date_<?php echo $history_type; ?>" size="12" value="<?php  echo date('Y-m-d')?>" onclick="showCalendar('end_date_<?php echo $history_type; ?>', '%Y-%m-%d', false, false, 'end_date_<?php echo $history_type; ?>');" />
										<?php echo show_hour_options('end_hour', date('H', (mktime() + 60 * 60))) ?> : 
										<?php echo show_mins_options('end_mins', floor(date('i')/10) * 10) ?><br/>
									<?php 
									}
									?>
									<input type="hidden" name="history_type" value="<?php echo $history_type; ?>">
									<input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>">
									<input type="submit" class="button" value="添加" name="submit">
									</form>
								</td></tr>
							</table>
						</div>
			<?php 
						} 
					}
				} 
			} 
			?>
		</div>
	</div>
</div>