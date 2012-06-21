<table width="920" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30" background="images/hjxxgh_10.jpg" class="mianbao">
	您所在位置：<a href="<?php echo site_url('') ?>">首页</a> &gt; 注册成功
	</td>
  </tr>
</table>
<table width="920" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top">
	<table width="662" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #c8c8c8; padding-bottom:6px;padding-left:20px;padding-top:10px">
        <tr>
          <td height="588"  width="600" align="left" valign="top">
			<table border="0" cellspacing="0" cellpadding="0">
				<tr><td align="center" width="600" class="font_14_3" style="border:1px solid #71C610;padding:5px">
					<img src="images/icon/ok.gif" style="vertical-align:middle"> 尊敬的<?php echo $user_name?>, 我们已经把激活邮件发送到了<?php echo $email?>，快去激活吧！<br/>
					<a href="<?php echo $emailurl ?>" target="_blank">去我的邮箱激活</a>
				</td></tr>
			</table>
			<table width="610" border="0" cellspacing="0" cellpadding="0" class="font_14">
				<tr class="register_tr">
					<td colspan="2" align="left"><strong>请牢记您的注册信息:</strong></td>
				</tr>
				<tr class="register_tr">
					<td width="120" align="right"><span>用户名：</span></td>
                    <td width="490" align="left"><?php echo $user_name ?></td>
				</tr>
				<tr class="register_tr">
					<td width="120" align="right"><span>密&nbsp;&nbsp;&nbsp;&nbsp;码：</span></td>
                    <td width="490" align="left"><?php echo $password ?></td>
				</tr>
			</table>			
		  </td>
        </tr>
    </table>
	</td>
    <td width="247" valign="top"><table width="247" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="33"><img src="images/hjxxgh_07.jpg" width="247" height="72" /></td>
      </tr>
    </table>
      <table width="247" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="images/hjxxgh_42.jpg" width="247" height="10" /></td>
        </tr>
    </table>
    <table width="247" border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;">
        <tr>
          <td align="center" valign="bottom"><a href="javascript:viod(0);" onclick="collapse_switch('guestbook_table')"><img src="images/hjxxgh_44.jpg" width="247" height="63" border="0" /></a></td>
        </tr>
    </table>
	
	<table id="guestbook_table" width="247" border="0" cellspacing="0" cellpadding="0" style="display:none">
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
          <td height="90" align="center" valign="bottom"><img src="images/index_94.jpg" width="237" height="93" /></td>
        </tr>
      </table></td>
  </tr>
</table>