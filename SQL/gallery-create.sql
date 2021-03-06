SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------

--
-- Table structure for table `<prefix>gallery`
--

DROP TABLE IF EXISTS `<prefix>gallery`;
CREATE TABLE IF NOT EXISTS `<prefix>gallery` (
  `IDGallery` int(10) unsigned zerofill NOT NULL auto_increment,
  `Name` varchar(255) NOT NULL default '',
  `Description` blob,
  `IDParent` int(10) unsigned zerofill NOT NULL default '0000000000',
  `UseTags` tinyint(1) NOT NULL,
  PRIMARY KEY  (`IDGallery`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;

-- --------------------------------------------------------

--
-- Table structure for table `<prefix>galleryindex`
--

DROP TABLE IF EXISTS `<prefix>galleryindex`;
CREATE TABLE IF NOT EXISTS `<prefix>galleryindex` (
  `IDGalleryIndex` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `IDGallery` int(10) unsigned zerofill NOT NULL,
  `IDImage` int(10) unsigned zerofill NOT NULL,
  `Seq` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`IDGalleryIndex`),
  KEY `Seq` (`Seq`),
  KEY `IDGallery` (`IDGallery`),
  KEY `IDImage` (`IDImage`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Table structure for table `<prefix>gallerytaglink`
--

DROP TABLE IF EXISTS `<prefix>gallerytaglink`;
CREATE TABLE IF NOT EXISTS `<prefix>gallerytaglink` (
  `IDGalleryTagLink` int(10) unsigned zerofill NOT NULL auto_increment,
  `IDGallery` int(10) unsigned zerofill NOT NULL default '0000000000',
  `IDTag` int(10) unsigned zerofill NOT NULL default '0000000000',
  PRIMARY KEY  (`IDGalleryTagLink`),
  KEY `IDGallery` (`IDGallery`),
  KEY `IDTag` (`IDTag`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Table structure for table `<prefix>image`
--

DROP TABLE IF EXISTS `<prefix>image`;
CREATE TABLE IF NOT EXISTS `<prefix>image` (
  `IDImage` int(10) unsigned zerofill NOT NULL auto_increment,
  `Filename` varchar(255) NOT NULL default '',
  `Description` blob,
  `Width` int(5) unsigned NOT NULL,
  `Height` int(5) unsigned NOT NULL,
  `Format` varchar(4) NOT NULL,
  PRIMARY KEY  (`IDImage`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Table structure for table `<prefix>imagetaglink`
--

DROP TABLE IF EXISTS `<prefix>imagetaglink`;
CREATE TABLE IF NOT EXISTS `<prefix>imagetaglink` (
  `IDImageTagLink` int(10) unsigned zerofill NOT NULL auto_increment,
  `IDImage` int(10) unsigned zerofill NOT NULL default '0000000000',
  `IDTag` int(10) unsigned zerofill NOT NULL default '0000000000',
  PRIMARY KEY  (`IDImageTagLink`),
  KEY `IDImage` (`IDImage`),
  KEY `IDTag` (`IDTag`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Table structure for table `<prefix>tag`
--

DROP TABLE IF EXISTS `<prefix>tag`;
CREATE TABLE IF NOT EXISTS `<prefix>tag` (
  `IDTag` int(10) unsigned zerofill NOT NULL auto_increment,
  `Name` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`IDTag`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Table structure for table `<prefix>users`
--

DROP TABLE IF EXISTS `<prefix>users`;
CREATE TABLE IF NOT EXISTS `<prefix>users` (
  `IDUser` int(10) unsigned zerofill NOT NULL auto_increment,
  `Name` varchar(40) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Admin` tinyint(1) NOT NULL,
  `Salt` varchar(8) NOT NULL,
  PRIMARY KEY  (`IDUser`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Table structure for table `<prefix>settings`
--

DROP TABLE IF EXISTS `<prefix>settings`;
CREATE TABLE IF NOT EXISTS `<prefix>settings` (
  `Name` varchar(100) NOT NULL,
  `Value` varchar(255) NOT NULL,
  `Type` varchar(10) NOT NULL,
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

--
-- Table structure for table `<prefix>frontpage`
--

DROP TABLE IF EXISTS `<prefix>frontpage`;
CREATE TABLE IF NOT EXISTS `<prefix>frontpage` (
  `Description` blob
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

INSERT INTO `<prefix>frontpage` VALUES ("");

--
-- Constraints for dumped tables
--

--
-- Constraints for table `<prefix>gallerytaglink`
--

ALTER TABLE `<prefix>gallerytaglink`
  ADD CONSTRAINT `<prefix>gallerytaglink_ibfk_1` FOREIGN KEY (`IDGallery`) REFERENCES `<prefix>gallery` (`IDGallery`),
  ADD CONSTRAINT `<prefix>gallerytaglink_ibfk_2` FOREIGN KEY (`IDTag`) REFERENCES `<prefix>tag` (`IDTag`);

--
-- Constraints for table `<prefix>imagetaglink`
--
ALTER TABLE `<prefix>imagetaglink`
  ADD CONSTRAINT `<prefix>imagetaglink_ibfk_1` FOREIGN KEY (`IDImage`) REFERENCES `<prefix>image` (`IDImage`),
  ADD CONSTRAINT `<prefix>imagetaglink_ibfk_2` FOREIGN KEY (`IDTag`) REFERENCES `<prefix>tag` (`IDTag`);