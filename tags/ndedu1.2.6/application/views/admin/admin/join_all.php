<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	 » 查看加入尼德列表
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
			
			<input type="submit" value=" 搜索 " class="button" />
		  </form>
		</div>
		
		<div id="listDiv" class="list-div">
			<table cellspacing='1' id="list-table">
				<tr>
					<th>ID</th>
					<th>姓名</th>
					<th>添加时间</th>
					<th>加盟省份</th>
					<th>操作</th>
				</tr>
				<?php foreach($lists as $val): ?>
				<tr>
					<td align="center"><a href="<?php echo site_url('admin/join/one/'.$val['join_id']) ?>"><?php echo $val['join_id'] ?></a></td>
					<td><?php echo $val['name'] ?></td>
					<td align="center"><?php $add_ts = strtotime($val['add_time']); echo (!empty($add_ts) ? date('Y-m-d H:i', $add_ts) : '') ?></td>
					<td align="center"><?php echo $val['province_name'].' -> '.$val['city_name']; ?></td>
					<td align="center">
						<a href="<?php echo site_url('admin/join/one/'.$val['join_id']) ?>">查看详情</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<!-- 分页 -->
		<?php echo $page_nav; ?>
	</div>
</div>