<?php

require_once __DIR__.'/../../../app/DB.php';
require_once __DIR__.'/../../../vendor/autoload.php';

$db = DB::connect();
$passengers = $db->query("SELECT * FROM passengers ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($passengers);