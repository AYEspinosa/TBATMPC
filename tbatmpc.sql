-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2018 at 03:45 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tbatmpc`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangays`
--

CREATE TABLE `barangays` (
  `id` int(11) NOT NULL,
  `brgy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `barangays`
--

INSERT INTO `barangays` (`id`, `brgy`, `city_id`) VALUES
(1, 'Abiang', 1),
(2, 'Caliking', 1),
(3, 'Cattubo', 1),
(4, 'Naguey', 1),
(5, 'Paoay', 1),
(6, 'Pasdong', 1),
(7, 'Poblacion', 1),
(8, 'Topdac', 1),
(9, 'A. Bonifacio-Caguioa-Rimando (ABCR)', 2),
(10, 'Abanao-Zandueta-Kayong-Chugum-Otek (AZKCO)', 2),
(11, 'Alfonso Tabora', 2),
(12, 'Ambiong', 2),
(13, 'Andres Bonifacio (Lower Bokawkan)', 2),
(14, 'Apugan-Loakan', 2),
(15, 'Asin Road', 2),
(16, 'Atok Trail', 2),
(17, 'Aurora Hill Proper (Malvar-Sgt. Floresca)', 2),
(18, 'Aurora Hill, North Central', 2),
(19, 'Aurora Hill, South Central', 2),
(20, 'Bagong Lipunan (Market Area)', 2),
(21, 'Bakakeng Central', 2),
(22, 'Bakakeng North', 2),
(23, 'Bal-Marcoville (Marcoville)', 2),
(24, 'Balsigan', 2),
(25, 'Bayan Park East', 2),
(26, 'Bayan Park Village', 2),
(27, 'Bayan Park West (Bayan Park, Leonila Hill)', 2),
(28, 'BGH Compound', 2),
(29, 'Brookside', 2),
(30, 'Brookspoint', 2),
(31, 'Cabinet Hill-Teacher\'s Camp', 2),
(32, 'Camdas Subdivision', 2),
(33, 'Camp 7', 2),
(34, 'Camp 8', 2),
(35, 'Camp Allen', 2),
(36, 'Campo Filipino', 2),
(37, 'City Camp Central', 2),
(38, 'City Camp Proper', 2),
(39, 'Country Club Village', 2),
(40, 'Cresencia Village', 2),
(41, 'Dagsian, Lower', 2),
(42, 'Dagsian, Upper', 2),
(43, 'Dizon Subdivision', 2),
(44, 'Dominican Hill-Mirador', 2),
(45, 'Dontogan', 2),
(46, 'DPS Compound', 2),
(47, 'Engineers\' Hill', 2),
(48, 'Fairview Village', 2),
(49, 'Ferdinand (Happy Homes-Campo Sioco)', 2),
(50, 'Fort del Pilar', 2),
(51, 'Gabriela Silang', 2),
(52, 'General Emilio F. Aguinaldo (Quirino‑Magsaysay, Lower)', 2),
(53, 'General Luna, Upper', 2),
(54, 'General Luna, Lower', 2),
(55, 'Gibraltar', 2),
(56, 'Greenwater Village', 2),
(57, 'Guisad Central', 2),
(58, 'Guisad Sorong', 2),
(59, 'Happy Hollow', 2),
(60, 'Happy Homes (Happy Homes-Lucban)', 2),
(61, 'Harrison-Claudio Carantes', 2),
(62, 'Hillside', 2),
(63, 'Holy Ghost Extension', 2),
(64, 'Holy Ghost Proper', 2),
(65, 'Honeymoon (Honeymoon-Holy Ghost)', 2),
(66, 'Imelda R. Marcos (La Salle)', 2),
(67, 'Imelda Village', 2),
(68, 'Irisan', 2),
(69, 'Kabayanihan', 2),
(70, 'Kagitingan', 2),
(71, 'Kayang Extension', 2),
(72, 'Kayang-Hilltop', 2),
(73, 'Kias', 2),
(74, 'Legarda-Burnham-Kisad', 2),
(75, 'Liwanag-Loakan', 2),
(76, 'Loakan Proper', 2),
(77, 'Lopez Jaena', 2),
(78, 'Lourdes Subdivision Extension', 2),
(79, 'Lourdes Subdivision, Lower', 2),
(80, 'Lourdes Subdivision, Proper', 2),
(81, 'Lualhati', 2),
(82, 'Lucnab', 2),
(83, 'Magsaysay Private Road', 2),
(84, 'Magsaysay, Lower', 2),
(85, 'Magsaysay, Upper', 2),
(86, 'Malcolm Square-Perfecto (Jose Abad Santos)', 2),
(87, 'Manuel A. Roxas', 2),
(88, 'Market Subdivision, Upper', 2),
(89, 'Middle Quezon Hill Subdivision (Quezon Hill Middle)', 2),
(90, 'Military Cut-off', 2),
(91, 'Mines View Park', 2),
(92, 'Modern Site, East', 2),
(93, 'Modern Site, West', 2),
(94, 'MRR-Queen of Peace', 2),
(95, 'New Lucban', 2),
(96, 'Outlook Drive', 2),
(97, 'Pacdal', 2),
(98, 'Padre Burgos', 2),
(99, 'Padre Zamora', 2),
(100, 'Palma-Urbano (Cariño-Palma)', 2),
(101, 'Phil-Am', 2),
(102, 'Pinget', 2),
(103, 'Pinsao Pilot Project', 2),
(104, 'Pinsao Proper', 2),
(105, 'Poliwes', 2),
(106, 'Pucsusan', 2),
(107, 'Quezon Hill Proper', 2),
(108, 'Quezon Hill, Upper', 2),
(109, 'Quirino Hill, East', 2),
(110, 'Quirino Hill, Lower', 2),
(111, 'Quirino Hill, Middle', 2),
(112, 'Quirino Hill, West', 2),
(113, 'Quirino-Magsaysay, Upper (Upper QM)', 2),
(114, 'Rizal Monument Area', 2),
(115, 'Rock Quarry, Lower', 2),
(116, 'Rock Quarry, Middle', 2),
(117, 'Rock Quarry, Upper', 2),
(118, 'Saint Joseph Village', 2),
(119, 'Salud Mitra', 2),
(120, 'San Antonio Village', 2),
(121, 'San Luis Village', 2),
(122, 'San Roque Village', 2),
(123, 'San Vicente', 2),
(124, 'Sanitary Camp, North', 2),
(125, 'Sanitary Camp, South', 2),
(126, 'Santa Escolastica', 2),
(127, 'Santo Rosario', 2),
(128, 'Santo Tomas Proper', 2),
(129, 'Santo Tomas School Area', 2),
(130, 'Scout Barrio', 2),
(131, 'Session Road Area', 2),
(132, 'Slaughter House Area (Santo Niño Slaughter)', 2),
(133, 'SLU-SVP Housing Village', 2),
(134, 'South Drive', 2),
(135, 'Teodora Alonzo', 2),
(136, 'Trancoville', 2),
(137, 'Victoria Village', 2),
(138, 'Ampusongan', 3),
(139, 'Bagu', 3),
(140, 'Dalipey', 3),
(141, 'Gambang', 3),
(142, 'Kayapa', 3),
(143, 'Poblacion (Central)', 3),
(144, 'Sinacbat', 3),
(145, 'Ambuclao', 4),
(146, 'Bila', 4),
(147, 'Bobok ‑ Bisal', 4),
(148, 'Daclan', 4),
(149, 'Ekip', 4),
(150, 'Karao', 4),
(151, 'Nawal', 4),
(152, 'Pito', 4),
(153, 'Poblacion', 4),
(154, 'Tikey', 4),
(155, 'Abatan', 5),
(156, 'Amgaleyguey', 5),
(157, 'Amlimay', 5),
(158, 'Baculongan Norte', 5),
(159, 'Bangao', 5),
(160, 'Buyacaoan', 5),
(161, 'Calamagan', 5),
(162, 'Catlubong', 5),
(163, 'Loo', 5),
(164, 'Natubleng', 5),
(165, 'Poblacion (Central)	', 5),
(166, 'Baculongan Sur', 5),
(167, 'Lengaoan', 5),
(168, 'Sebang', 5),
(169, 'Ampucao', 6),
(170, 'Dalupirip', 6),
(171, 'Gumatdang', 6),
(172, 'Loacan', 6),
(173, 'Poblacion (Central)', 6),
(174, 'Tinongdan', 6),
(175, 'Tuding', 6),
(176, 'Ucab', 6),
(177, 'Virac', 6),
(178, 'Adaoay', 7),
(179, 'Anchukey', 7),
(180, 'Ballay', 7),
(181, 'Bashoy', 7),
(182, 'Batan', 7),
(183, 'Duacan', 7),
(184, 'Eddet', 7),
(185, 'Gusaran', 7),
(186, 'Kabayan Barrio', 7),
(187, 'Lusod', 7),
(188, 'Pacso', 7),
(189, 'Poblacion (Central)', 7),
(190, 'Tawangan', 7),
(191, 'Balakbak', 8),
(192, 'Beleng‑Belis', 8),
(193, 'Boklaoan', 8),
(194, 'Cayapes', 8),
(195, 'Cuba', 8),
(196, 'Datakan', 8),
(197, 'Gadang', 8),
(198, 'Gasweling', 8),
(199, 'Labueg', 8),
(200, 'Paykek', 8),
(201, 'Poblacion Central', 8),
(202, 'Pudong', 8),
(203, 'Pongayan', 8),
(204, 'Sagubo', 8),
(205, 'Taba‑ao', 8),
(206, 'Badeo', 9),
(207, 'Lubo', 9),
(208, 'Madaymen', 9),
(209, 'Palina', 9),
(210, 'Poblacion', 9),
(211, 'Sagpat', 9),
(212, 'Tacadang', 9),
(213, 'Alapang', 10),
(214, 'Alno', 10),
(215, 'Ambiong', 10),
(216, 'Bahong', 10),
(217, 'Balili', 10),
(218, 'Beckel', 10),
(219, 'Bineng', 10),
(220, 'Betag', 10),
(221, 'Cruz', 10),
(222, 'Lubas', 10),
(223, 'Pico', 10),
(224, 'Poblacion', 10),
(225, 'Puguis', 10),
(226, 'Shilan', 10),
(227, 'Tawang', 10),
(228, 'Wangal', 10),
(229, 'Balili', 12),
(230, 'Bedbed', 12),
(231, 'Bulalacao', 12),
(232, 'Cabiten', 12),
(233, 'Colalo', 12),
(234, 'Guinaoang', 12),
(235, 'Paco', 12),
(236, 'Palasaan', 12),
(237, 'Poblacion', 12),
(238, 'Sapid', 12),
(239, 'Tabio', 12),
(240, 'Taneg', 12);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand`) VALUES
(1, 'Mobil'),
(2, 'Varni'),
(11, 'Cleopatras'),
(13, 'Motolet'),
(14, 'Toyota'),
(15, 'Laarni'),
(18, 'Aeros');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `items` text COLLATE utf8_unicode_ci NOT NULL,
  `expire_date` datetime NOT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT '0',
  `shipped` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `items`, `expire_date`, `paid`, `shipped`) VALUES
