<div id="order_main">
<form action="<?php echo site_url("cp_order/update"); ?>" method="post" onSubmit="return submit_order(this);">
	<div class="order_nav">
		<span>订购流程</span><img src="images/cp/order_nav1.jpg" />
	</div>
	<div class="order_notice">
		<div class="font_red_12_bold">欢迎您升级<?php echo $category_info['cat_name'] ?>至豪华版，请正确填写收货地址和联系方式，谢谢！</div>
	</div>
	
	<?php if(isset($notification) && !empty($notification)): ?>
	<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
		<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
	</div>
	<?php endif;?>
	
	<div class="order_sub_title">填写您的信息：</div>
	<div class="order_block">
		<div class="input">
			<label>姓名: </label>
			<input size="15" type="text" name="name" value="<?php echo (isset($orderinfo['name'])) ? $orderinfo['name'] : $card_info['user_info']['name']; ?>">
			<span id="name_warning"></span>
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
			<span class="font_red_12_bold"><?php echo $category_info['cat_name'] ?> - 卡ID: <?php echo $card_info['card_id'] ?> - 升级至豪华版</span>
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
			<label>给卖家留言: </label>
			<textarea cols="60" name="message"><?php echo !empty($orderinfo['message'])? $orderinfo['message'] : '' ?></textarea>
		</div>
		
		<input type="hidden" name="card_id" value="<?php echo $card_info['card_id'] ?>">
		<input type="hidden" name="province_id" value="<?php echo $card_info['user_info']['province_id'] ?>">
		<input type="hidden" name="city_id" value="<?php echo $card_info['user_info']['city_id'] ?>">
		<input type="hidden" name="district_id" value="<?php echo $card_info['user_info']['district_id'] ?>">
		<input type="hidden" name="cat_id" value="<?php echo $orderinfo['cat_id'] ?>">
		<input type="hidden" name="order_type" value="<?php echo $orderinfo['order_type'] ?>">
		<input type="hidden" value="step2" name="action">
		<div class="clear"></div>
	</div>
	<div class="order_submit_botton"><input type="image" name="submit" value="submit" src="images/cp/order_botton_confirm.jpg"></div>
</form>
</div>