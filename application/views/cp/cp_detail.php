<table width="920" border="0" align="center" cellpadding="0" cellspacing="0" class="banner_border" style="margin-top:10px;">
  <tr>
    <td align="left"><img src="images/cp/banner_<?php echo $cat_info['cat_id'] ?>.jpg" width="916" height="203" /></td>
  </tr>
</table>
<table width="920" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30" background="images/hjxxgh_10.jpg" class="mianbao">
	您所在位置：<a href="<?php echo site_url('') ?>">首页</a> &gt; <a href="<?php echo site_url('cp/detail/1') ?>">全方位测评</a> &gt; <?php echo $cat_info['cat_name'] ?>
	</td>
  </tr>
</table>
<div id="cp_main">
	<div id="cp_main_sidebar">
		<!-- 媒体报道 -->
		<div class="sidebar_block">
			<div class="sidebar_head">
				媒体报道
				<a href="<?php echo site_url('media') ?>" target="_blank">更多&gt;&gt;</a>
			</div>
			<div class="sidebar_main">
				<?php foreach($sidebar1 as $key => $article): ?>
					<div class="sidebar_main_content<?php echo (count($sidebar1) > ($key + 1)) ? ' dashed_gray_line' : ''; ?>">
						<span class="sidebar_main_des"><a href="<?php echo site_url('article/'.$article['article_id']) ?>" title="<?php echo $article['title']?>"><?php echo utf_substr($article['title'], 25)?></a></span>
						<span class="sidebar_main_date"><?php echo $article['add_time']?></span>
					</div>
				<?php endforeach;?>
			</div>
			<img src="images/cp/index_sidebar_bottom.jpg">
		</div>
		
		<!-- 测评体验 -->
		<div class="sidebar_block">
			<div class="sidebar_head">
				本月热销排行
			</div>
			<div class="sidebar_main">
				<?php foreach($sidebar2 as $key => $val): ?>
					<div class="sidebar_main_content<?php echo (count($sidebar2) > ($key + 1)) ? ' dashed_gray_line' : ''; ?>">
						<span class="sidebar_main_des"><a href="<?php echo site_url('promo') ?>" title="<?php echo $val['title']?>" target="_blank"><?php echo utf_substr($val['title'], 25)?></a></span>
						<span class="sidebar_main_count"><b><?php echo $val['count'];?>件</b></span>
					</div>
				<?php endforeach;?>
			</div>
			<img src="images/cp/index_sidebar_bottom.jpg">
		</div>
		
		<!-- 发货通知 -->
		<div class="sidebar_block">
			<div class="sidebar_head">
				发货通知
			</div>
			<div class="sidebar_main">
				<div class="font_12">
					<iframe name="res" src="<?php echo site_url("cp/marquee") ?>" frameborder="0" scrolling="no" height="300px" width="200px"></iframe>
				</div>
			</div>
			<img src="images/cp/index_sidebar_bottom.jpg">
		</div>
		
		<!-- 在线留言 -->
		<div class="sidebar_block">
		<table width="247" border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;" align="center">
			<tr>
			  <td align="center" valign="bottom"><a href="javascript:viod(0);" onclick="collapse_switch('guestbook_table')"><img src="images/hjxxgh_44.jpg" width="247" height="63" border="0" /></a></td>
			</tr>
		</table>
		<table id="guestbook_table" width="247" border="0" cellspacing="0" cellpadding="0" align="center" style="display:none">
		<form name="guestbook_right" action="<?php echo site_url().'/guestbook/submit/'?>" method="post" onSubmit="return checkTable_contactus_right(this);">
			<tr><td height="384" align="center" valign="top" background="images/right_80.jpg">
				<table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
					<tr>
						<td width="70" align="left">姓&nbsp;&nbsp;&nbsp;&nbsp;名：</td>
						<td align="left">
							<label><input type="text" name="username" style="width:106px; height:18px; background-color:#FFFFFF; border:1px solid #CCCCCC"/></label>
							<span id="username_alert" style="display:none"> * </span>
						</td>
					</tr>
				</table>
				<table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
					<tr>
						<td width="70" align="left">电&nbsp;&nbsp;&nbsp;&nbsp;话：</td>
						<td align="left">
							<label><input type="text" name="phone" style="width:106px; height:18px; background-color:#FFFFFF; border:1px solid #CCCCCC"/></label>
							<span id="phone_alert" style="display:none"> * </span>
						</td>
					</tr>
				</table>
				<table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
					<tr>
						<td width="70" align="left">年&nbsp;&nbsp;&nbsp;&nbsp;级：</td>
						<td align="left">
							<select name="grade">
							<option value="preschool">学前班</option>
							<option value="primary_school">小学</option>
							<option value="junior_middle_school">初中</option>
							<option value="high_school">高中</option>
							</select>
							<span id="grade_alert" style="display:none"> * </span>
						</td>
					</tr>
				</table>
				<table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
					<tr>
						<td width="70" valign="top">学习情况：</td>
						<td  align="left">
							<label><textarea name="message" style="width:148px; height:115px; background-color:#FFFFFF; border:1px solid #CCCCCC; overflow:auto"></textarea></label>
						</td>
					</tr>
				</table>
				<table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
					<tr>
						<td width="70" align="left">验证码：</td>
						<td width="70" align="left">
							<label><input type="text" name="captcha" style="width:60px; height:18px; background-color:#FFFFFF; border:1px solid #CCCCCC"/></label>
						</td>
						<td width="80" align="left">
							<img src="<?php echo site_url().'/ajax/captcha/'?>" id="safecode_right" border="0" onclick="reloadcode_right()" style="cursor:hand;padding:2px 8px 0pt 3px;"  />
						</td>
					</tr>
				</table>
				<table id="warningTable_right" width="220" border="0" cellspacing="0" cellpadding="0" style="display:none">
					<tr><td height="24" align="center" class="font_12_red"><div id="warningText_right"></div></td></tr>
				</table>
				<table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
					<tr><td align="center"><label><input type="image" name="submit" align="bottom" src="images/right_19.jpg"></label></td></tr>
				</table>
				<table width="231" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
					<tr><td width="231" height="62" align="center" background="images/index2_35.jpg" class="font_12_red" style="padding-left:8px; padding-right:8px; padding-top:4px; font-size:12px; color:#333333; font-weight:bold">请放心，家长所留下的个人信息，尼德将恪守职业道德，为您保密。</td></tr>
				</table>
			</td></tr>
		</form>	
		</table>
		</div>
		<!-- 联系电话 -->
		<div class="sidebar_block">
			<img src="images/cp/contact_phone.jpg">
		</div>
	</div>

	<div id="cp_main_body">
		<form action="<?php echo site_url('cp_order')?>" method="post" target="_blank">
		<div class="cat_block">
			<div class="cat_block_head"><?php echo $cat_info['cat_name'] ?></div>
			<div class="cat_block_main_body">
				<img src="images/cp/cat_pic<?php echo $cat_info['cat_id'] ?>.jpg" class="cat_block_main_pic">
				<div class="cat_block_main_detail">
					<div><input type="radio" id="level1" name="level" value="<?php echo CP_LEVEL_LUXURY ?>" style="margin:0;padding:0;padding-left:4px;vertical-align:middle;" CHECKED><label for="level1">豪华版：<font class="cat_detail_yuan"><?php echo $cat_info['price_luxury'] ?></font> 元</label> <span class="cat_detail_cp_link"><a href="<?php echo site_url('cp_login/'.$cat_info['cat_id'].'/2') ?>">进入测评>></a></span></div>
					<div><input type="radio" id="level2" name="level" value="<?php echo CP_LEVEL_ADVANCED ?>" style="margin:0;padding:0;padding-left:4px;vertical-align:middle;"><label for="level2">高级版：<font class="cat_detail_yuan"><?php echo $cat_info['price_advanced'] ?></font> 元</label> <span class="cat_detail_cp_link"><a href="<?php echo site_url('cp_login/'.$cat_info['cat_id'].'/1') ?>">进入测评>></a></span></div>
					<div class="padding_left">产品单位：套</div>
					<div class="padding_left">产品运费：8-15元 (支持货到付款)</div>
					<div class="padding_left">30天售出：<font class="font_14_orange"><?php echo $cat_info['saled_last30'] ?>件</font> ( <span class="cat_detail_comment_link"><a href="<?php echo site_url('cp/detail/'.$cat_info['cat_id'].($page_nav['current_page'] > 1 ? '/'.$page_nav['current_page'] : '')) ?>#comments">已有<?php echo $page_nav['total'] ?>人发表评论</a></span> )</div>
					<div class="cat_detail_buy" onmouseover="detail_buy_mouse(this, 'FFF9D5', 'FFCC66');" onmouseout="detail_buy_mouse(this, 'F9F9F9', 'EDEDED');">
						我要购买：<input type="text" name="order_num" value="1" size="4" class="input_class"> 套
						<div class="cat_detail_botton">
							<input type="image" name="submit" src="images/cp/index_cat_detail_botton_buy.jpg">
							<a href="<?php echo site_url('cp/example/'.$cat_info['cat_id']) ?>" target="_blank"><img src="images/cp/index_cat_detail_botton_report.jpg"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" name="cat_id" value="<?php echo $cat_info['cat_id']; ?>">
		</form>
		
		<!-- 测评详情 -->
		<div class="cat_detail">
			<div class="cat_menubox">
                <ul>
                  <li id="one1" onclick="setTab('one',1,4)"  class="hover">评价详情</li>
                  <li id="one2" onclick="setTab('one',2,4)" >豪华版说明</li>
                  <li id="one3" onclick="setTab('one',3,4)">高级版说明</li>
                  <li id="one4" onclick="setTab('one',4,4)">如何使用</li>
                </ul>
            </div>
            <div class="cat_content">
				<!-- 评价详情 -->
                <div id="con_one_1" class="hover">
					<div class="cat_content_common">
						<div class="cat_content_score">
							<strong>该测评系统平均得分</strong><br/>
							<span><?php echo $cat_info['star']; ?></span>分
							<?php
								$full_star_html = '<img src="images/cp/detail_star.gif">';
								$half_star_html = '<img src="images/cp/detail_half_star.gif">';
								$full_star_count = floor($cat_info['star']);
								for($i = 0; $i < $full_star_count; $i++)
									echo $full_star_html;
								
								if(($cat_info['star'] - $full_star_count) == 0)
									echo '';
								else
									echo $half_star_html;
							?>
						</div>
						<div class="cat_score_pic">
							<div class="cat_score_pointer" style="margin-left:<?php echo ( $cat_info['star'] / 5 ) * 402 ?>px"><?php echo $cat_info['star']; ?></div>
						</div>
						<div class="clear"></div>
					</div>
					<!-- 评论 -->
					<div class="cat_comments">
						<a id="comments"></a>
						<table width="100%" cellspacing="0">	
							<tr>
								<th width="80%">评论</th>
								<th align="left" width="20%" style="padding-left:10px">评论人</th>
							</tr>
							<?php foreach($comments as $comment): ?>
							<tr>
								<td>
									<p style="text-align: left; max-width: 100%;"><?php echo nl2br($comment['comment']) ?></p>
									<span>[<?php echo $comment['add_time'] ?>]</span>
								</td>						
								<td align="left" valign="top" style=""><p><?php echo $comment['name'] ?></p></td>
							</tr>
							<?php endforeach; ?>
							<?php if($page_nav['total_page'] > 0): ?>
							<form action="<?php echo site_url('cp/detail/'.$cat_info['cat_id'].'#comments')?>" method="post">
							<tfoot><tr>
								<td colspan="2">
									显示<?php echo $page_nav['start']+1 ?>-<?php echo $page_nav['end'] ?>条
									<?php
									//首页 + 上一页
									if($page_nav['current_page'] == 1)
									{
										echo ' 首页 ';
										echo ' 上一页 &lt;&lt; ';
									}
									else
									{
										echo ' <a href="'.site_url('cp/detail/'.$cat_info['cat_id'].'/1#comments').'">首页</a> ';
										echo ' <a href="'.site_url('cp/detail/'.$cat_info['cat_id'].'/'.($page_nav['current_page']-1)).'#comments">上一页 &lt;&lt; </a> ';
									}
									
									//循环数字
									$page_index = 1;
									if($page_nav['current_page'] > 3)
										$page_index = $page_nav['current_page'] - 2;
									
									if($page_nav['last_page'] > 5 && ($page_nav['last_page'] - $page_nav['current_page']) < 3)
										$page_index = $page_nav['current_page'] - 4 + ($page_nav['last_page'] - $page_nav['current_page']);
									
									for($i = 0; $i < 5; $i++, $page_index++)
									{
										if($page_index > $page_nav['last_page'])
											break;
										
										if($page_index == $page_nav['current_page'])
											echo ' [<font color="#ff0000"> '.$page_index.' </font>] ';
										else
											echo  ' <a href="'.site_url('cp/detail/'.$cat_info['cat_id'].'/'.$page_index).'#comments">'.$page_index.'</a> ';
									
									}
									
									
									//末页 + 下一页
									if($page_nav['current_page'] == $page_nav['last_page'])
									{
										echo ' 下一页 &gt;&gt; ';
										echo ' 末页 ';
									}
									else
									{
										echo ' <a href="'.site_url('cp/detail/'.$cat_info['cat_id'].'/'.($page_nav['current_page']+1)).'#comments">下一页 &gt;&gt; </a> ';
										echo ' <a href="'.site_url('cp/detail/'.$cat_info['cat_id'].'/'.$page_nav['last_page']).'#comments">末页</a> ';
									}
									?>
									
									<input type="text" size="3" maxlength="3" name="page">
									<input type="submit" value="确定" style="padding:0;margin:0">
								</td>
							</tr></tfoot>
							</form>
							<?php endif; ?>
						</table>
					</div>
					<!-- 添加评论 -->
					<div class="cat_add_comment">
						<form action="<?php echo site_url('cp_order')?>" method="post" onSubmit="return submit_comment(this);">
						<table width="100%" cellspacing="0" align="center">
							<tr><td align="center">
								<textarea name="comment" class="textarea_border"></textarea>
							</td></tr>
							<tr><td>
								用户名：<input type="text" size="15" name="name" class="input_border"/>
								验证码：<input type="text" size="6" name="captcha" class="input_border"/>
								<img src="<?php echo site_url().'/ajax/captcha/'?>" id="safecode" onclick="reloadcode()" class="img_middle"/>
								<input type="image" name="submit" src="images/cp/comment_submit.jpg" class="img_middle" style="margin-left:10px">
								<input type="hidden" name="cat_id" value="<?php echo $cat_info['cat_id'] ?>">
								<span id="warningText" style="display:none"></span>
							</td></tr>
						</table>
						</form>
					</div>
				</div>
				<!-- 豪华版说明 -->
				<div id="con_one_2" class="cat_content_common" style="display:none;">
					<?php echo nl2p($cat_info['des_luxury']); ?>
				</div>
				<!-- 高级版说明 -->
				<div id="con_one_3" class="cat_content_common" style="display:none;">
					<?php echo nl2p($cat_info['des_advanced']); ?>
				</div>
				<!-- 如何使用 -->
				<div id="con_one_4" class="cat_content_common" style="display:none;">
					<p>如何使用：<br/>
					1. 拿到卡片之后，请您首先核对卡片名称和版本与您购买订单名称和版本是否一致，如果不一致请您致电010-59790750找尼德教育客服老师咨询，或者在线IM咨询，如下图所示：
					<div style="text-align:center; margin-bottom:10px"><img src="images/cp/how_to_use.jpg"/></div>
					2. 核对不误后，请您刮开测评卡背面封条处密码，密码共六位，由数字和大写字母组成。<br/>
					3. 将帐号和密码输入到测评登录页面，注意阅读提示语言。<br/>
					4. 进入后可以开始测评，测评后点击生成您的个性化报告。</p>
				</div>
            </div>
		</div>
	</div>
</div>
