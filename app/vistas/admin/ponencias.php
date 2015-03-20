<div class="col-xs-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Nueva Ponencia</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="" method="POST">
                  <div class="box-body">
                    <div class="form-group">
                      <label>Ponentes</label>
                      <select class="form-control" name="id_ponencia">
                        <?php

                        	echo $ponentes;
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                    <div class="form-group">
                      <label>Horarios</label>
                      <select class="form-control" name="id_horario">
                        <?php
                        	echo $horarios;
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                    <div class="form-group">
                      <label>Lugares</label>
                      <select class="form-control" name="id_lugar">
                        <?php
                        	echo $lugares;
                        ?>
                      </select>
                    </div>
                    

                  <div class="box-footer">
                    <input  type="hidden" name="accion" value="nueva" />
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
                      <th>Ponencia</th>
                      <th>Horario</th>
                      <th>Lugar</th>
                    </tr>

                    <?php
                    foreach ($ponencias as $ponencia) {
                    	# code...
                    ?>
					<tr>
                      <td><?=$ponencia['id']?></td>
                      <td><?=$ponencia['ponente']?>-<?=$ponencia['ponencia']?></td>
                      <td><?=$ponencia['hora_nombre']?></td>
                      <td><?=$ponencia['lugar_nombre']?></td>
                      <td><span class="label label-success">Editar</span><span class="label label-danger">Borrar</span></td>
                    </tr>

                    <?php
                    }
                    ?>
                    
                  </tbody></table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>