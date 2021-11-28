<?php
 
if(!empty($_GET)){
    $id_regalo = (int) filter_input(INPUT_GET, 'id');
    require_once('../modelos/regalos.php');
    $regalos = new regalos();
    $regalos->delete($id_regalo);
    header('Location:regalos.php?msg=77');
}else{
    header('Location:regalos.php');
}
?>