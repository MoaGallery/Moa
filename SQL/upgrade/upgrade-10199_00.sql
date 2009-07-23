DROP TABLE IF EXISTS `<prefix>options`;
CREATE TABLE IF NOT EXISTS `<prefix>options` (
  `Name` varchar(40) NOT NULL,
  `Value` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`Name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO <prefix>options (Name, Value) VALUES ('Template', 'MoaDefault');