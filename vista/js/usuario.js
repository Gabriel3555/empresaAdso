(function(){


    // listar usuarios 


    listarTablaUsuarios();

    function listarTablaUsuarios(){
       
        let objData = {"listarUsuarios":"ok"};
        let objDataUsuario = new Usuario(objData);
        objDataUsuario.listarUsuarios();
    }



// EDITAR 

     
    $("#tablaUsuarios").on("click","#btnEditar",function(){
        $("#panelUsuario").hide();
        $("#panelEditar").show();


        let documento=$(this).attr("documento")
        let nombre=$(this).attr("nombre")
        let apellido=$(this).attr("apellido")
        let email=$(this).attr("email")
        let foto = $(this).attr("foto")
        let idUsuario=$(this).attr("idUsuario")


        $("#txt-documentoEditar").val(documento) 
        $("#txt-nombreEditar").val(nombre) 
        $("#txt-apellidoEditar").val(apellido)
        $("#txt-emailEditar").val(email)
        $("#txt-fotoEditar").val(foto)   
        $("#btnEnviarEditar").attr("idUsuario",idUsuario)    

    })

// ELIMINAR ALERTA Y ON CLICK 


    $("#tablaUsuarios").on("click","#btnEliminar",function(){
    Swal.fire({
        title: "Esta usted seguro?",
        text: "Si confirma esta opción no podra recuperar el registro!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar"
      }).then((result) => {
        if (result.isConfirmed) {
            let idUsuario = $(this).attr("idUsuario");
            let objData = {"eliminarUsuarios":"ok","idUsuario":idUsuario,"listarUsuarios":"ok"};
            let objUsuario = new Usuario(objData);
            objUsuario.eliminarUsuarios();
        }
      });
    })













    // registrar usuarios 

    

    'use strict'

    var formUsuario = document.querySelectorAll('#formUsuario');



    Array.prototype.slice.call(formUsuario)
    .forEach(function(form){
        form.addEventListener('submit',function(event){
            event.preventDefault();


            if(!form.checkValidity()){
                    event.stopPropagation();
                    form.classList.add('was-validated');

            }else{

                let documento = document.getElementById('txt-documento').value
                let nombre= document.getElementById('txt-nombre').value
                let apellido= document.getElementById('txt-apellido').value
                let email= document.getElementById('txt-email').value
                let foto= document.getElementById('txt-foto').files[0];


                let objData = {"registrarUsuario":"ok","documento":documento,"nombre":nombre,"apellido":apellido,"email":email,"foto":foto,"listarUsuarios":"ok"}
                let objUsuario = new Usuario(objData)
                objUsuario.registrarUsuarios();


            }
        })
    })





    


    const formsEditar = document.querySelectorAll('#formUsuarioEditar') // se lleva todo el formulario para ingresar a la persona 

    Array.from(formsEditar).forEach(form => {  // recorre el formulario 
        form.addEventListener('submit', event => { // sumit es el que valida el formulario


            event.preventDefault()
          if (!form.checkValidity()) { // se esta validando el formulario atraves del checkvalidity 
            event.stopPropagation()
            form.classList.add('was-validated')
            }else{
                let documento = document.getElementById('txt-documentoEditar').value
                let nombre= document.getElementById('txt-nombreEditar').value
                let apellido= document.getElementById('txt-apellidoEditar').value
                let email= document.getElementById('txt-emailEditar').value
                let foto= document.getElementById('txt-fotoEditar').files[0];
                let idusuario=$('#Enviar').attr("idUsuario");
                console.log(idusuario) 

                let objData = {"editarUsuarios":"ok","idusuario":idusuario,"documento":documento,"nombre":nombre,"apellido":apellido,"email":email,"foto":foto,"listarUsuarios":"ok"}
                let objUsuario = new Usuario(objData)
                objUsuario.editarUsuarios();


            }
        })
    })



    


})();