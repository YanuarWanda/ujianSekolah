-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2018 at 05:56 PM
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
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `nip` varchar(50) NOT NULL,
  `id` int(10) UNSIGNED NOT NULL,
  `bidang_keahlian` text,
  `nama` varchar(150) NOT NULL,
  `alamat` text,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `foto` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nip`, `id`, `bidang_keahlian`, `nama`, `alamat`, `jenis_kelamin`, `foto`) VALUES
('1111231142513', 7, 'IT', 'Faroon', 'Jalan Suka suka', 'L', 'nophoto.jpg'),
('12345678', 24, 'YANANAN', 'YANANA', 'YANANA', 'L', 'nophoto.jpg'),
('123456789987654321', 10, 'IT', 'Asep McHusen', 'SetiaBudi', 'P', '2_1517026660.jpg'),
('1293819284912', 25, 'MMAKJDKWAJ', 'MMAKSJDKASJ', 'MMADKJWDKADJ', 'L', NULL),
('1431242194871248', 23, 'jakdjwk', 'akdjwjdkaw', 'djakjdkw', 'L', 'nophoto.jpg'),
('150901293102', 21, 'Rekayasa Perangkat Lunak', 'Yanuar Wanda Putra', 'Jln. Marga Asri VI G. Blok C No 170', 'L', 'masyan_1516646821.png'),
('182731873812', 22, 'jdakwdjwka', 'akjdskawjd', 'lajkdklawjd', 'L', '13700183_1092905147445894_1933285681459202097_n_1516647055.jpg'),
('1958829381923', 1, 'IT', 'Ini nama guru loh sebenernya', 'Jalan Road', 'L', 'nophoto.jpg');

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
(1, 'MAPEL');

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
  `nis` varchar(10) NOT NULL,
  `jawaban_benar` int(11) NOT NULL,
  `jawaban_salah` int(11) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `nis` varchar(10) NOT NULL,
  `id` int(10) UNSIGNED NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` text,
  `jenis_kelamin` char(1) NOT NULL,
  `foto` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `id`, `id_kelas`, `nama`, `alamat`, `jenis_kelamin`, `foto`) VALUES
('1502011448', 19, 2, 'MMS', 'SADMkodakdwo', 'L', 'intro_1516645736.jpg'),
('1502011462', 20, 2, 'Yanuar Wanda Putra', 'Jln. Marga Asri VI G. Blok C No 170', 'L', '13700183_1092905147445894_1933285681459202097_n_1517025405.jpg');

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

-- --------------------------------------------------------

--
-- Table structure for table `ujian`
--

