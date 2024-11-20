

<div class="container">


    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Usuarios</h1>
            <p class="col-md-8 fs-4">
                "No te compares con nadie en este mundo... si lo haces, te estás insultando a ti mismo". - Bill Gates
            </p>
        </div>
    </div>
</div>


<div class="container" id="panelUsuario">
    <div class="row">
        <div class="col-md-4">
        <form id="formUsuario" class="needs-validation" novalidate>

        
            <div class="form-group col-md-12">
                <label for="">Documento</label>
                <input type="text" class="form-control" id="txt-documento" required>
                <div class="invalid-feedback">
                    este campo es obligatori ctm :C
                </div>
            </div>
    




        <div class="form-group col-md-12">
                <label for="">Nombre</label>
                <input type="text" class="form-control" id="txt-nombre" required>
                <div class="invalid-feedback">
                    este campo es obligatori ctm :C
                </div>
            </div>
       


        <div class="form-group col-md-12">
                <label for="">Apellido</label>
                <input type="text" class="form-control" id="txt-apellido" required>
                <div class="invalid-feedback">
                    este campo es obligatori ctm :C
                </div>
            </div>
        



        <div class="form-group col-md-12">
                <label for="">Email</label>
                <input type="email" class="form-control" id="txt-email" required>
                <div class="invalid-feedback">
                    este campo es obligatori ctm :C
                </div>
            </div>



            <div class="form-group col-md-12">
                <label for="">Foto usuario</label>
                <input type="file" class="form-control" id="txt-foto" accept=".jpg,.png,.web,.svg,.jpeg" required>
                <div class="invalid-feedback">
                    este campo es obligatori ctm :C
                </div>
                    </div>
           

                <button type="submit" class="btn btn-primary mt-3">Enviar form</button>
                    <br>
                </form>
                </div>





        <div class="col-md-8">
              <div  class="table-responsive">
                <table id="tablaUsuarios" class="table table-primary">
                    <thead>
                        <tr>
                            <th scope="col">Foto</th>
                            <th scope="col">Documento</th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Email</th>
                            <th scope="col"></th>

                        </tr>
                         </thead>
                       <tbody>
                        
                    </tbody>
                </table>
                
             </div>
        </div>
    </div>
</div>




<div id="panelEditar" class="container" style="display: none;">
    <div class="row">
        <div class="col-md-6">
        <form id="formUsuarioEditar" class="needs-validation" novalidate>

        
            <div class="form-group col-md-12">
                <label for="">Documento</label>
                <input type="text" class="form-control" id="txt-documentoEditar" required>
                <div class="invalid-feedback">
                    este campo es obligatori ctm :C
                </div>
            </div>
    




        <div class="form-group col-md-12">
                <label for="">Nombre</label>
                <input type="text" class="form-control" id="txt-nombreEditar" required>
                <div class="invalid-feedback">
                    este campo es obligatori ctm :C
                </div>
            </div>
       


        <div class="form-group col-md-12">
                <label for="">Apellido</label>
                <input type="text" class="form-control" id="txt-apellidoEditar" required>
                <div class="invalid-feedback">
                    este campo es obligatori ctm :C
                </div>
            </div>
        



        <div class="form-group col-md-12">
                <label for="">Email</label>
                <input type="email" class="form-control" id="txt-emailEditar" required>
                <div class="invalid-feedback">
                    este campo es obligatori ctm :C
                </div>
            </div>



            <div class="form-group col-md-12">
                <label for="">Foto usuario</label>
                <input type="file" class="form-control" id="txt-fotoEditar" accept=".jpg,.png,.web,.svg,.jpeg" required>
                <div class="invalid-feedback">
                    este campo es obligatori ctm :C
                </div>
                    </div>
           

                <button id="btnEnviarEditar" type="submit" class="btn btn-primary mt-3">Enviar form</button>
                    <br>
                </form>
                </div>





        
        </div>
    </div>
</div>








      










<script src="vista/js/usuario.js"></script>
