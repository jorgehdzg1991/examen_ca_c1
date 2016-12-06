/*
MySQL Backup
Source Server Version: 10.1.16
Source Database: db_examencac1
Date: 05/12/2016 22:00:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
--  Table structure for `bit_acciones`
-- ----------------------------
DROP TABLE IF EXISTS `bit_acciones`;
CREATE TABLE `bit_acciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accion` text,
  `colaboradores_id` int(11) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `cat_estatus`
-- ----------------------------
DROP TABLE IF EXISTS `cat_estatus`;
CREATE TABLE `cat_estatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `ctl_areas`
-- ----------------------------
DROP TABLE IF EXISTS `ctl_areas`;
CREATE TABLE `ctl_areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `ctl_colaboradores`
-- ----------------------------
DROP TABLE IF EXISTS `ctl_colaboradores`;
CREATE TABLE `ctl_colaboradores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `edad` tinyint(4) DEFAULT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `perfil` bit(1) DEFAULT NULL,
  `login` varchar(16) DEFAULT NULL,
  `passwd` varchar(32) DEFAULT NULL,
  `departamentos_id` int(11) DEFAULT NULL,
  `estatus` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `ctl_departamentos`
-- ----------------------------
DROP TABLE IF EXISTS `ctl_departamentos`;
CREATE TABLE `ctl_departamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `areas_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `opr_seguimientos`
-- ----------------------------
DROP TABLE IF EXISTS `opr_seguimientos`;
CREATE TABLE `opr_seguimientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `observaciones` text,
  `tickets_id` int(11) DEFAULT NULL,
  `estatus_id` int(11) DEFAULT '1',
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `opr_tickets`
-- ----------------------------
DROP TABLE IF EXISTS `opr_tickets`;
CREATE TABLE `opr_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta` text,
  `emisor_id` int(11) DEFAULT NULL,
  `receptor_id` int(11) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records 
-- ----------------------------
INSERT INTO `bit_acciones` VALUES ('1','El usuario Jorge Hernández García inició sesión','1','2016-12-03 08:25:27'), ('2','Jorge Hernández García ha creado un nuevo ticket','1','2016-12-03 08:26:50'), ('3','Jorge Hernández García ha creado un nuevo ticket','1','2016-12-03 08:28:03'), ('4','El usuario Jorge Hernández García inició sesión','1','2016-12-03 11:41:31'), ('5','El usuario Juan Camaney inició sesión','2','2016-12-05 20:09:56'), ('6','Juan Camaney ha creado un nuevo ticket','2','2016-12-05 20:10:57'), ('7','El usuario Juan Camaney cerró su sesión','2','2016-12-05 20:14:47'), ('8','El usuario Jorge Hernández García inició sesión','1','2016-12-05 20:14:52'), ('9','El usuario Jorge Hernández García cerró su sesión','1','2016-12-05 20:16:10'), ('10','El usuario Juan Camaney inició sesión','2','2016-12-05 20:16:28'), ('11','El usuario Juan Camaney cerró su sesión','2','2016-12-05 20:26:08'), ('12','El usuario Jorge Hernández García inició sesión','1','2016-12-05 20:26:13'), ('13','Jorge Hernández García ha abierto el ticket','1','2016-12-05 20:58:29'), ('14','El usuario Jorge Hernández García cerró su sesión','1','2016-12-05 21:07:23'), ('15','El usuario Juan Camaney inició sesión','2','2016-12-05 21:07:28'), ('16','El usuario Juan Camaney cerró su sesión','2','2016-12-05 21:09:12'), ('17','El usuario Jorge Hernández García inició sesión','1','2016-12-05 21:09:17'), ('18','El usuario Jorge Hernández García cerró su sesión','1','2016-12-05 21:13:35'), ('19','El usuario Juan Camaney inició sesión','2','2016-12-05 21:13:46'), ('20','El usuario Juan Camaney cerró su sesión','2','2016-12-05 21:31:09'), ('21','El usuario Jorge Hernández García inició sesión','1','2016-12-05 21:31:18'), ('22','El usuario Jorge Hernández García cerró su sesión','1','2016-12-05 21:42:21'), ('23','El usuario Juan Camaney inició sesión','2','2016-12-05 21:42:26'), ('24','El usuario Juan Camaney cerró su sesión','2','2016-12-05 21:52:57'), ('25','El usuario Jorge Hernández García inició sesión','1','2016-12-05 21:53:07');
INSERT INTO `cat_estatus` VALUES ('1','Registrado'), ('2','Abierto'), ('3','Proceso'), ('4','Finalizado'), ('5','Cerrado');
INSERT INTO `ctl_areas` VALUES ('1','IT'), ('2','Marketing'), ('3','Administración'), ('4','Dirección'), ('5','Recursos Humanos');
INSERT INTO `ctl_colaboradores` VALUES ('1','Jorge Hernández García','24','jorgehdzg1991@gmail.com','','jorge','cc03e747a6afbbcbf8be7668acfebee5','1',''), ('2','Juan Camaney','60','juan@test.com','','juan','cc03e747a6afbbcbf8be7668acfebee5','2',''), ('3','Pedro López','30','pedro@test.com','','pedro','cc03e747a6afbbcbf8be7668acfebee5','3',''), ('4','Luis Suarez','29','luis@test.com','','luis','cc03e747a6afbbcbf8be7668acfebee5','4',''), ('5','Leonel Messi','28','leo@test.com','','leo','cc03e747a6afbbcbf8be7668acfebee5','5',''), ('6','Sergio Perez','41','sergio@test.com','','checo','cc03e747a6afbbcbf8be7668acfebee5','6',''), ('7','Manuel Rodríquez','54','manuel@test.com','','manuel','cc03e747a6afbbcbf8be7668acfebee5','7',''), ('8','Andrés Orozco','23','andres@test.com','','andres','cc03e747a6afbbcbf8be7668acfebee5','8',''), ('9','Fulanito Hernández','44','fulano@test.com','','fulano','cc03e747a6afbbcbf8be7668acfebee5','9',''), ('10','Perla Campos','23','perla@test.com','','perla','cc03e747a6afbbcbf8be7668acfebee5','10',''), ('11','Belén Hernández','21','belen@test.com','','belen','cc03e747a6afbbcbf8be7668acfebee5','11',''), ('12','Ricardo Anaya','22','ricardo@test.com','','ricardo','cc03e747a6afbbcbf8be7668acfebee5','12','');
INSERT INTO `ctl_departamentos` VALUES ('1','Soporte Técnico','1'), ('2','Innovación','1'), ('3','Ventas','2'), ('4','Imágen Empresarial','2'), ('5','Publicidad','2'), ('6','Recursos Materiales','3'), ('7','Nomina','3'), ('8','Contabilidad','3'), ('9','Mesa Directiva','4'), ('10','Psicología','5'), ('11','Reclutamiento','5'), ('12','Sindicato','5');
INSERT INTO `opr_seguimientos` VALUES ('1','Se ha creado el ticket','1','1','2016-12-03 08:26:07'), ('2','Se ha creado el ticket','2','1','2016-12-03 08:27:59'), ('3','Se ha creado el ticket','3','1','2016-12-05 20:10:38'), ('4','Jorge Hernández García ha abierto el ticket','3','2','2016-12-05 20:58:29'), ('5','Voy en camino finísimo caballero','3','3','2016-12-05 21:13:26'), ('6','¡Listo! Ya jaló. Checa y dime si te funciona','3','4','2016-12-05 21:32:11'), ('7','Lísto','3','5','2016-12-05 21:35:04');
INSERT INTO `opr_tickets` VALUES ('1','No me ha llegado la quincena','1','7','2016-12-03 08:25:53'), ('2','Ya aceptaron mi solicitud se equipo de computo?','1','8','2016-12-03 08:27:59'), ('3','Me puede instalar el interné par favaaar','2','1','2016-12-05 20:10:38');
