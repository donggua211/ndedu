<?php 
require_once 'config.php';
require_once 'config.database.php';
require_once 'config.constant.php';
require_once 'function.common.php';
require_once 'class.database.php';
require_once 'model.base.php';
require_once 'smarty/Smarty.class.php';

date_default_timezone_set('PRC');

define('PATH_ROOT', realpath(dirname(dirname(__FILE__))).'/');
define('PATH_INCLUDE', PATH_ROOT.'/includes/');

//链接数据库.
$db = get_db_obj();

//view 对象
$smarty = new Smarty();

$smarty->setTemplateDir(PATH_ROOT.'views');
$smarty->setCompileDir(PATH_INCLUDE.'smarty/templates_c');
$smarty->setCacheDir(PATH_INCLUDE.'smarty/cache');
$smarty->setConfigDir(PATH_INCLUDE.'smarty/configs');


?>