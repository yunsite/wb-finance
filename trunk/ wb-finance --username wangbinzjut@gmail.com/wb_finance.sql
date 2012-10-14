-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 10 月 14 日 06:07
-- 服务器版本: 5.5.20
-- PHP 版本: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `wb_finance`
--

-- --------------------------------------------------------

--
-- 表的结构 `wb_bill`
--

CREATE TABLE IF NOT EXISTS `wb_bill` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `userId` tinyint(4) NOT NULL,
  `money` float NOT NULL,
  `categoryId` tinyint(4) NOT NULL,
  `typeId` tinyint(4) NOT NULL,
  `time` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- 转存表中的数据 `wb_bill`
--

INSERT INTO `wb_bill` (`id`, `userId`, `money`, `categoryId`, `typeId`, `time`) VALUES
(25, 2, 113, 4, 0, '2012-10-19'),
(26, 2, 123, 4, 0, '2012-10-03'),
(27, 2, 57, 4, 0, '2012-10-03'),
(31, 1, 100, 0, 1, '2012-10-03'),
(34, 1, 111, 4, 0, '2012-10-02'),
(35, 1, 150, 4, 0, '2012-10-05'),
(36, 1, 50, 1, 1, '2012-10-02'),
(46, 2, 12, 0, 1, '2012-10-02'),
(47, 2, 12.46, 4, 0, '2012-10-03'),
(48, 2, 12.4, 4, 0, '2012-10-04'),
(49, 2, 100, 0, 1, '2012-01-03'),
(50, 2, 100, 0, 1, '2012-02-07'),
(52, 2, 100, 0, 1, '2012-03-24'),
(53, 2, 100, 0, 1, '2012-04-04'),
(54, 2, 100, 0, 1, '2012-05-07'),
(55, 2, 102, 0, 1, '2012-06-14'),
(56, 2, 20, 0, 1, '2012-07-03'),
(57, 2, 100, 0, 1, '2012-08-07'),
(58, 2, 53, 0, 1, '2012-09-18'),
(59, 2, 72, 1, 1, '2012-11-08'),
(60, 2, 65, 0, 1, '2012-12-12'),
(61, 2, 100, 0, 1, '2010-02-01'),
(62, 2, 154, 0, 1, '2011-02-01');

-- --------------------------------------------------------

--
-- 表的结构 `wb_category`
--

CREATE TABLE IF NOT EXISTS `wb_category` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `item` varchar(50) NOT NULL,
  `typeId` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `wb_category`
--

INSERT INTO `wb_category` (`id`, `item`, `typeId`) VALUES
(0, '校园卡', 1),
(1, '话费', 1),
(2, '电费', 1),
(3, '吃饭', 1),
(4, '工资', 0),
(10, '11', 1),
(11, '22', 0);

-- --------------------------------------------------------

--
-- 表的结构 `wb_type`
--

CREATE TABLE IF NOT EXISTS `wb_type` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `item` varchar(12) NOT NULL,
  PRIMARY KEY (`id`,`item`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wb_type`
--

INSERT INTO `wb_type` (`id`, `item`) VALUES
(0, '收入'),
(1, '支出');

-- --------------------------------------------------------

--
-- 表的结构 `wb_user`
--

CREATE TABLE IF NOT EXISTS `wb_user` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  `reg_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `wb_user`
--

INSERT INTO `wb_user` (`id`, `name`, `pwd`, `reg_time`) VALUES
(1, 'wangbin', 'e10adc3949ba59abbe56e057f20f883e', '2012-01-01 02:23:23'),
(2, 'www', '202cb962ac59075b964b07152d234b70', '2012-01-01 02:23:12'),
(7, 'wangting', 'e10adc3949ba59abbe56e057f20f883e', '2012-01-01 02:23:04'),
(8, '汪斌', 'e10adc3949ba59abbe56e057f20f883e', '2012-01-01 02:23:09'),
(9, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2012-01-01 02:23:04');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
