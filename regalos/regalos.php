<?php
require_once('Juguetes.php');
$modelo = new Juguetes();
$rows = $modelo->selectAll();
if ($rows->num_rows == 0) {
    $mensajeKO = 'No existen datos de niños.';
}
if (!empty($_GET)) {
    $idMensaje = (int) filter_input(INPUT_GET, 'msg');
    if ($idMensaje == 77) {
        $mensajeOK = 'El niño ha sido borrado correctamente.';
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
                <a href="" class="btn btn-success float-right">Añadir</a>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-12 col-md-8 offset-md-2 mt-4">
                <h1> JUGUETES</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2 mt-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Descripción</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $rows->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['id_juguete']; ?></td>
                                <td><?php echo $row['nombre']; ?></td>
                                <td class="text-right"><?php echo number_format($row['precio'], 2, ',', '.'); ?>€</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="" class="btn btn-info float-right">Editar</a>
                                        <a href="" class="btn btn-danger float-right">Borrar</a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>

</html>