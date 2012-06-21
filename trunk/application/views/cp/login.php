<div class="ceping_shining_head">
	<div class="login_title"><?php echo $cat_list[$card['cat_id']]['cat_name'] ?></div>
	<div class="login_sub_title">精确诊断学习成长类型，科学生成有效学习成长指导报告</div>
</div>
<div id="ceping_main">
	<div class="login_content">
		<div class="login_content_img"><img src="images/cp/login_content_top.jpg"></div>
		<div class="login_content_text">
			<p>你的教育在将近六年的中小学学科学习咨询辅导的服务中，接触过上万个各种各样的家庭和孩子，有的家庭父母是高官、有的家庭父母是科研人员、有的家庭父母是成功商人、有的家庭父母是明星大腕、也有的家庭父母是一般公务员、也有的家庭父母是普通工人、更有的家庭父母是普通老百姓；孩子从两三岁的幼儿、七八岁的小学生到马上要参加高考的高中生。</p>
			<p>这么多的父母、这么多的孩子之所以请求咨询和辅导最大的原因就是，父母没有真正的了解自己的孩子、不能走进孩子的内心世界、根本不知道孩子需要什么；孩子不知道自己学业上真正的问题、不知道自己学习上薄弱的环节、不知道自己心理发展上相对的弱项、不知道自己真正喜欢的事情，学习上更多的是外在学校、家庭、升学给予的勤奋和动力，而缺少个体内在的热情、积极和努力。</p>
			<p>作为一家专业的中小学生学习成长服务机构，最最不愿意看到的就是正值金色童年的孩子们没有了天真和浪漫，正值十多岁的小学生们没有了对知识的内在的主动的渴望，正值青春期的初中生们对科普、对物理、对文学再也提不起兴趣，取而代之的却是游戏机，正值十七八岁风华正茂的高中生们不知道自己的兴趣、不知道如何正确选择自己的高考专业，还有含辛茹苦、望子成龙、望女成风的家长们到头来换来的却是事与愿违、适得其反。</p>
			<p>今天，你的教育全方位测评系统终于应运而生，该系统包括五个子系统，覆盖小学、初中、高中，特别是高考三个学阶：<br/>
			
			
			<?php
			foreach($cat_list as $cat)
			{
				echo (($cat['cat_id'] == $card['cat_id']) ? '<font style="color:red">' : '<a href="'.site_url('cp_login/'.$cat['cat_id'].'/'.$card['level']).'">').$cat['cat_name'].(($cat['cat_id'] == $card['cat_id']) ? '</font>' : '</a>').'<br/>';
			}
			
			?>
			</p>
			<p>专业、科学、精确的诊断帮助您发现孩子、了解孩子内心需求，从而合理正确的帮助孩子成长发展，全面、细致、系统的题目设置帮助你了解自己的不足和优势，从而取长补短，提高自己的成绩、成功完成自己的学业。</p>
		</div>
	
		<div class="login_block">
		<form action="<?php echo site_url("cp_login"); ?>" method="post" onSubmit="return login_submit(this);">
			<div class="login_block_head">用户登录</div>
			<div class="login_block_main">
				<!-- 报警区 -->
				<?php if(isset($notification) && !empty($notification)): ?>
				<div id="warning_login">
					<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;"><?php echo $notification;?></span>
				</div>
				<?php endif;?>
				<div class="login_input">
					<label>账号: </label>			
					<input size="19" type="text" name="card_id" value="<?php echo (isset($card['card_id'])) ? $card['card_id'] :''; ?>" style="width:128px" onBlur="check_card_id(this);">
					<span id="cat_id_info">（帐号共十位，由数字组成，请您正确输入）</span>
					<span id="cat_id_warning" style="display:none">（帐号共十位，由数字组成，请您正确输入）</span>
				</div>
				<div class="login_input">
					<label>密码: </label>			
					<input size="19" type="password" name="password" value="" style="width:128px" onBlur="check_password(this);">
					<span id="password_info">（密码共六位，由大写字母和数字组成，请您注意区分大小写）</span>
					<span id="password_warning" style="display:none">（密码共六位，由大写字母和数字组成，请您注意区分大小写）</span>
				</div>
				<div class="login_input">
					<label>验证码: </label>			
					<input type="text" size="9" name="captcha" class="input_border"  style="width:60px" onBlur="check_captcha(this);"/>
					<img src="<?php echo site_url().'/ajax/captcha/'?>" id="safecode" onclick="reloadcode()" class="img_middle"/>
					<span>看不清？<a href="javascript:return void(0);" onclick="reloadcode()" style="color:#3366CC">换一张</a></span>
					<span id="captcha_info">（验证码不区分大小写）</span>
					<span id="captcha_warning" style="display:none">（验证码不区分大小写）</span>
				</div>
				<div class="login_input">
					<label>选择版本</label>
					<select name="level" style="width:133px">
						<option value="<?php echo CP_LEVEL_ADVANCED ?>" <?php echo ($card['level'] == CP_LEVEL_ADVANCED) ? 'SELECTED' : '' ?>>高级版
						<option value="<?php echo CP_LEVEL_LUXURY ?>" <?php echo ($card['level'] == CP_LEVEL_LUXURY) ? 'SELECTED' : '' ?>>豪华版
					</select>
					<span id="level_info">（注意选择您测评卡的版本）</span>
				</div>
				
				<div class="order_submit_botton"><input type="image" name="submit" value="submit" src="images/cp/login_botton.jpg"></div>
				<input type="hidden" value="<?php echo $card['cat_id']; ?>" name="cat_id">
			</div>
		</form>
		</div>
		<div class="login_content_img" style="padding:20px 0 25px 0"><img src="images/cp/login_bottom.jpg"></div>
		<div class="login_content_img"><img src="images/cp/login_content_bottom.jpg"></div>
	</div>
</div>