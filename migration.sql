CREATE TABLE `password_otp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `otp` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1;

07-08-2023 CREATE TABLE `app_kanyakumari_property`.`website_contacts`(`id` INT
(10) NOT NULL AUTO_INCREMENT , `name` VARCHAR(50) NULL DEFAULT NULL , `email`
VARCHAR(75) NULL DEFAULT NULL , `subject` VARCHAR(100) NULL DEFAULT NULL ,
`message` VARCHAR(1000) NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE =
InnoDB;

alter table products modify description varchar(5000);


CREATE TABLE `customer_photo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1;

CREATE TABLE `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `quantity` varchar(200) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1;