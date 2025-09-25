<?php
session_start();
include('conexion/conexion.php'); 

// ============================================
// PROCESAMIENTO DEL LOGIN
// ============================================

if(isset($_POST['acceder'])){
    $email = trim($_POST['username']);
    $password = trim($_POST['Password']);

    // Validación de campos vacíos
    if(empty($email) || empty($password)){
        $_SESSION['error'] = 'Por favor complete todos los campos';   
    } else {
        try {
            // CONSULTA OPTIMIZADA: Verificar usuario activo
            $query = "SELECT 
                        u.id, 
                        u.username, 
                        u.email, 
                        u.password_hash, 
                        u.nombres, 
                        u.apellidos, 
                        u.rol as rol_id,
                        tr.nombre as rol_nombre, 
                        tr.descripcion as rol_descripcion, 
                        u.permisos_asignados, 
                        u.estado, 
                        u.ultimo_acceso 
                      FROM usuarios u 
                      INNER JOIN tipo_rol tr ON u.rol = tr.id
                      WHERE u.email = :email AND u.estado = 'activo'
                      LIMIT 1";
            
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if($usuario){
                $password_valido = false;
                
                // Verificar contraseña hasheada
                if(password_verify($password, $usuario['password_hash'])){
                    $password_valido = true;
                }
                // Contraseñas temporales para pruebas (ELIMINAR EN PRODUCCIÓN)
                elseif($password === 'admin123' && $usuario['rol_nombre'] === 'admin') {
                    $password_valido = true;
                }
                elseif($password === 'operador123' && $usuario['rol_nombre'] === 'operador') {
                    $password_valido = true;
                }
                elseif($password === 'supervisor123' && $usuario['rol_nombre'] === 'consulta') {
                    $password_valido = true;
                }

                // ============================================
                // LOGIN EXITOSO
                // ============================================
                if($password_valido){
                    
                    // Actualizar último acceso
                    $queryUpdate = "UPDATE usuarios SET ultimo_acceso = NOW() WHERE id = :id";
                    $stmtUpdate = $pdo->prepare($queryUpdate);
                    $stmtUpdate->bindParam(':id', $usuario['id'], PDO::PARAM_INT);
                    $stmtUpdate->execute();
                    
                    // Crear variables de sesión
                    $_SESSION['usuario_id'] = $usuario['id'];
                    $_SESSION['username'] = $usuario['username'];
                    $_SESSION['email'] = $usuario['email'];
                    $_SESSION['nombres'] = $usuario['nombres'];
                    $_SESSION['apellidos'] = $usuario['apellidos'];
                    $_SESSION['nombre_completo'] = $usuario['nombres'] . ' ' . $usuario['apellidos'];
                    
                    // Guardar información de rol
                    $_SESSION['rol_id'] = $usuario['rol_id'];
                    $_SESSION['rol'] = $usuario['rol_nombre'];
                    $_SESSION['rol_nombre'] = $usuario['rol_nombre'];
                    $_SESSION['rol_descripcion'] = $usuario['rol_descripcion'];
                    
                    // Decodificar permisos JSON
                    $_SESSION['permisos_asignados'] = json_decode($usuario['permisos_asignados'], true);
                    $_SESSION['login_time'] = date('Y-m-d H:i:s');

                    // Registrar login exitoso en logs
                    $queryLog = "INSERT INTO logs (usuario_id, accion, descripcion, ip_address, user_agent) 
                                 VALUES (:usuario_id, 'LOGIN', CONCAT('Usuario inició sesión exitosamente - Rol: ', :rol_nombre), :ip, :user_agent)";
                    
                    $stmtLog = $pdo->prepare($queryLog);
                    $stmtLog->bindParam(':usuario_id', $usuario['id'], PDO::PARAM_INT);
                    $stmtLog->bindParam(':rol_nombre', $usuario['rol_nombre'], PDO::PARAM_STR);
                    $stmtLog->bindParam(':ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
                    $stmtLog->bindParam(':user_agent', $_SERVER['HTTP_USER_AGENT'], PDO::PARAM_STR);
                    $stmtLog->execute();

                    // Mensaje de bienvenida según rol
                    switch($usuario['rol_nombre']){
                        case 'admin':
                            $_SESSION['mensaje_bienvenida'] = '¡Bienvenido Administrador!';
                            break;
                        case 'fundacion':
                            $_SESSION['mensaje_bienvenida'] = '¡Bienvenido Fundador!';
                            break;
                        case 'comcercial':
                            $_SESSION['mensaje_bienvenida'] = '¡Bienvenido Comercial!';
                            break;
                        default:
                            $_SESSION['mensaje_bienvenida'] = '¡Bienvenido al sistema!';
                    }
                    
                    // Redireccionar al sistema
                    if ($usuario['rol_nombre'] === 'fundacion') {
                        header('Location: bot2.php');
                    } else {
                        header('Location: bot.php');
                    }
                    exit();
                    
                } else {
                    // ============================================
                    // CONTRASEÑA INCORRECTA
                    // ============================================
                    $_SESSION['error'] = 'Contraseña incorrecta';

                    // Registrar intento fallido
                    $queryLogFail = "INSERT INTO logs (usuario_id, accion, descripcion, ip_address, user_agent) 
                                     VALUES (:usuario_id, 'LOGIN_FAILED', 'Intento de login fallido - contraseña incorrecta', :ip, :user_agent)";
                    
                    $stmtLogFail = $pdo->prepare($queryLogFail);
                    $stmtLogFail->bindParam(':usuario_id', $usuario['id'], PDO::PARAM_INT);
                    $stmtLogFail->bindParam(':ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
                    $stmtLogFail->bindParam(':user_agent', $_SERVER['HTTP_USER_AGENT'], PDO::PARAM_STR);
                    $stmtLogFail->execute();
                }
                
            } else {
                // Usuario no encontrado o inactivo
                $_SESSION['error'] = 'Usuario no encontrado o inactivo';
            }
            
        } catch (PDOException $e) {
            $_SESSION['error'] = 'Error de conexión. Intente nuevamente.';
            error_log("Error de login: " . $e->getMessage());
        }
    }
}

// ============================================
// OBTENER CONFIGURACIÓN DE EMPRESA
// ============================================
try {
    $queryEmpresa = "SELECT imagen, pestaña FROM empresa LIMIT 1";
    $stmtEmpresa = $pdo->prepare($queryEmpresa);
    $stmtEmpresa->execute();
    $rowEmpresa = $stmtEmpresa->fetch(PDO::FETCH_ASSOC);
    
    $rutaImagen = isset($rowEmpresa['imagen']) ? htmlspecialchars($rowEmpresa['imagen']) : 'system/assets/img/logo.png';
    $pestaña = isset($rowEmpresa['pestaña']) ? htmlspecialchars($rowEmpresa['pestaña']) : 'Sistema - WE';
    
} catch (PDOException $e) {
    $rutaImagen = 'assets/images/we.png';
    $pestaña = 'Sistema - WE';
    error_log("Error al obtener configuración de empresa: " . $e->getMessage());
}

// ============================================
// OBTENER MENSAJES DE LOGIN
// ============================================
try {
    $queryLogin = "SELECT mensaje_bienvenida, suman_mensaje FROM login LIMIT 1";
    $stmtLogin = $pdo->prepare($queryLogin);
    $stmtLogin->execute();
    $mensajes = $stmtLogin->fetch(PDO::FETCH_ASSOC);
    
    $primer_mensaje = isset($mensajes['mensaje_bienvenida']) ? htmlspecialchars($mensajes['mensaje_bienvenida']) : 'Bienvenido al Sistema';
    $segundo_mensaje = isset($mensajes['suman_mensaje']) ? htmlspecialchars($mensajes['suman_mensaje']) : 'Ingrese sus credenciales';
    
} catch(PDOException $e){
    $primer_mensaje = 'Bienvenido al Sistema';
    $segundo_mensaje = 'Ingrese sus credenciales para acceder';
    error_log("Error al obtener mensajes de login: " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo $rutaImagen; ?>" type="image/x-icon">
    <title><?php echo $pestaña; ?></title>
    
    <!-- Fonts & Styles -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #845642;
            --primary-hover: #444458;
            --bg-gradient: linear-gradient(135deg, #e3f2fd 0%, #f5fbff 100%);
            --card-shadow: 0 10px 30px rgba(0, 80, 130, 0.18);
            --input-bg: rgba(249, 251, 253, 0.9);
            --text-primary: #2d3a4a;
            --text-secondary: #5a6a7a;
            --border-radius: 12px;
            --transition-smooth: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', 'Segoe UI', sans-serif;
            background-image: url('fondo-hospital.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-blend-mode: overlay;
            background-color: rgba(235, 245, 255, 0.6);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 1;
        }

        .card {
            border: none;
            border-radius: var(--border-radius);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            box-shadow: var(--card-shadow);
            padding: 35px;
            transition: var(--transition-smooth);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 80, 130, 0.25);
        }

        .logo-container {
            width: 140px;
            height: 140px;
            margin: 0 auto 20px;
            perspective: 1000px;
        }

        .logo {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 50%;
            border: 4px solid rgba(0, 119, 182, 0.8);
            padding: 4px;
            background-color: white;
            box-shadow: 0 8px 20px rgba(0, 119, 182, 0.25);
            transition: var(--transition-smooth);
        }

        .title {
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 5px;
            font-size: 1.7rem;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.08);
        }

        .subtitle {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-bottom: 25px;
            letter-spacing: 0.2px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.9rem;
            margin-bottom: 6px;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #d1e3f5;
            border-radius: 10px;
            font-size: 1rem;
            transition: var(--transition-smooth);
            background: var(--input-bg);
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
            color: var(--text-primary);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(0, 119, 182, 0.15);
            background: white;
            outline: none;
        }

        .btn-primary {
            width: 100%;
            padding: 12px 15px;
            border-radius: 10px;
            background: linear-gradient(135deg, #0077b6 0%, #005f92 100%);
            border: none;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.5px;
            margin-top: 10px;
            transition: var(--transition-smooth);
            box-shadow: 0 4px 15px rgba(0, 119, 182, 0.25);
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 119, 182, 0.35);
            background: linear-gradient(135deg, #0088cc 0%, #0077b6 100%);
        }

        .btn-primary:active {
            transform: translateY(1px);
            box-shadow: 0 2px 10px rgba(0, 119, 182, 0.2);
        }

        .btn-primary::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .btn-primary:hover::after {
            left: 100%;
        }

        .footer-text {
            text-align: center;
            margin-top: 20px;
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        .footer-text a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition-smooth);
        }

        .footer-text a:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }

        .alert-danger {
            border-radius: 10px;
            border-left: 4px solid #dc3545;
            padding: 12px 15px;
            margin-bottom: 20px;
            background: rgba(220, 53, 69, 0.1);
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }

        @media (max-width: 480px) {
            .card {
                padding: 25px;
            }
            
            .logo-container {
                width: 110px;
                height: 110px;
            }
            
            .title {
                font-size: 1.5rem;
            }
            
            .form-control {
                padding: 10px 14px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card">
            <div class="text-center">
                <div class="logo-container">
                    <img src="<?php echo $rutaImagen; ?>" alt="Logo Sistema" class="logo" id="logo">
                </div>
                <h4 class="title"><?php echo $primer_mensaje; ?></h4>
                <p class="subtitle"><?php echo $segundo_mensaje; ?></p>
            </div>

            <!-- Mostrar mensajes de error -->
            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>⚠️ Error:</strong> <?php echo htmlspecialchars($_SESSION['error']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <?php if(isset($_SESSION['mensaje_logout'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>✅ Éxito:</strong> <?php echo htmlspecialchars($_SESSION['mensaje_logout']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['mensaje_logout']); ?>
            <?php endif; ?>

            <form action="" method="POST" id="loginForm">
                <div class="form-group">
                    <label for="username" class="form-label">📧 Correo electrónico</label>
                    <input 
                        type="email" 
                        class="form-control" 
                        id="username" 
                        name="username" 
                        placeholder="ejemplo@correo.com" 
                        required 
                        autocomplete="email"
                        autofocus>
                </div>
                
                <div class="form-group">
                    <label for="Password" class="form-label">🔒 Contraseña</label>
                    <input 
                        type="password" 
                        class="form-control" 
                        id="Password" 
                        name="Password" 
                        placeholder="Ingrese su contraseña" 
                        required 
                        autocomplete="current-password">
                </div>
                
                <button type="submit" class="btn btn-primary" name="acceder">
                    🚀 Iniciar sesión
                </button>
            </form>
            
            <div class="footer-text">
                <span>¿Olvidaste tu contraseña? <a href="#">Recuperar</a></span>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Efecto 3D para el logo
        const logo = document.getElementById('logo');
        const logoContainer = document.querySelector('.logo-container');
        
        if(logo && logoContainer) {
            document.addEventListener('mousemove', (e) => {
                const rect = logoContainer.getBoundingClientRect();
                const centerX = rect.left + rect.width / 2;
                const centerY = rect.top + rect.height / 2;
                
                const distanceX = e.clientX - centerX;
                const distanceY = e.clientY - centerY;
                const distance = Math.sqrt(distanceX * distanceX + distanceY * distanceY);
                
                if (distance < rect.width * 2) {
                    const maxRotation = 10;
                    const rotateY = maxRotation * (distanceX / rect.width);
                    const rotateX = -maxRotation * (distanceY / rect.height);
                    
                    requestAnimationFrame(() => {
                        logo.style.transform = `
                            perspective(1000px)
                            rotateX(${rotateX}deg)
                            rotateY(${rotateY}deg)
                            scale(1.05)
                        `;
                    });
                } else {
                    logo.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) scale(1)';
                }
            });
            
            document.addEventListener('mouseleave', () => {
                logo.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) scale(1)';
            });
        }

        // Auto-focus en el campo de email
        document.getElementById('username')?.focus();

        // Prevenir doble submit
        const form = document.getElementById('loginForm');
        let isSubmitting = false;
        
        form?.addEventListener('submit', function(e) {
            if (isSubmitting) {
                e.preventDefault();
                return false;
            }
            isSubmitting = true;
            
            // Reactivar después de 3 segundos por si hay error
            setTimeout(() => {
                isSubmitting = false;
            }, 3000);
        });
    </script>
</body>
</html>