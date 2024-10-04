<?php
// db_connect.php

$servername = "localhost";
$username = "root"; // Usuário padrão do XAMPP
$password = ""; // Senha padrão do XAMPP é vazia
$dbname = "tatuagem";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Falha na conexão com o banco de dados: ' . $conn->connect_error]));
}

// Definir o conjunto de caracteres para UTF-8
$conn->set_charset("utf8");
?>
