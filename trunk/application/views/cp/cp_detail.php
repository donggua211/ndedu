<table width="920" border="0" align="center" cellpadding="0" cellspacing="0" class="banner_border" style="margin-top:10px;">
  <tr>
    <td align="left"><img src="images/cp/banner_<?php echo $cat_info['cat_id'] ?>.jpg" width="916" height="203" /></td>
  </tr>
</table>
<table width="920" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30" background="images/hjxxgh_10.jpg" class="mianbao">
	您所在位置：<a href="<?php echo site_url('') ?>">首页</a> > <a href="<?php echo site_url('cp/detail/1') ?>">全方位测评</a> > <?php echo $cat_info['cat_name'] ?>
	</td>
  </tr>
</table>
<div id="cp_main">
	<div id="cp_main_sidebar">
		<!-- 媒体报道 -->
		<div class="sidebar_block">
			<div class="sidebar_head">
				<span>媒体报道</span>
				<a href="<?php echo site_url('media') ?>" target="_blank">更多>></a>
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
						<span class="sidebar_main_count"><?php echo $val['count'];?> 件</span>
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
					<tr><td width="231" height="62" align="center" background="images/index2_35.jpg" class="font_12_red" style="padding-left:8px; padding-right:8px; padding-top:4px; font-size:12px; color:#333333; font-weight:bold">请放心，家长所留下的个人信息，你的将恪守职业道德，为您保密。</td></tr>
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
					<table cellspacing="0" cellpadding="0" >
						<tr valign=""><td width="184px"><input type="radio" id="level1" name="level" value="<?php echo CP_LEVEL_LUXURY ?>" style="margin:0;padding:0;padding-left:4px;vertical-align:middle;" CHECKED><label for="level1">豪华版：<font class="cat_detail_yuan"><?php echo $cat_info['price_luxury'] ?></font> 元</label></td>
						<td valign="middle"><span class="cat_detail_cp_link"><a href="<?php echo site_url('cp_login/'.$cat_info['cat_id'].'/2') ?>">进入测评>></a></span></td></tr>
						<tr><td width="184px"><input type="radio" id="level2" name="level" value="<?php echo CP_LEVEL_ADVANCED ?>" style="margin:0;padding:0;padding-left:4px;vertical-align:middle;"><label for="level2">高级版：<font class="cat_detail_yuan"><?php echo $cat_info['price_advanced'] ?></font> 元</label></td>
						<td valign="middle"><span class="cat_detail_cp_link"><a href="<?php echo site_url('cp_login/'.$cat_info['cat_id'].'/1') ?>">进入测评>></a></span></td></tr>
					</table>
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
                  <li id="one1" onclick="setTab('one',1,4)"  class="hover">产品详情</li>
                  <li id="one2" onclick="setTab('one',2,4)" >用户评论</li>
                  <li id="one3" onclick="setTab('one',3,4)">常见问题</li>
                  <li id="one4" onclick="setTab('one',4,4)">如何使用</li>
                </ul>
            </div>
            <div class="cat_content">
				<!-- 产品详情 -->
				<div id="con_one_1" class="cat_content_common hover">
					<div class="detail_title">背景：</div>
					<div class="detail_text">
					<?php 
						if( $cat_info['cat_id'] == 1 )
							echo  '本测评由北京师范大学、北京大学多位教育心理专家、特高级教师参与编写开发，主要针对小学生在学习成长过程中经常遇到的学习成长内在因素进行科学检测，旨在辅助家长和教师准确把握孩子当前学习成长过程中遇到的问题，切实了解孩子的优势与不足，从而科学有效地解决问题，让孩子快乐学习成长，考试拿满分。';
						elseif( $cat_info['cat_id'] == 2 )
							echo  '本测评由北京师范大学、北京大学多位教育心理专家、特高级教师参与编写开发，主要针对初中生在学习成长过程中经常遇到的学习成长内在因素进行科学检测，旨在辅助家长和教师准确把握孩子当前学习成长过程中遇到的问题，切实了解孩子的优势与不足，从而科学有效地解决问题，让孩子快乐学习成长，考试拿满分。';
						elseif( $cat_info['cat_id'] == 3 )
							echo  '本测评由北京师范大学、北京大学多位教育心理专家、特高级教师参与编写开发，主要针对高中生在学习成长过程中经常遇到的学习成长内在因素进行科学检测，旨在辅助家长和教师准确把握孩子当前学习成长过程中遇到的问题，切实了解孩子的优势与不足，从而科学有效地解决问题，让孩子快乐学习成长，考试拿满分。';
						elseif( $cat_info['cat_id'] == 4 )
							echo  '本测评由北京师范大学、北京大学多位教育心理专家、特高级教师参与编写开发，主要针对高中生在高考之前身心压力和复习考试技巧各项因素进行科学检测，旨在帮助家长和教师准确把握孩子高考前夕可能遇到的问题；帮助学生自己明确自己当前的学习状态，从而科学有效地解决问题，让孩子快乐学习成长，考试拿满分。';
						elseif( $cat_info['cat_id'] == 5 )
							echo  '本测评由北京师范大学、北京大学多位教育心理专家、特高级教师参与编写，主要针对高三学生高考选择学校、选择专业进行科学检测，旨在帮助学员根据自己的兴趣、自己的考试成绩和当前热门专业说明，从而选择适合自己的专业和学校。';
					?>
					</div>										
					<div class="detail_title" style="margin-top:20px">详细说明：</div>
					<?php if( $cat_info['cat_id'] == 1 ): ?>
						<div class="detail_sub_title">1、什么是小学生学习成长素养与家庭教育指导测评？</div>
						<div class="detail_text">小学生学习成长素养与家庭教育指导测评是从小学生学业规划的角度出发，以帮助小学生快乐学习成长为目标，针对小学生常见的学习成长元素进行科学、全面、精准的测试，然后依据分析结果给出当前小学生学习成长问题和个性化学习成长报告。</div>
						
						<div class="detail_sub_title">2、为什么要进行学习素养与家庭教育指导测评？</div>
						<div class="detail_text">
							<ul>
								<li>从小培养孩子做事专心致志，作业主动积极。</li>
								<li>让孩子从小对学习感兴趣，培养孩子的好奇心和求知欲。</li>
								<li>孩子思维灵活、聪明机灵。</li>
								<li>能够很好的调整自己，人格完善、心理健康。</li>
								<li>逐渐掌握属于自己的学习方法、形成良好的学习习惯。</li>
								<li>让父母明确孩子可能遇到的学习成长问题，并了解问题背后的原因。</li>
								<li>给予父母科学的有效的解决孩子学习成长问题的方法。</li>
								<li>全国知名教育专家老师作为孩子、父母的坚强后盾。</li>
							</ul>
						</div>

						<div class="detail_sub_title">3、你可以从测评中得到什么？</div>
						<div class="detail_text">清晰了解孩子当前各项学习成长元素具体分值和说明，如下图：
						<div style="text-align:center;margin-top:15px;margin-bottom:15px"><img src="images/cp/detail_<?php echo $cat_info['cat_id']; ?>.jpg"></div>
						<ul>
							<li>针对孩子的每一项学习成长元素给予正确有效的方法和指导。</li>
							<li>让孩子从小养成良好的学习习惯和行为习惯。</li>
							<li>为孩子将来学业成功奠定坚实的基础。</li>
							<li>优异的学习成绩、全面的综合素质。</li>
							<li>一份专属于您孩子的学习成长元素分析说明和对应科学学习成长指导报告（5000字，10页左右）。</li>
						</ul>
						</div>
					<?php elseif( $cat_info['cat_id'] == 2 ): ?>
						<div class="detail_sub_title">1、什么是初中应试能力测评？</div>
						<div class="detail_text">初中应试能力测评是从初中学生学业规划的角度出发，以帮助初中学生提升学习应试能力为目标，针对初中学生经常遇到的学习成长问题进行科学、全面、精准的测试，然后依据分析结果给出当前学生学习成长问题和个性化学习成长报告。</div>
						
						<div class="detail_sub_title">2、为什么要进行初中应试能力测评？</div>
						<div class="detail_text">
						<ul>
							<li>让孩子正确认识自己当前的学业整体情况，从而更加准确的把握自己的学业方向。</li>
							<li>对照自己当前学习方法，除漏查缺，逐渐完善属于自己的学习方法。</li>
							<li>更加合理安排自己的学习时间和学习内容，统筹整体学习环节。</li>
							<li>发现自己欠缺的知识面，合理调整自己阅读内容，养成良好的阅读习惯。</li>
							<li>随着学科难度的增加，学业压力的增大，掌握相应考试技巧和复习方法，从而增强自己的学习信心。</li>
							<li>顺利度过青春期，明确青春期可能遇到的各种问题和相应解决方法。</li>
							合理评估自己家庭环境和学校环境，并采取积极的态度去面对。</li>
							<li>让父母更加了解孩子当前学习、心理、生理特点，并给予合理科学的指导建议和具有操作性的方法。</li>
							<li>全国知名教育专家老师作为孩子、父母的坚强后盾，我们随时为您解答测评的疑问。</li>
						</ul>
						</div>

						<div class="detail_sub_title">3、你可以从测评中得到什么？</div>
						<div class="detail_text">清晰了解孩子当前各项学习应试能力元素具体分值和说明，如下图：
						<div style="text-align:center;margin-top:15px;margin-bottom:15px"><img src="images/cp/detail_<?php echo $cat_info['cat_id']; ?>.jpg"></div>
						<ul>
							<li>针对孩子的每一项应试能力元素给予正确有效的方法和指导。</li>
							<li>越来越明白自己学习、应试、成长的一些问题，并开始正视这些问题。</li>
							<li>开始感觉到学习、考试越来越轻松，自己越来越自信强大。</li>
							<li>优异的学习成绩、全面的综合素质。</li>
							<li>亲子关系越来越融洽，似乎父母突然理解自己了。</li>
							<li>父母也突然感觉到孩子似乎变了个人，家庭氛围越来越好了。</li>
							<li>一份专属于您孩子的学习成长元素分析说明和对应科学学习成长指导报告（5000字，10页左右）。</li>
						</ul>
						</div>
					<?php elseif( $cat_info['cat_id'] == 3 ): ?>
						<div class="detail_sub_title">1、什么是高中应试能力测评？</div>
						<div class="detail_text">高中应试能力测评是从高中学生学业规划的角度出发，以帮助高中学生提升学习应试能力为目标，针对高中学生经常遇到的学习成长问题进行科学、全面、精准的测试，然后依据分析结果给出当前学生学习成长问题和个性化学习成长报告。</div>
						
						<div class="detail_sub_title">2、为什么要进行高中应试能力测评？</div>
						<div class="detail_text">
						<ul>
							<li>让孩子正确认识自己当前的学业整体情况，从而更加准确的把握自己的学业方向。</li>
							<li>对照自己当前学习方法，除漏查缺，逐渐完善属于自己的学习方法。</li>
							<li>更加合理安排自己的学习时间和学习内容，统筹整体学习环节。</li>
							<li>发现自己欠缺的知识面，合理调整自己阅读内容，养成良好的阅读习惯。</li>
							<li>随着学科难度的增加，学业压力的增大，掌握相应考试技巧和复习方法，从而增强自己的学习信心。</li>
							<li>合理评估自己家庭环境和学校环境，并采取积极的态度去面对。</li>
							<li>合理安排自己时间，掌握一定抗压技巧，轻松充实的度过高中学习生活。</li>
							<li>让父母更加了解孩子当前学习、心理、生理特点，并给予合理科学的指导建议和具有操作性的方法。</li>
							<li>全国知名教育专家老师作为孩子、父母的坚强后盾，我们随时为您解答测评的疑问。</li>
						</ul>
						</div>

						<div class="detail_sub_title">3、你可以从测评中得到什么？</div>
						<div class="detail_text">清晰了解孩子当前各项学习应试能力元素具体分值和说明，如下图：
						<div style="text-align:center;margin-top:15px;margin-bottom:15px"><img src="images/cp/detail_<?php echo $cat_info['cat_id']; ?>.jpg"></div>
						<ul>
							<li>针对孩子的每一项应试能力元素给予正确有效的方法和指导。</li>
							<li>越来越明白自己学习、应试、成长的一些问题，并开始正视这些问题。</li>
							<li>开始感觉到学习、考试越来越轻松，自己越来越自信强大。</li>
							<li>优异的学习成绩、全面的综合素质。</li>
							<li>亲子关系越来越融洽，似乎父母突然理解自己了。</li>
							<li>父母也突然感觉到孩子似乎变了个人，家庭氛围越来越好了。</li>
							<li>一份专属于您孩子的学习成长元素分析说明和对应科学学习成长指导报告（5000字，10页左右）。</li>
						</ul>
						</div>
					<?php elseif( $cat_info['cat_id'] == 4 ): ?>
						<div class="detail_sub_title">1、什么是你的高考状态测评？</div>
						<div class="detail_text">你的高考状态测评从高中学生学业规划的角度出发，以帮助高中学生积极调整高考状态超常发挥考试水平为目标，针对高中学生高考前经常遇到的复习考试问题进行科学、全面、精准的测试，然后依据分析结果给出当前学生个性化复习考试报告。</div>
						
						<div class="detail_sub_title">2、为什么要进行你的高考状态测评？</div>
						<div class="detail_text">
						<ul>
							<li>帮助学生正确了解自己个性特点，认识自己，调整自己。</li>
							<li>了解学生家庭教育与学校学习生活状况，给出正确处理家庭、学校、高考之间的关系。</li>
							<li>让孩子正确认识自己当前的学业整体情况，从而更加从容地面对高考。</li>
							<li>更加合理安排自己的复习时间和内容，统筹整体学习环节。</li>
							<li>掌握一定抗压技巧，快速进入备考状态。</li>
							<li>针对当前学生情况给予家长正确辅助孩子备考建议。</li>
							<li>全国知名教育专家老师作为孩子、父母的坚强后盾，我们随时为您解答测评的疑问。</li>
						</ul>
						</div>

						<div class="detail_sub_title">3、你可以从测评中得到什么？</div>
						<div class="detail_text">清晰了解孩子当前高考状态元素各项具体分值和说明，如下图：
						<div style="text-align:center;margin-top:15px;margin-bottom:15px"><img src="images/cp/detail_<?php echo $cat_info['cat_id']; ?>.jpg"></div>
						<ul>
							<li>针对孩子的每一项高考状态力元素给予正确有效的方法和指导。</li>
							<li>孩子更有信心和动力努力的投入到高考的复习当中。</li>
							<li>轻松、积极地备考。</li>
							<li>超常的发挥平日的学习水平。</li>
							<li>一份专属于您孩子的高考状态调整指导报告（5000字，10页左右）。</li>
						</ul>
						</div>
					<?php elseif( $cat_info['cat_id'] == 5 ): ?>
						<div class="detail_sub_title">1、什么是你的高考专业选择测评？</div>
						<div class="detail_text">你的高考专业选择测评从高中学生学业规划的角度出发，以帮助高中学生合理选择大学专业为目标，针对学生个性特点、兴趣方向进行科学、全面、精准的测试，然后依据分析结果给出当前学生大学专业选择报告。</div>
						
						<div class="detail_sub_title">2、为什么要进行你的高考专业选择测评？</div>
						<div class="detail_text">
						<ul>
							<li>帮助学生正确了解自己个性特点，熟悉大学的不同专业。</li>
							<li>正确认识自己的兴趣，将自己兴趣与大学专业建立关联。</li>
							<li>综合考虑自我的高考成绩和兴趣爱好以及个性特点从而选择合适的专业。</li>
							<li>走好自我职业规划的第一步，从而充实开心的度过大学，进入社会。</li>
							<li>全国知名教育专家老师作为孩子、父母的坚强后盾，我们随时为您解答测评的疑问。</li>
						</ul>
						</div>

						<div class="detail_sub_title">3、你可以从测评中得到什么？</div>
						<div class="detail_text">清晰了解学生当前高考专业选择相关元素具体分值和说明，如下图：
						<div style="text-align:center;margin-top:15px;margin-bottom:15px"><img src="images/cp/detail_<?php echo $cat_info['cat_id']; ?>.jpg"></div>
						<ul>
							<li>针对学生的每一项高考专业选择元素给予正确有效的方法和指导学生能够正确深入了解到大学不同专业的区别和联系。</li>
							<li>让学生从高考专业开始认识职业，走好职业的第一步。</li>
							<li>一份专属于您孩子的高考专业选择调整指导报告（5000字，10页左右）。</li>
						</ul>
						</div>
					<?php endif; ?>
					
					<div class="detail_title" style="margin-top:20px">温馨提示：</div>
					<div class="detail_text3">
						<ul>
							<li>豪华版在高级版基础上增加全面、专业、个性化的学习成长指导方案，方案具体包括：各子测评概念解释、学员测评结果解释、具体针对性解决方法，该方案具有很强的操作性和使用性。</li>
							<li>豪华版包含你的教育专业咨询老师单独针对测评学员的一对一课程，两节共计90分钟，外地学员通过电话或者网络平台进行授课，北京学员来你的教育学习中心面对面授课。</li>
							<li>一对一课程内容分为两部分，一部分是专业教育咨询老师就学员个性化报告不明白不理解的地方做全面、系统地解释；另一部分是针对学员当前的学习成长和家庭期望，为学员制定一个长期、有效、科学的学习成长规划。</li>
							<li>豪华版学员平时可以通过你的教育咨询QQ优先免费咨询平时学习成长、学习规划执行过程中遇到的零散的、无法解决的问题。（该服务免费提供一年，从学员购买豪华版测评之日起计）。</li>
						</ul>
					</div>
					<div>
						<table width="605" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px; background-color:#EEEEEE">
						  <tr>
							<td height="24" align="right" valign="middle" style="padding-right:10px;">
								分享到:
								<a href="http://v.t.sina.com.cn/share/share.php?url=<?php echo urlencode(site_url('cp/detail/'.$cat_info['cat_id']))?>&amp;title=<?php echo urlencode($cat_info['cat_name'])?>" title="新浪微博" target="_blank"><img src="images/icon/sina_t.gif" alt="分享到新浪微博" style="padding-left:5px;"></a>
								<a href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php echo urlencode(site_url('cp/detail/'.$cat_info['cat_id']))?>" title="QQ空间" target="_blank"><img src="images/icon/qqzone.gif"alt="分享到QQ空间" style="padding-left:5px;"></a>
								<a href="http://www.kaixin001.com/~repaste/repaste.php?rurl=<?php echo urlencode(site_url('cp/detail/'.$cat_info['cat_id']))?>&rtitle=<?php echo urlencode($cat_info['cat_name'])?>" title="开心网" target="_blank"><img src="images/icon/kaixin.gif" alt="分享开心网" style="padding-left:5px;"></a>
								<a href="http://apps.hi.baidu.com/share/?url=<?php echo urlencode(site_url('cp/detail/'.$cat_info['cat_id']))?>&title=<?php echo urlencode($cat_info['cat_name'])?>" target="_blank" title="百度空间"><img src="images/icon/baidu_kongjian.gif" alt="分享到百度空间" style="padding-left:5px;"></a>
								<a href="http://www.douban.com/recommend/?url=<?php echo urlencode(site_url('cp/detail/'.$cat_info['cat_id']))?>&title=<?php echo urlencode($cat_info['cat_name'])?>" title="豆瓣" target="_blank"><img src="images/icon/douban.gif" alt="分享到豆瓣" style="padding-left:5px;"></a>
								<a href="#" onclick="copyUrl();return false;" title="复制网址"><img src="images/icon/copy_url.gif" alt="复制网址" style="padding-left:5px;"></a>
								<a href="mailto:?subject=在你的教育网站发现一篇文章很不错&body=<?php echo $cat_info['cat_name']." ".site_url('cp/detail/'.$cat_info['cat_id'])?>" title="发送邮件" target="_blank"><img src="images/icon/mailto.gif" alt="发送邮件" style="padding-left:5px;"></a>
							</td>
						  </tr>
						</table>
					</div>
				</div>
				<!-- 评价详情 -->
                <div id="con_one_2" style="display:none;">
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
								<td <?php echo (!empty($comment['reply'])) ? 'style="border:0"' : ''; ?>>
									<p style="text-align: left; max-width: 100%;"><?php echo nl2br($comment['comment']) ?></p>
									<span>[<?php echo $comment['add_time'] ?>]</span>
								</td>						
								<td <?php echo (!empty($comment['reply'])) ? 'style="border:0"' : ''; ?> align="left" valign="top"><p><?php echo $comment['name'] ?></p></td>
							</tr>
							
							<?php if(!empty($comment['reply'])): ?>
							<tr>
								<td colspan="2">
									<div class="comment_reply">
										<p style="text-align: left; max-width: 100%;"><span style="color:red">【你的教育 回复说】：</span> <?php echo nl2br($comment['reply']) ?></p>
										<span>[<?php echo $comment['reply_time'] ?>]</span>
									</div>
								</td>
							</tr>
							<?php endif; ?>
							
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
				
				<!-- 常见问题 -->
				<div id="con_one_3" class="cat_content_common" style="display:none;">
					<div class="detail_sub_title">1、购买测评卡流程是怎样的？</div>
					<div class="detail_text">进入测评展示页面-> 选择合适版本  ->点击立即购买 -> 填写订单信息  ->选择付款方式 ->购买成功  ->2～5个工作日内收到测评卡。</div>
					
					<div class="detail_sub_title">2、购买后必须等拿到测评卡才能测试吗？</div>
					<div class="detail_text">不用，测评卡片只是你的教育测评的一种产品形式，如果您不需要卡片，付款成功后，请直接联系你的教育客服老师（010-59790750）或者通过你的教育咨询QQ（378138800）直接取得对应测评帐号和密码马上开始您的测评之旅。</div>
					
					<div class="detail_sub_title">3、测评优惠卷针对所有测评系统吗？</div>
					<div class="detail_text">是的，选择付款方式之前，页面会提示您输入优惠卷密码，您直接输入就可以立即减去您优惠卷面额，但是要注意优惠卷的使用期限哦。</div>
					
					<div class="detail_sub_title">4、我已拿到测评卡帐号和密码，在那里开始测试？</div>
					<div class="detail_text">在测评展示页面直接点击进入测试即可。</div>
					
					<div class="detail_sub_title">5、参加小学生学习素养指导测试需要注意什么？</div>
					<div class="detail_text">请您注意测试之前所有提示语言，特别是整个测试大概需要30～40分钟，同时一张测评卡只能进行一次测试，但是您的测评报告会永久保留，方便您随时浏览。</div>
					
					<div class="detail_sub_title">6、测试过程中掉线死机怎么办？</div>
					<div class="detail_text">没有关系，但是您之前的测试结果无法保留，需要等您电脑恢复正常后再次从新测试。</div>
					
					<div class="detail_sub_title">7、做完测试可以马上查看报告吗？</div>
					<div class="detail_text">是的，马上就可以查看您的报告。</div>
					
					<div class="detail_sub_title">8、为什么我儿子学习很不努力但是报告却说我儿子学习积极呢？</div>
					<div class="detail_text">测试所有题目都必须按照测试人的真实情况填写，也许您儿子在您面前不愿意填写对他不利的数据，所以您需要和孩子充分沟通并注意平日教育孩子的方式。</div>
					
					<div class="detail_sub_title">9、完成测试后，就可以完全按照测试报告教育孩子并保证孩子学习优异素质全面发展吗？</div>
					<div class="detail_text">无法保证，孩子学习成长是一个很复杂的系统工程，没有任何一家教育机构或者学校可以做此保证，你的全方位测评是一个非常权威和科学的学习成长工具，主要辅助学生更加了解自己优劣，从而正确认识自己，更好的提升自己；家长更加了解孩子学习成长特点，从而更加合理教育指导孩子。</div>
					
					<div class="detail_sub_title">10、对报告有疑问怎么办？</div>
					<div class="detail_text">任何疑问均可以在工作时间（早上9：00～下午5：00，周六日除外）随时拨打你的教育客服电话（010-59790750）进行咨询。</div>
				</div>
				<!-- 如何使用 -->
				<div id="con_one_4" class="cat_content_common" style="display:none;">
					<div class="detail_title">如何使用：</div>
					<div class="detail_text2">1. 拿到卡片之后，请您首先核对卡片名称和版本与您购买订单名称和版本是否一致，如果不一致请您致电010-59790750找你的教育客服老师咨询，或者在线IM咨询，如下图所示：</div>
					<div style="text-align:center; margin-bottom:10px;margin-top:10px"><img src="images/cp/cp_card_<?php echo $cat_info['cat_id']; ?>.gif"/></div>
					<div class="detail_text2">2. 核对不误后，请您刮开测评卡背面封条处密码，密码共六位，由数字和大写字母组成。</div>
					<div class="detail_text2">3. 将帐号和密码输入到测评登录页面，注意阅读提示语言。</div>
					<div class="detail_text2">4. 进入后可以开始测评，测评后点击生成您的个性化报告。</div>
				</div>
            </div>
		</div>
	</div>
</div>
