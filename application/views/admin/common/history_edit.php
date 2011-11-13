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
		<form action="<?php echo site_url('admin/history/edit/'.$type.'/'.$history_info['history_'.$type.'_id']) ?>" method="post">
			<?php if($type == 'learning'): ?>
				<table>
					<tr><td><b>科目：</b></td><td><input type="text" name="history_learning_subject" value="<?php  echo (isset($history_info['history_learning_subject']) ? $history_info['history_learning_subject'] : '')?>"></td></tr>
					<tr><td><b>课时：</b></td><td><input type="text" name="history_learning_period" value="<?php  echo (isset($history_info['history_learning_period']) ? $history_info['history_learning_period'] : '')?>" size="4"> 小时</td></tr>
					<tr><td><b>日期：</b></td><td><input type="text" name="history_learning_date" readonly="readonly" id="history_learning_date" size="12" value="<?php  echo (isset($history_info['history_learning_date']) ? $history_info['history_learning_date'] : '0000-00-00')?>" onclick="showCalendar('history_learning_date', '%Y-%m-%d', false, false, 'history_learning_date');" /></td></tr>
					<tr><td><b>教材版本：</b></td><td><input type="text" name="history_learning_version" value="<?php  echo (isset($history_info['history_learning_version']) ? $history_info['history_learning_version'] : '')?>"></td></tr>
					<tr><td><span class="notice-star"> * </span><b>授课描述和总结：</b><br/><span style="color:#000">（上课的情况、<br/>发现的问题、<br/>感悟与反思等）</span></td><td><textarea name="history_learning" cols="80" rows="5"><?php echo (isset($history_info['history_learning']) ? $history_info['history_learning'] : '')?></textarea></td></tr>
				</table>
			<?php elseif(in_array($type, array('consult', 'suyang'))): ?>
				<table>
					<tr><td><span class="notice-star"> * </span><b>教学目标：</b></td><td><textarea name="history_<?php echo $type ?>_target" cols="80" rows="5"><?php  echo (isset($history_info['history_'.$type.'_target']) ? $history_info['history_'.$type.'_target'] : '')?></textarea></td></tr>
					<tr><td><span class="notice-star"> * </span><b>教学内容：</b></td><td><textarea name="history_<?php echo $type?>" cols="80" rows="5"><?php  echo (isset($history_info['history_'.$type]) ? $history_info['history_'.$type] : '')?></textarea></td></tr>
					<tr><td><b>添加附件：</b>（2M之内）</td><td><input type="file" name="upload"> </td></tr>
				</table>	
			<?php else: ?>
				<textarea name="history_<?php echo $type?>" cols="80" rows="5"><?php  echo (isset($history_info['history_'.$type]) ? $history_info['history_'.$type] : '')?></textarea><br/>
			<?php endif; ?>
			<input type="hidden" name="type" value="<?php echo $type?>">
			<input type="hidden" name="history_id" value="<?php echo $history_info['history_'.$type.'_id'] ?>">
			<input type="hidden" name="student_id" value="<?php echo $student_info['student_id'] ?>">
			<input type="submit" class="button" value="更新" name="submit">
			<input type="submit" class="button" value="取消" name="cancel">
		</form>
	</div>
</div>