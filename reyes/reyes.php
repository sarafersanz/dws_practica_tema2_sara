<?php

require_once('../modelos/Ninos.php');
require_once('../modelos/Regalos.php');
require_once('../modelos/Reyes.php');
$reyesmagos = new Reyes();
$rows = $reyesmagos->selectAll();

?>
<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>DWS ||Práctica T2 || BD en PHP</title>
</head>

<body>
    <div class="container fondo">
        <div class="row justify-content-center">
            <div class="col-10 mt-4">
                <a href="../index.php" class="btn btn-primary float-right">Volver</a>
                <h1>Melchor</h1>
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
            <?php if ((int)$rows->num_rows) { ?>
                <div class="col-10 mt-4">
                    <table class="table table-striped">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>Niño</th>
                                <th>Regalo</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php while($row=$rows->fetch_assoc()){ ?>
                                <tr>
                                    <td><?php echo $row['id_nino']; ?></td>
                                    <td><?php echo $row['nombre']; ?></td>
                                    <td><?php echo $row['nombre']; ?></td>
                                    <td class="text-right"><?php echo number_format($row['precio'], 2, ',', '.'); ?>€</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>