<?php

require_once('../modelos/Ninos.php');
$ninos = new Ninos();

$id_nino = 0;
if (!empty($_POST)) {
    $datosNino = [];
    $datosNino['id_nino'] = (int)filter_input(INPUT_POST, 'id_nino', FILTER_SANITIZE_STRING);
    $datosNino['nombre'] = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $datosNino['apellido'] = filter_input(INPUT_POST, 'apellido', FILTER_SANITIZE_STRING);
    $datosNino['fechaNacimiento'] = filter_input(INPUT_POST, 'fechaNacimiento', FILTER_SANITIZE_STRING);
    $datosNino['bueno'] = filter_input(INPUT_POST, 'bueno', FILTER_SANITIZE_STRING);

    try {
        $id_nino = $ninos->update($datosNino);
        if ((int) $id_nino) {
            $mensajeOK = 'El niño se ha actualizado correctamente.';
        }
    } catch (Exception $ex) {
        $mensajeKO = $ex->getMessage();
        $id_nino = $datosNino['id_nino'];
    }
} else if (!empty($_GET)) {
    $idMensaje = (int) filter_input(INPUT_GET, 'msg');
    if ($idMensaje == 55) {
        $mensajeOK = 'El niño ha sido creado correctamente.';
    }
    $id_nino = (int) filter_input(INPUT_GET, 'id');
}
$nino = $ninos->select($id_nino);
if ($nino == null) {
    header('Location:ninos.php?msg=66');
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="../assets/css/site.css" rel="stylesheet">
    <title>Editar niño</title>
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
                <h1>Editar niño</h1>
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
                <form action="editar.php" method="post">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required value="<?php echo $nino['nombre']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required value="<?php echo $nino['apellido']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="fechaNacimiento">Fecha de nacimiento</label>
                        <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" required value="<?php echo $nino['fechanacimiento'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Ha sido bueno:</label>
                        <select name="bueno" class="form-control">
                            <option value="<?php echo $nino['bueno']; ?>" selected><?php echo $nino['bueno'] == 0 ? "No" : "Si"; ?></option>
                            <option value="<?php echo $nino['bueno'] == 0 ? "1" : "0"; ?>"><?php echo $nino['bueno'] == 0 ? "Si" : "No"; ?></option>
                        </select>
                    </div>
                    <input type="hidden" class="form-control" id="id_nino" name="id_nino" value="<?php echo $nino['id_nino']; ?>" />
                    <button type="submit" class="btn btn-success">Editar</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>