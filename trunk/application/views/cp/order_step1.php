<div id="order_main">
<form action="<?php echo site_url("cp_order"); ?>" method="post" onSubmit="return submit_order(this);">
	<div class="order_nav">
		<span>订购流程</span><img src="images/cp/order_nav1.jpg" />
	</div>
	<div class="order_notice">
		<div class="font_red_12_bold">欢迎您购买<?php echo $category_info['cat_name'] ?><?php echo ($orderinfo['order_type'] == CP_ORDER_TYPE_NORMAL ) ? ' - '.get_cp_level_text($orderinfo['level']) : ''; ?>，请正确填写收货地址和联系方式，谢谢！</div>
		<div class="font_gray_12_bold">您也可以在你的教育淘宝店购买，<a href="http://ndedu.taobao.com" class="font_143_orange" target="_blank">购买链接>></a></div>
	</div>
	
	<?php if(isset($notification) && !empty($notification)): ?>
	<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
		<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
	</div>
	<?php endif;?>
	
	<div class="order_notice_block">
		您可以直接通过银行转帐购买对应年级测评卡，转帐成功后我们会将测评卡帐号和密码通过在线聊天工具或者QQ直接发送给您。<br/>
		帐  号：9558 8002 0010 8555 372 ( 工商银行 )<br/>
		户  名：庞有博 
	</div>
	
	<div class="order_main_title">你的教育购买</div>
	<div class="order_sub_title">填写收货地址：</div>
	<div class="order_block">
		<div class="input">
			<label>收货人姓名: </label>
			<input size="15" type="text" name="name" value="<?php echo (isset($orderinfo['name'])) ? $orderinfo['name'] :''; ?>">
			<span id="name_warning"></span>
		</div>
		<div class="input">
			<label>所在地区: </label>
			<select name="province_id" id="selProvinces" onchange="region.changed(this, 2, 'selCities');update_ship_fee(this);">
				<option value='0' selected>省</option>
				<?php 
					foreach($provinces as $province)
						echo '<option value="'.$province['region_id'].'" '.((isset($orderinfo['province_id']) && $province['region_id'] == $orderinfo['province_id']) ? 'SELECTED' : '' ).'>'.$province['region_name'].'</option>';
				?>
			</select>
			<select onchange="region.changed(this, 3, 'selDistrict')" id="selCities" name="city_id">
				<option value="0" selected>市/地区</option>
				<?php 
					if(isset($cities) && !empty($cities))
					foreach($cities as $city)
						echo '<option value="'.$city['region_id'].'" '.((isset($orderinfo['city_id']) && $city['region_id'] == $orderinfo['city_id']) ? 'SELECTED' : '' ).'>'.$city['region_name'].'</option>';
				?>
			</select>
			<select id="selDistrict" name="district_id">
				<option value="0" selected>县/市</option>
				<?php
					if(isset($districts) && !empty($districts))
					foreach($districts as $district)
						echo '<option value="'.$district['region_id'].'" '.((isset($orderinfo['district_id']) && $district['region_id'] == $orderinfo['district_id']) ? 'SELECTED' : '' ).'>'.$district['region_name'].'</option>';
				?>
			</select> <span id="loader"></span>
		</div>
		<div class="input">
			<label>街道地址: </label>
			<input size="60" type="text" name="address" value="<?php echo (isset($orderinfo['address'])) ? $orderinfo['address'] :''; ?>">
			<span id="address_warning"></span>
		</div>
		<div class="input">
			<label>邮政编码: </label>
			<input size="15" type="text" name="postcode" value="<?php echo (isset($orderinfo['postcode']) && !empty($orderinfo['postcode'])) ? $orderinfo['postcode'] :''; ?>">
			<span id="postcode_warning"></span>
		</div>
		<div class="input">
			<label>座机电话: </label>
			<input size="20" type="text" name="phone" value="<?php echo (isset($orderinfo['phone']) && !empty($orderinfo['phone'])) ? $orderinfo['phone'] :'010-'; ?>" onblur="if (value ==''){value='010-'}" onfocus="if (value =='010-'){value =''}">
			<span id="phone_warning"></span>
		</div>
		<div class="input">
			<label>手机电话: </label>
			<input size="20" type="text" name="mobile" value="<?php echo (isset($orderinfo['mobile'])) ? $orderinfo['mobile'] :''; ?>">
			<span id="mobile_warning"></span>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="order_sub_title">填写产品信息：</div>
	<div class="order_block">
		<div class="input">
			<label>产品名称: </label>
			<span class="font_red_12_bold"><?php echo $category_info['cat_name'] ?><?php echo ($orderinfo['order_type'] == CP_ORDER_TYPE_NORMAL ) ? ' - '.get_cp_level_text($orderinfo['level']) : ''; ?></span>
		</div>
		<!-- 如果没有level, 则选则版本 -->
		<?php if(($orderinfo['order_type'] == CP_ORDER_TYPE_NORMAL ) && $orderinfo['level'] <= 0 ):?>
		<div class="input">
			<label>&nbsp;</label>			
			<input type="radio" name="level" value="<?php echo CP_LEVEL_LUXURY ?>" CHECKED> 豪华版<font class="cat_detail_yuan"><?php echo $category_info['price_luxury'] ?></font>元
		</div>
		<div class="input">
			<label>&nbsp;</label>			
			<input type="radio" name="level" value="<?php echo CP_LEVEL_ADVANCED ?>"> 高级版<font class="cat_detail_yuan"><?php echo $category_info['price_advanced'] ?></font>元
		</div>
		<?php else:?>
		<input type="hidden" name="level" value="<?php echo $orderinfo['level'] ?>">
		<?php endif; ?>
		<!-- 选择版本: end -->
		<div class="input">
			<label>购买数量: </label>
			<input size="6" type="text" name="order_num" value="<?php echo (isset($orderinfo['order_num']) && ($orderinfo['order_num'] > 0)) ? $orderinfo['order_num'] :'1'; ?>">套
			<span id="num_warning"></span>
		</div>
		<div class="input_noborder">
			<label>运送方式: </label>
			<span id="ship_to">北京</span>
			<span id="delivery_warning"></span>
		</div>
		<div class="input_noborder">
			<label>&nbsp;</label>			
			<input type="radio" name="delivery_type" value="<?php echo CP_ORDER_DELIVERY_TYPE_PINGYOU; ?>" <?php echo (isset($orderinfo['delivery_type']) && $orderinfo['delivery_type'] == CP_ORDER_DELIVERY_TYPE_PINGYOU) ? 'CHECKED' :''; ?>>平邮: <span id="pingyou_fee">8.00</span>
		</div>
		<div class="input_noborder">
			<label>&nbsp;</label>			
			<input type="radio" name="delivery_type" value="<?php echo CP_ORDER_DELIVERY_TYPE_KUAIDI; ?>" <?php echo (isset($orderinfo['delivery_type']) && $orderinfo['delivery_type'] == CP_ORDER_DELIVERY_TYPE_KUAIDI) ? 'CHECKED' :''; ?>>快递公司: <span id="kuaidi_fee">10.00</span>
		</div>
		<div class="input_noborder">
			<label>&nbsp;</label>			
			<input type="radio" name="delivery_type" value="<?php echo CP_ORDER_DELIVERY_TYPE_EMS; ?>" <?php echo (isset($orderinfo['delivery_type']) && $orderinfo['delivery_type'] == CP_ORDER_DELIVERY_TYPE_EMS) ? 'CHECKED' :''; ?>>EMS: <span id="ems_fee">15.00</span>
		</div>
		<div class="input_noborder">
			<label>&nbsp;</label>			
			<input type="radio" name="delivery_type" value="<?php echo CP_ORDER_DELIVERY_TYPE_HUODAO; ?>" <?php echo (isset($orderinfo['delivery_type']) && $orderinfo['delivery_type'] == CP_ORDER_DELIVERY_TYPE_HUODAO) ? 'CHECKED' :''; ?>>货到付款: <span id="huodao_fee">30.00</span>
		</div>
		<div class="input">
			<label>给卖家留言: </label>
			<textarea cols="60" name="message"><?php echo !empty($orderinfo['message'])? $orderinfo['message'] : '' ?></textarea>
		</div>
		
		<input type="hidden" name="cat_id" value="<?php echo $orderinfo['cat_id'] ?>">
		<input type="hidden" name="order_type" value="<?php echo $orderinfo['order_type'] ?>">
		<input type="hidden" value="step2" name="action">
		<div class="clear"></div>
	</div>
	<div class="order_submit_botton"><input type="image" name="submit" value="submit" src="images/cp/order_botton_confirm.jpg"></div>
</form>
</div>