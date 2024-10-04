<?php
// deleteAppointment.php
header('Content-Type: application/json');

require 'db_connect.php';

// Verificar se o ID foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']); // Sanitiza o ID para inteiro

    // Preparar a declaração para evitar injeção de SQL
    $stmt = $conn->prepare("DELETE FROM appointments WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(['success' => true, 'message' => 'Agendamento excluído com sucesso.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Nenhum agendamento encontrado com o ID fornecido.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao executar a consulta: ' . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao preparar a consulta: ' . $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID não fornecido ou método de requisição inválido.']);
}

$conn->close();
?>
