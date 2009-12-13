CREATE TABLE IF NOT EXISTS `<prefix>settings` (
  `Name` varchar(100) NOT NULL,
  `Value` varchar(255) NOT NULL default '',
  `Type` varchar(10) NOT NULL default 'STRING',
  UNIQUE KEY  (`Name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `<prefix>image` ADD (
  `Format` varchar(4)
);

DROP TABLE IF EXISTS `<prefix>frontpage`;
CREATE TABLE IF NOT EXISTS `<prefix>frontpage` (
  `Description` blob
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

INSERT INTO `<prefix>frontpage` VALUES ("");