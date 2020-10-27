-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.4.14-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_bms
CREATE DATABASE IF NOT EXISTS `db_bms` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `db_bms`;

-- Dumping structure for table db_bms.tb_akses
CREATE TABLE IF NOT EXISTS `tb_akses` (
  `id_akses` int(11) NOT NULL AUTO_INCREMENT,
  `id_submenu` int(11) NOT NULL,
  `id_tipeuser` int(11) NOT NULL,
  `view` enum('1','0') NOT NULL DEFAULT '1',
  `add` enum('1','0') NOT NULL DEFAULT '0',
  `edit` enum('1','0') NOT NULL DEFAULT '0',
  `delete` enum('1','0') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_akses`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table db_bms.tb_historikas
CREATE TABLE IF NOT EXISTS `tb_historikas` (
  `id_histori_kas` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kas` varchar(255) DEFAULT NULL,
  `jenis` varchar(255) DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL,
  `saldo` int(11) DEFAULT NULL,
  `tgltransaksi` date DEFAULT NULL,
  PRIMARY KEY (`id_histori_kas`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_bms.tb_jurnal
CREATE TABLE IF NOT EXISTS `tb_jurnal` (
  `id_jurnal` int(11) NOT NULL AUTO_INCREMENT,
  `tipe_transaksi` varchar(15) NOT NULL,
  `kode_coa_debet` varchar(20) NOT NULL,
  `kode_coa_kredit` varchar(20) NOT NULL,
  `nominal_debet` double DEFAULT NULL,
  `nominal_kredit` double DEFAULT NULL,
  `transaksi_debet` varchar(50) NOT NULL,
  `transaksi_kredit` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_update` datetime NOT NULL,
  PRIMARY KEY (`id_jurnal`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table db_bms.tb_kaskeluar
CREATE TABLE IF NOT EXISTS `tb_kaskeluar` (
  `id_kk` int(11) NOT NULL AUTO_INCREMENT,
  `tgltransaksi` datetime DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL,
  `kode_kas_keluar` varchar(255) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status_jurnal` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kk`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_bms.tb_kasmasuk
CREATE TABLE IF NOT EXISTS `tb_kasmasuk` (
  `id_km` int(11) NOT NULL AUTO_INCREMENT,
  `tgltransaksi` datetime DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL,
  `kode_kas_masuk` varchar(255) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `statusjurnal` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`id_km`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_bms.tb_kecamatan
CREATE TABLE IF NOT EXISTS `tb_kecamatan` (
  `id_kecamatan` char(7) NOT NULL,
  `id_kota` char(4) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_kecamatan`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table db_bms.tb_kelas
CREATE TABLE IF NOT EXISTS `tb_kelas` (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `kelas` varchar(50) NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL,
  `id_user` int(11) NOT NULL,
  `tglupdate` datetime NOT NULL,
  PRIMARY KEY (`id_kelas`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table db_bms.tb_kota
CREATE TABLE IF NOT EXISTS `tb_kota` (
  `id_kota` char(4) NOT NULL,
  `id_provinsi` char(4) NOT NULL,
  `name_kota` varchar(255) NOT NULL,
  PRIMARY KEY (`id_kota`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table db_bms.tb_mastercoa
CREATE TABLE IF NOT EXISTS `tb_mastercoa` (
  `id_coa` int(11) NOT NULL AUTO_INCREMENT,
  `kode_coa` varchar(255) DEFAULT NULL,
  `akun` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `neraca` enum('1','0') DEFAULT NULL,
  `perubahan_modal` enum('1','0') DEFAULT NULL,
  `laba_rugi` enum('1','0') DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tglupdate` datetime DEFAULT NULL,
  PRIMARY KEY (`id_coa`),
  UNIQUE KEY `Unique_akun` (`akun`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_bms.tb_mastertransaksi
CREATE TABLE IF NOT EXISTS `tb_mastertransaksi` (
  `id_mastertransaksi` int(11) NOT NULL AUTO_INCREMENT,
  `kodetransaksi` varchar(100) NOT NULL,
  `debet` enum('siswa','koperasi','') DEFAULT '',
  `kredit` enum('siswa','koperasi','') DEFAULT '',
  `kategori` varchar(100) NOT NULL,
  `deskripsi` varchar(250) NOT NULL,
  `nominal` double NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` enum('aktif','tidak') NOT NULL,
  `tgl_update` datetime NOT NULL,
  PRIMARY KEY (`id_mastertransaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table db_bms.tb_menu
CREATE TABLE IF NOT EXISTS `tb_menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(20) NOT NULL,
  `icon` varchar(20) NOT NULL,
  `urutan` int(11) NOT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table db_bms.tb_provinsi
CREATE TABLE IF NOT EXISTS `tb_provinsi` (
  `id_provinsi` char(4) NOT NULL,
  `name_prov` varchar(255) NOT NULL,
  PRIMARY KEY (`id_provinsi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table db_bms.tb_siswa
CREATE TABLE IF NOT EXISTS `tb_siswa` (
  `nis` char(5) NOT NULL,
  `namasiswa` varchar(100) NOT NULL DEFAULT '',
  `alamat` varchar(200) DEFAULT '',
  `tempat_lahir` varchar(30) NOT NULL DEFAULT '',
  `tgl_lahir` varchar(30) DEFAULT '',
  `provinsi` char(2) NOT NULL DEFAULT '',
  `kota` char(4) NOT NULL DEFAULT '',
  `kecamatan` char(7) NOT NULL DEFAULT '',
  `jk` enum('Laki-laki','Perempuan','') NOT NULL DEFAULT '',
  `id_kelas` int(11) NOT NULL DEFAULT 0,
  `tgl_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_user` int(11) NOT NULL DEFAULT 0,
  `status` enum('aktif','alumni','tidak aktif') NOT NULL DEFAULT 'aktif',
  `id_tipeuser` int(11) NOT NULL DEFAULT 2,
  `password` char(8) NOT NULL DEFAULT '',
  `rfid` varchar(100) DEFAULT '',
  `id_tahunakademik` int(11) DEFAULT 0,
  PRIMARY KEY (`nis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table db_bms.tb_staf
CREATE TABLE IF NOT EXISTS `tb_staf` (
  `id_staf` int(11) NOT NULL AUTO_INCREMENT,
  `nopegawai` char(12) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `provinsi` char(2) NOT NULL,
  `kota` char(4) NOT NULL,
  `kecamatan` char(7) NOT NULL,
  `tlp` varchar(12) NOT NULL,
  `id_tipeuser` int(11) NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL,
  `tgl_upddate` datetime NOT NULL,
  `id_user` int(11) NOT NULL,
  `password` char(15) NOT NULL,
  PRIMARY KEY (`id_staf`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table db_bms.tb_submenu
CREATE TABLE IF NOT EXISTS `tb_submenu` (
  `id_submenu` int(11) NOT NULL AUTO_INCREMENT,
  `id_menus` int(11) NOT NULL,
  `submenu` varchar(50) NOT NULL,
  `linksubmenu` varchar(20) NOT NULL,
  `statusmenu` enum('aktif','tidak') NOT NULL,
  PRIMARY KEY (`id_submenu`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table db_bms.tb_tahunakademik
CREATE TABLE IF NOT EXISTS `tb_tahunakademik` (
  `id_tahunakademik` int(11) NOT NULL AUTO_INCREMENT,
  `tglawal` date NOT NULL,
  `tglakhir` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `tglupdate` datetime NOT NULL,
  PRIMARY KEY (`id_tahunakademik`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table db_bms.tb_tipeuser
CREATE TABLE IF NOT EXISTS `tb_tipeuser` (
  `id_tipeuser` int(11) NOT NULL AUTO_INCREMENT,
  `tipeuser` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tipeuser`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table db_bms.tb_transaksi
CREATE TABLE IF NOT EXISTS `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `tipeuser` varchar(20) NOT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `id_jenistransaksi` int(11) NOT NULL,
  `kodetransaksi` varchar(50) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `nominal` double NOT NULL,
  `status_jurnal` enum('0','1') DEFAULT '0',
  `id_user` int(11) NOT NULL,
  `tgl_update` datetime NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table db_bms.tb_userlevel
CREATE TABLE IF NOT EXISTS `tb_userlevel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userlevel` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table db_bms.tb_userlog
CREATE TABLE IF NOT EXISTS `tb_userlog` (
  `id_userlog` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `waktu` datetime NOT NULL,
  `id_submenu` int(11) NOT NULL,
  `ket` varchar(250) NOT NULL,
  PRIMARY KEY (`id_userlog`)
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table db_bms.tb_users
CREATE TABLE IF NOT EXISTS `tb_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `user_level` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for view db_bms.v_siswa
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_siswa` (
	`namasiswa` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
	`nis` CHAR(5) NOT NULL COLLATE 'utf8mb4_general_ci',
	`alamat` VARCHAR(200) NULL COLLATE 'utf8mb4_general_ci',
	`jk` ENUM('Laki-laki','Perempuan','') NOT NULL COLLATE 'utf8mb4_general_ci',
	`status` ENUM('aktif','alumni','tidak aktif') NOT NULL COLLATE 'utf8mb4_general_ci',
	`password` CHAR(8) NOT NULL COLLATE 'utf8mb4_general_ci',
	`tempat_lahir` VARCHAR(30) NOT NULL COLLATE 'utf8mb4_general_ci',
	`tgl_lahir` VARCHAR(30) NULL COLLATE 'utf8mb4_general_ci',
	`id_kelas` INT(11) NOT NULL,
	`rfid` VARCHAR(100) NULL COLLATE 'utf8mb4_general_ci',
	`id_kecamatan` CHAR(7) NOT NULL COLLATE 'utf8mb4_general_ci',
	`kecamatan` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_general_ci',
	`id_kota` CHAR(4) NOT NULL COLLATE 'utf8mb4_general_ci',
	`name_kota` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_general_ci',
	`id_provinsi` CHAR(4) NOT NULL COLLATE 'utf8mb4_general_ci',
	`name_prov` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_general_ci',
	`tglupdate` TIMESTAMP NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for view db_bms.v_siswa
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_siswa`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_siswa` AS select `tb_siswa`.`namasiswa` AS `namasiswa`,`tb_siswa`.`nis` AS `nis`,`tb_siswa`.`alamat` AS `alamat`,`tb_siswa`.`jk` AS `jk`,`tb_siswa`.`status` AS `status`,`tb_siswa`.`password` AS `password`,`tb_siswa`.`tempat_lahir` AS `tempat_lahir`,`tb_siswa`.`tgl_lahir` AS `tgl_lahir`,`tb_siswa`.`id_kelas` AS `id_kelas`,`tb_siswa`.`rfid` AS `rfid`,`tb_kecamatan`.`id_kecamatan` AS `id_kecamatan`,`tb_kecamatan`.`kecamatan` AS `kecamatan`,`tb_kota`.`id_kota` AS `id_kota`,`tb_kota`.`name_kota` AS `name_kota`,`tb_provinsi`.`id_provinsi` AS `id_provinsi`,`tb_provinsi`.`name_prov` AS `name_prov`,`tb_siswa`.`tgl_update` AS `tglupdate` from (((`tb_siswa` join `tb_kecamatan` on(`tb_siswa`.`kecamatan` = `tb_kecamatan`.`id_kecamatan`)) join `tb_kota` on(`tb_siswa`.`kota` = `tb_kota`.`id_kota`)) join `tb_provinsi` on(`tb_siswa`.`provinsi` = `tb_provinsi`.`id_provinsi`)) ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
