-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2018 at 05:07 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ujian`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_data_siswa_saat_remed_kadaluarsa` (`id_ujian_asli` INT)  BEGIN
	SELECT COUNT(id_soal_remedial) FROM soal_remed WHERE id_ujian_remedial = id_ujian_asli INTO @jumlahSoal;
	/* Insert semua siswa yang belum mengerjakan ke table nilai dengan status harus susulan */
	INSERT INTO nilai_remedial (id_ujian_remedial, id_siswa, jawaban_benar, jawaban_salah, nilai_remedial)
	SELECT id_ujian_asli,
		id_siswa,
		0,
		@jumlahSoal,
		0
	FROM siswa JOIN kelas_ujian USING (id_kelas) WHERE id_ujian = id_ujian_asli  AND id_siswa NOT IN (SELECT id_siswa FROM nilai);
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_data_siswa_saat_tanggal_kadaluarsa` (`id_ujian_asli` INT)  BEGIN	
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
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bank_soal`
--

CREATE TABLE `bank_soal` (
  `id_bank_soal` int(11) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `isi_soal` text NOT NULL,
  `pilihan` text NOT NULL,
  `jawaban` text NOT NULL,
  `id_daftar_bidang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_soal`
--

INSERT INTO `bank_soal` (`id_bank_soal`, `tipe`, `isi_soal`, `pilihan`, `jawaban`, `id_daftar_bidang`) VALUES
(2, 'MC', '<p>Apakah?</p>', '<p>Whenever you are</p> ,  <p>I never said goodbye</p> ,  <p>i promise you forever right now</p> ,  ', '<p>I never said goodbye</p> ,  <p>i promise you forever right now</p> ,  ', 1),
(3, 'PG', '<p>Ini Soal untuk no 2</p>', '<p>Ini Pilihan A</p> ,  <p>Ini Pilihan B</p> ,  <p>Ini Pilihan C</p> ,  <p>Ini Pilihan D</p> ,  <p>Ini Pilihan E</p>', '<p>Ini Pilihan E</p>', 1),
(4, 'MC', '<p>Soal asd</p>', '<p>A asd</p> ,   ,  <p>C dsa</p> ,  <p>D FDS</p> ,  <p>E ddd</p>', ' ,   ,   ,  <p>D FDS</p> ,  <p>E ddd</p>', 1),
(5, 'MC', '<p>sssssasassa</p>', '<p>saddsdarqsa</p> ,  <p>sdfdfeee</p> ,  <p>efwwefef</p> ,  <p>sdfgfbxcbg</p> ,  ', '<p>saddsdarqsa</p> ,   ,   ,  <p>sdfgfbxcbg</p> ,  ', 1),
(6, 'MC', '<p>iNIA SIAPOL</p>', '<p>AISDJIAWDNI</p> ,  <p>BAJWDIAJWDI</p> ,  <p>CWOKOAKOD</p> ,  <p>DOWJROWAJ</p> ,  <p>EADKLADS</p>', '<p>AISDJIAWDNI</p> ,   ,   ,   ,   ,   ,   ,  <p>CWOKOAKOD</p> ,   ,   ,   ,   ,   ,   ,  <p>EADKLADS</p> ,  ', 1),
(7, 'MC', '<p>Ini SOal bODY</p>', '<p>A Yah</p> ,  <p>B Yah</p> ,  <p>C Yeh</p> ,  <p>D yUH</p> ,  <p>E maamam</p>', '<p>B Yah</p> ,   ,   ,   ,  <p>D yUH</p> ,   ,  ', 1),
(8, 'MC', '<p>Ini Soal</p>', '<p>Ini Pilihan A</p> ,  <p>Ini Pilihan B</p> ,  <p>Ini Pilihan C</p> ,  <p>Ini Pilihan D</p> ,  <p>Ini Pilihan E</p>', ' ,  <p>Ini Pilihan B</p> ,   ,   ,  <p>Ini Pilihan E</p>', 1),
(9, 'BS', '<p>Ini SOal bENAR Salah</p>', 'Benar ,  Salah', 'Salah', NULL),
(10, 'PG', '<p>Ini teh jawabannnya A</p>', '<p>Kalo jawab ini bener</p> ,   ,  <p>jawab ini salah</p> ,   ,  <p>Jawab ini juga salah</p>', '<p>Kalo jawab ini bener</p>', 1),
(11, 'BS', '<p>biar gampang</p>', 'Benar ,  Salah', 'Salah', 1),
(12, 'BS', '<p>biar gampang</p>', 'Benar ,  Salah', 'Salah', 1),
(13, 'MC', '<p>biar gampang 5</p>', '<p>ABC</p> ,  <p>DEF</p> ,   ,  <p>GHI</p> ,  ', '<p>ABC</p> ,  <p>DEF</p> ,   ,  <p>GHI</p> ,  ', 1),
(14, 'MC', '<p>asdasd</p>', '<p>dsadsa</p> ,  <p>ssssss</p> ,  <p>asdqwe</p> ,   ,  ', '<p>dsadsa</p> ,   ,  <p>asdqwe</p> ,   ,  ', 1),
(15, 'PG', '<p>Berapakah 1 + 6...</p>', '<p>8</p> ,  <p>7</p> ,  <p>6</p> ,  <p>5</p> ,  <p>4</p>', '<p>7</p>', 4),
(16, 'MC', '<p>Manakah yang merupakan penjumlahan dari bilangan 10?</p>', '<p>5+5</p> ,  <p>6+4</p> ,  <p>2+2</p> ,  <p>7+3</p> ,  <p>8+2</p>', '<p>5+5</p> ,  <p>6+4</p> ,   ,  <p>7+3</p> ,  <p>8+2</p>', 4),
(17, 'BS', '<p>Apakah Matematika ini pelajaran yang paling menakutkan?</p>', 'Benar ,  Salah', 'Salah', 4),
(18, 'MC', '<p>Ini Multichoice dengan 4 pilihan. (Jawabannya pertama dan ketiga).</p>', '<p>Betul</p> ,  <p>Salah ga</p> ,  <p>ga Salah</p> ,  <p>ga Betul</p> ,  ', '<p>Betul</p> ,   ,  <p>ga Salah</p> ,   ,  ', 4),
(19, 'BS', '<p>Jawab pertanyaan ini dengan benar dan kamu lulus</p>', 'Benar ,  Salah', 'Benar', 4),
(20, 'BS', '<p>asd</p>', 'Benar ,  Salah', 'Salah', 4),
(21, 'BS', '<p>asd</p>', 'Benar ,  Salah', 'Salah', 4);

-- --------------------------------------------------------

--
-- Table structure for table `bidang_keahlian`
--

CREATE TABLE `bidang_keahlian` (
  `id_bidang_keahlian` int(11) NOT NULL,
  `id_guru` int(11) UNSIGNED DEFAULT NULL,
  `id_daftar_bidang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bidang_keahlian`
--

INSERT INTO `bidang_keahlian` (`id_bidang_keahlian`, `id_guru`, `id_daftar_bidang`) VALUES
(1, 4, 1),
(2, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `daftar_bidang_keahlian`
--

CREATE TABLE `daftar_bidang_keahlian` (
  `id_daftar_bidang` int(11) NOT NULL,
  `bidang_keahlian` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daftar_bidang_keahlian`
--

INSERT INTO `daftar_bidang_keahlian` (`id_daftar_bidang`, `bidang_keahlian`) VALUES
(1, 'Rekayasa Perangkat Lunak'),
(2, 'Multimedia'),
(3, 'Teknik Komputer dan Jaringan'),
(4, 'Matematika');

--
-- Triggers `daftar_bidang_keahlian`
--
DELIMITER $$
CREATE TRIGGER `sebelum_hapus_daftarBidangKeahlian` BEFORE DELETE ON `daftar_bidang_keahlian` FOR EACH ROW BEGIN
	DELETE FROM bidang_keahlian WHERE id_daftar_bidang = old.id_daftar_bidang;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(10) UNSIGNED NOT NULL,
  `nip` varchar(50) NOT NULL,
  `id_users` int(10) UNSIGNED NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` text,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `foto` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nip`, `id_users`, `nama`, `alamat`, `jenis_kelamin`, `foto`) VALUES
(4, '12345678912345678912', 5, 'Yesterday Once More', 'Jalan Hati', 'P', 'nophoto.jpg'),
(5, '1921293829182394281', 15, 'sfso', 'My Heart Street', 'P', 'water-bg_1521346087.jpg');

--
-- Triggers `guru`
--
DELIMITER $$
CREATE TRIGGER `sebelum_hapus_guru` BEFORE DELETE ON `guru` FOR EACH ROW BEGIN
	DELETE FROM ujian WHERE id_guru = old.id_guru;
	DELETE FROM bidang_keahlian WHERE id_guru = old.id_guru;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_siswa`
--

CREATE TABLE `jawaban_siswa` (
  `id_jawaban` int(11) NOT NULL,
  `id_soal` int(11) DEFAULT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `jawaban_siswa` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jawaban_siswa`
--

INSERT INTO `jawaban_siswa` (`id_jawaban`, `id_soal`, `id_siswa`, `jawaban_siswa`) VALUES
(1, 1, 3, '<p>5+5</p> ,  <p>6+4</p> ,  <p>7+3</p> ,  <p>8+2</p>'),
(2, 2, 3, 'Benar'),
(3, 3, 3, '<p>7</p>'),
(4, 1, 1, '<p>5+5</p> ,  <p>6+4</p> ,  <p>7+3</p>'),
(5, 2, 1, 'Benar'),
(6, 3, 1, '<p>6</p>'),
(7, 1, 4, '<p>5+5</p> ,  <p>6+4</p> ,  <p>7+3</p> ,  <p>8+2</p>'),
(8, 2, 4, 'Salah'),
(9, 3, 4, '<p>7</p>'),
(10, 1, 5, '<p>2+2</p>'),
(11, 2, 5, 'Salah'),
(12, 3, 5, '<p>8</p>'),
(13, 1, 2, '<p>5+5</p> ,  <p>6+4</p> ,  <p>7+3</p> ,  <p>8+2</p>'),
(14, 2, 2, 'Salah'),
(15, 3, 2, '<p>7</p>');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_siswa_remed`
--

CREATE TABLE `jawaban_siswa_remed` (
  `id_jawaban_remedial` int(11) NOT NULL,
  `id_soal_remedial` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `jawaban_siswa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jawaban_siswa_remed`
--

INSERT INTO `jawaban_siswa_remed` (`id_jawaban_remedial`, `id_soal_remedial`, `id_siswa`, `jawaban_siswa`) VALUES
(1, 1, 2, '<p>7</p>'),
(2, 2, 2, '<p>5+5</p> ,  <p>6+4</p> ,  <p>7+3</p> ,  <p>8+2</p>'),
(3, 3, 2, 'Salah'),
(4, 4, 2, '<p>Betul</p> ,  <p>ga Salah</p>'),
(5, 5, 2, 'Benar'),
(6, 1, 5, '<p>7</p>'),
(7, 2, 5, '<p>5+5</p> ,  <p>6+4</p> ,  <p>7+3</p> ,  <p>8+2</p>'),
(8, 3, 5, 'Salah'),
(9, 4, 5, '<p>Betul</p> ,  <p>ga Salah</p>'),
(10, 5, 5, 'Salah');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`) VALUES
(1, 'Rekayasa Perangkat Lunak'),
(2, 'Multimedia'),
(3, 'Teknik Komputer Jaringan'),
(4, 'Administrasi Perkantoran'),
(5, 'Akuntansi'),
(6, 'Pemasaran');

--
-- Triggers `jurusan`
--
DELIMITER $$
CREATE TRIGGER `sebelum_hapus_jurusan` BEFORE DELETE ON `jurusan` FOR EACH ROW BEGIN
	delete from kelas WHERE id_jurusan = old.id_jurusan;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(20) NOT NULL,
  `id_jurusan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `id_jurusan`) VALUES
(1, 'XII RPL 1', 1),
(2, 'XII RPL 2', 1),
(3, 'XII RPL 3', 1),
(4, 'XII MM 1', 2),
(5, 'XII MM 2', 2),
(6, 'XII TKJ', 3);

--
-- Triggers `kelas`
--
DELIMITER $$
CREATE TRIGGER `sebelum_hapus_kelas` BEFORE DELETE ON `kelas` FOR EACH ROW BEGIN
	DELETE FROM kelas_ujian WHERE id_kelas = old.id_kelas;
	DELETE FROM siswa WHERE id_kelas = old.id_kelas;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kelas_ujian`
--

CREATE TABLE `kelas_ujian` (
  `id_kelas_ujian` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas_ujian`
--

INSERT INTO `kelas_ujian` (`id_kelas_ujian`, `id_ujian`, `id_kelas`) VALUES
(7, 1, 1),
(8, 1, 2),
(9, 1, 3),
(10, 1, 4),
(11, 1, 5),
(12, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL,
  `id_daftar_bidang` int(11) DEFAULT NULL,
  `nama_mapel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `id_daftar_bidang`, `nama_mapel`) VALUES
(1, 1, 'Pemrograman Berorientasi Objek'),
(2, 1, 'Web Dinamis'),
(3, 1, 'Basis Data'),
(4, 4, 'Matematika');

--
-- Triggers `mapel`
--
DELIMITER $$
CREATE TRIGGER `sebelum_hapus_mapel` BEFORE DELETE ON `mapel` FOR EACH ROW BEGIN
	DELETE FROM ujian WHERE id_mapel = old.id_mapel;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `jawaban_benar` int(11) NOT NULL,
  `jawaban_salah` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `status_pengerjaan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_ujian`, `id_siswa`, `jawaban_benar`, `jawaban_salah`, `nilai`, `status_pengerjaan`) VALUES
(1, 1, 3, 3, 0, 100, 'Sudah Mengerjakan'),
(2, 1, 1, 1, 2, 86, 'Sudah Mengerjakan'),
(3, 1, 4, 2, 1, 14, 'Harus Remedial'),
(4, 1, 5, 0, 3, 0, 'Harus Remedial'),
(5, 1, 2, 2, 1, 14, 'Harus Remedial');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_remedial`
--

CREATE TABLE `nilai_remedial` (
  `id_nilai_remedial` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_ujian_remedial` int(11) DEFAULT NULL,
  `jawaban_benar` int(11) NOT NULL,
  `jawaban_salah` int(11) NOT NULL,
  `nilai_remedial` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_remedial`
--

INSERT INTO `nilai_remedial` (`id_nilai_remedial`, `id_siswa`, `id_ujian_remedial`, `jawaban_benar`, `jawaban_salah`, `nilai_remedial`) VALUES
(1, 2, 1, 5, 0, 76),
(2, 5, 1, 4, 1, 27);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL COMMENT 'Primary Key',
  `nis` varchar(10) NOT NULL COMMENT 'Nomor Induk Siswa.',
  `id_users` int(10) UNSIGNED NOT NULL COMMENT 'Kolom untuk relasi ke tabel Users.',
  `id_kelas` int(11) NOT NULL COMMENT 'Kolom untuk relasi ke tabel Kelas',
  `nama` varchar(150) NOT NULL COMMENT 'Nama Siswa.',
  `alamat` text COMMENT 'Alamat Siswa.',
  `jenis_kelamin` char(1) NOT NULL COMMENT 'Jenis Kelamin Siswa.',
  `foto` varchar(256) NOT NULL COMMENT 'Foto Profil Siswa',
  `tahun_ajaran` varchar(25) NOT NULL COMMENT 'Tahun Ajaran siswa.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `id_users`, `id_kelas`, `nama`, `alamat`, `jenis_kelamin`, `foto`, `tahun_ajaran`) VALUES
(1, '1502011462', 6, 2, 'Yanuar Wanda Putra', 'Jalan Marga Asri VI G.', 'L', 'masyan_1520261258.png', ''),
(2, '1502011455', 7, 2, 'Wendy Setiawan', 'Coffee Garden Street', 'L', 'nophoto.jpg', ''),
(3, '1502011463', 8, 1, 'Riki Subagja', 'Jalan Deket Rumah Saya', 'L', 'nophoto.jpg', ''),
(4, '1502011464', 9, 3, 'Whisnu Mulya Pratama', 'Pasar Atas', 'L', 'IMG_20151017_125747_1520261470.jpg', ''),
(5, '1502011465', 10, 4, 'Muhammad Rizal', 'Pasar Pojok', 'L', 'IMG_20150923_101330_1520261586.jpg', ''),
(6, '1502011466', 11, 5, 'Ngudi Prasodjo', 'Jalan Padjajaran Deket SMKN 12 Bandung', 'L', 'IMG_1164_1520261665.JPG', ''),
(7, '1502011467', 12, 6, 'Muhammad Fauzan Faturrahman', 'Jamika', 'L', 'Screenshot (160)_1519920644_1520261801.png', ''),
(8, '1502011341', 13, 2, 'Kukuh MangkuHidayatullah', 'Ciroyom', 'L', 'imam-al-ghazali_1520387616.jpg', '');

--
-- Triggers `siswa`
--
DELIMITER $$
CREATE TRIGGER `before_insert_table_siswa` BEFORE INSERT ON `siswa` FOR EACH ROW BEGIN
    /* Proses nambah tahun_ajaran ke table siswa yang mau di insert */
 IF MONTH(CURDATE() ) < 6 THEN
  SET new.tahun_ajaran = CONCAT((YEAR(CURDATE())-1), '/', YEAR(CURDATE()));
 ELSEIF MONTH(CURDATE()) >= 6 THEN
  SET new.tahun_ajaran = CONCAT((YEAR(CURDATE())), '/', YEAR(CURDATE())+1);
 END IF;
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `sebelum_hapus_siswa` BEFORE DELETE ON `siswa` FOR EACH ROW BEGIN
	DELETE FROM nilai WHERE nilai.id_siswa = old.id_siswa;
	DELETE FROM nilai_remedial WHERE nilai_remedial.id_siswa = old.id_siswa;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id_soal` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `id_bank_soal` int(11) DEFAULT NULL,
  `point` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id_soal`, `id_ujian`, `id_bank_soal`, `point`) VALUES
(1, 1, 16, 5),
(2, 1, 19, 95),
(3, 1, 15, 10);

--
-- Triggers `soal`
--
DELIMITER $$
CREATE TRIGGER `sebelum_hapus_soal` BEFORE DELETE ON `soal` FOR EACH ROW BEGIN
	DELETE FROM jawaban_siswa WHERE id_soal = old.id_soal;
	
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `soal_remed`
--

CREATE TABLE `soal_remed` (
  `id_soal_remedial` int(11) NOT NULL,
  `id_ujian_remedial` int(11) NOT NULL,
  `id_bank_soal` int(11) NOT NULL,
  `point` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soal_remed`
--

INSERT INTO `soal_remed` (`id_soal_remedial`, `id_ujian_remedial`, `id_bank_soal`, `point`) VALUES
(1, 1, 15, 5),
(2, 1, 16, 10),
(3, 1, 17, 5),
(4, 1, 18, 10),
(5, 1, 19, 80);

-- --------------------------------------------------------

--
-- Table structure for table `ujian`
--

CREATE TABLE `ujian` (
  `id_ujian` int(11) NOT NULL COMMENT 'Primary Key.',
  `id_mapel` int(11) NOT NULL COMMENT 'Kolom untuk relasi ke tabel mapel.',
  `id_guru` int(10) UNSIGNED DEFAULT NULL COMMENT 'Kolom untuk relasi ke tabel guru.',
  `judul_ujian` varchar(200) DEFAULT NULL COMMENT 'Judul ujian.',
  `kkm` int(11) NOT NULL COMMENT 'KKM per ujian',
  `waktu_pengerjaan` time NOT NULL COMMENT 'Batas waktu pengerjaan saat ujian.',
  `tanggal_pembuatan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Tanggal pembuatan ujian.',
  `tanggal_post` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Tanggal ujian di post.',
  `tanggal_kadaluarsa` date NOT NULL COMMENT 'Tanggal ujian akan berakhir.',
  `status` varchar(50) NOT NULL DEFAULT 'Draft' COMMENT 'Status ujian antara Draft/Belum di Post atau Posted/Sudah di post.',
  `catatan` text COMMENT 'Catatan tentang ujian.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ujian`
--

INSERT INTO `ujian` (`id_ujian`, `id_mapel`, `id_guru`, `judul_ujian`, `kkm`, `waktu_pengerjaan`, `tanggal_pembuatan`, `tanggal_post`, `tanggal_kadaluarsa`, `status`, `catatan`) VALUES
(1, 4, 5, 'UTS Matematika Kelas `12', 76, '02:05:00', '2018-03-22 07:42:08', '2018-03-22 07:42:08', '2018-03-21', 'posted', 'Yang nilainya dibawah kkm harus lari di lapang 15 kuliling.');

--
-- Triggers `ujian`
--
DELIMITER $$
CREATE TRIGGER `sebelum_hapus_ujian` BEFORE DELETE ON `ujian` FOR EACH ROW BEGIN
	DELETE FROM kelas_ujian WHERE kelas_ujian.id_ujian = old.id_ujian;
	DELETE FROM nilai WHERE nilai.id_ujian = old.id_ujian;
	DELETE FROM soal WHERE soal.id_ujian = old.id_ujian;
	DELETE FROM ujian_remedial WHERE ujian_remedial.id_ujian = old.id_ujian;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ujian_remedial`
--

CREATE TABLE `ujian_remedial` (
  `id_ujian_remedial` int(11) NOT NULL,
  `id_ujian` int(11) DEFAULT NULL,
  `waktu_pengerjaan` time NOT NULL,
  `tanggal_pembuatan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `catatan` text,
  `tanggal_kadaluarsa` timestamp NULL DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Belum Selesai',
  `remed_ke` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ujian_remedial`
--

INSERT INTO `ujian_remedial` (`id_ujian_remedial`, `id_ujian`, `waktu_pengerjaan`, `tanggal_pembuatan`, `catatan`, `tanggal_kadaluarsa`, `status`, `remed_ke`) VALUES
(1, 1, '02:00:05', '2018-03-22 08:20:56', 'Tidak ada catatan.', '2018-03-22 17:00:00', 'posted', 1);

--
-- Triggers `ujian_remedial`
--
DELIMITER $$
CREATE TRIGGER `sebelum_hapus_ujianRemedial` BEFORE DELETE ON `ujian_remedial` FOR EACH ROW BEGIN
	DELETE FROM nilai_remedial WHERE id_ujian_remedial = old.id_ujian_remedial;
	DELETE FROM soal_remed WHERE id_ujian_remedial = old.id_ujian_remedial;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(10) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hak_akses` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `username`, `email`, `password`, `remember_token`, `hak_akses`, `created_at`, `updated_at`) VALUES
(5, 'yesterdayoncemore', 'yesterday.once@gmail.com', '$2y$10$7nWogqSU1MEMCH2VAiO1XedWhrc9GcdQCpjhKrRXaHOrGo58lfJei', 'ANLz3mOdJv3cs7Xu64jtbTogEbRfJeTjQmcKU49IilwkxdhMYX9sH4CEWeHw', 'guru', '2018-03-05 14:46:34', '2018-03-05 14:46:34'),
(6, 'yanuarwanda', 'yanuar.wanda2@gmail.com', '$2y$10$V2EqzIhM2H.p2jnCz5ncxeqZ1bXBSjDzA.5hqSC8ifFK.pL.Yx5o2', 'lI3XkDEQrnK8vGDp7OgwGJGhOV1g9QOKRgYx58BsHUKPfwKVpCJEW5LmoRnn', 'siswa', '2018-03-05 14:47:38', '2018-03-05 14:47:38'),
(7, 'wsetiawan', 'wendy.setiawan@gmail.com', '$2y$10$dRq8No6Uu8Rwh0SZehdyEODAfrnmDZQfK4hmkPMPAdX3qL3IOReRS', 'KrF0C8K4IJJK8rrAuVsBD3zzEvaJ4mmEvVwhqbtBwVT9I8mlhGGidkaJsmH8', 'siswa', '2018-03-05 14:48:21', '2018-03-05 14:48:21'),
(8, 'bagja', 'riki.subagja@gmail.com', '$2y$10$yT3WhV84zW0OvwHmvY/dF.gNrfWgOFn9YTLKfdDSGLiU5gbp8V4ey', 'bdfv9QTnIl27KOmsvmNoC5xtMFlaXLdStUAmQ5tkTetUICSzdjhrJ82crgAF', 'siswa', '2018-03-05 14:48:47', '2018-03-05 14:48:47'),
(9, 'blackluther', 'whisnu.mulya@gmail.com', '$2y$10$68fDnS3gxr3ohyZddZ783.y4P2bPz9EgCjwkSRNtZjHeqFHYMu8u6', 'Z2nodPRpt8KD9TQHKsD0sxhsRoFHJ1YsCLWEIXFWFpuRjpz4IGlNRRZPH58A', 'siswa', '2018-03-05 14:51:10', '2018-03-05 14:51:20'),
(10, 'rizal2', 'vectorarts@gmail.com', '$2y$10$WNFJPqISzl7h1r7NNuXFUeEkKd5csLyBvZIpRT2trSrfhOQcL5yFe', 'yJ0B92fzMWWAkDU26QohEbbL6AJNccpLqucqrGltB29Q2kPg2JXsDStVYiXP', 'siswa', '2018-03-05 14:53:06', '2018-03-05 14:53:06'),
(11, 'npras', 'n.pras@gmail.com', '$2y$10$p/LphJvxZomwRgILmYEx7uQD3o5f4EbsPo8B6pN91Gkq/S.Dk6Eyq', '0uJk387doKd0dnlQdLmOOC4G2oqUeHXHZP25ANxWuuslGstMxHMzQcUnMDjY', 'siswa', '2018-03-05 14:54:25', '2018-03-05 14:54:25'),
(12, 'jantung', 'hentaikyun@gmail.com', '$2y$10$NF10r/vY2Pec4b5hHlL1d.XcbQYp5VudISoFb1OZjIRJa2WcBE8Y6', 'PDemaWclXoRaTwAdPEDWfOn1xpKnY9GKcVSynKX2ijFBBeeB0M23PGPvtVLA', 'siswa', '2018-03-05 14:56:41', '2018-03-05 14:56:41'),
(13, 'pelog', 'kukuhpelog15@gmail.com', '$2y$10$D3tCUwkSghHlxd1BBCxJbOaQ44Hytvs91rxJYzXmWcDnVA.UaZZDa', 'GHNzzq5VEUYaOT9FQM6HlXPdFpLSNeLSVzrt9FqaPc8KcFUOVT3ptfrmhxv4', 'siswa', '2018-03-07 01:53:36', '2018-03-07 01:53:36'),
(14, 'laracry', 'mzfahri620@gmail.com', '$2y$10$tDcmXuHyf0qm.vlCHGhf/ufbcrC01o99T0Edz4zbPHI4sdVkUc9ja', 'sXZLzJQy2UaplQjXEj3bkbdNWTNivEgK3O4PDdM2K0lXZ8pMaV0DhJ7twD9A', 'admin', '2018-03-13 14:39:31', '2018-03-13 14:39:35'),
(15, 'sfso', 'sfso@gmail.com', '$2y$10$4GZfb4Cv880W3cVy8zA5gOylMPpmz0BHm5Yf9HtvmVUYsivQNjwMi', 'EUn4GYhdXUGmIFdglD66OFr55urXprRiJ8IkBlWNv41SAQka9eNqLke0I0le', 'guru', '2018-03-18 04:08:07', '2018-03-18 04:08:07');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `sebelum_hapus_users` BEFORE DELETE ON `users` FOR EACH ROW BEGIN
	DELETE FROM guru WHERE id_users = old.id_users;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_ujian`
-- (See below for the actual view)
--
CREATE TABLE `view_ujian` (
`id_ujian` int(11)
,`nama_mapel` varchar(50)
,`nama` varchar(150)
,`judul_ujian` varchar(200)
,`waktu_pengerjaan` time
,`tanggal_pembuatan` timestamp
,`tanggal_post` timestamp
,`tanggal_kadaluarsa` date
,`status` varchar(50)
,`catatan` text
);

-- --------------------------------------------------------

--
-- Structure for view `view_ujian`
--
DROP TABLE IF EXISTS `view_ujian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_ujian`  AS  (select `u`.`id_ujian` AS `id_ujian`,`m`.`nama_mapel` AS `nama_mapel`,`g`.`nama` AS `nama`,`u`.`judul_ujian` AS `judul_ujian`,`u`.`waktu_pengerjaan` AS `waktu_pengerjaan`,`u`.`tanggal_pembuatan` AS `tanggal_pembuatan`,`u`.`tanggal_post` AS `tanggal_post`,`u`.`tanggal_kadaluarsa` AS `tanggal_kadaluarsa`,`u`.`status` AS `status`,`u`.`catatan` AS `catatan` from ((`ujian` `u` join `mapel` `m` on((`u`.`id_mapel` = `m`.`id_mapel`))) join `guru` `g` on((`u`.`id_guru` = `g`.`id_guru`)))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_soal`
--
ALTER TABLE `bank_soal`
  ADD PRIMARY KEY (`id_bank_soal`),
  ADD KEY `id_daftar_bidang` (`id_daftar_bidang`);

--
-- Indexes for table `bidang_keahlian`
--
ALTER TABLE `bidang_keahlian`
  ADD PRIMARY KEY (`id_bidang_keahlian`),
  ADD KEY `id_daftar_bidang` (`id_daftar_bidang`),
  ADD KEY `id_guru` (`id_guru`);

--
-- Indexes for table `daftar_bidang_keahlian`
--
ALTER TABLE `daftar_bidang_keahlian`
  ADD PRIMARY KEY (`id_daftar_bidang`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`),
  ADD KEY `id_user` (`id_users`);

--
-- Indexes for table `jawaban_siswa`
--
ALTER TABLE `jawaban_siswa`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_soal` (`id_soal`);

--
-- Indexes for table `jawaban_siswa_remed`
--
ALTER TABLE `jawaban_siswa_remed`
  ADD PRIMARY KEY (`id_jawaban_remedial`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indexes for table `kelas_ujian`
--
ALTER TABLE `kelas_ujian`
  ADD PRIMARY KEY (`id_kelas_ujian`),
  ADD KEY `id_ujian` (`id_ujian`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`),
  ADD KEY `id_daftar_bidang` (`id_daftar_bidang`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_ujian` (`id_ujian`),
  ADD KEY `nis` (`id_siswa`);

--
-- Indexes for table `nilai_remedial`
--
ALTER TABLE `nilai_remedial`
  ADD PRIMARY KEY (`id_nilai_remedial`),
  ADD KEY `id_ujian_remedial` (`id_ujian_remedial`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_user` (`id_users`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `id_ujian` (`id_ujian`),
  ADD KEY `id_bank_soal` (`id_bank_soal`);

--
-- Indexes for table `soal_remed`
--
ALTER TABLE `soal_remed`
  ADD PRIMARY KEY (`id_soal_remedial`),
  ADD KEY `id_ujian_remedial` (`id_ujian_remedial`),
  ADD KEY `id_bank_soal` (`id_bank_soal`);

--
-- Indexes for table `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id_ujian`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `ujian_ibfk_2` (`id_guru`);

--
-- Indexes for table `ujian_remedial`
--
ALTER TABLE `ujian_remedial`
  ADD PRIMARY KEY (`id_ujian_remedial`),
  ADD KEY `id_ujian` (`id_ujian`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_soal`
--
ALTER TABLE `bank_soal`
  MODIFY `id_bank_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `bidang_keahlian`
--
ALTER TABLE `bidang_keahlian`
  MODIFY `id_bidang_keahlian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `daftar_bidang_keahlian`
--
ALTER TABLE `daftar_bidang_keahlian`
  MODIFY `id_daftar_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jawaban_siswa`
--
ALTER TABLE `jawaban_siswa`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `jawaban_siswa_remed`
--
ALTER TABLE `jawaban_siswa_remed`
  MODIFY `id_jawaban_remedial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kelas_ujian`
--
ALTER TABLE `kelas_ujian`
  MODIFY `id_kelas_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nilai_remedial`
--
ALTER TABLE `nilai_remedial`
  MODIFY `id_nilai_remedial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `soal_remed`
--
ALTER TABLE `soal_remed`
  MODIFY `id_soal_remedial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ujian_remedial`
--
ALTER TABLE `ujian_remedial`
  MODIFY `id_ujian_remedial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank_soal`
--
ALTER TABLE `bank_soal`
  ADD CONSTRAINT `bank_soal_ibfk_1` FOREIGN KEY (`id_daftar_bidang`) REFERENCES `daftar_bidang_keahlian` (`id_daftar_bidang`);

--
-- Constraints for table `bidang_keahlian`
--
ALTER TABLE `bidang_keahlian`
  ADD CONSTRAINT `bidang_keahlian_ibfk_2` FOREIGN KEY (`id_daftar_bidang`) REFERENCES `daftar_bidang_keahlian` (`id_daftar_bidang`),
  ADD CONSTRAINT `bidang_keahlian_ibfk_3` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`);

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`);

--
-- Constraints for table `jawaban_siswa`
--
ALTER TABLE `jawaban_siswa`
  ADD CONSTRAINT `jawaban_siswa_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`),
  ADD CONSTRAINT `jawaban_siswa_ibfk_2` FOREIGN KEY (`id_soal`) REFERENCES `soal` (`id_soal`);

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`);

--
-- Constraints for table `kelas_ujian`
--
ALTER TABLE `kelas_ujian`
  ADD CONSTRAINT `kelas_ujian_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`),
  ADD CONSTRAINT `kelas_ujian_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);

--
-- Constraints for table `mapel`
--
ALTER TABLE `mapel`
  ADD CONSTRAINT `mapel_ibfk_1` FOREIGN KEY (`id_daftar_bidang`) REFERENCES `daftar_bidang_keahlian` (`id_daftar_bidang`);

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`),
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `nilai_remedial`
--
ALTER TABLE `nilai_remedial`
  ADD CONSTRAINT `nilai_remedial_ibfk_1` FOREIGN KEY (`id_ujian_remedial`) REFERENCES `ujian_remedial` (`id_ujian_remedial`),
  ADD CONSTRAINT `nilai_remedial_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`);

--
-- Constraints for table `soal`
--
ALTER TABLE `soal`
  ADD CONSTRAINT `soal_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`),
  ADD CONSTRAINT `soal_ibfk_2` FOREIGN KEY (`id_bank_soal`) REFERENCES `bank_soal` (`id_bank_soal`);

--
-- Constraints for table `soal_remed`
--
ALTER TABLE `soal_remed`
  ADD CONSTRAINT `soal_remed_ibfk_1` FOREIGN KEY (`id_ujian_remedial`) REFERENCES `ujian_remedial` (`id_ujian_remedial`),
  ADD CONSTRAINT `soal_remed_ibfk_2` FOREIGN KEY (`id_bank_soal`) REFERENCES `bank_soal` (`id_bank_soal`);

--
-- Constraints for table `ujian`
--
ALTER TABLE `ujian`
  ADD CONSTRAINT `ujian_ibfk_1` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`),
  ADD CONSTRAINT `ujian_ibfk_2` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`);

--
-- Constraints for table `ujian_remedial`
--
ALTER TABLE `ujian_remedial`
  ADD CONSTRAINT `ujian_remedial_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `UNPOST_UJIAN_REMED_SAAT_TANGGAL_KADALUARSA` ON SCHEDULE EVERY 1 DAY STARTS '2018-03-11 10:20:01' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
	/* Meng unpost ujian jika sudah kadaluarsa */
	UPDATE ujian_remedial SET STATUS = IF(ujian_remedial.`tanggal_kadaluarsa` = CURDATE(), 'Sudah Selesai', 'posted');
	
	/* Menginput semua siswa yang belum mengerjakan ke table nilai dengan status harus susulan */
	CALL insert_data_siswa_saat_remed_kadaluarsa(`ujian_remedial`.`id_ujian_remedial`);
		
	END$$

CREATE DEFINER=`root`@`localhost` EVENT `UNPOST_UJIAN_SAAT_TANGGAL_KADALUARSA` ON SCHEDULE EVERY 1 DAY STARTS '2018-03-11 10:20:01' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
	/* Meng unpost ujian jika sudah kadaluarsa */
	UPDATE ujian SET STATUS = IF(ujian.`tanggal_kadaluarsa` = CURDATE(), 'Draft', 'posted');
	
	/* Menginput semua siswa yang belum mengerjakan ke table nilai dengan status harus susulan */
	CALL insert_data_siswa_saat_tanggal_kadaluarsa(ujian.`id_ujian`);
		
	END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
