<?php
require_once __DIR__ . '/../../../app/DB.php';
require_once __DIR__ . '/../../../vendor/autoload.php';


$data = json_decode(file_get_contents('php://input'), true);
$name = trim($data['name'] ?? '');
$country_id = (int)($data['country_id'] ?? 0);

if (!$name || !$country_id) {
    http_response_code(400);
    echo json_encode(['error' => 'Name and country_id are required']);
    exit;
}

$db = DB::connect();
$stmt = $db->prepare("INSERT INTO cities (name, country_id) VALUES (?, ?)");
$stmt->execute([$name, $country_id]);

echo json_encode(['message' => 'City added']);