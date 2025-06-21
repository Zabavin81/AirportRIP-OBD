<?php
$user = require_once __DIR__ . '/../middleware/auth.php';

echo json_encode([
  'id' => $user['id'],
  'email' => $user['email'],
  'role' => $user['role']
]);
