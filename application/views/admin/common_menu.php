<div id="tabbar-div">
	<p><span style="float:right; padding: 3px 5px;" ><a href="javascript:toggleCollapse();"><img id="toggleImg" src="images/menu_minus.gif" width="9" height="9" border="0" alt="闭合" /></a></span>
	<span class="tab-front" id="menu-tab">菜单</span>
</div>
<div id="main-div">
	<div id="menu-list">
		<ul>
			<li class="explode" key="01_calendar" name="menu">
				日程安排
				<ul>
					<li class="menu-item"><a href="<?php echo site_url("admin/calendar/"); ?>" target="main-frame">这个月</a></li>
					<li class="menu-item"><a href="<?php echo site_url("admin/calendar/today"); ?>" target="main-frame">今天</a></li>
					<li class="menu-item"><a href="<?php echo site_url("admin/calendar/add"); ?>" target="main-frame">添加日程</a></li>
				</ul>
			</li>
			<li class="explode" key="03_student" name="menu">
				学员管理
				<ul>
					<?php if(is_admin() || is_school_admin() || is_consultant()): //权限: 超级管理员, 校区管理员, 咨询师可以添加员工?>
					<li class="menu-item"><a href="<?php echo site_url("admin/student/add"); ?>" target="main-frame">添加学员</a></li>
					<?php endif; ?>
					<li class="menu-item"><a href="<?php echo site_url("admin/student"); ?>" target="main-frame">查看学员</a></li>
					<?php if(is_admin() || is_school_admin()): //权限: 超级管理员, 校区管理员?>
					<li class="menu-item"><a href="<?php echo site_url("admin/student/signup"); ?>" target="main-frame">已报名未分配的学员</a></li>
					<li class="menu-item"><a href="<?php echo site_url("admin/student/finished"); ?>" target="main-frame">已学完的学员</a></li>
					<li class="menu-item"><a href="<?php echo site_url("admin/student/inactive"); ?>" target="main-frame">注销的学员</a></li>
					<li class="menu-item"><a href="<?php echo site_url("admin/student/delete_student"); ?>" target="main-frame">删除的学员</a></li>
					<?php endif; ?>
				</ul>
			</li>
			<?php if(is_admin() || is_school_admin()): //权限: 只有超级管理员和校区管理员可以管理员工?>
			<li class="explode" key="02_staff" name="menu">
				员工管理
				<ul>
					<li class="menu-item"><a href="<?php echo site_url("admin/staff/add"); ?>" target="main-frame">添加员工</a></li>
					<li class="menu-item"><a href="<?php echo site_url("admin/staff"); ?>" target="main-frame">员工列表</a></li>
					<li class="menu-item"><a href="<?php echo site_url("admin/staff/performance"); ?>" target="main-frame">员工绩效</a></li>
					<li class="menu-item"><a href="<?php echo site_url("admin/staff/inactive_staff"); ?>" target="main-frame">注销的员工</a></li>
					<li class="menu-item"><a href="<?php echo site_url("admin/staff/delete_staff"); ?>" target="main-frame">删除的员工</a></li>
				</ul>
			</li>
			<?php endif; ?>
			<?php if(is_admin()): //权限: 只有超级管理员可以管理网站内容?>
			<li class="explode" key="04_guestbook" name="menu">
				留言本
				<ul>
					<li class="menu-item"><a href="<?php echo site_url("admin/guestbook/inbox"); ?>" target="main-frame">查看留言</a></li>
					<li class="menu-item"><a href="<?php echo site_url("admin/guestbook/trash"); ?>" target="main-frame">废件箱</a></li>
					<li class="menu-item"><a href="<?php echo site_url("admin/guestbook/all"); ?>" target="main-frame">查看全部留言</a></li>
				</ul>
			</li>
			<li class="explode" key="05_articleCat" name="menu">
				分类管理
				<ul>
					<li class="menu-item"><a href="<?php echo site_url("admin/articleCat"); ?>" target="main-frame">查看分类</a></li>
					<li class="menu-item"><a href="<?php echo site_url("admin/articleCat/add"); ?>" target="main-frame">添加分类</a></li>
				</ul>
			</li>
			<li class="explode" key="06_dangdang" name="menu">
				当当网内容管理
				<ul>
					<li class="menu-item"><a href="<?php echo site_url("admin/dangdang"); ?>" target="main-frame">查看当当网内容</a></li>
					<li class="menu-item"><a href="<?php echo site_url("admin/dangdang/add"); ?>" target="main-frame">添加当当网内容</a></li>
				</ul>
			</li>
			<li class="explode" key="07_tags" name="menu">
				tag管理
				<ul>
					<li class="menu-item"><a href="<?php echo site_url("admin/tags"); ?>" target="main-frame">查看tag</a></li>
					<li class="menu-item"><a href="<?php echo site_url("admin/tags/add"); ?>" target="main-frame">添加tag</a></li>
				</ul>
			</li>
			<li class="explode" key="08_tags" name="menu">
				文章管理
				<ul>
					<li class="menu-item"><a href="<?php echo site_url("admin/article"); ?>" target="main-frame">查看文章</a></li>
					<li class="menu-item"><a href="<?php echo site_url("admin/article/add"); ?>" target="main-frame">添加文章</a></li>
					<li class="menu-item"><a href="<?php echo site_url("admin/article/draft"); ?>" target="main-frame">草稿箱</a></li>
				</ul>
			</li>
			<li class="explode" key="09_tags" name="menu">
				统计
				<ul>
					<li class="menu-item"><a href="<?php echo site_url("admin/stats/keywords"); ?>" target="main-frame">查看搜索关键字</a></li>
				</ul>
			</li>
			<?php endif; ?>
		</ul>
	</div>
