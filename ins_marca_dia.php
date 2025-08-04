<?php
//para marcar asistencia
include("conexion.php");
date_default_timezone_set('America/Caracas');
$codigo = $_POST['codigo']; //empleado
$marca = $_POST['marca']; //puede ser entrada o salida E ó S
$fecha = date('Y-m-d');
$hora = date('h:i:s A'); // 24h para comparar
$observaciones = $_POST['observaciones'];
$hnull = NULL;

// Obtener el día de la semana y los horarios
$dia_semana = date('N'); // 1=lunes ... 5=viernes, 6=sábado, 7=domingo
$sql_hor = mysqli_query($con, "SELECT * FROM horario LIMIT 1");
$row_hor = mysqli_fetch_assoc($sql_hor);
if ($dia_semana >= 1 && $dia_semana <= 4) { // Lunes a jueves
	$hora_entrada = $row_hor['hora_e_sem'];
	$hora_salida  = $row_hor['hora_s_sem'];
} elseif ($dia_semana == 5) { // Viernes
	$hora_entrada = $row_hor['hora_e_vie'];
	$hora_salida  = $row_hor['hora_s_vie'];
} elseif ($dia_semana == 6) { // Sábado
	$hora_entrada = $row_hor['hora_e_fd'];
	$hora_salida  = $row_hor['hora_s_fd'];
} else {
	$hora_entrada = null;
	$hora_salida  = null;
}

$sql0 = mysqli_query($con, "SELECT * FROM empleados WHERE codigo='$codigo'");
//consultar si existe empleado
$nombre = "";
if (mysqli_num_rows($sql0) > 0) {
	$row0 = mysqli_fetch_assoc($sql0);

	$datos['nombre'] = $row0['nombres'];
	$nombre = $row0['nombres'];

	$sql1 = mysqli_query($con, "SELECT * FROM marcas WHERE codigo='$codigo' AND fecha='$fecha'");
	//consultar si existe empleado
	if (mysqli_num_rows($sql1) > 0) {

		$row = mysqli_fetch_assoc($sql1);
		$datos['codigo'] = $row['codigo'];
		$datos['fecha'] = $row['fecha'];
		$datos['hora_e'] = $row['hora_e'];
		$datos['hora_s'] = $row['hora_s'];
		//para marcar entrada
        if ($marca == 'E') {
            // Validar si ya existe hora_e para este usuario y fecha
            if (!empty($row['hora_e'])) {
                $datos['operacion'] = 'YA_MARCO_ENTRADA';
                $datos['mensaje'] = $nombre . ': Ya marcó la ENTRADA hoy.';
                echo json_encode($datos);
                exit;
            }
            $update = mysqli_query($con, "UPDATE marcas SET hora_e='$hora', observaciones='$observaciones' WHERE codigo='$codigo' AND fecha='$fecha'") or die(mysqli_error());
            $update1 = mysqli_query($con, "UPDATE `empleados` SET `disponible` = '1' WHERE `codigo` = '$codigo'");
            $tipo_marc = " MARCA ENTRADA A LAS ";
        }
        //para marcar salida
        if ($marca == 'S') {
            // Validar si ya existe hora_s para este usuario y fecha
            if (!empty($row['hora_s'])) {
                $datos['operacion'] = 'YA_MARCO_SALIDA';
                $datos['mensaje'] = $nombre . ': Ya marcó la SALIDA hoy.';
                echo json_encode($datos);
                exit;
            }
			$nueva_obs = ", " . $observaciones;
			$update = mysqli_query($con, "UPDATE marcas SET hora_s='$hora', observaciones=CONCAT(IFNULL(observaciones,''), IF(observaciones IS NULL OR observaciones = '', '', '\n'), '$nueva_obs') WHERE codigo='$codigo' AND fecha='$fecha'") or die(mysqli_error());
			$update1 = mysqli_query($con, "UPDATE `empleados` SET `disponible` = '0' WHERE `codigo` = '$codigo'");
			$tipo_marc = " MARCA SALIDA A LAS ";
		}
		if ($update) {
			$datos['operacion'] = 'UPD';
			$datos['mensaje'] = $nombre . ": " . $tipo_marc . " " . $hora;
		}
	} else {
		//si no hay registro de marcs en la fecha actual, inserta
		if ($marca == 'E') {
			$q_ins = "INSERT INTO marcas(id,codigo, fecha, hora_e, observaciones) ";
			$tipo_marc = " MARCA ENTRADA A LAS ";
		} else {
			$q_ins = "INSERT INTO marcas(id,codigo, fecha, hora_s, observaciones) ";
			$tipo_marc = " MARCA SALIDA A LAS ";
		}
		$q_ins .= " VALUES(DEFAULT,'$codigo','$fecha', '$hora', '$observaciones')";
		$insert = mysqli_query($con, $q_ins) or die(mysqli_error());

		if ($insert) {
			$datos['operacion'] = 'INS';
			$datos['mensaje'] = $nombre . ": " . $tipo_marc . " " . $hora;
		} else {
			$datos['operacion'] = 'NO_EJECUTADA';
			$datos['mensaje'] = $nombre . " NO REGISTRO MARCA";
		}
	}
	//si el codigo no existe
} else {
	$datos['operacion'] = 'NO EXISTE';
	$datos['mensaje'] = ' CODIGO  DE EMPLEADO: ' . $codigo . ',  NO EXISTE ';
}
echo json_encode($datos);
