<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<TITLE>Administrator's Control Panel</TITLE>
<base href="<?php echo base_url() ?>" />
<LINK href="images/admin.css" type=text/css rel=stylesheet>
</HEAD>
<BODY topMargin=10>
<TABLE cellSpacing=6 cellPadding=2 width="100%" border=0>
  <TBODY>
  <TR>
    <TD>
      <TABLE class=guide cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD><A href="<?php echo site_url("admin/entry/info"); ?>" target="main">后台首页</A>&nbsp;» 管理员密码修改</TD>
        </TR></TBODY></TABLE>
      <BR>
      <FORM action="<?php echo site_url("admin/admin/editPwd"); ?>" method="post" name="pass" id="pass"><A name=b8e6f4fa493903c4></A>
        <table class="tableborder" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr class="header">
          <td colspan="2" >修改密码</td>
        </tr>
<?php 
	if(!empty($notification)):
?>
		<tr>
			<td colspan="2" >
				<span style="color:#FF0000;font-size:18px"><?php echo get_language('admin', 'cn', $notification) ?></span>
			</td>
        </tr>
<?php
	endif;
?>
        <tr>
          <td width="100">原始密码：            </td>
          <td><input type="password" name="old" id="old"></td>
        </tr>
        <tr>
          <td>新密码：            </td>
          <td><input type="password" name="password" id="password"></td>
        </tr>
        <tr>
          <td>确认新密码：            </td>
          <td><input type="password" name="password2" id="password2"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input class="submit" type=submit value="修 改" name=submit></td>
        </tr>
      </table>
      </FORM></TD></TR></TBODY></TABLE><BR><BR>
<DIV class=footer>
<HR width="80%" color=#9db3c5 noShade SIZE=0>
Powered by kissjava <em>AT</em> 139.com. &nbsp;© 2006-2008, <B><A style="COLOR: #666" href="http://www.gpsnet.cc/" target="_blank">CFCNS.</A></B></DIV>
</BODY></HTML>
