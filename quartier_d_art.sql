-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Sam 30 Juin 2012 à 17:14
-- Version du serveur: 5.1.44
-- Version de PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `quartier_d_art`
--

-- --------------------------------------------------------

--
-- Structure de la table `artistes`
--

CREATE TABLE IF NOT EXISTS `artistes` (
  `surnom` text NOT NULL,
  `fonction` varchar(64) NOT NULL,
  `texte` varchar(10000) NOT NULL,
  `id` int(11) NOT NULL,
  `extension` text NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Contenu de la table `artistes`
--

INSERT INTO `artistes` (`surnom`, `fonction`, `texte`, `id`, `extension`) VALUES
('Brigitte Sibille', '', 'Brigitte Sibille a passé une bonne partie de son enfance à l''étranger d''où elle rapporte un monde de couleurs et de contrastes. Après une formation d''Architecte (DPLG, Paris, ENSBA) elle va résider deux ans à New York où elle va compléter sa formation artistique en démarrant ses premières toiles à l''huile. Elle y récolte une importante iconographie personnelle de photos et croquis, mêlés de personnages insolites qui vont donner le jour à ses toiles sur New York, à ses "Homm''Arts". et bien d''autres, la plus récente étant les Racines Carrées, aquarelles et huiles.. \r\nAprès une série d''expositions individuelles, elle ouvre son atelier à Paris en 2004 qui se trouve actuellement au Pont Mirabeau, derriere une grande vitrine du bel immeuble classé de Bassompierre (1936) au 1 rue Balard : de nombreux artistes amateurs peuvent y suivre un enseignement original sur le mode des ateliers traditionnels, tous âges et talents confondus.', 1, 'jpg'),
('JepCo', '', 'Photographe et compositeur numérique, JepCo passe la majorité de sa vie professionnelle à voyager pour ses affaires. Délaissant souvent les parcours traditionnels, il arpente les banlieues, les routes perdues, les casses de train et d''autos.\r\nDes centaines de photos de paysages sauvages, d''épaves, voire de simples morceaux de métal oublié se sont accumulées au fil des ans, constituant une documentation abondante et décalée, venant de toute la planète. \r\nJepCo exploite maintenant ce trésor en idéalisant ses souvenirs à l''aide de la technologie actuelle. Ses oeuvres, mélange d''authenticité et de composition numérique, nous restituent la charge de rêve que contiennent tous ces objets délaissés par les hommes.\r\nSa collection RETOUR VERS LE NEANT exposée pour la 1ere fois à Paris en 2007 a déjà fait l''objet aujourd''hui de plusieurs parutions dans la presse.\r\nPlus récemment "LA CAISSE A JOUETS" a mérité aussi un salut de la presse spécialisée : l''artiste exposera à nouveau en 2012 dans la belle galerie Quartier d''Art au Pont Mirabeau qui est aussi l''école de Peinture de Brigitte Sibille.', 2, 'jpg');

-- --------------------------------------------------------

--
-- Structure de la table `ateliers`
--

CREATE TABLE IF NOT EXISTS `ateliers` (
  `titre` text NOT NULL,
  `sousTitre` text NOT NULL,
  `texte` text NOT NULL,
  `id` int(11) NOT NULL,
  `extension` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ateliers`
--

INSERT INTO `ateliers` (`titre`, `sousTitre`, `texte`, `id`, `extension`) VALUES
('Sculpture', 'Cours confié à Bernadette KANTER, artiste sculpteur', 'Tout commence avec la terre.\r\nAvec ou sans dessin, les mains donnent la forme et créent l''harmonie des lignes et des volumes.\r\nPuis les élèves abordent l''édition de leur oeuvre. Celle-ci peut rester en terre, cuite ou juste séchée. Au delà, on peut créer le moule, puis couler une résine, enfin, au sommet de cet art, parfaitement maîtrisé par Bernadette Kanter, une oeuvre en bronze.\r\n\r\nDans l''atelier Quartier d''Art, en plein jour, sur des selles de tables ou en pied, les élèves démarrent chacun à leur rythme puis progressent semaine après semaine.\r\n\r\nEn complément, la galerie Quartier d''Art, dans les mêmes lieux, avec ses dix mètres de vitrine face au Pont Mirabeau, se prête parfaitement à  des expositions temporaires des oeuvres du maître  et des élèves.\r\n', 2, 'jpg'),
('Aquarelle', '', 'Du latin "aqua" (en latin "eau"), l''aquarelle à l''origine est une technique de restitution de la réalité (art dit figuratif), légère et rapide, avant l''apparition de l''appareil photo. Avec de toutes petites quantités de pigments secs et un peu d''eau, un pinceau épais pour imbiber le papier (couleurs dites "pastels", ciels, horizons etc..) et un pinceau fin pour restituer les lignes de paysages, constructions ou personnages, l''artiste observe et reproduit l''essentiel pour le montrer à son retour. (carnets de voyage, dessins d''architecture, de sciences naturelles etc..) A l''atelier Quartier d''Art, tout en vous présentant dans la bibliothèque de merveilleux exemples d''aquarelles traditionnelles (Turner à Venise..) on privilégiera la technique pure, comment laisser l''eau travailler la couleur, en précision ou en gouttes, en fondus... avec des lignes imaginaires, sans négliger les oeuvres dessinées pour les experts en dessin, bien entendu.', 1, 'jpg');

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

CREATE TABLE IF NOT EXISTS `evenements` (
  `titre` text NOT NULL,
  `sousTitre` text NOT NULL,
  `descriptif` text NOT NULL,
  `permanent` int(1) NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `extension` text NOT NULL,
  `id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Contenu de la table `evenements`
--

INSERT INTO `evenements` (`titre`, `sousTitre`, `descriptif`, `permanent`, `dateDebut`, `dateFin`, `extension`, `id`) VALUES
('Exposition : Art Numérique', 'Jacques Gérard', 'Art numéral ou art numérique ?...', 0, '2012-06-01', '2012-07-01', 'jpg', 1),
('Exposition : Art Culinaire', 'Niko', 'Niko revisite l''art culinaire japonais. Un régal pour les yeux et les papilles !', 1, '0000-00-00', '0000-00-00', 'jpg', 2);

-- --------------------------------------------------------

--
-- Structure de la table `formats`
--

CREATE TABLE IF NOT EXISTS `formats` (
  `format` varchar(64) CHARACTER SET utf8 NOT NULL,
  `type` varchar(64) CHARACTER SET utf8 NOT NULL,
  `largeur` int(11) NOT NULL,
  `hauteur` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=ucs2 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `formats`
--

INSERT INTO `formats` (`format`, `type`, `largeur`, `hauteur`, `prix`, `id`) VALUES
('standard', 'figure', 22, 16, 39, 1),
('carre', '', 15, 15, 39, 2),
('standard', 'paysage', 22, 14, 39, 3),
('standard', 'marine', 22, 12, 39, 4),
('carre', 'NC', 20, 20, 39, 14),
('standard', 'figure', 24, 19, 39, 10),
('standard', 'paysage', 24, 16, 39, 11),
('standard', 'marine', 24, 14, 39, 12),
('standard', 'figure', 27, 22, 45, 16),
('standard', 'paysage', 27, 19, 45, 17),
('standard', 'marine', 27, 16, 45, 18),
('carre', 'NC', 30, 30, 59, 19),
('carre', 'NC', 40, 40, 135, 20),
('standard', 'figure', 33, 24, 45, 21),
('standard', 'paysage', 33, 22, 45, 22),
('standard', 'marine', 33, 19, 45, 23);

-- --------------------------------------------------------

--
-- Structure de la table `jqcalendar`
--

CREATE TABLE IF NOT EXISTS `jqcalendar` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Subject` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `Location` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `Description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `StartTime` datetime DEFAULT NULL,
  `EndTime` datetime DEFAULT NULL,
  `IsAllDayEvent` smallint(6) NOT NULL,
  `Color` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `RecurringRule` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `jqcalendar`
--


-- --------------------------------------------------------

--
-- Structure de la table `oeuvres`
--

CREATE TABLE IF NOT EXISTS `oeuvres` (
  `titre` varchar(64) NOT NULL,
  `artiste` varchar(64) NOT NULL,
  `date` year(4) NOT NULL,
  `commentaire` varchar(500) NOT NULL,
  `theme` varchar(64) NOT NULL,
  `reference` int(100) NOT NULL,
  `extension` varchar(10) NOT NULL,
  UNIQUE KEY `Reference` (`reference`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Contenu de la table `oeuvres`
--

INSERT INTO `oeuvres` (`titre`, `artiste`, `date`, `commentaire`, `theme`, `reference`, `extension`) VALUES
('NEW YORK CITY NIGHT', 'Brigitte Sibille', 2000, 'huile originale et PRINT sur toile numéroté disponible', 'Manhattan', 3, 'jpg'),
('CENTRAL PARK SUNSET', 'Brigitte Sibille', 2000, 'huile originale et PRINT sur toile numéroté disponible', 'Manhattan', 2, 'jpg'),
('SPIELOBSTER', 'Brigitte Sibille', 2000, 'huile originale Collection particulière éditée sur toile en exemplaires signés numérotés', 'Manhattan', 1, 'jpg'),
('SKY TRAGEDY', 'Brigitte Sibille', 2000, 'HUILE ORIGINALE format 40N disponible et imprimable', 'Manhattan', 4, 'jpg'),
(' MANHATTAN 7H SUR LA 7ème', 'Brigitte Sibille', 2000, 'huile originale et PRINT sur toile numéroté disponible', 'Manhattan', 5, 'jpg'),
('MANHATTAN SUNSET', 'Brigitte Sibille', 2000, 'HUILE originale et PRINT sur toile numéroté disponible VOIR TARIFS et formats sur le site ou sur place', 'Manhattan', 6, 'jpg'),
('BI-PALETTE', 'Brigitte Sibille', 2000, 'HUILE SUR TOILE ET PHOTO ORIGINALE JEPCO', 'Encollage', 7, 'jpg'),
('TOUT CUIR', 'Brigitte Sibille', 2000, 'HUILE SUR TOILE ET PHOTO ORIGINALE SIGNEE JEPCO', 'Encollage', 8, 'jpg'),
('US COLOR', 'Brigitte Sibille', 2000, 'HUILE sur toile et COLLAGE ORIGINAL signé JepCo', 'Encollage', 9, 'jpg'),
('PROMOTARY', 'Brigitte Sibille', 2000, 'HUILE ORIGINALE ET PHOTOCOMPOSITION JEPCO', 'Encollage', 10, 'jpg'),
('QUEENSBORO', 'Brigitte Sibille', 2000, 'HUILE ORIGINALE format 80X80 disponible et imprimable', 'Manhattan', 11, 'jpg'),
('MANCHE A AIR', 'Brigitte Sibille', 2000, 'HUILE SUR TOILE ET PHOTO ORIGINALE JEPCO', 'Encollage', 12, 'jpg'),
('GARAGE', 'Brigitte Sibille', 2000, 'HUILE ORIGINALE AVEC COLLAGE CONCEPT JEPCO', 'Encollage', 13, 'jpg'),
('ALASKA', 'JepCo', 2000, 'Composition originale numérique, édition en exemplaires limités, signés, certifiés 1,50x1m & 100x75cm', 'Retour vers le néant', 14, 'jpg'),
('FIN DE VOYAGE', 'JepCo', 2000, 'Composition originale numérique, édition en exemplaires limités, signés, certifiés 1,50x1m & 100x75cm', 'Retour vers le néant', 15, 'jpg'),
('P 51', 'JepCo', 2000, 'Composition originale numérique, édition en exemplaires limités, signés, certifiés 1,50x1m & 100x75cm', 'Retour vers le néant', 16, 'jpg'),
('TISSUS', 'Brigitte Sibille', 2008, 'huile originale sur toile', 'Exotique', 17, 'jpg'),
('TEMPETE DE SABLE', 'Brigitte Sibille', 2008, 'HUILE ORIGINALE', 'Exotique', 18, 'jpg'),
('CHATEAU DE MIRLEFT MAROC JANVIER', 'Brigitte Sibille', 2008, 'HUILE SUR TOILE 100X100 ', 'Exotique', 19, 'jpg');

-- --------------------------------------------------------

--
-- Structure de la table `professeurs`
--

CREATE TABLE IF NOT EXISTS `professeurs` (
  `surnom` varchar(100) NOT NULL,
  `fonction` varchar(64) NOT NULL,
  `texte` text NOT NULL,
  `id` int(11) NOT NULL,
  `extension` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `professeurs`
--

INSERT INTO `professeurs` (`surnom`, `fonction`, `texte`, `id`, `extension`) VALUES
('EVY', 'Professeur partenaire', 'Spécialiste du décor de la porcelaine fine, dans la plus stricte tradition de l''art français, Evy aborde tous type de décors avec les élèves confirmés et forme les débutants à l''école Quartier d''Art depuis cette année.', 1, 'jpg'),
('Jacques GERARD', 'Professeur partenaire', 'Formé à Penningen, cet artiste maîtrise les logiciels les plus performants en matière de traitement digital de l''image. Il forme en France et à l''étranger de nombreux designers chaque année. C''est lui qui a en charge les cours thématiques de Quartier d''Art axés sur les créations et traitements numériques des images', 2, 'jpg');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `login` varchar(64) NOT NULL,
  `mdp` varchar(40) NOT NULL,
  `admin` int(11) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `prenom` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `etat` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`login`, `mdp`, `admin`, `nom`, `prenom`, `email`, `etat`) VALUES
('dominique', 'c00a3057e1daef83aec2643d3987f592fd7bb1de', 0, 'rossin', 'dominique', 'dominique.rossin@polytechnique.edu', 1),
('olivier', '663194f2b9123a38cd9e2e2811f8d2fd387b765e', 1, 'serre', 'olivier', 'olivier.serre@polytechnique.edu', 1);
