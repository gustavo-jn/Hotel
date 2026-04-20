<?php

$dbConfig = [
    'host' => 'localhost',
    'bd' => 'hotelaria',
    'user' => 'root',
    'pass' => '',
];

$localConfigPath = __DIR__ . '/conexao.local.php';
if (file_exists($localConfigPath)) {
    $localConfig = require $localConfigPath;
    if (is_array($localConfig)) {
        $dbConfig = array_merge($dbConfig, $localConfig);
    }
}

if (!defined('HOST')) {
    define('HOST', $dbConfig['host']);
}
if (!defined('BD')) {
    define('BD', $dbConfig['bd']);
}
if (!defined('USER')) {
    define('USER', $dbConfig['user']);
}
if (!defined('PASS')) {
    define('PASS', $dbConfig['pass']);
}

try {
    $conect = new PDO('mysql:host=' . HOST . ';dbname=' . BD, USER, PASS);
    $conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "<strong>Erro de PDO = </strong>" . $e->getMessage();
}
    

