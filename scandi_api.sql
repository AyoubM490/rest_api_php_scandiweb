USE `heroku_34fe46c9712aa54`;
CREATE TABLE `books` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `sku` varchar(255) NOT NULL,
    `name` varchar(255) NOT NULL,
    `price` decimal(10,2) NOT NULL,
    `weight` decimal(10,2) NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `dvds` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `sku` varchar(255) NOT NULL,
    `name` varchar(255) NOT NULL,
    `price` decimal(10,2) NOT NULL,
    `size` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `furnitures` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `sku` varchar(255) NOT NULL,
    `name` varchar(255) NOT NULL,
    `price` decimal(10,2) NOT NULL,
    `height` decimal(10,2) NOT NULL,
    `width` decimal(10,2) NOT NULL,
    `length` decimal(10,2) NOT NULL,
    PRIMARY KEY (`id`)
);