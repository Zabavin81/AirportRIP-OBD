<?php


require_once __DIR__.'/../../../app/DB.php';
require_once __DIR__.'/../../../vendor/autoload.php';

$data = json_decode(file_get_contents('php://input'), true);
$id = (int)($data['id'] ?? 0);
$name = trim($data['name'] ?? '');

if (!$id || !$name) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing fields']);
    exit;
}

$db = DB::connect();
$stmt = $db->prepare("UPDATE countries SET name = ? WHERE id = ?");
$stmt->execute([$name, $id]);

echo json_encode(['message' => 'Country updated']);