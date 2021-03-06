CREATE TABLE `blog`.`post` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(256) NOT NULL,
  `content` TEXT(10240) NULL,
  `create_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `title_UNIQUE` (`title` ASC));


CREATE TABLE `blog`.`comment` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `post_id` INT NULL,
  `content` TEXT(10240) NULL,
  PRIMARY KEY (`id`),
  INDEX `post_id_idx` (`post_id` ASC),
  CONSTRAINT `post_id`
    FOREIGN KEY (`post_id`)
    REFERENCES `blog`.`post` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


CREATE TABLE `blog`.`user` (
  `id` INT NOT NULL,
  `username` VARCHAR(32) NOT NULL,
  `password` VARCHAR(64) NOT NULL,
  `active` TINYINT NULL DEFAULT 1,
  `role` INT NULL,
  `create_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC));