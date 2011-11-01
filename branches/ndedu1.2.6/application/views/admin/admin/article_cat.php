<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/articleCat') ?>"  target="main-frame">分类管理 </a></span>
	 » 查看分类
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
					<th>分类名称</th>
					<th>分类描述</th>
					<th>添加时间</th>
					<th>最后修改时间</th>
					<th>操作</th>
				</tr>
				<?php 
				function show_category_list($category)
				{
					foreach($category as $value)
					{
						echo '<tr><td class="first-cell" align="left">';
						
						for($i = 0; $i < $value['level']; $i++)
							echo '&nbsp;&nbsp;&nbsp;&nbsp;';
						
						if($value['level'] > 0)
							echo '└─';
						
						echo '<img src="images/admin/menu_arrow.gif" width="9" height="9" border="0" style="margin-left:2px;margin-right:2px" />'.$value['cat_name'].'</td>
								<td>'.$value['cat_desc'].'</td>
								<td align="center">'.$value['add_time'].'</td>
								<td align="center">'.$value['modified_time'].'</td>
								<td align="center">
									<a href="'.site_url('admin/ArticleCat/edit/'.$value['cat_id']).'">编辑</a>
									<a onclick="return confirm(\'确定要删除\');" href="'.site_url('admin/ArticleCat/unavailable/'.$value['cat_id']).'">删除</a>
								</td>
							<tr>';
						
						if(isset($value['sub_cat']) && !empty($value['sub_cat']))
							show_category_list($value['sub_cat']);
					}
				}
				show_category_list($categories);
				?>
			</table>
		</div>
	</div>
</div>