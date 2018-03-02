-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2018 at 06:55 AM
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
(5, 2, 5),
(6, 2, 18);

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
(1, 'Pendidikan Agama dan Budi Pekerti'),
(2, 'PPKn'),
(3, 'Bahasa Indonesia'),
(4, 'Matematika'),
(5, 'Sejarah Indonesia'),
(6, 'Bahasa Inggris'),
(7, 'Seni Budaya'),
(8, 'Prakarya an Kewirausahaan'),
(9, 'Penjas, Olahraga & Kesehatan'),
(10, 'Pendikikan Lingkungan Hidup'),
(11, 'Bahasa Daerah'),
(12, 'Bahasa Jepang'),
(13, 'Pemrograman Berorientasi Objek'),
(14, 'Basis Data'),
(15, 'Pemrograman Web Dinamis'),
(16, 'Pemrograman Grafik'),
(17, 'Pemrograman Perangkat Bergerak'),
(18, 'Administrasi Basis Data'),
(19, 'Kerja Proyek RPL');

--
-- Triggers `daftar_bidang_keahlian`
--
DELIMITER $$
CREATE TRIGGER `hapus_bidang_keahlian_pas_hapus_daftar_bidang_keahlian` BEFORE DELETE ON `daftar_bidang_keahlian` FOR EACH ROW BEGIN
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
(2, '12345678912345678912', 140, 'Yesterday Once More', 'Jalan Dimana Saja', 'P', 'water-bg_1519917994.jpg');

--
-- Triggers `guru`
--
DELIMITER $$
CREATE TRIGGER `hapus_user_dan_ujian_pas_hapus_guru` BEFORE DELETE ON `guru` FOR EACH ROW BEGIN
	DELETE FROM ujian WHERE id_guru = old.id_guru;
	DELETE FROM bidang_keahlian WHERE id_guru = old.id_guru;
    END
$$
DELIMITER ;

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
(6, 'Pemasaran'),
(7, 'Jurusan Baru');

--
-- Triggers `jurusan`
--
DELIMITER $$
CREATE TRIGGER `hapus_kelas_pas_hapus_jurusan` BEFORE DELETE ON `jurusan` FOR EACH ROW BEGIN
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
(6, 'XII TKJ', 3),
(7, 'XIII RPL 1', 1);

--
-- Triggers `kelas`
--
DELIMITER $$
CREATE TRIGGER `hapus_kelas_ujian_dan_siswa_pas_hapus_kelas` BEFORE DELETE ON `kelas` FOR EACH ROW BEGIN
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
(1, 7, 1),
(2, 7, 2),
(3, 7, 3),
(4, 7, 4),
(5, 7, 5),
(6, 7, 6),
(7, 7, 7);

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL,
  `nama_mapel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `nama_mapel`) VALUES
(1, 'Pendidikan Agama dan Budi Pekerti'),
(2, 'PPKn'),
(3, 'Bahasa Indonesia'),
(4, 'Matematika'),
(5, 'Sejarah Indonesia'),
(6, 'Bahasa Inggris'),
(7, 'Seni Budaya'),
(8, 'Prakarya an Kewirausahaan'),
(9, 'Penjas, Olahraga & Kesehatan'),
(10, 'Pendikikan Lingkungan Hidup'),
(11, 'Bahasa Daerah'),
(12, 'Bahasa Jepang'),
(13, 'Pemrograman Berorientasi Objek'),
(14, 'Basis Data'),
(15, 'Pemrograman Web Dinamis'),
(16, 'Pemrograman Grafik'),
(17, 'Pemrograman Perangkat Bergerak'),
(18, 'Administrasi Basis Data'),
(19, 'Kerja Proyek RPL');

--
-- Triggers `mapel`
--
DELIMITER $$
CREATE TRIGGER `hapus_ujian_pas_hapus_mapel` BEFORE DELETE ON `mapel` FOR EACH ROW BEGIN
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
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_ujian`, `id_siswa`, `jawaban_benar`, `jawaban_salah`, `nilai`) VALUES
(1, 7, 2, 1, 1, 50),
(2, 7, 3, 0, 2, 0),
(3, 7, 4, 1, 1, 50),
(4, 7, 5, 2, 0, 100),
(5, 7, 6, 2, 0, 100),
(6, 7, 7, 2, 0, 100);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('yanuar.wanda2@gmail.com', '$2y$10$gNVzBLl6iEGSPx8sKJDuRuOVSoXOzYrgRtUMa0tZOibXSDy9JT/Sa', '2018-03-01 16:25:36');

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
  `foto` varchar(256) NOT NULL COMMENT 'Foto Profil Siswa'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `id_users`, `id_kelas`, `nama`, `alamat`, `jenis_kelamin`, `foto`) VALUES
