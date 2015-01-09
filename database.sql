-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 08, 2015 at 07:15 PM
-- Server version: 5.5.40
-- PHP Version: 5.4.4-14+deb7u14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Projet`
--

-- --------------------------------------------------------

--
-- Table structure for table `Action`
--

CREATE TABLE IF NOT EXISTS `Action` (
  `code_script` int(11) NOT NULL AUTO_INCREMENT,
  `commande` text NOT NULL,
  `nom` text NOT NULL,
  PRIMARY KEY (`code_script`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Action`
--

INSERT INTO `Action` (`code_script`, `commande`, `nom`) VALUES
(1, '', 'Transfert de zone DNS'),
(2, '', 'Récupération de l''OS (ttl)'),
(3, 'python http_scan.py', 'Informations Web'),
(4, 'python ForceFTP.py', 'Test du service FTP'),
(5, '', 'Liste Services');

-- --------------------------------------------------------

--
-- Table structure for table `Alerte`
--

CREATE TABLE IF NOT EXISTS `Alerte` (
  `id_alerte` int(11) NOT NULL AUTO_INCREMENT,
  `ip` text NOT NULL,
  `message` text NOT NULL,
  `etat` int(11) NOT NULL,
  PRIMARY KEY (`id_alerte`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=110 ;

--
-- Dumping data for table `Alerte`
--

INSERT INTO `Alerte` (`id_alerte`, `ip`, `message`, `etat`) VALUES
(109, '', 'Transfert de zone DNS possible : \n	0 IPs trouvées ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `FTP`
--

CREATE TABLE IF NOT EXISTS `FTP` (
  `ip` varchar(15) NOT NULL,
  `banniere` text NOT NULL,
  `login` text NOT NULL,
  `password` text NOT NULL,
  `anonyme` tinyint(1) NOT NULL,
  `fichier` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `FTP`
--

INSERT INTO `FTP` (`ip`, `banniere`, `login`, `password`, `anonyme`, `fichier`) VALUES
('192.168.1.65', '220 (vsFTPd 3.0.2)', '/', '/', 0, 'result.txt');

-- --------------------------------------------------------

--
-- Table structure for table `HTTP`
--

CREATE TABLE IF NOT EXISTS `HTTP` (
  `ip` text NOT NULL,
  `Banniere` text NOT NULL,
  `date` text NOT NULL,
  `methode` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `HTTP`
--

INSERT INTO `HTTP` (`ip`, `Banniere`, `date`, `methode`) VALUES
('192.168.1.88', 'Microsoft-IIS/7.5', 'Thu, 08 Jan 2015 16:49:24 GMT', 'OPTIONS, TRACE, GET, HEAD, POST');

-- --------------------------------------------------------

--
-- Table structure for table `Liste_Machine`
--

CREATE TABLE IF NOT EXISTS `Liste_Machine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` text NOT NULL,
  `mac` varchar(19) NOT NULL,
  `os` text NOT NULL,
  `nom_machine` text NOT NULL,
  `type` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=200 ;

--
-- Dumping data for table `Liste_Machine`
--

INSERT INTO `Liste_Machine` (`id`, `ip`, `mac`, `os`, `nom_machine`, `type`) VALUES
(193, '192.168.1.39', 'B8:EE:65:BB:09:2F', 'Linux', ' kali.', 2),
(194, '192.168.1.61', 'EC:85:2F:89:75:96', ' Apple iOS 4.X|5.X', ' iPhone-de-Remi.', 2),
(195, '192.168.1.64', '', '', ' projet.', 1),
(196, '192.168.1.65', '08:00:27:4D:96:AE', '', ' projet-VirtualBox.', 1),
(197, '192.168.1.79', 'C8:91:F9:95:DF:50', ' Linux 2.6.X|3.X', ' Host-001.', 1),
(198, '192.168.1.88', '08:00:27:F7:F1:E0', ' Microsoft Windows 7|Vista|2008', ' SRV-Projet.', 1),
(199, '192.168.1.254', 'C0:AC:54:0A:8D:2C', 'Linux', ' bbox.lan.', 3);

-- --------------------------------------------------------

--
-- Table structure for table `Resultat_Scan`
--

CREATE TABLE IF NOT EXISTS `Resultat_Scan` (
  `ip` varchar(15) NOT NULL,
  `port` mediumint(9) NOT NULL,
  `service` text NOT NULL,
  `version_service` text NOT NULL,
  `statut` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Resultat_Scan`
--

INSERT INTO `Resultat_Scan` (`ip`, `port`, `service`, `version_service`, `statut`) VALUES
('192.168.1.61', 62078, '  iphone-sync', '?', 'open'),
('192.168.1.64', 21, '  ftp', '?', 'open'),
('192.168.1.64', 22, '  ssh', '?', 'open'),
('192.168.1.64', 80, '  http', '?', 'open'),
('192.168.1.64', 111, '  rpcbind', '?', 'open'),
('192.168.1.65', 21, '  ftp', 'vsftpd3.0.2', 'open'),
('192.168.1.79', 21, '  ftp', '?', 'open'),
('192.168.1.88', 53, '  domain', 'Microsoft DNS6.1.7600', 'open'),
('192.168.1.88', 80, '  http', 'Microsoft IIS httpd7.5', 'open'),
('192.168.1.88', 135, '  msrpc', 'Microsoft Windows RPC', 'open'),
('192.168.1.88', 445, '  microsoft-ds', '', 'open'),
('192.168.1.88', 49154, '  unknown', 'Microsoft Windows RPC', 'open'),
('192.168.1.88', 49156, '  unknown', 'Microsoft Windows RPC', 'open'),
('192.168.1.254', 53, '  domain', '?', 'open'),
('192.168.1.254', 80, '  http', '?', 'open'),
('192.168.1.254', 139, '  netbios-ssn', '?', 'open'),
('192.168.1.254', 631, '  ipp', '?', 'open'),
('192.168.1.254', 8200, '  trivnet1', '?', 'open');

-- --------------------------------------------------------

--
-- Table structure for table `Wifi`
--

CREATE TABLE IF NOT EXISTS `Wifi` (
  `mac` text NOT NULL,
  `ssid` text NOT NULL,
  `securite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
