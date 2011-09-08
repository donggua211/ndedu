<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);
define('SITE_NAME', 'image');
/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ', 							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 					'ab');
define('FOPEN_READ_WRITE_CREATE', 				'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 			'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
 * Constans for Admin Panel
 */
 define('STUDENT_PER_PAGE', 15); //每页显示15个学员
 define('STAFF_PER_PAGE', 15); //每页显示15个员工
 define('DOCUMENT_PER_PAGE', 10); //每页显示15个学员
 
/*student status*/
define('STUDENT_STATUS_NOT_SIGNUP', 1); //未报名(0)
define('STUDENT_STATUS_SIGNUP', 2); //已报名(1)
define('STUDENT_STATUS_LEARNING', 3); //正在学(2)
define('STUDENT_STATUS_FINISHED', 4); //已学完(3)
define('STUDENT_STATUS_INACTIVE', 5); //注销(4)


/*GROUP ID for admin panel */
define('GROUP_ADMIN', 1);
define('GROUP_SCHOOLADMIN', 2);
define('GROUP_CONSULTANT', 3);
define('GROUP_SUPERVISOR', 4);
define('GROUP_TEACHER', 5);

/*region ID*/
define('REGION_PROVINCE', 1);
define('REGION_CITY', 2);
define('REGION_DISTRICT', 3);

/*grade ID*/
define('GRADE_PARENT', 0);
define('GRADE_CHILDREN', 1);

/*contract status*/
define('CONTRACT_STATUS_AVAILABLE', 1);
define('CONTRACT_STATUS_EXPIRED', 2);
define('CONTRACT_STATUS_FINISHED', 3);

/* Calendar */
define('DAY_OF_WEEK_START', 1); //适于周一

/* Guestbook */
define('GUESTBOOK_MESSAGE_PER_PAGE', 20);

/* Dangdang */
define('DANGDANG_BOOK_CAT_ID', 10);
define('DANGDANG_VIDEO_CAT_ID', 11);
define('DANGDANG_SOFTWARE_CAT_ID', 12);

/* End of file constants.php */
/* Location: ./system/application/config/constants.php */