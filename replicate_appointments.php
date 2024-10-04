<?php
$servername = "localhost";
$username = "root"; // Usuário padrão do XAMPP
$password = ""; // Senha padrão do XAMPP é vazia
$dbname = "tatuagem";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consultar os agendamentos
$sql = "SELECT * FROM agendamentos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Preparar a inserção na tabela appointments
    $stmt = $conn->prepare("INSERT INTO appointments (nome, data, tatuagem, descricao) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $data, $tatuagem, $descricao);

    // Transferir dados de agendamentos para appointments
    while ($row = $result->fetch_assoc()) {
        $nome = $row['nome'];
        $data = $row['data'];
        $tatuagem = $row['tatuagem'];
        $descricao = $row['descricao'];

        // Executar a inserção
        $stmt->execute();
    }

    echo "Dados replicados com sucesso!";
} else {
    echo "Nenhum agendamento encontrado.";
}

// Fechar a conexão
$stmt->close();
$conn->close();
?>
