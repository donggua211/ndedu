-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2010 年 11 月 08 日 10:35
-- 服务器版本: 5.1.36
-- PHP 版本: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `ndedu`
--

-- --------------------------------------------------------

--
-- 表的结构 `ndedu_crm_contact_history`
--

DROP TABLE IF EXISTS `ndedu_crm_contact_history`;
CREATE TABLE IF NOT EXISTS `ndedu_crm_contact_history` (
  `contact_history_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(10) unsigned NOT NULL,
  `contact_history` longtext NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`contact_history_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `ndedu_crm_contact_history`
--

INSERT INTO `ndedu_crm_contact_history` (`contact_history_id`, `student_id`, `contact_history`, `update_time`) VALUES
(1, 4, '10月21号 打电话 没人接', '2010-11-08 12:26:25');

-- --------------------------------------------------------

--
-- 表的结构 `ndedu_crm_employee`
--

DROP TABLE IF EXISTS `ndedu_crm_employee`;
CREATE TABLE IF NOT EXISTS `ndedu_crm_employee` (
  `employee_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `add_time` datetime NOT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `ndedu_crm_employee`
--

INSERT INTO `ndedu_crm_employee` (`employee_id`, `name`, `password`, `is_active`, `add_time`) VALUES
(1, 'admin', 'd528a42b38301d4eda7792e0419bf853', 1, '2010-10-26 18:26:26'),
(2, 'teacher', '8d788385431273d11e8b43bb78f3aa41', 1, '2010-11-02 10:53:26'),
(3, 'consultant', '7adfa4f2ba9323e6c1e024de375434b0', 1, '2010-11-02 10:53:54');

-- --------------------------------------------------------

--
-- 表的结构 `ndedu_crm_employee_group`
--

DROP TABLE IF EXISTS `ndedu_crm_employee_group`;
CREATE TABLE IF NOT EXISTS `ndedu_crm_employee_group` (
  `employee_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`employee_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ndedu_crm_employee_group`
--

INSERT INTO `ndedu_crm_employee_group` (`employee_id`, `group_id`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- 表的结构 `ndedu_crm_group`
--

DROP TABLE IF EXISTS `ndedu_crm_group`;
CREATE TABLE IF NOT EXISTS `ndedu_crm_group` (
  `group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `ndedu_crm_group`
--

INSERT INTO `ndedu_crm_group` (`group_id`, `description`) VALUES
(1, 'administrator'),
(2, '班主任'),
(3, '咨询师');

-- --------------------------------------------------------

--
-- 表的结构 `ndedu_crm_student`
--

DROP TABLE IF EXISTS `ndedu_crm_student`;
CREATE TABLE IF NOT EXISTS `ndedu_crm_student` (
  `student_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_name` varchar(30) NOT NULL,
  `student_phone` varchar(15) NOT NULL,
  `student_grade` varchar(30) NOT NULL,
  `student_learning_status` text NOT NULL,
  `father_name` varchar(30) NOT NULL,
  `father_phone` varchar(15) NOT NULL,
  `mother_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `mother_phone` varchar(15) NOT NULL,
  `remark` text NOT NULL,
  `add_time` datetime NOT NULL,
  `status` tinyint(2) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `ndedu_crm_student`
--

INSERT INTO `ndedu_crm_student` (`student_id`, `student_name`, `student_phone`, `student_grade`, `student_learning_status`, `father_name`, `father_phone`, `mother_name`, `mother_phone`, `remark`, `add_time`, `status`) VALUES
(1, 'asdasdas', 'asdasd', 'asdsada', 'sdasdasdas', 'dasdsadsad', '13', 'asdsad', '', '', '2010-11-03 17:11:38', 0),
(2, '赵远', '13426193755', '大学五年级', '学习很差.', '赵合清', '13567678899', '王甘露', '', '这是备注, 要写长一点啊', '2010-11-06 16:11:17', 0),
(3, '朱贺', '1312839283217', '小二大班', '不好好学习', '朱红定', 'q23123123', '', '', '备注备注备注备注备注备注备注备注备注备注', '2010-11-06 17:11:54', 0),
(4, '兰雪达', '23172873182', '初中一年级', '爱好画画', '蓝爸爸', '1273812738123', '', '', '.student_border {\n	border: #525c3d 1px solid; border-collapse: collapse; empty-cells: show\n}\n.student_border td {\n	line-height:25px;border:#525c3d 1px solid; padding-left:2px; padding-right:2px;\n}\n\n', '2010-11-06 17:11:58', 0);

-- --------------------------------------------------------

--
-- 表的结构 `ndedu_crm_student_employee`
--

DROP TABLE IF EXISTS `ndedu_crm_student_employee`;
CREATE TABLE IF NOT EXISTS `ndedu_crm_student_employee` (
  `student_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  PRIMARY KEY (`student_id`,`employee_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ndedu_crm_student_employee`
--

INSERT INTO `ndedu_crm_student_employee` (`student_id`, `employee_id`) VALUES
(3, 0),
(4, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ndedu_crm_study_history`
--

DROP TABLE IF EXISTS `ndedu_crm_study_history`;
CREATE TABLE IF NOT EXISTS `ndedu_crm_study_history` (
  `study_history_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(10) unsigned NOT NULL,
  `study_history` longtext NOT NULL,
  `last_update_time` datetime NOT NULL,
  PRIMARY KEY (`study_history_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `ndedu_crm_study_history`
--

INSERT INTO `ndedu_crm_study_history` (`study_history_id`, `student_id`, `study_history`, `last_update_time`) VALUES
(1, 4, '10月1号上了一节课, 还行, 不错', '2010-11-08 00:00:00');