(18, '[{\"id\":\"3\",\"size\":\"Sm\",\"quantity\":3},{\"id\":\"2\",\"size\":\"Honda-Civic\",\"quantity\":\"6\"}]', '2018-11-04 08:16:32', 0, 0),
(19, '[{\"id\":\"1\",\"size\":\"Mitsubishi-Adventure\",\"quantity\":\"1\"}]', '2018-11-10 16:55:45', 1, 0),
(20, '[{\"id\":\"1\",\"size\":\"Mitsubishi-Adventure\",\"quantity\":\"3\"}]', '2018-11-10 16:57:59', 1, 0),
(21, '[{\"id\":\"15\",\"size\":\"Medium\",\"quantity\":\"4\"}]', '2018-11-10 17:07:09', 1, 0),
(22, '[{\"id\":\"15\",\"size\":\"Small\",\"quantity\":\"1\"}]', '2018-11-10 17:10:39', 1, 1),
(23, '[{\"id\":\"14\",\"size\":\"Narrow\",\"quantity\":\"3\"}]', '2018-11-10 17:12:42', 1, 0),
(24, '[{\"id\":\"14\",\"size\":\"Med\",\"quantity\":\"1\"}]', '2018-11-10 17:13:21', 1, 1),
(25, '[{\"id\":\"16\",\"size\":\"Suzuki-Vios\",\"quantity\":\"1\"},{\"id\":\"15\",\"size\":\"Large\",\"quantity\":\"4\"},{\"id\":\"14\",\"size\":\"Med\",\"quantity\":\"1\"},{\"id\":\"2\",\"size\":\"Toyota-Vios\",\"quantity\":\"1\"},{\"id\":\"1\",\"size\":\"Honda-Civic\",\"quantity\":\"1\"}]', '2018-11-13 10:02:35', 1, 0),
(26, '[{\"id\":\"18\",\"size\":\"Truck Size\",\"quantity\":\"3\"},{\"id\":\"13\",\"size\":\"Toyota-Avanza 2018\",\"quantity\":\"3\"},{\"id\":\"2\",\"size\":\"Honda-Civic\",\"quantity\":\"3\"},{\"id\":\"1\",\"size\":\"Honda-Civic\",\"quantity\":\"3\"}]', '2018-11-13 10:11:45', 1, 0),
(27, '[{\"id\":\"2\",\"size\":\"Honda-Civic\",\"quantity\":\"1\"}]', '2018-11-13 10:14:04', 1, 0),
(28, '[{\"id\":\"15\",\"size\":\"Honda-Civic\",\"quantity\":\"2\"}]', '2018-11-13 10:16:40', 1, 0),
(29, '[{\"id\":\"1\",\"size\":\"Honda-Civic\",\"quantity\":\"1\"}]', '2018-11-13 10:18:47', 1, 1),
(30, '[{\"id\":\"1\",\"size\":\"Honda-Adventure\",\"quantity\":\"4\"}]', '2018-11-13 10:24:54', 1, 0),
(31, '[{\"id\":\"2\",\"size\":\"Honda-Adventure\",\"quantity\":\"1\"},{\"id\":\"1\",\"size\":\"Honda-Civic\",\"quantity\":\"1\"}]', '2018-11-13 10:32:33', 1, 0),
(32, '[{\"id\":\"13\",\"size\":\"Toyota-Vios 2017\",\"quantity\":\"2\"}]', '2018-11-13 10:34:44', 1, 0),
(33, '[{\"id\":\"16\",\"size\":\"Honda-Civic\",\"quantity\":\"1\"}]', '2018-11-13 10:40:36', 1, 0),
(34, '[{\"id\":\"2\",\"size\":\"Honda-Adventure\",\"quantity\":\"2\"}]', '2018-11-13 10:46:25', 1, 1),
(35, '[{\"id\":\"16\",\"size\":\"Suzuki-Vios\",\"quantity\":\"1\"},{\"id\":\"18\",\"size\":\"Vios\",\"quantity\":\"4\"},{\"id\":\"13\",\"size\":\"Toyota-Avanza 2018\",\"quantity\":\"1\"}]', '2018-11-13 10:48:25', 1, 1),
(36, '[{\"id\":\"16\",\"size\":\"Honda-Civic\",\"quantity\":\"1\"},{\"id\":\"17\",\"size\":\"Chevrolet-Fortuner\",\"quantity\":\"2\"},{\"id\":\"2\",\"size\":\"Honda-Adventure\",\"quantity\":\"1\"}]', '2018-11-13 16:30:07', 0, 0),
(39, '[{\"id\":\"1\",\"size\":\"Honda-Civic\",\"quantity\":\"1\"},{\"id\":\"1\",\"size\":\"Suzuki-Vios\",\"quantity\":\"2\"}]', '2018-11-13 16:37:12', 1, 1),
(40, '[{\"id\":\"1\",\"size\":\"Honda-Adventure\",\"quantity\":\"1\"}]', '2018-11-13 16:44:35', 1, 1),
(41, '[{\"id\":\"1\",\"size\":\"Honda-Civic\",\"quantity\":\"1\"}]', '2018-11-13 16:57:13', 1, 1),
(44, '[{\"id\":\"1\",\"size\":\"Honda-Adventure\",\"quantity\":\"2\"},{\"id\":\"2\",\"size\":\"Honda-Adventure\",\"quantity\":\"1\"},{\"id\":\"18\",\"size\":\"Truck Size\",\"quantity\":\"1\"}]', '2018-11-13 17:37:49', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `parent`) VALUES
(1, 'Car Accessories', 0),
(2, 'Car Care Products', 0),
(3, 'Car Parts', 0),
(5, 'Seat Covers', 1),
(6, 'Gauges', 1),
(7, 'Sun Screens', 1),
(8, 'Dashcams', 1),
(9, 'Polishers', 2),
(10, 'Cleaners', 2),
(11, 'Protectants', 2),
(12, 'Air Filters', 2),
(13, 'Exhausts', 3),
(14, 'Mirrors', 3),
(15, 'Stickers', 0),
(16, 'Matte Style', 15),
(17, 'Cartoons', 15),
(18, 'Grafitti', 15),
(19, 'Gifts', 0),
(20, 'Bubble Head', 19),
(21, 'Marbles', 19),
(22, 'Figurines', 19),
(23, 'Spare Parts', 1),
(24, 'Oil Filters', 3),
(25, 'Brakes', 3);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city`) VALUES
(1, 'Atok'),
(2, 'Baguio City'),
(3, 'Bakun'),
(4, 'Bokod'),
(5, 'Bugias'),
(6, 'Itogon'),
(7, 'Kabayan'),
(8, 'Kapangan'),
(9, 'Kibungan'),
(10, 'La Trinidad'),
(12, 'Mankayan'),
(13, 'Philippine Military Academy (PMA)'),
(14, 'Sablan'),
(15, 'Tuba'),
(16, 'Tublay');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `package` varchar(50) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `unit`, `package`, `color`, `start`, `end`) VALUES
(54, '2017 toyota hiace gl grandia', '3', 'with driver', '#FFD700', '2018-10-10 00:00:00', '2018-10-13 00:00:00'),
(60, 'Toyota - Grandia', '1', 'with driver and gro', '#008000', '2074-09-09 00:00:00', '2074-09-19 00:00:00'),
(62, 'mustang', '', 'with driver', '#008000', '2066-09-09 00:00:00', '2066-09-19 00:00:00'),
(63, 'Toyota-Fortuner 2016', NULL, 'Without Driver', '#008000', '2018-10-17 00:00:00', '2018-10-18 00:00:00'),
(64, 'Toyota - Grandia', NULL, 'With Driver', '#FF0000', '2018-10-24 00:00:00', '2018-10-28 00:00:00'),
(69, 'Toyota - Grandia', NULL, 'Driver, without car', '#FF0000', '2018-10-01 00:00:00', '2018-10-07 00:00:00'),
(70, 'Toyota-Fortuner 2016', NULL, 'With Driver', '#008000', '2018-10-29 00:00:00', '2018-11-01 00:00:00'),
(71, 'Toyota-Fortuner 2016', '14', 'Driver, without car', '#008000', '2018-11-01 00:00:00', '2018-11-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `description` text,
  `package_status` enum('active','inactive') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `name`, `description`, `package_status`) VALUES
(3, 'Package 2', 'Without Driver', 'active'),
(12, 'Package 1', 'With Drivers', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `list_price` decimal(10,2) NOT NULL,
  `brand` int(11) NOT NULL,
  `categories` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `sizes` text COLLATE utf8_unicode_ci NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `list_price`, `brand`, `categories`, `image`, `description`, `featured`, `sizes`, `deleted`) VALUES
(1, 'Seat Cover (Matte Black)', '399.75', '899.75', 1, '5', '/TBATMPC/imgs/Prods/3746cad653d295d74183d10d0757e9c3.png', 'One of the best Seat Covers, they are super comfy! Get yours now!', 1, 'Honda-Civic:1:3,Suzuki-Vios:5:7,Honda-Adventure:4:8', 0),
(2, 'Gauges (Sporty Gauge)', '4499.75', '7999.75', 1, '6', '/TBATMPC/imgs/Products/gauge4.png', 'Sporty Gauge for Adventurous ones! Get yours now!!', 1, 'Honda-Civic:2:4,Suzuki-Vios:2:4,Honda-Adventure:5:8', 0),
(18, 'Exhaust-Tested', '2299.75', '4499.75', 13, '13', '/TBATMPC/imgs/Prods/a7dfa901b6c124aaa22c29b5fb2be5c4.png,/TBATMPC/imgs/Prods/90e41eef68bd51d1ad6343b0cbfbe72e.png', 'Brake test multi images', 1, 'Truck Size:1:4,Vios:1:3,Adventure:8:10', 0),
(19, 'Brakes', '2599.75', '3599.75', 13, '25', '/TBATMPC/imgs/Prods/de409a0942815a380428ba4ec640510d.png,/TBATMPC/imgs/Prods/f3d24661fcb275aa50c416bfab103b39.png', 'One of the beast brakes!\r\nGet yours now!', 1, 'Avanza:4:4,Vioz:5:5,Civic:7:7', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rentalrequest`
--

