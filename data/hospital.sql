-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Авг 29 2021 г., 01:01
-- Версия сервера: 5.5.65-MariaDB
-- Версия PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `hospital`
--

-- --------------------------------------------------------

--
-- Структура таблицы `currentinsurance`
--

CREATE TABLE IF NOT EXISTS `currentinsurance` (
  `id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `insurance_id` int(11) NOT NULL,
  `date_of_beginning` date NOT NULL,
  `date_of_end` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `diseases`
--

CREATE TABLE IF NOT EXISTS `diseases` (
  `disease_id` int(11) NOT NULL,
  `classification_code` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `doctors`
--

CREATE TABLE IF NOT EXISTS `doctors` (
  `doctor_id` int(11) NOT NULL,
  `profession_id` int(11) NOT NULL,
  `dateOfEmployment` datetime NOT NULL,
  `fio` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `floor` int(11) NOT NULL,
  `cabinet` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `doctorsvisit`
--

CREATE TABLE IF NOT EXISTS `doctorsvisit` (
  `id` int(11) NOT NULL,
  `id_visits` int(11) NOT NULL,
  `medkart_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `doctor_professions`
--

CREATE TABLE IF NOT EXISTS `doctor_professions` (
  `profession_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `insurances`
--

CREATE TABLE IF NOT EXISTS `insurances` (
  `insurance_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `yearcost` bigint(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `medkarts`
--

CREATE TABLE IF NOT EXISTS `medkarts` (
  `medkart_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `disease_id` int(11) NOT NULL,
  `date_of_discharge` datetime NOT NULL,
  `person_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `related_hospital` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inn` bigint(20) NOT NULL,
  `person_id` int(11) NOT NULL,
  `alive` tinyint(1) NOT NULL DEFAULT '1',
  `healthy` tinyint(1) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `people`
--

CREATE TABLE IF NOT EXISTS `people` (
  `person_id` int(11) NOT NULL,
  `fio` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `passport` bigint(20) NOT NULL,
  `age` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'True=male, false = female'
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `visits`
--

CREATE TABLE IF NOT EXISTS `visits` (
  `id_visits` int(11) NOT NULL,
  `prescription` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `advice` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `diagnos` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `next_visit` date NOT NULL,
  `complains` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_visit` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `currentinsurance`
--
ALTER TABLE `currentinsurance`
  ADD PRIMARY KEY (`id`), ADD KEY `insurance_id` (`insurance_id`), ADD KEY `currentinsurance_ibfk_2` (`person_id`);

--
-- Индексы таблицы `diseases`
--
ALTER TABLE `diseases`
  ADD PRIMARY KEY (`disease_id`);

--
-- Индексы таблицы `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`), ADD KEY `profession_id` (`profession_id`);

--
-- Индексы таблицы `doctorsvisit`
--
ALTER TABLE `doctorsvisit`
  ADD PRIMARY KEY (`id`), ADD KEY `medkart_id` (`medkart_id`), ADD KEY `id_visits` (`id_visits`);

--
-- Индексы таблицы `doctor_professions`
--
ALTER TABLE `doctor_professions`
  ADD PRIMARY KEY (`profession_id`);

--
-- Индексы таблицы `insurances`
--
ALTER TABLE `insurances`
  ADD PRIMARY KEY (`insurance_id`);

--
-- Индексы таблицы `medkarts`
--
ALTER TABLE `medkarts`
  ADD PRIMARY KEY (`medkart_id`), ADD KEY `doctor_id` (`doctor_id`), ADD KEY `disease_id` (`disease_id`), ADD KEY `medkarts_ibfk_3` (`person_id`);

--
-- Индексы таблицы `patients`
--
ALTER TABLE `patients`
  ADD KEY `person_id` (`person_id`);

--
-- Индексы таблицы `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`person_id`), ADD UNIQUE KEY `passport` (`passport`), ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id_visits`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `currentinsurance`
--
ALTER TABLE `currentinsurance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `diseases`
--
ALTER TABLE `diseases`
  MODIFY `disease_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT для таблицы `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `doctorsvisit`
--
ALTER TABLE `doctorsvisit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `doctor_professions`
--
ALTER TABLE `doctor_professions`
  MODIFY `profession_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `insurances`
--
ALTER TABLE `insurances`
  MODIFY `insurance_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `medkarts`
--
ALTER TABLE `medkarts`
  MODIFY `medkart_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT для таблицы `people`
--
ALTER TABLE `people`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT для таблицы `visits`
--
ALTER TABLE `visits`
  MODIFY `id_visits` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `currentinsurance`
--
ALTER TABLE `currentinsurance`
ADD CONSTRAINT `currentinsurance_ibfk_1` FOREIGN KEY (`insurance_id`) REFERENCES `insurances` (`insurance_id`),
ADD CONSTRAINT `currentinsurance_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `people` (`person_id`);

--
-- Ограничения внешнего ключа таблицы `doctors`
--
ALTER TABLE `doctors`
ADD CONSTRAINT `doctors_ibfk_2` FOREIGN KEY (`profession_id`) REFERENCES `doctor_professions` (`profession_id`);

--
-- Ограничения внешнего ключа таблицы `doctorsvisit`
--
ALTER TABLE `doctorsvisit`
ADD CONSTRAINT `doctorsvisit_ibfk_1` FOREIGN KEY (`id_visits`) REFERENCES `visits` (`id_visits`),
ADD CONSTRAINT `doctorsvisit_ibfk_2` FOREIGN KEY (`medkart_id`) REFERENCES `medkarts` (`medkart_id`),
ADD CONSTRAINT `doctorsvisit_ibfk_3` FOREIGN KEY (`id_visits`) REFERENCES `visits` (`id_visits`),
ADD CONSTRAINT `doctorsvisit_ibfk_4` FOREIGN KEY (`id_visits`) REFERENCES `visits` (`id_visits`);

--
-- Ограничения внешнего ключа таблицы `medkarts`
--
ALTER TABLE `medkarts`
ADD CONSTRAINT `medkarts_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`),
ADD CONSTRAINT `medkarts_ibfk_2` FOREIGN KEY (`disease_id`) REFERENCES `diseases` (`disease_id`),
ADD CONSTRAINT `medkarts_ibfk_3` FOREIGN KEY (`person_id`) REFERENCES `people` (`person_id`);

--
-- Ограничения внешнего ключа таблицы `patients`
--
ALTER TABLE `patients`
ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `people` (`person_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
