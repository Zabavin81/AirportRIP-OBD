<?php
require_once __DIR__ . '/../../../app/DB.php';
require_once __DIR__ . '/../../../vendor/autoload.php';


$data = json_decode(file_get_contents('php://input'), true);
$code = strtoupper(trim($data['code'] ?? ''));
$city_id = (int)($data['city_id'] ?? 0);

if (!$code || !$city_id) {
    http_response_code(400);
    echo json_encode(['error' => 'Code and city_id are required']);
    exit;
}

$db = DB::connect();
$stmt = $db->prepare("INSERT INTO airports (code, city_id) VALUES (?, ?)");
$stmt->execute([$code, $city_id]);

echo json_encode(['message' => 'Airport added']);