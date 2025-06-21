<?php

require_once __DIR__.'/../../../app/DB.php';
require_once __DIR__.'/../../../vendor/autoload.php';

$db = DB::connect();
$countries = $db->query("SELECT * FROM countries ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($countries);