(2, '1502011462', 142, 2, 'Yanuar Wanda Putra', 'Jalan Marga Asri VI G.', 'L', '13700183_1092905147445894_1933285681459202097_n_1519918379.jpg'),
(3, '1502011463', 143, 1, 'Riki Subagja', 'Jalan Deket Rumah Saya', 'L', '1_1519919858.jpg'),
(4, '1502011464', 144, 3, 'Whisnu Mulya Kedua', 'Pasar Atas', 'L', 'IMG_20151118_105710_1519920021.jpg'),
(5, '1502011466', 145, 4, 'Muhammad Rizal', 'Pasar Pojok', 'L', 'DSC_0126_1519920077.JPG'),
(6, '1502011467', 146, 5, 'Ngudi Prasodjo', 'Jalan Padjajaran Deket SMKN 12 Bandung', 'L', 'IMG_20150925_085835_1519920356.jpg'),
(7, '1502011468', 147, 6, 'Muhammad Fauzan Faturrahman', 'Jamika', 'L', 'Screenshot (160)_1519920644.png');

--
-- Triggers `siswa`
--
DELIMITER $$
CREATE TRIGGER `hapus_nilai_pas_hapus_siswa` BEFORE DELETE ON `siswa` FOR EACH ROW BEGIN
	DELETE FROM nilai WHERE id_siswa = old.id_siswa;
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
  `tipe` varchar(50) NOT NULL,
  `isi_soal` text NOT NULL,
  `pilihan` text NOT NULL,
  `jawaban` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id_soal`, `id_ujian`, `tipe`, `isi_soal`, `pilihan`, `jawaban`) VALUES
(1, 7, 'BS', '<p>Apakah i termasuk dalam alphabet?</p>', 'Benar ,  Salah', 'Benar'),
(2, 7, 'PG', '<p>Apakah bahasa daerah utama di jawa barat?</p>', '<p>Sunda</p> ,  <p>Jawa</p> ,  <p>Inggris</p> ,  <p>Jerman</p> ,  <p>Russia</p>', '<p>Sunda</p>');

-- --------------------------------------------------------

--
-- Table structure for table `ujian`
--

CREATE TABLE `ujian` (
  `id_ujian` int(11) NOT NULL COMMENT 'Primary Key.',
  `id_mapel` int(11) NOT NULL COMMENT 'Kolom untuk relasi ke tabel mapel.',
  `id_guru` int(10) UNSIGNED DEFAULT NULL COMMENT 'Kolom untuk relasi ke tabel guru.',
  `judul_ujian` varchar(200) DEFAULT NULL COMMENT 'Judul ujian.',
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

INSERT INTO `ujian` (`id_ujian`, `id_mapel`, `id_guru`, `judul_ujian`, `waktu_pengerjaan`, `tanggal_pembuatan`, `tanggal_post`, `tanggal_kadaluarsa`, `status`, `catatan`) VALUES
(7, 11, 2, 'Judul', '01:03:01', '2018-03-01 15:50:23', '2018-03-01 15:50:23', '2018-04-06', 'posted', 'Ini Catatan');

--
-- Triggers `ujian`
--
DELIMITER $$
CREATE TRIGGER `hapus_soal_dan_nilai_pas_hapus_ujian` BEFORE DELETE ON `ujian` FOR EACH ROW BEGIN
	DELETE FROM soal WHERE id_ujian = old.id_ujian;
	DELETE FROM nilai WHERE id_ujian = old.id_ujian;
	delete from kelas_ujian WHERE id_ujian = old.id_ujian;
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
(1, 'laracry', 'mzfahri620@gmail.com', '$2y$10$aVnJAtv0V.Jo4e2Ob0GOFO/2fsdbjC347gNPCPUHYL9wu3Nfsv7sC', 'FSKyjRrN6FT1AG1EipoQHdAhGefHVxZWT7bcbtQ79TbUFxLTynA6HFPDCPJO', 'admin', '2018-02-26 04:11:25', '2018-02-26 04:11:30'),
(140, 'yesterdayoncemore', 'yesterday.once@gmail.com', '$2y$10$2dYgZFHwrXOHZTdvmbLn0esBYpuMi4cQ5dhoo/C/el91h1aG0MDcK', 'UqSM3Nais8xv2h3dGalXf393YK1tuUgIA2VWy5Cb1YpRyQ2ILOjZoKAGqyoh', 'guru', '2018-03-01 15:26:34', '2018-03-01 15:26:34'),
(142, 'yanuarwanda', 'yanuar.wanda2@gmail.com', '$2y$10$RHae3tmG0.8.vr8DH.Iff.VVH5hCmk4gax64.8mxDXE96XlLL9dyi', 'l64dtCfmmz2A3NLfCVThtrN35bE39ud8QAk2qLFHWjfUHpzZpSooFLjNqAod', 'siswa', '2018-03-01 15:29:35', '2018-03-01 15:29:35'),
(143, 'bagja', 'riki.subagja@gmail.com', '$2y$10$KwJdfJaM9Kh0IlY7AR/m3OnGs0/abWofeUFfhP9Li/P8Ms4XWvvZG', '0yDPMoehLkYMekzDIcGn6COIlIHK5wQxqflklq4LmNiDqkTuBiYMgxzRkaPx', 'siswa', '2018-03-01 15:57:38', '2018-03-01 15:57:38'),
(144, 'whisnu', 'whisnu.mulya@gmail.com', '$2y$10$tyDXfjZFiz/DuKS3ibGUkOzNs2VUDM7k7AsSyP5P4tgVaIDSV72me', 'VGEL54rwY7TEYhllTYMuxonY8LzGTU0GuIqq0wLqMeQ2cg59xwAr9pwAW4Dc', 'siswa', '2018-03-01 16:00:21', '2018-03-01 16:00:21'),
(145, 'rizal2', 'vectorarts@gmail.com', '$2y$10$MSSxumU.qaInYH1pzbDgW.4kYYx5MYdznEGrARRbWYQveXXxNRMeS', 'bWKYOMX4O6mSIJISFTI6LbRKEbsdy119F42V4hBx047TQkM6eLnhlVS3zYUq', 'siswa', '2018-03-01 16:01:17', '2018-03-01 16:01:17'),
(146, 'nguday', 'n.pras@gmail.com', '$2y$10$L27.mRMMksIaoL7sAsdhAuCRENq6RxizXXh4m5zO8FEhWn.LaDDLy', 'TyhOtO1HbbtffA8Vxq9jjO9JyMJRhTcuVj4yCCGzBWzuEqngMaHrhMBgUlo2', 'siswa', '2018-03-01 16:05:56', '2018-03-01 16:05:56'),
(147, 'jantung', 'mfauzan@gmail.com', '$2y$10$jJ/5LRh.K5gmAphqrrfpx.ZR4rqeKGMUMmtK2QzUem6ZmYZxXThpa', 'lKMWU8k5eEBSNpxgXZVTPrc7RsohITAK6EXNuPQ9PStv4gSVHlPDX7dBStrv', 'siswa', '2018-03-01 16:10:44', '2018-03-01 16:10:44');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `hapus_guru_pas_hapus_users` BEFORE DELETE ON `users` FOR EACH ROW BEGIN
	DELETE FROM guru WHERE id_users = old.id_users;
    END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`id_mapel`);

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
  ADD KEY `id_ujian` (`id_ujian`);

--
-- Indexes for table `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id_ujian`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `ujian_ibfk_2` (`id_guru`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bidang_keahlian`
--
ALTER TABLE `bidang_keahlian`
  MODIFY `id_bidang_keahlian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `daftar_bidang_keahlian`
--
ALTER TABLE `daftar_bidang_keahlian`
  MODIFY `id_daftar_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kelas_ujian`
--
ALTER TABLE `kelas_ujian`
  MODIFY `id_kelas_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- Constraints for dumped tables
--

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
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`),
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`);

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
  ADD CONSTRAINT `soal_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`);

--
-- Constraints for table `ujian`
--
ALTER TABLE `ujian`
  ADD CONSTRAINT `ujian_ibfk_1` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`),
  ADD CONSTRAINT `ujian_ibfk_2` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