CREATE TABLE `rentalrequest` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `address` varchar(50) CHARACTER SET utf8 NOT NULL,
  `contactnumber` varchar(11) NOT NULL,
  `comment` text NOT NULL,
  `van` varchar(50) DEFAULT NULL,
  `package` varchar(30) DEFAULT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `noofdays` int(11) DEFAULT NULL,
  `request_status` enum('Pending','Accepted','Rejected') NOT NULL,
  `code` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rentalrequest`
--

INSERT INTO `rentalrequest` (`id`, `firstname`, `lastname`, `email`, `address`, `contactnumber`, `comment`, `van`, `package`, `startdate`, `enddate`, `noofdays`, `request_status`, `code`) VALUES
(147, 'Genesis', 'Edano', 'alfonsotabz@gmail.com', '303 Sampaloc St Cembo Makati', '09472375391', 'Test!', 'Toyota - Grandia', 'With Driver', '2018-12-19', '2018-12-22', 3, 'Pending', 9478186),
(144, 'Genesis', 'Edano', 'alfonsotabz@gmail.com', '303 Sampaloc Street Cembo Makati City', '09462736451', 'Travel, and visit deceased loved ones.', 'Toyota-Fortuner 2016', 'Driver, without car', '2018-11-01', '2018-11-03', 2, 'Pending', 1479404),
(138, 'Alfonso Gabriel', 'Tabeta', 'alfonsotabz@gmail.com', '303 Sampaloc Street Cembo makati city', '09472375391', 'Birthday celeb!', 'Toyota-Fortuner 2016', 'With Driver', '2018-12-15', '2018-12-19', 5, 'Pending', 3107431),
(146, 'Alfonso', 'Tabeta', 'alfonsotabz@gmail.com', '303 Sampaloc St makati', '09472375391', 'Hi', 'Toyota - Grandia', 'With Driver', '2030-10-01', '2080-10-01', 1, 'Rejected', 9478186),
(145, 'Aira Yllana', 'Espinosa', 'eairayllana30@gmail.com', '213 Sangandaan Monumento Caloocan City', '09473231234', 'Vacation for sembreak!', 'Toyota - Grandia', 'With Driver', '2018-12-01', '2018-12-03', 2, 'Pending', 3397446);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `zip` int(4) NOT NULL,
  `pay_meth` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT '0',
  `cart_id` int(11) NOT NULL,
  `grand_amount` decimal(13,2) NOT NULL,
  `txn_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `full_name`, `address`, `email`, `city`, `zip`, `pay_meth`, `paid`, `cart_id`, `grand_amount`, `txn_date`) VALUES
