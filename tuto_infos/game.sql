CREATE TABLE `game`
(
    `game_id`     INT(11) NOT NULL AUTO_INCREMENT,
    `name`        VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
    `description` TEXT        NOT NULL COLLATE 'latin1_swedish_ci',
    `created_at`  TIMESTAMP   NOT NULL,
    `updated_at`  TIMESTAMP   NOT NULL,
    PRIMARY KEY (`game_id`) USING BTREE
) COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
;