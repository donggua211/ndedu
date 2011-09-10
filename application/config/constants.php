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
define('STUDENT_PER_PAGE', 15); //ÿҳ��ʾ15��ѧԱ
define('STAFF_PER_PAGE', 15); //ÿҳ��ʾ15��Ա��
define('DOCUMENT_PER_PAGE', 10); //ÿҳ��ʾ15��ѧԱ

/*student status*/
define('STUDENT_STATUS_NOT_APPOINTMENT', 1); //δԼ��
define('STUDENT_STATUS_HAS_APPOINTMENT', 7); //��Լ��
define('STUDENT_STATUS_SIGNUP', 2); //�ѱ���
define('STUDENT_STATUS_LEARNING', 3); //����ѧ
define('STUDENT_STATUS_FINISHED', 4); //��ѧ��
define('STUDENT_STATUS_INACTIVE', 5); //ע��


/*GROUP ID for admin panel */
define('GROUP_ADMIN', 1);			//����Ա
define('GROUP_SCHOOLADMIN', 2);		//У������Ա
define('GROUP_CONSULTANT', 3);		//��ѯʦ
define('GROUP_SUPERVISOR', 4);		//������
define('GROUP_CS', 7);				//�ͷ���ʦ
define('GROUP_TEACHER_PARTTIME', 5);//ѧ����ʦ����ְ��
define('GROUP_TEACHER_FULL', 6);	//ѧ����ʦ��ȫְ��
define('GROUP_SUYANG', 8);			//��������ʦ

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
define('DAY_OF_WEEK_START', 1); //������һ

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
define('CP_COMMENT_STATUS_NEW', 1); //������
define('CP_COMMENT_STATUS_REVIEWED', 2); //����, ����֤
//ceping order status
define('CP_ORDER_STATUS_NEW', 1); //�¶���
define('CP_ORDER_STATUS_CONFIRMED', 2); //������ȷ��
define('CP_ORDER_STATUS_SHIPPED', 3); //�����ѷ���
//ceping order delivery type
define('CP_ORDER_DELIVERY_TYPE_PINGYOU', 1); //ƽ��
define('CP_ORDER_DELIVERY_TYPE_KUAIDI', 2); //��ݹ�˾
define('CP_ORDER_DELIVERY_TYPE_EMS', 3); //EMS
define('CP_ORDER_DELIVERY_TYPE_HUODAO', 4); //��������
//ceping order type
define('CP_ORDER_TYPE_NORMAL', 1); //��ͨ����
define('CP_ORDER_TYPE_PROMO', 2); //����
define('CP_ORDER_TYPE_UPDATE', 3); //����
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

//��ѧ����ʦ������ʣ�������
define('WARNING_REMAIN_HOURS', 10);

//Ա��ת���Ŀ�ʱ��
define('STAFF_BECOME_FULL_HOURS', 20);

//��Ŀ
define('SUBJECT_SUYANG', 2);

//��ʷ��¼��Ȩ��.
define('HISTORY_RULE_READ', 1);
define('HISTORY_RULE_READ_WRITE', 2);

/* End of file constants.php */
/* Location: ./system/application/config/constants.php */