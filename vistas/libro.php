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
<!--Contenido00-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Books <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> New Book</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Options</th>
                            <th>Title</th>
                            <th>Avaliable</th>
                            <th>Author</th>
                            <th>Editorial</th>
                            <th>Edition Year</th>
                            <th>Topic</th>
                            <th>Pages</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Title:</label>
                            <input type="hidden" name="idlibro" id="idlibro">
                            <input type="text" class="form-control" name="titulo" id="titulo" maxlength="70" placeholder="Enter Title" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Avaliable:</label>
                            <input type="number" class="form-control" name="cantidad_disponible" id="cantidad_disponible" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Author:</label>
                          <select id="idautor" name="idautor" class="form-control selectpicker" data-live-search="true" required></select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Editorial:</label>
                          <select id="ideditorial" name="ideditorial" class="form-control selectpicker" data-live-search="true" required></select>
                        </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Edition Year(*):</label>
                            <input type="number" class="form-control" name="year_edicion" id="year_edicion" required>
                          </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Topic:</label>
                          <select id="idmateria" name="idmateria" class="form-control selectpicker" data-live-search="true" required></select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Pages:</label>
                            <input type="number" class="form-control" name="numero_paginas" id="numero_paginas" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Description:</label>
                            <input type="text" class="form-control" name="descripcion" id="descripcion" maxlength="800" placeholder="Enter Description">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Image:</label>
                            <input type="file" class="form-control" name="imagen" id="imagen">
                            <input type="hidden" name="imagenactual" id="imagenactual">
                            <img src="" width="150px" height="120px" id="imagenmuestra">
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
<script type="text/javascript" src="scripts/libro.js"></script>
<?php 
}
ob_end_flush();
?>
<script type="text/javascript">
  $('#siLibros').addClass("active");
</script>