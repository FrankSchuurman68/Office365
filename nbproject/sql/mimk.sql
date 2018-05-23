-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 29 jan 2016 om 14:00
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

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `praktijken`
--

CREATE TABLE IF NOT EXISTS `praktijken` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `praktijknummer` int(6) NOT NULL,
  `praktijkvolgnummer` int(6) NOT NULL,
  `naam` varchar(25) NOT NULL,
  `telefoonnummer` varchar(11) NOT NULL,
  `straat` varchar(24) NOT NULL,
  `huisnummer` int(5) NOT NULL,
  `huisnummer_toev` varchar(5) NOT NULL,
  `postcode` varchar(6) NOT NULL,
  `plaatsnaam` varchar(24) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Gegevens worden uitgevoerd voor tabel `praktijken`
--

INSERT INTO `praktijken` (`id`, `praktijknummer`, `praktijkvolgnummer`, `naam`, `telefoonnummer`, `straat`, `huisnummer`, `huisnummer_toev`, `postcode`, `plaatsnaam`) VALUES
(1, 0, 0, 'HAP Apeldoorn', '09006009000', 'Albert Schweitzerlaan', 31, '', '7334DZ', 'Apeldoorn'),
(2, 0, 0, 'HAP Arnhem', '0900 1598', 'Meester D.U. Stikkerstra', 122, '', '6842CW', 'Arnhem'),
(3, 0, 0, 'HAP Gorinchem', '', '', 0, '', '', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `relatie`
--

CREATE TABLE IF NOT EXISTS `relatie` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `id_users` int(6) NOT NULL,
  `id_praktijken` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Gegevens worden uitgevoerd voor tabel `relatie`
--

INSERT INTO `relatie` (`id`, `id_users`, `id_praktijken`) VALUES
(1, 2, 1),
(2, 14, 1),
(3, 15, 1),
(4, 16, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rights`
--

CREATE TABLE IF NOT EXISTS `rights` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `admin` int(2) NOT NULL,
  `user` int(6) NOT NULL,
  `export` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Gegevens worden uitgevoerd voor tabel `rights`
--

INSERT INTO `rights` (`id`, `admin`, `user`, `export`) VALUES
(1, 1, 2, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phone_number` varchar(16) DEFAULT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `confirmcode` varchar(32) DEFAULT NULL,
  `zorgverlenersnummer` int(6) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Gegevens worden uitgevoerd voor tabel `users`
--

INSERT INTO `users` (`id_user`, `name`, `email`, `phone_number`, `username`, `password`, `confirmcode`, `zorgverlenersnummer`) VALUES
(2, 'Frank Schuurman', 'frank@confra.nl', '', 'fschuurman', '8cbc2cbe8c97fcae9fbf8cb163b28445', 'y', 0),
(14, 'Herko Wegter', 'hwegter@novensys.nl', '', 'hwegter', 'dc647eb65e6711e155375218212b3964', NULL, 0),
(15, 'Connie Tool', 'ctool@confra.nl', '', 'ctool', 'dc647eb65e6711e155375218212b3964', NULL, 0),
(16, '', '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', NULL, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
