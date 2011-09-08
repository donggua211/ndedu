<?php /* Smarty version Smarty-3.0.7, created on 2011-04-28 09:33:55
         compiled from "D:\www\project\ndedu.org\tools\shui/views\post_status.tpl" */ ?>
<?php /*%%SmartyHeaderCode:215994db934830f7182-41613837%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd01d4053a4453095e4b68cd640e1f436c8752f98' => 
    array (
      0 => 'D:\\www\\project\\ndedu.org\\tools\\shui/views\\post_status.tpl',
      1 => 1303983231,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '215994db934830f7182-41613837',
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
		<thead>
			<tr>
				<td>浏览量</td>
				<td>回复量</td>
				<td>查看时间</td>
			</tr>
		</thead>
		<tbody>
			<?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('post_status')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
?>
			<tr>
				<td><?php echo $_smarty_tpl->tpl_vars['val']->value['view_num'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['val']->value['reply_num'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['val']->value['add_time'];?>
</td>
			</tr>
			<?php }} ?>
		</tbody>
	</table>	
</form>
</div>
<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>