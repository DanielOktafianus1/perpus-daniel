-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2024 at 10:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id` int(11) NOT NULL,
  `nisn` varchar(16) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `nisn`, `nama_lengkap`, `jenis_kelamin`, `no_telp`, `alamat`, `created_at`, `updated_at`) VALUES
(2, '12341', 'nanang sutekuy', 'Laki-Laki', '0834252454', 'jalan jalanan', '2024-08-12 02:03:32', '2024-08-12 09:03:32'),
(3, '123545', 'Adimas Sitompul', 'Laki-Laki', '0812345', 'Jalan Z No 6A RT013 RW008\r\nKel.Jatipulo Kec.Palmerah Jakarta Barat', '2024-08-16 01:09:12', '2024-08-16 08:11:14'),
(4, '5326735', 'konang smlehew', 'Laki-Laki', '085467834', 'Jalan Z No 6A RT013 RW008\r\nKel.Jatipulo Kec.Palmerah Jakarta Barat', '2024-08-16 01:12:09', '2024-08-16 08:12:09');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `tahun_terbit` varchar(5) NOT NULL,
  `penulis` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `id_kategori`, `judul`, `jumlah`, `penerbit`, `tahun_terbit`, `penulis`, `created_at`, `updated_at`) VALUES
(5, 39, 'Buku IPS kelas 7', 3, 'PT.Sinar Jaya', '2013', 'nanang', '2024-08-07 06:54:55', '2024-08-12 03:11:10'),
(7, 38, 'Buku IPA kelas 7', 4, 'PT.Sinar Jaya', '2013', 'nanang', '2024-08-07 06:56:56', '2024-08-07 06:56:56'),
(16, 40, 'Buku MTK SMK', 455, 'Daniel Campoes', '2043', 'Daniel Ajah', '2024-08-07 07:53:57', '2024-08-07 07:53:57'),
(18, 41, 'Tiket Masuk Surga Cuma 200k (cicilan 3 Tahun)', 9, 'uzumaki jarjit', '2024', 'Tukang Tulis Pinggir Jalan', '2024-08-13 07:26:34', '2024-08-13 07:26:34'),
(21, 42, 'Tutorial Meninju Angin', 4, 'uzumaki jarjit', '2024', 'Tukang Tulis Pinggir Jalan', '2024-08-13 07:33:09', '2024-08-13 07:33:09'),
(22, 43, 'Tutorial Membuat Tutorial', 4, 'adimas siregar butar-butar', '2024', 'Fajar SAD BOY', '2024-08-13 07:39:19', '2024-08-13 07:39:19'),
(23, 42, 'Tutorial Membuka Youtube', 4, 'adimas siregar butar-butar', '2024', 'Fajar SAD BOY', '2024-08-16 01:36:04', '2024-08-16 01:36:04'),
(24, 40, 'cara menjadi tuyul', 3, 'adimas siregar butar-butar', '1999', 'DanMasJos', '2024-08-16 02:33:54', '2024-08-16 02:33:54'),
(25, 40, 'cara menjadi tuyul', 3, 'adimas siregar butar-butar', '1999', 'DanMasJos', '2024-08-16 02:38:18', '2024-08-16 02:38:18'),
(26, 45, 'menjadi ANAK JALANAN yang Takut ORTU', 4, 'fajar study troy', '1990', 'Adimas Asyemene Digidaw', '2024-08-16 03:17:06', '2024-08-16 03:17:06');

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id` int(11) NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_kategori` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_peminjaman`
--

