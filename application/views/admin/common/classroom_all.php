<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/classroom') ?>" target="main-frame">班级管理</a></span>
	 » 查看班级
	<div style="clear:both"></div>
</div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		
		<div class="form-div">
		  <form action="<?php echo site_url('admin/classroom')?>" method="POST" name="searchForm">
			<img src="images/admin/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
			<!-- 时间 -->
			上课时间: 
			<select name="day">
				<option value='1' <?php echo ((isset($class['day'])) ? ( ($class['day'] == 1) ? 'SELECTED' : '' ) : '') ?>>星期一</option>
				<option value='2' <?php echo ((isset($class['day'])) ? ( ($class['day'] == 2) ? 'SELECTED' : '' ) : '') ?>>星期二</option>
				<option value='3' <?php echo ((isset($class['day'])) ? ( ($class['day'] == 3) ? 'SELECTED' : '' ) : '') ?>>星期三</option>
				<option value='4' <?php echo ((isset($class['day'])) ? ( ($class['day'] == 4) ? 'SELECTED' : '' ) : '') ?>>星期四</option>
				<option value='5' <?php echo ((isset($class['day'])) ? ( ($class['day'] == 5) ? 'SELECTED' : '' ) : '') ?>>星期五</option>
				<option value='6' <?php echo ((isset($class['day'])) ? ( ($class['day'] == 6) ? 'SELECTED' : '' ) : '') ?>>星期六</option>
				<option value='7' <?php echo ((isset($class['day'])) ? ( ($class['day'] == 7) ? 'SELECTED' : '' ) : '')?>>星期日</option>
			</select>
			
			<!-- 科目 -->
			<select name="subject_id">
				<option value='0'>全部科目</option>
				<?php
					foreach($subjects as $subject)
					{
						echo '<option value="'.$subject['subject_id'].'" '. (($subject['subject_id'] == SUBJECT_SUYANG) ? 'SELECTED' : '' ) .'>'.$subject['subject_name'].'</option>';
					}
				?>
			</select>
			
			<!-- 姓名 -->
			班级名: <input type="text" name="classroom_name" size="15" value="<?php echo isset($filter['classroom_name']) ? $filter['classroom_name'] : ''; ?>"/>
			<input type="submit" value=" 搜索 " class="button" />
		  </form>
		</div>
		
		<div id="listDiv" class="list-div">
			<table cellspacing='1' id="list-table">
				<tr>
					<th>班级编号</th>
					<th>开班时间</th>
					<th>班级名称</th>
					<th>学员数</th>
					<th>科目</th>
					<th>任课老师</th>
					<th>上课时间</th>
					<th>操作</th>
				</tr>
				<?php foreach($classroom as $one): ?>
				<tr>
					<td align="center"><?php echo $one['classroom_id'] ?></td>
					<td align="center"><?php echo $one['start_date'] ?></td>
					<td align="center"><?php echo $one['classroom_name'] ?></td>
					<td align="center"><?php echo $one['student_count'] ?></td>
					<td align="center"><?php echo $one['subject_name'] ?></td>
					<td align="center"><?php echo $one['name'] ?></td>
					<td align="center"><?php echo get_weekday($one['day']).', '.$one['start_time'].'至'.$one['end_time']; ?></td>
					
					<td align="center">
						<a href="<?php echo site_url('admin/classroom/edit/'.$one['classroom_id']) ?>">编辑</a>
						<a onclick="return confirm('确定要删除?');" href="<?php echo site_url('admin/classroom/delete/'.$one['classroom_id']); ?>">删除</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		  </form>
		</div>
		<!-- 分页 -->
		<?php echo $page_nav; ?>
	</div>
</div>