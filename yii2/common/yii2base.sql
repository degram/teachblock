-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 18 2019 г., 12:10
-- Версия сервера: 5.6.41
-- Версия PHP: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yii2base`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m130524_201442_init', 1547979533);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(100) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `all_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `text`, `all_text`) VALUES
(1, 'Новость №1', 'Авария на ул. Горького', 'На ул. Горького врезались 2 автомобиля'),
(2, 'Новость №2', 'Ежа смыло в унитаз', 'Ёж прыгнул в туалет и смылся нехрен из этого бренного мира');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'root', 'hRFsco0FYnor3sanD44VB4DTXjWgE7Gd', '$2y$13$XFhSLyibxHebNmEFzY0abuBUq1cmvaFSD7JDydetasfCDNBxDi7cq', 'J2HNEbahGQZLTBScTLycXAYFSkcgwiHH_1557321489', 'paind112@mail.ru', 10, 1554661060, 1557321489, '8U29grB6wa6Gm9EqXPOizVIOzGD_G6JZ_1554661060'),
(2, 'v.ivanov@vesti.ua', 'tDwg4_jg-GuWUzw-Y3uWnvIPLpkaTO_z', '$2y$13$dhrhwDTMk9GyMhOoQO.Cdu6729o.8aE2cwJo.MktI1SU7yQtB0cq6', NULL, 'v.ivanov@vesti.ua', 10, 1557067721, 1557067721, 'OUzO7cxdNZoEcocRzCf7yyuSFeb51rBq_1557067721'),
(3, 'root001', '8s71SYCyAIdaMTG537FJGc1kQvAxjh_5', '$2y$13$H1HHxCQ7mW1BhWscpdB.F.7JfNArGZmcaOGdAVbBzcu9hCrvo0Zxi', NULL, 'wwe55dx@uku.net', 10, 1557151358, 1557151358, '2MsfGQxgcRd-KJZIbg6OKmfxeTxJ5cye_1557151358'),
(4, 'root12', 'DLrHQVnXAuy6EfaVB1Ws9hbQf6QbIcEb', '$2y$13$gMUlVWG83VEJTFn74ZEIQukMsWHngukFEEN/geaYyfX7FSsoNfF0a', NULL, 'wwe55dx@ukr.net', 10, 1557151443, 1557151443, 'UVBz-nVp7UlpFqOaOBWGbZYNaRTD2fa6_1557151443'),
(5, 'root007', '-zrNSlkZfOwsEnpCZdouI6D-ZJLGIp9B', '$2y$13$mDxm2CrvYt59mf4DEN6gi.rJQQzUoizJdmZAUOZlmBqmaNz3LhPi.', NULL, 'wwe56dx@ukr.net', 10, 1557151524, 1557151524, 'QvpUQYnQdaUHIYSFeAq-eQqOjZ0Fk0qY_1557151524'),
(6, 'root_test', 'QrTx4LySQ13WK7eDm0__GcXZx-jKVkLa', '$2y$13$ljYdPKX84y41yYGTb1k.zeIL6wZoWgl8kqlpvkXVg5QuAFtMFiuJG', NULL, 'paind12@mail.ru', 10, 1557321657, 1557321672, 'vVg2tE6vDcV02qZiVc8WpF3t5mbhEDr2_1557321657'),
(7, 'qwerty', '1KQoUwuMq18R6QSopQW2kE5k7Oz95uAK', '$2y$13$7jhv7oNTUEIv5gOWoD8O9uxfu7gNPO3SJvzhCYW3Wy8mjN9h.3kKi', NULL, 'yurii832kazmiruk@gmail.com', 20, 1557478169, 1557478169, 'HWGlZr-9GNI2FzAnmeXL-bKHxiG3aR8X_1557478169'),
(8, 'root2', 'bzg-iSlcSeylOegGH2JYsdv46_GbFq-b', '$2y$13$DDKlHbIQ27XWAZIIgRTBNOZau3A3QUcr9HD8pTcfXMgL0D2bob6Bu', NULL, 'y.kazmiruk@vesti.ua', 20, 1557478290, 1557478290, 'kkDBy-fwIHsMJYfe5x9HcaeNDgu4BJao_1557478290'),
(9, 'root3', 'Qwl8JSR1Fy-NVcS9dOhZ4FYkl1eD2Cjm', '$2y$13$iXq1.pNkT0tTTw4jzULGxem015ZZOk9XHZpreWlOB9PoVZO/dlT5W', NULL, 'wwe545dx@ukr.net', 20, 1557478436, 1557478436, 'B0pMkAxMynRgJ5TCAUnmMYcuYbeP_Ptd_1557478436'),
(10, 'paind12@mail.ru', '4gtA8r3T3xhWRaes4QruZROYHeWHGWTl', '$2y$13$numXPdNP5uTQQotCRTmM2u.JMdZfQa3n9yfUy8OS3PqPTQrR6OEim', NULL, 'detected1995@gmail.com', 20, 1558531210, 1558531210, '1vu-vGu8q3CEyhwdStL_laOtUu9e2a3X_1558531210'),
(11, 'bender123', 'i3bk9--bwdFv-9jl4TUvLa4mY06HGL3z', '$2y$13$XOnfeNS7O0tja8iBxufeLuEY46epf9lbx563RhzSs/iSqi8zxKJiO', NULL, 'd.murachova@vesti.ua', 20, 1559556373, 1559556373, 'Lx9wSaePnbTfoSA2HJxscthHSKkToXzG_1559556373'),
(12, 'Дмитрий', 'l-v9ml-yCG4ILIoLjRn6dY6iXgxfs5lc', '$2y$13$3Gh.qK8mm.BW/euYfIZO4O/fYh1IV2kXDlQVfGUtg7hlsFMYrNEha', NULL, 'dessnight@gmail.com', 20, 1566542138, 1566542138, 'OqH6QmMiQbxqaU9Z-x6lo7OYG-4JWjLe_1566542138');

-- --------------------------------------------------------

--
-- Структура таблицы `yii_product`
--

CREATE TABLE `yii_product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `auth_assignment_user_id_idx` (`user_id`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Индексы таблицы `yii_product`
--
ALTER TABLE `yii_product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `yii_product`
--
ALTER TABLE `yii_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
