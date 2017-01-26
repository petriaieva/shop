-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Янв 26 2017 г., 14:20
-- Версия сервера: 5.7.11
-- Версия PHP: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shop`
--

DELIMITER $$
--
-- Процедуры
--
CREATE DEFINER=`genya`@`localhost` PROCEDURE `discount` (IN `dis` BOOLEAN)  begin
IF(dis=1) THEN SELECT id, price*0.9 AS price_discount FROM products;
ELSE SELECT id, price FROM products;
END IF;
end$$

CREATE DEFINER=`genya`@`localhost` PROCEDURE `showorders` ()  NO SQL
begin DECLARE i INT DEFAULT 10;
WHILE i>0 DO SELECT orders.id, products.title, orders.qty FROM orders, products WHERE orders.prod_id=products.id AND orders.id=i; SET i=i-1; END WHILE;
end$$

CREATE DEFINER=`genya`@`localhost` PROCEDURE `sum_discount` (IN `sm` INT, IN `i` INT, OUT `ss` DOUBLE)  begin IF((sm>=1000) && (sm<2000)) THEN
SELECT SUM(summa)*0.9 INTO ss FROM sum_sale WHERE id=i;
ELSEIF(sm>=2000) THEN SELECT SUM(summa)*0.8 INTO ss FROM sum_sale WHERE id=i;
ELSE SELECT SUM(summa) INTO ss FROM sum_sale WHERE id=i; END IF;
end$$

CREATE DEFINER=`genya`@`localhost` PROCEDURE `sum_sale` (IN `i` INT, OUT `ss` DOUBLE)  begin
DECLARE s INT;
DROP VIEW IF EXISTS sum_sale;
CREATE VIEW sum_sale AS 
SELECT orders.id, orders.prod_id, orders.qty, products.price, orders.qty*products.price AS summa FROM orders, products WHERE orders.prod_id=products.id;
SELECT SUM(summa) INTO s FROM sum_sale WHERE id=i;
CALL sum_discount(s, i, ss);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cat_id` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `cat_id`) VALUES
(1, 'Pluszaki', 'plusz'),
(2, 'Materiały biurowe', 'm_biur'),
(3, 'Interactive', 'inter');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product` varchar(100) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `qty` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `s_name` varchar(100) NOT NULL,
  `adress` varchar(100) NOT NULL,
  `post_index` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `product`, `prod_id`, `price`, `qty`, `name`, `s_name`, `adress`, `post_index`, `email`, `date`, `time`) VALUES
(9, 'Kot Tomas', 3, '115.00', '2', 'Ievgeniia', 'Petriaieva', 'Bobrzyńskiego 23/69', '30-348', 'pevgenia@gmail.com', '2016-11-04', '14:49:28'),
(10, 'Kula', 4, '600.00', '4', 'Ievgeniia', 'Petriaieva', 'Bobrzyńskiego 23/69', '30-348', 'pevgenia@gmail.com', '2016-11-04', '14:49:28');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `price` decimal(8,0) NOT NULL,
  `image` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `image`, `category`) VALUES
(1, 'Pies FAFA', 'To jest wspaniała zabawka jak dla niemowlę tak i dla przedszkolaka.', '100', '1.jpg', 'plusz'),
(2, 'Ferbusz', 'Furby z powodzeniem może zastąpić żywe zwierzątko lub być przygotowaniem do zakupu takowego. Dziecko musi się nim opiekować, spędzać z nim czas, uczyć go nowych rzeczy i oczywiście dbać o niego.\nCzasem zwierzak potrzebuje, aby go utulić czy podrapać po pleckach. Jest to doskonały sposób na naukę odpowiedzialności.\nPrzede wszystkim jednak maluch może się z nim bawić, a to obu stronom sprawia ogromną przyjemność.', '100', '2.jpg', 'inter'),
(3, 'Kot Tomas', 'Mówiący i interaktywny kociak: po pogłaskaniu po pyszczku i po głowie, powtarza za dzieckiem.', '115', '3.jpg', 'inter'),
(4, 'Kula', 'Pozwała poznać strony świata, państwa, oceany.', '600', '4.jpg', 'm_biur'),
(5, 'Żyrafa', 'Pluszowa żyrafka do kochania i mocnego ściskania.', '150', '5.jpg', 'plusz'),
(6, 'Myszki', 'Maskotka o wielkości 10cm. Ładne kolory, nietypowy wzór. Cena dotyczy 3 sztuki. ', '40', '6.jpg', 'plusz');

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `sum_sale`
--
CREATE TABLE `sum_sale` (
`id` int(11)
,`prod_id` int(11)
,`qty` varchar(10)
,`price` decimal(8,0)
,`summa` double
);

-- --------------------------------------------------------

--
-- Структура для представления `sum_sale`
--
DROP TABLE IF EXISTS `sum_sale`;

CREATE ALGORITHM=UNDEFINED DEFINER=`genya`@`localhost` SQL SECURITY DEFINER VIEW `sum_sale`  AS  select `orders`.`id` AS `id`,`orders`.`prod_id` AS `prod_id`,`orders`.`qty` AS `qty`,`products`.`price` AS `price`,(`orders`.`qty` * `products`.`price`) AS `summa` from (`orders` join `products`) where (`orders`.`prod_id` = `products`.`id`) ;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
