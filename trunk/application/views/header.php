<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="google-site-verification" content="CmIkFL0fe-8rD2sopBwU--rsiY6LpL7KEeL25jX73tY" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo (isset($meta_title) && !empty($meta_title)) ? $meta_title . ' - 你的教育': '你的教育，真正一对一个性化辅导，100%一线重点学校专职教师任教，100%个性化VIP小班设置，100%教育界资深人士管理。'; ?></title>
<meta name="keywords" content="<?php echo (isset($meta_keywords) && !empty($meta_keywords)) ? $meta_keywords : '你的教育，真正一对一个性化辅导，100%一线重点学校专职教师任教，100%个性化VIP小班设置，100%教育界资深人士管理。'; ?>" />
<meta name="description" content="<?php echo (isset($meta_description) && !empty($meta_description)) ? $meta_description : '你的教育，真正一对一个性化辅导，100%一线重点学校专职教师任教，100%个性化VIP小班设置，100%教育界资深人士管理。'; ?>" />
<meta name="subscrition " content="你的教育，北京最好的一对一个性化辅导机构，100%一线重点学校专职教师任教，100%个性化VIP小班设置，100%教育界资深人士管理。" />
<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo site_url('rss');?>" />
<base href="<?php echo base_url() ?>" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/x-icon"/>
<link rel="icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/x-icon"/>
<link href="images/css.css" rel="stylesheet" type="text/css" />
<?php if(isset($css_file) && !empty($css_file)):?>
	<?php 
	if(is_array($css_file)): 
		foreach($css_file as $css)
			echo '<link href="css/'.$css.'" rel="stylesheet" type="text/css" />';
	else: ?>
	<link href="css/<?php echo $css_file ?>" rel="stylesheet" type="text/css" />
	<?php endif; ?>
<?php endif;?>

<script>
<!--
site_url = '<?php echo site_url();?>';
base_url = '<?php echo base_url();?>';
thisURL = '<?php echo $_SERVER['REQUEST_URI'];?>';
-->
</script>

<!--
<?php
//Load Google Map API:
if(isset($load_google_map) && $load_google_map):
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
      title:"你的教育" 
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
-->

<?php if(IS_ONLINE): ?>
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
<script type="text/javascript">
	var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
	document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F115dea2941c3b5ea5c80d9febd4534fb' type='text/javascript'%3E%3C/script%3E"));
</script>
<?php endif; ?>
</head>
<body>
<?php if( !(isset($no_header) && $no_header)): ?>
<div class="promo_image">
	<a href="<?php echo site_url('robot') ?>" target="_blank"><img src="images/adc.jpg" width="930" height="120" alt="<?php echo SITE_NAME; ?>" /></a>
</div>
<div id="mini_nav">
	<div class="font_12_18">
		<a href="javascript:void(0);" onclick="SetHome(this,window.location)" style="CURSOR: hand">设为首页</a>
		<a href="<?php echo site_url('children') ?>" target="_blank">你的早教</a>
		<a href="<?php echo site_url('userGrowth') ?>" target="_blank">学习成长档案</a>
		<a href="<?php echo site_url('topGrowth') ?>" target="_blank">精英成长计划</a>
	</div>
</div>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="261"><img src="images/logo.gif" width="261" height="88" alt="<?php echo SITE_NAME; ?>" /></td>
        <td align="left" valign="bottom" background="images/top_03.jpg"><img src="images/icon/hot.gif" style="margin-left:30px"/></td>
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
    for(i=1; i < 10; i++) {
      if (i==modk) {
        document.getElementById(modtag+i).className="menuOn";document.getElementById(modcontent+i).className="slidingList";}
      else {
        document.getElementById(modtag+i).className="menuNo";document.getElementById(modcontent+i).className="slidingList_none";}
    }
  }
