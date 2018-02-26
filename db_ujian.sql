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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `bidang_keahlian` */

insert  into `bidang_keahlian`(`id_bidang_keahlian`,`id_guru`,`id_daftar_bidang`) values 
(1,1,4),
(2,1,6);

/*Table structure for table `daftar_bidang_keahlian` */

DROP TABLE IF EXISTS `daftar_bidang_keahlian`;

CREATE TABLE `daftar_bidang_keahlian` (
  `id_daftar_bidang` int(11) NOT NULL AUTO_INCREMENT,
  `bidang_keahlian` varchar(100) NOT NULL,
  PRIMARY KEY (`id_daftar_bidang`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `daftar_bidang_keahlian` */

insert  into `daftar_bidang_keahlian`(`id_daftar_bidang`,`bidang_keahlian`) values 
(1,'Pendidikan Agama dan Budi Pekerti'),
(2,'PPKn'),
(3,'Bahasa Indonesia'),
(4,'Matematika'),
(5,'Sejarah Indonesia'),
(6,'Bahasa Inggris'),
(7,'Seni Budaya'),
(8,'Prakarya an Kewirausahaan'),
(9,'Penjas, Olahraga & Kesehatan'),
(10,'Pendikikan Lingkungan Hidup'),
(11,'Bahasa Daerah'),
(12,'Bahasa Jepang'),
(13,'Pemrograman Berorientasi Objek'),
(14,'Basis Data'),
(15,'Pemrograman Web Dinamis'),
(16,'Pemrograman Grafik'),
(17,'Pemrograman Perangkat Bergerak'),
(18,'Administrasi Basis Data'),
(19,'Kerja Proyek RPL');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `guru` */

insert  into `guru`(`id_guru`,`nip`,`id_users`,`nama`,`alamat`,`jenis_kelamin`,`foto`) values 
(1,'1234567890987654321',2,'Erika Karata','Jalan Karapitan','P','Screenshot (3)_1519618625.png');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `kelas` */

insert  into `kelas`(`id_kelas`,`nama_kelas`,`id_jurusan`) values 
(1,'XII RPL 1',1),
(2,'XII RPL 2',1),
(3,'XII RPL 3',1),
(4,'XII MM 1',2),
(5,'XII MM 2',2),
(6,'XII TKJ',3);

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
  `nama_mapel` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_mapel`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `mapel` */

insert  into `mapel`(`id_mapel`,`nama_mapel`) values 
(1,'Pendidikan Agama dan Budi Pekerti'),
(2,'PPKn'),
(3,'Bahasa Indonesia'),
(4,'Matematika'),
(5,'Sejarah Indonesia'),
(6,'Bahasa Inggris'),
(7,'Seni Budaya'),
(8,'Prakarya an Kewirausahaan'),
(9,'Penjas, Olahraga & Kesehatan'),
(10,'Pendikikan Lingkungan Hidup'),
(11,'Bahasa Daerah'),
(12,'Bahasa Jepang'),
(13,'Pemrograman Berorientasi Objek'),
(14,'Basis Data'),
(15,'Pemrograman Web Dinamis'),
(16,'Pemrograman Grafik'),
(17,'Pemrograman Perangkat Bergerak'),
(18,'Administrasi Basis Data'),
(19,'Kerja Proyek RPL');

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
  `id_users` int(10) unsigned NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` text,
  `jenis_kelamin` char(1) NOT NULL,
  `foto` varchar(256) NOT NULL,
  PRIMARY KEY (`nis`),
  KEY `id_user` (`id_users`),
  KEY `id_kelas` (`id_kelas`),
  CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `siswa` */

insert  into `siswa`(`nis`,`id_users`,`id_kelas`,`nama`,`alamat`,`jenis_kelamin`,`foto`) values 
('1502011293',3,2,'Daniel Dwi Fortuna','Jalan Cipedes tengah 38, Bandung','L','Ijazah_180226_0025_1519619013.jpg'),
('1502011309',5,2,'Wendy Setiawan','Jalan Kebonkopi 80, Bandung','L','Ijazah_180226_0001_1519619299.jpg'),
('1502011376',4,2,'Muhammad Syaiful Mahialhakim','Jalan Gunungbatu 58, Bandung','L','Ijazah_180226_0013_1519619129.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `soal` */

/*Table structure for table `ujian` */

DROP TABLE IF EXISTS `ujian`;

CREATE TABLE `ujian` (
  `id_ujian` int(11) NOT NULL AUTO_INCREMENT,
  `id_mapel` int(11) NOT NULL,
  `id_guru` int(10) unsigned DEFAULT NULL,
  `judul_ujian` varchar(200) DEFAULT NULL,
  `waktu_pengerjaan` time NOT NULL,
  `tanggal_post` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_kadaluarsa` date NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Draft',
  `catatan` text,
  PRIMARY KEY (`id_ujian`),
  KEY `id_mapel` (`id_mapel`),
  KEY `ujian_ibfk_2` (`id_guru`),
  CONSTRAINT `ujian_ibfk_1` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`),
  CONSTRAINT `ujian_ibfk_2` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `ujian` */

insert  into `ujian`(`id_ujian`,`id_mapel`,`id_guru`,`judul_ujian`,`waktu_pengerjaan`,`tanggal_post`,`tanggal_kadaluarsa`,`status`,`catatan`) values 
(1,6,1,'Things about manners','01:00:00','2018-02-26 12:30:04','2018-02-26','Draft','Ulangan harian'),
(3,12,1,'Ujian Harian','01:00:00','2018-02-26 12:42:33','2018-02-26','Draft','untuk kepentingan laporan');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id_users`,`username`,`email`,`password`,`remember_token`,`hak_akses`,`created_at`,`updated_at`) values 
(1,'laracry','mzfahri620@gmail.com','$2y$10$aVnJAtv0V.Jo4e2Ob0GOFO/2fsdbjC347gNPCPUHYL9wu3Nfsv7sC','uZRmZtsys4AaTcf7wHlGB0vhWeGL3WYjOF87htQX2EB11T4m4CRtpI9x7SLM','admin','2018-02-26 11:11:25','2018-02-26 11:11:30'),
(2,'ErikaZul','erika_zul@gmail.com','$2y$10$Vz81o01vf1SMDHMoGNBboO5wAPGjvk/OQN54NqUQB06p07yrI6IVq','iysGDmJMxELE7nP2dnLcAXNUfdXyqjCfGzUgFb0csYUycsSA0nje2avvQvJ5','guru','2018-02-26 11:17:05','2018-02-26 11:20:25'),
(3,'dnaomissions','danieldwifortuna48@gmail.com','$2y$10$QLDH5YW3laEDwTA17E/roe/YQjURNR2LK/WZunY83sMDzGDwzUgCG',NULL,'siswa','2018-02-26 11:23:33','2018-02-26 11:23:33'),
(4,'lufiays','family.syaiful007@gmail.com','$2y$10$axMteHGXeN16MSzlt3TD0unWosFoCgTtN65BNK84HgifpwEBN54jW',NULL,'siswa','2018-02-26 11:25:29','2018-02-26 11:25:29'),
(5,'wsetiawan','wsetiawan135790@gmail.com','$2y$10$b/Mc1lHX5xJKSgXiUzjwIe1NImR8yui.OIGFJ/baKlD6VvrmLX22G',NULL,'siswa','2018-02-26 11:28:19','2018-02-26 11:28:19');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
