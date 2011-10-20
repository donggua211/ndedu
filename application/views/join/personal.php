<?php if(isset($notification) && !empty($notification)): ?>
<div style="margin-top:20px;backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
	<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
</div>
<?php endif; ?>
<div class="join_personal">
	<form action="<?php echo site_url('join/survey'); ?>" method="post" onsubmit="return submit_personal(this);">
	<div class="input">
		<label>姓 名：</label>
		<input type="text" name="name" value="<?php echo (isset($personal['name'])) ? $personal['name'] :''; ?>">
		<span id="name_warning"></span>
	</div>
	<div class="input">
		<label>性 别：</label>
		<input type="radio" name="gender" value="m" <?php echo (isset($personal['gender']) && $personal['gender'] == 'm') ? 'checked' :''; ?> style="border:0">男
		<input type="radio" name="gender" value="f" <?php echo (isset($personal['gender']) && $personal['gender'] == 'f') ? 'checked' :''; ?> style="border:0">女
		<span id="gender_warning"></span>
	</div>
	<div class="input">
		<label>出生日期：</label>
		<input type="text" name="birthday" readonly="readonly" id="birthday" size="12" value="<?php echo (isset($personal['birthday'])) ? $personal['birthday'] :''; ?>" onclick="SelectDate(this,'yyyy-MM-dd',80,0);" />
		<span id="birthday_info">（格式：0000-00-00）</span>
		<span id="birthday_warning"></span>
	</div>
	<div class="input">
		<label>居住地区：</label>
		<select name="province_id" id="selProvinces" onchange="region.changed(this, 2, 'selCities');">
			<option value='0' selected>省</option>
			<?php 
				foreach($provinces as $province)
					echo '<option value="'.$province['region_id'].'" '.((isset($personal['province_id']) && $province['region_id'] == $personal['province_id']) ? 'SELECTED' : '' ).'>'.$province['region_name'].'</option>';
			?>
		</select>
		<select id="selCities" name="city_id">
			<option value="0" selected>市/地区</option>
			<?php 
				if(isset($cities) && !empty($cities))
				foreach($cities as $city)
					echo '<option value="'.$city['region_id'].'" '.((isset($personal['city_id']) && $city['region_id'] == $personal['city_id']) ? 'SELECTED' : '' ).'>'.$city['region_name'].'</option>';
			?>
		</select>
		<span id="province_warning"></span>
	</div>
	<div class="input">
		<label>邮 编：</label>
		<input type="text" name="postcode" value="<?php echo (isset($personal['postcode']) && !empty($personal['postcode'])) ? $personal['postcode'] :''; ?>">
		<span id="postcode_warning"></span>
	</div>
	<div class="input">
		<label>居住地址：</label>
		<input type="text" size="40" name="address" value="<?php echo (isset($personal['address'])) ? $personal['address'] :''; ?>">
		<span id="address_warning"></span>
	</div>
	<div class="input">
		<label>居住时间：</label>
		<input type="text" name="duration" value="<?php echo (isset($personal['duration'])) ? $personal['duration'] :''; ?>">
		<span id="duration_info">（1年 2年半 8个月）</span>
		<span id="duration_warning"></span>
	</div>
	<div class="input">
		<label>家庭电话：</label>
		<input type="text" name="family_phone" value="<?php echo (isset($personal['family_phone'])) ? $personal['family_phone'] :''; ?>">
		<span id="family_phone_warning"></span>
	</div>
	<div class="input">
		<label>办公室电话：</label>
		<input type="text" name="work_phone" value="<?php echo (isset($personal['work_phone'])) ? $personal['work_phone'] :''; ?>">
		<span id="work_phone_warning"></span>
	</div>
	<div class="input">
		<label>手机：</label>
		<input type="text" name="mobile" value="<?php echo (isset($personal['mobile'])) ? $personal['mobile'] :''; ?>">
		<span id="mobile_warning"></span>
	</div>
	<div class="input">
		<label>电子邮件Email：</label>
		<input type="text" name="email" value="<?php echo (isset($personal['email'])) ? $personal['email'] :''; ?>">
		<span id="email_warning">（如通过初步审核，我们会发送相关信息到此邮件中）</span>
	</div>
	<div class="input">
		<label>最佳联系时间：</label>
		<input type="text" name="available_time" value="<?php echo (isset($personal['available_time'])) ? $personal['available_time'] :''; ?>">
		<span id="available_time_warning">（早上8点到10点 下午2半左右 晚上8点整 随时）</span>
	</div>
	<div class="input">
		<label>受您供养人数：</label>
		<input type="text" size="8" name="provide_count" value="<?php echo (isset($personal['provide_count'])) ? $personal['provide_count'] :''; ?>">人
		<span id="provide_count_info">（包括：儿女、父母、妻子等）</span>
		<span id="provide_count_warning"></span>
	</div>
	<div class="input">
		<label>受供养人姓名及年龄：</label>
		<textarea type="text" name="provide_peaple" rows="5" cols="50"><?php echo (isset($personal['provide_peaple'])) ? $personal['provide_peaple'] :"父亲：XXX 年龄：XX 岁\n母亲：XXX 年龄：XX 岁\n........"; ?></textarea>
		<span id="provide_peaple_warning"></span>
	</div>
	<div class="input">
		<label>尼德教育加盟省份：</label>
		<select name="join_provice" id="join_provice" onchange="region.changed(this, 2, 'join_city');">
			<option value='0' selected>省</option>
			<?php 
				foreach($provinces as $province)
					echo '<option value="'.$province['region_id'].'" '.((isset($personal['join_provice']) && $province['region_id'] == $personal['join_provice']) ? 'SELECTED' : '' ).'>'.$province['region_name'].'</option>';
			?>
		</select>
		<span id="join_provice_warning"></span>
	</div>
	<div class="input">
		<label>尼德教育加盟城市：</label>
		<select name="join_city" id="join_city">
			<option value="0" selected>市/地区</option>
			<?php 
				if(isset($join_cities) && !empty($join_cities))
				foreach($join_cities as $city)
					echo '<option value="'.$city['region_id'].'" '.((isset($personal['join_city']) && $city['region_id'] == $personal['join_city']) ? 'SELECTED' : '' ).'>'.$city['region_name'].'</option>';
			?>
		</select>
		<span id="join_city_warning"></span>
	</div>
	<div class="button">
		<input type="submit" name="submit" value="完成并下一步" class="input_button">
	</div>
	<input type="hidden" name="next_action" value="survey">
	</form>
</div>