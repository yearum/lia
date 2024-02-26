-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2024 at 04:54 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kantin_im`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_member`
--

CREATE TABLE `data_member` (
  `id_member` int(11) NOT NULL,
  `nama_member` varchar(255) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kasir`
--

CREATE TABLE `kasir` (
  `id_penjualan` char(4) NOT NULL,
  `id_barang` char(4) NOT NULL,
  `jumlah` int(9) NOT NULL,
  `total` int(9) NOT NULL,
  `tgl_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kasir`
--

INSERT INTO `kasir` (`id_penjualan`, `id_barang`, `jumlah`, `total`, `tgl_input`) VALUES
('K001', 'B001', 2, 6000, '0000-00-00');

--
-- Triggers `kasir`
--
DELIMITER $$
CREATE TRIGGER `trg_before_insert_kasir` BEFORE INSERT ON `kasir` FOR EACH ROW BEGIN
  DECLARE max_id INT(3);
  SET max_id = (SELECT MAX(CAST(SUBSTRING(`id_penjualan`, 2) AS UNSIGNED)) FROM `kasir`);
  SET NEW.`id_penjualan` = CONCAT('K', LPAD(COALESCE(max_id + 1, 1), 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` char(4) NOT NULL,
  `nama_kategori` varchar(20) NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `tanggal_input`) VALUES
('K001', 'ATK', '2023-06-20'),
('K002', 'Snack', '2023-05-29'),
('K003', 'Makanan Berat', '2023-05-29'),
('K004', 'Minuman', '2023-05-29'),
('K005', 'sabun', '2024-02-13'),
('K006', 'keperluan pokok', '2024-02-20'),
('K007', 'sandang', '2024-02-22'),
('K008', 'bebas', '2024-02-26');

