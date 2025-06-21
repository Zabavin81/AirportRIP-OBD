<?php

require_once __DIR__.'/../../../vendor/autoload.php';
require_once __DIR__ . '/../../../app/DB.php';


$data = json_decode(file_get_contents('php://input'), true);
$id = (int)($data['id'] ?? 0);

if (!$id) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing ID']);
    exit;
}

$db = DB::connect();
$stmt = $db->prepare("DELETE FROM planes WHERE id = ?");
$stmt->execute([$id]);

echo json_encode(['message' => 'Plane deleted']);