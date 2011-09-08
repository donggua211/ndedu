<div id="ceping_main">
	<div class="ceping_content">
	<form action="<?php echo site_url("ceping/userinfo"); ?>" method="post" onSubmit="return submit_userinfo(this);">
		<div><span class="font_30_red">个人信息</span> <span class="font_14_gray">以下均为必填项，请正确填写</span></div>	
		<div class="ceping_userinfo">
			<div class="input">
				<label>真实姓名: </label>
				<input size="15" type="text" name="name" value="<?php echo (isset($userinfo['name'])) ? $userinfo['name'] :''; ?>">
				<span id="name_warning"></span>
			</div>
			<div class="input">
				<label>手机号: </label>
				<input size="20" type="text" name="phone" value="<?php echo (isset($userinfo['phone'])) ? $userinfo['phone'] :''; ?>">
				<span id="phone_warning"></span>
			</div>
			<div class="input">
				<label>电子邮箱: </label>
				<input size="30" type="text" name="email" value="<?php echo (isset($userinfo['email'])) ? $userinfo['email'] :''; ?>">
				<span id="email_warning"></span>
			</div>
			<div class="input">
				<label>所在学校: </label>
				<input size="30" type="text" name="school" value="<?php echo (isset($userinfo['school'])) ? $userinfo['school'] :''; ?>">
				<span id="school_warning"></span>
			</div>
			<div class="input">
				<label>所在年级: </label>
				<select name="grade_id">
					<option value='0'>请选择...</option>
					<?php 
						foreach($grades as $grade)
							echo '<option value="'.$grade['grade_id'].'" '.((isset($userinfo['grade_id'])) ? ( ($grade['grade_id'] == $userinfo['grade_id']) ? 'SELECTED' : '' ) : '').'>'.$grade['grade_name'].'</option>';
					?>
				</select>
				<span id="grade_warning"></span>
			</div>
			<div class="input">
				<label>所在地: </label>
				<select name="province_id" id="selProvinces" onchange="region.changed(this, 2, 'selCities')">
					<option value='0' selected>省</option>
					<?php 
						foreach($provinces as $province)
							echo '<option value="'.$province['region_id'].'">'.$province['region_name'].'</option>';
					?>
				</select>
				<select onchange="region.changed(this, 3, 'selDistrict')" id="selCities" name="city_id">
					<option value="0" selected>市/地区</option>
				</select>
				<select id="selDistrict" name="district_id">
					<option value="0" selected>县/市</option>
				</select>
				<span id="loader"></span>
			</div>
		</div>
		<div class="order_submit_botton">
			<input type="image" name="submit" value="submit" src="images/cp/userinfo_botton.jpg">
		</div>
	</form>
	</div>
</div>