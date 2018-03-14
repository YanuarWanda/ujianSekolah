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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `bank_soal` */

insert  into `bank_soal`(`id_bank_soal`,`tipe`,`isi_soal`,`pilihan`,`jawaban`,`id_daftar_bidang`) values 
(2,'MC','<p>Apakah?</p>','<p>Whenever you are</p> ,  <p>I never said goodbye</p> ,  <p>i promise you forever right now</p> ,  ','<p>I never said goodbye</p> ,  <p>i promise you forever right now</p> ,  ',1),
(3,'PG','<p>Ini Soal untuk no 2</p>','<p>Ini Pilihan A</p> ,  <p>Ini Pilihan B</p> ,  <p>Ini Pilihan C</p> ,  <p>Ini Pilihan D</p> ,  <p>Ini Pilihan E</p>','<p>Ini Pilihan E</p>',1),
(4,'MC','<p>Soal asd</p>','<p>A asd</p> ,   ,  <p>C dsa</p> ,  <p>D FDS</p> ,  <p>E ddd</p>',' ,   ,   ,  <p>D FDS</p> ,  <p>E ddd</p>',1),
(5,'MC','<p>sssssasassa</p>','<p>saddsdarqsa</p> ,  <p>sdfdfeee</p> ,  <p>efwwefef</p> ,  <p>sdfgfbxcbg</p> ,  ','<p>saddsdarqsa</p> ,   ,   ,  <p>sdfgfbxcbg</p> ,  ',1),
(6,'MC','<p>iNIA SIAPOL</p>','<p>AISDJIAWDNI</p> ,  <p>BAJWDIAJWDI</p> ,  <p>CWOKOAKOD</p> ,  <p>DOWJROWAJ</p> ,  <p>EADKLADS</p>','<p>AISDJIAWDNI</p> ,   ,   ,   ,   ,   ,   ,  <p>CWOKOAKOD</p> ,   ,   ,   ,   ,   ,   ,  <p>EADKLADS</p> ,  ',1),
(7,'MC','<p>Ini SOal bODY</p>','<p>A Yah</p> ,  <p>B Yah</p> ,  <p>C Yeh</p> ,  <p>D yUH</p> ,  <p>E maamam</p>','<p>B Yah</p> ,   ,   ,   ,  <p>D yUH</p> ,   ,  ',1),
(8,'MC','<p>Ini Soal</p>','<p>Ini Pilihan A</p> ,  <p>Ini Pilihan B</p> ,  <p>Ini Pilihan C</p> ,  <p>Ini Pilihan D</p> ,  <p>Ini Pilihan E</p>',' ,  <p>Ini Pilihan B</p> ,   ,   ,  <p>Ini Pilihan E</p>',1),
(9,'BS','<p>Ini SOal bENAR Salah</p>','Benar ,  Salah','Salah',NULL),
(10,'PG','<p>Ini teh jawabannnya A</p>','<p>Kalo jawab ini bener</p> ,   ,  <p>jawab ini salah</p> ,   ,  <p>Jawab ini juga salah</p>','<p>Kalo jawab ini bener</p>',1),
(11,'BS','<p>biar gampang</p>','Benar ,  Salah','Salah',1),
(12,'BS','<p>biar gampang</p>','Benar ,  Salah','Salah',1),
(13,'MC','<p>biar gampang 5</p>','<p>ABC</p> ,  <p>DEF</p> ,   ,  <p>GHI</p> ,  ','<p>ABC</p> ,  <p>DEF</p> ,   ,  <p>GHI</p> ,  ',1),
(14,'MC','<p>asdasd</p>','<p>dsadsa</p> ,  <p>ssssss</p> ,  <p>asdqwe</p> ,   ,  ','<p>dsadsa</p> ,   ,  <p>asdqwe</p> ,   ,  ',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `bidang_keahlian` */

insert  into `bidang_keahlian`(`id_bidang_keahlian`,`id_guru`,`id_daftar_bidang`) values 
(1,4,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `guru` */

insert  into `guru`(`id_guru`,`nip`,`id_users`,`nama`,`alamat`,`jenis_kelamin`,`foto`) values 
(4,'12345678912345678912',5,'Yesterday Once More','Jalan Hati','P','nophoto.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `jawaban_siswa` */

insert  into `jawaban_siswa`(`id_jawaban`,`id_soal`,`id_siswa`,`jawaban_siswa`) values 
(1,2,1,'<p>Ini Pilihan E</p>'),
(2,3,1,'<p>D FDS</p> ,  <p>E ddd</p>'),
(3,4,1,'<p>saddsdarqsa</p> ,  <p>dfsgweerre</p>'),
(4,7,1,'<p>Ini Pilihan B</p> ,  <p>Ini Pilihan E</p>'),
(5,2,2,'<p>Ini Pilihan C</p>'),
(6,3,2,'<p>D FDS</p> ,  <p>E ddd</p>'),
(7,4,2,'<p>saddsdarqsa</p> ,  <p>sdfdfeee</p>'),
(8,7,2,'<p>Ini Pilihan B</p> ,  <p>Ini Pilihan D</p>'),
(9,2,8,'<p>Ini Pilihan B</p>'),
(10,3,8,'<p>A asd</p> ,  <p>C dsa</p>'),
(11,4,8,'<p>sdfdfeee</p> ,  <p>efwwefef</p> ,  <p>sdfgfbxcbg</p>'),
(12,7,8,'<p>Ini Pilihan B</p> ,  <p>Ini Pilihan D</p> ,  <p>Ini Pilihan E</p>'),
(13,8,1,'Benar'),
(14,9,1,'<p>jawab ini salah</p>');

/*Table structure for table `jawaban_siswa_remed` */

DROP TABLE IF EXISTS `jawaban_siswa_remed`;

CREATE TABLE `jawaban_siswa_remed` (
  `id_jawaban_remedial` int(11) NOT NULL AUTO_INCREMENT,
  `id_soal_remedial` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `jawaban_siswa` text NOT NULL,
  PRIMARY KEY (`id_jawaban_remedial`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `jawaban_siswa_remed` */

insert  into `jawaban_siswa_remed`(`id_jawaban_remedial`,`id_soal_remedial`,`id_siswa`,`jawaban_siswa`) values 
(6,2,1,'<p>dsadsa</p> ,  <p>ssssss</p> ,  <p>asdqwe</p>');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `kelas_ujian` */

insert  into `kelas_ujian`(`id_kelas_ujian`,`id_ujian`,`id_kelas`) values 
(2,4,2),
(4,5,2),
(9,3,1),
(10,3,2);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `nilai` */

insert  into `nilai`(`id_nilai`,`id_ujian`,`id_siswa`,`jawaban_benar`,`jawaban_salah`,`nilai`,`status_pengerjaan`) values 
(2,4,1,3,1,75,NULL),
(3,4,2,1,3,6,NULL),
(4,4,8,0,4,0,'Harus Remedial'),
(5,3,1,0,1,0,'Harus Remedial'),
(6,5,1,0,1,0,'Harus Remedial');

/*Table structure for table `nilai_remedial` */

DROP TABLE IF EXISTS `nilai_remedial`;

CREATE TABLE `nilai_remedial` (
  `id_nilai_remedial` int(11) NOT NULL AUTO_INCREMENT,
  `id_siswa` int(11) NOT NULL,
  `id_ujian_remedial` int(11) DEFAULT NULL,
  `jawaban_benar` int(11) NOT NULL,
  `jawaban_salah` int(11) NOT NULL,
  `nilai_remedial` int(11) NOT NULL,
  PRIMARY KEY (`id_nilai_remedial`),
  KEY `id_ujian_remedial` (`id_ujian_remedial`),
  KEY `id_siswa` (`id_siswa`),
  CONSTRAINT `nilai_remedial_ibfk_1` FOREIGN KEY (`id_ujian_remedial`) REFERENCES `ujian_remedial` (`id_ujian_remedial`),
  CONSTRAINT `nilai_remedial_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `nilai_remedial` */

insert  into `nilai_remedial`(`id_nilai_remedial`,`id_siswa`,`id_ujian_remedial`,`jawaban_benar`,`jawaban_salah`,`nilai_remedial`) values 
(2,1,3,0,1,0);

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
  `tahun_ajaran` varchar(25) NOT NULL COMMENT 'Tahun Ajaran siswa.',
  PRIMARY KEY (`id_siswa`),
  KEY `id_user` (`id_users`),
  KEY `id_kelas` (`id_kelas`),
  CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `siswa` */

insert  into `siswa`(`id_siswa`,`nis`,`id_users`,`id_kelas`,`nama`,`alamat`,`jenis_kelamin`,`foto`,`tahun_ajaran`) values 
(1,'1502011462',6,2,'Yanuar Wanda Putra','Jalan Marga Asri VI G.','L','masyan_1520261258.png',''),
(2,'1502011455',7,2,'Wendy Setiawan','Coffee Garden Street','L','nophoto.jpg',''),
(3,'1502011463',8,1,'Riki Subagja','Jalan Deket Rumah Saya','L','nophoto.jpg',''),
(4,'1502011464',9,3,'Whisnu Mulya Pratama','Pasar Atas','L','IMG_20151017_125747_1520261470.jpg',''),
(5,'1502011465',10,4,'Muhammad Rizal','Pasar Pojok','L','IMG_20150923_101330_1520261586.jpg',''),
(6,'1502011466',11,5,'Ngudi Prasodjo','Jalan Padjajaran Deket SMKN 12 Bandung','L','IMG_1164_1520261665.JPG',''),
(7,'1502011467',12,6,'Muhammad Fauzan Faturrahman','Jamika','L','Screenshot (160)_1519920644_1520261801.png',''),
(8,'1502011341',13,2,'Kukuh MangkuHidayatullah','Ciroyom','L','imam-al-ghazali_1520387616.jpg','');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `soal` */

insert  into `soal`(`id_soal`,`id_ujian`,`id_bank_soal`,`point`) values 
(2,4,3,5),
(3,4,4,2),
(4,4,5,15),
(7,4,8,12),
(8,3,9,5),
(9,5,10,6);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `soal_remed` */

insert  into `soal_remed`(`id_soal_remedial`,`id_ujian_remedial`,`id_bank_soal`,`point`) values 
(2,3,14,5),
(3,3,2,10),
(4,3,6,10);

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
  `tanggal_kadaluarsa` date NOT NULL COMMENT 'Tanggal ujian akan berakhir.',
  `status` varchar(50) NOT NULL DEFAULT 'Draft' COMMENT 'Status ujian antara Draft/Belum di Post atau Posted/Sudah di post.',
  `catatan` text COMMENT 'Catatan tentang ujian.',
  PRIMARY KEY (`id_ujian`),
  KEY `id_mapel` (`id_mapel`),
  KEY `ujian_ibfk_2` (`id_guru`),
  CONSTRAINT `ujian_ibfk_1` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`),
  CONSTRAINT `ujian_ibfk_2` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `ujian` */

insert  into `ujian`(`id_ujian`,`id_mapel`,`id_guru`,`judul_ujian`,`kkm`,`waktu_pengerjaan`,`tanggal_pembuatan`,`tanggal_post`,`tanggal_kadaluarsa`,`status`,`catatan`) values 
(3,1,4,'asda',75,'02:00:00','2018-03-05 22:06:11','2018-03-05 22:06:11','2018-03-12','posted','Tidak ada catatan.'),
(4,1,4,'UTS Pemrograman Berorientasi Objek',75,'02:00:00','2018-03-06 13:48:55','2018-03-06 13:48:55','2018-03-06','posted','Tidak ada catatan.'),
(5,2,4,'UAS Web Dinamis',80,'02:00:00','2018-03-10 20:16:04','2018-03-10 20:16:04','2018-03-01','posted','Ini UAS Loh!');

/*Table structure for table `ujian_remedial` */

DROP TABLE IF EXISTS `ujian_remedial`;

CREATE TABLE `ujian_remedial` (
  `id_ujian_remedial` int(11) NOT NULL AUTO_INCREMENT,
  `id_ujian` int(11) DEFAULT NULL,
  `waktu_pengerjaan` time DEFAULT NULL,
  `tanggal_pembuatan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `catatan` text,
  `tanggal_kadaluarsa` timestamp NULL DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Belum Selesai',
  PRIMARY KEY (`id_ujian_remedial`),
  KEY `id_ujian` (`id_ujian`),
  CONSTRAINT `ujian_remedial_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `ujian_remedial` */

insert  into `ujian_remedial`(`id_ujian_remedial`,`id_ujian`,`waktu_pengerjaan`,`tanggal_pembuatan`,`catatan`,`tanggal_kadaluarsa`,`status`) values 
(3,3,'02:05:00','2018-03-10 20:26:36','Tidak ada catatan. 2','2018-03-14 10:19:41','posted'),
(4,5,'02:00:00','2018-03-10 20:26:44','Tidak ada catatan.','2018-03-14 10:19:49','Belum Selesai');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id_users`,`username`,`email`,`password`,`remember_token`,`hak_akses`,`created_at`,`updated_at`) values 
(5,'yesterdayoncemore','yesterday.once@gmail.com','$2y$10$7nWogqSU1MEMCH2VAiO1XedWhrc9GcdQCpjhKrRXaHOrGo58lfJei','hE3rnye2qyEec1CTx8VxRMxo26wbtRjW1ysxr1KqWlBmJJC50hzmUzPhNN6O','guru','2018-03-05 21:46:34','2018-03-05 21:46:34'),
(6,'yanuarwanda','yanuar.wanda2@gmail.com','$2y$10$V2EqzIhM2H.p2jnCz5ncxeqZ1bXBSjDzA.5hqSC8ifFK.pL.Yx5o2','9Md9TV70aMJWFqmyXJc9Lc8l6N2ZB9Ylv715sR6RlC7bCIEkuwjjNjgyEAvI','siswa','2018-03-05 21:47:38','2018-03-05 21:47:38'),
(7,'wsetiawan','wendy.setiawan@gmail.com','$2y$10$dRq8No6Uu8Rwh0SZehdyEODAfrnmDZQfK4hmkPMPAdX3qL3IOReRS','C47GrMriOH3ZJKT2LPRGGWdepxDqehNeuvBsJnZPk2qDWFDccXZD1H61w27T','siswa','2018-03-05 21:48:21','2018-03-05 21:48:21'),
(8,'bagja','riki.subagja@gmail.com','$2y$10$yT3WhV84zW0OvwHmvY/dF.gNrfWgOFn9YTLKfdDSGLiU5gbp8V4ey','T5nT3JpZGMwZfCmnAcmcOEc7mkUGC5eLKsHXzIq69rDFPxYfYx0Ky6ltrnkO','siswa','2018-03-05 21:48:47','2018-03-05 21:48:47'),
(9,'blackluther','whisnu.mulya@gmail.com','$2y$10$68fDnS3gxr3ohyZddZ783.y4P2bPz9EgCjwkSRNtZjHeqFHYMu8u6',NULL,'siswa','2018-03-05 21:51:10','2018-03-05 21:51:20'),
(10,'rizal2','vectorarts@gmail.com','$2y$10$WNFJPqISzl7h1r7NNuXFUeEkKd5csLyBvZIpRT2trSrfhOQcL5yFe',NULL,'siswa','2018-03-05 21:53:06','2018-03-05 21:53:06'),
(11,'npras','n.pras@gmail.com','$2y$10$p/LphJvxZomwRgILmYEx7uQD3o5f4EbsPo8B6pN91Gkq/S.Dk6Eyq',NULL,'siswa','2018-03-05 21:54:25','2018-03-05 21:54:25'),
(12,'jantung','hentaikyun@gmail.com','$2y$10$NF10r/vY2Pec4b5hHlL1d.XcbQYp5VudISoFb1OZjIRJa2WcBE8Y6',NULL,'siswa','2018-03-05 21:56:41','2018-03-05 21:56:41'),
(13,'pelog','kukuhpelog15@gmail.com','$2y$10$D3tCUwkSghHlxd1BBCxJbOaQ44Hytvs91rxJYzXmWcDnVA.UaZZDa','GHNzzq5VEUYaOT9FQM6HlXPdFpLSNeLSVzrt9FqaPc8KcFUOVT3ptfrmhxv4','siswa','2018-03-07 08:53:36','2018-03-07 08:53:36'),
(14,'laracry','mzfahri620@gmail.com','$2y$10$tDcmXuHyf0qm.vlCHGhf/ufbcrC01o99T0Edz4zbPHI4sdVkUc9ja',NULL,'admin','2018-03-13 21:39:31','2018-03-13 21:39:35');

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
    /* Proses nambah tahun_ajaran ke table siswa yang mau di insert */
 IF MONTH(CURDATE() ) < 6 THEN
  SET new.tahun_ajaran = CONCAT((YEAR(CURDATE())-1), '/', YEAR(CURDATE()));
 ELSEIF MONTH(CURDATE()) >= 6 THEN
  SET new.tahun_ajaran = CONCAT((YEAR(CURDATE())), '/', YEAR(CURDATE())+1);
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

/* Event structure for event `UNPOST_UJIAN_REMED_SAAT_TANGGAL_KADALUARSA` */

/*!50106 DROP EVENT IF EXISTS `UNPOST_UJIAN_REMED_SAAT_TANGGAL_KADALUARSA`*/;

DELIMITER $$

/*!50106 CREATE DEFINER=`root`@`localhost` EVENT `UNPOST_UJIAN_REMED_SAAT_TANGGAL_KADALUARSA` ON SCHEDULE EVERY 1 DAY STARTS '2018-03-11 10:20:01' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
	/* Meng unpost ujian jika sudah kadaluarsa */
	UPDATE ujian_remedial SET STATUS = IF(ujian_remedial.`tanggal_kadaluarsa` = CURDATE(), 'Sudah Selesai', 'posted');
	
	/* Menginput semua siswa yang belum mengerjakan ke table nilai dengan status harus susulan */
	CALL insert_data_siswa_saat_remed_kadaluarsa(`ujian_remedial`.`id_ujian_remedial`);

		
	END */$$
DELIMITER ;

/* Event structure for event `UNPOST_UJIAN_SAAT_TANGGAL_KADALUARSA` */

/*!50106 DROP EVENT IF EXISTS `UNPOST_UJIAN_SAAT_TANGGAL_KADALUARSA`*/;

DELIMITER $$

/*!50106 CREATE DEFINER=`root`@`localhost` EVENT `UNPOST_UJIAN_SAAT_TANGGAL_KADALUARSA` ON SCHEDULE EVERY 1 DAY STARTS '2018-03-11 10:20:01' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
	/* Meng unpost ujian jika sudah kadaluarsa */
	UPDATE ujian SET STATUS = IF(ujian.`tanggal_kadaluarsa` = CURDATE(), 'Draft', 'posted');
	
	/* Menginput semua siswa yang belum mengerjakan ke table nilai dengan status harus susulan */
	CALL insert_data_siswa_saat_tanggal_kadaluarsa(ujian.`id_ujian`);
		
	END */$$
DELIMITER ;

/* Procedure structure for procedure `insert_data_siswa_saat_remed_kadaluarsa` */

/*!50003 DROP PROCEDURE IF EXISTS  `insert_data_siswa_saat_remed_kadaluarsa` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_data_siswa_saat_remed_kadaluarsa`( id_ujian_asli int )
BEGIN
	SELECT COUNT(id_soal_remedial) FROM soal_remed WHERE id_ujian_remedial = id_ujian_asli INTO @jumlahSoal;
	/* Insert semua siswa yang belum mengerjakan ke table nilai dengan status harus susulan */
	INSERT INTO nilai_remedial (id_ujian_remedial, id_siswa, jawaban_benar, jawaban_salah, nilai_remedial)
	SELECT id_ujian_asli,
		id_siswa,
		0,
		@jumlahSoal,
		0
	FROM siswa JOIN kelas_ujian USING (id_kelas) WHERE id_ujian = id_ujian_asli  AND id_siswa NOT IN (SELECT id_siswa FROM nilai);
	END */$$
DELIMITER ;

/* Procedure structure for procedure `insert_data_siswa_saat_tanggal_kadaluarsa` */

/*!50003 DROP PROCEDURE IF EXISTS  `insert_data_siswa_saat_tanggal_kadaluarsa` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_data_siswa_saat_tanggal_kadaluarsa`( id_ujian_asli int )
BEGIN	
SELECT COUNT(id_soal) FROM soal where id_ujian = id_ujian_asli into @jumlahSoal;
/* Insert semua siswa yang belum mengerjakan ke table nilai dengan status harus susulan */
insert into nilai (id_ujian, id_siswa, jawaban_benar, jawaban_salah, nilai, status_pengerjaan)
select id_ujian_asli,
	id_siswa,
	0,
	@jumlahSoal,
	0,
	'Harus Susulan'
FROM siswa JOIN kelas_ujian USING (id_kelas) WHERE id_ujian = id_ujian_asli  AND id_siswa NOT IN (SELECT id_siswa FROM nilai);

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
