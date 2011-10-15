/*
 * === CONSTRAINTS ===
 */

/* group needs to be on a server */
ALTER TABLE `group` ADD FOREIGN KEY `group_has_server` (server_id) REFERENCES `server`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE; 
ALTER TABLE `group` ADD FOREIGN KEY `group_has_creator` (creator_id) REFERENCES `account`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

/* group to account */
ALTER TABLE `_account_x_group`  ADD CONSTRAINT `FK__account_x_group_account` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE `_account_x_group`  ADD CONSTRAINT `FK__account_x_group_group` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

/* character to account/server */
ALTER TABLE `char` ADD CONSTRAINT `char_has_account` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT;
ALTER TABLE `char` ADD CONSTRAINT `char_has_server` FOREIGN KEY (`server_id`) REFERENCES `server` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT;

/* event to creator/group */
ALTER TABLE `event` ADD CONSTRAINT `event_has_creator` FOREIGN KEY (`creator_id`) REFERENCES `account` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT;
ALTER TABLE `event` ADD CONSTRAINT `event_has_group` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

/* application to event/char */
ALTER TABLE `application` ADD CONSTRAINT `application_has_event` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE `application` ADD CONSTRAINT `application_has_char` FOREIGN KEY (`char_id`) REFERENCES `char` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;
