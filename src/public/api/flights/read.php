<?php

require_once __DIR__.'/../../../app/DB.php';
require_once __DIR__.'/../../../vendor/autoload.php';

$db = DB::connect();

$query = "
    SELECT
        f.id,
        f.flight_number,
        f.departure_time,
        f.arrival_time,
        f.status,
        da.code AS departure_airport,
        aa.code AS arrival_airport,
        a.name AS airline,
        p.type AS plane,
        g.name AS gate
    FROM flights f
    JOIN airports da ON f.departure_airport_id = da.id
    JOIN airports aa ON f.arrival_airport_id = aa.id
    JOIN airlines a ON f.airline_id = a.id
    JOIN planes p ON f.plane_id = p.id
    JOIN gates g ON f.gate_id = g.id
    ORDER BY f.departure_time DESC
";

$flights = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($flights);