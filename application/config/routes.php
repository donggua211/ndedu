<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
| 	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['scaffolding_trigger'] = 'scaffolding';
|
| This route lets you set a "secret" word that will trigger the
| scaffolding feature for added security. Note: Scaffolding must be
| enabled in the controller in which you intend to use it.   The reserved 
| routes must come before any wildcard or regular expression routes.
|
*/

/* compatible for both the upper and lower case of controller's name*/
$route['topgrowth'] = "topGrowth";
$route['topgrowth/(:any)'] = "topGrowth/$1";
$route['usergrowth'] = "userGrowth";
$route['usergrowth/(:any)'] = "userGrowth/$1";
$route['articlecat/(:num)'] = "articleCat/index/$1";
$route['articlecat/(:num)/(:num)'] = "articleCat/index/$1/$2";
$route['growthglan'] = "growthPlan";
$route['growthglan/(:any)'] = "growthPlan/index/$1";
$route['tutorplan'] = "tutorPlan";
$route['tutorplan/(:any)'] = "tutorPlan/index/$1";

$route['default_controller'] = "entry";
$route['scaffolding_trigger'] = "scaffolding";

$route['article/(:num)'] = "article/index/$1";
$route['article/(:num)/(:num)'] = "article/index/$1/$2";
$route['article/(:num)/(:num)/(:num)'] = "article/index/$1/$2/$3";

$route['articleCat/(:num)'] = "articleCat/index/$1";
$route['articleCat/(:num)/(:num)'] = "articleCat/index/$1/$2";

$route['growthPlan/(:any)'] = "growthPlan/index/$1";
$route['tutorPlan/(:any)'] = "tutorPlan/index/$1";
$route['primaryEdu/(:any)'] = "short_article/primaryEdu/index/$1";
$route['primaryEdu2/(:any)'] = "short_article/primaryEdu2/index/$1";
$route['primaryEdu3/(:any)'] = "short_article/primaryEdu3/index/$1";
$route['primaryEdu4/(:any)'] = "short_article/primaryEdu4/index/$1";
$route['primaryEdu5/(:any)'] = "short_article/primaryEdu5/index/$1";
$route['primaryEdu6/(:any)'] = "short_article/primaryEdu6/index/$1";
$route['primaryEdu7/(:any)'] = "short_article/primaryEdu7/index/$1";
$route['primaryEdu8/(:any)'] = "short_article/primaryEdu8/index/$1";
$route['primaryEdu9/(:any)'] = "short_article/primaryEdu9/index/$1";
$route['primaryEdu10/(:any)'] = "short_article/primaryEdu10/index/$1";
$route['primaryEdu11/(:any)'] = "short_article/primaryEdu11/index/$1";
$route['primaryEdu12/(:any)'] = "short_article/primaryEdu12/index/$1";
$route['primaryEdu13/(:any)'] = "short_article/primaryEdu13/index/$1";
$route['primaryEdu14/(:any)'] = "short_article/primaryEdu14/index/$1";
$route['primaryEdu15/(:any)'] = "short_article/primaryEdu15/index/$1";
$route['primaryEdu16/(:any)'] = "short_article/primaryEdu16/index/$1";
$route['primaryEdu17/(:any)'] = "short_article/primaryEdu17/index/$1";
$route['primaryEdu18/(:any)'] = "short_article/primaryEdu18/index/$1";
$route['primaryEdu19/(:any)'] = "short_article/primaryEdu19/index/$1";
$route['primaryEdu20/(:any)'] = "short_article/primaryEdu20/index/$1";
$route['primaryEdu21/(:any)'] = "short_article/primaryEdu21/index/$1";
$route['primaryEdu22/(:any)'] = "short_article/primaryEdu22/index/$1";
$route['primaryEdu23/(:any)'] = "short_article/primaryEdu23/index/$1";
$route['primaryEdu24/(:any)'] = "short_article/primaryEdu24/index/$1";
$route['primaryEdu25/(:any)'] = "short_article/primaryEdu25/index/$1";
$route['primaryEdu26/(:any)'] = "short_article/primaryEdu26/index/$1";
$route['primaryEdu27/(:any)'] = "short_article/primaryEdu27/index/$1";
$route['primaryEdu28/(:any)'] = "short_article/primaryEdu28/index/$1";
$route['primaryEdu29/(:any)'] = "short_article/primaryEdu29/index/$1";
$route['middleEdu/(:any)'] = "short_article/middleEdu/index/$1";
$route['middleEdu2/(:any)'] = "short_article/middleEdu2/index/$1";
$route['middleEdu3/(:any)'] = "short_article/middleEdu3/index/$1";
$route['middleEdu4/(:any)'] = "short_article/middleEdu4/index/$1";
$route['middleEdu5/(:any)'] = "short_article/middleEdu5/index/$1";
$route['middleEdu6/(:any)'] = "short_article/middleEdu6/index/$1";
$route['middleEdu7/(:any)'] = "short_article/middleEdu7/index/$1";
$route['middlePer/(:any)'] = "short_article/middlePer/index/$1";

$route['news'] = "articleCat/index/1";
$route['14'] = "articleCat/index/7";

$route['goldenLearningPlan'] = "article/index/7";
$route['1v1testing'] = "article/index/8";
$route['1v1interview'] = "article/index/9";
$route['personalFiles'] = "article/index/10";

$route['multiSubjectTutorial'] = "article/index/11";
$route['tutorialFlow'] = "article/index/12";
$route['internationalTrusteeship'] = "article/index/13";
$route['studyGroup'] = "article/index/14";
$route['nv1Tutorial'] = "article/index/15";

$route['planEffect'] = "article/index/16";
$route['improveScore'] = "article/index/17";
$route['graduateRate'] = "article/index/18";
$route['learningAbility'] = "article/index/19";
$route['growingAbility'] = "article/index/20";
$route['successfulMembers'] = "article/index/21";

$route['synBasis'] = "article/index/22";
$route['advancedImprove'] = "article/index/23";
$route['goldenConnect'] = "article/index/24";
$route['specialModule'] = "article/index/25";
$route['valueGrowth'] = "article/index/26";

$route['aboutUs'] = "article/index/27";
$route['advantage'] = "article/index/28";
$route['team'] = "article/index/29";
$route['gallery'] = "article/index/30";
$route['jobs'] = "article/index/31";

$route['contactUs'] = "staticPage/contactus";
$route['siteMap'] = "staticPage/siteMap";
$route['oo1'] = "staticPage/oo1";

$route['school'] = "school/article/9/0-0/1";
$route['school/article/(:any)/(:any)'] = "school/article/9/$1/$2";
$route['school/book'] = "school/dangdang/10/0-0/1";
$route['school/book/(:any)/(:any)'] = "school/dangdang/10/$1/$2";
$route['school/vedio'] = "school/dangdang/11/0-0/1";
$route['school/vedio/(:any)/(:any)'] = "school/dangdang/11/$1/$2";
$route['school/software'] = "school/dangdang/12/0-0/1";
$route['school/software/(:any)/(:any)'] = "school/dangdang/12/$1/$2";

$route['evaluate'] = "evaluate/index";
$route['evaluate/(:num)'] = "evaluate/doEvaluate/$1";

$route['register'] = "user/register";
$route['register/(:any)'] = "user/register/$1";
/* End of file routes.php */
/* Location: ./system/application/config/routes.php */