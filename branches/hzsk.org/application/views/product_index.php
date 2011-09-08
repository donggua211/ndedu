<div class="product_content">
	<div class="left">
		<div class="title">产品分类 <img src="images/icon/green_right_triangle.gif"></div>
		<ul id="prod_left">
			<li onmouseover="switch_tag('prod_left', 0)" class="cover"><a href="<?php echo site_url('product') ?>">产品</a></li>
			<li onmouseover="switch_tag('prod_left', 1)"><a href="<?php echo site_url('service') ?>">服务</a></li>
		</ul>
	</div>
	<div class="right">
		<!-- 最新资讯 -->
		<div class="index_news">
			<div class="head">
				<span>最新资讯 <font>Newest</font></span>
				<a href="<?php echo site_url('media') ?>" target="_blank">更多>></a>
			</div>
			<div class="content">
				<?php foreach($sidebar1 as $key => $article): ?>
					<div class="one">
						<div class="des"><a href="<?php echo site_url('article/'.$article['article_id']) ?>" title="<?php echo $article['title']?>"><?php echo utf_substr($article['title'], 21)?></a></div>
						<div class="date"><?php $at_s = strtotime($article['add_time']); echo date('m/d', $at_s) ?></div>
					</div>
				<?php endforeach;?>
			</div>
		</div>
		
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
	<div class="center">
		<div class="text">
			恒正尚康恪守一套近乎苛刻的产品来源审核制度，充分考虑到产品种植或野生的环境因素，在全国范围内精选最自然、最品质、最精华养生保健产品，确保有机、自然、绿色。华夏960万平方公里的沃土就是我们的天然营养园。
		</div>
		<div class="products">
			<ul id="prod_ul">
				<li><img src="images/product1_large.jpg"><br/><span>恒正尚康-苦芥茶</span></li>
				<li><img src="images/product2_large.jpg"><br/><span>恒正尚康-苦芥茶</span></li>
				<li><img src="images/product3_large.jpg"><br/><span>恒正尚康-苦芥茶</span></li>
				<li><img src="images/product4_large.jpg"><br/><span>恒正尚康-苦芥茶</span></li>
			</ul>
		</div>
	</div>
</div>