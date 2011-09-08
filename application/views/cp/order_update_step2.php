<div id="order_main">
<form action="<?php echo site_url("cp_order/update"); ?>" method="post" id="orderstep2" onSubmit="return submit_order_step2(this);">
	<div class="order_nav">
		<span>订购流程</span><img src="images/cp/order_nav2.jpg" />
	</div>
	
	<?php if(isset($notification) && !empty($notification)): ?>
	<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
		<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
	</div>
	<?php endif;?>
	
	<div class="order_notice">
		<div class="font_red_14_bold">订单详情</div>
	</div>
	
	<div class="order_block">
		<div class="order_block_title border_gray_solid">您的信息：<a href="javascript:void(0)" onclick="return update_action_submit('orderstep2');">[编辑我的收款人信息]</a></div>
		<div class="order_block_cotent">
			<span><?php echo $orderinfo['name'] ?></span>
			<span><?php echo (isset($orderinfo['phone']) && !empty($orderinfo['phone'])) ? '座机：'.$orderinfo['phone'] : '' ?>
			<?php echo (isset($orderinfo['mobile']) && !empty($orderinfo['mobile'])) ? '手机：'.$orderinfo['mobile'] : '' ?></span>
		</div>
		
		<div class="order_block_title border_gray_solid" style="margin-top:10px">您的订单信息：<a href="javascript:void(0)" onclick="return update_action_submit('orderstep2');">[编辑订单信息]</a></div>
		<div class="order_block_cotent">
			产品名称：<?php echo $category_info['cat_name'] ?>- 升级至豪华版<br/>
			&nbsp;&nbsp;卡&nbsp;&nbsp;&nbsp;&nbsp;号&nbsp;&nbsp;：<?php echo (isset($card_info['card_id'])) ? $card_info['card_id'] :''; ?><br/>
			<div class="quan_link">
				<a href="javascript:void(0);" onclick="return collapse_switch('quan_area');">[使用优惠券]</a>
			</div>
			<div id="quan_area" style="display:none">
				<label>&nbsp;优&nbsp;惠&nbsp;券&nbsp;：</label>
				<input size="20" type="text" id="quan" name="quan" value="">
				<a href="javascript:void(0);" onclick="return check_quan();">确定</a>
				<span id="quan_warning"></span>
			</div>
			<div>
				&nbsp;&nbsp;总&nbsp;&nbsp;&nbsp;&nbsp;计&nbsp;&nbsp;：订单金额：<?php echo number_format($orderinfo['goods_fee'], 2, '.', '');?> + 运费：<?php echo number_format($orderinfo['ship_fee'], 2, '.', '') ;?> - 优惠券：<font id="quan_value">0</font> = 应付金额：<font id="total_count" class="font_30_orange"><?php echo number_format(($orderinfo['goods_fee'] + $orderinfo['ship_fee']), 2, '.', '') ;?></font>元
				<font id="old_total_count" style="display:none"><?php echo number_format(($orderinfo['goods_fee'] + $orderinfo['ship_fee']), 2, '.', '') ;?></font>
			</div>
		</div>
		<!--hidden信息 -->
		<input type="hidden" name="card_id" value="<?php echo $card_info['card_id'] ?>">
		<input type="hidden" name="name" value="<?php echo $orderinfo['name'];?>">
		<input type="hidden" name="province_id" value="<?php echo $orderinfo['province_id'];?>">
		<input type="hidden" name="city_id" value="<?php echo $orderinfo['city_id'];?>">
		<input type="hidden" name="district_id" value="<?php echo $orderinfo['district_id'];?>">
		<input type="hidden" name="address" value="<?php echo $orderinfo['address'];?>">
		<input type="hidden" name="postcode" value="<?php echo $orderinfo['postcode'];?>">
		<input type="hidden" name="phone" value="<?php echo $orderinfo['phone'];?>">
		<input type="hidden" name="mobile" value="<?php echo $orderinfo['mobile'];?>">
		<input type="hidden" name="order_num" value="<?php echo $orderinfo['order_num'];?>">
		<input type="hidden" name="delivery_type" value="<?php echo $orderinfo['delivery_type'];?>">
		<input type="hidden" name="message" value="<?php echo $orderinfo['message'];?>">
		
		<input type="hidden" name="total_price" value="<?php echo $orderinfo['goods_fee'] + $orderinfo['ship_fee'] ;?>">
		
		<input type="hidden" name="cat_id" value="<?php echo $orderinfo['cat_id'] ?>">
		<input type="hidden" name="level" value="<?php echo $orderinfo['level'] ?>">
		<input type="hidden" name="order_type" value="<?php echo $orderinfo['order_type'] ?>">
		<input type="hidden" value="step3" name="action" id="action">
	</div>
	<div class="order_submit_botton"><input type="image" name="submit" value="submit" src="images/cp/order_botton_submit.jpg"></div>
</form>
</div>