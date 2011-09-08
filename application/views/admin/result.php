<html>
<head>
<script language="javascript">
    var start = 5; 
	function GoTo()
	{
		if(start == 1)
		{
			document.getElementById('second').innerHTML = start;
			window.location= '<?php echo site_url($page) ?>';
		}
		else
		{
			start=start-1;
			document.getElementById('second').innerHTML = start;
			setTimeout( 'GoTo() ',1000);
		}
	}

	window.onload = function()
	{
		setTimeout( "GoTo() ",1000);
	}
</script>
</head>
<div>
	<span id="second">5</span>秒后会刷新页面，或者请点击链接：<a href="<?php echo site_url($page) ?>">返回</a>
</div>
<div>
<?php
	if(!empty($notification))
	{
		echo '<font color="green">';
		if(is_array($notification))
		{
			foreach($notification as $one_notification)
				echo get_language('guestbook, article_category, admin', 'cn', $notification).'<br/>';
		}
		else
		{
			echo get_language('guestbook, article_category, admin', 'cn', $notification);
		}
			
		echo '</font>';
	}
?>
</div>
