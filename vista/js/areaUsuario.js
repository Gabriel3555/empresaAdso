(function(){

    listarTablaUsuariosArea();

    function listarTablaUsuariosArea(){
        let objData = {"listarAreaUsuarios":"ok"};
        let objUsuarioArea = new UsuarioArea(objData);
        objUsuarioArea.listarAreaUsuarios();
    }

})()