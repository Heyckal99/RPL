-- --------------------------------------------------------
-- Host:                         10.100.78.20
-- Server version:               10.4.11-MariaDB - MariaDB Server
-- Server OS:                    Linux
-- HeidiSQL Version:             12.7.0.6850
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for warkah
CREATE DATABASE IF NOT EXISTS `db_warkah` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_warkah`;

-- Dumping structure for table warkah.album
CREATE TABLE IF NOT EXISTS `album` (
  `id_album` varchar(16) NOT NULL,
  `id_tower` varchar(16) DEFAULT NULL,
  `nama_rak` char(1) DEFAULT NULL,
  `no_rak` tinyint(3) unsigned DEFAULT NULL,
  `id_kolom` varchar(16) DEFAULT NULL,
  `id_baris` varchar(16) DEFAULT NULL,
  `album_nomor` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id_album`),
  KEY `idx_album_nomor` (`album_nomor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table warkah.album: ~0 rows (approximately)

-- Dumping structure for table warkah.baris
CREATE TABLE IF NOT EXISTS `baris` (
  `id_baris` varchar(16) NOT NULL,
  `no_baris` tinyint(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_baris`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table warkah.baris: ~7 rows (approximately)
INSERT INTO `baris` (`id_baris`, `no_baris`) VALUES
	('7h45q3i5vqscoo', 6),
	('8njvoay37t444o', 5),
	('8t6dlv19r4kcc8', 3),
	('8whh53djuvc4k8', 4),
	('9526ri4pwi048o', 7),
	('c4jxir3adnso04', 1),
	('g8ybz8bzshkwgc', 2);


-- Dumping structure for table warkah.kolom
CREATE TABLE IF NOT EXISTS `kolom` (
  `id_kolom` varchar(16) NOT NULL,
  `no_kolom` tinyint(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_kolom`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table warkah.kolom: ~30 rows (approximately)
INSERT INTO `kolom` (`id_kolom`, `no_kolom`) VALUES
	('1whwhdsgioe804', 2),
	('6y4wg6f05g1233', 8),
	('6y4wg6f05g1344', 14),
	('6y4wg6f05g1413', 20),
	('6y4wg6f05g2671', 23),
	('6y4wg6f05g2769', 11),
	('6y4wg6f05g2914', 30),
	('6y4wg6f05g2989', 17),
	('6y4wg6f05g3966', 12),
	('6y4wg6f05g3987', 25),
	('6y4wg6f05g3988', 18),
	('6y4wg6f05g4363', 26),
	('6y4wg6f05g4368', 19),
	('6y4wg6f05g4682', 24),
	('6y4wg6f05g4889', 29),
	('6y4wg6f05g5412', 27),
	('6y4wg6f05g5564', 21),
	('6y4wg6f05g7127', 22),
	('6y4wg6f05g7836', 28),
	('6y4wg6f05g8572', 13),
	('6y4wg6f05g8682', 10),
	('6y4wg6f05g8949', 9),
	('6y4wg6f05g9322', 15),
	('6y4wg6f05g9884', 16),
	('6y4wg6f05gw8sw', 7),
	('9jtnx5ktzf8cc', 3),
	('b6bb0ptybz4gsg', 5),
	('cfpecv99snsc8w', 1),
	('d4iqxzv7zps804', 6),
	('gbxzxxx4izccoc', 4);

-- Dumping structure for table warkah.lorong
CREATE TABLE IF NOT EXISTS `lorong` (
  `id_lorong` tinyint(4) NOT NULL,
  `posisi_lorong` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id_lorong`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table warkah.lorong: ~2 rows (approximately)
INSERT INTO `lorong` (`id_lorong`, `posisi_lorong`) VALUES
	(1, 'KANAN'),
	(2, 'KIRI');

-- Dumping structure for table warkah.nomor_rak
CREATE TABLE IF NOT EXISTS `nomor_rak` (
  `id_nomor_rak` varchar(16) NOT NULL,
  `rak_nomor` tinyint(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_nomor_rak`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table warkah.nomor_rak: ~30 rows (approximately)
INSERT INTO `nomor_rak` (`id_nomor_rak`, `rak_nomor`) VALUES
	('czh2jwtd1tcs8o', 1),
	('czrj3e5cotw80s', 2),
	('d0dswq3tids8gc', 3),
	('d0xl40hgsso48k', 4),
	('d1f8seyjtgggoo', 5),
	('d35exwqb6xw0g8', 6),
	('d3ezriy5bq8kgw', 7),
	('d3nnbuk5kkoook', 8),
	('d41x4xx2tgoo0g', 9),
	('d4aqpfy0ylw8ws', 10),
	('d4lz47nz57484g', 11),
	('d543vw3a0sg0w8', 12),
	('ducy33s2ky04ow', 13),
	('dulnhxzahk0kw8', 14),
	('duvpeu5chbco8k', 15),
	('dv4hiogi23so44', 16),
	('dvfex4f23jswck', 17),
	('dvo3psf7g8owoo', 18),
	('dw110ttam00ggk', 19),
	('dw9yfwkfpnccks', 20),
	('dwkgr4pr6x448s', 21),
	('dybxmxn0t88wog', 22),
	('dyq3qztiqkg000', 23),
	('dz1qehtzgyokok', 24),
	('dzo0iwvzki8808', 25),
	('e016rg4lr6oggc', 26),
	('e0gyjdg491s8cg', 27),
	('e26iio5bp7w4w0', 28),
	('e2llw0xniigwkk', 29),
	('e2v0edn0h3c4gg', 30);


-- Dumping structure for table warkah.tbl_ptsl_warkah
CREATE TABLE IF NOT EXISTS `tbl_ptsl_warkah` (
  `no_urut` bigint(20) unsigned NOT NULL DEFAULT 0,
  `di_208_nomor` varchar(10) DEFAULT NULL,
  `di_208_tahun` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`no_urut`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Dumping structure for table warkah.tower
CREATE TABLE IF NOT EXISTS `tower` (
  `id_tower` varchar(16) NOT NULL,
  `nama_tower` char(1) DEFAULT NULL,
  PRIMARY KEY (`id_tower`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table warkah.tower: ~2 rows (approximately)
INSERT INTO `tower` (`id_tower`, `nama_tower`) VALUES
	('3gu9ttc7an8kkg', 'A'),
	('ck7jv0nfkjk0ow', 'B');

-- Dumping structure for table warkah.username
CREATE TABLE IF NOT EXISTS `username` (
  `username` varchar(30) NOT NULL,
  `nama` varchar(70) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `no_level` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`username`),
  KEY `idx_nama` (`nama`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table warkah.username: ~152 rows (approximately)
INSERT INTO `username` (`username`, `nama`, `password`, `no_level`) VALUES
	('admin', 'administrator', 'administrator', 1),
	('AGUNG', 'AGUNG NUGROHO, SH', '25032021', 2);

-- Dumping structure for table warkah.username_level
CREATE TABLE IF NOT EXISTS `username_level` (
  `no_level` tinyint(11) unsigned NOT NULL,
  `otoritas` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`no_level`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table warkah.username_level: ~2 rows (approximately)
INSERT INTO `username_level` (`no_level`, `otoritas`) VALUES
	(1, 'Administrator'),
	(2, 'Pengguna');

-- Dumping structure for table warkah.warkah
CREATE TABLE IF NOT EXISTS `warkah` (
  `id_warkah` varchar(16) NOT NULL,
  `id_tower` varchar(16) NOT NULL,
  `nama_rak` char(1) NOT NULL,
  `no_rak` varchar(16) NOT NULL,
  `id_kolom` varchar(16) DEFAULT NULL,
  `id_baris` varchar(16) DEFAULT NULL,
  `id_lorong` tinyint(4) DEFAULT NULL,
  `album_nomor` varchar(12) NOT NULL,
  `di_208_nomor` varchar(10) DEFAULT NULL,
  `di_208_tahun` varchar(4) DEFAULT NULL,
  `scan` char(1) DEFAULT NULL,
  `tgl_entri` datetime DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_warkah`),
  KEY `idx_DI208_nomor` (`di_208_nomor`),
  KEY `idx_DI208_tahun` (`di_208_tahun`),
  KEY `idx_album_nomor` (`album_nomor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;