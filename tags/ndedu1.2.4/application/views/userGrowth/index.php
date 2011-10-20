<table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="816" height="100" style="padding-left:25px;"><img src="images/logo.gif" width="237" height="69" alt="<?php echo SITE_NAME; ?>" /></td>
    <td width="84" valign="top" style="padding-top:8px;"><a href="<?php echo site_url('') ?>">返回首页</a></td>
  </tr>
</table>
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0" background="images/loginbg_06.jpg" style="background-repeat:repeat-x; background-position:0 33px;">
  <tr>
    <td width="569" height="406" align="left" valign="top" style="background-repeat:no-repeat; background-position:0 34px;">
	<table width="296" border="0" cellpadding="0" cellspacing="0" class="font_14black" style="margin-top:47px; margin-left:58px;">
      <tr>
        <td>查看学员档案小提示:</td>
      </tr>
    </table>
	<table width="460" border="0" cellspacing="0" cellpadding="0" style="margin-left:58px; margin-top:10px;">
      <tr>
        <td width="15"><img src="images/login_11.jpg" width="7" height="7" /></td>
        <td width="438" class="font_14">您是否为尼德教育正式学员？</td>
      </tr>
    </table>
	<table width="460" border="0" cellspacing="0" cellpadding="0" style="margin-left:58px; margin-top:4px;">
      <tr>
        <td class="font_12_24" style="padding-left:15px;">只有正式学员才拥有相应帐号登录学员档案系统。</td>
        </tr>
    </table>
	<table width="460" border="0" cellspacing="0" cellpadding="0" style="margin-left:58px; margin-top:10px;">
      <tr>
        <td width="15"><img src="images/login_11.jpg" width="7" height="7" /></td>
        <td width="438" class="font_14">学员是否在尼德教育接受服务满三月？</td>
      </tr>
    </table>
	<table width="460" border="0" cellspacing="0" cellpadding="0" style="margin-left:58px; margin-top:4px;">
      <tr>
        <td class="font_12_24" style="padding-left:15px;">正式学员接受尼德教育服务满三个月，学员个性化成长档案正式开始备案。</td>
      </tr>
    </table>
	<table width="460" border="0" cellspacing="0" cellpadding="0" style="margin-left:58px; margin-top:10px;">
      <tr>
        <td width="15"><img src="images/login_11.jpg" width="7" height="7" /></td>
        <td width="438" class="font_14">学员个性化成长档案隐私？</td>
      </tr>
    </table>
	<table width="460" border="0" cellspacing="0" cellpadding="0" style="margin-left:58px; margin-top:4px;">
      <tr>
        <td class="font_12_24" style="padding-left:15px;">学员个性化成长档案用来记录学员在尼德教育学习成长全过程，属于学员个人隐私，只允许学员本人、监护人、尼德教师查看。</td>
      </tr>
    </table>
	<table width="460" border="0" cellspacing="0" cellpadding="0" style="margin-left:58px; margin-top:10px;">
      <tr>
        <td width="15"><img src="images/login_11.jpg" width="7" height="7" /></td>
        <td width="438" class="font_14">忘记用户名和密码</td>
      </tr>
    </table>
	<table width="460" border="0" cellspacing="0" cellpadding="0" style="margin-left:58px; margin-top:4px;">
      <tr>
        <td class="font_12_24" style="padding-left:15px;">学员在线个性化成长档案用户名和密码在学员与尼德教育签署服务合同三个月后由学员私人教育顾问统一发放，如果您忘记或者丢失请致电学员的私人学习顾问。</td>
      </tr>
    </table></td>
    <td>
	  <form name="login" action="" method="post" onSubmit="return checkTable_falk(this);">
	  <table width="296" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="406" align="left" valign="top" background="images/login_06.jpg" style="background-repeat:no-repeat; background-position:top">
		<table width="230" border="0" cellspacing="0" cellpadding="0" style="margin-top:85px; margin-left:40px;">
          <tr>
            <td width="57" class="font_14_3">用户名：</td>
            <td><input type="text" name="username"  style="background-color:#ebebeb; border:1px solid #afafaf; height:23px; width:160px; line-height:25px;"/></td>
          </tr>
        </table>
		<table width="230" border="0" cellspacing="0" cellpadding="0" style="margin-top:15px; margin-left:40px;">
          <tr>
            <td width="57" class="font_14_3">密&nbsp;&nbsp;&nbsp;码：</td>
            <td><input type="password" name="password"  style="background-color:#ebebeb; border:1px solid #afafaf; height:23px; width:160px; line-height:25px;"/></td>
          </tr>
        </table>
		<table width="230" border="0" cellspacing="0" cellpadding="0" style="margin-top:15px; margin-left:40px;">
          <tr>
            <td width="57" class="font_14_3">验证码：</td>
            <td width="69"><input type="text" name="captcha" style="background-color:#ebebeb; border:1px solid #afafaf; height:23px; width:60px; line-height:25px;"/></td>
            <td width="104"><img src="<?php echo site_url().'/ajax/captcha/'?>" id="safecode" border="0" onclick="reloadcode()" src="<?php echo site_url().'/ajax/captcha/'?>"/></td>
          </tr>
        </table>
		<table id="warningTable" border="0" cellspacing="0" cellpadding="0" width="230" style="margin-top:15px; margin-left:40px; display:none">
			  <tr>
				<td align="left" class="font_12_red"><div id="warningText"></div></td>
			  </tr>
		</table>
		<table width="230" border="0" cellspacing="0" cellpadding="0" style="margin-top:23px; margin-left:40px;">
          <tr>
            <td width="56" class="font_14_3">&nbsp;</td>
            <td><input type="image" name="submit" align="bottom" src="images/login_15.jpg"></td>
            </tr>
        </table>
		<table width="230" border="0" cellspacing="0" cellpadding="0" style="margin-top:35px; margin-left:40px;">
          <tr>
            <td width="66" class="font_14_3">&nbsp;</td>
            <td width="164" class="font_12_24">欢迎您登录学员个性化成长档案，如果您对档案内容有任何反馈请您直接致电学员私人教育顾问。<br /></td>
          </tr>
        </table></td>
        </tr>
    </table></td>
  </tr>
</table>
