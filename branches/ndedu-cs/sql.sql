-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2011 年 01 月 26 日 13:52
-- 服务器版本: 5.1.36
-- PHP 版本: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `ndedu`
--

-- --------------------------------------------------------

--
-- 表的结构 `ndedu_ics_category`
--

CREATE TABLE IF NOT EXISTS `ndedu_ics_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `order` tinyint(4) NOT NULL,
  `add_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- 表的结构 `ndedu_ics_document`
--

CREATE TABLE IF NOT EXISTS `ndedu_ics_document` (
  `document_id` int(11) NOT NULL AUTO_INCREMENT,
  `document` text NOT NULL,
  `tags` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `is_delete` tinyint(4) NOT NULL,
  `add_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`document_id`),
  KEY `grade_id` (`grade_id`),
  KEY `is_delete` (`is_delete`),
  KEY `tags` (`tags`),
  KEY `provider_id` (`provider_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ndedu_ics_grade`
--

CREATE TABLE IF NOT EXISTS `ndedu_ics_grade` (
  `grade_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `grade_name` varchar(50) NOT NULL,
  `parent_id` smallint(5) NOT NULL,
  PRIMARY KEY (`grade_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `ndedu_ics_grade`
--

INSERT INTO `ndedu_ics_grade` (`grade_id`, `grade_name`, `parent_id`) VALUES
(1, '小学低年级', 0),
(2, '小学高年级', 0);

-- --------------------------------------------------------

--
-- 表的结构 `ndedu_ics_source`
--

CREATE TABLE IF NOT EXISTS `ndedu_ics_source` (
  `source_id` int(11) NOT NULL AUTO_INCREMENT,
  `source_desc` varchar(255) NOT NULL,
  `add_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`source_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ndedu_ics_source_doc`
--

CREATE TABLE IF NOT EXISTS `ndedu_ics_source_doc` (
  `source_doc_id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` int(11) NOT NULL,
  `source_id` int(11) NOT NULL,
  `add_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`source_doc_id`),
  KEY `document_id` (`document_id`),
  KEY `source_id` (`source_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
