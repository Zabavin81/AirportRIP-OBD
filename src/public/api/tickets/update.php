<?php
require_once __DIR__ . '/../../../app/DB.php';

require_once __DIR__.'/../../../vendor/autoload.php';

$data = json_decode(file_get_contents('php://input'), true);

$id           = (int)($data['id'] ?? 0);
$number       = trim($data['number'] ?? '');
$type         = trim($data['type'] ?? '');
$passenger_id = (int)($data['passenger_id'] ?? 0);
$flight_id    = (int)($data['flight_id'] ?? 0);

if (!$id || !$number || !$type || !$passenger_id || !$flight_id) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing fields']);
    exit;
}

$db = DB::connect();
$stmt = $db->prepare("UPDATE tickets SET number = ?, type = ?, passenger_id = ?, flight_id = ? WHERE id = ?");
$stmt->execute([$number, $type, $passenger_id, $flight_id, $id]);

echo json_encode(['message' => 'Ticket updated']);