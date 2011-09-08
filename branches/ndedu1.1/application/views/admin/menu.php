<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<TITLE>Administrator's Control Panel</TITLE>
<base href="<?php echo base_url() ?>" />
<LINK href="images/admin.css" type=text/css rel=stylesheet>
<SCRIPT src="js/common.js" type=text/javascript></SCRIPT>
<SCRIPT>
function collapse_change(menucount) {
	if($('menu_' + menucount).style.display == 'none') {
		$('menu_' + menucount).style.display = '';
	} else {
		$('menu_' + menucount).style.display = 'none';
	}
}
</SCRIPT>
</HEAD>
<BODY style="MARGIN: 3px">
<TABLE class=leftmenulist style="MARGIN-BOTTOM: 5px" cellSpacing=0 cellPadding=0 width=146 align=center border=0>
  <TBODY>
  <TR class=leftmenutext>
    <TD>
      <DIV align=center>
      <A href="<?php echo site_url(); ?>" target="_blank">网站首页</A>&nbsp;&nbsp;<a href="<?php echo site_url(); ?>/admin/entry/info" target="main">后台首页</a>
      </DIV>
    </TD>
  </TR>
  </TBODY>
</TABLE>
<DIV id=home>
<TABLE class=leftmenulist style="MARGIN-BOTTOM: 5px" cellSpacing=0 cellPadding=0 width=146 align=center border=0>
	<TR class=leftmenutext>
		<TD><A onclick=collapse_change(7) href="javascript:void(0)"><IMG src="images/menu_reduce.gif" name="menuimg_6" border=0 id=menuimg_2></A>&nbsp;<A onclick=collapse_change(7) href="javascript:void(0)">学生管理</A></TD>
	  </TR>
  <TBODY id=menu_6>
  <TR class=leftmenutd>
    <TD>
      <TABLE class=leftmenuinfo cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
		<?php if(in_array($group_id, array(1,3))): ?>
        <TR>
          <TD><A href="<?php echo site_url("admin/student/add"); ?>" target="main">添加学生</A></TD>
		</TR>
		<?php endif; ?>
        <TR>
		  <TD><A href="<?php echo site_url("admin/student"); ?>" target="main">查看学生</A></TD>
		</TR>
        </TBODY>
      </TABLE>
    </TD>
  </TR>
  </TBODY> 
  
  <?php if(in_array($group_id, array(1))): ?>
  <TR class=leftmenutext>
    <TD><A onclick=collapse_change(1) href="javascript:void(0)"><IMG src="images/menu_reduce.gif" name="menuimg_1" border=0 id=menuimg_1></A>&nbsp;<A onclick=collapse_change(1) href="javascript:void(0)">员工管理</A></TD>
  </TR>
  <TBODY id=menu_1>
  <TR class=leftmenutd>
    <TD>
      <TABLE class=leftmenuinfo cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR>
          <TD><A href="<?php echo site_url("admin/employee"); ?>" target="main">员工列表</A></TD></TR>
        <TR>
          <TD><A href="<?php echo site_url("admin/employee/add"); ?>" target=main>添加员工</A></TD>
        </TR>
        </TBODY>
      </TABLE>
    </TD>
  </TR>
  </TBODY>
  
	<TR class=leftmenutext>
    <TD><A onclick=collapse_change(1) href="javascript:void(0)"><IMG src="images/menu_reduce.gif" name="menuimg_1" border=0 id=menuimg_1></A>&nbsp;<A onclick=collapse_change(1) href="javascript:void(0)">留言本</A></TD>
  </TR>
  <TBODY id=menu_1>
  <TR class=leftmenutd>
    <TD>
      <TABLE class=leftmenuinfo cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR>
          <TD><A href="<?php echo site_url("admin/guestbook/inbox"); ?>" target="main">查看留言</A></TD></TR>
        <TR>
          <TD><A href="<?php echo site_url("admin/guestbook/trash"); ?>" target=main>废件箱</A></TD>
        </TR>
        <TR>
          <TD><A href="<?php echo site_url("admin/guestbook/all"); ?>" target="main">查看全部留言</A></TD>
        </TR>
        </TBODY>
      </TABLE>
    </TD>
  </TR>
  </TBODY>
  
    <TR class=leftmenutext>
    <TD><A onclick=collapse_change(2) href="javascript:void(0)"><IMG src="images/menu_reduce.gif" name="menuimg_2" border=0 id=menuimg_2></A>&nbsp;<A onclick=collapse_change(2) href="javascript:void(0)">分类管理</A></TD>
  </TR>
  <TBODY id=menu_2>
  <TR class=leftmenutd>
    <TD>
      <TABLE class=leftmenuinfo cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR>
          <TD><A href="<?php echo site_url("admin/articleCat/add"); ?>" target="main">添加分类</A></TD>
		</TR>
        <TR>
		  <TD><A href="<?php echo site_url("admin/articleCat"); ?>" target="main">查看分类</A></TD>
		</TR>
        </TBODY>
      </TABLE>
    </TD>
  </TR>
  </TBODY> 
    
  <TR class=leftmenutext>
    <TD><A onclick=collapse_change(6) href="javascript:void(0)"><IMG src="images/menu_reduce.gif" name="menuimg_6" border=0 id=menuimg_2></A>&nbsp;<A onclick=collapse_change(6) href="javascript:void(0)">当当网内容管理</A></TD>
  </TR>
  <TBODY id=menu_6>
  <TR class=leftmenutd>
    <TD>
      <TABLE class=leftmenuinfo cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR>
          <TD><A href="<?php echo site_url("admin/dangdang/add"); ?>" target="main">添加当当网内容</A></TD>
		</TR>
        <TR>
		  <TD><A href="<?php echo site_url("admin/dangdang"); ?>" target="main">查看当当网内容</A></TD>
		</TR>
        </TBODY>
      </TABLE>
    </TD>
  </TR>
  </TBODY> 
  
  <TR class=leftmenutext>
    <TD><A onclick=collapse_change(5) href="javascript:void(0)"><IMG src="images/menu_reduce.gif" name="menuimg_5" border=0 id=menuimg_5></A>&nbsp;<A onclick=collapse_change(5) href="javascript:void(0)">tag管理</A></TD>
  </TR>
  <TBODY id=menu_5>
  <TR class=leftmenutd>
    <TD>
      <TABLE class=leftmenuinfo cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR>
          <TD><A href="<?php echo site_url("admin/tags/add"); ?>" target="main">添加tag</A></TD>
		</TR>
        <TR>
		  <TD><A href="<?php echo site_url("admin/tags"); ?>" target="main">查看tag</A></TD>
		</TR>
        </TBODY>
      </TABLE>
    </TD>
  </TR>
  </TBODY>  
   
  <TR class=leftmenutext>
    <TD><A onclick=collapse_change(3) href="javascript:void(0)"><IMG src="images/menu_reduce.gif" name="menuimg_3" border=0 id=menuimg_3></A>&nbsp;<A onclick=collapse_change(3) href="javascript:void(0)">文章管理</A></TD>
  </TR>
  <TBODY id=menu_3>
  <TR class=leftmenutd>
    <TD>
      <TABLE class=leftmenuinfo cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR>
          <TD><A href="<?php echo site_url("admin/article/add"); ?>" target="main">添加文章</A></TD></TR>
        <TR>
		  <TD><A href="<?php echo site_url("admin/article"); ?>" target="main">查看文章</A></TD>
		</TR>
        <TR>
		  <TD><A href="<?php echo site_url("admin/article/draft"); ?>" target="main">草稿箱</A></TD>
		</TR>
        </TBODY>
      </TABLE>
    </TD>
  </TR>
  </TBODY> 
 
  <TR class=leftmenutext>
    <TD><A onclick=collapse_change(4) href="javascript:void(0)"><IMG src="images/menu_reduce.gif" name="menuimg_4" border=0 id=menuimg_4></A>&nbsp;<A onclick=collapse_change(4) href="javascript:void(0)">统计</A></TD>
  </TR>
  <TBODY id=menu_4>
  <TR class=leftmenutd>
    <TD>
      <TABLE class=leftmenuinfo cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR>
          <TD><A href="<?php echo site_url("admin/stats/"); ?>" target="main">查看点击率</A></TD>
		</TR>
		<TR>
          <TD><A href="<?php echo site_url("admin/stats/keywords"); ?>" target="main">查看搜索关键字</A></TD>
		</TR>
        </TBODY>
      </TABLE>
    </TD>
  </TR>
  </TBODY> 
</TABLE>
</DIV>
<?php endif; ?>
<TABLE class=leftmenulist cellSpacing=0 cellPadding=0 width=146 align=center border=0>
  <TBODY>
  <TR class=leftmenutext>
    <TD>
      <DIV style="MARGIN-LEFT: 30px">
        <a href="<?php echo site_url("admin/admin/editPwd"); ?>" target="main">修改密码</a> </DIV>
    </TD>
  </TR>
  </TBODY>
</TABLE>
<TABLE class=leftmenulist cellSpacing=0 cellPadding=0 width=146 align=center border=0>
  <TBODY>
  <TR class=leftmenutext>
    <TD>
      <DIV style="MARGIN-LEFT: 48px">
        <a href="<?php echo site_url("admin/admin/logout"); ?>" target="_top">退出</a> </DIV>
    </TD>
  </TR>
  </TBODY>
</TABLE>
</BODY>
</HTML>
