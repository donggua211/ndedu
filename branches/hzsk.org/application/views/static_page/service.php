<div class="page_nav">
	当前位置：<a href="<?php site_url() ?>">首页</a> > 服务
</div>

<div class="product_content">
	<div class="left">
		<div class="title">产品分类 <img src="images/icon/green_right_triangle.gif"></div>
		<ul id="prod_left">
			<li onmouseover="switch_tag('prod_left', 0)"><a href="<?php echo site_url('product') ?>">产品</a></li>
			<li onmouseover="switch_tag('prod_left', 1)" class="cover"><a href="<?php echo site_url('service') ?>">服务</a></li>
		</ul>
	</div>
	<div class="right">
		<div class="text">    恒正尚康在为您过滤真品、正品、精品中求得生存，在为您提供科学、专业养生保健的服务上求得发展。</div>
		<div class="service">
			<table width="234px" border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;">
				<tr>
				  <td align="left" valign="bottom"><img src="images/index_message_head.jpg"/></td>
				</tr>
			</table>
			<table id="guestbook_table" border="0" cellspacing="0" cellpadding="0">
			<form name="guestbook_right" action="" method="post" onSubmit="return check_message_submit(this);">
				<tr><td align="left" valign="top">
					<table border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
						<tr>
							<td width="58px" align="right">姓&nbsp;&nbsp;名：</td>
							<td align="left">
								<label><input type="text" name="username" style="width:106px; height:18px; background-color:#F4F4F4; border:1px solid #DADADA"/></label>
								<span id="username_alert" style="display:none"> * </span>
							</td>
						</tr>
					</table>
					<table border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
						<tr>
							<td width="58px" align="right">电&nbsp;&nbsp;话：</td>
							<td align="left">
								<label><input type="text" name="phone" style="width:106px; height:18px; background-color:#F4F4F4; border:1px solid #DADADA"/></label>
								<span id="phone_alert" style="display:none"> * </span>
							</td>
						</tr>
					</table>
					<table border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
						<tr>
							<td width="58px" align="right">邮&nbsp;&nbsp;箱：</td>
							<td align="left">
								<label><input type="text" name="email" style="width:106px; height:18px; background-color:#F4F4F4; border:1px solid #DADADA"/></label>
								<span id="phone_alert" style="display:none"> * </span>
							</td>
						</tr>
					</table>
					<table border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
						<tr>
							<td width="58px" align="right">类&nbsp;&nbsp;型：</td>
							<td align="left">
								<label><input type="text" name="type" style="width:106px; height:18px; background-color:#F4F4F4; border:1px solid #DADADA"/></label>
								<span id="phone_alert" style="display:none"> * </span>
							</td>
						</tr>
					</table>
					<table border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
						<tr>
							<td width="58px" valign="top" align="right">内&nbsp;&nbsp;容：</td>
							<td align="left">
								<label><textarea name="message" style="width:300px; height:75px; background-color:#F4F4F4; border:1px solid #DADADA; overflow:auto"></textarea></label>
							</td>
						</tr>
					</table>
					<table border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
						<tr>
							<td width="58px" align="right">验证码：</td>
							<td align="left">
								<label><input type="text" name="captcha" style="width:60px; height:18px; background-color:#F4F4F4; border:1px solid #DADADA"/></label>
							</td>
							<td width="80" align="left">
								<img src="<?php echo site_url().'/ajax/captcha/'?>" id="safecode_right" border="0" onclick="reloadcode_right()" style="cursor:hand;padding:2px 8px 0pt 3px;"  />
							</td>
						</tr>
					</table>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
						<tr><td align="center"><label><input type="image" name="submit" align="bottom" src="images/message_botton.jpg"></label></td></tr>
					</table>
					<table width="100%" id="warningTable_right" border="0" cellspacing="0" cellpadding="0" style="display:none">
						<tr><td height="24" align="center" class="font_12_red"><div id="warningText_right"></div></td></tr>
					</table>
				</td></tr>
			</form>	
			</table>
		</div>
	</div>
</div>