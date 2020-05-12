-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 14, 2020 at 11:48 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ha_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ha_agrees`
--

CREATE TABLE `ha_agrees` (
  `ID_AGRE` int(11) NOT NULL,
  `ID_CMPT` int(11) NOT NULL,
  `ID_AGR` int(11) DEFAULT NULL,
  `DATE_AGRE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_agrees`
--

INSERT INTO `ha_agrees` (`ID_AGRE`, `ID_CMPT`, `ID_AGR`, `DATE_AGRE`, `MODE`) VALUES
(1, 1, 2, '17/08/2016, 11:33:38', 1),
(2, 5, 2, '17/08/2016, 11:53:07', 1),
(3, 2, 1, '17/08/2016, 17:44:53', 1),
(4, 3, 1, '17/08/2016, 17:50:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_alert`
--

CREATE TABLE `ha_alert` (
  `ID_ALT` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `ICON` text COLLATE utf8_unicode_ci NOT NULL,
  `TEXTE` text COLLATE utf8_unicode_ci NOT NULL,
  `DATE_HEURE` text COLLATE utf8_unicode_ci NOT NULL,
  `DATE_VUE` text COLLATE utf8_unicode_ci,
  `ACTIONBTN` text COLLATE utf8_unicode_ci,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ha_annexe_contrat`
--

CREATE TABLE `ha_annexe_contrat` (
  `ID_ANEX` int(11) NOT NULL,
  `ID_CONTRAT` int(11) NOT NULL,
  `LIBELLE` text COLLATE utf8_unicode_ci NOT NULL,
  `PIECE` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ha_appel_offre`
--

CREATE TABLE `ha_appel_offre` (
  `ID_APPEL` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `ID_DOM_A` int(11) NOT NULL,
  `ID_TYPE_O` int(11) NOT NULL,
  `CATEGORIE` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SPECIFICATION` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `REF` text COLLATE utf8_unicode_ci NOT NULL,
  `LIBELLE` text COLLATE utf8_unicode_ci NOT NULL,
  `DATE_D` text COLLATE utf8_unicode_ci NOT NULL,
  `DATE_F` text COLLATE utf8_unicode_ci NOT NULL,
  `CONFIDENCIAL` tinyint(1) NOT NULL,
  `PUBLIER` tinyint(1) NOT NULL,
  `CREER_PAR` text COLLATE utf8_unicode_ci NOT NULL,
  `CREER_LE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODIFIER_PAR` text COLLATE utf8_unicode_ci,
  `MODIFIER_LE` text COLLATE utf8_unicode_ci,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_appel_offre`
--

INSERT INTO `ha_appel_offre` (`ID_APPEL`, `ID_USER`, `ID_DOM_A`, `ID_TYPE_O`, `CATEGORIE`, `SPECIFICATION`, `REF`, `LIBELLE`, `DATE_D`, `DATE_F`, `CONFIDENCIAL`, `PUBLIER`, `CREER_PAR`, `CREER_LE`, `MODIFIER_PAR`, `MODIFIER_LE`, `MODE`) VALUES
(1, 1, 6, 1, NULL, '0', 'CLT/RFQ-2017N&deg;00001', 'Unde Rufinus ea tempestate test', '10/04/2020', '24/04/2020', 1, 1, 'Junior MAMADOU', '08/04/2017, 01:06:41', 'Junior MAMADOU', '09/04/2017, 01:17:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_article_cataloguer`
--

CREATE TABLE `ha_article_cataloguer` (
  `ID_ART_CAT` int(11) NOT NULL,
  `ID_CAT_FRS` int(11) NOT NULL,
  `ID_DOM_A` int(11) NOT NULL,
  `ID_S_DOM` int(11) NOT NULL,
  `CODE` text COLLATE utf8_unicode_ci NOT NULL,
  `REFERENCE` text COLLATE utf8_unicode_ci NOT NULL,
  `DESIGNATION` text COLLATE utf8_unicode_ci NOT NULL,
  `DATE_REFER` text COLLATE utf8_unicode_ci NOT NULL,
  `DELAI_MOY_LIV` text COLLATE utf8_unicode_ci NOT NULL,
  `DATE_CHANG` text COLLATE utf8_unicode_ci NOT NULL,
  `COMAND_MIN` int(11) NOT NULL,
  `CREER_LE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODIFIER_LE` text COLLATE utf8_unicode_ci,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_article_cataloguer`
--

INSERT INTO `ha_article_cataloguer` (`ID_ART_CAT`, `ID_CAT_FRS`, `ID_DOM_A`, `ID_S_DOM`, `CODE`, `REFERENCE`, `DESIGNATION`, `DATE_REFER`, `DELAI_MOY_LIV`, `DATE_CHANG`, `COMAND_MIN`, `CREER_LE`, `MODIFIER_LE`, `MODE`) VALUES
(1, 2, 8, 43, '2347', 'DER5', 'Transport de Personnel ', '42599', 'Imm&eacute;diat', '42599', 50, '17/08/2016, 11:19:08', NULL, 1),
(2, 2, 8, 44, '2348', 'DER6', 'Transport de Marchandises', '42599', 'Imm&eacute;diat ', '42599', 50, '17/08/2016, 11:19:08', NULL, 1),
(3, 3, 8, 43, '2345', 'DER3', 'Transport de Personnel ', '42599', 'Imm&eacute;diat', '42599', 50, '17/08/2016, 11:24:04', NULL, 1),
(4, 3, 8, 44, '2346', 'DER4', 'Transport de Marchandises', '42599', 'Imm&eacute;diat ', '42599', 50, '17/08/2016, 11:24:04', NULL, 1),
(5, 4, 6, 38, '2345', 'DER3', 'TONER 1', '42599', '1 mois', '42599', 50, '17/08/2016, 11:40:43', NULL, 1),
(6, 4, 6, 38, '2346', 'DER4', 'TONER 2', '42599', '1 mois', '42599', 50, '17/08/2016, 11:40:43', NULL, 1),
(7, 4, 6, 38, '2347', 'DER5', 'TONER 3', '42599', '1 mois', '42599', 50, '17/08/2016, 11:40:43', NULL, 1),
(8, 4, 6, 38, '2348', 'DER6', 'TONER 4', '42599', '1 mois', '42599', 50, '17/08/2016, 11:40:43', NULL, 1),
(9, 4, 6, 38, '2349', 'DER7', 'TONER 5', '42599', '1 mois', '42599', 50, '17/08/2016, 11:40:43', NULL, 1),
(10, 4, 6, 38, '2350', 'DER8', 'TONER 6', '42599', '1 mois', '42599', 50, '17/08/2016, 11:40:43', NULL, 1),
(11, 4, 6, 38, '2351', 'DER9', 'TONER 7', '42599', '1 mois', '42599', 50, '17/08/2016, 11:40:43', NULL, 1),
(12, 4, 6, 38, '2352', 'DER10', 'TONER 8', '42599', '1 mois', '42599', 50, '17/08/2016, 11:40:43', NULL, 1),
(13, 4, 6, 38, '2353', 'DER11', 'TONER 9', '42599', '1 mois', '42599', 50, '17/08/2016, 11:40:43', NULL, 1),
(14, 4, 6, 38, '2354', 'DER12', 'TONER 10', '42599', '1 mois', '42599', 50, '17/08/2016, 11:40:43', NULL, 1),
(15, 4, 6, 38, '2355', 'DER13', 'TONER 11', '42599', '1 mois', '42599', 50, '17/08/2016, 11:40:43', NULL, 1),
(16, 4, 6, 38, '2356', 'DER14', 'TONER 12', '42599', '1 mois', '42599', 50, '17/08/2016, 11:40:43', NULL, 1),
(17, 4, 6, 38, '2357', 'DER15', 'TONER 13', '42599', '1 mois', '42599', 50, '17/08/2016, 11:40:43', NULL, 1),
(18, 4, 6, 38, '2358', 'DER16', 'TONER 14', '42599', '1 mois', '42599', 50, '17/08/2016, 11:40:43', NULL, 1),
(19, 4, 6, 38, '2359', 'DER17', 'TONER 15', '42599', '1 mois', '42599', 50, '17/08/2016, 11:40:43', NULL, 1),
(20, 4, 6, 38, '2360', 'DER18', 'TONER 16', '42599', '1 mois', '42599', 50, '17/08/2016, 11:40:43', NULL, 1),
(21, 4, 6, 38, '2361', 'DER19', 'TONER 17', '42599', '1 mois', '42599', 50, '17/08/2016, 11:40:43', NULL, 1),
(22, 4, 6, 38, '2362', 'DER20', 'TONER 18', '42599', '1 mois', '42599', 50, '17/08/2016, 11:40:43', NULL, 1),
(23, 4, 6, 38, '2363', 'DER21', 'TONER 19', '42599', '1 mois', '42599', 50, '17/08/2016, 11:40:43', NULL, 1),
(24, 4, 6, 38, '2364', 'DER22', 'TONER 20', '42599', '1 mois', '42599', 50, '17/08/2016, 11:40:43', NULL, 1),
(25, 4, 6, 38, '2365', 'DER23', 'TONER 21', '42599', '1 mois', '42599', 50, '17/08/2016, 11:40:43', NULL, 1),
(26, 4, 6, 38, '2366', 'DER24', 'TONER 22', '42599', '1 mois', '42599', 50, '17/08/2016, 11:40:43', NULL, 1),
(27, 4, 6, 38, '2367', 'DER25', 'TONER 23', '42599', '1 mois', '42599', 50, '17/08/2016, 11:40:43', NULL, 1),
(28, 4, 6, 38, '2368', 'DER26', 'TONER 24', '42599', '1 mois', '42599', 50, '17/08/2016, 11:40:43', NULL, 1),
(29, 5, 6, 38, '2369', 'DER27', 'TONER 1', '42599', '1 mois', '42599', 50, '17/08/2016, 12:00:52', NULL, 1),
(30, 5, 6, 38, '2370', 'DER28', 'TONER 2', '42599', '1 mois', '42599', 50, '17/08/2016, 12:00:52', NULL, 1),
(31, 5, 6, 38, '2371', 'DER29', 'TONER 3', '42599', '1 mois', '42599', 50, '17/08/2016, 12:00:52', NULL, 1),
(32, 5, 6, 38, '2372', 'DER30', 'TONER 4', '42599', '1 mois', '42599', 50, '17/08/2016, 12:00:52', NULL, 1),
(33, 5, 6, 38, '2373', 'DER31', 'TONER 5', '42599', '1 mois', '42599', 50, '17/08/2016, 12:00:52', NULL, 1),
(34, 5, 6, 38, '2374', 'DER32', 'TONER 6', '42599', '1 mois', '42599', 50, '17/08/2016, 12:00:52', NULL, 1),
(35, 5, 6, 38, '2375', 'DER33', 'TONER 7', '42599', '1 mois', '42599', 50, '17/08/2016, 12:00:52', NULL, 1),
(36, 5, 6, 38, '2376', 'DER34', 'TONER 8', '42599', '1 mois', '42599', 50, '17/08/2016, 12:00:52', NULL, 1),
(37, 5, 6, 38, '2377', 'DER35', 'TONER 9', '42599', '1 mois', '42599', 50, '17/08/2016, 12:00:52', NULL, 1),
(38, 5, 6, 38, '2378', 'DER36', 'TONER 10', '42599', '1 mois', '42599', 50, '17/08/2016, 12:00:52', NULL, 1),
(39, 5, 6, 38, '2379', 'DER37', 'TONER 11', '42599', '1 mois', '42599', 50, '17/08/2016, 12:00:52', NULL, 1),
(40, 5, 6, 38, '2380', 'DER38', 'TONER 12', '42599', '1 mois', '42599', 50, '17/08/2016, 12:00:52', NULL, 1),
(41, 5, 6, 38, '2381', 'DER39', 'TONER 13', '42599', '1 mois', '42599', 50, '17/08/2016, 12:00:52', NULL, 1),
(42, 5, 6, 38, '2382', 'DER40', 'TONER 14', '42599', '1 mois', '42599', 50, '17/08/2016, 12:00:52', NULL, 1),
(43, 5, 6, 38, '2383', 'DER41', 'TONER 15', '42599', '1 mois', '42599', 50, '17/08/2016, 12:00:52', NULL, 1),
(44, 5, 6, 38, '2384', 'DER42', 'TONER 16', '42599', '1 mois', '42599', 50, '17/08/2016, 12:00:52', NULL, 1),
(45, 5, 6, 38, '2385', 'DER43', 'TONER 17', '42599', '1 mois', '42599', 50, '17/08/2016, 12:00:52', NULL, 1),
(46, 5, 6, 38, '2386', 'DER44', 'TONER 18', '42599', '1 mois', '42599', 50, '17/08/2016, 12:00:52', NULL, 1),
(47, 5, 6, 38, '2387', 'DER45', 'TONER 19', '42599', '1 mois', '42599', 50, '17/08/2016, 12:00:52', NULL, 1),
(48, 5, 6, 38, '2388', 'DER46', 'TONER 20', '42599', '1 mois', '42599', 50, '17/08/2016, 12:00:52', NULL, 1),
(49, 5, 6, 38, '2389', 'DER47', 'TONER 21', '42599', '1 mois', '42599', 50, '17/08/2016, 12:00:52', NULL, 1),
(50, 5, 6, 38, '2390', 'DER48', 'TONER 22', '42599', '1 mois', '42599', 50, '17/08/2016, 12:00:52', NULL, 1),
(51, 5, 6, 38, '2391', 'DER49', 'TONER 23', '42599', '1 mois', '42599', 50, '17/08/2016, 12:00:52', NULL, 1),
(52, 5, 6, 38, '2392', 'DER50', 'TONER 24', '42599', '1 mois', '42599', 50, '17/08/2016, 12:00:52', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_avenant_contrat`
--

CREATE TABLE `ha_avenant_contrat` (
  `ID_AVENANT` int(11) NOT NULL,
  `ID_CONTRAT` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `ID_AGRE` int(11) NOT NULL,
  `CODE` text COLLATE utf8_unicode_ci NOT NULL,
  `LIBELLE` text COLLATE utf8_unicode_ci NOT NULL,
  `PRIX` text COLLATE utf8_unicode_ci NOT NULL,
  `CONDITION_PAIE` text COLLATE utf8_unicode_ci NOT NULL,
  `DELAIS` int(11) NOT NULL,
  `DATE_DEBUT` text COLLATE utf8_unicode_ci NOT NULL,
  `DUREE` int(11) NOT NULL,
  `PIECE` text COLLATE utf8_unicode_ci,
  `ETAT` tinyint(1) DEFAULT NULL,
  `DATE_CHARGE` text COLLATE utf8_unicode_ci,
  `CONFIRMER` tinyint(1) DEFAULT NULL,
  `CREER_PAR` text COLLATE utf8_unicode_ci NOT NULL,
  `CREER_LE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODIFIER_PAR` text COLLATE utf8_unicode_ci,
  `MODIFIER_LE` text COLLATE utf8_unicode_ci,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_avenant_contrat`
--

INSERT INTO `ha_avenant_contrat` (`ID_AVENANT`, `ID_CONTRAT`, `ID_USER`, `ID_AGRE`, `CODE`, `LIBELLE`, `PRIX`, `CONDITION_PAIE`, `DELAIS`, `DATE_DEBUT`, `DUREE`, `PIECE`, `ETAT`, `DATE_CHARGE`, `CONFIRMER`, `CREER_PAR`, `CREER_LE`, `MODIFIER_PAR`, `MODIFIER_LE`, `MODE`) VALUES
(1, 1, 1, 4, 'AV-2017N&deg;00001', 'Post quorum necem nihilo lenius', '__9.000.000 XOF', 'ferociens Gallus ut leo cadaveribus \r\npastus multa huius modi scrutabatur', 11, '30/06/2017', 1080, 'dc255cef4d740b4643391dbac9c01645cb5fbc0b.docx', 0, NULL, 1, 'Junior MAMADOU', '10/05/2017, 22:07:10', 'Junior MAMADOU', '10/05/2017, 22:30:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_bon_commande`
--

CREATE TABLE `ha_bon_commande` (
  `ID_BC` int(11) NOT NULL,
  `ID_DA` int(11) NOT NULL,
  `ID_AGRE` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `CODE` text COLLATE utf8_unicode_ci NOT NULL,
  `TYPE_BC` tinyint(1) NOT NULL,
  `CATEGORIE` text COLLATE utf8_unicode_ci NOT NULL,
  `IMP_ANAL` text COLLATE utf8_unicode_ci NOT NULL,
  `MONTANT_HT` bigint(20) NOT NULL,
  `TVA` double NOT NULL,
  `MONTANT_TTC` bigint(20) NOT NULL,
  `REGLEMENT` tinyint(1) NOT NULL,
  `DATE_BC` text COLLATE utf8_unicode_ci NOT NULL,
  `DATE_LIV` text COLLATE utf8_unicode_ci NOT NULL,
  `CONFIRMER` tinyint(1) DEFAULT NULL,
  `CREER_PAR` text COLLATE utf8_unicode_ci NOT NULL,
  `CREER_LE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODIFIER_PAR` text COLLATE utf8_unicode_ci,
  `MODIFIER_LE` text COLLATE utf8_unicode_ci,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_bon_commande`
--

INSERT INTO `ha_bon_commande` (`ID_BC`, `ID_DA`, `ID_AGRE`, `ID_USER`, `CODE`, `TYPE_BC`, `CATEGORIE`, `IMP_ANAL`, `MONTANT_HT`, `TVA`, `MONTANT_TTC`, `REGLEMENT`, `DATE_BC`, `DATE_LIV`, `CONFIRMER`, `CREER_PAR`, `CREER_LE`, `MODIFIER_PAR`, `MODIFIER_LE`, `MODE`) VALUES
(1, 1, 2, 1, 'BC-2017N&deg;00001', 0, 'bien', 'KSI', 600000, 0.18, 708000, 0, '17/05/2017', '01/06/2017', 1, 'Junior MAMADOU', '17/05/2017, 16:40:56', 'Junior MAMADOU', '17/05/2017, 21:57:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_catalogue_four`
--

CREATE TABLE `ha_catalogue_four` (
  `ID_CAT_FRS` int(11) NOT NULL,
  `ID_DOM_A` int(11) NOT NULL,
  `ID_CMPT` int(11) NOT NULL,
  `CODE_CAT` text COLLATE utf8_unicode_ci NOT NULL,
  `TITRE` text COLLATE utf8_unicode_ci NOT NULL,
  `AUTORISER` tinyint(1) NOT NULL,
  `FICHIER` text COLLATE utf8_unicode_ci NOT NULL,
  `CREER_LE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODIFIER_LE` text COLLATE utf8_unicode_ci,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_catalogue_four`
--

INSERT INTO `ha_catalogue_four` (`ID_CAT_FRS`, `ID_DOM_A`, `ID_CMPT`, `CODE_CAT`, `TITRE`, `AUTORISER`, `FICHIER`, `CREER_LE`, `MODIFIER_LE`, `MODE`) VALUES
(1, 1, 1, 'CAT/FRS01', 'CATALOGUE ARTICLES RK', 1, '007e9bd2978c3cd764c873ad8d314747bb093550.doc', '26/01/2015, 10:15:30', NULL, 1),
(2, 8, 5, 'CAT-2016/FRS/N&deg;00002', 'Catalogue SPEED 2016', 0, '007e9bd2978c3cd764c873ad8d314747bb093550.doc', '17/08/2016, 11:19:08', NULL, 1),
(3, 8, 4, 'CAT-2016/FRS/N&deg;00003', 'CATALOGUE UTB 2016', 0, '55c4cde909f517e29bf42757f99711d6c8e627af.doc', '17/08/2016, 11:24:04', NULL, 1),
(4, 6, 2, 'CAT-2016/FRS/N&deg;00004', 'Catalogue DUPONT 2016', 0, 'fe7598427c96a351e41dd3ac20096778a66ad742.doc', '17/08/2016, 11:40:43', NULL, 1),
(5, 6, 3, 'CAT-2016/FRS/N&deg;00005', 'Catalogue GKS 2016', 1, 'cd2d8cbf02173d5333a0d7296fb1ea2877c30595.doc', '17/08/2016, 12:00:52', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_chiffre_affaire_four`
--

CREATE TABLE `ha_chiffre_affaire_four` (
  `ID_CA_FRS` int(11) NOT NULL,
  `ID_CMPT` int(11) NOT NULL,
  `ANNEE` text COLLATE utf8_unicode_ci,
  `CA` int(11) NOT NULL,
  `RESULTATS_NET` int(11) NOT NULL,
  `ORDRE` int(11) NOT NULL,
  `CREER_LE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODIFIER_LE` text COLLATE utf8_unicode_ci,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_chiffre_affaire_four`
--

INSERT INTO `ha_chiffre_affaire_four` (`ID_CA_FRS`, `ID_CMPT`, `ANNEE`, `CA`, `RESULTATS_NET`, `ORDRE`, `CREER_LE`, `MODIFIER_LE`, `MODE`) VALUES
(1, 1, 'N', 2500000, 2000000, 1, '15/05/2015, 15:20:02', NULL, 1),
(2, 1, 'N-1', 2500000, 1800000, 2, '15/05/2015, 15:20:02', NULL, 1),
(3, 1, 'N-2', 2500000, 2360000, 3, '15/05/2015, 15:20:02', NULL, 1),
(4, 2, '2016', 23456789, 1234567, 1, '16/08/16, 19:52:27', NULL, 1),
(5, 2, '2015', 24567890, 2345678, 2, '16/08/16, 19:52:27', NULL, 1),
(6, 2, '2014', 23455678, 2456778, 3, '16/08/16, 19:52:27', NULL, 1),
(7, 3, '2016', 2147483647, 6567647, 1, '16/08/16, 20:05:16', NULL, 1),
(8, 3, '2015', 2147483647, 57678776, 2, '16/08/16, 20:05:16', NULL, 1),
(9, 3, '2014', 2147483647, 67657657, 3, '16/08/16, 20:05:16', NULL, 1),
(10, 4, '2016', 2147483647, 5656577, 1, '17/08/16, 11:27:01', NULL, 1),
(11, 4, '2015', 2147483647, 4676766, 2, '17/08/16, 11:27:01', NULL, 1),
(12, 4, '2014', 2147483647, 77585787, 3, '17/08/16, 11:27:01', NULL, 1),
(13, 5, '2016', 2147483647, 454254242, 1, '17/08/16, 11:44:12', NULL, 1),
(14, 5, '2015', 2147483647, 42646446, 2, '17/08/16, 11:44:12', NULL, 1),
(15, 5, '2014', 2147483647, 46465653, 3, '17/08/16, 11:44:12', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_close_confidentialite`
--

CREATE TABLE `ha_close_confidentialite` (
  `ID_CLOSE` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `ID_AGRE` int(11) NOT NULL,
  `CODE_CL` text COLLATE utf8_unicode_ci NOT NULL,
  `LIBELLE` text COLLATE utf8_unicode_ci NOT NULL,
  `PIECE` text COLLATE utf8_unicode_ci,
  `ETAT` tinyint(1) NOT NULL,
  `DATE_CLAUSE` text COLLATE utf8_unicode_ci NOT NULL,
  `DATE_CHARGE` text COLLATE utf8_unicode_ci,
  `CREER_PAR` text COLLATE utf8_unicode_ci NOT NULL,
  `CREER_LE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODIFIER_PAR` text COLLATE utf8_unicode_ci,
  `MODIFIER_LE` text COLLATE utf8_unicode_ci,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_close_confidentialite`
--

INSERT INTO `ha_close_confidentialite` (`ID_CLOSE`, `ID_USER`, `ID_AGRE`, `CODE_CL`, `LIBELLE`, `PIECE`, `ETAT`, `DATE_CLAUSE`, `DATE_CHARGE`, `CREER_PAR`, `CREER_LE`, `MODIFIER_PAR`, `MODIFIER_LE`, `MODE`) VALUES
(1, 1, 3, 'CLS-2017N&deg;00001', 'Teste de confidentialit&eacute; N&deg; 1', 'cc3662b9dbddc5da401018d30e3b3f7f99607831.docx', 0, '31/07/2017', NULL, 'Junior MAMADOU', '06/05/2017, 18:17:27', 'Junior MAMADOU', '06/05/2017, 20:46:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_compte_charge`
--

CREATE TABLE `ha_compte_charge` (
  `ID_COMPTE_CHR` int(11) NOT NULL,
  `NUMERO` int(11) NOT NULL,
  `LIBELLE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_compte_charge`
--

INSERT INTO `ha_compte_charge` (`ID_COMPTE_CHR`, `NUMERO`, `LIBELLE`, `MODE`) VALUES
(1, 21, 'IMMOBILISATIONS INCORPORELLES', 1),
(2, 22, 'TERRAINS', 1),
(3, 23, 'B&Acirc;TIMENTS, INSTALLATIONS TECHNIQUES ET AGENCEMENTS', 1),
(4, 24, 'MAT&Eacute;RIEL', 1),
(5, 60, 'MATIERES PREMIERES', 1),
(6, 60, 'BIENS', 1),
(7, 60, 'MOYENS GENERAUX', 1),
(8, 61, 'TRANSPORTS', 1),
(9, 62, 'SERVICES EXTERIEURS A', 1),
(10, 63, 'SERVICES EXTERIEURS B', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_compte_fournisseur`
--

CREATE TABLE `ha_compte_fournisseur` (
  `ID_CMPT` int(11) NOT NULL,
  `ID_DOM_A` int(11) NOT NULL,
  `CODE_CANDIDAT` text COLLATE utf8_unicode_ci NOT NULL,
  `PASS` text COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL` text COLLATE utf8_unicode_ci NOT NULL,
  `DATE_INSC` text COLLATE utf8_unicode_ci NOT NULL,
  `CREER_LE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODIFIER_LE` text COLLATE utf8_unicode_ci,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_compte_fournisseur`
--

INSERT INTO `ha_compte_fournisseur` (`ID_CMPT`, `ID_DOM_A`, `CODE_CANDIDAT`, `PASS`, `EMAIL`, `DATE_INSC`, `CREER_LE`, `MODIFIER_LE`, `MODE`) VALUES
(1, 6, 'CAD-2016N&deg;00006', '8cc40021a9ab35e2361b20e8d7ec10e68c812125', 'tyer@gmail.com', '2016-04-25', '25/04/16, 19:47:12', NULL, 1),
(2, 6, 'CAD-2016N&deg;00002', '89542dbc01b14a672bd9be62f24802b18182583d', 'ouattaraamih@ivoirusbuyer.com', '2016-08-16', '16/08/16, 19:52:27', NULL, 1),
(3, 6, 'CAD-2016N&deg;00003', '89542dbc01b14a672bd9be62f24802b18182583d', 'moro.koffi@ivoirusbuyer.com', '2016-08-16', '16/08/16, 20:05:16', NULL, 1),
(4, 8, 'CAD-2016N&deg;00004', '89542dbc01b14a672bd9be62f24802b18182583d', 'franck.olivierkoua@ivoirusbuyer.com', '2016-08-17', '17/08/16, 11:27:01', NULL, 1),
(5, 8, 'CAD-2016N&deg;00005', '89542dbc01b14a672bd9be62f24802b18182583d', 'koua.olivier0@gmail.com', '2016-08-17', '17/08/16, 11:44:12', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_connecter`
--

CREATE TABLE `ha_connecter` (
  `ID_CTE` int(11) NOT NULL,
  `ID_EMG` int(11) NOT NULL,
  `IP` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `TIMESTAMP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_connecter`
--

INSERT INTO `ha_connecter` (`ID_CTE`, `ID_EMG`, `IP`, `TIMESTAMP`) VALUES
(1, 2, '127.0.0.1', 1506115421),
(2, 2, '160.120.19.2', 1556012628),
(3, 2, '160.120.173.105', 1556134240);

-- --------------------------------------------------------

--
-- Table structure for table `ha_contact_four`
--

CREATE TABLE `ha_contact_four` (
  `ID_CNT_FRS` int(11) NOT NULL,
  `ID_CMPT` int(11) NOT NULL,
  `TITRE` text COLLATE utf8_unicode_ci NOT NULL,
  `NOM` text COLLATE utf8_unicode_ci NOT NULL,
  `PRENOMS` text COLLATE utf8_unicode_ci NOT NULL,
  `TELEPHONE` text COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL` text COLLATE utf8_unicode_ci NOT NULL,
  `CREER_LE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODIFIER_LE` text COLLATE utf8_unicode_ci,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_contact_four`
--

INSERT INTO `ha_contact_four` (`ID_CNT_FRS`, `ID_CMPT`, `TITRE`, `NOM`, `PRENOMS`, `TELEPHONE`, `EMAIL`, `CREER_LE`, `MODIFIER_LE`, `MODE`) VALUES
(1, 1, 'Pr&eacute;sident', 'AKOSSI', 'ALBERT DESIRE', '56545645', 'akoss05@yahoo.fr', '15/05/2015, 15:20:02', NULL, 1),
(2, 1, 'Directeur G&eacute;n&eacute;ral', 'ZEH', 'IROU LOU BERNADETTE', '03568954', 'irou_bet@live.fr', '15/05/2015, 15:20:02', NULL, 1),
(3, 1, 'Directeur Commercial', 'LOPI', 'JOEL NATHAN', '47102569', 'jerca@gmail.com', '15/05/2015, 15:20:02', NULL, 1),
(4, 1, 'Personne &agrave; contacter pour le R&egrave;glement', 'GBONKE', 'CHICA TERNIM', '55826985', 'poliu_tren@live.ug', '15/05/2015, 15:20:02', NULL, 1),
(5, 2, 'Pr&eacute;sident', 'AZEAZERZAE', 'ZZEZEAZE', '13223123', 'azeze@dupont.com', '16/08/16, 19:52:27', NULL, 1),
(6, 2, 'Directeur G&eacute;n&eacute;ral', 'dfdsfdsfsdf', 'sdqsddsdq', '23433434', 'dfdf@dupont.com', '16/08/16, 19:52:27', NULL, 1),
(7, 2, 'Directeur Commercial', 'fdfqsdfqsdfq', 'qfdsqqdsqvf', '34568899', 'gfhghg@dupont.com', '16/08/16, 19:52:27', NULL, 1),
(8, 2, 'Personne &agrave; contacter pour le r&egrave;glement', 'qdfdsfsdfdsdf', 'azaeezaddqcd', '34343554', 'sddfd@dupont.com', '16/08/16, 19:52:27', NULL, 1),
(9, 3, 'Pr&eacute;sident', 'sdfddfddf', 'dfdfdgf', '23456788', 'ffgf@gks.com', '16/08/16, 20:05:16', NULL, 1),
(10, 3, 'Directeur G&eacute;n&eacute;ral', 'fbdbdfbfd', 'fgfrgf', '24567890', 'ggbg@gks.com', '16/08/16, 20:05:16', NULL, 1),
(11, 3, 'Directeur Commercial', 'gthygjhk', 'hhkghk', '89556578', 'cvvc@gks.com', '16/08/16, 20:05:16', NULL, 1),
(12, 3, 'Personne &agrave; contacter pour le r&egrave;glement', 'ghgjhjhjhjj', 'fgdghjghk', '79845676', 'lmk@gks.com', '16/08/16, 20:05:16', NULL, 1),
(13, 4, 'Pr&eacute;sident', 'GVBG', 'GTRHRJY', '23434545', 'ggh@gmail.com', '17/08/16, 11:27:01', NULL, 1),
(14, 4, 'Directeur G&eacute;n&eacute;ral', 'GFFJFHJH', 'FGFDGFHDHDG', '46565653', 'loik@gmail.com', '17/08/16, 11:27:01', NULL, 1),
(15, 4, 'Directeur Commercial', 'GHKHGJ', 'GFGFDGFGF', '44546567', 'kjnn@gmail.com', '17/08/16, 11:27:01', NULL, 1),
(16, 4, 'Personne &agrave; contacter pour le r&egrave;glement', 'THYGJFG', 'DFHGHJGHJFJ', '34545657', 'kiuj@gmail.com', '17/08/16, 11:27:01', NULL, 1),
(17, 5, 'Pr&eacute;sident', 'dfsdgfs', 'dghghj', '35265463', 'njko@speed.com', '17/08/16, 11:44:12', NULL, 1),
(18, 5, 'Directeur G&eacute;n&eacute;ral', 'hgfjhffg', 'tyere', '21435355', 'vfgfo@speed.com', '17/08/16, 11:44:12', NULL, 1),
(19, 5, 'Directeur Commercial', 'rggyiuooy', 'sddfgfgrety', '23354576', 'huio@speed.com', '17/08/16, 11:44:12', NULL, 1),
(20, 5, 'Personne &agrave; contacter pour le r&egrave;glement', 'fhtgyhtruyjd', 'ffghghgh', '56556467', 'kjhtyt@speed.com', '17/08/16, 11:44:12', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_contrat`
--

CREATE TABLE `ha_contrat` (
  `ID_CONTRAT` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `ID_AGRE` int(11) NOT NULL,
  `CODE` text COLLATE utf8_unicode_ci NOT NULL,
  `LIBELLE` text COLLATE utf8_unicode_ci NOT NULL,
  `PRIX` text COLLATE utf8_unicode_ci NOT NULL,
  `CONDITION_PAIE` text COLLATE utf8_unicode_ci NOT NULL,
  `DELAIS` int(11) NOT NULL,
  `DATE_DEBUT` text COLLATE utf8_unicode_ci NOT NULL,
  `DUREE` int(11) NOT NULL,
  `PIECE` text COLLATE utf8_unicode_ci,
  `ETAT` tinyint(1) DEFAULT NULL,
  `DATE_CHARGE` text COLLATE utf8_unicode_ci,
  `CONFIRMER` tinyint(1) DEFAULT NULL,
  `CREER_PAR` text COLLATE utf8_unicode_ci NOT NULL,
  `CREER_LE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODIFIER_PAR` text COLLATE utf8_unicode_ci,
  `MODIFIER_LE` text COLLATE utf8_unicode_ci,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_contrat`
--

INSERT INTO `ha_contrat` (`ID_CONTRAT`, `ID_USER`, `ID_AGRE`, `CODE`, `LIBELLE`, `PRIX`, `CONDITION_PAIE`, `DELAIS`, `DATE_DEBUT`, `DUREE`, `PIECE`, `ETAT`, `DATE_CHARGE`, `CONFIRMER`, `CREER_PAR`, `CREER_LE`, `MODIFIER_PAR`, `MODIFIER_LE`, `MODE`) VALUES
(1, 1, 4, 'CNT-2017N&deg;00001', 'Primi igitur omnium statuuntur', '__5.000.000 XOF', 'Unde Rufinus ea tempestate praefectus praetorio ad discrimen trusus est ultimum.', 15, '31/05/2020', 1080, 'debc65bcab75cbb4d7701e7f712031531e1aadb4.docx', 1, '09/05/2017, 13:13:15', 1, 'Junior MAMADOU', '09/05/2017, 13:13:15', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_demande_agrement`
--

CREATE TABLE `ha_demande_agrement` (
  `ID_AGR` int(11) NOT NULL,
  `ID_DOM_A` int(11) NOT NULL,
  `LIBELLE` text COLLATE utf8_unicode_ci NOT NULL,
  `DATE_C` text COLLATE utf8_unicode_ci,
  `TYPE` tinyint(1) NOT NULL,
  `PUBLIER` tinyint(1) NOT NULL,
  `CREER_PAR` text COLLATE utf8_unicode_ci NOT NULL,
  `CREER_LE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODIFIER_PAR` text COLLATE utf8_unicode_ci,
  `MODIFIER_LE` text COLLATE utf8_unicode_ci,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_demande_agrement`
--

INSERT INTO `ha_demande_agrement` (`ID_AGR`, `ID_DOM_A`, `LIBELLE`, `DATE_C`, `TYPE`, `PUBLIER`, `CREER_PAR`, `CREER_LE`, `MODIFIER_PAR`, `MODIFIER_LE`, `MODE`) VALUES
(1, 6, 'Teste agrement fournisseur 2017', 'Ouvert', 1, 1, 'Junior MAMADOU', '04/05/2017, 17:09:40', 'Junior MAMADOU', '04/05/2017, 17:10:02', 1),
(2, 6, 'bloeoeoeooe', '21/09/2018', 0, 1, 'Junior MAMADOU', '15/09/2018, 09:36:34', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_detail_article_cataloguer`
--

CREATE TABLE `ha_detail_article_cataloguer` (
  `ID_DET_ART` int(11) NOT NULL,
  `ID_ART_CAT` int(11) NOT NULL,
  `PRIX_BASE` int(11) NOT NULL,
  `PRIX_VENTE` int(11) NOT NULL,
  `UNITE` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `QTE_DISPO` int(11) NOT NULL,
  `INTERVAL_REMISE` text COLLATE utf8_unicode_ci NOT NULL,
  `REMISE` double DEFAULT NULL,
  `TVA` double NOT NULL,
  `DERNIER_PRIX` int(11) NOT NULL,
  `CARACTERISTIQUE` text COLLATE utf8_unicode_ci NOT NULL,
  `INFORMATION` text COLLATE utf8_unicode_ci NOT NULL,
  `CREER_LE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODIFIER_LE` text COLLATE utf8_unicode_ci,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_detail_article_cataloguer`
--

INSERT INTO `ha_detail_article_cataloguer` (`ID_DET_ART`, `ID_ART_CAT`, `PRIX_BASE`, `PRIX_VENTE`, `UNITE`, `QTE_DISPO`, `INTERVAL_REMISE`, `REMISE`, `TVA`, `DERNIER_PRIX`, `CARACTERISTIQUE`, `INFORMATION`, `CREER_LE`, `MODIFIER_LE`, `MODE`) VALUES
(1, 1, 150, 250, 'Kg', 1200, '>10kg', NULL, 0.18, 250, 'xwvwcvwxcvxw xw wxv xwv qs qs', 'fq zzfzafaz AZ FAZF AZF AZF d fgfd dfh dfsg dfsgsdfgdfs', '12/02/2013, 15:20:30', NULL, 1),
(2, 2, 150, 200, 'Kg', 1200, '>10kg', NULL, 0.18, 200, 'xwvwcvwxcvxw xw wxv xwv qs qs', 'fq zzfzafaz AZ FAZF AZF AZF d fgfd dfh dfsg dfsgsdfgdfs', '12/02/2013, 15:20:30', NULL, 1),
(3, 3, 1300, 2500, 'Kg', 100, '>150', NULL, 0.18, 2500, 'xsge gs g sgdgf sfg', 'fhs hs tt rturtu euuuu urt', '12/02/2013, 15:20:30', NULL, 1),
(4, 4, 15000, 15000, 'Kg', 1200, '>10', NULL, 0.18, 15000, 'xwvwcvwxcvxw xw wxv xwv qs qs', 'fq zzfzafaz AZ FAZF AZF AZF d fgfd dfh dfsg dfsgsdfgdfs', '12/02/2013, 15:20:30', NULL, 1),
(5, 5, 300, 800, 'Kg', 100, '>150', NULL, 0.18, 800, 'xsge gs g sgdgf sfg', 'fhs hs tt rturtu euuuu urt', '12/02/2013, 15:20:30', NULL, 1),
(6, 6, 850, 1000, 'Kg', 50, '>10', NULL, 0.18, 1000, 'xwvwcvwxcvxw xw wxv xwv qs qs', 'fq zzfzafaz AZ FAZF AZF AZF d fgfd dfh dfsg dfsgsdfgdfs', '12/02/2013, 15:20:30', NULL, 1),
(7, 7, 1500, 3000, 'Kg', 100, '>150', NULL, 0.18, 3000, 'xsge gs g sgdgf sfg', 'fhs hs tt rturtu euuuu urt', '12/02/2013, 15:20:30', NULL, 1),
(8, 8, 14500, 23000, 'Kg', 50, '>10', NULL, 0.18, 23000, 'xwvwcvwxcvxw xw wxv xwv qs qs', 'fq zzfzafaz AZ FAZF AZF AZF d fgfd dfh dfsg dfsgsdfgdfs', '12/02/2013, 15:20:30', NULL, 1),
(9, 9, 65000000, 75000000, 'Nbr', 25, '&gt;3', 0.1, 0.18, 5000000, 'lorem ino ghue juis rte der ', 'lorem ino ghue juis rte der za edroud djnf kdmpoiejdjd', '14/05/2016, 15:07:02', NULL, 1),
(10, 10, 200, 200, '9567', 34, '60 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(11, 11, 200, 200, '9567', 34, '61 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(12, 12, 200, 200, '9567', 34, '62 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(13, 13, 200, 200, '9567', 34, '63 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(14, 14, 200, 200, '9567', 34, '64 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(15, 15, 200, 200, '9567', 34, '65 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(16, 16, 200, 200, '9567', 34, '66 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(17, 17, 200, 200, '9567', 34, '67 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(18, 18, 200, 200, '9567', 34, '68 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(19, 19, 200, 200, '9567', 34, '69 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(20, 20, 200, 200, '9567', 34, '70 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(21, 21, 200, 200, '9567', 34, '71 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(22, 22, 200, 200, '9567', 34, '72 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(23, 23, 200, 200, '9567', 34, '73 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(24, 24, 200, 200, '9567', 34, '74 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(25, 25, 200, 200, '9567', 34, '75 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(26, 26, 200, 200, '9567', 34, '76 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(27, 27, 200, 200, '9567', 34, '77 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(28, 28, 200, 200, '9567', 34, '78 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(29, 29, 200, 200, '9567', 34, '79 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(30, 30, 200, 200, '9567', 34, '80 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(31, 31, 200, 200, '9567', 34, '81 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(32, 32, 200, 200, '9567', 34, '82 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(33, 33, 200, 200, '9567', 34, '83 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(34, 34, 200, 200, '9567', 34, '84 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(35, 35, 200, 200, '9567', 34, '85 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(36, 36, 200, 200, '9567', 34, '86 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(37, 37, 200, 200, '9567', 34, '87 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(38, 38, 200, 200, '9567', 34, '88 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(39, 39, 200, 200, '9567', 34, '89 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(40, 40, 200, 200, '9567', 34, '90 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(41, 41, 200, 200, '9567', 34, '91 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(42, 42, 200, 200, '9567', 34, '92 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(43, 43, 200, 200, '9567', 34, '93 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(44, 44, 200, 200, '9567', 34, '94 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(45, 45, 200, 200, '9567', 34, '95 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(46, 46, 200, 200, '9567', 34, '96 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(47, 47, 200, 200, '9567', 34, '97 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(48, 48, 200, 200, '9567', 34, '98 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(49, 49, 200, 200, '9567', 34, '99 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(50, 50, 200, 200, '9567', 34, '100 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(51, 51, 200, 200, '9567', 34, '101 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(52, 52, 200, 200, '9567', 34, '102 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(53, 53, 200, 200, '9567', 34, '103 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(54, 54, 200, 200, '9567', 34, '104 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(55, 55, 200, 200, '9567', 34, '105 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(56, 56, 200, 200, '9567', 34, '106 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(57, 57, 200, 200, '9567', 34, '107 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(58, 58, 200, 200, '9567', 34, '108 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(59, 59, 200, 200, '9567', 34, '109 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(60, 60, 200, 200, '9567', 34, '110 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(61, 61, 200, 200, '9567', 34, '111 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(62, 62, 200, 200, '9567', 34, '112 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(63, 63, 200, 200, '9567', 34, '113 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(64, 64, 200, 200, '9567', 34, '114 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(65, 65, 200, 200, '9567', 34, '115 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(66, 66, 200, 200, '9567', 34, '116 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(67, 67, 200, 200, '9567', 34, '117 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(68, 68, 200, 200, '9567', 34, '118 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(69, 69, 200, 200, '9567', 34, '119 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(70, 70, 200, 200, '9567', 34, '120 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(71, 71, 200, 200, '9567', 34, '121 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(72, 72, 200, 200, '9567', 34, '122 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(73, 73, 200, 200, '9567', 34, '123 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(74, 74, 200, 200, '9567', 34, '124 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(75, 75, 200, 200, '9567', 34, '125 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(76, 76, 200, 200, '9567', 34, '126 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(77, 77, 200, 200, '9567', 34, '127 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(78, 78, 200, 200, '9567', 34, '128 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(79, 79, 200, 200, '9567', 34, '129 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(80, 80, 200, 200, '9567', 34, '130 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(81, 81, 200, 200, '9567', 34, '131 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(82, 82, 200, 200, '9567', 34, '132 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(83, 83, 200, 200, '9567', 34, '133 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(84, 84, 200, 200, '9567', 34, '134 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(85, 85, 200, 200, '9567', 34, '135 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(86, 86, 200, 200, '9567', 34, '136 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(87, 87, 200, 200, '9567', 34, '137 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(88, 88, 200, 200, '9567', 34, '138 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(89, 89, 200, 200, '9567', 34, '139 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(90, 90, 200, 200, '9567', 34, '140 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(91, 91, 200, 200, '9567', 34, '141 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(92, 92, 200, 200, '9567', 34, '142 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(93, 93, 200, 200, '9567', 34, '143 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(94, 94, 200, 200, '9567', 34, '144 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(95, 95, 200, 200, '9567', 34, '145 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(96, 96, 200, 200, '9567', 34, '146 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(97, 97, 200, 200, '9567', 34, '147 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(98, 98, 200, 200, '9567', 34, '148 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(99, 99, 200, 200, '9567', 34, '149 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(100, 100, 200, 200, '9567', 34, '150 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(101, 101, 200, 200, '9567', 34, '151 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(102, 102, 200, 200, '9567', 34, '152 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(103, 103, 200, 200, '9567', 34, '153 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(104, 104, 200, 200, '9567', 34, '154 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(105, 105, 200, 200, '9567', 34, '155 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(106, 106, 200, 200, '9567', 34, '156 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(107, 107, 200, 200, '9567', 34, '157 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(108, 108, 200, 200, '9567', 34, '158 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(109, 109, 200, 200, '9567', 34, '159 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(110, 110, 200, 200, '9567', 34, '160 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(111, 111, 200, 200, '9567', 34, '161 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(112, 112, 200, 200, '9567', 34, '162 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(113, 113, 200, 200, '9567', 34, '163 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(114, 114, 200, 200, '9567', 34, '164 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(115, 115, 200, 200, '9567', 34, '165 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(116, 116, 200, 200, '9567', 34, '166 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(117, 117, 200, 200, '9567', 34, '167 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(118, 118, 200, 200, '9567', 34, '168 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(119, 119, 200, 200, '9567', 34, '169 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(120, 120, 200, 200, '9567', 34, '170 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(121, 121, 200, 200, '9567', 34, '171 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(122, 122, 200, 200, '9567', 34, '172 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(123, 123, 200, 200, '9567', 34, '173 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(124, 124, 200, 200, '9567', 34, '174 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(125, 125, 200, 200, '9567', 34, '175 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(126, 126, 200, 200, '9567', 34, '176 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(127, 127, 200, 200, '9567', 34, '177 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(128, 128, 200, 200, '9567', 34, '178 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(129, 129, 200, 200, '9567', 34, '179 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(130, 130, 200, 200, '9567', 34, '180 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(131, 131, 200, 200, '9567', 34, '181 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(132, 132, 200, 200, '9567', 34, '182 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(133, 133, 200, 200, '9567', 34, '183 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(134, 134, 200, 200, '9567', 34, '184 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(135, 135, 200, 200, '9567', 34, '185 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(136, 136, 200, 200, '9567', 34, '186 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(137, 137, 200, 200, '9567', 34, '187 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(138, 138, 200, 200, '9567', 34, '188 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(139, 139, 200, 200, '9567', 34, '189 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(140, 140, 200, 200, '9567', 34, '190 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(141, 141, 200, 200, '9567', 34, '191 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(142, 142, 200, 200, '9567', 34, '192 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(143, 143, 200, 200, '9567', 34, '193 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(144, 144, 200, 200, '9567', 34, '194 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(145, 145, 200, 200, '9567', 34, '195 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(146, 146, 200, 200, '9567', 34, '196 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(147, 147, 200, 200, '9567', 34, '197 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(148, 148, 200, 200, '9567', 34, '198 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(149, 149, 200, 200, '9567', 34, '199 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(150, 150, 200, 200, '9567', 34, '200 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(151, 151, 200, 200, '9567', 34, '201 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(152, 152, 200, 200, '9567', 34, '202 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(153, 153, 200, 200, '9567', 34, '203 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(154, 154, 200, 200, '9567', 34, '204 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(155, 155, 200, 200, '9567', 34, '205 JOURS', 0.2, 0.18, 150, 'DGFGFGHFDHGDH', 'CFBFDBFDBFDB', '20/07/2016, 15:22:54', NULL, 1),
(156, 0, 9750, 9750, '1', 15, '1 &agrave; 2 %', 0.02, 0.18, 9750, 'S-BICC0720N', 'Lot de 20 stylos bille BIC Cristal Clic 0,7 mm noir', '28/07/2016, 16:30:43', NULL, 1),
(157, 0, 6500, 6500, '1', 10, '1 &agrave; 2 %', 0.02, 0.18, 6500, 'S-BICC0720B', 'Lot de 20 stylos bille BIC Cristal Clic 0,7 mm bleu', '28/07/2016, 16:30:43', NULL, 1),
(158, 0, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'S-BICC0720R', 'Lot de 20 stylos bille BIC Cristal Clic 0,7 mm rouge', '28/07/2016, 16:30:43', NULL, 1),
(159, 0, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'S-BICC0720V', 'Lot de 20 stylos bille BIC Cristal Clic 0,7 mm vert', '28/07/2016, 16:30:43', NULL, 1),
(160, 0, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'S-BICC0720B', 'Lot de 20 stylos bille BIC Cristal Grip 0,7 mm bleu', '28/07/2016, 16:30:43', NULL, 1),
(161, 0, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'S-BICC0720N', 'Lot de 20 stylos bille BIC Cristal Grip 0,7 mm noir', '28/07/2016, 16:30:43', NULL, 1),
(162, 0, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'S-BICC0720V', 'Lot de 20 stylos bille BIC Cristal Grip 0,7 mm vert', '28/07/2016, 16:30:43', NULL, 1),
(163, 0, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'S-BICC0720R', 'Lot de 20 stylos bille BIC Cristal Grip 0,7 mm rouge', '28/07/2016, 16:30:43', NULL, 1),
(164, 0, 650, 650, '1', 1, '1 &agrave; 2 %', 0.02, 0.18, 650, 'S-BICC1050N', 'Lot de 50 stylos BIC M10 noir clic', '28/07/2016, 16:30:43', NULL, 1),
(165, 0, 11050, 11050, '1', 17, '1 &agrave; 2 %', 0.02, 0.18, 11050, 'S-PILB0702N', 'Lot de 2 stylos-bille PILOT B2P 0,7 mm noir', '28/07/2016, 16:30:43', NULL, 1),
(166, 0, 1950, 1950, '1', 3, '1 &agrave; 2 %', 0.02, 0.18, 1950, 'S-PILA0702V', 'Lot de 2 stylos-bille PILOT ALPHAGEL r&eacute;tractables 0,7 mm violet', '28/07/2016, 16:30:43', NULL, 1),
(167, 0, 7800, 7800, '1', 12, '1 &agrave; 2 %', 0.02, 0.18, 7800, 'S-PILA0702N', 'Lot de 2 stylos-bille PILOT ALPHAGEL r&eacute;tractables 0,7 mm noir', '28/07/2016, 16:30:43', NULL, 1),
(168, 0, 1950, 1950, '1', 3, '1 &agrave; 2 %', 0.02, 0.18, 1950, 'S-JETS0000I', 'Stylo-bille encre gel JetStream Premier', '28/07/2016, 16:30:43', NULL, 1),
(169, 0, 5200, 5200, '1', 8, '1 &agrave; 2 %', 0.02, 0.18, 5200, 'S-PENE0702N', 'Lot de 2 stylos-bille PENTEL Energel XM BL r&eacute;tractables 0,7 mm noir', '28/07/2016, 16:30:43', NULL, 1),
(170, 0, 16250, 16250, '1', 25, '1 &agrave; 2 %', 0.02, 0.18, 16250, 'S-STAG0702N', 'Lot de 2 stylos-bille STAPLES Gel r&eacute;tractables 0,7mm noir', '28/07/2016, 16:30:43', NULL, 1),
(171, 0, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'S-PILV0002N', 'Lot de 2 stylos plume Pilot V Pen noir non rechargeables', '28/07/2016, 16:30:43', NULL, 1),
(172, 0, 13000, 13000, '1', 20, '1 &agrave; 2 %', 0.02, 0.18, 13000, 'M-BICVPB02N', 'Lot de 2 marqueurs BIC VELLEDA M&eacute;tal Pointe Biseau noir', '28/07/2016, 16:30:43', NULL, 1),
(173, 0, 6500, 6500, '1', 10, '1 &agrave; 2 %', 0.02, 0.18, 6500, 'M-BICVPB02R', 'Lot de 2 marqueurs BIC VELLEDA M&eacute;tal Pointe Biseau rouge', '28/07/2016, 16:30:43', NULL, 1),
(174, 0, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'M-BICVPB02V', 'Lot de 2 marqueurs BIC VELLEDA M&eacute;tal Pointe Biseau vert', '28/07/2016, 16:30:43', NULL, 1),
(175, 0, 9750, 9750, '1', 15, '1 &agrave; 2 %', 0.02, 0.18, 9750, 'M-BICVPB02B', 'Lot de 2 marqueurs BIC VELLEDA M&eacute;tal Pointe Biseau bleu', '28/07/2016, 16:30:43', NULL, 1),
(176, 0, 2600, 2600, '1', 4, '1 &agrave; 2 %', 0.02, 0.18, 2600, 'M-BICD0004I', 'Pochette de 4 marqueurs BIC pour CD/DVD', '28/07/2016, 16:30:43', NULL, 1),
(177, 0, 19500, 19500, '1', 30, '1 &agrave; 2 %', 0.02, 0.18, 19500, 'M-FLUO0002I', 'Pochette de 2 marqueurs FLUO', '28/07/2016, 16:30:43', NULL, 1),
(178, 0, 32500, 32500, '1', 50, '1 &agrave; 2 %', 0.02, 0.18, 32500, 'C-OXF18005S', 'Lot 5 cahiers spirales 180 pages 5 x 5 90g/m2 Oxford couverture poly-propyl&egrave;ne 21 x 29,7 cm', '28/07/2016, 16:30:43', NULL, 1),
(179, 0, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'C-OXF19210B', 'Lot 10 cahiers broch&eacute;s 192 pages 5 x 5 Oxford Office 90g/m2 21 x 29,7 cm', '28/07/2016, 16:30:43', NULL, 1),
(180, 0, 14950, 14950, '1', 23, '1 &agrave; 2 %', 0.02, 0.18, 14950, 'C-CON09610P', 'Lot  10  cahiers  piqu&eacute;s  96  pages 5 x 5 Conqu&eacute;rant Sept 70g/m&sup2;  21 x 29,7 cm', '28/07/2016, 16:30:43', NULL, 1),
(181, 0, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'C-CLA10010S', 'Lot 10 cahiers spirales 100 pages 5 x 5 Clairefontaine Forever calligraphe recycl&eacute; 21 x 29,7 cm', '28/07/2016, 16:30:43', NULL, 1),
(182, 0, 4550, 4550, '1', 7, '1 &agrave; 2 %', 0.02, 0.18, 4550, 'C-CLA09605P', 'Lot 5 cahiers piqu&eacute;s 96 pages 5 x 5 Clairefontaine 17 x 22 cm 90g/m2', '28/07/2016, 16:30:43', NULL, 1),
(183, 0, 9750, 9750, '1', 15, '1 &agrave; 2 %', 0.02, 0.18, 9750, 'B-STA00000I', 'Bloc m&eacute;mo Staples', '28/07/2016, 16:30:43', NULL, 1),
(184, 0, 71500, 71500, '1', 110, '1 &agrave; 2 %', 0.02, 0.18, 71500, 'B-BUD00000I', 'Bloc de bureau BUDGET avec couverture 14,8 x 21 cm &ndash; 5 x 5', '28/07/2016, 16:30:43', NULL, 1),
(185, 0, 6500, 6500, '1', 10, '1 &agrave; 2 %', 0.02, 0.18, 6500, 'P-STAP00100L', 'Bo&icirc;te de 100 planches d&rsquo;&eacute;tiquettes LASER Staples 10,5 x 7,2 mm', '28/07/2016, 16:30:43', NULL, 1),
(186, 0, 15600, 15600, '1', 24, '1 &agrave; 2 %', 0.02, 0.18, 15600, 'D-DIST00012C', 'Distributeur 4 x 35 Index Post-it&reg; L.12 mm assortis classique', '28/07/2016, 16:30:43', NULL, 1),
(187, 0, 4550, 4550, '1', 7, '1 &agrave; 2 %', 0.02, 0.18, 4550, 'D-DIST00025R', 'Distributeur 50 index Post it L. 25 mm rouge', '28/07/2016, 16:30:43', NULL, 1),
(188, 0, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'K-KRAF00025V', 'Lot de 25 dossiers suspendus kraft pour armoires &eacute;quip&eacute;es de rails tu-bulaires fond &laquo;V&raquo;', '28/07/2016, 16:30:43', NULL, 1),
(189, 0, 6500, 6500, '1', 10, '1 &agrave; 2 %', 0.02, 0.18, 6500, 'O-CORB00000S', 'Corbeille &agrave; papier tri s&eacute;lectif', '28/07/2016, 16:30:43', NULL, 1),
(190, 0, 15600, 15600, '1', 24, '1 &agrave; 2 %', 0.02, 0.18, 15600, 'O-CORB00015B', 'Corbeille &agrave; papier 15 L. bleu', '28/07/2016, 16:30:43', NULL, 1),
(191, 0, 5850, 5850, '1', 9, '1 &agrave; 2 %', 0.02, 0.18, 5850, 'L-BACC00706N', 'Lot de 6 bacs &agrave; courrier &laquo;12-65&raquo; standard &ndash; H. 7 cm - Coloris : Noir.', '28/07/2016, 16:30:43', NULL, 1),
(192, 0, 65000, 65000, '1', 100, '1 &agrave; 2 %', 0.02, 0.18, 65000, 'R-CLAI09005I', 'Lot de 5 ramettes papier Clairalfa A4 &ndash; 90g/m&sup2;', '28/07/2016, 16:30:43', NULL, 1),
(193, 0, 1300, 1300, '1', 2, '1 &agrave; 2 %', 0.02, 0.18, 1300, 'F-CLAI25080I', 'Pack 2500 feuilles papier Clairalfa A4 &ndash; 80g/m&sup2;', '28/07/2016, 16:30:43', NULL, 1),
(194, 0, 19500, 19500, '1', 30, '1 &agrave; 2 %', 0.02, 0.18, 19500, 'A-RUBA00008I', 'Lot de 8 rubans adh&eacute;sifs invisibles', '28/07/2016, 16:30:43', NULL, 1),
(195, 0, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'A-RUBA06606I', 'Lot 6 rubans adh&eacute;sifs PVC havane L. 66 m.', '28/07/2016, 16:30:43', NULL, 1),
(196, 0, 6500, 6500, '1', 10, '1 &agrave; 2 %', 0.02, 0.18, 6500, 'A-STAD03000I', 'R&egrave;gle gradu&eacute;e 30 cm STAEDTLER plexiglas', '28/07/2016, 16:30:43', NULL, 1),
(197, 0, 6500, 6500, '1', 10, '1 &agrave; 2 %', 0.02, 0.18, 6500, 'P-QUIL10025I', 'Bo&icirc;te de 1000 trombones QUILL L. 25 mm', '28/07/2016, 16:30:43', NULL, 1),
(198, 0, 9750, 9750, '1', 15, '1 &agrave; 2 %', 0.02, 0.18, 9750, 'P-QUIL01232I', 'Bo&icirc;te  de 12 pinces-clips QUILL L.32 mm', '28/07/2016, 16:30:43', NULL, 1),
(199, 0, 9750, 9750, '1', 15, '1 &agrave; 2 %', 0.02, 0.18, 9750, 'P-QUIL01241I', 'Bo&icirc;te  de 12 pinces-clips QUILL L.41 mm', '28/07/2016, 16:30:43', NULL, 1),
(200, 0, 9750, 9750, '1', 15, '1 &agrave; 2 %', 0.02, 0.18, 9750, 'P-QUIL01225I', 'Bo&icirc;te  de 12 pinces-clips QUILL L.25 mm', '28/07/2016, 16:30:43', NULL, 1),
(201, 0, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'P-STAP00000I', 'Ciseaux STAPLES coupe-tout', '28/07/2016, 16:30:43', NULL, 1),
(202, 0, 9750, 9750, '1', 15, '1 &agrave; 2 %', 0.02, 0.18, 9750, 'S-BICC0720N', 'Lot de 20 stylos bille BIC Cristal Clic 0,7 mm noir', '28/07/2016, 16:53:50', NULL, 1),
(203, 0, 6500, 6500, '1', 10, '1 &agrave; 2 %', 0.02, 0.18, 6500, 'S-BICC0720B', 'Lot de 20 stylos bille BIC Cristal Clic 0,7 mm bleu', '28/07/2016, 16:53:50', NULL, 1),
(204, 0, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'S-BICC0720R', 'Lot de 20 stylos bille BIC Cristal Clic 0,7 mm rouge', '28/07/2016, 16:53:50', NULL, 1),
(205, 0, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'S-BICC0720V', 'Lot de 20 stylos bille BIC Cristal Clic 0,7 mm vert', '28/07/2016, 16:53:50', NULL, 1),
(206, 0, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'S-BICC0720B', 'Lot de 20 stylos bille BIC Cristal Grip 0,7 mm bleu', '28/07/2016, 16:53:50', NULL, 1),
(207, 0, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'S-BICC0720N', 'Lot de 20 stylos bille BIC Cristal Grip 0,7 mm noir', '28/07/2016, 16:53:50', NULL, 1),
(208, 0, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'S-BICC0720V', 'Lot de 20 stylos bille BIC Cristal Grip 0,7 mm vert', '28/07/2016, 16:53:50', NULL, 1),
(209, 0, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'S-BICC0720R', 'Lot de 20 stylos bille BIC Cristal Grip 0,7 mm rouge', '28/07/2016, 16:53:50', NULL, 1),
(210, 0, 650, 650, '1', 1, '1 &agrave; 2 %', 0.02, 0.18, 650, 'S-BICC1050N', 'Lot de 50 stylos BIC M10 noir clic', '28/07/2016, 16:53:50', NULL, 1),
(211, 0, 11050, 11050, '1', 17, '1 &agrave; 2 %', 0.02, 0.18, 11050, 'S-PILB0702N', 'Lot de 2 stylos-bille PILOT B2P 0,7 mm noir', '28/07/2016, 16:53:50', NULL, 1),
(212, 0, 1950, 1950, '1', 3, '1 &agrave; 2 %', 0.02, 0.18, 1950, 'S-PILA0702V', 'Lot de 2 stylos-bille PILOT ALPHAGEL r&eacute;tractables 0,7 mm violet', '28/07/2016, 16:53:50', NULL, 1),
(213, 0, 7800, 7800, '1', 12, '1 &agrave; 2 %', 0.02, 0.18, 7800, 'S-PILA0702N', 'Lot de 2 stylos-bille PILOT ALPHAGEL r&eacute;tractables 0,7 mm noir', '28/07/2016, 16:53:50', NULL, 1),
(214, 0, 1950, 1950, '1', 3, '1 &agrave; 2 %', 0.02, 0.18, 1950, 'S-JETS0000I', 'Stylo-bille encre gel JetStream Premier', '28/07/2016, 16:53:50', NULL, 1),
(215, 0, 5200, 5200, '1', 8, '1 &agrave; 2 %', 0.02, 0.18, 5200, 'S-PENE0702N', 'Lot de 2 stylos-bille PENTEL Energel XM BL r&eacute;tractables 0,7 mm noir', '28/07/2016, 16:53:50', NULL, 1),
(216, 0, 16250, 16250, '1', 25, '1 &agrave; 2 %', 0.02, 0.18, 16250, 'S-STAG0702N', 'Lot de 2 stylos-bille STAPLES Gel r&eacute;tractables 0,7mm noir', '28/07/2016, 16:53:50', NULL, 1),
(217, 0, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'S-PILV0002N', 'Lot de 2 stylos plume Pilot V Pen noir non rechargeables', '28/07/2016, 16:53:50', NULL, 1),
(218, 0, 13000, 13000, '1', 20, '1 &agrave; 2 %', 0.02, 0.18, 13000, 'M-BICVPB02N', 'Lot de 2 marqueurs BIC VELLEDA M&eacute;tal Pointe Biseau noir', '28/07/2016, 16:53:50', NULL, 1),
(219, 0, 6500, 6500, '1', 10, '1 &agrave; 2 %', 0.02, 0.18, 6500, 'M-BICVPB02R', 'Lot de 2 marqueurs BIC VELLEDA M&eacute;tal Pointe Biseau rouge', '28/07/2016, 16:53:50', NULL, 1),
(220, 0, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'M-BICVPB02V', 'Lot de 2 marqueurs BIC VELLEDA M&eacute;tal Pointe Biseau vert', '28/07/2016, 16:53:50', NULL, 1),
(221, 0, 9750, 9750, '1', 15, '1 &agrave; 2 %', 0.02, 0.18, 9750, 'M-BICVPB02B', 'Lot de 2 marqueurs BIC VELLEDA M&eacute;tal Pointe Biseau bleu', '28/07/2016, 16:53:50', NULL, 1),
(222, 0, 2600, 2600, '1', 4, '1 &agrave; 2 %', 0.02, 0.18, 2600, 'M-BICD0004I', 'Pochette de 4 marqueurs BIC pour CD/DVD', '28/07/2016, 16:53:50', NULL, 1),
(223, 0, 19500, 19500, '1', 30, '1 &agrave; 2 %', 0.02, 0.18, 19500, 'M-FLUO0002I', 'Pochette de 2 marqueurs FLUO', '28/07/2016, 16:53:50', NULL, 1),
(224, 0, 32500, 32500, '1', 50, '1 &agrave; 2 %', 0.02, 0.18, 32500, 'C-OXF18005S', 'Lot 5 cahiers spirales 180 pages 5 x 5 90g/m2 Oxford couverture poly-propyl&egrave;ne 21 x 29,7 cm', '28/07/2016, 16:53:50', NULL, 1),
(225, 0, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'C-OXF19210B', 'Lot 10 cahiers broch&eacute;s 192 pages 5 x 5 Oxford Office 90g/m2 21 x 29,7 cm', '28/07/2016, 16:53:50', NULL, 1),
(226, 0, 14950, 14950, '1', 23, '1 &agrave; 2 %', 0.02, 0.18, 14950, 'C-CON09610P', 'Lot  10  cahiers  piqu&eacute;s  96  pages 5 x 5 Conqu&eacute;rant Sept 70g/m&sup2;  21 x 29,7 cm', '28/07/2016, 16:53:50', NULL, 1),
(227, 0, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'C-CLA10010S', 'Lot 10 cahiers spirales 100 pages 5 x 5 Clairefontaine Forever calligraphe recycl&eacute; 21 x 29,7 cm', '28/07/2016, 16:53:50', NULL, 1),
(228, 0, 4550, 4550, '1', 7, '1 &agrave; 2 %', 0.02, 0.18, 4550, 'C-CLA09605P', 'Lot 5 cahiers piqu&eacute;s 96 pages 5 x 5 Clairefontaine 17 x 22 cm 90g/m2', '28/07/2016, 16:53:50', NULL, 1),
(229, 0, 9750, 9750, '1', 15, '1 &agrave; 2 %', 0.02, 0.18, 9750, 'B-STA00000I', 'Bloc m&eacute;mo Staples', '28/07/2016, 16:53:50', NULL, 1),
(230, 0, 71500, 71500, '1', 110, '1 &agrave; 2 %', 0.02, 0.18, 71500, 'B-BUD00000I', 'Bloc de bureau BUDGET avec couverture 14,8 x 21 cm &ndash; 5 x 5', '28/07/2016, 16:53:50', NULL, 1),
(231, 0, 6500, 6500, '1', 10, '1 &agrave; 2 %', 0.02, 0.18, 6500, 'P-STAP00100L', 'Bo&icirc;te de 100 planches d&rsquo;&eacute;tiquettes LASER Staples 10,5 x 7,2 mm', '28/07/2016, 16:53:50', NULL, 1),
(232, 0, 15600, 15600, '1', 24, '1 &agrave; 2 %', 0.02, 0.18, 15600, 'D-DIST00012C', 'Distributeur 4 x 35 Index Post-it&reg; L.12 mm assortis classique', '28/07/2016, 16:53:50', NULL, 1),
(233, 0, 4550, 4550, '1', 7, '1 &agrave; 2 %', 0.02, 0.18, 4550, 'D-DIST00025R', 'Distributeur 50 index Post it L. 25 mm rouge', '28/07/2016, 16:53:50', NULL, 1),
(234, 0, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'K-KRAF00025V', 'Lot de 25 dossiers suspendus kraft pour armoires &eacute;quip&eacute;es de rails tu-bulaires fond &laquo;V&raquo;', '28/07/2016, 16:53:50', NULL, 1),
(235, 0, 6500, 6500, '1', 10, '1 &agrave; 2 %', 0.02, 0.18, 6500, 'O-CORB00000S', 'Corbeille &agrave; papier tri s&eacute;lectif', '28/07/2016, 16:53:50', NULL, 1),
(236, 0, 15600, 15600, '1', 24, '1 &agrave; 2 %', 0.02, 0.18, 15600, 'O-CORB00015B', 'Corbeille &agrave; papier 15 L. bleu', '28/07/2016, 16:53:50', NULL, 1),
(237, 0, 5850, 5850, '1', 9, '1 &agrave; 2 %', 0.02, 0.18, 5850, 'L-BACC00706N', 'Lot de 6 bacs &agrave; courrier &laquo;12-65&raquo; standard &ndash; H. 7 cm - Coloris : Noir.', '28/07/2016, 16:53:50', NULL, 1),
(238, 0, 65000, 65000, '1', 100, '1 &agrave; 2 %', 0.02, 0.18, 65000, 'R-CLAI09005I', 'Lot de 5 ramettes papier Clairalfa A4 &ndash; 90g/m&sup2;', '28/07/2016, 16:53:50', NULL, 1),
(239, 0, 1300, 1300, '1', 2, '1 &agrave; 2 %', 0.02, 0.18, 1300, 'F-CLAI25080I', 'Pack 2500 feuilles papier Clairalfa A4 &ndash; 80g/m&sup2;', '28/07/2016, 16:53:50', NULL, 1),
(240, 0, 19500, 19500, '1', 30, '1 &agrave; 2 %', 0.02, 0.18, 19500, 'A-RUBA00008I', 'Lot de 8 rubans adh&eacute;sifs invisibles', '28/07/2016, 16:53:50', NULL, 1),
(241, 0, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'A-RUBA06606I', 'Lot 6 rubans adh&eacute;sifs PVC havane L. 66 m.', '28/07/2016, 16:53:50', NULL, 1),
(242, 0, 6500, 6500, '1', 10, '1 &agrave; 2 %', 0.02, 0.18, 6500, 'A-STAD03000I', 'R&egrave;gle gradu&eacute;e 30 cm STAEDTLER plexiglas', '28/07/2016, 16:53:50', NULL, 1),
(243, 0, 6500, 6500, '1', 10, '1 &agrave; 2 %', 0.02, 0.18, 6500, 'P-QUIL10025I', 'Bo&icirc;te de 1000 trombones QUILL L. 25 mm', '28/07/2016, 16:53:50', NULL, 1),
(244, 0, 9750, 9750, '1', 15, '1 &agrave; 2 %', 0.02, 0.18, 9750, 'P-QUIL01232I', 'Bo&icirc;te  de 12 pinces-clips QUILL L.32 mm', '28/07/2016, 16:53:50', NULL, 1),
(245, 0, 9750, 9750, '1', 15, '1 &agrave; 2 %', 0.02, 0.18, 9750, 'P-QUIL01241I', 'Bo&icirc;te  de 12 pinces-clips QUILL L.41 mm', '28/07/2016, 16:53:50', NULL, 1),
(246, 0, 9750, 9750, '1', 15, '1 &agrave; 2 %', 0.02, 0.18, 9750, 'P-QUIL01225I', 'Bo&icirc;te  de 12 pinces-clips QUILL L.25 mm', '28/07/2016, 16:53:50', NULL, 1),
(247, 0, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'P-STAP00000I', 'Ciseaux STAPLES coupe-tout', '28/07/2016, 16:53:50', NULL, 1),
(248, 156, 9750, 9750, '1', 15, '1 &agrave; 2 %', 0.02, 0.18, 9750, 'S-BICC0720N', 'Lot de 20 stylos bille BIC Cristal Clic 0,7 mm noir', '28/07/2016, 16:58:08', NULL, 1),
(249, 157, 6500, 6500, '1', 10, '1 &agrave; 2 %', 0.02, 0.18, 6500, 'S-BICC0720B', 'Lot de 20 stylos bille BIC Cristal Clic 0,7 mm bleu', '28/07/2016, 16:58:08', NULL, 1),
(250, 158, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'S-BICC0720R', 'Lot de 20 stylos bille BIC Cristal Clic 0,7 mm rouge', '28/07/2016, 16:58:08', NULL, 1),
(251, 159, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'S-BICC0720V', 'Lot de 20 stylos bille BIC Cristal Clic 0,7 mm vert', '28/07/2016, 16:58:08', NULL, 1),
(252, 160, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'S-BICC0720B', 'Lot de 20 stylos bille BIC Cristal Grip 0,7 mm bleu', '28/07/2016, 16:58:08', NULL, 1),
(253, 161, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'S-BICC0720N', 'Lot de 20 stylos bille BIC Cristal Grip 0,7 mm noir', '28/07/2016, 16:58:08', NULL, 1),
(254, 162, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'S-BICC0720V', 'Lot de 20 stylos bille BIC Cristal Grip 0,7 mm vert', '28/07/2016, 16:58:08', NULL, 1),
(255, 163, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'S-BICC0720R', 'Lot de 20 stylos bille BIC Cristal Grip 0,7 mm rouge', '28/07/2016, 16:58:08', NULL, 1),
(256, 164, 650, 650, '1', 1, '1 &agrave; 2 %', 0.02, 0.18, 650, 'S-BICC1050N', 'Lot de 50 stylos BIC M10 noir clic', '28/07/2016, 16:58:08', NULL, 1),
(257, 165, 11050, 11050, '1', 17, '1 &agrave; 2 %', 0.02, 0.18, 11050, 'S-PILB0702N', 'Lot de 2 stylos-bille PILOT B2P 0,7 mm noir', '28/07/2016, 16:58:08', NULL, 1),
(258, 166, 1950, 1950, '1', 3, '1 &agrave; 2 %', 0.02, 0.18, 1950, 'S-PILA0702V', 'Lot de 2 stylos-bille PILOT ALPHAGEL r&eacute;tractables 0,7 mm violet', '28/07/2016, 16:58:08', NULL, 1),
(259, 167, 7800, 7800, '1', 12, '1 &agrave; 2 %', 0.02, 0.18, 7800, 'S-PILA0702N', 'Lot de 2 stylos-bille PILOT ALPHAGEL r&eacute;tractables 0,7 mm noir', '28/07/2016, 16:58:08', NULL, 1),
(260, 168, 1950, 1950, '1', 3, '1 &agrave; 2 %', 0.02, 0.18, 1950, 'S-JETS0000I', 'Stylo-bille encre gel JetStream Premier', '28/07/2016, 16:58:08', NULL, 1),
(261, 169, 5200, 5200, '1', 8, '1 &agrave; 2 %', 0.02, 0.18, 5200, 'S-PENE0702N', 'Lot de 2 stylos-bille PENTEL Energel XM BL r&eacute;tractables 0,7 mm noir', '28/07/2016, 16:58:08', NULL, 1),
(262, 170, 16250, 16250, '1', 25, '1 &agrave; 2 %', 0.02, 0.18, 16250, 'S-STAG0702N', 'Lot de 2 stylos-bille STAPLES Gel r&eacute;tractables 0,7mm noir', '28/07/2016, 16:58:08', NULL, 1),
(263, 171, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'S-PILV0002N', 'Lot de 2 stylos plume Pilot V Pen noir non rechargeables', '28/07/2016, 16:58:08', NULL, 1),
(264, 172, 13000, 13000, '1', 20, '1 &agrave; 2 %', 0.02, 0.18, 13000, 'M-BICVPB02N', 'Lot de 2 marqueurs BIC VELLEDA M&eacute;tal Pointe Biseau noir', '28/07/2016, 16:58:08', NULL, 1),
(265, 173, 6500, 6500, '1', 10, '1 &agrave; 2 %', 0.02, 0.18, 6500, 'M-BICVPB02R', 'Lot de 2 marqueurs BIC VELLEDA M&eacute;tal Pointe Biseau rouge', '28/07/2016, 16:58:08', NULL, 1),
(266, 174, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'M-BICVPB02V', 'Lot de 2 marqueurs BIC VELLEDA M&eacute;tal Pointe Biseau vert', '28/07/2016, 16:58:08', NULL, 1),
(267, 175, 9750, 9750, '1', 15, '1 &agrave; 2 %', 0.02, 0.18, 9750, 'M-BICVPB02B', 'Lot de 2 marqueurs BIC VELLEDA M&eacute;tal Pointe Biseau bleu', '28/07/2016, 16:58:08', NULL, 1),
(268, 176, 2600, 2600, '1', 4, '1 &agrave; 2 %', 0.02, 0.18, 2600, 'M-BICD0004I', 'Pochette de 4 marqueurs BIC pour CD/DVD', '28/07/2016, 16:58:08', NULL, 1),
(269, 177, 19500, 19500, '1', 30, '1 &agrave; 2 %', 0.02, 0.18, 19500, 'M-FLUO0002I', 'Pochette de 2 marqueurs FLUO', '28/07/2016, 16:58:08', NULL, 1),
(270, 178, 32500, 32500, '1', 50, '1 &agrave; 2 %', 0.02, 0.18, 32500, 'C-OXF18005S', 'Lot 5 cahiers spirales 180 pages 5 x 5 90g/m2 Oxford couverture poly-propyl&egrave;ne 21 x 29,7 cm', '28/07/2016, 16:58:08', NULL, 1),
(271, 179, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'C-OXF19210B', 'Lot 10 cahiers broch&eacute;s 192 pages 5 x 5 Oxford Office 90g/m2 21 x 29,7 cm', '28/07/2016, 16:58:08', NULL, 1),
(272, 180, 14950, 14950, '1', 23, '1 &agrave; 2 %', 0.02, 0.18, 14950, 'C-CON09610P', 'Lot  10  cahiers  piqu&eacute;s  96  pages 5 x 5 Conqu&eacute;rant Sept 70g/m&sup2;  21 x 29,7 cm', '28/07/2016, 16:58:08', NULL, 1),
(273, 181, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'C-CLA10010S', 'Lot 10 cahiers spirales 100 pages 5 x 5 Clairefontaine Forever calligraphe recycl&eacute; 21 x 29,7 cm', '28/07/2016, 16:58:08', NULL, 1),
(274, 182, 4550, 4550, '1', 7, '1 &agrave; 2 %', 0.02, 0.18, 4550, 'C-CLA09605P', 'Lot 5 cahiers piqu&eacute;s 96 pages 5 x 5 Clairefontaine 17 x 22 cm 90g/m2', '28/07/2016, 16:58:08', NULL, 1),
(275, 183, 9750, 9750, '1', 15, '1 &agrave; 2 %', 0.02, 0.18, 9750, 'B-STA00000I', 'Bloc m&eacute;mo Staples', '28/07/2016, 16:58:08', NULL, 1),
(276, 184, 71500, 71500, '1', 110, '1 &agrave; 2 %', 0.02, 0.18, 71500, 'B-BUD00000I', 'Bloc de bureau BUDGET avec couverture 14,8 x 21 cm &ndash; 5 x 5', '28/07/2016, 16:58:08', NULL, 1),
(277, 185, 6500, 6500, '1', 10, '1 &agrave; 2 %', 0.02, 0.18, 6500, 'P-STAP00100L', 'Bo&icirc;te de 100 planches d&rsquo;&eacute;tiquettes LASER Staples 10,5 x 7,2 mm', '28/07/2016, 16:58:08', NULL, 1),
(278, 186, 15600, 15600, '1', 24, '1 &agrave; 2 %', 0.02, 0.18, 15600, 'D-DIST00012C', 'Distributeur 4 x 35 Index Post-it&reg; L.12 mm assortis classique', '28/07/2016, 16:58:08', NULL, 1),
(279, 187, 4550, 4550, '1', 7, '1 &agrave; 2 %', 0.02, 0.18, 4550, 'D-DIST00025R', 'Distributeur 50 index Post it L. 25 mm rouge', '28/07/2016, 16:58:08', NULL, 1),
(280, 188, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'K-KRAF00025V', 'Lot de 25 dossiers suspendus kraft pour armoires &eacute;quip&eacute;es de rails tu-bulaires fond &laquo;V&raquo;', '28/07/2016, 16:58:08', NULL, 1),
(281, 189, 6500, 6500, '1', 10, '1 &agrave; 2 %', 0.02, 0.18, 6500, 'O-CORB00000S', 'Corbeille &agrave; papier tri s&eacute;lectif', '28/07/2016, 16:58:08', NULL, 1),
(282, 190, 15600, 15600, '1', 24, '1 &agrave; 2 %', 0.02, 0.18, 15600, 'O-CORB00015B', 'Corbeille &agrave; papier 15 L. bleu', '28/07/2016, 16:58:08', NULL, 1),
(283, 191, 5850, 5850, '1', 9, '1 &agrave; 2 %', 0.02, 0.18, 5850, 'L-BACC00706N', 'Lot de 6 bacs &agrave; courrier &laquo;12-65&raquo; standard &ndash; H. 7 cm - Coloris : Noir.', '28/07/2016, 16:58:08', NULL, 1),
(284, 192, 65000, 65000, '1', 100, '1 &agrave; 2 %', 0.02, 0.18, 65000, 'R-CLAI09005I', 'Lot de 5 ramettes papier Clairalfa A4 &ndash; 90g/m&sup2;', '28/07/2016, 16:58:08', NULL, 1),
(285, 193, 1300, 1300, '1', 2, '1 &agrave; 2 %', 0.02, 0.18, 1300, 'F-CLAI25080I', 'Pack 2500 feuilles papier Clairalfa A4 &ndash; 80g/m&sup2;', '28/07/2016, 16:58:08', NULL, 1),
(286, 194, 19500, 19500, '1', 30, '1 &agrave; 2 %', 0.02, 0.18, 19500, 'A-RUBA00008I', 'Lot de 8 rubans adh&eacute;sifs invisibles', '28/07/2016, 16:58:08', NULL, 1),
(287, 195, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'A-RUBA06606I', 'Lot 6 rubans adh&eacute;sifs PVC havane L. 66 m.', '28/07/2016, 16:58:08', NULL, 1),
(288, 196, 6500, 6500, '1', 10, '1 &agrave; 2 %', 0.02, 0.18, 6500, 'A-STAD03000I', 'R&egrave;gle gradu&eacute;e 30 cm STAEDTLER plexiglas', '28/07/2016, 16:58:08', NULL, 1),
(289, 197, 6500, 6500, '1', 10, '1 &agrave; 2 %', 0.02, 0.18, 6500, 'P-QUIL10025I', 'Bo&icirc;te de 1000 trombones QUILL L. 25 mm', '28/07/2016, 16:58:08', NULL, 1),
(290, 198, 9750, 9750, '1', 15, '1 &agrave; 2 %', 0.02, 0.18, 9750, 'P-QUIL01232I', 'Bo&icirc;te  de 12 pinces-clips QUILL L.32 mm', '28/07/2016, 16:58:08', NULL, 1),
(291, 199, 9750, 9750, '1', 15, '1 &agrave; 2 %', 0.02, 0.18, 9750, 'P-QUIL01241I', 'Bo&icirc;te  de 12 pinces-clips QUILL L.41 mm', '28/07/2016, 16:58:08', NULL, 1),
(292, 200, 9750, 9750, '1', 15, '1 &agrave; 2 %', 0.02, 0.18, 9750, 'P-QUIL01225I', 'Bo&icirc;te  de 12 pinces-clips QUILL L.25 mm', '28/07/2016, 16:58:08', NULL, 1),
(293, 201, 3250, 3250, '1', 5, '1 &agrave; 2 %', 0.02, 0.18, 3250, 'P-STAP00000I', 'Ciseaux STAPLES coupe-tout', '28/07/2016, 16:58:08', NULL, 1),
(294, 202, 50000, 50000, 'PAR PERSONN', 1, '20', 2, 18, 25000, 'Transport de Personnel ', 'Transport de Personnel ', '17/08/2016, 10:48:41', NULL, 1),
(295, 203, 50000, 50000, 'PAR PERSONN', 1, '20', 2, 18, 25000, 'Transport de Marchandises', 'Transport de Marchandises', '17/08/2016, 10:48:41', NULL, 1),
(296, 204, 60000, 60000, 'PAR PERSONN', 1, '20', 2, 18, 30000, 'Transport de Personnel ', 'Transport de Personnel ', '17/08/2016, 11:02:20', NULL, 1),
(297, 205, 60000, 60000, 'PAR PERSONN', 1, '20', 2, 18, 30000, 'Transport de Marchandises', 'Transport de Marchandises', '17/08/2016, 11:02:20', NULL, 1),
(298, 1, 60000, 60000, 'PAR PERSONN', 1, '20', 2, 18, 30000, 'Transport de Personnel ', 'Transport de Personnel ', '17/08/2016, 11:19:32', NULL, 1),
(299, 2, 60000, 60000, 'PAR PERSONN', 1, '20', 2, 18, 30000, 'Transport de Marchandises', 'Transport de Marchandises', '17/08/2016, 11:19:32', NULL, 1),
(300, 3, 50000, 50000, 'PAR PERSONN', 1, '20', 2, 18, 25000, 'Transport de Personnel ', 'Transport de Personnel ', '17/08/2016, 11:24:28', NULL, 1),
(301, 4, 50000, 50000, 'PAR PERSONN', 1, '20', 2, 18, 25000, 'Transport de Marchandises', 'Transport de Marchandises', '17/08/2016, 11:24:28', NULL, 1),
(302, 5, 10000, 10000, 'PAR TONER', 1000, '20', 2, 18, 8500, 'TONER 1', 'Pour Imprimante', '17/08/2016, 11:41:08', NULL, 1),
(303, 6, 10000, 10000, 'PAR TONER', 1000, '20', 2, 18, 8500, 'TONER 2', 'Pour Imprimante', '17/08/2016, 11:41:08', NULL, 1),
(304, 7, 10000, 10000, 'PAR TONER', 1000, '20', 2, 18, 8500, 'TONER 3', 'Pour Imprimante', '17/08/2016, 11:41:08', NULL, 1),
(305, 8, 10000, 10000, 'PAR TONER', 1000, '20', 2, 18, 8500, 'TONER 4', 'Pour Imprimante', '17/08/2016, 11:41:08', NULL, 1),
(306, 9, 10000, 10000, 'PAR TONER', 1000, '20', 2, 18, 8500, 'TONER 5', 'Pour Imprimante', '17/08/2016, 11:41:08', NULL, 1),
(307, 10, 10000, 10000, 'PAR TONER', 1000, '20', 2, 18, 8500, 'TONER 6', 'Pour Imprimante', '17/08/2016, 11:41:08', NULL, 1),
(308, 11, 10000, 10000, 'PAR TONER', 1000, '20', 2, 18, 8500, 'TONER 7', 'Pour Imprimante', '17/08/2016, 11:41:08', NULL, 1),
(309, 12, 10000, 10000, 'PAR TONER', 1000, '20', 2, 18, 8500, 'TONER 8', 'Pour Imprimante', '17/08/2016, 11:41:08', NULL, 1),
(310, 13, 10000, 10000, 'PAR TONER', 1000, '20', 2, 18, 8500, 'TONER 9', 'Pour Imprimante', '17/08/2016, 11:41:08', NULL, 1),
(311, 14, 10000, 10000, 'PAR TONER', 1000, '20', 2, 18, 8500, 'TONER 10', 'Pour Imprimante', '17/08/2016, 11:41:08', NULL, 1),
(312, 15, 10000, 10000, 'PAR TONER', 1000, '20', 2, 18, 8500, 'TONER 11', 'Pour Imprimante', '17/08/2016, 11:41:08', NULL, 1),
(313, 16, 10000, 10000, 'PAR TONER', 1000, '20', 2, 18, 8500, 'TONER 12', 'Pour Imprimante', '17/08/2016, 11:41:08', NULL, 1),
(314, 17, 10000, 10000, 'PAR TONER', 1000, '20', 2, 18, 8500, 'TONER 13', 'Pour Imprimante', '17/08/2016, 11:41:08', NULL, 1),
(315, 18, 10000, 10000, 'PAR TONER', 1000, '20', 2, 18, 8500, 'TONER 14', 'Pour Imprimante', '17/08/2016, 11:41:08', NULL, 1),
(316, 19, 10000, 10000, 'PAR TONER', 1000, '20', 2, 18, 8500, 'TONER 15', 'Pour Imprimante', '17/08/2016, 11:41:08', NULL, 1),
(317, 20, 10000, 10000, 'PAR TONER', 1000, '20', 2, 18, 8500, 'TONER 16', 'Pour Imprimante', '17/08/2016, 11:41:08', NULL, 1),
(318, 21, 10000, 10000, 'PAR TONER', 1000, '20', 2, 18, 8500, 'TONER 17', 'Pour Imprimante', '17/08/2016, 11:41:08', NULL, 1),
(319, 22, 10000, 10000, 'PAR TONER', 1000, '20', 2, 18, 8500, 'TONER 18', 'Pour Imprimante', '17/08/2016, 11:41:08', NULL, 1),
(320, 23, 10000, 10000, 'PAR TONER', 1000, '20', 2, 18, 8500, 'TONER 19', 'Pour Imprimante', '17/08/2016, 11:41:08', NULL, 1),
(321, 24, 10000, 10000, 'PAR TONER', 1000, '20', 2, 18, 8500, 'TONER 20', 'Pour Imprimante', '17/08/2016, 11:41:08', NULL, 1),
(322, 25, 10000, 10000, 'PAR TONER', 1000, '20', 2, 18, 8500, 'TONER 21', 'Pour Imprimante', '17/08/2016, 11:41:08', NULL, 1),
(323, 26, 10000, 10000, 'PAR TONER', 1000, '20', 2, 18, 8500, 'TONER 22', 'Pour Imprimante', '17/08/2016, 11:41:08', NULL, 1),
(324, 27, 10000, 10000, 'PAR TONER', 1000, '20', 2, 18, 8500, 'TONER 23', 'Pour Imprimante', '17/08/2016, 11:41:08', NULL, 1),
(325, 28, 10000, 10000, 'PAR TONER', 1000, '20', 2, 18, 8500, 'TONER 24', 'Pour Imprimante', '17/08/2016, 11:41:08', NULL, 1),
(326, 29, 15000, 15000, 'PAR TONER', 1000, '20', 2, 18, 8000, 'TONER 1', 'Pour Imprimante', '17/08/2016, 12:01:17', NULL, 1),
(327, 30, 15000, 15000, 'PAR TONER', 1000, '20', 2, 18, 8000, 'TONER 2', 'Pour Imprimante', '17/08/2016, 12:01:17', NULL, 1),
(328, 31, 15000, 15000, 'PAR TONER', 1000, '20', 2, 18, 8000, 'TONER 3', 'Pour Imprimante', '17/08/2016, 12:01:17', NULL, 1),
(329, 32, 15000, 15000, 'PAR TONER', 1000, '20', 2, 18, 8000, 'TONER 4', 'Pour Imprimante', '17/08/2016, 12:01:17', NULL, 1),
(330, 33, 15000, 15000, 'PAR TONER', 1000, '20', 2, 18, 8000, 'TONER 5', 'Pour Imprimante', '17/08/2016, 12:01:17', NULL, 1),
(331, 34, 15000, 15000, 'PAR TONER', 1000, '20', 2, 18, 8000, 'TONER 6', 'Pour Imprimante', '17/08/2016, 12:01:17', NULL, 1),
(332, 35, 15000, 15000, 'PAR TONER', 1000, '20', 2, 18, 8000, 'TONER 7', 'Pour Imprimante', '17/08/2016, 12:01:17', NULL, 1),
(333, 36, 15000, 15000, 'PAR TONER', 1000, '20', 2, 18, 8000, 'TONER 8', 'Pour Imprimante', '17/08/2016, 12:01:17', NULL, 1),
(334, 37, 15000, 15000, 'PAR TONER', 1000, '20', 2, 18, 8000, 'TONER 9', 'Pour Imprimante', '17/08/2016, 12:01:17', NULL, 1),
(335, 38, 15000, 15000, 'PAR TONER', 1000, '20', 2, 18, 8000, 'TONER 10', 'Pour Imprimante', '17/08/2016, 12:01:17', NULL, 1),
(336, 39, 15000, 15000, 'PAR TONER', 1000, '20', 2, 18, 8000, 'TONER 11', 'Pour Imprimante', '17/08/2016, 12:01:17', NULL, 1);
INSERT INTO `ha_detail_article_cataloguer` (`ID_DET_ART`, `ID_ART_CAT`, `PRIX_BASE`, `PRIX_VENTE`, `UNITE`, `QTE_DISPO`, `INTERVAL_REMISE`, `REMISE`, `TVA`, `DERNIER_PRIX`, `CARACTERISTIQUE`, `INFORMATION`, `CREER_LE`, `MODIFIER_LE`, `MODE`) VALUES
(337, 40, 15000, 15000, 'PAR TONER', 1000, '20', 2, 18, 8000, 'TONER 12', 'Pour Imprimante', '17/08/2016, 12:01:17', NULL, 1),
(338, 41, 15000, 15000, 'PAR TONER', 1000, '20', 2, 18, 8000, 'TONER 13', 'Pour Imprimante', '17/08/2016, 12:01:17', NULL, 1),
(339, 42, 15000, 15000, 'PAR TONER', 1000, '20', 2, 18, 8000, 'TONER 14', 'Pour Imprimante', '17/08/2016, 12:01:17', NULL, 1),
(340, 43, 15000, 15000, 'PAR TONER', 1000, '20', 2, 18, 8000, 'TONER 15', 'Pour Imprimante', '17/08/2016, 12:01:17', NULL, 1),
(341, 44, 15000, 15000, 'PAR TONER', 1000, '20', 2, 18, 8000, 'TONER 16', 'Pour Imprimante', '17/08/2016, 12:01:17', NULL, 1),
(342, 45, 15000, 15000, 'PAR TONER', 1000, '20', 2, 18, 8000, 'TONER 17', 'Pour Imprimante', '17/08/2016, 12:01:17', NULL, 1),
(343, 46, 15000, 15000, 'PAR TONER', 1000, '20', 2, 18, 8000, 'TONER 18', 'Pour Imprimante', '17/08/2016, 12:01:17', NULL, 1),
(344, 47, 15000, 15000, 'PAR TONER', 1000, '20', 2, 18, 8000, 'TONER 19', 'Pour Imprimante', '17/08/2016, 12:01:17', NULL, 1),
(345, 48, 15000, 15000, 'PAR TONER', 1000, '20', 2, 18, 8000, 'TONER 20', 'Pour Imprimante', '17/08/2016, 12:01:17', NULL, 1),
(346, 49, 15000, 15000, 'PAR TONER', 1000, '20', 2, 18, 8000, 'TONER 21', 'Pour Imprimante', '17/08/2016, 12:01:17', NULL, 1),
(347, 50, 15000, 15000, 'PAR TONER', 1000, '20', 2, 18, 8000, 'TONER 22', 'Pour Imprimante', '17/08/2016, 12:01:17', NULL, 1),
(348, 51, 15000, 15000, 'PAR TONER', 1000, '20', 2, 18, 8000, 'TONER 23', 'Pour Imprimante', '17/08/2016, 12:01:17', NULL, 1),
(349, 52, 15000, 15000, 'PAR TONER', 1000, '20', 2, 18, 8000, 'TONER 24', 'Pour Imprimante', '17/08/2016, 12:01:17', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_detail_compte_four`
--

CREATE TABLE `ha_detail_compte_four` (
  `ID_DET_FRS` int(11) NOT NULL,
  `ID_CMPT` int(11) NOT NULL,
  `DETAILS_DOM` text COLLATE utf8_unicode_ci NOT NULL,
  `RAISON_FRS` text COLLATE utf8_unicode_ci NOT NULL,
  `NOM_CHARGER` text COLLATE utf8_unicode_ci NOT NULL,
  `PRENOMS_CHARGER` text COLLATE utf8_unicode_ci NOT NULL,
  `POSTE` text COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL` text COLLATE utf8_unicode_ci NOT NULL,
  `ATTESTATION` text COLLATE utf8_unicode_ci NOT NULL,
  `SIGNATURE` tinyint(1) NOT NULL,
  `CREER_LE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODIFIER_LE` text COLLATE utf8_unicode_ci,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_detail_compte_four`
--

INSERT INTO `ha_detail_compte_four` (`ID_DET_FRS`, `ID_CMPT`, `DETAILS_DOM`, `RAISON_FRS`, `NOM_CHARGER`, `PRENOMS_CHARGER`, `POSTE`, `EMAIL`, `ATTESTATION`, `SIGNATURE`, `CREER_LE`, `MODIFIER_LE`, `MODE`) VALUES
(1, 1, 'Fournitures de bureau; Consommables informatiques; Papier Repro. &eacute;co-responsable; Carburant; Gazole Non Routier; Fioul; Lubrifiant et Bio-lubrifiant; Hygi&egrave;ne et entretien', 'bzejbfzbfez zb ebzbfj ezj bbhzbe bzeb fhz\r\nz fzeg ziugu', 'KOUAME', 'OCTAVIO', 'COMMERCIAL', 'kouame@gmail.com', '1ERJULDCC.pdf', 1, '25/04/2015, 15:20:23', NULL, 1),
(2, 2, 'Informatique Bureautique; T&eacute;l&eacute;com, R&eacute;seaux et Serveur; Audiovisuel et multim&eacute;dia; Solution et Prestation informatique ', 'sdgds zeg zegzeg ezfzefgzefozeg ze zeg ezakljzepi ezipzeu gaizeu a zefze fez', 'KONE', 'KOUAMASSIEN', 'CORMMERCIAL', 'koamassien@yahoo.fr', '1ERTIEORP.pdf', 1, '28/05/2015, 10:25:35', NULL, 1),
(3, 3, 'Terrains Agricoles Et Forestiers; Terrains Nus; Terrains B&acirc;Tis; Travaux De Mise En Valeur Des Terrains; Terrains De Gisement; Terrains Am&eacute;Nag&eacute;S; ', 'jkfjfjjfjfvvjkhvjkksv', 'ZERO', 'Kouss', 'Secretaire', 'kouss@yahoo.fr', 'ssnjcjshjsdhjfzefe.docx', 1, '25/04/16, 19:47:12', NULL, 1),
(4, 4, 'Terrains Agricoles Et Forestiers; Terrains Nus; Terrains B&acirc;Tis; Travaux De Mise En Valeur Des Terrains; Terrains De Gisement; Terrains Am&eacute;Nag&eacute;S; ', 'dkfzekjfjze zejke', 'ZEBU', 'LAPKA', 'Secretaire', 'lapka@yahoo.eu', 'sdjksdjdnjvdsjvzo.docx', 1, '25/04/16, 19:47:12', NULL, 1),
(5, 5, 'Transports Sur Ventes; Transports Pour Le Compte De Tiers; Transports Du Personnel; Transport De Plis; Autres Frais De Transport; ', 'sddsfdsdfdsfdsfds', 'sddfd', 'qdfdsfvfsfsdfs', 'dsfdsfdsfdsff', 'dsdd@speed.com', 'fe9398d1cb5cbc091a0991f41c75ab87fc239329.doc', 1, '17/08/16, 11:44:12', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_document_facture`
--

CREATE TABLE `ha_document_facture` (
  `ID_DOC_F` int(11) NOT NULL,
  `ID_AGRE` int(11) NOT NULL,
  `ID_BC` int(11) NOT NULL,
  `NUM_FAC` text COLLATE utf8_unicode_ci NOT NULL,
  `LIBELLE` text COLLATE utf8_unicode_ci NOT NULL,
  `PIECE_JOINTE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_document_facture`
--

INSERT INTO `ha_document_facture` (`ID_DOC_F`, `ID_AGRE`, `ID_BC`, `NUM_FAC`, `LIBELLE`, `PIECE_JOINTE`, `MODE`) VALUES
(1, 4, 1, 'FAC-CD-10', 'Facture de GSK SA', '2818565314661103b5de45b9a7149bfd7d0b52de.pdf', 1),
(2, 2, 3, 'FACT-2016/0001', 'FACTURE DE PRESTATION DE TRANSPORT', 'a3118f39d602932b1aec72ef6143b90f27861093.pdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_document_fournir_agrement`
--

CREATE TABLE `ha_document_fournir_agrement` (
  `ID_DOC_D` int(11) NOT NULL,
  `ID_AGR` int(11) NOT NULL,
  `ID_PIECE_FD` int(11) NOT NULL,
  `ID_CMPT` int(11) NOT NULL,
  `LIBELLE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_document_fournir_agrement`
--

INSERT INTO `ha_document_fournir_agrement` (`ID_DOC_D`, `ID_AGR`, `ID_PIECE_FD`, `ID_CMPT`, `LIBELLE`, `MODE`) VALUES
(7, 2, 7, 1, 'beb680b519e614857e40d9fdae0d206e443c83a6.pdf', 1),
(8, 2, 6, 1, '789f9ca9709985cc938e903a1a0cdaf7f448f15f.pdf', 1),
(9, 2, 5, 1, '113b634f4b92a9dcd56f98b4b0b860cc2aa40d3a.pdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_document_fournir_appel`
--

CREATE TABLE `ha_document_fournir_appel` (
  `ID_DOC_A` int(11) NOT NULL,
  `ID_PIECE_FA` int(11) NOT NULL,
  `ID_AGRE` int(11) NOT NULL,
  `LIBELLE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ha_domaine_activite`
--

CREATE TABLE `ha_domaine_activite` (
  `ID_DOM_A` int(11) NOT NULL,
  `ID_COMPTE_CHR` int(11) NOT NULL,
  `LIBELLE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_domaine_activite`
--

INSERT INTO `ha_domaine_activite` (`ID_DOM_A`, `ID_COMPTE_CHR`, `LIBELLE`, `MODE`) VALUES
(1, 1, 'IMMOBILISATIONS INCORPORELLES', 1),
(2, 2, 'TERRAINS', 1),
(3, 3, 'B&Acirc;TIMENTS, INSTALLATIONS TECHNIQUES ET AGENCEMENTS', 1),
(4, 4, 'MAT&Eacute;RIEL', 1),
(5, 5, 'MATIERES PREMIERES', 1),
(6, 6, 'BIENS', 1),
(7, 7, 'MOYENS GENERAUX', 1),
(8, 8, 'TRANSPORTS', 1),
(9, 9, 'SERVICES EXTERIEURS A', 1),
(10, 10, 'SERVICES EXTERIEURS B', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_fournisseur_consulte_appel`
--

CREATE TABLE `ha_fournisseur_consulte_appel` (
  `ID_CONSF` int(11) NOT NULL,
  `ID_APPEL` int(11) NOT NULL,
  `ID_AGRE` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `IDEN` text COLLATE utf8_unicode_ci NOT NULL,
  `PASS` text COLLATE utf8_unicode_ci NOT NULL,
  `MDP` text COLLATE utf8_unicode_ci NOT NULL,
  `CREER_PAR` text COLLATE utf8_unicode_ci NOT NULL,
  `CREER_LE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_fournisseur_consulte_appel`
--

INSERT INTO `ha_fournisseur_consulte_appel` (`ID_CONSF`, `ID_APPEL`, `ID_AGRE`, `ID_USER`, `IDEN`, `PASS`, `MDP`, `CREER_PAR`, `CREER_LE`, `MODE`) VALUES
(1, 1, 1, 12, 'APP-197', 'WLGF', 'b2421b442124618ec4a7d6d56cb1709c20f27427', 'KOFFI Moro', '17/08/2016, 16:08:25', 1),
(2, 1, 2, 12, 'APP-749', 'LTM6', '6848b2b21dc65313be440eb0ff1e8a851de7ac5c', 'KOFFI Moro', '17/08/2016, 16:08:25', 1),
(3, 2, 3, 11, 'APP-943', 'R8HM', '7ff0b601b5c00a05af59952dfd7a5abb078deb56', 'KOUASSI Manaza', '18/08/2016, 16:13:20', 1),
(4, 2, 4, 11, 'APP-623', '4SIM', '55de8acb7964d3a9d9d53707feb39f84c26ccf20', 'KOUASSI Manaza', '18/08/2016, 16:13:20', 1),
(5, 1, 4, 1, 'APP-42308', 'R8HI7A', '9dc500084d34e648e78e1b8df570ece22a09c7ff', 'Junior MAMADOU', '09/04/2017, 19:41:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_grille_cotation_btp`
--

CREATE TABLE `ha_grille_cotation_btp` (
  `ID_GRC_BTP` int(11) NOT NULL,
  `ID_APPEL` int(11) NOT NULL,
  `ID_AGRE` int(11) NOT NULL,
  `ID_FNC_BTP` int(11) NOT NULL,
  `ID_CRT_BTP` int(11) NOT NULL,
  `COTATION` int(11) NOT NULL,
  `DATE_COT` text COLLATE utf8_unicode_ci NOT NULL,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ha_grille_cotation_imp`
--

CREATE TABLE `ha_grille_cotation_imp` (
  `ID_GRC_IMP` int(11) NOT NULL,
  `ID_APPEL` int(11) NOT NULL,
  `ID_AGRE` int(11) NOT NULL,
  `ID_FNC_IMP` int(11) NOT NULL,
  `ID_CRT_IMP` int(11) NOT NULL,
  `COTATION` int(11) NOT NULL,
  `DATE_COT` text COLLATE utf8_unicode_ci NOT NULL,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ha_grille_cotation_pi`
--

CREATE TABLE `ha_grille_cotation_pi` (
  `ID_GRC_PI` int(11) NOT NULL,
  `ID_APPEL` int(11) NOT NULL,
  `ID_AGRE` int(11) NOT NULL,
  `ID_FNC_PI` int(11) NOT NULL,
  `ID_CRT_PI` int(11) NOT NULL,
  `COTATION` int(11) NOT NULL,
  `DATE_COT` text COLLATE utf8_unicode_ci NOT NULL,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ha_grille_cotation_prj`
--

CREATE TABLE `ha_grille_cotation_prj` (
  `ID_GRC_PRJ` int(11) NOT NULL,
  `ID_APPEL` int(11) NOT NULL,
  `ID_AGRE` int(11) NOT NULL,
  `ID_FNC_PRJ` int(11) NOT NULL,
  `ID_CRT_PRJ` int(11) NOT NULL,
  `COTATION` int(11) NOT NULL,
  `DATE_COT` text COLLATE utf8_unicode_ci NOT NULL,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ha_grille_cotation_sg`
--

CREATE TABLE `ha_grille_cotation_sg` (
  `ID_GRC_SG` int(11) NOT NULL,
  `ID_APPEL` int(11) NOT NULL,
  `ID_AGRE` int(11) NOT NULL,
  `ID_FNC_SG` int(11) NOT NULL,
  `ID_CRT_SG` int(11) NOT NULL,
  `TYPE_EVAL` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `COTATION` int(11) NOT NULL,
  `DATE_COT` text COLLATE utf8_unicode_ci NOT NULL,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ha_grille_cotation_std`
--

CREATE TABLE `ha_grille_cotation_std` (
  `ID_GRC_STD` int(11) NOT NULL,
  `ID_APPEL` int(11) NOT NULL,
  `ID_AGRE` int(11) NOT NULL,
  `ID_FNC_STD` int(11) NOT NULL,
  `ID_CRT_STD` int(11) NOT NULL,
  `COTATION` int(11) NOT NULL,
  `DATE_COT` text COLLATE utf8_unicode_ci NOT NULL,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_grille_cotation_std`
--

INSERT INTO `ha_grille_cotation_std` (`ID_GRC_STD`, `ID_APPEL`, `ID_AGRE`, `ID_FNC_STD`, `ID_CRT_STD`, `COTATION`, `DATE_COT`, `MODE`) VALUES
(1, 1, 2, 5, 49, 8000, '18/08/2016, 16:12:48', 1),
(2, 1, 2, 5, 50, 1500, '18/08/2016, 16:12:48', 1),
(3, 1, 1, 5, 49, 2500, '18/08/2016, 16:12:48', 1),
(4, 1, 1, 5, 50, 5000, '18/08/2016, 16:12:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_identification_four`
--

CREATE TABLE `ha_identification_four` (
  `ID_IDT_FRS` int(11) NOT NULL,
  `ID_CMPT` int(11) NOT NULL,
  `DENOMINATION` text COLLATE utf8_unicode_ci NOT NULL,
  `GROUPE` text COLLATE utf8_unicode_ci,
  `FILIALES` text COLLATE utf8_unicode_ci,
  `PAYS_SIEGE` text COLLATE utf8_unicode_ci NOT NULL,
  `VILLE` text COLLATE utf8_unicode_ci NOT NULL,
  `ADRESSE` text COLLATE utf8_unicode_ci NOT NULL,
  `SITUATION_GEO` text COLLATE utf8_unicode_ci NOT NULL,
  `TELEPHONE` text COLLATE utf8_unicode_ci NOT NULL,
  `FAX` text COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL` text COLLATE utf8_unicode_ci,
  `SITE_WEB` text COLLATE utf8_unicode_ci,
  `CAPITAL_SOCIAL` text COLLATE utf8_unicode_ci NOT NULL,
  `CAPITAUX_ETR` text COLLATE utf8_unicode_ci NOT NULL,
  `FORME_JUR` text COLLATE utf8_unicode_ci NOT NULL,
  `DATE_CREATION` text COLLATE utf8_unicode_ci NOT NULL,
  `OBJET_SOCIAL` text COLLATE utf8_unicode_ci NOT NULL,
  `IMMATRICULATION` text COLLATE utf8_unicode_ci NOT NULL,
  `COMPTE_CONTRI` text COLLATE utf8_unicode_ci NOT NULL,
  `REGIME_FISCAL` text COLLATE utf8_unicode_ci NOT NULL,
  `CENTRE_IMPOSI` text COLLATE utf8_unicode_ci NOT NULL,
  `ETABLISSEMENT_BANK` text COLLATE utf8_unicode_ci NOT NULL,
  `PAYS_BANK` text COLLATE utf8_unicode_ci NOT NULL,
  `VILLE_BANK` text COLLATE utf8_unicode_ci NOT NULL,
  `ADRESSE_BANK` text COLLATE utf8_unicode_ci NOT NULL,
  `COMPTE_BANK` text COLLATE utf8_unicode_ci NOT NULL,
  `RIB` text COLLATE utf8_unicode_ci NOT NULL,
  `IBAN` text COLLATE utf8_unicode_ci NOT NULL,
  `SWIFT` text COLLATE utf8_unicode_ci NOT NULL,
  `CREER_LE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODIFIER_LE` text COLLATE utf8_unicode_ci,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_identification_four`
--

INSERT INTO `ha_identification_four` (`ID_IDT_FRS`, `ID_CMPT`, `DENOMINATION`, `GROUPE`, `FILIALES`, `PAYS_SIEGE`, `VILLE`, `ADRESSE`, `SITUATION_GEO`, `TELEPHONE`, `FAX`, `EMAIL`, `SITE_WEB`, `CAPITAL_SOCIAL`, `CAPITAUX_ETR`, `FORME_JUR`, `DATE_CREATION`, `OBJET_SOCIAL`, `IMMATRICULATION`, `COMPTE_CONTRI`, `REGIME_FISCAL`, `CENTRE_IMPOSI`, `ETABLISSEMENT_BANK`, `PAYS_BANK`, `VILLE_BANK`, `ADRESSE_BANK`, `COMPTE_BANK`, `RIB`, `IBAN`, `SWIFT`, `CREER_LE`, `MODIFIER_LE`, `MODE`) VALUES
(1, 1, 'ZKV Invok', 'Maersk', '', 'Cote D\\\'ivoire', 'Abidjan', '225 Cocody centre avenue Angoulvant', 'Boulevard Fran&ccedil;ois Mitterrand Abidjan C&ocirc;te d\\\'Ivoire', '20000712', '20000001', 'akatsuki@frapper.com', 'http://www.invoc.com', '140000000', '25000000', 'SA', '1985-04-25', ' dssd sd dsf ds', 'sdf dsf ds fdsf dsf dsf d', 'sfdsfsd fds', 'ds fd fsd', 'sd sfdsf dsfds ', 'Standard Charted', 'Cote D\\\'ivoire', 'Abidjan', 'Avenue kouassi va dormir', '447 771z 777 75', 'sZ7455511', '7777o88o88o888', 'qq777444747q', '25/04/16, 19:47:12', NULL, 1),
(2, 2, 'Dupont SA', 'Dupont SA', 'Dupont SA', 'Cote D\\\'ivoire', 'Abidjan', '23 BP 3443 Abidjan 23', 'SDFDF', '12345678', '12345678', 'franck.olivierkoua@ivoirusbuyer.com', 'dupont@dupont.com', '0', '0', 'SA', '2011-01-01', 'sfsdfdsf', '2141341343', '122241443', '124243434', '1423421442', 'BICICI', 'Cote D\\\'ivoire', 'Abidjan', '12 BP Abidjan 12', '12324452454', '212341343143434', '214124132431243214', '1341341412424', '16/08/16, 19:52:27', NULL, 1),
(3, 3, 'GKS SA', 'GKS SA', 'GKS SA', 'Cote D\\\'ivoire', 'Abidjan', '19 BP Abidjan 19', 'sddfdsfdsfdsf', '22334334', '22334334', 'franck.olivierkoua@ivoirusbuyer.com', 'gks@gks.com', '0', '0', 'SA', '1991-04-02', 'FOURNITURES CONSOMMABLES', '13243423452425', '34335254243532', '23442332434', 'CNRS', 'BICICI', 'Cote D\\\'ivoire', 'Abidjan', '45 BP 34312 ABIDJAN 45 ', '2343434323234552', '343243243243243', '343242343432432432', '23434324324243432', '16/08/16, 20:05:16', NULL, 1),
(4, 4, 'UTB SA', 'UTB SA', 'UTB SA', 'Cote D\\\'ivoire', 'Abidjan', '87 BP 1897 ABIDJAN 87', 'dfedfdefezfz', '23456788', '23244545', 'franck.olivierkoua@ivoirusbuyer.com', 'utb@utb.com', '0', '0', 'SA', '2004-03-01', 'Transport de Personnes et de Marchandises', '343534657476', '32324546346565', '3252345454523', 'Abidjan', 'BICICI', 'Cote D\\\'ivoire', 'Abidjan', '34 BP 2766 Abidjan 34', '3432654657467', '354256465376563565', '324532542545454225', '324542425454252452', '17/08/16, 11:27:01', NULL, 1),
(5, 5, 'SPEED SA', 'SPEED SA', 'SPPED SA', 'Cote D\\\'ivoire', 'Abidjan', '20 BP 9876 Abidjan 20', 'sgvfsgdsdsdgfdg', '23456789', '23455667', 'franck.olivierkoua@ivoirusbuyer.com', 'speed@speed.com', '0', '0', 'SA', '1993-05-01', 'Transports ', '34254363653635635', '23432542636356', 'EFQFFDQ', 'Abidjan', 'BICICI', 'Cote D\\\'ivoire', 'Abidjan', '87 BP 2887 Abidjan 87', '346575757644', '463465653653635653653', '346366536356556365', '3635635653653365665', '17/08/16, 11:44:12', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_info_societe`
--

CREATE TABLE `ha_info_societe` (
  `ID_G` int(11) NOT NULL,
  `NOM` text COLLATE utf8_unicode_ci NOT NULL,
  `SLOGANT` text COLLATE utf8_unicode_ci NOT NULL,
  `VILLE` text COLLATE utf8_unicode_ci NOT NULL,
  `LOCALITE` text COLLATE utf8_unicode_ci NOT NULL,
  `ADRESSE` text COLLATE utf8_unicode_ci NOT NULL,
  `ACTIVITE` text COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL` text COLLATE utf8_unicode_ci NOT NULL,
  `SITE_WEB` text COLLATE utf8_unicode_ci NOT NULL,
  `FIXE` text COLLATE utf8_unicode_ci NOT NULL,
  `FAX` text COLLATE utf8_unicode_ci NOT NULL,
  `TELEPHONE` text COLLATE utf8_unicode_ci NOT NULL,
  `CAPITAL` bigint(20) NOT NULL,
  `CHIFFRE` bigint(20) NOT NULL,
  `SIEGE` text COLLATE utf8_unicode_ci NOT NULL,
  `FORME` text COLLATE utf8_unicode_ci NOT NULL,
  `RCCM` text COLLATE utf8_unicode_ci NOT NULL,
  `INITAL_BNK` text COLLATE utf8_unicode_ci NOT NULL,
  `COMPTE` text COLLATE utf8_unicode_ci NOT NULL,
  `TELEX` text COLLATE utf8_unicode_ci NOT NULL,
  `REGIME` text COLLATE utf8_unicode_ci NOT NULL,
  `CENTRE` text COLLATE utf8_unicode_ci NOT NULL,
  `LOGO` text COLLATE utf8_unicode_ci NOT NULL,
  `HEURE_D` time NOT NULL,
  `HEURE_F` time NOT NULL,
  `CREER_PAR` text COLLATE utf8_unicode_ci NOT NULL,
  `CREER_LE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODIFIER_PAR` text COLLATE utf8_unicode_ci,
  `MODIFIER_LE` text COLLATE utf8_unicode_ci,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_info_societe`
--

INSERT INTO `ha_info_societe` (`ID_G`, `NOM`, `SLOGANT`, `VILLE`, `LOCALITE`, `ADRESSE`, `ACTIVITE`, `EMAIL`, `SITE_WEB`, `FIXE`, `FAX`, `TELEPHONE`, `CAPITAL`, `CHIFFRE`, `SIEGE`, `FORME`, `RCCM`, `INITAL_BNK`, `COMPTE`, `TELEX`, `REGIME`, `CENTRE`, `LOGO`, `HEURE_D`, `HEURE_F`, `CREER_PAR`, `CREER_LE`, `MODIFIER_PAR`, `MODIFIER_LE`, `MODE`) VALUES
(1, 'M ALIENX', 'la Qualit&eacute; au meilleur prix', 'ABIDJAN', '14 EME RUE MICHELLE DUMON', '01 BP 1580 ABDJ 01', 'MATRIELS ET LOGICIEL INFORMATIQUE', 'alienx-info@free.com', 'www.alienx.org', '22356988', '22356989', '05898898', 12000000000, 7500000000, 'COCODY CENTRE', 'SA', 'P001D4514', 'BNP', '115D550', '22356995', 'inonnu', 'inconnu', '18.jpg', '07:30:00', '19:00:00', 'ZEN Hiro', '23/01/2016, 01:20:23', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_notation_administratif`
--

CREATE TABLE `ha_notation_administratif` (
  `ID_NOTE_A` int(11) NOT NULL,
  `ID_AGR` int(11) NOT NULL,
  `ID_CMPT` int(11) NOT NULL,
  `MOYENNE` double NOT NULL,
  `CREER_PAR` text COLLATE utf8_unicode_ci NOT NULL,
  `DATE_NOTE` text COLLATE utf8_unicode_ci NOT NULL,
  `COMMENTAIRE` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_notation_administratif`
--

INSERT INTO `ha_notation_administratif` (`ID_NOTE_A`, `ID_AGR`, `ID_CMPT`, `MOYENNE`, `CREER_PAR`, `DATE_NOTE`, `COMMENTAIRE`) VALUES
(1, 1, 1, 14.8, 'KOSSONOU Adolphe', '01/06/2015, 00:28:24', 'freyuoiuulll'),
(2, 2, 4, 18.17, 'KOFFI Moro', '17/08/2016, 11:33:38', 'Fournisseur satisfaisant du point de vu administratif'),
(3, 2, 5, 20, 'KOFFI Moro', '17/08/2016, 11:53:07', 'Candidat satisfaisant'),
(4, 1, 2, 16, 'KOUASSI Manaza', '17/08/2016, 17:44:53', 'AZERTY'),
(5, 1, 3, 16, 'KOUASSI Manaza', '17/08/2016, 17:50:18', 'QSDFG');

-- --------------------------------------------------------

--
-- Table structure for table `ha_note_financiere_btp`
--

CREATE TABLE `ha_note_financiere_btp` (
  `ID_NFIN_BTP` int(11) NOT NULL,
  `ID_APPEL` int(11) NOT NULL,
  `ID_AGRE` int(11) NOT NULL,
  `PONDERATION` double NOT NULL,
  `POINT` int(11) NOT NULL,
  `POINT_POND` double NOT NULL,
  `NOTE_ACHT` text COLLATE utf8_unicode_ci,
  `NOTE_COMITE` text COLLATE utf8_unicode_ci,
  `DATE_NOTE` text COLLATE utf8_unicode_ci NOT NULL,
  `NOTE_PAR` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ha_note_financiere_imp`
--

CREATE TABLE `ha_note_financiere_imp` (
  `ID_NFIN_IMP` int(11) NOT NULL,
  `ID_APPEL` int(11) NOT NULL,
  `ID_AGRE` int(11) NOT NULL,
  `PONDERATION` double NOT NULL,
  `POINT` int(11) NOT NULL,
  `POINT_POND` double NOT NULL,
  `NOTE_ACHT` text COLLATE utf8_unicode_ci,
  `NOTE_COMITE` text COLLATE utf8_unicode_ci,
  `DATE_NOTE` text COLLATE utf8_unicode_ci NOT NULL,
  `NOTE_PAR` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ha_note_financiere_pi`
--

CREATE TABLE `ha_note_financiere_pi` (
  `ID_NFIN_PI` int(11) NOT NULL,
  `ID_APPEL` int(11) NOT NULL,
  `ID_AGRE` int(11) NOT NULL,
  `PONDERATION` double NOT NULL,
  `POINT` int(11) NOT NULL,
  `POINT_POND` double NOT NULL,
  `NOTE_ACHT` text COLLATE utf8_unicode_ci,
  `NOTE_COMITE` text COLLATE utf8_unicode_ci,
  `DATE_NOTE` text COLLATE utf8_unicode_ci NOT NULL,
  `NOTE_PAR` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ha_note_financiere_prj`
--

CREATE TABLE `ha_note_financiere_prj` (
  `ID_NFIN_PRJ` int(11) NOT NULL,
  `ID_APPEL` int(11) NOT NULL,
  `ID_AGRE` int(11) NOT NULL,
  `PONDERATION` double NOT NULL,
  `POINT` int(11) NOT NULL,
  `POINT_POND` double NOT NULL,
  `NOTE_ACHT` text COLLATE utf8_unicode_ci,
  `NOTE_COMITE` text COLLATE utf8_unicode_ci,
  `DATE_NOTE` text COLLATE utf8_unicode_ci NOT NULL,
  `NOTE_PAR` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ha_note_financiere_sg`
--

CREATE TABLE `ha_note_financiere_sg` (
  `ID_NFIN_SG` int(11) NOT NULL,
  `ID_APPEL` int(11) NOT NULL,
  `ID_AGRE` int(11) NOT NULL,
  `TYPE_EVAL` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `PONDERATION` double NOT NULL,
  `POINT` int(11) NOT NULL,
  `POINT_POND` double NOT NULL,
  `NOTE_ACHT` text COLLATE utf8_unicode_ci,
  `NOTE_COMITE` text COLLATE utf8_unicode_ci,
  `DATE_NOTE` text COLLATE utf8_unicode_ci NOT NULL,
  `NOTE_PAR` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ha_note_financiere_std`
--

CREATE TABLE `ha_note_financiere_std` (
  `ID_NFIN_STD` int(11) NOT NULL,
  `ID_APPEL` int(11) NOT NULL,
  `ID_AGRE` int(11) NOT NULL,
  `PONDERATION` double NOT NULL,
  `POINT` int(11) NOT NULL,
  `POINT_POND` double NOT NULL,
  `NOTE_ACHT` text COLLATE utf8_unicode_ci,
  `NOTE_COMITE` text COLLATE utf8_unicode_ci,
  `DATE_NOTE` text COLLATE utf8_unicode_ci NOT NULL,
  `NOTE_PAR` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_note_financiere_std`
--

INSERT INTO `ha_note_financiere_std` (`ID_NFIN_STD`, `ID_APPEL`, `ID_AGRE`, `PONDERATION`, `POINT`, `POINT_POND`, `NOTE_ACHT`, `NOTE_COMITE`, `DATE_NOTE`, `NOTE_PAR`) VALUES
(1, 1, 2, 100, 32, 19.16, NULL, 'et alioqui coalito more in ordinarias dignitates', '13/04/2017, 01:51:46', 'Junior MAMADOU'),
(2, 1, 1, 100, 32, 13.63, NULL, 'et alioqui coalito more in ordinarias dignitates', '13/04/2017, 01:53:20', 'Junior MAMADOU');

-- --------------------------------------------------------

--
-- Table structure for table `ha_note_technique_btp`
--

CREATE TABLE `ha_note_technique_btp` (
  `ID_NTEC_BTP` int(11) NOT NULL,
  `ID_APPEL` int(11) NOT NULL,
  `ID_AGRE` int(11) NOT NULL,
  `PONDERATION` double NOT NULL,
  `POINT` int(11) NOT NULL,
  `POINT_POND` double NOT NULL,
  `NOTE_PRES` text COLLATE utf8_unicode_ci NOT NULL,
  `NOTE_COMITE` text COLLATE utf8_unicode_ci NOT NULL,
  `DATE_NOTE` text COLLATE utf8_unicode_ci,
  `NOTE_PAR` text COLLATE utf8_unicode_ci,
  `VALIDER` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ha_note_technique_imp`
--

CREATE TABLE `ha_note_technique_imp` (
  `ID_NTEC_IMP` int(11) NOT NULL,
  `ID_APPEL` int(11) NOT NULL,
  `ID_AGRE` int(11) NOT NULL,
  `PONDERATION` double NOT NULL,
  `POINT` int(11) NOT NULL,
  `POINT_POND` double NOT NULL,
  `NOTE_PRES` text COLLATE utf8_unicode_ci,
  `NOTE_COMITE` text COLLATE utf8_unicode_ci,
  `DATE_NOTE` text COLLATE utf8_unicode_ci NOT NULL,
  `NOTE_PAR` text COLLATE utf8_unicode_ci NOT NULL,
  `VALIDER` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ha_note_technique_pi`
--

CREATE TABLE `ha_note_technique_pi` (
  `ID_NTEC_PI` int(11) NOT NULL,
  `ID_APPEL` int(11) NOT NULL,
  `ID_AGRE` int(11) NOT NULL,
  `PONDERATION` double NOT NULL,
  `POINT` int(11) NOT NULL,
  `POINT_POND` double NOT NULL,
  `NOTE_PRES` text COLLATE utf8_unicode_ci,
  `NOTE_COMITE` text COLLATE utf8_unicode_ci,
  `DATE_NOTE` text COLLATE utf8_unicode_ci NOT NULL,
  `NOTE_PAR` text COLLATE utf8_unicode_ci NOT NULL,
  `VALIDER` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ha_note_technique_prj`
--

CREATE TABLE `ha_note_technique_prj` (
  `ID_NTEC_PRJ` int(11) NOT NULL,
  `ID_APPEL` int(11) NOT NULL,
  `ID_AGRE` int(11) NOT NULL,
  `PONDERATION` double NOT NULL,
  `POINT` int(11) NOT NULL,
  `POINT_POND` double NOT NULL,
  `NOTE_PRES` text COLLATE utf8_unicode_ci,
  `NOTE_COMITE` text COLLATE utf8_unicode_ci,
  `DATE_NOTE` text COLLATE utf8_unicode_ci NOT NULL,
  `NOTE_PAR` text COLLATE utf8_unicode_ci NOT NULL,
  `VALIDER` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ha_note_technique_sg`
--

CREATE TABLE `ha_note_technique_sg` (
  `ID_NTEC_SG` int(11) NOT NULL,
  `ID_APPEL` int(11) NOT NULL,
  `ID_AGRE` int(11) NOT NULL,
  `TYPE_EVAL` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `PONDERATION` double NOT NULL,
  `POINT` int(11) NOT NULL,
  `POINT_POND` double NOT NULL,
  `NOTE_PRES` text COLLATE utf8_unicode_ci,
  `NOTE_COMITE` text COLLATE utf8_unicode_ci,
  `DATE_NOTE` text COLLATE utf8_unicode_ci NOT NULL,
  `NOTE_PAR` text COLLATE utf8_unicode_ci NOT NULL,
  `VALIDER` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ha_note_technique_std`
--

CREATE TABLE `ha_note_technique_std` (
  `ID_NTEC_STD` int(11) NOT NULL,
  `ID_APPEL` int(11) NOT NULL,
  `ID_AGRE` int(11) NOT NULL,
  `PONDERATION` double NOT NULL,
  `POINT` int(11) NOT NULL,
  `POINT_POND` double NOT NULL,
  `NOTE_PRES` text COLLATE utf8_unicode_ci,
  `NOTE_COMITE` text COLLATE utf8_unicode_ci,
  `DATE_NOTE` text COLLATE utf8_unicode_ci NOT NULL,
  `NOTE_PAR` text COLLATE utf8_unicode_ci NOT NULL,
  `VALIDER` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_note_technique_std`
--

INSERT INTO `ha_note_technique_std` (`ID_NTEC_STD`, `ID_APPEL`, `ID_AGRE`, `PONDERATION`, `POINT`, `POINT_POND`, `NOTE_PRES`, `NOTE_COMITE`, `DATE_NOTE`, `NOTE_PAR`, `VALIDER`) VALUES
(1, 1, 2, 100, 29, 14.4, NULL, 'Int&eacute;ressant pour la suite on reste toujours d\'an l\'observation', '12/04/2017, 03:40:35', 'Junior MAMADOU', 1),
(2, 1, 1, 100, 23, 11.8, NULL, 'On verra pour la suite on reste toujours d\'an l\'observation', '12/04/2017, 03:41:08', 'Junior MAMADOU', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_pieces_agrement`
--

CREATE TABLE `ha_pieces_agrement` (
  `ID_PIECE` int(11) NOT NULL,
  `LIBELLE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_pieces_agrement`
--

INSERT INTO `ha_pieces_agrement` (`ID_PIECE`, `LIBELLE`, `MODE`) VALUES
(1, 'Le registre de commerce', 1),
(2, 'L&rsquo;attestation CNPS', 1),
(3, 'L&rsquo;attestation RF', 1),
(4, 'L&rsquo;attestation BE (A B E)', 1),
(5, 'L&rsquo;attestation F D F P', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_pieces_fournir_agrement`
--

CREATE TABLE `ha_pieces_fournir_agrement` (
  `ID_PIECE_FD` int(11) NOT NULL,
  `ID_AGR` int(11) NOT NULL,
  `ID_PIECE` int(11) NOT NULL,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_pieces_fournir_agrement`
--

INSERT INTO `ha_pieces_fournir_agrement` (`ID_PIECE_FD`, `ID_AGR`, `ID_PIECE`, `MODE`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 4, 1),
(5, 2, 1, 1),
(6, 2, 3, 1),
(7, 2, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_pieces_fournir_appel`
--

CREATE TABLE `ha_pieces_fournir_appel` (
  `ID_PIECE_FA` int(11) NOT NULL,
  `ID_APPEL` int(11) NOT NULL,
  `LIBELLE` text COLLATE utf8_unicode_ci NOT NULL,
  `PIECE` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_pieces_fournir_appel`
--

INSERT INTO `ha_pieces_fournir_appel` (`ID_PIECE_FA`, `ID_APPEL`, `LIBELLE`, `PIECE`) VALUES
(1, 1, 'Primi igitur omnium statuuntur', '5fb8711a85bbf13e04da0cca5891096d7e69fa0b.docx');

-- --------------------------------------------------------

--
-- Table structure for table `ha_position_commerciale_four`
--

CREATE TABLE `ha_position_commerciale_four` (
  `ID_PC_FRS` int(11) NOT NULL,
  `ID_CMPT` int(11) NOT NULL,
  `ACTIVITE_P` text COLLATE utf8_unicode_ci NOT NULL,
  `ACTIVITE_S` text COLLATE utf8_unicode_ci NOT NULL,
  `MARQUES` text COLLATE utf8_unicode_ci,
  `NBR_REFERENCE` int(11) NOT NULL,
  `SERVICE_AP` tinyint(1) NOT NULL,
  `DIMENTIONS` text COLLATE utf8_unicode_ci NOT NULL,
  `REFERNCE_COM` text COLLATE utf8_unicode_ci NOT NULL,
  `ETES_VS` text COLLATE utf8_unicode_ci NOT NULL,
  `SECTEURS_ACTIVITE` tinyint(1) NOT NULL,
  `CLIENTS` text COLLATE utf8_unicode_ci,
  `PRODUITS_SERVICE` text COLLATE utf8_unicode_ci NOT NULL,
  `REFRENCE_ENTR` text COLLATE utf8_unicode_ci NOT NULL,
  `TYPE_MARCHE` tinyint(1) NOT NULL,
  `LE_QUEL` text COLLATE utf8_unicode_ci NOT NULL,
  `ORGANISATION_COM` text COLLATE utf8_unicode_ci NOT NULL,
  `CREER_LE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODIFIER_LE` text COLLATE utf8_unicode_ci,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_position_commerciale_four`
--

INSERT INTO `ha_position_commerciale_four` (`ID_PC_FRS`, `ID_CMPT`, `ACTIVITE_P`, `ACTIVITE_S`, `MARQUES`, `NBR_REFERENCE`, `SERVICE_AP`, `DIMENTIONS`, `REFERNCE_COM`, `ETES_VS`, `SECTEURS_ACTIVITE`, `CLIENTS`, `PRODUITS_SERVICE`, `REFRENCE_ENTR`, `TYPE_MARCHE`, `LE_QUEL`, `ORGANISATION_COM`, `CREER_LE`, `MODIFIER_LE`, `MODE`) VALUES
(1, 1, 'VENTE DE FOURNITURES', 'ENTRETIEN DE CONSOMMABLE INFORMATIQUE', NULL, 18, 0, '', 'FGHFG45', 'DISTRIBUTEUR AGREE ; IMPORTATEUR', 0, NULL, 'Auccun', 'Auccun', 0, '', 'SDU KG GDSDSUIF SDDFGSD HGFSD GHFD SHJG SDHGF SDJGHF DSGFHB DSH FDSH<F', '15/05/2015, 15:20:02', NULL, 1),
(2, 2, 'Fournitures de bureau', 'Fournitures de Bureau ', 'Dupont', 0, 1, 'DFDQFFQD', 'QFSFSFQSFS', 'Fabriquant; QSDSDQSDQSDQS; ', 1, 'SQDSDSDSQDSDSQ', 'QSDSDSDSQDQS', 'QSDSDSQDSDQSD', 1, 'qdsdfdfcqdfqd', 'dfdsfdfdfdfsdfdsf', '16/08/16, 19:52:27', NULL, 1),
(3, 3, 'Fournitures consommables ', 'Fournitures consommables ', 'GKS', 0, 1, '0', 'sdfdfdfdfdsfdsf', 'Fabriquant; dsfdsfsfsdfsdffdsdsf; ', 1, 'dsfdsfdsfsddsfdsds', 'sddsfdsffsdfdfsfsd', 'dsdsfdsbfbfdghfdgfgd', 1, 'sdgffhffdgfdf', 'sdfgfdsgfsgfdgfhgffgdf', '16/08/16, 20:05:16', NULL, 1),
(4, 4, 'Transports ', 'Transports', 'UTB', 0, 1, 'sfdsfdfdsfdscds', 'dsdvdsdfdghnjh', 'Fabriquant; jvbfbghufhgfuhigfhufufhfuiob; ', 1, 'ghbgbhgrfbgbdfvf', 'fgfdbgfbgbgtbgbgbfd', 'dggebeghtegrgteggfggef', 1, 'erehbtegfgefgregre', 'gdcgbbgfhtgfrhtrhbgbgbgd', '17/08/16, 11:27:01', NULL, 1),
(5, 5, 'TRANSPORTS', 'TRANSPORTS ', 'SPEED', 0, 1, '0', 'sddfsfdfdsfddssf', 'Fabriquant; dfsfdffbfffgbfbggd; ', 1, 'dsdfftfrgvfdbgfbhtghthd', 'gdbfvfdvfvdvds', 'dvdsvdsvdvdvdvdfv', 1, 'hykjuiuoiitsfd', 'ezerztyzertvd', '17/08/16, 11:44:12', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_postuler`
--

CREATE TABLE `ha_postuler` (
  `ID_POSTULER_D` int(11) NOT NULL,
  `ID_AGR` int(11) NOT NULL,
  `ID_CMPT` int(11) NOT NULL,
  `DATE_POST` text COLLATE utf8_unicode_ci NOT NULL,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_postuler`
--

INSERT INTO `ha_postuler` (`ID_POSTULER_D`, `ID_AGR`, `ID_CMPT`, `DATE_POST`, `MODE`) VALUES
(6, 1, 1, '11/04/2020, 13:31:33', 1),
(7, 2, 1, '11/04/2020, 13:31:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_postuler_offre`
--

CREATE TABLE `ha_postuler_offre` (
  `ID_POSTULE_O` int(11) NOT NULL,
  `ID_APPEL` int(11) NOT NULL,
  `ID_AGRE` int(11) NOT NULL,
  `DATE_POST` text COLLATE utf8_unicode_ci NOT NULL,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_postuler_offre`
--

INSERT INTO `ha_postuler_offre` (`ID_POSTULE_O`, `ID_APPEL`, `ID_AGRE`, `DATE_POST`, `MODE`) VALUES
(5, 1, 1, '11/04/2020, 12:52:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_post_sujet_agrement`
--

CREATE TABLE `ha_post_sujet_agrement` (
  `ID_POST_SUJ_A` int(11) NOT NULL,
  `ID_SUJ_A` int(11) NOT NULL,
  `PROFIL` text COLLATE utf8_unicode_ci NOT NULL,
  `COMMENTAIRE` text COLLATE utf8_unicode_ci NOT NULL,
  `CREER_PAR` text COLLATE utf8_unicode_ci NOT NULL,
  `CREER_LE` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ha_post_sujet_consultation`
--

CREATE TABLE `ha_post_sujet_consultation` (
  `ID_POST_SUJ_O` int(11) NOT NULL,
  `ID_SUJ_O` int(11) NOT NULL,
  `PROFIL` text COLLATE utf8_unicode_ci NOT NULL,
  `COMMENTAIRE` text COLLATE utf8_unicode_ci NOT NULL,
  `CREER_PAR` text COLLATE utf8_unicode_ci NOT NULL,
  `CREER_LE` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ha_ressource_humaine_four`
--

CREATE TABLE `ha_ressource_humaine_four` (
  `ID_RH_FRS` int(11) NOT NULL,
  `ID_CMPT` int(11) NOT NULL,
  `NBR_SALARIES` int(11) NOT NULL,
  `NBR_CADRE` int(11) NOT NULL,
  `NBR_SALARIES_CNPS` int(11) NOT NULL,
  `NBR_SALARIES_CDI` int(11) NOT NULL,
  `NBR_SALARIES_CDD` int(11) NOT NULL,
  `NBR_TRAVAILLEUR_TEMPO` int(11) NOT NULL,
  `PERCENT_SALARIES_CDI` double NOT NULL,
  `PERCENT_SALARIES_CDD` double NOT NULL,
  `PERCENT_TRAVAILLEUR_TEMPO` double NOT NULL,
  `ANCIENNETE_MOYENNE` double NOT NULL,
  `AGE_MOYEN` int(11) NOT NULL,
  `TAUX_TURN_OVER` double NOT NULL,
  `CREER_LE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODIFIER_LE` text COLLATE utf8_unicode_ci,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_ressource_humaine_four`
--

INSERT INTO `ha_ressource_humaine_four` (`ID_RH_FRS`, `ID_CMPT`, `NBR_SALARIES`, `NBR_CADRE`, `NBR_SALARIES_CNPS`, `NBR_SALARIES_CDI`, `NBR_SALARIES_CDD`, `NBR_TRAVAILLEUR_TEMPO`, `PERCENT_SALARIES_CDI`, `PERCENT_SALARIES_CDD`, `PERCENT_TRAVAILLEUR_TEMPO`, `ANCIENNETE_MOYENNE`, `AGE_MOYEN`, `TAUX_TURN_OVER`, `CREER_LE`, `MODIFIER_LE`, `MODE`) VALUES
(1, 1, 50, 5, 35, 36, 10, 4, 72, 10, 8, 40.5, 35, 0.25, '15/05/2015, 15:20:02', NULL, 1),
(2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '16/08/16, 19:52:27', NULL, 1),
(3, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '16/08/16, 20:05:16', NULL, 1),
(4, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '17/08/16, 11:27:01', NULL, 1),
(5, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '17/08/16, 11:44:12', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_sous_compte_charge`
--

CREATE TABLE `ha_sous_compte_charge` (
  `ID_S_COMPTE` int(11) NOT NULL,
  `ID_COMPTE_CHR` int(11) NOT NULL,
  `NUMERO` int(11) NOT NULL,
  `LIBELLE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_sous_compte_charge`
--

INSERT INTO `ha_sous_compte_charge` (`ID_S_COMPTE`, `ID_COMPTE_CHR`, `NUMERO`, `LIBELLE`, `MODE`) VALUES
(1, 1, 211, 'FRAIS DE RECHERCHE ET DE D&Eacute;VELOPPEMENT', 1),
(2, 1, 212, 'BREVETS, LICENCES, CONCESSIONS ET DROITS SIMILAIRES', 1),
(3, 1, 213, 'LOGICIELS', 1),
(4, 1, 214, 'MARQUES', 1),
(5, 1, 215, 'FONDS COMMERCIAL', 1),
(6, 1, 216, 'DROIT AU BAIL', 1),
(7, 1, 217, 'INVESTISSEMENTS DE CR&Eacute;ATION', 1),
(8, 1, 218, 'AUTRES DROITS ET VALEURS INCORPORELS', 1),
(9, 1, 219, 'IMMOBILISATIONS INCORPORELLES EN COURS', 1),
(10, 2, 221, 'TERRAINS AGRICOLES ET FORESTIERS', 1),
(11, 2, 222, 'TERRAINS NUS', 1),
(12, 2, 223, 'TERRAINS B&Acirc;TIS', 1),
(13, 2, 224, 'TRAVAUX DE MISE EN VALEUR DES TERRAINS', 1),
(14, 2, 225, 'TERRAINS DE GISEMENT', 1),
(15, 2, 226, 'TERRAINS AM&Eacute;NAG&Eacute;S', 1),
(16, 2, 227, 'TERRAINS MIS EN CONCESSION', 1),
(17, 2, 228, 'AUTRES TERRAINS', 1),
(18, 2, 229, 'AM&Eacute;NAGEMENTS DE TERRAINS EN COURS', 1),
(19, 3, 231, 'B&Acirc;TIMENTS INDUSTRIELS, AGRICOLES, ADMINISTRATIFS ET COMMERCIAUX SUR SOL PROPRE', 1),
(20, 3, 232, 'B&Acirc;TIMENTS INDUSTRIELS, AGRICOLES, ADMINISTRATIFS ET COMMERCIAUX SUR SOL D&rsquo;AUTRUI', 1),
(21, 3, 233, 'OUVRAGES D&rsquo;INFRASTRUCTURE', 1),
(22, 3, 234, 'INSTALLATIONS TECHNIQUES', 1),
(23, 3, 235, 'AMENAGEMENTS DE BUREAUX', 1),
(24, 3, 237, 'B&Acirc;TIMENTS INDUSTRIELS, AGRICOLES ET COMMERCIAUX MIS ENCONCESSION', 1),
(25, 3, 238, 'AUTRES INSTALLATIONS ET AGENCEMENTS', 1),
(26, 3, 239, 'B&Acirc;TIMENTS ET INSTALLATIONS EN COURS', 1),
(27, 4, 241, 'MAT&Eacute;RIEL ET OUTILLAGE INDUSTRIEL ET COMMERCIAL', 1),
(28, 4, 242, 'MAT&Eacute;RIEL ET OUTILLAGE AGRICOLE', 1),
(29, 4, 243, 'MAT&Eacute;RIEL D&rsquo;EMBALLAGE R&Eacute;CUP&Eacute;RABLE ET IDENTIFIABLE', 1),
(30, 4, 244, 'MAT&Eacute;RIEL ET MOBILIER', 1),
(31, 4, 245, 'MAT&Eacute;RIEL DE TRANSPORT', 1),
(32, 4, 246, 'IMMOBILISATIONS ANIMALES ET AGRICOLES', 1),
(33, 4, 247, 'AGENCEMENTS ET AM&Eacute;NAGEMENTS DU MAT&Eacute;RIEL', 1),
(34, 4, 248, 'AUTRES MAT&Eacute;RIELS', 1),
(35, 4, 249, 'MAT&Eacute;RIEL EN COURS', 1),
(36, 5, 601, 'ACHATS DE MARCHANDISES', 1),
(37, 5, 602, 'ACHATS DE MATIERES PREMIERES ET FOURNITURES LIEES', 1),
(38, 6, 604, 'MATI&Egrave;RES ET FOURNITURES CONSOMMABLES', 1),
(39, 7, 605, 'AUTRES ACHATS', 1),
(40, 7, 608, 'ACHATS D&rsquo;EMBALLAGES', 1),
(41, 8, 612, 'TRANSPORTS SUR VENTES', 1),
(42, 8, 613, 'TRANSPORTS POUR LE COMPTE DE TIERS', 1),
(43, 8, 614, 'TRANSPORTS DU PERSONNEL', 1),
(44, 8, 616, 'TRANSPORT DE PLIS', 1),
(45, 8, 618, 'AUTRES FRAIS DE TRANSPORT', 1),
(47, 9, 621, 'SOUS-TRAITANCE GENERALE', 1),
(48, 9, 622, 'LOCATIONS ET CHARGES LOCATIVES', 1),
(49, 9, 623, 'REDEVANCES DE LOCATION-FINANCEMENT ET CONTRATS ASSIMILES AVANT RETRAITEMENT (IMMOBILISATIONS/EMPRUNTS EQUIVALENTS)', 1),
(50, 9, 624, 'ENTRETIEN, R&Eacute;PARATIONS ET MAINTENANCE', 1),
(51, 9, 625, 'PRIMES D&rsquo;ASSURANCE', 1),
(52, 9, 626, 'ETUDES, RECHERCHES ET DOCUMENTATION', 1),
(53, 9, 627, 'PUBLICITE, PUBLICATIONS, RELATIONS PUBLIQUES', 1),
(54, 9, 628, 'FRAIS DE TELECOMMUNICATIONS', 1),
(55, 10, 631, 'FRAIS BANCAIRES', 1),
(56, 10, 632, 'R&Eacute;MUNERATIONS D&rsquo;INTERMEDIAIRES ET DE CONSEILS', 1),
(57, 10, 633, 'FRAIS DE FORMATION DU PERSONNEL', 1),
(58, 10, 634, 'REDEVANCES POUR BREVETS, LICENCES, lOGICIEL ET DROITS SIMILAIRES', 1),
(59, 10, 635, 'COTISATIONS', 1),
(60, 10, 637, 'REMUNERATIONS DE PERSONNEL EXTERIEUR A L&rsquo;ENTREPRISE', 1),
(61, 10, 638, 'AUTRES CHARGES EXTERNES', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_sous_domaine_activite`
--

CREATE TABLE `ha_sous_domaine_activite` (
  `ID_S_DOM` int(11) NOT NULL,
  `ID_DOM_A` int(11) NOT NULL,
  `ID_COMPTE_CHR` int(11) NOT NULL,
  `ID_S_COMPTE` int(11) NOT NULL,
  `LIBELLE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_sous_domaine_activite`
--

INSERT INTO `ha_sous_domaine_activite` (`ID_S_DOM`, `ID_DOM_A`, `ID_COMPTE_CHR`, `ID_S_COMPTE`, `LIBELLE`, `MODE`) VALUES
(1, 1, 1, 1, 'Frais De Recherche Et De D&eacute;veloppement', 1),
(2, 1, 1, 2, 'Brevets, Licences, Concessions Et Droits Similaires', 1),
(3, 1, 1, 3, 'Logiciels', 1),
(4, 1, 1, 4, 'Marques', 1),
(5, 1, 1, 5, 'Fonds Commercial', 1),
(6, 1, 1, 6, 'Droit Au Bail', 1),
(7, 1, 1, 7, 'Investissements De Cr&eacute;ation', 1),
(8, 1, 1, 8, 'Autres Droits Et Valeurs Incorporels', 1),
(9, 1, 1, 9, 'Immobilisations Incorporelles En Cours', 1),
(10, 2, 2, 10, 'Terrains Agricoles Et Forestiers', 1),
(11, 2, 2, 11, 'Terrains Nus', 1),
(12, 2, 2, 12, 'Terrains B&acirc;Tis', 1),
(13, 2, 2, 13, 'Travaux De Mise En Valeur Des Terrains', 1),
(14, 2, 2, 14, 'Terrains De Gisement', 1),
(15, 2, 2, 15, 'Terrains Am&eacute;Nag&eacute;s', 1),
(16, 2, 2, 16, 'Terrains Mis En Concession', 1),
(17, 2, 2, 17, 'Autres Terrains', 1),
(18, 2, 2, 18, 'Am&eacute;Nagements De Terrains En Cours', 1),
(19, 3, 3, 19, 'B&acirc;Timents Industriels, Agricoles, Administratifs Et Commerciaux Sur Sol Propre', 1),
(20, 3, 3, 20, 'B&acirc;Timents Industriels, Agricoles, Administratifs Et Commerciaux sur Sol D&rsquo;Autrui', 1),
(21, 3, 3, 21, 'Ouvrages D&rsquo;Infrastructure', 1),
(22, 3, 3, 22, 'Installations Techniques', 1),
(23, 3, 3, 23, 'Am&eacute;nagements De Bureaux', 1),
(24, 3, 3, 24, 'B&acirc;Timents Industriels, Agricoles Et Commerciaux Mis Enconc&eacute;ssion', 1),
(25, 3, 3, 25, 'Autres Installations Et Agencements', 1),
(26, 3, 3, 26, 'B&acirc;Timents Et Installations En Cours', 1),
(27, 4, 4, 27, 'Mat&eacute;Riel Et Outillage Industriel Et Commercial', 1),
(28, 4, 4, 28, 'Mat&eacute;Riel Et Outillage Agricole', 1),
(29, 4, 4, 29, 'Mat&eacute;Riel D&rsquo;Emballage R&eacute;Cup&eacute;Rable Et Identifiable', 1),
(30, 4, 4, 30, 'Mat&eacute;Riel Et Mobilier', 1),
(31, 4, 4, 31, 'Mat&eacute;Riel De Transport', 1),
(32, 4, 4, 32, 'Immobilisations Animales Et Agricoles', 1),
(33, 4, 4, 33, 'Agencements Et Am&eacute;Nagements Du Mat&eacute;Riel', 1),
(34, 4, 4, 34, 'Autres Mat&eacute;Riels', 1),
(35, 4, 4, 35, 'Mat&eacute;Riel En Cours', 1),
(36, 5, 5, 36, 'Achats De Marchandises', 1),
(37, 5, 5, 37, 'Achats De Mati&egrave;res Pr&eacute;mi&egrave;res Et Fournitures Li&eacute;es', 1),
(38, 6, 6, 38, 'Mati&egrave;Res Et Fournitures Consommables', 1),
(39, 7, 7, 39, 'Autres Achats', 1),
(40, 7, 7, 40, 'Achats D&rsquo;Emballages', 1),
(41, 8, 8, 41, 'Transports Sur Ventes', 1),
(42, 8, 8, 42, 'Transports Pour Le Compte De Tiers', 1),
(43, 8, 8, 43, 'Transports Du Personnel', 1),
(44, 8, 8, 44, 'Transport De Plis', 1),
(45, 8, 8, 45, 'Autres Frais De Transport', 1),
(46, 9, 9, 47, 'Sous-Traitance G&eacute;n&eacute;rale', 1),
(47, 9, 9, 48, 'Locations Et Charges Locatives', 1),
(48, 9, 9, 49, 'Redevances De Location-Financement Et Contrats Assimiles Avant Retraitement (Immobilisations/Emprunts Equivalents)', 1),
(49, 9, 9, 50, 'Entretien, R&eacute;Parations Et Maintenance', 1),
(50, 9, 9, 51, 'Primes D&rsquo;Assurance', 1),
(51, 9, 9, 52, 'Etudes, Recherches Et Documentation', 1),
(52, 9, 9, 53, 'Publicit&eacute;, Publications, Relations Publiques', 1),
(53, 9, 9, 54, 'Frais De T&eacute;l&eacute;communications', 1),
(54, 10, 10, 55, 'Frais Bancaires', 1),
(55, 10, 10, 56, 'R&eacute;Munerations D&rsquo;Intermediaires Et De Conseils', 1),
(56, 10, 10, 57, 'Frais De Formation Du Personnel', 1),
(57, 10, 10, 58, 'Redevances Pour Brevets, Licences, Logiciel Et Droits Similaires', 1),
(58, 10, 10, 59, 'Cotisations', 1),
(59, 10, 10, 60, 'R&eacute;mun&eacute;rations De Personnel Exterieur A L&rsquo;Entreprise', 1),
(60, 10, 10, 61, 'Autres Charges Externes', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_sous_sous_compte_charge`
--

CREATE TABLE `ha_sous_sous_compte_charge` (
  `ID_SS_COMPTE` int(11) NOT NULL,
  `ID_COMPTE_CHR` int(11) NOT NULL,
  `ID_S_COMPTE` int(11) NOT NULL,
  `NUMERO` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `LIBELLE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_sous_sous_compte_charge`
--

INSERT INTO `ha_sous_sous_compte_charge` (`ID_SS_COMPTE`, `ID_COMPTE_CHR`, `ID_S_COMPTE`, `NUMERO`, `LIBELLE`, `MODE`) VALUES
(1, 1, 1, '211', 'Frais de recherche et de d&eacute;veloppement', 1),
(2, 1, 2, '212', 'Brevets, Licences, Consession et Droit Similaires', 1),
(3, 1, 3, '213', 'Logiciels', 1),
(4, 1, 4, '214', 'Marques', 1),
(5, 1, 5, '215', 'Fonds Commercial', 1),
(6, 1, 6, '216', 'Droit au Bail', 1),
(7, 1, 7, '217', 'Investissement de cr&eacute;ation', 1),
(8, 1, 8, '218', 'Autres Droits et Valeurs Incorporels', 1),
(9, 1, 9, '2191', 'Frais de recherche et de d&eacute;veloppement', 1),
(10, 1, 9, '2193', 'Logiciels', 1),
(11, 1, 9, '2198', 'Autres droits et valeurs incorporels', 1),
(12, 2, 10, '2211', 'Terrains d&rsquo;exploitation agricole', 1),
(13, 2, 10, '2212', 'Terrains d&rsquo;exploitation foresti&egrave;re', 1),
(14, 2, 10, '2218', 'Autres terrains', 1),
(15, 2, 11, '2221', 'Terrains &agrave; b&acirc;tir', 1),
(16, 2, 11, '2228', 'Autres terrains nus', 1),
(17, 2, 12, '2231', 'B&acirc;timents industriels et agricoles', 1),
(18, 2, 12, '2232', 'B&acirc;timents administratifs et commerciaux', 1),
(19, 2, 12, '2234', 'B&acirc;timents affect&eacute;s aux autres op&eacute;rations professionnelles', 1),
(20, 2, 12, '2235', 'B&acirc;timents affect&eacute;s aux autres op&eacute;rations non professionnelles', 1),
(21, 2, 12, '2238', 'Autres terrains b&acirc;tis', 1),
(22, 2, 13, '2241', 'Plantation d&rsquo;arbres et d&rsquo;arbustes', 1),
(23, 2, 13, '2248', 'Autres travaux', 1),
(24, 2, 14, '2251', 'Carri&egrave;res', 1),
(25, 2, 15, '2261', 'Parkings', 1),
(26, 2, 16, '227', 'Terrains mis en Concession', 1),
(27, 2, 17, '2281', 'Terrains des immeubles de rapport', 1),
(28, 2, 17, '2285', 'Terrains des logements affect&eacute;s au personnel', 1),
(29, 2, 17, '2288', 'Autres terrains', 1),
(30, 2, 18, '2291', 'Terrains agricoles et forestiers', 1),
(31, 2, 18, '2292', 'Terrains nus', 1),
(32, 2, 18, '2295', 'Terrains de gisement', 1),
(33, 2, 18, '2298', 'Autres terrains', 1),
(34, 3, 19, '2311', 'B&acirc;timents industriels', 1),
(35, 3, 19, '2311x', 'B&acirc;timents industriels : Grosses r&eacute;parations', 1),
(36, 3, 19, '2311y', 'B&acirc;timents industriels : Inspections majeures', 1),
(37, 3, 19, '2312', 'B&acirc;timents agricoles', 1),
(38, 3, 19, '2312x', 'B&acirc;timents agricoles : Grosses r&eacute;parations', 1),
(39, 3, 19, '2312y', 'B&acirc;timents agricoles : Inspections majeures', 1),
(40, 3, 19, '2313', 'B&acirc;timents administratifs et commerciaux', 1),
(41, 3, 19, '2313x', 'B&acirc;timents administratifs et commerciaux : Grosses r&eacute;parations', 1),
(42, 3, 19, '2313y', 'B&acirc;timents administratifs et commerciaux : Inspections majeures', 1),
(43, 3, 19, '2314', 'B&acirc;timents affect&eacute;s au logement du personnel', 1),
(44, 3, 19, '2314x', 'B&acirc;timents affect&eacute;s au logement du personnel : Grosses r&eacute;parations', 1),
(45, 3, 19, '2314y', 'B&acirc;timents affect&eacute;s au logement du personnel : Inspections majeures', 1),
(46, 3, 19, '2315', 'Immeubles de rapport', 1),
(47, 3, 19, '2315x', 'Immeubles de rapport : Grosses r&eacute;parations', 1),
(48, 3, 19, '2315y', 'Immeubles de rapport : Inspections majeures', 1),
(49, 3, 20, '2321', 'B&acirc;timents industriels', 1),
(50, 3, 20, '2322', 'B&acirc;timents agricoles', 1),
(51, 3, 20, '2323', 'B&acirc;timents administratifs et commerciaux', 1),
(52, 3, 20, '2324', 'B&acirc;timents affect&eacute;s au logement du personnel', 1),
(53, 3, 20, '2325', 'Immeubles de rapport', 1),
(54, 3, 21, '2331', 'Voies de terre', 1),
(55, 3, 21, '2332', 'Voies de fer', 1),
(56, 3, 21, '2333', 'Voies d&rsquo;eau', 1),
(57, 3, 21, '2334', 'Barrages, Digues', 1),
(58, 3, 21, '2335', 'Pistes d&rsquo;aérodrome', 1),
(59, 3, 21, '2338', 'Autres', 1),
(60, 3, 22, '2341', 'Installations complexes sp&eacute;cialis&eacute;es sur sol propre', 1),
(61, 3, 22, '2342', 'Installations complexes sp&eacute;cialis&eacute;es sur sol d&rsquo;autrui', 1),
(62, 3, 22, '2343', 'Installations &agrave; caract&egrave;re sp&eacute;cifique sur sol propre', 1),
(63, 3, 22, '2344', 'Installations &agrave; caract&egrave;re sp&eacute;cifique sur sol d&rsquo;autrui', 1),
(64, 3, 23, '2351', 'Installations g&eacute;n&eacute;rales', 1),
(65, 3, 23, '2358', 'Autres', 1),
(66, 3, 24, '237', 'B&acirc;timents Industriels, Agricoles et Commerciaux mis en Concession', 1),
(67, 3, 25, '238', 'Autres Installations et Agencements', 1),
(68, 3, 26, '239', 'B&acirc;timents et Installations en cours', 1),
(69, 4, 27, '2411', 'Mat&eacute;riel industriel (1)', 1),
(70, 4, 27, '241181', 'Mat&eacute;riel industriel : Droits de mutations', 1),
(71, 4, 27, '241182', 'Mat&eacute;riel industriel : Commissions', 1),
(72, 4, 27, '241183', 'Mat&eacute;riel industriel : Frais d&rsquo;actes', 1),
(73, 4, 27, '241184', 'Mat&eacute;riel industriel : Honoraires  ', 1),
(74, 4, 27, '241188', 'Mat&eacute;riel industriel : Autres frais accessoires ', 1),
(75, 4, 27, '2412', 'Outillage industriel', 1),
(76, 4, 27, '2413', 'Mat&eacute;riel commercial', 1),
(77, 4, 27, '2414', 'Outillage commercial (1)', 1),
(78, 4, 27, '241481', 'Outillage commercial : Droits de mutations', 1),
(79, 4, 27, '241482', 'Outillage commercial : Commissions', 1),
(80, 4, 27, '241483', 'Outillage commercial : Frais d&rsquo;actes', 1),
(81, 4, 27, '241484', 'Outillage commercial : Honoraires', 1),
(82, 4, 27, '241488', 'Outillage commercial : Autres frais accessoires', 1),
(83, 4, 28, '2421', 'Mat&eacute;riel agricole', 1),
(84, 4, 28, '2422', 'Outillage agricole', 1),
(85, 4, 29, '243', 'Mat&eacute;riel d&rsquo;emballage r&eacute;cup&eacute;rable et identifiable', 1),
(86, 4, 30, '2441', 'Mat&eacute;riel de bureau', 1),
(87, 4, 30, '2442', 'Mat&eacute;riel informatique', 1),
(88, 4, 30, '2443', 'Mat&eacute;riel bureautique', 1),
(89, 4, 30, '2444', 'Mobilier de bureau', 1),
(90, 4, 30, '2446', 'Mat&eacute;riel et mobilier des immeubles de rapport', 1),
(91, 4, 30, '2447', 'Mat&eacute;riel et mobilier des logements du personnel', 1),
(92, 4, 31, '2451', 'Mat&eacute;riel automobile', 1),
(93, 4, 31, '2452', 'Mat&eacute;riel ferroviaire', 1),
(94, 4, 31, '2453', 'Mat&eacute;riel fluvial, lagunaire', 1),
(95, 4, 31, '2454', 'Mat&eacute;riel naval', 1),
(96, 4, 31, '2455', 'Mat&eacute;riel a&eacute;rien', 1),
(97, 4, 31, '2456', 'Mat&eacute;riel hippomobile', 1),
(98, 4, 31, '2458', 'Autres (v&eacute;lo, mobylette, moto)', 1),
(99, 4, 32, '2461', 'Cheptel, animaux de trait', 1),
(100, 4, 32, '2462', 'Cheptel, animaux reproducteurs', 1),
(101, 4, 32, '2463', 'Animaux de garde', 1),
(102, 4, 32, '2465', 'Plantations agricoles', 1),
(103, 4, 32, '2468', 'Autres', 1),
(104, 4, 33, '247', 'Agencements et Am&eacute;nagements du Mat&eacute;riel', 1),
(105, 4, 34, '2481', 'Collections et &oelig;uvres d&rsquo;art', 1),
(106, 4, 35, '2491', 'Mat&eacute;riel et outillage industriel et commercial', 1),
(107, 4, 35, '2492', 'Mat&eacute;riel et outillage agricole', 1),
(108, 4, 35, '2493', 'Mat&eacute;riel d&rsquo;emballage r&eacute;cup&eacute;rable et identifiable', 1),
(109, 4, 35, '2494', 'Mat&eacute;riel et mobilier de bureau', 1),
(110, 4, 35, '2495', 'Mat&eacute;riel de transport', 1),
(111, 4, 35, '2496', 'Immobilisations animales et agricoles', 1),
(112, 4, 35, '2497', 'Agencements et am&eacute;nagements du mat&eacute;riel', 1),
(113, 4, 35, '2498', 'Autres mat&eacute;riel', 1),
(114, 5, 36, '6011', 'Dans la R&eacute;gion', 1),
(115, 5, 36, '6012', 'Hors R&eacute;gion', 1),
(116, 5, 36, '6013', 'Aux Entreprises du groupe dans la R&eacute;gion', 1),
(117, 5, 36, '6014', 'Aux Entreprises du groupe hors R&eacute;gion', 1),
(118, 5, 36, '6015', 'Frais sur achats', 1),
(119, 5, 36, '60151', 'Frais sur achats : Droits de douane', 1),
(120, 5, 36, '60152', 'Frais sur achats : Frets et transports sur achats', 1),
(121, 5, 36, '60153', 'Frais sur achats : Assurances transport sur achats', 1),
(122, 5, 36, '60154', 'Frais sur achats : Commissions et courtages sur achats', 1),
(123, 5, 36, '60155', 'Frais sur achats : Frais de transit', 1),
(124, 5, 36, '60158', 'Frais sur achats : Autres frais accessoires sur achats', 1),
(125, 5, 37, '6021', 'Dans la R&eacute;gion', 1),
(126, 5, 37, '6022', 'Hors R&eacute;gion', 1),
(127, 5, 37, '6023', 'Aux Entreprises du groupe dans la R&eacute;gion', 1),
(128, 5, 37, '6024', 'Aux Entreprises du groupe hors R&eacute;gion', 1),
(129, 5, 37, '6025', 'Frais sur achats ', 1),
(130, 5, 37, '60251', 'Frais sur achats : Droits de douane', 1),
(131, 5, 37, '60252', 'Frais sur achats : Frets et transports sur achats', 1),
(132, 5, 37, '60253', 'Frais sur achats : Assurances transport sur achats', 1),
(133, 5, 37, '60254', 'Frais sur achats : Commissions et courtages sur achats', 1),
(134, 5, 37, '60255', 'Frais sur achats : Frais de transit', 1),
(135, 5, 37, '60258', 'Frais sur achats : Autres frais accessoires sur achats', 1),
(136, 6, 38, '6041', 'Mati&egrave;res consommables', 1),
(137, 6, 38, '6042', 'Mati&egrave;res combustibles', 1),
(138, 6, 38, '6043', 'Produits d&rsquo;entretien', 1),
(139, 6, 38, '6044', 'Fournitures d&rsquo;atelier et d&rsquo;usine', 1),
(140, 6, 38, '6045', 'Frais sur achats ', 1),
(141, 6, 38, '60451', 'Frais sur achats : Droits de douane', 1),
(142, 6, 38, '60452', 'Frais sur achats : Frets et transports sur achats', 1),
(143, 6, 38, '60453', 'Frais sur achats : Assurances transport sur achats', 1),
(144, 6, 38, '60454', 'Frais sur achats : Commissions et courtages sur achats', 1),
(145, 6, 38, '60455', 'Frais sur achats : Frais de transit', 1),
(146, 6, 38, '60458', 'Frais sur achats : Autres frais accessoires sur achats', 1),
(147, 6, 38, '6046', 'Fournitures de magasin', 1),
(148, 6, 38, '6047', 'Fournitures de bureau', 1),
(149, 6, 38, '6049', 'Rabais, Remises et Ristournes obtenus (non ventil&eacute;s)', 1),
(150, 7, 39, '6051', 'Fournitures non stockables-Eau', 1),
(151, 7, 39, '6052', 'Fournitures non stockables- Electricit&eacute;', 1),
(152, 7, 39, '6053', 'Fournitures non stockables- Autres &eacute;nergies', 1),
(153, 7, 39, '6054', 'Fournitures d&rsquo;entretien non stockables', 1),
(154, 7, 39, '6055', 'Fournitures de bureau non stockables', 1),
(155, 7, 39, '6056', 'Achats de petit mat&eacute;riel et outillage', 1),
(156, 7, 39, '6057', 'Achats d&rsquo;&eacute;tudes et prestations de service', 1),
(157, 7, 39, '6058', 'Achats de travaux, mat&eacute;riels et &eacute;quipements', 1),
(158, 7, 40, '6081', 'Emballages perdus', 1),
(159, 7, 40, '6082', 'Emballages r&eacute;cup&eacute;rables non identifiables', 1),
(160, 7, 40, '6083', 'Emballages &agrave; usage mixte', 1),
(161, 8, 41, '612', 'Transports sur Ventes', 1),
(162, 8, 42, '613', 'Transports pour le Compte de Tiers', 1),
(163, 8, 43, '614', 'Transports du Personnel', 1),
(164, 8, 44, '616', 'Transport de Plis', 1),
(165, 8, 45, '6181', 'Voyages et d&eacute;placements', 1),
(166, 8, 45, '6182', 'Transports entre &eacute;tablissements ou chantiers', 1),
(167, 8, 45, '6183', 'Transports administratifs', 1),
(168, 9, 47, '621', 'Sous-traitance G&eacute;n&eacute;rale', 1),
(169, 9, 48, '6221', 'Locations de terrains', 1),
(170, 9, 48, '6222', 'Locations de b&acirc;timents', 1),
(171, 9, 48, '6223', 'Locations de mat&eacute;riels et outillages', 1),
(172, 9, 48, '6224', 'Malis sur emballages', 1),
(173, 9, 48, '6225', 'Locations d&rsquo;emballages', 1),
(174, 9, 48, '6228', 'Locations et charges locatives diverses', 1),
(175, 9, 49, '6232', 'Location-financement immobili&egrave;re', 1),
(176, 9, 49, '6233', 'Location-financement  mobili&egrave;re', 1),
(177, 9, 49, '6235', 'Contrats assimil&eacute;s', 1),
(178, 9, 50, '6241', 'Entretien et r&eacute;parations des biens immobiliers', 1),
(179, 9, 50, '6242', 'Entretien et r&eacute;parations des biens mobiliers', 1),
(180, 9, 50, '6243', 'Maintenance', 1),
(181, 9, 50, '6248', 'Autres entretiens et r&eacute;parations', 1),
(182, 9, 51, '6251', 'Assurances multirisques', 1),
(183, 9, 51, '6252', 'Assurances mat&eacute;riel de transport', 1),
(184, 9, 51, '6253', 'Assurances risques d&rsquo;exploitation', 1),
(185, 9, 51, '6254', 'Assurances responsabilit&eacute; du producteur', 1),
(186, 9, 51, '6255', 'Assurances insolvabilit&eacute; clients', 1),
(187, 9, 51, '6256', 'Assurances transports sur achats', 1),
(188, 9, 51, '6257', 'Assurances transports sur ventes', 1),
(189, 9, 51, '6258', 'Autres primes d&rsquo;assurances', 1),
(190, 9, 52, '6261', 'Etudes et recherches', 1),
(191, 9, 52, '6265', 'Documentation g&eacute;n&eacute;rale', 1),
(192, 9, 52, '6266', 'Documentation technique', 1),
(193, 9, 53, '6271', 'Annonces, insertions', 1),
(194, 9, 53, '6272', 'Catalogues, imprim&eacute;s publicitaires', 1),
(195, 9, 53, '6273', 'Echantillons', 1),
(196, 9, 53, '6274', 'Foires et expositions', 1),
(197, 9, 53, '6275', 'Publications', 1),
(198, 9, 53, '6276', 'Cadeaux à la client&egrave;le', 1),
(199, 9, 53, '6277', 'Frais de colloques, s&eacute;minaires, conf&eacute;rences', 1),
(200, 9, 53, '6278', 'Autres charges de publicit&eacute; et relations publiques', 1),
(201, 9, 54, '6281', 'Frais de t&eacute;l&eacute;phone', 1),
(202, 9, 54, '6282', 'Frais de t&eacute;lex', 1),
(203, 9, 54, '6283', 'Frais de t&eacute;l&eacute;copie', 1),
(204, 9, 54, '6288', 'Autres frais de t&eacute;l&eacute;communications', 1),
(205, 10, 55, '6311', 'Frais sur titres (achat, vente, garde)', 1),
(206, 10, 55, '6312', 'Frais sur effets', 1),
(207, 10, 55, '6313', 'Location de coffres', 1),
(208, 10, 55, '6315', 'Commissions sur cartes de cr&eacute;dit', 1),
(209, 10, 55, '6316', 'Frais d&rsquo;&eacute;mission d&rsquo;emprunts', 1),
(210, 10, 55, '6318', 'Autres frais bancaires', 1),
(211, 10, 56, '6322', 'Commissions et courtages sur achats', 1),
(212, 10, 56, '6324', 'Honoraires', 1),
(213, 10, 56, '6325', 'Frais d&rsquo;actes et de contentieux', 1),
(214, 10, 56, '6328', 'Divers frais', 1),
(215, 10, 57, '633', 'Frais de Formation du Personnel', 1),
(216, 10, 58, '6342', 'Redevances pour brevets, licences, concessions et droits similaires', 1),
(217, 10, 58, '6343', 'Redevances pour logiciels', 1),
(218, 10, 58, '6344', 'Redevances pour marques', 1),
(219, 10, 59, '6351', 'Cotisations', 1),
(220, 10, 59, '6358', 'Concours divers', 1),
(221, 10, 60, '6371', 'Personnel int&eacute;rimaire', 1),
(222, 10, 60, '6372', 'Personnel d&eacute;tach&eacute; ou pr&ecirc;t&eacute; &agrave; l&rsquo;entreprise', 1),
(223, 10, 61, '6381', 'Frais de recrutement du personnel', 1),
(224, 10, 61, '6382', 'Frais de d&eacute;m&eacute;nagement', 1),
(225, 10, 61, '6383', 'R&eacute;ceptions', 1),
(226, 10, 61, '6384', 'Missions', 1),
(227, 10, 61, '6388', 'Autres services divers', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_sujet_agrement`
--

CREATE TABLE `ha_sujet_agrement` (
  `ID_SUJ_A` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `ID_AGR` int(11) NOT NULL,
  `LIBELLE` text COLLATE utf8_unicode_ci NOT NULL,
  `CATEGORIE` text COLLATE utf8_unicode_ci NOT NULL,
  `DETAILS` text COLLATE utf8_unicode_ci NOT NULL,
  `COMMENT` int(11) NOT NULL,
  `VUE` int(11) NOT NULL,
  `CREER_PAR` text COLLATE utf8_unicode_ci NOT NULL,
  `CREER_LE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODIFIER_LE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ha_sujet_consultation`
--

CREATE TABLE `ha_sujet_consultation` (
  `ID_SUJ_O` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `ID_APPEL` int(11) NOT NULL,
  `LIBELLE` text COLLATE utf8_unicode_ci NOT NULL,
  `CATEGORIE` text COLLATE utf8_unicode_ci NOT NULL,
  `DETAILS` text COLLATE utf8_unicode_ci NOT NULL,
  `COMMENT` int(11) NOT NULL,
  `VUE` int(11) NOT NULL,
  `CREER_PAR` text COLLATE utf8_unicode_ci NOT NULL,
  `CREER_LE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODIFIER_LE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ha_type_offre`
--

CREATE TABLE `ha_type_offre` (
  `ID_TYPE_O` int(11) NOT NULL,
  `LIBELLE` text COLLATE utf8_unicode_ci NOT NULL,
  `CREER_PAR` text COLLATE utf8_unicode_ci NOT NULL,
  `CREER_LE` text COLLATE utf8_unicode_ci NOT NULL,
  `MODIFIER_PAR` text COLLATE utf8_unicode_ci,
  `MODIFIER_LE` text COLLATE utf8_unicode_ci,
  `MODE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ha_type_offre`
--

INSERT INTO `ha_type_offre` (`ID_TYPE_O`, `LIBELLE`, `CREER_PAR`, `CREER_LE`, `MODIFIER_PAR`, `MODIFIER_LE`, `MODE`) VALUES
(1, 'Achat Produits &amp; Mat&eacute;riels STD', 'Junior MAMADOU', '2017-03-16 03:26:40', NULL, NULL, 1),
(2, 'Achat Prestation Intellectuelle', 'Junior MAMADOU', '2017-03-16 03:26:40', NULL, NULL, 1),
(3, 'Achat Imports', 'Junior MAMADOU', '2017-03-16 03:26:40', NULL, NULL, 1),
(4, 'Achat Projets', 'Junior MAMADOU', '2017-03-16 03:26:40', NULL, NULL, 1),
(5, 'Achat BTP', 'Junior MAMADOU', '2017-03-16 03:26:40', NULL, NULL, 1),
(6, 'Achat Services G&eacute;n&eacute;raux', 'Junior MAMADOU', '2017-03-16 03:26:40', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `UUID` int(11) NOT NULL,
  `ID_CMPT` int(11) NOT NULL,
  `TIMES` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`UUID`, `ID_CMPT`, `TIMES`) VALUES
(1, 1, '1561720959'),
(2, 1, '1561720994'),
(3, 1, '1561721027');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ha_agrees`
--
ALTER TABLE `ha_agrees`
  ADD PRIMARY KEY (`ID_AGRE`);

--
-- Indexes for table `ha_alert`
--
ALTER TABLE `ha_alert`
  ADD PRIMARY KEY (`ID_ALT`);

--
-- Indexes for table `ha_annexe_contrat`
--
ALTER TABLE `ha_annexe_contrat`
  ADD PRIMARY KEY (`ID_ANEX`);

--
-- Indexes for table `ha_appel_offre`
--
ALTER TABLE `ha_appel_offre`
  ADD PRIMARY KEY (`ID_APPEL`);

--
-- Indexes for table `ha_article_cataloguer`
--
ALTER TABLE `ha_article_cataloguer`
  ADD PRIMARY KEY (`ID_ART_CAT`);

--
-- Indexes for table `ha_avenant_contrat`
--
ALTER TABLE `ha_avenant_contrat`
  ADD PRIMARY KEY (`ID_AVENANT`);

--
-- Indexes for table `ha_bon_commande`
--
ALTER TABLE `ha_bon_commande`
  ADD PRIMARY KEY (`ID_BC`);

--
-- Indexes for table `ha_catalogue_four`
--
ALTER TABLE `ha_catalogue_four`
  ADD PRIMARY KEY (`ID_CAT_FRS`);

--
-- Indexes for table `ha_chiffre_affaire_four`
--
ALTER TABLE `ha_chiffre_affaire_four`
  ADD PRIMARY KEY (`ID_CA_FRS`);

--
-- Indexes for table `ha_close_confidentialite`
--
ALTER TABLE `ha_close_confidentialite`
  ADD PRIMARY KEY (`ID_CLOSE`);

--
-- Indexes for table `ha_compte_charge`
--
ALTER TABLE `ha_compte_charge`
  ADD PRIMARY KEY (`ID_COMPTE_CHR`);

--
-- Indexes for table `ha_compte_fournisseur`
--
ALTER TABLE `ha_compte_fournisseur`
  ADD PRIMARY KEY (`ID_CMPT`);

--
-- Indexes for table `ha_connecter`
--
ALTER TABLE `ha_connecter`
  ADD PRIMARY KEY (`ID_CTE`);

--
-- Indexes for table `ha_contact_four`
--
ALTER TABLE `ha_contact_four`
  ADD PRIMARY KEY (`ID_CNT_FRS`);

--
-- Indexes for table `ha_contrat`
--
ALTER TABLE `ha_contrat`
  ADD PRIMARY KEY (`ID_CONTRAT`);

--
-- Indexes for table `ha_demande_agrement`
--
ALTER TABLE `ha_demande_agrement`
  ADD PRIMARY KEY (`ID_AGR`);

--
-- Indexes for table `ha_detail_article_cataloguer`
--
ALTER TABLE `ha_detail_article_cataloguer`
  ADD PRIMARY KEY (`ID_DET_ART`);

--
-- Indexes for table `ha_detail_compte_four`
--
ALTER TABLE `ha_detail_compte_four`
  ADD PRIMARY KEY (`ID_DET_FRS`);

--
-- Indexes for table `ha_document_facture`
--
ALTER TABLE `ha_document_facture`
  ADD PRIMARY KEY (`ID_DOC_F`);

--
-- Indexes for table `ha_document_fournir_agrement`
--
ALTER TABLE `ha_document_fournir_agrement`
  ADD PRIMARY KEY (`ID_DOC_D`);

--
-- Indexes for table `ha_document_fournir_appel`
--
ALTER TABLE `ha_document_fournir_appel`
  ADD PRIMARY KEY (`ID_DOC_A`);

--
-- Indexes for table `ha_domaine_activite`
--
ALTER TABLE `ha_domaine_activite`
  ADD PRIMARY KEY (`ID_DOM_A`);

--
-- Indexes for table `ha_fournisseur_consulte_appel`
--
ALTER TABLE `ha_fournisseur_consulte_appel`
  ADD PRIMARY KEY (`ID_CONSF`);

--
-- Indexes for table `ha_grille_cotation_btp`
--
ALTER TABLE `ha_grille_cotation_btp`
  ADD PRIMARY KEY (`ID_GRC_BTP`);

--
-- Indexes for table `ha_grille_cotation_imp`
--
ALTER TABLE `ha_grille_cotation_imp`
  ADD PRIMARY KEY (`ID_GRC_IMP`);

--
-- Indexes for table `ha_grille_cotation_pi`
--
ALTER TABLE `ha_grille_cotation_pi`
  ADD PRIMARY KEY (`ID_GRC_PI`);

--
-- Indexes for table `ha_grille_cotation_prj`
--
ALTER TABLE `ha_grille_cotation_prj`
  ADD PRIMARY KEY (`ID_GRC_PRJ`);

--
-- Indexes for table `ha_grille_cotation_sg`
--
ALTER TABLE `ha_grille_cotation_sg`
  ADD PRIMARY KEY (`ID_GRC_SG`);

--
-- Indexes for table `ha_grille_cotation_std`
--
ALTER TABLE `ha_grille_cotation_std`
  ADD PRIMARY KEY (`ID_GRC_STD`);

--
-- Indexes for table `ha_identification_four`
--
ALTER TABLE `ha_identification_four`
  ADD PRIMARY KEY (`ID_IDT_FRS`);

--
-- Indexes for table `ha_pieces_agrement`
--
ALTER TABLE `ha_pieces_agrement`
  ADD PRIMARY KEY (`ID_PIECE`);

--
-- Indexes for table `ha_pieces_fournir_agrement`
--
ALTER TABLE `ha_pieces_fournir_agrement`
  ADD PRIMARY KEY (`ID_PIECE_FD`);

--
-- Indexes for table `ha_pieces_fournir_appel`
--
ALTER TABLE `ha_pieces_fournir_appel`
  ADD PRIMARY KEY (`ID_PIECE_FA`);

--
-- Indexes for table `ha_position_commerciale_four`
--
ALTER TABLE `ha_position_commerciale_four`
  ADD PRIMARY KEY (`ID_PC_FRS`);

--
-- Indexes for table `ha_postuler`
--
ALTER TABLE `ha_postuler`
  ADD PRIMARY KEY (`ID_POSTULER_D`);

--
-- Indexes for table `ha_postuler_offre`
--
ALTER TABLE `ha_postuler_offre`
  ADD PRIMARY KEY (`ID_POSTULE_O`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`UUID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ha_agrees`
--
ALTER TABLE `ha_agrees`
  MODIFY `ID_AGRE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ha_alert`
--
ALTER TABLE `ha_alert`
  MODIFY `ID_ALT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ha_annexe_contrat`
--
ALTER TABLE `ha_annexe_contrat`
  MODIFY `ID_ANEX` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ha_appel_offre`
--
ALTER TABLE `ha_appel_offre`
  MODIFY `ID_APPEL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ha_article_cataloguer`
--
ALTER TABLE `ha_article_cataloguer`
  MODIFY `ID_ART_CAT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `ha_avenant_contrat`
--
ALTER TABLE `ha_avenant_contrat`
  MODIFY `ID_AVENANT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ha_bon_commande`
--
ALTER TABLE `ha_bon_commande`
  MODIFY `ID_BC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ha_catalogue_four`
--
ALTER TABLE `ha_catalogue_four`
  MODIFY `ID_CAT_FRS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ha_chiffre_affaire_four`
--
ALTER TABLE `ha_chiffre_affaire_four`
  MODIFY `ID_CA_FRS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ha_close_confidentialite`
--
ALTER TABLE `ha_close_confidentialite`
  MODIFY `ID_CLOSE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ha_compte_charge`
--
ALTER TABLE `ha_compte_charge`
  MODIFY `ID_COMPTE_CHR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ha_compte_fournisseur`
--
ALTER TABLE `ha_compte_fournisseur`
  MODIFY `ID_CMPT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ha_connecter`
--
ALTER TABLE `ha_connecter`
  MODIFY `ID_CTE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ha_contact_four`
--
ALTER TABLE `ha_contact_four`
  MODIFY `ID_CNT_FRS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ha_contrat`
--
ALTER TABLE `ha_contrat`
  MODIFY `ID_CONTRAT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ha_demande_agrement`
--
ALTER TABLE `ha_demande_agrement`
  MODIFY `ID_AGR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ha_detail_article_cataloguer`
--
ALTER TABLE `ha_detail_article_cataloguer`
  MODIFY `ID_DET_ART` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=350;

--
-- AUTO_INCREMENT for table `ha_detail_compte_four`
--
ALTER TABLE `ha_detail_compte_four`
  MODIFY `ID_DET_FRS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ha_document_facture`
--
ALTER TABLE `ha_document_facture`
  MODIFY `ID_DOC_F` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ha_document_fournir_agrement`
--
ALTER TABLE `ha_document_fournir_agrement`
  MODIFY `ID_DOC_D` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ha_document_fournir_appel`
--
ALTER TABLE `ha_document_fournir_appel`
  MODIFY `ID_DOC_A` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ha_domaine_activite`
--
ALTER TABLE `ha_domaine_activite`
  MODIFY `ID_DOM_A` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ha_fournisseur_consulte_appel`
--
ALTER TABLE `ha_fournisseur_consulte_appel`
  MODIFY `ID_CONSF` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ha_grille_cotation_btp`
--
ALTER TABLE `ha_grille_cotation_btp`
  MODIFY `ID_GRC_BTP` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ha_grille_cotation_imp`
--
ALTER TABLE `ha_grille_cotation_imp`
  MODIFY `ID_GRC_IMP` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ha_grille_cotation_pi`
--
ALTER TABLE `ha_grille_cotation_pi`
  MODIFY `ID_GRC_PI` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ha_grille_cotation_prj`
--
ALTER TABLE `ha_grille_cotation_prj`
  MODIFY `ID_GRC_PRJ` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ha_grille_cotation_sg`
--
ALTER TABLE `ha_grille_cotation_sg`
  MODIFY `ID_GRC_SG` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ha_grille_cotation_std`
--
ALTER TABLE `ha_grille_cotation_std`
  MODIFY `ID_GRC_STD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ha_identification_four`
--
ALTER TABLE `ha_identification_four`
  MODIFY `ID_IDT_FRS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ha_pieces_agrement`
--
ALTER TABLE `ha_pieces_agrement`
  MODIFY `ID_PIECE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ha_pieces_fournir_agrement`
--
ALTER TABLE `ha_pieces_fournir_agrement`
  MODIFY `ID_PIECE_FD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ha_pieces_fournir_appel`
--
ALTER TABLE `ha_pieces_fournir_appel`
  MODIFY `ID_PIECE_FA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ha_position_commerciale_four`
--
ALTER TABLE `ha_position_commerciale_four`
  MODIFY `ID_PC_FRS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ha_postuler`
--
ALTER TABLE `ha_postuler`
  MODIFY `ID_POSTULER_D` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ha_postuler_offre`
--
ALTER TABLE `ha_postuler_offre`
  MODIFY `ID_POSTULE_O` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `UUID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
