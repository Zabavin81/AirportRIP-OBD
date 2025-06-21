<?php
require_once __DIR__ . '/../../../app/DB.php';
require_once __DIR__ . '/../../../vendor/autoload.php';


$data = json_decode(file_get_contents('php://input'), true);

$id            = (int)($data['id'] ?? 0);
$ticket_id     = (int)($data['ticket_id'] ?? 0);
$weight        = (float)($data['weight'] ?? 0);
$is_oversized  = (bool)($data['is_oversized'] ?? false);

if (!$id || !$ticket_id || !$weight) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing fields']);
    exit;
}

$db = DB::connect();
$stmt = $db->prepare("UPDATE baggage SET ticket_id = ?, weight = ?, is_oversized = ? WHERE id = ?");
$stmt->execute([$ticket_id, $weight, $is_oversized, $id]);

echo json_encode(['message' => 'Baggage updated']);
