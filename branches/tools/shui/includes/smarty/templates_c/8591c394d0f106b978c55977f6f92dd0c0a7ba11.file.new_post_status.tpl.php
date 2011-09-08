<?php /* Smarty version Smarty-3.0.7, created on 2011-04-28 09:30:47
         compiled from "D:\www\project\ndedu.org\tools\shui/views\new_post_status.tpl" */ ?>
<?php /*%%SmartyHeaderCode:94704db933c7a44351-92075201%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8591c394d0f106b978c55977f6f92dd0c0a7ba11' => 
    array (
      0 => 'D:\\www\\project\\ndedu.org\\tools\\shui/views\\new_post_status.tpl',
      1 => 1303983043,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '94704db933c7a44351-92075201',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
<h1>添加记录</h1>
<h4>添加记录到: <?php echo $_smarty_tpl->getVariable('post_site_info')->value['site_name'];?>
 > <?php echo $_smarty_tpl->getVariable('post_site_info')->value['block_name'];?>
 > <?php echo $_smarty_tpl->getVariable('post_site_info')->value['post_title'];?>
</h4>
<div class="form">
<form method="POST" action="new_post_status.php">
	<table align="center" border="1" cellspacing="0" cellpadding="0">
		<tr><td>浏览量: </td><td><input type="text" name="view_num" value=""/></td></tr>
		<tr><td>回复量: </td><td><input type="text" name="reply_num" value=""/></td></tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" name="submit" value="提交"/>
				<input type="hidden" name="post_site_id" value="<?php echo $_smarty_tpl->getVariable('post_site_info')->value['post_site_id'];?>
"/>
			</td>
		</tr>
	</table>	
</form>
</div>
<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>