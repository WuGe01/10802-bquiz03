-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2019 年 12 月 17 日 07:48
-- 伺服器版本： 10.4.6-MariaDB
-- PHP 版本： 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `db03`
--

-- --------------------------------------------------------

--
-- 資料表結構 `movie`
--

CREATE TABLE `movie` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '流水號',
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '電影名稱',
  `level` tinyint(1) NOT NULL COMMENT '分級',
  `length` int(5) NOT NULL COMMENT '長度',
  `ondate` date NOT NULL COMMENT '放映日期',
  `publish` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '發行商',
  `director` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '導演',
  `trailer` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '預告影片',
  `poster` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '預告海報',
  `intro` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '電影介紹',
  `rank` int(5) NOT NULL COMMENT '排序',
  `sh` int(1) NOT NULL DEFAULT 1 COMMENT '顯示'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `ord`
--

CREATE TABLE `ord` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '流水號',
  `no` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '訂單編號',
  `movie` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '電影名稱',
  `date` date NOT NULL COMMENT '觀影日期',
  `session` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '場次',
  `qt` int(1) NOT NULL COMMENT '票數',
  `seat` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '座位'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `poster`
--

CREATE TABLE `poster` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '流水號',
  `poster` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '檔案路徑',
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '片名',
  `rank` int(5) NOT NULL COMMENT '排序',
  `sh` int(1) NOT NULL DEFAULT 1 COMMENT '顯示',
  `ani` int(1) NOT NULL DEFAULT 1 COMMENT '轉場動畫'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `ord`
--
ALTER TABLE `ord`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `poster`
--
ALTER TABLE `poster`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '流水號';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `ord`
--
ALTER TABLE `ord`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '流水號';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `poster`
--
ALTER TABLE `poster`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '流水號';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
