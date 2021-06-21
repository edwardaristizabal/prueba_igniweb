<?php

ob_start();
session_start();
//Evaluamos si el usuario ha iniciado sesión si no está vacia la variables de sesión
//nombre indica que el usuario ha iniciado sesión
if (!isset($_SESSION["nombre"]))
{
  header("Location: ../index.php");
}

else
{
require 'header.php';

?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Editorials <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> New Editorial</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Options</th>
                            <th>Editorial Name</th>
                            <th>Description</th>
                            <th>Status</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                        </table>
                    </div>
                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Name:</label>
                            <input type="hidden" name="ideditorial" id="ideditorial">
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" placeholder="Enter Editorial Name" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Description:</label>
                            <input type="text" class="form-control" name="descripcion" id="descripcion" maxlength="500" placeholder="Enter Description">
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Save</button>

                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancel</button>
                          </div>
                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php

require 'footer.php';
?>
<script type="text/javascript" src="scripts/editorial.js"></script>
<?php 
}
ob_end_flush();
?>
<script type="text/javascript">
  $('#siEditoriales').addClass("active");
</script>