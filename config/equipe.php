<?php
// Buscar Membro 1
$stmt1 = $conect->prepare("SELECT * FROM equipe WHERE id = 1");
$stmt1->execute();
$membro1 = $stmt1->fetch(PDO::FETCH_ASSOC);

// Buscar Membro 2
$stmt2 = $conect->prepare("SELECT * FROM equipe WHERE id = 2");
$stmt2->execute();
$membro2 = $stmt2->fetch(PDO::FETCH_ASSOC);

// Buscar Membro 3
$stmt3 = $conect->prepare("SELECT * FROM equipe WHERE id = 3");
$stmt3->execute();
$membro3 = $stmt3->fetch(PDO::FETCH_ASSOC);
?>
