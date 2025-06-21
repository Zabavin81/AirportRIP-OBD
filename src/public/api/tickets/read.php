<?php

require_once __DIR__.'/../../../app/DB.php';
require_once __DIR__.'/../../../vendor/autoload.php';

$db = DB::connect();
$tickets = $db->query(
  "
    SELECT 
        t.id, t.number, t.type, 
        p.first_name, p.last_name, 
        f.flight_number, f.origin, f.destination
    FROM tickets t
    JOIN passengers p ON t.passenger_id = p.id
    JOIN flights f ON t.flight_id = f.id
    ORDER BY t.id DESC
"
)->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($tickets);
