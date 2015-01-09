DROP TABLE IF EXISTS `Liste_Machine`;
CREATE TABLE `Liste_Machine` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`ip` varchar(15) NOT NULL,
`os` TEXT NOT NULL,
`nom_machine` TEXT NOT NULL,
PRIMARY KEY (`id`),
KEY `Liste_Machine_Index1` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `Resultat_Scan`;
CREATE TABLE `Resultat_Scan` (
`scan_id` int(11) NOT NULL,
`port` mediumint(11) NOT NULL,
`version_service` TEXT NOT NULL,
`status` boolean NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `Alerte`;
CREATE TABLE `Alerte` (
`alerte_id` int(11) NOT NULL,
`etat` mediumint(11) NOT NULL,
`message` TEXT NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=latin1;