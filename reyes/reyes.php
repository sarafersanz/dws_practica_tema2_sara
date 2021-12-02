<?php

require_once('../modelos/Reyes.php');
$reyesmagos = new Reyes();

/* Lista de cada uno de los reyes con los regalos que les han pedido los niños (solo los buenos) */
$regalosMelchor = $reyesmagos->selectRegaloMelchor();
$regalosGaspar = $reyesmagos->selectRegaloGaspar();
$regalosBaltasar = $reyesmagos->selectRegaloBaltasar();

/* ID asociado al rey que reparte el carbón */
$reyMagoReparteCarbon = $reyesmagos->comprobarReyCarbon();

/* Niños que han sido malos y recibien solo carbón */
$ninosMalos = $reyesmagos->comprobarMalo();

/* Precios totales de la lista de cada rey */
$totalMelchor = 0;
$totalGaspar = 0;
$totalBaltasar = 0;

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
    <div class="container fondo">
        <div class="row text-center py-3">
            <div class="col-12 col-md-8 offset-md-2 mt-4">
                <p class="bg-opacity">Practica || Tema 2 || BD en PHP</p>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-12 col-md-8 offset-md-2 mt-4">
                <a href="../index.php" class="btn btn-warning float-right">Inicio</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-10 mt-4 text-center">
                <h1>Melchor</h1>
            </div>
            <?php if ((int)$regalosMelchor->num_rows) { ?>
                <div class="col-10 mt-4">
                    <table class="table table-striped text-center bg-opacity border">
                        <thead>
                            <tr>
                                <th>Niño</th>
                                <th>Regalo</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php while ($regaloMelchor = $regalosMelchor->fetch_assoc()) {
                                 $totalMelchor = $regaloMelchor['precio'] + $totalMelchor;
                                 
                                 ?>
                                <tr>
                                    <td><?php echo $regaloMelchor['nombre_nino_melchor']; ?></td>
                                    <td><?php echo $regaloMelchor['nombre_regalo_melchor']; ?></td>
                                    
                                </tr>
                                <?php }
                            if ($reyMagoReparteCarbon['id_reymago'] == '1') {
                                while ($ninoMalo = $ninosMalos->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $ninoMalo['nombre_nino']; ?></td>
                                        <td><?php echo $ninoMalo['nombre_carbon']; ?></td>
                                    </tr>
                            <?php }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <td><b>Precio total:</b></td>
                            <td><b><?php echo $totalMelchor; ?> €</b></td>
                        </tfoot>
                    </table>
                </div>
            <?php } 
            else{
                echo "<div class='col-10 mt-2 text-center '>
                        <p>El saco de Melchor está vacío</p>
                    </div>";
            }?>
        </div>
        <div class="row justify-content-center">
            <div class="col-10 mt-4 text-center">
                <h1>Gaspar</h1>
            </div>
            <?php if ((int)$regalosGaspar->num_rows) { ?>
                <div class="col-10 mt-4">
                    <table class="table table-striped text-center bg-opacity border">
                        <thead>
                            <tr>
                                <th>Niño</th>
                                <th>Regalo</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php while ($regaloGaspar = $regalosGaspar->fetch_assoc()) {
                                $totalGaspar = $regaloGaspar['precio'] + $totalGaspar;
                                ?>
                                <tr>
                                    <td><?php echo $regaloGaspar['nombre_nino_gaspar']; ?></td>
                                    <td><?php echo $regaloGaspar['nombre_regalo_gaspar']; ?></td>
                                </tr>
                                <?php }
                            if ($reyMagoReparteCarbon['id_reymago'] == '2') {
                                while ($ninoMalo = $ninosMalos->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $ninoMalo['nombre_nino']; ?></td>
                                        <td><?php echo $ninoMalo['nombre_carbon']; ?></td>
                                    </tr>
                            <?php }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <td><b>Precio total:</b></td>
                            <td><b><?php echo $totalGaspar; ?> €</b></td>
                        </tfoot>
                    </table>
                </div>
            <?php }else{
                echo "<div class='col-10 mt-2 text-center '>
                        <p>El saco de Gaspar está vacío</p>
                    </div>";
            }?>
        </div>
        <div class="row justify-content-center">
            <div class="col-10 mt-4 text-center">
                <h1>Baltasar</h1>
            </div>
            <?php if ((int)$regalosBaltasar->num_rows) { ?>
                <div class="col-10 mt-4">
                    <table class="table table-striped text-center bg-opacity border">
                        <thead>
                            <tr>
                                <th>Niño</th>
                                <th>Regalo</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php while ($regaloBaltasar = $regalosBaltasar->fetch_assoc()) {
                                $totalBaltasar = $regaloBaltasar['precio'] + $totalBaltasar;
                            ?>
                                <tr>
                                    <td><?php echo $regaloBaltasar['nombre_nino_baltasar']; ?></td>
                                    <td><?php echo $regaloBaltasar['nombre_regalo_baltasar']; ?></td>
                                </tr>
                                <?php }
                            if ($reyMagoReparteCarbon['id_reymago'] == '3') {
                                while ($ninoMalo = $ninosMalos->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $ninoMalo['nombre_nino']; ?></td>
                                        <td><?php echo $ninoMalo['nombre_carbon']; ?></td>
                                    </tr>
                            <?php }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <td><b>Precio total:</b></td>
                            <td><b><?php echo $totalBaltasar; ?> €</b></td>
                        </tfoot>
                    </table>
                </div>
            <?php } 
             else{
                echo "<div class='col-10 mt-2 text-center '>
                        <p>El saco de Baltasar está vacío</p>
                    </div>";
            }?>
        </div>

    </div>
</body>

</html>