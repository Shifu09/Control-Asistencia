<?php
//aqui es el index principal, donde se hace la asistencia 
//y el login si es administrador
include("conexion.php");
include("login.php");
date_default_timezone_set('America/Caracas');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="img/aguamerca_logo.png">
    <title>Asistencia</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body style="background-color: #e4efe7;">
    <nav>
        <img src="img/head-back.png" alt="Logo ministerio">
    </nav>
    <div class="main-container d-flex" style="min-height: 83vh;">
        <!-- LADO IZQUIERDO: Marcador de hora y formulario de marcado -->
        <div class="left-side d-flex flex-column justify-content-center align-items-center" style="flex:1; background:#eaf6fb; min-width: 350px;">
            <div class="text-center">
                <h1 class="h4 mb-4 mt-5">Marcado Diario</h1>
                <hr class="bg-dark" style="height:2px; width:100%; border-width:0; color:#343a40; background-color:#343a40">
                <div class="date1" style="font-size:25px;">
                    <span id="weekDay" class="weekDay h4"></span>,
                    <span id="day" class="day h4"></span> <span class="h4">de</span>
                    <span id="month" class="month h4"></span> <span class="h4">del</span>
                    <span id="year" class="year h4"></span>
                </div>
                <div class="clock" style="font-size:25px;">
                    <span id="hours" class="hours h4"></span> :
                    <span id="minutes" class="minutes h4"></span> :
                    <span id="seconds" class="seconds h4"></span>
                </div>
            </div>
            <?php
            $fecha_actual = date('d-m-Y');
            $hora_eval = date("h:i:s");
            if ($hora_eval < date("h:i:s A")) {
                $checked = 'checked';
                $checked2 = '';
            } else {
                $checked2 = 'checked';
                $checked = '';
            }
            ?>
            <form class="mt-4 w-100 px-4" action="" autocomplete="off">
                <div class="row w-100">
                    <div class="col-12 my-3">
                        <p style="font-size:20px; font-weight:bold; color:#325288;">INGRESE SU CEDULA Y PULSE LA TECLA ENTER EN EL PRIMER CAMPO</p>
                    </div>
                    <div class="col-12 d-flex mb-2">
                        <div class="form-check me-4">
                            <input class="form-check-input" type="checkbox" name="entrada" id="entrada" value="E" <?php echo $checked ?>>
                            <label class="form-check-label" for="entrada">
                                Entrada
                            </label>
                        </div>
                        <div class="form-check me-4">
                            <input class="form-check-input" type="checkbox" id="salida" name="salida" value="S" <?php echo $checked2 ?>>
                            <label class="form-check-label" for="salida">
                                Salida
                            </label>
                        </div>

                    </div>
                    <div class="col-12">
                        <div class="input-group mt-2">
                            <span class="input-group-text text-light" id="basic-addon1" style="background-color:#325288;">Cedula del Empleado:</span>
                            <input type="text" class="form-control" name="codigo" id="codigo" aria-label="Username" aria-describedby="basic-addon1" autofocus>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="input-group mt-2">
                            <span class="input-group-text text-light" id="basic-addon1" style="background-color:#325288;">Observaciones:</span>
                            <input type="text" class="form-control" name="observaciones" id="observaciones" aria-label="Observaciones" aria-describedby="basic-addon1">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="alert alert-primary mt-3 mensajes" role="alert"></div>
                    </div>
                </div>
            </form>
        </div>
        <!-- LADO DERECHO: Login -->
        <div class="right-side d-flex flex-column justify-content-center align-items-center" style="flex:1; background:#fff; min-width:400px;">
            <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST" class="d-flex flex-column p-4 border rounded shadow bg-light" id="formulario" style="min-width:450px; max-width:450px;">
                <div class="text-center">
                    <img src="img/aguamerca_logo.png" id="logo_login">
                    <h3 class="text-center">Inicio de Sesión</h3>
                    <label class="mb-3" style="color: red;">*Para administradores*</label>
                </div>

                <p class="text-center">Por favor, ingresa tus credenciales para iniciar sesión.</p>
                <div class="form-group has-feedback mb-3">
                    <input type="text" name="name" id="name" placeholder="Cedula del usuario" class="form-control" required>
                </div>
                <div class="form-group has-feedback mb-3">
                    <input type="password" name="password" id="password" placeholder="Contraseña" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-2" name="acceder" id="btn">Acceder</button>
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/marcar.js"></script>
    <script src="js/clock.js"></script>
    <script>
        $('.date').datepicker({
            //agarramos la fecha
            format: 'dd-mm-yyyy',
        })
    </script>
    <script src="js/validacion.js"></script>
</body>

</html>