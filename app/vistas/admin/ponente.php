<div class="col-xs-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Nuevo Ponente</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="" method="POST">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nombre</label>
                      <input type="text" name="ponente" class="form-control" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Ponencia</label>
                      <input type="text" name="ponencia" class="form-control" placeholder="Ponencia">
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <input  type="hidden" name="accion" value="nuevoponente" />
                    <button type="submit" class="btn btn-primary">Crear</button>
                  </div>
                </form>
              </div><!-- /.box -->
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Ponentes</h3>
                  <div class="box-tools">
                    <div class="input-group">
                      
                      
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tbody><tr>
                      <th>ID</th>
                      <th>Ponente</th>
                      <th>Ponencia</th>
                      <th>Editar</th>
                    </tr>

                    <?php
                    foreach ($ponentes as $ponente) {
                    	# code...
                    ?>
					<tr>
                      <td><?=$ponente['id']?></td>
                      <td><?=$ponente['ponente']?></td>
                      <td><?=$ponente['ponencia']?></td>
                      <td><span class="label label-success">Editar</span><span class="label label-danger">Borrar</span></td>
                    </tr>

                    <?php
                    }
                    ?>
                    
                  </tbody></table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>