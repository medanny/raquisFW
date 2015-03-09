<style>
  .login-box-body, .register-box-body{

    background: #f2f4f5;
padding: 20px;
color: #444;
border-top: 0;
color: #666;
  }

</style>
<div class="register-box">
      <div class="register-logo">
        <a href=""><b>Registro</b> Asistente</a>
      </div>

      <div class="register-box-body">
        <p class="login-box-msg">Porfavor llena los siguientes campos</p>
        <form action="" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Nombre Completo" name="nombre" required/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Correo" name="correo" required/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
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