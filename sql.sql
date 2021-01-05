
CREATE TABLE IF NOT EXISTS `gamessm_servers` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `ip` text NOT NULL,
    `game` text NOT NULL,
    `vip` text NOT NULL,
    `date` text NOT NULL,
    `addedby` text NOT NULL,
    `website` text NOT NULL,
    `startvip` text,
    `expirevip` text,
    PRIMARY KEY (`id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `gamessm_users` (
    `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
    `regdate` int(11) UNSIGNED NOT NULL DEFAULT '0',
    `username` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
    `password` char(60) COLLATE utf8_bin NOT NULL DEFAULT '',
    `email` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
    `role` varchar(255) COLLATE utf8_bin DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
COMMIT;

