<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="google-site-verification" content="CmIkFL0fe-8rD2sopBwU--rsiY6LpL7KEeL25jX73tY" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> <?php echo (isset($meta_title) && !empty($meta_title)) ? ($meta_title == 'contactus')? '联系我们' : $meta_title : '尼德教育 - 学科学习咨询 成长咨询 学科辅导 一对一-个性化辅导-家教-N对一-课外辅导-辅导班-小学家教-初中家教-高中家教-小学课外辅导-初中课外辅导-高中课外辅导'; ?></title>
<meta name="keywords" content="尼德,尼德教育,一对一-个性化辅导,家教,N对一,课外辅导,辅导班,小学家教,初中家教,高中家教,小学课外辅导,初中课外辅导,高中课外辅导" />
<meta name="description" content="尼德,尼德教育,一对一-个性化辅导,家教,N对一,课外辅导,辅导班,小学家教,初中家教,高中家教,小学课外辅导,初中课外辅导,高中课外辅导" />
<meta name="subscrition " content="尼德,尼德教育,一对一-个性化辅导,家教,N对一,课外辅导,辅导班,小学家教,初中家教,高中家教,小学课外辅导,初中课外辅导,高中课外辅导" />
<base href="<?php echo base_url() ?>" />
<link href="images/css.css" rel="stylesheet" type="text/css" />
<SCRIPT src="js/ajax.js" type="text/javascript"></SCRIPT>
<SCRIPT src="js/js.js" type="text/javascript"></SCRIPT>
<script>
<!--

site_url = '<?php echo site_url();?>';
base_url = '<?php echo base_url();?>';
thisURL = '<?php echo $_SERVER['REQUEST_URI'];?>';

/*第一种形式 第二种形式 更换显示样式*/
function setTab(name,cursel,n){
for(i=1;i<=n;i++){
var menu=document.getElementById(name+i);
var con=document.getElementById("con_"+name+"_"+i);
menu.className=i==cursel?"hover":"";
con.style.display=i==cursel?"block":"none";
}
}
//-->
</script>

<?php
//Load Google Map API:
if(isset($meta_title) && $meta_title == 'contactus'):
?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=zh-CN"></script>
<script type="text/javascript">

function initialize() { 
    var latlng = new google.maps.LatLng(39.97720, 116.30580); 
    var myOptions = { 
      zoom: 16, 
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP 
    }; 
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions); 

	var infowindow = new google.maps.InfoWindow();
	infowindow.setContent('<table width="228px" border="0" cellpadding="0" cellspacing="0"><tr align="left"><td colspan="2"><a target="_blank" href="http://ditu.google.cn/maps/place?cid=9231005487692207063&amp;q=%E5%8C%97%E4%BA%AC%E7%BB%B4%E4%BA%9A%E5%A4%A7%E5%8E%A6&amp;hl=zh-CN&amp;cd=1&amp;cad=src:ppiwlink&amp;ei=Qb41TOWjCtiHkAXZuZWIAQ"><font style="color:#0000CC;font-size:123%;font-weight:bold">维亚大厦</font></a></td></tr><tr align="left"><td valign="TOP"><font style="color:#000000;font-size:13px">邮政编码: 100080<br/>北京海淀区苏州街29号</font></a></td><td align="right"><img border="0" alt="照片" src="http://lh4.ggpht.com/3eNjV2sMlCzlMpE5hawbZo9LpdcXxZyxrFdLMpBLUFY0H7-1zN3l1ChEpkjj8Apa0WasIPCkgqif6j8VqrcCANwleW2r-YiX-w-_8SiBmva2Ac0xRRiNp6ojc-s82NYaWw"></td></tr></table>');
	infowindow.setPosition(latlng);
	infowindow.open(map);
	
	var marker = new google.maps.Marker({ 
      position: latlng,  
      map: map,  
      title:"尼德教育" 
	});
}

