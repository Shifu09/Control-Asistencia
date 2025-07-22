<!--PHP PARA AGREGAR EMPLEADOS-->

<?php
//se mandan a llamar lo que nesecitamos
include("head.php");
include("leftmenu.php");
include("agregar.php");
?>
<div class="container content-wrapper">
  <div>
    <h1 class="h4 mb-4 mt-5">Datos del empleado &raquo; Agregar datos</h1>

  </div>
  <div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="card shadow p-4" style="width: 100%; max-width: 800px; min-width: 650px;">
      <div class="card-body">
        <h5 class="card-title text-center mb-4">Datos del empleado</h5>
        <form class="row g-3" action="" method="post">
          <div class="row">
            <div class="col-md-6 mb-3">
              <input type="text" name="codigo" class="form-control" placeholder="Cédula del empleado" required>
            </div>
            <div class="col-md-6 mb-3">
              <input type="text" name="nombres" class="form-control" placeholder="Nombre del empleado" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <input type="text" name="apellido" class="form-control" placeholder="Apellido del empleado" required>
            </div>
            <div class="col-md-6 mb-3">
              <input type="text" name="telefono" class="form-control" placeholder="Teléfono" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <input type="text" name="puesto" class="form-control" placeholder="Cargo" required>
            </div>
            <div class="col-md-6 mb-3">
              <input type="text" name="gerencia" class="form-control" placeholder="Gerencia a la que pertenece" required>
            </div>
            <div class="col-md-6 mb-3">
              <select name="tipo" class="form-select">
                <option value="" selected disabled>Seleccione tipo de usuario</option>
                <option value=" 0">Empleado</option>
                <option value="1">Administrador</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <input type="password" id="contra" name="pass" class="form-control" placeholder="Contraseña" required>
            </div>
            <div class="col-md-6 mb-3">
              <input type="submit" name="add" class="btn btn-primary" value="Guardar datos">
              <a href="admin_ventana.php" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
      </div>
    </div>


    </form>
  </div>
</div>

<?php include_once("foot.php"); ?>
<script>
  $(document).ready(function() {
    $("#contra").hide();
    $("#contra").removeAttr("required");
    $(".form-select").change(function() {
      if ($(this).val() == "1") {
        $("#contra").show();
        $("#contra").prop("required", true);
      } else {
        $("#contra").hide();
        $("#contra").removeAttr("required");
      }
    });
  });
</script>