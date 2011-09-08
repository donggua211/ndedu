{include file='header.tpl'}
{foreach $posts as $post}
	<h1>{if $post.type == 'tie'}<span style="color:#F4A460">百度贴吧 -- {$post.site_name}</span>{else}{$post.site_name}{/if}</h1>
	{if isset($post.block)}
		{foreach $post.block as $block}
			<h3>{$block.block_name}</h3>
			<table align="center" border="1" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
						<td>Title</td>
						<td>添加时间</td>
						<td>操作</td>
					</tr>
				</thead>
				<tbody>
					{foreach $block.post as $val}
					<tr>
						<td>
							{if $val.status == $POST_SITE_STATUS_AVAILABLE}
								<a href="{$val.post_url}" target="_blank">{$val.post_title}</a>
							{else}
								<span class="color_r">{$val.post_title}
							{/if}
						</td>
						<td align="center">{$val.add_time}</td>
						<td align="center">
							{if $val.status == $POST_SITE_STATUS_AVAILABLE}
								<a href="new_post_status.php?post={$val.post_site_id}">添加记录</a>
								<a href="post_status.php?post={$val.post_site_id}">查看记录</a>
								<a href="rm_post.php?post={$val.post_site_id}" onclick="return confirm('确定要删除');">删除记录</a>
							{else}
								<a href="{$val.post_url}" target="_blank">查看页面</a>
							{/if}
						</td>
					</tr>
					{/foreach}
				</tbody>
			</table>
		{/foreach}
	{else}
		<table align="center" border="1" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<td>Title</td>
					<td>添加时间</td>
					<td>操作</td>
				</tr>
			</thead>
			<tbody>
				{foreach $post.post as $val}
				<tr>
					<td>
						{if $val.status == $POST_SITE_STATUS_AVAILABLE}
							<a href="{$val.post_url}" target="_blank">{$val.post_title}</a>
						{else}
							<span class="color_r">{$val.post_title}
						{/if}
					</td>
					<td align="center">{$val.add_time}</td>
					<td align="center">
						{if $val.status == $POST_SITE_STATUS_AVAILABLE}
							<a href="new_post_status.php?post={$val.post_site_id}">添加记录</a>
							<a href="post_status.php?post={$val.post_site_id}">查看记录</a>
							<a href="rm_post.php?post={$val.post_site_id}" onclick="return confirm('确定要删除');">删除记录</a>
						{else}
							<a href="{$val.post_url}" target="_blank">查看页面</a>
						{/if}
					</td>
				</tr>
				{/foreach}
			</tbody>
		</table>
	{/if}
	{if !$post@last}<hr>{/if}
{/foreach}
{include file='footer.tpl'}