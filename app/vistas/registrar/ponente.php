<div class="register-box">
      <div class="register-logo">
        <a href="#"><b>Registro</b> Ponente</a>
      </div>

      <div class="register-box-body">
        <p class="login-box-msg">Porfavor llena los siguientes campos</p>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Nombre Completo" name="nombre" required/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Correo" name="correo" required/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group">
                      <select class="form-control" placeholder="Categoria" name="categoria" required>
                      <option value="">Categoria</option>
                      <option value="1">Experiencia </option>
                        <option value="2">Ensayo </option>
                        <option value="3">Propuesta formal </option>
                        <option value="4">Investigación terminada </option>
                        <option value="5">Cartel </option>
                      </select>
                    </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Autor Principal" name="autor" required/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Co Autores" name="coautor" required/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group">
                      <label for="exampleInputFile">Adjuntar Archivo</label>
                      <input type="file" id="exampleInputFile" name="image" required>
                      <p class="help-block">Adjunta algun archivo de tu trabajo.</p>
                    </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Escuela" name="escuela" required/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Institución de adscripción" name="institucion" required/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
                                    
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Registrarse</button>
            </div><!-- /.col -->
          </div>
        </form>        
      </div><!-- /.form-box -->
    </div><!-- /.register-box -->