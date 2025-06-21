<?php

require_once __DIR__ . '/../../../vendor/autoload.php';


use App\TokenService;

$headers = getallheaders();

if (!isset($headers['Authorization'])) {
    http_response_code(401);
    echo json_encode(['error' => 'No token provided']);
    exit;
}

$token = str_replace('Bearer ', '', $headers['Authorization']);
$decoded = TokenService::validate($token);

if (!$decoded) {
    http_response_code(401);
    echo json_encode(['error' => 'Invalid token']);
    exit;
}

// ✅ Возвращаем $user как результат
return (array)$decoded;
