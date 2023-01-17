--
-- Create schema test_db
--

CREATE DATABASE IF NOT EXISTS test_db;
USE test_db;

--
-- Definition of table `hourly_temp`
--

DROP TABLE IF EXISTS `hourly_temp`;
CREATE TABLE `hourly_temp` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `temp` double(4,2) NOT NULL,
  `dateT` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hourly_temp`
--

/*!40000 ALTER TABLE `hourly_temp` DISABLE KEYS */;
INSERT INTO `hourly_temp` (`id`,`temp`,`dateT`) VALUES 
 (4,7.07,'2023-01-17 20:47:11'),
 (5,7.07,'2023-01-17 21:02:48');
/*!40000 ALTER TABLE `hourly_temp` ENABLE KEYS */;


