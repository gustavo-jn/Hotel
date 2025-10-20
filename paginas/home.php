<?php
session_start();
include('../config/conexao.php'); 

if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo'] !== 'admin') {
    header('Location: ../index.php'); 
    exit;
}
    include_once('../includes/header.php');
    if(isset($_GET['acao'])){
        $acao = $_GET['acao'];
        if($acao == 'bemvindo'){
            include_once('../paginas/conteudo/cadastro_usuario.php');
        }elseif($acao == 'editar'){
            include_once('../paginas/conteudo/update_usuario.php');
        }elseif($acao == 'cadastroQuarto'){
            include_once('../paginas/conteudo/cadastroQuartos.php');
        }elseif($acao == 'updateQuarto'){
            include_once('../paginas/conteudo/update_quarto.php');
        }elseif($acao == 'listaReservas'){
            include_once('../paginas/conteudo/reservas.php');
        }elseif($acao == 'paginaInicial'){
            include_once('../paginas/index/hero.php');
        }elseif($acao == 'sobre'){
            include_once('../paginas/index/sobre.php');
        }elseif($acao == 'equipe'){
            include_once('../paginas/index/equipe.php');
        }elseif($acao == 'faq'){
            include_once('../paginas/index/faq.php');
        }elseif($acao == 'contato'){
            include_once('../paginas/index/contato.php');
        }
    }else{
      include_once('../../paginas/conteudo/cadastro_contato.php');  
    }
    include_once('../includes/footer.php');