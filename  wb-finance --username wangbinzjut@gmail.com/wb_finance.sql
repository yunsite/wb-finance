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
(4, '工资', 0);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
