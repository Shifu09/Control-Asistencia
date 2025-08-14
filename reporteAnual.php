<?php
//reporte por intervalo de fechas
include("head.php");
include("leftmenu.php");
include("conexion.php");
include("funciones.php");

$fechai = date('d-m-Y');
$fechaf = date('d-m-Y');
$sql = mysqli_query($con, "SELECT * FROM empleados");

if (mysqli_num_rows($sql) > 0) {
}
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css" rel="stylesheet">
<div class="tab-content flex-grow-1 ms-3" id="v-tabs-tabContent">
	<div class='row'>
		<h3>Reporte por Rango de Fechas</h3>

		<!--input type='hidden' value='<?php echo $codigo ?>' id='codigo' name='codigo' /-->
		<!--aqui le pedimos las fechas-->
		<div class="col-sm-4">
			<div class="form-control">
				<label class="col-sm-4 control-label">Fecha de inicio</label>
				<div class="col-sm-4">
					<input type="text" name="fechai" id="fechai" class="input-group date form-control" date="" data-date-format="dd-mm-yyyy" placeholder="00-00-0000" value="<?php echo $fechai ?>" required>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-control">
				<label class="col-sm-4 control-label">Fecha Fin</label>
				<div class="col-sm-4">
					<input type="text" name="fechaf" id="fechaf" class="input-group date form-control" date="" data-date-format="dd-mm-yyyy" placeholder="00-00-0000" value="<?php echo $fechaf ?>" required>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label class="col-sm-3 control-label">&nbsp;</label>
				<div class="col-sm-6">
					<!--cuando le de click en el boton de enviar ocupamos el ver_llegadas.js para buscar que hay en ese rango de fecha-->
					<button type="button" class="btn btn-outline-info s" name="buscar" id="buscar">Enviar</button>
				</div>
			</div>
		</div>
	</div>
	<div class='mostrar_datos'>
		<h5>Lista de LLegadas por Fechas</h5>
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
		<div class="table-responsive custom-table-container">
			<table class="table table-striped table-hover custom-table">
				<!--ya aqui mostramos todos los datos dentro del rango de fecha-->
				<thead>
					<tr>
						<th>No</th>
						<th>Código</th>
						<th>Nombre Empleado</th>
						<!--th>Fecha</th-->
						<th>Dias trabajados</th>
						<th>Llegadas tardes</th>
						<th>Salida Temprana</th>
						<th>Observacion</th>
					</tr>
				</thead>
				<tbody id='mostrar_datoss'> <!--aqui mete los datos que en reporte-->
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php include_once("foot.php"); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="js/reporteRango.js"></script>