</div>
<script type="text/javascript" src="js/admin/global.js"></script>
<script type="text/javascript" src="js/admin/utils.js"></script>
<script type="text/javascript" src="js/admin/transport.js"></script>
<script language="JavaScript">
<!--
var collapse_all = "闭合";
var expand_all = "展开";
var collapse = true;

function toggleCollapse()
{
  var items = document.getElementsByTagName('LI');
  for (i = 0; i < items.length; i++)
  {
    if (collapse)
    {
      if (items[i].className == "explode")
      {
        toggleCollapseExpand(items[i], "collapse");
      }
    }
    else
    {
      if ( items[i].className == "collapse")
      {
        toggleCollapseExpand(items[i], "explode");
        ToggleHanlder.Reset();
      }
    }
  }

  collapse = !collapse;
  document.getElementById('toggleImg').src = collapse ? 'images/admin/menu_minus.gif' : 'images/admin/menu_plus.gif';
  document.getElementById('toggleImg').alt = collapse ? collapse_all : expand_all;
}

function toggleCollapseExpand(obj, status)
{
  if (obj.tagName.toLowerCase() == 'li' && obj.className != 'menu-item')
  {
    for (i = 0; i < obj.childNodes.length; i++)
    {
      if (obj.childNodes[i].tagName == "UL")
      {
        if (status == null)
        {
          if (obj.childNodes[1].style.display != "none")
          {
            obj.childNodes[1].style.display = "none";
            ToggleHanlder.RecordState(obj.getAttribute("key"), "collapse");
            obj.className = "collapse";
          }
          else
          {
            obj.childNodes[1].style.display = "block";
            ToggleHanlder.RecordState(obj.getAttribute("key"), "explode");
            obj.className = "explode";
          }
          break;
        }
        else
        {
          if( status == "collapse")
          {
            ToggleHanlder.RecordState(obj.getAttribute("key"), "collapse");
            obj.className = "collapse";
          }
          else
          {
            ToggleHanlder.RecordState(obj.getAttribute("key"), "explode");
            obj.className = "explode";
          }
          obj.childNodes[1].style.display = (status == "explode") ? "block" : "none";
        }
      }
    }
  }
}
document.getElementById('menu-list').onclick = function(e)
{
  var obj = Utils.srcElement(e);
  toggleCollapseExpand(obj);
}

