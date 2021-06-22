/*
 Navicat Premium Data Transfer

 Source Server         : mysql
 Source Server Type    : MySQL
 Source Server Version : 80012
 Source Host           : localhost:3306
 Source Schema         : activity

 Target Server Type    : MySQL
 Target Server Version : 80012
 File Encoding         : 65001

 Date: 04/06/2021 00:38:09
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ac_activity_time
-- ----------------------------
DROP TABLE IF EXISTS `ac_activity_time`;
CREATE TABLE `ac_activity_time`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_time` datetime(0) NOT NULL,
  `end_time` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ac_activity_time
-- ----------------------------
INSERT INTO `ac_activity_time` VALUES (1, '2021-06-02 19:32:28', '2021-06-06 19:32:37');

-- ----------------------------
-- Table structure for ac_reservation
-- ----------------------------
DROP TABLE IF EXISTS `ac_reservation`;
CREATE TABLE `ac_reservation`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `sign_time` datetime(0) NOT NULL COMMENT '预定选择的日期',
  `sign_over_time` datetime(0) NULL DEFAULT NULL COMMENT '签到日期',
  `status` tinyint(1) NOT NULL COMMENT '状态 1已预定  2以签到',
  `check_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '签到邀请码',
  `add_time` datetime(0) NOT NULL COMMENT '预定时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ac_reservation
-- ----------------------------
INSERT INTO `ac_reservation` VALUES (1, 2, '2021-06-03 00:00:00', '2021-06-03 15:21:57', 2, 'brhcsi', '2021-06-03 14:58:17');
INSERT INTO `ac_reservation` VALUES (2, 2, '2021-06-04 00:00:00', '2021-06-03 15:33:28', 2, 'iyykzz', '2021-06-03 14:59:07');
INSERT INTO `ac_reservation` VALUES (3, 2, '2021-06-04 00:00:00', '2021-06-04 00:18:07', 2, 'cvqzcl', '2021-06-04 00:17:55');
INSERT INTO `ac_reservation` VALUES (4, 3, '2021-06-04 00:00:00', NULL, 1, 'ezeacm', '2021-06-04 00:22:41');

-- ----------------------------
-- Table structure for ac_user
-- ----------------------------
DROP TABLE IF EXISTS `ac_user`;
CREATE TABLE `ac_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `add_time` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ac_user
-- ----------------------------
INSERT INTO `ac_user` VALUES (1, 'zhouzilei', '123123@qq.com', 'e10adc3949ba59abbe56e057f20f883e', '2021-06-02 22:48:34');
INSERT INTO `ac_user` VALUES (2, '123123', '123456@qq.com', '4297f44b13955235245b2497399d7a93', '2021-06-02 15:29:15');
INSERT INTO `ac_user` VALUES (3, 'zzzlll', 'zzzlll@qq.com', '2cda9557d019a5ccb278c88d0f18ce85', '2021-06-04 00:22:26');

SET FOREIGN_KEY_CHECKS = 1;