window.onload = function() 
{ 
	initialize(); 
} 
</script>
<?php
//Load Google Map API END.
endif;
?>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-16932864-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="261"><img src="images/logo.gif" width="261" height="88" alt="<?php echo SITE_NAME; ?>" /></td>
        <td align="right" valign="top" background="images/top_03.jpg" style="background-position:left; background-repeat:no-repeat">
		  <table width="270" border="0" cellpadding="0" cellspacing="0" class="font_gray" style="margin-top:6px; margin-right:6px;">
          <tr>
            <td align="right"><img src="images/index7_07.jpg" width="10" height="9" alt="<?php echo SITE_NAME; ?>" /> <span style="CURSOR: hand" onClick="window.external.addFavorite('http://www.ndedu.org','尼德教育')" title="尼德教育">加入收藏</span></td>
            <td align="right"><img src="images/index7_07.jpg" width="10" height="9" alt="<?php echo SITE_NAME; ?>" /> <span onclick="var strHref=window.location.href;this.style.behavior='url(#default#homepage)';this.setHomePage('http://www.ndedu.org');" style="CURSOR: hand">设为首页</span></td>
            <td align="center"><img src="images/index7_07.jpg" width="10" height="9" alt="<?php echo SITE_NAME; ?>" /> <a href="<?php echo site_url('user/login') ?>">学习成长档案</a></td>
          </tr>
        </table></td>
      </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="68" align="center" valign="top" background="images/index_06.jpg"><table width="960" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="36">
<div id="slidingBlock">
<script language="javascript">
  function switchmodTag(modtag,modcontent,modk) {
    for(i=1; i <8; i++) {
      if (i==modk) {
        document.getElementById(modtag+i).className="menuOn";document.getElementById(modcontent+i).className="slidingList";}
      else {
        document.getElementById(modtag+i).className="menuNo";document.getElementById(modcontent+i).className="slidingList_none";}
    }
  }
