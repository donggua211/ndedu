<?php /* Smarty version Smarty-3.0.7, created on 2011-05-06 11:14:52
         compiled from "D:\www\project\ndedu.org\tools\shui/views\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:130624dc367ac78be27-35042861%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd91bb5242daf338b10080031cd3c8512db6c745c' => 
    array (
      0 => 'D:\\www\\project\\ndedu.org\\tools\\shui/views\\index.tpl',
      1 => 1304578140,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '130624dc367ac78be27-35042861',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
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
		<?php  $_smarty_tpl->tpl_vars['site'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('sites')->value['bbs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['site']->key => $_smarty_tpl->tpl_vars['site']->value){
?>
		<tr>
			<td><a href="<?php echo $_smarty_tpl->tpl_vars['site']->value['site_url'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['site']->value['site_name'];?>
</a></td>
			<td><?php echo $_smarty_tpl->tpl_vars['site']->value['user_name'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['site']->value['password'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['site']->value['status'];?>
</td>
		</tr>
		<?php }} ?>
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
		<?php  $_smarty_tpl->tpl_vars['site'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('sites')->value['tie']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['site']->key => $_smarty_tpl->tpl_vars['site']->value){
?>
		<tr>
			<td>
				<?php if ($_smarty_tpl->tpl_vars['site']->value['status']!=1){?>
					<?php echo $_smarty_tpl->tpl_vars['site']->value['site_name'];?>

				<?php }else{ ?>
					<a href="<?php echo $_smarty_tpl->tpl_vars['site']->value['site_url'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['site']->value['site_name'];?>
</a>
				<?php }?>
			</td>
		</tr>
		<?php }} ?>
	</tbody>
</table>
<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>