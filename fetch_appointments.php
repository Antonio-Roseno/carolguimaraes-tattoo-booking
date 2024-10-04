<?php
// fetch_appointments.php
header('Content-Type: application/json');

require 'db_connect.php';

// Consulta para buscar todos os agendamentos
$sql = "SELECT id, fullName, preferredDate, tattooDescription, email, phone, birthDate, tattooSize, bodyPart, medicalConditions, allergies, medications, pregnantNursing, skinConditions, skinSensitivity, recentTan FROM appointments ORDER BY preferredDate DESC";

$result = $conn->query($sql);

$appointments = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        // Conversão de campos booleanos para true/false
        $row['pregnantNursing'] = (bool)$row['pregnantNursing'];
        $row['recentTan'] = (bool)$row['recentTan'];
        
        $appointments[] = $row;
    }
    echo json_encode($appointments);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao buscar agendamentos: ' . $conn->error]);
}

$conn->close();
?>
