<?php
require_once __DIR__ . '/../../../app/DB.php';
require_once __DIR__ . '/../../../vendor/autoload.php';


$data = json_decode(file_get_contents('php://input'), true);
$first = trim($data['first_name'] ?? '');
$last  = trim($data['last_name'] ?? '');

if (!$first || !$last) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing fields']);
    exit;
}

$db = DB::connect();
$stmt = $db->prepare("INSERT INTO passengers (first_name, last_name) VALUES (?, ?)");
$stmt->execute([$first, $last]);

echo json_encode(['message' => 'Passenger added']);