--
-- Triggers `kategori`
--
DELIMITER $$
CREATE TRIGGER `trg_before_insert_kategori` BEFORE INSERT ON `kategori` FOR EACH ROW BEGIN
  DECLARE max_id INT(3);
  SET max_id = (SELECT MAX(CAST(SUBSTRING(`id_kategori`, 2) AS UNSIGNED)) FROM `kategori`);
  SET NEW.`id_kategori` = CONCAT('K', LPAD(COALESCE(max_id + 1, 1), 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` int(11) NOT NULL,
  `id_nota` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `nama_kasir` varchar(100) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `tgl_input` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` int(3) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `user`, `pass`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `master_diskon`
--

CREATE TABLE `master_diskon` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `nama_diskon` varchar(100) DEFAULT NULL,
  `besar_diskon` decimal(10,2) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `produk_diskon` varchar(100) DEFAULT NULL,
  `target_diskon` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `nomor_handphone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nota`
--

CREATE TABLE `nota` (
  `id_nota` char(4) NOT NULL,
  `id_barang` char(4) NOT NULL,
  `jumlah` int(9) NOT NULL,
  `total` int(9) NOT NULL,
  `tgl_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nota`
--

INSERT INTO `nota` (`id_nota`, `id_barang`, `jumlah`, `total`, `tgl_input`) VALUES
('N001', 'B006', 2, 20000, '2023-06-20'),
('N002', 'B007', 1, 5000, '2023-06-20'),
('N003', 'B001', 2, 6000, '2023-06-20'),
('N004', 'B005', 2, 6000, '2023-07-06'),
('N005', 'B006', 1, 10000, '2023-07-10'),
('N006', 'B004', 1, 1000, '2023-07-14'),
('N007', 'B003', 1, 2000, '2023-07-14'),
('N008', 'B006', 9, 90000, '2024-02-01'),
('N009', 'B001', 2, 6000, '2024-02-13'),
('N010', 'B003', 4, 8000, '2024-02-13'),
('N011', 'B004', 5, 5000, '2024-02-13'),
('N012', 'B001', 5, 15000, '2024-02-20'),
('N013', 'B004', 6, 6000, '2024-02-20'),
('N014', 'B008', 1, 3000, '2024-02-20'),
('N015', 'B007', 13, 65000, '2024-02-20'),
('N016', 'B010', 3, 21000, '2024-02-20'),
('N017', 'B006', 2, 20000, '2024-02-20'),
('N018', 'B005', 1, 3000, '2024-02-20');

--
-- Triggers `nota`
--
DELIMITER $$
CREATE TRIGGER `trg_before_insert_nota` BEFORE INSERT ON `nota` FOR EACH ROW BEGIN
  DECLARE max_id INT(3);
  SET max_id = (SELECT MAX(CAST(SUBSTRING(`id_nota`, 2) AS UNSIGNED)) FROM `nota`);
  SET NEW.`id_nota` = CONCAT('N', LPAD(COALESCE(max_id + 1, 1), 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_barang` char(4) NOT NULL,
  `id_kategori` char(4) NOT NULL,
  `nama_barang` varchar(20) NOT NULL,
  `stok` int(4) NOT NULL,
  `harga_jual` varchar(9) NOT NULL,
  `harga_beli` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_barang`, `id_kategori`, `nama_barang`, `stok`, `harga_jual`, `harga_beli`) VALUES
('B001', 'K001', 'Pensil', 11, '3000', '1500'),
('B003', 'K002', 'Roti', 15, '2000', '1500'),
('B004', 'K002', 'Pilus', 9, '1000', '500'),
('B005', 'K003', 'Mie', 14, '3000', '5000'),
('B006', 'K003', 'Nasi Kuning', 1, '10000', '8000'),
('B007', 'K004', 'Air Putih', 6, '5000', '3000'),
('B008', 'K004', 'Kopi', 11, '3000', '1500'),
('B009', 'K005', 'deterjen', 10, '5000', '2500'),
('B010', 'K001', 'gula', 17, '7000', '14000'),
('B011', 'K006', 'beras', 50, '12000', '50000');

--
-- Triggers `produk`
--
DELIMITER $$
CREATE TRIGGER `trg_before_insert_produk` BEFORE INSERT ON `produk` FOR EACH ROW BEGIN
  DECLARE max_id INT(3);
  SET max_id = (SELECT MAX(CAST(SUBSTRING(`id_barang`, 2) AS UNSIGNED)) FROM `produk`);
  SET NEW.`id_barang` = CONCAT('B', LPAD(COALESCE(max_id + 1, 1), 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `stok_barang`
--

CREATE TABLE `stok_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nomor_telepon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_lengkap`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `password`, `email`, `nomor_telepon`) VALUES
(1, 'salah', 'Laki-laki', 'tulungagung', '2024-02-07', 'asza', '202cb962ac59075b964b07152d234b70', 'anisa@gmail.com', '123434'),
(2, 'dila', 'Perempuan', 'tulungagung', '2024-02-20', 'tulungagung', '202cb962ac59075b964b07152d234b70', 'marcus@gmail.com', '123434'),
(7, 'jayanto', 'Perempuan', 'tulungagung', '2012-06-12', 'jalan aja dulu', '79d886010186eb60e3611cd4a5d0bcae', 'jjanto@gmail.com', '09876543211234567'),
(8, 'joko', 'Laki-laki', 'kediri', '2020-10-21', 'jalan aja dulu', '115cb53deea1f407b6a4d3513fc492b0', 'agus@gmail.com', '0987656789876'),
(9, 'qqq', 'Laki-laki', 'kediri', '2024-02-21', 'sdfbn', 'f02a3108c3470d2450e35b28e572657f', 'marcus@gmail.com', '09876543211234567'),
(10, 'kkk', 'Laki-laki', 'kediri', '2024-02-21', 'ssss', 'adcaec3805aa912c0d0b14a81bedb6ff', 'dayanaramadhani452@gmail.com', '0987654322');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `data_member`
--
ALTER TABLE `data_member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `master_diskon`
--
ALTER TABLE `master_diskon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_handphone` (`nomor_handphone`);

--
-- Indexes for table `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id_nota`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `stok_barang`
--
ALTER TABLE `stok_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_member`
--
ALTER TABLE `data_member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_diskon`
--
ALTER TABLE `master_diskon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stok_barang`
--
ALTER TABLE `stok_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kasir`
--
ALTER TABLE `kasir`
  ADD CONSTRAINT `kasir_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `produk` (`id_barang`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `nota_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `produk` (`id_barang`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
