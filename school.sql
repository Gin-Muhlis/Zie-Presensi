-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2023 at 10:52 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `no_absen` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('hadir','izin','sakit','tanpa keterangan') NOT NULL,
  `keterangan` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `no_absen`, `nama`, `kelas`, `tanggal`, `status`, `keterangan`) VALUES
(67, 1, 'm abdul kholik', '11 rpl 1', '2023-02-03', 'sakit', 'batuk pilek'),
(68, 2, 'arkha alesya', '11 rpl 1', '2023-01-30', 'izin', 'pergi ke bandung'),
(69, 6, 'gin gin nurilham muhlis', '11 rpl 1', '2023-01-30', 'hadir', '-'),
(70, 8, 'kiky', '11 rpl 2', '2023-01-30', 'izin', 'latihan pramuka'),
(71, 9, 'm bintang al ghazali', '11 rpl 2', '2023-01-30', 'hadir', '-'),
(75, 2, 'arkha alesya', '11 rpl 1', '2023-02-02', 'sakit', 'demam'),
(76, 13, 'ainur rofiq', '11 rpl 1', '2023-02-02', 'hadir', '-'),
(77, 3, 'daniel kustiawan', '11 rpl 1', '2023-02-03', 'hadir', '-'),
(78, 8, 'kiky', '11 rpl 2', '2023-02-04', 'hadir', '-'),
(79, 6, 'gin gin nurilham muhlis', '11 rpl 1', '2023-02-09', 'hadir', '-');

-- --------------------------------------------------------

--
-- Table structure for table `absensi_guru`
--

CREATE TABLE `absensi_guru` (
  `id` int(11) NOT NULL,
  `nip` int(11) NOT NULL,
  `nama` varchar(1000) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('hadir','sakit','izin','tanpa keterangan') NOT NULL,
  `keterangan` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi_guru`
--

INSERT INTO `absensi_guru` (`id`, `nip`, `nama`, `tanggal`, `status`, `keterangan`) VALUES
(4, 123456789, 'sarah siti sumaerah', '2023-02-01', 'sakit', 'demam tinggi'),
(5, 123456789, 'sarah siti sumaerah', '2023-02-03', 'hadir', '-'),
(7, 98743208, 'mariam hidayat', '2023-02-09', 'sakit', '-');

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `pengajar` varchar(500) NOT NULL,
  `jam` varchar(200) NOT NULL,
  `materi` varchar(500) NOT NULL,
  `keterangan` varchar(2000) NOT NULL,
  `kelas` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id`, `tanggal`, `pengajar`, `jam`, `materi`, `keterangan`, `kelas`) VALUES
(5, '2023-01-30', 'dikdik juanda', 'Pertama', 'sikap toleransi', 'masuk dan ada tugas toleransi', '11 rpl 1'),
(7, '2023-01-31', 'novi siswayanti', 'pertama', 'transformasi dan dilatasi', 'masuk', '11 rpl 1'),
(8, '2023-01-31', 'ginanjar prapta m.', 'kedua', 'peran indonesia dalam perdamaian dunia', 'masuk', '11 rpl 1'),
(9, '2023-02-01', 'leni haryani', 'pertama', 'report text', 'masuk', '11 rpl 1'),
(10, '2023-02-03', 'yaqub hadi', 'pertama', 'game tebak gambar', 'masuk', '11 rpl 1');

-- --------------------------------------------------------

--
-- Table structure for table `cookie`
--

