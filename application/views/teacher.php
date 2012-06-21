<table width="920" border="0" align="center" cellpadding="0" cellspacing="0" class="banner_border" style="margin-top:10px;">
  <tr>
    <td align="left"><img src="images/teacher_header.gif" width="916" height="203" /></td>
  </tr>
</table>
<table width="920" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30" background="images/hjxxgh_10.jpg" class="mianbao">您所在位置： <a href="<?php echo site_url() ?>">首页 </a> &gt; <a href="<?php echo site_url('teacher') ?>">名师风采 </a> &gt; 师资团队</td>
  </tr>
</table>
<table width="920" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top">
	<table width="662" border="0" cellpadding="0" cellspacing="0" style="padding-bottom:6px;">
		<tr><td height="736" align="center" valign="top">

			<?php foreach($teachers as $key => $teacher): ?>
			<table border="0" align="center" cellpadding="0" cellspacing="0" class="box" style="margin-top:10px; <?php echo ($key % 2 == 1) ?  'background:#fffaf2' : '' ?>">
				<tr>
					<td align="center" style="border-right:1px dashed #ffc600; padding:3px;">
						<img src="images/teacher/<?php echo $teacher['img']?>.jpg" width="114" height="114" />
					</td>
					<td align="center" class="font_14" style="padding-right:15px; padding-left:15px;">
						<strong><?php echo $teacher['name']?></strong><br />
						<?php echo $teacher['text']?>
					</td>
				</tr>
			</table>
			<?php endforeach; ?>
			
		</td></tr>
    </table></td>
    <td width="247" valign="top"><table width="247" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="33"><img src="images/hjxxgh_07.jpg" width="247" height="72" /></td>
      </tr>
    </table>
      <table width="247" border="0" cellspacing="0" cellpadding="0" height="30" style="margin-top:10px; background-image:url(images/hjxxgh_18.jpg);">
        <tr>
          <td class="font_14white" style="padding-left:35px;">关于你的</td>
        </tr>
      </table>
      <table width="247" border="0" cellpadding="0" cellspacing="0" class="gray_box">
        <tr>
          <td height="200" align="center" valign="top"><table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
            <tr>
              <td align="left" background="images/ndys_11.jpg" class="font_14" style="background-position:left; background-repeat:no-repeat; padding-left:30px;"><a href="<?php echo site_url('aboutUs') ?>">你的简介</a></td>
            </tr>
          </table>
		    <table width="200" border="0" cellpadding="0" cellspacing="0" class="font_right_content" style="margin-left:20px;">
              <tr>
                <td align="left"><a href="<?php echo site_url('aboutUs') ?>">你的教育前身是北师大儿童心理学教授为中小学生学习规划科研项目，开始于2003年，当时国家正大力提倡素质教育， 2005年，又一批关心中国基础教育的教授、归国学者...</a></td>
              </tr>
            </table>
		    <table width="245" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td background="images/line_36.jpg" style="background-repeat:no-repeat; background-position:center" height="9"></td>
            </tr>
          </table>
		    <table width="220" border="0" cellspacing="0" cellpadding="0" >
              <tr>
                <td align="left" background="images/ndjj_07.jpg" class="font_14" style="background-position:left; background-repeat:no-repeat; padding-left:30px;"><a href="<?php echo site_url('advantage') ?>">你的优势</a></td>
              </tr>
            </table>
		    <table width="200" border="0" cellpadding="0" cellspacing="0" class="font_right_content" style="margin-left:20px;">
            <tr>
              <td align="left"><a href="<?php echo site_url('advantage') ?>">1.黄金学习规划<br />
                2.多元化学科辅导<br />
                3.科学合理的课程设置<br />
                4.优中选优的师资团队<br />
                5.辅导模式<br />
                6.学习环境</a></td>
            </tr>
          </table>
		  <table width="245" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td background="images/line_36.jpg" style="background-repeat:no-repeat; background-position:center" height="9"></td>
            </tr>
          </table>
		  <table width="220" border="0" cellspacing="0" cellpadding="0" >
            <tr>
              <td height="21" background="images/ndjj_11.jpg" class="font_14" style="background-position:left; background-repeat:no-repeat; padding-left:30px;"><a href="<?php echo site_url('team') ?>">师资来源</a></td>
            </tr>
          </table>
		  <table width="200" border="0" cellpadding="0" cellspacing="0" class="font_right_content" style="margin-left:20px;">
            <tr>
              <td align="left"><a href="<?php echo site_url('team') ?>">毕业于以北师大、华东师范大学为首的高等师范院校，近300名一线特高级教师，以本科、硕士学历为主，也有部分博士教授作为师资顾问...</a></td>
            </tr>
          </table></td>
        </tr>
      </table>
      <table width="247" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="images/hjxxgh_42.jpg" width="247" height="10" /></td>
        </tr>
      </table>
	   <table width="247" border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;">
        <tr>
          <td height="32" background="images/right_79.jpg"></td>
        </tr>
      </table>
      <table width="247" border="0" cellspacing="0" cellpadding="0">
	  <form name="guestbook_right" action="<?php echo site_url().'/guestbook/submit/'?>" method="post" onSubmit="return checkTable_contactus_right(this);">
        <tr>
          <td height="384" align="center" valign="top" background="images/right_80.jpg"><table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
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
                  <textarea name="message" style="width:148px; height:115px; background-color:#FFFFFF; border:1px solid #CCCCCC; overflow:auto"></textarea>
                </label></td>
              </tr>
            </table>
            <table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
              <tr>
                <td width="70" align="left">验证码：</td>
                <td width="70" align="left"><label>
                  <input type="text" name="captcha" style="width:60px; height:18px; background-color:#FFFFFF; border:1px solid #CCCCCC"/>
                </label></td>
                <td width="80" align="left"><img src="<?php echo site_url().'/ajax/captcha/'?>" id="safecode_right" border="0" onclick="reloadcode_right()" style="cursor:hand;padding:2px 8px 0pt 3px;"  /></td>
                
              </tr>
            </table>
            <table id="warningTable_right" width="220" border="0" cellspacing="0" cellpadding="0" style="display:none">
              <tr>
                <td height="24" align="center" class="font_12_red"><div id="warningText_right"></div></td>
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
            </table></td>
        </tr>
	  </form>	
      </table>
      <table width="247" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="images/hjxxgh_42.jpg" width="247" height="10" /></td>
        </tr>
    </table>
	
	<table width="247" border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;">
		<tr>
		  <td align="center" valign="bottom"><a href="<?php echo site_url('topGrowth') ?>" target="_blank"><img src="images/jyczjh.gif" width="247" height="70" border="0" /></a></td>
		</tr>
	</table>

	 <table width="247" border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;">
        <tr>
          <td align="center" valign="bottom"><a href="<?php echo site_url('cp/detail/1') ?>" target="_blank"><img src="images/banner_evaluate.gif" width="247" height="72" border="0" /></a></td>
        </tr>
      </table>
	
    <table width="247" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="90" align="center" valign="bottom"><a href="<?php echo site_url('contactUs') ?>"><img src="images/index_94.jpg" width="237" height="93" border="0" /></a></td>
        </tr>
    </table>
	<table width="247" border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;">
		<tr>
			<td align="center" valign="bottom"><a href="<?php echo site_url('entry/oo1') ?>" target="_blank"><img src="images/9d.gif" width="247" height="70" border="0" /></a></td>
		</tr>
	</table>
	  </td>
  </tr>
</table>