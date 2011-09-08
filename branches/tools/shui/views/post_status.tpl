{include file='header.tpl'}
<h1>添加记录</h1>
<h4>添加记录到: {$post_site_info.site_name} > {$post_site_info.block_name} > {$post_site_info.post_title}</h4>
<div class="form">
<form method="POST" action="new_post_status.php">
	<table align="center" border="1" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<td>浏览量</td>
				<td>回复量</td>
				<td>查看时间</td>
			</tr>
		</thead>
		<tbody>
			{foreach $post_status as $val}
			<tr>
				<td>{$val.view_num}</td>
				<td>{$val.reply_num}</td>
				<td>{$val.add_time}</td>
			</tr>
			{/foreach}
		</tbody>
	</table>	
</form>
</div>
{include file='footer.tpl'}