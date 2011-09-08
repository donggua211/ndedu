<table width="920" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30" background="images/hjxxgh_10.jpg" class="mianbao">
	您所在位置：<a href="<?php echo site_url('') ?>">首页</a> &gt; 注册
	</td>
  </tr>
</table>
<table width="920" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top">
	<table width="662" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #c8c8c8; padding-bottom:6px;padding-left:20px;padding-top:10px">
        <tr>
          <td height="588"  width="600" align="left" valign="top">
            <?php if(isset($notification)): ?>
			<table border="0" cellspacing="0" cellpadding="0">
				<tr><td align="center" width="600" class="font_red_14" style="border:1px solid #FF8080;padding:5px"><img src="images/icon/warning.gif" style="vertical-align:middle"> <?php echo $notification ?></td></tr>
			</table>
			<?php endif; ?>
			<form name="guestbook" action="<?php echo site_url('user/register')?>" method="post" onSubmit="return checkRegister(this);">
			<input type="hidden" name="backurl" value="<?php echo $backurl?>">
			<table width="610" border="0" cellspacing="0" cellpadding="0" class="font_14">
				<tr>
					<td colspan="3" style="padding:10px;">
						<a href="<?php echo site_url(); ?>">尼德教育</a>用户注册
						<hr size="1" width="100%" color="#DDDDDD"></td>
				</tr>
				<tr id="tr_username" class="register_tr">
					<td width="120" align="right"><span>用户名：</span></td>
                    <td width="180" align="left"><input type="text" name="username" value="<?php echo (isset($user_name))?$user_name:''; ?>" style="width:150px; height:18px; background-color:#FFFFFF; border:1px solid #CCCCCC" onFocus="focusInput(this, 'username', '只能由3-16位字母(a-z)、数字(0-9)或下划线(_)构成');" onBlur="checkUser(this, 'username');"/></td>
					<td width="210"><div id="warning_username"></div></td>
				</tr>
				<tr id="tr_realname" class="register_tr">
					<td width="120" align="right"><span>真实姓名：</span></td>
                    <td width="180" align="left"><input type="text" name="realname" value="<?php echo (isset($real_name))?$real_name:''; ?>" style="width:150px; height:18px; background-color:#FFFFFF; border:1px solid #CCCCCC" onFocus="focusInput(this, 'realname', '请输您的真实姓名, 以便我们及时和您联系.');" onBlur="checkRealname(this, 'realname');"/></td>
					<td width="210"><div id="warning_realname"></div></td>
				</tr>
				<tr>
					<td colspan="3" style="padding:10px;"><hr size="1" width="100%" color="#DDDDDD"></td>
				</tr>
				<tr id="tr_password" class="register_tr">
					<td width="120" align="right"><span>密&nbsp;&nbsp;&nbsp;&nbsp;码：</span></td>
                    <td width="180" align="left"><input type="password" id="password" name="password" style="width:150px; height:18px; background-color:#FFFFFF; border:1px solid #CCCCCC" onFocus="focusInput(this, 'password', '密码至少要6位, 且不能包含空格, 英文字母区分大小写.');" onBlur="checkPassword(this, 'password');"/></td>
					<td width="210"><div id="warning_password"></div></td>
				</tr>
				<tr id="tr_password_c" class="register_tr">
					<td width="120" align="right"><span>再次输入密码：</span></td>
                    <td width="180" align="left"><input type="password" name="password_c" style="width:150px; height:18px; background-color:#FFFFFF; border:1px solid #CCCCCC" onFocus="focusInput(this, 'password_c', '请再次输入输您的密码.');" onBlur="checkPasswordC(this, 'password_c');"/></td>
					<td width="210"><div id="warning_password_c"></div></td>
				</tr>
				<tr>
					<td colspan="3" style="padding:10px;"><hr size="1" width="100%" color="#DDDDDD"></td>
				</tr>
				<tr id="tr_phone" class="register_tr">
					<td width="120" align="right"><span>手机号：</span></td>
					<td width="180" align="left"><input type="text" name="phone" value="<?php echo (isset($phone))?$phone:''; ?>" style="width:150px; height:18px; background-color:#FFFFFF; border:1px solid #CCCCCC" onFocus="focusInput(this, 'phone', '请输入您的手机号或者座机号.');" onBlur="checkPhoneRegister(this, 'phone');"/></td>
					<td width="210"><div id="warning_phone"></div></td>
				</tr>
				<tr id="tr_email" class="register_tr">
					<td width="120" align="right"><span>电子邮箱：</span></td>
					<td width="180" align="left"><input type="text" name="email" value="<?php echo (isset($email))?$email:''; ?>" style="width:150px; height:18px; background-color:#FFFFFF; border:1px solid #CCCCCC" onFocus="focusInput(this, 'email', '请输入您常用的邮箱，方便日后找回密码。');" onBlur="checkEmail(this, 'email');"/></td>
					<td width="210"><div id="warning_email"></div></td>
				</tr>
				<tr id="tr_province" class="register_tr">
					<td width="120" align="right"><span>居住地：</span></td>
					<td align="left" colspan="2">
						<select onchange="changeProvince();" tabindex="11" name="User_Shen" id="User_Shen">
						</select>
						<select onchange="changeTown();" tabindex="12" name="User_Town" id="User_Town">
						</select>
						<select tabindex="13" name="User_City" id="User_City">
						</select>
						<span style="margin-left:10px" id="warning_province"></span>
					</td>
				</tr>
				<tr>
					<td colspan="3" style="padding:10px;"><hr size="1" width="100%" color="#DDDDDD"></td>
				</tr>
				<tr class="register_tr">
					<td width="120" align="right"><span>VIP码：</span></td>
					<td width="180" align="left"><input type="text" name="vipcode" value="<?php echo (isset($vipcode))?$vipcode:''; ?>" style="width:150px; height:18px; background-color:#FFFFFF; border:1px solid #CCCCCC" onFocus="focusInput(this, 'phone', '请输入您的VIP码.');"/></td>
					<td width="210"><div id="warning_vipcode"></div></td>
				</tr>
			</table>
			<table width="610" border="0" cellspacing="0" cellpadding="0" class="font_14">
				<tr id="tr_captcha" class="register_tr">
					<td width="120" align="right"><span>验证码：</span></td>
                    <td width="80" align="left">
						<input type="text" name="captcha" style="width:80px; height:18px; background-color:#FFFFFF; border:1px solid #CCCCCC" onFocus="focusInput(this, 'captcha', '请输入图片中所显示的字母或数字，不区分大小写。');" onBlur="blurInput('captcha');">
					</td>
					<td width="100" align="center">
						<img src="<?php echo site_url().'/ajax/captcha/'?>" id="safecode_right" border="0" onclick="reloadcode_right()" style="cursor:hand;"/>
					<td width="210"><div id="warning_captcha"></div></td>
				</tr>				
				<tr class="register_tr">
					<td height="36" align="center" colspan="4" style="padding-top:10px;">
						<button type="submit" id="reigster_submit">提交注册</button>
						<input type="hidden" name="submit" value="submit" />
					</td>
				</tr>
			</form>
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
                <td width="231" height="62" align="center" background="images/index2_35.jpg" class="font_12_red" style="padding-left:8px; padding-right:8px; padding-top:4px; font-size:12px; color:#333333; font-weight:bold">请放心，家长所留下的个人信息，尼德将恪守职业道德，为您保密。</td>
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