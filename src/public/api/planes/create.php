<?php
require_once __DIR__ . '/../../../app/DB.php';
require_once __DIR__ . '/../../../vendor/autoload.php';


$data = json_decode(file_get_contents('php://input'), true);
$type = trim($data['type'] ?? '');
$capacity = (int)($data['capacity'] ?? 0);
$serial_number = trim($data['serial_number'] ?? '');

if (!$type || !$capacity || !$serial_number) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing fields']);
    exit;
}

$db = DB::connect();
$stmt = $db->prepare("INSERT INTO planes (type, capacity, serial_number) VALUES (?, ?, ?)");
$stmt->execute([$type, $capacity, $serial_number]);

echo json_encode(['message' => 'Plane created']);