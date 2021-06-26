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
                          <h1 class="box-title">Loans/Returns <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> New Loan </button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Option</th>
                            <th>Book</th>
                            <th>Loan Date</th>
                            <th>Return Date</th>
                            <th>Quantity</th>
                            <th>Observation</th>
                            <th>Status</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                       <form name="formulario" id="formulario" method="POST">
                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                          <label>Book:</label>
                          <input type="hidden" name="idprestamo" id="idprestamo">
                          <select type="text" name="idlibro" id="idlibro" class="form-control selectpicker" data-live-search="true" required></select>
                          <input type="hidden" name="idarticulo" id="idarticulo">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
                          <label>Loan Date:</label>
                          <input type="date" name="fecha_prestamo" id="fecha_prestamo" class="form-control" placeholder="Enter loan date" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Return Date:</label>
                          <input type="date" name="fecha_devolucion" id="fecha_devolucion" class="form-control" placeholder="Enter return date" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Quantity:</label>
                          <input type="number" name="cantidad" id="cantidad" class="form-control" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Observation:</label>
                            <input type="text" class="form-control" name="observacion" id="observacion" maxlength="200" placeholder="Enter you observation">
                          </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Save</button>
                            <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancel</button>
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
<script type="text/javascript" src="scripts/prestamo.js"></script>
<?php 
}
ob_end_flush();
?>
<script type="text/javascript">
  $('#siPrestamos').addClass("active");
</script>
