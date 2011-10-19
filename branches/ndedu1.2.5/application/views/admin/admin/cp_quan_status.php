<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/cp_card') ?>" target="main-frame">测评系统管理</a></span>
	 » 密码卡统计
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
		  <form action="<?php echo site_url('admin/cp_card/status')?>" method="POST" name="searchForm">
			<img src="images/admin/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
			<!-- 添加card的时间 -->
			添加的时间: <input type="text" name="add_time_a" maxlength="60" size="10" value="" readonly="readonly" id="add_time_a" onclick="return showCalendar('add_time_a', '%Y-%m-%d', false, false, 'add_time_a');"/>
			到 <input type="text" name="add_time_b" maxlength="60" size="10" value="" readonly="readonly" id="add_time_b" onclick="return showCalendar('add_time_b', '%Y-%m-%d', false, false, 'add_time_b');"/>
			<input type="submit" value=" 搜索 " class="button" />
		  </form>
		</div>
		
		<div id="listDiv" class="list-div">
			<table cellspacing='1' id="list-table">
				<tr>
					<th>-</th>
					<th><?php echo get_cp_status_text(CP_CARD_STATUS_UNUSED) ?></th>
					<th><?php echo get_cp_status_text(CP_CARD_STATUS_STARTED) ?></th>
					<th><?php echo get_cp_status_text(CP_CARD_STATUS_FINISHED) ?></th>
					<th>总计</th>
				</tr>
				<?php $row = $column1_total = $column2_total = $column3_total = 0; ?>
				<?php foreach($status as $statu): ?>
				<tr>
					<td><?php echo $statu['cat_name'] ?></td>
					<td align="center">
					<?php
						$column1 = (isset($statu[CP_CARD_STATUS_UNUSED]) ? intval($statu[CP_CARD_STATUS_UNUSED]) : 0);
						$column1_total += $column1;
						echo $column1;
					?>
					</td>
					<td align="center">
					<?php
						$column2 = (isset($statu[CP_CARD_STATUS_STARTED]) ? intval($statu[CP_CARD_STATUS_STARTED]) : 0);
						$column2_total += $column2;
						echo $column2;
					?>
					</td>
					<td align="center">
					<?php
						$column3 = (isset($statu[CP_CARD_STATUS_FINISHED]) ? intval($statu[CP_CARD_STATUS_FINISHED]) : 0);
						$column3_total += $column3;
						echo $column3;
					?>
					</td>
					<td align="center">
					<?php
						echo $column1 + $column2 +$column3;
					?>
					</td>
				</tr>
				<?php endforeach; ?>
				<tr>
					<td align="center" class="first-cell">总计</td>
					<td align="center"><?php echo $column1_total ?></td>
					<td align="center"><?php echo $column2_total ?></td>
					<td align="center"><?php echo $column3_total ?></td>
					<td align="center"><?php echo $column1_total + $column2_total + $column3_total ?></td>
				</tr>
			</table>
		</div>
	</div>
</div>