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
define('STUDENT_STATUS_NOT_APPOINTMENT', 1); //未约访
define('STUDENT_STATUS_HAS_APPOINTMENT', 7); //已约访
define('STUDENT_STATUS_SIGNUP', 2); //已报名
define('STUDENT_STATUS_LEARNING', 3); //正在学
define('STUDENT_STATUS_FINISHED', 4); //已学完
define('STUDENT_STATUS_INACTIVE', 5); //注销


/*GROUP ID for admin panel */
define('GROUP_ADMIN', 1);				//管理员
define('GROUP_SCHOOLADMIN', 2);			//校区管理员
define('GROUP_CONSULTANT', 3);			//咨询师
define('GROUP_SUPERVISOR', 4);			//班主任
define('GROUP_CS', 7);					//课程顾问
define('GROUP_SUYANG', 8);				//素养课老师
define('GROUP_JIAOWU', 13);				//教务老师
define('GROUP_TEACHER_PARTTIME', 5);	//学科老师（兼职）
define('GROUP_TEACHER_FULL', 6);		//学科老师（全职）
define('GROUP_TEACHER_D', 9);			//学科主管
define('GROUP_CONSULTANT_D', 10);		//咨询主管
define('GROUP_SUYANG_D', 11);			//素养主管
define('GROUP_CS_D', 12);				//课程顾问主管
define('GROUP_JIAOWU_D', 14);			//教务主管

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

/* ceping */
define('CP_COMMENTS_PER_CAT', 5);
define('CP_CARD_PER_PAGE', 20);
define('CP_COMMENTS_PER_PAGE', 20);
define('CP_GEN_CARD_MAX', 5000);
//ceping card status
define('CP_CARD_STATUS_UNUSED', 1);
define('CP_CARD_STATUS_AGREED', 2);
define('CP_CARD_STATUS_STARTED', 3);
define('CP_CARD_STATUS_FINISHED', 4);
//ceping level
define('CP_LEVEL_ADVANCED', 1);
define('CP_LEVEL_LUXURY', 2);
//ceping comment status
define('CP_COMMENT_STATUS_NEW', 1); //新评论
define('CP_COMMENT_STATUS_REVIEWED', 2); //评论, 已验证
//ceping order status
define('CP_ORDER_STATUS_NEW', 1); //新订单
define('CP_ORDER_STATUS_CONFIRMED', 2); //订单以确认
define('CP_ORDER_STATUS_SHIPPED', 3); //订单已发货
//ceping order delivery type
define('CP_ORDER_DELIVERY_TYPE_PINGYOU', 1); //平邮
define('CP_ORDER_DELIVERY_TYPE_KUAIDI', 2); //快递公司
define('CP_ORDER_DELIVERY_TYPE_EMS', 3); //EMS
define('CP_ORDER_DELIVERY_TYPE_HUODAO', 4); //货到付款
//ceping order type
define('CP_ORDER_TYPE_NORMAL', 1); //普通购买卡
define('CP_ORDER_TYPE_PROMO', 2); //促销
define('CP_ORDER_TYPE_UPDATE', 3); //升级
//ceping quan
define('CP_QUAN_STATUS_NEW', 1);
define('CP_QUAN_STATUS_USED', 2);
define('CP_QUAN_USED_AT_NDEDU', 1);
define('CP_QUAN_USED_AT_TAOBAO', 2);
//ceping cat type
define('CP_CAT_TYPE_NORMAL', 1);
define('CP_CAT_TYPE_PROMO', 2);
//join us
define('JOIN_STATUS_START', 1);
define('JOIN_STATUS_SURVEY', 2);
define('JOIN_STATUS_FINISHED', 3);
define('JOIN_PER_PAGE', 20);

//给学管老师报警的剩余课数数
define('WARNING_REMAIN_HOURS', 10);

//员工转正的课时数
define('STAFF_BECOME_FULL_HOURS', 20);

//科目
define('SUBJECT_XUEKE', 1);
define('SUBJECT_SUYANG', 2);
define('SUBJECT_ZIXUN', 3);

//历史记录
define('HISTORY_DENY', 0);
define('HISTORY_R', 1);
define('HISTORY_WR', 2);
define('HISTORY_LEARNING_SEP', 'HISTORY_LEARNING_SEP');
define('HISTORY_TYPE_CONSULT', 1);
define('HISTORY_TYPE_SUYANG', 2);
define('HISTORY_TYPE_LEARNING', 3);

//sms 历史
define('SMS_HISTORY_PER_PAGE', 10);

//schedule
define('SCHEDULE_UNAVAILABLE', 0);
define('SCHEDULE_AVAILABLE', 1);
define('SCHEDULE_HAS_CLASS', 2);

//ticket
define('TICKET_PER_PAGE', 50);

//student teacher 对应关系
define('STUDENT_TEACHER_XUEKE', 1);
define('STUDENT_TEACHER_SUYANG', 2);
define('STUDENT_TEACHER_ZIXUN', 3);

//HR系统状态表
define('HR_PER_PAGE', 20);
define('HR_NOTICE_METHOD_MOBILE', 1);
define('HR_NOTICE_METHOD_SMS', 2);
define('HR_NOTICE_METHOD_EMAIL', 3);
define('HR_NOTICE_METHOD_SELF', 4);

define('HR_STATUS_NEW', 1);//新加
define('HR_STATUS_APPOINTMENT', 2);//已约访
define('HR_STATUS_NOT_COME', 3);//没来
define('HR_STATUS_COME', 4);//已来
define('HR_STATUS_OK', 5);//已来
define('HR_STATUS_NG', 6);//已来



/* End of file constants.php */
/* Location: ./system/application/config/constants.php */