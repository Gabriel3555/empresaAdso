<?php

include_once "conexion.php";

class usuarioAreaModelo{
    public static function mdlUsuarioAreaModelo(){
        $mensaje = array();
        try {
            // Realizamos la consulta con INNER JOIN
                $objRespuesta = Conexion::conectar()->prepare("SELECT 
            usuario.nombre AS nombre,
            area.nombre_area AS area,
            usuario_has_area.salario AS salario
            FROM usuario
            JOIN usuario_has_area ON usuario.idusuario = usuario_has_area.usuario_idusuario
            JOIN area ON usuario_has_area.area_idarea = area.idarea;
");
                $objRespuesta->execute();
                $listarEditar = $objRespuesta->fetchAll();
                $objRespuesta = null ;
                $mensaje = array("codigo"=>"200","listarEditar"=>$listarEditar);
    
            } catch (Exception $e){
                $mensaje= array("codigo"=>"401","mensaje"=>$e->getMessage());
    
            }
            return $mensaje; 
        }
    
    }


