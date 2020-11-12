/*
 Navicat Premium Data Transfer

 Source Server         : localWin
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : test

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 12/11/2020 15:23:56
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for excel_test
-- ----------------------------
DROP TABLE IF EXISTS `excel_test`;
CREATE TABLE `excel_test`  (
  `order` int(11) NULL DEFAULT NULL COMMENT '排序',
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL COMMENT '内容',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '姓名',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of excel_test
-- ----------------------------
INSERT INTO `excel_test` VALUES (3, 1, '我觉得不错1', '邓');
INSERT INTO `excel_test` VALUES (4, 2, '他说的对', '王');
INSERT INTO `excel_test` VALUES (5, 3, '他们都说的对', '李');

SET FOREIGN_KEY_CHECKS = 1;
