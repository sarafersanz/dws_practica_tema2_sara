<?php
require_once('./modelos/Ninos.php');
require_once('./modelos/Recibidos.php');
require_once('./modelos/Regalos.php');
$ninos = new Ninos();
$rows_ninos = $ninos->selectAll();

if ($rows_ninos->num_rows == 0) {
    $mensajeKO = 'No existen datos.';
}

if (isset($_POST["buscar"])) {
    if (isset($_POST["nino"])) {
        $id_nino = $_POST["nino"];
        $nino = $ninos->select($id_nino);
        $recibidos = new Recibidos();
        $regalosDeNino = $recibidos->selectFromNino($id_nino);
    } else {
        $mensajeKO = "Debe seleccionar un niño.";
    }

    $regalo = new Regalos();
    $rows_regalos = $regalo->selectAll();
    if ($rows_regalos->num_rows == 0) {
        $mensajeKO = 'No existen regalos.';
    }
}

if (isset($_POST["anadir"])) {
    $id_nino = $_POST["nino"];
    $id_regalo = $_POST["regalo"];

    $recibidos = new Recibidos();
    $regalosDeNino = $recibidos->selectFromNino($id_nino);
    try {
        $id = $recibidos->insert($id_nino, $id_regalo);
        if ((int) $id) {
            $mensajeOK = 'El regalo se ha añadido correctamente.';
        }
    } catch (Exception $ex) {
        $mensajeKO = $ex->getMessage();
    }
    $nino = $ninos->select($id_nino);
    $regalosDeNino = $recibidos->selectFromNino($id_nino);

    $regalo = new Regalos();
    $rows_regalos = $regalo->selectAll();
    if ($rows_regalos->num_rows == 0) {
        $mensajeKO = 'No existen regalos.';
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
    <link href="assets/css/site.css" rel="stylesheet">
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
                <a href="./index.php" class="btn btn-warning float-left">Inicio</a>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-12 col-md-8 offset-md-2 mt-4">
                <h1>BÚSQUEDA</h1>
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
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 offset-md-2 mt-4 py-2">
                <form method="POST" action="busqueda.php">
                    <div class="form-row">
                        <div class="form-group col-6">
                            <select id="inputChildren" class="form-control" name="nino">
                                <option selected disabled value="null">Elige un niño...</option>
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
                            <button type="submit" class="btn btn-success" name="buscar">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
        if (isset($_POST["nino"])) { ?>
            <div class='row'>
                <div class='col-12 col-md-8 offset-md-2 mt-2'>
                    <h5>Lista de regalos de <?php echo $nino['nombre'] ?>:</h5>
                    <ul>
                        <?php
                        if ($regalosDeNino->num_rows != 0){
                            while ($fila = $regalosDeNino->fetch_assoc()) {
                                $nombre_regalo = $fila['nombre'];
                                 echo "<li>$nombre_regalo</li>";   
                            }
                        } else {
                            echo "<li>" . $nino['nombre'] . " no tiene regalos</li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
                <div class="row justify-content-center pb-5">
                    <div class="col-12 col-md-8 offset-md-2 mt-2">
                        <form method="POST" action="busqueda.php">
                            <input type="hidden" name="nino" value="<?php echo $_POST["nino"] ?>">
                            <p><?php $_POST["nino"] ?></p>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <select id="inputToys" class="form-control" name="regalo">
                                        <option selected>Elige un regalo...</option>
                                        <?php
                                        while ($fila = $rows_regalos->fetch_assoc()) {
                                            $id = $fila['id_regalo'];
                                            $nombre = $fila['nombre'];
                                            echo "<option value=$id>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <button type="submit" class="btn btn-success" name="anadir">Añadir</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        <?php } ?>

    </div>
</body>

</html>