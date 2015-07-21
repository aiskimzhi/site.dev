-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июн 03 2015 г., 16:47
-- Версия сервера: 5.6.20
-- Версия PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `task_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `table_1`
--

CREATE TABLE IF NOT EXISTS `table_1` (
`id` int(11) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `fname` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=75 ;

--
-- Дамп данных таблицы `table_1`
--

INSERT INTO `table_1` (`id`, `name`, `surname`, `fname`) VALUES
(52, 'Иван', 'Иванов', 'Petrovich'),
(53, 'Петр', 'Петров', 'Петрович'),
(54, 'Анастасия', 'Искимжи', 'Степановна'),
(55, 'Иван', 'Петренко', 'Петрович'),
(56, 'Петр', 'Сидоренко', 'Иванович'),
(57, 'Ваня', 'Сидоров', 'Петрович'),
(59, 'Василий', 'Петренко', 'Петрович'),
(60, 'Василий', 'Василенко', 'Васильевич'),
(64, 'Иван', 'Сидоренко', 'Иванович'),
(65, 'Иван', 'Искимжи', 'Петрович'),
(67, 'Петр', 'Сидоров', 'Сидорович'),
(68, 'Петр', 'Петров', 'Петрович'),
(73, 'Анастасия', '&lt;b&gt;ass&lt;/b&gt;', 'Петрович'),
(74, 'Hello', '&lt;b&gt;ass&lt;/b&gt;', 'jlkjljlj');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_1`
--
ALTER TABLE `table_1`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_1`
--
ALTER TABLE `table_1`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=75;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
