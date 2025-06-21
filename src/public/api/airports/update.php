<?php
require_once __DIR__ . '/../../../app/DB.php';

require_once __DIR__.'/../../../vendor/autoload.php';

$data = json_decode(file_get_contents('php://input'), true);
$id = (int)($data['id'] ?? 0);
$code = strtoupper(trim($data['code'] ?? ''));
$city_id = (int)($data['city_id'] ?? 0);

if (!$id || !$code || !$city_id) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing fields']);
    exit;
}

$db = DB::connect();
$stmt = $db->prepare("UPDATE airports SET code = ?, city_id = ? WHERE id = ?");
$stmt->execute([$code, $city_id, $id]);

echo json_encode(['message' => 'Airport updated']);