</script>
<div id="nav_box">
	<?php $nav_menu_id = (isset($nav_menu_id) && !empty($nav_menu_id)) ? $nav_menu_id : 1; ?>
	<h4 class="<?php echo ($nav_menu_id == 1) ? 'menuOn' : 'menuNo'; ?>" id="mod1" onmouseover="switchmodTag('mod','slidingList','1');this.blur();"><a href="<?php echo site_url('') ?>">首页</a></h4>
	<div id="line"></div>
	<h4 class="<?php echo ($nav_menu_id == 2) ? 'menuOn' : 'menuNo'; ?>" id="mod2" onmouseover="switchmodTag('mod','slidingList','2');this.blur();"><a href="<?php echo site_url('goldenLearningPlan') ?>">私人教育顾问</a></h4>
	<div id="line"></div>
	<h4 class="<?php echo ($nav_menu_id == 8) ? 'menuOn' : 'menuNo'; ?>" id="mod8" onmouseover="switchmodTag('mod','slidingList','8');this.blur();"><a href="<?php echo site_url('cp/detail/1') ?>">全方位测评</a></h4>
	<div id="line"></div>
	<h4 class="<?php echo ($nav_menu_id == 3) ? 'menuOn' : 'menuNo'; ?>" id="mod3" onmouseover="switchmodTag('mod','slidingList','3');this.blur();" style="width:125px;"><a href="<?php echo site_url('multiSubjectTutorial') ?>">一对一多元化辅导</a></h4>
	<div id="line"></div>
	<h4 class="<?php echo ($nav_menu_id == 4) ? 'menuOn' : 'menuNo'; ?>" id="mod4" onmouseover="switchmodTag('mod','slidingList','4');this.blur();"><a href="<?php echo site_url('planEffect') ?>">辅导效果</a></h4>
	<div id="line"></div>
	<h4 class="<?php echo ($nav_menu_id == 5) ? 'menuOn' : 'menuNo'; ?>" id="mod5" onmouseover="switchmodTag('mod','slidingList','5');this.blur();"><a href="<?php echo site_url('synBasis') ?>">课程设置</a></h4>
	<div id="line"></div>
	<h4 class="<?php echo ($nav_menu_id == 9) ? 'menuOn' : 'menuNo'; ?>" id="mod9" onmouseover="switchmodTag('mod','slidingList','9');this.blur();"><a href="<?php echo site_url('teacher') ?>">名师风采</a></h4>
	<div id="line"></div>
	<h4 class="<?php echo ($nav_menu_id == 6) ? 'menuOn' : 'menuNo'; ?>" id="mod6" onmouseover="switchmodTag('mod','slidingList','6');this.blur();"><a href="<?php echo site_url('school') ?>">你的学堂</a></h4>
	<div id="line"></div>
	<h4 class="<?php echo ($nav_menu_id == 7) ? 'menuOn' : 'menuNo'; ?>" id="mod7" onmouseover="switchmodTag('mod','slidingList','7');this.blur();"><a href="<?php echo site_url('aboutUs') ?>">关于你的</a></a></h4>
	<div id="line"></div>
