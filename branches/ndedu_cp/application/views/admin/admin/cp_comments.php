<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/cp') ?>" target="main-frame">测评系统管理</a></span>
	 » 查看评论
	<div style="clear:both"></div>
</div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		
		<div class="form-div">
		  <form action="<?php echo site_url('admin/cp_card')?>" method="POST" name="searchForm">
			<img src="images/admin/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
			<!-- 添加card的时间 -->
			添加的时间: <input type="text" name="add_time_a" maxlength="60" size="10" value="" readonly="readonly" id="add_time_a" onclick="return showCalendar('add_time_a', '%Y-%m-%d', false, false, 'add_time_a');"/>
			到 <input type="text" name="add_time_b" maxlength="60" size="10" value="" readonly="readonly" id="add_time_b" onclick="return showCalendar('add_time_b', '%Y-%m-%d', false, false, 'add_time_b');"/>
			<!-- 测评分类 -->
			<select name="cat_id">
				<option value='0'>请选择...</option>
				<?php
				foreach($category as $value)
					echo '<option value="'.$value['cat_id'].'" '.((isset($filter['cat_id']) && ($filter['cat_id'] == $value['cat_id'])) ? 'SELECTED' : '').'>'.$value['cat_name'].'</option>';
				?>
			</select>
			<!-- 状态 -->
			<select name="status">
				<option value='0'>状态</option>
				<option value='1' <?php echo (isset($filter['status']) && ($filter['status'] == CP_COMMENT_STATUS_NEW) ? 'SELECTED' : '' ) ?> ><?php echo get_comments_status_text(CP_COMMENT_STATUS_NEW); ?></option>
				<option value='<?php echo CP_CARD_STATUS_STARTED ?>' <?php echo (isset($filter['status']) &&  ($filter['status'] == CP_COMMENT_STATUS_REVIEWED) ? 'SELECTED' : '' ) ?> ><?php echo get_comments_status_text(CP_COMMENT_STATUS_REVIEWED); ?></option>
			</select>
			<input type="submit" value=" 搜索 " class="button" />
		  </form>
		</div>
		
		<div id="listDiv" class="list-div">
			<table cellspacing='1' id="list-table">
				<tr>
					<th>姓名</th>
					<th>测评分类</th>
					<th>状态状态</th>
					<th>测评</th>
					<th>时间</th>
					<th>操作</th>
				</tr>
				<?php foreach($comments as $comment): ?>
				<tr>
					<td align="center"><?php echo $comment['name'] ?></td>
					<td align="center"><?php echo $comment['cat_name'] ?></td>
					<td align="center">
					<?php
						echo ($comment['status'] == CP_COMMENT_STATUS_NEW) ? '<font color="red">' : '';
						echo get_comments_status_text($comment['status']); 
						echo ($comment['status'] == CP_COMMENT_STATUS_NEW) ? '</font>' : '';
					?>
					</td>
					<td><?php echo $comment['comment'] ?></td>
					<td align="center"><?php echo date('Y-m-d H:i', strtotime($comment['add_time'])); ?></td>
					<td align="center">
					<?php
						echo ($comment['status'] == CP_COMMENT_STATUS_NEW) ? '<a href="'.site_url('admin/cp/comment_review/'.$comment['comment_id']).'">通过审核</a>' : '';
					?>	
						<a onclick="return confirm('确定要删除? 删除后将无法回复!');" href="<?php echo site_url('admin/cp/comment_delete/'.$comment['comment_id']) ?>">删除</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<!-- 分页 -->
		<?php echo $page_nav; ?>
	</div>
</div>