<?php /* Smarty version Smarty-3.0.7, created on 2011-05-06 11:18:36
         compiled from "D:\www\project\ndedu.org\tools\shui/views\posts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:285154dc3688c824243-33148795%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '72585f3f8429fe390babb5243a3032ce115d69f5' => 
    array (
      0 => 'D:\\www\\project\\ndedu.org\\tools\\shui/views\\posts.tpl',
      1 => 1304651913,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '285154dc3688c824243-33148795',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
<?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('posts')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['post']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['post']->iteration=0;
if ($_smarty_tpl->tpl_vars['post']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value){
 $_smarty_tpl->tpl_vars['post']->iteration++;
 $_smarty_tpl->tpl_vars['post']->last = $_smarty_tpl->tpl_vars['post']->iteration === $_smarty_tpl->tpl_vars['post']->total;
?>
	<h1><?php if ($_smarty_tpl->tpl_vars['post']->value['type']=='tie'){?><span style="color:#F4A460">百度贴吧 -- <?php echo $_smarty_tpl->tpl_vars['post']->value['site_name'];?>
</span><?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['post']->value['site_name'];?>
<?php }?></h1>
	<?php if (isset($_smarty_tpl->tpl_vars['post']->value['block'])){?>
		<?php  $_smarty_tpl->tpl_vars['block'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['post']->value['block']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['block']->key => $_smarty_tpl->tpl_vars['block']->value){
?>
			<h3><?php echo $_smarty_tpl->tpl_vars['block']->value['block_name'];?>
</h3>
			<table align="center" border="1" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
						<td>Title</td>
						<td>添加时间</td>
						<td>操作</td>
					</tr>
				</thead>
				<tbody>
					<?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['block']->value['post']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
?>
					<tr>
						<td>
							<?php echo $_smarty_tpl->tpl_vars['val']->value['status'];?>

							<?php if ($_smarty_tpl->tpl_vars['val']->value['status']==$_smarty_tpl->getVariable('POST_SITE_STATUS_AVAILABLE')->value){?>
								<a href="<?php echo $_smarty_tpl->tpl_vars['val']->value['post_url'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['val']->value['post_title'];?>
</a>
							<?php }else{ ?>
								<span class="color_r"><?php echo $_smarty_tpl->tpl_vars['val']->value['post_title'];?>

							<?php }?>
						</td>
						<td align="center"><?php echo $_smarty_tpl->tpl_vars['val']->value['add_time'];?>
</td>
						<td align="center">
							<?php if ($_smarty_tpl->tpl_vars['val']->value['status']==$_smarty_tpl->getVariable('POST_SITE_STATUS_AVAILABLE')->value){?>
								<a href="new_post_status.php?post=<?php echo $_smarty_tpl->tpl_vars['val']->value['post_site_id'];?>
">添加记录</a>
								<a href="post_status.php?post=<?php echo $_smarty_tpl->tpl_vars['val']->value['post_site_id'];?>
">查看记录</a>
								<a href="rm_post.php?post=<?php echo $_smarty_tpl->tpl_vars['val']->value['post_id'];?>
">删除记录</a>
							<?php }else{ ?>
								<a href="<?php echo $_smarty_tpl->tpl_vars['val']->value['post_url'];?>
" target="_blank">查看页面</a>
							<?php }?>
						</td>
					</tr>
					<?php }} ?>
				</tbody>
			</table>
		<?php }} ?>
	<?php }else{ ?>
		<table align="center" border="1" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<td>Title</td>
					<td>添加时间</td>
					<td>操作</td>
				</tr>
			</thead>
			<tbody>
				<?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['post']->value['post']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
?>
				<tr>
					<td>
						<?php if ($_smarty_tpl->tpl_vars['val']->value['status']==$_smarty_tpl->getVariable('POST_SITE_STATUS_AVAILABLE')->value){?>
							<a href="<?php echo $_smarty_tpl->tpl_vars['val']->value['post_url'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['val']->value['post_title'];?>
</a>
						<?php }else{ ?>
							<span class="color_r"><?php echo $_smarty_tpl->tpl_vars['val']->value['post_title'];?>

						<?php }?>
					</td>
					<td align="center"><?php echo $_smarty_tpl->tpl_vars['val']->value['add_time'];?>
</td>
					<td align="center">
						<?php if ($_smarty_tpl->tpl_vars['val']->value['status']==$_smarty_tpl->getVariable('POST_SITE_STATUS_AVAILABLE')->value){?>
							<a href="new_post_status.php?post=<?php echo $_smarty_tpl->tpl_vars['val']->value['post_site_id'];?>
">添加记录</a>
							<a href="post_status.php?post=<?php echo $_smarty_tpl->tpl_vars['val']->value['post_site_id'];?>
">查看记录</a>
							<a href="rm_post.php?post=<?php echo $_smarty_tpl->tpl_vars['val']->value['post_id'];?>
">删除记录</a>
						<?php }else{ ?>
							<a href="<?php echo $_smarty_tpl->tpl_vars['val']->value['post_url'];?>
" target="_blank">查看页面</a>
						<?php }?>
					</td>
				</tr>
				<?php }} ?>
			</tbody>
		</table>
	<?php }?>
	<?php if (!$_smarty_tpl->tpl_vars['post']->last){?><hr><?php }?>
<?php }} ?>
<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>