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
			<span class="navbar-front"><a href="<?php echo site_url('admin/student/one/'.$student['student_id']) ?>">基本信息</a></span>
			<span class="navbar-back"><a href="<?php echo site_url('admin/student/one/'.$student['student_id'].'/history') ?>">详细信息</a></span>
			<?php if(is_admin() || is_school_admin() || is_consultant() || is_supervisor()): //权限: 超级管理员, 校区管理员, 咨询师可以查看/编辑合同信息?>
			<span class="navbar-back"><a href="<?php echo site_url('admin/student/one/'.$student['student_id'].'/contract') ?>">合同信息</a></span>
			<?php endif; ?>
		</p>
	</div>
	
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		<table width="90%">
			<tr>
				<td class="label" valign="top">姓名: </td>
				<td><?php echo $student['name'] ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">性别: </td>
				<td>
					<?php
						echo !(empty($student['gender'])) ? ( $student['gender'] == 'm' ? '男' : '女' ) : '无';
					?>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top">生日: </td>
				<td><?php echo $student['dob']?></td>
			</tr>
			<tr>
				<td class="label" valign="top">年级: </td>
				<td><?php echo $student['grade_name']?></td>
			</tr>
			<tr>
				<td class="label" valign="top">爸爸电话: </td>
				<td><?php echo (isset($student['father_phone'])) ? $student['father_phone'] :''; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">妈妈电话: </td>
				<td><?php echo (isset($student['mother_phone'])) ? $student['mother_phone'] :''; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">咨询QQ: </td>
				<td><?php echo (isset($student['qq']) && !empty($student['qq'])) ? $student['qq'] : ''; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">电子邮箱: </td>
				<td><?php echo (isset($student['email'])) ? $student['email'] :''; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">地址: </td>
				<td>
					<span class="notice-highlight">省份: </span><?php echo (isset($student['province_name'])) ? $student['province_name'] :''; ?><span class="notice-highlight"> --> </span>
					<span class="notice-highlight">城市: </span><?php echo (isset($student['city_name'])) ? $student['city_name'] :''; ?><span class="notice-highlight"> --> </span>
					<span class="notice-highlight">区: </span><?php echo (isset($student['district_name'])) ? $student['district_name'] :''; ?><br/>
					<span class="notice-highlight">详细地址: </span><?php echo (isset($student['address'])) ? $student['address'] :''; ?>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top">学员状态: </td>
				<td>
					<?php echo (isset($student['status_text'])) ? $student['status_text'] :''; ?>
					<?php if(is_admin() || is_school_admin()): //权限: 只有管理员可以按状态?>
					<a href="javascript:void(0);" onclick="collapse_switch('status_history')" style="margin-left:20px"><font style="color:red">查看详情</font></a></td>
					<?php endif?>
			</tr>
			<?php if(is_admin() || is_school_admin()): //权限: 只有管理员可以按状态?>
			<tr id="status_history" style="display:none">
				<td></td>
				<td>
					<div id="listDiv" class="list-div">
						<table cellspacing='1' id="list-table">
							<?php foreach($student['status_history'] as $history): ?>
							<tr>
								<td class="status_history">
									<?php echo $history['add_time'] ?>, 从"<?php echo get_student_status_text($history['from_status'])?>", 改为了"<?php echo get_student_status_text($history['status'])?>". 
								</td>
								<td align="center">
									<?php if(!empty($history['from_status'])): ?>
									<form onsubmit="return confirm('确定要删除? 删除将无法恢复!');" action="<?php echo site_url('admin/status_history/delete/') ?>" method="post">
										<input type="hidden" name="status_history_id" value="<?php echo $history['status_history_id'] ?>"/>
										<input type="submit" name="submit" value="删除" class="button" />
									</form>
									<?php endif ?>
								</td>
							</tr>
							<?php endforeach ?>
						</table>
					</div>
				</td>
			</tr>
			<?php endif?>
			<tr>
				<td class="label" valign="top">班主任: </td>
				<td><?php echo (isset($student['supervisor']['name'])) ? $student['supervisor']['name'] :'未分配'; ?></td>
			</tr>
			
			<tr>
				<td class="label" valign="top">添加时间: </td>
				<td><?php echo (isset($student['add_time'])) ? $student['add_time'] :''; ?></td>
			</tr>
			
			<tr>
				<td class="label" valign="top">
			<?php
				if(isset($student['user_student']['user_name']) && !empty($student['user_student']['user_name']))
				{
					echo '已经关联到账号: ';
					echo '</td><td>';
					echo $student['user_student']['user_name'];
				}
				else
				{
					echo '学员VIP码: ';
					echo '</td><td>';
					echo $student['user_student']['vip_code'];
				}
			?>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top">备注: </td>
				<td><?php echo (isset($student['remark'])) ? $student['remark'] :''; ?></td>
			</tr>			
		</table>
		<div class="button-link-div">
			<a href="<?php echo site_url('admin/student/edit/'.$student['student_id']) ?>">编辑</a>
			<a href="javascript:void();" onclick="history.back(-1)">返回</a>
		</div>
	</div>
</div>