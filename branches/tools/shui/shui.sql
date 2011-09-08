-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2011 年 04 月 27 日 09:00
-- 服务器版本: 5.5.8
-- PHP 版本: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `shui`
--

-- --------------------------------------------------------

--
-- 表的结构 `shui_post`
--

DROP TABLE IF EXISTS `shui_post`;
CREATE TABLE IF NOT EXISTS `shui_post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `site_block_id` int(11) NOT NULL,
  `post_title` varchar(100) NOT NULL,
  `post_url` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `add_time` datetime NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- 转存表中的数据 `shui_post`
--

INSERT INTO `shui_post` (`post_id`, `site_id`, `site_block_id`, `post_title`, `post_url`, `status`, `add_time`) VALUES
(1, 1, 1, '【我的教育经历】 我的第一名学生 -- 小康', 'http://club.edu.sina.com.cn/viewthread.php?tid=1874879&page=1', 1, '0000-00-00 00:00:00'),
(2, 1, 6, '【让孩子爱上家务活的12个技巧】', 'http://club.edu.sina.com.cn/viewthread.php?tid=1875071&page=1', 1, '0000-00-00 00:00:00'),
(3, 2, 0, '【我的教育经历】 我的第一名学生 -- 小康', 'http://bbs.education.163.com/bbs/jiaoyu/208742148.html', 1, '0000-00-00 00:00:00'),
(4, 2, 0, '【让孩子爱上家务活的12个技巧】', 'http://bbs.education.163.com/bbs/jiaoyu/208752530.html', 1, '0000-00-00 00:00:00'),
(5, 4, 5, '【我的教育经历】 我的第一名学生 -- 小康', 'http://bbs.edu.qq.com/b-1000090386/11374.htm', 1, '0000-00-00 00:00:00'),
(6, 4, 4, '【让孩子爱上家务活的12个技巧】', 'http://bbs.edu.qq.com/b-1000090387/12646.htm', 1, '0000-00-00 00:00:00'),
(7, 1, 1, '【我的教育经历】 我的第一名学生——小康之（二）：”第二次见面“', 'http://club.edu.sina.com.cn/viewthread.php?tid=1876628&pid=15335863&extra=page%3D1&frombbs=1', 1, '2011-04-26 16:17:54'),
(8, 2, 0, '【我的教育经历】 我的第一名学生——小康之（二）：“第二次见面”', 'http://bbs.education.163.com/bbs/jiaoyu/208971667.html', 1, '2011-04-26 16:22:22'),
(9, 4, 7, '【我的教育经历】 我的第一名学生——小康之（二）：第二次见面', 'http://bbs.edu.qq.com/b-1000090399/19258.htm', 1, '2011-04-26 16:25:25'),
(41, 8, 0, '药家鑫的昨天', 'http://tieba.baidu.com/f?kz=1062748235', 1, '2011-04-27 07:32:03'),
(42, 10, 0, '药家鑫的昨天', 'http://tieba.baidu.com/f?kz=1062756014', 1, '2011-04-27 07:34:34'),
(43, 1, 1, '药家鑫的昨天', 'http://club.edu.sina.com.cn/viewthread.php?tid=1877489&pid=15337785&extra=page%3D1&frombbs=1', 1, '2011-04-27 08:17:55'),
(44, 1, 1, '《家常菜》中何文达', 'http://club.edu.sina.com.cn/viewthread.php?tid=1877491&pid=15337788&extra=&frombbs=1', 1, '2011-04-27 08:18:57'),
(45, 2, 0, '药家鑫的昨天', 'http://bbs.education.163.com/bbs/jiaoyu/209070663.html', 1, '2011-04-27 08:22:03'),
(46, 2, 0, '《家常菜》中何文达', 'http://bbs.education.163.com/bbs/jiaoyu/209070825.html', 1, '2011-04-27 08:22:58'),
(47, 2, 0, '那些乞讨、流浪的儿童', 'http://bbs.education.163.com/bbs/jiaoyu/209071004.html', 1, '2011-04-27 08:24:14'),
(48, 1, 6, '那些乞讨、流浪的儿童', 'http://club.edu.sina.com.cn/viewthread.php?tid=1877500&pid=15337807&extra=page%3D1&frombbs=1', 1, '2011-04-27 08:25:14'),
(49, 4, 7, '药家鑫的昨天', 'http://bbs.edu.qq.com/b-1000090399/19268.htm', 1, '2011-04-27 08:26:34'),
(50, 4, 7, '《家常菜》中何文达', 'http://bbs.edu.qq.com/b-1000090399/19269.htm', 1, '2011-04-27 08:28:28'),
(51, 4, 7, '药家鑫的昨天', 'http://bbs.edu.qq.com/b-1000090399/19270.htm', 1, '2011-04-27 08:29:08'),
(52, 5, 8, '药家鑫的昨天', 'http://bbs.eol.cn/viewthread.php?tid=1586941', 1, '2011-04-27 08:30:57'),
(53, 5, 8, '《家常菜》中何文达', 'http://bbs.eol.cn/viewthread.php?tid=1586942', 1, '2011-04-27 08:31:38'),
(54, 6, 11, '《家常菜》中何文达', '', 1, '2011-04-27 08:38:24'),
(55, 6, 11, '药家鑫的昨天', '', 1, '2011-04-27 08:39:31'),
(56, 7, 12, '药家鑫的昨天', 'http://home.xdf.cn/forum.php?mod=viewthread&tid=68942&extra=', 1, '2011-04-27 08:41:55'),
(57, 7, 12, '《家常菜》中何文达', 'http://home.xdf.cn/forum.php?mod=viewthread&tid=68944&extra=', 1, '2011-04-27 08:42:33'),
(58, 7, 12, '那些乞讨、流浪的儿童', 'http://home.xdf.cn/forum.php?mod=viewthread&tid=68945&extra=', 1, '2011-04-27 08:44:12');

-- --------------------------------------------------------

--
-- 表的结构 `shui_post_status`
--

DROP TABLE IF EXISTS `shui_post_status`;
CREATE TABLE IF NOT EXISTS `shui_post_status` (
  `post_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `view_num` int(11) NOT NULL,
  `reply_num` int(11) NOT NULL,
  `add_time` datetime NOT NULL,
  PRIMARY KEY (`post_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `shui_post_status`
--


-- --------------------------------------------------------

--
-- 表的结构 `shui_sites`
--

DROP TABLE IF EXISTS `shui_sites`;
CREATE TABLE IF NOT EXISTS `shui_sites` (
  `site_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(50) NOT NULL,
  `site_url` varchar(100) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` enum('bbs','tie') NOT NULL DEFAULT 'bbs',
  `status` tinyint(4) NOT NULL,
  `add_time` datetime NOT NULL,
  PRIMARY KEY (`site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- 转存表中的数据 `shui_sites`
--

INSERT INTO `shui_sites` (`site_id`, `site_name`, `site_url`, `user_name`, `password`, `type`, `status`, `add_time`) VALUES
(1, '新浪 - 教育论坛', 'http://club.edu.sina.com.cn/', 'yourgrow@gmail.com', '1q1q1q1q', 'bbs', 1, '2011-04-26 12:31:25'),
(2, '网易教育论坛', 'http://bbs.education.163.com/', 'ndedu@ndedu.org', '000000a', 'bbs', 1, '2011-04-26 12:31:25'),
(3, '搜狐教育论坛', 'http://club.learning.sohu.com/newleft/left_frame.php?channel=learning#class15', 'yourgrow@gmail.com', '1q1q1q1q', 'bbs', 2, '2011-04-26 12:31:25'),
(4, '腾讯教育论坛', 'http://bbs.qq.com/navi.htm?f=63#preExpand=63&preType=0', '378138800', '1q1q1q1q', 'bbs', 1, '2011-04-26 12:31:25'),
(5, '教育在线社区', 'http://bbs.eol.cn/frame.php?frameon=yes&referer=http%3A//bbs.eol.cn/', 'ndedu1@ndedu.org', '000000', 'bbs', 1, '2011-04-26 12:31:25'),
(6, 'e度论坛--北京', 'http://bbs.eduu.com/', 'ndedu1', '000000', 'bbs', 3, '2011-04-26 12:35:19'),
(7, '新东方 - 论坛', 'http://home.xdf.cn/forum.php', 'ndedu1@ndedu.org', '000000', 'bbs', 3, '2011-04-26 12:35:19'),
(8, '初中生', 'http://tieba.baidu.com/f?kw=%B3%F5%D6%D0%C9%FA', '', '', 'tie', 1, '2011-04-26 12:31:25'),
(9, '中小学辅导', 'http://tieba.baidu.com/f?kw=%D6%D0%D0%A1%D1%A7%B8%A8%B5%BC', '', '', 'tie', 1, '2011-04-26 12:31:25'),
(10, '中考', 'http://tieba.baidu.com/f?kw=%D6%D0%BF%BC', '', '', 'tie', 1, '2011-04-26 12:31:25'),
(11, '初中数学', 'http://tieba.baidu.com/f?kw=%B3%F5%D6%D0%CA%FD%D1%A7', '', '', 'tie', 1, '2011-04-26 12:31:25'),
(12, '高中数学', 'http://tieba.baidu.com/f?kw=%B8%DF%D6%D0%CA%FD%D1%A7', '', '', 'tie', 1, '2011-04-26 12:31:25'),
(13, '老师', 'http://tieba.baidu.com/f?kw=%C0%CF%CA%A6', '', '', 'tie', 1, '2011-04-26 12:31:25'),
(14, '一对一', 'http://tieba.baidu.com/f?kw=%D2%BB%B6%D4%D2%BB', '', '', 'tie', 1, '2011-04-26 12:31:25'),
(15, '作业', 'http://tieba.baidu.com/f?kw=%D7%F7%D2%B5', '', '', 'tie', 1, '2011-04-26 12:31:25');

-- --------------------------------------------------------

--
-- 表的结构 `shui_site_block`
--

DROP TABLE IF EXISTS `shui_site_block`;
CREATE TABLE IF NOT EXISTS `shui_site_block` (
  `site_block_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `block_name` varchar(50) NOT NULL,
  `block_url` varchar(100) NOT NULL,
  `add_time` datetime NOT NULL,
  PRIMARY KEY (`site_block_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `shui_site_block`
--

INSERT INTO `shui_site_block` (`site_block_id`, `site_id`, `block_name`, `block_url`, `add_time`) VALUES
(1, 1, '大话教育', 'http://club.edu.sina.com.cn/bbs/forum-209-1.html', '2011-04-26 12:31:25'),
(2, 1, '初中·中考', 'http://club.edu.sina.com.cn/forum-24-1.html', '2011-04-26 12:31:25'),
(3, 1, '小学·小升初', 'http://club.edu.sina.com.cn/forum-219-1.html', '2011-04-26 12:31:25'),
(4, 4, '家长俱乐部', 'http://w.bbs.qq.com/b-1000090387', '2011-04-26 12:31:25'),
(5, 4, '教师心声 ', 'http://bbs.edu.qq.com/b-1000090386', '2011-04-26 12:31:25'),
(6, 1, '家长杂谈', 'http://club.edu.sina.com.cn/forumdisplay.php?fid=3', '2011-04-26 12:31:25'),
(7, 4, '漫画教育', 'http://bbs.edu.qq.com/b-1000090399', '2011-04-26 12:31:25'),
(8, 5, '家庭教育', 'http://bbs.eol.cn/forumdisplay.php?fid=337', '2011-04-27 10:50:46'),
(9, 6, '一年级', 'http://bbs.eduu.com/f.php?referer=http%3A//bbs.eduu.com/forum-560-1.html', '2011-04-27 10:50:46'),
(10, 7, '小学教育', 'http://home.xdf.cn/forum-48-1.html', '2011-04-27 10:50:46'),
(11, 6, '成长故事', 'http://bbs.eduu.com/f.php?referer=http%3A//bbs.eduu.com/forum-895-1.html', '2011-04-27 10:50:46'),
(12, 7, '休闲湖畔', 'http://home.xdf.cn/forum-70-1.html', '2011-04-27 10:50:46');
