<?php

if (!empty($_POST)) {
    $datosRegalo = [];
    $datosRegalo['nombre'] = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $datosRegalo['precio'] = (float)filter_input(INPUT_POST, 'precio', FILTER_SANITIZE_STRING);
    $datosRegalo['id_reymago'] = (int)filter_input(INPUT_POST, 'reymago', FILTER_SANITIZE_STRING);

    require_once('../modelos/Regalos.php');
    $regalos = new Regalos();
    try {
        $id_regalo = $regalos->insert($datosRegalo);
        if ((int) $id_regalo) {
            header('Location:editar.php?msg=55&id=' . $id_regalo);
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
    <title>DWS ||Práctica T2 || BD en PHP</title>
</head>

<body>
    <div class="container">
        <div class="row text-center py-3">
            <div class="col-12 mt-4">
                <p>Practica || Tema 2 || BD en PHP</p>
            </div>
        </div>
        <div class="row align-items-center justify-content-center">
            <div class="col-10">
                <div class="row justify-content-center text-center">
                    <div class="col-12 col-md-8 mt-4">
                        <a href="regalos.php" class="btn btn-warning float-left">Volver al listado</a>
                    </div>
                </div>
                <div class="row text-center justify-content-center">
                    <div class="col-6 mt-4">
                        <h1>CREAR REGALO</h1>
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
                <div class="row pb-3">
                    <div class="col-12 mt-4">
                        <div class="row text-center align-items-center justify-content-center">
                            <div class="col-4">
                                <form action="crear.php" method="post">
                                    <div class="form-group">
                                        <label for="nombre">Nombre:</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="precio">Precio:</label>
                                        <input type="text" class="form-control" id="precio" name="precio" placeholder="0.00" required />
                                    </div>
                                    <div class="form-group py-2">
                                        <label>Rey Mago:</label>
                                        <select name="reymago" class="form-control">
                                            <option value="1" selected>Melchor</option>
                                            <option value="2">Gaspar</option>
                                            <option value="3">Baltasar</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success">Crear</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>