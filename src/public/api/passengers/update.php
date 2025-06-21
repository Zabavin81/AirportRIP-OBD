<?php


require_once __DIR__.'/../../../app/DB.php';

require_once __DIR__.'/../../../vendor/autoload.php';

$data = json_decode(file_get_contents('php://input'), true);
$id = (int)($data['id'] ?? 0);
$first = trim($data['first_name'] ?? '');
$last = trim($data['last_name'] ?? '');

if (!$id || !$first || !$last) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing fields']);
    exit;
}

$db = DB::connect();
$stmt = $db->prepare(
  "UPDATE passengers SET first_name = ?, last_name = ? WHERE id = ?"
);
$stmt->execute([$first, $last, $id]);

echo json_encode(['message' => 'Passenger updated']);