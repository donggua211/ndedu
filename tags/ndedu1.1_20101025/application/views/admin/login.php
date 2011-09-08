<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<TITLE>Administrator's Control Panel</TITLE>
<base href="<?php echo base_url() ?>" />
<LINK href="images/admin.css" type="text/css" rel="stylesheet">
</script>
</HEAD>
<BODY topMargin=10><br /><br /><br /><br /><br /><br />
	<FORM action="<?php echo site_url("admin/admin/login"); ?>" method="post" name="pass" id="pass"><A name=b8e6f4fa493903c4></A>
		<table width="400" border="0" align="center" cellpadding="0" cellspacing="0" class="tableborder">
			<tr class="header">
				<td colspan="3" align="right"><div align="right">管理登入</div></td>
			</tr>
			<tr>
				<td colspan="3"><span>
				<?php 
					if(!empty($notification)):
				?>
						<span style="color:#FF0000;font-size:18px"><?php echo get_language('admin', 'cn', $notification) ?></span>
				<?php
					else:
				?>
						&nbsp;
				<?php
					endif;
				?>
				</td>
			</tr>
			<tr>
				<td width="149" height="40" align="right"><div align="right">用户名：            </div></td>
				<td width="251" colspan="2"><input type="text" name="username" id="username"></td>
			</tr>
			<tr>
				<td height="40" align="right"><div align="right">密码：</div></td>
				<td colspan="2"><input type="password" name="password" id="password"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td colspan="2"><input class="submit" type=submit value="Login" name=submit></td>
			</tr>
		</table>
	</FORM>
</BODY></HTML>
