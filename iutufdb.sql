CREATE TABLE `user` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`username` varchar(100) NOT NULL UNIQUE,
	`email` varchar(100) NOT NULL UNIQUE,
	`passwd` varchar(64) NOT NULL,
	`rol` INT NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `comments` (
	`id` INT NOT NULL AUTO_INCREMENT UNIQUE,
	`comment` varchar(255),
	`iduser` INT(100),
	`video` INT(11) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `video` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`title` varchar(100) NOT NULL,
	`cont` varchar(255),
	`desc` VARCHAR(100),
	`iduser` INT(100) NOT NULL,
	`create-date` DATE NOT NULL,
	`route` varchar(255) NOT NULL UNIQUE,
	`modify-date` DATE,
	PRIMARY KEY (`id`)
);

CREATE TABLE `video_tags` (
	`video_id` INT(11) NOT NULL,
	`tags_id` INT NOT NULL
);

CREATE TABLE `tags` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`tag` varchar(45) NOT NULL UNIQUE,
	PRIMARY KEY (`id`)
);

CREATE TABLE `roles` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`rol` varchar(45) NOT NULL,
	`desc` varchar(45) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `puntuaciones` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`video_id` INT NOT NULL,
	`iduser` INT(50) NOT NULL,
	`p_num` INT(11),
	PRIMARY KEY (`id`)
);

ALTER TABLE `user` ADD CONSTRAINT `user_fk0` FOREIGN KEY (`rol`) REFERENCES `roles`(`id`);

ALTER TABLE `comments` ADD CONSTRAINT `comments_fk0` FOREIGN KEY (`iduser`) REFERENCES `user`(`id`);

ALTER TABLE `comments` ADD CONSTRAINT `comments_fk1` FOREIGN KEY (`video`) REFERENCES `video`(`id`);

ALTER TABLE `video` ADD CONSTRAINT `video_fk0` FOREIGN KEY (`iduser`) REFERENCES `user`(`id`);

ALTER TABLE `video_tags` ADD CONSTRAINT `video_tags_fk0` FOREIGN KEY (`video_id`) REFERENCES `video`(`id`);

ALTER TABLE `video_tags` ADD CONSTRAINT `video_tags_fk1` FOREIGN KEY (`tags_id`) REFERENCES `tags`(`id`);

ALTER TABLE `puntuaciones` ADD CONSTRAINT `puntuaciones_fk0` FOREIGN KEY (`video_id`) REFERENCES `video`(`id`);

ALTER TABLE `puntuaciones` ADD CONSTRAINT `puntuaciones_fk1` FOREIGN KEY (`iduser`) REFERENCES `user`(`id`);

