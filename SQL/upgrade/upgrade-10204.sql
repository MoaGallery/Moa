ALTER TABLE `<prefix>gallery` ADD (
  `UseTags` tinyint(1) NOT NULL
);

UPDATE `<prefix>gallery` SET UseTags = 0;

CREATE TABLE IF NOT EXISTS `<prefix>galleryindex` (
  `IDGalleryIndex` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `IDGallery` int(10) unsigned zerofill NOT NULL,
  `IDImage` int(10) unsigned zerofill NOT NULL,
  `Seq` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`IDGalleryIndex`),
  KEY `Seq` (`Seq`),
  KEY `IDGallery` (`IDGallery`),
  KEY `IDImage` (`IDImage`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;