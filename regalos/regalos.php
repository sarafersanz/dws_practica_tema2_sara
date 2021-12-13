<?php
require_once('../modelos/Regalos.php');
$regalos = new Regalos();
$rows = $regalos->selectAll();
if ($rows->num_rows == 0) {
    $mensajeKO = 'No existen datos de regalos.';
}
if (!empty($_GET)) {
    $idMensaje = (int) filter_input(INPUT_GET, 'msg');
    if ($idMensaje == 77) {
        $mensajeOK = 'El regalo ha sido borrado correctamente.';
    } else if ($idMensaje == 66) {
        $mensajeKO = 'Lo sentimos pero los datos introducidos no existen.';
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
    <link href="../assets/css/site.css" rel="stylesheet">
    <title>DWS ||Práctica T2 || BD en PHP</title>
</head>

<body>
    <div class="container">
        <div class="row text-center py-3">
            <div class="col-12  mt-4">
                <p>Practica || Tema 2 || BD en PHP</p>
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-12 col-md-8 mt-4">
                <a href="crear.php" class="btn btn-success float-right">Añadir</a>
                <a href="../index.php" class="btn btn-warning float-left">Inicio</a>
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-12 col-md-8 mt-4">
                <h1> REGALOS</h1>
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
        <?php if ((int)$rows->num_rows) { ?>
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 mt-4 pb-5">
                    <div class="table-responsive">
                        <table class="table table-striped text-center bg-opacity border">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Id_reymago</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $rows->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $row['id_regalo']; ?></td>
                                        <td><?php echo $row['nombre']; ?></td>
                                        <td class="text-right"><?php echo number_format($row['precio'], 2, ',', '.'); ?>€</td>
                                        <td><?php echo $row['reyMago']; ?></td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="editar.php?id=<?php echo $row['id_regalo']; ?>" class="btn btn-outline-success">Editar</a>
                                                <a href="borrar.php?id=<?php echo $row['id_regalo']; ?>" class="btn btn-outline-danger">Borrar</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</body>

</html>