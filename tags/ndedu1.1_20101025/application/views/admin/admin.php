<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<base href="<?php echo base_url() ?>" />
	<link href="images/admin.css" rel="stylesheet" type="text/css" />
	<title>administrator's control panel</title>
</head>
<body style="margin: 0px" scroll=no>
<div style="z-index: 2; left: 0px; width: 100%; position: absolute; top: 0px; height: 65px">
  <iframe id=header style="z-index: 1; visibility: inherit; width: 100%; height: 65px" name=header src="<?php echo site_url("admin/entry/top") ?>" frameborder=0 scrolling=no></iframe>
</div>
<table style="table-layout: fixed" height="100%" cellspacing=0 cellpadding=0 width="100%" border=0>
  <tbody>
    <tr>
      <td width=165 height=65></td>
      <td></td>
    </tr>
    <tr>
      <td><iframe id=menu style="z-index: 1; visibility: inherit; overflow: auto; width: 100%; height: 100%" name=menu src="<?php echo site_url("admin/entry/menu") ?>" frameborder=0 scrolling=yes></iframe></td>
      <td><iframe id=main style="z-index: 1; visibility: inherit; overflow: auto; width: 100%; height: 100%" name=main src="<?php echo site_url("admin/entry/info") ?>" frameborder=0 scrolling=yes></iframe></td>
    </tr>
  </tbody>
</table>
</body>
</html>