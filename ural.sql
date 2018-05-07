-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 07 2018 г., 05:55
-- Версия сервера: 10.1.30-MariaDB
-- Версия PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ural`
--

-- --------------------------------------------------------

--
-- Структура таблицы `device`
--

CREATE TABLE `device` (
  `deviceID` int(11) NOT NULL,
  `deviceName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `deviceIP` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `deviceTypeID` int(11) DEFAULT NULL,
  `deviceSerial` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `deviceMAC` varchar(17) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `deviceTelNum` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `deviceSubDiv` varchar(90) CHARACTER SET utf32 COLLATE utf32_unicode_ci DEFAULT NULL,
  `deviceInv` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `deviceNote` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `devicequery`
--

CREATE TABLE `devicequery` (
  `queryID` int(11) NOT NULL,
  `deviceID` int(11) DEFAULT NULL,
  `queryDate` date DEFAULT NULL,
  `queryTime` time DEFAULT NULL,
  `ping` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `devicetype`
--

CREATE TABLE `devicetype` (
  `deviceTypeID` int(11) NOT NULL,
  `deviceTypeName` varchar(255) DEFAULT NULL,
  `deviceTypeType` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `usertbl`
--

CREATE TABLE `usertbl` (
  `id` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `userPswd` varchar(255) NOT NULL,
  `priv` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`deviceID`);

--
-- Индексы таблицы `devicequery`
--
ALTER TABLE `devicequery`
  ADD PRIMARY KEY (`queryID`),
  ADD UNIQUE KEY `queryID_2` (`queryID`),
  ADD KEY `queryID` (`queryID`),
  ADD KEY `queryID_3` (`queryID`);

--
-- Индексы таблицы `devicetype`
--
ALTER TABLE `devicetype`
  ADD PRIMARY KEY (`deviceTypeID`);

--
-- Индексы таблицы `usertbl`
--
ALTER TABLE `usertbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `device`
--
ALTER TABLE `device`
  MODIFY `deviceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1103;

--
-- AUTO_INCREMENT для таблицы `devicequery`
--
ALTER TABLE `devicequery`
  MODIFY `queryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27599;

--
-- AUTO_INCREMENT для таблицы `devicetype`
--
ALTER TABLE `devicetype`
  MODIFY `deviceTypeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `usertbl`
--
ALTER TABLE `usertbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
