CREATE TABLE IF NOT EXISTS `Orders` (
                            `User_ID` int auto_increment not null,
                            `Order_Number` int auto_increment not null,
                            `City` varchar(60) not null,
                            `Address` varchar(60) not null,
                            `PostalCode` varchar(5) not null,
                            `date_created` timestamp not null default current_timestamp,
                            PRIMARY KEY (`User_id`)
                            ) CHARACTER SET utf8 COLLATE utf8_general_ci