INSERT INTO `detail_peminjaman` (`id`, `id_peminjaman`, `id_buku`, `id_kategori`) VALUES
(3, 7, 17, 41),
(4, 8, 5, 39),
(5, 8, 5, 39),
(6, 9, 16, 40),
(7, 9, 16, 40),
(8, 9, 16, 40),
(9, 10, 17, 41),
(10, 11, 5, 39),
(11, 18, 21, 42),
(12, 18, 21, 42),
(13, 19, 21, 42),
(14, 19, 17, 41),
(15, 20, 22, 43),
(16, 20, 21, 42),
(17, 22, 22, 43),
(18, 22, 18, 41),
(19, 22, 21, 42),
(20, 27, 26, 45),
(21, 27, 26, 44),
(22, 31, 26, 45),
(23, 31, 26, 45),
(24, 32, 26, 45),
(25, 33, 18, 41),
(26, 33, 18, 41),
(27, 34, 22, 43);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `keterangan`, `created_at`, `updated_at`) VALUES
(38, 'buku IPA', 'buku ini buku IPA', '2024-08-07 06:52:28', '2024-08-07 06:53:25'),
(39, 'buku IPS', 'Ini buku IPS', '2024-08-07 06:53:16', '2024-08-07 06:53:16'),
(40, 'buku Matematika', 'buku ini buku Matematika', '2024-08-07 07:09:59', '2024-08-07 07:09:59'),
(41, 'Buku Tutorial ', 'Cara Bernafas Didalam Bumi ', '2024-08-12 04:42:21', '2024-08-13 07:36:45'),
(42, 'Buku Tutorial ', 'APAKAH DUNIA ITU MEMILIKI BUNTUT', '2024-08-13 07:31:59', '2024-08-13 07:31:59'),
(43, 'ARAHAN', 'TOMBO ATI', '2024-08-13 07:37:43', '2024-08-13 07:37:43'),
(44, 'Fiksi Perang', 'bertema tentang perperangan fiksi', '2024-08-16 03:11:05', '2024-08-16 03:11:05'),
(45, 'PUNK', 'Pentang Anak Jalanan', '2024-08-16 03:11:38', '2024-08-16 03:11:38');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `nama_level` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `nama_level`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Hard', 'Sangat sulit', '2024-07-31 07:52:43', '2024-08-13 02:28:09'),
(3, 'easy', 'sanggat mudah kawan', '2024-07-31 07:56:39', '2024-08-13 02:27:24'),
(5, 's', 'f', '2024-07-31 07:56:56', '2024-07-31 07:56:56');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode_transaksi` varchar(30) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_at` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `id_anggota`, `id_user`, `kode_transaksi`, `tgl_pinjam`, `tgl_kembali`, `status`, `created_at`, `updated_at`, `delete_at`) VALUES
(7, 2, 33, 'PJ12082024001', '2024-08-12', '2024-08-19', 1, '2024-08-12 07:04:51', '2024-08-16 07:56:32', 1),
(8, 2, 33, 'PJ12082024008', '2024-08-08', '2024-08-29', 1, '2024-08-12 07:33:10', '2024-08-16 07:44:08', 1),
(9, 2, 33, 'PJ12082024009', '2024-08-08', '2024-08-12', 1, '2024-08-12 07:51:01', '2024-08-16 07:56:36', 1),
(10, 2, 33, 'PJ12082024010', '2024-08-20', '2024-08-28', 1, '2024-08-12 07:52:19', '2024-08-16 07:56:40', 1),
(18, 2, 33, 'PJ13082024013', '2024-08-13', '2024-08-31', 1, '2024-08-13 07:33:55', '2024-08-16 07:56:43', 1),
(19, 2, 33, 'PJ13082024019', '2024-08-13', '2024-08-17', 2, '2024-08-13 07:34:32', '2024-08-16 08:17:43', 1),
(20, 2, 33, 'PJ13082024020', '2024-08-13', '2024-08-14', 2, '2024-08-13 07:40:06', '2024-08-16 08:30:28', 1),
(22, 2, 34, 'PJ16082024022', '2024-08-16', '2024-08-23', 1, '2024-08-16 01:14:20', '2024-08-16 07:56:52', 0),
(26, 0, 34, '', '0000-00-00', '0000-00-00', 1, '2024-08-16 03:08:57', '2024-08-16 07:56:55', 1),
(27, 4, 34, 'PJ16082024027', '2024-08-16', '2024-08-23', 2, '2024-08-16 03:18:08', '2024-08-16 08:17:24', 0),
(28, 0, 34, '', '0000-00-00', '2024-08-02', 1, '2024-08-16 04:26:20', '2024-08-16 07:57:01', 1),
(29, 0, 34, '', '0000-00-00', '2024-08-02', 1, '2024-08-16 04:47:51', '2024-08-16 07:57:06', 1),
(30, 0, 34, '', '0000-00-00', '2024-08-02', 1, '2024-08-16 04:48:11', '2024-08-16 07:57:14', 1),
(31, 0, 34, 'PJ16082024031', '2024-08-03', '2024-08-16', 1, '2024-08-16 08:25:32', '2024-08-16 08:25:42', 1),
(32, 2, 34, 'PJ16082024032', '2024-08-16', '2024-08-23', 2, '2024-08-16 08:26:00', '2024-08-16 08:26:15', 0),
(33, 3, 34, 'PJ16082024033', '2024-08-16', '2024-08-23', 2, '2024-08-16 08:36:30', '2024-08-16 08:36:43', 0),
(34, 3, 34, 'PJ16082024034', '2024-08-20', '2024-08-22', 2, '2024-08-16 08:45:05', '2024-08-16 08:45:41', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id` int(11) NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `kode_pengembalian` varchar(30) NOT NULL,
  `denda` int(11) NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `terlambat` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id`, `id_peminjaman`, `kode_pengembalian`, `denda`, `tgl_pengembalian`, `terlambat`, `created_at`, `updated_at`) VALUES
(27, 27, '', 70000, '2024-08-23', 7, '2024-08-16 07:43:02', '2024-08-16 14:43:02'),
(28, 7, '', 30000, '2024-08-19', 3, '2024-08-16 07:56:10', '2024-08-16 14:56:10'),
(29, 27, '', 70000, '2024-08-23', 7, '2024-08-16 08:17:24', '2024-08-16 15:17:24'),
(30, 19, '', 10000, '2024-08-17', 1, '2024-08-16 08:17:43', '2024-08-16 15:17:43'),
(31, 32, '', 70000, '2024-08-23', 7, '2024-08-16 08:26:15', '2024-08-16 15:26:15'),
(32, 20, '', 0, '2024-08-14', 0, '2024-08-16 08:30:28', '2024-08-16 15:30:28'),
(33, 33, '', 70000, '2024-08-23', 7, '2024-08-16 08:36:43', '2024-08-16 15:36:43'),
(34, 34, '', 60000, '2024-08-22', 6, '2024-08-16 08:45:41', '2024-08-16 15:45:41');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama_lengkap`, `email`, `password`, `created_at`, `updated_at`) VALUES
(31, 'ucup stuerd', 'ucup123@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '2024-07-31 04:50:08', '2024-07-31 04:50:08'),
(34, 'daniel oktafianus', 'danieloktafianus@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2024-08-07 01:05:50', '2024-08-07 01:05:50'),
(37, '', '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '2024-08-07 04:30:50', '2024-08-07 04:30:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
