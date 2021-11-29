<?php

require_once('../modelos/Ninos.php');
$ninos = new Ninos();
$rows = $ninos->selectAll();
if ($rows->num_rows == 0) {
    $mensajeKO = 'No hay ningún niño guardado.';
}
if (!empty($_GET)) {
    $idMensaje = (int) filter_input(INPUT_GET, 'msg');
    if ($idMensaje == 77) {
        $mensajeOK = 'El niño ha sido borrado correctamente.';
    } else if ($idMensaje == 66) {
        $mensajeKO = 'Lo sentimos, pero ha intentado acceder a un niño que no existe.';
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="../assets/css/site.css" rel="stylesheet">
    <title>DWS ||Práctica T2 || BD en PHP</title>
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
                <a href="crear.php" class="btn btn-success float-right">Añadir</a>
                <a href="../index.php" class="btn btn-warning float-right">Inicio</a>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-12 col-md-8 offset-md-2 mt-4">
                <h1>Niños</h1>
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
            <div class="col-12 col-md-8 offset-md-2 mt-4 pb-5">
                <table class="table table-striped text-center bg-opacity border">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Bueno</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php while ($row = $rows->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['id_nino']; ?></td>
                                <td><?php echo $row['nombre']; ?></td>
                                <td><?php echo $row['apellido']; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['fechanacimiento'])); ?></td>
                                <td><?php echo $row['bueno'] == 0 ? "No" : "Si"; ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="editar.php?id=<?php echo $row['id_nino']; ?>" class="btn btn-outline-success">Editar</a>
                                        <a href="borrar.php?id=<?php echo $row['id_nino']; ?>" class="btn btn-outline-danger">Borrar</a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</body>

</html>