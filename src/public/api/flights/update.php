<?php
require_once __DIR__ . '/../../../app/DB.php';

require_once __DIR__.'/../../../vendor/autoload.php';

$data = json_decode(file_get_contents('php://input'), true);

$id = (int)($data['id'] ?? 0);
$flight_number = trim($data['flight_number'] ?? '');
$departure_time = $data['departure_time'] ?? '';
$arrival_time = $data['arrival_time'] ?? '';
$status = trim($data['status'] ?? '');

$departure_airport_id = (int)($data['departure_airport_id'] ?? 0);
$arrival_airport_id = (int)($data['arrival_airport_id'] ?? 0);
$airline_id = (int)($data['airline_id'] ?? 0);
$plane_id = (int)($data['plane_id'] ?? 0);
$gate_id = (int)($data['gate_id'] ?? 0);

if (!$id || !$flight_number || !$departure_time || !$arrival_time || !$status || !$departure_airport_id || !$arrival_airport_id || !$airline_id || !$plane_id || !$gate_id) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required fields']);
    exit;
}

$db = DB::connect();
$stmt = $db->prepare("
    UPDATE flights
    SET flight_number = ?, departure_time = ?, arrival_time = ?, status = ?,
        departure_airport_id = ?, arrival_airport_id = ?, airline_id = ?, plane_id = ?, gate_id = ?
    WHERE id = ?
");
$stmt->execute([$flight_number, $departure_time, $arrival_time, $status, $departure_airport_id, $arrival_airport_id, $airline_id, $plane_id, $gate_id, $id]);

echo json_encode(['message' => 'Flight updated']);