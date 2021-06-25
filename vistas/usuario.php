<?php
//Iniciar el buffer
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
include "header.php";
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
                      <h1 class="box-title">Users <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i>New User </button></h1>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>User consecutive</th>
                            <th>Options</th>
                            <th>Suscriptor code</th>
                            <th>Identification number</th>
                            <th>User Name</th>
                            <th>Profession</th>
                            <th>Ocupation</th>
                            <th>Address</th>
                            <th>Telephone number</th>
                            <th>E-mail</th>
                            <th>Login User</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                        </table>
                    </div>
                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Suscriptor code:</label>
                            <input type="hidden" name="idusuario" id="idusuario">
                            <input type="text" class="form-control" name="codigo_trabajador" id="codigo_trabajador" maxlength="20" placeholder="Enter you suscriptor code" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Identification number:</label>
                            <input type="text" class="form-control" name="num_documento" id="num_documento" maxlength="8" placeholder="Enter you identification number" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>User Name:</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" placeholder="Enter you user name" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Profession:</label>
                            <input type="text" class="form-control" name="profesion" id="profesion" maxlength="30" placeholder="Enter you profession">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Ocupation:</label>
                             <input type="text" class="form-control" name="cargo" id="cargo" maxlength="30" placeholder="Enter you ocupation">
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Address:</label>
                            <input type="text" class="form-control" name="direccion" id="direccion" maxlength="70" placeholder="Enter you address" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Telephone number:</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" maxlength="20" placeholder="Enter you telephone number" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>E-mail:</label>
                            <input type="email" class="form-control" name="email" id="email" maxlength="50" placeholder="E-mail">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Login User:</label>
                            <input type="text" class="form-control" name="login" id="login" maxlength="20" placeholder="Enter login user" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Password:</label>
                            <input type="password" class="form-control" name="clave" id="clave" maxlength="20" placeholder="Enter you password" required>
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
 include 'footer.php';
?>
<script type ="text/javascript" src="scripts/usuario.js"></script>
<?php
//Cerramos el else
}
//Liberamos el espacio del buffer
ob_end_flush();
?>
<script type="text/javascript">
  $('#siUsuarios').addClass("active");
</script>