(4, 'Aira Yllana Espinosa', '202 Sampaloc Street, Baguio City 2600', 'alfonsotabz@gmail.com', 'Baguio City', 2600, 'cash on delivery', 1, 3, '800.00', '2018-10-11 22:44:44'),
(5, 'Alfonso Gabriel Tabeta', '303 Sampaloc Street Cembo, Atok 2612', 'alfonsotabz@gmail.com', 'Atok', 2612, 'pick up', 1, 4, '799.50', '2018-10-11 22:44:44'),
(6, 'Alfonso Gabriel Tabeta', '303 Sampaloc Cembo, Baguio City 2600', 'alfonsotabz@gmail.com', 'Baguio City', 2600, 'pick up', 1, 5, '1998.75', '2018-10-11 22:44:44'),
(25, 'Alfonso Gabriel Tabeta', '248 Purok East Magsaysay Loakan Proper, Baguio City 2600, Baguio City 2600', 'alfonsotabz@gmail.com', 'Baguio City', 2600, 'pick up', 1, 22, '600.00', '2018-10-11 23:12:05'),
(27, 'Alfonso Gabriel Tabeta', '248 Purok East Magsaysay Loakan Proper, Baguio City 2600, Baguio City 2600', 'alfonsotabz@gmail.com', 'Baguio City', 2600, 'pick up', 1, 24, '399.75', '2018-10-11 23:14:18'),
(32, 'Alfonso Gabriel Tabeta', '325 East Magsaysay Loakan Proper, Baguio City 2600, Baguio City 2600', 'alfonsotabz@gmail.com', 'Baguio City', 2600, 'pick up', 1, 29, '399.75', '2018-10-14 16:19:33'),
(38, 'Alfonso Gabriel Tabeta', '325 Purok East Magsaysay Loakan Proper, Baguio City 2600, Baguio City 2600', 'alfonsotabz@gmail.com', 'Baguio City', 2600, 'pick up', 1, 34, '8999.50', '2018-10-14 16:47:10'),
(39, 'Alfonso Gabriel Tabeta', '325 Purok East Magsaysay Loakan Proper, Baguio City 2600, Baguio City 2600', 'alfonsotabz@gmail.com', 'Baguio City', 2600, 'pick up', 1, 35, '20198.50', '2018-10-14 16:49:15'),
(40, 'Alfonso Gabriel Tabeta', '325 Purok East Magsaysay Loakan Proper, Baguio City 2600, Baguio City 2600', 'alfonsotabz@gmail.com', 'Baguio City', 2600, 'pick up', 1, 39, '1199.25', '2018-10-14 22:38:56'),
(41, 'Alfonso Gabriel Tabeta', '325 Purok East Loakan Proper, Baguio City 2600, Baguio City 2600', 'alfonsotabz@gmail.com', 'Baguio City', 2600, 'pick up', 1, 40, '399.75', '2018-10-14 22:46:04'),
(42, 'Alfonso Gabriel Tabeta', '325 East Magsaysay Loakan Proper, Baguio City 2600, Baguio City 2600', 'alfonsotabz@gmail.com', 'Baguio City', 2600, 'pick up', 1, 41, '399.75', '2018-10-14 22:58:00'),
(43, 'Alfonso Gabriel Tabeta', '325 Purok East Magsaysay Loakan Proper, Baguio City 2600, Baguio City 2600', 'alfonsotabz@gmail.com', 'Baguio City', 2600, 'pick up', 1, 44, '7599.00', '2018-10-14 23:40:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL,
  `permissions` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `join_date`, `last_login`, `permissions`) VALUES
