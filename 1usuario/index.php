<?php
include_once('../config/conexao.php');
include_once('includes/header.php');
if(isset($_GET['acao'])){
    $acao = $_GET['acao'];
    
    if($acao == 'inicio'){
        include_once('paginas/home.php');
    }elseif($acao == 'reservar'){
        include_once('paginas/pagReserva.php');
    }elseif($acao == 'minhasReservas'){
        include_once('paginas/reservas.php');
    }
}
include_once('includes/footer.php');
?>


  