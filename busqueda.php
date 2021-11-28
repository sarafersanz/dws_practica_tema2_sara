<?php
require_once('Ninos.php');
require_once('Recibidos.php');
require_once('Juguetes.php');
$ninos = new Ninos();
$rows_ninos = $ninos->selectAll();
if ($rows_ninos->num_rows == 0) {
    $mensajeKO = 'No existen datos.';
}

if (isset($_POST["buscar"])) {
    $id_nino = $_POST["nino"];
    $recibidos = new Recibidos();
    $juguetesDeNino = $recibidos->selectFromNino($id_nino);

    $juguete = new Juguetes();
    $rows_juguetes = $juguete->selectAll();
    if ($rows_juguetes->num_rows == 0) {
        $mensajeKO = 'No existen datos.';
    }
}

if(isset($_POST["anadir"])){
    $id_nino = $_POST["id_nino"];
    $id_juguete = $_POST["juguete"];
    $recibidos = new Recibidos();
    try {
        $id = $recibidos->insert($id_nino, $id_juguete);
        /* if ((int) $id) {
            header('Location:busqueda.php?msg=55&id=' . $id);
        } */
    } catch (Exception $ex) {
        $mensajeKO = $ex->getMessage();
    }
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
                            <select id="inputChildren" class="form-control" name="nino">
                                <option selected>Elige un niño...</option>
                                <?php
                                while ($fila = $rows_ninos->fetch_assoc()) {
                                    $id = $fila['id_nino'];
                                    $nombre = $fila['nombre'];
                                    echo "<option value=$id>$nombre</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <button type="submit" class="btn btn-info" name="buscar">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php
        if (isset($_POST["buscar"])) { ?>
            <div class='row'>
                <div class='col-12 col-md-8 offset-md-2 mt-4'>
                    <h5>Los juguetes son:</h5>
                    <ul>
                        <?php
                        while ($fila = $juguetesDeNino->fetch_assoc()) {
                            $nombre_juguete = $fila['nombre'];
                            echo "<li>$nombre_juguete</li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 offset-md-2 mt-4">
                    <form method="POST" action="busqueda.php">
                        <input type="hidden" name="id_nino" value="<?php $id_nino ?>">
                        <div class="form-row">
                            <div class="form-group col-6">
                                <select id="inputToys" class="form-control" name="juguete">
                                    <option selected>Elige un juguete...</option>
                                    <?php
                                    while ($fila = $rows_juguetes->fetch_assoc()) {
                                        $id = $fila['id_juguete'];
                                        $nombre = $fila['nombre'];
                                        echo "<option value=$id>$nombre</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <button type="submit" class="btn btn-info" name="anadir">Añadir</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php
        } ?>

    </div>
</body>

</html>