(6, 'Genevieve Oscares', 'evevoscares@gmail.com', '$2y$10$4J5FFYhRmYRHQBZuTzy9EebS4y.8Lt.eArNgcCljd3Cn6NX2MmtX6', '2018-10-01 13:54:30', '2018-10-01 10:24:01', 'admin,editor'),
(8, 'Genesis Edano', 'genesis.edano@gmail.com', '$2y$10$oShIwU0aSCajM5PG3For0ejkleq4OV5achyvYzq1Xrll0IT3t/WkW', '2018-10-01 13:56:23', '0000-00-00 00:00:00', 'admin,editor'),
(10, 'Aira Yllana Espinosa', 'eairayllana30@gmail.com', '$2y$10$3f10CzsYNP85lfB79jWa4.yPxoaYED6pZ4quUJjyXhDsevmQhAMhu', '2018-10-05 11:35:42', '0000-00-00 00:00:00', 'admin,editor'),
(11, 'Marjorie Codlin', 'marjcodlin@gmail.com', '$2y$10$AXdrx6jgYKtiRBZs3o2/deLmwEZ9Fg3AVQXrBNRewubu1jauKB98.', '2018-10-05 11:36:38', '0000-00-00 00:00:00', 'editor'),
(12, 'Yllana Espinosa', 'eairayllana30@gmail.om', '$2y$10$128nkZ0G8K2qgVqouM8DQeczzWLBigDELR2rVfZf7akrRnrTv6fq6', '2018-10-05 14:39:11', '0000-00-00 00:00:00', 'editor'),
(13, 'Gab Tabeta', 'gab_tabeta@gmail.com', '$2y$10$SIR2L0X0szwwT9vo.mroFO/JxShdqFpcPrxYHxN8kNSHfa6ylaKbm', '2018-10-14 21:56:56', '2018-10-14 15:57:50', 'admin,editor'),
(14, 'Alfonso Gabriel Tabeta', 'alfonsotabz@gmail.com', '$2y$10$W2NBIzjmNe6diH0BDTkn4.tct3bzqha7YnzCZ.WfEU1/eV8VFxolC', '2018-10-14 21:59:00', '2018-10-14 16:40:29', 'admin,editor,superadmin');

