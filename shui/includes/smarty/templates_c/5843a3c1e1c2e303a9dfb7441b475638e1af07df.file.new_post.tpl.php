<?php /* Smarty version Smarty-3.0.7, created on 2011-04-28 07:58:27
         compiled from "D:\www\project\ndedu.org\tools\shui/views\new_post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:223104db91e23d154b1-16689188%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5843a3c1e1c2e303a9dfb7441b475638e1af07df' => 
    array (
      0 => 'D:\\www\\project\\ndedu.org\\tools\\shui/views\\new_post.tpl',
      1 => 1303977505,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '223104db91e23d154b1-16689188',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
<h1>添加文章</h1>
<h3>添加到: <?php if ($_smarty_tpl->getVariable('type')->value=='bbs'){?>BBS<?php }else{ ?>百度贴吧<?php }?></h3>
<div class="form">
<form method="POST" action="new_post.php">
	<table align="center" border="1" cellspacing="0" cellpadding="0">
		<tr>
			<td colspan="3">
			选择: <select name="post_id">
						<option value="0">选择文章</option>
						<?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('posts')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value){
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['post']->value['post_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value['post_title'];?>
</option>
						<?php }} ?>
					</select><br/><br/>
			标题: <input type="text" name="post_title" size="50"/>
			</td>
		</tr>
		<?php  $_smarty_tpl->tpl_vars['site'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('sites')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['site']->key => $_smarty_tpl->tpl_vars['site']->value){
?>
			<tr>
				<td><?php echo $_smarty_tpl->tpl_vars['site']->value['site_name'];?>
:</td>
				<?php if (isset($_smarty_tpl->getVariable('blocks',null,true,false)->value[$_smarty_tpl->tpl_vars['site']->value['site_id']])){?>
					<td>区块: <select name="site_post[<?php echo $_smarty_tpl->tpl_vars['site']->value['site_id'];?>
][block_id]">
						<option value="0">选择区块</option>
						<?php  $_smarty_tpl->tpl_vars['block'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('blocks')->value[$_smarty_tpl->tpl_vars['site']->value['site_id']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['block']->key => $_smarty_tpl->tpl_vars['block']->value){
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['block']->value['site_block_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['block']->value['block_name'];?>
</option>
						<?php }} ?>
					</select></td>
				<?php }else{ ?>
					<td><input type="hidden" name="site_post[<?php echo $_smarty_tpl->tpl_vars['site']->value['site_id'];?>
][block_id]" value="0"/></td>
				<?php }?>
				<td>URL: <input type="text" name="site_post[<?php echo $_smarty_tpl->tpl_vars['site']->value['site_id'];?>
][post_url]" size="50"/>
				<input type="hidden" name="site_post[<?php echo $_smarty_tpl->tpl_vars['site']->value['site_id'];?>
][site_id]" value="<?php echo $_smarty_tpl->tpl_vars['site']->value['site_id'];?>
"/></td>
			</tr>
		<?php }} ?>
		<tr><td colspan="3" align="center"><input type="submit" name="submit" value="提交"/></td></tr>
	</table>
</form>
</div>
<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>