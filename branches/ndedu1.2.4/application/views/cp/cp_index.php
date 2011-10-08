<script  src="js/swfobject_source.js" type=text/javascript></script>
<div id="cp_main_flash">
	<a href="#" arget=_blank><img src="images/cp/banner_1.jpg" border=0 alt="<?php echo SITE_NAME; ?>" /></a>
</div>
<div id="cp_main_flash_bottom">
<img src="images/cp/banner_bottom.jpg" border=0 alt="<?php echo SITE_NAME; ?>" />
</div>
<script type=text/javascript>
var s1 = new SWFObject("<?php echo base_url() ?>images/flash/focusFlash_fp.swf", "mymovie1", "940", "300", "3", "#ffffff");
s1.addParam("wmode", "transparent");
s1.addParam("AllowscriptAccess", "sameDomain");
s1.addVariable("bigSrc", "images/cp/banner_1.jpg|images/cp/banner_2.jpg|images/cp/banner_3.jpg");
s1.addVariable("smallSrc", "");
s1.addVariable("href", "<?php echo site_url('') ?>|<?php echo site_url('') ?>|<?php echo site_url('') ?>");
s1.addVariable("txt", "1|2|3");
s1.addVariable("width", "940");
s1.addVariable("height", "300");
s1.write("cp_main_flash");
</script>

<div id="cp_main">
	<div id="cp_main_sidebar">
		<!-- 媒体报道 -->
		<div class="sidebar_block">
			<div class="sidebar_head">
				媒体报道
				<a href="<?php echo site_url('media') ?>" target="_blank">更多&gt;&gt;</a>
			</div>
			<div class="sidebar_main">
				<?php foreach($sidebar1 as $key => $article): ?>
					<div class="sidebar_main_content<?php echo (count($sidebar1) > ($key + 1)) ? ' dashed_gray_line' : ''; ?>">
						<span class="sidebar_main_des"><a href="<?php echo site_url('article/'.$article['article_id']) ?>" title="<?php echo $article['title']?>"><?php echo utf_substr($article['title'], 25)?></a></span>
						<span class="sidebar_main_date"><?php echo $article['add_time']?></span>
					</div>
				<?php endforeach;?>
			</div>
			<img src="images/cp/index_sidebar_bottom.jpg">
		</div>
		
		<!-- 测评体验 -->
		<div class="sidebar_block">
			<div class="sidebar_head">
				测评体验
			</div>
			<div class="sidebar_main">
				<?php foreach($sidebar2 as $key => $comment): ?>
					<div class="sidebar_main_content<?php echo (count($sidebar2) > ($key + 1)) ? ' dashed_gray_line' : ''; ?>">
						<span class="sidebar_main_des"><a href="<?php echo site_url('cp/detail/'.$comment['cat_id']) ?>" title="<?php echo $comment['comment']?>" target="_blank"><?php echo utf_substr($comment['comment'], 25)?></a></span>
						<span class="sidebar_main_date" title="<?php echo $comment['name'] ?>"><?php echo utf_substr($comment['name'], 9)?></span>
					</div>
				<?php endforeach;?>
			</div>
			<img src="images/cp/index_sidebar_bottom.jpg">
		</div>
		
		<!-- 发货通知 -->
		<div class="sidebar_block">
			<div class="sidebar_head">
				发货通知
				<a href="<?php echo site_url('news') ?>">更多&gt;&gt;</a>
			</div>
			<div class="sidebar_main">
				发货状态：<span class="font_12_red">已发货</span><br/>
				物流编号：LP11030925927323<br/>
				物流公司：中通速递 <br/>
				运单号码：201003003071 <br/>
				<a href="" class="font_143_orange">查询>></a>
			</div>
			<img src="images/cp/index_sidebar_bottom.jpg">
		</div>
	</div>

	<div id="cp_main_body">
		<?php foreach($cat_list as $key => $cat): ?>
		<form action="<?php echo site_url('cp_order')?>" method="post">
		<div class="cat_block">
			<div class="cat_block_head"><a href="<?php echo site_url('cp/detail/'.$cat['cat_id']) ?>" target="_blank"><?php echo $cat['cat_name'] ?></a></div>
			<div class="cat_block_main_body">
				<a href="<?php echo site_url('cp/detail/'.$cat['cat_id']) ?>" target="_blank"><img src="images/cp/cat_pic<?php echo $cat['cat_id'] ?>.jpg" class="cat_block_main_pic"></a>
				<div class="cat_block_main_detail">
					<div><input type="radio" id="level1" name="level" value="<?php echo CP_LEVEL_LUXURY ?>" style="margin:0" CHECKED> <label for="level1">豪华版：<font class="cat_detail_yuan"><?php echo $cat['price_luxury'] ?></font> 元</label> <span class="cat_detail_cp_link"><a href="<?php echo site_url('cp_login/'.$cat['cat_id'].'/2') ?>">进入测评>></a></span></div>
					<div><input type="radio" id="level2" name="level" value="<?php echo CP_LEVEL_ADVANCED ?>" style="margin:0"> <label for="level2">高级版：<font class="cat_detail_yuan"><?php echo $cat['price_advanced'] ?></font> 元</label> <span class="cat_detail_cp_link"><a href="<?php echo site_url('cp_login/'.$cat['cat_id'].'/1') ?>">进入测评>></a></span></div>
					<div class="padding_left">产品单位：套</div>
					<div class="padding_left">产品运费：8-15元(支持货到付款)</div>
					<div class="padding_left">30天售出：<font class="font_14_orange">1024件</font>( <span class="cat_detail_comment_link"><a href="<?php echo site_url('cp/detail/'.$cat['cat_id']) ?>">已有168人发表评论</a></span> )</div>
					<div class="cat_detail_buy" onmouseover="detail_buy_mouse(this, 'FFF9D5', 'FFCC66');" onmouseout="detail_buy_mouse(this, 'F9F9F9', 'EDEDED');">
						我要购买：<input type="text" name="order_num" value="1" size="4" class="input_class"> 套
						<div class="cat_detail_botton">
							<input type="image" name="submit" src="images/cp/index_cat_detail_botton_buy.jpg">
							<a href="<?php echo site_url('cp/detail/'.$cat['cat_id']) ?>" target="_blank"><img src="images/cp/index_cat_detail_botton_report.jpg"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" name="cat_id" value="<?php echo $cat['cat_id']; ?>">
		</form>
		<?php endforeach; ?>
	</div>
</div>
