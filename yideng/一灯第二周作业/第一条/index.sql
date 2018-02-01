-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: 2018-02-01 10:09:02
-- 服务器版本： 5.6.35
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `db_yideng`
--

-- --------------------------------------------------------

--
-- 表的结构 `t_praise`
--

CREATE TABLE `t_praise` (
  `id` int(50) NOT NULL COMMENT 'id',
  `num` int(50) NOT NULL COMMENT '点赞数'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `t_praise`
--

INSERT INTO `t_praise` (`id`, `num`) VALUES
(1, 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_praise`
--
ALTER TABLE `t_praise`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `t_praise`
--
ALTER TABLE `t_praise`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=3;