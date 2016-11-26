/*
MySQL Backup
Source Server Version: 10.1.16
Source Database: db_examencac1
Date: 26/11/2016 17:24:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
--  Table structure for `bit_acciones`
-- ----------------------------
DROP TABLE IF EXISTS `bit_acciones`;
CREATE TABLE `bit_acciones` (
  `id` int(11) NOT NULL,
  `accion` text,
  `fecha` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `colaboradores_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `ctl_areas`
-- ----------------------------
DROP TABLE IF EXISTS `ctl_areas`;
CREATE TABLE `ctl_areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `ctl_colaboradores`
-- ----------------------------
DROP TABLE IF EXISTS `ctl_colaboradores`;
CREATE TABLE `ctl_colaboradores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `edad` tinyint(4) DEFAULT NULL,
  `perfil` bit(1) DEFAULT NULL,
  `login` varchar(16) DEFAULT NULL,
  `passwd` varchar(32) DEFAULT NULL,
  `areas_id` int(11) DEFAULT NULL,
  `departamentos_id` int(11) DEFAULT NULL,
  `estatus` bit(1) DEFAULT NULL COMMENT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `ctl_departamentos`
-- ----------------------------
DROP TABLE IF EXISTS `ctl_departamentos`;
CREATE TABLE `ctl_departamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `opr_seguimientos`
-- ----------------------------
DROP TABLE IF EXISTS `opr_seguimientos`;
CREATE TABLE `opr_seguimientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comentario` text,
  `colaboradores_id` int(11) DEFAULT NULL,
  `tickets_id` int(11) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `opr_tickets`
-- ----------------------------
DROP TABLE IF EXISTS `opr_tickets`;
CREATE TABLE `opr_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta` text,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estatus` bit(1) DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records 
-- ----------------------------
INSERT INTO `ctl_areas` VALUES ('1','FICE');
INSERT INTO `ctl_colaboradores` VALUES ('1','Jorge Hernández García','24','','jorge','cc03e747a6afbbcbf8be7668acfebee5','1','1','');
INSERT INTO `ctl_departamentos` VALUES ('1','MTWyDM');
