<div class="cp_promo_header">
	<img src="images/cp/cp_promo_head.jpg">
</div>
<div class="cp_promo_wrap">
	<div class="cp_promo_main">
		<?php reset($cat_list); for($i = 1; $i <= 3; $i++): $value = current($cat_list); ?>
		<div class="cp_promo_first3" style="background:#FFFFFF url(images/cp/promo_<?php echo $i; ?>.jpg) no-repeat 96% <?php echo ($i==2)?20:50;?>px">
			<div class="cp_promo_block_title"><div class="index"><?php echo $i ?></div><?php echo $value['cat_name'] ?></div>
			<div class="cp_promo_content">
				<div class="cp_promo_block_left">
					<div class="cp_promo_block_buy">
						<span>￥<?php echo $value['ndedu_price'] ?></span>
						<form action="<?php echo site_url('cp_order')?>" method="post" target="_blank">
						<input type="image" name="submit" value="submit" src="images/cp/cp_promo_block_buy_botton.jpg">
						<input type="hidden" name="cat_id" value="<?php echo $value['cat_id']; ?>">
						<input type="hidden" name="level" value="<?php echo CP_LEVEL_LUXURY; ?>">
						<input type="hidden" name="order_type" value="<?php echo CP_ORDER_TYPE_PROMO; ?>">
						</form>
					</div>
					<div class="cp_promo_block_price">
						<table align="center">
							<thead>
								<tr><td>原价</td><td><font style="color:#D00A0A">节省</font></td></tr>
							</thead>
							<tbody>
								<tr><td>￥<?php echo $value['price'] ?></td><td><font style="color:#FF0000">￥<?php echo $value['price']-$value['ndedu_price'] ?></font></td></tr>
							</tbody>
						</table>
					</div>
					<div class="cp_promo_block_left_des">
						已有<?php echo $value['saled_cards'] ?>人购买<br/>
						<span class="red"><?php echo $value['intro'] ?></span><br/>
						<span class="gray">限量促销：<?php echo $value['total_cards'] ?>套，还剩<?php echo $value['total_cards']-$value['saled_cards'] ?>套</span>
					</div>
				</div>
				
				<div class="cp_promo_first3_right" style="margin-top:<?php if($i==1){echo 200;}elseif($i==2){echo 210;}elseif($i==3){echo 210;}?>px">
					<!-- <img src="images/cp/promo_<?php echo $i; ?>.jpg" /> -->
						<?php echo $value['description'] ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<?php next($cat_list);endfor; ?>
		
		<div class="clear"></div>
		
		<!-- 在线留言 -->
		<div class="cp_promo_sidebar">
			<div class="sidebar_block">
				<table width="264" border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;" align="center">
					<tr>
					  <td align="center" valign="bottom"><a href="javascript:viod(0);" onclick="collapse_switch('guestbook_table')"><img src="images/cp/promo_message.jpg" width="264" height="63" border="0" /></a></td>
					</tr>
				</table>
				<table id="guestbook_table" width="264" border="0" cellspacing="0" cellpadding="0" align="center" style="border-left:1px solid #FB8816;border-right:1px solid #FB8816;">
				<form name="guestbook_right" action="<?php echo site_url().'/guestbook/submit/'?>" method="post" onSubmit="return checkTable_contactus_right(this);">
					<tr><td align="center" valign="top">
						<table width="230" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
							<tr>
								<td width="70" align="left">姓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名：</td>
								<td align="left">
									<label><input type="text" name="username" style="width:106px; height:18px; background-color:#FFFBE2; border:1px solid #FD8610"/></label>
									<span id="username_alert" style="display:none"> * </span>
								</td>
							</tr>
						</table>
						<table width="230" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
							<tr>
								<td width="70" align="left">电&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;话：</td>
								<td align="left">
									<label><input type="text" name="phone" style="width:106px; height:18px; background-color:#FFFBE2; border:1px solid #FD8610"/></label>
									<span id="phone_alert" style="display:none"> * </span>
								</td>
							</tr>
						</table>
						<table width="230" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
							<tr>
								<td width="70" align="left">年&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;级：</td>
								<td align="left">
									<select name="grade" style="background-color:#FFFBE2; border:1px solid #FD8610;margin:0">
									<option value="preschool">学前班</option>
									<option value="primary_school">小学</option>
									<option value="junior_middle_school">初中</option>
									<option value="high_school">高中</option>
									</select>
									<span id="grade_alert" style="display:none"> * </span>
								</td>
							</tr>
						</table>
						<table width="230" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
							<tr>
								<td width="70" valign="top">学习情况：</td>
								<td  align="left">
									<label><textarea name="message" style="width:148px; height:115px; background-color:#FFFBE2; border:1px solid #FD8610; overflow:auto"></textarea></label>
								</td>
							</tr>
						</table>
						<table width="230" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
							<tr>
								<td width="70" align="left">验&nbsp;&nbsp;证&nbsp;&nbsp;码：</td>
								<td width="70" align="left">
									<label><input type="text" name="captcha" style="width:60px; height:18px; background-color:#FFFBE2; border:1px solid #FD8610"/></label>
								</td>
								<td width="80" align="left">
									<img src="<?php echo site_url().'/ajax/captcha/'?>" id="safecode_right" border="0" onclick="reloadcode_right()" style="cursor:hand;padding:2px 8px 0pt 3px;"  />
								</td>
							</tr>
						</table>
						<table id="warningTable_right" width="230" border="0" cellspacing="0" cellpadding="0" style="display:none">
							<tr><td height="24" align="center" class="font_12_red"><div id="warningText_right"></div></td></tr>
						</table>
						<table width="230" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
							<tr><td align="center"><label><input type="image" name="submit" align="bottom" src="images/cp/promo_message_botton.jpg"></label></td></tr>
						</table>
						<table width="231" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;padding-bottom:8px;">
							<tr><td width="231" height="62" align="center" background="images/index2_35.jpg" class="font_12_red" style="padding-left:8px; padding-right:8px; padding-top:4px; font-size:12px; color:#333333; font-weight:bold">请放心，家长所留下的个人信息，你的将恪守职业道德，为您保密。</td></tr>
						</table>
					</td></tr>
				</form>	
				</table>
				<table width="264" border="0" cellspacing="0" cellpadding="0">
					<tr><td width="264" align="center"><img src="images/cp/promo_message_bottom.jpg"></td></tr>
				</table>
			</div>
			<div class="sidebar_block">
				<!-- 联系电话 -->
				<div class="sidebar_block">
					<img src="images/cp/promo_contact_phone.jpg">
				</div>
			</div>
		</div>
		<div class="cp_promo_others_main">
			<?php prev($cat_list); while(next($cat_list) !== false): $value = current($cat_list);?>
			<div class="cp_promo_others">
				<div class="cp_promo_block_title"><div class="index"><?php echo $i ?></div><?php echo $value['cat_name'] ?></div>
				<div class="cp_promo_content">
					<div class="cp_promo_block_left">
						<div class="cp_promo_block_buy">
							￥<?php echo $value['ndedu_price'] ?>
							<form action="<?php echo site_url('cp_order')?>" method="post" target="_blank">
							<input type="image" name="submit" src="images/cp/cp_promo_block_buy_botton.jpg">
							<input type="hidden" name="cat_id" value="<?php echo $value['cat_id']; ?>">
							<input type="hidden" name="level" value="<?php echo CP_LEVEL_LUXURY; ?>">
							<input type="hidden" name="order_type" value="<?php echo CP_ORDER_TYPE_PROMO; ?>">
							</form>
						</div>
						<div class="cp_promo_block_price">
							<table align="center">
								<thead>
									<tr><td>原价</td><td><font style="color:#D00A0A">节省</font></td></tr>
								</thead>
								<tbody>
									<tr><td>￥<?php echo $value['price'] ?></td><td><font style="color:#FF0000">￥<?php echo $value['price']-$value['ndedu_price'] ?></font></td></tr>
								</tbody>
							</table>
						</div>
						<div class="cp_promo_block_left_des">
							已有<?php echo $value['saled_cards'] ?>人购买<br/>
							<span class="red"><?php echo $value['intro'] ?></span><br/>
							<span class="gray">限量促销：<?php echo $value['total_cards'] ?>套，还剩<?php echo $value['total_cards']-$value['saled_cards'] ?>套</span>
						</div>
					</div>
					
					<div class="cp_promo_others_right">
						<img src="images/cp/promo_<?php echo $i; ?>.jpg" />
						<div class="cp_promo_others_right_des">
							<?php echo $value['description'] ?>
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<?php $i++;endwhile; ?>
		</div>
		<div class="clear"></div>
	</div>
</div>