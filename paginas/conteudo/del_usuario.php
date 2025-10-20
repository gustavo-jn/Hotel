<?php

include_once('../../config/conexao.php');
if(isset($_GET['idDel'])){
    $id = $_GET['idDel'];
    $delete ="DELETE FROM usuarios WHERE id_usuario=:id";

    try{
        $result = $conect->prepare($delete);
        $result->bindValue(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $contar = $result->rowCount();
        if($contar>0){
            header("Location: ../home.php?acao=bemvindo");
        }else{
            header("Location: ../home.php?acao=bemvindo");
        }
    }catch(PDOException $e){
        echo "Erro de delete".$e->getMessage();
    }
}