<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<base href="<?php echo base_url() ?>" />
	<link href="images/admin.css" rel="stylesheet" type="text/css" />
	<title>administrator's control panel</title>
</head>
<body>

<div id="navigation" class="navigation">
	<a href="<?php echo site_url().'/admin/entry/info'?>">admin</a> &nbsp;»&nbsp; <a href="<?php echo site_url().'/admin/article/index'?>">文章管理</a> &nbsp;»&nbsp; 文章搜索
</div>
<div>
	<FORM action="<?php echo site_url("admin/article/search"); ?>" method="post" >
		<table width="400" border="0" align="left" cellpadding="0" cellspacing="0" class="tableborder">
		<?php 
			if(!empty($notification)):
		?>
			<tr>
				<td><span>
						<span style="color:#FF0000;font-size:18px"><?php echo get_language('admin', 'cn', $notification) ?></span>
				<?php
					else:
				?>
						&nbsp;
				</td>
			</tr>
		<?php
			endif;
		?>

			<tr>
				<td><input type="text" name="keyword" size="50" id="keyword"> <input type="submit" value="搜索" name="submit"></td>
			</tr>
		</table>
	</FORM>
</div>
</body>
</html>