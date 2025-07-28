<?php
//para modificar
include("conexion.php");

if (!empty($_POST)) {
    //se traen los datos 
    $codigo = mysqli_real_escape_string($con, $_POST["codigo"]);
    $nombres = mysqli_real_escape_string($con, $_POST["nombres"]);
    $telefono = mysqli_real_escape_string($con, $_POST["telefono"]);
    $gerencia = mysqli_real_escape_string($con, $_POST["gerencia"]);
    $puesto = mysqli_real_escape_string($con, $_POST["puesto"]);
    $tipo = mysqli_real_escape_string($con, $_POST["tipo"]);
    $encriptar = mysqli_real_escape_string($con, $_POST["pass"]);
    $pass = sha1($encriptar);
    //se valida si existe ese empleado
    if ($codigo != $_SESSION['id_empleado']) {
        $consulta = "SELECT * FROM empleados WHERE codigo = '$codigo'";
        $resultado = $con->query($consulta);
        $filas = $resultado->num_rows;

        if ($filas > 0) {
            $fila = $resultado->fetch_assoc();
            if ($fila["estado"] != 0) {
                //si existe se hace el update
                $consulta = "UPDATE empleados SET nombres='$nombres', telefono='$telefono', gerencia='$gerencia',puesto='$puesto',tipo='$tipo',contrasenia='$pass' WHERE codigo='$codigo'";
                $con->query($consulta);
                echo "<script type='text/javascript'>Swal.fire({icon: 'success', title: '¡Éxito!', text: 'Modificado con exito!'}); window.location.href = 'reporteEmp.php';</script>";
            } else {
                //si no encuentra el empleado
                echo "<script type='text/javascript'>Swal.fire({icon: 'error', title: 'Error!', text: 'Cédula no encontrada.'});</script>";
            }
        } else {
            //si no encuentra el empleado
            echo "<script type='text/javascript'>Swal.fire({icon: 'error', title: 'Error!', text: 'Cédula no encontrada.'});</script>";
        }
    } else {
        //si hay algun problema
        $mensaje = 'No puedes modificar tus datos.';
        echo "<script type='text/javascript'>Swal.fire({icon: 'error', title: 'Error', text: '$mensaje'});</script>";
    }
}
