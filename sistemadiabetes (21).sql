-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 22-03-2019 a las 23:08:42
-- Versión del servidor: 5.7.19
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemadiabetes`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `SP_ASIGNACION_LISTAR_ASIGNACIONES`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ASIGNACION_LISTAR_ASIGNACIONES` (IN `idEspecialidad` INT(11))  NO SQL
BEGIN
SELECT asig.idAsignacionEspecialidad,esp.Descripcion as Especialidad,CONCAT(med.nombres," ",med.apellidoPaterno," ",med.apellidoMaterno) as NombreMedico,DATE_FORMAT(asig.fechaRegistro,"%d/%m/%Y") as fechaRegistro from tab_asignacionespecialidad asig INNER JOIN tab_especialidad esp ON esp.idEspecialidad=asig.Especialidad_idEspecialidad INNER JOIN tab_medico med ON med.idMedico=asig.Medico_idMedico where asig.Especialidad_idEspecialidad=idEspecialidad;
END$$

DROP PROCEDURE IF EXISTS `SP_ASIGNACION_LISTAR_MEDICOS_DISPONIBLES`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ASIGNACION_LISTAR_MEDICOS_DISPONIBLES` (IN `idEspecialidad` INT(11))  NO SQL
SELECT med.idMedico,CONCAT(med.nombres," ",med.apellidoPaterno," ",med.apellidoMaterno) as NombreMedico,med.edad,med.dni FROM tab_medico med where med.Estado_idEstado=1 and NOT EXISTS (SELECT * FROM tab_asignacionespecialidad esp WHERE esp.Medico_idMedico=med.idMedico and esp.Especialidad_idEspecialidad=idEspecialidad)$$

DROP PROCEDURE IF EXISTS `SP_CRUD_MEDICO`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CRUD_MEDICO` (IN `Operacion` VARCHAR(100), IN `idMedicoM` VARCHAR(11), IN `MNombre` VARCHAR(150), IN `MApePa` VARCHAR(150), IN `MApeMa` VARCHAR(150), IN `MFechaNa` DATE, IN `Medad` INT(11), IN `MDNI` CHAR(11), IN `Mtelefo` CHAR(11), IN `MCel` CHAR(11), IN `Mcorreo` VARCHAR(100), IN `Msexo` INT(11))  NO SQL
BEGIN

SET idMedicoM=FU_VALIDAR_INT(idMedicoM);
SET MNombre=FU_VALIDAR_VARCHAR(MNombre);
SET MApePa=FU_VALIDAR_VARCHAR(MApePa);
SET MApeMa=FU_VALIDAR_VARCHAR(MApeMa);
SET MFechaNa=FU_VALIDAR_DATE(MFechaNa);
SET Medad=FU_VALIDAR_INT(Medad);
SET MDNI=FU_VALIRDAR_CHAR(MDNI);
SET Mtelefo=FU_VALIRDAR_CHAR(Mtelefo);
SET MCel=FU_VALIRDAR_CHAR(MCel);
SET Mcorreo=FU_VALIDAR_VARCHAR(Mcorreo);
SET Msexo=FU_VALIDAR_INT(Msexo);


if(Operacion="REGISTRAR")then 
 
INSERT INTO `tab_medico`(`idMedico`, `nombres`, `apellidoPaterno`, `apellidoMaterno`, `fechaNacimiento`, `edad`, `dni`, `Telefono`, `Celular`, `Correo`, `Sexo_idSexo`, `Perfil_idPerfil`, `Estado_idEstado`, `fechaRegistro`) VALUES (NULL,MNombre,MApePa,MApeMa,MFechaNa,Medad,MDNI,Mtelefo,MCel,Mcorreo,Msexo,11,1,NOW());


ELSEIF(Operacion="EDITAR")then 

UPDATE `tab_medico` SET `nombres`=MNombre,`apellidoPaterno`=MApePa,`apellidoMaterno`=MApeMa,`fechaNacimiento`=MFechaNa,`edad`=Medad,`dni`=MDNI,`Telefono`=Mtelefo,`Celular`=MCel,`Correo`=Mcorreo,`Sexo_idSexo`=Msexo  WHERE `idMedico`=idMedicoM;

ELSEIF(Operacion="ELIMINAR")then 

DELETE FROM `tab_medico` WHERE `idMedico`=idMedicoM;

ELSEIF(Operacion="HABILITAR")THEN

UPDATE `tab_medico` SET `Estado_idEstado`=1 WHERE `idMedico`=idMedicoM;

ELSEIF(operacion="INHABILITAR")THEN 

UPDATE `tab_medico` SET `Estado_idEstado`=2 WHERE `idMedico`=idMedicoM;

END IF;

END$$

DROP PROCEDURE IF EXISTS `SP_ESTADO_LISTAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ESTADO_LISTAR` (IN `Tipo` INT(11))  NO SQL
BEGIN

Select * FROM estado e WHERE e.tipoEstado=Tipo;

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_COMORBILIDAD_ACTIVACION`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_COMORBILIDAD_ACTIVACION` (IN `idComorbilidadU` INT(11), IN `codigo` INT(11))  NO SQL
BEGIN 

UPDATE `tab_comorbilidad` SET  `Estado_idEstado`=codigo  WHERE  `idComorbilidad`=idComorbilidadU;   

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_COMORBILIDAD_EDITAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_COMORBILIDAD_EDITAR` (IN `dato` VARCHAR(150), IN `idComorbilidadU` INT(11))  NO SQL
BEGIN

UPDATE `tab_comorbilidad` SET `Descripcion`=dato WHERE `idComorbilidad`=idComorbilidadU;
 
END$$

DROP PROCEDURE IF EXISTS `SP_MANT_COMORBILIDAD_ELIMINAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_COMORBILIDAD_ELIMINAR` (IN `idComorbilidadD` INT(11))  NO SQL
BEGIN

DELETE FROM `tab_comorbilidad` WHERE `idComorbilidad`=idComorbilidadD;

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_COMORBILIDAD_LISTAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_COMORBILIDAD_LISTAR` ()  NO SQL
BEGIN 

SELECT tab.idComorbilidad,tab.Descripcion,tab.Estado_idEstado,DATE_FORMAT(tab.fechaRegistro,"%d/%m/%Y") as fechaRegistro,e.nombreEstado FROM tab_comorbilidad tab INNER JOIN estado e ON e.idEstado=tab.Estado_idEstado; 

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_COMORBILIDAD_RECUPERAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_COMORBILIDAD_RECUPERAR` (IN `idComorbilidadS` INT(11))  NO SQL
BEGIN 

SELECT * FROM tab_comorbilidad tab where tab.idComorbilidad=idComorbilidadS;

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_COMORBILIDAD_REGISTRO`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_COMORBILIDAD_REGISTRO` (IN `dato` VARCHAR(150))  NO SQL
BEGIN 

INSERT INTO `tab_comorbilidad`(`idComorbilidad`, `Descripcion`, `Estado_idEstado`, `fechaRegistro`) VALUES (NULL,dato,1,NOW());

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_CONDICION_ACTIVACION`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_CONDICION_ACTIVACION` (IN `idCONDICIONU` INT(11), IN `codigo` INT(11))  NO SQL
BEGIN 

UPDATE `tab_Condicion` SET  `Estado_idEstado`=codigo  WHERE  `idCondicion`=idCONDICIONU;   

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_CONDICION_EDITAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_CONDICION_EDITAR` (IN `dato` VARCHAR(150), IN `idCONDICIONU` INT(11))  NO SQL
BEGIN

UPDATE `tab_Condicion` SET `Descripcion`=dato WHERE `idCondicion`=idCONDICIONU;
 
END$$

DROP PROCEDURE IF EXISTS `SP_MANT_CONDICION_ELIMINAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_CONDICION_ELIMINAR` (IN `idCONDICIOND` INT(11))  NO SQL
BEGIN

DELETE FROM `tab_Condicion` WHERE `idCondicion`=idCONDICIOND;

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_CONDICION_LISTAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_CONDICION_LISTAR` ()  NO SQL
BEGIN 

SELECT tab.idCondicion,tab.Descripcion,tab.Estado_idEstado,DATE_FORMAT(tab.fechaRegistro,"%d/%m/%Y") as fechaRegistro,e.nombreEstado FROM tab_condicion tab INNER JOIN estado e ON e.idEstado=tab.Estado_idEstado; 

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_CONDICION_RECUPERAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_CONDICION_RECUPERAR` (IN `idCONDICIONS` INT(11))  NO SQL
BEGIN 

SELECT * FROM tab_condicion tab where tab.idCondicion=idCONDICIONS;

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_CONDICION_REGISTRO`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_CONDICION_REGISTRO` (IN `dato` VARCHAR(150))  NO SQL
BEGIN 

INSERT INTO `tab_condicion`(`idCondicion`, `Descripcion`, `Estado_idEstado`, `fechaRegistro`) VALUES (NULL,dato,1,NOW());

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_DIAGNOSTICOENFERMERIA_ACTIVACION`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_DIAGNOSTICOENFERMERIA_ACTIVACION` (IN `idDiagnosticoEnfermeriaU` INT(11), IN `codigo` INT(11))  NO SQL
BEGIN 

UPDATE `tab_diagnostico_enfermeria` SET  `Estado_idEstado`=codigo  WHERE  `idDiagnosticoEnfermeria`=idDiagnosticoEnfermeriaU;   

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_DIAGNOSTICOENFERMERIA_EDITAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_DIAGNOSTICOENFERMERIA_EDITAR` (IN `dato` VARCHAR(150), IN `idDiagnosticoEnfermeriaU` INT(11))  NO SQL
BEGIN

UPDATE `tab_diagnostico_enfermeria` SET `Descripcion`=dato WHERE `idDiagnosticoEnfermeria`=idDiagnosticoEnfermeriaU;
 
END$$

DROP PROCEDURE IF EXISTS `SP_MANT_DIAGNOSTICOENFERMERIA_ELIMINAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_DIAGNOSTICOENFERMERIA_ELIMINAR` (IN `idDiagnosticoEnfermeriaD` INT(11))  NO SQL
BEGIN

DELETE FROM `tab_diagnostico_enfermeria` WHERE `idDiagnosticoEnfermeria`=idDiagnosticoEnfermeriaD;

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_DIAGNOSTICOENFERMERIA_LISTAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_DIAGNOSTICOENFERMERIA_LISTAR` ()  NO SQL
BEGIN 

SELECT tab.idDiagnosticoEnfermeria,tab.Descripcion,tab.Estado_idEstado,DATE_FORMAT(tab.fechaRegistro,"%d/%m/%Y") as fechaRegistro,e.nombreEstado FROM tab_diagnostico_enfermeria tab INNER JOIN estado e ON e.idEstado=tab.Estado_idEstado; 

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_DIAGNOSTICOENFERMERIA_RECUPERAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_DIAGNOSTICOENFERMERIA_RECUPERAR` (IN `idDiagnosticoEnfermeriaS` INT(11))  NO SQL
BEGIN 

SELECT * FROM tab_diagnostico_enfermeria tab where tab.idDiagnosticoEnfermeria=idDiagnosticoEnfermeriaS;

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_DIAGNOSTICOENFERMERIA_REGISTRO`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_DIAGNOSTICOENFERMERIA_REGISTRO` (IN `dato` VARCHAR(150))  NO SQL
BEGIN 

INSERT INTO `tab_diagnostico_enfermeria`(`idDiagnosticoEnfermeria`, `Descripcion`, `Estado_idEstado`, `fechaRegistro`) VALUES (NULL,dato,1,NOW());

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_DIAGNOSTICOESPECIALIDAD_ACTIVACION`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_DIAGNOSTICOESPECIALIDAD_ACTIVACION` (IN `idDiag` INT(11), IN `codigo` INT(11))  NO SQL
BEGIN 

UPDATE `tab_diagnostico_especialidad` SET  `Estado_idEstado`=codigo  WHERE  `idDiagnosticoEspecialidad`=idDiag;   

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_DIAGNOSTICOESPECIALIDAD_EDITAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_DIAGNOSTICOESPECIALIDAD_EDITAR` (IN `dato` VARCHAR(150), IN `idDiag` INT(11))  NO SQL
BEGIN

UPDATE `tab_diagnostico_especialidad` SET `Descripcion`=dato WHERE `idDiagnosticoEspecialidad`=idDiag;
   
END$$

DROP PROCEDURE IF EXISTS `SP_MANT_DIAGNOSTICOESPECIALIDAD_ELIMINAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_DIAGNOSTICOESPECIALIDAD_ELIMINAR` (IN `idDiag` INT(11))  NO SQL
BEGIN

DELETE FROM `tab_diagnostico_especialidad` WHERE `idDiagnosticoEspecialidad`=idDiag;

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_DIAGNOSTICOESPECIALIDAD_LISTAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_DIAGNOSTICOESPECIALIDAD_LISTAR` ()  NO SQL
BEGIN 

SELECT tab.idDiagnosticoEspecialidad,tab.Descripcion,tab.Estado_idEstado,DATE_FORMAT(tab.fechaRegistro,"%d/%m/%Y") as fechaRegistro,e.nombreEstado FROM tab_diagnostico_especialidad tab INNER JOIN estado e ON e.idEstado=tab.Estado_idEstado;  

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_DIAGNOSTICOESPECIALIDAD_RECUPERAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_DIAGNOSTICOESPECIALIDAD_RECUPERAR` (IN `idDiag` INT(11))  NO SQL
BEGIN 

SELECT * FROM tab_diagnostico_especialidad tab where tab.idDiagnosticoEspecialidad=idDiag;

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_DIAGNOSTICOESPECIALIDAD_REGISTRO`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_DIAGNOSTICOESPECIALIDAD_REGISTRO` (IN `dato` VARCHAR(150))  NO SQL
BEGIN 

INSERT INTO `tab_diagnostico_especialidad`(`idDiagnosticoEspecialidad`, `Descripcion`, `Estado_idEstado`, `fechaRegistro`) VALUES (NULL,dato,1,NOW());

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_DIAGNOSTICO_ACTIVACION`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_DIAGNOSTICO_ACTIVACION` (IN `idDIAGNOSTICOU` INT(11), IN `codigo` INT(11))  NO SQL
BEGIN 

UPDATE `tab_Diagnostico` SET  `Estado_idEstado`=codigo  WHERE  `idDiagnostico`=idDIAGNOSTICOU;   

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_DIAGNOSTICO_EDITAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_DIAGNOSTICO_EDITAR` (IN `dato` VARCHAR(150), IN `idDIAGNOSTICOU` INT(11))  NO SQL
BEGIN

UPDATE `tab_Diagnostico` SET `Descripcion`=dato WHERE `idDiagnostico`=idDIAGNOSTICOU;
 
END$$

DROP PROCEDURE IF EXISTS `SP_MANT_DIAGNOSTICO_ELIMINAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_DIAGNOSTICO_ELIMINAR` (IN `idDIAGNOSTICOD` INT(11))  NO SQL
BEGIN

DELETE FROM `tab_Diagnostico` WHERE `idDiagnostico`=idDIAGNOSTICOD;

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_DIAGNOSTICO_LISTAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_DIAGNOSTICO_LISTAR` ()  NO SQL
BEGIN 

SELECT tab.idDiagnostico,tab.Descripcion,tab.Estado_idEstado,DATE_FORMAT(tab.fechaRegistro,"%d/%m/%Y") as fechaRegistro,e.nombreEstado FROM tab_Diagnostico tab INNER JOIN estado e ON e.idEstado=tab.Estado_idEstado; 

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_DIAGNOSTICO_RECUPERAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_DIAGNOSTICO_RECUPERAR` (IN `idDIAGNOSTICOS` INT(11))  NO SQL
BEGIN 

SELECT * FROM tab_Diagnostico tab where tab.idDiagnostico=idDIAGNOSTICOS;

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_DIAGNOSTICO_REGISTRO`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_DIAGNOSTICO_REGISTRO` (IN `dato` VARCHAR(150))  NO SQL
BEGIN 

INSERT INTO `tab_Diagnostico`(`idDiagnostico`, `Descripcion`, `Estado_idEstado`, `fechaRegistro`) VALUES (NULL,dato,1,NOW());

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_ESPECIALIDAD_ACTIVACION`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_ESPECIALIDAD_ACTIVACION` (IN `idEspecialidadU` INT(11), IN `codigo` INT(11))  NO SQL
BEGIN 

UPDATE `tab_especialidad` SET  `Estado_idEstado`=codigo  WHERE  `idEspecialidad`=idEspecialidadU;   

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_ESPECIALIDAD_EDITAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_ESPECIALIDAD_EDITAR` (IN `dato` VARCHAR(150), IN `idEspecialidadU` INT(11))  NO SQL
BEGIN

UPDATE `tab_especialidad` SET `Descripcion`=UPPER(dato) WHERE `idEspecialidad`=idEspecialidadU;
 
END$$

DROP PROCEDURE IF EXISTS `SP_MANT_ESPECIALIDAD_ELIMINAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_ESPECIALIDAD_ELIMINAR` (IN `idEspecialidadD` INT(11))  NO SQL
BEGIN

DELETE FROM `tab_especialidad` WHERE `idEspecialidad`=idEspecialidadD;

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_ESPECIALIDAD_LISTAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_ESPECIALIDAD_LISTAR` ()  NO SQL
BEGIN 

SELECT tab.idEspecialidad,tab.Descripcion,tab.Estado_idEstado,DATE_FORMAT(tab.fechaRegistro,"%d/%m/%Y") as fechaRegistro,e.nombreEstado,(SELECT COUNT(*) FROM tab_asignacionespecialidad asig WHERE asig.Especialidad_idEspecialidad=tab.idEspecialidad) as Asignaciones FROM tab_especialidad tab INNER JOIN estado e ON e.idEstado=tab.Estado_idEstado; 

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_ESPECIALIDAD_RECUPERAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_ESPECIALIDAD_RECUPERAR` (IN `idEspecialidadS` INT(11))  NO SQL
BEGIN 

SELECT * FROM tab_especialidad tab where tab.idEspecialidad=idEspecialidadS;

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_ESPECIALIDAD_REGISTRO`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_ESPECIALIDAD_REGISTRO` (IN `dato` VARCHAR(150))  NO SQL
BEGIN 

INSERT INTO `tab_especialidad`(`idEspecialidad`, `Descripcion`, `Estado_idEstado`, `fechaRegistro`) VALUES (NULL,UPPER(dato),1,NOW());

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_GRADOINSTRUCCION_ACTIVACION`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_GRADOINSTRUCCION_ACTIVACION` (IN `idGradoInstruccionU` INT(11), IN `codigo` INT(11))  NO SQL
BEGIN 

UPDATE `tab_gradoinstruccion` SET  `Estado_idEstado`=codigo  WHERE  `idGradoInstruccion`=idGradoInstruccionU;   

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_GRADOINSTRUCCION_EDITAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_GRADOINSTRUCCION_EDITAR` (IN `dato` VARCHAR(150), IN `idGradoInstruccionU` INT(11))  NO SQL
BEGIN

UPDATE `tab_gradoinstruccion` SET `Descripcion`=dato WHERE `idGradoInstruccion`=idGradoInstruccionU;
 
END$$

DROP PROCEDURE IF EXISTS `SP_MANT_GRADOINSTRUCCION_ELIMINAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_GRADOINSTRUCCION_ELIMINAR` (IN `idGradoInstruccionD` INT(11))  NO SQL
BEGIN

DELETE FROM `tab_gradoinstruccion` WHERE `idGradoInstruccion`=idGradoInstruccionD;

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_GRADOINSTRUCCION_LISTAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_GRADOINSTRUCCION_LISTAR` ()  NO SQL
BEGIN 

SELECT tab.idGradoInstruccion,tab.Descripcion,tab.Estado_idEstado,DATE_FORMAT(tab.fechaRegistro,"%d/%m/%Y") as fechaRegistro,e.nombreEstado FROM tab_gradoinstruccion tab INNER JOIN estado e ON e.idEstado=tab.Estado_idEstado; 

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_GRADOINSTRUCCION_RECUPERAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_GRADOINSTRUCCION_RECUPERAR` (IN `idGradoInstruccionS` INT(11))  NO SQL
BEGIN 

SELECT * FROM tab_gradoinstruccion tab where tab.idGradoInstruccion=idGradoInstruccionS;

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_GRADOINSTRUCCION_REGISTRO`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_GRADOINSTRUCCION_REGISTRO` (IN `dato` VARCHAR(150))  NO SQL
BEGIN 

INSERT INTO `tab_gradoinstruccion`(`idGradoInstruccion`, `Descripcion`, `Estado_idEstado`, `fechaRegistro`) VALUES (NULL,dato,1,NOW());

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_GRUPOOPCION_ACTIVACION`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_GRUPOOPCION_ACTIVACION` (IN `idGrupoOpcionU` INT(11), IN `codigo` INT(11))  NO SQL
BEGIN 

UPDATE `tab_grupoopcion` SET  `Estado_idEstado`=codigo  WHERE  `idGrupoOpcion`=idGrupoOpcionU;   

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_GRUPOOPCION_EDITAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_GRUPOOPCION_EDITAR` (IN `dato` VARCHAR(150), IN `idGrupoOpcionU` INT(11))  NO SQL
BEGIN

UPDATE `tab_grupoopcion` SET `Descripcion`=dato WHERE `idGrupoOpcion`=idGrupoOpcionU;
 
END$$

DROP PROCEDURE IF EXISTS `SP_MANT_GRUPOOPCION_ELIMINAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_GRUPOOPCION_ELIMINAR` (IN `idGrupoOpcionD` INT(11))  NO SQL
BEGIN

DELETE FROM `tab_grupoopcion` WHERE `idGrupoOpcion`=idGrupoOpcionD;

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_GRUPOOPCION_LISTAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_GRUPOOPCION_LISTAR` ()  NO SQL
BEGIN 

SELECT tab.idGrupoOpcion,tab.Descripcion,tab.Estado_idEstado,DATE_FORMAT(tab.fechaRegistro,"%d/%m/%Y") as fechaRegistro,e.nombreEstado,(SELECT COUNT(*) FROM tab_opcion op where op.GrupoOpcion_idGrupoOpcion=tab.idGrupoOpcion) as Opciones FROM tab_grupoopcion tab INNER JOIN estado e ON e.idEstado=tab.Estado_idEstado; 

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_GRUPOOPCION_RECUPERAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_GRUPOOPCION_RECUPERAR` (IN `idGrupoOpcionS` INT(11))  NO SQL
BEGIN 

SELECT * FROM tab_grupoopcion tab where tab.idGrupoOpcion=idGrupoOpcionS;

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_GRUPOOPCION_REGISTRO`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_GRUPOOPCION_REGISTRO` (IN `dato` VARCHAR(150))  NO SQL
BEGIN 

INSERT INTO `tab_grupoopcion`(`idGrupoOpcion`, `Descripcion`, `Estado_idEstado`, `fechaRegistro`) VALUES (NULL,dato,1,NOW());

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_OPCION_LISTARTIPOS`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_OPCION_LISTARTIPOS` ()  NO SQL
BEGIN 

SELECT * FROM tab_tipoopcion;

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_SATISFACCION_ACTIVACION`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_SATISFACCION_ACTIVACION` (IN `idSatisfaccionU` INT(11), IN `codigo` INT(11))  NO SQL
BEGIN 

UPDATE `tab_satisfaccion` SET  `Estado_idEstado`=codigo  WHERE  `idSatisfaccion`=idSatisfaccionU;   

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_SATISFACCION_EDITAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_SATISFACCION_EDITAR` (IN `dato` VARCHAR(150), IN `idSatisfaccionU` INT(11))  NO SQL
BEGIN

UPDATE `tab_satisfaccion` SET `Descripcion`=dato WHERE `idSatisfaccion`=idSatisfaccionU;
 
END$$

DROP PROCEDURE IF EXISTS `SP_MANT_SATISFACCION_ELIMINAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_SATISFACCION_ELIMINAR` (IN `idSatisfaccionD` INT(11))  NO SQL
BEGIN

DELETE FROM `tab_satisfaccion` WHERE `idSatisfaccion`=idSatisfaccionD;

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_SATISFACCION_LISTAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_SATISFACCION_LISTAR` ()  NO SQL
BEGIN 

SELECT tab.idSatisfaccion,tab.Descripcion,tab.Estado_idEstado,DATE_FORMAT(tab.fechaRegistro,"%d/%m/%Y") as fechaRegistro,e.nombreEstado FROM tab_satisfaccion tab INNER JOIN estado e ON e.idEstado=tab.Estado_idEstado; 

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_SATISFACCION_RECUPERAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_SATISFACCION_RECUPERAR` (IN `idSatisfaccionS` INT(11))  NO SQL
BEGIN 

SELECT * FROM tab_satisfaccion tab where tab.idSatisfaccion=idSatisfaccionS;

END$$

DROP PROCEDURE IF EXISTS `SP_MANT_SATISFACCION_REGISTRO`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_SATISFACCION_REGISTRO` (IN `dato` VARCHAR(150))  NO SQL
BEGIN 

INSERT INTO `tab_satisfaccion`(`idSatisfaccion`, `Descripcion`, `Estado_idEstado`, `fechaRegistro`) VALUES (NULL,dato,1,NOW());

END$$

DROP PROCEDURE IF EXISTS `SP_MEDICO_LISTAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MEDICO_LISTAR` ()  NO SQL
begin

SELECT med.idMedico,CONCAT(med.nombres," ",med.apellidoPaterno," ",med.apellidoMaterno) as Nombremedico,med.edad,med.dni,med.Estado_idEstado,e.nombreEstado,CONCAT(med.Telefono,"/",med.Celular) as Comunicacion  FROM tab_medico med INNER JOIN estado e ON e.idEstado=med.Estado_idEstado;

end$$

DROP PROCEDURE IF EXISTS `SP_MEDICO_RECUPERAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MEDICO_RECUPERAR` (IN `idMedicoD` INT(11))  NO SQL
BEGIN 

SELECT * FROM tab_medico where idMedico=idMedicoD;
END$$

DROP PROCEDURE IF EXISTS `SP_PACIENTE_LISTAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_PACIENTE_LISTAR` ()  NO SQL
BEGIN

SELECT 
pa.idPaciente,
pa.Codigo,
CONCAT(pa.Nombres," ",pa.apellidoPaterno," ",pa.apellidoMaterno) as NombreCompletoPaciente,
IFNULL(pa.edad,"-") AS edad,
pa.numeroDocumento,
tipdoc.Descripcion as tipoDocu,
e.nombreEstado,
pa.Estado_idEstado,
IFNULL(CONCAT(depa.departamento,"/",prov.provincia,"/",dis.distrito),"-") as procedencia,
con.Descripcion as condicion
FROM tab_paciente pa LEFT JOIN estado e ON e.idEstado=pa.Estado_idEstado LEFT JOIN tab_tipodocumento tipdoc on tipdoc.idTipoDocumento=pa.TipoDocumento_idTipoDocumento LEFT JOIN sexo s ON s.idSexo=pa.Sexo_idSexo LEFT JOIN tab_condicion con ON con.idCondicion=pa.Condicion_idCondicion LEFT JOIN tab_departamento depa ON depa.idDepartamento=pa.Departamento_idDepartamento LEFT JOIN tab_provincia prov ON prov.idProvincia=pa.Provincia_idProvincia LEFT JOIN tab_distrito dis ON dis.idDistrito=pa.Distrito_idDistrito ;

END$$

DROP PROCEDURE IF EXISTS `SP_PACIENTE_RECUPERAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_PACIENTE_RECUPERAR` (IN `idPacienteU` INT(11))  NO SQL
BEGIN

SELECT * FROM tab_paciente pa WHERE pa.idPaciente=idPacienteU;
END$$

DROP PROCEDURE IF EXISTS `SP_PERFIL_ACTUALIZAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_PERFIL_ACTUALIZAR` (IN `nombre` VARCHAR(50), IN `descripcion` TEXT, IN `estado` INT(11), IN `idperfilE` INT(11), IN `creador` INT(11))  NO SQL
BEGIN

if(descripcion='-1')then
SET descripcion=null;
end if;

UPDATE `perfil` SET `nombrePerfil`=nombre,`descripcionPerfil`=descripcion,`Estado_idEstado`=estado WHERE `idPerfil`=idperfilE;

/* ------ REGISTRO DE BITACORA ------ */
SET @NombreUsuario=(SELECT u.usuario FROM usuario u WHERE u.idUsuario=creador);

INSERT INTO `bitacora`(`idBitacora`, `usuarioAccion`, `Accion`, `tablaAccion`,`Detalle`, `fechaRegistro`) VALUES (null,@NombreUsuario,'ACTUALIZACION','Perfil',CONCAt("SE ACTUALIZO PERFIL:",nombre),NOW());
END$$

DROP PROCEDURE IF EXISTS `SP_PERFIL_HABILITACION`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_PERFIL_HABILITACION` (IN `idPerfilE` INT(11), IN `codigo` INT(11), IN `idUsuarioE` INT(11))  NO SQL
BEGIN

SET @NombrePerfil=(SELECT pe.nombrePerfil FROM perfil pe WHERE pe.idPerfil=idPerfilE);


if (codigo=1) then
 	UPDATE `perfil` SET  `Estado_idEstado`=4 WHERE `idPerfil`=idPerfilE;
  SET @Mensaje=("PERFIL DESHBILITADO");
else
    UPDATE `perfil` SET  `Estado_idEstado`=1  WHERE `idPerfil`=idPerfilE;
 SET  @Mensaje=("PERFIL HABILITADO");
end if;

 /* ------ REGISTRO DE BITACORA ------ */

set @usuario=(SELECT u.user FROM usuario u  WHERE u.idUsuario=idUsuarioE);

INSERT INTO `bitacora`(`usuarioAccion`, `Accion`, `tablaAccion`,`Detalle`, `fechaRegistro`) VALUES (@usuario,@Mensaje,'PERFIL',CONCAT("SE",@Mensaje," :", @NombrePerfil),NOW());

END$$

DROP PROCEDURE IF EXISTS `SP_PERFIL_LISTAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_PERFIL_LISTAR` ()  NO SQL
BEGIN

SELECT * FROM perfil;

END$$

DROP PROCEDURE IF EXISTS `SP_PERFIL_LISTAR_TODOS`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_PERFIL_LISTAR_TODOS` ()  NO SQL
BEGIN

SELECT * FROM perfil p INNER JOIN estado e on e.idEstado=p.Estado_idEstado;
END$$

DROP PROCEDURE IF EXISTS `SP_PERFIL_RECUPERAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_PERFIL_RECUPERAR` (IN `idPerfilE` INT(11))  NO SQL
BEGIN

SELECT * FROM perfil p WHERE p.idPerfil=idPerfilE;
END$$

DROP PROCEDURE IF EXISTS `SP_PERFIL_REGISTRO`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_PERFIL_REGISTRO` (IN `nombrePerfil` VARCHAR(50), IN `descripcion` TEXT, IN `estado` INT(11), IN `idUsuario` INT(11))  NO SQL
BEGIN

DECLARE idPerfil INT(11);

-- REGISTRAR PERFIL --
INSERT INTO `perfil`(`idPerfil`, `nombrePerfil`, `descripcionPerfil`, `Estado_idEstado`, `fechaRegistro`) VALUES (null,nombrePerfil,descripcion,estado,NOW());
-- RECUPERAR ID DE PERFIL REGISTRADO --
SET idPerfil=(SELECT LAST_INSERT_ID());
-- REGISTRAR PERMISOS ASIGNADOS A PERFIL --
INSERT INTO `permisos`(`idPermisos`, `perfil_idPerfil`, `permiso1`, `permiso2`, `permiso3`, `permiso4`, `permiso5`, `permiso6`) VALUES (null,idPerfil,1,1,1,1,1,1);




SET @NombreUsuario=(SELECT concat(p.nombrePersona,' ',p.apellidoPaterno,' ',p.apellidoMaterno) as NombresPersona FROM usuario u inner join persona p ON p.idPersona=u.Persona_idPersona WHERE u.idUsuario=idUsuario);


INSERT INTO `bitacora`(`idBitacora`, `usuarioAccion`, `Accion`, `tablaAccion`,`Detalle`, `fechaRegistro`) VALUES (null,@NombreUsuario,'INSERTAR','SE REGISTRO PERFIL','Perfil',NOW());

INSERT INTO `bitacora`(`idBitacora`, `usuarioAccion`, `Accion`, `tablaAccion`,`Detalle`, `fechaRegistro`) VALUES (null,@NombreUsuario,'INSERTAR','SE REGISTRO PERMISOS DE PERFIL','Permisos',NOW());

END$$

DROP PROCEDURE IF EXISTS `SP_PERMISOS_ACTUALIZAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_PERMISOS_ACTUALIZAR` (IN `idPermisosE` INT(11), IN `perm1` INT(11), IN `perm2` INT(11), IN `perm3` INT(11), IN `perm4` INT(11), IN `perm5` INT(11), IN `perm6` INT(11), IN `idPerfilE` INT(11), IN `idUsuarioE` INT(11))  NO SQL
BEGIN

UPDATE `permisos` SET `Permiso1`=perm1,`Permiso2`=perm2,`Permiso3`=perm3,`Permiso4`=perm4,`Permiso5`=perm5,`Permiso6`=perm6 WHERE `idPermisos`=idPermisosE;

set @perfil=(SELECT perfil.nombrePerfil FROM perfil WHERE perfil.idPerfil=idPerfilE);

/* ------ REGISTRO DE BITACORA ------ */

set @usuario=(SELECT u.usuario FROM usuario u  WHERE u.idUsuario=idUsuarioE);

INSERT INTO `bitacora`(`idBitacora`, `usuarioAccion`, `Accion`, `tablaAccion`,`Detalle`, `fechaRegistro`) VALUES (null,@usuario,'SE ACTUALIZO PERMISOS','PERMISOS',CONCAT("SE ACTUALIZO PERMISOS DE PERFIL:",@perfil),NOW());

END$$

DROP PROCEDURE IF EXISTS `SP_PERMISOS_RECUPERAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_PERMISOS_RECUPERAR` (IN `idPerfilE` INT(11))  NO SQL
BEGIN

SELECT per.idPermisos,per.Permiso1,per.Permiso2,per.Permiso3,per.Permiso4,per.Permiso5,per.Permiso6,perf.nombrePerfil FROM permisos per INNER JOIN perfil perf ON perf.idPerfil=per.Perfil_idPerfil WHERE perf.idPerfil=idPerfilE;

END$$

DROP PROCEDURE IF EXISTS `SP_PERSONAS_LISTAR_SIN_USUARIOS`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_PERSONAS_LISTAR_SIN_USUARIOS` ()  NO SQL
BEGIN

SELECT * FROM persona p WHERE NOT EXISTS (SELECT * FROM usuario u WHERE u.Persona_idPersona=p.idPersona);


END$$

DROP PROCEDURE IF EXISTS `SP_PERSONA_ACTUALIZAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_PERSONA_ACTUALIZAR` (IN `nombre` VARCHAR(50), IN `apellidoP` VARCHAR(50), IN `apellidoM` VARCHAR(50), IN `DNI` CHAR(10), IN `fechaNacimiento` DATE, IN `correo` VARCHAR(100), IN `telefono` CHAR(10), IN `Direccion` TEXT, IN `estado` INT(11), IN `idPersonaU` INT(11), IN `idUsuario` INT(11))  NO SQL
BEGIN

if(fechaNacimiento=-1)then
SET fechaNacimiento=null;
end if;
if(correo=-1)then
SET correo=null;
end if;
if(telefono=-1)then
SET telefono=null;
end if;
if(Direccion=-1)then
SET Direccion=null;
end if;

UPDATE `persona` SET `nombrePersona`=nombre,`apellidoPaterno`=apellidoP,`apellidoMaterno`=apellidoM,`DNI`=DNI,`fechaNacimiento`=fechaNacimiento,`correo`=correo,`telefono`=telefono,`direccion`=Direccion,`Estado_idEstado`=estado WHERE `idPersona`=idPersonaU;

/* ------ REGISTRO DE BITACORA ------ */
SET @NombreUsuario=(SELECT concat(p.nombrePersona,' ',p.apellidoPaterno,' ',p.apellidoMaterno) as NombresPersona FROM usuario u inner join persona p ON p.idPersona=u.Persona_idPersona WHERE u.idUsuario=idUsuario);

