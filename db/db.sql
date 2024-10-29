-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 07 2024 г., 00:16
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
-- База данных: `VikingTaxi`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cars`
--

CREATE TABLE `cars` (
  `id_car` int NOT NULL,
  `owner_car` int NOT NULL,
  `brand_car` varchar(50) NOT NULL,
  `mark_car` varchar(50) NOT NULL,
  `color_car` varchar(50) NOT NULL,
  `numer_car` varchar(10) NOT NULL,
  `rate_car` varchar(50) NOT NULL,
  `isChildSeet_car` tinyint(1) NOT NULL DEFAULT '0',
  `img_car` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'defaul.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `cars`
--

INSERT INTO `cars` (`id_car`, `owner_car`, `brand_car`, `mark_car`, `color_car`, `numer_car`, `rate_car`, `isChildSeet_car`, `img_car`) VALUES
(1, 1, 'volkswagen', 'jetta', 'Черный', 'Б103РЕ18', 'base', 0, 'default.jpg'),
(2, 1, 'lada', 'granta', 'Красный', 'Н245ШД18', 'base', 0, 'default.jpg'),
(3, 2, 'lada', 'vesta', 'Белый', 'К923ПО18', 'base', 0, 'drive_К923ПО18.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `drivers`
--

CREATE TABLE `drivers` (
  `id_driver` int NOT NULL,
  `user_driver` int NOT NULL,
  `status_driver` varchar(50) NOT NULL,
  `rating_driver` float NOT NULL DEFAULT '0',
  `numberRatings_driver` int NOT NULL DEFAULT '0',
  `currentCar_driver` int DEFAULT NULL,
  `coorders_driver` varchar(100) DEFAULT NULL,
  `passportDetails_driver` varchar(50) NOT NULL,
  `yearBirth_driver` int NOT NULL,
  `inn_driver` int NOT NULL,
  `drivingExperience_driver` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `drivers`
--

INSERT INTO `drivers` (`id_driver`, `user_driver`, `status_driver`, `rating_driver`, `numberRatings_driver`, `currentCar_driver`, `coorders_driver`, `passportDetails_driver`, `yearBirth_driver`, `inn_driver`, `drivingExperience_driver`) VALUES
(1, 2, 'sleep', 0, 0, NULL, NULL, '1111 111111', 1980, 11111, 10),
(2, 4, 'search', 3.5, 2, 3, '56.86000637829461,53.2662224370405', '222', 22, 22, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `favoriteAddresses`
--

CREATE TABLE `favoriteAddresses` (
  `id_favoriteAddresse` int NOT NULL,
  `user_favoriteAddresse` int NOT NULL,
  `coorders_favoriteAddresse` varchar(100) NOT NULL,
  `name_favoriteAddresse` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `game`
--

CREATE TABLE `game` (
  `id_game` int NOT NULL,
  `totalScore_game` float DEFAULT NULL,
  `maxScore_game` float DEFAULT NULL,
  `numberComplete_game` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id_order` int NOT NULL,
  `date_order` varchar(100) NOT NULL,
  `timeStart_order` varchar(100) NOT NULL,
  `timeFinish_order` varchar(100) DEFAULT NULL,
  `distance_order` varchar(100) NOT NULL,
  `duration_order` varchar(100) NOT NULL,
  `durationInTraffic_order` varchar(100) NOT NULL,
  `startShort_order` varchar(100) NOT NULL,
  `finishShort_order` varchar(100) NOT NULL,
  `startLong_order` varchar(100) NOT NULL,
  `finishLong_order` varchar(100) NOT NULL,
  `startCoorders_order` varchar(100) NOT NULL,
  `finishCoorders_order` varchar(100) NOT NULL,
  `status_order` varchar(50) NOT NULL DEFAULT 'search',
  `priority_order` varchar(10) NOT NULL,
  `price_order` varchar(50) NOT NULL,
  `rate_order` varchar(50) NOT NULL,
  `paymentType_order` varchar(50) NOT NULL,
  `user_order` int NOT NULL,
  `taxiDriver_order` int DEFAULT NULL,
  `timeInSearch_order` varchar(50) DEFAULT NULL,
  `timeInWaitDriver_order` varchar(50) DEFAULT NULL,
  `timeInDrive_order` varchar(50) DEFAULT NULL,
  `rating_order` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id_order`, `date_order`, `timeStart_order`, `timeFinish_order`, `distance_order`, `duration_order`, `durationInTraffic_order`, `startShort_order`, `finishShort_order`, `startLong_order`, `finishLong_order`, `startCoorders_order`, `finishCoorders_order`, `status_order`, `priority_order`, `price_order`, `rate_order`, `paymentType_order`, `user_order`, `taxiDriver_order`, `timeInSearch_order`, `timeInWaitDriver_order`, `timeInDrive_order`, `rating_order`) VALUES
(299, '05.05.2024', '22:21', NULL, '6 км', '12 мин', '12 мин', 'СНТ Восток-3 МОТ', 'улица Воровского, 162', 'Удмуртская Республика, Ижевск, СНТ Восток-3 МОТ', 'Удмуртская Республика, Ижевск, улица Воровского, 162', '56.8610156187202,53.271474867605214', '56.844738962599244,53.232036000216695', 'canseled', '0', '286', 'base', 'cash', 3, 2, '00:00:24', NULL, NULL, NULL),
(300, '05.05.2024', '23:04', NULL, '3,9 км', '10 мин', '9 мин', '10-й микрорайон', 'улица Владимира Краева', 'Удмуртская Республика, Ижевск, жилой район Культбаза, 10-й микрорайон', 'Удмуртская Республика, Ижевск, улица Владимира Краева', '56.86154218593072,53.26439154649861', '56.84221156497747,53.23507991585655', 'end', '1', '300', 'base', 'cash', 3, 2, '00:00:16', NULL, NULL, NULL),
(301, '06.05.2024', '17:57', NULL, '8,6 км', '19 мин', '30 мин', 'Восточный жилой район', 'Центральный жилой район', 'Удмуртская Республика, Ижевск, Восточный жилой район', 'Удмуртская Республика, Ижевск, Центральный жилой район', '56.86726797138243,53.278724098007736', '56.852448681432584,53.23763170245809', 'canseled', '0', '328', 'base', 'cash', 2, NULL, NULL, NULL, NULL, NULL),
(302, '06.05.2024', '18:05', NULL, '4,1 км', '10 мин', '11 мин', 'улица Серова, 25', 'Центральный жилой район', 'Удмуртская Республика, Ижевск, улица Серова, 25', 'Удмуртская Республика, Ижевск, Центральный жилой район', '56.86484837412062,53.24242133020527', '56.84745404976639,53.21570155428129', 'canseled', '0', '179', 'base', 'cash', 2, NULL, NULL, NULL, NULL, NULL),
(303, '07.05.2024', '01:12', NULL, '9,4 км', '18 мин', '15 мин', '4-й микрорайон', 'микрорайон Ю-2', 'Удмуртская Республика, Ижевск, Восточный жилой район, 4-й микрорайон', 'Удмуртская Республика, Ижевск, Южный жилой район, микрорайон Ю-2', '56.87202782282452,53.281859485094984', '56.834016674505186,53.22305886928817', 'canseled', '0', '262', 'base', 'cash', 2, 2, '00:00:50', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `prices`
--

CREATE TABLE `prices` (
  `id_price` int NOT NULL,
  `start_price` int NOT NULL,
  `min_price` int NOT NULL,
  `toKm_price` int NOT NULL,
  `toMin_price` int NOT NULL,
  `lowerСoefficient_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `prices`
