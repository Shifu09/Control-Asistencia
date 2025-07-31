<!--PHP PARA MODIFICAR EMPLEADOS-->

<?php
include("head.php");
include("leftmenu.php");
include("modificar.php");
//primero nos traemos el id del empleado
if (isset($_GET["nik"])) {
  $id = $_GET["nik"];
}
//se trae todo de ese empleado 
$query = "SELECT * FROM empleados WHERE codigo =$id";

$resultados = $con->query($query);
$res = $resultados->fetch_assoc();

function imprimirTipo($tipo)
{
  if ($tipo == 1) {
    echo '<option value="0" id="emp" >Empleado</option>
    <option value="1" selected="selected" id="admin" >Administrador</option>';
  } else {
    echo '<option value="0" selected="selected" id="emp" >Empleado</option>
    <option value="1" id="admin">Administrador</option>';
  }
}
//luego aqui se muestra al usuario
?>

<div class="container ">
  <div>
    <h1 class="h4 mb-4 mt-5">Datos del empleado &raquo; Modificar datos</h1>
    <hr class="bg-dark" style="height:2px; width:100%; border-width:0; color:#343a40; background-color:#343a40">
  </div>
  <div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="card shadow p-4" style="width: 100%; max-width: 800px; min-width: 650px;">
      <div class="card-body">
        <h5 class="card-title text-center mb-4">Datos del empleado</h5>
        <form class="row g-3" action="" method="post">
          <div class="row">
            <div class="col-md-6 mb-3">
              <input type="text" name="codigo" class="form-control" placeholder="Cédula del empleado" value="<?= $res['codigo'] ?>" required maxlength="8">
            </div>
            <div class="col-md-6 mb-3">
              <input type="text" name="nombres" class="form-control" placeholder="Nombre del empleado" value="<?= $res['nombres'] ?>" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <input type="text" name="apellido" class="form-control" placeholder="Apellido del empleado" value="<?= isset($res['apellido']) ? $res['apellido'] : '' ?>" required>
            </div>
            <div class="col-md-6 mb-3">
              <input type="text" name="telefono" class="form-control" placeholder="Teléfono" value="<?= $res['telefono'] ?>" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <input type="text" name="puesto" class="form-control" placeholder="Cargo" value="<?= $res['puesto'] ?>" required>
            </div>
            <div class="col-md-6 mb-3">
              <input type="text" name="gerencia" class="form-control" placeholder="Gerencia a la que pertenece" value="<?= isset($res['gerencia']) ? $res['gerencia'] : '' ?>" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <select name="tipo" class="form-select">
                <option value="" disabled>Seleccione tipo de usuario</option>
                <option value="0" <?= $res['tipo'] == 0 ? 'selected' : '' ?>>Empleado</option>
                <option value="1" <?= $res['tipo'] == 1 ? 'selected' : '' ?>>Administrador</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <input type="password" id="contra" name="pass" class="form-control" placeholder="Contraseña" required>
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <input type="submit" name="add" class="btn btn-primary" value="Guardar datos">
            <a href="reporteEmp.php" class="btn btn-danger">Cancelar</a>
          </div>
        </form>
      </div>
    </div>
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