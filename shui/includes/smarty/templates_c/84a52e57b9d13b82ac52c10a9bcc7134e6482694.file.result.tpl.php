<?php /* Smarty version Smarty-3.0.7, created on 2011-05-06 11:14:59
         compiled from "D:\www\project\ndedu.org\tools\shui/views\result.tpl" */ ?>
<?php /*%%SmartyHeaderCode:66074db925de05e201-57655836%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '84a52e57b9d13b82ac52c10a9bcc7134e6482694' => 
    array (
      0 => 'D:\\www\\project\\ndedu.org\\tools\\shui/views\\result.tpl',
      1 => 1303983540,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '66074db925de05e201-57655836',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
<div class="<?php if ($_smarty_tpl->getVariable('type')->value=='error'){?>error<?php }else{ ?>result<?php }?>">
	<h1><?php if ($_smarty_tpl->getVariable('type')->value=='error'){?>失败!!<?php }else{ ?>成功<?php }?></h1>
	<div class="text"><?php echo $_smarty_tpl->getVariable('result')->value;?>
</div>
	<div class="result_link"><a href="<?php echo $_smarty_tpl->getVariable('back_url')->value;?>
">返回</a></div>
</div>
<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>