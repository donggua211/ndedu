<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="google-site-verification" content="CmIkFL0fe-8rD2sopBwU--rsiY6LpL7KEeL25jX73tY" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo (isset($meta_title) && !empty($meta_title)) ? $meta_title . ' - 恒正尚康': '恒正尚康'; ?></title>
<meta name="keywords" content="<?php echo (isset($meta_keywords) && !empty($meta_keywords)) ? $meta_keywords : '恒正尚康'; ?>" />
<meta name="description" content="<?php echo (isset($meta_description) && !empty($meta_description)) ? $meta_description : '恒正尚康'; ?>" />
<meta name="subscrition " content="恒正尚康" />
<base href="<?php echo base_url() ?>" />
<link href="css/css.css" rel="stylesheet" type="text/css" />
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
</head>
<body>
<div class="header">
	<img src="images/header.jpg">
</div>
<div class="nav_wrap">
	<div class="nav">
		<ul id="nav_ul">
			<?php if(!isset($nav_menu_id) || empty($nav_menu_id)) $nav_menu_id = 1; ?>
			<li <?php echo ($nav_menu_id == 1) ? 'class="cover"' : ''; ?> onmouseover="switch_tag('nav_ul', 0)"><a href="<?php echo site_url(); ?>">首页</a></li>
			<li <?php echo ($nav_menu_id == 2) ? 'class="cover"' : ''; ?> onmouseover="switch_tag('nav_ul', 1)"><a href="<?php echo site_url('product'); ?>">产品与服务</a></li>
			<li <?php echo ($nav_menu_id == 3) ? 'class="cover"' : ''; ?> onmouseover="switch_tag('nav_ul', 2)"><a href="<?php echo site_url(); ?>">在线商城</a></li>
			<li <?php echo ($nav_menu_id == 4) ? 'class="cover"' : ''; ?> onmouseover="switch_tag('nav_ul', 3)"><a href="<?php echo site_url('aboutus'); ?>">关于我们</a></li>
			<li <?php echo ($nav_menu_id == 5) ? 'class="cover"' : ''; ?> onmouseover="switch_tag('nav_ul', 4)"><a href="<?php echo site_url('contactus'); ?>">联系我们</a></li>
		</ul>
		<div class="fav">
			<img src="images/icon/star.gif"> 
			<a href="javascript:void(0);" onclick="SetHome(this,window.location)">设为首页</a>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<div class="index_center">
	<table align="center" border=0 cellpadding=0 cellspacing=0 >
		<tr>
			<?php if(isset($show_flash) && $show_flash == 1): ?>
			<td><img src="images/index_image_left.jpg"/></td>
			<td align="center" valign="bottom" bgcolor="#FFFFFF" width="960px" height="310px">
				<div id="main_flash"><img src="images/banner_1.jpg" width="954px" height="307px"/></div>
			</td>
			<td><img src="images/index_image_right.jpg"/></td>
			<?php else: ?>
			<td><img src="images/product_image_left.jpg"/></td>
			<td align="center" valign="bottom" bgcolor="#FFFFFF" width="960px" height="250px">
				<div id="main_flash"><img src="images/banner_product_index.jpg" width="954px" height="247px"/></div>
			</td>
			<td><img src="images/product_image_right.jpg"/></td>
			<?php endif; ?>
		</tr>
	</table>
</div>

<?php if(isset($show_flash) && $show_flash == 1): ?>
<script  src="js/swfobject_source.js" type=text/javascript></script>
<script type=text/javascript>
var s1 = new SWFObject("<?php echo base_url() ?>images/flash/focusFlash_fp.swf", "mymovie1", "955", "272", "3", "#ffffff");
s1.addParam("wmode", "transparent");
s1.addParam("AllowscriptAccess", "sameDomain");
s1.addVariable("bigSrc", "images/banner_1.jpg|images/banner_2.jpg|images/banner_3.jpg");
s1.addVariable("smallSrc", "");
s1.addVariable("href", "<?php echo site_url('children') ?>|<?php echo site_url('children/advantage') ?>|<?php echo site_url('children/parrent') ?>");
s1.addVariable("txt", "1|2|3");
s1.addVariable("width", "955");
s1.addVariable("height", "272");
s1.write("main_flash");
</script>
<?php endif; ?>

<div class="main">
