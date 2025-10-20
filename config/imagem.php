<?php
$query = "SELECT imagem FROM imagem ORDER BY id DESC LIMIT 1";
$stmt = $conect->prepare($query);
$stmt->execute();               
$imagem = $stmt->fetch(PDO::FETCH_ASSOC);
?>
