class UsuarioArea{

    constructor(objData){
        this._objData = objData;
    }


    listarAreaUsuarios(){
        let objData = new FormData();
        objData.append("listarAreaUsuarios",this._objData.listarAreaUsuarios);

        fetch("controlador/usuarioAreaControlador.php",{
            method: 'POST',
            body: objData
        })


          .then(response => response.json()).catch(error =>{
        console.log(error);
    })
    .then(response =>{

        console.log(response);



        if (response["codigo"] == "200"){

            let dataSet = [];

            response["listarEditar"].forEach(item => {
                let objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                objBotones += '<button id="btn-editar" type="button" class="btn btn-info" usuario="'+item.idusuario+'" id_area="'+item.id_area+'"  salario="'+item.salario+'"><i class="bi bi-pen"></i></button>';
                objBotones += '<button id="btn-eliminar" type="button" class="btn btn-danger" usuario="'+item.idusuario+'"><i class="bi bi-x"></i></button>';
                objBotones += '</div>';

                dataSet.push([item.nombre,item.area,item.salario,objBotones]);
            });

            $("#tablaUsuariosArea").DataTable({
                
                buttons:[{
                    extend: "colvis",
                    text: "Columnas"
                },
                "excel",
                "pdf",
                "print"
                ],
                dom: "Bfrtip",
                responsive: true,
                destroy:true,
                data:dataSet
            });
        }else{
            console.log("error");
        }

    })
    .catch((error)=>{
        console.log("Error",error);
    })

    }
}   