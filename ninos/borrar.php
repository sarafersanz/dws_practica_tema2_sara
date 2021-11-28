<?php
 
if(!empty($_GET)){
    $id_nino = (int) filter_input(INPUT_GET, 'id');
    require_once('../modelos/Ninos.php');
    $ninos = new Ninos();
    $ninos->delete($id_nino);
    header('Location:ninos.php?msg=77');
}else{
    header('Location:ninos.php');
}
?>