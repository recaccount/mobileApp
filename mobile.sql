-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 20 Eyl 2021, 16:07:49
-- Sunucu sürümü: 10.4.21-MariaDB
-- PHP Sürümü: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `mobile`
--

DELIMITER $$
--
-- Yordamlar
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_uuid` (IN `uuid` VARCHAR(64))  BEGIN 
   SELECT * FROM device
   WHERE device.uuid = uuid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_device_is_exist` (`uuid` VARCHAR(36))  BEGIN 
   SELECT COUNT(uuid) FROM device 
   WHERE device.uuid=uuid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_device` (IN `uuid` VARCHAR(36), IN `uid` VARCHAR(72), IN `appid` INT(11), IN `lang` VARCHAR(50), IN `os` VARCHAR(10), IN `client_token` VARCHAR(70))  BEGIN 
   INSERT INTO device(uuid,uid,appid,lang,os,client_token) VALUES (uuid,uid,appid,lang,os,client_token);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_purchase_reqs` (IN `client_token` VARCHAR(70), IN `receipt_hash` VARCHAR(100), IN `activity_date` VARCHAR(50), IN `expire_date` VARCHAR(50))  BEGIN 
   INSERT INTO purchase(client_token,receipt_hash,activity_date,expire_date) VALUES (client_token,receipt_hash,activity_date,expire_date);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `device`
--

CREATE TABLE `device` (
  `id` int(11) NOT NULL,
  `uuid` varchar(64) NOT NULL,
  `uid` varchar(64) NOT NULL,
  `appid` int(11) NOT NULL,
  `lang` varchar(64) NOT NULL,
  `os` varchar(64) NOT NULL,
  `client_token` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `device`
--

INSERT INTO `device` (`id`, `uuid`, `uid`, `appid`, `lang`, `os`, `client_token`) VALUES
(1, '8446ca6f-b133-4ee8-967a-cb0cd3b96c84', 'TEKN-UB43-7889-9081', 4, 'Turkish', 'Android', 'T-5avS3mOIYcFu6S6jEsmtxKPQHqFX1qHGtet6EtLvlj7N6PpxKn4LfH6YSoAuQV'),
(2, '8446ca6f-b133-4ee8-967a-cb0cd3b96c82', 'TEKN-UB43-7889-9081', 4, 'Turkish', 'Android', 'T-QMZfF0NYNU3ft7Wa6894rBLvtqK9nysOzcROEGCXfHPrsqFYdBtH4GCOObGhcQ'),
(3, '8446ca6f-b133-4ee8-967a-cb0cd3b96c81', 'TEKN-UB43-7889-9081', 4, 'Turkish', 'Android', 'T-CrIa7PWmhkwOvydzSSaC3x8ckyBGeHCajKo0EZFm6LIHR7csIBpXePjlQinRpl'),
(4, '8446ca6f-b133-4ee8-967a-cb0cd3b96c72', 'TEKN-UB43-7889-9081', 5, 'Turkish', 'Android', 'T-vYuphk0XINMdAjSKxNqL3Z5strNJzBPMFY41KCwmhnMyKnjjyLyY1VwfHvA5wx');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `client_token` varchar(70) NOT NULL,
  `receipt_hash` varchar(64) NOT NULL,
  `activity_date` varchar(64) NOT NULL,
  `expire_date` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `purchase`
--

INSERT INTO `purchase` (`id`, `client_token`, `receipt_hash`, `activity_date`, `expire_date`) VALUES
(19, 'T-vYuphk0XINMdAjSKxNqL3Z5strNJzBPMFY41KCwmhnMyKnjjyLyY1VwfHvA5wx', '8446ca6f-b133-4ee8-967a-cb0cd3b96c81', '2021-09-19 15:24:39', '2021-09-22 15:24:39');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `device`
--
ALTER TABLE `device`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
