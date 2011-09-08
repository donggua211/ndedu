<div class="page_nav">
	当前位置：<a href="<?php site_url() ?>">首页</a> > <?php echo $cat_info['cat_name'] ?>
</div>
<div class="article_content">
	<div class="left">
		<!-- 在线留言 -->
		<div class="index_message">
			<table width="234px" border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;" align="center">
				<tr>
				  <td align="center" valign="bottom"><img src="images/index_message_head.jpg"/></td>
				</tr>
			</table>
			<table id="guestbook_table" width="234px" border="0" cellspacing="0" cellpadding="0">
			<form name="guestbook_right" action="" method="post" onSubmit="return check_message_submit(this);">
				<tr><td align="center" valign="top">
					<table width="230" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
						<tr>
							<td width="60" align="right">姓&nbsp;&nbsp;名：</td>
							<td align="left">
								<label><input type="text" name="username" style="width:106px; height:18px; background-color:#F4F4F4; border:1px solid #DADADA"/></label>
								<span id="username_alert" style="display:none"> * </span>
							</td>
						</tr>
					</table>
					<table width="230" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
						<tr>
							<td width="60" align="right">电&nbsp;&nbsp;话：</td>
							<td align="left">
								<label><input type="text" name="phone" style="width:106px; height:18px; background-color:#F4F4F4; border:1px solid #DADADA"/></label>
								<span id="phone_alert" style="display:none"> * </span>
							</td>
						</tr>
					</table>
					<table width="230" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
						<tr>
							<td width="60" align="right">邮&nbsp;&nbsp;箱：</td>
							<td align="left">
								<label><input type="text" name="email" style="width:106px; height:18px; background-color:#F4F4F4; border:1px solid #DADADA"/></label>
								<span id="phone_alert" style="display:none"> * </span>
							</td>
						</tr>
					</table>
					<table width="230" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
						<tr>
							<td width="60" align="right">类&nbsp;&nbsp;型：</td>
							<td align="left">
								<label><input type="text" name="type" style="width:106px; height:18px; background-color:#F4F4F4; border:1px solid #DADADA"/></label>
								<span id="phone_alert" style="display:none"> * </span>
							</td>
						</tr>
					</table>
					<table width="230" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
						<tr>
							<td width="60" valign="top" align="right">内&nbsp;&nbsp;容：</td>
							<td align="left">
								<label><textarea name="message" style="width:148px; height:115px; background-color:#F4F4F4; border:1px solid #DADADA; overflow:auto"></textarea></label>
							</td>
						</tr>
					</table>
					<table width="230" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
						<tr>
							<td width="60" align="right">验证码：</td>
							<td align="left">
								<label><input type="text" name="captcha" style="width:60px; height:18px; background-color:#F4F4F4; border:1px solid #DADADA"/></label>
							</td>
							<td width="80" align="left">
								<img src="<?php echo site_url().'/ajax/captcha/'?>" id="safecode_right" border="0" onclick="reloadcode_right()" style="cursor:hand;padding:2px 8px 0pt 3px;"  />
							</td>
						</tr>
					</table>
					<table width="230" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
						<tr><td align="center"><label><input type="image" name="submit" align="bottom" src="images/message_botton.jpg"></label></td></tr>
					</table>
					<table id="warningTable_right" width="230" border="0" cellspacing="0" cellpadding="0" style="display:none">
						<tr><td height="24" align="center" class="font_12_red"><div id="warningText_right"></div></td></tr>
					</table>
				</td></tr>
			</form>	
			</table>
		</div>
	</div>
	<div class="right">
		<ul style="height:400px;">
			<?php foreach($article_list as $val): ?>
				<li>
					<div class="list_title"><a href="<?php echo site_url('article/'.$val['article_id']) ?>"><?php echo $val['title'] ?></a></div>
					<div class="list_time"><?php echo $val['add_time'] ?></div>
				</li>
			<?php endforeach; ?>
		</ul>
		
	</div>
</div>