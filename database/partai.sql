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

 Date: 03/10/2023 01:36:33
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for partai
-- ----------------------------
DROP TABLE IF EXISTS `partai`;
CREATE TABLE `partai`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `no_urut` tinyint(3) UNSIGNED NULL DEFAULT 0,
  `nama_partai` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `warna` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of partai
-- ----------------------------
INSERT INTO `partai` VALUES (1, 1, 'Partai Demokrasi Indonesia Perjuangan', 'PDI-P', '#f21f3f', NULL);
INSERT INTO `partai` VALUES (2, 2, 'Partai Keadilan Sejahtera', 'PKS', '#c42c2c', NULL);
INSERT INTO `partai` VALUES (3, 3, 'Partai Persatuan Indonesia', 'PERINDO', '#40adc9', NULL);
INSERT INTO `partai` VALUES (4, 4, 'Partai Nasional Demokrat', 'NASDEM', '#a63a9e', NULL);
INSERT INTO `partai` VALUES (5, 5, 'Partai Bulan Bintang', 'PBB', '#41ba36', NULL);
INSERT INTO `partai` VALUES (6, 6, 'Partai Kebangkitan Nusantara', 'PKN', '#5e612c', NULL);
INSERT INTO `partai` VALUES (7, 7, 'Partai Garda Perubahan Indonesia', 'GARDA', '#4abccc', NULL);
INSERT INTO `partai` VALUES (8, 8, 'Partai Demokrat', 'DEMOKRAT', '#1e53d9', NULL);
INSERT INTO `partai` VALUES (9, 9, 'Partai Gelombang Rakyat Indonesia', 'GELORA', '#000000', NULL);
INSERT INTO `partai` VALUES (10, 10, 'Partai Hati Nurani Rakyat', 'HANURA', '#3eaebd', NULL);
INSERT INTO `partai` VALUES (11, 11, 'Partai Gerakan Indonesia Raya', 'GERINDRA', '#4b3fd4', NULL);
INSERT INTO `partai` VALUES (12, 12, 'Partai Kebangkitan Bangsa', 'PKB', '#8eeb89', NULL);
INSERT INTO `partai` VALUES (13, 13, 'Partai Solidaritas Indonesia', 'PSI', '#e80e0e', NULL);
INSERT INTO `partai` VALUES (14, 14, 'Partai Amanat Nasional', 'PAN', '#468af0', NULL);
INSERT INTO `partai` VALUES (15, 15, 'Partai Golongan Karya', 'GOLKAR', '#e4ed33', NULL);
INSERT INTO `partai` VALUES (16, 16, 'Partai Persatuan Pembangunan', 'PPP', '#cfa64b', NULL);
INSERT INTO `partai` VALUES (17, 17, 'Partai Buruh', 'PB', '#9ed641', NULL);
INSERT INTO `partai` VALUES (18, 18, 'Partai Sejahtera', 'PSH', '#e83ca3', NULL);
INSERT INTO `partai` VALUES (19, 19, 'Partai Nangroe Aceh', 'PNA', '#886ce6', NULL);
INSERT INTO `partai` VALUES (20, 20, 'Partai Generasi Aceh Beusaboh Thaat dan Taqwa', 'GABTHAT', '#c42685', NULL);
INSERT INTO `partai` VALUES (21, 21, 'Partai Darul Aceh', 'PDA', '#c2612b', NULL);
INSERT INTO `partai` VALUES (22, 22, 'Partai Aceh', 'PA', '#8fe34d', NULL);
INSERT INTO `partai` VALUES (23, 23, 'Partai Adil Sejahtera Aceh', 'PAS ACEH', '#4ad4a6', NULL);
INSERT INTO `partai` VALUES (24, 24, 'Partai Soliditas Independen Rakyat Aceh', 'SIRA', '#229c27', NULL);
INSERT INTO `partai` VALUES (25, 0, 'TIDAK ADA PARTAI', 'TDP', '#de2c97', NULL);

SET FOREIGN_KEY_CHECKS = 1;
