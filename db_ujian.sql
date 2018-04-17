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
  CONSTRAINT `bank_soal_ibfk_1` FOREIGN KEY (`id_daftar_bidang`) REFERENCES `daftar_bidang_keahlian` (`id_daftar_bidang`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `bank_soal` */

insert  into `bank_soal`(`id_bank_soal`,`tipe`,`isi_soal`,`pilihan`,`jawaban`,`id_daftar_bidang`) values 
(1,'PG','<p>DML merupakan singkatan dari ...</p>','<p>Data Main Language</p> ,  <p>Data Manipulation Listener</p> ,  <p>Data Manipulation Language</p> ,   ,  ','<p>Data Manipulation Language</p>',1),
(2,'BS','<p>Query <code>SELECT</code> dalam MYSQL merupakan salah satu contoh dari DDL.</p>','Benar ,  Salah','Benar',1),
(3,'MC','<p>Berikut ini merupakan beberapa contoh dari DML, yaitu ... <em>(pilih 3)</em></p>','<p><code>INSERT&nbsp; INTO ...</code></p> ,  <p><code>SELECT * FROM ...</code></p> ,  <p><code>DELETE FROM ...</code></p> ,  <p><code>UPDATE ...</code></p> ,  ','<p><code>INSERT&nbsp; INTO ...</code></p> ,   ,  <p><code>DELETE FROM ...</code></p> ,  <p><code>UPDATE ...</code></p> ,  ',1),
(4,'PG','<p>Saat ini, Bahasa pemrograman&nbsp;PHP merupakan kependekan dari...</p>','<p>Personal Home Page</p> ,  <p>PHP: Hypertext Preprocessor</p> ,  <p>Parents Helping Parents</p> ,  <p>Pre Hypertext Processor</p> ,  <p>Pemberi Harapan Palsu</p>','<p>PHP: Hypertext Preprocessor</p>',1),
(5,'BS','<p><code>var x</code> merupakan inisialisasi variable pada PHP</p>','Benar ,  Salah','Salah',1),
(6,'MC','<p>Contoh variable dalam PHP yaitu...</p>','<p>$test</p> ,  <p>$cd</p> ,  <p>var x</p> ,  <p>_$as</p> ,  ','<p>$test</p> ,  <p>$cd</p> ,   ,   ,  ',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `bidang_keahlian` */

insert  into `bidang_keahlian`(`id_bidang_keahlian`,`id_guru`,`id_daftar_bidang`) values 
(3,1,1),
(4,1,2),
(5,2,1),
(6,2,3);

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
(2,'Teknik Komputer Jaringan'),
(3,'Multimedia');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `guru` */

insert  into `guru`(`id_guru`,`nip`,`id_users`,`nama`,`alamat`,`jenis_kelamin`,`foto`) values 
(1,'196211051986032008',2,'Dr. Sukawati Raisa, M.MPd','Jalan pegasan timur no. 5','P','nophoto.jpg'),
(2,'196211051986032001',3,'Jajang Nurjamal,  S.Pd','Jalan Kebon Ciroyom no. 13','L','Ijazah_180226_0004_1523798082.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

/*Data for the table `jawaban_siswa` */

insert  into `jawaban_siswa`(`id_jawaban`,`id_soal`,`id_siswa`,`jawaban_siswa`) values 
(1,1,1,'<p>Data Manipulation Listener</p>'),
(2,2,1,'Benar'),
(3,3,1,'<p><code>UPDATE ...</code></p> ,  <p><code>DELETE FROM ...</code></p> ,  <p><code>INSERT  INTO ...</code></p>'),
(4,1,7,'<p>Data Manipulation Language</p>'),
(5,2,7,'Benar'),
(6,3,7,'<p><code>DELETE FROM ...</code></p> ,  <p><code>INSERT  INTO ...</code></p> ,  <p><code>UPDATE ...</code></p> ,  <p><code>SELECT * FROM ...</code></p>'),
(7,1,2,'<p>Data Manipulation Listener</p>'),
(8,2,2,'Salah'),
(9,3,2,'<p><code>SELECT * FROM ...</code></p>'),
(10,1,8,'<p>Data Manipulation Language</p>'),
(11,2,8,'Benar'),
(12,3,8,'<p><code>DELETE FROM ...</code></p> ,  <p><code>INSERT  INTO ...</code></p> ,  <p><code>UPDATE ...</code></p>'),
(13,1,4,'<p>Data Main Language</p>'),
(14,2,4,'Benar'),
(15,3,4,'<p><code>INSERT  INTO ...</code></p> ,  <p><code>UPDATE ...</code></p> ,  <p><code>DELETE FROM ...</code></p>'),
(16,1,5,'<p>Data Manipulation Language</p>'),
(17,2,5,'Benar'),
(18,3,5,'<p><code>INSERT  INTO ...</code></p> ,  <p><code>UPDATE ...</code></p> ,  <p><code>DELETE FROM ...</code></p>'),
(19,1,6,'<p>Data Manipulation Language</p>'),
(20,2,6,'Benar'),
(21,3,6,'<p><code>UPDATE ...</code></p> ,  <p><code>DELETE FROM ...</code></p> ,  <p><code>INSERT  INTO ...</code></p>'),
(22,1,9,'<p>Data Manipulation Language</p>'),
(23,2,9,'Benar'),
(24,3,9,'<p><code>INSERT  INTO ...</code></p> ,  <p><code>UPDATE ...</code></p> ,  <p><code>DELETE FROM ...</code></p>'),
(25,4,2,'<p>Pre Hypertext Processor</p>'),
(26,5,2,'Benar'),
(27,4,9,'<p>Personal Home Page</p>'),
(28,5,9,'Salah'),
(29,4,8,'<p>PHP: Hypertext Preprocessor</p>'),
(30,5,8,'Salah'),
(31,4,4,'<p>Pemberi Harapan Palsu</p>'),
(32,5,4,'Benar'),
(33,4,7,'<p>Pre Hypertext Processor</p>'),
(34,5,7,'Benar');

/*Table structure for table `jawaban_siswa_remed` */

DROP TABLE IF EXISTS `jawaban_siswa_remed`;

CREATE TABLE `jawaban_siswa_remed` (
  `id_jawaban_remedial` int(11) NOT NULL AUTO_INCREMENT,
  `id_soal_remedial` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `jawaban_siswa` text NOT NULL,
  PRIMARY KEY (`id_jawaban_remedial`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `jawaban_siswa_remed` */

insert  into `jawaban_siswa_remed`(`id_jawaban_remedial`,`id_soal_remedial`,`id_siswa`,`jawaban_siswa`) values 
(1,1,9,'<p>Data Manipulation Language</p>'),
(2,2,9,'Benar'),
(3,1,6,'<p>Data Manipulation Language</p>'),
(4,2,6,'Benar'),
(5,1,4,'<p>Data Manipulation Language</p>'),
(6,2,4,'Benar'),
(7,1,2,'<p>Data Manipulation Language</p>'),
(8,2,2,'Benar'),
(9,3,9,'<p>$test</p> ,  <p>$cd</p>'),
(10,4,9,'Benar'),
(11,5,9,'<p>$test</p> ,  <p>$cd</p>'),
(12,3,2,'<p>$test</p> ,  <p>$cd</p>'),
(13,4,2,'Salah'),
(14,5,2,'<p>$test</p> ,  <p>$cd</p>'),
(15,5,4,'<p>$test</p> ,  <p>$cd</p>'),
(16,6,4,'Salah'),
(17,4,4,'Salah'),
(18,1,8,'<p>Data Manipulation Language</p>'),
(19,2,8,'Benar'),
(20,3,7,'<p>var x</p> ,  <p>_$as</p>'),
(21,4,7,'Salah'),
(22,5,7,'<p>$test</p> ,  <p>$cd</p>'),
(23,6,7,'Salah');

/*Table structure for table `jurusan` */

DROP TABLE IF EXISTS `jurusan`;

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jurusan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_jurusan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `jurusan` */

insert  into `jurusan`(`id_jurusan`,`nama_jurusan`) values 
(1,'RPL'),
(2,'MM'),
(3,'TKJ');

/*Table structure for table `kelas` */

DROP TABLE IF EXISTS `kelas`;

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(20) NOT NULL,
  `id_jurusan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_kelas`),
  KEY `id_jurusan` (`id_jurusan`),
  CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `kelas` */

insert  into `kelas`(`id_kelas`,`nama_kelas`,`id_jurusan`) values 
(1,'XII RPL 1',1),
(2,'XII RPL 2',1),
(3,'XII RPL 3',1),
(4,'XII TKJ',3),
(5,'XII MM 1',2),
(6,'XII MM 2',2),
(8,'ALUMNI RPL 2',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `kelas_ujian` */

insert  into `kelas_ujian`(`id_kelas_ujian`,`id_ujian`,`id_kelas`) values 
(1,1,2),
(2,2,2);

/*Table structure for table `mapel` */

DROP TABLE IF EXISTS `mapel`;

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL AUTO_INCREMENT,
  `id_daftar_bidang` int(11) DEFAULT NULL,
  `nama_mapel` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_mapel`),
  KEY `id_daftar_bidang` (`id_daftar_bidang`),
  CONSTRAINT `mapel_ibfk_1` FOREIGN KEY (`id_daftar_bidang`) REFERENCES `daftar_bidang_keahlian` (`id_daftar_bidang`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `mapel` */

insert  into `mapel`(`id_mapel`,`id_daftar_bidang`,`nama_mapel`) values 
(1,1,'Web Dinamis'),
(2,1,'Database');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `nilai` */

insert  into `nilai`(`id_nilai`,`id_ujian`,`id_siswa`,`jawaban_benar`,`jawaban_salah`,`nilai`,`status_pengerjaan`) values 
(1,1,1,1,2,20,'Harus Remedial'),
(2,1,7,2,1,40,'Harus Remedial'),
(3,1,2,0,3,0,'Harus Remedial'),
(4,1,8,2,1,40,'Harus Remedial'),
(5,1,4,1,2,20,'Harus Remedial'),
(6,1,5,2,1,40,'Harus Remedial'),
(7,1,6,2,1,40,'Harus Remedial'),
(8,1,9,2,1,40,'Harus Remedial'),
(9,2,2,0,2,0,'Harus Remedial'),
(10,2,9,1,1,50,'Harus Remedial'),
(11,2,8,2,0,100,'Sudah Mengerjakan'),
(12,2,4,0,2,0,'Harus Remedial'),
(13,2,7,0,2,0,'Harus Remedial');

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `nilai_remedial` */

insert  into `nilai_remedial`(`id_nilai_remedial`,`id_siswa`,`id_ujian_remedial`,`jawaban_benar`,`jawaban_salah`,`nilai_remedial`) values 
(1,9,1,2,0,60),
(2,6,1,2,0,60),
(3,4,1,2,0,60),
(4,2,1,2,0,60),
(5,9,2,1,0,70),
(6,9,3,0,1,0),
(7,9,4,1,0,70),
(8,2,2,1,0,70),
(9,2,3,1,0,70),
(10,2,4,1,0,70),
(11,4,4,2,0,70),
(12,4,3,1,0,70),
(13,8,1,2,0,60),
(14,7,2,0,1,0),
(15,7,3,1,0,70),
(16,7,4,2,0,70);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `siswa` */

insert  into `siswa`(`id_siswa`,`nis`,`id_users`,`id_kelas`,`nama`,`alamat`,`jenis_kelamin`,`foto`,`tahun_ajaran`) values 
(1,'1502011100',5,8,'Alli Taufik Rachman','Jalan Geger Kalong no. 1','L','Ijazah_180226_0029_1523801258.jpg','2017/2018'),
(2,'1502011455',6,2,'Wendy Setiawan','Jalan Kebon Kopi no. 33','L','Ijazah_180226_0001_1523801314.jpg','2017/2018'),
(4,'1502011152',8,2,'Dea Fitri Handayani','Jalan Margaasih no. 3','P','Ijazah_180226_0023_1523801448.jpg','2017/2018'),
(5,'1502011153',9,2,'Asep Husen','Jalan Setiabudi no. 44','L','Ijazah_180226_0027_1523801533.jpg','2017/2018'),
(6,'1502011154',10,2,'Muhammad Syaiful Mahialhakim','Jalan Gunung Batu no. 88','L','Ijazah_180226_0013_1523801583.jpg','2017/2018'),
(7,'1502011155',11,2,'Amalia Nur Oktaviani','Jalan gatau namanya no. 019','P','Ijazah_180226_0028_1523801657.jpg','2017/2018'),
(8,'1502011157',12,2,'Yanuar Wanda Putra','Jalan Bumi Asri no. 69','L','Ijazah_180226_0002_1523802216.jpg','2017/2018'),
(9,'1502011158',13,2,'Kukuh Mangku Hidayat','Jalan Ciroyom bawah no. 221','L','Ijazah_180226_0018_1523802317.jpg','2017/2018'),
(10,'1502011321',14,1,'Intan Nurmalasari','Jalan Batu Jajang no. 48','P','nophoto.jpg','2017/2018'),
(11,'1502011240',15,1,'Nisa Rahmasari','Jalan Tegalkawung','P','nophoto.jpg','2017/2018'),
(12,'1402911389',16,1,'Rizki Febriansyah','Jalan Aksan no. 20','L','nophoto.jpg','2017/2018');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `soal` */

insert  into `soal`(`id_soal`,`id_ujian`,`id_bank_soal`,`point`) values 
(1,1,1,10),
(2,1,2,10),
(3,1,3,30),
(4,2,4,10),
(5,2,5,10);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `soal_remed` */

insert  into `soal_remed`(`id_soal_remedial`,`id_ujian_remedial`,`id_bank_soal`,`point`) values 
(1,1,1,10),
(2,1,2,10),
(3,2,6,10),
(4,3,5,10),
(5,4,6,50),
(6,4,5,10);

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
  `lihat_nilai` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_ujian`),
  KEY `id_mapel` (`id_mapel`),
  KEY `ujian_ibfk_2` (`id_guru`),
  CONSTRAINT `ujian_ibfk_1` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`),
  CONSTRAINT `ujian_ibfk_2` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `ujian` */

insert  into `ujian`(`id_ujian`,`id_mapel`,`id_guru`,`judul_ujian`,`kkm`,`waktu_pengerjaan`,`tanggal_pembuatan`,`tanggal_post`,`tanggal_kadaluarsa`,`status`,`catatan`,`lihat_nilai`) values 
(1,2,1,'Berkenalan dengan SQL',60,'00:05:00','2018-04-15 20:32:17','2018-04-15 20:32:17','2018-04-15','posted','Pre-test untuk para siswa mengenai SQL (khususnya MYSQL)','N'),
(2,1,1,'PDKT dengan PHP',70,'00:05:00','2018-04-16 17:24:29','2018-04-16 17:24:29','2018-04-16','posted','Pre-test pelajaran web dinamis','Y');

/*Table structure for table `ujian_remedial` */

DROP TABLE IF EXISTS `ujian_remedial`;

CREATE TABLE `ujian_remedial` (
  `id_ujian_remedial` int(11) NOT NULL AUTO_INCREMENT,
  `id_ujian` int(11) DEFAULT NULL,
  `waktu_pengerjaan` time NOT NULL,
  `tanggal_pembuatan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `catatan` text,
  `tanggal_kadaluarsa` timestamp NULL DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Belum Selesai',
  `remed_ke` int(11) NOT NULL,
  PRIMARY KEY (`id_ujian_remedial`),
  KEY `id_ujian` (`id_ujian`),
  CONSTRAINT `ujian_remedial_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `ujian_remedial` */

insert  into `ujian_remedial`(`id_ujian_remedial`,`id_ujian`,`waktu_pengerjaan`,`tanggal_pembuatan`,`catatan`,`tanggal_kadaluarsa`,`status`,`remed_ke`) values 
(1,1,'00:10:00','2018-04-15 21:51:30','Ayo semangat','2018-04-15 00:00:00','posted',1),
(2,2,'00:04:00','2018-04-16 17:57:06','Tidak ada catatan.','2018-04-16 00:00:00','posted',1),
(3,2,'00:03:00','2018-04-16 19:00:44','Tidak ada catatan.','2018-04-16 00:00:00','posted',2),
(4,2,'00:00:30','2018-04-16 19:04:23','Tidak ada catatan.','2018-04-16 00:00:00','posted',3);

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id_users`,`username`,`email`,`password`,`remember_token`,`hak_akses`,`created_at`,`updated_at`) values 
(1,'laracry','muhfah666@gmail.com','$2y$10$tDcmXuHyf0qm.vlCHGhf/ufbcrC01o99T0Edz4zbPHI4sdVkUc9ja','xzminKdI6ULEfLZj0Dpf4Apb2rfAOJsYkO5Lgc3ewCgoN56SRr3OPgT9656d','admin','2018-04-15 19:59:11','2018-04-15 19:59:17'),
(2,'sukawati','sukawati5@gmail.com','$2y$10$JzMulNWgSGbRjm9Nb7exHOysz9rG9kaLX8CjN6OLeQnPffZiv.U4q','3zJ46JGWNIWDAa683N1dB3ATtECoRUYTHkY6QRLR4XQe0R9axNL1sm1uVkzs','guru','2018-04-15 20:10:27','2018-04-15 20:10:27'),
(3,'nurjamal','nurjamal21@gmail.com','$2y$10$Fj0V5ajDlJ/hpLA/XtExBuM2vzuqOsifcHbIO4WvU2rLs3S3hRFoq',NULL,'guru','2018-04-15 20:14:41','2018-04-15 20:14:41'),
(5,'alli','rachman_alli@gmail.com','$2y$10$0J8cfDlbKN7aWKmgyGBBS.qSX.DMQjQTWv5z9uFoUlpO7Nd/m0ddm','XEvlC50Ql7Nfm2h5rtJz2BuJ1vu0BkasTqK47QaRiDfHpdYVEFvcosN69GzD','siswa','2018-04-15 21:07:38','2018-04-15 21:07:38'),
(6,'wsetiawan','wsetiawan135790@gmail.com','$2y$10$Obp42e6Rylx5SVbdnlOXH.Xg1ZpexWWQjflf/Nc0BhqPzjdkicYSa','zgiZYDcsYAFmzSosSGHTybZ1EcVSSvyRGr1N6S9aTRhUJoDGwChSeY1ZAnzu','siswa','2018-04-15 21:08:33','2018-04-15 21:08:33'),
(8,'deafitrih','deafitrih16@gmail.com','$2y$10$lZqCfbk.xRNanBM0UPR6Mef4M/SDpQMFuZJwzEnx9HZb5AGet3tsu','JrQPalY2EC87ERQTm4lKeOelhDiOPpYhZELTbabZnYkeJsks09z8yYwPSxVg','siswa','2018-04-15 21:10:48','2018-04-15 21:10:48'),
(9,'indomie','asepmchusen@gmail.com','$2y$10$D.m/xEzGW1TKx9ByGj1zYOJCHCtl.Ptx9lBCkgNatD2UALDyUcnZ.','QHNO5mfe5II5rWIZywdoJzJPeCyO43ckC5Q7O9HKYErnPWLlyEGFMN18GpzZ','siswa','2018-04-15 21:12:13','2018-04-15 21:12:13'),
(10,'lufiays','mahial_hakim@gmail.com','$2y$10$.33QtLKkaet0WAFeL3f1pO8YbhGX7y.vOXCJ2qvgIJZ/QjsqKg1mO','EYv5fe68tQTS8net9vyUyqTr9Xdr7ULisYpBnab1GvDioOVz0EgbVyCsOIyK','siswa','2018-04-15 21:13:02','2018-04-15 21:13:02'),
(11,'amalianuro','amalianuro@gmail.com','$2y$10$BjF8mh1tKBMWWcqVmq9yWOPtvS3UEuLDtog8IPQlknOgTZACJDW7.','nVymp1LrQb6ERflKWwnRNTdezW6oRAvK6rWiqI1aBfdHhDcPRXhdVaygfhmD','siswa','2018-04-15 21:14:17','2018-04-15 21:14:17'),
(12,'yanuarwanda','yanuarwanda16@gmail.com','$2y$10$/Vgc.IsMedirsfD6X.bLn.ysed4yFbVbaUmzM2lgdhm25bmgO8nDy','iNXWaG4OrFyPW8HXm7gz1krbRXqeuSD1Yu2KUmjUgEl5MddyUVmNAWBzvtJN','siswa','2018-04-15 21:23:36','2018-04-15 21:23:36'),
(13,'kukuhpelog','kukuhpelig15@gmail.com','$2y$10$YGbcd2cX/5D/N1LCJc1.He8ZL3XAHrnpfpcpr7.szC1uBbZJu9aEO','2LVHPB267pXme9i6CISFmbMEhFOabfUPOQ6HVeJqrZxRkaKAS7EhH0kVNlfb','siswa','2018-04-15 21:25:17','2018-04-15 21:25:17'),
(14,'intan','intan_48@gmail.com','$2y$10$OBf6F5n0hcFx3p4Y2kQTK.faCshzevhQFAfdwckhtZsKA6A00Q52u',NULL,'siswa','2018-04-16 21:38:02','2018-04-16 21:38:02'),
(15,'nisa','nisanisa@gmail.com','$2y$10$N4a1zcIZUp07NFnLLEOmWe39E5x1/z5Nq2eS7z9QzFkeQ3h0H5YhW',NULL,'siswa','2018-04-16 21:39:10','2018-04-16 21:39:10'),
(16,'rizki','cikecong@gmail.com','$2y$10$0waScxsRJav4f.0VSG3Me.ik40MOILVqgHmtbrf1VT6019ZQNYzzy',NULL,'siswa','2018-04-16 21:40:26','2018-04-16 21:40:26');

/* Trigger structure for table `daftar_bidang_keahlian` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `sebelum_hapus_daftarBidangKeahlian` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `sebelum_hapus_daftarBidangKeahlian` BEFORE DELETE ON `daftar_bidang_keahlian` FOR EACH ROW BEGIN
	DELETE FROM bidang_keahlian WHERE id_daftar_bidang = old.id_daftar_bidang;
    END */$$


DELIMITER ;

/* Trigger structure for table `guru` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `sebelum_hapus_guru` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `sebelum_hapus_guru` BEFORE DELETE ON `guru` FOR EACH ROW BEGIN
	DELETE FROM ujian WHERE id_guru = old.id_guru;
	DELETE FROM bidang_keahlian WHERE id_guru = old.id_guru;
    END */$$


DELIMITER ;

/* Trigger structure for table `jurusan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `sebelum_hapus_jurusan` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `sebelum_hapus_jurusan` BEFORE DELETE ON `jurusan` FOR EACH ROW BEGIN
	delete from kelas WHERE id_jurusan = old.id_jurusan;
    END */$$


DELIMITER ;

/* Trigger structure for table `kelas` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `sebelum_hapus_kelas` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `sebelum_hapus_kelas` BEFORE DELETE ON `kelas` FOR EACH ROW BEGIN
	DELETE FROM kelas_ujian WHERE id_kelas = old.id_kelas;
	DELETE FROM siswa WHERE id_kelas = old.id_kelas;
    END */$$


DELIMITER ;

/* Trigger structure for table `mapel` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `sebelum_hapus_mapel` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `sebelum_hapus_mapel` BEFORE DELETE ON `mapel` FOR EACH ROW BEGIN
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

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `sebelum_hapus_siswa` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `sebelum_hapus_siswa` BEFORE DELETE ON `siswa` FOR EACH ROW BEGIN
	DELETE FROM nilai WHERE nilai.id_siswa = old.id_siswa;
	DELETE FROM nilai_remedial WHERE nilai_remedial.id_siswa = old.id_siswa;
    END */$$


DELIMITER ;

/* Trigger structure for table `soal` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `sebelum_hapus_soal` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `sebelum_hapus_soal` BEFORE DELETE ON `soal` FOR EACH ROW BEGIN
	DELETE FROM jawaban_siswa WHERE id_soal = old.id_soal;
	
    END */$$


DELIMITER ;

/* Trigger structure for table `ujian` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `sebelum_hapus_ujian` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `sebelum_hapus_ujian` BEFORE DELETE ON `ujian` FOR EACH ROW BEGIN
	DELETE FROM kelas_ujian WHERE kelas_ujian.id_ujian = old.id_ujian;
	DELETE FROM nilai WHERE nilai.id_ujian = old.id_ujian;
	DELETE FROM soal WHERE soal.id_ujian = old.id_ujian;
	DELETE FROM ujian_remedial WHERE ujian_remedial.id_ujian = old.id_ujian;
    END */$$


DELIMITER ;

/* Trigger structure for table `ujian_remedial` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `sebelum_hapus_ujianRemedial` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `sebelum_hapus_ujianRemedial` BEFORE DELETE ON `ujian_remedial` FOR EACH ROW BEGIN
	DELETE FROM nilai_remedial WHERE id_ujian_remedial = old.id_ujian_remedial;
	DELETE FROM soal_remed WHERE id_ujian_remedial = old.id_ujian_remedial;
    END */$$


DELIMITER ;

/* Trigger structure for table `users` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `sebelum_hapus_users` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `sebelum_hapus_users` BEFORE DELETE ON `users` FOR EACH ROW BEGIN
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

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_data_siswa_saat_remed_kadaluarsa`(`id_ujian_asli` INT)
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

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_data_siswa_saat_tanggal_kadaluarsa`(`id_ujian_asli` INT)
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