document.getElementById('tabbar-div').onmouseover=function(e)
{
  var obj = Utils.srcElement(e);

  if (obj.className == "tab-back")
  {
    obj.className = "tab-hover";
  }
}

document.getElementById('tabbar-div').onmouseout=function(e)
{
  var obj = Utils.srcElement(e);

  if (obj.className == "tab-hover")
  {
    obj.className = "tab-back";
  }
}

document.getElementById('tabbar-div').onclick=function(e)
{
  var obj = Utils.srcElement(e);

 // var mnuTab = document.getElementById('menu-tab');
  var mnuDiv = document.getElementById('menu-list');

  //if (obj.id == 'menu-tab')
//  {
//    mnuTab.className = 'tab-front';
//    hlpTab.className = 'tab-back';
//    mnuDiv.style.display = "block";
//    hlpDiv.style.display = "none";
//  }
}

/**
 * 创建XML对象
 */
function createDocument()
{
  var xmlDoc;

  // create a DOM object
  if (window.ActiveXObject)
  {
    try
    {
      xmlDoc = new ActiveXObject("Msxml2.DOMDocument.6.0");
    }
    catch (e)
    {
      try
      {
        xmlDoc = new ActiveXObject("Msxml2.DOMDocument.5.0");
      }
      catch (e)
      {
        try
        {
          xmlDoc = new ActiveXObject("Msxml2.DOMDocument.4.0");
        }
        catch (e)
        {
          try
          {
            xmlDoc = new ActiveXObject("Msxml2.DOMDocument.3.0");
          }
          catch (e)
          {
            alert(e.message);
          }
        }
      }
    }
  }
  else
  {
    if (document.implementation && document.implementation.createDocument)
    {
      xmlDoc = document.implementation.createDocument("","doc",null);
    }
    else
    {
      alert("Create XML object is failed.");
    }
  }
  xmlDoc.async = false;

  return xmlDoc;
}

//菜单展合状态处理器
var ToggleHanlder = new Object();

Object.extend(ToggleHanlder ,{
  SourceObject : new Object(),
  CookieName   : 'Toggle_State',
  RecordState : function(name,state)
  {
    if(state == "collapse")
    {
      this.SourceObject[name] = state;
    }
    else
    {
      if(this.SourceObject[name])
      {
        delete(this.SourceObject[name]);
      }
    }
    var date = new Date();
    date.setTime(date.getTime() + 99999999);
    document.setCookie(this.CookieName, this.SourceObject.toJSONString(), date.toGMTString());
  },

  Reset :function()
  {
    var date = new Date();
    date.setTime(date.getTime() + 99999999);
    document.setCookie(this.CookieName, "{}" , date.toGMTString());
  },

  Load : function()
  {
    if (document.getCookie(this.CookieName) != null)
    {
      this.SourceObject = eval("("+ document.getCookie(this.CookieName) +")");
      var items = document.getElementsByTagName('LI');
      for (var i = 0; i < items.length; i++)
      {
        if ( items[0].getAttribute("name") == "menu")
        {
          for (var k in this.SourceObject)
          {
            if ( typeof(items[i]) == "object")
            {
              if (items[i].getAttribute('key') == k)
              {
                toggleCollapseExpand(items[i], this.SourceObject[k]);
                collapse = false;
              }
            }
          }
        }
     }
    }
    document.getElementById('toggleImg').src = collapse ? 'images/admin/menu_minus.gif' : 'images/admin/menu_plus.gif';
    document.getElementById('toggleImg').alt = collapse ? collapse_all : expand_all;
  }
});

ToggleHanlder.CookieName += "_1";
//初始化菜单状态
ToggleHanlder.Load();

//-->
</script>