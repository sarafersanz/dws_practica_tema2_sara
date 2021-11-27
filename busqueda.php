<?php
require_once('Ninos.php');
$ninos = new Ninos();
$rows = $ninos->selectAll();
if ($rows->num_rows == 0) {
    $mensajeKO = 'No existen datos.';
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <!-- <link href="assets/css/site.css" rel="stylesheet"> -->
    <title>DWS ||Práctica T2 || BD en PHP</title>
</head>

<body>
    <div class="container">
        <div class="row text-center py-3">
            <div class="col-12 col-md-8 offset-md-2 mt-4">
                <p>Practica || Tema 2 || BD en PHP</p>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-12 col-md-8 offset-md-2 mt-4">
                <a href="" class="btn btn-success float-right">volver</a>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-12 col-md-8 offset-md-2 mt-4">
                <h1>BÚSQUEDA</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 offset-md-2 mt-4">
                <form method="POST" action="busqueda.php">
                    <div class="form-row">
                        <div class="form-group col-6">
                            <select id="inputState" class="form-control" name="nino">
                                <option selected>Elige un niño...</option>
                                <?php
                                while ($fila = $rows->fetch_assoc()) {
                                    $id = $fila['id_nino'];
                                    $nombre = $fila['nombre'];
                                    echo "<option value=$id>$nombre</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <button type="submit" class="btn btn-info">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2 mt-4">
                                
            </div>
        </div>
    </div>
</body>

</html>