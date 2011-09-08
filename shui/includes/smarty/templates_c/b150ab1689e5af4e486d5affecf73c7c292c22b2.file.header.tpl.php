<?php /* Smarty version Smarty-3.0.7, created on 2011-05-06 11:14:52
         compiled from "D:\www\project\ndedu.org\tools\shui/views\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:125644db9289013e285-46856597%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b150ab1689e5af4e486d5affecf73c7c292c22b2' => 
    array (
      0 => 'D:\\www\\project\\ndedu.org\\tools\\shui/views\\header.tpl',
      1 => 1303983540,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '125644db9289013e285-46856597',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $_smarty_tpl->getVariable('title')->value;?>
</title>
	<link href="css/css.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="nav">
	<ul>
		<li><a href="index.php">站点列表</a></li>
		<li><a href="posts.php">帖子列表</a></li>
		<li><a href="new_post.php?type=bbs">发布帖子(bbs)</a></li>
		<li><a href="new_post.php?type=tie">发布帖子(tieba)</a></li>
	</ul>
</div>
<div class="clearfix"></div>
<div class="wrap">