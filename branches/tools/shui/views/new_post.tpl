{include file='header.tpl'}
<h1>添加文章</h1>
<h3>添加到: {if $type == 'bbs'}BBS{else}百度贴吧{/if}</h3>
<div class="form">
<form method="POST" action="new_post.php">
	<table align="center" border="1" cellspacing="0" cellpadding="0">
		<tr>
			<td colspan="3">
			选择: <select name="post_id">
						<option value="0">选择文章</option>
						{foreach $posts as $post}
						<option value="{$post.post_id}">{$post.post_title}</option>
						{/foreach}
					</select><br/><br/>
			标题: <input type="text" name="post_title" size="50"/>
			</td>
		</tr>
		{foreach $sites as $site}
			<tr>
				<td>{$site.site_name}:</td>
				{if isset($blocks.{$site.site_id})}
					<td>区块: <select name="site_post[{$site.site_id}][block_id]">
						<option value="0">选择区块</option>
						{foreach $blocks.{$site.site_id} as $block}
						<option value="{$block.site_block_id}">{$block.block_name}</option>
						{/foreach}
					</select></td>
				{else}
					<td><input type="hidden" name="site_post[{$site.site_id}][block_id]" value="0"/></td>
				{/if}
				<td>URL: <input type="text" name="site_post[{$site.site_id}][post_url]" size="50"/>
				<input type="hidden" name="site_post[{$site.site_id}][site_id]" value="{$site.site_id}"/></td>
			</tr>
		{/foreach}
		<tr><td colspan="3" align="center"><input type="submit" name="submit" value="提交"/></td></tr>
	</table>
</form>
</div>
{include file='footer.tpl'}