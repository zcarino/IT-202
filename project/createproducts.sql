CREATE TABLE `products` (
    `product_id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100)  NOT NULL,
    `image` varchar(100) NOT NULL,
    `price` float NOT NULL,
    PRIMARY KEY (product_id)
);
