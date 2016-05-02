-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016 年 5 月 01 日 04:04
-- サーバのバージョン： 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `team20160215`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `photo_path` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `member_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `photos`
--

INSERT INTO `photos` (`id`, `photo_path`, `title`, `comment`, `member_id`, `created`, `modified`) VALUES
(1, 'allcats.jpg', 'ハローワールド', 'lorem ipsum', 4, '2016-04-16 21:10:00', '2016-04-16 13:10:00'),
(2, 'autumnleaves.jpg', 'タイトル', 'テキスト', 4, '2016-04-17 16:30:00', '2016-04-17 08:30:00'),
(3, 'butterfly.jpg', 'Danke!', 'bonjour!', 4, '2016-04-17 21:06:00', '2016-04-17 13:06:00'),
(4, 'cats.jpg', 'Good morning sunshine', 'Hello world', 5, '2016-04-18 09:00:00', '2016-04-18 01:00:00'),
(5, 'darknight.jpg', 'おはよう太陽', 'こんにちは世界', 5, '2016-04-18 21:05:00', '2016-04-18 13:05:00'),
(6, 'shadow.jpg', '宮沢賢治', 'あのイーハトーヴォのすきとおった風、夏でも底に冷たさをもつ青いそら、うつくしい森で飾られたモリーオ市、郊外のぎらぎらひかる草の波。', 5, '2016-04-19 09:00:00', '2016-04-19 01:00:00'),
(7, 'fall.jpg', 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 6, '2016-04-19 12:12:00', '2016-04-19 04:12:00'),
(8, 'fireworks.jpg', 'ローレムイプサム', 'lorem ipsum', 6, '2016-04-19 17:46:00', '2016-04-19 09:46:00'),
(9, 'fireworks2.jpg', '888888', 'テキスト', 6, '2016-04-20 08:13:00', '2016-04-20 00:13:00'),
(10, 'flowers.jpg', 'ハローワールド', 'bonjour!', 6, '2016-04-20 09:00:00', '2016-04-20 01:00:00'),
(11, 'kyoto.jpg', 'タイトル', 'Hello world', 6, '2016-04-20 12:15:00', '2016-04-20 04:15:00'),
(12, 'lotus.jpg', 'Danke!', 'こんにちは世界', 5, '2016-04-20 22:15:00', '2016-04-20 14:15:00'),
(13, 'rainbow.jpg', 'Good morning sunshine', 'あのイーハトーヴォのすきとおった風、夏でも底に冷たさをもつ青いそら、うつくしい森で飾られたモリーオ市、郊外のぎらぎらひかる草の波。', 5, '2016-04-21 08:36:00', '2016-04-21 00:36:00'),
(14, 'sample.jpg', 'おはよう太陽', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 6, '2016-04-21 09:00:00', '2016-04-21 01:00:00'),
(15, 'taoyuan.jpg', '宮沢賢治', 'lorem ipsum', 6, '2016-04-21 15:00:00', '2016-04-21 07:00:00'),
(16, 'yokohama.jpg', 'lorem ipsum', 'テキスト', 6, '2016-04-21 19:50:00', '2016-04-21 11:50:00'),
(17, 'allcats.jpg', 'ローレムイプサム', 'bonjour!', 6, '2016-04-22 08:20:00', '2016-04-22 00:20:00'),
(18, 'autumnleaves.jpg', '888889', 'Hello world', 6, '2016-04-22 09:00:00', '2016-04-22 01:00:00'),
(19, 'butterfly.jpg', 'ハローワールド', 'lorem ipsum', 4, '2016-04-23 13:20:00', '2016-04-23 05:20:00'),
(20, 'cats.jpg', 'タイトル', 'テキスト', 4, '2016-04-23 14:20:00', '2016-04-23 06:20:00'),
(21, 'darknight.jpg', 'Danke!', 'bonjour!', 4, '2016-04-24 19:40:00', '2016-04-24 11:40:00'),
(22, 'shadow.jpg', 'Good morning sunshine', 'Hello world', 4, '2016-04-25 09:00:00', '2016-04-25 01:00:00'),
(23, 'fall.jpg', 'おはよう太陽', 'こんにちは世界', 4, '2016-04-26 06:45:00', '2016-04-25 22:45:00'),
(24, 'fireworks.jpg', '宮沢賢治', 'あのイーハトーヴォのすきとおった風、夏でも底に冷たさをもつ青いそら、うつくしい森で飾られたモリーオ市、郊外のぎらぎらひかる草の波。', 4, '2016-04-26 09:00:00', '2016-04-26 01:00:00'),
(25, 'fireworks2.jpg', 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 6, '2016-04-26 15:00:00', '2016-04-26 07:00:00'),
(26, 'flowers.jpg', 'ローレムイプサム', 'lorem ipsum', 6, '2016-04-26 18:55:00', '2016-04-26 10:55:00'),
(27, 'kyoto.jpg', '888890', 'テキスト', 6, '2016-04-27 09:00:00', '2016-04-27 01:00:00'),
(28, 'lotus.jpg', 'ハローワールド', 'bonjour!', 4, '2016-04-27 21:12:00', '2016-04-27 13:12:00'),
(29, 'rainbow.jpg', 'タイトル', 'Hello world', 4, '2016-04-28 09:00:00', '2016-04-28 01:00:00'),
(30, 'sample.jpg', 'Danke!', 'こんにちは世界', 4, '2016-04-28 12:04:00', '2016-04-28 04:04:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
