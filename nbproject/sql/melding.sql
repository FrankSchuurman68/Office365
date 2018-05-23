-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 29 jan 2016 om 13:59
-- Serverversie: 5.5.24-log
-- PHP-versie: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `mimk`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `melding`
--

CREATE TABLE IF NOT EXISTS `melding` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `organisatie` int(6) NOT NULL,
  `zorgverlener` varchar(40) NOT NULL,
  `geslacht` varchar(8) NOT NULL,
  `geboortedatum` varchar(10) NOT NULL,
  `ingangsklacht` varchar(40) NOT NULL,
  `ikanders` varchar(40) NOT NULL,
  `toegevwaarde` varchar(40) NOT NULL,
  `toelichting` varchar(500) NOT NULL,
  `timestamp` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `timestamp` (`timestamp`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Gegevens worden uitgevoerd voor tabel `melding`
--

INSERT INTO `melding` (`id`, `organisatie`, `zorgverlener`, `geslacht`, `geboortedatum`, `ingangsklacht`, `ikanders`, `toegevwaarde`, `toelichting`, `timestamp`) VALUES
(34, 1, 'fred', 'Man', '12-12-2014', 'Huid', '', 'Nee - Niet voldoende zichtbaar', 'dit is een test 1', '0000-00-00'),
(35, 1, 'Kees', 'Vrouw', '12-12-2014', 'Huid', '', 'Ja - Door beeld toch hogere urgentie', 'dit is een test 2', '0000-00-00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
