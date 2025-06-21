<?php

require_once __DIR__.'/../../../app/DB.php';
require_once __DIR__.'/../../../vendor/autoload.php';

$db = DB::connect();
$cities = $db->query("
    SELECT c.id, c.name, c.country_id, countries.name AS country_name
    FROM cities c
    JOIN countries ON c.country_id = countries.id
    ORDER BY c.name
")->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($cities);