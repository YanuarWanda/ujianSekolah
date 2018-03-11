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
  `id_daftar_bidang` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_bank_soal`),
  KEY `id_daftar_bidang` (`id_daftar_bidang`),
  CONSTRAINT `bank_soal_ibfk_1` FOREIGN KEY (`id_daftar_bidang`) REFERENCES `daftar_bidang_keahlian` (`id_daftar_bidang`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `bank_soal` */

insert  into `bank_soal`(`id_bank_soal`,`tipe`,`isi_soal`,`pilihan`,`jawaban`,`id_daftar_bidang`) values 
(1,'BS','<p>OOP singkatan dari Object Oriented Programming</p>','Benar ,  Salah','Benar',1),
(2,'BS','jajaja','Benar ,  Salah','Benar',1),
(3,'BS','jajajafklasdkflasjdflkasdfjldsjflaks','Benar ,  Salah','Benar',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `daftar_bidang_keahlian` */

insert  into `daftar_bidang_keahlian`(`id_daftar_bidang`,`bidang_keahlian`) values 
(1,'Rekayasa Perangkat Lunak'),
(2,'Multimedia'),
(3,'Teknik Komputer dan Jaringan');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

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

/*Table structure for table `jawaban_siswa_remed` */

DROP TABLE IF EXISTS `jawaban_siswa_remed`;

CREATE TABLE `jawaban_siswa_remed` (
  `id_jawaban_remedial` int(11) NOT NULL AUTO_INCREMENT,
  `id_soal_remedial` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `jawaban_siswa` text NOT NULL,
  PRIMARY KEY (`id_jawaban_remedial`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `jawaban_siswa_remed` */

/*Table structure for table `jurusan` */

DROP TABLE IF EXISTS `jurusan`;

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jurusan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_jurusan`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `jurusan` */

insert  into `jurusan`(`id_jurusan`,`nama_jurusan`) values 
(1,'Rekayasa Perangkat Lunak'),
(2,'Multimedia'),
(3,'Teknik Komputer Jaringan'),
(4,'Administrasi Perkantoran'),
(5,'Akuntansi'),
(6,'Pemasaran');

/*Table structure for table `kelas` */

DROP TABLE IF EXISTS `kelas`;

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(20) NOT NULL,
  `id_jurusan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_kelas`),
  KEY `id_jurusan` (`id_jurusan`),
  CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `kelas` */

