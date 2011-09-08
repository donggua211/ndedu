-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- ����: localhost
-- ��������: 2011 �� 03 �� 06 �� 16:24
-- �������汾: 5.1.36
-- PHP �汾: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- ���ݿ�: `ndedu`
--

-- --------------------------------------------------------

--
-- ��Ľṹ `ndedu_cp_card`
--

DROP TABLE IF EXISTS `ndedu_cp_card`;
CREATE TABLE IF NOT EXISTS `ndedu_cp_card` (
  `card_id` int(10) unsigned NOT NULL,
  `cat_id` int(11) NOT NULL,
  `level` smallint(6) NOT NULL,
  `has_agreed` smallint(6) NOT NULL,
  `password` char(32) NOT NULL,
  `add_time` datetime NOT NULL,
  `status` smallint(6) NOT NULL,
  `start_time` datetime NOT NULL,
  `finished_time` datetime NOT NULL,
  PRIMARY KEY (`card_id`),
  KEY `cat_id` (`cat_id`,`level`,`has_agreed`,`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- ��Ľṹ `ndedu_cp_card_batch`
--

DROP TABLE IF EXISTS `ndedu_cp_card_batch`;
CREATE TABLE IF NOT EXISTS `ndedu_cp_card_batch` (
  `batch_id` int(10) unsigned NOT NULL,
  `last_sn` int(11) NOT NULL,
  `add_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`batch_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- ��Ľṹ `ndedu_cp_cat`
--

DROP TABLE IF EXISTS `ndedu_cp_cat`;
CREATE TABLE IF NOT EXISTS `ndedu_cp_cat` (
  `cat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(30) NOT NULL,
  `star` float NOT NULL,
  `price_luxury` float NOT NULL,
  `price_advanced` float NOT NULL,
  `des_luxury` text NOT NULL,
  `des_advanced` text NOT NULL,
  `add_time` datetime NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- ת����е����� `ndedu_cp_cat`
--

INSERT INTO `ndedu_cp_cat` (`cat_id`, `cat_name`, `star`, `price_luxury`, `price_advanced`, `des_luxury`, `des_advanced`, `add_time`) VALUES
(1, 'Сѧ��ѧϰ�������ͥ����ָ��������Сһ��С����', 4.5, 198, 268, '������������1��\n������������2��\n������������3��\n��������', '�߼���������1��\n�߼���������2��\n�߼���������3��\n�߼�����\nasdasdsad', '2011-03-05 20:57:56');

-- --------------------------------------------------------

--
-- ��Ľṹ `ndedu_cp_ceping`
--

DROP TABLE IF EXISTS `ndedu_cp_ceping`;
CREATE TABLE IF NOT EXISTS `ndedu_cp_ceping` (
  `cp_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `cp_name` varchar(255) NOT NULL,
  `cp_des` text NOT NULL,
  `add_time` datetime NOT NULL,
  PRIMARY KEY (`cp_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- ת����е����� `ndedu_cp_ceping`
--

INSERT INTO `ndedu_cp_ceping` (`cp_id`, `cat_id`, `cp_name`, `cp_des`, `add_time`) VALUES
(1, 1, '�������', '����������������.', '2011-03-05 23:41:33'),
(2, 1, '�������', '����������������.', '2011-03-05 23:52:26');

-- --------------------------------------------------------

--
-- ��Ľṹ `ndedu_cp_comment`
--

DROP TABLE IF EXISTS `ndedu_cp_comment`;
CREATE TABLE IF NOT EXISTS `ndedu_cp_comment` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `name` varchar(150) NOT NULL,
  `comment` text NOT NULL,
  `add_time` datetime NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- ת����е����� `ndedu_cp_comment`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `ndedu_cp_order`
--

DROP TABLE IF EXISTS `ndedu_cp_order`;
CREATE TABLE IF NOT EXISTS `ndedu_cp_order` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_sn` int(11) NOT NULL,
  `total_price` float NOT NULL,
  `status` smallint(6) NOT NULL,
  `add_time` datetime NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `order_sn` (`order_sn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- ת����е����� `ndedu_cp_order`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `ndedu_cp_order_action`
--

DROP TABLE IF EXISTS `ndedu_cp_order_action`;
CREATE TABLE IF NOT EXISTS `ndedu_cp_order_action` (
  `action_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `action_notes` varchar(255) NOT NULL,
  `from_status` smallint(6) NOT NULL,
  `to_status` smallint(6) NOT NULL,
  `add_time` datetime NOT NULL,
  PRIMARY KEY (`action_id`),
  KEY `order_id` (`order_id`,`staff_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- ת����е����� `ndedu_cp_order_action`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `ndedu_cp_order_detail`
--

DROP TABLE IF EXISTS `ndedu_cp_order_detail`;
CREATE TABLE IF NOT EXISTS `ndedu_cp_order_detail` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `province_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postcode` char(6) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `delivery_type` int(11) NOT NULL,
  `message` text NOT NULL,
  `add_time` datetime NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- ת����е����� `ndedu_cp_order_detail`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `ndedu_cp_order_list`
--

DROP TABLE IF EXISTS `ndedu_cp_order_list`;
CREATE TABLE IF NOT EXISTS `ndedu_cp_order_list` (
  `order_list_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `cat_type` int(11) NOT NULL,
  `add_time` datetime NOT NULL,
  PRIMARY KEY (`order_list_id`),
  KEY `order_id` (`order_id`,`cat_id`,`cat_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- ת����е����� `ndedu_cp_order_list`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `ndedu_cp_result`
--

DROP TABLE IF EXISTS `ndedu_cp_result`;
CREATE TABLE IF NOT EXISTS `ndedu_cp_result` (
  `result_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `card_id` int(11) NOT NULL,
  `result` text NOT NULL,
  `add_time` datetime NOT NULL,
  PRIMARY KEY (`result_id`),
  KEY `card_id` (`card_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- ת����е����� `ndedu_cp_result`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `ndedu_cp_userinfo`
--

DROP TABLE IF EXISTS `ndedu_cp_userinfo`;
CREATE TABLE IF NOT EXISTS `ndedu_cp_userinfo` (
  `userinfo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `card_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `school` varchar(50) NOT NULL,
  `province_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `add_time` datetime NOT NULL,
  PRIMARY KEY (`userinfo_id`),
  KEY `card_id` (`card_id`,`province_id`,`city_id`,`district_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- ת����е����� `ndedu_cp_userinfo`
--

