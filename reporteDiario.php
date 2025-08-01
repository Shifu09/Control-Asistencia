<?php
//aqui es el reporte diario
include("conexion.php");
include("funciones.php");
include("head.php");
include("leftmenu.php");
//nos traemos las cosas de horario
$sql0 = "SELECT id, hora_e_sem, hora_s_sem, hora_e_fd, hora_s_fd, hora_e_vie, hora_s_vie FROM horario";
$res0 = mysqli_query($con, $sql0);
$row0 = mysqli_fetch_assoc($res0);
?>


<div class="container content-wrapper">
  <div>
    <h1 class="h4 mb-4 mt-5">Reporte diario</h1>
    <hr class="bg-dark" style="height:2px; width:100%; border-width:0; color:#343a40; background-color:#343a40">
  </div>
  <div class="row">
    <div class="table-responsive mt-5">
      <table class="table table-striped table-hover">
        <tr>
          <th>No</th>
          <th>Nombre</th>
          <th>Hora de llegada</th>
          <th>Hora Salida</th>
          <th>Observaciones</th>
          <th>Observacion de marcado</th>
        </tr>
        <?php

        $filter = 1;
        if ($filter) {
          //aqui es para mostrar a los empleados
          $sql = mysqli_query($con, "SELECT * FROM marcas WHERE fecha = CURDATE()");
        }

        if (mysqli_num_rows($sql) == 0) {
          //cuando no hay datos
          echo '<tr><td colspan="8">No hay datos.</td></tr>';
        } else {
          $no = 1;
          while ($row = mysqli_fetch_assoc($sql)) {
            // lo siguiente es para el menu de acciones, de aqui se muestra en una tabla
            // la hora de entrada, salida, si está en la empresa o no, etc.
            $codigo = $row['codigo'];
            $query = mysqli_query($con, "SELECT * FROM empleados WHERE codigo='$codigo'");
            while ($nom = mysqli_fetch_assoc($query)) {
              if ($nom['estado'] == 1) {
                $activo = $nom['disponible'] != 0 ? 'Sí' : 'No';
                echo '<tr>
								<td>' . $no . '</td>
								<td>' . $nom['nombres'] . '</td>
								<td>' . $row['hora_e'] . '</td>
								<td>' . $row['hora_s'] . '</td>
                <td>' . $row['observaciones'] . '</td>
                <td>';
                //obtener observaciones del dia
                if (date("w") > 0 && date("w") < 6) { // Lunes a Viernes
                  // Entrada (siempre contra hora_e_sem)
                  if ($row['hora_e']) {
                    $hes1 = new DateTime($row['fecha'] . " " . $row0['hora_e_sem']);
                    $hes2 = new DateTime($row['fecha'] . " " . $row['hora_e']);
                    $obs_es = obtener_observa($hes1, $hes2, "E");
                    echo $obs_es;
                  } else {
                    echo "<span class='text-danger'>No marco Entrada</span>";
                  }
                  // Mostrar observación manual si existe
                  if (!empty($row['observacion'])) {
                    echo "<div class='text-primary'><strong>Obs. usuario:</strong> " . htmlspecialchars($row['observacion']) . "</div>";
                  }
                  // Salida: viernes usa hora_s_vie, otros días hora_s_sem
                  if ($row['hora_s']) {
                    $dia_semana = date('w', strtotime($row['fecha']));
                    if ($dia_semana == 5 && isset($row0['hora_s_vie'])) { // Viernes
                      $hss1 = new DateTime($row['fecha'] . " " . $row0['hora_s_vie']);
                    } else { // Lunes a jueves
                      $hss1 = new DateTime($row['fecha'] . " " . $row0['hora_s_sem']);
                    }
                    $hss2 = new DateTime($row['fecha'] . " " . $row['hora_s']);
                    $obs_ss = obtener_observa($hss1, $hss2, "S");
                    echo $obs_ss;
                  } else {
                    echo "<span class='text-danger'>No marco Salida</span>";
                  }
                }
                if (date("w") == 6 || date("w") == 0) { //esto ya es para sabado y domingo
                  if ($row['hora_e']) {
                    $hefd1 = new DateTime($row['fecha'] . " " . $row0['hora_e_fd']); //config horario
                    $hefd2 = new DateTime($row['fecha'] . " " . $row['hora_e']); //esto es para el finde
                    $obs_efd = obtener_observa($hefd1, $hefd2, "E");
                    echo $obs_efd;
                  } else {
                    echo "<span class='text-danger'>No marco Entrada</span>";
                  }
                  if ($row['hora_s']) {
                    $hsfd1 = new DateTime($row['fecha'] . " " . $row0['hora_s_fd']); //config horario
                    $hsfd2 = new DateTime($row['fecha'] . " " . $row['hora_s']);
                    $obs_sfd = obtener_observa($hsfd1, $hsfd2, "S");
                    echo $obs_sfd;
                  } else {
                    echo "<span class='text-danger'>No marco Salida</span>";
                  }
                }
                echo '</td></tr>';
              }
            }
            $no++;
          }
        }
        ?>
      </table>
    </div>
  </div>
</div>
<?php include_once("foot.php"); ?>