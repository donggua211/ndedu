﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>NDEDU 内部咨询系统</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="Text/Javascript" language="JavaScript">
<!--

if (window.top != window)
{
  window.top.location.href = document.location.href;
}

//-->
</script>

<frameset rows="50,*" framespacing="0" border="0">
  <frame src="<?php echo site_url("ics/entry/top") ?>" id="header-ics" name="header-ics" frameborder="no" scrolling="no">
  <frameset cols="200, 10, *" framespacing="0" border="0" id="frame-body">
    <frame src="<?php echo site_url("ics/ics/menu") ?>" id="menu-ics" name="menu-ics" frameborder="no" scrolling="yes">
    <frame src="<?php echo site_url("admin/entry/drag") ?>" id="drag-ics" name="drag-ics" frameborder="no" scrolling="no">

    <frame src="<?php echo site_url($main_url) ?>" id="main-ics" name="main-ics" frameborder="no" scrolling="yes">
  </frameset>
</frameset>
</head>
<body>
</body>
</html>