<div class="main_content">
	<div class="left">
		<div class="title">尚康推荐 <span>Recommended</span></div>
		<img src="images/top.jpg"/>
		<div class="products">
			<ul id="prod_ul">
				<li onmouseover="switch_tag('prod_ul', 0)"><a href="http://item.taobao.com/item.htm?spm=a1z10.1.w28.14.0Jyycq&id=20820444669" target="_blank"><img src="images/product1.jpg"></a><br/><a href="http://item.taobao.com/item.htm?spm=a1z10.1.w28.14.0Jyycq&id=20820444669" target="_blank"><span>恒正尚康-瓜子片</span></a></li>
				<li onmouseover="switch_tag('prod_ul', 1)"><a href="http://item.taobao.com/item.htm?spm=a1z10.1.w28.14.0Jyycq&id=20802352954" target="_blank"><img src="images/product2.jpg"></a><br/><a href="http://item.taobao.com/item.htm?spm=a1z10.1.w28.14.0Jyycq&id=20802352954" target="_blank"><span>恒正尚康-官儿正北芪</span></a></li>
				<li onmouseover="switch_tag('prod_ul', 2)"><a href="http://item.taobao.com/item.htm?spm=a1z10.1.w28.14.0Jyycq&id=20823620832" target="_blank"><img src="images/product3.jpg"></a><br/><a href="http://item.taobao.com/item.htm?spm=a1z10.1.w28.14.0Jyycq&id=20823620832" target="_blank"><span>恒正尚康-官儿正北芪</span></a></li>
				<li onmouseover="switch_tag('prod_ul', 3)"><a href="http://item.taobao.com/item.htm?spm=a1z10.1.w28.14.0Jyycq&id=19920920609" target="_blank"><img src="images/product4.jpg"></a><br/><a href="http://item.taobao.com/item.htm?spm=a1z10.1.w28.14.0Jyycq&id=19920920609" target="_blank"><span>恒正尚康-官儿正北芪</span></a></li>
			</ul>
		</div>
		<div class="clearfix"></div>
		<div class="title">尚康价值 <span>Value</span></div>
		<div class="block2">
			<div class="text">
				“精选自全国各地，健康于你我他家“，探寻华夏天然营养精华，甄选自然、绿色、有机<br/>
				的健康产品，为你我他家带来健康、快乐。
			</div>
		</div>
	</div>
	
	<div class="right">
		<!-- 最新资讯 -->
		<div class="index_news">
			<div class="head">
				<span>最新资讯 <font>Newest</font></span>
				<a href="<?php echo site_url('article/cat/1') ?>" target="_blank">更多>></a>
			</div>
			<div class="content">
				<?php foreach($sidebar1 as $key => $article): ?>
					<div class="one">
						<div class="des"><a href="<?php echo site_url('article/'.$article['article_id']) ?>" title="<?php echo $article['title']?>"><?php echo utf_substr($article['title'], 21)?></a></div>
						<div class="date"><?php $at_s = strtotime($article['add_time']); echo date('m/d', $at_s) ?></div>
					</div>
				<?php endforeach;?>
			</div>
			<img src="images/cp/index_sidebar_bottom.jpg">
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
</div>