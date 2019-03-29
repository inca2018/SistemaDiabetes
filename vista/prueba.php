BEGIN


if(tipoGeneral="OPCION")THEN

    if(tipoOpcion="2")THEN


    INSERT INTO `tab_resultado_ficha`(`idResultadoFicha`, `Seguimiento_idSeguimiento`, `Opcion_Opcion`, `Especialidad_idEspecialidad`, `TipoOpcion`, `Propiedades`, `RespuestaTexto`, `RespuestaValor`, `RespuestaFecha`, `RespuestaAdecuado`, `TipoListado`,`Grupo_idGrupo`,`fechaRegistro`) VALUES (NULL,idSeguimiento,id,NULL,2,NULL,campo,NULL,NULL,NULL,NULL,idGrupo,NOW());


UPDATE `tab_resultado_ficha` SET  `Propiedades`=[value-6],`RespuestaTexto`=[value-7],`RespuestaValor`=[value-8],`RespuestaFecha`=[value-9],`RespuestaAdecuado`=[value-10],`TipoListado`=[value-11],`Grupo_idGrupo`=[value-12],`fechaRegistro`=[value-13] WHERE `Seguimiento_idSeguimiento`=idSeguimiento and `Opcion_Opcion`=id;

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

END