INSERT INTO `bitacora`(`idBitacora`, `usuarioAccion`, `Accion`, `tablaAccion`,`Detalle`, `fechaRegistro`) VALUES (null,@NombreUsuario,'ACTUALIZACION','Persona',CONCAT('SE ACTUALIZO PERSONA:',nombre,' ',apellidoP,' ',apellidoM),NOW());
END$$

DROP PROCEDURE IF EXISTS `SP_PERSONA_HABILITACION`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_PERSONA_HABILITACION` (IN `idPersonaE` INT(11), IN `codigo` INT(11), IN `idUsuarioE` INT(11))  NO SQL
BEGIN

SET @NombrePersona=(SELECT concat(p.nombrePersona,' ',p.apellidoPaterno,' ',p.apellidoMaterno) as NombresPersona FROM persona p WHERE p.idPersona=idPersonaE);


if (codigo=1) then
 	UPDATE `persona` SET  `Estado_idEstado`=4 WHERE `idPersona`=idPersonaE;
  SET @Mensaje=("PERSONA DESHBILITADO");
else
    UPDATE `persona` SET  `Estado_idEstado`=1  WHERE `idPersona`=idPersonaE;
 SET  @Mensaje=("PERSONA HABILITADO");
end if;

 /* ------ REGISTRO DE BITACORA ------ */

set @usuario=(SELECT u.user FROM usuario u  WHERE u.idUsuario=idUsuarioE);

INSERT INTO `bitacora`(`idBitacora`, `usuarioAccion`, `Accion`, `tablaAccion`,`Detalle`, `fechaRegistro`) VALUES (null,@usuario,@Mensaje,'USUARIO',CONCAT("SE",@Mensaje," :", @NombrePersona),NOW());

END$$

DROP PROCEDURE IF EXISTS `SP_PERSONA_LISTAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_PERSONA_LISTAR` ()  NO SQL
BEGIN


SELECT * FROM persona p INNER JOIN estado e ON e.idEstado=p.Estado_idEstado;


END$$

DROP PROCEDURE IF EXISTS `SP_PERSONA_LISTAR_TODO`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_PERSONA_LISTAR_TODO` ()  NO SQL
BEGIN

SELECT * FROM persona;

END$$

DROP PROCEDURE IF EXISTS `SP_PERSONA_RECUPERAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_PERSONA_RECUPERAR` (IN `idPersonaU` INT)  NO SQL
begin

SELECT * FROM persona p WHERE p.idPersona=idPersonaU;

end$$

DROP PROCEDURE IF EXISTS `SP_PERSONA_REGISTRO`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_PERSONA_REGISTRO` (IN `nombre` VARCHAR(50), IN `apellidoP` VARCHAR(50), IN `apellidoM` VARCHAR(50), IN `DNI` CHAR(10), IN `fechaNacimiento` DATE, IN `correo` VARCHAR(100), IN `telefono` CHAR(10), IN `Direccion` TEXT, IN `estado` INT(11), IN `idUsuario` INT(11))  NO SQL
BEGIN

if(correo='0')THEN
SET correo=null;
end if;
if(telefono='0')THEN
SET telefono=null;
end if;
if(Direccion='0')THEN
SET Direccion=null;
end if;


INSERT INTO `persona`(`idPersona`, `nombrePersona`, `apellidoPaterno`, `apellidoMaterno`, `DNI`, `fechaNacimiento`, `correo`, `telefono`, `direccion`, `Estado_idEstado`, `fechaRegistro`) VALUES (NULL,nombre,apellidoP,apellidoM,DNI,fechaNacimiento,correo,telefono,Direccion,estado,NOW());


/* ------ REGISTRO DE BITACORA ------ */
SET @NombreUsuario=(SELECT concat(p.nombrePersona,' ',p.apellidoPaterno,' ',p.apellidoMaterno) as NombresPersona FROM usuario u inner join persona p ON p.idPersona=u.Persona_idPersona WHERE u.idUsuario=idUsuario);

INSERT INTO `bitacora`(`idBitacora`, `usuarioAccion`, `Accion`, `tablaAccion`,`Detalle`, `fechaRegistro`) VALUES (null,@NombreUsuario,'REGISTRO','Persona',CONCAT('SE REGISTRO PERSONA:',nombre,' ',apellidoP,' ',apellidoM),NOW());


END$$

DROP PROCEDURE IF EXISTS `SP_REGISTRAR_RESULTADOS`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_RESULTADOS` (IN `id` VARCHAR(11), IN `tipoGeneral` VARCHAR(150), IN `tipoOpcion` VARCHAR(11), IN `campo` TEXT, IN `Respuesta` TEXT, IN `Estado` VARCHAR(11), IN `Sexo` VARCHAR(11), IN `v1` VARCHAR(150), IN `v2` VARCHAR(150), IN `v3` VARCHAR(150), IN `v4` VARCHAR(150), IN `tipoCampo` VARCHAR(150), IN `valorCampo` VARCHAR(150), IN `Dosis` VARCHAR(150), IN `Num` VARCHAR(150), IN `Diag` VARCHAR(11), IN `Medico` VARCHAR(11), IN `Tratamiento` VARCHAR(150), IN `Observacion` TEXT, IN `r1` VARCHAR(11), IN `r2` VARCHAR(11), IN `r3` VARCHAR(11), IN `r4` VARCHAR(11), IN `r5` VARCHAR(11), IN `r6` VARCHAR(11), IN `r7` VARCHAR(11), IN `r8` VARCHAR(11), IN `idGrupo` VARCHAR(11), IN `idSeguimiento` VARCHAR(11))  NO SQL
BEGIN 


if(tipoGeneral="OPCION")THEN 

    if(tipoOpcion="2")THEN 


    INSERT INTO `tab_resultado_ficha`(`idResultadoFicha`, `Seguimiento_idSeguimiento`, `Opcion_Opcion`, `Especialidad_idEspecialidad`, `TipoOpcion`, `Propiedades`, `RespuestaTexto`, `RespuestaValor`, `RespuestaFecha`, `RespuestaAdecuado`, `TipoListado`,`Grupo_idGrupo`,`fechaRegistro`) VALUES (NULL,idSeguimiento,id,NULL,2,NULL,campo,NULL,NULL,NULL,NULL,idGrupo,NOW());

    ELSEIF(tipoOpcion="3") THEN 

    INSERT INTO `tab_resultado_ficha`(`idResultadoFicha`, `Seguimiento_idSeguimiento`, `Opcion_Opcion`, `Especialidad_idEspecialidad`, `TipoOpcion`, `Propiedades`, `RespuestaTexto`, `RespuestaValor`, `RespuestaFecha`, `RespuestaAdecuado`, `TipoListado`,`Grupo_idGrupo`,`fechaRegistro`) VALUES (NULL,idSeguimiento,id,NULL,3,NULL,NULL,Respuesta,NULL,Estado,NULL,idGrupo,NOW()); 
 
  ELSEIF(tipoOpcion="4")THEN    
  
    SET @propiedades=(CONCAT('{"Sexo":',Sexo,'}'));

    INSERT INTO `tab_resultado_ficha`(`idResultadoFicha`, `Seguimiento_idSeguimiento`, `Opcion_Opcion`, `Especialidad_idEspecialidad`, `TipoOpcion`, `Propiedades`, `RespuestaTexto`, `RespuestaValor`, `RespuestaFecha`, `RespuestaAdecuado`, `TipoListado`,`Grupo_idGrupo`,`fechaRegistro`) VALUES (NULL,idSeguimiento,id,NULL,4,@propiedades,NULL,Respuesta,NULL,Estado,NULL,idGrupo,NOW()); 

    ELSEIF(tipoOpcion="5")THEN 

    SET @Fecha=(DATE_FORMAT(campo,"%Y-%m-%d")); 
    INSERT INTO `tab_resultado_ficha`(`idResultadoFicha`, `Seguimiento_idSeguimiento`, `Opcion_Opcion`, `Especialidad_idEspecialidad`, `TipoOpcion`, `Propiedades`, `RespuestaTexto`, `RespuestaValor`, `RespuestaFecha`, `RespuestaAdecuado`, `TipoListado`, `Grupo_idGrupo`,`fechaRegistro`) VALUES (NULL,idSeguimiento,id,NULL,5,NULL,NULL,NULL,@Fecha,NULL,NULL,idGrupo,NOW()); 

    ELSEIF(tipoOpcion="6")THEN 
    
    if(v1="")then
    SET v1=0;
    end if;
     if(v2="")then
    SET v2=0;
    end if;
     if(v3="")then
    SET v3=0;
    end if;
     if(v4="")then
    SET v4=0;
    end if;
    SET @propiedades=(CONCAT('{"v1":',v1,',"v2":',v2,',"v3":',v3,',"v4":',v4,'}'));


    INSERT INTO `tab_resultado_ficha`(`idResultadoFicha`, `Seguimiento_idSeguimiento`, `Opcion_Opcion`, `Especialidad_idEspecialidad`, `TipoOpcion`, `Propiedades`, `RespuestaTexto`, `RespuestaValor`, `RespuestaFecha`, `RespuestaAdecuado`, `TipoListado`,`Grupo_idGrupo`,`fechaRegistro`) VALUES (NULL,idSeguimiento,id,NULL,6,@propiedades,NULL,Respuesta,NULL,NULL,NULL,idGrupo,NOW());   

    ELSEIF(tipoOpcion="7")THEN 


    INSERT INTO `tab_resultado_ficha`(`idResultadoFicha`, `Seguimiento_idSeguimiento`, `Opcion_Opcion`, `Especialidad_idEspecialidad`, `TipoOpcion`, `Propiedades`, `RespuestaTexto`, `RespuestaValor`, `RespuestaFecha`, `RespuestaAdecuado`, `TipoListado`,`Grupo_idGrupo`,`fechaRegistro`) VALUES (NULL,idSeguimiento,id,NULL,7,NULL,NULL,NULL,NULL,Estado,NULL,idGrupo,NOW()); 

    ELSEIF(tipoOpcion="9")THEN 

     if(tipoCampo="")then
        SET tipoCampo=0;
        end if;

     if(valorCampo="")then
    SET valorCampo=0;
    end if;
    
     if(Dosis="")then
    SET Dosis=0;
    end if;
    
    if(Num="")then
    SET Num=0;
    end if;  
    
    SET @propiedades=(CONCAT('{"tipocampo":"',tipoCampo,'","valorCampo":"',valorCampo,'","Dosis":"',Dosis,'","Num":"',Num,'"}'));  

    INSERT INTO `tab_resultado_ficha`(`idResultadoFicha`, `Seguimiento_idSeguimiento`, `Opcion_Opcion`, `Especialidad_idEspecialidad`, `TipoOpcion`, `Propiedades`, `RespuestaTexto`, `RespuestaValor`, `RespuestaFecha`, `RespuestaAdecuado`, `TipoListado`, `Grupo_idGrupo`,`fechaRegistro`) VALUES (NULL,idSeguimiento,id,NULL,9,@propiedades,NULL,NULL,NULL,Estado,NULL,idGrupo,NOW());   

 ELSEIF(tipoOpcion="11")THEN 

     if(tipoCampo="")then
        SET tipoCampo=0;
        end if;

     if(valorCampo="")then
    SET valorCampo=0;
    end if;
    
     if(Dosis="")then
    SET Dosis=0;
    end if;
    
    if(Num="")then
    SET Num=0;
    end if;  
    
    SET @propiedades=(CONCAT('{"tipocampo":"',tipoCampo,'","valorCampo":"',valorCampo,'","Dosis":"',Dosis,'","Num":"',Num,'"}'));  

    INSERT INTO `tab_resultado_ficha`(`idResultadoFicha`, `Seguimiento_idSeguimiento`, `Opcion_Opcion`, `Especialidad_idEspecialidad`, `TipoOpcion`, `Propiedades`, `RespuestaTexto`, `RespuestaValor`, `RespuestaFecha`, `RespuestaAdecuado`, `TipoListado`, `Grupo_idGrupo`,`fechaRegistro`) VALUES (NULL,idSeguimiento,id,NULL,11,@propiedades,NULL,NULL,NULL,NULL,NULL,idGrupo,NOW());   
  

    END IF;

ELSEIF(tipoGeneral="ESPECIALIDAD")THEN

		  
    if(Diag="")then
    SET Diag=0;
    end if;  
     if(Medico="")then
    SET Medico=0;
    end if; 
    if(Tratamiento="")then
    SET Tratamiento=0;
    end if;  
    if(Observacion="")then
    SET Observacion=0;
    end if;     
    
    SET @propiedades=(CONCAT('{"Diagnostico":"',Diag,'","Medico":"',Medico,'","Tratamiento":"',Tratamiento,'","Observacion":"',Observacion,'"}'));  

    INSERT INTO `tab_resultado_ficha`(`idResultadoFicha`, `Seguimiento_idSeguimiento`, `Opcion_Opcion`, `Especialidad_idEspecialidad`, `TipoOpcion`, `Propiedades`, `RespuestaTexto`, `RespuestaValor`, `RespuestaFecha`, `RespuestaAdecuado`, `TipoListado`,`Grupo_idGrupo`,`fechaRegistro`) VALUES (NULL,idSeguimiento,NULL,id,NULL,@propiedades,NULL,NULL,NULL,Estado,NULL,NULL,NOW());   

ELSEIF(tipoGeneral="PIE")THEN 

    INSERT INTO `tab_resultado_pie`(`idResultadoPie`, `Seguimiento_idSeguimiento`, `R1`, `R2`, `R3`, `R4`, `R5`, `R6`, `R7`, `R8`) VALUES (NULL,idSeguimiento,r1,r2,r3,r4,r5,r6,r7,r8);

ELSEIF(tipoGeneral="REFIERE")THEN 

   INSERT INTO `tab_extra`(`idExtra`, `Refiere`, `Riesgo`, `Seguimiento_idSeguimiento`) VALUES (NULL,Respuesta,campo,idSeguimiento);
   
END IF;

END$$

DROP PROCEDURE IF EXISTS `SP_REGISTRO_SEGUIMIENTO`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRO_SEGUIMIENTO` (IN `idPaciente` INT(11), IN `idAno` INT(11), IN `idMes` INT(11))  NO SQL
BEGIN

DECLARE CODIGO VARCHAR(150);
DECLARE ID INT(11);

SET @Contador=(SELECT COUNT(*) FROM tab_seguimiento);

SET @Contador=(@Contador+1);
SET CODIGO=(CONCAT("SEG-",@Contador));

INSERT INTO `tab_seguimiento`(`idSeguimiento`, `Codigo`, `Year`, `Mes`, `Paciente_idPaciente`,`fechaRegistro`) VALUES (null,CODIGO,idAno,idMes,idPaciente,NOW());

SET ID=(LAST_INSERT_ID());

SELECT ID;               

END$$

DROP PROCEDURE IF EXISTS `SP_REPORTE_GENERAL`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REPORTE_GENERAL` (IN `year` INT(11), IN `mes` INT(11))  NO SQL
BEGIN 
DECLARE TotalPaciente INT(11);
DECLARE TotalPacienteFemenino INT(11);
DECLARE TotalPacienteMasculino INT(11);

DECLARE CantidadHgSI DECIMAL(20,2);
DECLARE CantidadHgNO DECIMAL(20,2);

DECLARE PorcentajeHgCon DECIMAL(20,2);
DECLARE PorcentajeHgSin DECIMAL(20,2);

DECLARE totalColesterolSI DECIMAL(20,2);
DECLARE totalColesterolNO DECIMAL(20,2);

DECLARE totalHDLSI DECIMAL(20,2);
DECLARE totalHDLNO DECIMAL(20,2);

DECLARE totalLDLSI DECIMAL(20,2);
DECLARE totalLDLNO DECIMAL(20,2);

DECLARE totalIMCSI DECIMAL(20,2);
DECLARE totalIMCNO DECIMAL(20,2);

/* ------------------------------- */
DECLARE tallerGLUCSI DECIMAL(20,3);
DECLARE tallerGLUCNO DECIMAL(20,3);

DECLARE tallerNUTSI DECIMAL(20,3);
DECLARE tallerNUTNO DECIMAL(20,3);

DECLARE tallerDIASI DECIMAL(20,3);
DECLARE tallerDIANO DECIMAL(20,3);

DECLARE tallerINSSI DECIMAL(20,3);
DECLARE tallerINSNO DECIMAL(20,3);

DECLARE tallerPODSI DECIMAL(20,3);
DECLARE tallerPODNO DECIMAL(20,3);

DECLARE tallerPSISI DECIMAL(20,3);
DECLARE tallerPSINO DECIMAL(20,3);

DECLARE totalFichasGeneral DECIMAL(20,3);
DECLARE totalFichasYear DECIMAL(20,3);

DECLARE totalMedico DECIMAL(20,3);  

SET TotalPaciente=(SELECT COUNT(*) FROM tab_paciente);

SET CantidadHgSI=(SELECT COUNT(IF((SELECT resu.RespuestaAdecuado FROM tab_seguimiento seg inner join tab_resultado_ficha resu on resu.Seguimiento_idSeguimiento=seg.idSeguimiento where seg.Paciente_idPaciente=pa.idPaciente and seg.Year=year and resu.Opcion_Opcion=8 and seg.Mes=mes ORDER BY resu.idResultadoFicha DESC LIMIT 1)=1,1,NULL)) as Estado FROM tab_paciente pa);  

SET CantidadHgNO=(SELECT COUNT(IF((SELECT resu.RespuestaAdecuado FROM tab_seguimiento seg inner join tab_resultado_ficha resu on resu.Seguimiento_idSeguimiento=seg.idSeguimiento where seg.Paciente_idPaciente=pa.idPaciente and seg.Year=year and resu.Opcion_Opcion=8 and seg.Mes=mes ORDER BY resu.idResultadoFicha DESC LIMIT 1)=0,1,NULL)) as Estado FROM tab_paciente pa);  

SET PorcentajeHgCon=(ROUND((CantidadHgSI*100)/TotalPaciente,2));
SET PorcentajeHgSin=(ROUND((CantidadHgNO*100)/TotalPaciente,2));


SET totalColesterolSI=(SELECT COUNT(IF((SELECT resu.RespuestaAdecuado FROM tab_seguimiento seg inner join tab_resultado_ficha resu on resu.Seguimiento_idSeguimiento=seg.idSeguimiento where seg.Paciente_idPaciente=pa.idPaciente and seg.Year=year and resu.Opcion_Opcion=9 and seg.Mes=mes ORDER BY resu.idResultadoFicha DESC LIMIT 1)=1,1,NULL)) as Estado FROM tab_paciente pa);

SET totalColesterolNO=(SELECT COUNT(IF((SELECT resu.RespuestaAdecuado FROM tab_seguimiento seg inner join tab_resultado_ficha resu on resu.Seguimiento_idSeguimiento=seg.idSeguimiento where seg.Paciente_idPaciente=pa.idPaciente and seg.Year=year and resu.Opcion_Opcion=9 and seg.Mes=mes ORDER BY resu.idResultadoFicha DESC LIMIT 1)=0,1,NULL)) as Estado FROM tab_paciente pa); 

SET totalHDLSI=(SELECT COUNT(IF((SELECT resu.RespuestaAdecuado FROM tab_seguimiento seg inner join tab_resultado_ficha resu on resu.Seguimiento_idSeguimiento=seg.idSeguimiento where seg.Paciente_idPaciente=pa.idPaciente and seg.Year=year and resu.Opcion_Opcion=10 and seg.Mes=mes ORDER BY resu.idResultadoFicha DESC LIMIT 1)=1,1,NULL)) as Estado FROM tab_paciente pa);

SET totalHDLNO=(SELECT COUNT(IF((SELECT resu.RespuestaAdecuado FROM tab_seguimiento seg inner join tab_resultado_ficha resu on resu.Seguimiento_idSeguimiento=seg.idSeguimiento where seg.Paciente_idPaciente=pa.idPaciente and seg.Year=year and resu.Opcion_Opcion=10 and seg.Mes=mes ORDER BY resu.idResultadoFicha DESC LIMIT 1)=0,1,NULL)) as Estado FROM tab_paciente pa);

SET totalLDLSI=(SELECT COUNT(IF((SELECT resu.RespuestaAdecuado FROM tab_seguimiento seg inner join tab_resultado_ficha resu on resu.Seguimiento_idSeguimiento=seg.idSeguimiento where seg.Paciente_idPaciente=pa.idPaciente and seg.Year=year and resu.Opcion_Opcion=11 and seg.Mes=mes ORDER BY resu.idResultadoFicha DESC LIMIT 1)=1,1,NULL)) as Estado FROM tab_paciente pa);

SET totalLDLNO=(SELECT COUNT(IF((SELECT resu.RespuestaAdecuado FROM tab_seguimiento seg inner join tab_resultado_ficha resu on resu.Seguimiento_idSeguimiento=seg.idSeguimiento where seg.Paciente_idPaciente=pa.idPaciente and seg.Year=year and resu.Opcion_Opcion=11 and seg.Mes=mes ORDER BY resu.idResultadoFicha DESC LIMIT 1)=0,1,NULL)) as Estado FROM tab_paciente pa);  
 
SET totalIMCSI=(SELECT COUNT(IF((SELECT resu.RespuestaAdecuado FROM tab_seguimiento seg inner join tab_resultado_ficha resu on resu.Seguimiento_idSeguimiento=seg.idSeguimiento where seg.Paciente_idPaciente=pa.idPaciente and seg.Year=year and resu.Opcion_Opcion=13 and seg.Mes=mes ORDER BY resu.idResultadoFicha DESC LIMIT 1)=1,1,NULL)) as Estado FROM tab_paciente pa);

SET totalIMCNO=(SELECT COUNT(IF((SELECT resu.RespuestaAdecuado FROM tab_seguimiento seg inner join tab_resultado_ficha resu on resu.Seguimiento_idSeguimiento=seg.idSeguimiento where seg.Paciente_idPaciente=pa.idPaciente and seg.Year=year and resu.Opcion_Opcion=13 and seg.Mes=mes ORDER BY resu.idResultadoFicha DESC LIMIT 1)=0,1,NULL)) as Estado FROM tab_paciente pa);


SET tallerGLUCSI=(SELECT COUNT(IF((SELECT resu.RespuestaAdecuado FROM tab_seguimiento seg inner join tab_resultado_ficha resu on resu.Seguimiento_idSeguimiento=seg.idSeguimiento where seg.Paciente_idPaciente=pa.idPaciente and seg.Year=year and resu.Opcion_Opcion=90 and seg.Mes=mes ORDER BY resu.idResultadoFicha DESC LIMIT 1)=1,1,NULL)) as Estado FROM tab_paciente pa);

SET tallerGLUCNO=(SELECT COUNT(IF((SELECT resu.RespuestaAdecuado FROM tab_seguimiento seg inner join tab_resultado_ficha resu on resu.Seguimiento_idSeguimiento=seg.idSeguimiento where seg.Paciente_idPaciente=pa.idPaciente and seg.Year=year and resu.Opcion_Opcion=90 and seg.Mes=mes ORDER BY resu.idResultadoFicha DESC LIMIT 1)=0,1,NULL)) as Estado FROM tab_paciente pa); 

SET tallerNUTSI=(SELECT COUNT(IF((SELECT resu.RespuestaAdecuado FROM tab_seguimiento seg inner join tab_resultado_ficha resu on resu.Seguimiento_idSeguimiento=seg.idSeguimiento where seg.Paciente_idPaciente=pa.idPaciente and seg.Year=year and resu.Opcion_Opcion=91 and seg.Mes=mes ORDER BY resu.idResultadoFicha DESC LIMIT 1)=1,1,NULL)) as Estado FROM tab_paciente pa);

SET tallerNUTNO=(SELECT COUNT(IF((SELECT resu.RespuestaAdecuado FROM tab_seguimiento seg inner join tab_resultado_ficha resu on resu.Seguimiento_idSeguimiento=seg.idSeguimiento where seg.Paciente_idPaciente=pa.idPaciente and seg.Year=year and resu.Opcion_Opcion=91 and seg.Mes=mes ORDER BY resu.idResultadoFicha DESC LIMIT 1)=0,1,NULL)) as Estado FROM tab_paciente pa); 

SET tallerDIASI=(SELECT COUNT(IF((SELECT resu.RespuestaAdecuado FROM tab_seguimiento seg inner join tab_resultado_ficha resu on resu.Seguimiento_idSeguimiento=seg.idSeguimiento where seg.Paciente_idPaciente=pa.idPaciente and seg.Year=year and resu.Opcion_Opcion=92 and seg.Mes=mes ORDER BY resu.idResultadoFicha DESC LIMIT 1)=1,1,NULL)) as Estado FROM tab_paciente pa);

SET tallerDIANO=(SELECT COUNT(IF((SELECT resu.RespuestaAdecuado FROM tab_seguimiento seg inner join tab_resultado_ficha resu on resu.Seguimiento_idSeguimiento=seg.idSeguimiento where seg.Paciente_idPaciente=pa.idPaciente and seg.Year=year and resu.Opcion_Opcion=92 and seg.Mes=mes ORDER BY resu.idResultadoFicha DESC LIMIT 1)=0,1,NULL)) as Estado FROM tab_paciente pa); 

SET tallerINSSI=(SELECT COUNT(IF((SELECT resu.RespuestaAdecuado FROM tab_seguimiento seg inner join tab_resultado_ficha resu on resu.Seguimiento_idSeguimiento=seg.idSeguimiento where seg.Paciente_idPaciente=pa.idPaciente and seg.Year=year and resu.Opcion_Opcion=93 and seg.Mes=mes ORDER BY resu.idResultadoFicha DESC LIMIT 1)=1,1,NULL)) as Estado FROM tab_paciente pa);

SET tallerINSNO=(SELECT COUNT(IF((SELECT resu.RespuestaAdecuado FROM tab_seguimiento seg inner join tab_resultado_ficha resu on resu.Seguimiento_idSeguimiento=seg.idSeguimiento where seg.Paciente_idPaciente=pa.idPaciente and seg.Year=year and resu.Opcion_Opcion=93 and seg.Mes=mes ORDER BY resu.idResultadoFicha DESC LIMIT 1)=0,1,NULL)) as Estado FROM tab_paciente pa);   

SET tallerPODSI=(SELECT COUNT(IF((SELECT resu.RespuestaAdecuado FROM tab_seguimiento seg inner join tab_resultado_ficha resu on resu.Seguimiento_idSeguimiento=seg.idSeguimiento where seg.Paciente_idPaciente=pa.idPaciente and seg.Year=year and resu.Opcion_Opcion=94 and seg.Mes=mes ORDER BY resu.idResultadoFicha DESC LIMIT 1)=1,1,NULL)) as Estado FROM tab_paciente pa);

SET tallerPODNO=(SELECT COUNT(IF((SELECT resu.RespuestaAdecuado FROM tab_seguimiento seg inner join tab_resultado_ficha resu on resu.Seguimiento_idSeguimiento=seg.idSeguimiento where seg.Paciente_idPaciente=pa.idPaciente and seg.Year=year and resu.Opcion_Opcion=94 and seg.Mes=mes ORDER BY resu.idResultadoFicha DESC LIMIT 1)=0,1,NULL)) as Estado FROM tab_paciente pa);  

SET tallerPSISI=(SELECT COUNT(IF((SELECT resu.RespuestaAdecuado FROM tab_seguimiento seg inner join tab_resultado_ficha resu on resu.Seguimiento_idSeguimiento=seg.idSeguimiento where seg.Paciente_idPaciente=pa.idPaciente and seg.Year=year and resu.Opcion_Opcion=95 and seg.Mes=mes ORDER BY resu.idResultadoFicha DESC LIMIT 1)=1,1,NULL)) as Estado FROM tab_paciente pa);

SET tallerPSINO=(SELECT COUNT(IF((SELECT resu.RespuestaAdecuado FROM tab_seguimiento seg inner join tab_resultado_ficha resu on resu.Seguimiento_idSeguimiento=seg.idSeguimiento where seg.Paciente_idPaciente=pa.idPaciente and seg.Year=year and resu.Opcion_Opcion=95 and seg.Mes=mes ORDER BY resu.idResultadoFicha DESC LIMIT 1)=0,1,NULL)) as Estado FROM tab_paciente pa);   

SET totalFichasGeneral=(SELECT COUNT(*) FROM tab_seguimiento);

SET totalFichasYear=(SELECT COUNT(*) FROM tab_seguimiento seg where seg.Year=year);  

SET totalMedico=(SELECT COUNT(*) FROM tab_medico);

SET TotalPacienteMasculino=(SELECT COUNT(*) FROM tab_paciente pa where pa.Sexo_idSexo=1);
SET TotalPacienteFemenino=(SELECT COUNT(*) FROM tab_paciente pa where pa.Sexo_idSexo=2);
 
  
SELECT totalFichasGeneral,totalFichasYear,TotalPaciente,TotalPacienteMasculino,
TotalPacienteFemenino,totalMedico,CantidadHgSI,CantidadHgNO,PorcentajeHgCon,PorcentajeHgSin,totalColesterolSI,totalColesterolNO,totalHDLSI,totalHDLNO,totalLDLSI,totalLDLNO,totalIMCSI,totalIMCNO,tallerGLUCSI,tallerGLUCNO,tallerNUTSI,tallerNUTNO,tallerDIASI,tallerDIANO,tallerINSSI,tallerINSNO,tallerPODSI,tallerPODNO,tallerPSISI,tallerPSINO;
END$$

DROP PROCEDURE IF EXISTS `SP_USUARIO_ACTUALIZAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_USUARIO_ACTUALIZAR` (IN `usuario` VARCHAR(50), IN `pass` TEXT, IN `idPerfil` INT(11), IN `idEstado` INT(11), IN `idUsuarioU` INT(11), IN `idCreador` INT(11))  NO SQL
BEGIN

DECLARE Mensaje VARCHAR(100);

-- ACTUALIZAR USUARIO
if(pass='0')then

UPDATE `usuario` SET 		`user`=usuario,`Perfil_idPerfil`=idPerfil,`Estado_idEstado`=idEstado WHERE  `idUsuario`= idUsuarioU;
set Mensaje="SE ACTUALIZO EL USUARIO:";

else

UPDATE `usuario` SET 		`user`=usuario,`password`=pass,`Perfil_idPerfil`=idPerfil,`Estado_idEstado`=idEstado WHERE  `idUsuario`= idUsuarioU;
set Mensaje="SE ACTUALIZO EL USUARIO:";
end if;



-- REGISTRAR BITACORA
SET @NombreUsuario=(SELECT concat(p.nombrePersona,' ',p.apellidoPaterno,' ',p.apellidoMaterno) as NombresPersona FROM usuario u inner join persona p ON p.idPersona=u.Persona_idPersona WHERE u.idUsuario=idCreador);

INSERT INTO `bitacora`(`idBitacora`, `usuarioAccion`, `Accion`, `tablaAccion`,`Detalle`, `fechaRegistro`) VALUES (null,@NombreUsuario,'ACTUALIZACION','USUARIO',CONCAT(Mensaje,usuario),NOW());



END$$

DROP PROCEDURE IF EXISTS `SP_USUARIO_HABILITACION`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_USUARIO_HABILITACION` (IN `idUsuarioE` INT(11), IN `codigo` INT(11), IN `idUsuarioM` INT(11))  NO SQL
BEGIN

SET @NombreUsuario=(SELECT concat(p.nombrePersona,' ',p.apellidoPaterno,' ',p.apellidoMaterno) as NombresPersona FROM usuario u inner join persona p ON p.idPersona=u.Persona_idPersona WHERE u.idUsuario=idUsuarioM);


if (codigo=1) then
 	UPDATE `usuario` SET  `Estado_idEstado`=4 WHERE `idUsuario`=idUsuarioE;
  SET @Mensaje=("USUARIO DESHBILITADO");
else
    UPDATE `usuario` SET  `Estado_idEstado`=1  WHERE `idUsuario`=idUsuarioE;
 SET  @Mensaje=("USAURIO HABILITADO");
end if;

 /* ------ REGISTRO DE BITACORA ------ */

set @usuario=(SELECT u.user FROM usuario u  WHERE u.idUsuario=idUsuarioE);

INSERT INTO `bitacora`(`idBitacora`, `usuarioAccion`, `Accion`, `tablaAccion`,`Detalle`, `fechaRegistro`) VALUES (null,@usuario,@Mensaje,'USUARIO',CONCAT("SE",@Mensaje," :", @NombreUsuario),NOW());

END$$

DROP PROCEDURE IF EXISTS `SP_USUARIO_LISTAR_TODO`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_USUARIO_LISTAR_TODO` ()  NO SQL
BEGIN

SELECT
u.idUsuario,
u.usuario,
DATE_FORMAT(u.fechaRegistro,'%d/%m/%Y') as fechaRegistro,
CONCAT(pes.nombrePersona,' ',pes.apellidoPaterno,' ',pes.apellidoMaterno) as NombrePersona,
e.nombreEstado,
e.idEstado as Estado_idEstado,
per.nombrePerfil
FROM usuario u INNER JOIN estado e ON e.idEstado=u.Estado_idEstado INNER JOIN perfil per ON per.idPerfil=u.Perfil_idPerfil INNER JOIN persona pes ON pes.idPersona=u.Persona_idPersona;

END$$

DROP PROCEDURE IF EXISTS `SP_USUARIO_RECUPERAR`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_USUARIO_RECUPERAR` (IN `idUsuarioE` INT)  NO SQL
BEGIN


SELECT * FROM usuario u WHERE u.idUsuario=idUsuarioE;


END$$

DROP PROCEDURE IF EXISTS `SP_USUARIO_REGISTRO`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_USUARIO_REGISTRO` (IN `usuario` VARCHAR(50), IN `pass` TEXT, IN `idPerfil` INT(11), IN `idPersona` INT(11), IN `idEstado` INT(11), IN `idCreador` INT(11))  NO SQL
BEGIN

DECLARE Mensaje VARCHAR(100);

-- REGISTRO USUARIO --
INSERT INTO `usuario`(`usuario`, `pass`, `Perfil_idPerfil`, `Persona_idPersona`, `Estado_idEstado`, `fechaRegistro`) VALUES (usuario,pass,idPerfil,idPersona,idEstado,NOW());

set Mensaje="SE REGISTRO EL USUARIO:";


-- REGISTRAR BITACORA
SET @NombreUsuario=(SELECT concat(p.nombrePersona,' ',p.apellidoPaterno,' ',p.apellidoMaterno) as NombresPersona FROM usuario u inner join persona p ON p.idPersona=u.Persona_idPersona WHERE u.idUsuario=idCreador);

INSERT INTO `bitacora`(`idBitacora`, `usuarioAccion`, `Accion`, `tablaAccion`,`Detalle`, `fechaRegistro`) VALUES (null,@NombreUsuario,'REGISTRO','USUARIO',CONCAT(Mensaje,usuario),NOW());

END$$

--
-- Funciones
--
DROP FUNCTION IF EXISTS `FU_RECUPERAR_MES`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `FU_RECUPERAR_MES` (`mes` INT(11)) RETURNS VARCHAR(100) CHARSET latin1 NO SQL
BEGIN 

DECLARE mes_regreso VARCHAR(100);

IF(mes=1)THEN
SET mes_regreso="ENERO";
ELSEIF(mes=2)THEN
SET mes_regreso="FEBRERO";
ELSEIF(mes=3)THEN
SET mes_regreso="MARZO";
ELSEIF(mes=4)THEN
SET mes_regreso="ABRIL";
ELSEIF(mes=5)THEN
SET mes_regreso="MAYO";
ELSEIF(mes=6)THEN
SET mes_regreso="JUNIO";
ELSEIF(mes=7)THEN
SET mes_regreso="JULIO";
ELSEIF(mes=8)THEN
SET mes_regreso="AGOSTO";
ELSEIF(mes=9)THEN
SET mes_regreso="SEPTIEMBRE";
ELSEIF(mes=10)THEN
SET mes_regreso="OCTUBRE";
ELSEIF(mes=11)THEN
SET mes_regreso="NOVIEMBRE";
ELSEIF(mes=12)THEN
SET mes_regreso="DICIEMBRE";
END IF;

RETURN mes_regreso;

END$$

DROP FUNCTION IF EXISTS `FU_VALIDAR_DATE`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `FU_VALIDAR_DATE` (`valor` VARCHAR(150)) RETURNS DATE NO SQL
BEGIN 

