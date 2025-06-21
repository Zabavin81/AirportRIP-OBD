<?php

require_once __DIR__.'/../../../app/DB.php';
require_once __DIR__.'/../../../vendor/autoload.php';

$db = DB::connect();
$airports = $db->query("
    SELECT a.id, a.code, a.city_id, c.name AS city_name
    FROM airports a
    JOIN cities c ON a.city_id = c.id
    ORDER BY a.code
")->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($airports);