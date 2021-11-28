<?php

if (!empty($_POST)) {
    $datosRegalo = [];
    $datosRegalo['nombre'] = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $datosRegalo['precio'] = (float)filter_input(INPUT_POST, 'precio', FILTER_SANITIZE_STRING);
    $datosRegalo['id_reymago'] = filter_input(INPUT_POST, 'rey', FILTER_SANITIZE_STRING);

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
    <title>Crear Juguete:</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4 offset-md-4 mt-4">
                <a href="regalos.php" class="btn btn-primary float-right">Volver al listado</a>
                <div class="clearfix"></div>
                <h1>Crear juguete</h1>
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
                <form action="crear.php" method="post">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required />
                    </div>
                    <div class="form-group">
                    <label for="precio">Precio</label>
                        <input type="text" class="form-control" id="precio" name="precio" placeholder="0.00" required />
                    </div>
                    <div class="form-group">
                        <h5>Rey Mago:</h5>
                        <select name="rey">
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
</body>

</html>