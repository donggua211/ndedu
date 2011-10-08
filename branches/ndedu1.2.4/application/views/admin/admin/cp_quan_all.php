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
		  <form action="<?php echo site_url('admin/cp_quan')?>" method="POST" name="searchForm">
			<img src="images/admin/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
			<!-- 状态 -->
			<select name="used_at">
				<option value='0'>请选择用于何处</option>
				<option value='<?php echo CP_QUAN_USED_AT_NDEDU ?>' <?php echo (isset($filter['used_at']) && ($filter['used_at'] == CP_QUAN_USED_AT_NDEDU) ? 'SELECTED' : '' ) ?> ><?php echo get_cp_quan_used_at_text(CP_QUAN_USED_AT_NDEDU)?></option>
				<option value='<?php echo CP_QUAN_USED_AT_TAOBAO ?>' <?php echo (isset($filter['used_at']) &&  ($filter['used_at'] == CP_QUAN_USED_AT_TAOBAO) ? 'SELECTED' : '' ) ?> ><?php echo get_cp_quan_used_at_text(CP_QUAN_USED_AT_TAOBAO)?></option>
			</select>
			<!-- 状态 -->
			<select name="status">
				<option value='0'>所有状态</option>
				<option value='<?php echo CP_QUAN_STATUS_NEW ?>' <?php echo (isset($filter['status']) && ($filter['status'] == CP_QUAN_STATUS_NEW) ? 'SELECTED' : '' ) ?> ><?php echo get_cp_quan_status_text(CP_QUAN_STATUS_NEW)?></option>
				<option value='<?php echo CP_QUAN_STATUS_USED ?>' <?php echo (isset($filter['status']) &&  ($filter['status'] == CP_QUAN_STATUS_USED) ? 'SELECTED' : '' ) ?> ><?php echo get_cp_quan_status_text(CP_QUAN_STATUS_USED)?></option>
			</select>
			<input type="submit" value=" 搜索 " class="button" />
		  </form>
		</div>
		
		<div id="listDiv" class="list-div">
			<table cellspacing='1' id="list-table">
				<tr>
					<th>ID</th>
					<th>生成时间</th>
					<th>面额</th>
					<th>状态</th>
					<th>使用时间</th>
					<th>用于</th>
					<th>点单号</th>
				</tr>
				<?php foreach($quans as $quan): ?>
				<tr>
					<td align="center"><?php echo $quan['quan_id'] ?></td>
					<td align="center"><?php $add_ts = strtotime($quan['add_time']); echo (!empty($add_ts) ? date('Y-m-d H:i', $add_ts) : '') ?></td>
					<td align="center"><?php echo $quan['value'] ?></td>
					<td align="center"><?php echo get_cp_quan_status_text($quan['status']) ?></td>
					<td align="center"><?php $used_ts = strtotime($quan['used_time']); echo (!empty($used_ts) ? date('Y-m-d H:i', $used_ts) : '') ?></td>
					<td align="center"><?php echo get_cp_quan_used_at_text($quan['used_at']); ?></td>
					<td align="center"><a href="<?php echo site_url('admin/cp_order/one/'.$quan['order_id']) ?>"><?php echo $quan['order_id']; ?></a></td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<!-- 分页 -->
		<?php echo $page_nav; ?>
	</div>
</div>