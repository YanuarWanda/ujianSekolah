/*
SQLyog Ultimate v12.09 (64 bit)
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
  `foto` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`nip`),
  KEY `id_user` (`id`),
  CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `guru` */

insert  into `guru`(`nip`,`id`,`bidang_keahlian`,`nama`,`alamat`,`jenis_kelamin`,`foto`) values ('1111231142513',7,'IT','Faroon','Jalan Suka suka','L','nophoto.jpg'),('12345678',24,'YANANAN','YANANA','YANANA','L','nophoto.jpg'),('123456789987654321',10,'IT','Asep McHusen','SetiaBudi','P','2_1517026660.jpg'),('1293819284912',25,'MMAKJDKWAJ','MMAKSJDKASJ','MMADKJWDKADJ','L',NULL),('1431242194871248',23,'jakdjwk','akdjwjdkaw','djakjdkw','L','nophoto.jpg'),('150901293102',21,'Rekayasa Perangkat Lunak','Yanuar Wanda Putra','Jln. Marga Asri VI G. Blok C No 170','L','masyan_1516646821.png'),('182731873812',22,'jdakwdjwka','akjdskawjd','lajkdklawjd','L','13700183_1092905147445894_1933285681459202097_n_1516647055.jpg'),('1958829381923',1,'IT','Admin yang nyamar jadi guru','Jalan Road','L','nophoto.jpg');

/*Table structure for table `jurusan` */

