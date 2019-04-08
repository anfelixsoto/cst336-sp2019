--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `password` varchar(512) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`),
  KEY `user2` (`user`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` VALUES (1,'admin','$2y$11$xl8rmzbQXOOIcN8dhMlmEepwp8VUF7Aiid/yvpPg/HNmHQIS/JFvK');
