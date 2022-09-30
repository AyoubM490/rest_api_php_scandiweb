USE `heroku_34fe46c9712aa54`;
CREATE TABLE `books` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `sku` varchar(255) NOT NULL CHECK (sku <> ''),
    `name` varchar(255) NOT NULL CHECK (name <> ''),
    `price` decimal(10,2) NOT NULL CHECK (price > 0),
    `weight` decimal(10,2) NOT NULL CHECK (weight > 0),
    PRIMARY KEY (`id`)
);

CREATE TABLE `dvds` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `sku` varchar(255) NOT NULL CHECK (sku <> ''),
    `name` varchar(255) NOT NULL CHECK (name <> ''),
    `price` decimal(10,2) NOT NULL CHECK (price > 0),
    `size` varchar(255) NOT NULL CHECK (size <> ''),
    PRIMARY KEY (`id`)
);

CREATE TABLE `furnitures` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `sku` varchar(255) NOT NULL CHECK (sku <> ''),
    `name` varchar(255) NOT NULL CHECK (name <> ''),
    `price` decimal(10,2) NOT NULL CHECK (price > 0),
    `height` decimal(10,2) NOT NULL CHECK (height > 0),
    `width` decimal(10,2) NOT NULL CHECK (width > 0),
    `length` decimal(10,2) NOT NULL CHECK (length > 0),
    PRIMARY KEY (`id`)
);