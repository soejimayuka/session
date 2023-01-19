-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 2023 年 1 月 19 日 13:14
-- サーバのバージョン： 5.7.26
-- PHP のバージョン: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `chat_app`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `posts`
--

CREATE TABLE `posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `person` varchar(25) NOT NULL,
  `txt` varchar(255) NOT NULL,
  `created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `posts`
--

INSERT INTO `posts` (`id`, `person`, `txt`, `created`) VALUES
(7, 'fam', 'test2', '2023-01-14'),
(10, 'fam', '今日は昼ごはんにお弁当を作ったので、11時くらいに行きます。', '2023-01-15'),
(15, 'fam', 'testdadadasa', '2023-01-19');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
