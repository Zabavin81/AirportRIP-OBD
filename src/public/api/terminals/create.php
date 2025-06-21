<?php
require_once __DIR__ . '/../../../app/DB.php';
require_once __DIR__ . '/../../../vendor/autoload.php';


$data = json_decode(file_get_contents('php://input'), true);
$name = trim($data['name'] ?? '');

if (!$name) {
    http_response_code(400);
    echo json_encode(['error' => 'Terminal name is required']);
    exit;
}

$db = DB::connect();
$stmt = $db->prepare("INSERT INTO terminals (name) VALUES (?)");
$stmt->execute([$name]);

echo json_encode(['message' => 'Terminal added']);