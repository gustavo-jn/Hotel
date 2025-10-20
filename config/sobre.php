<?php

$query = "SELECT * FROM sobre";
$stmt = $conect->prepare($query);
$stmt->execute();               
$sobre = $stmt->fetch(PDO::FETCH_ASSOC); 
?>