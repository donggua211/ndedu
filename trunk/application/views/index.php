<table width="920" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:10px;">
  <tr>
    <td align="left"><table width="658" border="0" cellpadding="0" cellspacing="0" class="hotpic">
      <tr>
        <td height="201">
		<SCRIPT  src="js/swfobject_source.js" type=text/javascript></SCRIPT>
<DIV id=flashFCI><A href="#" arget=_blank><IMG alt="images/01.jpg" border=0 alt="<?php echo SITE_NAME; ?>" /></A></DIV>
<SCRIPT type=text/javascript>
   var s1 = new SWFObject("<?php echo base_url() ?>images/flash/focusFlash_fp.swf", "mymovie1", "658", "201", "5", "#ffffff");
   s1.addParam("wmode", "transparent");
   s1.addParam("AllowscriptAccess", "sameDomain");
   s1.addVariable("bigSrc", "images/07.jpg|images/06.jpg|images/02.jpg|images/03.jpg|images/04.jpg|images/05.jpg");
   s1.addVariable("smallSrc", "|||||");
   s1.addVariable("href", "<?php echo site_url('cp/detail/1') ?>|<?php echo site_url('topGrowth') ?>|<?php echo site_url('goldenLearningPlan') ?>|<?php echo site_url('1v1interview') ?>|<?php echo site_url('personalFiles') ?>|<?php echo site_url('multiSubjectTutorial') ?>");
   s1.addVariable("txt", "||||");
   s1.addVariable("width", "658");
   s1.addVariable("height", "201");
   s1.write("flashFCI");
 </SCRIPT></td>
      </tr>
    </table></td>
    <td width="247" height="207" valign="top"><table width="247" border="0" cellpadding="0" cellspacing="0" class="news_title">
      <tr>
        <td align="right" class="more"><a href="<?php echo site_url('news') ?>">更多&gt;&gt;</a></td>
      </tr>
    </table>
	<table width="247" border="0" cellpadding="0" cellspacing="0" class="news_content">
          <tr>
            <td align="center" valign="top">
		<?php
		$i = 1;
		foreach($news as $new):
			$file_id_follorup = isset($news_file_id[$i])? '/'.$news_file_id[$i]: ''
		?>
			<table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:<?php if($i==1) echo '6'; else echo '3'; ?>px;">
              <tr>
                <td width="153" align="left" class="news_content_li"><a href="<?php echo site_url('article/'.$new['article_id'].$file_id_follorup) ?>" title="<?php echo $new['title'] ?>"><?php echo utf_substr($new['title'], 21)?></a></td>
                <td width="67" align="right" class="date"><?php echo $new['add_time']?></td>
              </tr>
            </table>
		<?php
			if($i == $news_num) break;
			$i++;
		endforeach;
		?>
            </td>
          </tr>
      </table>
	</td>
  </tr>
