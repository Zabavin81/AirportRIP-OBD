<?php
require_once __DIR__ . '/../../../app/DB.php';

require_once __DIR__.'/../../../vendor/autoload.php';

$data = json_decode(file_get_contents('php://input'), true);
$id = (int)($data['id'] ?? 0);
$name = trim($data['name'] ?? '');
$terminal_id = (int)($data['terminal_id'] ?? 0);

if (!$id || !$name || !$terminal_id) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing fields']);
    exit;
}

$db = DB::connect();
$stmt = $db->prepare("UPDATE gates SET name = ?, terminal_id = ? WHERE id = ?");
$stmt->execute([$name, $terminal_id, $id]);

echo json_encode(['message' => 'Gate updated']);