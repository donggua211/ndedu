<div style="background-color:#FEF6AF;height:100%;width:100%">
<table width="926" height="572" border="0" align="center" cellpadding="0" cellspacing="0" background="images/evaluate/login_bg.jpg">
  <tr>
    <td align="center" valign="center">
		<table width="340" height="258" border="0" align="center" cellpadding="0" cellspacing="0" style="background-color:#FFFBE6;">
		<form name="login" action="<?php echo site_url('user/login')?>" method="post" onSubmit="">
		  <tr>
			<td width="340" height="258" align="center">
				<table width="340" height="44" border="0" align="center" cellpadding="0" cellspacing="0" background="images/evaluate/login_banner_top.gif" style="background-repeat:no-repeat; background-position:top">
					<tr>
						<td width="57" align="center"><img src="images/evaluate/login_site_icon.gif"></td>
						<td width="200" align="left" class="font_16_bold" style="padding-top:5px">你的教育全方位测试系统</td>
						<td width="83" align="left"><img src="images/evaluate/beta1.0.gif"></td>
					</tr>
				</table>
				<table width="340" height="200" border="0" align="center" cellpadding="0" cellspacing="0" style="border-left:1px solid #FFA901;border-right:1px solid #FFA901;border-top:1px solid #FFA901">
					<tr height="30">
						<td colspan="2" align="center" class="font_red_14"><?php echo isset($notification) ? $notification : ''; ?></td>
					</tr>
					<tr height="40">
						<td width="105" class="font_14_3" align="right">用户名：</td>
						<td><input type="text" name="username" value="<?php echo (isset($user_name))?$user_name:''; ?>" style="background-color:#FEF6AF; border:1px solid #FFA902; height:23px; width:160px; line-height:25px;"/></td>
					</tr>
					<tr height="40">
						<td width="105" class="font_14_3" align="right">密&nbsp;&nbsp;&nbsp;码：</td>
						<td><input type="password" name="password"  style="background-color:#FEF6AF; border:1px solid #FFA902; height:23px; width:160px; line-height:25px;"/></td>
					</tr>
					<tr height="80">
						<td  colspan="2" align="center">
							<input type="image" name="submit" align="bottom" src="images/evaluate/login__botton.gif" value="submit"><a href="<?php echo site_url('register/'.$backurl) ?>" style="margin-left:20px"><img src="images/evaluate/register_botton.gif" border="0"/></a>
						</td>
					</tr>
				</table>
				<table width="340" height="13" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr><td><img src="images/evaluate/login_banner_bottom.gif"></td></tr>
				</table>
			</td>
		  </tr>
		<input type="hidden" name="backurl" value="<?php echo $backurl?>">
		</form>
		</table>
	</td>
  </tr>
</table>
</div>