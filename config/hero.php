<?php

$query = "SELECT * FROM hero";
$stmt = $conect->prepare($query);
$stmt->execute();               
$hero = $stmt->fetch(PDO::FETCH_ASSOC); 
?>