CREATE TABLE `ujian` (
  `id_ujian` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `judul_ujian` varchar(50) DEFAULT NULL,
  `waktu_pengerjaan` time NOT NULL,
  `tanggal_post` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_kadaluarsa` date NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Draft'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ujian`
--

INSERT INTO `ujian` (`id_ujian`, `id_mapel`, `nip`, `judul_ujian`, `waktu_pengerjaan`, `tanggal_post`, `tanggal_kadaluarsa`, `status`) VALUES
(2, 1, '12345678', 'JUDUUL', '04:00:00', '2018-01-08 17:00:00', '2018-01-10', 'AKRTIGF'),
(3, 1, '1958829381923', NULL, '02:02:00', '2018-01-28 13:54:51', '2018-01-17', 'Draft'),
(4, 1, '1958829381923', 'Judul yang ke 3', '03:03:00', '2018-01-28 13:56:26', '2018-01-19', 'Draft');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
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

INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `hak_akses`, `created_at`, `updated_at`) VALUES
(1, 'laracry', 'test@example.com', '$2y$10$tDcmXuHyf0qm.vlCHGhf/ufbcrC01o99T0Edz4zbPHI4sdVkUc9ja', 'tPkmZdbQVOxSQMYlLCPFZMg730zT8z8voa7vhQo6rrZ3hGsGKxQegzUUHS6Z', 'admin', '2018-01-21 05:51:29', '2018-01-21 05:51:33'),
(4, 'kuyaBaleum', 'yanuar.wanda2@gmail.com', '$2y$10$NEGxXp3pi.bdDcMQnzz3ROtE3RKkrR/txgnPnAIPEtniOcYnyAq9O', 'hgmpkARFsPFJ663nLJXA7lOHMnRMIvcW1Qx1dIoI2tkTyQsgFNW5pev2xZut', 'siswa', '2018-01-20 23:13:50', '2018-01-22 00:24:55'),
(5, 'a', 'test@gmail.com', '123', 'kipffpipo', 'guru', '2018-01-21 03:18:20', '2018-01-21 03:18:20'),
(6, 'guruku', 'tesst@fda.a', '$2y$10$402DyxrYWFBvRq91zVvelOoIecg3ZPYhUebCLYMhd0W/d9oEOSbFG', NULL, 'guru', '2018-01-21 03:38:52', '2018-01-21 05:16:57'),
(7, 'faroon', 'far@s.co', '$2y$10$9byFuVHo5ZYfrR5to0p6R.UWn7T9JISMSw2rmu3RfMeAQlX1hNlkW', NULL, 'guru', '2018-01-21 05:21:04', '2018-01-21 05:21:04'),
(10, 'ieedes', 'asep@ima.coo', '$2y$10$4TQsUj3KpL27NN3UbkPpU.l2RHN.90PicAbUeH1K0EEXvJjFuxvXu', NULL, 'guru', '2018-01-21 20:08:18', '2018-01-26 21:17:40'),
(11, 'onratus', 'deafitrih16@gmail.com', '$2y$10$cSIr1Ex6CSGeqsviz5SBM.GNTjNz5Nc2P1RC37NFxLad/UKpgfQou', 'NsSBZaNxuyaPTOsg7l1tzebWqnSBJgThhrS6UcLyBpzjyaotuRqmxo2ifZMz', 'siswa', '2018-01-21 23:06:35', '2018-01-21 23:06:35'),
(12, 'jajang', 'wsetiawan135790@gmail.com', '$2y$10$YOQF5NbSRvxlYASE2T.BMujEoUF49khfBkZJqyvj80St/mp/UBFdG', 'vebLlRmpy8WaGdoCrZTs0xH9wRjTc8thsyvuiC15hdh9gtQOfqkUMtOUEMoE', 'siswa', '2018-01-22 00:28:47', '2018-01-22 00:41:53'),
(13, 'chihuahua bucin', 'family.syaiful007@gmail.com', '$2y$10$mePDg7sdXsFpzVouP5O1TOXFDZTosdb/lcJ.LoqXoqYr9/Ilw.ceC', 'b3qXcyXwXvf3Deu3JQmIkJGPZLEfOxLilGbPWNfgIMBtafiX9F5aFBqY6ZoJ', 'siswa', '2018-01-22 00:32:29', '2018-01-22 00:32:29'),
(14, 'iedesu', 'bang@sa.de', '$2y$10$iHyVyW05t1eHfWPocB6Tz.d9cTR8fR.71n3xhMx3UutzFX/5C.OQK', 'ATrhJnFEKcQPRGqg3pz53NOpYxKGGqJJTx7Kg96NsX17l3fHHMJVsSA2nTSZ', 'siswa', '2018-01-22 00:39:14', '2018-01-22 00:40:20'),
(15, 'Nurok', 'amalianuro74@gmail.com', '$2y$10$/lPLnTtuNVh8Cr7SSgOSsupTBN/W0GFBtv6OcdPxf5hZyoF5k8AsS', 'QWvzdSKvZvzxa1ftccc3pKAzOlaODzlzySTieF4KK8Ep1GxjQzPZOP4VIgiu', 'siswa', '2018-01-22 00:49:48', '2018-01-22 00:49:48'),
(16, 'DummyStyle', 'jajangwara@gmail.com', '$2y$10$jdwoM5SNOYeXTO8EHYujMuhLz1gQ/UMtAKSqx6GN.QWRC6EZJUbya', NULL, 'siswa', '2018-01-22 00:54:34', '2018-01-22 00:54:34'),
(17, 'tester', 'test@example.com', '$2y$10$9Mh67CVodNC7Ie3/qLIDGuX2NBr94LfLT07adBXYtrF92ePA.xaye', NULL, 'siswa', '2018-01-22 06:40:52', '2018-01-22 06:43:41'),
(18, 'aksjak', 'ss@s.css', '$2y$10$ofsgDtIKUA.AswYUNTsHWO8on2LRjTiWKWyPqvvBr1jqKp.FbnSre', NULL, 'siswa', '2018-01-22 11:06:53', '2018-01-22 11:06:53'),
(19, 'akabsjsk', 'ss@s.xxs', '$2y$10$kNuINXXb5y.rt.2.nfc8s.oEkAOZDfzg2dxZEfRP7EOIO0L5lo71a', NULL, 'siswa', '2018-01-22 11:08:33', '2018-01-22 11:28:56'),
(20, 'yanuarwanda', 'yanuar.wanda22@gmail.com', '$2y$10$25GhyiiMHDvKkvwtpvW41el3Ewtiue3IgwfVamgqP6OmseN0CuGQO', NULL, 'siswa', '2018-01-22 11:35:43', '2018-01-26 20:56:45'),
(21, 'yanuaww', 'yanuar.wanda221@gmail.co', '$2y$10$8rfkDLtXxFX0pIt1u8SA9.qpxEh1mY5pjz42J8cjReNcetJhj9.9a', NULL, 'guru', '2018-01-22 11:47:01', '2018-01-22 11:47:01'),
(22, 'adwadawd', 'awdadawd@a.a', '$2y$10$3.C0zA76bWFwfhyABZYs8eHqXKCwayXW826SEfVOoFmfanFR.OgF2', NULL, 'guru', '2018-01-22 11:47:24', '2018-01-22 11:50:55'),
(23, '1231kjsks', 'akjdkwad@a.s', '$2y$10$tjc3sBT/3QT6IKu.qNSime.LofQokOBNjlLa8G/HdoEw8OE/KbMe6', NULL, 'guru', '2018-01-22 12:01:12', '2018-01-22 12:01:12'),
(24, 'YANANA', 'YANANA@NA.NA', '$2y$10$9C067KYxaMkW4ZIyeJwDLO1dhvaJxA3s5ipJSTTYCGSBeU..8sEU6', NULL, 'guru', '2018-01-22 12:02:30', '2018-01-22 12:02:30'),
(25, 'mmmmmmmm', 'MM@mm.mm', '$2y$10$iaZHNRQOzI5GpWum1Es9Y.L7F9Fkq0vTfA3oiZuDxb0iU1avNdKci', NULL, 'guru', '2018-01-22 12:03:16', '2018-01-22 12:03:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `id_user` (`id`);

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
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `id_user` (`id`),
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
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

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
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`);

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`),
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

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
  ADD CONSTRAINT `ujian_ibfk_2` FOREIGN KEY (`nip`) REFERENCES `guru` (`nip`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
