DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_GrupoOpcion_ACTIVACION`(IN `idGrupoOpcionU` INT(11), IN `codigo` INT(11))
    NO SQL
BEGIN

UPDATE `tab_GrupoOpcion` SET  `Estado_idEstado`=codigo  WHERE  `idGrupoOpcion`=idGrupoOpcionU;

END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_GrupoOpcion_EDITAR`(IN `dato` VARCHAR(150), IN `idGrupoOpcionU` INT(11))
    NO SQL
BEGIN

UPDATE `tab_GrupoOpcion` SET `Descripcion`=dato WHERE `idGrupoOpcion`=idGrupoOpcionU;

END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_GrupoOpcion_ELIMINAR`(IN `idGrupoOpcionD` INT(11))
    NO SQL
BEGIN

DELETE FROM `tab_GrupoOpcion` WHERE `idGrupoOpcion`=idGrupoOpcionD;

END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_GrupoOpcion_LISTAR`()
    NO SQL
BEGIN

SELECT tab.idGrupoOpcion,tab.Descripcion,tab.Estado_idEstado,DATE_FORMAT(tab.fechaRegistro,"%d/%m/%Y") as fechaRegistro,e.nombreEstado FROM tab_GrupoOpcion tab INNER JOIN estado e ON e.idEstado=tab.Estado_idEstado;

END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_GrupoOpcion_RECUPERAR`(IN `idGrupoOpcionS` INT(11))
    NO SQL
BEGIN

SELECT * FROM tab_GrupoOpcion tab where tab.idGrupoOpcion=idGrupoOpcionS;

END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MANT_GrupoOpcion_REGISTRO`(IN `dato` VARCHAR(150))
    NO SQL
BEGIN

INSERT INTO `tab_GrupoOpcion`(`idGrupoOpcion`, `Descripcion`, `Estado_idEstado`, `fechaRegistro`) VALUES (NULL,dato,1,NOW());

END$$
DELIMITER ;
