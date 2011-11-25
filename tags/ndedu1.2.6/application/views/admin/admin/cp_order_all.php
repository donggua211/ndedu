<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/cp') ?>" target="main-frame">测评系统管理</a></span>
	 » 查看订单
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
		  <form action="<?php echo site_url('admin/cp_order/')?>" method="POST" name="searchForm">
			<img src="images/admin/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
			
			<!-- 添加card的时间 -->
			添加的时间: <input type="text" name="add_time_a" maxlength="60" size="10" value="" readonly="readonly" id="add_time_a" onclick="return showCalendar('add_time_a', '%Y-%m-%d', false, false, 'add_time_a');"/>
			到 <input type="text" name="add_time_b" maxlength="60" size="10" value="" readonly="readonly" id="add_time_b" onclick="return showCalendar('add_time_b', '%Y-%m-%d', false, false, 'add_time_b');"/>
			<!-- 状态 -->
			<select name="status">
				<option value='0'>所有状态</option>
				<option value='<?php echo CP_ORDER_STATUS_NEW ?>' <?php echo (isset($filter['status']) && ($filter['status'] == CP_ORDER_STATUS_NEW) ? 'SELECTED' : '' ) ?> ><?php echo get_cp_order_text(CP_ORDER_STATUS_NEW)?></option>
				<option value='<?php echo CP_ORDER_STATUS_CONFIRMED ?>' <?php echo (isset($filter['status']) &&  ($filter['status'] == CP_ORDER_STATUS_CONFIRMED) ? 'SELECTED' : '' ) ?> ><?php echo get_cp_order_text(CP_ORDER_STATUS_CONFIRMED)?></option>
				<option value='<?php echo CP_ORDER_STATUS_SHIPPED ?>' <?php echo (isset($filter['status']) && ($filter['status'] == CP_ORDER_STATUS_SHIPPED) ? 'SELECTED' : '' ) ?> ><?php echo get_cp_order_text(CP_ORDER_STATUS_SHIPPED)?></option>
			</select>
			<input type="submit" value=" 搜索 " class="button" />
		  </form>
		</div>
		
		<div id="listDiv" class="list-div">
			<table cellspacing='1' id="list-table">
				<tr>
					<th>收货人</th>
					<th>类别</th>
					<th width="100px">时间</th>
					<th>总价</th>
					<th>货运方式</th>
					<th>地址</th>
					<th>邮编</th>
					<th>电话</th>
					<th>优惠券</th>
					<th>优惠券面额</th>
					<th>给卖家留言</th>
					<th width="60px">操作</th>
				</tr>
				<?php foreach($orders as $order): ?>
				<tr>
					<td align="center"><a href="<?php echo site_url('admin/cp_order/one/'.$order['order_id']) ?>"><?php echo $order['name'] ?></a></td>
					<td align="center"><?php echo get_cp_order_type_text($order['order_type']) ?></td>
					<td align="center"><?php echo date('Y-m-d H:i', strtotime($order['add_time']));?></td>
					<td align="center"><?php echo $order['total_price'] ?></td>
					<td align="center"><?php echo get_order_delivery_type_text($order['delivery_type']) ?></td>
					<td>
						<span class="notice-highlight">省份: </span><?php echo (isset($order['province_name'])) ? $order['province_name'] :''; ?><span class="notice-highlight"> --> </span>
						<span class="notice-highlight">城市: </span><?php echo (isset($order['city_name'])) ? $order['city_name'] :''; ?><span class="notice-highlight"> --> </span>
						<span class="notice-highlight">区: </span><?php echo (isset($order['district_name'])) ? $order['district_name'] :''; ?><br/>
						<span class="notice-highlight">详细地址: </span><?php echo (isset($order['address'])) ? $order['address'] :''; ?>
					</td>
					<td align="center"><?php echo $order['postcode'] ?></td>
					<td>
						<?php echo (isset($order['phone']) && !empty($order['phone'])) ? '座机电话: '.$order['phone'].'<br/>' :''; ?>
						<?php echo (isset($order['mobile']) && !empty($order['mobile'])) ? '手机电话: '.$order['mobile'] :''; ?>
					</td>
					<td align="center">
						<?php echo isset($order['quan_id']) ? $order['quan_id'] :''; ?>
					</td>
					<td align="center">
						<?php echo isset($order['quan_id']) ? $order['quan_value'] :''; ?>
					</td>
					<td><?php echo $order['message'] ?></td>
					<td align="center">
						<a href="<?php echo site_url('admin/cp_order/one/'.$order['order_id']) ?>">查看详情</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<!-- 分页 -->
		<?php echo $page_nav; ?>
	</div>
</div>