<div id="order_main">
	<div class="order_nav">
		<span>订购流程</span><img src="images/cp/order_nav3.jpg" />
	</div>
	
	<?php if(isset($notification) && !empty($notification)): ?>
	<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
		<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
	</div>
	<?php endif;?>
	
	<div class="order_notice">
		<div class="font_red_14_bold">订单成功!</div>
	</div>
	
	<div class="order_block">
		<div class="order_block_title border_gray_solid">亲爱的，<?php echo $orderinfo['name'] ?>: </div>
		<div class="order_block_cotent">
			您的订单已成功，请您等待收货。收货时间依据您所在区域决定，感谢您的购买和支持，如果您有任何其他问题，随时拨打公司咨询电话010-59790750；或者登陆http://www.ndedu.org（尼德成长教育科技有限公司官方网站在线咨询，再一次感谢您的支持，祝您学习生活愉快！）
		</div>
		
		<div class="order_block_menubox">
			<ul>
				<span class="title">付款方式: </span>
				<li id="one1" onclick="setTab('one',1,2)" <?php echo (isset($orderinfo['delivery_type']) && $orderinfo['delivery_type'] == CP_ORDER_DELIVERY_TYPE_HUODAO ? 'class="hover"' : 'class="menu"' ) ?>>货到付款</li>
				<li id="one2" onclick="setTab('one',2,2)" <?php echo (isset($orderinfo['delivery_type']) && $orderinfo['delivery_type'] != CP_ORDER_DELIVERY_TYPE_HUODAO ? 'class="hover"' : 'class="menu"' ) ?>>银行汇款</li>
			</ul>
			<div class="clear border_gray_solid" style="padding-top:10px"></div>
		</div>
		<div class="order_block_content">
			<!-- 货到付款 -->
			<div id="con_one_1" <?php echo (isset($orderinfo['delivery_type']) && $orderinfo['delivery_type'] == CP_ORDER_DELIVERY_TYPE_HUODAO ? 'class="hover"' : 'style="display:none;"' ) ?> >				
				您选择货到付款方式，建议您再次确认您的订单信息，特别是姓名、地址电话，因为您提交订单之后，所有信息都无法再次修改，确定没有问题之后，尼德教育客服老师会在三个工作日之内和您核对您的订单信息，核对无误后，便会立即发货，谢谢您的订购。<br/>
				货到付款（适用于城市客户）： <br/>
				下好订单之后，请您在工作时间（9:00—17:30）拨打我们的订购电话：010-59790750或者发短信至13621360168告诉我们您的订单姓名、详细地址和联系电话，我们会通过宅急送将您订购的产品送到您家，收到货后将货款及快递费付给送货员。货到付款需加收手续费30元/次。
			</div>
			<!-- 银行汇款 -->
			<div id="con_one_2" <?php echo (isset($orderinfo['delivery_type']) && $orderinfo['delivery_type'] != CP_ORDER_DELIVERY_TYPE_HUODAO ? 'class="hover"' : 'style="display:none;"') ?>>
				<p>开户行：中国工商银行北京分行<br/>
				帐  号：9558 8002 0010 8555 372<br/>
				户  名：庞有博 </p>
				<p>开户行：中国民生银行北京苏州街支行<br/>
				帐号：  0125 0141 7001 8507<br/>
				户主：  北京尼德成长教育科技有限公司</p>
				<p>汇款方式说明：<br/>
				1.因为汇款的人比较多，请您务必在汇款金额后加上自己的手机尾号最后2位，比如：手机            号为139******45,应付汇款1500元，实际汇款 1500.45元。汇款之后发短信告知您的姓名、汇款金额，以备核对。 <br/>
				2.核对汇款之后，会回复短信跟您确认，一般在1个工作日之内即会回复，若您没有收到回复，请及时与我们联系。 3.请保留汇款凭证，以备不时之需。 </p>
			</div>
		</div>
	</div>
</div>