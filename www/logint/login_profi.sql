CREATE TABLE `login_profi` (
  `id` mediumint(7) unsigned NOT NULL auto_increment,
  `benutzername` varchar(100) NOT NULL,
  `passwort` varchar(32) NOT NULL,
  `passwort_zusatz` varchar(10) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `benutzerinfo` varchar(255) NOT NULL,
  `anmeldung` varchar(32) NOT NULL,
  `zuletzt_aktiv` datetime NOT NULL,
  `fehlversuche` tinyint(2) unsigned NOT NULL,
  `aktiviert` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `benutzername` (`benutzername`)
) ENGINE=MyISAM ;

--
-- Passwort fuer Benutzer Otto ist: geheim
--

INSERT INTO `login_profi` VALUES(1, 'Otto', '024804bce490063fcb700af668550f2c', 'e5645dd85d', '', '', '7a255d6e3ea8436a3f0d902171cc9b89', '0000-00-00 00:00:00', 0, 1);
