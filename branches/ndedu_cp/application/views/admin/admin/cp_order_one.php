<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/cp') ?>" target="main-frame">测评系统管理</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/cp_order') ?>" target="main-frame">查看订单</a></span>
	 » <?php echo $order_info['order_id'] ?>
</div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		<table width="100%">
			<tr>
				<td class="label" valign="top">订单号: </td>
				<td><?php echo $order_info['order_id'] ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">状态: </td>
				<td><?php echo get_cp_order_text($order_info['status']) ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">总价: </td>
				<td><?php echo $order_info['total_price'] ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">姓名: </td>
				<td><?php echo $order_info['name']; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">购买时间: </td>
				<td><?php echo $order_info['order_add_time']; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">地址: </td>
				<td>
					<span class="notice-highlight">省份: </span><?php echo (isset($order_info['province_name'])) ? $order_info['province_name'] :''; ?><span class="notice-highlight"> --> </span>
					<span class="notice-highlight">城市: </span><?php echo (isset($order_info['city_name'])) ? $order_info['city_name'] :''; ?><span class="notice-highlight"> --> </span>
					<span class="notice-highlight">区: </span><?php echo (isset($order_info['district_name'])) ? $order_info['district_name'] :''; ?><br/>
					<span class="notice-highlight">详细地址: </span><?php echo (isset($order_info['address'])) ? $order_info['address'] :''; ?>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top">邮编: </td>
				<td><?php echo $order_info['postcode'] ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">联系方式: </td>
				<td>
					<?php
					echo !(empty($order_info['mobile'])) ? '<b>座机:</b> '.$order_info['mobile'].'<br/>' : '';
					echo !(empty($order_info['phone'])) ? '<b>手机:</b> '.$order_info['phone'] : '';
					?>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top">送货方式: </td>
				<td><?php echo get_order_delivery_type_text($order_info['delivery_type']) ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">优惠券: </td>
				<td>
				<?php
					if(isset($order_info['quan_id']))
						echo '<span class="notice-highlight">ID: </span>'.$order_info['quan_id'].' <span class="notice-highlight">面额: </span>'.$order_info['quan_value']; 
					else
						echo '<form action="'.site_url("admin/cp_quan/use_quan").'" method="post">
							<input size="20" type="text" id="quan" name="quan" value="">
							<input type="hidden"  name="order_id" value="'.$order_info['order_id'].'">
							<input type="submit" name="submit" value="提交">
							</form>';
				?>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top">给卖家留言: </td>
				<td><?php echo nl2br($order_info['message']) ?></td>
			</tr>
		</table>
		
		<div class="title"><span>更改状态</span></div>
		<div class="form-div">
		  <form action="<?php echo site_url('admin/cp_order/change_status')?>" method="POST" name="searchForm">
			<!-- 状态 -->
			把状态改为: 
			<select name="status">
				<option value='0'>所有状态</option>
				<option value='<?php echo CP_ORDER_STATUS_NEW ?>' <?php echo (isset($order_info['status']) && ($order_info['status'] == CP_ORDER_STATUS_NEW) ? 'SELECTED' : '' ) ?> ><?php echo get_cp_order_text(CP_ORDER_STATUS_NEW)?></option>
				<option value='<?php echo CP_ORDER_STATUS_CONFIRMED ?>' <?php echo (isset($order_info['status']) &&  ($order_info['status'] == CP_ORDER_STATUS_CONFIRMED) ? 'SELECTED' : '' ) ?> ><?php echo get_cp_order_text(CP_ORDER_STATUS_CONFIRMED)?></option>
				<option value='<?php echo CP_ORDER_STATUS_SHIPPED ?>' <?php echo (isset($order_info['status']) && ($order_info['status'] == CP_ORDER_STATUS_SHIPPED) ? 'SELECTED' : '' ) ?> ><?php echo get_cp_order_text(CP_ORDER_STATUS_SHIPPED)?></option>
			</select><br/>
			备注:<br/><textarea name="action_notes" cols="50" rows="5"></textarea><br/>
			<input type="hidden" name="order_id" value="<?php echo $order_info['order_id'] ?>" />
			<input type="hidden" name="from_status" value="<?php echo $order_info['status'] ?>" />
			<input type="submit" name="submit" value="更改" class="button" />
		  </form>
		</div>
		
		<!-- 订单详情 -->
		<div class="title"><span>订单详情</span></div>
		<div id="listDiv" class="list-div">
		<table width="100%">
			<tr>
				<th>产品名</th>
				<th>版本</th>
				<th>数量</th>
				<th>单价</th>
			</tr>
			<?php foreach($order_info['order_list'] as $one): ?>
			<tr>
				<td><?php echo $one['cat_name'] ?></td>
				<td align="center"><?php echo get_cp_level_text($one['cat_level']) ?></td>
				<td align="center"><?php echo $one['quantity'] ?></td>
				<td align="center"><?php echo ($one['cat_level'] == CP_LEVEL_ADVANCED) ? $one['price_advanced'] : $one['price_luxury']; ?></td>
			</tr>
			<?php endforeach; ?>
		</table>
		
		<!-- 操作历史 -->
		<div class="title"><span>操作历史</span></div>
		<?php if(!empty($order_info['order_action'])): ?>
		<table width="100%">
			<tr>
				<th>操作历史</th>
				<th>备注</th>
				<th>操作</th>
			</tr>

			<?php foreach($order_info['order_action'] as $action): ?>
			<tr>
				<td class="status_history">
					<?php echo $action['add_time'] ?>, 从"<?php echo get_cp_order_text($action['from_status'])?>", 改为了"<?php echo get_cp_order_text($action['to_status'])?>". 
				</td>
				<td align="center">
					<?php echo $action['action_notes']; ?>
				</td>
				<td align="center">
					<?php if(!empty($action['from_status'])): ?>
					<form onsubmit="return confirm('确定要删除? 删除将无法恢复!');" action="<?php echo site_url('admin/cp_order/delete_action') ?>" method="post">
						<input type="hidden" name="order_action_id" value="<?php echo $action['action_id'] ?>"/>
						<input type="submit" name="submit" value="删除" class="button" />
					</form>
					<?php endif; ?>
				</td>
			</tr>
			<?php endforeach ?>
		</table>
		<?php else: ?>
		无
		<?php endif ?>
		</div>
		
		<div class="button-link-div">
			<a href="javascript:void();" onclick="history.back(-1)">返回</a>
		</div>
	</div>
</div>