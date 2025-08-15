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


<style>
  .custom-table-container {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
    padding: 24px 18px 18px 18px;
    margin-bottom: 40px;
  }

  .custom-table th {
    background: #132795;
    color: #fff;
    font-weight: bold;
    position: sticky;
    top: 0;
    z-index: 2;
    vertical-align: middle;
  }

  .custom-table td,
  .custom-table th {
    vertical-align: middle !important;
    padding: 0.5rem 0.75rem !important;
    font-size: 0.97rem;
  }

  .custom-table tr {
    border-bottom: 1px solid #e0e0e0;
  }

  .custom-table tbody tr:hover {
    background: #f5f7fa;
    transition: background 0.2s;
  }

  .custom-table thead th {
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
  }

  @media (max-width: 768px) {
    .custom-table-container {
      padding: 10px 2px;
    }

    .custom-table td,
    .custom-table th {
      font-size: 0.92rem;
      padding: 0.35rem 0.5rem !important;
    }
  }
</style>

<div class="container content-wrapper">
  <div>
    <h1 class="h4 mb-4 mt-5">Reporte diario</h1>
  </div>
  <div class="row">
    <div class="table-responsive mt-5 custom-table-container">
      <table class="table table-striped table-hover custom-table">
        <thead>
          <tr>
            <th>No</th>
            <th>Nombre</th>
            <th>Hora de llegada</th>
            <th>Hora Salida</th>
            <th>Observaciones Generales</th>
            <th>Observaciones de marcado</th>
          </tr>
        </thead>
        <tbody>
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
                // Día de la semana basado en la fecha de la marca (0=Dom..6=Sáb)
                $dia_semana = (int) date('w', strtotime($row['fecha']));

                echo '<tr>
								<td>' . $no . '</td>
								<td>' . htmlspecialchars($nom['nombres'], ENT_QUOTES, 'UTF-8') . '</td>
								<td>' . $row['hora_e'] . '</td>
								<td>' . $row['hora_s'] . '</td>
								<td>' . htmlspecialchars((string)$row['observaciones'], ENT_QUOTES, 'UTF-8') . '</td>
                <td>';
                //obtener observaciones del dia
                if ($dia_semana > 0 && $dia_semana < 6) { // Lunes a Viernes
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
                    echo "<div class='text-primary'><strong>Obs. usuario:</strong> " . htmlspecialchars($row['observacion'], ENT_QUOTES, 'UTF-8') . "</div>";
                  }
                  // Salida: usar hora_s_sem para L-V
                  if ($row['hora_s']) {
                    $hss1 = new DateTime($row['fecha'] . " " . $row0['hora_s_sem']);
                    $hss2 = new DateTime($row['fecha'] . " " . $row['hora_s']);
                    $obs_ss = obtener_observa($hss1, $hss2, "S");
                    echo $obs_ss;
                  } else {
                    echo "<span class='text-danger'>No marco Salida</span>";
                  }
                } else { //esto ya es para sabado y domingo
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
                $no++;
              }
            }
          }

          ?>
      </table>
    </div>
  </div>
</div>
<?php include_once("foot.php"); ?>