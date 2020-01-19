-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 19 2020 г., 23:39
-- Версия сервера: 5.7.28-0ubuntu0.16.04.2
-- Версия PHP: 7.0.33-0ubuntu0.16.04.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `todoapp`
--

-- --------------------------------------------------------

--
-- Структура таблицы `todo`
--

CREATE TABLE `todo` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL,
  `done` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `todo`
--

INSERT INTO `todo` (`id`, `user_id`, `parent_id`, `title`, `text`, `date`, `done`) VALUES
(1, 3, 0, 'test', 'sdgdfsgdfhgfdhdfhfdg', '2020-01-31 07:33:33', 1),
(2, 3, 0, 'test2', 'sefgrsdgdfgfdgfdg', '2020-01-31 17:16:42', 1),
(3, 3, 0, 'fjhfjgygyjgjkyjkuyiuyyu', 'iyuiuyuyiuyuiuyiuyuiuyiuiuyiuy', '2020-01-23 18:25:00', 0),
(4, 3, 1, 'dtrtrttr', 'gdcgfgfgfgfgfgfgfgfgfg', '2020-01-29 12:16:17', 1),
(5, 3, 1, 'dfhfdhfgh', 'gfhfghfghfghgfh', '2020-01-21 09:30:43', 1),
(6, 3, 0, 'drghretyehrtyrtjhyrtjh', 'ytjtytjtyjtyytjtyyjtyjty', '2020-01-28 18:25:00', 0),
(7, 3, 2, '44444', 'drhgrt44444htrhtr', '2020-01-30 19:10:00', 0),
(13, 3, 0, 'sdfgergreg', 'gerregreger', '2020-01-21 05:21:00', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(3, 'ww@ww.ww', '$2y$10$itTbSzOJhcdRLC6Jf2yJhuInMC1vJlkxodazZe7IWled1.BwPAkzq');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `todo`
--
ALTER TABLE `todo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
