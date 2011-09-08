{include file='header.tpl'}
<div class="{if $type == 'error'}error{else}result{/if}">
	<h1>{if $type == 'error'}失败!!{else}成功{/if}</h1>
	<div class="text">{$result}</div>
	<div class="result_link"><a href="{$back_url}">返回</a></div>
</div>
{include file='footer.tpl'}