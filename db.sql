CREATE TABLE IF NOT EXISTS `cats` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50),
	`age` INT,
	`female` TINYINT,
	`mother_id` INT,
	PRIMARY KEY (`id`) USING BTREE
);

CREATE TABLE IF NOT EXISTS `cats_fathers` (
	`id` INT,
	`cat_id` INT,
	INDEX `cat_id` (`cat_id`) USING BTREE,
	INDEX `id` (`id`) USING BTREE
);
