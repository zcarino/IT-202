CREATE TABLE IF NOT EXISTS `Orders` (
                            `User_ID` int auto_increment not null,
                            `product_id` int(11) NOT NULL AUTO_INCREMENT,
                            `name` varchar(100)  NOT NULL,
                            `Order_Number` int auto_increment not null,
                            `price` float NOT NULL,
                            `date_created` timestamp not null default current_timestamp,
                            PRIMARY KEY (`User_id`)
                            ) CHARACTER SET utf8 COLLATE utf8_general_ci
