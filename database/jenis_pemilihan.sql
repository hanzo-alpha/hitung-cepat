/*
 Navicat Premium Data Transfer

 Source Server         : Laragon
 Source Server Type    : MariaDB
 Source Server Version : 101104 (10.11.4-MariaDB-log)
 Source Host           : localhost:3306
 Source Schema         : hitung_cepat

 Target Server Type    : MariaDB
 Target Server Version : 101104 (10.11.4-MariaDB-log)
 File Encoding         : 65001

 Date: 03/10/2023 01:37:04
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for jenis_pemilihan
-- ----------------------------
DROP TABLE IF EXISTS `jenis_pemilihan`;
CREATE TABLE `jenis_pemilihan`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_institusi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tingkat_pemilihan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `jumlah_dapil` int(10) UNSIGNED NULL DEFAULT 0,
  `jumlah_kursi` int(10) UNSIGNED NULL DEFAULT 0,
  `total_dapil` int(10) UNSIGNED NULL DEFAULT 0,
  `total_kursi` int(10) UNSIGNED NULL DEFAULT 0,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_pemilihan` tinyint(1) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jenis_pemilihan
-- ----------------------------
INSERT INTO `jenis_pemilihan` VALUES (1, 'DPR RI', 'Nasional', 84, 580, 0, 0, 'Dewan Perwakilan Rakyat Republik Indonesia (DPR RI)', '2023-10-01 05:55:48', '2023-10-01 05:55:48', 1);
INSERT INTO `jenis_pemilihan` VALUES (2, 'DPD', 'Nasional', 0, 0, 0, 0, 'Dewan Perwakilan Daerah (DPD)', '2023-10-01 05:56:10', '2023-10-01 05:56:10', 1);
INSERT INTO `jenis_pemilihan` VALUES (3, 'DPRD I', 'Provinsi', 301, 2372, 0, 0, 'Dewan Perwakilan Rakyat Daerah I (DPRD I)', '2023-10-01 05:56:54', '2023-10-01 05:56:54', 1);
INSERT INTO `jenis_pemilihan` VALUES (4, 'DPRD II', 'Kabupaten/Kota', 2325, 17510, 0, 0, 'Dewan Perwakilan Rakyat Daerah II (DPRD II)', '2023-10-01 05:57:29', '2023-10-01 05:57:29', 1);

SET FOREIGN_KEY_CHECKS = 1;
