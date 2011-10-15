/*
 * Account
 */
CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL auto_increment,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL default '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP,
  `email` varchar(128) NOT NULL,
  `password` char(40) NOT NULL,
  `unique_key` char(19) NOT NULL,
  `verified` tinyint NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_account` (`email`)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
 * Group
 */
CREATE TABLE IF NOT EXISTS `group` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `created_at` datetime NOT NULL,
    `updated_at` timestamp NOT NULL default '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP,
    `server_id` int(11) NOT NULL,
    `creator_id` int(11) NOT NULL,
    `name` varchar(128) NOT NULL,
    `faction` ENUM('alliance', 'horde'),
    PRIMARY KEY (`id`),
    UNIQUE KEY `unique_group` (`name`, `server_id`)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
 * Account X Group
 */
CREATE TABLE `_account_x_group` (
    `account_id` INT(11) NOT NULL,
    `group_id` INT(11) NOT NULL,
    `status` ENUM('request', 'member', 'banned', 'rejected', 'operator') NOT NULL DEFAULT 'request',
    `created_at` DATETIME NOT NULL,
    `updated_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`account_id`, `group_id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
ROW_FORMAT=DEFAULT;

/*
 * Server
 */
CREATE TABLE IF NOT EXISTS `server` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `created_at` datetime NOT NULL,
    `updated_at` timestamp NOT NULL default '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP,
    `name` varchar(128) NOT NULL,
    `slug` varchar(128) NOT NULL,
    `type` ENUM('pvp', 'pve', 'rp', 'rppvp') NOT NULL DEFAULT 'pvp',
    `region` ENUM('us', 'eu', 'cn', 'kr', 'tw', 'jp', 'br'),
    PRIMARY KEY (`id`),
    UNIQUE KEY `unique_server` (`name`, `slug`, `region`)
)
ENGINE=InnoDb DEFAULT CHARSET=utf8;

/*
 * Char
 */
CREATE TABLE `char` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `created_at` DATETIME NOT NULL,
    `updated_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
    `account_id` INT(11) NOT NULL,
    `server_id` INT(11) NOT NULL,
    `name` VARCHAR(128) NOT NULL,
    `faction` ENUM('alliance','horde') NOT NULL,
    `class` ENUM('warrior', 'deathknight', 'druid', 'priest', 'paladin', 'rogue', 'hunter', 'mage', 'warlock', 'shaman') NOT NULL,
    `race` ENUM('human', 'dwarf', 'gnome', 'nightelf', 'dreanai', 'worgen', 'orc', 'troll', 'undead', 'bloodelf', 'tauren', 'goblin') NOT NULL,
    `sex` ENUM('male', 'female') NOT NULL,
    `level` INT NOT NULL DEFAULT 1,
    `tree_first` TINYINT NOT NULL DEFAULT 0,
    `tree_second` TINYINT NOT NULL DEFAULT 0,
    `tree_third` TINYINT NOT NULL DEFAULT 0,
    `style_tank` TINYINT NOT NULL DEFAULT 0,
    `style_heal` TINYINT NOT NULL DEFAULT 0,
    `style_dps` TINYINT NOT NULL DEFAULT 0,
    `gearlevel` INT NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `unique_character` (`name`, `server_id`),
    INDEX (`account_id`),
    INDEX (`server_id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
ROW_FORMAT=DEFAULT;

/*
 * Event
 */
CREATE TABLE `event` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `created_at` DATETIME NOT NULL,
    `updated_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
    `group_id` INT(11) NOT NULL,
    `creator_id` INT(11) NOT NULL,
    `type_id` INT(11) NOT NULL,
    `name` VARCHAR(128) NOT NULL,
    `players` TINYINT NOT NULL,
    `start` DATETIME NOT NULL,
    `end` DATETIME NOT NULL,
    `status_id` TINYINT NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    INDEX `group_id` (`group_id`),
    INDEX `creator_id` (`creator_id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
ROW_FORMAT=DEFAULT;

/*
 * APPLICATION TO EVENT
 */
CREATE TABLE `application` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `created_at` DATETIME NOT NULL,
    `updated_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
    `event_id` INT(11) NOT NULL,
    `char_id` INT(11) NOT NULL,
    `status` ENUM('indecicive', 'attending', 'attending_partial', 'replacement', 'dropped') NOT NULL,
    `comment` TINYTEXT NULL,
    `partial_come` DATETIME NULL,
    `partial_go` DATETIME NULL,
    PRIMARY KEY (`id`),
    INDEX `event_id` (`event_id`),
    INDEX `char_id` (`char_id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
ROW_FORMAT=DEFAULT;