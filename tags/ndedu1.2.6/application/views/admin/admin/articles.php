<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/article') ?>"  target="main-frame">文章管理 </a></span>
	 » <?php echo $page_name ?>
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
					<th>标题</th>
					<th>分类</th>
					<th width="120px">添加时间</th>
					<th width="120px">最后修改时间</th>
					<th width="60px">操作</th>
				</tr>
				
				<?php foreach($articles as $article):?>
				<tr>
					<td align="left"><a href="<?php echo site_url('/article/'.$article['article_id']) ?>"><?php echo $article['title']?></a></td>
					<td align="left"><?php echo $article['cat_name']?></td>
					<td><?php echo $article['add_time']?></td>
					<td><?php echo $article['modified_time']?></td>
					<td align="center">
						<a href="<?php echo site_url('admin/article/edit/'.$article['article_id'])?>">编辑</a>
						<a onclick="return confirm('确定要删除');" href="<?php echo site_url('admin/article/delete/'.$article['article_id'])?>">删除</a>
					</td>
				</tr>
				<?php endforeach;?>
			</table>
		</div>
	</div>
</div>