</div>
<div class="<?php echo ($nav_menu_id == 1) ? 'slidingList' : 'slidingList_none'; ?>" id="slidingList1">
<ul></ul>
</div>
<?php $CI =& get_instance();?>
<div class="<?php echo ($nav_menu_id == 2) ? 'slidingList' : 'slidingList_none'; ?>" id="slidingList2">
<ul>
<li > <a href="<?php echo site_url('goldenLearningPlan') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'goldenLearningPlan') ? 'slidingBlock_hover' : '';?>">黄金学习规划</font></a></li>
<li > <a href="<?php echo site_url('1v1testing') ?>"><font class="<?php echo ($CI->uri->segment(1) == '1v1testing') ? 'slidingBlock_hover' : '';?>">一对一测评</font></a></li>
<li > <a href="<?php echo site_url('1v1interview') ?>"><font class="<?php echo ($CI->uri->segment(1) == '1v1interview') ? 'slidingBlock_hover' : '';?>">一对一访谈</font></a></li>
<li > <a href="<?php echo site_url('personalFiles') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'personalFiles') ? 'slidingBlock_hover' : '';?>">个性化成长档案</font></a></li>
</ul>
</div>
<div class="<?php echo ($nav_menu_id == 8) ? 'slidingList' : 'slidingList_none'; ?>" id="slidingList8">
<ul>
<li style="margin-left:80px;"> <a href="<?php echo site_url('cp/detail/1') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'cp' && $CI->uri->segment(2) == 'detail' && $CI->uri->segment(3) == '1') ? 'slidingBlock_hover' : '';?>">小学生素养</font></a></li>
<li > <a href="<?php echo site_url('cp/detail/2') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'cp' && $CI->uri->segment(2) == 'detail' && $CI->uri->segment(3) == '2') ? 'slidingBlock_hover' : '';?>">初中应试</font></a></li>
<li > <a href="<?php echo site_url('cp/detail/3') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'cp' && $CI->uri->segment(2) == 'detail' && $CI->uri->segment(3) == '3') ? 'slidingBlock_hover' : '';?>">高中应试</font></a></li>
<li > <a href="<?php echo site_url('cp/detail/4') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'cp' && $CI->uri->segment(2) == 'detail' && $CI->uri->segment(3) == '4') ? 'slidingBlock_hover' : '';?>">高考状态</font></a></li>
<li > <a href="<?php echo site_url('cp/detail/5') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'cp' && $CI->uri->segment(2) == 'detail' && $CI->uri->segment(3) == '5') ? 'slidingBlock_hover' : '';?>">专业选择</font></a></li>
<li > <a href="<?php echo site_url('promo') ?>" target="_blank"><font">促销组合</font></a></li>
</ul>
</div>
<div class="<?php echo ($nav_menu_id == 3) ? 'slidingList' : 'slidingList_none'; ?>" id="slidingList3">
<ul>
<li style="margin-left:100px;"> <a href="<?php echo site_url('multiSubjectTutorial') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'multiSubjectTutorial') ? 'slidingBlock_hover' : '';?>">多元化学科辅导</font></a></li>
<li> <a href="<?php echo site_url('tutorialFlow') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'tutorialFlow') ? 'slidingBlock_hover' : '';?>">辅导流程</font></a></li>
<li> <a href="<?php echo site_url('internationalTrusteeship') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'internationalTrusteeship') ? 'slidingBlock_hover' : '';?>">学后国际化托管</font></a></li>
<li> <a href="<?php echo site_url('studyGroup') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'studyGroup') ? 'slidingBlock_hover' : '';?>">团体研究性学习</font></a></li>
<li> <a href="<?php echo site_url('nv1Tutorial') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'nv1Tutorial') ? 'slidingBlock_hover' : '';?>">多对一纯学科辅导</font></a></li>
</ul>
</div>
<div class="<?php echo ($nav_menu_id == 4) ? 'slidingList' : 'slidingList_none'; ?>" id="slidingList4">
<ul>
<li style="margin-left:280px;"> <a href="<?php echo site_url('planEffect') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'planEffect') ? 'slidingBlock_hover' : '';?>">规划效果</font></a></li>
<li> <a href="<?php echo site_url('improveScore') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'improveScore') ? 'slidingBlock_hover' : '';?>">成绩提升</font></a></li>
<li> <a href="<?php echo site_url('graduateRate') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'graduateRate') ? 'slidingBlock_hover' : '';?>">升学比率</font></a></li>
<li> <a href="<?php echo site_url('learningAbility') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'learningAbility') ? 'slidingBlock_hover' : '';?>">学习能力</font></a></li>
<li> <a href="<?php echo site_url('growingAbility') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'growingAbility') ? 'slidingBlock_hover' : '';?>">成长力</font></a></li>
<li> <a href="<?php echo site_url('successfulMembers') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'successfulMembers') ? 'slidingBlock_hover' : '';?>">成功学员</font></a></li>
</ul>
</div>
<div class="<?php echo ($nav_menu_id == 5) ? 'slidingList' : 'slidingList_none'; ?>" id="slidingList5">
<ul>
<li style="margin-left:400px;"> <a href="<?php echo site_url('synBasis') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'synBasis') ? 'slidingBlock_hover' : '';?>">同步基础</font></a></li>
<li> <a href="<?php echo site_url('advancedImprove') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'advancedImprove') ? 'slidingBlock_hover' : '';?>">拔高冲刺</font></a></li>
<li> <a href="<?php echo site_url('goldenConnect') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'goldenConnect') ? 'slidingBlock_hover' : '';?>">黄金衔接</font></a></li>
<li> <a href="<?php echo site_url('specialModule') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'specialModule') ? 'slidingBlock_hover' : '';?>">专题模块</font></a></li>
<li> <a href="<?php echo site_url('valueGrowth') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'valueGrowth') ? 'slidingBlock_hover' : '';?>">学习素养</font></a></li>
</ul>
</div>
<div class="<?php echo ($nav_menu_id == 9) ? 'slidingList' : 'slidingList_none'; ?>" id="slidingList9">
<ul>
<li style="margin-left:580px;"> <a href="<?php echo site_url('teacher') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'teacher') ? 'slidingBlock_hover' : '';?>">师资团队</font></a></li>
<li > <a href="<?php echo site_url('team') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'team') ? 'slidingBlock_hover' : '';?>">师资来源</font></a></li>
<li > <a href="<?php echo site_url('gallery') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'gallery') ? 'slidingBlock_hover' : '';?>">你的图集</font></a></li>
</ul>
</div>
<div class="<?php echo ($nav_menu_id == 6) ? 'slidingList' : 'slidingList_none'; ?>" id="slidingList6">
<ul>
<li style="margin-left:620px;"> <a href="<?php echo site_url('school') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'school' && $CI->uri->segment(2) == false) ? 'slidingBlock_hover' : '';?>">教育文章</font></a></li>
<li> <a href="<?php echo site_url('school/book') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'school' && $CI->uri->segment(2) == 'book') ? 'slidingBlock_hover' : '';?>">精品图书</font></a></li>
<li> <a href="<?php echo site_url('school/vedio') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'school' && $CI->uri->segment(2) == 'vedio') ? 'slidingBlock_hover' : '';?>">教育影视</font></a></li>
<li> <a href="<?php echo site_url('school/software') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'school' && $CI->uri->segment(2) == 'software') ? 'slidingBlock_hover' : '';?>">教育软件</font></a></li>
</ul>
</div>
<div class="<?php echo ($nav_menu_id == 7) ? 'slidingList' : 'slidingList_none'; ?>" id="slidingList7">
<ul>
<li style="margin-left:670px;"> <a href="<?php echo site_url('aboutUs') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'aboutUs') ? 'slidingBlock_hover' : '';?>">你的简介</font></a></li>
<li> <a href="<?php echo site_url('advantage') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'advantage') ? 'slidingBlock_hover' : '';?>">你的优势</font></a></li>
<li> <a href="<?php echo site_url('jobs') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'jobs') ? 'slidingBlock_hover' : '';?>">招贤纳士</font></a></li>
<li> <a href="<?php echo site_url('contactUs') ?>"><font class="<?php echo ($CI->uri->segment(1) == 'contactUs') ? 'slidingBlock_hover' : '';?>">联系我们</font></a></li>
</ul>
</div>
</div>
		</td>
      </tr>
    </table>
    </td>
  </tr>
</table>
<?php endif; ?>