DECLARE OUT_vALOR DATE;

if(valor="-1" or valor="2000-01-01")THEN
SET OUT_vALOR=NULL;
ELSE
SET OUT_vALOR=valor;
END IF;

RETURN OUT_VALOR;
END$$

DROP FUNCTION IF EXISTS `FU_VALIDAR_DATETIME`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `FU_VALIDAR_DATETIME` (`valor` VARCHAR(150)) RETURNS DATETIME NO SQL
BEGIN 

DECLARE OUT_vALOR DATETIME;

if(valor="-1")THEN
SET OUT_vALOR=NULL;
ELSE
SET OUT_vALOR=valor;
END IF;

RETURN OUT_VALOR;
END$$

DROP FUNCTION IF EXISTS `FU_VALIDAR_INT`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `FU_VALIDAR_INT` (`valor` INT(11)) RETURNS INT(11) NO SQL
BEGIN 

DECLARE OUT_vALOR INT(11);

if(valor="-1")THEN
SET OUT_vALOR=NULL;
ELSE
SET OUT_vALOR=valor;
END IF;

RETURN OUT_VALOR;
END$$

DROP FUNCTION IF EXISTS `FU_VALIDAR_TEXT`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `FU_VALIDAR_TEXT` (`valor` TEXT) RETURNS TEXT CHARSET latin1 NO SQL
BEGIN 

DECLARE OUT_vALOR TEXT;

if(valor="-1")THEN
SET OUT_vALOR=NULL;
ELSE
SET OUT_vALOR=valor;
END IF;

RETURN OUT_VALOR;
END$$

DROP FUNCTION IF EXISTS `FU_VALIDAR_VARCHAR`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `FU_VALIDAR_VARCHAR` (`valor` VARCHAR(150)) RETURNS VARCHAR(200) CHARSET latin1 NO SQL
BEGIN 

DECLARE OUT_vALOR VARCHAR(200);

if(valor="-1")THEN
SET OUT_vALOR=NULL;
ELSE
SET OUT_vALOR=valor;
END IF;

RETURN OUT_VALOR;
END$$

DROP FUNCTION IF EXISTS `FU_VALIRDAR_CHAR`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `FU_VALIRDAR_CHAR` (`valor` CHAR(20)) RETURNS CHAR(20) CHARSET latin1 NO SQL
BEGIN 

DECLARE OUT_vALOR CHAR(20);

if(valor="-1")THEN
SET OUT_vALOR=NULL;
ELSE
SET OUT_vALOR=valor;
END IF;

RETURN OUT_VALOR;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

