/*
SQLyog Job Agent v12.09 (64 bit) Copyright(c) Webyog Inc. All Rights Reserved.


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

/*Table structure for table `guru` */

DROP TABLE IF EXISTS `guru`;

CREATE TABLE `guru` (
  `nip` varchar(50) NOT NULL,
  `id` int(10) unsigned NOT NULL,
  `bidang_keahlian` text,
  `nama` varchar(150) NOT NULL,
  `alamat` text,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`nip`),
  KEY `id_user` (`id`),
  CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `guru` */

insert  into `guru` values ('1111231142513',7,'IT','Faroon','Jalan Suka suka','L','nophoto.jpg'),('123456789987654321',10,'IT','Asep McHusen','SetiaBudi','P','nophoto.jpg');

/*Table structure for table `jurusan` */

DROP TABLE IF EXISTS `jurusan`;

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jurusan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_jurusan`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `jurusan` */

insert  into `jurusan` values (1,'Rekayasa Perangkat Lunak'),(2,'Multimedia'),(3,'Teknik Komputer Jaringan'),(4,'Administrasi Perkantoran'),(5,'Akuntansi'),(6,'Pemasaran');

/*Table structure for table `kelas` */

DROP TABLE IF EXISTS `kelas`;

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(20) NOT NULL,
  `id_jurusan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_kelas`),
  KEY `id_jurusan` (`id_jurusan`),
  CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `kelas` */

insert  into `kelas` values (1,'XII RPL 1',1),(2,'XII RPL 2',1),(3,'XII RPL 3',1),(4,'XII MM 1',2),(5,'XII MM 2',2),(6,'XII TKJ',3);

/*Table structure for table `mapel` */

DROP TABLE IF EXISTS `mapel`;

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mapel` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_mapel`)
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
  `nis` varchar(10) NOT NULL,
  `jawaban_benar` int(11) NOT NULL,
  `jawaban_salah` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  PRIMARY KEY (`id_nilai`),
  KEY `id_ujian` (`id_ujian`),
  KEY `nis` (`nis`),
  CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`),
  CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`)
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
  `nis` varchar(10) NOT NULL,
  `id` int(10) unsigned NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` text,
  `jenis_kelamin` char(1) NOT NULL,
  `foto` varchar(50) NOT NULL,
  PRIMARY KEY (`nis`),
  KEY `id_user` (`id`),
  KEY `id_kelas` (`id_kelas`),
  CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `siswa` */

insert  into `siswa` values ('1502011211',17,5,'Testing','Jalan Colang','L','nophoto.jpg'),('1502011276',15,2,'Amalia Nuro','Jln. Sukawarna no. 22 rt03/rw01 Kel. Padjajaran Kec. Cicendo 40173 Pasteur Kota Bandung','L','nophoto.jpg'),('1502011283',14,2,'Asep McHusen','SetiaBudi','L','nophoto.jpg'),('1502011294',11,2,'Dea Fitri Handoko','Marga Glory','P','nophoto.jpg'),('1502011376',13,2,'Muhammad Syaiful Mahialhakim','Jl. Gunung Batu No.58','L','nophoto.jpg'),('1502011455',12,2,'Wendy Setiadi','Coffee Gordon','L','nophoto.jpg'),('1502011462',4,2,'Yanuar Wanda Putar','BumAs Gloriest','L','nophoto.jpg');

/*Table structure for table `soal` */

DROP TABLE IF EXISTS `soal`;