</table>
<table width="920" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:10px;">
  <tr>
    <td align="left" valign="top"><table width="662" border="0" cellpadding="0" cellspacing="0" bgcolor="#FDFCEA" class="box">
      <tr>
        <td height="208" align="center" valign="top"><table width="662" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="36" align="left" style="padding-left:5px;"><a href="<?php echo site_url('goldenLearningPlan') ?>"><img src="images/index7_43.jpg" width="234" height="27" border="0" alt="<?php echo SITE_NAME; ?>"/></a></td>
              </tr>
          </table>
            <table width="600" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="166" height="156"><a href="<?php echo site_url('goldenLearningPlan') ?>"><img src="images/index_40.jpg" width="136" height="136" class="img_border" alt="<?php echo SITE_NAME; ?>" /></a></td>
                <td class="font_14"><a href="<?php echo site_url('goldenLearningPlan') ?>">孩子的教育是不可逆的，特别是处于中小学黄金时期，错过教育的关键期，孩子将会遗憾终生，良好的教育是实现孩子完美人生的必要手段。<br />
                  孩子如何选择和度过小学、初中、高中？<br />
                  如何安排孩子的课外学习内容和时间？<br />
                  ……<br />
                  如果没有一以贯之的教育规划，盲目培养，会给孩子的成长历程造成混乱，对孩子的学习、成长、成才十分不利。</a></td>
              </tr>
          </table></td>
      </tr>
    </table>
      <table width="662" border="0" cellpadding="0" cellspacing="0" style="margin-top:9px;">
        <tr>
          <td align="center" valign="top"><div id="Tab1">
              <div class="Menubox">
                <ul>
                  <li id="one1" onmouseover="setTab('one',1,5)"  class="hover"><a href="<?php echo site_url('planEffect') ?>">规划效果</a></li>
                  <li id="one2" onmouseover="setTab('one',2,5)" ><a href="<?php echo site_url('improveScore') ?>">成绩提升</a></li>
                  <li id="one3" onmouseover="setTab('one',3,5)"><a href="<?php echo site_url('graduateRate') ?>">升学比率</a></li>
                  <li id="one4" onmouseover="setTab('one',4,5)"><a href="<?php echo site_url('learningAbility') ?>">学习能力</a></li>
                  <li id="one5" onmouseover="setTab('one',5,5)"><a href="<?php echo site_url('growingAbility') ?>">成长力</a></li>
                </ul>
              </div>
            <div class="Contentbox">
                <div id="con_one_1" class="hover" style="text-align:center"><a href="<?php echo site_url('planEffect') ?>"><img src="images/guihua1.gif" border="0" alt="<?php echo SITE_NAME; ?>"/></a></div>
              <div id="con_one_2" style="display:none; text-align:center"><a href="<?php echo site_url('improveScore') ?>"><img src="images/guihua2.gif" border="0" alt="<?php echo SITE_NAME; ?>"/></a></div>
              <div id="con_one_3" style="display:none; text-align:center"><a href="<?php echo site_url('graduateRate') ?>"><img src="images/guihua3.gif" border="0" alt="<?php echo SITE_NAME; ?>"/>v</div>
              <div id="con_one_4" style="display:none; text-align:center"><a href="<?php echo site_url('learningAbility') ?>"><img src="images/xxnl2.jpg" border="0" alt="<?php echo SITE_NAME; ?>"/></a></div>
              <div id="con_one_5" style="display:none; text-align:center"><a href="<?php echo site_url('growingAbility') ?>"><img src="images/czl.jpg" border="0" alt="<?php echo SITE_NAME; ?>"/></a></div>
            </div>
          </div></td>
        </tr>
      </table>
	  
	  <table width="662" border="0" cellpadding="0" cellspacing="0" style="margin-top:9px;">
        <tr>
          <td align="center" valign="top">
			  <div id="Tab1">
				  <div class="Menubox">
					<ul>
					  <li id="school1" onmouseover="setTab('school',1,4)"  class="hover"><a href="<?php echo site_url('school') ?>">教育文章</a></li>
					  <li id="school2" onmouseover="setTab('school',2,4)" ><a href="<?php echo site_url('school/book') ?>">精品图书</a></li>
					  <li id="school3" onmouseover="setTab('school',3,4)"><a href="<?php echo site_url('school/vedio') ?>">教育影视</a></li>
					  <li id="school4" onmouseover="setTab('school',4,4)"><a href="<?php echo site_url('school/software') ?>">教育软件</a></li>
					</ul>
				  </div>
				<div class="Contentbox">
					<div id="con_school_1" class="hover" style="text-align:left">
					<table width="660" border="0" cellspacing="0" cellpadding="0">
					<tr><td width="330" align="left" style="padding-left:10px;border-right:1px dashed #C8C8C8">
					<?php foreach($school_articles as $index => $article): ?>
					<table width="300" border="0" cellspacing="0" cellpadding="0" style="margin-top:3px">
					  <tr><td align="left" class="news_content_li"><a href="<?php echo site_url('article/'.$article['article_id']) ?>" title="<?php echo $article['title']?>"><?php echo utf_substr($article['title'], 48); ?></a></td></tr>
					</table>
					
					<?php if(($index+1) == ceil($school_articles_num/2)): //分屏 ?>
					</td><td width="330" align="left" style="padding-left:10px;">
					<?php endif;?>
					
					<?php endforeach;?>
					</td></tr>
					</table>
					</div>
					<div id="con_school_2" style="display:none; text-align:center">
					<table width="660" border="0" cellspacing="0" cellpadding="0">
						<tr>
						<?php foreach($school_book as  $book): ?>
						<td width="163" height="32" valign="top" align="center" class="font_12_18" style="text-align:center;padding-top:5px">
							<a href="<?php echo site_url('transfer/dangdang/'.$book['pid'])?>" target="_blank"><img src="<?php echo $book['image_url'] ?>" title="<?php echo $book['product_name'] ?>" /></a><br/>
							<a href="<?php echo site_url('transfer/dangdang/'.$book['pid']) ?>" target="_blank" title="<?php echo $book['product_name'] ?>" ><?php echo utf_substr($book['product_name'], 48) ?></a><br/>
						</td>
						<?php endforeach;?>
						</tr>
					</table>
					</div>
					<div id="con_school_3" style="display:none; text-align:center">
					<table width="660" border="0" cellspacing="0" cellpadding="0">
						<tr>
						<?php foreach($school_vedio as  $book): ?>
						<td width="163" height="32" valign="top" align="center" class="font_12_18" style="text-align:center;padding-top:5px">
							<a href="<?php echo site_url('transfer/dangdang/'.$book['pid'])?>" target="_blank"><img src="<?php echo $book['image_url'] ?>" title="<?php echo $book['product_name'] ?>" /></a><br/>
							<a href="<?php echo site_url('transfer/dangdang/'.$book['pid']) ?>" target="_blank" title="<?php echo $book['product_name'] ?>" ><?php echo utf_substr($book['product_name'], 48) ?></a><br/>
						</td>
						<?php endforeach;?>
						</tr>
					</table>
					</div>
					<div id="con_school_4" style="display:none; text-align:center">
					<table width="660" border="0" cellspacing="0" cellpadding="0">
						<tr>
						<?php foreach($school_software as  $book): ?>
						<td width="163" height="32" valign="top" align="center" class="font_12_18" style="text-align:center;padding-top:5px">
							<a href="<?php echo site_url('transfer/dangdang/'.$book['pid'])?>" target="_blank"><img src="<?php echo $book['image_url'] ?>" title="<?php echo $book['product_name'] ?>" /></a><br/>
							<a href="<?php echo site_url('transfer/dangdang/'.$book['pid']) ?>" target="_blank" title="<?php echo $book['product_name'] ?>" ><?php echo utf_substr($book['product_name'], 48) ?></a><br/>
						</td>
						<?php endforeach;?>
						</tr>
					</table>
					</div>
			  </div>
		  </td>
        </tr>
      </table>
	  
      <table width="662" border="0" cellpadding="0" cellspacing="0" style="margin-top:9px;">
        <tr>
          <td align="center" valign="top">
		  <div id="Tab2">
              <div class="Menubox">
                <ul>
                  <li id="two1" onmouseover="setTab('two',1,5)"  class="hover"><a href="<?php echo site_url('synBasis') ?>">同步基础</a></li>
                  <li id="two2" onmouseover="setTab('two',2,5)" ><a href="<?php echo site_url('advancedImprove') ?>">拔高冲刺</a></li>
                  <li id="two3" onmouseover="setTab('two',3,5)"><a href="<?php echo site_url('goldenConnect') ?>">黄金衔接</a></li>
                  <li id="two4" onmouseover="setTab('two',4,5)"><a href="<?php echo site_url('specialModule') ?>">专题模块</a></li>
                  <li id="two5" onmouseover="setTab('two',5,5)"><a href="<?php echo site_url('valueGrowth') ?>">成长增值</a></li>
                </ul>
              </div>
            <div class="Contentbox">
                <div id="con_two_1" class="hover" style="text-align:center"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:6px;">
  <tr>
    <td width="231" align="left"><a href="<?php echo site_url('synBasis') ?>"><img src="images/index_57.jpg" class="img_border" alt="<?php echo SITE_NAME; ?>"/></a></td>
    <td class="font_12_20" valign="top"><span class="red_title">同步基础</span><br />
       <a href="<?php echo site_url('synBasis') ?>">同步基础
