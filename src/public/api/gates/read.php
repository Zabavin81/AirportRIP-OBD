<?php

require_once __DIR__.'/../../../app/DB.php';
require_once __DIR__.'/../../../vendor/autoload.php';

$db = DB::connect();
$gates = $db->query("
    SELECT g.id, g.name, g.terminal_id, t.name AS terminal_name
    FROM gates g
    JOIN terminals t ON g.terminal_id = t.id
    ORDER BY g.id DESC
")->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($gates);
