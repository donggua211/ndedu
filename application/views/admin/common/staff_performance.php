<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/staff') ?>" target="main-frame">员工管理</a></span>
	 » 员工绩效
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
		  <form action="<?php echo site_url('admin/staff/performance')?>" method="POST" name="searchForm">
			<img src="images/admin/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
			<!-- 时间 -->
			绩效时间: <input type="text" name="start_time" maxlength="60" size="10" value="" readonly="readonly" id="start_time_id" /> <input name="selbtn1" type="button" id="selbtn1" onclick="return showCalendar('start_time_id', '%Y-%m-%d', '24', false, 'selbtn1');" value="选择" class="button"/> 到 <input type="text" name="end_time" maxlength="60" size="10" value="" readonly="readonly" id="end_time_id" /> <input name="selbtn1" type="button" id="selbtn2" onclick="return showCalendar('end_time_id', '%Y-%m-%d', '24', false, 'selbtn2');" value="选择" class="button"/>
			<!-- 校区 -->
			<?php if(is_admin()): //权限: 只有超级管理员可以按校区搜索?>
			<select name="branch_id">
				<option value='0'>尼德教育所有校区</option>
				<?php
					foreach($branches['branch'] as $branch)
						echo '<option value="'.$branch['branch_id'].'">'.$branch['branch_name'].'</option>';
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
			<select name="group_id">
				<option value='0'>所有员工角色</option>
				<?php
					foreach($groups as $group)
						echo '<option value="'.$group['group_id'].'" '.((isset($staff['group_id'])) ? ( ($group['group_id'] == $staff['group_id']) ? 'SELECTED' : '' ) : '').'>'.$group['group_name'].'</option>';
				?>
			</select>
			<!-- 姓名 -->
			员工姓名 <input type="text" name="name" size="15" />
			<input type="submit" value=" 搜索 " class="button" />
		  </form>
		</div>
		
		<div id="listDiv" class="list-div">
			<table cellspacing='1' id="list-table">
				<tr>
					<th>姓名</th>
					<th>角色</th>
					<th>未报名</th>
					<th>已报名</th>
					<th>正在学</th>
					<th>总课时</th>
					<th>已完成课时</th>
					<th>退费</th>
					<th>投诉</th>
				</tr>
				<?php foreach($staffs as $staff): ?>
				<tr>
					<td align="center">
						<?php echo $staff['name']; ?>
					</td>
					<td align="center"><?php echo get_group_name($staff['group_id'])?></td>
					<td align="center"><?php echo ($staff['group_id'] == GROUP_CONSULTANT) ? $staff['not_signup'].'位' : 'N/A';?></td>
					<td align="center"><?php echo ($staff['group_id'] == GROUP_CONSULTANT) ? $staff['signup'].'位' : 'N/A';?></td>
					<td align="center"><?php echo ($staff['group_id'] == GROUP_SUPERVISOR) ? $staff['learning'].'位' : 'N/A';?></td>
					<td align="center"><?php echo ($staff['group_id'] == GROUP_CONSULTANT) ? $staff['total_hours'].'小时' : 'N/A';?></td>
					<td align="center"><?php echo ($staff['group_id'] == GROUP_SUPERVISOR || $staff['group_id'] == GROUP_TEACHER) ? $staff['finished_hours'].'小时' : 'N/A';?></td>
					<td align="center"><?php echo $staff['refund_hours'] ?>小时</td>
					<td align="center">
					<?php
						if($staff['complain'] > 0)
							echo '<a href="'.site_url('admin/complain/index/'.$staff['staff_id']).'">';
						
						echo $staff['complain'].'次';
						
						if($staff['complain'] > 0)
							echo '</a>';
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