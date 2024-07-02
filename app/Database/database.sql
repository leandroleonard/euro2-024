drop table if exists `player`;

create table `player`(
    `id` int primary key auto_increment,
    `name` varchar(50) not null,
    `position` varchar(10) not null,
    `birthday` date not null,
    `image` text,
    `team_id` int not null,
    foreign key `team_id` references `team`(`id`)
);

DROP TABLE IF EXISTS `player`;

CREATE TABLE `player` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `position` VARCHAR(10) NOT NULL,
    `birthday` DATE NOT NULL,
    `image` TEXT,
    `team_id` INT NOT NULL,
    FOREIGN KEY (`team_id`) REFERENCES `team`(`id`)
);


DROP TABLE IF EXISTS `championship`

CREATE TABLE `championship` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `description` TEXT,
    `type` enum("knock-out", "classification")
);

DROP TABLE IF EXISTS `season`

CREATE TABLE `season`(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `description` VARCHAR(50) NOT NULL
);

DROP TABLE IF EXISTS `match`

CREATE TABLE `match`(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `season_id` INT,
    `date` datetime,
    `home_id` INT NOT NULL,
    `away_id` INT NOT NULL,
    `goals_home` INT NOT NULL,
    `goals_away` INT NOT NULL,
    FOREIGN KEY (`season_id`) REFERENCES `season`(`id`),
    FOREIGN KEY (`home_id`) REFERENCES `team`(`id`),
    FOREIGN KEY (`away_id`) REFERENCES `team`(`id`)
);

CREATE TABLE `match_details`(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `event` TEXT NOT NULL,
    `minute` TIME,
    `player_id` INT NOT NULL,
    `match_id` INT NOT NULL,
    FOREIGN KEY (`player_id`) REFERENCES `player`(`id`),
    FOREIGN KEY (`match_id`) REFERENCES `match`(`id`)
);

CREATE TABLE IF NOT EXISTS `group`(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `description` CHAR NOT NULL
);

INSERT INTO `group` (`description`) VALUES
('A'),
('B'),
('C'),
('D'),
('E'),
('F');

CREATE TABLE IF NOT EXISTS `teams_group`(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `group_id` INT NOT NULL,
    `team_id` INT NOT NULL,
    FOREIGN KEY (`group_id`) REFERENCES `group`(`id`),
    FOREIGN KEY (`team_id`) REFERENCES `team`(`id`)
);