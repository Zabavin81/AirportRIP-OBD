<?php
require_once __DIR__ . '/../../../app/DB.php';
require_once __DIR__ . '/../../../vendor/autoload.php';


$data = json_decode(file_get_contents('php://input'), true);
$name = trim($data['name'] ?? '');
$terminal_id = (int)($data['terminal_id'] ?? 0);

if (!$name || !$terminal_id) {
    http_response_code(400);
    echo json_encode(['error' => 'Name and terminal_id are required']);
    exit;
}

$db = DB::connect();
$stmt = $db->prepare("INSERT INTO gates (name, terminal_id) VALUES (?, ?)");
$stmt->execute([$name, $terminal_id]);

echo json_encode(['message' => 'Gate added']);