CREATE TABLE `soal` (
  `id_soal` int(11) NOT NULL AUTO_INCREMENT,
  `id_ujian` int(11) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `isi_soal` text NOT NULL,
  `pilihan` text NOT NULL,
  `jawaban` text NOT NULL,
  PRIMARY KEY (`id_soal`),
  KEY `id_ujian` (`id_ujian`),
  CONSTRAINT `soal_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `soal` */

/*Table structure for table `ujian` */

DROP TABLE IF EXISTS `ujian`;

CREATE TABLE `ujian` (
  `id_ujian` int(11) NOT NULL AUTO_INCREMENT,
  `id_mapel` int(11) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `judul_ujian` varchar(50) DEFAULT NULL,
  `waktu_pengerjaan` time NOT NULL,
  `tanggal_post` date NOT NULL,
  `tanggal_kadaluarsa` date NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id_ujian`),
  KEY `id_mapel` (`id_mapel`),
  KEY `nip` (`nip`),
  CONSTRAINT `ujian_ibfk_1` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`),
  CONSTRAINT `ujian_ibfk_2` FOREIGN KEY (`nip`) REFERENCES `guru` (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ujian` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hak_akses` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users` values (1,'laracry','test@example.com','$2y$10$tDcmXuHyf0qm.vlCHGhf/ufbcrC01o99T0Edz4zbPHI4sdVkUc9ja','qeTOzcy2t5TocrKHXh77xhvfzDrOYP52WKDV3aUnR4PSAN5U7qPpBVCEgIsA','admin','2018-01-21 12:51:29','2018-01-21 12:51:33'),(4,'kuyaBaleum','yanuar.wanda2@gmail.com','$2y$10$NEGxXp3pi.bdDcMQnzz3ROtE3RKkrR/txgnPnAIPEtniOcYnyAq9O','hgmpkARFsPFJ663nLJXA7lOHMnRMIvcW1Qx1dIoI2tkTyQsgFNW5pev2xZut','siswa','2018-01-21 06:13:50','2018-01-22 07:24:55'),(5,'a','test@gmail.com','123','kipffpipo','guru','2018-01-21 10:18:20','2018-01-21 10:18:20'),(6,'guruku','tesst@fda.a','$2y$10$402DyxrYWFBvRq91zVvelOoIecg3ZPYhUebCLYMhd0W/d9oEOSbFG',NULL,'guru','2018-01-21 10:38:52','2018-01-21 12:16:57'),(7,'faroon','far@s.co','$2y$10$9byFuVHo5ZYfrR5to0p6R.UWn7T9JISMSw2rmu3RfMeAQlX1hNlkW',NULL,'guru','2018-01-21 12:21:04','2018-01-21 12:21:04'),(10,'ieedes','asep@ima.coo','$2y$10$FFpuYrcL0smYOTTCy0hCyu2BCWLdHugXtr/zONy7f.9aC1yWvbet6',NULL,'guru','2018-01-22 03:08:18','2018-01-22 03:08:18'),(11,'onratus','deafitrih16@gmail.com','$2y$10$cSIr1Ex6CSGeqsviz5SBM.GNTjNz5Nc2P1RC37NFxLad/UKpgfQou','NsSBZaNxuyaPTOsg7l1tzebWqnSBJgThhrS6UcLyBpzjyaotuRqmxo2ifZMz','siswa','2018-01-22 06:06:35','2018-01-22 06:06:35'),(12,'jajang','wsetiawan135790@gmail.com','$2y$10$YOQF5NbSRvxlYASE2T.BMujEoUF49khfBkZJqyvj80St/mp/UBFdG','vebLlRmpy8WaGdoCrZTs0xH9wRjTc8thsyvuiC15hdh9gtQOfqkUMtOUEMoE','siswa','2018-01-22 07:28:47','2018-01-22 07:41:53'),(13,'chihuahua bucin','family.syaiful007@gmail.com','$2y$10$mePDg7sdXsFpzVouP5O1TOXFDZTosdb/lcJ.LoqXoqYr9/Ilw.ceC','b3qXcyXwXvf3Deu3JQmIkJGPZLEfOxLilGbPWNfgIMBtafiX9F5aFBqY6ZoJ','siswa','2018-01-22 07:32:29','2018-01-22 07:32:29'),(14,'iedesu','bang@sa.de','$2y$10$iHyVyW05t1eHfWPocB6Tz.d9cTR8fR.71n3xhMx3UutzFX/5C.OQK','ATrhJnFEKcQPRGqg3pz53NOpYxKGGqJJTx7Kg96NsX17l3fHHMJVsSA2nTSZ','siswa','2018-01-22 07:39:14','2018-01-22 07:40:20'),(15,'Nurok','amalianuro74@gmail.com','$2y$10$/lPLnTtuNVh8Cr7SSgOSsupTBN/W0GFBtv6OcdPxf5hZyoF5k8AsS','QWvzdSKvZvzxa1ftccc3pKAzOlaODzlzySTieF4KK8Ep1GxjQzPZOP4VIgiu','siswa','2018-01-22 07:49:48','2018-01-22 07:49:48'),(16,'DummyStyle','jajangwara@gmail.com','$2y$10$jdwoM5SNOYeXTO8EHYujMuhLz1gQ/UMtAKSqx6GN.QWRC6EZJUbya',NULL,'siswa','2018-01-22 07:54:34','2018-01-22 07:54:34'),(17,'tester','test@example.com','$2y$10$9Mh67CVodNC7Ie3/qLIDGuX2NBr94LfLT07adBXYtrF92ePA.xaye',NULL,'siswa','2018-01-22 13:40:52','2018-01-22 13:43:41');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
