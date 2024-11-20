<?php


    include_once "../modelo/usuarioAreaModelo.php";




        class usuarioAreaControlador {
         
                public function ctrListarAreaControlador(){
                    $objRespuesta= usuarioAreaModelo:: mdlUsuarioAreaModelo();
                    echo json_encode($objRespuesta);
                }



        }




        if (isset($_POST["listarAreaUsuarios"]) == "ok") {  // <- Aqui
            $objUsuarioAreaControlador = new usuarioAreaControlador();
            $objUsuarioAreaControlador->ctrListarAreaControlador();
        }