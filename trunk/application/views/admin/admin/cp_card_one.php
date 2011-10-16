<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/cp') ?>" target="main-frame">测评系统管理</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/cp_card') ?>" target="main-frame">查看密码卡</a></span>
	 » <?php echo $card_info['card_id'] ?>
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
				<td class="label" valign="top">卡号: </td>
				<td><?php echo $card_info['card_id'] ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">测评分类: </td>
				<td><?php echo $card_info['cat_name']; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">测评级别: </td>
				<td><?php echo get_cp_level_text($card_info['level']) ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">目前状态: </td>
				<td><?php echo get_cp_status_text($card_info['status']) ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">生成时间: </td>
				<td><?php echo $card_info['card_add_time']?></td>
			</tr>
			<tr>
				<td class="label" valign="top">开始测评时间: </td>
				<td><?php $start_ts = strtotime($card_info['start_time']); echo (!empty($start_ts) ? date('Y-m-d H:i:s', $start_ts) : '') ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">结束测评时间: </td>
				<td><?php $finished_ts = strtotime($card_info['finished_time']); echo (!empty($finished_ts) ? date('Y-m-d H:i:s', $finished_ts) : '') ?></td>
			</tr>
			<tr>
				<td colspan="2"><div class="title"><span>用户信息</span></div></td>
			</tr>
			<tr>
				<td class="label" valign="top">姓名: </td>
				<td><?php echo (isset($card_info['user_info']['name'])) ? $card_info['user_info']['name'] : ''; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">电话: </td>
				<td><?php echo (isset($card_info['user_info']['phone'])) ? $card_info['user_info']['phone'] : ''; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">电子邮箱: </td>
				<td><?php echo (isset($card_info['user_info']['email'])) ? $card_info['user_info']['email'] :''; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">所在年级: </td>
				<td><?php echo (isset($card_info['user_info']['grade_name'])) ? $card_info['user_info']['grade_name'] :''; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">所在学校: </td>
				<td><?php echo (isset($card_info['user_info']['school'])) ? $card_info['user_info']['school'] :''; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">地址: </td>
				<td>
					<span class="notice-highlight">省份: </span><?php echo (isset($card_info['user_info']['province_name'])) ? $card_info['user_info']['province_name'] :''; ?><span class="notice-highlight"> --> </span>
					<span class="notice-highlight">城市: </span><?php echo (isset($card_info['user_info']['city_name'])) ? $card_info['user_info']['city_name'] :''; ?><span class="notice-highlight"> --> </span>
					<span class="notice-highlight">区: </span><?php echo (isset($card_info['user_info']['district_name'])) ? $card_info['user_info']['district_name'] :''; ?><br/>
				</td>
			</tr>		
		</table>
		<div class="button-link-div">
			<a href="javascript:void(0);" onclick="history.back(-1)">返回</a>
		</div>
	</div>
</div>