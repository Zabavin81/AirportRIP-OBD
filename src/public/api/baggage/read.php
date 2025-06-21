<?php
require_once __DIR__ . '/../../../app/DB.php';
require_once __DIR__ . '/../../../vendor/autoload.php';


$db = DB::connect();
$baggage = $db->query("
    SELECT 
        b.id, b.weight, b.is_oversized, b.created_at,
        t.number AS ticket_number
    FROM baggage b
    JOIN tickets t ON b.ticket_id = t.id
    ORDER BY b.id DESC
")->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($baggage);
