-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 20 Okt 2017 pada 13.16
-- Versi Server: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoicedb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `clients`
--

CREATE TABLE `clients` (
  `clientID` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `company` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `clients`
--

INSERT INTO `clients` (`clientID`, `name`, `company`, `address`, `phone`) VALUES
(5225411, 'Tobiah MacGilpatrick', 'Nektar Therapeutics', '6594 Stephen Alley', '237 359 0816'),
(5225412, 'Elias Buttery', 'Landmark Partners LP', '31098 Barby Crossing', '723 807 8103'),
(5225413, 'Lane Habbert', 'CST Brands, Inc.', '308 Laurel Lane', '404 208 1276'),
(5225414, 'Craggie Hegg', 'Core-Mark Holding, Inc.', '155 Caliangt Center', '720 226 0985'),
(5225415, 'Rickie Marklew', 'Lindblad Holdings Inc. ', '7752 Tennessee Junction', '775 147 0025');

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice`
--

CREATE TABLE `invoice` (
  `invoiceID` int(11) DEFAULT NULL,
  `clientID` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `invoice`
--

INSERT INTO `invoice` (`invoiceID`, `clientID`, `date`) VALUES
(1341231, 5225411, '2017-06-23'),
(3234242, 5225413, '2017-09-02'),
(2334233, 5225415, '2017-09-24'),
(2624344, 5225414, '2017-10-04'),
(3352345, 5225414, '2017-04-24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `item`
--

CREATE TABLE `item` (
  `ItemID` int(11) DEFAULT NULL,
  `InvoiceID` int(11) DEFAULT NULL,
  `itemName` varchar(50) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `tax` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `item`
--

INSERT INTO `item` (`ItemID`, `InvoiceID`, `itemName`, `amount`, `tax`) VALUES
(1, 1341231, 'Sebring', 23219, 631),
(2, 1341231, 'Montero', 80806, 856),
(3, 1341231, 'Concorde', 99548, 935),
(4, 3234242, 'tC', 60797, 509),
(5, 3234242, 'Gallardo', 95015, 842),
(6, 3234242, 'G37', 82026, 679),
(7, 3234242, 'Focus', 33729, 844),
(8, 2334233, 'Eclipse', 34100, 728),
(9, 2334233, 'Eclipse', 87654, 945),
(10, 2334233, 'tC', 67714, 764),
(11, 2334233, 'Celica', 48764, 514),
(12, 2624344, 'H3', 29221, 862),
(13, 2624344, 'Nitro', 21450, 702),
(14, 2624344, 'Charade', 61587, 594),
(15, 3352345, 'Cabriolet', 18951, 943),
(16, 3352345, 'xD', 53663, 665),
(17, 3352345, 'F450', 37892, 760),
(18, 3352345, 'STS', 90445, 629);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
