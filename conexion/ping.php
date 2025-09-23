<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

// Respuesta simple y rápida
$response = [
    'status' => 'pong',
    'message' => 'El servidor se prendio!',
    'timestamp' => date('Y-m-d H:i:s'),
    'memory_usage' => memory_get_usage(true),
    'uptime' => file_exists('/proc/uptime') ? file_get_contents('/proc/uptime') : 'unknown'
];

echo json_encode($response, JSON_PRETTY_PRINT);
?>