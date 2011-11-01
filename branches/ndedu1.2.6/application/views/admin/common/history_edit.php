<div id="nav">
	<div id="nav_left">
		<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
		<span class="action-span"> » <a href="<?php echo site_url('admin/student') ?>" target="main-frame">学员管理</a></span>
		<span class="action-span"> » <a href="<?php echo site_url('admin/student') ?>" target="main-frame">查看学员</a></span>
		<span class="action-span"> » <a href="<?php echo site_url('admin/student/one/'.$student_info['student_id'].'/history') ?>" target="main-frame"><?php echo $student_info['name'] ?></a></span>
		 » 修改<?php if($type == 'contact') {echo '联系历史';} else{ echo '学习历史';} ?>
	</div>
	<div id="nav_right">
		所在校区: <span><?php echo $student_info['branch_name'] ?></span>
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
		<form action="<?php echo site_url('admin/history/edit/'.$type.'/'.$history_info['history_id']) ?>" method="post">
			<?php if($type == 'learning'): ?>
				<table>
					<?php $history_learning = explode(HISTORY_LEARNING_SEP, $history_info['history_text']); ?>
					<tr><td>科目：</td><td><input type="text" name="subject_name" value="<?php echo $history_learning[0]; ?>"></td></tr>
					<tr><td>课时：</td><td><input type="text" name="finished_hours" value="<?php echo $history_learning[1]; ?>" size="4"> 小时</td></tr>
					<tr><td>日期：</td><td><input type="text" name="start_date" readonly="readonly" id="start_date_<?php echo $type; ?>" size="12" value="<?php echo $history_learning[2]; ?>" onclick="showCalendar('start_date_<?php echo $type; ?>', '%Y-%m-%d', false, false, 'start_date_<?php echo $type; ?>');" /></td></tr>
					<tr><td>教材版本：</td><td><input type="text" name="version" value="<?php echo $history_learning[3]; ?>"></td></tr>
					<tr><td>教案：</td><td><textarea name="history_text" cols="80" rows="5"><?php echo $history_learning[4]; ?></textarea></td></tr>
					<input type="hidden" name="add_calendar" value="0">
				</table>
			<?php else: ?>
				<textarea name="history_text" cols="80" rows="5"><?php echo $history_info['history_text'] ?></textarea><br/>
			<?php endif; ?>
			<input type="hidden" name="type" value="<?php echo $type?>">
			<input type="hidden" name="history_id" value="<?php echo $history_info['history_id'] ?>">
			<input type="hidden" name="student_id" value="<?php echo $student_info['student_id'] ?>">
			<input type="submit" class="button" value="更新" name="submit">
			<input type="submit" class="button" value="取消" name="cancel">
		</form>
	</div>
</div>