DROP TABLE IF EXISTS `jurusan`;

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jurusan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_jurusan`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `jurusan` */

insert  into `jurusan`(`id_jurusan`,`nama_jurusan`) values (1,'Rekayasa Perangkat Lunak'),(2,'Multimedia'),(3,'Teknik Komputer Jaringan'),(4,'Administrasi Perkantoran'),(5,'Akuntansi'),(6,'Pemasaran');

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

insert  into `kelas`(`id_kelas`,`nama_kelas`,`id_jurusan`) values (1,'XII RPL 1',1),(2,'XII RPL 2',1),(3,'XII RPL 3',1),(4,'XII MM 1',2),(5,'XII MM 2',2),(6,'XII TKJ',3);

/*Table structure for table `mapel` */

DROP TABLE IF EXISTS `mapel`;

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mapel` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_mapel`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `mapel` */

insert  into `mapel`(`id_mapel`,`nama_mapel`) values (1,'Pendidikan Agama dan Budi Pekerti'),(2,'PPKn'),(3,'Bahasa Indonesia'),(4,'Matematika'),(5,'Sejarah Indonesia'),(6,'Bahasa Inggris'),(7,'Seni Budaya'),(8,'Prakarya an Kewirausahaan'),(9,'Penjas, Olahraga & Kesehatan'),(10,'Bahasa Daerah'),(11,'Bahasa Jepang'),(12,'Pemrograman Berorientasi Objek'),(13,'Basis Data'),(14,'Pemrograman Web Dinamis'),(15,'Pemrograman Grafik'),(16,'Pemrograman Perangkat Bergerak'),(17,'Administrasi Basis Data'),(18,'Kerja Proyek RPL');

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
  `foto` varchar(256) NOT NULL,
  PRIMARY KEY (`nis`),
  KEY `id_user` (`id`),
  KEY `id_kelas` (`id_kelas`),
  CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `siswa` */

insert  into `siswa`(`nis`,`id`,`id_kelas`,`nama`,`alamat`,`jenis_kelamin`,`foto`) values ('1502011448',19,2,'MMS','SADMkodakdwo','L','intro_1516645736.jpg'),('1502011462',20,2,'Yanuar Wanda Putra','Jln. Marga Asri VI G. Blok C No 170','L','13700183_1092905147445894_1933285681459202097_n_1517025405.jpg');

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
  `tanggal_post` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_kadaluarsa` date NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Draft',
  `catatan` text,
  PRIMARY KEY (`id_ujian`),
  KEY `id_mapel` (`id_mapel`),
  KEY `nip` (`nip`),
  CONSTRAINT `ujian_ibfk_1` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`),
  CONSTRAINT `ujian_ibfk_2` FOREIGN KEY (`nip`) REFERENCES `guru` (`nip`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `ujian` */

insert  into `ujian`(`id_ujian`,`id_mapel`,`nip`,`judul_ujian`,`waktu_pengerjaan`,`tanggal_post`,`tanggal_kadaluarsa`,`status`,`catatan`) values (2,1,'12345678','JUDUUL','04:00:00','2018-01-09 00:00:00','2018-01-10','Draft','Tidak ada deskripsi.'),(3,1,'1958829381923',NULL,'02:02:00','2018-01-28 20:54:51','2018-01-17','Draft','Tidak ada deskripsi.'),(4,1,'1958829381923','Judul yang ke 3','03:03:00','2018-01-28 20:56:26','2018-01-19','Draft','Tidak ada deskripsi.'),(5,12,'1958829381923','Konsep OOP','01:00:00','2018-01-30 15:20:41','2018-01-30','Draft','Tidak ada deskripsi.'),(6,1,'1958829381923','Test Kejujuran','00:30:00','2018-01-30 15:53:24','2018-01-30','Draft','Tidak ada deskripsi.'),(12,9,'1958829381923','Teori Senam','01:00:00','2018-01-31 14:00:50','2018-01-31','Draft','Tidak ada catatan.'),(13,1,'1958829381923','dfdlsjklaj','00:01:00','2018-01-31 14:08:20','2018-01-31','Draft','ini catatan ulangan.');

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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`email`,`password`,`remember_token`,`hak_akses`,`created_at`,`updated_at`) values (1,'laracry','test@example.com','$2y$10$tDcmXuHyf0qm.vlCHGhf/ufbcrC01o99T0Edz4zbPHI4sdVkUc9ja','ZBbIO1JHpIcbUY8xs9Pa2G5mcMcnQAi8jRiIGw8ysZIrDcf4AbC756dFePoL','admin','2018-01-21 12:51:29','2018-01-21 12:51:33'),(4,'kuyaBaleum','yanuar.wanda2@gmail.com','$2y$10$NEGxXp3pi.bdDcMQnzz3ROtE3RKkrR/txgnPnAIPEtniOcYnyAq9O','hgmpkARFsPFJ663nLJXA7lOHMnRMIvcW1Qx1dIoI2tkTyQsgFNW5pev2xZut','siswa','2018-01-21 06:13:50','2018-01-22 07:24:55'),(5,'a','test@gmail.com','123','kipffpipo','guru','2018-01-21 10:18:20','2018-01-21 10:18:20'),(6,'guruku','tesst@fda.a','$2y$10$402DyxrYWFBvRq91zVvelOoIecg3ZPYhUebCLYMhd0W/d9oEOSbFG',NULL,'guru','2018-01-21 10:38:52','2018-01-21 12:16:57'),(7,'faroon','far@s.co','$2y$10$9byFuVHo5ZYfrR5to0p6R.UWn7T9JISMSw2rmu3RfMeAQlX1hNlkW',NULL,'guru','2018-01-21 12:21:04','2018-01-21 12:21:04'),(10,'ieedes','asep@ima.coo','$2y$10$4TQsUj3KpL27NN3UbkPpU.l2RHN.90PicAbUeH1K0EEXvJjFuxvXu',NULL,'guru','2018-01-22 03:08:18','2018-01-27 04:17:40'),(11,'onratus','deafitrih16@gmail.com','$2y$10$cSIr1Ex6CSGeqsviz5SBM.GNTjNz5Nc2P1RC37NFxLad/UKpgfQou','NsSBZaNxuyaPTOsg7l1tzebWqnSBJgThhrS6UcLyBpzjyaotuRqmxo2ifZMz','siswa','2018-01-22 06:06:35','2018-01-22 06:06:35'),(12,'jajang','wsetiawan135790@gmail.com','$2y$10$YOQF5NbSRvxlYASE2T.BMujEoUF49khfBkZJqyvj80St/mp/UBFdG','vebLlRmpy8WaGdoCrZTs0xH9wRjTc8thsyvuiC15hdh9gtQOfqkUMtOUEMoE','siswa','2018-01-22 07:28:47','2018-01-22 07:41:53'),(13,'chihuahua bucin','family.syaiful007@gmail.com','$2y$10$mePDg7sdXsFpzVouP5O1TOXFDZTosdb/lcJ.LoqXoqYr9/Ilw.ceC','b3qXcyXwXvf3Deu3JQmIkJGPZLEfOxLilGbPWNfgIMBtafiX9F5aFBqY6ZoJ','siswa','2018-01-22 07:32:29','2018-01-22 07:32:29'),(14,'iedesu','bang@sa.de','$2y$10$iHyVyW05t1eHfWPocB6Tz.d9cTR8fR.71n3xhMx3UutzFX/5C.OQK','ATrhJnFEKcQPRGqg3pz53NOpYxKGGqJJTx7Kg96NsX17l3fHHMJVsSA2nTSZ','siswa','2018-01-22 07:39:14','2018-01-22 07:40:20'),(15,'Nurok','amalianuro74@gmail.com','$2y$10$/lPLnTtuNVh8Cr7SSgOSsupTBN/W0GFBtv6OcdPxf5hZyoF5k8AsS','QWvzdSKvZvzxa1ftccc3pKAzOlaODzlzySTieF4KK8Ep1GxjQzPZOP4VIgiu','siswa','2018-01-22 07:49:48','2018-01-22 07:49:48'),(16,'DummyStyle','jajangwara@gmail.com','$2y$10$jdwoM5SNOYeXTO8EHYujMuhLz1gQ/UMtAKSqx6GN.QWRC6EZJUbya',NULL,'siswa','2018-01-22 07:54:34','2018-01-22 07:54:34'),(17,'tester','test@example.com','$2y$10$9Mh67CVodNC7Ie3/qLIDGuX2NBr94LfLT07adBXYtrF92ePA.xaye',NULL,'siswa','2018-01-22 13:40:52','2018-01-22 13:43:41'),(18,'aksjak','ss@s.css','$2y$10$ofsgDtIKUA.AswYUNTsHWO8on2LRjTiWKWyPqvvBr1jqKp.FbnSre',NULL,'siswa','2018-01-22 18:06:53','2018-01-22 18:06:53'),(19,'akabsjsk','ss@s.xxs','$2y$10$kNuINXXb5y.rt.2.nfc8s.oEkAOZDfzg2dxZEfRP7EOIO0L5lo71a',NULL,'siswa','2018-01-22 18:08:33','2018-01-22 18:28:56'),(20,'yanuarwanda','yanuar.wanda22@gmail.com','$2y$10$25GhyiiMHDvKkvwtpvW41el3Ewtiue3IgwfVamgqP6OmseN0CuGQO',NULL,'siswa','2018-01-22 18:35:43','2018-01-27 03:56:45'),(21,'yanuaww','yanuar.wanda221@gmail.co','$2y$10$8rfkDLtXxFX0pIt1u8SA9.qpxEh1mY5pjz42J8cjReNcetJhj9.9a',NULL,'guru','2018-01-22 18:47:01','2018-01-22 18:47:01'),(22,'adwadawd','awdadawd@a.a','$2y$10$3.C0zA76bWFwfhyABZYs8eHqXKCwayXW826SEfVOoFmfanFR.OgF2',NULL,'guru','2018-01-22 18:47:24','2018-01-22 18:50:55'),(23,'1231kjsks','akjdkwad@a.s','$2y$10$tjc3sBT/3QT6IKu.qNSime.LofQokOBNjlLa8G/HdoEw8OE/KbMe6',NULL,'guru','2018-01-22 19:01:12','2018-01-22 19:01:12'),(24,'YANANA','YANANA@NA.NA','$2y$10$9C067KYxaMkW4ZIyeJwDLO1dhvaJxA3s5ipJSTTYCGSBeU..8sEU6',NULL,'guru','2018-01-22 19:02:30','2018-01-22 19:02:30'),(25,'mmmmmmmm','MM@mm.mm','$2y$10$iaZHNRQOzI5GpWum1Es9Y.L7F9Fkq0vTfA3oiZuDxb0iU1avNdKci',NULL,'guru','2018-01-22 19:03:16','2018-01-22 19:03:16');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
