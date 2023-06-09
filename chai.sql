-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 09 2023 г., 10:57
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `chai`
--

-- --------------------------------------------------------

--
-- Структура таблицы `teapot`
--

CREATE TABLE `teapot` (
  `id` int NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `teapot`
--

INSERT INTO `teapot` (`id`, `name`, `description`) VALUES
(1, 'Чайник белый', 'Электрический чайник — бытовой электрический прибор для нагревания и кипячения питьевой воды, работающий на электроэнергии1'),
(2, 'Чайник черный', 'Электрический чайник — бытовой электрический прибор для нагревания и кипячения питьевой воды, работающий на электроэнергии2'),
(3, 'Чайник красный', 'Электрический чайник — бытовой электрический прибор для нагревания и кипячения питьевой воды, работающий на электроэнергии3'),
(4, 'Чайник1', 'Это чайник номер 1'),
(5, 'Чайник11', 'Это чайник номер 11'),
(13, 'Чайник118', 'Это чайник номер 118');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `teapot`
--
ALTER TABLE `teapot`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `teapot`
--
ALTER TABLE `teapot`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
