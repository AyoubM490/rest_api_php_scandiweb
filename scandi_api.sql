USE `heroku_34fe46c9712aa54`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `additional_properties` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `units` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `additional_properties` (`id`, `type_id`, `name`, `units`) VALUES
(1, 2, 'Size', 'MB'),
(2, 3, 'WxHxL', 'CM'),
(3, 1, 'Weight', 'KG');

CREATE TABLE `keys_and_values` (
  `id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `ad_prop_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `keys_and_values` (`id`, `prod_id`, `type_id`, `ad_prop_id`, `value`) VALUES
(2, 2, 1, 3, '2'),
(5, 5, 3, 2, '25x50x20'),
(6, 6, 3, 2, '80x200x80');

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `sku` varchar(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `products` (`id`, `sku`, `name`, `price`) VALUES
(2, 'GGWP0007', 'War and Peace', 20.00),
(5, 'TR120555', 'Chair', 40.00),
(6, 'JVC200123', 'Acme DISC', 1.00);

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'Book'),
(2, 'DVD'),
(3, 'Furniture');

ALTER TABLE `additional_properties`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `keys_and_values`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `products`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `type`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `additional_properties`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `keys_and_values`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `products`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `type`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;