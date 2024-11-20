<?php

include_once "conexion.php";
include_once "folderModelo.php";

class usuarioModelo{


    public static function mdlListarUsuarios(){
        $mensaje= array() ;

        try{
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM usuario");
            $objRespuesta->execute();
            $listarUsuarios = $objRespuesta->fetchall();
            $objRespuesta = null;
            $mensaje = array("codigo"=>"200","listarUsuarios"=>$listarUsuarios);
        } catch (Exception $e){
            $mensaje= array("codigo"=>"401","mensaje"=>$e->getMenssage());
        }
        return $mensaje;
    }



    
    public static function mdlRegistrarUsuario($documento,$nombre,$apellido,$email,$foto){
    
        $mensaje = FolderModelo::mdlCrearFolder($documento);

         if($mensaje["codigo"]=="200"){
            $ruta = $mensaje["ruta"];
            $arrayArchivo = explode('.',$foto["name"]);
            $nombreArchivo = uniqid('img-').'.'.end($arrayArchivo);
            $rutaFinal = $ruta.$nombreArchivo;
            if (move_uploaded_file($foto["tmp_name"],'../'.$ruta.$nombreArchivo)){

                try{
                    $objRespuesta= Conexion::conectar()->prepare("INSERT INTO usuario(nombre,apellido,documento,email,urlfoto) 
                    VALUES (:nombre,:apellido,:documento,:email,:urlfoto)");
                    $objRespuesta->bindParam(":nombre",$nombre);
                    $objRespuesta->bindParam(":apellido",$apellido);
                    $objRespuesta->bindParam(":documento",$documento);
                    $objRespuesta->bindParam(":email",$email);
                    $objRespuesta->bindParam(":urlfoto",$rutaFinal);
                        if($objRespuesta->execute()){
                            $mensaje = array ("codigo"=>"200","usuario registrado correctamente");
                        }else {
                            $mensaje = array("codifo"=>"401","error al registrar el usuario");
                        }

                } catch(Exception $e) {
                        $mensaje = array ("codigo"=>"401","mensaje"=>$e->getMessage());
                }

            }
         }
      return $mensaje;
    }





    public static function mdlEliminarUsuario($idusuario){
        $mensaje = array();
    
        try {
            
            $objConsulta = Conexion::conectar()->prepare("SELECT documento, urlFoto FROM usuario WHERE idusuario = :idusuario");
            $objConsulta->bindParam(":idusuario", $idusuario);
            $objConsulta->execute();
            $usuario = $objConsulta->fetch();
    
            if ($usuario) {
                
                $objRespuesta = Conexion::conectar()->prepare("DELETE FROM usuario WHERE idusuario = :idusuario");
                $objRespuesta->bindParam(":idusuario", $idusuario);
    
                if($objRespuesta->execute()){
                    
                    $rutaCarpeta = dirname(dirname(_FILE_)) . '/archivos/' . $usuario['documento'] . '/';
                    
                    error_log("Intentando eliminar la carpeta: " . $rutaCarpeta);
    
                    
                    if (is_dir($rutaCarpeta)) {
                        
                        $archivos = glob($rutaCarpeta . '*', GLOB_MARK);
                        foreach ($archivos as $archivo) {
                            if (is_file($archivo)) {
                                unlink($archivo);
                                error_log("Archivo eliminado: " . $archivo);
                            }
                        }
    

                        if (rmdir($rutaCarpeta)) {
                            $mensaje = array("codigo" => "200", "mensaje" => "Usuario y carpeta eliminados correctamente");
                            error_log("Carpeta eliminada exitosamente: " . $rutaCarpeta);
                        } else {
                            $mensaje = array("codigo" => "200", "mensaje" => "Usuario eliminado, pero no se pudo eliminar la carpeta");
                            error_log("No se pudo eliminar la carpeta: " . $rutaCarpeta);
                        }
                    } else {
                        $mensaje = array("codigo" => "200", "mensaje" => "Usuario eliminado, la carpeta no existía");
                        error_log("La carpeta no existe: " . $rutaCarpeta);
                    }
    

                    if (!empty($usuario['urlFoto']) && file_exists('../' . $usuario['urlFoto'])) {
                        if (unlink('../' . $usuario['urlFoto'])) {
                            error_log("Foto eliminada: " . $usuario['urlFoto']);
                        } else {
                            error_log("No se pudo eliminar la foto: " . $usuario['urlFoto']);
                        }
                    }
                } else {
                    $mensaje = array("codigo" => "401", "mensaje" => "Error al eliminar el Usuario");
                }
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Usuario no encontrado");
            }
    
            $objRespuesta = null;
            $objConsulta = null;
    
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
    



  // // public static function mdlEditarUsuarios($idusuario,$documento,$nombre,$apellido,$email,$foto){
     //   $mensaje = array();
//
     //   try {
     //       $objConsulta = Conexion::conectar()->prepare("SELECT documento,urlfoto FROM usuario WHERE idusuario=:idusuario");
     //       $objConsulta->bindparam(":idusuario",$idusuario);
     //       $objConsulta->execute();
     //       $usuarioActual = $objConsulta->fetchall();
//
//
//
     //     
     //       if ($foto['size'] > 0) {
     //      
     //           $mensajeFolder = FolderModelo::mdlCrearFolder($documento);
     //           if ($mensajeFolder["codigo"] == "200") {
     //               $ruta = $mensajeFolder["ruta"];
     //               $arrayArchivo = explode('.', $foto["name"]);
     //               $nombreArchivo = uniqid('img-') . '.' . end($arrayArchivo);
     //               $rutaFinal = $ruta . $nombreArchivo;
    //
     //           
     //               if (move_uploaded_file($foto['tmp_name'], '../' . $rutaFinal)) {
     //                  
     //                   if (!empty($usuarioActual['urlFoto']) && file_exists('../' . $usuarioActual['urlFoto'])) {
     //                       unlink('../' . $usuarioActual['urlFoto']);
     //                   }
     //               } else {
     //                   throw new Exception("Error al subir la nueva foto");
     //               }
     //           } else {
     //               throw new Exception($mensajeFolder["mensaje"]);
     //           }
     //       } else {
     //           
     //           $rutaFinal = $usuarioActual['urlFoto'];
     //       }
    //
     //       
     //       $objRespuesta = Conexion::conectar()->prepare("UPDATE usuario SET nombre=:nombre, apellido=:apellido, documento=:documento, email=:email, urlfoto=:urlfoto WHERE idusuario=:idusuario");
     //       $objRespuesta->bindParam(":nombre", $nombres);
     //       $objRespuesta->bindParam(":apellido", $apellidos);
     //       $objRespuesta->bindParam(":documento", $documento);
     //       $objRespuesta->bindParam(":email", $email);
     //       $objRespuesta->bindParam(":urlfoto", $rutaFinal);
     //       $objRespuesta->bindParam(":idusuario", $idusuario);
    //
     //       if ($objRespuesta->execute()) {
     //           $mensaje = array("codigo" => "200", "mensaje" => "Se editó correctamente");
     //       } else {
     //           $mensaje = array("codigo" => "401", "mensaje" => "Error al editar");
     //       }
     //   } catch (Exception $e) {
     //       $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
     //   }
     //   return $mensaje;
  // // }

        public static function mdlEditarUsuarios($idusuario,$documento,$nombre,$apellido,$email,$foto){
                $mensaje = array();
                try {
                    $objRespuesta= Conexion::conectar()->prepare("UPDATE usuario SET documento=:documento, nombre=:nombre,apellido=:apellido,email=:email,urlfoto=:urlfoto WHERE idusuario=:idUsuario");
                   // lo de azul son los valores de la linea 68 que estan arriba del array
                    
            
                    $objRespuesta->bindParam(":nombre",$nombres);
                    $objRespuesta->bindParam(":apellido",$apellidos);
                    $objRespuesta->bindParam(":documento",$documento);
                    $objRespuesta->bindParam(":email",$email);   
                    $objRespuesta->bindParam(":urlfoto",$foto); // ademas lo de naranja es lo que utilizamos en la consulta anteponiendo un :
                    $objRespuesta->bindParam(":idUsuario",$idusuario);
            
                    if ($objRespuesta->execute()){
                        $mensaje= array ("codigo"=>"200","mensaje"=>"El usuario se edito correctamente.");
                    }else {
                        $mensaje= array ("codigo"=>"401","mensaje"=>"Error al editar al usuario.");
                    }
                    $objRespuesta= null;
            
            
                } catch (Exception $e) {
                    $mensaje= array ("codigo"=>"401","mensaje"=>$e->getMessage());
                }
                return $mensaje;
        }



















  




}