--

INSERT INTO `prices` (`id_price`, `start_price`, `min_price`, `toKm_price`, `toMin_price`, `lowerСoefficient_price`) VALUES
(1, 75, 150, 12, 5, 0.9),
(2, 100, 250, 15, 8, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `login_user` varchar(50) NOT NULL,
  `password_user` varchar(50) NOT NULL,
  `name_user` varchar(50) NOT NULL,
  `lastName_user` varchar(50) NOT NULL,
  `phone_user` varchar(50) NOT NULL,
  `role_user` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `login_user`, `password_user`, `name_user`, `lastName_user`, `phone_user`, `role_user`) VALUES
(1, 'test', 'test 1', 'Алексадр', 'Борин', '888', 'user'),
(2, 'test2', 'test 2', 'Петр', 'Петров', '889', 'driver'),
(3, 'test3', 'test 3', 'Иван', 'Иванов', '890', 'admin'),
(4, 'drive', '123', 'олег', 'олегов', '123', 'driver');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id_car`),
  ADD UNIQUE KEY `id_car` (`id_car`),
  ADD UNIQUE KEY `numer_car` (`numer_car`),
  ADD KEY `cars_fk0` (`owner_car`);

--
-- Индексы таблицы `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id_driver`),
  ADD UNIQUE KEY `id_driver` (`id_driver`),
  ADD UNIQUE KEY `user_driver` (`user_driver`),
  ADD UNIQUE KEY `passportDetails_driver` (`passportDetails_driver`),
  ADD UNIQUE KEY `inn_driver` (`inn_driver`),
  ADD KEY `drivers_fk1` (`currentCar_driver`);

--
-- Индексы таблицы `favoriteAddresses`
--
ALTER TABLE `favoriteAddresses`
  ADD PRIMARY KEY (`id_favoriteAddresse`),
  ADD KEY `favoriteAddress_fk0` (`user_favoriteAddresse`);

--
-- Индексы таблицы `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id_game`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD UNIQUE KEY `id_order` (`id_order`),
  ADD KEY `orders_fk0` (`user_order`),
  ADD KEY `orders_fk1` (`taxiDriver_order`);

--
-- Индексы таблицы `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id_price`),
  ADD UNIQUE KEY `lowerСoefficient_price` (`lowerСoefficient_price`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `id_user` (`id_user`),
  ADD UNIQUE KEY `login_user` (`login_user`),
  ADD UNIQUE KEY `phone_user` (`phone_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cars`
--
ALTER TABLE `cars`
  MODIFY `id_car` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id_driver` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `favoriteAddresses`
--
ALTER TABLE `favoriteAddresses`
  MODIFY `id_favoriteAddresse` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=304;

--
-- AUTO_INCREMENT для таблицы `prices`
--
ALTER TABLE `prices`
  MODIFY `id_price` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_fk0` FOREIGN KEY (`owner_car`) REFERENCES `drivers` (`id_driver`);

--
-- Ограничения внешнего ключа таблицы `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `drivers_fk0` FOREIGN KEY (`user_driver`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `drivers_fk1` FOREIGN KEY (`currentCar_driver`) REFERENCES `cars` (`id_car`);

--
-- Ограничения внешнего ключа таблицы `favoriteAddresses`
--
ALTER TABLE `favoriteAddresses`
  ADD CONSTRAINT `favoriteAddress_fk0` FOREIGN KEY (`user_favoriteAddresse`) REFERENCES `users` (`id_user`);

--
-- Ограничения внешнего ключа таблицы `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `game_fk0` FOREIGN KEY (`id_game`) REFERENCES `users` (`id_user`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_fk0` FOREIGN KEY (`user_order`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `orders_fk1` FOREIGN KEY (`taxiDriver_order`) REFERENCES `drivers` (`id_driver`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
