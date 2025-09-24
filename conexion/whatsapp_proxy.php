<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

$action = $_GET['action'] ?? '';
$nodeServer = 'http://34.30.42.255:3000';

try {
    switch($action) {
        case 'start':
            $response = file_get_contents($nodeServer . '/start-whatsapp', false, stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => 'Content-Type: application/json',
                    'timeout' => 10
                ]
            ]));
            break;
            
        case 'status':
            $response = file_get_contents($nodeServer . '/get-qr');
            break;
            
        case 'stop':
            $response = file_get_contents($nodeServer . '/stop-whatsapp', false, stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => 'Content-Type: application/json',
                    'timeout' => 10
                ]
            ]));
            break;
            
        default:
            $response = json_encode(['error' => 'Invalid action']);
    }
    
    echo $response;
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage(), 'success' => false]);
}
?>