insert  into `kelas`(`id_kelas`,`nama_kelas`,`id_jurusan`) values 
(1,'XII RPL 1',1),
(2,'XII RPL 2',1),
(3,'XII RPL 3',1),
(4,'XII MM 1',2),
(5,'XII MM 2',2),
(6,'XII TKJ',3),
(7,'X RPL 1',1),
(9,'XI RPL 1',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `mapel` */

insert  into `mapel`(`id_mapel`,`id_daftar_bidang`,`nama_mapel`) values 
(1,1,'Pemrograman Berorientasi Objek'),
(2,1,'Web Dinamis'),
(3,1,'Basis Data');

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
  `status_pengerjaan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_nilai`),
  KEY `id_ujian` (`id_ujian`),
  KEY `nis` (`id_siswa`),
  CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`),
  CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `nilai` */

/*Table structure for table `nilai_remedial` */

DROP TABLE IF EXISTS `nilai_remedial`;

CREATE TABLE `nilai_remedial` (
  `id_nilai_remedial` int(11) NOT NULL AUTO_INCREMENT,
  `id_ujian_remedial` int(11) DEFAULT NULL,
  `jawaban_benar` int(11) NOT NULL,
  `jawaban_salah` int(11) NOT NULL,
  `nilai_remedial` int(11) NOT NULL,
  PRIMARY KEY (`id_nilai_remedial`),
  KEY `id_ujian_remedial` (`id_ujian_remedial`),
  CONSTRAINT `nilai_remedial_ibfk_1` FOREIGN KEY (`id_ujian_remedial`) REFERENCES `ujian_remedial` (`id_ujian_remedial`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `nilai_remedial` */

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
  `tahun_ajaran` varchar(9) DEFAULT NULL COMMENT 'Untuk tahun ajar siswa',
  PRIMARY KEY (`id_siswa`),
  KEY `id_user` (`id_users`),
  KEY `id_kelas` (`id_kelas`),
  CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `siswa` */

insert  into `siswa`(`id_siswa`,`nis`,`id_users`,`id_kelas`,`nama`,`alamat`,`jenis_kelamin`,`foto`,`tahun_ajaran`) values 
(2,'1502011309',5,2,'Fahri Muhamad Zulkarnaen','Jalan Cigondewah Kaler','L','Ijazah_180226_0020_1520310706.jpg','2017-2018'),
(3,'1502011310',6,2,'Fariz','Jalan Pangembangan','L','70525086-b842-4394-8d6b-570d77b084db_1520328021.jpg','2017-2018');

/*Table structure for table `soal` */

DROP TABLE IF EXISTS `soal`;

CREATE TABLE `soal` (
  `id_soal` int(11) NOT NULL AUTO_INCREMENT,
  `id_ujian` int(11) NOT NULL,
  `id_bank_soal` int(11) DEFAULT NULL,
  `point` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_soal`),
  KEY `id_ujian` (`id_ujian`),
  KEY `id_bank_soal` (`id_bank_soal`),
  CONSTRAINT `soal_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`),
  CONSTRAINT `soal_ibfk_2` FOREIGN KEY (`id_bank_soal`) REFERENCES `bank_soal` (`id_bank_soal`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `soal` */

insert  into `soal`(`id_soal`,`id_ujian`,`id_bank_soal`,`point`) values 
(1,2,1,1);

/*Table structure for table `soal_remed` */

DROP TABLE IF EXISTS `soal_remed`;

CREATE TABLE `soal_remed` (
  `id_soal_remedial` int(11) NOT NULL AUTO_INCREMENT,
  `id_ujian_remedial` int(11) NOT NULL,
  `id_bank_soal` int(11) NOT NULL,
  `point` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_soal_remedial`),
  KEY `id_ujian_remedial` (`id_ujian_remedial`),
  KEY `id_bank_soal` (`id_bank_soal`),
  CONSTRAINT `soal_remed_ibfk_1` FOREIGN KEY (`id_ujian_remedial`) REFERENCES `ujian_remedial` (`id_ujian_remedial`),
  CONSTRAINT `soal_remed_ibfk_2` FOREIGN KEY (`id_bank_soal`) REFERENCES `bank_soal` (`id_bank_soal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `soal_remed` */

/*Table structure for table `test_event` */

DROP TABLE IF EXISTS `test_event`;

CREATE TABLE `test_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

/*Data for the table `test_event` */

insert  into `test_event`(`id`) values 
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31),
(32),
(33),
(34),
(35),
(36),
(37),
(38),
(39),
(40),
(41),
(42),
(43),
(44),
(45),
(46),
(47),
(48),
(49),
(50),
(51),
(52),
(53),
(54),
(55),
(56);

/*Table structure for table `ujian` */

DROP TABLE IF EXISTS `ujian`;

CREATE TABLE `ujian` (
  `id_ujian` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.',
  `id_mapel` int(11) NOT NULL COMMENT 'Kolom untuk relasi ke tabel mapel.',
  `id_guru` int(10) unsigned DEFAULT NULL COMMENT 'Kolom untuk relasi ke tabel guru.',
  `judul_ujian` varchar(200) DEFAULT NULL COMMENT 'Judul ujian.',
  `kkm` int(11) NOT NULL COMMENT 'KKM per ujian',
  `waktu_pengerjaan` time NOT NULL COMMENT 'Batas waktu pengerjaan saat ujian.',
  `tanggal_pembuatan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Tanggal pembuatan ujian.',
  `tanggal_post` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Tanggal ujian di post.',
  `tanggal_kadaluarsa` date DEFAULT NULL COMMENT 'Tanggal post akan berakhir',
  `status` varchar(50) NOT NULL DEFAULT 'Draft' COMMENT 'Status ujian antara Draft/Belum di Post atau Posted/Sudah di post.',
  `catatan` text COMMENT 'Catatan tentang ujian.',
  PRIMARY KEY (`id_ujian`),
  KEY `id_mapel` (`id_mapel`),
  KEY `ujian_ibfk_2` (`id_guru`),
  CONSTRAINT `ujian_ibfk_1` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`),
  CONSTRAINT `ujian_ibfk_2` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `ujian` */

insert  into `ujian`(`id_ujian`,`id_mapel`,`id_guru`,`judul_ujian`,`kkm`,`waktu_pengerjaan`,`tanggal_pembuatan`,`tanggal_post`,`tanggal_kadaluarsa`,`status`,`catatan`) values 
(2,1,NULL,'Konsep OOP',0,'01:00:00','2018-03-06 07:14:58','2018-03-06 07:14:58','2018-03-11','posted','Untuk ulangan harian.');

/*Table structure for table `ujian_remedial` */

DROP TABLE IF EXISTS `ujian_remedial`;

CREATE TABLE `ujian_remedial` (
  `id_ujian_remedial` int(11) NOT NULL AUTO_INCREMENT,
  `id_ujian` int(11) DEFAULT NULL,
  `waktu_pengerjaan` time DEFAULT NULL,
  `tanggal_pembuatan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `catatan` text,
  PRIMARY KEY (`id_ujian_remedial`),
  KEY `id_ujian` (`id_ujian`),
  CONSTRAINT `ujian_remedial_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ujian_remedial` */

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id_users`,`username`,`email`,`password`,`remember_token`,`hak_akses`,`created_at`,`updated_at`) values 
(1,'laracry','test@example.com','$2y$10$tDcmXuHyf0qm.vlCHGhf/ufbcrC01o99T0Edz4zbPHI4sdVkUc9ja','hEOSv8KaLRuvhAjwXZlN8s8lJB5ReQykePLAxIZ0wlfoG6ucOIRA6ThexvAB','admin','2018-01-20 22:51:29','2018-01-20 22:51:33'),
(5,'fahri','mzfahri620@gmail.com','$2y$10$fOkp04.6ln1LRK4v.5447.3sXeqypUHvbV5TRujiYTQxpNzAGpzzS','ZK3JPjxkK2bikrZgXcNfAUSRtgVSfYSDmdjK2EffuxxuU7R5ZoyZLCbMTDV0','siswa','2018-03-06 11:31:45','2018-03-06 11:31:45'),
(6,'fariz','fafafa@gmail.com','$2y$10$S0XyU.9cj3k4hiIa.ZBbGuaHcKYgTqQOlFQfi/w5.QYNH/Nrcd8/2',NULL,'siswa','2018-03-06 16:20:21','2018-03-06 16:20:21');

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

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `before_insert_table_siswa` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `before_insert_table_siswa` BEFORE INSERT ON `siswa` FOR EACH ROW BEGIN
	IF MONTH(CURDATE()) < 6
	  THEN SET new.tahun_ajaran = CONCAT((YEAR(CURDATE()) - 1), '/', YEAR(CURDATE()));
	  
	  ELSEIF MONTH(CURDATE()) >= 6
	  THEN SET new.tahun_ajaran = CONCAT((YEAR(CURDATE())), '/', YEAR(CURDATE()) + 1);
	  
	END IF;
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

/*!50106 set global event_scheduler = 1*/;

/* Event structure for event `UNPOST_UJIAN_SAAT_TANGGAL_KADALUARSA` */

/*!50106 DROP EVENT IF EXISTS `UNPOST_UJIAN_SAAT_TANGGAL_KADALUARSA`*/;

DELIMITER $$

/*!50106 CREATE DEFINER=`root`@`localhost` EVENT `UNPOST_UJIAN_SAAT_TANGGAL_KADALUARSA` ON SCHEDULE EVERY 1 DAY STARTS '2018-03-11 10:20:01' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
	UPDATE ujian SET STATUS = IF(ujian.`tanggal_kadaluarsa` = CURDATE(), 'Draft', 'posted');
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
