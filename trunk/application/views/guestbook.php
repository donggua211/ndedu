<?php 
	if(!empty($notification))
	{
?>
		<div>
			<b><?php echo get_language('guestbook', 'cn', $notification) ?></b>
		</div>
<?php
	}
?>
<div>
	请点击链接返回首页：<a href="<?php echo site_url() ?>">返回</a>
</div>