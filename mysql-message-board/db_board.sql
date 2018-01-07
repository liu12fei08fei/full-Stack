-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: 2018-01-07 12:30:51
-- 服务器版本： 5.6.35
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `db_board`
--

-- --------------------------------------------------------

--
-- 表的结构 `t_message`
--

CREATE TABLE `t_message` (
  `id` int(11) NOT NULL COMMENT '留言id',
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `time` int(11) NOT NULL COMMENT '时间',
  `content` longtext NOT NULL COMMENT '内容'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='存储用户留言';

--
-- 转存表中的数据 `t_message`
--

INSERT INTO `t_message` (`id`, `username`, `title`, `time`, `content`) VALUES
(1, '颜真卿', '《劝学诗》', 1515298788, '黑发不知勤学早，白首方悔读书迟。\r\n三更灯火五更鸡，正是男儿读书时。'),
(3, '陆游', '《冬夜读书示子聿》', 1515299029, '古人学问无遗力，少壮工夫老始成。 纸上得来终觉浅，绝知此事要躬行。 '),
(4, '杜甫', '《春望》', 1515299042, '国破山河在，城春草木深。 '),
(5, '王贞白', '《白鹿洞二首·其一》', 1515299057, '读书不觉已春深，一寸光阴一寸金。 '),
(6, '徐锡麟', '《出塞》', 1515299072, '只解沙场为国死，何须马革裹尸还。 '),
(7, '杜牧', '《泊秦淮》', 1515299086, '商女不知亡国恨，隔江犹唱后庭花。 '),
(8, '林则徐', '《赴戍登程口占示家人·其二》', 1515299098, '苟利国家生死以，岂因祸福避趋之！谪居正是君恩厚，养拙刚于戍卒宜。 '),
(9, '孟子及其弟子', '《生于忧患死于安乐》', 1515299110, '入则无法家拂士，出则无敌国外患者，国恒亡。 ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_message`
--
ALTER TABLE `t_message`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `t_message`
--
ALTER TABLE `t_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '留言id', AUTO_INCREMENT=11;