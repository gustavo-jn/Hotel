<?php

include('../../config/conexao.php');
if(isset($_GET['idDel'])){
    $id = $_GET['idDel'];
    $delete = "DELETE FROM reservas WHERE id_reserva=:id";

    try{
        $result = $conect->prepare($delete);
        $result->bindValue(':id', $id, PDO::PARAM_INT);
        $result->execute();
        header("Location: ../home.php?acao=listaReservas");
        
    }catch(PDOException $e){
        echo "Erro de DELETE". $e->getMessage();
    }
}