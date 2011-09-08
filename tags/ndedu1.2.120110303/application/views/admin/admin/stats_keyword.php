<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/status') ?>"  target="main-frame">统计</a></span>
	 » 查看tag
	<div style="clear:both"></div>
</div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		
		<div id="listDiv" class="list-div">
			<table cellspacing='1' id="list-table">
				<tr>
					<th>关键字</th>
					<th>点击次数</th>
				</tr>
				<?php foreach($keyword_stats as $keyword_stat): ?>
					<tr>
						<td class="first-cell" align="left"><?php echo $keyword_stat['keyword'] ?></td>
						<td align="center"><?php echo $keyword_stat['counter'] ?></td>
					</tr>
				<?php endforeach;?>
			</table>
		</div>
	</div>
</div>