结合学生学习特点，以方法点拨为主线，团体研究性学习为实践平台，以思维锻炼为重点，以能力培养为核心，将基础知识、考试内容、学习能力和成长力提高融为一体。<br />
课程目标：加强学习基础、改进学习方法、形成学习习惯、提升学习能力和成长力；</a><br />
</td>
  </tr>
</table>
</div>
              <div id="con_two_2" style="display:none; text-align:center"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:6px;">
  <tr>
    <td width="231" align="left"><a href="<?php echo site_url('advancedImprove') ?>"><img src="images/chongci.jpg" class="img_border" alt="<?php echo SITE_NAME; ?>"/></a></td>
    <td class="font_12_20" valign="top"><span class="red_title">拔高冲刺</span><br />
      <a href="<?php echo site_url('advancedImprove') ?>">以升学考试为目标，弱势学科变强，强势学科更强为宗旨，提供从学员学科知识、考试技巧、应试心理、考试大纲、目标学校等多角度，全方位、团队化辅导，帮助学员确定目标学校并顺利升学。<br />
课程目标：将弱势学科变强，强势学科更强，全心冲刺中高考</a></td>
  </tr>
</table></div>
              <div id="con_two_3" style="display:none; text-align:center"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:6px;">
  <tr>
    <td width="231" align="left"><a href="<?php echo site_url('goldenConnect') ?>"><img src="images/huangjin.jpg" class="img_border" alt="<?php echo SITE_NAME; ?>" /></a></td>
    <td class="font_12_20" valign="top"><span class="red_title">黄金衔接</span><br />
      <a href="<?php echo site_url('goldenConnect') ?>">面对不同学阶不同学习任务、形式、内容、要求，通过提前预设新学阶学习环境、学习内容、学习习惯、学习方法等课程内容，帮助处于黄金衔接期学员顺利平稳地过渡到新学阶，为孩子未来学习打下坚实的基础。<br />
课程目标：幼小衔接、小初衔接、初高衔接，帮助处于黄金衔接期学员顺利平稳地过渡</a></td>
  </tr>
