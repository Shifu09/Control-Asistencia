<!--CABEZA DE LA INTERFAZ DEL ADMINISTRADOR CON SU NAVBAR-->
<?php
include("conexion.php");
//para iniciar sesion
session_start();
if (!isset($_SESSION['id_empleado'])) {
    header("Location: index.php");
}

$iduser = $_SESSION['id_empleado'];
$consulta = "SELECT * FROM empleados WHERE codigo = '$iduser'";
$resultado = $con->query($consulta);
$fila = $resultado->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c8a0597b0e.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="img/aguamerca_logo.png">
    <title>Admin</title>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    

<body style="background-color: #e4efe7;">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous"></script>
    <nav class="navbar navbar-expand-lg navbar-light d-flex justify-content-between">
        <div class="d-flex bd-highlight mx-2">

        </div>

        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle mx-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);">
                <img src="img/aguamerca_logo.png" alt="Logo" class="nav-logo">Bienvenido <?php echo utf8_decode($fila['nombres']); ?> </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="salir.php"><i class="fas fa-sign-out-alt" style="color: red;"></i> Cerrar sesion</a></li>
            </ul>
        </div>

    </nav>
    <div class="d-flex align-items-center">