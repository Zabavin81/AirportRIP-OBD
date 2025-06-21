<?php


require_once __DIR__.'/../../../app/DB.php';
require_once __DIR__.'/../../../vendor/autoload.php';

$data = json_decode(file_get_contents('php://input'), true);
$id = (int)($data['id'] ?? 0);
$name = trim($data['name'] ?? '');
$country_id = (int)($data['country_id'] ?? 0);

if (!$id || !$name || !$country_id) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing fields']);
    exit;
}

$db = DB::connect();
$stmt = $db->prepare("UPDATE cities SET name = ?, country_id = ? WHERE id = ?");
$stmt->execute([$name, $country_id, $id]);

echo json_encode(['message' => 'City updated']);