</table></div>
              <div id="con_two_4" style="display:none; text-align:center"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:6px;">
  <tr>
    <td width="231" align="left"><a href="<?php echo site_url('specialModule') ?>"><img src="images/zhuanti.jpg" class="img_border" alt="<?php echo SITE_NAME; ?>" /></a></td>
    <td class="font_12_20" valign="top"><span class="red_title">专题模块</span><br />
      <a href="<?php echo site_url('specialModule') ?>">每一个学科都有重点、难点知识模块，而每一个重、难点又都贯穿该学科始终，如数学的函数模块、语文的作文、物理的力学、外语的单词记忆法，这些模块知识的掌握对该学科知识的掌握至关重要，你的专题模块课程就是帮助理清、掌握学科重难点知识模块结构，灵活应用知识点，建立学科思维框架，轻松通过考试。<br />
课程目标：帮助理清、掌握学科重难点知识模块结构，灵活应用知识点，牢固掌握知识结构，轻松通过考试。</a></td>
  </tr>
</table></div>
              <div id="con_two_5" style="display:none; text-align:center"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:6px;">
  <tr>
    <td width="231" align="left"><a href="<?php echo site_url('valueGrowth') ?>"><img src="images/chengzhang.jpg" class="img_border" alt="<?php echo SITE_NAME; ?>" /></a></td>
    <td class="font_12_20" valign="top"><span class="red_title">成长增值</span><br />
      <a href="<?php echo site_url('valueGrowth') ?>">以培养儿童成功核心素质为导向。你的教育认为，儿童成功核心素质与学业成功是相辅相成的，有了良好的注意力、观察力、想象力、思维力、学习能力，自我管理能力、交往能力，学习成绩的优异是必然的产物。<br />
课程目标：精准、科学、系统的核心能力与习惯培养体系，为孩子学业成功奠定坚实的基础。</a></td>
  </tr>
</table></div>
            </div>
          </div></td>
        </tr>
      </table>
      <table width="664" border="0" cellpadding="0" cellspacing="0" style="margin-top:9px;">
        <tr>
          <td width="664" valign="top">
		  <div id="Tab3">
              <div class="Menubox_2">
                <ul>
				 <li id="thr1" onmouseover="setTab('thr',1,3)"  class="hover"><a href="<?php echo site_url('internationalTrusteeship') ?>">学后国际化托管</a></li>
				 <li id="thr2" onmouseover="setTab('thr',2,3)" ><a href="<?php echo site_url('studyGroup') ?>">团体研究性学习</a></li>
				 <li id="thr3" onmouseover="setTab('thr',3,3)" ><a href="<?php echo site_url('nv1Tutorial') ?>">多对一学科辅导</a></li>
</ul>
</div>
<div class="Contentbox_2">
                <div id="con_thr_1" class="hover" style="text-align:center">
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:6px;">
  <tr>
    <td width="231" align="left"><a href="<?php echo site_url('internationalTrusteeship') ?>"><img src="images/index_74.jpg" width="209" height="150" border="0" class="img_border"  alt="<?php echo SITE_NAME; ?>"/></a></td>
    <td class="font_12_20" valign="top"><span class="red_title">学后国际化托管</span><br />
      <a href="<?php echo site_url('internationalTrusteeship') ?>">学后国际化托管是你的多元化N对一学科辅导基础组成部分，以家庭作业辅导为载体，以私人成长顾问形式为主导，培养学员基本的学习能力、个性发展、行为品格、人际交往，提升学员综合素质。</a><br />

</td>
  </tr>
</table></div>
<div id="con_thr_2" style="display:none; text-align:center"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:6px;">
  <tr>
    <td width="231" align="left"><a href="<?php echo site_url('studyGroup') ?>"><img src="images/tuanti.jpg" class="img_border" alt="<?php echo SITE_NAME; ?>" /></a></td>
    <td class="font_12_20" valign="top"><span class="red_title">团体研究性学习</span><br />
      <a href="<?php echo site_url('studyGroup') ?>">团队互动式学习是你的多元化N对一学科辅导重要组成部分之一，通过知识分享、营地活动等形式，以让学员正确认识读书学习、成功体验所学知识、有效应用所学知识为主要目标。</a><br />

</td>
  </tr>
</table></div>
<div id="con_thr_3" style="display:none; text-align:center"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:6px;">
  <tr>
    <td width="231" align="left"><a href="<?php echo site_url('nv1Tutorial') ?>"><img src="images/1d1.jpg" class="img_border" alt="<?php echo SITE_NAME; ?>" /></a></td>
    <td class="font_12_20" valign="top"><span class="red_title">多对一学科辅导</span><br />
      <a href="<?php echo site_url('nv1Tutorial') ?>">多对一纯学科辅导是你的多元化学科辅导主要组成部分，学生为主体，学科知识学习为主要内容，彻底颠覆填鸭式教学，师生双向互动，针对性辅导,每个学生都能体验到学习的高峰，以提高学习成绩、轻松应对考试、成功完成学业为主要目标。</a><br />
