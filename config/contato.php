<?php
if(isset($_POST['mensagem'])){
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $mensagem = $_POST['mensagem'] ?? '';
    $imagem = null;

    // Inserção no banco
        $sql = "INSERT INTO contato (nome, email, mensagem) VALUES (:nome, :email, :mensagem)";
        $stmt = $conect->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mensagem', $mensagem);
        $stmt->execute();


    if($stmt->rowCount() > 0){
        echo '<div class="alert alert-success">Mensagem enviada com sucesso!</div>';
    } else {
        echo '<div class="alert alert-danger">Erro ao enviar a mensagem.</div>';
    }
}
?>
