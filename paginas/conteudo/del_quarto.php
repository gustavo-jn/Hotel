<?php

include_once('../../config/conexao.php');

if (isset($_GET['idDel'])) {
    $id = $_GET['idDel'];

    $delete = "DELETE FROM quartos WHERE id_quarto = :id";

    try {
        $result = $conect->prepare($delete);
        $result->bindValue(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $contar = $result->rowCount();

        if ($contar > 0) {
            header("Location: ../home.php?acao=cadastroQuarto");
        } else {
            header("Location: ../home.php?acao=cadastroQuarto");
        }
    } catch (PDOException $e) {
        echo "Erro de delete: " . $e->getMessage();
    }
}
?>
