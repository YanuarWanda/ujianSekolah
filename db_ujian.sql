/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.1.26-MariaDB : Database - db_ujian
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_ujian` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_ujian`;

/*Table structure for table `bank_soal` */

DROP TABLE IF EXISTS `bank_soal`;

CREATE TABLE `bank_soal` (
  `id_bank_soal` int(11) NOT NULL AUTO_INCREMENT,
  `tipe` varchar(50) NOT NULL,
  `isi_soal` text NOT NULL,
  `pilihan` text NOT NULL,
  `jawaban` text NOT NULL,
  `point` int(11) NOT NULL,
  PRIMARY KEY (`id_bank_soal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bank_soal` */

/*Table structure for table `bidang_keahlian` */

DROP TABLE IF EXISTS `bidang_keahlian`;

CREATE TABLE `bidang_keahlian` (
  `id_bidang_keahlian` int(11) NOT NULL AUTO_INCREMENT,
  `id_guru` int(11) unsigned DEFAULT NULL,
  `id_daftar_bidang` int(11) NOT NULL,
  PRIMARY KEY (`id_bidang_keahlian`),
  KEY `id_daftar_bidang` (`id_daftar_bidang`),
  KEY `id_guru` (`id_guru`),
  CONSTRAINT `bidang_keahlian_ibfk_2` FOREIGN KEY (`id_daftar_bidang`) REFERENCES `daftar_bidang_keahlian` (`id_daftar_bidang`),
  CONSTRAINT `bidang_keahlian_ibfk_3` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bidang_keahlian` */

/*Table structure for table `daftar_bidang_keahlian` */

DROP TABLE IF EXISTS `daftar_bidang_keahlian`;

CREATE TABLE `daftar_bidang_keahlian` (
  `id_daftar_bidang` int(11) NOT NULL AUTO_INCREMENT,
  `bidang_keahlian` varchar(100) NOT NULL,
  PRIMARY KEY (`id_daftar_bidang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `daftar_bidang_keahlian` */

/*Table structure for table `guru` */

DROP TABLE IF EXISTS `guru`;

CREATE TABLE `guru` (
  `id_guru` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nip` varchar(50) NOT NULL,
  `id_users` int(10) unsigned NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` text,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `foto` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id_guru`),
  KEY `id_user` (`id_users`),
  CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `guru` */

/*Table structure for table `jawaban_siswa` */

DROP TABLE IF EXISTS `jawaban_siswa`;

CREATE TABLE `jawaban_siswa` (
  `id_jawaban` int(11) NOT NULL AUTO_INCREMENT,
  `id_soal` int(11) DEFAULT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `jawaban_siswa` text,
  PRIMARY KEY (`id_jawaban`),
  KEY `id_siswa` (`id_siswa`),
  KEY `id_soal` (`id_soal`),
  CONSTRAINT `jawaban_siswa_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`),
  CONSTRAINT `jawaban_siswa_ibfk_2` FOREIGN KEY (`id_soal`) REFERENCES `soal` (`id_soal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `jawaban_siswa` */

/*Table structure for table `jurusan` */

DROP TABLE IF EXISTS `jurusan`;

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jurusan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_jurusan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `jurusan` */

/*Table structure for table `kelas` */

DROP TABLE IF EXISTS `kelas`;

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(20) NOT NULL,
  `id_jurusan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_kelas`),
  KEY `id_jurusan` (`id_jurusan`),
  CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `kelas` */

/*Table structure for table `kelas_ujian` */

DROP TABLE IF EXISTS `kelas_ujian`;

CREATE TABLE `kelas_ujian` (
  `id_kelas_ujian` int(11) NOT NULL AUTO_INCREMENT,
  `id_ujian` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  PRIMARY KEY (`id_kelas_ujian`),
  KEY `id_ujian` (`id_ujian`),
  KEY `id_kelas` (`id_kelas`),
  CONSTRAINT `kelas_ujian_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`),
  CONSTRAINT `kelas_ujian_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `kelas_ujian` */

/*Table structure for table `mapel` */

DROP TABLE IF EXISTS `mapel`;

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL AUTO_INCREMENT,
  `id_daftar_bidang` int(11) DEFAULT NULL,
  `nama_mapel` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_mapel`),
  KEY `id_daftar_bidang` (`id_daftar_bidang`),
  CONSTRAINT `mapel_ibfk_1` FOREIGN KEY (`id_daftar_bidang`) REFERENCES `daftar_bidang_keahlian` (`id_daftar_bidang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mapel` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

/*Table structure for table `nilai` */

DROP TABLE IF EXISTS `nilai`;

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `id_ujian` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `jawaban_benar` int(11) NOT NULL,
  `jawaban_salah` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  PRIMARY KEY (`id_nilai`),
  KEY `id_ujian` (`id_ujian`),
  KEY `nis` (`id_siswa`),
  CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`),
  CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `nilai` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `siswa` */

DROP TABLE IF EXISTS `siswa`;

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `nis` varchar(10) NOT NULL COMMENT 'Nomor Induk Siswa.',
  `id_users` int(10) unsigned NOT NULL COMMENT 'Kolom untuk relasi ke tabel Users.',
  `id_kelas` int(11) NOT NULL COMMENT 'Kolom untuk relasi ke tabel Kelas',
  `nama` varchar(150) NOT NULL COMMENT 'Nama Siswa.',
  `alamat` text COMMENT 'Alamat Siswa.',
  `jenis_kelamin` char(1) NOT NULL COMMENT 'Jenis Kelamin Siswa.',
  `foto` varchar(256) NOT NULL COMMENT 'Foto Profil Siswa',
  PRIMARY KEY (`id_siswa`),
  KEY `id_user` (`id_users`),
  KEY `id_kelas` (`id_kelas`),
  CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `siswa` */

/*Table structure for table `soal` */

DROP TABLE IF EXISTS `soal`;

CREATE TABLE `soal` (
  `id_soal` int(11) NOT NULL AUTO_INCREMENT,
  `id_ujian` int(11) NOT NULL,
  `id_bank_soal` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_soal`),
  KEY `id_ujian` (`id_ujian`),
  KEY `id_bank_soal` (`id_bank_soal`),
  CONSTRAINT `soal_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`),
  CONSTRAINT `soal_ibfk_2` FOREIGN KEY (`id_bank_soal`) REFERENCES `bank_soal` (`id_bank_soal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `soal` */

/*Table structure for table `ujian` */

DROP TABLE IF EXISTS `ujian`;

CREATE TABLE `ujian` (
  `id_ujian` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.',
  `id_mapel` int(11) NOT NULL COMMENT 'Kolom untuk relasi ke tabel mapel.',
  `id_guru` int(10) unsigned DEFAULT NULL COMMENT 'Kolom untuk relasi ke tabel guru.',
  `judul_ujian` varchar(200) DEFAULT NULL COMMENT 'Judul ujian.',
  `waktu_pengerjaan` time NOT NULL COMMENT 'Batas waktu pengerjaan saat ujian.',
  `tanggal_pembuatan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Tanggal pembuatan ujian.',
  `tanggal_post` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Tanggal ujian di post.',
  `tanggal_kadaluarsa` date NOT NULL COMMENT 'Tanggal ujian akan berakhir.',
  `status` varchar(50) NOT NULL DEFAULT 'Draft' COMMENT 'Status ujian antara Draft/Belum di Post atau Posted/Sudah di post.',
  `catatan` text COMMENT 'Catatan tentang ujian.',
  PRIMARY KEY (`id_ujian`),
  KEY `id_mapel` (`id_mapel`),
  KEY `ujian_ibfk_2` (`id_guru`),
  CONSTRAINT `ujian_ibfk_1` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`),
  CONSTRAINT `ujian_ibfk_2` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ujian` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id_users` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hak_akses` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_users`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

/* Trigger structure for table `daftar_bidang_keahlian` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `hapus_bidang_keahlian_pas_hapus_daftar_bidang_keahlian` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `hapus_bidang_keahlian_pas_hapus_daftar_bidang_keahlian` BEFORE DELETE ON `daftar_bidang_keahlian` FOR EACH ROW BEGIN
	DELETE FROM bidang_keahlian WHERE id_daftar_bidang = old.id_daftar_bidang;
    END */$$


DELIMITER ;

/* Trigger structure for table `guru` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `hapus_user_dan_ujian_pas_hapus_guru` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `hapus_user_dan_ujian_pas_hapus_guru` BEFORE DELETE ON `guru` FOR EACH ROW BEGIN
	DELETE FROM ujian WHERE id_guru = old.id_guru;
	DELETE FROM bidang_keahlian WHERE id_guru = old.id_guru;
    END */$$


DELIMITER ;

/* Trigger structure for table `jurusan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `hapus_kelas_pas_hapus_jurusan` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `hapus_kelas_pas_hapus_jurusan` BEFORE DELETE ON `jurusan` FOR EACH ROW BEGIN
	delete from kelas WHERE id_jurusan = old.id_jurusan;
    END */$$


DELIMITER ;

/* Trigger structure for table `kelas` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `hapus_kelas_ujian_dan_siswa_pas_hapus_kelas` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `hapus_kelas_ujian_dan_siswa_pas_hapus_kelas` BEFORE DELETE ON `kelas` FOR EACH ROW BEGIN
	DELETE FROM kelas_ujian WHERE id_kelas = old.id_kelas;
	DELETE FROM siswa WHERE id_kelas = old.id_kelas;
    END */$$


DELIMITER ;

/* Trigger structure for table `mapel` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `hapus_ujian_pas_hapus_mapel` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `hapus_ujian_pas_hapus_mapel` BEFORE DELETE ON `mapel` FOR EACH ROW BEGIN
	DELETE FROM ujian WHERE id_mapel = old.id_mapel;
    END */$$


DELIMITER ;

/* Trigger structure for table `siswa` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `hapus_nilai_pas_hapus_siswa` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `hapus_nilai_pas_hapus_siswa` BEFORE DELETE ON `siswa` FOR EACH ROW BEGIN
	DELETE FROM nilai WHERE id_siswa = old.id_siswa;
    END */$$


DELIMITER ;

/* Trigger structure for table `ujian` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `hapus_soal_dan_nilai_pas_hapus_ujian` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `hapus_soal_dan_nilai_pas_hapus_ujian` BEFORE DELETE ON `ujian` FOR EACH ROW BEGIN
	DELETE FROM soal WHERE id_ujian = old.id_ujian;
	DELETE FROM nilai WHERE id_ujian = old.id_ujian;
	delete from kelas_ujian WHERE id_ujian = old.id_ujian;
    END */$$


DELIMITER ;

/* Trigger structure for table `users` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `hapus_guru_pas_hapus_users` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `hapus_guru_pas_hapus_users` BEFORE DELETE ON `users` FOR EACH ROW BEGIN
	DELETE FROM guru WHERE id_users = old.id_users;
    END */$$


DELIMITER ;

/*Table structure for table `view_ujian` */

DROP TABLE IF EXISTS `view_ujian`;

/*!50001 DROP VIEW IF EXISTS `view_ujian` */;
/*!50001 DROP TABLE IF EXISTS `view_ujian` */;

/*!50001 CREATE TABLE  `view_ujian`(
 `id_ujian` int(11) ,
 `nama_mapel` varchar(50) ,
 `nama` varchar(150) ,
 `judul_ujian` varchar(200) ,
 `waktu_pengerjaan` time ,
 `tanggal_pembuatan` timestamp ,
 `tanggal_post` timestamp ,
 `tanggal_kadaluarsa` date ,
 `status` varchar(50) ,
 `catatan` text 
)*/;

/*View structure for view view_ujian */

/*!50001 DROP TABLE IF EXISTS `view_ujian` */;
/*!50001 DROP VIEW IF EXISTS `view_ujian` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_ujian` AS (select `u`.`id_ujian` AS `id_ujian`,`m`.`nama_mapel` AS `nama_mapel`,`g`.`nama` AS `nama`,`u`.`judul_ujian` AS `judul_ujian`,`u`.`waktu_pengerjaan` AS `waktu_pengerjaan`,`u`.`tanggal_pembuatan` AS `tanggal_pembuatan`,`u`.`tanggal_post` AS `tanggal_post`,`u`.`tanggal_kadaluarsa` AS `tanggal_kadaluarsa`,`u`.`status` AS `status`,`u`.`catatan` AS `catatan` from ((`ujian` `u` join `mapel` `m` on((`u`.`id_mapel` = `m`.`id_mapel`))) join `guru` `g` on((`u`.`id_guru` = `g`.`id_guru`)))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
