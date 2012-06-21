<div class="wrapper">
	<div class="header">
		<h2><img src="images/icon/icon_arrow_orange.jpg" alt="<?php echo $page_title ?> 小箭头"/><?php echo $page_title ?></h2>
	</div>
	<div class="content">
		<div class="description">
			<strong><?php echo $content ?></strong>
		</div>
		<div class="telephone_image">
			<img src="images/growth_plan/telephone.jpg" alt="<?php echo $page_title ?> 电话010-59790750"/>
		</div>
	</div>
	<div class="main">
		<div class="left_side">
			<div class="float_left">
				<ul class="font_12">
				<?php
					foreach( $list as $key => $value )
						echo '<li><a href="' . site_url($controller . '/'. $key) . '">' . $value['page_title'].  '</a></li>';
				?>
				</ul>
			</div>
			<div class="right_image">
				<a href="<?php echo site_url('topGrowth') ?>" target="_blank"><img src="images/11_05.jpg" width="350" height="478" alt="精英成长计划 你的教育"/></a>
			</div>
			<div class="left_botton_image">
				<a href="<?php echo site_url('tutorPlan') ?>" target="_blank"><img src="images/growth_plan/multiSubjectTutorial.jpg" width="552" height="80" alt="<?php echo $page_title ?> 多元化学科辅导"/></a>
			</div>
		</div>
		<div class="right_side">
			<div class="gray_bg">
				<img src="images/tutor_plan/banner_marquee.jpg" width="279" height="39" alt="<?php echo $page_title ?> 家长留言"/>
				<div class="marquee font_12">
				<marquee scrollamount="2" height="200" direction="up"  onMouseOver='this.stop()' onMouseOut='this.start()'>
					你的教育的老师：您们好！<br/>我这次其中考试数学100分，语文100分，物理99分，较之前进步太大了，而且我现在特别喜欢学习，特别是物理，感觉越来越有兴趣，再不想以前那样枯燥无味了。<br/>
					其次我和父母关系也越来越好，我真没想到我父母能够做出改变，我们每天都很期待没月的访谈课程，更期待您们提供的学习指导方案。<br/>
					非常感谢你的教育让我的学习成绩越来越好、成长越来越快乐。<br/>
					<span class="font_gray">--初二年级 王同学</span><br /><br />现在还清楚地记得那句让我印象深刻的那些话。经过系统的测评和数次的访谈课程之后，咨询老师对我说："由于您爱人经常出差，所以您在情感上有些依赖孩子，无法在孩子面前建立起威信，以至于您的说教不但不起作用，反而让孩子越来越皮。建议您，说教不必多，但说了就一定要坚决执行，比如……"<br/>
					这几句话让我有些恍然大悟的感觉，从开始的不愿意接受到越想越觉得有道理再到写这封感谢信…….<br/>
					目前儿子成绩稳步提升，良好的生活和学习习惯也慢慢的建立起来，我也逐渐的感觉到儿子开始明事理、讲道理。<br/>
					希望这些话对其他的家长选择教育机构时有帮助，同时希望你的教育越办越好。<br/>
					<span class="font_gray">--小学5年级  李同学妈妈</span>
				</marquee>
				</div>
				<img src="images/growth_plan/border_botton.jpg" width="279" height="11" />
			</div>
			<div class="guestbook">
				<table width="275" border="0" cellspacing="0" cellpadding="0">
				<form name="guestbook" action="<?php echo site_url().'/guestbook/submit/'?>" method="post" onSubmit="return checkTable(this);">
					<tr>
						<td colspan="3" height="72" background="images/yxfd_30.jpg">&nbsp;</td>
					</tr>
					<tr>
						<td width="65" height="30" align="right" class="font_121" style="padding-right:5px;">姓名：</td>
						<td colspan="2" align="left"><input name="username" type="text" class="input" /></td>
					</tr>
					<tr>
						<td width="65" height="30" align="right" class="font_121" style="padding-right:5px;">电话：</td>
						<td colspan="2" align="left"><input name="phone" type="text" class="input" /></td>
					</tr>
					<tr>
						<td width="65" height="30" align="right" class="font_121" style="padding-right:5px;">年级：</td>
						<td colspan="2" align="left">
							<select name="grade">
								<option value="preschool">学前班</option>
								<option value="primary_school">小学</option>
								<option value="junior_middle_school">初中</option>
								<option value="high_school">高中</option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="65" height="70" align="right" valign="top" class="font_121" style="padding-right:5px; padding-top:5px;">学习情况：</td>
						<td colspan="2" align="left"><textarea name="message" class="input21"></textarea></textarea></td>
					</tr>
					<tr>
						<td width="65" height="30" align="right" class="font_121" style="padding-right:5px;">验证码：</td>
						<td width="73" align="left"><input name="captcha" type="text" class="input31" /></td>
						<td align="left"><img src="<?php echo site_url().'/ajax/captcha/'?>" id="safecode" border="0" onclick="reloadcode()" width="60" height="20" /></td>
					</tr>
					<tr>
						<td colspan="3" >
							<table id="warningTable" width="275" border="0" cellspacing="0" cellpadding="0" style="display:none">
								<tr>
									<td align="center" class="font_12_red"><div id="warningText"></div></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="3" height="90" align="center" class="font_121" style="padding-right:5px;"><label><input type="image" name="submit" align="bottom" src="images/yxfd_37.jpg"></label></td>
					</tr>
				</form>
                </table>
			</div>
			<img src="images/1_19.jpg" width="279" height="67" />
		</div>
	</div>
	<div class="clearfix"></div>
</div>