-- --------------------------------------------------------

--
-- Table structure for table `van`
--

CREATE TABLE `van` (
  `id` int(11) NOT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `costperday` decimal(10,2) DEFAULT NULL,
  `description` text,
  `Chassis` varchar(100) DEFAULT NULL,
  `Plate` varchar(100) DEFAULT NULL,
  `Motor` varchar(100) DEFAULT NULL,
  `van_status` enum('active','inactive') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `van`
--

INSERT INTO `van` (`id`, `unit`, `costperday`, `description`, `Chassis`, `Plate`, `Motor`, `van_status`) VALUES
(1, 'Toyota - Grandia', '4200.00', 'Metallic Silver', 'JTFRT13P0H8012893', 'VV6508', '1KD2702848', 'active'),
(14, 'Toyota-Fortuner 2016', '10500.00', 'Freedom White', '908908', 'ABC1234', '13812093819', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `zipc`
--

CREATE TABLE `zipc` (
  `id` int(11) NOT NULL,
  `zip_code` int(10) NOT NULL,
  `city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `zipc`
--

INSERT INTO `zipc` (`id`, `zip_code`, `city_id`) VALUES
(1, 2612, 1),
(2, 2600, 2),
(3, 2610, 3),
(4, 2605, 4),
(5, 2607, 5),
(6, 2604, 6),
(7, 2606, 7),
(8, 2613, 8),
(9, 2611, 9),
(10, 2601, 10),
(12, 2608, 12),
(14, 2614, 14),
(15, 2603, 15),
(16, 2615, 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangays`
--
ALTER TABLE `barangays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rentalrequest`
--
ALTER TABLE `rentalrequest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `van`
--
ALTER TABLE `van`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zipc`
--
ALTER TABLE `zipc`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangays`
--
ALTER TABLE `barangays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `rentalrequest`
--
ALTER TABLE `rentalrequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `van`
--
ALTER TABLE `van`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `zipc`
--
ALTER TABLE `zipc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
