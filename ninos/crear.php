<?php

if (!empty($_POST)) {
    $datosNino = [];
    $datosNino['nombre'] = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $datosNino['apellido'] = filter_input(INPUT_POST, 'apellido', FILTER_SANITIZE_STRING);
    $datosNino['fechaNacimiento'] = filter_input(INPUT_POST, 'fechaNacimiento', FILTER_SANITIZE_STRING);
    $datosNino['bueno'] = filter_input(INPUT_POST, 'bueno', FILTER_SANITIZE_STRING);

    require_once('../modelos/Ninos.php');
    $ninos = new Ninos();
    try {
        $id_nino = $ninos->insert($datosNino);
        if ((int) $id_nino) {
            header('Location:editar.php?msg=55&id=' . $id_nino);
        }
    } catch (Exception $ex) {
        $mensajeKO = $ex->getMessage();
    }
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="../assets/css/site.css" rel="stylesheet">
    <title>Crear Niño:</title>
</head>

<body>
    <div class="container pb-5">
        <div class="row text-center py-3">
            <div class="col-12 col-md-8 offset-md-2 mt-4">
                <p>Practica || Tema 2 || BD en PHP</p>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-12 col-md-8 offset-md-2 mt-4">
                <a href="ninos.php" class="btn btn-warning float-left">Volver al listado</a>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-12 col-md-4 offset-md-4 mt-4 pb-3">
                <div class="clearfix"></div>
                <h1>Crear niño</h1>
                <?php if (isset($mensajeOK)) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $mensajeOK; ?>
                    </div>
                <?php } else if (isset($mensajeKO)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $mensajeKO; ?>
                    </div>
                <?php } ?>
            </div>
            <div class="col-12 col-md-4 offset-md-4">
                <form action="crear.php" method="post">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required />
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required />
                    </div>
                    <div class="form-group">
                        <label for="fechaNacimiento">Fecha de nacimiento</label>
                        <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" required />
                    </div>
                    <div class="form-group py-2">
                        <label>Ha sido bueno:</label>
                        <select name="bueno" class="form-control">
                            <option value="1" selected>Si</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Crear</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>