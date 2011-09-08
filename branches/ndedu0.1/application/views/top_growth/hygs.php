<div class="description">
	<div class="center"><img src="images/hygs_03.jpg" width="878" height="149" /></div>
</div>
<div class="main" style="padding-left:30px; padding-top:6px;">
	经过三年的积累，目前我们已经与北京市多所幼儿园、中小学校建立了长期良好的科研、实验、推广合作关系，近万名学生参加了尼德教育课程辅导，并享受了我们的会员服务。涉及数学、英语、语文等学科，小学和初中各年级。家长们对课程和服务都给出了中肯的评价，一下是一些家长和会员的评价：
</div>

<table width="920" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="images/hygs_07.jpg" width="583" height="408" /></td>
    <td valign="top"><table width="279" border="0" cellspacing="0" cellpadding="0" style="border:2px solid #e9f0a9;">
      <tr>
		<form name="guestbook" action="<?php echo site_url().'/guestbook/submit/'?>" method="post" onSubmit="return checkTable(this);">
        <td><table width="275" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="72" background="images/yxfd_30.jpg">&nbsp;</td>
            </tr>
          </table>
            <table width="275" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
              <tr>
                <td width="65" height="30" align="right" class="font_121" style="padding-right:5px;">姓名：</td>
                <td align="left"><input name="username" type="text" class="input" /></td>
              </tr>
            </table>
          <table width="275" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="65" height="30" align="right" class="font_121" style="padding-right:5px;">电话：</td>
                <td align="left"><input name="phone" type="text" class="input" /></td>
              </tr>
            </table>
          <table width="275" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="65" height="30" align="right" class="font_121" style="padding-right:5px;">年级：</td>
                <td align="left"><select name="grade">
					<option value="preschool">学前班</option>
					<option value="primary_school">小学</option>
					<option value="junior_middle_school">初中</option>
					<option value="high_school">高中</option>
				</select></td>
              </tr>
            </table>
          <table width="275" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="65" height="70" align="right" valign="top" class="font_121" style="padding-right:5px; padding-top:5px;">学习情况：</td>
                <td align="left"><textarea name="message" class="input21"></textarea></td>
              </tr>
            </table>
          <table width="275" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="65" height="30" align="right" class="font_121" style="padding-right:5px;">验证码：</td>
                <td width="73" align="left"><input name="captcha" type="text" class="input31" /></td>
                <td align="left"><img src="<?php echo site_url().'/ajax/captcha/'?>" id="safecode" border="0" onclick="reloadcode()" width="60" height="20" /></td>
              </tr>
            </table>
			<table id="warningTable" width="275" border="0" cellspacing="0" cellpadding="0" style="display:none">
              <tr>
                <td align="center" class="font_12_red"><div id="warningText"></div></td>
              </tr>
            </table>
          <table width="275" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="90" align="center" class="font_121" style="padding-right:5px;"><label><input type="image" name="submit" align="bottom" src="images/yxfd_37.jpg"></label></td>
              </tr>
          </table></td>
      </tr>
    </table></td>
  </tr>
</table>