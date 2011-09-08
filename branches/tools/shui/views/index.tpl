{include file='header.tpl'}
<h1>BBS</h1>
<table align="center" border="1" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<td>站点名称</td>
			<td>用户名</td>
			<td>密码</td>
			<td>状态</td>
		</tr>
	</thead>
	<tbody>
		{foreach item=site from=$sites.bbs}
		{if $site.status == 2}
		{continue}
		{/if}
		<tr>
			<td><a href="{$site.site_url}" target="_blank">{$site.site_name}</a></td>
			<td>{$site.user_name}</td>
			<td>{$site.password}</td>
			<td>{$site.status}</td>
		</tr>
		{/foreach}
	</tbody>
</table>

<h1><span style="color:#F4A460">BAIDU 贴吧</span></h1>
<table align="center" border="1" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<td>站点名称</td>
		</tr>
	</thead>
	<tbody>
		{foreach item=site from=$sites.tie}
		<tr>
			<td>
				{if $site.status != 1}
					{$site.site_name}
				{else}
					<a href="{$site.site_url}" target="_blank">{$site.site_name}</a>
				{/if}
			</td>
		</tr>
		{/foreach}
	</tbody>
</table>
{include file='footer.tpl'}