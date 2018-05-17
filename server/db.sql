CREATE DATABASE `iot` /*!40100 DEFAULT CHARACTER SET utf8 */;

CREATE TABLE `iot_office` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` smallint(6) NOT NULL,
  `month` tinyint(4) NOT NULL,
  `day` tinyint(4) NOT NULL,
  `hour` tinyint(4) NOT NULL,
  `minute` tinyint(4) NOT NULL,
  `light` smallint(6) DEFAULT NULL,
  `sound` smallint(6) DEFAULT NULL,
  `motion` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
