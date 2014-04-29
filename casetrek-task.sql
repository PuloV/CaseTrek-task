-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Време на генериране:
-- Версия на сървъра: 5.5.27
-- Версия на PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- БД: `casetrek-task`
--
CREATE DATABASE `casetrek-task` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci;
USE `casetrek-task`;

-- --------------------------------------------------------

--
-- Структура на таблица `features`
--

CREATE TABLE IF NOT EXISTS `features` (
  `feature.order_id` int(45) NOT NULL AUTO_INCREMENT,
  `feature.id` int(45) NOT NULL,
  `feature.name` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`feature.order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура на таблица `user_votes`
--

CREATE TABLE IF NOT EXISTS `user_votes` (
  `user_email` varchar(45) CHARACTER SET utf8 NOT NULL,
  `vote` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
