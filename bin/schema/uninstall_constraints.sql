/*
 * GROUP
 */
ALTER TABLE `group`  DROP FOREIGN KEY `group_ibfk_1`,  DROP FOREIGN KEY `group_ibfk_2`;

/*
 * ACCOUNT_GROUP
 */
ALTER TABLE `_account_x_group`  DROP FOREIGN KEY `FK__account_x_group_group`,  DROP FOREIGN KEY `FK__account_x_group_account`;

/*
 * CHAR
 */
ALTER TABLE `char`  DROP FOREIGN KEY `char_has_account`,  DROP FOREIGN KEY `char_has_server`;

/*
 * EVENT
 */
ALTER TABLE `event`  DROP FOREIGN KEY `event_has_creator`,  DROP FOREIGN KEY `event_has_group`;

/*
 * APPLICATION
 */
ALTER TABLE `application`  DROP FOREIGN KEY `application_has_event`,  DROP FOREIGN KEY `application_has_char`;