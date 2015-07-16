<?php
/*
	Author: Valdeir Santana
	Site: http://www.valdeirsantana.com.br
*/
$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pagueveloz_billet` (`pagueveloz_billet_id` int(11) NOT NULL AUTO_INCREMENT,`order_id` int(11) DEFAULT NULL,`billet_id` varchar(255) DEFAULT NULL,`doc` varchar(255) DEFAULT NULL,`complete` smallint(6) DEFAULT '0',PRIMARY KEY (`pagueveloz_billet_id`)) ENGINE=MyISAM DEFAULT CHARSET=latin1;");