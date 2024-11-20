<?php

include_once "../modelo/usuarioModelo.php";

class usuarioControlador{

    public $idUsuario;
    public $documento;
    public $nombre;
    public $apellido;
    public $email;
    public $foto;


    public function ctrListarUsuarios(){
            $objRespuesta = usuarioModelo::mdlListarUsuarios();
            echo json_encode($objRespuesta);


    }

    public function ctrRegistrarUsuario(){
          $objRespuesta =usuarioModelo::mdlRegistrarUsuario($this->documento,$this->nombre,$this->apellido,$this->email,$this->foto);
        echo json_encode($objRespuesta);

    }


    public function ctrEliminarUsuario(){
        $objRespuesta = UsuarioModelo::mdlEliminarUsuario($this->idUsuario);
        echo json_encode($objRespuesta);
    }


    public function ctrEditarUsuario(){
        $objRespuesta = usuarioModelo::mdlEditarUsuarios($this->idUsuario,$this->documento,$this->nombre,$this->apellido,$this->email,$this->foto);
        echo json_encode($objRespuesta);
    }


}


if(isset($_POST["registrarUsuario"]) =="ok"){
    $objUsuario = new usuarioControlador();
    $objUsuario->documento=$_POST['documento'];
    $objUsuario->nombre=$_POST['nombre'];
    $objUsuario->apellido=$_POST["apellido"];
    $objUsuario->email=$_POST["email"];
    $objUsuario->foto=$_FILES["foto"];
    $objUsuario->ctrRegistrarUsuario();

}

if(isset($_POST["editarUsuarios"]) =="ok"){
    $objUsuario = new usuarioControlador();
    
    $objUsuario->documento=$_POST['documento'];
    $objUsuario->nombre=$_POST['email'];
    $objUsuario->apellido=$_POST["apellido"];
    $objUsuario->email=$_POST["email"];
    $objUsuario->foto=$_FILES["foto"];
    $objUsuarios->idUsuario = $_POST["idUsuario"];
    $objUsuario->ctrEditarUsuario();

}


if(isset($_POST["listarUsuarios"])=="ok"){
    $objUsuario = new usuarioControlador();
    $objUsuario->ctrListarUsuarios();
}


if (isset($_POST["eliminarUsuarios"]) == "ok"){
    $objUsuarios = new UsuarioControlador();
    $objUsuarios->idUsuario = $_POST["idUsuario"];
    $objUsuarios->ctrEliminarUsuario();
}