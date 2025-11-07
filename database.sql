DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user`(
    `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(100) NOT NULL, 
    `password` VARCHAR(255) NOT NULL,
    `nickname` VARCHAR(100) NOT NULL,
    `is_active` BOOLEAN NOT NULL DEFAULT false
);

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
    `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `price` INT NOT NULL,
    `image` VARCHAR(255),
    `is_available` BOOLEAN NOT NULL DEFAULT true,
    `description` TEXT NOT NULL,
    `created_at` INT NOT NULL DEFAULT 0,
    `user_id` INT,
    FOREIGN KEY (user_id) REFERENCES user(`id`)  
);