<?php

class FolderModelo {

    public static function mdlCrearFolder($ruta) {
        $rutaGeneral = 'archivos';
        $mensaje = array();
        $error = false;

        if(!file_exists("../".$rutaGeneral)){
            if(!mkdir("../".$rutaGeneral,0777,true)){
                $error = true;
            }
        }

        if(!$error){
            if(!file_exists("../".$rutaGeneral."/".$ruta)){
                if(!mkdir("../".$rutaGeneral."/".$ruta,0777,true)){
                    $error = true;
                }
            }

            if(!$error){
                $mensaje = array("codigo"=>"200", "ruta"=>$rutaGeneral."/".$ruta."/");
            } else {
                $mensaje = array("codigo"=>"401", "mensaje"=>"Error al crear directorio del usuario".$rutaGeneral."/".$ruta);
            }

        } else {
            $mensaje = array("codigo"=>"401", "mensaje"=>"Error al crear el directorio principal denominado ". $rutaGeneral);
        }
        
        return $mensaje;  
    }
}