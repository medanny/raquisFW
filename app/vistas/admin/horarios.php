<div class="col-xs-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Nuevo Hora</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="" method="POST">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nombre</label>
                      <input type="text" name="nombre" class="form-control" placeholder="Nombre">
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <input  type="hidden" name="accion" value="nuevo" />
                    <button type="submit" class="btn btn-primary">Crear</button>
                  </div>
                </form>
              </div><!-- /.box -->
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Hora</h3>
                  <div class="box-tools">
                    <div class="input-group">
                      
                      
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tbody><tr>
                      <th>ID</th>
                      <th>Lugar</th>
                      <th>Editar</th>
                    </tr>

                    <?php
                    foreach ($horas as $hora) {
                    	# code...
                    ?>
					<tr>
                      <td><?=$hora['id']?></td>
                      <td><?=$hora['nombre']?></td>
                      <td><span class="label label-success">Editar</span><span class="label label-danger">Borrar</span></td>
                    </tr>

                    <?php
                    }
                    ?>
                    
                  </tbody></table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>