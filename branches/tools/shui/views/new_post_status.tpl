{include file='header.tpl'}
<h1>添加记录</h1>
<h4>添加记录到: {$post_site_info.site_name} > {$post_site_info.block_name} > {$post_site_info.post_title}</h4>
<div class="form">
<form method="POST" action="new_post_status.php">
	<table align="center" border="1" cellspacing="0" cellpadding="0">
		<tr><td>浏览量: </td><td><input type="text" name="view_num" value=""/></td></tr>
		<tr><td>回复量: </td><td><input type="text" name="reply_num" value=""/></td></tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" name="submit" value="提交"/>
				<input type="hidden" name="post_site_id" value="{$post_site_info.post_site_id}"/>
			</td>
		</tr>
	</table>	
</form>
</div>
{include file='footer.tpl'}