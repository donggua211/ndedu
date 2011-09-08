<?php if( !(isset($no_footer) && $no_footer)): ?>
<div align="center" style="margin-top:10px;clear:both">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border-top:1px solid #dbdbdb">
  <tr>
    <td height="67" align="center" valign="top" background="images/hjxxgh_56.jpg" class="font_gray" style="padding-top:8px; background-position:top; background-repeat:repeat-x">
		<a href="<?php echo site_url('children') ?>" target="_parent">尼德早教</a> &nbsp;|&nbsp; 
		<a href="<?php echo site_url('userGrowth') ?>" target="_parent">学习成长档案</a> &nbsp;|&nbsp; 
		<a href="<?php echo site_url('topGrowth') ?>" target="_parent">精英成长计划</a> &nbsp;|&nbsp; 
		<a href="<?php echo site_url('aboutUs') ?>" target="_parent">关于我们</a>  &nbsp;|&nbsp; 
		<a href="<?php echo site_url('contactUs') ?>" target="_parent">联系我们</a> &nbsp;|&nbsp; 
		<a href="<?php echo site_url('siteMap') ?>" target="_parent">网站地图</a><br/>
		Copyright 2006-2010  www.ndedu.org All Right Reserved<br/>
		版权所有：北京尼德成长教育科技有限公司  <a href="http://www.miibeian.gov.cn/">京ICP备 10053869号</a>
	</td>
  </tr>
</table>
</div>
<?php endif; ?>
<SCRIPT src="js/ajax.js" type="text/javascript"></SCRIPT>
<SCRIPT src="js/common.js" type="text/javascript"></SCRIPT>
<?php if(isset($load_register_js)&&$load_register_js): ?>
<SCRIPT src="js/privince.js" type="text/javascript"></SCRIPT>
<SCRIPT src="js/register.js" type="text/javascript"></SCRIPT>
<?php endif; ?>
<?php if(isset($js_file) && !empty($js_file)):?>
	<?php 
	if(is_array($js_file)): 
		foreach($js_file as $js)
			echo '<script type="text/javascript" src="js/'.$js.'"></script>';
	else: ?>
	<script type="text/javascript" src="js/<?php echo $js_file ?>"></script>
	<?php endif; ?>
<?php endif;?>
<?php if(IS_ONLINE && !(isset($no_baidu) && $no_baidu)): ?>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F115dea2941c3b5ea5c80d9febd4534fb' type='text/javascript'%3E%3C/script%3E"));
</script>
<?php endif; ?>
</body>
</html>