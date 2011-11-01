<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/student') ?>" target="main-frame">学员管理</a></span>
	» 添加学员
	<div style="clear:both"></div>
</div>
<div id="main">
	<div id="main_navbar">
		<p>
			<span class="navbar-front">基本信息</span>
			<span class="navbar-back">详细信息</span>
			<span class="navbar-back">合同信息</span>
			<span class="navbar-back">退费信息</span>
		</p>
	</div>
	
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		<form action="<?php echo site_url('admin/student/add') ?>" method="post">
		<table width="90%" id="shop_info-table">
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>校区: </td>
				<td>
					<?php if(is_admin()): //权限: 只有超级管理员可以管理网站内容?>
					<select name="branch_id">
						<option value='0'>请选择...</option>
						<?php
							foreach($branches['branch'] as $branch)
								echo '<option value="'.$branch['branch_id'].'" '.((isset($student['branch_id'])) ? ( ($branch['branch_id'] == $student['branch_id']) ? 'SELECTED' : '' ) : '').'>'.$branch['branch_name'].'</option>';
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
					<input name="gender" type="radio" value="m" CHECKED="CHECKED" />男
					<input name="gender" type="radio" value="f"/>女
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
						<?php 
							foreach($grades as $grade)
								echo '<option value="'.$grade['grade_id'].'" '.((isset($student['grade_id'])) ? ( ($grade['grade_id'] == $student['grade_id']) ? 'SELECTED' : '' ) : '').'>'.$grade['grade_name'].'</option>';
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
						<?php 
							foreach($provinces as $province)
								echo '<option value="'.$province['region_id'].'">'.$province['region_name'].'</option>';
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
				<td class="label" valign="top"><span class="notice-star"> * </span>学员来源: </td>
				<td>
					<select id="student_from" name="student_from">
						<option value="0">请选择...</option>
						<?php 
							foreach($froms as $from)
								echo '<option value="'.$from['student_from_id'].'" '.((isset($student['student_from']) && $from['student_from_id'] == $student['student_from']) ? 'SELECTED' : '' ).'>'.$from['student_from_name'].'</option>';
						?>
						<option value="other" <?php echo ((isset($student['student_from']) && $student['student_from'] == 'other') ? 'SELECTED' : '' ) ?>>其他</option>
					</select>
					<span id="student_from_text_span" style="display:<?php echo ((isset($student['student_from']) && $student['student_from'] == 'other') ? '' : 'NONE' ) ?>"> 请填写：<input type="text" value="<?php echo (isset($student['student_from_text']) ? $student['student_from_text'] : '' ) ?>" name="student_from_text"  id="student_from_text"/></span>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>星级: </td>
				<td>
					<select name="level">
						<option value='1'>A级</option>
						<option value='3'>3A级</option>
						<option value='5'>5A级</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top">备注: </td>
				<td><textarea name="remark" cols="40" rows="5"></textarea></td>
			</tr>			
		</table>
		<div class="button-div">
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
		
		$("#student_from").change(function(){
			if($("#student_from option:selected").val() == 'other')
			{
				$("#student_from_text_span").css('display', '');
				$("#student_from_text").focus();
			}
			else
				$("#student_from_text_span").css('display', 'none');
		});
	});
</script>