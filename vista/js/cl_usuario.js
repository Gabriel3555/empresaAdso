class Usuario{

    constructor(objData){
        this.objDataUsuario = objData;
    }

    listarUsuarios(){
        
            let objData = new FormData();
            objData.append("listarUsuarios",this.objDataUsuario.listarUsuarios);


            fetch("controlador/usuarioControlador.php",{
                method: 'POST',
                body: objData
            })
            .then(response=>response.json()).catch(error=>{
                console.log(error);
            })
            .then(response=>{
                console.log(response)

                if (response["codigo"]=="200"){


                    let dataSet = [];


                    response["listarUsuarios"].forEach(item => {
                        let objBotones = '<div class="btn-group" role="group">';
                        objBotones += '<button id="btnEditar" type="button" class="btn btn-info" idUsuario="' + item.idusuario + '" documento="' + item.documento + '" nombre="' + item.nombre + '" apellido="' + item.apellido + '" email="' + item.email + '" foto="' + item.urlfoto + '"><i class="bi bi-cloud-arrow-up"></i></button>';
                        objBotones += '<button id="btnEliminar" type="button" class="btn btn-danger" idUsuario="' + item.idusuario + '"><i class="bi bi-person-x"></i></button>';
                        objBotones += '</div>';

                        dataSet.push(['<div class="foto"><img src="'+item.urlfoto+'" style="height: 60px; width: 80px;"></div>', item.documento, item.nombre + " " + item.apellido, item.email, objBotones]);

                    });

                    $('#tablaUsuarios').DataTable({
                        buttons: [{
                            extend: "colvis",
                            text: "Columnas"
                        },
                            "excel",
                            "pdf",
                            "print"
                        ],
                        dom: "Bfrtip",
                        responsive: true,
                        destroy: true,
                        data: dataSet
                    });
                } else {
                    console.log("Error en la respuesta o no hay usuarios");
                }
            })

        }




    registrarUsuarios(){
        let objData = new FormData()
        objData.append("registrarUsuario",this.objDataUsuario.registrarUsuario);
        objData.append("documento",this.objDataUsuario.documento)
        objData.append("nombre",this.objDataUsuario.nombre)
        objData.append("apellido",this.objDataUsuario.apellido)
        objData.append("email",this.objDataUsuario.email)
        objData.append("foto",this.objDataUsuario.foto)
        
        fetch("controlador/usuarioControlador.php",{
            method: 'POST',
            body: objData
        })
        .then(response=> response.json()).catch(error=>{
            console.log(error);
        }).then(response =>{
            this.listarUsuarios();
        })

    }


    editarUsuarios(){
        console.log(this.objDataUsuario)
        let objData = new FormData();

        objData.append("editarUsuarios",this.objDataUsuario.editarUsuarios)
        objData.append("documento",this.objDataUsuario.documento)
        objData.append("nombre",this.objDataUsuario.nombre)
        objData.append("apellido",this.objDataUsuario.apellido)
        objData.append("email",this.objDataUsuario.email)
        objData.append("foto",this.objDataUsuario.foto)
        objData.append("idUsuario",this.objDataUsuario.idusuario);

        


        fetch("controlador/usuarioControlador.php", {
            method: 'POST',
            body: objData
        })

            .then(response => response.json()).catch(error => {
                console.log(error);
            })
            .then(response => {
                if (response["codigo"] == "200") {
                    let formulario = document.getElementById('formUsuarioEditar');
                    formulario.reset();
                    $("#panelUsuario").show();
                     $("#formUsuarioEditar").hide();

                    // con esta se actualia la tabla 
                    this.listarUsuarios();

                    // alerta
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: response["mensaje"],
                        showConfirmButton: false,
                        timer: 1500
                    });
                }else{
                    Swal.fire(response["mensaje"]);
                }
            })

    }


    // eliminar usuarios 


eliminarUsuarios(){


            let objData = new FormData();
            objData.append("eliminarUsuarios",this.objDataUsuario.eliminarUsuarios);
            objData.append("idusuario",this.objDataUsuario.idUsuario);
            fetch("controlador/usuarioControlador.php",{
                method: 'POST',
                body: objData
            })
            .then(response => response.json()).catch(error => {
                console.log(error);
            })
            .then(response =>{
                if (response["codigo"] == "200"){
                    this.listarUsuarios();
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: response["mensaje"],
                        showConfirmButton: false,
                        timer: 1500
                      });
                }else{
                    Swal.fire(response["mensaje"]);
                }
            })
        }
    }
