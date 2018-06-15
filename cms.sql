/*
Navicat MySQL Data Transfer

Source Server         : 103.251.36.122
Source Server Version : 50720
Source Host           : 103.251.36.122:51618
Source Database       : cms

Target Server Type    : MYSQL
Target Server Version : 50720
File Encoding         : 65001

Date: 2018-06-11 13:39:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for dz_admins
-- ----------------------------
DROP TABLE IF EXISTS `dz_admins`;
CREATE TABLE `dz_admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '登录用户名',
  `password` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '登录密码',
  `last_login_ip` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '最后一次登录IP',
  `token` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'token',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员表';

-- ----------------------------
-- Records of dz_admins
-- ----------------------------
INSERT INTO `dz_admins` VALUES ('1', 'VRONE', '4e26dd1183429c181ecf4e8a4d0ff059', '183.15.241.47', 'e76e87654c8fac9ec862ab6c29c3637b', '2018-05-19 17:44:42', '2018-05-21 11:58:15');
INSERT INTO `dz_admins` VALUES ('2', 'VRONE1', 'b29adf8204aa502f02db991ebe521ea1', null, 'hello world', null, null);
INSERT INTO `dz_admins` VALUES ('3', 'VRONE2', '05b28be5593fb5d589f93b3e8065a912', null, 'good bye', null, null);
INSERT INTO `dz_admins` VALUES ('4', 'VRONE3', '9e4ed03ea7fe93d210bcee3214d5de6a', null, 'see you', null, null);
INSERT INTO `dz_admins` VALUES ('5', 'VRONE4', '23e7e1974dc5654df7b8e134b1b499db', null, 'me too', null, null);
INSERT INTO `dz_admins` VALUES ('6', 'VRONE5', '89911b533816139bfd92d6473f64a6ab', null, 'hey gay', null, null);

-- ----------------------------
-- Table structure for dz_dynamics
-- ----------------------------
DROP TABLE IF EXISTS `dz_dynamics`;
CREATE TABLE `dz_dynamics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '链接',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '图片',
  `time` date NOT NULL COMMENT '发布时间',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='动态信息表';

-- ----------------------------
-- Records of dz_dynamics
-- ----------------------------

-- ----------------------------
-- Table structure for dz_news
-- ----------------------------
DROP TABLE IF EXISTS `dz_news`;
CREATE TABLE `dz_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '图片地址',
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '内容',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '超链接',
  `time` date NOT NULL COMMENT '发布时间',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='动态与公告表';

-- ----------------------------
-- Records of dz_news
-- ----------------------------
INSERT INTO `dz_news` VALUES ('19', '标题1', 'uploads/2018/05/1b68ab4ce8c915ea3916a4e7ec6f79b5.jpeg', '的飞洒的放松放松冯绍峰的飞洒的放松放松冯绍峰的飞洒的放松放松冯绍峰的飞洒的放松放松冯绍峰的飞洒的放松放松冯绍峰的飞洒的放松放松冯绍峰', 'http://127.0.0.1:8020/dz_official/web/manage/index.html', '2018-05-21', '2018-05-21 12:11:27', '2018-05-21 12:11:27');
INSERT INTO `dz_news` VALUES ('21', '标题2', 'uploads/2018/05/4642713550a98a536c9364834b249846.jpeg', '撒地方撒地方撒地方撒地方撒地方撒地方撒地方撒地方撒地方撒地方撒地方撒地方撒地方撒地方撒地方撒地方撒地方撒地方撒地方撒地方撒地方撒地方撒地方撒地方', 'http://127.0.0.1:8020/dz_official/web/manage/index.html', '2018-05-17', '2018-05-21 12:12:42', '2018-05-21 12:12:42');
INSERT INTO `dz_news` VALUES ('22', '撒地方', 'uploads/2018/05/be01aaaa76c2e4e8dfe2c8efda131837.jpeg', '大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰', 'http://127.0.0.1:8020/dz_official/web/manage/index.html', '2018-05-16', '2018-05-21 12:13:11', '2018-05-21 12:13:11');
INSERT INTO `dz_news` VALUES ('23', '撒地方', 'uploads/2018/05/e2900d4b719d5294319dfc35b98edd65.jpeg', '大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰', 'http://127.0.0.1:8020/dz_official/web/manage/index.html', '2018-05-16', '2018-05-21 12:13:11', '2018-05-21 12:13:11');
INSERT INTO `dz_news` VALUES ('24', '撒地方', 'uploads/2018/05/8a649440d07ee81455090a2bcfc8de86.jpeg', '大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰', 'http://127.0.0.1:8020/dz_official/web/manage/index.html', '2018-05-16', '2018-05-21 12:13:12', '2018-05-21 12:13:12');
INSERT INTO `dz_news` VALUES ('25', '撒地方', 'uploads/2018/05/8c0d39a2f5f1f2518d8014eb2e0e9fb2.jpeg', '大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰', 'http://127.0.0.1:8020/dz_official/web/manage/index.html', '2018-05-16', '2018-05-21 12:13:12', '2018-05-21 12:13:12');
INSERT INTO `dz_news` VALUES ('26', '撒地方', 'uploads/2018/05/f00ef4b79f54cd84931d6f1460fb4bee.jpeg', '大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰', 'http://127.0.0.1:8020/dz_official/web/manage/index.html', '2018-05-16', '2018-05-21 12:13:13', '2018-05-21 12:13:13');
INSERT INTO `dz_news` VALUES ('27', '撒地方', 'uploads/2018/05/204318731683f32dfc8ef7b094d1babf.jpeg', '大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰', 'http://127.0.0.1:8020/dz_official/web/manage/index.html', '2018-05-16', '2018-05-21 12:13:13', '2018-05-21 12:13:13');
INSERT INTO `dz_news` VALUES ('28', '撒地方', 'uploads/2018/05/12c7267f1eb01c81be10d91b6f025aa3.jpeg', '大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰大师法是的风格的撒发生的冯绍峰', 'http://127.0.0.1:8020/dz_official/web/manage/index.html', '2018-05-16', '2018-05-21 12:13:14', '2018-05-21 12:13:14');

-- ----------------------------
-- Table structure for dz_teches
-- ----------------------------
DROP TABLE IF EXISTS `dz_teches`;
CREATE TABLE `dz_teches` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '链接',
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '内容',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '图片',
  `type` tinyint(1) NOT NULL COMMENT '类型 0表示技术1表示产品',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='技术与产品表';

-- ----------------------------
-- Records of dz_teches
-- ----------------------------
INSERT INTO `dz_teches` VALUES ('21', '技术1', 'http://127.0.0.1:8020/dz_official/web/manage/index.html', '的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚', 'uploads/2018/05/e3074bee706475303389333956d06d7e.png', '0', '2018-05-21 12:14:33', '2018-05-21 12:14:33');
INSERT INTO `dz_teches` VALUES ('22', '技术1', 'http://127.0.0.1:8020/dz_official/web/manage/index.html', '的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚', 'uploads/2018/05/11d94f37fee9a746d7acbc439b99838c.png', '0', '2018-05-21 12:14:34', '2018-05-21 12:14:34');
INSERT INTO `dz_teches` VALUES ('23', '技术1', 'http://127.0.0.1:8020/dz_official/web/manage/index.html', '的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚', 'uploads/2018/05/c56e608d06870c9e7dfbfac1d474f277.png', '0', '2018-05-21 12:14:34', '2018-05-21 12:14:34');
INSERT INTO `dz_teches` VALUES ('24', '技术1', 'http://127.0.0.1:8020/dz_official/web/manage/index.html', '的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚', 'uploads/2018/05/8c4798c24f2ca683e92deecc92e646f1.png', '0', '2018-05-21 12:14:35', '2018-05-21 12:14:35');
INSERT INTO `dz_teches` VALUES ('25', '技术1', 'http://127.0.0.1:8020/dz_official/web/manage/index.html', '的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚', 'uploads/2018/05/05016f4bf993f3acbedd554b97dee639.png', '0', '2018-05-21 12:14:35', '2018-05-21 12:14:35');
INSERT INTO `dz_teches` VALUES ('26', '技术1', 'http://127.0.0.1:8020/dz_official/web/manage/index.html', '的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚', 'uploads/2018/05/f48bc1cb25089db0b90ce7acb8e4c1ac.png', '0', '2018-05-21 12:14:36', '2018-05-21 12:14:36');
INSERT INTO `dz_teches` VALUES ('27', '技术1', 'http://127.0.0.1:8020/dz_official/web/manage/index.html', '的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚', 'uploads/2018/05/2f50e6cacaef68ccf9f85ff7acb2be4c.png', '0', '2018-05-21 12:14:36', '2018-05-21 12:14:36');
INSERT INTO `dz_teches` VALUES ('28', '技术1', 'http://127.0.0.1:8020/dz_official/web/manage/index.html', '的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚的发个梵蒂冈的刚', 'uploads/2018/05/5877838e1595c2bf3c9ad68611842945.png', '0', '2018-05-21 12:14:37', '2018-05-21 12:14:37');
INSERT INTO `dz_teches` VALUES ('29', '产品111', 'http://127.0.0.1:8020/dz_official/web/manage/index.html', '产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品', 'uploads/2018/05/1da0f6a5b957aa528c9f443c247da9e6.png', '1', '2018-05-21 12:15:27', '2018-05-21 12:15:27');
INSERT INTO `dz_teches` VALUES ('30', '产品111', 'http://127.0.0.1:8020/dz_official/web/manage/index.html', '产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品', 'uploads/2018/05/b6ff90c3bf1a65b00db4b1c861e4c57f.png', '1', '2018-05-21 12:15:27', '2018-05-21 12:15:27');
INSERT INTO `dz_teches` VALUES ('31', '产品111', 'http://127.0.0.1:8020/dz_official/web/manage/index.html', '产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品产品', 'uploads/2018/05/2a6130d5e9922432fcdc6e295ce9fa83.png', '1', '2018-05-21 12:15:27', '2018-05-21 12:15:27');
INSERT INTO `dz_teches` VALUES ('32', '产品2', 'http://127.0.0.1:8020/dz_official/web/manage/index.html', '的花果山的风格所得税的的花果山的风格所得税的的花果山的风格所得税的的花果山的风格所得税的的花果山的风格所得税的的花果山的风格所得税的', 'uploads/2018/05/735cdf04e4ffe072a222decce207fca4.png', '1', '2018-05-21 12:15:52', '2018-05-21 12:15:52');
INSERT INTO `dz_teches` VALUES ('33', '产品2', 'http://127.0.0.1:8020/dz_official/web/manage/index.html', '的花果山的风格所得税的的花果山的风格所得税的的花果山的风格所得税的的花果山的风格所得税的的花果山的风格所得税的的花果山的风格所得税的', 'uploads/2018/05/294148376f54778155fb371614054f25.png', '1', '2018-05-21 12:15:52', '2018-05-21 12:15:52');
INSERT INTO `dz_teches` VALUES ('34', '产品2', 'http://127.0.0.1:8020/dz_official/web/manage/index.html', '的花果山的风格所得税的的花果山的风格所得税的的花果山的风格所得税的的花果山的风格所得税的的花果山的风格所得税的的花果山的风格所得税的', 'uploads/2018/05/c527d4da855494c4b586553f679cd1e6.png', '1', '2018-05-21 12:15:53', '2018-05-21 12:15:53');
INSERT INTO `dz_teches` VALUES ('35', '产品2', 'http://127.0.0.1:8020/dz_official/web/manage/index.html', '的花果山的风格所得税的的花果山的风格所得税的的花果山的风格所得税的的花果山的风格所得税的的花果山的风格所得税的的花果山的风格所得税的', 'uploads/2018/05/1866ce4180c80c7294d85fb1c7f6cfdb.png', '1', '2018-05-21 12:15:53', '2018-05-21 12:15:53');
INSERT INTO `dz_teches` VALUES ('36', '产品2', 'http://127.0.0.1:8020/dz_official/web/manage/index.html', '的花果山的风格所得税的的花果山的风格所得税的的花果山的风格所得税的的花果山的风格所得税的的花果山的风格所得税的的花果山的风格所得税的', 'uploads/2018/05/b5322ed6fd9a714df1471f86d351bebb.png', '1', '2018-05-21 12:15:54', '2018-05-21 12:15:54');
INSERT INTO `dz_teches` VALUES ('37', '产品2', 'http://127.0.0.1:8020/dz_official/web/manage/index.html', '的花果山的风格所得税的的花果山的风格所得税的的花果山的风格所得税的的花果山的风格所得税的的花果山的风格所得税的的花果山的风格所得税的', 'uploads/2018/05/b05be01c4854d06b7a0adfeddb5e041a.png', '1', '2018-05-21 12:15:54', '2018-05-21 12:15:54');

-- ----------------------------
-- Table structure for dz_users
-- ----------------------------
DROP TABLE IF EXISTS `dz_users`;
CREATE TABLE `dz_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ip地址',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '留言内容',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '留言时间',
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户留言表';

-- ----------------------------
-- Records of dz_users
-- ----------------------------
INSERT INTO `dz_users` VALUES ('4', '183.15.241.47', 'sdgfsdfdsfsf的爽肤水凤飞飞凤飞飞凤飞飞凤飞飞凤飞飞凤飞飞', '2018-05-21 12:02:50', '2018-05-21 12:02:50');
