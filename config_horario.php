<?php
//aqui se hace la configuracion del horario

function inicio()
{
	include_once "conexion.php";
	include("head.php");
	include("leftmenu.php");
	//nos traemos todo de horario
	$sql0 = "SELECT  * FROM horario";
	$res0 = mysqli_query($con, $sql0);

	if (mysqli_num_rows($res0) > 0) {
		$row0 = mysqli_fetch_assoc($res0);
	}
?>
	<!--aqui es lo que se le muestra al usuario-->
	<div class="tab-content flex-grow-1 ms-3" id="v-tabs-tabContent">
		<div class="container-fluid my-5">
			<h3>Configurar Horarios laborales</h3>
			<form id="horarios">
				<input type="hidden" id='process' name='process' value="guardar" />
				<table>
					<tr>
						<td>Dia</td>
						<td>Hora entrada</td>
						<td>Minutos entrada</td>
						<td>Hora salida</td>
						<td>Minutos salida</td>
					</tr>
					<?php
					// Lunes a Jueves
					$hora_e_sem = isset($row0['hora_e_sem']) ? $row0['hora_e_sem'] : '08:00:00';
					$hora_s_sem = isset($row0['hora_s_sem']) ? $row0['hora_s_sem'] : '16:00:00';
					list($h_e_sem, $m_e_sem, $s_e_sem) = explode(':', $hora_e_sem);
					list($h_s_sem, $m_s_sem, $s_s_sem) = explode(':', $hora_s_sem);
					// Viernes
					$hora_e_vie = isset($row0['hora_e_vie']) ? $row0['hora_e_vie'] : '08:00:00';
					$hora_s_vie = isset($row0['hora_s_vie']) ? $row0['hora_s_vie'] : '15:00:00';
					list($h_e_vie, $m_e_vie, $s_e_vie) = explode(':', $hora_e_vie);
					list($h_s_vie, $m_s_vie, $s_s_vie) = explode(':', $hora_s_vie);
					// Sábado
					$hora_e_fd = isset($row0['hora_e_fd']) ? $row0['hora_e_fd'] : '08:00:00';
					$hora_s_fd = isset($row0['hora_s_fd']) ? $row0['hora_s_fd'] : '12:00:00';
					list($h_e_fd, $m_e_fd, $s_e_fd) = explode(':', $hora_e_fd);
					list($h_s_fd, $m_s_fd, $s_s_fd) = explode(':', $hora_s_fd);

					// Mostrar filas
					echo "<tr>
						<td class='dia'>Lunes a Jueves</td>
						<td><input type='number' name='hora_e_sem_h' min='0' max='23' class='datas form-control input-md integer_positive' value='$h_e_sem'></td>
						<td><input type='number' name='hora_e_sem_m' min='0' max='59' class='datas form-control input-md integer_positive' value='$m_e_sem'></td>
						<td><input type='number' name='hora_s_sem_h' min='0' max='23' class='datas form-control input-md integer_positive' value='$h_s_sem'></td>
						<td><input type='number' name='hora_s_sem_m' min='0' max='59' class='datas form-control input-md integer_positive' value='$m_s_sem'></td>
					</tr>";
					echo "<tr>
						<td class='dia'>Viernes</td>
						<td><input type='number' name='hora_e_vie_h' min='0' max='23' class='datas form-control input-md integer_positive' value='$h_e_vie'></td>
						<td><input type='number' name='hora_e_vie_m' min='0' max='59' class='datas form-control input-md integer_positive' value='$m_e_vie'></td>
						<td><input type='number' name='hora_s_vie_h' min='0' max='23' class='datas form-control input-md integer_positive' value='$h_s_vie'></td>
						<td><input type='number' name='hora_s_vie_m' min='0' max='59' class='datas form-control input-md integer_positive' value='$m_s_vie'></td>
					</tr>";
					echo "<tr>
						<td class='dia'>Sábado</td>
						<td><input type='number' name='hora_e_fd_h' min='0' max='23' class='datas form-control input-md integer_positive' value='$h_e_fd'></td>
						<td><input type='number' name='hora_e_fd_m' min='0' max='59' class='datas form-control input-md integer_positive' value='$m_e_fd'></td>
						<td><input type='number' name='hora_s_fd_h' min='0' max='23' class='datas form-control input-md integer_positive' value='$h_s_fd'></td>
						<td><input type='number' name='hora_s_fd_m' min='0' max='59' class='datas form-control input-md integer_positive' value='$m_s_fd'></td>
					</tr>";
					?>
				</table>
		</div>
		<div class="container-fluid my-5">
			<div class="justify-content-center ">
				<div class="border border-light p-3 mb-4">
					<div class="text-center">
						<!--aqui dejamos el boton de guardar los datos si en caso los modifica-->
						<input type="submit" name="guardar2" id="guardar2" class="btn btn-outline-primary" value="Guardar datos">
						<a type="button" href="reporteEmp.php" class="btn btn-outline-danger">Cancelar</a>
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
	<?php include_once("foot.php"); ?>
	<script src="js/config_horario.js"></script>
<?php
}
//aqui es cuando de click en guardar
function guardar()
{
	include "conexion.php";
	$validar = true;
	// Lunes a Jueves
	$h_e_sem = isset($_POST['hora_e_sem_h']) ? $_POST['hora_e_sem_h'] : '';
	$m_e_sem = isset($_POST['hora_e_sem_m']) ? $_POST['hora_e_sem_m'] : '';
	$h_s_sem = isset($_POST['hora_s_sem_h']) ? $_POST['hora_s_sem_h'] : '';
	$m_s_sem = isset($_POST['hora_s_sem_m']) ? $_POST['hora_s_sem_m'] : '';
	// Viernes
	$h_e_vie = isset($_POST['hora_e_vie_h']) ? $_POST['hora_e_vie_h'] : '';
	$m_e_vie = isset($_POST['hora_e_vie_m']) ? $_POST['hora_e_vie_m'] : '';
	$h_s_vie = isset($_POST['hora_s_vie_h']) ? $_POST['hora_s_vie_h'] : '';
	$m_s_vie = isset($_POST['hora_s_vie_m']) ? $_POST['hora_s_vie_m'] : '';
	// Sábado
	$h_e_fd = isset($_POST['hora_e_fd_h']) ? $_POST['hora_e_fd_h'] : '';
	$m_e_fd = isset($_POST['hora_e_fd_m']) ? $_POST['hora_e_fd_m'] : '';
	$h_s_fd = isset($_POST['hora_s_fd_h']) ? $_POST['hora_s_fd_h'] : '';
	$m_s_fd = isset($_POST['hora_s_fd_m']) ? $_POST['hora_s_fd_m'] : '';

	if (
		$h_e_sem === '' || $m_e_sem === '' || $h_s_sem === '' || $m_s_sem === '' ||
		$h_e_vie === '' || $m_e_vie === '' || $h_s_vie === '' || $m_s_vie === '' ||
		$h_e_fd === '' || $m_e_fd === '' || $h_s_fd === '' || $m_s_fd === ''
	) {
		$validar = false;
	}

	$hora_e_sem = sprintf('%02d:%02d:00', $h_e_sem, $m_e_sem);
	$hora_s_sem = sprintf('%02d:%02d:00', $h_s_sem, $m_s_sem);
	$hora_e_vie = sprintf('%02d:%02d:00', $h_e_vie, $m_e_vie);
	$hora_s_vie = sprintf('%02d:%02d:00', $h_s_vie, $m_s_vie);
	$hora_e_fd = sprintf('%02d:%02d:00', $h_e_fd, $m_e_fd);
	$hora_s_fd = sprintf('%02d:%02d:00', $h_s_fd, $m_s_fd);

	$q = "UPDATE horario SET 
		hora_e_sem='$hora_e_sem',
		hora_s_sem='$hora_s_sem',
		hora_e_vie='$hora_e_vie',
		hora_s_vie='$hora_s_vie',
		hora_e_fd='$hora_e_fd',
		hora_s_fd='$hora_s_fd'";

	if ($validar == false) {
		$datos["mensaje"] = "¡Revise que las casillas de horario no estén vacías!";
	} else {
		$update = mysqli_query($con, $q) or die(mysqli_error());
		if ($update) {
			$datos["mensaje"] = "Horario Actualizado";
		} else {
			$datos["mensaje"] = "Horario no pudo ser Actualizado!";
		}
	}
	echo json_encode($datos);
}
if (!isset($_REQUEST['process'])) {
	inicio();
}

if (isset($_REQUEST['process'])) {
	switch ($_REQUEST['process']) {
		case 'inicio':
			inicio();
			break;
		case 'guardar':
			guardar();
			break;
	}
}
?>