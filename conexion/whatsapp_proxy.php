<?php
header('Content-Type: application/json');
header('Cache-Control: no-cache, no-store, must-revalidate');

// URL base del servidor Node.js
$nodeServerUrl = 'http://34.30.42.255:8080';

// Función para realizar peticiones HTTP
function makeHttpRequest($url, $method = 'GET', $data = null) {
    $context = stream_context_create([
        'http' => [
            'method' => $method,
            'header' => [
                'Content-Type: application/json',
                'User-Agent: WhatsApp-PHP-Proxy/1.0'
            ],
            'timeout' => 30,
            'ignore_errors' => true
        ]
    ]);
    
    if ($data && $method === 'POST') {
        $context['http']['content'] = json_encode($data);
    }
    
    $result = @file_get_contents($url, false, $context);
    
    if ($result === false) {
        throw new Exception('No se pudo conectar con el servidor Node.js');
    }
    
    return json_decode($result, true);
}

// Función para validar que el servidor Node.js esté disponible
function checkNodeServer($url) {
    $healthUrl = $url . '/health';
    
    try {
        $response = makeHttpRequest($healthUrl);
        return isset($response['status']) && $response['status'] === 'ok';
    } catch (Exception $e) {
        return false;
    }
}

try {
    // Verificar que el servidor Node.js esté disponible
    if (!checkNodeServer($nodeServerUrl)) {
        throw new Exception('El servidor Node.js no está disponible en el puerto 3000');
    }
    
    $action = $_GET['action'] ?? '';
    
    switch ($action) {
        case 'start':
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Método no permitido');
            }
            
            $response = makeHttpRequest($nodeServerUrl . '/start-whatsapp', 'POST');
            
            // Agregar información adicional
            if (isset($response['success']) && $response['success']) {
                $response['timestamp'] = date('Y-m-d H:i:s');
                $response['action'] = 'start';
            }
            
            echo json_encode($response);
            break;
            
        case 'status':
            $response = makeHttpRequest($nodeServerUrl . '/get-qr');
            
            // Validar respuesta
            if (!isset($response['status'])) {
                throw new Exception('Respuesta inválida del servidor Node.js');
            }
            
            // Agregar información adicional
            $response['timestamp'] = date('Y-m-d H:i:s');
            $response['server_status'] = 'online';
            
            echo json_encode($response);
            break;
            
        case 'stop':
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Método no permitido');
            }
            
            $response = makeHttpRequest($nodeServerUrl . '/stop-whatsapp', 'POST');
            
            // Agregar información adicional
            if (isset($response['success']) && $response['success']) {
                $response['timestamp'] = date('Y-m-d H:i:s');
                $response['action'] = 'stop';
            }
            
            echo json_encode($response);
            break;
            
        case 'cleanup':
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Método no permitido');
            }
            
            $response = makeHttpRequest($nodeServerUrl . '/cleanup-session', 'POST');
            
            // Agregar información adicional
            if (isset($response['success']) && $response['success']) {
                $response['timestamp'] = date('Y-m-d H:i:s');
                $response['action'] = 'cleanup';
                
                // Log de limpieza
                error_log('[WhatsApp Cleanup] Sesión limpiada exitosamente - ' . date('Y-m-d H:i:s'));
            }
            
            echo json_encode($response);
            break;
            
        case 'health':
            $response = makeHttpRequest($nodeServerUrl . '/health');
            
            // Agregar información del proxy PHP
            $response['php_proxy'] = [
                'status' => 'ok',
                'version' => PHP_VERSION,
                'timestamp' => date('Y-m-d H:i:s'),
                'memory_usage' => memory_get_usage(true),
                'peak_memory' => memory_get_peak_usage(true)
            ];
            
            echo json_encode($response);
            break;
            
        case 'send':
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Método no permitido');
            }
            
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($input['number']) || !isset($input['message'])) {
                throw new Exception('Parámetros faltantes: number y message son requeridos');
            }
            
            // Validar número de teléfono
            $number = preg_replace('/[^0-9]/', '', $input['number']);
            if (empty($number)) {
                throw new Exception('Número de teléfono inválido');
            }
            
            $data = [
                'number' => $number,
                'message' => $input['message']
            ];
            
            $response = makeHttpRequest($nodeServerUrl . '/send-message', 'POST', $data);
            echo json_encode($response);
            break;
            
        default:
            throw new Exception('Acción no válida: ' . $action);
    }
    
} catch (Exception $e) {
    // Log del error
    error_log('[WhatsApp Proxy Error] ' . $e->getMessage() . ' - ' . date('Y-m-d H:i:s'));
    
    $errorResponse = [
        'success' => false,
        'error' => true,
        'message' => $e->getMessage(),
        'timestamp' => date('Y-m-d H:i:s'),
        'action' => $_GET['action'] ?? 'unknown'
    ];
    
    // Agregar sugerencia según el tipo de error
    if (strpos($e->getMessage(), 'Node.js') !== false) {
        $errorResponse['suggestion'] = 'Verifica que el servidor Node.js esté ejecutándose en el puerto 3000';
        $errorResponse['troubleshooting'] = [
            'Ejecutar: node server.js',
            'Verificar que el puerto 3000 esté disponible',
            'Revisar los logs del servidor Node.js'
        ];
    }
    
    http_response_code(500);
    echo json_encode($errorResponse);
}

// Función para logging personalizado (opcional)
function logWhatsAppActivity($action, $details = []) {
    $logEntry = [
        'timestamp' => date('Y-m-d H:i:s'),
        'action' => $action,
        'details' => $details,
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
    ];
    
    error_log('[WhatsApp Activity] ' . json_encode($logEntry));
}
?>