CREATE TABLE `cookie` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `foto` varchar(1000) NOT NULL,
  `nip` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jenis_kelamin` varchar(25) NOT NULL,
  `level` varchar(100) NOT NULL,
  `kelas` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `foto`, `nip`, `nama`, `jenis_kelamin`, `level`, `kelas`, `password`) VALUES
(1, '63e31b03b9b6b.jpg', 123456789, 'sarah siti sumaerah', 'perempuan', 'wali kelas', '11 rpl 1', '$2y$10$YUtftyfXw/9pQnlmTtrIlOxSZEPlLqQeWSA7Bl1LgHugKJ.JyJWT6'),
(2, '', 987654321, 'yayat ruhiyat', '1', 'guru', '', '$2y$10$JS82zJLA3om4UY.NN1RqruzmZIEeVBNwHnI75VdyvaS5KeFw54Wuu'),
(3, '', 214748364, 'yaqub hadi', 'Laki-Laki', 'guru', '', '$2y$10$YAEhVYeg7ojwfXr8OZXqCejaMgNhOmkRdVQD2kBaxbzzUkDqu0OFu'),
(4, '', 65749234, 'novi siswayanti', 'Perempuan', 'wali kelas', '11 rpl 2', '$2y$10$ASSZlpRlsSSiK9cAAb331eX9r44XnAI5J8GY2CJqQ3CFCsAHJ07oG'),
(5, '', 34567812, 'dikdik juanda nugraha', 'Laki-Laki', 'guru', '', '$2y$10$dkM0ZwEoUQj3/JT8iPwofudS62CyUjbytUrTv1NTvEq/9ztnqjhfm'),
(6, '', 98073641, 'tedi herdiansah', 'Laki-laki', 'guru', '', '$2y$10$Hh9IvG4xfiDSf9hNR7Ym7OuoffubRnL.ZOUbBMCmEciUj/Iguo5ce'),
(7, '', 30958234, 'ginanjar prapta m.', 'Laki-Laki', 'guru', '', '$2y$10$ZLU7PAX8n0T9wHDyPfi1/u3jmiXcizo.BcLgFdVOm7DZU38KgYCFS'),
(8, '', 53678123, 'leni haryani', 'Laki-laki', 'guru', '', '$2y$10$6H8iF04cAb//RUahWmdZNOeaaxKY43i21vY/8XNOUYE9J9K0uQjJy'),
(9, '', 25763456, 'a. luddie tri saputra', 'Laki-laki', 'guru', '', '$2y$10$G8VUSXnxRANXpfDevQHtne2oWz3LQVk2k0DEZmZ2otcanD6PGEWUm'),
(10, '63e4ec102f1d1.jpg', 98743208, 'mariam hidayat', 'perempuan', 'bk', '', '$2y$10$XBYo2.Mej/hexbuQ8Y7kDe.CWW8.WsR1dw3Bat6GpgA36orujD2hu');

-- --------------------------------------------------------

--
-- Table structure for table `hari`
--

CREATE TABLE `hari` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hari`
--

INSERT INTO `hari` (`id`, `nama`) VALUES
(1, 'Senin'),
(2, 'Selasa'),
(3, 'Rabu'),
(4, 'Kamis'),
(5, 'Jumat');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_guru` int(11) DEFAULT NULL,
  `id_mapel` int(11) DEFAULT NULL,
  `id_hari` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `jam_mulai`, `jam_selesai`, `id_kelas`, `id_guru`, `id_mapel`, `id_hari`) VALUES
(1, '07:00:00', '09:00:00', 1, 5, 6, 1),
(3, '07:00:00', '09:00:00', 1, 4, 1, 2),
(4, '09:00:00', '11:00:00', 1, 7, 8, 2),
(5, '07:00:00', '09:00:00', 1, 8, 9, 3),
(6, '09:00:00', '11:00:00', 1, 3, 3, 5),
(7, '07:00:00', '09:00:00', 1, 9, 4, 4),
(8, '09:00:00', '11:00:00', 1, 9, 5, 4),
(9, '11:00:00', '12:00:00', 1, 1, 11, 4),
(10, '07:00:00', '09:00:00', 1, 9, 4, 3),
(11, '09:00:00', '10:00:00', 1, 1, 2, 5),
(13, '10:00:00', '11:00:00', 1, 1, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `wali_kelas` varchar(255) DEFAULT NULL,
  `jumlah_siswa` varchar(255) DEFAULT NULL,
  `kode` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama`, `wali_kelas`, `jumlah_siswa`, `kode`) VALUES
(1, '11 rekayasa perangkat lunak 1', 'sarah siti sumaerah', '32', '11 rpl 1'),
(2, '11 rekayasa perangkat lunak 2', 'novi siswayanti', '32', '11 rpl 2');

-- --------------------------------------------------------

--
-- Table structure for table `kepala_sekolah`
--

