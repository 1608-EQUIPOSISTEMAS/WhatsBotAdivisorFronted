<?php
/**
 * ============================================
 * SISTEMA DE CIERRE DE SESIÓN (LOGOUT)
 * ============================================
 * - Registra el logout en logs
 * - Destruye la sesión completamente
 * - Limpia cookies de sesión
 * - Redirecciona al login
 */

session_start();

// Incluir conexión a base de datos
require_once('../conexion/conexion.php');

// ============================================
// REGISTRAR LOGOUT EN LOGS
// ============================================
if(isset($_SESSION['usuario_id']) && isset($_SESSION['username'])) {
    try {
        $queryLog = "INSERT INTO logs (
                        usuario_id, 
                        accion, 
                        descripcion, 
                        ip_address, 
                        user_agent
                     ) VALUES (
                        :usuario_id, 
                        'LOGOUT', 
                        CONCAT('Usuario cerró sesión - ', :username), 
                        :ip, 
                        :user_agent
                     )";
        
        $stmtLog = $pdo->prepare($queryLog);
        $stmtLog->bindParam(':usuario_id', $_SESSION['usuario_id'], PDO::PARAM_INT);
        $stmtLog->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
        $stmtLog->bindParam(':ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
        $stmtLog->bindParam(':user_agent', $_SERVER['HTTP_USER_AGENT'], PDO::PARAM_STR);
        $stmtLog->execute();
        
    } catch(PDOException $e) {
        // Si falla el log, continuar con el logout de todas formas
        error_log("Error al registrar logout: " . $e->getMessage());
    }
}

// ============================================
// DESTRUIR SESIÓN COMPLETAMENTE
// ============================================

// Limpiar todas las variables de sesión
$_SESSION = array();

// Destruir la cookie de sesión si existe
if (isset($_COOKIE[session_name()])) {
    setcookie(
        session_name(), 
        '', 
        time() - 42000, 
        '/',
        '',
        isset($_SERVER['HTTPS']),
        true
    );
}

// Destruir la sesión
session_destroy();

// Regenerar ID de sesión por seguridad
session_start();
session_regenerate_id(true);
$_SESSION = array();
session_destroy();

// ============================================
// REDIRECCIONAR AL LOGIN
// ============================================

// Mensaje de despedida (opcional)
session_start();
$_SESSION['mensaje_logout'] = 'Sesión cerrada correctamente. ¡Hasta pronto!';

// Redireccionar
header('Location: ../index.php');
exit();
?>