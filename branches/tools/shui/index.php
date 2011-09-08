<?php
require_once 'includes/header.php'; 
require_once 'includes/model.site.php';

//model 对象
$site_model = new site_model();

$smarty->assign('title', 'sites 列表');
$smarty->assign('sites', $site_model->list_site());
$smarty->display('index.tpl');
?>