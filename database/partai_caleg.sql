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

 Date: 03/10/2023 01:36:50
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for partai_caleg
-- ----------------------------
DROP TABLE IF EXISTS `partai_caleg`;
CREATE TABLE `partai_caleg`  (
  `partai_id` bigint(20) UNSIGNED NOT NULL,
  `caleg_id` bigint(20) UNSIGNED NOT NULL,
  INDEX `partai_caleg_partai_id_foreign`(`partai_id`) USING BTREE,
  INDEX `partai_caleg_caleg_id_foreign`(`caleg_id`) USING BTREE,
  CONSTRAINT `partai_caleg_caleg_id_foreign` FOREIGN KEY (`caleg_id`) REFERENCES `caleg` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `partai_caleg_partai_id_foreign` FOREIGN KEY (`partai_id`) REFERENCES `partai` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of partai_caleg
-- ----------------------------
INSERT INTO `partai_caleg` VALUES (22, 1);
INSERT INTO `partai_caleg` VALUES (14, 2);
INSERT INTO `partai_caleg` VALUES (15, 3);
INSERT INTO `partai_caleg` VALUES (7, 4);
INSERT INTO `partai_caleg` VALUES (9, 5);
INSERT INTO `partai_caleg` VALUES (17, 6);

SET FOREIGN_KEY_CHECKS = 1;