CREATE TABLE `kepala_sekolah` (
  `id` int(11) NOT NULL,
  `foto` varchar(1000) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nip` int(11) NOT NULL,
  `jenis_kelamin` varchar(25) NOT NULL,
  `level` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kepala_sekolah`
--

INSERT INTO `kepala_sekolah` (`id`, `foto`, `nama`, `nip`, `jenis_kelamin`, `level`, `password`) VALUES
(1, '', 'Wawan Mawardi', 123456789, 'Laki=laki', 'kepala sekolah', '$2y$10$dDuIGyCkW9EWKLSpPL9AfuCuEmkD8tIHEv7HtgbcohKuG923TERPe');

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id` int(11) NOT NULL,
  `nis_siswa` int(11) NOT NULL,
  `nama_siswa` varchar(1000) NOT NULL,
  `kelas_siswa` varchar(500) NOT NULL,
  `waliKelas_siswa` varchar(1000) NOT NULL,
  `guruBK_siswa` varchar(1000) NOT NULL,
  `jenisKonsultasi` enum('karir','belajar','kasus') NOT NULL,
  `rangkumanKonsultasi` varchar(2000) NOT NULL,
  `penanganan` varchar(1000) NOT NULL,
  `status` enum('diproses','selesai') NOT NULL,
  `dokumentasi` varchar(1000) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konsultasi`
--

INSERT INTO `konsultasi` (`id`, `nis_siswa`, `nama_siswa`, `kelas_siswa`, `waliKelas_siswa`, `guruBK_siswa`, `jenisKonsultasi`, `rangkumanKonsultasi`, `penanganan`, `status`, `dokumentasi`, `tanggal`) VALUES
(9, 78673423, 'gin gin', '11 rpl 1', 'sarah siti s', 'mariam hidayat', 'karir', 'membuang samapah sembarangan', 'pemanggilan orang tua', 'diproses', '63e611847b524.jpg', '2023-02-10');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id`, `nama`, `kode`) VALUES
(1, 'Matematika', 'MTK'),
(2, 'Pemrograman Web', 'PW'),
(3, 'Object Oriented Programming', 'OOP'),
(4, 'Pemodelan Perangkat Lunak', 'PPL'),
(5, 'Basis Data', 'BD'),
(6, 'Pendidikan Agama dan Budi Pekerti', 'PABP'),
(7, 'Bahasa Indonesia', 'B. Indo'),
(8, 'Pendidikan Kewarganegaraan', 'PKn'),
(9, 'Bahasa Inggris', 'B. Inggris'),
(10, 'Pendidikan Kewirausahaan', 'PKWU');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `foto` varchar(1000) NOT NULL,
  `nis` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `no_absen` int(11) DEFAULT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `password` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `foto`, `nis`, `nama`, `id_kelas`, `no_absen`, `jenis_kelamin`, `level`, `password`) VALUES
(1, '63e48a9df23b8.jpg', 78673423, 'gin gin nurilham muhlis', 1, 6, 'laki-laki', 'siswa', '$2y$10$GdmgxdHR0QeCv8bNGgJrgOMpmGLbmi09TTxtSy0.I5ARoNBpsaMCC'),
(2, '', 12345678, 'm bintang al ghazali', 2, 20, 'laki-laki', 'siswa', '$2y$10$BQWeKvinfJVBIYTl5n1MrO/oCjoYFmOm8Uqev8QdXs0mLZHTF8EUK'),
(3, '', 212210003, 'arkha alesya', 1, 2, 'laki-laki', 'operator siswa', '$2y$10$VjR52kCIcQQVqGnProjBsuT1siCzDdYNEpTEYW4imwQ8tlIYecrKm'),
(4, '', 34564599, 'kiky', 2, 8, 'perempuan', 'operator siswa', '$2y$10$N/VFPHcnWmNSZ4sAOGUJ5ea8eh7n8MgRJpqnk5UxtChrTTc5.ATay');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `absensi_guru`
--
ALTER TABLE `absensi_guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cookie`
--
ALTER TABLE `cookie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hari`
--
ALTER TABLE `hari`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `id_hari` (`id_hari`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kepala_sekolah`
--
ALTER TABLE `kepala_sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `absensi_guru`
--
ALTER TABLE `absensi_guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cookie`
--
ALTER TABLE `cookie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hari`
--
ALTER TABLE `hari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kepala_sekolah`
--
ALTER TABLE `kepala_sekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id`),
  ADD CONSTRAINT `jadwal_ibfk_3` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id`),
  ADD CONSTRAINT `jadwal_ibfk_4` FOREIGN KEY (`id_hari`) REFERENCES `hari` (`id`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
