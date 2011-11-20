<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/student') ?>" target="main-frame">学员管理</a></span>
	<span class="action-span"> » 编辑学员</span>
	<div style="clear:both"></div>
</div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		<form action="<?php echo site_url('admin/student/edit') ?>" method="post">
		<table width="90%" id="shop_info-table" >
			<?php
			//access control
			$CI = & get_instance();
			if($CI->admin_ac_student->view_student_edit_status() !=false):
			?>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>状态: </td>
				<td>
					<select name="status">
						<option value='0'>所有状态</option>
						<?php
						foreach($CI->admin_ac_student->view_student_edit_status() as $val)
							echo '<option value="'.$val.'" '.((isset($student['status']) && $val == $student['status']) ? 'SELECTED' : '').'>'.get_student_status_text($val).'</option>';
						?>
					</select>
				</td>
			</tr>
			<?php endif; ?>
			
			
			<?php if($CI->admin_ac_student->view_student_edit_cs($student['status'])): ?>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>课程顾问: </td>
				<td>
					<select name="cservice_id">
						<option value='0'>请选择...</option>
						<?php
							foreach($cservices as $cs)
							{
								echo '<option value="'.$cs['staff_id'].'" '.((isset($student['cservice_id']) && $cs['staff_id'] == $student['cservice_id']) ? 'SELECTED' : '' ).'>'.$cs['name'].'</option>';
							}
						?>
					</select>
				</td>
			</tr>
			<?php endif; ?>
			
			<?php if($CI->admin_ac_student->view_student_edit_jiaowu($student['status'])): ?>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>教务老师: </td>
				<td>
					<select name="jiaowu_id">
						<option value='0'>请选择...</option>
						<?php
							foreach($jiaowus as $jiaowu)
							{
								echo '<option value="'.$jiaowu['staff_id'].'" '.((isset($student['jiaowu_id']) && $jiaowu['staff_id'] == $student['jiaowu_id']) ? 'SELECTED' : '' ).'>'.$jiaowu['name'].'</option>';
							}
						?>
					</select>
				</td>
			</tr>
			<?php endif; ?>
			
			<?php if($CI->admin_ac_student->view_student_edit_consultant($student['status'])): ?>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>咨询师: </td>
				<td>
					<select name="consultant_id">
						<option value='0'>请选择...</option>
						<?php
							foreach($consultants as $consultant)
							{
								echo '<option value="'.$consultant['staff_id'].'" '.((isset($student['consultant_id']) && $consultant['staff_id'] == $student['consultant_id']) ? 'SELECTED' : '' ).'>'.$consultant['name'].'</option>';
							}
						?>
					</select>
				</td>
			</tr>
			<?php endif; ?>
			
			<?php if($CI->admin_ac_student->view_student_edit_suyang($student['status'])): ?>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>素养老师: </td>
				<td>
					<select name="suyang_id">
						<option value='0'>请选择...</option>
						<?php
							foreach($suyangs as $suyang)
							{
								echo '<option value="'.$suyang['staff_id'].'" '.((isset($student['suyang_id']) && $suyang['staff_id'] == $student['suyang_id']) ? 'SELECTED' : '' ).'>'.$suyang['name'].'</option>';
							}
						?>
					</select>
				</td>
			</tr>
			<?php endif; ?>
			
			<!-- 去掉班主任角色 ndedu1.2.3
			<?php if($CI->admin_ac_student->view_student_edit_supervisor()): ?>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>班主任: </td>
				<td>
					<select name="supervisor_id">
						<option value='0'>请选择...</option>
						<?php
							foreach($supervisors as $supervisor)
							{
								echo '<option value="'.$supervisor['staff_id'].'" '.((isset($student['supervisor_id']) && $supervisor['staff_id'] == $student['supervisor_id']) ? 'SELECTED' : '' ).'>'.$supervisor['name'].'</option>';
							}
						?>
					</select>
				</td>
			</tr>
			<?php endif; ?>
			-->
			
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>校区: </td>
				<td>
					<?php if(is_admin()): //权限: 只有超级管理员可以管理网站内容?>
					<select name="branch_id">
						<option value='0'>请选择...</option>
						<?php
							foreach($branches['branch'] as $branch)
								echo '<option value="'.$branch['branch_id'].'" '.(isset($student['branch_id']) &&  ($branch['branch_id'] == $student['branch_id']) ? 'SELECTED' : '').'>'.$branch['branch_name'].'</option>';
						?>
					</select>
					<?php else: ?>
						<input name="branch_id" type="hidden" value="<?php echo $branches['branch']['branch_id'];?>" />
						<?php echo $branches['branch']['branch_name']; ?>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>姓名: </td>
				<td><input name="name" type="text" value="<?php echo (isset($student['name'])) ? $student['name'] :''; ?>" size="40" /></td>
			</tr>
			
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>性别: </td>
				<td>
					<input name="gender" type="radio" value="m" <?php echo ((isset($student['gender']) && $student['gender'] == 'm') ? 'CHECKED' : '' ); ?> />男
					<input name="gender" type="radio" value="f" <?php echo ((isset($student['gender']) && $student['gender'] == 'f') ? 'CHECKED' : '' ); ?> />女
				</td>
			</tr>
			<tr>
				<td class="label" valign="top">生日: </td>
				<td>
					<input type="text" name="dob" maxlength="60" size="10" value="<?php echo (isset($student['dob'])) ? $student['dob'] :''; ?>" readonly="readonly" id="date" />
				</td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>年级: </td>
				<td>
					<select name="grade_id">
						<option value='0'>请选择...</option>
						<?php 
							foreach($grades as $grade)
								echo '<option value="'.$grade['grade_id'].'" '.((isset($student['grade_id']) && $grade['grade_id'] == $student['grade_id']) ? 'SELECTED' : '' ).'>'.$grade['grade_name'].'</option>';
						?>
					</select><br/>					
					<span class="notice-span" style="display:block"  id="noticeskype">学员所在的年纪</span>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>爸爸电话: </td>
				<td>
					<input name="father_phone" type="text" value="<?php echo (isset($student['father_phone'])) ? $student['father_phone'] :''; ?>" size="40" /><br/>
					<span class="notice-span" style="display:block"  id="noticeskype">爸爸的电话或者妈妈的电话必须二填一</span>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>妈妈电话: </td>
				<td>
					<input name="mother_phone" type="text" value="<?php echo (isset($student['mother_phone'])) ? $student['mother_phone'] :''; ?>" size="40" /><br/>
					<span class="notice-span" style="display:block"  id="noticeskype">爸爸的电话或者妈妈的电话必须二填一</span>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top">咨询QQ: </td>
				<td>
					<input name="qq" type="text" value="<?php echo (isset($student['qq'])) ? $student['qq'] :''; ?>" size="40" /><br/>
					<span class="notice-span" style="display:block"  id="noticeskype">学员的QQ号码</span>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top">电子邮箱: </td>
				<td><input name="email" type="text" value="<?php echo (isset($student['email'])) ? $student['email'] :''; ?>" size="40" /></td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>所在省份: </td>
				<td>
					<select name="province_id" id="selProvinces" onchange="region.changed(this, 2, 'selCities')">
						<option value='0' selected>请选择...</option>
						<?php 
							foreach($provinces as $province)
								echo '<option value="'.$province['region_id'].'" '.((isset($student['province_id']) && $province['region_id'] == $student['province_id']) ? 'SELECTED' : '' ).'>'.$province['region_name'].'</option>';
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>所在城市: </td>
				<td>
					<select onchange="region.changed(this, 3, 'selDistrict')" id="selCities" name="city_id">
						<option value="0" selected>请选择...</option>
						<?php 
							foreach($cities as $city)
								echo '<option value="'.$city['region_id'].'" '.((isset($student['city_id']) && $city['region_id'] == $student['city_id']) ? 'SELECTED' : '' ).'>'.$city['region_name'].'</option>';
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>所在区: </td>
				<td>
					<select id="selDistrict" name="district_id">
						<option value="0" selected>请选择...</option>
						<?php 
							foreach($districts as $district)
								echo '<option value="'.$district['region_id'].'" '.((isset($student['district_id']) && $district['region_id'] == $student['district_id']) ? 'SELECTED' : '' ).'>'.$district['region_name'].'</option>';
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>详细地址: </td>
				<td><input name="address" type="text" value="<?php echo (isset($student['address'])) ? $student['address'] :''; ?>" size="40" /></td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>星级: </td>
				<td>
					<select name="level">
						<option value='1' <?php echo (isset($student['level']) && $student['level'] == 1) ? 'SELECTED' : ''  ?>>A级</option>
						<option value='3' <?php echo (isset($student['level']) && $student['level'] == 3) ? 'SELECTED' : ''  ?>>3A级</option>
						<option value='5' <?php echo (isset($student['level']) && $student['level'] == 5) ? 'SELECTED' : ''  ?>>5A级</option>
					</select>
				</td>
			</tr>
			
			
			<tr>
				<td class="label" valign="top">备注: </td>
				<td><textarea name="remark" cols="40" rows="5"><?php echo (isset($student['remark'])) ? $student['remark'] :''; ?></textarea></td>
			</tr>			
		</table>
		<div class="button-div">
			<input type="hidden" value="<?php echo (isset($student['student_id'])) ? $student['student_id'] :''; ?>" name="student_id">
			<input type="submit" class="button" value=" 确定 " name="submit">
			<input type="reset" class="button" value=" 重置 " name="reset">
		</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		//日期选择的事件
		$("#date").click(function(){
			showCalendar('date', '%Y-%m-%d', false, false, 'date');
		});
	});
</script>