DROP TABLE IF EXISTS `bitacora`;
CREATE TABLE IF NOT EXISTS `bitacora` (
  `idBitacora` int(11) NOT NULL AUTO_INCREMENT,
  `usuarioAccion` varchar(100) NOT NULL,
  `Accion` varchar(100) NOT NULL,
  `tablaAccion` varchar(100) NOT NULL,
  `Detalle` text NOT NULL,
  `fechaRegistro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idBitacora`)
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`idBitacora`, `usuarioAccion`, `Accion`, `tablaAccion`, `Detalle`, `fechaRegistro`) VALUES
(1, 'JESUS INCA CARDENAS', 'INSERTAR', 'USUARIO', 'SE REGISTRO EL USUARIO:admin3', '2018-09-29 19:53:29'),
(2, 'JESUS INCA CARDENAS', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:usuaricambia', '2018-09-29 19:56:41'),
(3, 'JESUS INCA CARDENAS', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba', '2018-09-29 20:00:24'),
(4, 'JESUS INCA CARDENAS', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:nuevo', '2018-09-29 20:01:47'),
(5, 'JESUS INCA CARDENAS', 'USUARIO DESHBILITADO', 'USUARIO', 'SEUSUARIO DESHBILITADO :admin', '2018-10-03 00:56:59'),
(6, 'JESUS INCA CARDENAS', 'USUARIO DESHBILITADO', 'USUARIO', 'SEUSUARIO DESHBILITADO :admin', '2018-10-03 01:04:58'),
(7, 'JESUS INCA CARDENAS', 'USAURIO HABILITADO', 'USUARIO', 'SEUSAURIO HABILITADO :admin', '2018-10-03 01:09:40'),
(8, 'JESUS INCA CARDENAS', 'USUARIO DESHBILITADO', 'USUARIO', 'SEUSUARIO DESHBILITADO :admin', '2018-10-03 01:09:44'),
(9, 'JESUS INCA CARDENAS', 'USAURIO HABILITADO', 'USUARIO', 'SEUSAURIO HABILITADO :admin', '2018-10-03 01:09:47'),
(10, 'JESUS INCA CARDENAS', 'ACTUALIZO', 'USUARIO', 'SE REGISTRO EL USUARIO:wdqw', '2018-10-03 02:00:09'),
(11, 'MAJE SILVA SILVA', 'ACTUALIZO', 'USUARIO', 'SE REGISTRO EL USUARIO:msilva', '2018-10-04 13:29:08'),
(12, 'MAJE SILVA SILVA', 'ACTUALIZO', 'USUARIO', 'SE REGISTRO EL USUARIO:JLOPEZ', '2018-10-04 13:35:15'),
(13, 'MAJE SILVA SILVA', 'USUARIO DESHBILITADO', 'USUARIO', 'SEUSUARIO DESHBILITADO :JLOPEZ', '2018-10-04 13:35:27'),
(14, 'MAJE SILVA SILVA', 'USAURIO HABILITADO', 'USUARIO', 'SEUSAURIO HABILITADO :JLOPEZ', '2018-10-04 13:35:36'),
(15, 'MAJE SILVA SILVA', 'USUARIO DESHBILITADO', 'USUARIO', 'SEUSUARIO DESHBILITADO :JLOPEZ', '2018-10-04 13:35:40'),
(16, 'MAJE SILVA SILVA', 'USAURIO HABILITADO', 'USUARIO', 'SEUSAURIO HABILITADO :JLOPEZ', '2018-10-04 13:35:42'),
(17, 'MAJE SILVA SILVA', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba', '2018-10-04 16:38:33'),
(18, 'MAJE SILVA SILVA', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:msilva2', '2018-10-04 16:39:27'),
(19, 'MAJE SILVA SILVA', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:admin', '2018-10-04 16:45:08'),
(20, 'MAJE SILVA SILVA', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba2', '2018-10-04 16:45:17'),
(21, 'MAJE SILVA SILVA', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba2', '2018-10-04 16:45:47'),
(22, 'MAJE SILVA SILVA', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba2', '2018-10-04 16:46:08'),
(23, 'MAJE SILVA SILVA', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba3', '2018-10-04 16:47:16'),
(24, 'MAJE SILVA SILVA', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba1', '2018-10-04 16:47:56'),
(25, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba1', '2018-10-04 16:48:23'),
(26, 'JESUS INCA CARDENAS', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba3', '2018-10-04 16:50:18'),
(27, 'JESUS INCA CARDENAS', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba3', '2018-10-04 16:51:20'),
(28, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:admin2', '2018-10-04 16:52:32'),
(29, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba3', '2018-10-04 16:55:17'),
(30, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba3', '2018-10-04 16:55:33'),
(31, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba3', '2018-10-04 16:55:53'),
(32, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba2', '2018-10-04 16:56:02'),
(33, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba2', '2018-10-04 16:56:09'),
(34, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba2', '2018-10-04 16:56:32'),
(35, 'MAJE SILVA SILVA', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba2', '2018-10-04 16:58:27'),
(36, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba2', '2018-10-04 16:59:13'),
(37, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba2', '2018-10-04 17:01:09'),
(38, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba2', '2018-10-04 17:03:37'),
(39, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba2', '2018-10-04 17:04:28'),
(40, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba2', '2018-10-04 17:04:43'),
(41, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba2', '2018-10-04 17:05:07'),
(42, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba2', '2018-10-04 17:05:52'),
(43, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba2', '2018-10-04 17:06:14'),
(44, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba', '2018-10-04 17:07:12'),
(45, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba', '2018-10-04 17:08:37'),
(46, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba', '2018-10-04 17:09:29'),
(47, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba', '2018-10-04 17:10:33'),
(48, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba', '2018-10-04 17:11:14'),
(49, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba', '2018-10-04 17:12:14'),
(50, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba', '2018-10-04 17:12:22'),
(51, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba', '2018-10-04 17:13:03'),
(52, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba', '2018-10-04 17:13:14'),
(53, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba', '2018-10-04 17:14:09'),
(54, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba', '2018-10-04 17:14:50'),
(55, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba', '2018-10-04 17:14:50'),
(56, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba', '2018-10-04 17:15:39'),
(57, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba', '2018-10-04 17:15:47'),
(58, 'JESUS INCA CARDENAS', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba', '2018-10-04 17:17:05'),
(59, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:admin2', '2018-10-04 17:19:14'),
(60, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:admin2', '2018-10-04 17:19:43'),
(61, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:admin2', '2018-10-04 17:22:44'),
(62, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:admin2', '2018-10-04 17:23:08'),
(63, 'LUCIA TABOADA GUZMAN', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:admin2', '2018-10-04 17:24:49'),
(64, 'MAJE SILVA SILVA', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:admin', '2018-10-04 17:29:52'),
(65, 'JESUS INCA CARDENAS', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:admin', '2018-10-04 17:31:53'),
(66, 'MAJE SILVA SILVA', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:admin', '2018-10-04 17:32:14'),
(67, 'MAJE SILVA SILVA', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:admin', '2018-10-04 17:48:50'),
(68, 'MAJE SILVA SILVA', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:admin', '2018-10-04 17:49:27'),
(69, 'MAJE SILVA SILVA', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:admin', '2018-10-04 17:53:16'),
(70, 'MAJE SILVA SILVA', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:admin', '2018-10-04 17:54:56'),
(71, 'MAJE SILVA SILVA', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:admin', '2018-10-04 17:55:24'),
(72, 'MAJE SILVA SILVA', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:admin', '2018-10-04 17:56:52'),
(73, 'MAJE SILVA SILVA', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:admin', '2018-10-04 18:00:31'),
(74, 'JESUS INCA CARDENAS', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:admin', '2018-10-04 18:03:17'),
(75, 'JESUS INCA CARDENAS', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:admin', '2018-10-04 18:04:41'),
(76, 'JESUS INCA CARDENAS', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:admin', '2018-10-04 18:06:15'),
(77, 'JESUS INCA CARDENAS', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba2', '2018-10-05 10:02:27'),
(78, 'JESUS INCA CARDENAS', 'ACTUALIZO', 'USUARIO', 'SE REGISTRO EL USUARIO:persona', '2018-10-05 10:14:26'),
(79, 'JESUS INCA CARDENAS', 'ACTUALIZO', 'USUARIO', 'SE REGISTRO EL USUARIO:persona2', '2018-10-05 10:16:34'),
(80, 'JESUS INCA CARDENAS', 'ACTUALIZO', 'USUARIO', 'SE REGISTRO EL USUARIO:prueba', '2018-10-05 10:17:48'),
(81, 'JESUS INCA CARDENAS', 'ACTUALIZO', 'USUARIO', 'SE REGISTRO EL USUARIO:prueba1', '2018-10-05 10:18:17'),
(82, 'JESUS INCA CARDENAS', 'ACTUALIZO', 'USUARIO', 'SE ACTUALIZO EL USUARIO:prueba2', '2018-10-05 10:39:30'),
(83, 'JESUS INCA CARDENAS', 'INSERTAR', 'Persona', 'SE REGISTRO PERSONA:jesu werfwe fefwe', '2018-10-05 10:51:36'),
(84, 'JESUS INCA CARDENAS', 'ACTUALIZACION', 'Persona', 'SE ACTUALIZO PERSONA:jesus inca cardenas', '2018-10-05 11:11:11'),
(85, 'JESUS INCA CARDENAS', 'REGISTRO', 'Persona', 'SE REGISTRO PERSONA:wfwefwe werfwef frefwef', '2018-10-05 12:48:34'),
(86, 'JESUS INCA CARDENAS', 'USUARIO DESHBILITADO', 'USUARIO', 'SEUSUARIO DESHBILITADO :admin', '2018-10-05 13:36:40'),
(87, 'JESUS INCA CARDENAS', 'USUARIO DESHBILITADO', 'USUARIO', 'SEUSUARIO DESHBILITADO :admin', '2018-10-05 13:36:46'),
(88, 'admin', 'PERSONA DESHBILITADO', 'USUARIO', 'SEPERSONA DESHBILITADO :JESUS INCA CARDENAS', '2018-10-05 13:38:27'),
(89, 'admin', 'PERSONA HABILITADO', 'USUARIO', 'SEPERSONA HABILITADO :JESUS INCA CARDENAS', '2018-10-05 13:38:30'),
(90, 'admin', 'PERSONA DESHBILITADO', 'USUARIO', 'SEPERSONA DESHBILITADO :JESUS INCA CARDENAS', '2018-10-05 13:38:32'),
(91, 'admin', 'PERSONA DESHBILITADO', 'USUARIO', 'SEPERSONA DESHBILITADO :LUCIA TABOADA GUZMAN', '2018-10-05 13:59:32'),
(92, 'admin', 'PERSONA HABILITADO', 'USUARIO', 'SEPERSONA HABILITADO :JESUS INCA CARDENAS', '2018-10-05 14:00:13'),
(93, 'JESUS23 INCA23 CARDENAS', 'ACTUALIZACION', 'Persona', 'SE ACTUALIZO PERSONA:JESUS23 INCA23 CARDENAS', '2018-10-05 14:42:15'),
(94, 'JESUS233 INCA233 CARDENAS', 'ACTUALIZACION', 'Persona', 'SE ACTUALIZO PERSONA:JESUS233 INCA233 CARDENAS', '2018-10-05 14:43:49'),
(95, 'JESUS23331 INCA23314 CARDENAS', 'ACTUALIZACION', 'Persona', 'SE ACTUALIZO PERSONA:JESUS23331 INCA23314 CARDENAS', '2018-10-05 14:45:17'),
(96, 'JESUS23331 INCA23314 CARDENAS', 'ACTUALIZACION', 'Persona', 'SE ACTUALIZO PERSONA:JESUS23331 INCA23314 CARDENAS', '2018-10-05 14:46:03'),
(97, 'JESUS INCA CARDENAS', 'ACTUALIZACION', 'Persona', 'SE ACTUALIZO PERSONA:JESUS INCA CARDENAS', '2018-10-05 14:48:34'),
(98, 'JESUS2 INCA2 CARDENAS', 'ACTUALIZACION', 'Persona', 'SE ACTUALIZO PERSONA:JESUS2 INCA2 CARDENAS', '2018-10-05 14:49:29'),
(99, 'admin', 'PERSONA DESHBILITADO', 'USUARIO', 'SEPERSONA DESHBILITADO :JESUS2 INCA2 CARDENAS', '2018-10-05 14:49:35'),
(100, 'JESUS2 INCA2 CARDENAS', 'INSERTAR', 'SE REGISTRO PERFIL', 'Perfil', '2018-10-05 15:42:18'),
(101, 'JESUS2 INCA2 CARDENAS', 'INSERTAR', 'SE REGISTRO PERMISOS DE PERFIL', 'Permisos', '2018-10-05 15:42:18'),
(102, 'JESUS2 INCA2 CARDENAS', 'INSERTAR', 'SE REGISTRO PERFIL', 'Perfil', '2018-10-05 15:42:43'),
(103, 'JESUS2 INCA2 CARDENAS', 'INSERTAR', 'SE REGISTRO PERMISOS DE PERFIL', 'Permisos', '2018-10-05 15:42:43'),
(104, 'admin', 'PERSONA DESHBILITADO', 'USUARIO', 'SEPERSONA DESHBILITADO :MAJE SILVA SILVA', '2018-10-05 15:42:51'),
(105, 'admin', 'ACTUALIZACION', 'Perfil', 'SE ACTUALIZO PERFIL:fweefw', '2018-10-05 15:53:04'),
(106, 'admin', 'ACTUALIZACION', 'Perfil', 'SE ACTUALIZO PERFIL:ADMINISTRADOR', '2018-10-05 15:53:22'),
(107, 'admin', 'ACTUALIZACION', 'Perfil', 'SE ACTUALIZO PERFIL:wefwefew', '2018-10-05 15:54:03'),
(108, 'admin', 'ACTUALIZACION', 'Perfil', 'SE ACTUALIZO PERFIL:wfgwf', '2018-10-05 15:54:11'),
(109, 'admin', 'PERSONA DESHBILITADO', 'USUARIO', 'SEPERSONA DESHBILITADO :JESUS2 INCA2 CARDENAS', '2018-10-05 15:56:36'),
(110, 'admin', 'PERSONA DESHBILITADO', 'USUARIO', 'SEPERSONA DESHBILITADO :JESUS2 INCA2 CARDENAS', '2018-10-05 15:56:44'),
(111, 'admin', 'PERFIL DESHBILITADO', 'PERFIL', 'SEPERFIL DESHBILITADO :ADMINISTRADOR', '2018-10-05 16:02:49'),
(112, 'admin', 'PERFIL HABILITADO', 'PERFIL', 'SEPERFIL HABILITADO :ADMINISTRADOR', '2018-10-05 16:03:01'),
(113, 'admin', 'PERFIL HABILITADO', 'PERFIL', 'SEPERFIL HABILITADO :wefwefew', '2018-10-05 16:03:02'),
(114, 'admin', 'PERFIL HABILITADO', 'PERFIL', 'SEPERFIL HABILITADO :wfgwf', '2018-10-05 16:03:05'),
(115, 'JESUS2 INCA2 CARDENAS', 'INSERTAR', 'SE REGISTRO PERFIL', 'Perfil', '2018-11-08 13:25:46'),
(116, 'JESUS2 INCA2 CARDENAS', 'INSERTAR', 'SE REGISTRO PERMISOS DE PERFIL', 'Permisos', '2018-11-08 13:25:46'),
(117, 'admin', 'ACTUALIZACION', 'Perfil', 'SE ACTUALIZO PERFIL:ADMINISTRADOR', '2018-11-08 13:26:10'),
(118, 'JESUS2 INCA2 CARDENAS', 'INSERTAR', 'SE REGISTRO PERFIL', 'Perfil', '2018-11-08 13:26:34'),
(119, 'JESUS2 INCA2 CARDENAS', 'INSERTAR', 'SE REGISTRO PERMISOS DE PERFIL', 'Permisos', '2018-11-08 13:26:34'),
(120, 'JESUS2 INCA2 CARDENAS', 'INSERTAR', 'SE REGISTRO PERFIL', 'Perfil', '2018-11-08 13:27:09'),
(121, 'JESUS2 INCA2 CARDENAS', 'INSERTAR', 'SE REGISTRO PERMISOS DE PERFIL', 'Permisos', '2018-11-08 13:27:09'),
(122, 'JESUS2 INCA2 CARDENAS', 'INSERTAR', 'SE REGISTRO PERFIL', 'Perfil', '2018-11-08 13:27:48'),
(123, 'JESUS2 INCA2 CARDENAS', 'INSERTAR', 'SE REGISTRO PERMISOS DE PERFIL', 'Permisos', '2018-11-08 13:27:48'),
(124, 'JESUS2 INCA2 CARDENAS', 'INSERTAR', 'SE REGISTRO PERFIL', 'Perfil', '2018-11-08 13:28:06'),
(125, 'JESUS2 INCA2 CARDENAS', 'INSERTAR', 'SE REGISTRO PERMISOS DE PERFIL', 'Permisos', '2018-11-08 13:28:06'),
(126, 'admin', 'USAURIO HABILITADO', 'USUARIO', 'SEUSAURIO HABILITADO :JESUS2 INCA2 CARDENAS', '2018-11-08 13:28:18'),
(127, 'admin', 'PERSONA HABILITADO', 'USUARIO', 'SEPERSONA HABILITADO :JESUS2 INCA2 CARDENAS', '2018-11-08 13:29:09'),
(128, 'ADMINISTRADOR GENERAL DEL SISTEMA', 'ACTUALIZACION', 'Persona', 'SE ACTUALIZO PERSONA:ADMINISTRADOR GENERAL DEL SISTEMA', '2018-11-08 13:29:28'),
(129, 'ADMINISTRADOR GENERAL DEL SISTEMA', 'REGISTRO', 'Persona', 'SE REGISTRO PERSONA:JOSE RODRIGO SULCA', '2018-11-08 13:30:27'),
(130, 'ADMINISTRADOR GENERAL DEL SISTEMA', 'REGISTRO', 'Persona', 'SE REGISTRO PERSONA:JORGE ROMAN SULCA', '2018-11-08 13:31:02'),
(131, 'ADMINISTRADOR GENERAL DEL SISTEMA', 'REGISTRO', 'Persona', 'SE REGISTRO PERSONA:feww wef wef', '2018-11-08 14:29:45'),
(132, 'ADMINISTRADOR GENERAL DEL SISTEMA', 'REGISTRO', 'Persona', 'SE REGISTRO PERSONA:wef wef wef', '2018-11-08 14:32:35'),
(133, 'ADMINISTRADOR GENERAL DEL SISTEMA', 'ACTUALIZACION', 'Persona', 'SE ACTUALIZO PERSONA:wef wef wef', '2018-11-08 14:34:19'),
(134, 'ADMINISTRADOR GENERAL DEL SISTEMA', 'REGISTRO', 'Persona', 'SE REGISTRO PERSONA:rger gwefwe gwegw', '2018-11-08 14:34:33'),
(135, 'ADMINISTRADOR GENERAL DEL SISTEMA', 'REGISTRO', 'Persona', 'SE REGISTRO PERSONA:rf f fr', '2018-11-08 14:35:17'),
(136, 'admin', 'MATERIAL DESHABILITADO', 'MATERIAL', 'MATERIAL ACTUALIZAR', '2018-11-08 15:42:18'),
(137, 'admin', 'MATERIAL HABILITADO', 'MATERIAL', 'MATERIAL ACTUALIZAR', '2018-11-08 15:42:21'),
(138, 'admin', 'ACTUALIZACION', 'Material', 'SE ACTUALIZO MATERIAL:PRIMA WOOL - 000236', '2018-11-08 15:42:32'),
(139, 'admin', 'ACTUALIZACION', 'Material', 'SE ACTUALIZO MATERIAL:PRIMA ACRYLIC - 000235', '2018-11-08 15:43:16'),
(140, 'admin', 'ACTUALIZACION', 'Material', 'SE ACTUALIZO MATERIAL:PRIMA COTTON - 000234', '2018-11-08 15:43:23'),
(141, 'ADMINISTRADOR GENERAL DEL SISTEMA', 'REGISTRO', 'USUARIO', 'SE REGISTRO EL USUARIO:agarciaa', '2018-11-08 15:52:43'),
(142, 'ADMINISTRADOR GENERAL DEL SISTEMA', 'REGISTRO', 'USUARIO', 'SE REGISTRO EL USUARIO:jgonzalezc', '2018-11-08 15:54:41'),
(143, 'ADMINISTRADOR GENERAL DEL SISTEMA', 'REGISTRO', 'USUARIO', 'SE REGISTRO EL USUARIO:mrodriguezc', '2018-11-08 15:55:08'),
(144, 'ADMINISTRADOR GENERAL DEL SISTEMA', 'REGISTRO', 'USUARIO', 'SE REGISTRO EL USUARIO:dlopezp', '2018-11-08 15:55:42'),
(145, 'ADMINISTRADOR GENERAL DEL SISTEMA', 'REGISTRO', 'USUARIO', 'SE REGISTRO EL USUARIO:jmartinezs', '2018-11-08 15:56:05'),
(146, 'admin', 'SE ACTUALIZO PERMISOS', 'PERMISOS', 'SE ACTUALIZO PERMISOS DE PERFIL:SUPERVISOR DE ENCONADO', '2018-11-08 16:02:04'),
(147, 'admin', 'SE ACTUALIZO PERMISOS', 'PERMISOS', 'SE ACTUALIZO PERMISOS DE PERFIL:SUPERVISOR DE OVILLADO', '2018-11-08 16:03:13'),
(148, 'admin', 'SE ACTUALIZO PERMISOS', 'PERMISOS', 'SE ACTUALIZO PERMISOS DE PERFIL:SUPERVISOR DE CALIDAD', '2018-11-08 16:03:28'),
(149, 'admin', 'SE ACTUALIZO PERMISOS', 'PERMISOS', 'SE ACTUALIZO PERMISOS DE PERFIL:SUPERVISOR DE TINTORERIA', '2018-11-08 16:03:43'),
(150, 'admin', 'SE ACTUALIZO PERMISOS', 'PERMISOS', 'SE ACTUALIZO PERMISOS DE PERFIL:TRABAJADOR', '2018-11-08 16:03:59'),
(151, 'admin', 'MATERIAL DESHABILITADO', 'MATERIAL', 'MATERIAL ACTUALIZAR', '2018-11-21 01:02:36'),
(152, 'admin', 'MATERIAL DESHABILITADO', 'MATERIAL', 'MATERIAL ACTUALIZAR', '2018-11-21 01:02:38'),
(153, 'admin', 'MATERIAL HABILITADO', 'MATERIAL', 'MATERIAL ACTUALIZAR', '2018-11-21 01:02:40'),
(154, 'admin', 'MATERIAL HABILITADO', 'MATERIAL', 'MATERIAL ACTUALIZAR', '2018-11-21 01:02:42'),
(155, 'admin', 'ACTUALIZACION', 'Material', 'SE ACTUALIZO MATERIAL:ALPACA - 000234', '2018-11-21 01:02:57'),
(156, 'admin', 'ACTUALIZACION', 'Material', 'SE ACTUALIZO MATERIAL:BABY MICROFIBRA - 000235', '2018-11-21 01:03:11'),
(157, 'admin', 'ACTUALIZACION', 'Material', 'SE ACTUALIZO MATERIAL:COTTON WOOL - 000236', '2018-11-21 01:03:23'),
(158, 'ADMINISTRADOR GENERAL DEL SISTEMA', 'INSERTAR', 'SE REGISTRO PERFIL', 'Perfil', '2018-11-21 20:48:11'),
(159, 'ADMINISTRADOR GENERAL DEL SISTEMA', 'INSERTAR', 'SE REGISTRO PERMISOS DE PERFIL', 'Permisos', '2018-11-21 20:48:11'),
(160, 'ADMINISTRADOR GENERAL DEL SISTEMA', 'INSERTAR', 'SE REGISTRO PERFIL', 'Perfil', '2018-11-21 20:48:29'),
(161, 'ADMINISTRADOR GENERAL DEL SISTEMA', 'INSERTAR', 'SE REGISTRO PERMISOS DE PERFIL', 'Permisos', '2018-11-21 20:48:29'),
(162, 'ADMINISTRADOR GENERAL DEL SISTEMA', 'INSERTAR', 'SE REGISTRO PERFIL', 'Perfil', '2018-11-21 20:51:02'),
(163, 'ADMINISTRADOR GENERAL DEL SISTEMA', 'INSERTAR', 'SE REGISTRO PERMISOS DE PERFIL', 'Permisos', '2018-11-21 20:51:02'),
(164, 'admin', 'ACTUALIZACION', 'Perfil', 'SE ACTUALIZO PERFIL:ADMINISTRADOR', '2018-11-21 20:54:22'),
(165, 'admin', 'ACTUALIZACION', 'Perfil', 'SE ACTUALIZO PERFIL:MEDICO', '2018-11-21 20:54:41'),
(166, 'admin', 'ACTUALIZACION', 'Perfil', 'SE ACTUALIZO PERFIL:MEDICO', '2018-11-21 20:58:41'),
(167, 'admin', 'ACTUALIZACION', 'Perfil', 'SE ACTUALIZO PERFIL:MEDICO', '2018-11-21 20:58:52'),
(168, 'ADMINISTRADOR GENERAL DEL SISTEMA', 'REGISTRO', 'USUARIO', 'SE REGISTRO EL USUARIO:agarciaa', '2018-11-21 22:46:32'),
(169, 'ADMINISTRADOR GENERAL DEL SISTEMA', 'REGISTRO', 'USUARIO', 'SE REGISTRO EL USUARIO:jgonzalezc', '2018-11-21 22:46:48'),
(170, 'ADMINISTRADOR GENERAL DEL SISTEMA', 'REGISTRO', 'USUARIO', 'SE REGISTRO EL USUARIO:mrodriguezc', '2018-11-21 22:47:07'),
(171, 'admin', 'PACIENTE DESHABILITADO', 'PACIENTE', 'PACIENTE ACTUALIZAR', '2018-11-22 00:37:30'),
(172, 'admin', 'PACIENTE HABILITADO', 'PACIENTE', 'PACIENTE ACTUALIZAR', '2018-11-22 00:37:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dx`
--

DROP TABLE IF EXISTS `dx`;
CREATE TABLE IF NOT EXISTS `dx` (
  `idDx` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`idDx`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dx`
--

INSERT INTO `dx` (`idDx`, `Descripcion`) VALUES
(1, 'TIPO 1'),
(2, 'TIPO 2'),
(3, 'GESTACIONAL'),
(4, 'SECUNDARIA'),
(5, 'INTOLERANCIA A LA GLUCOSA'),
(6, 'NO CLASIFICADA'),
(7, 'OTRO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

DROP TABLE IF EXISTS `estado`;
CREATE TABLE IF NOT EXISTS `estado` (
  `idEstado` int(11) NOT NULL AUTO_INCREMENT,
  `tipoEstado` tinyint(4) NOT NULL,
  `nombreEstado` varchar(50) NOT NULL,
  PRIMARY KEY (`idEstado`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`idEstado`, `tipoEstado`, `nombreEstado`) VALUES
(1, 1, 'ACTIVO'),
(2, 1, 'INACTIVO'),
(3, 2, 'HABILITADO'),
(4, 2, 'DESHABILITADO'),
(5, 3, 'EN PROCESO - OVILLADO'),
(6, 3, 'EN PROCESO - CALIDAD'),
(7, 3, 'FINALIZADO'),
(8, 3, 'ENVIADO A ENCONADO'),
(9, 3, 'ENVIADO A CALIDAD'),
(10, 3, 'EN PROCESO - ENCONADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `idLogin` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario_idUsuario` int(11) NOT NULL,
  `usuarioLog` varchar(50) NOT NULL,
  `passwordLog` varchar(100) NOT NULL,
  `perfilLog` varchar(150) NOT NULL,
  `fechaLog` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(50) DEFAULT NULL,
  `fechaLogout` datetime DEFAULT NULL,
  PRIMARY KEY (`idLogin`),
  KEY `Usuario_idUsuario` (`Usuario_idUsuario`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`idLogin`, `Usuario_idUsuario`, `usuarioLog`, `passwordLog`, `perfilLog`, `fechaLog`, `ip`, `fechaLogout`) VALUES
(1, 1, 'admin', '$2a$08$RCuzW/8g2Lg4QMNCfmsa/uKp33rvDmdWrC.P40DOECJlMtPu16NMW', 'Administrador', '2018-09-29 14:03:44', '::1', '2019-03-08 16:02:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

DROP TABLE IF EXISTS `perfil`;
CREATE TABLE IF NOT EXISTS `perfil` (
  `idPerfil` int(11) NOT NULL AUTO_INCREMENT,
  `nombrePerfil` varchar(50) NOT NULL,
  `descripcionPerfil` text,
  `Estado_idEstado` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`idPerfil`),
  KEY `FK_Estado` (`Estado_idEstado`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`idPerfil`, `nombrePerfil`, `descripcionPerfil`, `Estado_idEstado`, `fechaRegistro`) VALUES
(1, 'ADMINISTRADOR', 'ADMINISTRADOR GENERAL.', 1, '2018-09-29 13:29:55'),
(9, 'PACIENTE', 'PACIENTE EN EL SISTEMA', 1, '2018-11-21 20:48:11'),
(10, 'ASISTENTE', 'INFORMACION GENERAL', 1, '2018-11-21 20:48:29'),
(11, 'MEDICO', 'MEDICO GENERAL', 1, '2018-11-21 20:51:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE IF NOT EXISTS `permisos` (
  `idPermisos` int(11) NOT NULL AUTO_INCREMENT,
  `Perfil_idPerfil` int(11) NOT NULL,
  `Permiso1` int(11) NOT NULL,
  `Permiso2` int(11) NOT NULL,
  `Permiso3` int(11) NOT NULL,
  `Permiso4` int(11) NOT NULL,
  `Permiso5` int(11) NOT NULL,
  `Permiso6` int(11) NOT NULL,
  PRIMARY KEY (`idPermisos`),
  KEY `FK_Perfil_idPerfil` (`Perfil_idPerfil`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idPermisos`, `Perfil_idPerfil`, `Permiso1`, `Permiso2`, `Permiso3`, `Permiso4`, `Permiso5`, `Permiso6`) VALUES
(4, 1, 1, 1, 1, 1, 1, 1),
(10, 9, 1, 1, 1, 1, 1, 1),
(11, 10, 1, 1, 1, 1, 1, 1),
(12, 11, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

DROP TABLE IF EXISTS `persona`;
CREATE TABLE IF NOT EXISTS `persona` (
  `idPersona` int(11) NOT NULL AUTO_INCREMENT,
  `nombrePersona` varchar(50) NOT NULL,
  `apellidoPaterno` varchar(50) NOT NULL,
  `apellidoMaterno` varchar(50) NOT NULL,
  `DNI` char(8) NOT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `telefono` char(10) DEFAULT NULL,
  `direccion` text,
  `Estado_idEstado` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`idPersona`),
  KEY `FK_Estado_idEstado` (`Estado_idEstado`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idPersona`, `nombrePersona`, `apellidoPaterno`, `apellidoMaterno`, `DNI`, `fechaNacimiento`, `correo`, `telefono`, `direccion`, `Estado_idEstado`, `fechaRegistro`) VALUES
(1, 'ADMINISTRADOR', 'GENERAL', 'DEL SISTEMA', '47040087', '1992-05-18', 'jic_d12@hotmail.com', '5284039', 'aahh enrique milla ochoa mz 74 lt 7 los olicvos', 1, '2018-09-29 13:45:53'),
(40, 'ANTONIO', 'GARCIA', 'ARIAS', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(41, 'JOSE', 'GONZALEZ', 'CARMONA', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(42, 'MANUEL', 'RODRIGUEZ', 'CRESPO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(43, 'FRANCISCO', 'FERNANDEZ', 'ROMAN', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(44, 'DAVID', 'LOPEZ', 'PASTOR', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(45, 'JUAN', 'MARTINEZ', 'SOTO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(46, 'JOSE ANTONIO', 'SANCHEZ', 'SAEZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(47, 'JAVIER', 'PEREZ', 'VELASCO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(48, 'JOSE LUIS', 'GOMEZ', 'MOYA', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(49, 'DANIEL', 'MARTIN', 'SOLER', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(50, 'FRANCISCO JAVIER', 'JIMENEZ', 'PARRA', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(51, 'JESUS', 'RUIZ', 'ESTEBAN', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(52, 'CARLOS', 'HERNANDEZ', 'BRAVO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(53, 'ALEJANDRO', 'DIAZ', 'GALLARDO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(54, 'MIGUEL', 'MORENO', 'ROJAS', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(55, 'JOSE MANUEL', 'MUÑOZ', 'HERRERO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(56, 'RAFAEL', 'ALVAREZ', 'MONTERO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(57, 'PEDRO', 'ROMERO', 'LORENZO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(58, 'MIGUEL ANGEL', 'ALONSO', 'HIDALGO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(59, 'ANGEL', 'GUTIERREZ', 'GIMENEZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(60, 'PABLO', 'NAVARRO', 'IBAÑEZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(61, 'JOSE MARIA', 'TORRES', 'FERRER', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(62, 'FERNANDO', 'DOMINGUEZ', 'DURAN', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(63, 'SERGIO', 'VAZQUEZ', 'SANTIAGO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(64, 'LUIS', 'RAMOS', 'BENITEZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(65, 'JORGE', 'GIL', 'VARGAS', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(66, 'ALBERTO', 'RAMIREZ', 'MORA', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(67, 'JUAN CARLOS', 'SERRANO', 'VICENTE', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(68, 'ALVARO', 'BLANCO', 'VIDAL', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(69, 'JUAN JOSE', 'MOLINA', 'PEÑA', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(70, 'DIEGO', 'MORALES', 'FLORES', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(71, 'ADRIAN', 'SUAREZ', 'CABRERA', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(72, 'RAUL', 'ORTEGA', 'CAMPOS', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(73, 'JUAN ANTONIO', 'DELGADO', 'VEGA', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(74, 'IVAN', 'CASTRO', 'FUENTES', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(75, 'ENRIQUE', 'ORTIZ', 'CARRASCO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(76, 'RUBEN', 'RUBIO', 'DIEZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(77, 'RAMON', 'MARIN', 'REYES', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(78, 'VICENTE', 'SANZ', 'CABALLERO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(79, 'OSCAR', 'NUÑEZ', 'NIETO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(80, 'ANDRES', 'IGLESIAS', 'AGUILAR', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(81, 'JOAQUIN', 'MEDINA', 'PASCUAL', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(82, 'JUAN MANUEL', 'GARRIDO', 'SANTANA', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(83, 'SANTIAGO', 'CORTES', 'MORALES', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(84, 'EDUARDO', 'CASTILLO', 'SUAREZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(85, 'VICTOR', 'SANTOS', 'ORTEGA', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(86, 'MARIO', 'LOZANO', 'DELGADO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(87, 'ROBERTO', 'GUERRERO', 'CASTRO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(88, 'JAIME', 'CANO', 'ORTIZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(89, 'ANGELA', 'PRIETO', 'MOLINA', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(90, 'SONIA', 'MENDEZ', 'RUBIO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(91, 'SANDRA', 'CRUZ', 'MARIN', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(92, 'MARINA', 'CALVO', 'SANZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(93, 'SUSANA', 'GALLEGO', 'NUÑEZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(94, 'YOLANDA', 'HERRERA', 'IGLESIAS', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(95, 'NATALIA', 'MARQUEZ', 'MEDINA', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(96, 'MARGARITA', 'LEON', 'GARRIDO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(97, 'MARIA JOSEFA', 'VIDAL', 'CORTES', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(98, 'MARIA ROSARIO', 'PEÑA', 'CASTILLO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(99, 'EVA', 'FLORES', 'SANTOS', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(100, 'INMACULADA', 'CABRERA', 'LOZANO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(101, 'CLAUDIA', 'CAMPOS', 'GUERRERO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(102, 'MARIA MERCEDES', 'VEGA', 'CANO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(103, 'ANA ISABEL', 'FUENTES', 'PRIETO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(104, 'ESTHER', 'CARRASCO', 'MENDEZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(105, 'NOELIA', 'DIEZ', 'CRUZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(106, 'CARLA', 'REYES', 'CALVO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(107, 'VERONICA', 'CABALLERO', 'GALLEGO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(108, 'SOFIA', 'NIETO', 'HERRERA', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(109, 'ANGELES', 'AGUILAR', 'MARQUEZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(110, 'CAROLINA', 'PASCUAL', 'LEON', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(111, 'NEREA', 'SANTANA', 'ROMERO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(112, 'MARIA VICTORIA', 'HERRERO', 'ALONSO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(113, 'MARIA ROSA', 'MONTERO', 'GUTIERREZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(114, 'EVA MARIA', 'LORENZO', 'NAVARRO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(115, 'AMPARO', 'HIDALGO', 'TORRES', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(116, 'MIRIAM', 'GIMENEZ', 'DOMINGUEZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(117, 'LORENA', 'IBAÑEZ', 'VAZQUEZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(118, 'INES', 'FERRER', 'RAMOS', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(119, 'MARIA CONCEPCION', 'DURAN', 'GIL', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(120, 'ANA BELEN', 'SANTIAGO', 'RAMIREZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(121, 'MARIA ELENA', 'BENITEZ', 'SERRANO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(122, 'VICTORIA', 'VARGAS', 'BLANCO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:08:59'),
(123, 'MARIA ANTONIA', 'MORA', 'GARCIA', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:09:00'),
(124, 'DANIELA', 'VICENTE', 'GONZALEZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:09:00'),
(125, 'CATALINA', 'ARIAS', 'RODRIGUEZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:09:00'),
(126, 'CONSUELO', 'CARMONA', 'FERNANDEZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:09:00'),
(127, 'LIDIA', 'CRESPO', 'LOPEZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:09:00'),
(128, 'MARIA NIEVES', 'ROMAN', 'MARTINEZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:09:00'),
(129, 'CELIA', 'PASTOR', 'SANCHEZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:09:00'),
(130, 'ALEJANDRA', 'SOTO', 'PEREZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:09:00'),
(131, 'OLGA', 'SAEZ', 'GOMEZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:09:00'),
(132, 'EMILIA', 'VELASCO', 'MARTIN', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:09:00'),
(133, 'GLORIA', 'MOYA', 'JIMENEZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:09:00'),
(134, 'LUISA', 'SOLER', 'RUIZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:09:00'),
(135, 'AINHOA', 'PARRA', 'HERNANDEZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:09:00'),
(136, 'AURORA', 'ESTEBAN', 'DIAZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:09:00'),
(137, 'MARIA SOLEDAD', 'BRAVO', 'MORENO', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:09:00'),
(138, 'MARTINA', 'GALLARDO', 'MUÑOZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:09:00'),
(139, 'FATIMA', 'ROJAS', 'ALVAREZ', '44444444', '1989-01-01', 'example@hotmail.com', '999999999', 'direccion ejemplo', 1, '2018-10-20 14:09:00'),
(142, 'ROMULO', 'SANTA', 'PEREZ', '47404442', '2018-11-21', 'jic_D12@hotmail.com', '121313', 'a.a.h.h enrique milla ochoa mz 74 lt 7\r\nlos olivos- lima - lima', 1, '2018-11-21 23:39:58'),
(143, 'LUISA', 'LUPE', 'ROMEROS', '23121231', '2018-11-13', 'WFEF@RF.COM', '312312', 'WEFWEFEWFWE', 1, '2018-11-22 00:41:25'),
(144, 'MIRIAN', 'RODRIGUEZX', 'PORRAS', '35635454', '2018-11-27', 'wef@gew.com', '123124123', 'cqefqwfewf', 1, '2018-11-22 00:42:06'),
(145, 'wef', 'wef', 'wef', '122321', '2018-11-14', NULL, '141', NULL, 1, '2018-11-22 15:28:08'),
(146, 'prueba', 'fwef', 'fewf', '212312', '1999-12-25', NULL, '2112', 'wefewf', 1, '2018-12-01 17:00:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sexo`
--

DROP TABLE IF EXISTS `sexo`;
CREATE TABLE IF NOT EXISTS `sexo` (
  `idSexo` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(150) NOT NULL,
  PRIMARY KEY (`idSexo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sexo`
--

INSERT INTO `sexo` (`idSexo`, `Descripcion`) VALUES
(1, 'MASCULINO'),
(2, 'FEMENINO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_asignacionespecialidad`
--

DROP TABLE IF EXISTS `tab_asignacionespecialidad`;
CREATE TABLE IF NOT EXISTS `tab_asignacionespecialidad` (
  `idAsignacionEspecialidad` int(11) NOT NULL AUTO_INCREMENT,
  `Especialidad_idEspecialidad` int(11) NOT NULL,
  `Medico_idMedico` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`idAsignacionEspecialidad`),
  KEY `FK_MEDICOAS` (`Medico_idMedico`),
  KEY `FK_ESPEAS` (`Especialidad_idEspecialidad`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_asignacionespecialidad`
--

INSERT INTO `tab_asignacionespecialidad` (`idAsignacionEspecialidad`, `Especialidad_idEspecialidad`, `Medico_idMedico`, `fechaRegistro`) VALUES
(7, 4, 1, '2019-02-09 20:25:37'),
(8, 4, 2, '2019-02-09 20:25:40'),
(11, 5, 2, '2019-02-09 20:36:59'),
(12, 6, 1, '2019-02-09 20:37:12'),
(13, 5, 3, '2019-02-09 20:37:22'),
(15, 6, 3, '2019-02-09 21:00:28'),
(16, 7, 1, '2019-02-09 21:00:37'),
(20, 8, 2, '2019-02-09 21:00:54'),
(24, 9, 3, '2019-02-09 21:01:18'),
(25, 10, 1, '2019-02-09 21:01:27'),
(26, 10, 2, '2019-02-09 21:01:29'),
(27, 10, 3, '2019-02-09 21:01:32'),
(28, 11, 1, '2019-02-09 21:01:40'),
(29, 11, 2, '2019-02-09 21:01:43'),
(30, 11, 3, '2019-02-09 21:01:46'),
(31, 12, 1, '2019-02-09 21:01:54'),
(32, 12, 2, '2019-02-09 21:01:57'),
(33, 12, 3, '2019-02-09 21:02:00'),
(34, 13, 1, '2019-02-09 21:02:09'),
(35, 13, 2, '2019-02-09 21:02:12'),
(36, 13, 3, '2019-02-09 21:02:15'),
(37, 14, 1, '2019-02-09 21:02:26'),
(38, 14, 2, '2019-02-09 21:02:29'),
(39, 14, 3, '2019-02-09 21:02:32'),
(40, 15, 1, '2019-02-09 21:02:41'),
(41, 15, 2, '2019-02-09 21:02:45'),
(42, 15, 3, '2019-02-09 21:02:47'),
(43, 16, 1, '2019-02-09 21:02:58'),
(44, 16, 2, '2019-02-09 21:03:01'),
(45, 16, 3, '2019-02-09 21:03:04'),
(49, 18, 1, '2019-02-09 21:03:30'),
(50, 18, 2, '2019-02-09 21:03:33'),
(51, 18, 3, '2019-02-09 21:03:35'),
(52, 19, 1, '2019-02-09 21:03:46'),
(53, 19, 2, '2019-02-09 21:03:49'),
(54, 19, 3, '2019-02-09 21:03:52'),
(55, 20, 1, '2019-02-09 21:04:02'),
(56, 20, 2, '2019-02-09 21:04:05'),
(57, 20, 3, '2019-02-09 21:04:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_comorbilidad`
--

DROP TABLE IF EXISTS `tab_comorbilidad`;
CREATE TABLE IF NOT EXISTS `tab_comorbilidad` (
  `idComorbilidad` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(150) NOT NULL,
  `Estado_idEstado` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`idComorbilidad`),
  KEY `FK_COM_ESTADO` (`Estado_idEstado`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_comorbilidad`
--

INSERT INTO `tab_comorbilidad` (`idComorbilidad`, `Descripcion`, `Estado_idEstado`, `fechaRegistro`) VALUES
(3, 'Hipertensión Arterial', 1, '2019-02-10 11:28:35'),
(4, 'Obesidad', 1, '2019-02-10 11:28:44'),
(5, 'Dislipidemia', 1, '2019-02-10 11:28:55'),
(6, 'Anemia', 1, '2019-02-10 11:29:01'),
(7, 'Hígado Graso', 1, '2019-02-10 11:29:11'),
(8, 'Insuficiencia Cardiaca', 1, '2019-02-10 11:29:23'),
(9, 'Enf. Renal Crónica', 1, '2019-02-10 11:29:44'),
(10, 'Diálisis', 1, '2019-02-10 11:29:54'),
(11, 'Hipotiroidismo', 1, '2019-02-10 11:30:09'),
(12, 'Tuberculosis', 1, '2019-02-10 11:30:19'),
(13, 'Fuma Actualmente (Fumador)', 1, '2019-02-10 11:30:34'),
(14, 'Cáncer', 1, '2019-02-10 11:30:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_condicion`
--

DROP TABLE IF EXISTS `tab_condicion`;
CREATE TABLE IF NOT EXISTS `tab_condicion` (
  `idCondicion` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(150) NOT NULL,
  `Estado_idEstado` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`idCondicion`),
  KEY `FK_COND_ESTADO` (`Estado_idEstado`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_condicion`
--

INSERT INTO `tab_condicion` (`idCondicion`, `Descripcion`, `Estado_idEstado`, `fechaRegistro`) VALUES
(7, 'NUEVO', 1, '2019-01-19 14:02:25'),
(8, 'CONTINUADOR', 1, '2019-01-19 14:02:33'),
(9, 'REINGRESANTE', 1, '2019-01-19 14:02:41'),
(10, 'PREVALENTE', 1, '2019-01-19 14:02:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_departamento`
--

DROP TABLE IF EXISTS `tab_departamento`;
CREATE TABLE IF NOT EXISTS `tab_departamento` (
  `idDepartamento` int(5) NOT NULL DEFAULT '0',
  `departamento` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idDepartamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tab_departamento`
--

INSERT INTO `tab_departamento` (`idDepartamento`, `departamento`) VALUES
(1, 'AMAZONAS'),
(2, 'ANCASH'),
(3, 'APURIMAC'),
(4, 'AREQUIPA'),
(5, 'AYACUCHO'),
(6, 'CAJAMARCA'),
(7, 'CALLAO'),
(8, 'CUSCO'),
(9, 'HUANCAVELICA'),
(10, 'HUANUCO'),
(11, 'ICA'),
(12, 'JUNIN'),
(13, 'LA LIBERTAD'),
(14, 'LAMBAYEQUE'),
(15, 'LIMA'),
(16, 'LORETO'),
(17, 'MADRE DE DIOS'),
(18, 'MOQUEGUA'),
(19, 'PASCO'),
(20, 'PIURA'),
(21, 'PUNO'),
(22, 'SAN MARTIN'),
(23, 'TACNA'),
(24, 'TUMBES'),
(25, 'UCAYALI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_diagnostico`
--

DROP TABLE IF EXISTS `tab_diagnostico`;
CREATE TABLE IF NOT EXISTS `tab_diagnostico` (
  `idDiagnostico` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(150) NOT NULL,
  `Estado_idEstado` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`idDiagnostico`),
  KEY `FK_DIAG_ESTADO` (`Estado_idEstado`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_diagnostico`
--

INSERT INTO `tab_diagnostico` (`idDiagnostico`, `Descripcion`, `Estado_idEstado`, `fechaRegistro`) VALUES
(3, 'ANORMALIDADES A LA INTOLERANCIA A LA GLUCOSA', 1, '2019-01-19 14:04:20'),
(4, 'HIPERGLICERINA NO ESPECIFICADA', 1, '2019-01-19 14:04:38'),
(5, 'FACTOR RIESGO', 1, '2019-01-19 14:04:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_diagnostico_enfermeria`
--

DROP TABLE IF EXISTS `tab_diagnostico_enfermeria`;
CREATE TABLE IF NOT EXISTS `tab_diagnostico_enfermeria` (
  `idDiagnosticoEnfermeria` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(150) NOT NULL,
  `Estado_idEstado` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`idDiagnosticoEnfermeria`),
  KEY `FK_DIAG_ENF_ESTADO` (`Estado_idEstado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_diagnostico_enfermeria`
--

INSERT INTO `tab_diagnostico_enfermeria` (`idDiagnosticoEnfermeria`, `Descripcion`, `Estado_idEstado`, `fechaRegistro`) VALUES
(1, 'Diag Enfermeria 1', 1, '2019-02-24 21:50:27'),
(2, 'Diag Enfermeria 2', 1, '2019-02-24 21:50:36'),
(3, 'Diag Enfermeria 3', 1, '2019-02-24 21:50:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_diagnostico_especialidad`
--

DROP TABLE IF EXISTS `tab_diagnostico_especialidad`;
CREATE TABLE IF NOT EXISTS `tab_diagnostico_especialidad` (
  `idDiagnosticoEspecialidad` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(200) NOT NULL,
  `Estado_idEstado` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`idDiagnosticoEspecialidad`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_diagnostico_especialidad`
--

INSERT INTO `tab_diagnostico_especialidad` (`idDiagnosticoEspecialidad`, `Descripcion`, `Estado_idEstado`, `fechaRegistro`) VALUES
(3, 'Diagnostico Especialidad 1', 1, '2019-03-08 16:14:37'),
(4, 'Diagnostico Especialidad 2', 1, '2019-03-08 16:14:44'),
(5, 'Diagnostico Especialidad 3', 1, '2019-03-08 16:14:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_distrito`
--

DROP TABLE IF EXISTS `tab_distrito`;
CREATE TABLE IF NOT EXISTS `tab_distrito` (
  `idDistrito` int(5) NOT NULL DEFAULT '0',
  `distrito` varchar(50) DEFAULT NULL,
  `Provincia_idProvincia` int(5) DEFAULT NULL,
  PRIMARY KEY (`idDistrito`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tab_distrito`
--

INSERT INTO `tab_distrito` (`idDistrito`, `distrito`, `Provincia_idProvincia`) VALUES
(1, 'CHACHAPOYAS', 1),
(2, 'ASUNCION', 1),
(3, 'BALSAS', 1),
(4, 'CHETO', 1),
(5, 'CHILIQUIN', 1),
(6, 'CHUQUIBAMBA', 1),
(7, 'GRANADA', 1),
(8, 'HUANCAS', 1),
(9, 'LA JALCA', 1),
(10, 'LEIMEBAMBA', 1),
(11, 'LEVANTO', 1),
(12, 'MAGDALENA', 1),
(13, 'MARISCAL CASTILLA', 1),
(14, 'MOLINOPAMPA', 1),
(15, 'MONTEVIDEO', 1),
(16, 'OLLEROS', 1),
(17, 'QUINJALCA', 1),
(18, 'SAN FRANCISCO DE DAGUAS', 1),
(19, 'SAN ISIDRO DE MAINO', 1),
(20, 'SOLOCO', 1),
(21, 'SONCHE', 1),
(22, 'LA PECA', 2),
(23, 'ARAMANGO', 2),
(24, 'COPALLIN', 2),
(25, 'EL PARCO', 2),
(26, 'IMAZA', 2),
(27, 'JUMBILLA', 3),
(28, 'CHISQUILLA', 3),
(29, 'CHURUJA', 3),
(30, 'COROSHA', 3),
(31, 'CUISPES', 3),
(32, 'FLORIDA', 3),
(33, 'JAZAN', 3),
(34, 'RECTA', 3),
(35, 'SAN CARLOS', 3),
(36, 'SHIPASBAMBA', 3),
(37, 'VALERA', 3),
(38, 'YAMBRASBAMBA', 3),
(39, 'NIEVA', 4),
(40, 'EL CENEPA', 4),
(41, 'RIO SANTIAGO', 4),
(42, 'LAMUD', 5),
(43, 'CAMPORREDONDO', 5),
(44, 'COCABAMBA', 5),
(45, 'COLCAMAR', 5),
(46, 'CONILA', 5),
(47, 'INGUILPATA', 5),
(48, 'LONGUITA', 5),
(49, 'LONYA CHICO', 5),
(50, 'LUYA', 5),
(51, 'LUYA VIEJO', 5),
(52, 'MARIA', 5),
(53, 'OCALLI', 5),
(54, 'OCUMAL', 5),
(55, 'PISUQUIA', 5),
(56, 'PROVIDENCIA', 5),
(57, 'SAN CRISTOBAL', 5),
(58, 'SAN FRANCISCO DEL YESO', 5),
(59, 'SAN JERONIMO', 5),
(60, 'SAN JUAN DE LOPECANCHA', 5),
(61, 'SANTA CATALINA', 5),
(62, 'SANTO TOMAS', 5),
(63, 'TINGO', 5),
(64, 'TRITA', 5),
(65, 'SAN NICOLAS', 6),
(66, 'CHIRIMOTO', 6),
(67, 'COCHAMAL', 6),
(68, 'HUAMBO', 6),
(69, 'LIMABAMBA', 6),
(70, 'LONGAR', 6),
(71, 'MARISCAL BENAVIDES', 6),
(72, 'MILPUC', 6),
(73, 'OMIA', 6),
(74, 'SANTA ROSA', 6),
(75, 'TOTORA', 6),
(76, 'VISTA ALEGRE', 6),
(77, 'BAGUA GRANDE', 7),
(78, 'CAJARURO', 7),
(79, 'CUMBA', 7),
(80, 'EL MILAGRO', 7),
(81, 'JAMALCA', 7),
(82, 'LONYA GRANDE', 7),
(83, 'YAMON', 7),
(84, 'HUARAZ', 8),
(85, 'COCHABAMBA', 8),
(86, 'COLCABAMBA', 8),
(87, 'HUANCHAY', 8),
(88, 'INDEPENDENCIA', 8),
(89, 'JANGAS', 8),
(90, 'LA LIBERTAD', 8),
(91, 'OLLEROS', 8),
(92, 'PAMPAS', 8),
(93, 'PARIACOTO', 8),
(94, 'PIRA', 8),
(95, 'TARICA', 8),
(96, 'AIJA', 9),
(97, 'CORIS', 9),
(98, 'HUACLLAN', 9),
(99, 'LA MERCED', 9),
(100, 'SUCCHA', 9),
(101, 'LLAMELLIN', 10),
(102, 'ACZO', 10),
(103, 'CHACCHO', 10),
(104, 'CHINGAS', 10),
(105, 'MIRGAS', 10),
(106, 'SAN JUAN DE RONTOY', 10),
(107, 'CHACAS', 11),
(108, 'ACOCHACA', 11),
(109, 'CHIQUIAN', 12),
(110, 'ABELARDO PARDO LEZAMETA', 12),
(111, 'ANTONIO RAYMONDI', 12),
(112, 'AQUIA', 12),
(113, 'CAJACAY', 12),
(114, 'CANIS', 12),
(115, 'COLQUIOC', 12),
(116, 'HUALLANCA', 12),
(117, 'HUASTA', 12),
(118, 'HUAYLLACAYAN', 12),
(119, 'LA PRIMAVERA', 12),
(120, 'MANGAS', 12),
(121, 'PACLLON', 12),
(122, 'SAN MIGUEL DE CORPANQUI', 12),
(123, 'TICLLOS', 12),
(124, 'CARHUAZ', 13),
(125, 'ACOPAMPA', 13),
(126, 'AMASHCA', 13),
(127, 'ANTA', 13),
(128, 'ATAQUERO', 13),
(129, 'MARCARA', 13),
(130, 'PARIAHUANCA', 13),
(131, 'SAN MIGUEL DE ACO', 13),
(132, 'SHILLA', 13),
(133, 'TINCO', 13),
(134, 'YUNGAR', 13),
(135, 'SAN LUIS', 14),
(136, 'SAN NICOLAS', 14),
(137, 'YAUYA', 14),
(138, 'CASMA', 15),
(139, 'BUENA VISTA ALTA', 15),
(140, 'COMANDANTE NOEL', 15),
(141, 'YAUTAN', 15),
(142, 'CORONGO', 16),
(143, 'ACO', 16),
(144, 'BAMBAS', 16),
(145, 'CUSCA', 16),
(146, 'LA PAMPA', 16),
(147, 'YANAC', 16),
(148, 'YUPAN', 16),
(149, 'HUARI', 17),
(150, 'ANRA', 17),
(151, 'CAJAY', 17),
(152, 'CHAVIN DE HUANTAR', 17),
(153, 'HUACACHI', 17),
(154, 'HUACCHIS', 17),
(155, 'HUACHIS', 17),
(156, 'HUANTAR', 17),
(157, 'MASIN', 17),
(158, 'PAUCAS', 17),
(159, 'PONTO', 17),
(160, 'RAHUAPAMPA', 17),
(161, 'RAPAYAN', 17),
(162, 'SAN MARCOS', 17),
(163, 'SAN PEDRO DE CHANA', 17),
(164, 'UCO', 17),
(165, 'HUARMEY', 18),
(166, 'COCHAPETI', 18),
(167, 'CULEBRAS', 18),
(168, 'HUAYAN', 18),
(169, 'MALVAS', 18),
(170, 'CARAZ', 26),
(171, 'HUALLANCA', 26),
(172, 'HUATA', 26),
(173, 'HUAYLAS', 26),
(174, 'MATO', 26),
(175, 'PAMPAROMAS', 26),
(176, 'PUEBLO LIBRE', 26),
(177, 'SANTA CRUZ', 26),
(178, 'SANTO TORIBIO', 26),
(179, 'YURACMARCA', 26),
(180, 'PISCOBAMBA', 27),
(181, 'CASCA', 27),
(182, 'ELEAZAR GUZMAN BARRON', 27),
(183, 'FIDEL OLIVAS ESCUDERO', 27),
(184, 'LLAMA', 27),
(185, 'LLUMPA', 27),
(186, 'LUCMA', 27),
(187, 'MUSGA', 27),
(188, 'OCROS', 21),
(189, 'ACAS', 21),
(190, 'CAJAMARQUILLA', 21),
(191, 'CARHUAPAMPA', 21),
(192, 'COCHAS', 21),
(193, 'CONGAS', 21),
(194, 'LLIPA', 21),
(195, 'SAN CRISTOBAL DE RAJAN', 21),
(196, 'SAN PEDRO', 21),
(197, 'SANTIAGO DE CHILCAS', 21),
(198, 'CABANA', 22),
(199, 'BOLOGNESI', 22),
(200, 'CONCHUCOS', 22),
(201, 'HUACASCHUQUE', 22),
(202, 'HUANDOVAL', 22),
(203, 'LACABAMBA', 22),
(204, 'LLAPO', 22),
(205, 'PALLASCA', 22),
(206, 'PAMPAS', 22),
(207, 'SANTA ROSA', 22),
(208, 'TAUCA', 22),
(209, 'POMABAMBA', 23),
(210, 'HUAYLLAN', 23),
(211, 'PAROBAMBA', 23),
(212, 'QUINUABAMBA', 23),
(213, 'RECUAY', 24),
(214, 'CATAC', 24),
(215, 'COTAPARACO', 24),
(216, 'HUAYLLAPAMPA', 24),
(217, 'LLACLLIN', 24),
(218, 'MARCA', 24),
(219, 'PAMPAS CHICO', 24),
(220, 'PARARIN', 24),
(221, 'TAPACOCHA', 24),
(222, 'TICAPAMPA', 24),
(223, 'CHIMBOTE', 25),
(224, 'CACERES DEL PERU', 25),
(225, 'COISHCO', 25),
(226, 'MACATE', 25),
(227, 'MORO', 25),
(228, 'NEPE&Ntilde;A', 25),
(229, 'SAMANCO', 25),
(230, 'SANTA', 25),
(231, 'NUEVO CHIMBOTE', 25),
(232, 'SIHUAS', 26),
(233, 'ACOBAMBA', 26),
(234, 'ALFONSO UGARTE', 26),
(235, 'CASHAPAMPA', 26),
(236, 'CHINGALPO', 26),
(237, 'HUAYLLABAMBA', 26),
(238, 'QUICHES', 26),
(239, 'RAGASH', 26),
(240, 'SAN JUAN', 26),
(241, 'SICSIBAMBA', 26),
(242, 'YUNGAY', 27),
(243, 'CASCAPARA', 27),
(244, 'MANCOS', 27),
(245, 'MATACOTO', 27),
(246, 'QUILLO', 27),
(247, 'RANRAHIRCA', 27),
(248, 'SHUPLUY', 27),
(249, 'YANAMA', 27),
(250, 'ABANCAY', 28),
(251, 'CHACOCHE', 28),
(252, 'CIRCA', 28),
(253, 'CURAHUASI', 28),
(254, 'HUANIPACA', 28),
(255, 'LAMBRAMA', 28),
(256, 'PICHIRHUA', 28),
(257, 'SAN PEDRO DE CACHORA', 28),
(258, 'TAMBURCO', 28),
(259, 'ANDAHUAYLAS', 29),
(260, 'ANDARAPA', 29),
(261, 'CHIARA', 29),
(262, 'HUANCARAMA', 29),
(263, 'HUANCARAY', 29),
(264, 'HUAYANA', 29),
(265, 'KISHUARA', 29),
(266, 'PACOBAMBA', 29),
(267, 'PACUCHA', 29),
(268, 'PAMPACHIRI', 29),
(269, 'POMACOCHA', 29),
(270, 'SAN ANTONIO DE CACHI', 29),
(271, 'SAN JERONIMO', 29),
(272, 'SAN MIGUEL DE CHACCRAMPA', 29),
(273, 'SANTA MARIA DE CHICMO', 29),
(274, 'TALAVERA', 29),
(275, 'TUMAY HUARACA', 29),
(276, 'TURPO', 29),
(277, 'KAQUIABAMBA', 29),
(278, 'ANTABAMBA', 30),
(279, 'EL ORO', 30),
(280, 'HUAQUIRCA', 30),
(281, 'JUAN ESPINOZA MEDRANO', 30),
(282, 'OROPESA', 30),
(283, 'PACHACONAS', 30),
(284, 'SABAINO', 30),
(285, 'CHALHUANCA', 31),
(286, 'CAPAYA', 31),
(287, 'CARAYBAMBA', 31),
(288, 'CHAPIMARCA', 31),
(289, 'COLCABAMBA', 31),
(290, 'COTARUSE', 31),
(291, 'HUAYLLO', 31),
(292, 'JUSTO APU SAHUARAURA', 31),
(293, 'LUCRE', 31),
(294, 'POCOHUANCA', 31),
(295, 'SAN JUAN DE CHAC&Ntilde;A', 31),
(296, 'SA&Ntilde;AYCA', 31),
(297, 'SORAYA', 31),
(298, 'TAPAIRIHUA', 31),
(299, 'TINTAY', 31),
(300, 'TORAYA', 31),
(301, 'YANACA', 31),
(302, 'TAMBOBAMBA', 32),
(303, 'COTABAMBAS', 32),
(304, 'COYLLURQUI', 32),
(305, 'HAQUIRA', 32),
(306, 'MARA', 32),
(307, 'CHALLHUAHUACHO', 32),
(308, 'CHINCHEROS', 33),
(309, 'ANCO-HUALLO', 33),
(310, 'COCHARCAS', 33),
(311, 'HUACCANA', 33),
(312, 'OCOBAMBA', 33),
(313, 'ONGOY', 33),
(314, 'URANMARCA', 33),
(315, 'RANRACANCHA', 33),
(316, 'CHUQUIBAMBILLA', 34),
(317, 'CURPAHUASI', 34),
(318, 'GAMARRA', 34),
(319, 'HUAYLLATI', 34),
(320, 'MAMARA', 34),
(321, 'MICAELA BASTIDAS', 34),
(322, 'PATAYPAMPA', 34),
(323, 'PROGRESO', 34),
(324, 'SAN ANTONIO', 34),
(325, 'SANTA ROSA', 34),
(326, 'TURPAY', 34),
(327, 'VILCABAMBA', 34),
(328, 'VIRUNDO', 34),
(329, 'CURASCO', 34),
(330, 'AREQUIPA', 35),
(331, 'ALTO SELVA ALEGRE', 35),
(332, 'CAYMA', 35),
(333, 'CERRO COLORADO', 35),
(334, 'CHARACATO', 35),
(335, 'CHIGUATA', 35),
(336, 'JACOBO HUNTER', 35),
(337, 'LA JOYA', 35),
(338, 'MARIANO MELGAR', 35),
(339, 'MIRAFLORES', 35),
(340, 'MOLLEBAYA', 35),
(341, 'PAUCARPATA', 35),
(342, 'POCSI', 35),
(343, 'POLOBAYA', 35),
(344, 'QUEQUE&Ntilde;A', 35),
(345, 'SABANDIA', 35),
(346, 'SACHACA', 35),
(347, 'SAN JUAN DE SIGUAS', 35),
(348, 'SAN JUAN DE TARUCANI', 35),
(349, 'SANTA ISABEL DE SIGUAS', 35),
(350, 'SANTA RITA DE SIGUAS', 35),
(351, 'SOCABAYA', 35),
(352, 'TIABAYA', 35),
(353, 'UCHUMAYO', 35),
(354, 'VITOR', 35),
(355, 'YANAHUARA', 35),
(356, 'YARABAMBA', 35),
(357, 'YURA', 35),
(358, 'JOSE LUIS BUSTAMANTE Y RIVERO', 35),
(359, 'CAMANA', 36),
(360, 'JOSE MARIA QUIMPER', 36),
(361, 'MARIANO NICOLAS VALCARCEL', 36),
(362, 'MARISCAL CACERES', 36),
(363, 'NICOLAS DE PIEROLA', 36),
(364, 'OCO&Ntilde;A', 36),
(365, 'QUILCA', 36),
(366, 'SAMUEL PASTOR', 36),
(367, 'CARAVELI', 37),
(368, 'ACARI', 37),
(369, 'ATICO', 37),
(370, 'ATIQUIPA', 37),
(371, 'BELLA UNION', 37),
(372, 'CAHUACHO', 37),
(373, 'CHALA', 37),
(374, 'CHAPARRA', 37),
(375, 'HUANUHUANU', 37),
(376, 'JAQUI', 37),
(377, 'LOMAS', 37),
(378, 'QUICACHA', 37),
(379, 'YAUCA', 37),
(380, 'APLAO', 38),
(381, 'ANDAGUA', 38),
(382, 'AYO', 38),
(383, 'CHACHAS', 38),
(384, 'CHILCAYMARCA', 38),
(385, 'CHOCO', 38),
(386, 'HUANCARQUI', 38),
(387, 'MACHAGUAY', 38),
(388, 'ORCOPAMPA', 38),
(389, 'PAMPACOLCA', 38),
(390, 'TIPAN', 38),
(391, 'U&Ntilde;ON', 38),
(392, 'URACA', 38),
(393, 'VIRACO', 38),
(394, 'CHIVAY', 39),
(395, 'ACHOMA', 39),
(396, 'CABANACONDE', 39),
(397, 'CALLALLI', 39),
(398, 'CAYLLOMA', 39),
(399, 'COPORAQUE', 39),
(400, 'HUAMBO', 39),
(401, 'HUANCA', 39),
(402, 'ICHUPAMPA', 39),
(403, 'LARI', 39),
(404, 'LLUTA', 39),
(405, 'MACA', 39),
(406, 'MADRIGAL', 39),
(407, 'SAN ANTONIO DE CHUCA', 39),
(408, 'SIBAYO', 39),
(409, 'TAPAY', 39),
(410, 'TISCO', 39),
(411, 'TUTI', 39),
(412, 'YANQUE', 39),
(413, 'MAJES', 39),
(414, 'CHUQUIBAMBA', 40),
(415, 'ANDARAY', 40),
(416, 'CAYARANI', 40),
(417, 'CHICHAS', 40),
(418, 'IRAY', 40),
(419, 'RIO GRANDE', 40),
(420, 'SALAMANCA', 40),
(421, 'YANAQUIHUA', 40),
(422, 'MOLLENDO', 41),
(423, 'COCACHACRA', 41),
(424, 'DEAN VALDIVIA', 41),
(425, 'ISLAY', 41),
(426, 'MEJIA', 41),
(427, 'PUNTA DE BOMBON', 41),
(428, 'COTAHUASI', 42),
(429, 'ALCA', 42),
(430, 'CHARCANA', 42),
(431, 'HUAYNACOTAS', 42),
(432, 'PAMPAMARCA', 42),
(433, 'PUYCA', 42),
(434, 'QUECHUALLA', 42),
(435, 'SAYLA', 42),
(436, 'TAURIA', 42),
(437, 'TOMEPAMPA', 42),
(438, 'TORO', 42),
(439, 'AYACUCHO', 43),
(440, 'ACOCRO', 43),
(441, 'ACOS VINCHOS', 43),
(442, 'CARMEN ALTO', 43),
(443, 'CHIARA', 43),
(444, 'OCROS', 43),
(445, 'PACAYCASA', 43),
(446, 'QUINUA', 43),
(447, 'SAN JOSE DE TICLLAS', 43),
(448, 'SAN JUAN BAUTISTA', 43),
(449, 'SANTIAGO DE PISCHA', 43),
(450, 'SOCOS', 43),
(451, 'TAMBILLO', 43),
(452, 'VINCHOS', 43),
(453, 'JESUS NAZARENO', 43),
(454, 'CANGALLO', 44),
(455, 'CHUSCHI', 44),
(456, 'LOS MOROCHUCOS', 44),
(457, 'MARIA PARADO DE BELLIDO', 44),
(458, 'PARAS', 44),
(459, 'TOTOS', 44),
(460, 'SANCOS', 45),
(461, 'CARAPO', 45),
(462, 'SACSAMARCA', 45),
(463, 'SANTIAGO DE LUCANAMARCA', 45),
(464, 'HUANTA', 46),
(465, 'AYAHUANCO', 46),
(466, 'HUAMANGUILLA', 46),
(467, 'IGUAIN', 46),
(468, 'LURICOCHA', 46),
(469, 'SANTILLANA', 46),
(470, 'SIVIA', 46),
(471, 'LLOCHEGUA', 46),
(472, 'SAN MIGUEL', 47),
(473, 'ANCO', 47),
(474, 'AYNA', 47),
(475, 'CHILCAS', 47),
(476, 'CHUNGUI', 47),
(477, 'LUIS CARRANZA', 47),
(478, 'SANTA ROSA', 47),
(479, 'TAMBO', 47),
(480, 'PUQUIO', 48),
(481, 'AUCARA', 48),
(482, 'CABANA', 48),
(483, 'CARMEN SALCEDO', 48),
(484, 'CHAVI&Ntilde;A', 48),
(485, 'CHIPAO', 48),
(486, 'HUAC-HUAS', 48),
(487, 'LARAMATE', 48),
(488, 'LEONCIO PRADO', 48),
(489, 'LLAUTA', 48),
(490, 'LUCANAS', 48),
(491, 'OCA&Ntilde;A', 48),
(492, 'OTOCA', 48),
(493, 'SAISA', 48),
(494, 'SAN CRISTOBAL', 48),
(495, 'SAN JUAN', 48),
(496, 'SAN PEDRO', 48),
(497, 'SAN PEDRO DE PALCO', 48),
(498, 'SANCOS', 48),
(499, 'SANTA ANA DE HUAYCAHUACHO', 48),
(500, 'SANTA LUCIA', 48),
(501, 'CORACORA', 49),
(502, 'CHUMPI', 49),
(503, 'CORONEL CASTA&Ntilde;EDA', 49),
(504, 'PACAPAUSA', 49),
(505, 'PULLO', 49),
(506, 'PUYUSCA', 49),
(507, 'SAN FRANCISCO DE RAVACAYCO', 49),
(508, 'UPAHUACHO', 49),
(509, 'PAUSA', 50),
(510, 'COLTA', 50),
(511, 'CORCULLA', 50),
(512, 'LAMPA', 50),
(513, 'MARCABAMBA', 50),
(514, 'OYOLO', 50),
(515, 'PARARCA', 50),
(516, 'SAN JAVIER DE ALPABAMBA', 50),
(517, 'SAN JOSE DE USHUA', 50),
(518, 'SARA SARA', 50),
(519, 'QUEROBAMBA', 51),
(520, 'BELEN', 51),
(521, 'CHALCOS', 51),
(522, 'CHILCAYOC', 51),
(523, 'HUACA&Ntilde;A', 51),
(524, 'MORCOLLA', 51),
(525, 'PAICO', 51),
(526, 'SAN PEDRO DE LARCAY', 51),
(527, 'SAN SALVADOR DE QUIJE', 51),
(528, 'SANTIAGO DE PAUCARAY', 51),
(529, 'SORAS', 51),
(530, 'HUANCAPI', 52),
(531, 'ALCAMENCA', 52),
(532, 'APONGO', 52),
(533, 'ASQUIPATA', 52),
(534, 'CANARIA', 52),
(535, 'CAYARA', 52),
(536, 'COLCA', 52),
(537, 'HUAMANQUIQUIA', 52),
(538, 'HUANCARAYLLA', 52),
(539, 'HUAYA', 52),
(540, 'SARHUA', 52),
(541, 'VILCANCHOS', 52),
(542, 'VILCAS HUAMAN', 53),
(543, 'ACCOMARCA', 53),
(544, 'CARHUANCA', 53),
(545, 'CONCEPCION', 53),
(546, 'HUAMBALPA', 53),
(547, 'INDEPENDENCIA', 53),
(548, 'SAURAMA', 53),
(549, 'VISCHONGO', 53),
(550, 'CAJAMARCA', 54),
(551, 'CAJAMARCA', 54),
(552, 'ASUNCION', 54),
(553, 'CHETILLA', 54),
(554, 'COSPAN', 54),
(555, 'ENCA&Ntilde;ADA', 54),
(556, 'JESUS', 54),
(557, 'LLACANORA', 54),
(558, 'LOS BA&Ntilde;OS DEL INCA', 54),
(559, 'MAGDALENA', 54),
(560, 'MATARA', 54),
(561, 'NAMORA', 54),
(562, 'SAN JUAN', 54),
(563, 'CAJABAMBA', 55),
(564, 'CACHACHI', 55),
(565, 'CONDEBAMBA', 55),
(566, 'SITACOCHA', 55),
(567, 'CELENDIN', 56),
(568, 'CHUMUCH', 56),
(569, 'CORTEGANA', 56),
(570, 'HUASMIN', 56),
(571, 'JORGE CHAVEZ', 56),
(572, 'JOSE GALVEZ', 56),
(573, 'MIGUEL IGLESIAS', 56),
(574, 'OXAMARCA', 56),
(575, 'SOROCHUCO', 56),
(576, 'SUCRE', 56),
(577, 'UTCO', 56),
(578, 'LA LIBERTAD DE PALLAN', 56),
(579, 'CHOTA', 57),
(580, 'ANGUIA', 57),
(581, 'CHADIN', 57),
(582, 'CHIGUIRIP', 57),
(583, 'CHIMBAN', 57),
(584, 'CHOROPAMPA', 57),
(585, 'COCHABAMBA', 57),
(586, 'CONCHAN', 57),
(587, 'HUAMBOS', 57),
(588, 'LAJAS', 57),
(589, 'LLAMA', 57),
(590, 'MIRACOSTA', 57),
(591, 'PACCHA', 57),
(592, 'PION', 57),
(593, 'QUEROCOTO', 57),
(594, 'SAN JUAN DE LICUPIS', 57),
(595, 'TACABAMBA', 57),
(596, 'TOCMOCHE', 57),
(597, 'CHALAMARCA', 57),
(598, 'CONTUMAZA', 58),
(599, 'CHILETE', 58),
(600, 'CUPISNIQUE', 58),
(601, 'GUZMANGO', 58),
(602, 'SAN BENITO', 58),
(603, 'SANTA CRUZ DE TOLED', 58),
(604, 'TANTARICA', 58),
(605, 'YONAN', 58),
(606, 'CUTERVO', 59),
(607, 'CALLAYUC', 59),
(608, 'CHOROS', 59),
(609, 'CUJILLO', 59),
(610, 'LA RAMADA', 59),
(611, 'PIMPINGOS', 59),
(612, 'QUEROCOTILLO', 59),
(613, 'SAN ANDRES DE CUTERVO', 59),
(614, 'SAN JUAN DE CUTERVO', 59),
(615, 'SAN LUIS DE LUCMA', 59),
(616, 'SANTA CRUZ', 59),
(617, 'SANTO DOMINGO DE LA CAPILLA', 59),
(618, 'SANTO TOMAS', 59),
(619, 'SOCOTA', 59),
(620, 'TORIBIO CASANOVA', 59),
(621, 'BAMBAMARCA', 60),
(622, 'CHUGUR', 60),
(623, 'HUALGAYOC', 60),
(624, 'JAEN', 61),
(625, 'BELLAVISTA', 61),
(626, 'CHONTALI', 61),
(627, 'COLASAY', 61),
(628, 'HUABAL', 61),
(629, 'LAS PIRIAS', 61),
(630, 'POMAHUACA', 61),
(631, 'PUCARA', 61),
(632, 'SALLIQUE', 61),
(633, 'SAN FELIPE', 61),
(634, 'SAN JOSE DEL ALTO', 61),
(635, 'SANTA ROSA', 61),
(636, 'SAN IGNACIO', 62),
(637, 'CHIRINOS', 62),
(638, 'HUARANGO', 62),
(639, 'LA COIPA', 62),
(640, 'NAMBALLE', 62),
(641, 'SAN JOSE DE LOURDES', 62),
(642, 'TABACONAS', 62),
(643, 'PEDRO GALVEZ', 63),
(644, 'CHANCAY', 63),
(645, 'EDUARDO VILLANUEVA', 63),
(646, 'GREGORIO PITA', 63),
(647, 'ICHOCAN', 63),
(648, 'JOSE MANUEL QUIROZ', 63),
(649, 'JOSE SABOGAL', 63),
(650, 'SAN MIGUEL', 64),
(651, 'SAN MIGUEL', 64),
(652, 'BOLIVAR', 64),
(653, 'CALQUIS', 64),
(654, 'CATILLUC', 64),
(655, 'EL PRADO', 64),
(656, 'LA FLORIDA', 64),
(657, 'LLAPA', 64),
(658, 'NANCHOC', 64),
(659, 'NIEPOS', 64),
(660, 'SAN GREGORIO', 64),
(661, 'SAN SILVESTRE DE COCHAN', 64),
(662, 'TONGOD', 64),
(663, 'UNION AGUA BLANCA', 64),
(664, 'SAN PABLO', 65),
(665, 'SAN BERNARDINO', 65),
(666, 'SAN LUIS', 65),
(667, 'TUMBADEN', 65),
(668, 'SANTA CRUZ', 66),
(669, 'ANDABAMBA', 66),
(670, 'CATACHE', 66),
(671, 'CHANCAYBA&Ntilde;OS', 66),
(672, 'LA ESPERANZA', 66),
(673, 'NINABAMBA', 66),
(674, 'PULAN', 66),
(675, 'SAUCEPAMPA', 66),
(676, 'SEXI', 66),
(677, 'UTICYACU', 66),
(678, 'YAUYUCAN', 66),
(679, 'CALLAO', 67),
(680, 'BELLAVISTA', 67),
(681, 'CARMEN DE LA LEGUA REYNOSO', 67),
(682, 'LA PERLA', 67),
(683, 'LA PUNTA', 67),
(684, 'VENTANILLA', 67),
(685, 'CUSCO', 67),
(686, 'CCORCA', 67),
(687, 'POROY', 67),
(688, 'SAN JERONIMO', 67),
(689, 'SAN SEBASTIAN', 67),
(690, 'SANTIAGO', 67),
(691, 'SAYLLA', 67),
(692, 'WANCHAQ', 67),
(693, 'ACOMAYO', 68),
(694, 'ACOPIA', 68),
(695, 'ACOS', 68),
(696, 'MOSOC LLACTA', 68),
(697, 'POMACANCHI', 68),
(698, 'RONDOCAN', 68),
(699, 'SANGARARA', 68),
(700, 'ANTA', 69),
(701, 'ANCAHUASI', 69),
(702, 'CACHIMAYO', 69),
(703, 'CHINCHAYPUJIO', 69),
(704, 'HUAROCONDO', 69),
(705, 'LIMATAMBO', 69),
(706, 'MOLLEPATA', 69),
(707, 'PUCYURA', 69),
(708, 'ZURITE', 69),
(709, 'CALCA', 70),
(710, 'COYA', 70),
(711, 'LAMAY', 70),
(712, 'LARES', 70),
(713, 'PISAC', 70),
(714, 'SAN SALVADOR', 70),
(715, 'TARAY', 70),
(716, 'YANATILE', 70),
(717, 'YANAOCA', 71),
(718, 'CHECCA', 71),
(719, 'KUNTURKANKI', 71),
(720, 'LANGUI', 71),
(721, 'LAYO', 71),
(722, 'PAMPAMARCA', 71),
(723, 'QUEHUE', 71),
(724, 'TUPAC AMARU', 71),
(725, 'SICUANI', 72),
(726, 'CHECACUPE', 72),
(727, 'COMBAPATA', 72),
(728, 'MARANGANI', 72),
(729, 'PITUMARCA', 72),
(730, 'SAN PABLO', 72),
(731, 'SAN PEDRO', 72),
(732, 'TINTA', 72),
(733, 'SANTO TOMAS', 73),
(734, 'CAPACMARCA', 73),
(735, 'CHAMACA', 73),
(736, 'COLQUEMARCA', 73),
(737, 'LIVITACA', 73),
(738, 'LLUSCO', 73),
(739, 'QUI&Ntilde;OTA', 73),
(740, 'VELILLE', 73),
(741, 'ESPINAR', 74),
(742, 'CONDOROMA', 74),
(743, 'COPORAQUE', 74),
(744, 'OCORURO', 74),
(745, 'PALLPATA', 74),
(746, 'PICHIGUA', 74),
(747, 'SUYCKUTAMBO', 74),
(748, 'ALTO PICHIGUA', 74),
(749, 'SANTA ANA', 75),
(750, 'ECHARATE', 75),
(751, 'HUAYOPATA', 75),
(752, 'MARANURA', 75),
(753, 'OCOBAMBA', 75),
(754, 'QUELLOUNO', 75),
(755, 'KIMBIRI', 75),
(756, 'SANTA TERESA', 75),
(757, 'VILCABAMBA', 75),
(758, 'PICHARI', 75),
(759, 'PARURO', 76),
(760, 'ACCHA', 76),
(761, 'CCAPI', 76),
(762, 'COLCHA', 76),
(763, 'HUANOQUITE', 76),
(764, 'OMACHA', 76),
(765, 'PACCARITAMBO', 76),
(766, 'PILLPINTO', 76),
(767, 'YAURISQUE', 76),
(768, 'PAUCARTAMBO', 77),
(769, 'CAICAY', 77),
(770, 'CHALLABAMBA', 77),
(771, 'COLQUEPATA', 77),
(772, 'HUANCARANI', 77),
(773, 'KOS&Ntilde;IPATA', 77),
(774, 'URCOS', 78),
(775, 'ANDAHUAYLILLAS', 78),
(776, 'CAMANTI', 78),
(777, 'CCARHUAYO', 78),
(778, 'CCATCA', 78),
(779, 'CUSIPATA', 78),
(780, 'HUARO', 78),
(781, 'LUCRE', 78),
(782, 'MARCAPATA', 78),
(783, 'OCONGATE', 78),
(784, 'OROPESA', 78),
(785, 'QUIQUIJANA', 78),
(786, 'URUBAMBA', 79),
(787, 'CHINCHERO', 79),
(788, 'HUAYLLABAMBA', 79),
(789, 'MACHUPICCHU', 79),
(790, 'MARAS', 79),
(791, 'OLLANTAYTAMBO', 79),
(792, 'YUCAY', 79),
(793, 'HUANCAVELICA', 80),
(794, 'ACOBAMBILLA', 80),
(795, 'ACORIA', 80),
(796, 'CONAYCA', 80),
(797, 'CUENCA', 80),
(798, 'HUACHOCOLPA', 80),
(799, 'HUAYLLAHUARA', 80),
(800, 'IZCUCHACA', 80),
(801, 'LARIA', 80),
(802, 'MANTA', 80),
(803, 'MARISCAL CACERES', 80),
(804, 'MOYA', 80),
(805, 'NUEVO OCCORO', 80),
(806, 'PALCA', 80),
(807, 'PILCHACA', 80),
(808, 'VILCA', 80),
(809, 'YAULI', 80),
(810, 'ASCENSION', 80),
(811, 'HUANDO', 80),
(812, 'ACOBAMBA', 81),
(813, 'ANDABAMBA', 81),
(814, 'ANTA', 81),
(815, 'CAJA', 81),
(816, 'MARCAS', 81),
(817, 'PAUCARA', 81),
(818, 'POMACOCHA', 81),
(819, 'ROSARIO', 81),
(820, 'LIRCAY', 82),
(821, 'ANCHONGA', 82),
(822, 'CALLANMARCA', 82),
(823, 'CCOCHACCASA', 82),
(824, 'CHINCHO', 82),
(825, 'CONGALLA', 82),
(826, 'HUANCA-HUANCA', 82),
(827, 'HUAYLLAY GRANDE', 82),
(828, 'JULCAMARCA', 82),
(829, 'SAN ANTONIO DE ANTAPARCO', 82),
(830, 'SANTO TOMAS DE PATA', 82),
(831, 'SECCLLA', 82),
(832, 'CASTROVIRREYNA', 83),
(833, 'ARMA', 83),
(834, 'AURAHUA', 83),
(835, 'CAPILLAS', 83),
(836, 'CHUPAMARCA', 83),
(837, 'COCAS', 83),
(838, 'HUACHOS', 83),
(839, 'HUAMATAMBO', 83),
(840, 'MOLLEPAMPA', 83),
(841, 'SAN JUAN', 83),
(842, 'SANTA ANA', 83),
(843, 'TANTARA', 83),
(844, 'TICRAPO', 83),
(845, 'CHURCAMPA', 84),
(846, 'ANCO', 84),
(847, 'CHINCHIHUASI', 84),
(848, 'EL CARMEN', 84),
(849, 'LA MERCED', 84),
(850, 'LOCROJA', 84),
(851, 'PAUCARBAMBA', 84),
(852, 'SAN MIGUEL DE MAYOCC', 84),
(853, 'SAN PEDRO DE CORIS', 84),
(854, 'PACHAMARCA', 84),
(855, 'HUAYTARA', 85),
(856, 'AYAVI', 85),
(857, 'CORDOVA', 85),
(858, 'HUAYACUNDO ARMA', 85),
(859, 'LARAMARCA', 85),
(860, 'OCOYO', 85),
(861, 'PILPICHACA', 85),
(862, 'QUERCO', 85),
(863, 'QUITO-ARMA', 85),
(864, 'SAN ANTONIO DE CUSICANCHA', 85),
(865, 'SAN FRANCISCO DE SANGAYAICO', 85),
(866, 'SAN ISIDRO', 85),
(867, 'SANTIAGO DE CHOCORVOS', 85),
(868, 'SANTIAGO DE QUIRAHUARA', 85),
(869, 'SANTO DOMINGO DE CAPILLAS', 85),
(870, 'TAMBO', 85),
(871, 'PAMPAS', 86),
(872, 'ACOSTAMBO', 86),
(873, 'ACRAQUIA', 86),
(874, 'AHUAYCHA', 86),
(875, 'COLCABAMBA', 86),
(876, 'DANIEL HERNANDEZ', 86),
(877, 'HUACHOCOLPA', 86),
(878, 'HUARIBAMBA', 86),
(879, '&Ntilde;AHUIMPUQUIO', 86),
(880, 'PAZOS', 86),
(881, 'QUISHUAR', 86),
(882, 'SALCABAMBA', 86),
(883, 'SALCAHUASI', 86),
(884, 'SAN MARCOS DE ROCCHAC', 86),
(885, 'SURCUBAMBA', 86),
(886, 'TINTAY PUNCU', 86),
(887, 'HUANUCO', 87),
(888, 'AMARILIS', 87),
(889, 'CHINCHAO', 87),
(890, 'CHURUBAMBA', 87),
(891, 'MARGOS', 87),
(892, 'QUISQUI', 87),
(893, 'SAN FRANCISCO DE CAYRAN', 87),
(894, 'SAN PEDRO DE CHAULAN', 87),
(895, 'SANTA MARIA DEL VALLE', 87),
(896, 'YARUMAYO', 87),
(897, 'PILLCO MARCA', 87),
(898, 'AMBO', 88),
(899, 'CAYNA', 88),
(900, 'COLPAS', 88),
(901, 'CONCHAMARCA', 88),
(902, 'HUACAR', 88),
(903, 'SAN FRANCISCO', 88),
(904, 'SAN RAFAEL', 88),
(905, 'TOMAY KICHWA', 88),
(906, 'LA UNION', 89),
(907, 'CHUQUIS', 89),
(908, 'MARIAS', 89),
(909, 'PACHAS', 89),
(910, 'QUIVILLA', 89),
(911, 'RIPAN', 89),
(912, 'SHUNQUI', 89),
(913, 'SILLAPATA', 89),
(914, 'YANAS', 89),
(915, 'HUACAYBAMBA', 90),
(916, 'CANCHABAMBA', 90),
(917, 'COCHABAMBA', 90),
(918, 'PINRA', 90),
(919, 'LLATA', 91),
(920, 'ARANCAY', 91),
(921, 'CHAVIN DE PARIARCA', 91),
(922, 'JACAS GRANDE', 91),
(923, 'JIRCAN', 91),
(924, 'MIRAFLORES', 91),
(925, 'MONZON', 91),
(926, 'PUNCHAO', 91),
(927, 'PU&Ntilde;OS', 91),
(928, 'SINGA', 91),
(929, 'TANTAMAYO', 91),
(930, 'RUPA-RUPA', 92),
(931, 'DANIEL ALOMIA ROBLES', 92),
(932, 'HERMILIO VALDIZAN', 92),
(933, 'JOSE CRESPO Y CASTILLO', 92),
(934, 'LUYANDO', 92),
(935, 'MARIANO DAMASO BERAUN', 92),
(936, 'HUACRACHUCO', 93),
(937, 'CHOLON', 93),
(938, 'SAN BUENAVENTURA', 93),
(939, 'PANAO', 94),
(940, 'CHAGLLA', 94),
(941, 'MOLINO', 94),
(942, 'UMARI', 94),
(943, 'PUERTO INCA', 95),
(944, 'CODO DEL POZUZO', 95),
(945, 'HONORIA', 95),
(946, 'TOURNAVISTA', 95),
(947, 'YUYAPICHIS', 95),
(948, 'JESUS', 96),
(949, 'BA&Ntilde;OS', 96),
(950, 'JIVIA', 96),
(951, 'QUEROPALCA', 96),
(952, 'RONDOS', 96),
(953, 'SAN FRANCISCO DE ASIS', 96),
(954, 'SAN MIGUEL DE CAURI', 96),
(955, 'CHAVINILLO', 97),
(956, 'CAHUAC', 97),
(957, 'CHACABAMBA', 97),
(958, 'APARICIO POMARES', 97),
(959, 'JACAS CHICO', 97),
(960, 'OBAS', 97),
(961, 'PAMPAMARCA', 97),
(962, 'CHORAS', 97),
(963, 'ICA', 98),
(964, 'LA TINGUI&Ntilde;A', 98),
(965, 'LOS AQUIJES', 98),
(966, 'OCUCAJE', 98),
(967, 'PACHACUTEC', 98),
(968, 'PARCONA', 98),
(969, 'PUEBLO NUEVO', 98),
(970, 'SALAS', 98),
(971, 'SAN JOSE DE LOS MOLINOS', 98),
(972, 'SAN JUAN BAUTISTA', 98),
(973, 'SANTIAGO', 98),
(974, 'SUBTANJALLA', 98),
(975, 'TATE', 98),
(976, 'YAUCA DEL ROSARIO', 98),
(977, 'CHINCHA ALTA', 99),
(978, 'ALTO LARAN', 99),
(979, 'CHAVIN', 99),
(980, 'CHINCHA BAJA', 99),
(981, 'EL CARMEN', 99),
(982, 'GROCIO PRADO', 99),
(983, 'PUEBLO NUEVO', 99),
(984, 'SAN JUAN DE YANAC', 99),
(985, 'SAN PEDRO DE HUACARPANA', 99),
(986, 'SUNAMPE', 99),
(987, 'TAMBO DE MORA', 99),
(988, 'NAZCA', 100),
(989, 'CHANGUILLO', 100),
(990, 'EL INGENIO', 100),
(991, 'MARCONA', 100),
(992, 'VISTA ALEGRE', 100),
(993, 'PALPA', 101),
(994, 'LLIPATA', 101),
(995, 'RIO GRANDE', 101),
(996, 'SANTA CRUZ', 101),
(997, 'TIBILLO', 101),
(998, 'PISCO', 102),
(999, 'HUANCANO', 102),
(1000, 'HUMAY', 102),
(1001, 'INDEPENDENCIA', 102),
(1002, 'PARACAS', 102),
(1003, 'SAN ANDRES', 102),
(1004, 'SAN CLEMENTE', 102),
(1005, 'TUPAC AMARU INCA', 102),
(1006, 'HUANCAYO', 103),
(1007, 'CARHUACALLANGA', 103),
(1008, 'CHACAPAMPA', 103),
(1009, 'CHICCHE', 103),
(1010, 'CHILCA', 103),
(1011, 'CHONGOS ALTO', 103),
(1012, 'CHUPURO', 103),
(1013, 'COLCA', 103),
(1014, 'CULLHUAS', 103),
(1015, 'EL TAMBO', 103),
(1016, 'HUACRAPUQUIO', 103),
(1017, 'HUALHUAS', 103),
(1018, 'HUANCAN', 103),
(1019, 'HUASICANCHA', 103),
(1020, 'HUAYUCACHI', 103),
(1021, 'INGENIO', 103),
(1022, 'PARIAHUANCA', 103),
(1023, 'PILCOMAYO', 103),
(1024, 'PUCARA', 103),
(1025, 'QUICHUAY', 103),
(1026, 'QUILCAS', 103),
(1027, 'SAN AGUSTIN', 103),
(1028, 'SAN JERONIMO DE TUNAN', 103),
(1029, 'SA&Ntilde;O', 103),
(1030, 'SAPALLANGA', 103),
(1031, 'SICAYA', 103),
(1032, 'SANTO DOMINGO DE ACOBAMBA', 103),
(1033, 'VIQUES', 103),
(1034, 'CONCEPCION', 104),
(1035, 'ACO', 104),
(1036, 'ANDAMARCA', 104),
(1037, 'CHAMBARA', 104),
(1038, 'COCHAS', 104),
(1039, 'COMAS', 104),
(1040, 'HEROINAS TOLEDO', 104),
(1041, 'MANZANARES', 104),
(1042, 'MARISCAL CASTILLA', 104),
(1043, 'MATAHUASI', 104),
(1044, 'MITO', 104),
(1045, 'NUEVE DE JULIO', 104),
(1046, 'ORCOTUNA', 104),
(1047, 'SAN JOSE DE QUERO', 104),
(1048, 'SANTA ROSA DE OCOPA', 104),
(1049, 'CHANCHAMAYO', 105),
(1050, 'PERENE', 105),
(1051, 'PICHANAQUI', 105),
(1052, 'SAN LUIS DE SHUARO', 105),
(1053, 'SAN RAMON', 105),
(1054, 'VITOC', 105),
(1055, 'JAUJA', 106),
(1056, 'ACOLLA', 106),
(1057, 'APATA', 106),
(1058, 'ATAURA', 106),
(1059, 'CANCHAYLLO', 106),
(1060, 'CURICACA', 106),
(1061, 'EL MANTARO', 106),
(1062, 'HUAMALI', 106),
(1063, 'HUARIPAMPA', 106),
(1064, 'HUERTAS', 106),
(1065, 'JANJAILLO', 106),
(1066, 'JULCAN', 106),
(1067, 'LEONOR ORDO&Ntilde;EZ', 106),
(1068, 'LLOCLLAPAMPA', 106),
(1069, 'MARCO', 106),
(1070, 'MASMA', 106),
(1071, 'MASMA CHICCHE', 106),
(1072, 'MOLINOS', 106),
(1073, 'MONOBAMBA', 106),
(1074, 'MUQUI', 106),
(1075, 'MUQUIYAUYO', 106),
(1076, 'PACA', 106),
(1077, 'PACCHA', 106),
(1078, 'PANCAN', 106),
(1079, 'PARCO', 106),
(1080, 'POMACANCHA', 106),
(1081, 'RICRAN', 106),
(1082, 'SAN LORENZO', 106),
(1083, 'SAN PEDRO DE CHUNAN', 106),
(1084, 'SAUSA', 106),
(1085, 'SINCOS', 106),
(1086, 'TUNAN MARCA', 106),
(1087, 'YAULI', 106),
(1088, 'YAUYOS', 106),
(1089, 'JUNIN', 107),
(1090, 'CARHUAMAYO', 107),
(1091, 'ONDORES', 107),
(1092, 'ULCUMAYO', 107),
(1093, 'SATIPO', 108),
(1094, 'COVIRIALI', 108),
(1095, 'LLAYLLA', 108),
(1096, 'MAZAMARI', 108),
(1097, 'PAMPA HERMOSA', 108),
(1098, 'PANGOA', 108),
(1099, 'RIO NEGRO', 108),
(1100, 'RIO TAMBO', 108),
(1101, 'TARMA', 109),
(1102, 'ACOBAMBA', 109),
(1103, 'HUARICOLCA', 109),
(1104, 'HUASAHUASI', 109),
(1105, 'LA UNION', 109),
(1106, 'PALCA', 109),
(1107, 'PALCAMAYO', 109),
(1108, 'SAN PEDRO DE CAJAS', 109),
(1109, 'TAPO', 109),
(1110, 'LA OROYA', 110),
(1111, 'CHACAPALPA', 110),
(1112, 'HUAY-HUAY', 110),
(1113, 'MARCAPOMACOCHA', 110),
(1114, 'MOROCOCHA', 110),
(1115, 'PACCHA', 110),
(1116, 'SANTA BARBARA DE CARHUACAYAN', 110),
(1117, 'SANTA ROSA DE SACCO', 110),
(1118, 'SUITUCANCHA', 110),
(1119, 'YAULI', 110),
(1120, 'CHUPACA', 111),
(1121, 'AHUAC', 111),
(1122, 'CHONGOS BAJO', 111),
(1123, 'HUACHAC', 111),
(1124, 'HUAMANCACA CHICO', 111),
(1125, 'SAN JUAN DE ISCOS', 111),
(1126, 'SAN JUAN DE JARPA', 111),
(1127, 'TRES DE DICIEMBRE', 111),
(1128, 'YANACANCHA', 111),
(1129, 'TRUJILLO', 112),
(1130, 'EL PORVENIR', 112),
(1131, 'FLORENCIA DE MORA', 112),
(1132, 'HUANCHACO', 112),
(1133, 'LA ESPERANZA', 112),
(1134, 'LAREDO', 112),
(1135, 'MOCHE', 112),
(1136, 'POROTO', 112),
(1137, 'SALAVERRY', 112),
(1138, 'SIMBAL', 112),
(1139, 'VICTOR LARCO HERRERA', 112),
(1140, 'ASCOPE', 113),
(1141, 'CHICAMA', 113),
(1142, 'CHOCOPE', 113),
(1143, 'MAGDALENA DE CAO', 113),
(1144, 'PAIJAN', 113),
(1145, 'RAZURI', 113),
(1146, 'SANTIAGO DE CAO', 113),
(1147, 'CASA GRANDE', 113),
(1148, 'BOLIVAR', 114),
(1149, 'BAMBAMARCA', 114),
(1150, 'CONDORMARCA', 114),
(1151, 'LONGOTEA', 114),
(1152, 'UCHUMARCA', 114),
(1153, 'UCUNCHA', 114),
(1154, 'CHEPEN', 115),
(1155, 'PACANGA', 115),
(1156, 'PUEBLO NUEVO', 115),
(1157, 'JULCAN', 116),
(1158, 'CALAMARCA', 116),
(1159, 'CARABAMBA', 116),
(1160, 'HUASO', 116),
(1161, 'OTUZCO', 117),
(1162, 'AGALLPAMPA', 117),
(1163, 'CHARAT', 117),
(1164, 'HUARANCHAL', 117),
(1165, 'LA CUESTA', 117),
(1166, 'MACHE', 117),
(1167, 'PARANDAY', 117),
(1168, 'SALPO', 117),
(1169, 'SINSICAP', 117),
(1170, 'USQUIL', 117),
(1171, 'SAN PEDRO DE LLOC', 118),
(1172, 'GUADALUPE', 118),
(1173, 'JEQUETEPEQUE', 118),
(1174, 'PACASMAYO', 118),
(1175, 'SAN JOSE', 118),
(1176, 'TAYABAMBA', 119),
(1177, 'BULDIBUYO', 119),
(1178, 'CHILLIA', 119),
(1179, 'HUANCASPATA', 119),
(1180, 'HUAYLILLAS', 119),
(1181, 'HUAYO', 119),
(1182, 'ONGON', 119),
(1183, 'PARCOY', 119),
(1184, 'PATAZ', 119),
(1185, 'PIAS', 119),
(1186, 'SANTIAGO DE CHALLAS', 119),
(1187, 'TAURIJA', 119),
(1188, 'URPAY', 119),
(1189, 'HUAMACHUCO', 120),
(1190, 'CHUGAY', 120),
(1191, 'COCHORCO', 120),
(1192, 'CURGOS', 120),
(1193, 'MARCABAL', 120),
(1194, 'SANAGORAN', 120),
(1195, 'SARIN', 120),
(1196, 'SARTIMBAMBA', 120),
(1197, 'SANTIAGO DE CHUCO', 121),
(1198, 'ANGASMARCA', 121),
(1199, 'CACHICADAN', 121),
(1200, 'MOLLEBAMBA', 121),
(1201, 'MOLLEPATA', 121),
(1202, 'QUIRUVILCA', 121),
(1203, 'SANTA CRUZ DE CHUCA', 121),
(1204, 'SITABAMBA', 121),
(1205, 'GRAN CHIMU', 122),
(1206, 'CASCAS', 122),
(1207, 'LUCMA', 122),
(1208, 'MARMOT', 122),
(1209, 'SAYAPULLO', 122),
(1210, 'VIRU', 123),
(1211, 'CHAO', 123),
(1212, 'GUADALUPITO', 123),
(1213, 'CHICLAYO', 124),
(1214, 'CHONGOYAPE', 124),
(1215, 'ETEN', 124),
(1216, 'ETEN PUERTO', 124),
(1217, 'JOSE LEONARDO ORTIZ', 124),
(1218, 'LA VICTORIA', 124),
(1219, 'LAGUNAS', 124),
(1220, 'MONSEFU', 124),
(1221, 'NUEVA ARICA', 124),
(1222, 'OYOTUN', 124),
(1223, 'PICSI', 124),
(1224, 'PIMENTEL', 124),
(1225, 'REQUE', 124),
(1226, 'SANTA ROSA', 124),
(1227, 'SA&Ntilde;A', 124),
(1228, 'CAYALTI', 124),
(1229, 'PATAPO', 124),
(1230, 'POMALCA', 124),
(1231, 'PUCALA', 124),
(1232, 'TUMAN', 124),
(1233, 'FERRE&Ntilde;AFE', 125),
(1234, 'CA&Ntilde;ARIS', 125),
(1235, 'INCAHUASI', 125),
(1236, 'MANUEL ANTONIO MESONES MURO', 125),
(1237, 'PITIPO', 125),
(1238, 'PUEBLO NUEVO', 125),
(1239, 'LAMBAYEQUE', 126),
(1240, 'CHOCHOPE', 126),
(1241, 'ILLIMO', 126),
(1242, 'JAYANCA', 126),
(1243, 'MOCHUMI', 126),
(1244, 'MORROPE', 126),
(1245, 'MOTUPE', 126),
(1246, 'OLMOS', 126),
(1247, 'PACORA', 126),
(1248, 'SALAS', 126),
(1249, 'SAN JOSE', 126),
(1250, 'TUCUME', 126),
(1251, 'LIMA', 127),
(1252, 'ANCON', 127),
(1253, 'ATE', 127),
(1254, 'BARRANCO', 127),
(1255, 'BRE&Ntilde;A', 127),
(1256, 'CARABAYLLO', 127),
(1257, 'CHACLACAYO', 127),
(1258, 'CHORRILLOS', 127),
(1259, 'CIENEGUILLA', 127),
(1260, 'COMAS', 127),
(1261, 'EL AGUSTINO', 127),
(1262, 'INDEPENDENCIA', 127),
(1263, 'JESUS MARIA', 127),
(1264, 'LA MOLINA', 127),
(1265, 'LA VICTORIA', 127),
(1266, 'LINCE', 127),
(1267, 'LOS OLIVOS', 127),
(1268, 'LURIGANCHO', 127),
(1269, 'LURIN', 127),
(1270, 'MAGDALENA DEL MAR', 127),
(1271, 'MAGDALENA VIEJA', 127),
(1272, 'MIRAFLORES', 127),
(1273, 'PACHACAMAC', 127),
(1274, 'PUCUSANA', 127),
(1275, 'PUENTE PIEDRA', 127),
(1276, 'PUNTA HERMOSA', 127),
(1277, 'PUNTA NEGRA', 127),
(1278, 'RIMAC', 127),
(1279, 'SAN BARTOLO', 127),
(1280, 'SAN BORJA', 127),
(1281, 'SAN ISIDRO', 127),
(1282, 'SAN JUAN DE LURIGANCHO', 127),
(1283, 'SAN JUAN DE MIRAFLORES', 127),
(1284, 'SAN LUIS', 127),
(1285, 'SAN MARTIN DE PORRES', 127),
(1286, 'SAN MIGUEL', 127),
(1287, 'SANTA ANITA', 127),
(1288, 'SANTA MARIA DEL MAR', 127),
(1289, 'SANTA ROSA', 127),
(1290, 'SANTIAGO DE SURCO', 127),
(1291, 'SURQUILLO', 127),
(1292, 'VILLA EL SALVADOR', 127),
(1293, 'VILLA MARIA DEL TRIUNFO', 127),
(1294, 'BARRANCA', 128),
(1295, 'PARAMONGA', 128),
(1296, 'PATIVILCA', 128),
(1297, 'SUPE', 128),
(1298, 'SUPE PUERTO', 128),
(1299, 'CAJATAMBO', 129),
(1300, 'COPA', 129),
(1301, 'GORGOR', 129),
(1302, 'HUANCAPON', 129),
(1303, 'MANAS', 129),
(1304, 'CANTA', 130),
(1305, 'ARAHUAY', 130),
(1306, 'HUAMANTANGA', 130),
(1307, 'HUAROS', 130),
(1308, 'LACHAQUI', 130),
(1309, 'SAN BUENAVENTURA', 130),
(1310, 'SANTA ROSA DE QUIVES', 130),
(1311, 'SAN VICENTE DE CA&Ntilde;ETE', 131),
(1312, 'ASIA', 131),
(1313, 'CALANGO', 131),
(1314, 'CERRO AZUL', 131),
(1315, 'CHILCA', 131),
(1316, 'COAYLLO', 131),
(1317, 'IMPERIAL', 131),
(1318, 'LUNAHUANA', 131),
(1319, 'MALA', 131),
(1320, 'NUEVO IMPERIAL', 131),
(1321, 'PACARAN', 131),
(1322, 'QUILMANA', 131),
(1323, 'SAN ANTONIO', 131),
(1324, 'SAN LUIS', 131),
(1325, 'SANTA CRUZ DE FLORES', 131),
(1326, 'ZU&Ntilde;IGA', 131),
(1327, 'HUARAL', 132),
(1328, 'ATAVILLOS ALTO', 132),
(1329, 'ATAVILLOS BAJO', 132),
(1330, 'AUCALLAMA', 132),
(1331, 'CHANCAY', 132),
(1332, 'IHUARI', 132),
(1333, 'LAMPIAN', 132),
(1334, 'PACARAOS', 132),
(1335, 'SAN MIGUEL DE ACOS', 132),
(1336, 'SANTA CRUZ DE ANDAMARCA', 132),
(1337, 'SUMBILCA', 132),
(1338, 'VEINTISIETE DE NOVIEMBRE', 132),
(1339, 'MATUCANA', 133),
(1340, 'ANTIOQUIA', 133),
(1341, 'CALLAHUANCA', 133),
(1342, 'CARAMPOMA', 133),
(1343, 'CHICLA', 133),
(1344, 'CUENCA', 133),
(1345, 'HUACHUPAMPA', 133),
(1346, 'HUANZA', 133),
(1347, 'HUAROCHIRI', 133),
(1348, 'LAHUAYTAMBO', 133),
(1349, 'LANGA', 133),
(1350, 'LARAOS', 133),
(1351, 'MARIATANA', 133),
(1352, 'RICARDO PALMA', 133),
(1353, 'SAN ANDRES DE TUPICOCHA', 133),
(1354, 'SAN ANTONIO', 133),
(1355, 'SAN BARTOLOME', 133),
(1356, 'SAN DAMIAN', 133),
(1357, 'SAN JUAN DE IRIS', 133),
(1358, 'SAN JUAN DE TANTARANCHE', 133),
(1359, 'SAN LORENZO DE QUINTI', 133),
(1360, 'SAN MATEO', 133),
(1361, 'SAN MATEO DE OTAO', 133),
(1362, 'SAN PEDRO DE CASTA', 133),
(1363, 'SAN PEDRO DE HUANCAYRE', 133),
(1364, 'SANGALLAYA', 133),
(1365, 'SANTA CRUZ DE COCACHACRA', 133),
(1366, 'SANTA EULALIA', 133),
(1367, 'SANTIAGO DE ANCHUCAYA', 133),
(1368, 'SANTIAGO DE TUNA', 133),
(1369, 'SANTO DOMINGO DE LOS OLLEROS', 133),
(1370, 'SURCO', 133),
(1371, 'HUACHO', 134),
(1372, 'AMBAR', 134),
(1373, 'CALETA DE CARQUIN', 134),
(1374, 'CHECRAS', 134),
(1375, 'HUALMAY', 134),
(1376, 'HUAURA', 134),
(1377, 'LEONCIO PRADO', 134),
(1378, 'PACCHO', 134),
(1379, 'SANTA LEONOR', 134),
(1380, 'SANTA MARIA', 134),
(1381, 'SAYAN', 134),
(1382, 'VEGUETA', 134),
(1383, 'OYON', 135),
(1384, 'ANDAJES', 135),
(1385, 'CAUJUL', 135),
(1386, 'COCHAMARCA', 135),
(1387, 'NAVAN', 135),
(1388, 'PACHANGARA', 135),
(1389, 'YAUYOS', 136),
(1390, 'ALIS', 136),
(1391, 'AYAUCA', 136),
(1392, 'AYAVIRI', 136),
(1393, 'AZANGARO', 136),
(1394, 'CACRA', 136),
(1395, 'CARANIA', 136),
(1396, 'CATAHUASI', 136),
(1397, 'CHOCOS', 136),
(1398, 'COCHAS', 136),
(1399, 'COLONIA', 136),
(1400, 'HONGOS', 136),
(1401, 'HUAMPARA', 136),
(1402, 'HUANCAYA', 136),
(1403, 'HUANGASCAR', 136),
(1404, 'HUANTAN', 136),
(1405, 'HUA&Ntilde;EC', 136),
(1406, 'LARAOS', 136),
(1407, 'LINCHA', 136),
(1408, 'MADEAN', 136),
(1409, 'MIRAFLORES', 136),
(1410, 'OMAS', 136),
(1411, 'PUTINZA', 136),
(1412, 'QUINCHES', 136),
(1413, 'QUINOCAY', 136),
(1414, 'SAN JOAQUIN', 136),
(1415, 'SAN PEDRO DE PILAS', 136),
(1416, 'TANTA', 136),
(1417, 'TAURIPAMPA', 136),
(1418, 'TOMAS', 136),
(1419, 'TUPE', 136),
(1420, 'VI&Ntilde;AC', 136),
(1421, 'VITIS', 136),
(1422, 'IQUITOS', 137),
(1423, 'ALTO NANAY', 137),
(1424, 'FERNANDO LORES', 137),
(1425, 'INDIANA', 137),
(1426, 'LAS AMAZONAS', 137),
(1427, 'MAZAN', 137),
(1428, 'NAPO', 137),
(1429, 'PUNCHANA', 137),
(1430, 'PUTUMAYO', 137),
(1431, 'TORRES CAUSANA', 137),
(1432, 'BELEN', 137),
(1433, 'SAN JUAN BAUTISTA', 137),
(1434, 'YURIMAGUAS', 138),
(1435, 'BALSAPUERTO', 138),
(1436, 'BARRANCA', 138),
(1437, 'CAHUAPANAS', 138),
(1438, 'JEBEROS', 138),
(1439, 'LAGUNAS', 138),
(1440, 'MANSERICHE', 138),
(1441, 'MORONA', 138),
(1442, 'PASTAZA', 138),
(1443, 'SANTA CRUZ', 138),
(1444, 'TENIENTE CESAR LOPEZ ROJAS', 138),
(1445, 'NAUTA', 139),
(1446, 'PARINARI', 139),
(1447, 'TIGRE', 139),
(1448, 'TROMPETEROS', 139),
(1449, 'URARINAS', 139),
(1450, 'RAMON CASTILLA', 140),
(1451, 'PEBAS', 140),
(1452, 'YAVARI', 140),
(1453, 'SAN PABLO', 140),
(1454, 'REQUENA', 141),
(1455, 'ALTO TAPICHE', 141),
(1456, 'CAPELO', 141),
(1457, 'EMILIO SAN MARTIN', 141),
(1458, 'MAQUIA', 141),
(1459, 'PUINAHUA', 141),
(1460, 'SAQUENA', 141),
(1461, 'SOPLIN', 141),
(1462, 'TAPICHE', 141),
(1463, 'JENARO HERRERA', 141),
(1464, 'YAQUERANA', 141),
(1465, 'CONTAMANA', 142),
(1466, 'INAHUAYA', 142),
(1467, 'PADRE MARQUEZ', 142),
(1468, 'PAMPA HERMOSA', 142),
(1469, 'SARAYACU', 142),
(1470, 'VARGAS GUERRA', 142),
(1471, 'TAMBOPATA', 143),
(1472, 'INAMBARI', 143),
(1473, 'LAS PIEDRAS', 143),
(1474, 'LABERINTO', 143),
(1475, 'MANU', 144),
(1476, 'FITZCARRALD', 144),
(1477, 'MADRE DE DIOS', 144),
(1478, 'HUEPETUHE', 144),
(1479, 'I&Ntilde;APARI', 145),
(1480, 'IBERIA', 145),
(1481, 'TAHUAMANU', 145),
(1482, 'MOQUEGUA', 146),
(1483, 'CARUMAS', 146),
(1484, 'CUCHUMBAYA', 146),
(1485, 'SAMEGUA', 146),
(1486, 'SAN CRISTOBAL', 146),
(1487, 'TORATA', 146),
(1488, 'OMATE', 147),
(1489, 'CHOJATA', 147),
(1490, 'COALAQUE', 147),
(1491, 'ICHU&Ntilde;A', 147),
(1492, 'LA CAPILLA', 147),
(1493, 'LLOQUE', 147),
(1494, 'MATALAQUE', 147),
(1495, 'PUQUINA', 147),
(1496, 'QUINISTAQUILLAS', 147),
(1497, 'UBINAS', 147),
(1498, 'YUNGA', 147),
(1499, 'ILO', 148),
(1500, 'EL ALGARROBAL', 148),
(1501, 'PACOCHA', 148),
(1502, 'CHAUPIMARCA', 149),
(1503, 'HUACHON', 149),
(1504, 'HUARIACA', 149),
(1505, 'HUAYLLAY', 149),
(1506, 'NINACACA', 149),
(1507, 'PALLANCHACRA', 149),
(1508, 'PAUCARTAMBO', 149),
(1509, 'SAN FCO.DE ASIS DE YARUSYACAN', 149),
(1510, 'SIMON BOLIVAR', 149),
(1511, 'TICLACAYAN', 149),
(1512, 'TINYAHUARCO', 149),
(1513, 'VICCO', 149),
(1514, 'YANACANCHA', 149),
(1515, 'YANAHUANCA', 150),
(1516, 'CHACAYAN', 150),
(1517, 'GOYLLARISQUIZGA', 150),
(1518, 'PAUCAR', 150),
(1519, 'SAN PEDRO DE PILLAO', 150),
(1520, 'SANTA ANA DE TUSI', 150),
(1521, 'TAPUC', 150),
(1522, 'VILCABAMBA', 150),
(1523, 'OXAPAMPA', 151),
(1524, 'CHONTABAMBA', 151),
(1525, 'HUANCABAMBA', 151),
(1526, 'PALCAZU', 151),
(1527, 'POZUZO', 151),
(1528, 'PUERTO BERMUDEZ', 151),
(1529, 'VILLA RICA', 151),
(1530, 'PIURA', 152),
(1531, 'CASTILLA', 152),
(1532, 'CATACAOS', 152),
(1533, 'CURA MORI', 152),
(1534, 'EL TALLAN', 152),
(1535, 'LA ARENA', 152),
(1536, 'LA UNION', 152),
(1537, 'LAS LOMAS', 152),
(1538, 'TAMBO GRANDE', 152),
(1539, 'AYABACA', 153),
(1540, 'FRIAS', 153),
(1541, 'JILILI', 153),
(1542, 'LAGUNAS', 153),
(1543, 'MONTERO', 153),
(1544, 'PACAIPAMPA', 153),
(1545, 'PAIMAS', 153),
(1546, 'SAPILLICA', 153),
(1547, 'SICCHEZ', 153),
(1548, 'SUYO', 153),
(1549, 'HUANCABAMBA', 154),
(1550, 'CANCHAQUE', 154),
(1551, 'EL CARMEN DE LA FRONTERA', 154),
(1552, 'HUARMACA', 154),
(1553, 'LALAQUIZ', 154),
(1554, 'SAN MIGUEL DE EL FAIQUE', 154),
(1555, 'SONDOR', 154),
(1556, 'SONDORILLO', 154),
(1557, 'CHULUCANAS', 155),
(1558, 'BUENOS AIRES', 155),
(1559, 'CHALACO', 155),
(1560, 'LA MATANZA', 155),
(1561, 'MORROPON', 155),
(1562, 'SALITRAL', 155),
(1563, 'SAN JUAN DE BIGOTE', 155),
(1564, 'SANTA CATALINA DE MOSSA', 155),
(1565, 'SANTO DOMINGO', 155),
(1566, 'YAMANGO', 155),
(1567, 'PAITA', 156),
(1568, 'AMOTAPE', 156),
(1569, 'ARENAL', 156),
(1570, 'COLAN', 156),
(1571, 'LA HUACA', 156),
(1572, 'TAMARINDO', 156),
(1573, 'VICHAYAL', 156),
(1574, 'SULLANA', 157),
(1575, 'BELLAVISTA', 157),
(1576, 'IGNACIO ESCUDERO', 157),
(1577, 'LANCONES', 157),
(1578, 'MARCAVELICA', 157),
(1579, 'MIGUEL CHECA', 157),
(1580, 'QUERECOTILLO', 157),
(1581, 'SALITRAL', 157),
(1582, 'PARI&Ntilde;AS', 158),
(1583, 'EL ALTO', 158),
(1584, 'LA BREA', 158),
(1585, 'LOBITOS', 158),
(1586, 'LOS ORGANOS', 158),
(1587, 'MANCORA', 158),
(1588, 'SECHURA', 159),
(1589, 'BELLAVISTA DE LA UNION', 159),
(1590, 'BERNAL', 159),
(1591, 'CRISTO NOS VALGA', 159),
(1592, 'VICE', 159),
(1593, 'RINCONADA LLICUAR', 159),
(1594, 'PUNO', 160),
(1595, 'ACORA', 160),
(1596, 'AMANTANI', 160),
(1597, 'ATUNCOLLA', 160),
(1598, 'CAPACHICA', 160),
(1599, 'CHUCUITO', 160),
(1600, 'COATA', 160),
(1601, 'HUATA', 160),
(1602, 'MA&Ntilde;AZO', 160),
(1603, 'PAUCARCOLLA', 160),
(1604, 'PICHACANI', 160),
(1605, 'PLATERIA', 160),
(1606, 'SAN ANTONIO', 160),
(1607, 'TIQUILLACA', 160),
(1608, 'VILQUE', 160),
(1609, 'AZANGARO', 161),
(1610, 'ACHAYA', 161),
(1611, 'ARAPA', 161),
(1612, 'ASILLO', 161),
(1613, 'CAMINACA', 161),
(1614, 'CHUPA', 161),
(1615, 'JOSE DOMINGO CHOQUEHUANCA', 161),
(1616, 'MU&Ntilde;ANI', 161),
(1617, 'POTONI', 161),
(1618, 'SAMAN', 161),
(1619, 'SAN ANTON', 161),
(1620, 'SAN JOSE', 161),
(1621, 'SAN JUAN DE SALINAS', 161),
(1622, 'SANTIAGO DE PUPUJA', 161),
(1623, 'TIRAPATA', 161),
(1624, 'MACUSANI', 162),
(1625, 'AJOYANI', 162),
(1626, 'AYAPATA', 162),
(1627, 'COASA', 162),
(1628, 'CORANI', 162),
(1629, 'CRUCERO', 162),
(1630, 'ITUATA', 162),
(1631, 'OLLACHEA', 162),
(1632, 'SAN GABAN', 162),
(1633, 'USICAYOS', 162),
(1634, 'JULI', 163),
(1635, 'DESAGUADERO', 163),
(1636, 'HUACULLANI', 163),
(1637, 'KELLUYO', 163),
(1638, 'PISACOMA', 163),
(1639, 'POMATA', 163),
(1640, 'ZEPITA', 163),
(1641, 'ILAVE', 164),
(1642, 'CAPAZO', 164),
(1643, 'PILCUYO', 164),
(1644, 'SANTA ROSA', 164),
(1645, 'CONDURIRI', 164),
(1646, 'HUANCANE', 165),
(1647, 'COJATA', 165),
(1648, 'HUATASANI', 165),
(1649, 'INCHUPALLA', 165),
(1650, 'PUSI', 165),
(1651, 'ROSASPATA', 165),
(1652, 'TARACO', 165),
(1653, 'VILQUE CHICO', 165),
(1654, 'LAMPA', 166),
(1655, 'CABANILLA', 166),
(1656, 'CALAPUJA', 166),
(1657, 'NICASIO', 166),
(1658, 'OCUVIRI', 166),
(1659, 'PALCA', 166),
(1660, 'PARATIA', 166),
(1661, 'PUCARA', 166),
(1662, 'SANTA LUCIA', 166),
(1663, 'VILAVILA', 166),
(1664, 'AYAVIRI', 167),
(1665, 'ANTAUTA', 167),
(1666, 'CUPI', 167),
(1667, 'LLALLI', 167),
(1668, 'MACARI', 167),
(1669, 'NU&Ntilde;OA', 167),
(1670, 'ORURILLO', 167),
(1671, 'SANTA ROSA', 167),
(1672, 'UMACHIRI', 167),
(1673, 'MOHO', 168),
(1674, 'CONIMA', 168),
(1675, 'HUAYRAPATA', 168),
(1676, 'TILALI', 168),
(1677, 'PUTINA', 169),
(1678, 'ANANEA', 169),
(1679, 'PEDRO VILCA APAZA', 169),
(1680, 'QUILCAPUNCU', 169),
(1681, 'SINA', 169),
(1682, 'JULIACA', 170),
(1683, 'CABANA', 170),
(1684, 'CABANILLAS', 170),
(1685, 'CARACOTO', 170),
(1686, 'SANDIA', 171),
(1687, 'CUYOCUYO', 171),
(1688, 'LIMBANI', 171),
(1689, 'PATAMBUCO', 171),
(1690, 'PHARA', 171),
(1691, 'QUIACA', 171),
(1692, 'SAN JUAN DEL ORO', 171),
(1693, 'YANAHUAYA', 171),
(1694, 'ALTO INAMBARI', 171),
(1695, 'YUNGUYO', 172),
(1696, 'ANAPIA', 172),
(1697, 'COPANI', 172),
(1698, 'CUTURAPI', 172),
(1699, 'OLLARAYA', 172),
(1700, 'TINICACHI', 172),
(1701, 'UNICACHI', 172),
(1702, 'MOYOBAMBA', 173),
(1703, 'CALZADA', 173),
(1704, 'HABANA', 173),
(1705, 'JEPELACIO', 173),
(1706, 'SORITOR', 173),
(1707, 'YANTALO', 173),
(1708, 'BELLAVISTA', 174),
(1709, 'ALTO BIAVO', 174),
(1710, 'BAJO BIAVO', 174),
(1711, 'HUALLAGA', 174),
(1712, 'SAN PABLO', 174),
(1713, 'SAN RAFAEL', 174),
(1714, 'SAN JOSE DE SISA', 175),
(1715, 'AGUA BLANCA', 175),
(1716, 'SAN MARTIN', 175),
(1717, 'SANTA ROSA', 175),
(1718, 'SHATOJA', 175),
(1719, 'SAPOSOA', 176),
(1720, 'ALTO SAPOSOA', 176),
(1721, 'EL ESLABON', 176),
(1722, 'PISCOYACU', 176),
(1723, 'SACANCHE', 176),
(1724, 'TINGO DE SAPOSOA', 176),
(1725, 'LAMAS', 177),
(1726, 'ALONSO DE ALVARADO', 177),
(1727, 'BARRANQUITA', 177),
(1728, 'CAYNARACHI', 177),
(1729, 'CU&Ntilde;UMBUQUI', 177),
(1730, 'PINTO RECODO', 177),
(1731, 'RUMISAPA', 177),
(1732, 'SAN ROQUE DE CUMBAZA', 177),
(1733, 'SHANAO', 177),
(1734, 'TABALOSOS', 177),
(1735, 'ZAPATERO', 177),
(1736, 'JUANJUI', 178),
(1737, 'CAMPANILLA', 178),
(1738, 'HUICUNGO', 178),
(1739, 'PACHIZA', 178),
(1740, 'PAJARILLO', 178),
(1741, 'PICOTA', 179),
(1742, 'BUENOS AIRES', 179),
(1743, 'CASPISAPA', 179),
(1744, 'PILLUANA', 179),
(1745, 'PUCACACA', 179),
(1746, 'SAN CRISTOBAL', 179),
(1747, 'SAN HILARION', 179),
(1748, 'SHAMBOYACU', 179),
(1749, 'TINGO DE PONASA', 179),
(1750, 'TRES UNIDOS', 179),
(1751, 'RIOJA', 180),
(1752, 'AWAJUN', 180),
(1753, 'ELIAS SOPLIN VARGAS', 180),
(1754, 'NUEVA CAJAMARCA', 180),
(1755, 'PARDO MIGUEL', 180),
(1756, 'POSIC', 180),
(1757, 'SAN FERNANDO', 180),
(1758, 'YORONGOS', 180),
(1759, 'YURACYACU', 180),
(1760, 'TARAPOTO', 181),
(1761, 'ALBERTO LEVEAU', 181),
(1762, 'CACATACHI', 181),
(1763, 'CHAZUTA', 181),
(1764, 'CHIPURANA', 181),
(1765, 'EL PORVENIR', 181),
(1766, 'HUIMBAYOC', 181),
(1767, 'JUAN GUERRA', 181),
(1768, 'LA BANDA DE SHILCAYO', 181),
(1769, 'MORALES', 181),
(1770, 'PAPAPLAYA', 181),
(1771, 'SAN ANTONIO', 181),
(1772, 'SAUCE', 181),
(1773, 'SHAPAJA', 181),
(1774, 'TOCACHE', 182),
(1775, 'NUEVO PROGRESO', 182),
(1776, 'POLVORA', 182),
(1777, 'SHUNTE', 182),
(1778, 'UCHIZA', 182),
(1779, 'TACNA', 183),
(1780, 'ALTO DE LA ALIANZA', 183),
(1781, 'CALANA', 183),
(1782, 'CIUDAD NUEVA', 183),
(1783, 'INCLAN', 183),
(1784, 'PACHIA', 183),
(1785, 'PALCA', 183),
(1786, 'POCOLLAY', 183),
(1787, 'SAMA', 183),
(1788, 'CORONEL GREGORIO ALBARRACIN LANCHIPA', 183),
(1789, 'CANDARAVE', 184),
(1790, 'CAIRANI', 184),
(1791, 'CAMILACA', 184),
(1792, 'CURIBAYA', 184),
(1793, 'HUANUARA', 184),
(1794, 'QUILAHUANI', 184),
(1795, 'LOCUMBA', 185),
(1796, 'ILABAYA', 185),
(1797, 'ITE', 185),
(1798, 'TARATA', 186),
(1799, 'CHUCATAMANI', 186),
(1800, 'ESTIQUE', 186),
(1801, 'ESTIQUE-PAMPA', 186),
(1802, 'SITAJARA', 186),
(1803, 'SUSAPAYA', 186),
(1804, 'TARUCACHI', 186),
(1805, 'TICACO', 186),
(1806, 'TUMBES', 187),
(1807, 'CORRALES', 187),
(1808, 'LA CRUZ', 187),
(1809, 'PAMPAS DE HOSPITAL', 187),
(1810, 'SAN JACINTO', 187),
(1811, 'SAN JUAN DE LA VIRGEN', 187),
(1812, 'ZORRITOS', 188),
(1813, 'CASITAS', 188),
(1814, 'ZARUMILLA', 189),
(1815, 'AGUAS VERDES', 189),
(1816, 'MATAPALO', 189),
(1817, 'PAPAYAL', 189),
(1818, 'CALLERIA', 190),
(1819, 'CAMPOVERDE', 190),
(1820, 'IPARIA', 190),
(1821, 'MASISEA', 190),
(1822, 'YARINACOCHA', 190),
(1823, 'NUEVA REQUENA', 190),
(1824, 'RAYMONDI', 191),
(1825, 'SEPAHUA', 191),
(1826, 'TAHUANIA', 191),
(1827, 'YURUA', 191),
(1828, 'PADRE ABAD', 192),
(1829, 'IRAZOLA', 192),
(1830, 'CURIMANA', 192),
(1831, 'PURUS', 193);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_especialidad`
--

DROP TABLE IF EXISTS `tab_especialidad`;
CREATE TABLE IF NOT EXISTS `tab_especialidad` (
  `idEspecialidad` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(150) NOT NULL,
  `Estado_idEstado` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`idEspecialidad`),
  KEY `FK_ESP_ESTADO` (`Estado_idEstado`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_especialidad`
--

INSERT INTO `tab_especialidad` (`idEspecialidad`, `Descripcion`, `Estado_idEstado`, `fechaRegistro`) VALUES
(4, 'ENDICRONOLOGIA', 1, '2019-02-09 18:34:51'),
(5, 'NEUROLOGIA', 1, '2019-02-09 18:35:00'),
(6, 'EV. FONDO DE OJO', 1, '2019-02-09 18:35:17'),
(7, 'CARDIOLOGIA', 1, '2019-02-09 18:35:27'),
(8, 'C. CARDIOVASCULAR', 1, '2019-02-09 18:35:50'),
(9, 'UROLOGIA', 1, '2019-02-09 18:36:01'),
(10, 'DENTAL', 1, '2019-02-09 18:36:09'),
(11, 'PODOLOGIA', 1, '2019-02-09 18:36:19'),
(12, 'PACIENTE CONTROLADO', 1, '2019-02-09 18:36:29'),
(13, 'NUTRICIÓN', 1, '2019-02-09 18:36:46'),
(14, 'PSICOLOGIA', 1, '2019-02-09 18:36:57'),
(15, 'FISIOTERAPIA', 1, '2019-02-09 18:37:08'),
(16, 'OTROS', 1, '2019-02-09 18:37:15'),
(18, 'INDICACIONES', 1, '2019-02-09 18:37:32'),
(19, 'DIAGNOSTICO', 1, '2019-02-09 18:37:41'),
(20, 'EVALUACIÓN FÍSICA DE ENFERMERÍA', 1, '2019-02-09 18:38:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_evaluado`
--

DROP TABLE IF EXISTS `tab_evaluado`;
CREATE TABLE IF NOT EXISTS `tab_evaluado` (
  `idEvaluado` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(150) NOT NULL,
  `Estado_idEstado` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`idEvaluado`),
  KEY `FK_EVA_eSTAD` (`Estado_idEstado`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_evaluado`
--

INSERT INTO `tab_evaluado` (`idEvaluado`, `Descripcion`, `Estado_idEstado`, `fechaRegistro`) VALUES
(1, 'TÉCNICO', 1, '2019-01-19 00:00:00'),
(2, 'PERSONAL DE ENFERMERIA', 1, '2019-01-19 00:00:00'),
(3, 'PODOLOGO', 1, '2019-01-19 00:00:00'),
(4, 'DOCTOR', 1, '2019-01-19 00:00:00'),
(5, 'ASIMISMO', 1, '2019-01-19 00:00:00'),
(6, 'FAMILIAR', 1, '2019-01-19 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_extra`
--

DROP TABLE IF EXISTS `tab_extra`;
CREATE TABLE IF NOT EXISTS `tab_extra` (
  `idExtra` int(11) NOT NULL AUTO_INCREMENT,
  `Refiere` text NOT NULL,
  `Riesgo` text,
  `Seguimiento_idSeguimiento` int(11) NOT NULL,
  PRIMARY KEY (`idExtra`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_extra`
--

INSERT INTO `tab_extra` (`idExtra`, `Refiere`, `Riesgo`, `Seguimiento_idSeguimiento`) VALUES
(1, '', '{&quot;opA1&quot;:1,&quot;opA2&quot;:1,&quot;opA3&quot;:1,&quot;opA4&quot;:1,&quot;opB1&quot;:1,&quot;opB2&quot;:1,&quot;opB3&quot;:1,&quot;opB4&quot;:1,&quot;opC1&quot;:1,&quot;opC2&quot;:1,&quot;opC3&quot;:1,&quot;opC4&quot;:1,&quot;opD1&quot;:1,&quot;opD2&quot;:1,&quot;opE1&quot;:1,&quot;opE2&quot;:1}', 1),
(2, '', '{&quot;opA1&quot;:1,&quot;opA2&quot;:0,&quot;opA3&quot;:1,&quot;opA4&quot;:0,&quot;opB1&quot;:1,&quot;opB2&quot;:0,&quot;opB3&quot;:0,&quot;opB4&quot;:0,&quot;opC1&quot;:1,&quot;opC2&quot;:1,&quot;opC3&quot;:0,&quot;opC4&quot;:1,&quot;opD1&quot;:0,&quot;opD2&quot;:1,&quot;opE1&quot;:0,&quot;opE2&quot;:1}', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_gradoinstruccion`
--

DROP TABLE IF EXISTS `tab_gradoinstruccion`;
CREATE TABLE IF NOT EXISTS `tab_gradoinstruccion` (
  `idGradoInstruccion` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(150) NOT NULL,
  `Estado_idEstado` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`idGradoInstruccion`),
  KEY `FK_GRADOP_ESTADO` (`Estado_idEstado`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_gradoinstruccion`
--

INSERT INTO `tab_gradoinstruccion` (`idGradoInstruccion`, `Descripcion`, `Estado_idEstado`, `fechaRegistro`) VALUES
(1, 'ESTUDIANTE', 1, '2019-02-07 16:15:05'),
(2, 'UNIVERSITARIO', 1, '2019-02-07 16:15:12'),
(3, 'PRIMARIA COMPLETA', 1, '2019-02-07 16:15:20'),
(4, 'SECUNDARIA COMPLETA', 1, '2019-02-07 16:15:26'),
(5, 'TRABAJADOR INDEPENDIENTE', 1, '2019-02-07 16:16:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_grupoopcion`
--

DROP TABLE IF EXISTS `tab_grupoopcion`;
CREATE TABLE IF NOT EXISTS `tab_grupoopcion` (
  `idGrupoOpcion` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(150) NOT NULL,
  `Estado_idEstado` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`idGrupoOpcion`),
  KEY `FK_GRUPO_eSTA` (`Estado_idEstado`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_grupoopcion`
--

INSERT INTO `tab_grupoopcion` (`idGrupoOpcion`, `Descripcion`, `Estado_idEstado`, `fechaRegistro`) VALUES
(1, 'DATOS DEL SEGUIMIENTO', 1, '2019-01-19 14:35:55'),
(5, 'OTROS TRATAMIENTOS', 1, '2019-02-10 11:25:10'),
(6, 'DATOS ADICIONALES', 1, '2019-02-10 19:12:43'),
(7, 'FICHA DE SEGUIMIENTO', 1, '2019-02-11 13:47:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_medico`
--

DROP TABLE IF EXISTS `tab_medico`;
CREATE TABLE IF NOT EXISTS `tab_medico` (
  `idMedico` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellidoPaterno` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellidoMaterno` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `edad` int(11) NOT NULL,
  `dni` char(18) NOT NULL,
  `Telefono` char(9) DEFAULT NULL,
  `Celular` char(11) DEFAULT NULL,
  `Correo` varchar(100) DEFAULT NULL,
  `Sexo_idSexo` int(11) NOT NULL,
  `Perfil_idPerfil` int(11) NOT NULL,
  `Estado_idEstado` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`idMedico`),
  KEY `FK_SEXO` (`Sexo_idSexo`),
  KEY `FK_Perfil` (`Perfil_idPerfil`),
  KEY `FK_EstadoMEDIC` (`Estado_idEstado`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_medico`
--

INSERT INTO `tab_medico` (`idMedico`, `nombres`, `apellidoPaterno`, `apellidoMaterno`, `fechaNacimiento`, `edad`, `dni`, `Telefono`, `Celular`, `Correo`, `Sexo_idSexo`, `Perfil_idPerfil`, `Estado_idEstado`, `fechaRegistro`) VALUES
(1, 'Lucas mario', 'Román', 'Vela', '1959-11-12', 59, '47444444', NULL, NULL, NULL, 1, 11, 1, '2019-02-09 19:19:57'),
(2, 'Gabriel', 'Mendoza', 'Damián', '1966-11-24', 52, '23525234', NULL, NULL, NULL, 1, 11, 1, '2019-02-09 19:20:24'),
(3, 'Joaquín', 'Miranda', 'Zuñiga', '1969-06-11', 49, '32423423', '345423524', NULL, NULL, 1, 11, 1, '2019-02-09 19:20:43'),
(4, 'Joaquin', 'Rivera', 'Mosquera', '1955-07-27', 63, '42342342', NULL, NULL, NULL, 1, 11, 1, '2019-03-08 16:18:04'),
(5, 'Lucia', 'River', 'Mendoza', '1955-11-30', 63, '12121212', NULL, NULL, NULL, 2, 11, 1, '2019-03-08 16:20:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_opcion`
--

DROP TABLE IF EXISTS `tab_opcion`;
CREATE TABLE IF NOT EXISTS `tab_opcion` (
  `idOpcion` int(11) NOT NULL AUTO_INCREMENT,
  `TituloOpcion` text NOT NULL,
  `Propiedades` text NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  `Estado_idEstado` int(11) NOT NULL,
  `TipoOpcion_idTipoOpcion` int(11) NOT NULL,
  `GrupoOpcion_idGrupoOpcion` int(11) DEFAULT NULL,
  PRIMARY KEY (`idOpcion`),
  KEY `FK_GrupoOpcion` (`GrupoOpcion_idGrupoOpcion`),
  KEY `FK_EstadoFK` (`Estado_idEstado`),
  KEY `FK_TIPOOPCION` (`TipoOpcion_idTipoOpcion`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_opcion`
--

INSERT INTO `tab_opcion` (`idOpcion`, `TituloOpcion`, `Propiedades`, `fechaRegistro`, `Estado_idEstado`, `TipoOpcion_idTipoOpcion`, `GrupoOpcion_idGrupoOpcion`) VALUES
(4, 'Consejería Diabeto Lógica', '{&quot;TipoOpcion&quot;:1,&quot;CodigoOpcion&quot;:&quot;Cabecera&quot;,&quot;Titulo&quot;:&quot;Consejería Diabeto Lógica&quot;}', '2019-02-10 10:43:10', 1, 1, 1),
(5, 'Glucosa Ayunas', '{&quot;TipoOpcion&quot;:3,&quot;CodigoOpcion&quot;:&quot;Opcion Rango&quot;,&quot;Titulo&quot;:&quot;Glucosa Ayunas&quot;,&quot;Atributo&quot;:&quot;mg/dl.&quot;,&quot;Minimo&quot;:70,&quot;Maximo&quot;:130}', '2019-02-10 10:44:55', 1, 3, 1),
(6, 'Glucosa al Azar', '{&quot;TipoOpcion&quot;:3,&quot;CodigoOpcion&quot;:&quot;Opcion Rango&quot;,&quot;Titulo&quot;:&quot;Glucosa al Azar&quot;,&quot;Atributo&quot;:&quot;mg/dl.&quot;,&quot;Minimo&quot;:70,&quot;Maximo&quot;:130}', '2019-02-10 10:47:59', 1, 3, 1),
(7, 'Glucosa Post prandial', '{&quot;TipoOpcion&quot;:3,&quot;CodigoOpcion&quot;:&quot;Opcion Rango&quot;,&quot;Titulo&quot;:&quot;Glucosa Post prandial&quot;,&quot;Atributo&quot;:&quot;mg/dl.&quot;,&quot;Minimo&quot;:1,&quot;Maximo&quot;:180}', '2019-02-10 10:49:55', 1, 3, 1),
(8, 'Hemoglobina Glicosilada', '{&quot;TipoOpcion&quot;:3,&quot;CodigoOpcion&quot;:&quot;Opcion Rango&quot;,&quot;Titulo&quot;:&quot;Hemoglobina Glicosilada&quot;,&quot;Atributo&quot;:&quot;%&quot;,&quot;Minimo&quot;:5,&quot;Maximo&quot;:7}', '2019-02-10 10:50:43', 1, 3, 1),
(9, 'Colesterol Total', '{&quot;TipoOpcion&quot;:3,&quot;CodigoOpcion&quot;:&quot;Opcion Rango&quot;,&quot;Titulo&quot;:&quot;Colesterol Total&quot;,&quot;Atributo&quot;:&quot;mg/dl.&quot;,&quot;Minimo&quot;:1,&quot;Maximo&quot;:200}', '2019-02-10 10:51:07', 1, 3, 1),
(10, 'HDL-c', '{&quot;TipoOpcion&quot;:4,&quot;CodigoOpcion&quot;:&quot;Opcion Rango-Sexo&quot;,&quot;Titulo&quot;:&quot;HDL-c&quot;,&quot;AtributoHombre&quot;:&quot;mg/dl.&quot;,&quot;MinimoHombre&quot;:40,&quot;MaximoHombre&quot;:9999,&quot;AtributoMujer&quot;:&quot;mg/dl.&quot;,&quot;MinimoMujer&quot;:50,&quot;MaximoMujer&quot;:9999}', '2019-02-10 10:52:31', 1, 4, 1),
(11, 'LDL-c', '{&quot;TipoOpcion&quot;:3,&quot;CodigoOpcion&quot;:&quot;Opcion Rango&quot;,&quot;Titulo&quot;:&quot;LDL-c&quot;,&quot;Atributo&quot;:&quot;mg/dl.&quot;,&quot;Minimo&quot;:1,&quot;Maximo&quot;:100}', '2019-02-10 10:53:04', 1, 3, 1),
(12, 'Triglicérios', '{&quot;TipoOpcion&quot;:3,&quot;CodigoOpcion&quot;:&quot;Opcion Rango&quot;,&quot;Titulo&quot;:&quot;Triglicérios&quot;,&quot;Atributo&quot;:&quot;mg/dl.&quot;,&quot;Minimo&quot;:1,&quot;Maximo&quot;:150}', '2019-02-10 10:54:05', 1, 3, 1),
(13, 'IMC(P/T**)', '{&quot;TipoOpcion&quot;:6,&quot;CodigoOpcion&quot;:&quot;Opcion Formula&quot;,&quot;Titulo&quot;:&quot;IMC(P/T**)&quot;,&quot;minimo&quot;:&quot;18.5&quot;,&quot;maximo&quot;:&quot;24.9&quot;,&quot;variable1&quot;:&quot;TALLA&quot;,&quot;variable2&quot;:&quot;PESO&quot;,&quot;variable3&quot;:&quot;&quot;,&quot;variable4&quot;:&quot;&quot;,&quot;Formula&quot;:&quot;V2SEP/SEP(SEPV1SEPEXPSEP)SEP&quot;}', '2019-02-10 10:56:15', 1, 6, 1),
(16, 'Circunferencia Abdominal', '{&quot;TipoOpcion&quot;:3,&quot;CodigoOpcion&quot;:&quot;Opcion Rango&quot;,&quot;Titulo&quot;:&quot;Circunferencia Abdominal&quot;,&quot;Atributo&quot;:&quot;cm.&quot;,&quot;Minimo&quot;:30,&quot;Maximo&quot;:50}', '2019-02-10 10:59:39', 1, 3, 1),
(17, 'Microalbumimuria', '{&quot;TipoOpcion&quot;:3,&quot;CodigoOpcion&quot;:&quot;Opcion Rango&quot;,&quot;Titulo&quot;:&quot;Microalbumimuria&quot;,&quot;Atributo&quot;:&quot;mg/24h&quot;,&quot;Minimo&quot;:1,&quot;Maximo&quot;:30}', '2019-02-10 11:00:24', 1, 3, 1),
(18, 'Creatinina en Sangre', '{&quot;TipoOpcion&quot;:3,&quot;CodigoOpcion&quot;:&quot;Opcion Rango&quot;,&quot;Titulo&quot;:&quot;Creatinina en Sangre&quot;,&quot;Atributo&quot;:&quot;mg/dl.&quot;,&quot;Minimo&quot;:0.6,&quot;Maximo&quot;:1.1}', '2019-02-10 11:00:53', 1, 3, 1),
(19, 'Presión Arterial', '{&quot;TipoOpcion&quot;:3,&quot;CodigoOpcion&quot;:&quot;Opcion Rango&quot;,&quot;Titulo&quot;:&quot;Presión Arterial&quot;,&quot;Atributo&quot;:&quot;/80 mHg.&quot;,&quot;Minimo&quot;:1,&quot;Maximo&quot;:130}', '2019-02-10 11:01:57', 1, 3, 1),
(20, 'Comorbilidad al Momento de la Captación del caso (Evaluado por el personal capacitado)', '{&quot;TipoOpcion&quot;:1,&quot;CodigoOpcion&quot;:&quot;Cabecera&quot;,&quot;Titulo&quot;:&quot;Comorbilidad al Momento de la Captación del caso (Evaluado por el personal capacitado)&quot;}', '2019-02-10 11:32:38', 1, 1, 5),
(21, 'Comorbilidad', '{&quot;TipoOpcion&quot;:9,&quot;CodigoOpcion&quot;:&quot;Opcion Condición Campos&quot;,&quot;Titulo&quot;:&quot;Comorbilidad&quot;,&quot;TipoCampo&quot;:2}', '2019-02-10 11:33:21', 1, 9, 5),
(22, 'Complicaciones al momento de la Captación del caso (Evaluado por personal de salud entrenado)', '{&quot;TipoOpcion&quot;:1,&quot;CodigoOpcion&quot;:&quot;Cabecera&quot;,&quot;Titulo&quot;:&quot;Complicaciones al momento de la Captación del caso (Evaluado por personal de salud entrenado)&quot;}', '2019-02-10 11:34:03', 1, 1, 5),
(23, 'Neuropatía Sensitiva Periférica', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Neuropatía Sensitiva Periférica&quot; }', '2019-02-10 11:34:42', 1, 7, 5),
(24, 'Retinopatía no proliferativa', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Retinopatía no proliferativa&quot;}', '2019-02-10 11:35:24', 1, 9, 5),
(25, 'Retinopatía  proliferativa', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Retinopatía  proliferativa&quot;}', '2019-02-10 11:35:34', 1, 9, 5),
(26, 'Pie Diabetico sin Amputación', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Pie Diabetico sin Amputación&quot;}', '2019-02-10 11:36:07', 1, 7, 5),
(27, 'Pie con Amputación  menor', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Pie con Amputación  menor&quot;}', '2019-02-10 11:36:43', 1, 7, 5),
(28, 'Pie con Amputación  mayor', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Pie con Amputación  mayor&quot;}', '2019-02-10 11:36:59', 1, 7, 5),
(29, 'Hipoglicemia en ultimo año', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Hipoglicemia en ultimo año&quot;}', '2019-02-10 11:40:46', 1, 7, 5),
(30, 'Hospitalización en el año previo', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Hospitalización en el año previo&quot;}', '2019-02-10 11:41:12', 1, 7, 5),
(31, 'Infarto Agudo Miocardio', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Infarto Agudo Miocardio&quot;}', '2019-02-10 11:41:32', 1, 7, 5),
(32, 'Enf. Cerebro Vascular', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Enf Cerebro Vascular&quot;}', '2019-02-10 11:42:07', 1, 7, 5),
(33, 'Enf. Arterial Periférica', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Enf Arterial Periférica&quot;}', '2019-02-10 11:42:29', 1, 7, 5),
(34, 'Tratamiento (Evaluado por personal de salud entrenado)', '{&quot;TipoOpcion&quot;:1,&quot;CodigoOpcion&quot;:&quot;Cabecera&quot;,&quot;Titulo&quot;:&quot;Tratamiento (Evaluado por personal de salud entrenado)&quot;}', '2019-02-10 11:42:56', 1, 1, 5),
(35, '¿Cumple dieta saludable?', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;¿Cumple dieta saludable?&quot;}', '2019-02-10 11:43:16', 1, 7, 5),
(36, '¿Camina 30 minutos diarios?', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;¿Camina  minutos diarios?&quot;}', '2019-02-10 11:43:33', 1, 7, 5),
(37, 'Tipo de Medicamento (una o más)', '{&quot;TipoOpcion&quot;:1,&quot;CodigoOpcion&quot;:&quot;Cabecera&quot;,&quot;Titulo&quot;:&quot;Tipo de Medicamento (una o más)&quot;}', '2019-02-10 11:44:33', 1, 1, 5),
(38, '- Metformina', '{&quot;TipoOpcion&quot;:9,&quot;CodigoOpcion&quot;:&quot;Opcion Condición Campos&quot;,&quot;Titulo&quot;:&quot;- Metformina&quot;,&quot;TipoCampo&quot;:3}', '2019-02-10 11:45:10', 1, 9, 5),
(39, '- Sulfonilureas : Glibenclamida', '{&quot;TipoOpcion&quot;:9,&quot;CodigoOpcion&quot;:&quot;Opcion Condición Campos&quot;,&quot;Titulo&quot;:&quot;- Sulfonilureas : Glibenclamida&quot;,&quot;TipoCampo&quot;:3}', '2019-02-10 11:45:47', 1, 9, 5),
(40, '- Glimepirida', '{&quot;TipoOpcion&quot;:9,&quot;CodigoOpcion&quot;:&quot;Opcion Condición Campos&quot;,&quot;Titulo&quot;:&quot;- Glimepirida&quot;,&quot;TipoCampo&quot;:3}', '2019-02-10 11:46:17', 1, 9, 5),
(41, '- Inhibidores de la DPP4', '{&quot;TipoOpcion&quot;:9,&quot;CodigoOpcion&quot;:&quot;Opcion Condición Campos&quot;,&quot;Titulo&quot;:&quot;- Inhibidores de la DPP&quot;,&quot;TipoCampo&quot;:3}', '2019-02-10 11:46:44', 1, 9, 5),
(42, '- Pioglitazonas', '{&quot;TipoOpcion&quot;:9,&quot;CodigoOpcion&quot;:&quot;Opcion Condición Campos&quot;,&quot;Titulo&quot;:&quot;- Pioglitazonas&quot;,&quot;TipoCampo&quot;:3}', '2019-02-10 11:47:28', 1, 9, 5),
(43, '- Glifozinas (Empa Dapaglifozina)', '{&quot;TipoOpcion&quot;:9,&quot;CodigoOpcion&quot;:&quot;Opcion Condición Campos&quot;,&quot;Titulo&quot;:&quot;- Glifozinas (Empa Dapaglifozina)&quot;,&quot;TipoCampo&quot;:3}', '2019-02-10 11:48:04', 1, 9, 5),
(44, 'Agonistas de Receptores GLP1  INSULINAS', '{&quot;TipoOpcion&quot;:9,&quot;CodigoOpcion&quot;:&quot;Opcion Condición Campos&quot;,&quot;Titulo&quot;:&quot;Agonistas de Receptores GLP  INSULINAS&quot;,&quot;TipoCampo&quot;:3}', '2019-02-10 11:48:26', 1, 9, 5),
(45, 'Insulinas Humanas : Cristalinas', '{&quot;TipoOpcion&quot;:9,&quot;CodigoOpcion&quot;:&quot;Opcion Condición Campos&quot;,&quot;Titulo&quot;:&quot;Insulinas Humanas : Cristalinas&quot;,&quot;TipoCampo&quot;:3}', '2019-02-10 11:48:59', 1, 9, 5),
(46, '- NPH', '{&quot;TipoOpcion&quot;:9,&quot;CodigoOpcion&quot;:&quot;Opcion Condición Campos&quot;,&quot;Titulo&quot;:&quot;- NPH&quot;,&quot;TipoCampo&quot;:3}', '2019-02-10 11:49:08', 1, 9, 5),
(47, 'Insulinas Análogas Rápidas', '{&quot;TipoOpcion&quot;:9,&quot;CodigoOpcion&quot;:&quot;Opcion Condición Campos&quot;,&quot;Titulo&quot;:&quot;Insulinas Análogas Rápidas&quot;,&quot;TipoCampo&quot;:3}', '2019-02-10 11:49:35', 1, 9, 5),
(48, '- Basal', '{&quot;TipoOpcion&quot;:9,&quot;CodigoOpcion&quot;:&quot;Opcion Condición Campos&quot;,&quot;Titulo&quot;:&quot;- Basal&quot;,&quot;TipoCampo&quot;:3}', '2019-02-10 11:49:46', 1, 9, 5),
(49, 'Examen de Pie Diabetico (Realizado por personal de salud entrenado)', '{&quot;TipoOpcion&quot;:1,&quot;CodigoOpcion&quot;:&quot;Cabecera&quot;,&quot;Titulo&quot;:&quot;Examen de Pie Diabetico (Realizado por personal de salud entrenado)&quot;}', '2019-02-10 11:52:45', 1, 1, 5),
(50, '¿Fue Evaluado del pie en el ultimo año?', '{&quot;TipoOpcion&quot;:9,&quot;CodigoOpcion&quot;:&quot;Opcion Condición Campos&quot;,&quot;Titulo&quot;:&quot;¿Fue Evaluado del pie en el ultimo año?&quot;,&quot;TipoCampo&quot;:4}', '2019-02-10 11:53:10', 1, 9, 5),
(51, '¿Sabe usted como evaluarse los pies?', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;¿Sabe usted como evaluarse los pies?&quot;}', '2019-02-10 12:20:14', 1, 7, 5),
(52, 'Examen Objetivo del Pie', '{&quot;TipoOpcion&quot;:10,&quot;CodigoOpcion&quot;:&quot;SubCabecera&quot;,&quot;Titulo&quot;:&quot;Examen Objetivo del Pie&quot;}', '2019-02-10 11:55:31', 1, 10, 5),
(53, 'Uñas micoticas,distroficas o encarnadas', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Uñas micoticas,distroficas o encarnadas&quot;}', '2019-02-10 11:56:11', 1, 7, 5),
(54, 'Resequedad de la Piel', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Resequedad de Piel&quot;}', '2019-02-10 11:57:00', 1, 7, 5),
(55, 'Lesión Severa : Evalué', '{&quot;TipoOpcion&quot;:10,&quot;CodigoOpcion&quot;:&quot;SubCabecera&quot;,&quot;Titulo&quot;:&quot;Lesión Severa : Evalué&quot;}', '2019-02-10 11:57:42', 1, 10, 5),
(56, 'Dedos en Martillo , en garra', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Dedos en Martillo , en garra&quot;}', '2019-02-10 11:58:00', 1, 7, 5),
(57, 'Dedos Superpuestos', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Dedos Superpuestos&quot;}', '2019-02-10 11:58:13', 1, 7, 5),
(58, 'Amputación Previa', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Amputación Previa&quot;}', '2019-02-10 11:58:26', 1, 7, 5),
(59, 'Juanetes o Hallux Vlagus', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Juanetes o Hallux Vlagus&quot;}', '2019-02-10 11:58:48', 1, 7, 5),
(60, 'Pie de Charcot o Plano o Cavo', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Pie de Charcot o Plano o Calvo&quot;}', '2019-02-10 11:59:10', 1, 7, 5),
(61, 'Úlcera aguda  en pie', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Úlcera aguda  en pie&quot;}', '2019-02-10 11:59:37', 1, 7, 5),
(62, 'Gangrena en pie', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Gangrena en pie&quot;}', '2019-02-10 11:59:54', 1, 7, 5),
(63, 'Pulsos', '{&quot;TipoOpcion&quot;:10,&quot;CodigoOpcion&quot;:&quot;SubCabecera&quot;,&quot;Titulo&quot;:&quot;Pulsos&quot;}', '2019-02-10 12:00:03', 1, 10, 5),
(64, 'Pedio Der. Ausente', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Pedio Der Ausente&quot;}', '2019-02-10 12:00:24', 1, 7, 5),
(65, 'Pedio Izq. Ausente', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Pedio Izq Ausente&quot;}', '2019-02-10 12:00:38', 1, 7, 5),
(66, 'Tibial Der. Ausente', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Tibial Der Ausente&quot;}', '2019-02-10 12:00:51', 1, 7, 5),
(67, 'Tibial Izq. Ausente', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Tibial Izq Ausente&quot;}', '2019-02-10 12:01:04', 1, 7, 5),
(68, 'AutoEvaluación del Pie Diabetico', '{&quot;TipoOpcion&quot;:1,&quot;CodigoOpcion&quot;:&quot;Cabecera&quot;,&quot;Titulo&quot;:&quot;Evaluación de la Educación&quot; }', '2019-02-10 12:06:15', 1, 1, 5),
(69, 'Ha tenido el paciente educación sobre el cuidado de los pies', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Ha tenido el paciente educación sobre el cuidado de los pies&quot;}', '2019-02-10 12:06:44', 1, 7, 5),
(70, 'Ha recibido educación en diabetes (3  ó más sesiones )', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Ha recibido educación en diabetes (  ó más sesiones )&quot;}', '2019-02-10 12:07:21', 1, 7, 5),
(71, 'Se realiza automonitoreo de glucosa', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Se realiza automonitoreo de glucosa&quot;}', '2019-02-10 12:07:58', 1, 7, 5),
(72, 'Valoración del Calzado', '{&quot;TipoOpcion&quot;:1,&quot;CodigoOpcion&quot;:&quot;Cabecera&quot;,&quot;Titulo&quot;:&quot;Valoración del Calzado&quot;}', '2019-02-10 12:08:18', 1, 1, 5),
(73, 'Calzado en mal estado,roto,desgastado, o deforme por el uso', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Calzado en mal estado,roto,desgastado, o deforme por el uso&quot;}', '2019-02-10 12:08:43', 1, 7, 5),
(74, 'Calzado que deja descubierto los dedos o el Talón', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Calzado que deja descubierto los dedos o el Talón&quot;}', '2019-02-10 12:09:07', 1, 7, 5),
(75, 'Calzado de punta estrecha  que comprimiera los dedos', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Calzado de punta estrecha  que comprimiera los dedos&quot;}', '2019-02-10 12:09:32', 1, 7, 5),
(76, 'Calzado demasiado ancho que no permitiera un ajuste adecuado al pie', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Calzado demasiado ancho que no permitiera un ajuste adecuado al pie&quot;}', '2019-02-10 12:10:07', 1, 7, 5),
(77, 'Calzado de un Tacón de altura  superior a 2.5 cm', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Calzado de un Tacón de altura  superori a  cm&quot;}', '2019-02-10 12:10:33', 1, 7, 5),
(78, 'Calzado con costuras o imperfecciones en su interior que favorecen roces', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;Calzado con costuras o imperfecciones en su interior que favorecen roces&quot;}', '2019-02-10 12:11:24', 1, 7, 5),
(80, 'RIESGO', '{&quot;TipoOpcion&quot;:2,&quot;CodigoOpcion&quot;:&quot;Opcion Campo Texto&quot;,&quot;Titulo&quot;:&quot;RIESGO&quot;}', '2019-02-10 19:13:31', 1, 2, 6),
(81, 'FECHA DE INICIO', '{&quot;TipoOpcion&quot;:5,&quot;CodigoOpcion&quot;:&quot;Opcion Campo Fecha&quot;,&quot;Titulo&quot;:&quot;FECHA DE INICIO&quot;}', '2019-02-10 19:13:43', 1, 5, 6),
(82, 'OBSERVACIONES', '{&quot;TipoOpcion&quot;:2,&quot;CodigoOpcion&quot;:&quot;Opcion Campo Texto&quot;,&quot;Titulo&quot;:&quot;OBSERVACIONES&quot;}', '2019-02-10 19:13:53', 1, 2, 6),
(89, 'DIAGNOSTICO DE ENFERMERIA', '{&quot;TipoOpcion&quot;:9,&quot;CodigoOpcion&quot;:&quot;Opcion Condición Campos&quot;,&quot;Titulo&quot;:&quot;DIAGNOSTICO DE ENFERMERIA&quot;,&quot;TipoCampo&quot;:5}', '2019-02-10 19:17:26', 1, 9, 6),
(90, 'TALLER DE GLUCOMETRIA', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;TALLER DE GLUCOMETRIA&quot;}', '2019-02-10 19:17:40', 1, 7, 6),
(91, 'TALLER DE NUTRICIÓN', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;TALLER DE NUTRICIÓN&quot;}', '2019-02-10 19:17:53', 1, 7, 6),
(92, 'TALLER DE CONOCIMIENTO DE DIABETES', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;TALLER DE CONOCIMIENTO DE DIABETES&quot;} ', '2019-02-10 19:18:06', 1, 7, 6),
(93, 'TALLER DE INSULINISACIÓN', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;TALLER DE INSULINISACIÓN&quot;}', '2019-02-10 19:18:24', 1, 7, 6),
(94, 'TALLER DE PODOLOGIA', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;TALLER DE PODOLOGIA&quot;}', '2019-02-10 19:18:35', 1, 7, 6),
(95, 'TALLER DE PSICOLOGÍA', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;TALLER DE PSICOLOGÍA&quot;}', '2019-02-10 19:18:46', 1, 7, 6),
(96, 'PLAN DE ACCIÓN', '{&quot;TipoOpcion&quot;:2,&quot;CodigoOpcion&quot;:&quot;Opcion Campo Texto&quot;,&quot;Titulo&quot;:&quot;PLAN DE ACCIÓN&quot;}', '2019-02-10 19:19:25', 1, 2, 6),
(97, 'PRÓXIMA CITA', '{&quot;TipoOpcion&quot;:5,&quot;CodigoOpcion&quot;:&quot;Opcion Campo Fecha&quot;,&quot;Titulo&quot;:&quot;PRÓXIMA CITA&quot;}', '2019-02-10 19:21:12', 1, 5, 6),
(98, 'FECHA DE SEGUIMIENTO', '{&quot;TipoOpcion&quot;:5,&quot;CodigoOpcion&quot;:&quot;Opcion Campo Fecha&quot;,&quot;Titulo&quot;:&quot;FECHA DE SEGUIMIENTO&quot;}', '2019-02-11 13:47:44', 1, 5, 7),
(99, 'CUMPLE DIETA', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;CUMPLE DIETA&quot;}', '2019-02-11 13:47:59', 1, 7, 7),
(100, 'CUMPLE CAMINATA', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;CUMPLE CAMINATA&quot;}', '2019-02-11 13:48:10', 1, 7, 7),
(101, 'CUMPLE MEDICACIÓN', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;CUMPLE MEDICACIÓN&quot;}', '2019-02-11 13:48:21', 1, 7, 7),
(102, 'CUMPLE MEDICACIÓN DM', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;CUMPLE MEDICACIÓN DM&quot;}', '2019-02-11 13:48:38', 1, 7, 7),
(103, 'RECIBIÓ EDUCACIÓN', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;RECIBIÓ EDUCACIÓN&quot;}', '2019-02-11 13:48:56', 1, 7, 7),
(104, 'TUVO HIPOGLICEMIA', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;TUVO HIPOGLICEMIA&quot;}', '2019-02-11 13:49:13', 1, 7, 7),
(105, 'TIENE ULCERA EN EL PIE', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;TIENE ULCERA EN EL PIE&quot;}', '2019-02-11 14:37:18', 1, 7, 7),
(106, 'AUTOMONITOREO DE GLUCOSA', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;AUTOMONITOREO DE GLUCOSA&quot;}', '2019-02-11 14:37:40', 1, 7, 7),
(107, 'SE HOSPITALIZÓ', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;SE HOSPITALIZÓ&quot;}', '2019-02-11 14:37:56', 1, 7, 7),
(108, 'ELECTROCARDIOGRAMA', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;ELECTROCARDIOGRAMA&quot;}', '2019-02-11 14:38:12', 1, 7, 7),
(109, 'CHEQUEO DE RETINOPATÍA', '{&quot;TipoOpcion&quot;:7,&quot;CodigoOpcion&quot;:&quot;Opcion Condición&quot;,&quot;Titulo&quot;:&quot;CHEQUEO DE RETINOPATÍA&quot;}', '2019-02-11 14:38:50', 1, 7, 7),
(112, 'OTROS TRATAMIENTOS', '{&quot;TipoOpcion&quot;:9,&quot;CodigoOpcion&quot;:&quot;Opcion Condición Campos&quot;,&quot;Titulo&quot;:&quot;OTROS TRATAMIENTOS&quot;,&quot;TipoCampo&quot;:6}', '2019-02-24 21:12:36', 1, 9, 5),
(117, 'NIVEL DE SATISFACCIÓN', '{&quot;TipoOpcion&quot;:11,&quot;CodigoOpcion&quot;:&quot;Opcion Listado&quot;,&quot;Titulo&quot;:&quot;NIVEL DE SATISFACCIÓN&quot;,&quot;TipoCampo&quot;:7}', '2019-03-15 16:35:24', 1, 11, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_paciente`
--

DROP TABLE IF EXISTS `tab_paciente`;
CREATE TABLE IF NOT EXISTS `tab_paciente` (
  `idPaciente` int(11) NOT NULL AUTO_INCREMENT,
  `Codigo` varchar(100) NOT NULL,
  `Nombres` varchar(100) NOT NULL,
  `apellidoPaterno` varchar(50) NOT NULL,
  `apellidoMaterno` varchar(50) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `edad` int(11) DEFAULT NULL,
  `numeroDocumento` char(11) DEFAULT NULL,
  `Telefono` char(11) DEFAULT NULL,
  `Celular` char(9) DEFAULT NULL,
  `Correo` varchar(150) DEFAULT NULL,
  `Direccion` text,
  `TipoMedida_idTipoMedida` int(11) DEFAULT NULL,
  `CantidadTiempo` int(11) DEFAULT NULL,
  `tituloGrado` text,
  `Sexo_idSexo` int(11) DEFAULT NULL,
  `DX_idDX` int(11) DEFAULT NULL,
  `Medico_idMedico` int(11) DEFAULT NULL,
  `TipoDocumento_idTipoDocumento` int(11) DEFAULT NULL,
  `Departamento_idDepartamento` int(11) DEFAULT NULL,
  `Provincia_idProvincia` int(11) DEFAULT NULL,
  `Distrito_idDistrito` int(11) DEFAULT NULL,
  `Condicion_idCondicion` int(11) DEFAULT NULL,
  `GradoInstruccion_idGradoInstruccion` int(11) DEFAULT NULL,
  `Estado_idEstado` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`idPaciente`),
  KEY `FK_PACIENTE_TIPODOC` (`TipoDocumento_idTipoDocumento`),
  KEY `FK_PACIENTE_EST` (`Estado_idEstado`),
  KEY `FK_PACIENTE_SEX` (`Sexo_idSexo`),
  KEY `FK_MEDICOPACIENTE` (`Medico_idMedico`),
  KEY `FK_DEPA` (`Departamento_idDepartamento`),
  KEY `FK_PROV` (`Provincia_idProvincia`),
  KEY `FK_DD` (`Distrito_idDistrito`),
  KEY `FK_DIAGO` (`DX_idDX`),
  KEY `FK_PACI_TIPO` (`TipoMedida_idTipoMedida`),
  KEY `FK_COND_PA` (`Condicion_idCondicion`),
  KEY `FK_GRADO` (`GradoInstruccion_idGradoInstruccion`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_paciente`
--

INSERT INTO `tab_paciente` (`idPaciente`, `Codigo`, `Nombres`, `apellidoPaterno`, `apellidoMaterno`, `fechaNacimiento`, `edad`, `numeroDocumento`, `Telefono`, `Celular`, `Correo`, `Direccion`, `TipoMedida_idTipoMedida`, `CantidadTiempo`, `tituloGrado`, `Sexo_idSexo`, `DX_idDX`, `Medico_idMedico`, `TipoDocumento_idTipoDocumento`, `Departamento_idDepartamento`, `Provincia_idProvincia`, `Distrito_idDistrito`, `Condicion_idCondicion`, `GradoInstruccion_idGradoInstruccion`, `Estado_idEstado`, `fechaRegistro`) VALUES
(13, 'Nº 0001', 'Jesús', 'Inca', 'Cárdenas', '1992-05-18', 26, '47040087', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 4, NULL, 1, NULL, NULL, NULL, 7, NULL, 1, '2019-02-23 13:34:43'),
(14, 'Nº 0002', 'José', 'Román', 'López', '1959-11-26', 59, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, NULL, NULL, NULL, 7, NULL, 1, '2019-02-23 19:25:55'),
(15, 'Nº 0003', 'Luisa', 'Perez', 'Quispe', '1960-10-20', 58, '21212121', NULL, NULL, NULL, NULL, 1, 5, NULL, 2, 5, 1, 1, 15, 127, 1267, 8, 1, 1, '2019-03-08 16:22:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_provincia`
--

DROP TABLE IF EXISTS `tab_provincia`;
CREATE TABLE IF NOT EXISTS `tab_provincia` (
  `idProvincia` int(5) NOT NULL DEFAULT '0',
  `provincia` varchar(50) DEFAULT NULL,
  `Departamento_idDepartamento` int(5) DEFAULT NULL,
  PRIMARY KEY (`idProvincia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tab_provincia`
--

INSERT INTO `tab_provincia` (`idProvincia`, `provincia`, `Departamento_idDepartamento`) VALUES
(1, 'CHACHAPOYAS ', 1),
(2, 'BAGUA', 1),
(3, 'BONGARA', 1),
(4, 'CONDORCANQUI', 1),
(5, 'LUYA', 1),
(6, 'RODRIGUEZ DE MENDOZA', 1),
(7, 'UTCUBAMBA', 1),
(8, 'HUARAZ', 2),
(9, 'AIJA', 2),
(10, 'ANTONIO RAYMONDI', 2),
(11, 'ASUNCION', 2),
(12, 'BOLOGNESI', 2),
(13, 'CARHUAZ', 2),
(14, 'CARLOS FERMIN FITZCARRALD', 2),
(15, 'CASMA', 2),
(16, 'CORONGO', 2),
(17, 'HUARI', 2),
(18, 'HUARMEY', 2),
(19, 'HUAYLAS', 2),
(20, 'MARISCAL LUZURIAGA', 2),
(21, 'OCROS', 2),
(22, 'PALLASCA', 2),
(23, 'POMABAMBA', 2),
(24, 'RECUAY', 2),
(25, 'SANTA', 2),
(26, 'SIHUAS', 2),
(27, 'YUNGAY', 2),
(28, 'ABANCAY', 3),
(29, 'ANDAHUAYLAS', 3),
(30, 'ANTABAMBA', 3),
(31, 'AYMARAES', 3),
(32, 'COTABAMBAS', 3),
(33, 'CHINCHEROS', 3),
(34, 'GRAU', 3),
(35, 'AREQUIPA', 4),
(36, 'CAMANA', 4),
(37, 'CARAVELI', 4),
(38, 'CASTILLA', 4),
(39, 'CAYLLOMA', 4),
(40, 'CONDESUYOS', 4),
(41, 'ISLAY', 4),
(42, 'LA UNION', 4),
(43, 'HUAMANGA', 5),
(44, 'CANGALLO', 5),
(45, 'HUANCA SANCOS', 5),
(46, 'HUANTA', 5),
(47, 'LA MAR', 5),
(48, 'LUCANAS', 5),
(49, 'PARINACOCHAS', 5),
(50, 'PAUCAR DEL SARA SARA', 5),
(51, 'SUCRE', 5),
(52, 'VICTOR FAJARDO', 5),
(53, 'VILCAS HUAMAN', 5),
(54, 'CAJAMARCA', 6),
(55, 'CAJABAMBA', 6),
(56, 'CELENDIN', 6),
(57, 'CHOTA ', 6),
(58, 'CONTUMAZA', 6),
(59, 'CUTERVO', 6),
(60, 'HUALGAYOC', 6),
(61, 'JAEN', 6),
(62, 'SAN IGNACIO', 6),
(63, 'SAN MARCOS', 6),
(64, 'SAN PABLO', 6),
(65, 'SANTA CRUZ', 6),
(66, 'CALLAO', 7),
(67, 'CUSCO', 8),
(68, 'ACOMAYO', 8),
(69, 'ANTA', 8),
(70, 'CALCA', 8),
(71, 'CANAS', 8),
(72, 'CANCHIS', 8),
(73, 'CHUMBIVILCAS', 8),
(74, 'ESPINAR', 8),
(75, 'LA CONVENCION', 8),
(76, 'PARURO', 8),
(77, 'PAUCARTAMBO', 8),
(78, 'QUISPICANCHI', 8),
(79, 'URUBAMBA', 8),
(80, 'HUANCAVELICA', 9),
(81, 'ACOBAMBA', 9),
(82, 'ANGARAES', 9),
(83, 'CASTROVIRREYNA', 9),
(84, 'CHURCAMPA', 9),
(85, 'HUAYTARA', 9),
(86, 'TAYACAJA', 9),
(87, 'HUANUCO', 10),
(88, 'AMBO', 10),
(89, 'DOS DE MAYO', 10),
(90, 'HUACAYBAMBA', 10),
(91, 'HUAMALIES', 10),
(92, 'LEONCIO PRADO', 10),
(93, 'MARA&Ntilde;ON', 10),
(94, 'PACHITEA', 10),
(95, 'PUERTO INCA', 10),
(96, 'LAURICOCHA', 10),
(97, 'YAROWILCA', 10),
(98, 'ICA', 11),
(99, 'CHINCHA', 11),
(100, 'NAZCA', 11),
(101, 'PALPA', 11),
(102, 'PISCO', 11),
(103, 'HUANCAYO', 12),
(104, 'CONCEPCION', 12),
(105, 'CHANCHAMAYO', 12),
(106, 'JAUJA', 12),
(107, 'JUNIN', 12),
(108, 'SATIPO', 12),
(109, 'TARMA', 12),
(110, 'YAULI', 12),
(111, 'CHUPACA', 12),
(112, 'TRUJILLO', 13),
(113, 'ASCOPE', 13),
(114, 'BOLIVAR', 13),
(115, 'CHEPEN', 13),
(116, 'JULCAN', 13),
(117, 'OTUZCO', 13),
(118, 'PACASMAYO', 13),
(119, 'PATAZ', 13),
(120, 'SANCHEZ CARRION', 13),
(121, 'SANTIAGO DE CHUCO', 13),
(122, 'GRAN CHIMU', 13),
(123, 'VIRU', 13),
(124, 'CHICLAYO', 14),
(125, 'FERRE&Ntilde;AFE', 14),
(126, 'LAMBAYEQUE', 14),
(127, 'LIMA', 15),
(128, 'BARRANCA', 15),
(129, 'CAJATAMBO', 15),
(130, 'CANTA', 15),
(131, 'CA&Ntilde;ETE', 15),
(132, 'HUARAL', 15),
(133, 'HUAROCHIRI', 15),
(134, 'HUAURA', 15),
(135, 'OYON', 15),
(136, 'YAUYOS', 15),
(137, 'MAYNAS', 16),
(138, 'ALTO AMAZONAS', 16),
(139, 'LORETO', 16),
(140, 'MARISCAL RAMON CASTILLA', 16),
(141, 'REQUENA', 16),
(142, 'UCAYALI', 16),
(143, 'TAMBOPATA', 17),
(144, 'MANU', 17),
(145, 'TAHUAMANU', 17),
(146, 'MARISCAL NIETO', 18),
(147, 'GENERAL SANCHEZ CERRO', 18),
(148, 'ILO', 18),
(149, 'PASCO', 19),
(150, 'DANIEL ALCIDES CARRION', 19),
(151, 'OXAPAMPA', 19),
(152, 'PIURA', 20),
(153, 'AYABACA', 20),
(154, 'HUANCABAMBA', 20),
(155, 'MORROPON', 20),
(156, 'PAITA', 20),
(157, 'SULLANA', 20),
(158, 'TALARA', 20),
(159, 'SECHURA', 20),
(160, 'PUNO', 21),
(161, 'AZANGARO', 21),
(162, 'CARABAYA', 21),
(163, 'CHUCUITO', 21),
(164, 'EL COLLAO', 21),
(165, 'HUANCANE', 21),
(166, 'LAMPA', 21),
(167, 'MELGAR', 21),
(168, 'MOHO', 21),
(169, 'SAN ANTONIO DE PUTINA', 21),
(170, 'SAN ROMAN', 21),
(171, 'SANDIA', 21),
(172, 'YUNGUYO', 21),
(173, 'MOYOBAMBA', 22),
(174, 'BELLAVISTA', 22),
(175, 'EL DORADO', 22),
(176, 'HUALLAGA', 22),
(177, 'LAMAS', 22),
(178, 'MARISCAL CACERES', 22),
(179, 'PICOTA', 22),
(180, 'RIOJA', 22),
(181, 'SAN MARTIN', 22),
(182, 'TOCACHE', 22),
(183, 'TACNA', 23),
(184, 'CANDARAVE', 23),
(185, 'JORGE BASADRE', 23),
(186, 'TARATA', 23),
(187, 'TUMBES', 24),
(188, 'CONTRALMIRANTE VILLAR', 24),
(189, 'ZARUMILLA', 24),
(190, 'CORONEL PORTILLO', 25),
(191, 'ATALAYA', 25),
(192, 'PADRE ABAD', 25),
(193, 'PURUS', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_resultado_ficha`
--

DROP TABLE IF EXISTS `tab_resultado_ficha`;
CREATE TABLE IF NOT EXISTS `tab_resultado_ficha` (
  `idResultadoFicha` int(11) NOT NULL AUTO_INCREMENT,
  `Seguimiento_idSeguimiento` int(11) NOT NULL,
  `Opcion_Opcion` int(11) DEFAULT NULL,
  `Especialidad_idEspecialidad` int(11) DEFAULT NULL,
  `TipoOpcion` int(11) DEFAULT NULL,
  `Propiedades` text,
  `RespuestaTexto` text,
  `RespuestaValor` decimal(12,2) DEFAULT NULL,
  `RespuestaFecha` date DEFAULT NULL,
  `RespuestaAdecuado` int(11) DEFAULT NULL,
  `TipoListado` int(11) DEFAULT NULL,
  `Grupo_idGrupo` int(11) DEFAULT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`idResultadoFicha`),
  KEY `FK_FICHA_GRUPOS` (`Grupo_idGrupo`),
  KEY `FK_RESU_SEGU` (`Seguimiento_idSeguimiento`),
  KEY `FK_RESU_ESP` (`Especialidad_idEspecialidad`),
  KEY `FKORSE` (`Opcion_Opcion`)
) ENGINE=InnoDB AUTO_INCREMENT=209 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_resultado_ficha`
--

INSERT INTO `tab_resultado_ficha` (`idResultadoFicha`, `Seguimiento_idSeguimiento`, `Opcion_Opcion`, `Especialidad_idEspecialidad`, `TipoOpcion`, `Propiedades`, `RespuestaTexto`, `RespuestaValor`, `RespuestaFecha`, `RespuestaAdecuado`, `TipoListado`, `Grupo_idGrupo`, `fechaRegistro`) VALUES
(1, 1, 5, NULL, 3, NULL, NULL, '1.00', NULL, 0, NULL, 1, '2019-03-22 16:48:34'),
(2, 1, 6, NULL, 3, NULL, NULL, '1.00', NULL, 0, NULL, 1, '2019-03-22 16:48:34'),
(3, 1, 7, NULL, 3, NULL, NULL, '1.00', NULL, 1, NULL, 1, '2019-03-22 16:48:34'),
(4, 1, 8, NULL, 3, NULL, NULL, '1.00', NULL, 0, NULL, 1, '2019-03-22 16:48:34'),
(5, 1, 9, NULL, 3, NULL, NULL, '1.00', NULL, 1, NULL, 1, '2019-03-22 16:48:35'),
(6, 1, 10, NULL, 4, '{\"Sexo\":1}', NULL, '1.00', NULL, 0, NULL, 1, '2019-03-22 16:48:35'),
(7, 1, 11, NULL, 3, NULL, NULL, '1.00', NULL, 1, NULL, 1, '2019-03-22 16:48:35'),
(8, 1, 12, NULL, 3, NULL, NULL, '1.00', NULL, 1, NULL, 1, '2019-03-22 16:48:35'),
(9, 1, 13, NULL, 6, '{\"v1\":1,\"v2\":1,\"v3\":0,\"v4\":0}', NULL, '1.00', NULL, NULL, NULL, 1, '2019-03-22 16:48:35'),
(10, 1, 16, NULL, 3, NULL, NULL, '1.00', NULL, 0, NULL, 1, '2019-03-22 16:48:35'),
(11, 1, 17, NULL, 3, NULL, NULL, '1.00', NULL, 1, NULL, 1, '2019-03-22 16:48:35'),
(12, 1, 18, NULL, 3, NULL, NULL, '1.00', NULL, 1, NULL, 1, '2019-03-22 16:48:35'),
(13, 1, 19, NULL, 3, NULL, NULL, '1.00', NULL, 1, NULL, 1, '2019-03-22 16:48:35'),
(14, 1, 21, NULL, 9, '{\"tipocampo\":\"2\",\"valorCampo\":\"0\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(15, 1, 23, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(16, 1, 24, NULL, 9, '{\"tipocampo\":\"undefined\",\"valorCampo\":\"null\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(17, 1, 25, NULL, 9, '{\"tipocampo\":\"undefined\",\"valorCampo\":\"null\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(18, 1, 26, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(19, 1, 27, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(20, 1, 28, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(21, 1, 29, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(22, 1, 30, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(23, 1, 31, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(24, 1, 32, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(25, 1, 33, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(26, 1, 35, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(27, 1, 36, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(28, 1, 38, NULL, 9, '{\"tipocampo\":\"3\",\"valorCampo\":\"null\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(29, 1, 39, NULL, 9, '{\"tipocampo\":\"3\",\"valorCampo\":\"null\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(30, 1, 40, NULL, 9, '{\"tipocampo\":\"3\",\"valorCampo\":\"null\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(31, 1, 41, NULL, 9, '{\"tipocampo\":\"3\",\"valorCampo\":\"null\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(32, 1, 42, NULL, 9, '{\"tipocampo\":\"3\",\"valorCampo\":\"null\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(33, 1, 43, NULL, 9, '{\"tipocampo\":\"3\",\"valorCampo\":\"null\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(34, 1, 44, NULL, 9, '{\"tipocampo\":\"3\",\"valorCampo\":\"null\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(35, 1, 45, NULL, 9, '{\"tipocampo\":\"3\",\"valorCampo\":\"null\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(36, 1, 46, NULL, 9, '{\"tipocampo\":\"3\",\"valorCampo\":\"null\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(37, 1, 47, NULL, 9, '{\"tipocampo\":\"3\",\"valorCampo\":\"null\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(38, 1, 48, NULL, 9, '{\"tipocampo\":\"3\",\"valorCampo\":\"null\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(39, 1, 50, NULL, 9, '{\"tipocampo\":\"4\",\"valorCampo\":\"0\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(40, 1, 51, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(41, 1, 53, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(42, 1, 54, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(43, 1, 56, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(44, 1, 57, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(45, 1, 58, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(46, 1, 59, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(47, 1, 60, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(48, 1, 61, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(49, 1, 62, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:35'),
(50, 1, 64, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:36'),
(51, 1, 65, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:36'),
(52, 1, 66, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:36'),
(53, 1, 67, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:36'),
(54, 1, 69, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:36'),
(55, 1, 70, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:36'),
(56, 1, 71, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:36'),
(57, 1, 73, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:36'),
(58, 1, 74, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:36'),
(59, 1, 75, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:36'),
(60, 1, 76, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:36'),
(61, 1, 77, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:36'),
(62, 1, 78, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:36'),
(63, 1, 112, NULL, 9, '{\"tipocampo\":\"6\",\"valorCampo\":\"0\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 16:48:36'),
(64, 1, 80, NULL, 2, NULL, '', NULL, NULL, NULL, NULL, 6, '2019-03-22 16:48:36'),
(65, 1, 81, NULL, 5, NULL, NULL, NULL, '2019-03-13', NULL, NULL, 6, '2019-03-22 16:48:36'),
(66, 1, 82, NULL, 2, NULL, '', NULL, NULL, NULL, NULL, 6, '2019-03-22 16:48:36'),
(67, 1, 89, NULL, 9, '{\"tipocampo\":\"5\",\"valorCampo\":\"0\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 6, '2019-03-22 16:48:36'),
(68, 1, 90, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 6, '2019-03-22 16:48:36'),
(69, 1, 91, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 6, '2019-03-22 16:48:36'),
(70, 1, 92, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 6, '2019-03-22 16:48:36'),
(71, 1, 93, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 6, '2019-03-22 16:48:36'),
(72, 1, 94, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 6, '2019-03-22 16:48:36'),
(73, 1, 95, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 6, '2019-03-22 16:48:36'),
(74, 1, 96, NULL, 2, NULL, '', NULL, NULL, NULL, NULL, 6, '2019-03-22 16:48:36'),
(75, 1, 97, NULL, 5, NULL, NULL, NULL, '2019-03-28', NULL, NULL, 6, '2019-03-22 16:48:36'),
(76, 1, 98, NULL, 5, NULL, NULL, NULL, '2019-03-12', NULL, NULL, 7, '2019-03-22 16:48:36'),
(77, 1, 99, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 7, '2019-03-22 16:48:36'),
(78, 1, 100, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 7, '2019-03-22 16:48:36'),
(79, 1, 101, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 7, '2019-03-22 16:48:36'),
(80, 1, 102, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 7, '2019-03-22 16:48:36'),
(81, 1, 103, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 7, '2019-03-22 16:48:36'),
(82, 1, 104, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 7, '2019-03-22 16:48:36'),
(83, 1, 105, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 7, '2019-03-22 16:48:36'),
(84, 1, 106, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 7, '2019-03-22 16:48:36'),
(85, 1, 107, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 7, '2019-03-22 16:48:36'),
(86, 1, 108, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 7, '2019-03-22 16:48:36'),
(87, 1, 109, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 7, '2019-03-22 16:48:36'),
(88, 1, 117, NULL, 11, '{\"tipocampo\":\"7\",\"valorCampo\":\"0\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, NULL, NULL, 7, '2019-03-22 16:48:36'),
(89, 1, NULL, 4, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 16:48:36'),
(90, 1, NULL, 5, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 16:48:36'),
(91, 1, NULL, 6, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 16:48:36'),
(92, 1, NULL, 7, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 16:48:37'),
(93, 1, NULL, 8, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 16:48:37'),
(94, 1, NULL, 9, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 16:48:37'),
(95, 1, NULL, 10, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 16:48:37'),
(96, 1, NULL, 11, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 16:48:37'),
(97, 1, NULL, 12, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 16:48:37'),
(98, 1, NULL, 13, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 16:48:37'),
(99, 1, NULL, 14, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 16:48:37'),
(100, 1, NULL, 15, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 16:48:37'),
(101, 1, NULL, 16, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 16:48:37'),
(102, 1, NULL, 18, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 16:48:37'),
(103, 1, NULL, 19, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 16:48:37'),
(104, 1, NULL, 20, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 16:48:37'),
(105, 2, 5, NULL, 3, NULL, NULL, '1.00', NULL, 0, NULL, 1, '2019-03-22 17:24:33'),
(106, 2, 6, NULL, 3, NULL, NULL, '1.00', NULL, 0, NULL, 1, '2019-03-22 17:24:33'),
(107, 2, 7, NULL, 3, NULL, NULL, '1.00', NULL, 1, NULL, 1, '2019-03-22 17:24:33'),
(108, 2, 8, NULL, 3, NULL, NULL, '1.00', NULL, 0, NULL, 1, '2019-03-22 17:24:33'),
(109, 2, 9, NULL, 3, NULL, NULL, '1.00', NULL, 1, NULL, 1, '2019-03-22 17:24:33'),
(110, 2, 10, NULL, 4, '{\"Sexo\":1}', NULL, '1.00', NULL, 0, NULL, 1, '2019-03-22 17:24:33'),
(111, 2, 11, NULL, 3, NULL, NULL, '1.00', NULL, 1, NULL, 1, '2019-03-22 17:24:33'),
(112, 2, 12, NULL, 3, NULL, NULL, '1.00', NULL, 1, NULL, 1, '2019-03-22 17:24:33'),
(113, 2, 13, NULL, 6, '{\"v1\":1,\"v2\":1,\"v3\":0,\"v4\":0}', NULL, '1.00', NULL, NULL, NULL, 1, '2019-03-22 17:24:33'),
(114, 2, 16, NULL, 3, NULL, NULL, '1.00', NULL, 0, NULL, 1, '2019-03-22 17:24:33'),
(115, 2, 17, NULL, 3, NULL, NULL, '1.00', NULL, 1, NULL, 1, '2019-03-22 17:24:33'),
(116, 2, 18, NULL, 3, NULL, NULL, '1.00', NULL, 1, NULL, 1, '2019-03-22 17:24:33'),
(117, 2, 19, NULL, 3, NULL, NULL, '1.00', NULL, 1, NULL, 1, '2019-03-22 17:24:33'),
(118, 2, 21, NULL, 9, '{\"tipocampo\":\"2\",\"valorCampo\":\"0\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:33'),
(119, 2, 23, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:33'),
(120, 2, 24, NULL, 9, '{\"tipocampo\":\"undefined\",\"valorCampo\":\"null\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:33'),
(121, 2, 25, NULL, 9, '{\"tipocampo\":\"undefined\",\"valorCampo\":\"null\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:33'),
(122, 2, 26, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:33'),
(123, 2, 27, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:33'),
(124, 2, 28, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:33'),
(125, 2, 29, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(126, 2, 30, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(127, 2, 31, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(128, 2, 32, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(129, 2, 33, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(130, 2, 35, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(131, 2, 36, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(132, 2, 38, NULL, 9, '{\"tipocampo\":\"3\",\"valorCampo\":\"null\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(133, 2, 39, NULL, 9, '{\"tipocampo\":\"3\",\"valorCampo\":\"null\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(134, 2, 40, NULL, 9, '{\"tipocampo\":\"3\",\"valorCampo\":\"null\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(135, 2, 41, NULL, 9, '{\"tipocampo\":\"3\",\"valorCampo\":\"null\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(136, 2, 42, NULL, 9, '{\"tipocampo\":\"3\",\"valorCampo\":\"null\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(137, 2, 43, NULL, 9, '{\"tipocampo\":\"3\",\"valorCampo\":\"null\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(138, 2, 44, NULL, 9, '{\"tipocampo\":\"3\",\"valorCampo\":\"null\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(139, 2, 45, NULL, 9, '{\"tipocampo\":\"3\",\"valorCampo\":\"null\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(140, 2, 46, NULL, 9, '{\"tipocampo\":\"3\",\"valorCampo\":\"null\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(141, 2, 47, NULL, 9, '{\"tipocampo\":\"3\",\"valorCampo\":\"null\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(142, 2, 48, NULL, 9, '{\"tipocampo\":\"3\",\"valorCampo\":\"null\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(143, 2, 50, NULL, 9, '{\"tipocampo\":\"4\",\"valorCampo\":\"0\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(144, 2, 51, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(145, 2, 53, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(146, 2, 54, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(147, 2, 56, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(148, 2, 57, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(149, 2, 58, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(150, 2, 59, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(151, 2, 60, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(152, 2, 61, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(153, 2, 62, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(154, 2, 64, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(155, 2, 65, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(156, 2, 66, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(157, 2, 67, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(158, 2, 69, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(159, 2, 70, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(160, 2, 71, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(161, 2, 73, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(162, 2, 74, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(163, 2, 75, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(164, 2, 76, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(165, 2, 77, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(166, 2, 78, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(167, 2, 112, NULL, 9, '{\"tipocampo\":\"6\",\"valorCampo\":\"0\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 5, '2019-03-22 17:24:34'),
(168, 2, 80, NULL, 2, NULL, '', NULL, NULL, NULL, NULL, 6, '2019-03-22 17:24:34'),
(169, 2, 81, NULL, 5, NULL, NULL, NULL, '2019-03-04', NULL, NULL, 6, '2019-03-22 17:24:35'),
(170, 2, 82, NULL, 2, NULL, '', NULL, NULL, NULL, NULL, 6, '2019-03-22 17:24:35'),
(171, 2, 89, NULL, 9, '{\"tipocampo\":\"5\",\"valorCampo\":\"0\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, 0, NULL, 6, '2019-03-22 17:24:35'),
(172, 2, 90, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 6, '2019-03-22 17:24:35'),
(173, 2, 91, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 6, '2019-03-22 17:24:35'),
(174, 2, 92, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 6, '2019-03-22 17:24:35'),
(175, 2, 93, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 6, '2019-03-22 17:24:35'),
(176, 2, 94, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 6, '2019-03-22 17:24:35'),
(177, 2, 95, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 6, '2019-03-22 17:24:35'),
(178, 2, 96, NULL, 2, NULL, '', NULL, NULL, NULL, NULL, 6, '2019-03-22 17:24:35'),
(179, 2, 97, NULL, 5, NULL, NULL, NULL, '2019-03-18', NULL, NULL, 6, '2019-03-22 17:24:35'),
(180, 2, 98, NULL, 5, NULL, NULL, NULL, '2019-03-27', NULL, NULL, 7, '2019-03-22 17:24:35'),
(181, 2, 99, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 7, '2019-03-22 17:24:35'),
(182, 2, 100, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 7, '2019-03-22 17:24:35'),
(183, 2, 101, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 7, '2019-03-22 17:24:35'),
(184, 2, 102, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 7, '2019-03-22 17:24:35'),
(185, 2, 103, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 7, '2019-03-22 17:24:35'),
(186, 2, 104, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 7, '2019-03-22 17:24:35'),
(187, 2, 105, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 7, '2019-03-22 17:24:35'),
(188, 2, 106, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 7, '2019-03-22 17:24:35'),
(189, 2, 107, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 7, '2019-03-22 17:24:35'),
(190, 2, 108, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 7, '2019-03-22 17:24:35'),
(191, 2, 109, NULL, 7, NULL, NULL, NULL, NULL, 0, NULL, 7, '2019-03-22 17:24:35'),
(192, 2, 117, NULL, 11, '{\"tipocampo\":\"7\",\"valorCampo\":\"1\",\"Dosis\":\"0\",\"Num\":\"0\"}', NULL, NULL, NULL, NULL, NULL, 7, '2019-03-22 17:24:35'),
(193, 2, NULL, 4, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 17:24:35'),
(194, 2, NULL, 5, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 17:24:35'),
(195, 2, NULL, 6, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 17:24:35'),
(196, 2, NULL, 7, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 17:24:35'),
(197, 2, NULL, 8, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 17:24:35'),
(198, 2, NULL, 9, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 17:24:35'),
(199, 2, NULL, 10, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 17:24:35'),
(200, 2, NULL, 11, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 17:24:35'),
(201, 2, NULL, 12, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 17:24:35'),
(202, 2, NULL, 13, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 17:24:35'),
(203, 2, NULL, 14, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 17:24:35'),
(204, 2, NULL, 15, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 17:24:35'),
(205, 2, NULL, 16, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 17:24:35'),
(206, 2, NULL, 18, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 17:24:35'),
(207, 2, NULL, 19, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 17:24:35'),
(208, 2, NULL, 20, NULL, '{\"Diagnostico\":\"0\",\"Medico\":\"0\",\"Tratamiento\":\"0\",\"Observacion\":\"0\"}', NULL, NULL, NULL, 0, NULL, NULL, '2019-03-22 17:24:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_resultado_pie`
--

DROP TABLE IF EXISTS `tab_resultado_pie`;
CREATE TABLE IF NOT EXISTS `tab_resultado_pie` (
  `idResultadoPie` int(11) NOT NULL AUTO_INCREMENT,
  `Seguimiento_idSeguimiento` int(11) NOT NULL,
  `R1` int(11) NOT NULL,
  `R2` int(11) NOT NULL,
  `R3` int(11) NOT NULL,
  `R4` int(11) NOT NULL,
  `R5` int(11) NOT NULL,
  `R6` int(11) NOT NULL,
  `R7` int(11) NOT NULL,
  `R8` int(11) NOT NULL,
  PRIMARY KEY (`idResultadoPie`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_resultado_pie`
--

INSERT INTO `tab_resultado_pie` (`idResultadoPie`, `Seguimiento_idSeguimiento`, `R1`, `R2`, `R3`, `R4`, `R5`, `R6`, `R7`, `R8`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 2, 3, 2, 1, 1, 4, 1, 5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_satisfaccion`
--

DROP TABLE IF EXISTS `tab_satisfaccion`;
CREATE TABLE IF NOT EXISTS `tab_satisfaccion` (
  `idSatisfaccion` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(150) NOT NULL,
  `Estado_idEstado` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`idSatisfaccion`),
  KEY `FK_SAT_ESTADO` (`Estado_idEstado`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_satisfaccion`
--

INSERT INTO `tab_satisfaccion` (`idSatisfaccion`, `Descripcion`, `Estado_idEstado`, `fechaRegistro`) VALUES
(1, 'MUY POCO', 1, '2019-03-08 02:12:46'),
(2, 'POCO', 1, '2019-03-08 02:12:57'),
(3, 'NORMAL', 1, '2019-03-08 02:13:07'),
(4, 'SATISFECHO', 1, '2019-03-08 02:13:17'),
(5, 'MUY SATISFECHO', 1, '2019-03-08 02:13:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_seguimiento`
--

DROP TABLE IF EXISTS `tab_seguimiento`;
CREATE TABLE IF NOT EXISTS `tab_seguimiento` (
  `idSeguimiento` int(11) NOT NULL AUTO_INCREMENT,
  `Codigo` varchar(100) NOT NULL,
  `Year` int(11) NOT NULL,
  `Mes` int(11) NOT NULL,
  `Paciente_idPaciente` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`idSeguimiento`),
  KEY `FK_SEGUI_PA` (`Paciente_idPaciente`),
  KEY `FK_YEAR` (`Year`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_seguimiento`
--

INSERT INTO `tab_seguimiento` (`idSeguimiento`, `Codigo`, `Year`, `Mes`, `Paciente_idPaciente`, `fechaRegistro`) VALUES
(1, 'SEG-1', 4, 1, 13, '2019-03-22 16:48:34'),
(2, 'SEG-2', 4, 1, 13, '2019-03-22 17:24:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_tipodocumento`
--

DROP TABLE IF EXISTS `tab_tipodocumento`;
CREATE TABLE IF NOT EXISTS `tab_tipodocumento` (
  `idTipoDocumento` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(200) NOT NULL,
  `Estado_idEstado` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`idTipoDocumento`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_tipodocumento`
--

INSERT INTO `tab_tipodocumento` (`idTipoDocumento`, `Descripcion`, `Estado_idEstado`, `fechaRegistro`) VALUES
(1, 'DNI', 1, '2019-02-07 00:00:00'),
(2, 'LIBRETA ELECTORAL', 1, '2019-02-07 00:00:00'),
(3, 'PASAPORTE', 1, '2019-02-07 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_tipomedida`
--

DROP TABLE IF EXISTS `tab_tipomedida`;
CREATE TABLE IF NOT EXISTS `tab_tipomedida` (
  `idTipoMedida` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(150) NOT NULL,
  `Estado_idEstado` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`idTipoMedida`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_tipomedida`
--

INSERT INTO `tab_tipomedida` (`idTipoMedida`, `Descripcion`, `Estado_idEstado`, `fechaRegistro`) VALUES
(1, 'DIA/DIAS', 1, '2019-02-07 00:00:00'),
(2, 'MES/MESES', 1, '2019-02-07 00:00:00'),
(3, 'AÑO/AÑOS', 1, '2019-02-07 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_tipoopcion`
--

DROP TABLE IF EXISTS `tab_tipoopcion`;
CREATE TABLE IF NOT EXISTS `tab_tipoopcion` (
  `idTipoOpcion` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(150) NOT NULL,
  PRIMARY KEY (`idTipoOpcion`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_tipoopcion`
--

INSERT INTO `tab_tipoopcion` (`idTipoOpcion`, `Descripcion`) VALUES
(1, 'Opción Cabecera'),
(2, 'Opción Campo de Texto'),
(3, 'Opción de Rango'),
(4, 'Opción de Rango Según el Sexo'),
(5, 'Opción de Fecha'),
(6, 'Opción con Fórmula'),
(7, 'Opción Condición'),
(9, 'Opción Condición y Selección de Lista'),
(10, 'SubCabecera'),
(11, 'Opción Lista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_tratamientos`
--

DROP TABLE IF EXISTS `tab_tratamientos`;
CREATE TABLE IF NOT EXISTS `tab_tratamientos` (
  `idTratamiento` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(150) NOT NULL,
  `Estado_idEstado` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`idTratamiento`),
  KEY `FK_TRATAMIENTOS_ESTADO` (`Estado_idEstado`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_tratamientos`
--

INSERT INTO `tab_tratamientos` (`idTratamiento`, `Descripcion`, `Estado_idEstado`, `fechaRegistro`) VALUES
(1, 'AAS', 1, '2019-02-24 00:00:00'),
(2, 'ESTATINAS', 1, '2019-02-24 00:00:00'),
(3, 'FIBRATOS', 1, '2019-02-24 00:00:00'),
(4, 'IECA(Enalapril)', 1, '2019-02-24 00:00:00'),
(5, 'ARA II(Losartán)', 1, '2019-02-24 00:00:00'),
(6, 'BETA BLOQUEADOR', 1, '2019-02-24 00:00:00'),
(7, 'BLOQ. CANAL CALCIO', 1, '2019-02-24 00:00:00'),
(8, 'FUROSEMIDA', 1, '2019-02-24 00:00:00'),
(9, 'HIROCLOROTIAZIDA', 1, '2019-02-24 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_year`
--

DROP TABLE IF EXISTS `tab_year`;
CREATE TABLE IF NOT EXISTS `tab_year` (
  `idYear` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(20) NOT NULL,
  `Estado_idEstado` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`idYear`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tab_year`
--

INSERT INTO `tab_year` (`idYear`, `year`, `Estado_idEstado`, `fechaRegistro`) VALUES
(1, 2016, 1, '2019-02-07 00:00:00'),
(2, 2017, 1, '2019-02-07 00:00:00'),
(3, 2018, 1, '2019-02-07 00:00:00'),
(4, 2019, 1, '2019-02-07 00:00:00'),
(5, 2020, 1, '2019-02-07 00:00:00'),
(6, 2021, 1, '2019-02-07 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `Perfil_idPerfil` int(11) NOT NULL,
  `Persona_idPersona` int(11) NOT NULL,
  `Estado_idEstado` int(11) NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `Perfil_idPerfil` (`Perfil_idPerfil`) USING BTREE,
  KEY `Persona_idPersona` (`Persona_idPersona`) USING BTREE,
  KEY `Estado_idEstado` (`Estado_idEstado`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `usuario`, `pass`, `Perfil_idPerfil`, `Persona_idPersona`, `Estado_idEstado`, `fechaRegistro`) VALUES
(1, 'admin', '$2a$08$Vo4zFrwFG.k2ZHhln/fQVu5NoeJdzJUSG6HOVA6fBCknS/umS0bki', 1, 1, 1, '2018-09-29 14:03:15'),
(49, 'agarciaa', '$2a$08$wyjmYshNwr4LA2OqlXw.OOxAi1WMxvGcHve8oXL/VQNWFTpwMXfiO', 11, 40, 1, '2018-11-21 22:46:32'),
(50, 'jgonzalezc', '$2a$08$wMCGnNSJl1Al2ZhvbSh6JeXv6lKrdQrnyWQdZfroQbGiZDnrB6lJ6', 11, 41, 1, '2018-11-21 22:46:48'),
(51, 'mrodriguezc', '$2a$08$TGTEo0z.wGkW6KsOZfBGY.yFOPxcrBWmoucC43qTWFVNG0Ao1YgLC', 11, 42, 1, '2018-11-21 22:47:07');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `FK_Usuario_idUsuario2` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD CONSTRAINT `FK_ESTADO` FOREIGN KEY (`Estado_idEstado`) REFERENCES `estado` (`idEstado`);

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `FK_Perfil_idPerfil` FOREIGN KEY (`Perfil_idPerfil`) REFERENCES `perfil` (`idPerfil`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `FK_Estado_idEstado` FOREIGN KEY (`Estado_idEstado`) REFERENCES `estado` (`idEstado`);

--
-- Filtros para la tabla `tab_asignacionespecialidad`
--
ALTER TABLE `tab_asignacionespecialidad`
  ADD CONSTRAINT `FK_ESPEAS` FOREIGN KEY (`Especialidad_idEspecialidad`) REFERENCES `tab_especialidad` (`idEspecialidad`),
  ADD CONSTRAINT `FK_MEDICOAS` FOREIGN KEY (`Medico_idMedico`) REFERENCES `tab_medico` (`idMedico`);

--
-- Filtros para la tabla `tab_comorbilidad`
--
ALTER TABLE `tab_comorbilidad`
  ADD CONSTRAINT `FK_COM_ESTADO` FOREIGN KEY (`Estado_idEstado`) REFERENCES `estado` (`idEstado`);

--
-- Filtros para la tabla `tab_condicion`
--
ALTER TABLE `tab_condicion`
  ADD CONSTRAINT `FK_COND_ESTADO` FOREIGN KEY (`Estado_idEstado`) REFERENCES `estado` (`idEstado`);

--
-- Filtros para la tabla `tab_diagnostico`
--
ALTER TABLE `tab_diagnostico`
  ADD CONSTRAINT `FK_DIAG_ESTADO` FOREIGN KEY (`Estado_idEstado`) REFERENCES `estado` (`idEstado`);

--
-- Filtros para la tabla `tab_diagnostico_enfermeria`
--
ALTER TABLE `tab_diagnostico_enfermeria`
  ADD CONSTRAINT `FK_DIAG_ENF_ESTADO` FOREIGN KEY (`Estado_idEstado`) REFERENCES `estado` (`idEstado`);

--
-- Filtros para la tabla `tab_especialidad`
--
ALTER TABLE `tab_especialidad`
  ADD CONSTRAINT `FK_ESP_ESTADO` FOREIGN KEY (`Estado_idEstado`) REFERENCES `estado` (`idEstado`);

--
-- Filtros para la tabla `tab_evaluado`
--
ALTER TABLE `tab_evaluado`
  ADD CONSTRAINT `FK_EVA_eSTAD` FOREIGN KEY (`Estado_idEstado`) REFERENCES `estado` (`idEstado`);

--
-- Filtros para la tabla `tab_gradoinstruccion`
--
ALTER TABLE `tab_gradoinstruccion`
  ADD CONSTRAINT `FK_GRADOP_ESTADO` FOREIGN KEY (`Estado_idEstado`) REFERENCES `estado` (`idEstado`);

--
-- Filtros para la tabla `tab_grupoopcion`
--
ALTER TABLE `tab_grupoopcion`
  ADD CONSTRAINT `FK_GRUPO_eSTA` FOREIGN KEY (`Estado_idEstado`) REFERENCES `estado` (`idEstado`);

--
-- Filtros para la tabla `tab_medico`
--
ALTER TABLE `tab_medico`
  ADD CONSTRAINT `FK_EstadoMEDIC` FOREIGN KEY (`Estado_idEstado`) REFERENCES `estado` (`idEstado`),
  ADD CONSTRAINT `FK_Perfil` FOREIGN KEY (`Perfil_idPerfil`) REFERENCES `perfil` (`idPerfil`),
  ADD CONSTRAINT `FK_SEXO` FOREIGN KEY (`Sexo_idSexo`) REFERENCES `sexo` (`idSexo`);

--
-- Filtros para la tabla `tab_opcion`
--
ALTER TABLE `tab_opcion`
  ADD CONSTRAINT `FK_EstadoFK` FOREIGN KEY (`Estado_idEstado`) REFERENCES `estado` (`idEstado`),
  ADD CONSTRAINT `FK_GrupoOpcion` FOREIGN KEY (`GrupoOpcion_idGrupoOpcion`) REFERENCES `tab_grupoopcion` (`idGrupoOpcion`),
  ADD CONSTRAINT `FK_TIPOOPCION` FOREIGN KEY (`TipoOpcion_idTipoOpcion`) REFERENCES `tab_tipoopcion` (`idTipoOpcion`);

--
-- Filtros para la tabla `tab_paciente`
--
ALTER TABLE `tab_paciente`
  ADD CONSTRAINT `FK_COND_PA` FOREIGN KEY (`Condicion_idCondicion`) REFERENCES `tab_condicion` (`idCondicion`),
  ADD CONSTRAINT `FK_DD` FOREIGN KEY (`Distrito_idDistrito`) REFERENCES `tab_distrito` (`idDistrito`),
  ADD CONSTRAINT `FK_DEPA` FOREIGN KEY (`Departamento_idDepartamento`) REFERENCES `tab_departamento` (`idDepartamento`),
  ADD CONSTRAINT `FK_DIAGO` FOREIGN KEY (`DX_idDX`) REFERENCES `tab_diagnostico` (`idDiagnostico`),
  ADD CONSTRAINT `FK_GRADO` FOREIGN KEY (`GradoInstruccion_idGradoInstruccion`) REFERENCES `tab_gradoinstruccion` (`idGradoInstruccion`),
  ADD CONSTRAINT `FK_MEDICOPACIENTE` FOREIGN KEY (`Medico_idMedico`) REFERENCES `tab_medico` (`idMedico`),
  ADD CONSTRAINT `FK_PACIENTE_EST` FOREIGN KEY (`Estado_idEstado`) REFERENCES `estado` (`idEstado`),
  ADD CONSTRAINT `FK_PACIENTE_SEX` FOREIGN KEY (`Sexo_idSexo`) REFERENCES `sexo` (`idSexo`),
  ADD CONSTRAINT `FK_PACIENTE_TIPODOC` FOREIGN KEY (`TipoDocumento_idTipoDocumento`) REFERENCES `tab_tipodocumento` (`idTipoDocumento`),
  ADD CONSTRAINT `FK_PACI_TIPO` FOREIGN KEY (`TipoMedida_idTipoMedida`) REFERENCES `tab_tipomedida` (`idTipoMedida`),
  ADD CONSTRAINT `FK_PROV` FOREIGN KEY (`Provincia_idProvincia`) REFERENCES `tab_provincia` (`idProvincia`);

--
-- Filtros para la tabla `tab_resultado_ficha`
--
ALTER TABLE `tab_resultado_ficha`
  ADD CONSTRAINT `FKORSE` FOREIGN KEY (`Opcion_Opcion`) REFERENCES `tab_opcion` (`idOpcion`),
  ADD CONSTRAINT `FK_FICHA_GRUPOS` FOREIGN KEY (`Grupo_idGrupo`) REFERENCES `tab_grupoopcion` (`idGrupoOpcion`),
  ADD CONSTRAINT `FK_RESU_ESP` FOREIGN KEY (`Especialidad_idEspecialidad`) REFERENCES `tab_especialidad` (`idEspecialidad`),
  ADD CONSTRAINT `FK_RESU_SEGU` FOREIGN KEY (`Seguimiento_idSeguimiento`) REFERENCES `tab_seguimiento` (`idSeguimiento`);

--
-- Filtros para la tabla `tab_satisfaccion`
--
ALTER TABLE `tab_satisfaccion`
  ADD CONSTRAINT `FK_SAT_ESTADO` FOREIGN KEY (`Estado_idEstado`) REFERENCES `estado` (`idEstado`);

--
-- Filtros para la tabla `tab_seguimiento`
--
ALTER TABLE `tab_seguimiento`
  ADD CONSTRAINT `FK_SEGUI_PA` FOREIGN KEY (`Paciente_idPaciente`) REFERENCES `tab_paciente` (`idPaciente`),
  ADD CONSTRAINT `FK_YEAR` FOREIGN KEY (`Year`) REFERENCES `tab_year` (`idYear`);

--
-- Filtros para la tabla `tab_tratamientos`
--
ALTER TABLE `tab_tratamientos`
  ADD CONSTRAINT `FK_TRATAMIENTOS_ESTADO` FOREIGN KEY (`Estado_idEstado`) REFERENCES `estado` (`idEstado`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_Estado_idEstado2` FOREIGN KEY (`Estado_idEstado`) REFERENCES `estado` (`idEstado`),
  ADD CONSTRAINT `FK_Perfil_idPerfil2` FOREIGN KEY (`Perfil_idPerfil`) REFERENCES `perfil` (`idPerfil`),
  ADD CONSTRAINT `FK_Persona_idPersona2` FOREIGN KEY (`Persona_idPersona`) REFERENCES `persona` (`idPersona`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
