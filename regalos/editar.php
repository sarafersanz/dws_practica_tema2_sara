<?php

require_once('../modelos/Regalos.php');
require_once('../modelos/Reyes.php');
$regalos = new Regalos();
$reyes = new Reyes();

$id_regalo = 0;
if (!empty($_POST)) {
    $datosRegalo = [];
    $datosRegalo['id_regalo'] = (int)filter_input(INPUT_POST, 'id_regalo', FILTER_SANITIZE_STRING);
    $datosRegalo['nombre'] = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $datosRegalo['precio'] = (float)filter_input(INPUT_POST, 'precio', FILTER_SANITIZE_STRING);
    $datosRegalo['id_reymago'] = (int)filter_input(INPUT_POST, 'reymago', FILTER_SANITIZE_STRING);

    try {
        $id_regalo = $regalos->update($datosRegalo);
        if ((int) $id_regalo) {
            $mensajeOK = 'El regalo se ha actualizado correctamente.';
        }
    } catch (Exception $ex) {
        $mensajeKO = $ex->getMessage();
        $id_regalo = $datosRegalo['id_regalo'];
    }
} else if (!empty($_GET)) {
    $idMensaje = (int) filter_input(INPUT_GET, 'msg');
    if ($idMensaje == 55) {
        $mensajeOK = 'El regalo ha sido creado correctamente.';
    }
    $id_regalo = (int) filter_input(INPUT_GET, 'id');
}
$regalo = $regalos->select($id_regalo);
$listaReyes = $reyes->selectAll();

if ($regalo == null) {
    header('Location:regalos.php?msg=66');
}


?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="../assets/css/site.css" rel="stylesheet">
    <title>Editar regalo</title>
</head>

<body>
    <div class="container">
        <div class="row text-center py-3">
            <div class="col-12 col-md-8 offset-md-2 mt-4">
                <p class="bg-opacity">Practica || Tema 2 || BD en PHP</p>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-12 col-md-8 offset-md-2 mt-4">
                <a href="regalos.php" class="btn btn-warning float-left">Volver al listado</a>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-12 col-md-4 offset-md-4 mt-4 pb-3">
                <div class="clearfix"></div>
                <h1>Editar regalo</h1>
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
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required value="<?php echo $regalo['nombre']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio:</label>
                        <input type="text" class="form-control" id="precio" name="precio" placeholder="0.00" required value="<?php echo $regalo['precio']; ?>" />
                    </div>
                    <div class="form-group py-2">
                        <label>Elije un Rey Mago:</label>
                        <select name="reymago" class="form-control">
                            <?php
                            while ($fila = $listaReyes->fetch_assoc()) {
                                $id = $fila['id_reymago'];
                                $nombre = $fila['nombre'];
                                $selected = $regalo['id_reymago'] == $id ? "selected" : "";
                                echo "<option value=" . $id . " " . $selected . ">" . $nombre . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" class="form-control" id="id_regalo" name="id_regalo" value="<?php echo $regalo['id_regalo']; ?>" />
                    <button type="submit" class="btn btn-success">Crear</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>