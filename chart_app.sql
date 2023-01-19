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
-- データベース: `chart_app`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `posts`
--

CREATE TABLE `posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `cond` varchar(60) NOT NULL,
  `temp` float NOT NULL,
  `pulse` int(11) NOT NULL,
  `sbp` int(11) NOT NULL,
  `dbp` int(11) NOT NULL,
  `created` date DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `posts`
--

INSERT INTO `posts` (`id`, `cond`, `temp`, `pulse`, `sbp`, `dbp`, `created`, `comment`, `user_id`) VALUES
(33, 'とても良い', 36, 42, 180, 138, '2023-01-04', '昨日はよく眠れて調子が’良いです。', 1),
(34, 'とても良い', 37, 78, 200, 100, '2023-01-06', '良き', 1),
(35, '悪い', 36.8, 78, 200, 68, '2023-01-07', '調子が悪くて寝ています。', 1),
(36, '良い', 37, 78, 170, 68, '2023-01-05', '今日は調子が良いので散歩に行きました。', 1),
(37, 'とても良い', 36.5, 78, 200, 68, '2023-01-09', '今日は血圧が高くて心配です。体調は変わりありません。', 1),
(38, '悪い', 36.5, 58, 154, 70, '2023-01-10', '雨が降っているせいか体調がすぐれません。', 1),
(39, 'とても良い', 37, 68, 120, 72, '2023-01-11', '今日はぐっすり眠れて調子が良いです。', 1),
(40, 'とても良い', 36.5, 90, 170, 80, '2023-01-12', '散歩に行きました。', 1),
(42, '悪い', 35.9, 90, 170, 68, '2023-01-13', '血圧が少し下がりました。', 1),
(43, '良い', 38, 58, 180, 90, '2023-01-14', 'テストメッセージ', 1),
(44, 'とても良い', 37, 58, 120, 85, '2023-01-18', '今日は雨なので、外には出ないで家で料理をします。', 1),
(46, '良い', 38, 58, 180, 90, '2023-01-19', 'test', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user-name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `users_table`
--

CREATE TABLE `users_table` (
  `id` int(12) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `is_admin` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users_table`
--

INSERT INTO `users_table` (`id`, `username`, `password`, `is_admin`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'testuser01', '111111', 1, '2023-01-15 17:33:17', '2023-01-15 17:33:17', NULL),
(2, 'testuser02', '222222', 0, '2023-01-15 17:33:17', '2023-01-15 17:33:17', NULL),
(3, 'testuser03', '333333', 0, '2023-01-15 17:33:17', '2023-01-15 17:33:17', NULL),
(4, 'testuser04', '444444', 0, '2023-01-15 17:33:17', '2023-01-15 17:33:17', NULL);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- テーブルのAUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
