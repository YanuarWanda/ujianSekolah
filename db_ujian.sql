-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2018 at 07:24 AM
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
(1, 1, 4),
(2, 1, 6),
(3, 2, 10),
(4, 2, 14);

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
(1, '1234567890987654321', 2, 'Erika Karata', 'Jalan Karapitan', 'P', 'Screenshot (3)_1519618625.png'),
(2, '12738292718347382937', 6, 'Yanuar Wanda Putra', 'Bumi Asri', 'L', 'nophoto.jpg');

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
(7, 1, 2),
(8, 1, 4),
(9, 1, 5),
(17, 6, 2),
(18, 7, 2),
(19, 8, 2);

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
(3, 6, 3, 0, 1, 0),
(4, 1, 2, 3, 1, 75);

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
  `foto` varchar(256) NOT NULL COMMENT 'Foto Profil Siswa'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `id_users`, `id_kelas`, `nama`, `alamat`, `jenis_kelamin`, `foto`) VALUES
(1, '1502011293', 3, 2, 'Daniel Dwi Fortuna', 'Jalan Cipedes tengah 38, Bandung', 'L', 'Ijazah_180226_0025_1519619013.jpg'),
(2, '1502011309', 5, 2, 'Wendy Setiawan', 'Jalan Kebonkopi 80, Bandung', 'L', 'Ijazah_180226_0001_1519619299.jpg'),
(3, '1502011376', 4, 2, 'Muhammad Syaiful Mahialhakim', 'Jalan Gunungbatu 58, Bandung', 'L', 'Ijazah_180226_0013_1519619129.jpg');

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
(2, 1, 'BS', '<p>Apakah ini bisa digunakan?</p>', 'Benar ,  Salah', 'Benar'),
(3, 1, 'BS', '<p>Apakah isi dari 5 x 5 + 5 - 5 x 0 = 20?</p>', 'Benar ,  Salah', 'Salah'),
(4, 1, 'BS', 'Apakah 1 + 1 = 5?', 'Benar ,  Salah', 'Salah'),
(5, 6, 'PG', '<p>asdaldjwaljdjkwa</p>', '<p>ZXCXCMZ,C</p> ,  <p>AKLSDJAS</p> ,  <p>SDJKAKLDJAS</p> ,  <p>LKSDJKALSD</p> ,  <p>JASLJKDAKSD</p>', '<p>LKSDJKALSD</p>'),
(6, 1, 'PG', '<p>Apakah semuanya akan berlalu?</p>', '<p>Mungkin</p> ,  <p>Bisa Jadi</p> ,  <p>Tidak</p> ,  <p>Iya</p> ,  <p>Nya kitu welah</p>', '<p>Nya kitu welah</p>');

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
(1, 6, 1, 'Things about manners', '01:00:00', '2018-02-27 07:39:56', '2018-02-26 05:30:04', '2018-02-26', 'posted', 'Ulangan harian'),
(3, 12, 1, 'Ujian Harian', '01:00:00', '2018-02-27 07:39:56', '2018-02-26 05:42:33', '2018-02-26', 'Draft', 'untuk kepentingan laporan'),
(4, 1, 1, 'Judul ke 221x', '02:01:00', '2018-02-27 07:39:56', '2018-02-26 15:13:08', '2018-02-28', 'Draft', 'asdasd'),
(5, 14, NULL, 'Judul ke berapa', '03:00:00', '2018-02-27 07:39:56', '2018-02-26 15:30:58', '2018-03-09', 'Draft', 'adjakwdjka'),
(6, 14, 2, 'adiowdjoa', '03:00:00', '2018-02-27 07:39:56', '2018-02-26 15:31:50', '2018-02-26', 'posted', 'klasdjkasld'),
(7, 14, 2, 'Ini Basis Data', '02:00:00', '2018-02-27 18:39:02', '2018-02-27 18:39:02', '2018-03-09', 'posted', 'Ini Catatan'),
(8, 10, 2, 'Ini PLH', '00:05:00', '2018-02-27 18:56:52', '2018-02-27 18:56:52', '2018-03-10', 'posted', 'Ini Catatan 2');

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
(1, 'laracry', 'mzfahri620@gmail.com', '$2y$10$aVnJAtv0V.Jo4e2Ob0GOFO/2fsdbjC347gNPCPUHYL9wu3Nfsv7sC', 'qZKUrsbkXp6JCI1X7jkRgQfPBQwdpoyPxQiwEAAPGmi2g8MP9TJYBlL1EXxr', 'admin', '2018-02-26 04:11:25', '2018-02-26 04:11:30'),
(2, 'ErikaZul', 'erika_zul@gmail.com', '$2y$10$jAIDnzFg0Yus4xxyjOnk9eB2pYuYfm7ZF7c3.QXb4a5MYueYZ8Z9u', 'FgrFxOMcvtDFh640FTSVCFl9KLJms2jQVpIAXiZzQ7AM5F6hlYWeOJawSTED', 'guru', '2018-02-26 04:17:05', '2018-02-26 14:39:29'),
(3, 'dnaomissions', 'danieldwifortuna48@gmail.com', '$2y$10$QLDH5YW3laEDwTA17E/roe/YQjURNR2LK/WZunY83sMDzGDwzUgCG', NULL, 'siswa', '2018-02-26 04:23:33', '2018-02-26 04:23:33'),
(4, 'lufiays', 'family.syaiful007@gmail.com', '$2y$10$QKODz5qcLcxo0AavaKINdeQYCY8Bl6Ba/ZqN/567T1pxo0oFv51qi', 'zHLcA3owYDfdddhyuHnz8LqQpacNaRJwF9O5hByvDGumVGsfO0hR2eYOGlYZ', 'siswa', '2018-02-26 04:25:29', '2018-02-26 14:38:18'),
(5, 'wsetiawan', 'wsetiawan135790@gmail.com', '$2y$10$DaTUQVhL8DIcc6z5OBnr9ePSVoRHleoDLQz3KyZ5LoP/uQXwYHYNy', 'tHaTA3etD1HORI8uDTI14RjXOBMSzsTi6L8wYkI5dfhNGRBReL3s8f9wUxhv', 'siswa', '2018-02-26 04:28:19', '2018-02-27 06:47:46'),
(6, 'yanuarwanda', 'yanuar.wanda2@gmail.com', '$2y$10$JdoFIr3Kka/gjRwxrVA08uUbFZiuMK1.46bJGgc6sHIc3inB.BHLe', 'sMPs9f7jQAsi1c6WmRAYstHh9ijiOONb5tkh3kgQ4aO81ojLcb5rgKVuys0W', 'guru', '2018-02-26 15:15:24', '2018-02-26 15:15:24');

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
  MODIFY `id_bidang_keahlian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id_kelas_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key.', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
