DROP TABLE IF EXISTS `#__ganalytics`;

CREATE TABLE `#__ganalytics` (
  `id` int(11) NOT NULL auto_increment,
  `accountID` varchar(100) NOT NULL,
  `accountName` varchar(100) NOT NULL,
  `profileID` varchar(100) NOT NULL,
  `profileName` varchar(100) NOT NULL,
  `webPropertyId` varchar(100) NOT NULL,
  `startDate` DATE NOT NULL,
  PRIMARY KEY  (`id`)
);
