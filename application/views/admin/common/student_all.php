<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/student') ?>" target="main-frame">学员管理</a></span>
	 » 查看学员
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
		  <form action="<?php echo site_url('admin/student')?>" method="POST" name="searchForm">
			<img src="images/admin/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
			<!-- 时间 -->
			状态时间: <input type="text" name="start_time" maxlength="60" size="10" value="" readonly="readonly" id="start_time_id" /> <input name="selbtn1" type="button" id="selbtn1" onclick="return showCalendar('start_time_id', '%Y-%m-%d', '24', false, 'selbtn1');" value="选择" class="button"/> 到 <input type="text" name="end_time" maxlength="60" size="10" value="" readonly="readonly" id="end_time_id" /> <input name="selbtn1" type="button" id="selbtn2" onclick="return showCalendar('end_time_id', '%Y-%m-%d', '24', false, 'selbtn2');" value="选择" class="button"/>
			<!-- 校区 -->
			<?php if(is_admin()): //权限: 只有超级管理员可以按校区搜索?>
			<select name="branch_id">
				<option value='0'>请选择...</option>
				<?php
					foreach($branches['branch'] as $branch)
						echo '<option value="'.$branch['branch_id'].'" '.((isset($student['branch'])) ? ( ($branch['branch_id'] == $student['branch']) ? 'SELECTED' : '' ) : '').'>'.$branch['branch_name'].'</option>';
				?>
			</select>
			<?php endif; ?>
			<!-- 学阶 -->
			<select name="grade_id">
				<option value='0'>全部学阶</option>
				<?php
					foreach($grades as $grade)
						echo '<option value="'.$grade['grade_id'].'">'.$grade['grade_name'].'</option>';
				?>
			</select>
			<!-- 校区 -->
			<?php if(is_admin() || is_school_admin()): //权限: 只有管理员可以按状态?>
			<select name="status">
				<option value='0'>所有状态</option>
				<option value='<?php echo STUDENT_STATUS_NOT_SIGNUP ?>'><?php echo get_student_status_text(STUDENT_STATUS_NOT_SIGNUP)?></option>
				<option value='<?php echo STUDENT_STATUS_SIGNUP ?>'><?php echo get_student_status_text(STUDENT_STATUS_SIGNUP)?></option>
				<option value='<?php echo STUDENT_STATUS_LEARNING ?>'><?php echo get_student_status_text(STUDENT_STATUS_LEARNING)?></option>
				<option value='<?php echo STUDENT_STATUS_FINISHED ?>'><?php echo get_student_status_text(STUDENT_STATUS_FINISHED)?></option>
				<option value='<?php echo STUDENT_STATUS_INACTIVE ?>'><?php echo get_student_status_text(STUDENT_STATUS_INACTIVE)?></option>
			</select>
			<?php endif; ?>
			<!-- 省市 -->
			<select name="province_id" id="selProvinces" onchange="region.changed(this, 2, 'selCities')">
				<option value='0' selected>所有省...</option>
				<?php 
					foreach($provinces as $province)
						echo '<option value="'.$province['region_id'].'">'.$province['region_name'].'</option>';
				?>
			</select>
			<select onchange="" id="selCities" name="city_id">
				<option value="0" selected>所有市...</option>
			</select>
			<!-- 姓名 -->
			学员姓名 <input type="text" name="name" size="15" />
			<input type="submit" value=" 搜索 " class="button" />
		  </form>
		</div>
		
		<div id="listDiv" class="list-div">
			<table cellspacing='1' id="list-table">
				<tr>
					<th>姓名</th>
					<th>年级</th>
					<th>父母电话</th>
					<th>QQ</th>
					<th>学习时间</th>
					<th>住址</th>
					<th>状态</th>
					<th>操作</th>
				</tr>
				<?php foreach($students as $student): ?>
				<tr>
					<td align="center"><a href="<?php echo site_url('admin/student/one/'.$student['student_id']) ?>"><?php echo $student['name'] ?></a></td>
					<td align="center"><?php echo $student['grade_name'] ?></td>
					<td>
						<?php
							echo !(empty($student['father_phone'])) ? '<b>父亲电话:</b> '.$student['father_phone'].'<br/>' : '';
							echo !(empty($student['mother_phone'])) ? '<b>母亲电话:</b> '.$student['mother_phone'] : '';
						?>
					</td>
					<td><?php echo $student['qq'] ?></td>
					<td><?php echo $student['total_hours'] ?></td>
					<td><?php echo $student['address'] ?></td>
					<td align="center"><?php echo get_student_status_text($student['status']) ?></td>
					<td align="center">
						<a href="<?php echo site_url('admin/student/edit/'.$student['student_id']) ?>">编辑</a>
						<?php
						if(is_admin() || is_school_admin()) //权限: 只有管理员可以按状态
						{
							if($student['is_delete'] == 0) 
								echo '<a onclick="return confirm(\'确定要删除?\');" href="'.site_url('admin/student/delete/'.$student['student_id']).'">删除</a>';
							else
								echo '<a onclick="return confirm(\'确定要取消删除?\');" href="'.site_url('admin/student/delete/'.$student['student_id'].'/1').'">取消删除</a>';
						}
						?>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<!-- 分页 -->
		<?php echo $page_nav; ?>
	</div>
</div>