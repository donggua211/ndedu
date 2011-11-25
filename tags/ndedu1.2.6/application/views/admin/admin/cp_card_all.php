<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/cp') ?>" target="main-frame">测评系统管理</a></span>
	 » 查看密码卡
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
			<!-- 测评分类 -->
			<select name="cat_id">
				<option value='0'>请选择...</option>
				<?php
				foreach($category as $value)
					echo '<option value="'.$value['cat_id'].'" '.((isset($filter['cat_id']) && ($filter['cat_id'] == $value['cat_id'])) ? 'SELECTED' : '').'>'.$value['cat_name'].'</option>';
				?>
			</select>
			<!-- 测评级别 -->
			<select name="level">
				<option value='0'>全部级别</option>
				<option value='<?php echo CP_LEVEL_ADVANCED ?>' <?php echo (isset($filter['level']) && ($filter['level'] == CP_LEVEL_ADVANCED) ? 'SELECTED' : '' ) ?> ><?php echo get_cp_level_text(CP_LEVEL_ADVANCED)?></option>
				<option value='<?php echo CP_LEVEL_LUXURY ?>' <?php echo (isset($filter['level']) && ($filter['level'] == CP_LEVEL_LUXURY) ? 'SELECTED' : '' ) ?> ><?php echo get_cp_level_text(CP_LEVEL_LUXURY)?></option>
			</select>
			<!-- 状态 -->
			<select name="status">
				<option value='0'>所有状态</option>
				<option value='<?php echo CP_CARD_STATUS_UNUSED ?>' <?php echo (isset($filter['status']) && ($filter['status'] == CP_CARD_STATUS_UNUSED) ? 'SELECTED' : '' ) ?> ><?php echo get_cp_status_text(CP_CARD_STATUS_UNUSED)?></option>
				<option value='<?php echo CP_CARD_STATUS_STARTED ?>' <?php echo (isset($filter['status']) &&  ($filter['status'] == CP_CARD_STATUS_STARTED) ? 'SELECTED' : '' ) ?> ><?php echo get_cp_status_text(CP_CARD_STATUS_STARTED)?></option>
				<option value='<?php echo CP_CARD_STATUS_FINISHED ?>' <?php echo (isset($filter['status']) && ($filter['status'] == CP_CARD_STATUS_FINISHED) ? 'SELECTED' : '' ) ?> ><?php echo get_cp_status_text(CP_CARD_STATUS_FINISHED)?></option>
			</select>
			<input type="submit" value=" 搜索 " class="button" />
		  </form>
		</div>
		
		<div id="listDiv" class="list-div">
			<table cellspacing='1' id="list-table">
				<tr>
					<th>ID</th>
					<th>生成时间</th>
					<th>测评分类</th>
					<th>测评级别</th>
					<th>状态</th>
					<th>开始测评时间</th>
					<th>结束测评时间</th>
					<th>操作</th>
				</tr>
				<?php foreach($cards as $card): ?>
				<tr>
					<td align="center"><a href="<?php echo site_url('admin/cp_card/one/'.$card['card_id']) ?>"><?php echo $card['card_id'] ?></a></td>
					<td align="center"><?php $add_ts = strtotime($card['add_time']); echo (!empty($add_ts) ? date('Y-m-d H:i', $add_ts) : '') ?></td>
					<td><?php echo $card['cat_name'] ?></td>
					<td align="center"><?php echo get_cp_level_text($card['level']) ?></td>
					<td align="center"><?php echo get_cp_status_text($card['status']) ?></td>
					<td align="center"><?php $start_ts = strtotime($card['start_time']); echo (!empty($start_ts) ? date('Y-m-d H:i', $start_ts) : '') ?></td>
					<td align="center"><?php $finished_ts = strtotime($card['finished_time']); echo (!empty($finished_ts) ? date('Y-m-d H:i', $finished_ts) : '') ?></td>
					<td align="center">
						<a href="<?php echo site_url('admin/cp_card/one/'.$card['card_id']) ?>">查看详情</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<!-- 分页 -->
		<?php echo $page_nav; ?>
	</div>
</div>