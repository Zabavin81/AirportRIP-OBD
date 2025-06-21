<?php
require_once __DIR__ . '/../../../app/DB.php';
require_once __DIR__ . '/../../../vendor/autoload.php';


$data = json_decode(file_get_contents('php://input'), true);

$number       = trim($data['number'] ?? '');
$type         = trim($data['type'] ?? 'economy');
$passenger_id = (int)($data['passenger_id'] ?? 0);
$flight_id    = (int)($data['flight_id'] ?? 0);

if (!$number || !$passenger_id || !$flight_id) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing fields']);
    exit;
}

$db = DB::connect();
$stmt = $db->prepare("INSERT INTO tickets (number, type, passenger_id, flight_id) VALUES (?, ?, ?, ?)");
$stmt->execute([$number, $type, $passenger_id, $flight_id]);

echo json_encode(['message' => 'Ticket created']);