</td>
  </tr>
</table></div>
</div></div></td>
        </tr>
      </table>
      <table width="662" border="0" cellpadding="0" cellspacing="0" style="margin-top:9px;">
        <tr>
          <td valign="top"><table width="662" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="28" valign="bottom" background="images/slide_bg.gif">
			    <table width="662" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="31" height="28">&nbsp;</td>
                  <td width="631" height="26" align="left" class="font_14"><a href="<?php echo site_url('tutorialFlow') ?>">辅导流程</a></td>
                </tr>
              </table></td>
            </tr>
          </table>
            <table width="662" border="0" cellspacing="0" cellpadding="0" style="padding-top:8px; padding-bottom:8px; border-bottom:1px solid #ffc600;
			border-left:1px solid #ffc600; border-right:1px solid #ffc600;">
              <tr>
                <td height="169" align="center" valign="top" background="images/index_23.jpg" style="background-position:center; background-repeat:no-repeat">
				  <table width="611" border="0" cellpadding="0" cellspacing="0" class="font_12_20" style="margin-top:66px; font-weight:bold">
                  <tr>
                    <td width="94" valign="top">电话或者在线留言预约对应学阶私人成长顾问</td>
                    <td width="37">&nbsp;</td>
                    <td width="89" valign="top">专业咨询老师
                      一对一咨询</td>
                    <td width="43">&nbsp;</td>
                    <td width="88" valign="top">综合形成个性
                      化成长档案</td>
                    <td width="38">&nbsp;</td>
                    <td width="92" valign="top">专家团队依据档案综合分析、研究最后得出最优辅导方案</td>
                    <td width="44">&nbsp;</td>
                    <td width="86" valign="top">班主任老师定
                      期维护成长档
                      案并向家长反
                      馈</td>
                  </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>
      </table>
      <table width="662" border="0" cellpadding="0" cellspacing="0" style="margin-top:9px;">
        <tr>
          <td height="200" align="center" valign="top"><table width="662" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="28" valign="bottom" background="images/slide_bg.gif"><table width="662" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="31">&nbsp;</td>
                      <td width="631" height="26" align="left" class="font_14"><a href="<?php echo site_url('successfulMembers') ?>">成功学员</a></td>
                    </tr>
                </table></td>
              </tr>
            </table>
              <table width="662" border="0" cellspacing="0" cellpadding="0" style="padding-top:8px; padding-bottom:8px; border-bottom:1px solid #ffc600;
			border-left:1px solid #ffc600; border-right:1px solid #ffc600;">
                <tr>
                  <td align="center"><table width="636" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="left"><table width="211" border="0" cellpadding="0" cellspacing="0" bgcolor="#f5f5f5" class="font_12_20">
                            <tr>
                              <td width="85" height="86" align="center"><a href="<?php echo site_url('successfulMembers') ?>"><img src="images/ll.jpg" width="65" height="65" border="0" class="img_border" alt="<?php echo SITE_NAME; ?>" /></a></td>
                              <td><span class="red_title">李蕾</span><br />
                                小一 <br />
                                你的教育3A级学员</td>
                            </tr>
                        </table></td>
                      <td align="left"><table width="211" border="0" cellpadding="0" cellspacing="0" bgcolor="#f5f5f5" class="font_12_20">
                          <tr>
                            <td width="85" height="86" align="center"><a href="<?php echo site_url('successfulMembers') ?>"><img src="images/lzh.jpg" width="65" height="65" border="0" class="img_border" alt="<?php echo SITE_NAME; ?>" /></a></td>
                            <td><span class="red_title">吕志浩</span><br />
                              小四 <br />
                              你的教育2A级学员</td>
                          </tr>
                      </table></td>
                      <td align="left"><table width="211" border="0" cellpadding="0" cellspacing="0" bgcolor="#f5f5f5" class="font_12_20">
                          <tr>
                            <td width="85" height="86" align="center"><a href="<?php echo site_url('successfulMembers') ?>"><img src="images/hxd.jpg" width="65" height="65" border="0" class="img_border" alt="<?php echo SITE_NAME; ?>" /></a></td>
                            <td><span class="red_title">胡晓丹</span><br />
                              小六 <br />
                              你的教育A级学员</td>
                          </tr>
                      </table></td>
                    </tr>
                  </table>
                    <table width="636" border="0" cellspacing="0" cellpadding="0" style="margin-top:1px;">
                      <tr>
                        <td align="left"><table width="211" border="0" cellpadding="0" cellspacing="0" bgcolor="#f5f5f5" class="font_12_20">
                          <tr>
                            <td width="85" height="86" align="center"><a href="<?php echo site_url('successfulMembers') ?>"><img src="images/jjw.jpg" width="65" height="65" border="0" class="img_border" alt="<?php echo SITE_NAME; ?>" /></a></td>
                            <td><span class="red_title">贾静雯</span><br />
                              初二 <br />
                              你的教育A级学员</td>
                          </tr>
                      </table></td>
                        <td align="left"><table width="211" border="0" cellpadding="0" cellspacing="0" bgcolor="#f5f5f5" class="font_12_20">
                            <tr>
                              <td width="85" height="86" align="center"><a href="<?php echo site_url('successfulMembers') ?>"><img src="images/index_79.jpg" width="65" height="66" border="0" class="img_border" alt="<?php echo SITE_NAME; ?>" /></a></td>
                              <td><span class="red_title">聂媛媛</span><br />
                                初三 <br />
                                你的教育A级学员</td>
                            </tr>
                        </table></td>
                        <td align="left"><table width="211" border="0" cellpadding="0" cellspacing="0" bgcolor="#f5f5f5" class="font_12_20">
                            <tr>
                              <td width="85" height="86" align="center"><a href="<?php echo site_url('successfulMembers') ?>"><img src="images/zk.jpg" width="65" height="65" border="0" class="img_border" alt="<?php echo SITE_NAME; ?>" /></a></td>
                              <td><span class="red_title">张坤</span><br />
                                高三 <br />
                                你的教育A级学员</td>
                            </tr>
                        </table></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
          </td>
        </tr>
      </table>
      <table width="662" border="0" cellpadding="0" cellspacing="0" style="margin-top:9px;">
        <tr>
          <td align="center" valign="top"><table width="662" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="28" valign="bottom" background="images/slide_bg.gif"><table width="662" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="12">&nbsp;</td>
                      <td height="26" align="left" class="font_14"><a href="<?php echo site_url('gallery') ?>">优越的学习环境</a></td>
                    </tr>
                </table></td>
              </tr>
            </table>
              <table width="662" border="0" cellspacing="0" cellpadding="0" style="padding-top:8px; padding-bottom:8px; border-bottom:1px solid #ffc600;
			border-left:1px solid #ffc600; border-right:1px solid #ffc600;">
                <tr>
                  <td align="center"><table width="660" border="0" cellspacing="0" cellpadding="0" style="margin:8px auto">
                    <tr>
                      <td align="center"><a href="<?php echo site_url('gallery') ?>"><img src="images/ndpic_hj_1.jpg" width="128" height="95" border="0" class="img_border" alt="<?php echo SITE_NAME; ?>" /></a></td>
                      <td align="center"><a href="<?php echo site_url('gallery') ?>"><img src="images/ndpic_hj_2.jpg" width="128" height="95" border="0" class="img_border" alt="<?php echo SITE_NAME; ?>" /></a></td>
                      <td align="center"><a href="<?php echo site_url('gallery') ?>"><img src="images/ndpic_hj_3.jpg" width="129" height="95" border="0" class="img_border" alt="<?php echo SITE_NAME; ?>" /></a></td>
                      <td align="center"><a href="<?php echo site_url('gallery') ?>"><img src="images/ndpic_hj_4.jpg" width="128" height="95" border="0" class="img_border" alt="<?php echo SITE_NAME; ?>" /></a></td>
                    </tr>
                  </table>
                    <table width="660" border="0" cellpadding="0" cellspacing="0" class="font_14">
                      <tr>
                        <td width="165" align="center"><a href="<?php echo site_url('gallery') ?>">集体照</a></td>
                        <td width="165" align="center"><a href="<?php echo site_url('gallery') ?>">你的前台</a></td>
                        <td width="166" align="center"><a href="<?php echo site_url('gallery') ?>">师生合影</a></td>
                        <td align="center"><a href="<?php echo site_url('gallery') ?>">建造科学模型</a></td>
                      </tr>
                    </table></td>
                </tr>
          </table></td>
        </tr>
      </table>
    </td>
    <td width="247" valign="top">
	  <table width="247" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:9px;">
        <tr>
          <td align="center" valign="bottom"><a href="<?php echo site_url('topGrowth') ?>" target="_blank"><img src="images/jyczjh.gif" width="247" height="70" border="0" /></a></td>
        </tr>
      </table>
      <table width="247" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="31" background="images/index_47.jpg"><a href="<?php echo site_url('advantage') ?>" class="more2">更多&gt;&gt;</a></td>
        </tr>
      </table>
      <table width="247" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="165" background="images/index_51.jpg"><table width="220" border="0" align="center" cellpadding="0" cellspacing="0" class="font_12_20">
            <tr>
              <td style="line-height:24px;"><a href="<?php echo site_url('advantage') ?>">1.黄金学习规划</a><br />
                <a href="<?php echo site_url('advantage') ?>">2.多元化学科辅导</a><br />
                <a href="<?php echo site_url('advantage') ?>">3.科学合理的课程设置</a><br />
                <a href="<?php echo site_url('advantage') ?>">4.优中选优的师资团队</a><br />
                <a href="<?php echo site_url('advantage') ?>">5.辅导模式</a><br />
                <a href="<?php echo site_url('advantage') ?>">6.学习环境</a></td>
            </tr>
          </table></td>
        </tr>
      </table>
	  <table width="247" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
        <tr>
          <td><img src="images/hjxxgh_07.jpg" width="247" height="72" /></td>
        </tr>
      </table>
	  <table width="247" border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;">
        <tr>
          <td height="32" background="images/right_79.jpg"></td>
        </tr>
      </table>
      <table width="247" border="0" cellspacing="0" cellpadding="0">
	  <form name="guestbook" action="<?php echo site_url().'/guestbook/submit/'?>" method="post" onSubmit="return checkTable(this);">
        <tr>
          <td height="" align="center" valign="top" background="images/right_80.jpg"><table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
            <tr>
              <td width="70" align="left">姓&nbsp;&nbsp;&nbsp;&nbsp;名：</td>
              <td align="left"><label>
                <input type="text" name="username" style="width:106px; height:18px; background-color:#FFFFFF; border:1px solid #CCCCCC"/>
              </label><span id="username_alert" style="display:none"> * </span></td>
            </tr>
          </table>
            <table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
              <tr>
                <td width="70" align="left">电&nbsp;&nbsp;&nbsp;&nbsp;话：</td>
                <td align="left"><label>
                  <input type="text" name="phone" style="width:106px; height:18px; background-color:#FFFFFF; border:1px solid #CCCCCC"/>
                </label><span id="phone_alert" style="display:none"> * </span></td>
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
                  <span id="grade_alert" style="display:none"> * </span></td>
              </tr>
            </table>
            <table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
              <tr>
                <td width="70" valign="top">学习情况：</td>
                <td  align="left"><label>
                  <textarea name="message" style="width:148px; height:130px; background-color:#FFFFFF; border:1px solid #CCCCCC; overflow:auto"></textarea>
                </label></td>
              </tr>
            </table>
            <table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
              <tr>
                <td width="70" align="left">验证码：</td>
                <td width="70" align="left"><label>
                  <input type="text" name="captcha" style="width:60px; height:18px; background-color:#FFFFFF; border:1px solid #CCCCCC"/>
                </label></td>
                <td width="80" align="left"><img src="<?php echo site_url().'/ajax/captcha/'?>" id="safecode" border="0" onclick="reloadcode()" style="cursor:hand;padding:2px 8px 0pt 3px;"  /></td>
                
              </tr>
            </table>
            <table id="warningTable" width="220" border="0" cellspacing="0" cellpadding="0" style="display:none">
              <tr>
                <td height="24" align="center" class="font_12_red"><div id="warningText"></div></td>
              </tr>
            </table>
            <table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
              <tr>
                <td align="center"><label><input type="image" name="submit" align="bottom" src="images/right_19.jpg"></label></td>
              </tr>
            </table>
            <table width="231" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
              <tr>
                <td width="231" height="62" align="center" background="images/index2_35.jpg" class="font_12_red" style="padding-left:8px; padding-right:8px; padding-top:4px; font-size:12px; color:#333333; font-weight:bold">请放心，家长所留下的个人信息，你的将恪守职业道德，为您保密。</td>
              </tr>
            </table>
			<table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/right_80_bottom.gif"></td>
              </tr>
            </table></td>
        </tr>
	  </form>	
      </table>
	  <table width="247" border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;">
        <tr>
          <td align="center" valign="bottom"><a href="<?php echo site_url('userGrowth') ?>" target="_blank"><img src="images/evaluate/banner_userGrowth.gif" width="247" height="72" border="0" /></a></td>
        </tr>
      </table>  
      <table width="247" border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;">
        <tr>
          <td height="31" background="images/index_54.jpg"><a href="<?php echo site_url('aboutUs') ?>" class="more2">更多&gt;&gt;</a></td>
        </tr>
      </table>
      <table width="247" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="165" align="center" background="images/index_55.jpg"><table width="220" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="140" align="left" valign="top" class="font_12_20"><a href="<?php echo site_url('aboutUs') ?>"><img src="images/right_07.jpg" width="60" height="60" border="0" class="img_border"  style="float:left; margin-right:8px;" alt="<?php echo SITE_NAME; ?>"/>你的教育配合黄金学习规划系统，反思当前课外辅导机构辅导方式对学员成长的弊端，正式提出你的多元化学科辅导体系，该体系以黄金学习规划系统工具为基础，以学后国际化托管、团体研究性学习、纯学科一对一辅导...</a></td>
              </tr>
          </table></td>
        </tr>
      </table>
	  <table width="247" border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;">
        <tr>
          <td align="center" valign="bottom"><a href="<?php echo site_url('cp/detail/1') ?>" target="_blank"><img src="images/banner_evaluate.gif" width="247" height="72" border="0" /></a></td>
        </tr>
      </table>
	  <table width="247" border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;">
        <tr>
          <td height="31" background="images/teacher_11.jpg"><a href="<?php echo site_url('team') ?>" class="more2">更多&gt;&gt;</a></td>
        </tr>
      </table>
      <table width="247" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="165" align="center" background="images/index_55.jpg"><table width="220" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="140" valign="top" class="font_12_20"><a href="<?php echo site_url('team') ?>"><img src="images/teacher.jpg" width="60" height="60" border="0" class="img_border" style="float:left; margin-right:8px;" alt="<?php echo SITE_NAME; ?>"/></a><a href="<?php echo site_url('team') ?>">毕业于以北师大、华东师范<br />
                大学为首的高等师范院校，<br />
                近300名一线特高级教师，以本科、硕士学历为主，也<br />
                有部分博士教授作为师资顾问；以学科教<br />
                育专业为主，以儿童发展心理学为辅，其<br />
                中近多一半教师从事过中小学教育...</a></td>
              </tr>
          </table></td>
        </tr>
      </table>
      <table width="247" border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;">
        <tr>
          <td height="31" background="images/index_61.jpg"><a href="<?php echo site_url('gallery') ?>" class="more2">更多&gt;&gt;</a></td>
        </tr>
      </table>
      <table width="247" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="200" align="center" valign="top" background="images/index_66.jpg"><table width="220" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="65" height="48"><a href="<?php echo site_url('gallery') ?>"><img src="images/index7_11.jpg" width="49" height="33" border="0" class="img_border" /></a></td>
              <td align="left"><a href="<?php echo site_url('gallery') ?>" title="2010年家长集体授予最值得信赖的学科辅导机构">2010年家长集体授予最值...</a></td>
            </tr>
          </table>
            <table width="220" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="65" height="48"><a href="<?php echo site_url('gallery') ?>"><img src="images/index7_11.jpg" width="49" height="33" border="0" class="img_border" /></a></td>
                <td align="left"><a href="<?php echo site_url('gallery') ?>" title="2009年连续三年被评为最值得推荐的教育品牌">2009年连续三年被评为最...</a></td>
              </tr>
            </table>
            <table width="220" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="65" height="48"><a href="<?php echo site_url('gallery') ?>"><img src="images/index7_11.jpg" width="49" height="33" border="0" class="img_border" /></a></td>
                <td align="left"><a href="<?php echo site_url('gallery') ?>" title="2008年你的黄金学习规划系统获得国家级优秀教育产品奖">2008年你的黄金学习规划...</a></td>
              </tr>
            </table>
            <table width="220" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="65" height="48"><a href="<?php echo site_url('gallery') ?>"><img src="images/index7_11.jpg" width="49" height="33" border="0" class="img_border" /></a></td>
                <td align="left"><a href="<?php echo site_url('gallery') ?>" title="2007年被评为北京课外辅导机构最具有发展潜力奖">2007年被评为北京课外辅...</a></td>
              </tr>
            </table>
			<table width="220" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/index_66_bottom.gif"></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <table width="247" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="100" valign="bottom"><a href="<?php echo site_url('contactUs') ?>"><img src="images/index_94.jpg" width="237" height="93" border="0" alt="<?php echo SITE_NAME; ?>" /></a></td>
        </tr>
    </table>
	<table width="247" border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;">
        <tr>
          <td align="center" valign="bottom"><a href="<?php echo site_url('entry/oo1') ?>" target="_blank"><img src="images/9d.gif" width="247" height="70" border="0" /></a></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="920" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:10px">
  <tr>
    <td width="83"><img src="images/index_98.jpg" width="83" height="36" alt="<?php echo SITE_NAME; ?>" /></td>
    <td bgcolor="#f1f1f1" class="font_12_20" style="border-bottom:1px solid #d7d7d7; border-right:1px solid #d7d7d7; border-top:1px solid #d7d7d7; padding-left:10px;">
		<a href="http://fe.bnu.edu.cn/index.htm" target="_blank">北京师范大学教育学部</a> &nbsp;&nbsp;|&nbsp;&nbsp; 
		<a href="http://www.bjeea.cn" target="_blank">北京教育考试院</a> &nbsp;&nbsp;|&nbsp;&nbsp; 
		<a href="http://www.21cedu.org/index.html" target="_blank">21世纪教育研究院</a> &nbsp;&nbsp;|&nbsp;&nbsp; 
		<a href="http://www.appshare.cn" target="_blank">工程师爸爸</a>
	</td>
  </tr>
</table>