</script><div id="nav_box">
<?php $nav_menu_id = (isset($nav_menu_id) && !empty($nav_menu_id)) ? $nav_menu_id : 1; ?>
<h4 class="<?php echo ($nav_menu_id == 1) ? 'menuOn' : 'menuNo'; ?>" id="mod1" onmouseover="switchmodTag('mod','slidingList','1');this.blur();">
<a href="<?php echo site_url('') ?>">首页</a></h4><div id="line"></div>
<h4 class="<?php echo ($nav_menu_id == 2) ? 'menuOn' : 'menuNo'; ?>" id="mod2" onmouseover="switchmodTag('mod','slidingList','2');this.blur();">
<a href="<?php echo site_url('goldenLearningPlan') ?>">黄金学习规划</a></h4><div id="line"></div>
<h4 class="<?php echo ($nav_menu_id == 3) ? 'menuOn' : 'menuNo'; ?>" id="mod3" onmouseover="switchmodTag('mod','slidingList','3');this.blur();">
<a href="<?php echo site_url('multiSubjectTutorial') ?>">多元化学科辅导</a></h4><div id="line"></div>
<h4 class="<?php echo ($nav_menu_id == 4) ? 'menuOn' : 'menuNo'; ?>" id="mod4" onmouseover="switchmodTag('mod','slidingList','4');this.blur();">
<a href="<?php echo site_url('planEffect') ?>">辅导效果</a></h4><div id="line"></div>
<h4 class="<?php echo ($nav_menu_id == 5) ? 'menuOn' : 'menuNo'; ?>" id="mod5" onmouseover="switchmodTag('mod','slidingList','5');this.blur();">
<a href="<?php echo site_url('synBasis') ?>">课程设置</a></h4><div id="line"></div>
<h4 class="<?php echo ($nav_menu_id == 6) ? 'menuOn' : 'menuNo'; ?>" id="mod6" onmouseover="switchmodTag('mod','slidingList','6');this.blur();">
<a href="<?php echo site_url('aboutUs') ?>">关于尼德</a></h4><div id="line"></div>
<h4 class="<?php echo ($nav_menu_id == 7) ? 'menuOn' : 'menuNo'; ?>" id="mod7" onmouseover="switchmodTag('mod','slidingList','7');this.blur();">
<a href="<?php echo site_url('contactUs') ?>">联系我们</a></a></h4><div id="line"></div></div>
<div class="<?php echo ($nav_menu_id == 1) ? 'slidingList' : 'slidingList_none'; ?>" id="slidingList1">
<ul>
</ul>
</div>
<div class="<?php echo ($nav_menu_id == 2) ? 'slidingList' : 'slidingList_none'; ?>" id="slidingList2">
<ul>
<li > <a href="<?php echo site_url('goldenLearningPlan') ?>">黄金学习规划</a></li>
<li > <a href="<?php echo site_url('1v1testing') ?>">一对一测评</a></li>
<li > <a href="<?php echo site_url('1v1interview') ?>">一对一访谈</a></li>
<li > <a href="<?php echo site_url('personalFiles') ?>">个性化成长档案</a></li>
</ul>
</div>
<div class="<?php echo ($nav_menu_id == 3) ? 'slidingList' : 'slidingList_none'; ?>" id="slidingList3">
<ul>
<li style="margin-left:30px;"> <a href="<?php echo site_url('multiSubjectTutorial') ?>">多元化学科辅导</a></li>
<li> <a href="<?php echo site_url('tutorialFlow') ?>">辅导流程</a></li>
<li> <a href="<?php echo site_url('internationalTrusteeship') ?>">学后国际化托管</a></li>
<li> <a href="<?php echo site_url('studyGroup') ?>">团体研究性学习</a></li>
<li> <a href="<?php echo site_url('nv1Tutorial') ?>">多对一纯学科辅导</a></li>
</ul>
</div>
<div class="<?php echo ($nav_menu_id == 4) ? 'slidingList' : 'slidingList_none'; ?>" id="slidingList4">
<ul>
<li style="margin-left:180px;"> <a href="<?php echo site_url('planEffect') ?>">规划效果</a></li>
<li> <a href="<?php echo site_url('improveScore') ?>">成绩提升</a></li>
<li> <a href="<?php echo site_url('graduateRate') ?>">升学比率</a></li>
<li> <a href="<?php echo site_url('learningAbility') ?>">学习能力</a></li>
<li> <a href="<?php echo site_url('growingAbility') ?>">成长力</a></li>
<li> <a href="<?php echo site_url('successfulMembers') ?>">成功学员</a></li>
</ul>
</div>
<div class="<?php echo ($nav_menu_id == 5) ? 'slidingList' : 'slidingList_none'; ?>" id="slidingList5">
<ul>
<li> <a href="<?php echo site_url('synBasis') ?>" style="margin-left:300px;">同步基础</a></li>
<li> <a href="<?php echo site_url('advancedImprove') ?>">拔高冲刺</a></li>
<li> <a href="<?php echo site_url('goldenConnect') ?>">黄金衔接</a></li>
<li> <a href="<?php echo site_url('specialModule') ?>">专题模块</a></li>
<li> <a href="<?php echo site_url('valueGrowth') ?>">成长增值</a></li>
</ul>
</div><div class="<?php echo ($nav_menu_id == 6) ? 'slidingList' : 'slidingList_none'; ?>" id="slidingList6">
<ul>
<li style="margin-left:420px;"> <a href="<?php echo site_url('aboutUs') ?>">尼德简介</a></li>
<li> <a href="<?php echo site_url('advantage') ?>">尼德优势</a></li>
<li> <a href="<?php echo site_url('team') ?>">师资团队</a></li>
<li> <a href="<?php echo site_url('gallery') ?>">尼德图集</a></li>
<li> <a href="<?php echo site_url('jobs') ?>">招贤纳士</a></li>
</ul>
</div><div class="<?php echo ($nav_menu_id == 7) ? 'slidingList' : 'slidingList_none'; ?>" id="slidingList7">
<ul>
</ul>
</div>
</div>
		</td>
        <td width="160" align="right" valign="top">
			<table width="160" border="0" cellspacing="0" cellpadding="0" style="margin-top:6px;">
			<form name="search" action="<?php echo site_url().'/article/search/'?>" method="post">
			  <tr>
				<td width="120" height="21" align="left" background="images/index_16.jpg" style="background-repeat:no-repeat; background-position:left"><input name="keyword" type="text" value="快乐提高成绩" class="input_serch" onfocus="if (value =='快乐提高成绩'){value =''}" onblur="if (value ==''){value='快乐提高成绩'}"/></td>
				<td align="center"><input type="image" name="submit" align="bottom" src="images/index_17.jpg"></td>
			  </tr>

			</form>
			</table>
		</td>
      </tr>
    </table>
    </td>
  </tr>
</table>