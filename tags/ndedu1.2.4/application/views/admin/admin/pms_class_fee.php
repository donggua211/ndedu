<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/staff') ?>" target="main-frame">员工管理</a></span>
	 » 查看员工
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
		  <form action="<?php echo site_url('admin/pms/class_fee/')?>" method="POST" name="searchForm">
			<img src="images/admin/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
			<!-- 时间 -->
			查询时间: <input type="text" name="class_start_time" size="10" value="<?php echo isset($filter['class_start_time']) ? $filter['class_start_time'] : '' ?>" readonly="readonly" id="start_time_id" />
			到 <input type="text" name="class_end_time" maxlength="10" size="10" value="<?php echo isset($filter['class_end_time']) ? $filter['class_end_time'] : '' ?>" readonly="readonly" id="end_time_id" />
			<!-- 校区 -->
			<?php if(is_admin()): //权限: 只有超级管理员可以按校区搜索?>
			<select name="branch_id">
				<option value='0'>尼德教育所有校区</option>
				<?php
					foreach($branches['branch'] as $branch)
						echo '<option value="'.$branch['branch_id'].'" ' . ( ($branch['branch_id'] == $filter['branch_id']) ? 'SELECTED' : '' ) . '>'.$branch['branch_name'].'</option>';
				?>
			</select>
			<?php endif; ?>
			<!-- 员工角色 -->
			<select name="group_id">
				<option value='0'>所有员工角色</option>
				<?php
					foreach($groups as $group)
						echo '<option value="'.$group['group_id'].'" '. (($group['group_id'] == $filter['group_id']) ? 'SELECTED' : '' ) .'>'.$group['group_name'].'</option>';
				?>
			</select>
			<!-- 姓名 -->
			员工姓名 <input type="text" name="name" size="15" />
			<input type="submit" value=" 搜索 " class="button" />
		  </form>
		</div>
		
		<div id="listDiv" class="list-div">
		  <form action="<?php echo site_url('admin/student/sms_batch')?>" method="POST" id="sms_batch">
			<table cellspacing='1' id="list-table">
				<tr>
					<th>姓名</th>
					<th>角色</th>
					<th>课时费</th>
					<th>总计</th>
					<th>操作</th>
				</tr>
				<?php foreach($staffs as $staff): ?>
				<tr>
					<td class="first-cell" align="center"><a href="<?php echo site_url('admin/pms/class_fee_one/'.$staff['staff_id']) ?>"><?php echo $staff['name'] ?></a></td>
					<td><?php echo get_group_name( $staff['group_id'] ) ?></td>
					<td>
						<?php 
						if(is_array($staff['class_fee']['suyang']))
						{
							if($staff['class_fee']['suyang']['total_fee'] > 0)
								echo '素养课课时数：'.$staff['class_fee']['suyang']['total_hours'].'小时；素养课课时费：'.$staff['class_fee']['suyang']['total_fee'].'元<br/>';
							if($staff['class_fee']['xueke']['total_fee'] > 0)
								echo '学科课课时数：'.$staff['class_fee']['xueke']['total_hours'].'小时；学科课课时费：'.$staff['class_fee']['xueke']['total_fee'].'元';
							
							if($staff['class_fee']['suyang']['total_fee'] <= 0 && $staff['class_fee']['xueke']['total_fee'] <= 0)
								echo '0元';
						}
						else
							echo $staff['class_fee'];
						?>
					</td>
					<td>
					<?php 
						if(is_array($staff['class_fee']['suyang']))
						{
							echo $staff['class_fee']['suyang']['total_fee'] + $staff['class_fee']['xueke']['total_fee'].'元';
						}
						else
							echo $staff['class_fee'];
						?>
					
					</td>
					<td align="center"  id="option_<?php echo $staff['staff_id']; ?>">
						<a href="<?php echo site_url('admin/pms/class_fee_one/'.$staff['staff_id']) ?>">查看详情</a>
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

<script type="text/javascript">
	//ready function
	$(document).ready(function(){
		//日期选择按钮
		$("input[name='class_start_time']").click(function(){
			showCalendar('start_time_id', '%Y-%m-%d', false, false, 'start_time_id')
		});
		$("input[name='class_end_time']").click(function(){
			showCalendar('end_time_id', '%Y-%m-%d', false, false, 'end_time_id')
		});
	});
</script>