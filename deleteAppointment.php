<?php
$servername = "localhost";
$username = "root"; // Usuário padrão do XAMPP
$password = ""; // Senha padrão do XAMPP é vazia
$dbname = "tatuagem";

// Conexão ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifique a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifique se o ID foi enviado
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare a instrução SQL para deletar o agendamento
    $sql = "DELETE FROM appointments WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Agendamento excluído com sucesso']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Falha ao excluir agendamento']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'ID não fornecido']);
}

$conn->close();
?>
