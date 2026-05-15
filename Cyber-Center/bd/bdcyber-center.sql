/*
 Navicat Premium Dump SQL

 Source Server         : PHP8
 Source Server Type    : MySQL
 Source Server Version : 120202 (12.2.2-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : bdcyber-center

 Target Server Type    : MySQL
 Target Server Version : 120202 (12.2.2-MariaDB)
 File Encoding         : 65001

 Date: 15/05/2026 01:19:31
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for DETALLE_PERSONA
-- ----------------------------
DROP TABLE IF EXISTS `DETALLE_PERSONA`;
CREATE TABLE `DETALLE_PERSONA`  (
  `id_detalle` int NOT NULL AUTO_INCREMENT,
  `id_persona` int NOT NULL,
  `carrera` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `semestre` int NULL DEFAULT NULL,
  `departamento` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `institucion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `motivo_visita` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `area_administrativa` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `cargo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_detalle`) USING BTREE,
  UNIQUE INDEX `id_persona`(`id_persona` ASC) USING BTREE,
  CONSTRAINT `1` FOREIGN KEY (`id_persona`) REFERENCES `PERSONA` (`id_persona`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of DETALLE_PERSONA
-- ----------------------------

-- ----------------------------
-- Table structure for EQUIPO
-- ----------------------------
DROP TABLE IF EXISTS `EQUIPO`;
CREATE TABLE `EQUIPO`  (
  `id_equipo` int NOT NULL AUTO_INCREMENT,
  `numero_equipo` int NOT NULL,
  `nombre_host` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sistema_operativo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `procesador` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `ram_gb` int NULL DEFAULT NULL,
  `almacenamiento_gb` int NULL DEFAULT NULL,
  `estado_equipo` enum('Disponible','Ocupado','Mantenimiento') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'Disponible',
  PRIMARY KEY (`id_equipo`) USING BTREE,
  UNIQUE INDEX `numero_equipo`(`numero_equipo` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of EQUIPO
-- ----------------------------

-- ----------------------------
-- Table structure for PERIFERICO
-- ----------------------------
DROP TABLE IF EXISTS `PERIFERICO`;
CREATE TABLE `PERIFERICO`  (
  `id_periferico` int NOT NULL AUTO_INCREMENT,
  `tipo` enum('monitor','teclado','mouse','audifonos','camara','otros') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `marca` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `serial` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `modelo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `estado_periferico` enum('operativo','defectuoso','en reparacion') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'operativo',
  `id_equipo` int NOT NULL,
  PRIMARY KEY (`id_periferico`) USING BTREE,
  UNIQUE INDEX `serial`(`serial` ASC) USING BTREE,
  INDEX `id_equipo`(`id_equipo` ASC) USING BTREE,
  CONSTRAINT `1` FOREIGN KEY (`id_equipo`) REFERENCES `EQUIPO` (`id_equipo`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of PERIFERICO
-- ----------------------------

-- ----------------------------
-- Table structure for PERSONA
-- ----------------------------
DROP TABLE IF EXISTS `PERSONA`;
CREATE TABLE `PERSONA`  (
  `id_persona` int NOT NULL AUTO_INCREMENT,
  `cedula` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `apellido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telefono` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_tipo_usuario` int NOT NULL,
  PRIMARY KEY (`id_persona`) USING BTREE,
  UNIQUE INDEX `cedula`(`cedula` ASC) USING BTREE,
  UNIQUE INDEX `email`(`email` ASC) USING BTREE,
  INDEX `id_tipo_usuario`(`id_tipo_usuario` ASC) USING BTREE,
  CONSTRAINT `1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `TIPO_USUARIO` (`id_tipo_usuario`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of PERSONA
-- ----------------------------

-- ----------------------------
-- Table structure for RESERVA
-- ----------------------------
DROP TABLE IF EXISTS `RESERVA`;
CREATE TABLE `RESERVA`  (
  `id_reserva` int NOT NULL AUTO_INCREMENT,
  `id_persona` int NOT NULL,
  `id_equipo` int NOT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `duracion_minutos` int NOT NULL,
  `estado` enum('Activa','Finalizada','Cancelada') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'Activa',
  `fecha_hora_creacion` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_reserva`) USING BTREE,
  INDEX `id_persona`(`id_persona` ASC) USING BTREE,
  INDEX `id_equipo`(`id_equipo` ASC) USING BTREE,
  CONSTRAINT `1` FOREIGN KEY (`id_persona`) REFERENCES `PERSONA` (`id_persona`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `2` FOREIGN KEY (`id_equipo`) REFERENCES `EQUIPO` (`id_equipo`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of RESERVA
-- ----------------------------

-- ----------------------------
-- Table structure for TIPO_USUARIO
-- ----------------------------
DROP TABLE IF EXISTS `TIPO_USUARIO`;
CREATE TABLE `TIPO_USUARIO`  (
  `id_tipo_usuario` int NOT NULL,
  `nombre_tipo` enum('Estudiante','Profesor','Invitado','Administrativo') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`) USING BTREE,
  UNIQUE INDEX `nombre_tipo`(`nombre_tipo` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of TIPO_USUARIO
-- ----------------------------
INSERT INTO `TIPO_USUARIO` VALUES (1, 'Estudiante');
INSERT INTO `TIPO_USUARIO` VALUES (2, 'Profesor');
INSERT INTO `TIPO_USUARIO` VALUES (3, 'Invitado');
INSERT INTO `TIPO_USUARIO` VALUES (4, 'Administrativo');

-- ----------------------------
-- Triggers structure for table RESERVA
-- ----------------------------
DROP TRIGGER IF EXISTS `before_insert_reserva_no_finalizada_hoy`;
delimiter ;;
CREATE TRIGGER `before_insert_reserva_no_finalizada_hoy` BEFORE INSERT ON `RESERVA` FOR EACH ROW BEGIN
    DECLARE finalizada_hoy INT DEFAULT 0;
    SELECT COUNT(*) INTO finalizada_hoy
    FROM RESERVA
    WHERE id_persona = NEW.id_persona
      AND fecha = NEW.fecha
      AND estado = 'Finalizada';
    IF finalizada_hoy > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No puede reservar hoy porque ya tuvo una reserva que finalizó.';
    END IF;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
