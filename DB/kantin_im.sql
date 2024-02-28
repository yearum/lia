/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100428 (10.4.28-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : kantin_im

 Target Server Type    : MySQL
 Target Server Version : 100428 (10.4.28-MariaDB)
 File Encoding         : 65001

 Date: 28/02/2024 19:23:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for barang
-- ----------------------------
DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang`  (
  `id_barang` int NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `harga` decimal(10, 2) NOT NULL,
  `stok` int NOT NULL,
  PRIMARY KEY (`id_barang`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of barang
-- ----------------------------

-- ----------------------------
-- Table structure for data_member
-- ----------------------------
DROP TABLE IF EXISTS `data_member`;
CREATE TABLE `data_member`  (
  `id_member` int NOT NULL AUTO_INCREMENT,
  `nama_member` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `telepon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_member`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_member
-- ----------------------------
INSERT INTO `data_member` VALUES (1, 'doni', 'pakisrejo', 'doni.smpn1@gmail.com', '0987654321');
INSERT INTO `data_member` VALUES (2, 'lia', 'botoran', 'lia@gmail.com', '23456789');

-- ----------------------------
-- Table structure for kasir
-- ----------------------------
DROP TABLE IF EXISTS `kasir`;
CREATE TABLE `kasir`  (
  `id_penjualan` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_barang` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah` int NOT NULL,
  `total` int NOT NULL,
  `tgl_input` date NOT NULL,
  PRIMARY KEY (`id_penjualan`) USING BTREE,
  INDEX `id_barang`(`id_barang` ASC) USING BTREE,
  CONSTRAINT `kasir_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `produk` (`id_barang`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kasir
-- ----------------------------

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori`  (
  `id_kategori` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_kategori` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_input` date NOT NULL,
  PRIMARY KEY (`id_kategori`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kategori
-- ----------------------------
INSERT INTO `kategori` VALUES ('K001', 'ATK', '2023-06-20');
INSERT INTO `kategori` VALUES ('K002', 'Snack', '2023-05-29');
INSERT INTO `kategori` VALUES ('K003', 'Makanan Berat', '2023-05-29');
INSERT INTO `kategori` VALUES ('K004', 'Minuman', '2023-05-29');
INSERT INTO `kategori` VALUES ('K005', 'sabun', '2024-02-13');
INSERT INTO `kategori` VALUES ('K006', 'keperluan pokok', '2024-02-20');
INSERT INTO `kategori` VALUES ('K007', 'sandang', '2024-02-22');
INSERT INTO `kategori` VALUES ('K008', 'bebas', '2024-02-26');

-- ----------------------------
-- Table structure for laporan
-- ----------------------------
DROP TABLE IF EXISTS `laporan`;
CREATE TABLE `laporan`  (
  `id_laporan` int NOT NULL AUTO_INCREMENT,
  `id_nota` int NULL DEFAULT NULL,
  `id_barang` int NULL DEFAULT NULL,
  `nama_kasir` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `total` decimal(10, 2) NULL DEFAULT NULL,
  `tgl_input` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_laporan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of laporan
-- ----------------------------

-- ----------------------------
-- Table structure for login
-- ----------------------------
DROP TABLE IF EXISTS `login`;
CREATE TABLE `login`  (
  `id_login` int NOT NULL AUTO_INCREMENT,
  `user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pass` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kelamin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tempat_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nomor_telepon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_login`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of login
-- ----------------------------
INSERT INTO `login` VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `login` VALUES (4, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `login` VALUES (5, 'doni', '857c058d9cee7f5798d51876963b5ce9', 'Laki-laki', 'wasdwasd', '2024-02-27', 'wasd', 'doni.smpn1@gmail.com', 'wasd');
INSERT INTO `login` VALUES (6, 'test', '857c058d9cee7f5798d51876963b5ce9', 'Laki-laki', 'wasdwasd', '2024-02-21', 'wasd', 'doni.smpn1@gmail.com', 'wasdw');

-- ----------------------------
-- Table structure for master_diskon
-- ----------------------------
DROP TABLE IF EXISTS `master_diskon`;
CREATE TABLE `master_diskon`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_diskon` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `besar_diskon` decimal(10, 2) NULL DEFAULT NULL,
  `tgl_mulai` date NULL DEFAULT NULL,
  `tgl_akhir` date NULL DEFAULT NULL,
  `produk_diskon` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `target_diskon` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of master_diskon
-- ----------------------------
INSERT INTO `master_diskon` VALUES (1, '0', 'DIskon 50%', 1500.00, '2024-02-28', '2024-02-29', 'Pensil', 'SEMUA ORANG');
INSERT INTO `master_diskon` VALUES (4, 'B003', 'DIskon 50%', 1000.00, '2024-02-28', '2024-02-29', 'Roti', 'SEMUA ORANG');
INSERT INTO `master_diskon` VALUES (5, 'B001', 'DIskon 50%', 1500.00, '2024-02-28', '2024-02-29', 'Pensil', 'SEMUA ORANG');

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nomor_handphone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `nomor_handphone`(`nomor_handphone` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of member
-- ----------------------------

-- ----------------------------
-- Table structure for nota
-- ----------------------------
DROP TABLE IF EXISTS `nota`;
CREATE TABLE `nota`  (
  `id_nota` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_barang` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah` int NOT NULL,
  `total` int NOT NULL,
  `tgl_input` date NOT NULL,
  PRIMARY KEY (`id_nota`) USING BTREE,
  INDEX `id_barang`(`id_barang` ASC) USING BTREE,
  CONSTRAINT `nota_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `produk` (`id_barang`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of nota
-- ----------------------------
INSERT INTO `nota` VALUES ('N001', 'B006', 2, 20000, '2023-06-20');
INSERT INTO `nota` VALUES ('N002', 'B007', 1, 5000, '2023-06-20');
INSERT INTO `nota` VALUES ('N003', 'B001', 2, 6000, '2023-06-20');
INSERT INTO `nota` VALUES ('N004', 'B005', 2, 6000, '2023-07-06');
INSERT INTO `nota` VALUES ('N005', 'B006', 1, 10000, '2023-07-10');
INSERT INTO `nota` VALUES ('N006', 'B004', 1, 1000, '2023-07-14');
INSERT INTO `nota` VALUES ('N007', 'B003', 1, 2000, '2023-07-14');
INSERT INTO `nota` VALUES ('N008', 'B006', 9, 90000, '2024-02-01');
INSERT INTO `nota` VALUES ('N009', 'B001', 2, 6000, '2024-02-13');
INSERT INTO `nota` VALUES ('N010', 'B003', 4, 8000, '2024-02-13');
INSERT INTO `nota` VALUES ('N011', 'B004', 5, 5000, '2024-02-13');
INSERT INTO `nota` VALUES ('N012', 'B001', 5, 15000, '2024-02-20');
INSERT INTO `nota` VALUES ('N013', 'B004', 6, 6000, '2024-02-20');
INSERT INTO `nota` VALUES ('N014', 'B008', 1, 3000, '2024-02-20');
INSERT INTO `nota` VALUES ('N015', 'B007', 13, 65000, '2024-02-20');
INSERT INTO `nota` VALUES ('N016', 'B010', 3, 21000, '2024-02-20');
INSERT INTO `nota` VALUES ('N017', 'B006', 2, 20000, '2024-02-20');
INSERT INTO `nota` VALUES ('N018', 'B005', 1, 3000, '2024-02-20');
INSERT INTO `nota` VALUES ('N019', 'B001', 2, 6000, '2024-02-27');
INSERT INTO `nota` VALUES ('N020', 'B006', 1, 3000, '2024-02-27');
INSERT INTO `nota` VALUES ('N021', 'B001', 1, 3000, '2024-02-27');
INSERT INTO `nota` VALUES ('N022', 'B007', 2, 6000, '0000-00-00');
INSERT INTO `nota` VALUES ('N023', 'B011', 1, 3000, '0000-00-00');
INSERT INTO `nota` VALUES ('N024', 'B006', 1, 10000, '2024-02-27');
INSERT INTO `nota` VALUES ('N025', 'B003', 2, 2000, '2024-02-28');
INSERT INTO `nota` VALUES ('N026', 'B003', 5, 5000, '2024-02-28');
INSERT INTO `nota` VALUES ('N027', 'B003', 6, 6000, '2024-02-28');
INSERT INTO `nota` VALUES ('N028', 'B003', 5, 5000, '2024-02-28');

-- ----------------------------
-- Table structure for produk
-- ----------------------------
DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk`  (
  `id_barang` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_kategori` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_barang` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `stok` int NOT NULL,
  `harga_jual` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `harga_beli` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_diskon` int NOT NULL,
  PRIMARY KEY (`id_barang`) USING BTREE,
  INDEX `id_kategori`(`id_kategori` ASC) USING BTREE,
  CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of produk
-- ----------------------------
INSERT INTO `produk` VALUES ('B001', 'K001', 'Pensil', 7, '3000', '1500', 1);
INSERT INTO `produk` VALUES ('B003', 'K002', 'Roti', -7, '2000', '1500', 1);
INSERT INTO `produk` VALUES ('B004', 'K002', 'Pilus', 5, '1000', '500', 0);
INSERT INTO `produk` VALUES ('B005', 'K003', 'Mie', 0, '3000', '5000', 0);
INSERT INTO `produk` VALUES ('B006', 'K003', 'Nasi Kuning', -4, '10000', '8000', 0);
INSERT INTO `produk` VALUES ('B007', 'K004', 'Air Putih', 0, '5000', '3000', 0);
INSERT INTO `produk` VALUES ('B008', 'K004', 'Kopi', 7, '3000', '1500', 0);
INSERT INTO `produk` VALUES ('B009', 'K005', 'deterjen', 6, '5000', '2500', 0);
INSERT INTO `produk` VALUES ('B010', 'K001', 'gula', 13, '7000', '14000', 0);
INSERT INTO `produk` VALUES ('B011', 'K006', 'beras', 45, '12000', '50000', 0);

-- ----------------------------
-- Table structure for stok_barang
-- ----------------------------
DROP TABLE IF EXISTS `stok_barang`;
CREATE TABLE `stok_barang`  (
  `id_barang` int NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `stok` int NOT NULL,
  PRIMARY KEY (`id_barang`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of stok_barang
-- ----------------------------
INSERT INTO `stok_barang` VALUES (1, 'Pensil', 6);
INSERT INTO `stok_barang` VALUES (2, 'Roti', 10);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tempat_lahir` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_lahir` date NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nomor_telepon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'salah', 'Laki-laki', 'tulungagung', '2024-02-07', 'asza', '202cb962ac59075b964b07152d234b70', 'anisa@gmail.com', '123434');
INSERT INTO `users` VALUES (2, 'dila', 'Perempuan', 'tulungagung', '2024-02-20', 'tulungagung', '202cb962ac59075b964b07152d234b70', 'marcus@gmail.com', '123434');
INSERT INTO `users` VALUES (7, 'jayanto', 'Perempuan', 'tulungagung', '2012-06-12', 'jalan aja dulu', '79d886010186eb60e3611cd4a5d0bcae', 'jjanto@gmail.com', '09876543211234567');
INSERT INTO `users` VALUES (8, 'joko', 'Laki-laki', 'kediri', '2020-10-21', 'jalan aja dulu', '115cb53deea1f407b6a4d3513fc492b0', 'agus@gmail.com', '0987656789876');
INSERT INTO `users` VALUES (9, 'qqq', 'Laki-laki', 'kediri', '2024-02-21', 'sdfbn', 'f02a3108c3470d2450e35b28e572657f', 'marcus@gmail.com', '09876543211234567');
INSERT INTO `users` VALUES (10, 'kkk', 'Laki-laki', 'kediri', '2024-02-21', 'ssss', 'adcaec3805aa912c0d0b14a81bedb6ff', 'dayanaramadhani452@gmail.com', '0987654322');
INSERT INTO `users` VALUES (11, 'wasdwasd', 'Laki-laki', 'wasdwasd', '2024-02-27', 'wasdwasd', '857c058d9cee7f5798d51876963b5ce9', 'doni.smpn1@gmail.com', '12345');

-- ----------------------------
-- Triggers structure for table kasir
-- ----------------------------
DROP TRIGGER IF EXISTS `trg_before_insert_kasir`;
delimiter ;;
CREATE TRIGGER `trg_before_insert_kasir` BEFORE INSERT ON `kasir` FOR EACH ROW BEGIN
  DECLARE max_id INT(3);
  SET max_id = (SELECT MAX(CAST(SUBSTRING(`id_penjualan`, 2) AS UNSIGNED)) FROM `kasir`);
  SET NEW.`id_penjualan` = CONCAT('K', LPAD(COALESCE(max_id + 1, 1), 3, '0'));
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table kategori
-- ----------------------------
DROP TRIGGER IF EXISTS `trg_before_insert_kategori`;
delimiter ;;
CREATE TRIGGER `trg_before_insert_kategori` BEFORE INSERT ON `kategori` FOR EACH ROW BEGIN
  DECLARE max_id INT(3);
  SET max_id = (SELECT MAX(CAST(SUBSTRING(`id_kategori`, 2) AS UNSIGNED)) FROM `kategori`);
  SET NEW.`id_kategori` = CONCAT('K', LPAD(COALESCE(max_id + 1, 1), 3, '0'));
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table nota
-- ----------------------------
DROP TRIGGER IF EXISTS `trg_before_insert_nota`;
delimiter ;;
CREATE TRIGGER `trg_before_insert_nota` BEFORE INSERT ON `nota` FOR EACH ROW BEGIN
  DECLARE max_id INT(3);
  SET max_id = (SELECT MAX(CAST(SUBSTRING(`id_nota`, 2) AS UNSIGNED)) FROM `nota`);
  SET NEW.`id_nota` = CONCAT('N', LPAD(COALESCE(max_id + 1, 1), 3, '0'));
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table produk
-- ----------------------------
DROP TRIGGER IF EXISTS `trg_before_insert_produk`;
delimiter ;;
CREATE TRIGGER `trg_before_insert_produk` BEFORE INSERT ON `produk` FOR EACH ROW BEGIN
  DECLARE max_id INT(3);
  SET max_id = (SELECT MAX(CAST(SUBSTRING(`id_barang`, 2) AS UNSIGNED)) FROM `produk`);
  SET NEW.`id_barang` = CONCAT('B', LPAD(COALESCE(max_id + 1, 1), 3, '0'));
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
