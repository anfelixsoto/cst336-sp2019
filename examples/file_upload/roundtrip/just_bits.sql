CREATE DATABASE IF NOT EXISTS `just_bits` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `just_bits`;

DROP TABLE IF EXISTS `bit_storage`;
CREATE TABLE IF NOT EXISTS `bit_storage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `caption` varchar(256) DEFAULT NULL,
  `content_type` varchar(64) NOT NULL,
  `email_address` varchar(128) DEFAULT NULL,
  `bits` mediumblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
