<?php
session_start();
require_once 'conexion/conexion.php';

// DEBUG: Ver qué valor tiene realmente la sesión
error_log("DEBUG - ROL en sesión: " . print_r($_SESSION['rol_id'] ?? 'NO DEFINIDO', true));

// Obtener el rol del usuario y asegurar que sea integer
$user_role = isset($_SESSION['rol_id']) ? (int)$_SESSION['rol_id'] : null;
$user_permissions = [];
$role_name = 'Sin Rol';
$role_class = 'default';

// Mapear rol a permisos y nombres
switch($user_role) {
    case 1: // Administrador
        $user_permissions = ['all'];
        $role_name = 'Administrador';
        $role_class = 'admin';
        break;
    case 2: // Foundation
        $user_permissions = ['fundacion'];
        $role_name = 'Foundation';
        $role_class = 'foundation';
        break;
    case 3: // Comercial
        $user_permissions = ['members'];
        $role_name = 'Asesor Comercial';
        $role_class = 'comercial';
        break;
    case 4: // Members
        $user_permissions = ['members'];
        $role_name = 'Comercial';
        $role_class = 'comercial';
        break;
    default:
        $user_permissions = [];
        $role_name = 'Sin Permisos';
        $role_class = 'default';
}

// Log para debug
error_log("DEBUG - Rol procesado: {$user_role}, Nombre: {$role_name}, Permisos: " . json_encode($user_permissions));

// Obtener configuraciones
try {
    $sql = "SELECT id, mensaje_bienvenida, palabra_clave FROM configuraciones ORDER BY id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $configuraciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $configuraciones = [];
    $error_message = "Error al obtener configuraciones: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Connect Plus</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">
    
    <style>
        .btn-whatsapp {
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            border: none;
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
            transition: all 0.3s ease;
        }
        
        .btn-whatsapp:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4);
            background: linear-gradient(135deg, #128C7E 0%, #075E54 100%);
        }

        .user-role-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 10px;
        }

        .role-admin { background: #007bff; color: white; }
        .role-foundation { background: #28a745; color: white; }
        .role-comercial { background: #fd7e14; color: white; }
    </style>
</head>
<body>
    <div class="container-scroller">
        <?php include 'includes/header.php'; ?>

        <div class="container-fluid page-body-wrapper">
            <?php include 'includes/sidebar.php'; ?>
            
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            Mensaje de Bienvenida
                            <?php if ($user_role): ?>
                                <span class="user-role-badge role-<?php echo htmlspecialchars($role_class); ?>">
                                    ROL: <?php echo htmlspecialchars($role_name); ?> (ID: <?php echo $user_role; ?>)
                                </span>
                            <?php else: ?>
                                <span class="user-role-badge role-default">
                                    SIN ROL ASIGNADO
                                </span>
                            <?php endif; ?>
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Configuraciones</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <h4 class="card-title">Tabla de Configuraciones</h4>
                                            <p class="card-description">
                                                Configuraciones del sistema
                                                <?php if (!empty($user_permissions)): ?>
                                                    - Permisos: <?php echo implode(', ', $user_permissions); ?>
                                                <?php endif; ?>
                                            </p>
                                        </div>
                                        <div>
                                            <button id="startWhatsAppBtn" class="btn btn-whatsapp btn-rounded d-flex align-items-center justify-content-center" style="color: white;">
                                                <i class="mdi mdi-whatsapp mr-2"></i>
                                                <span id="btnText">Iniciar WhatsApp Bot</span>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <?php if (isset($error_message)): ?>
                                        <div class="alert alert-danger">
                                            <i class="mdi mdi-alert-circle mr-2"></i>
                                            <?php echo htmlspecialchars($error_message); ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th><i class="mdi mdi-pound mr-1"></i> ID </th>
                                                    <th><i class="mdi mdi-key mr-1"></i> Palabra Clave </th>
                                                    <th><i class="mdi mdi-message-text mr-1"></i> Mensaje de Bienvenida </th>
                                                    <th><i class="mdi mdi-cogs mr-1"></i> Acciones </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($configuraciones)): ?>
                                                    <?php foreach ($configuraciones as $config): ?>
                                                        <tr>
                                                            <td><?php echo htmlspecialchars($config['id']); ?></td>
                                                            <td>
                                                                <span class="badge badge-info">
                                                                    <?php echo htmlspecialchars($config['palabra_clave']); ?>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <div style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" 
                                                                     title="<?php echo htmlspecialchars($config['mensaje_bienvenida']); ?>">
                                                                    <?php echo htmlspecialchars($config['mensaje_bienvenida']); ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <button 
                                                                    class="btn btn-outline-primary btn-sm btn-rounded"
                                                                    data-toggle="modal"
                                                                    data-target="#editarModal"
                                                                    data-id="<?php echo htmlspecialchars($config['id']); ?>"
                                                                    data-palabra="<?php echo htmlspecialchars($config['palabra_clave']); ?>"
                                                                    data-mensaje="<?php echo htmlspecialchars($config['mensaje_bienvenida']); ?>"
                                                                >
                                                                    <i class="mdi mdi-pencil-outline mr-2"></i>
                                                                    <span>Editar</span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="4" class="text-center text-muted py-4">
                                                            <i class="mdi mdi-database-remove" style="font-size: 2rem;"></i>
                                                            <p class="mt-2">No hay configuraciones disponibles</p>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include 'includes/footer.php'; ?>
            </div>
        </div>
    </div>

    <?php include 'modals/bot/whatsapp.php'; ?>
    <?php include 'modals/bot/editar.php'; ?>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
    
    <script>
        // Configuración del rol del usuario desde PHP
        const USER_ROLE = <?php echo json_encode($user_role); ?>;
        const USER_PERMISSIONS = <?php echo json_encode($user_permissions); ?>;

        console.log('Usuario actual - Rol:', USER_ROLE, 'Permisos:', USER_PERMISSIONS);

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });

        let qrLibraryLoaded = false;
        let checkingQR = false;
        let whatsappConnected = false;

        function loadQRLibrary() {
            return new Promise((resolve, reject) => {
                if (typeof QRCode !== 'undefined') {
                    qrLibraryLoaded = true;
                    resolve();
                    return;
                }

                const script = document.createElement('script');
                script.src = 'https://cdnjs.cloudflare.com/ajax/libs/qrcode-generator/1.4.4/qrcode.min.js';
                script.onload = () => {
                    window.createQRCode = function(text, container) {
                        try {
                            container.innerHTML = '';
                            const qr = qrcode(0, 'M');
                            qr.addData(text);
                            qr.make();
                            
                            const div = document.createElement('div');
                            div.innerHTML = qr.createImgTag(4, 8);
                            div.style.display = 'flex';
                            div.style.justifyContent = 'center';
                            div.style.alignItems = 'center';
                            container.appendChild(div);
                            
                            return true;
                        } catch (error) {
                            console.error('Error generando QR:', error);
                            return false;
                        }
                    };
                    
                    qrLibraryLoaded = true;
                    resolve();
                };
                script.onerror = () => reject(new Error('Failed to load QR library'));
                document.head.appendChild(script);
            });
        }

        function generateQRCode(container, qrData) {
            if (qrLibraryLoaded && window.createQRCode) {
                const success = window.createQRCode(qrData, container);
                if (!success) showTextQR(container, qrData);
            } else {
                showTextQR(container, qrData);
            }
        }

        function showTextQR(container, qrData) {
            container.innerHTML = `
                <div class="alert alert-info text-center">
                    <i class="mdi mdi-qrcode-scan mb-3" style="font-size: 2rem;"></i>
                    <p><strong>Código QR:</strong></p>
                    <textarea class="form-control" rows="4" readonly style="font-size: 10px;">${qrData}</textarea>
                </div>`;
        }

        function updateButtonState(state, text) {
            const btn = document.getElementById('startWhatsAppBtn');
            const btnText = document.getElementById('btnText');
            
            btn.className = 'btn btn-rounded d-flex align-items-center justify-content-center';
            
            switch(state) {
                case 'loading':
                    btn.classList.add('btn-warning');
                    btn.disabled = true;
                    btnText.innerHTML = '<i class="mdi mdi-loading mdi-spin mr-2"></i>' + text;
                    break;
                case 'connected':
                    btn.classList.add('btn-success');
                    btn.disabled = false;
                    btnText.innerHTML = '<i class="mdi mdi-check-circle mr-2"></i>' + text;
                    break;
                case 'error':
                    btn.classList.add('btn-danger');
                    btn.disabled = false;
                    btnText.innerHTML = '<i class="mdi mdi-alert-circle mr-2"></i>' + text;
                    break;
                default:
                    btn.classList.add('btn-whatsapp');
                    btn.disabled = false;
                    btnText.innerHTML = '<i class="mdi mdi-whatsapp mr-2"></i>' + text;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            loadQRLibrary().catch(error => {
                console.warn('QR library failed to load:', error);
            });

            checkWhatsAppStatus();
        });

        async function checkWhatsAppStatus() {
            try {
                const response = await fetch('conexion/whatsapp_proxy_fundacion.php?action=status');
                const data = await response.json();
                
                if (data.status === 'connected') {
                    whatsappConnected = true;
                    updateButtonState('connected', 'WhatsApp Conectado');
                }
            } catch (error) {
                console.log('WhatsApp no está conectado inicialmente');
            }
        }

        document.getElementById('startWhatsAppBtn').addEventListener('click', async function() {
            // Validar que el usuario tenga permisos
            if (!USER_PERMISSIONS || USER_PERMISSIONS.length === 0) {
                Swal.fire({
                    title: 'Sin Permisos',
                    text: 'No tienes permisos asignados para usar el bot de WhatsApp',
                    icon: 'error',
                    confirmButtonColor: '#dc3545'
                });
                return;
            }

            if (whatsappConnected) {
                const result = await Swal.fire({
                    title: '¿Desconectar WhatsApp?',
                    text: 'El bot de WhatsApp está actualmente conectado.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sí, desconectar',
                    cancelButtonText: 'Cancelar'
                });

                if (result.isConfirmed) {
                    await stopWhatsApp();
                }
                return;
            }

            Swal.fire({
                title: 'Iniciando WhatsApp Bot',
                html: `<p>Preparando la conexión...</p><p><small>Rol: ${USER_ROLE} | Permisos: ${USER_PERMISSIONS.join(', ')}</small></p>`,
                icon: 'info',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            updateButtonState('loading', 'Iniciando...');

            try {
                // ENVIAR EL ROL AL SERVIDOR NODE.JS
                const response = await fetch('conexion/whatsapp_proxy_fundacion.php?action=start', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        role: USER_ROLE,
                        permissions: USER_PERMISSIONS
                    })
                });

                const result = await response.json();
                console.log('Respuesta del servidor:', result);
                
                if (result.success) {
                    Swal.close();
                    $('#whatsappModal').modal('show');
                    
                    document.getElementById('loadingQR').style.display = 'block';
                    document.getElementById('qrCode').style.display = 'none';
                    document.getElementById('whatsappReady').style.display = 'none';
                    document.getElementById('qrCode').innerHTML = '';
                    
                    if (!checkingQR) {
                        checkingQR = true;
                        checkForQR();
                    }
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: result.message,
                        icon: 'error',
                        confirmButtonColor: '#007bff'
                    });
                    
                    updateButtonState('error', 'Error de Conexión');
                    setTimeout(() => {
                        updateButtonState('default', 'Iniciar WhatsApp Bot');
                    }, 3000);
                }
            } catch (error) {
                Swal.fire({
                    title: 'Error del Servidor',
                    text: 'No se pudo conectar con el servidor Node.js',
                    icon: 'error',
                    footer: '<small>' + error.message + '</small>'
                });
                
                console.error('Error de conexión:', error);
                updateButtonState('error', 'Error del Servidor');
                
                setTimeout(() => {
                    updateButtonState('default', 'Iniciar WhatsApp Bot');
                }, 5000);
            }
        });

        async function stopWhatsApp() {
            try {
                updateButtonState('loading', 'Desconectando...');
                
                const response = await fetch('conexion/whatsapp_proxy_fundacion.php?action=stop', {
                    method: 'POST'
                });
                
                checkingQR = false;
                whatsappConnected = false;
                
                Toast.fire({
                    icon: 'success',
                    title: 'WhatsApp Desconectado'
                });
                
                updateButtonState('default', 'Iniciar WhatsApp Bot');
                $('#whatsappModal').modal('hide');
                
            } catch (error) {
                console.error('Error stopping bot:', error);
                Toast.fire({
                    icon: 'error',
                    title: 'Error al desconectar'
                });
            }
        }

        async function checkForQR() {
            if (!checkingQR) return;
            
            try {
                const response = await fetch('conexion/whatsapp_proxy_fundacion.php?action=status');
                const data = await response.json();
                
                switch(data.status) {
                    case 'generating_qr':
                        document.getElementById('loadingQR').style.display = 'block';
                        document.getElementById('qrCode').style.display = 'none';
                        document.getElementById('whatsappReady').style.display = 'none';
                        updateButtonState('loading', 'Generando QR...');
                        break;
                        
                    case 'waiting_scan':
                        if (data.qr) {
                            document.getElementById('loadingQR').style.display = 'none';
                            document.getElementById('qrCode').style.display = 'block';
                            document.getElementById('whatsappReady').style.display = 'none';
                            
                            const qrContainer = document.getElementById('qrCode');
                            generateQRCode(qrContainer, data.qr);
                            updateButtonState('loading', 'Esperando escaneo...');
                        }
                        break;
                        
                    case 'connected':
                        document.getElementById('loadingQR').style.display = 'none';
                        document.getElementById('qrCode').style.display = 'none';
                        document.getElementById('whatsappReady').style.display = 'block';
                        
                        whatsappConnected = true;
                        updateButtonState('connected', 'WhatsApp Conectado');
                        checkingQR = false;
                        
                        Swal.fire({
                            title: '¡Conectado!',
                            text: 'WhatsApp Bot funcionando con permisos: ' + USER_PERMISSIONS.join(', '),
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            $('#whatsappModal').modal('hide');
                        });
                        
                        return;
                }
                
                setTimeout(checkForQR, 2000);
                
            } catch (error) {
                console.error('Error checking QR:', error);
                setTimeout(checkForQR, 3000);
            }
        }

        document.getElementById('stopWhatsAppBtn').addEventListener('click', async function() {
            const result = await Swal.fire({
                title: '¿Detener WhatsApp Bot?',
                text: 'Se cerrará la conexión actual del bot',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, detener',
                cancelButtonText: 'Cancelar'
            });

            if (result.isConfirmed) {
                await stopWhatsApp();
            }
        });

        $('#whatsappModal').on('hidden.bs.modal', function () {
            if (!whatsappConnected) {
                checkingQR = false;
                updateButtonState('default', 'Iniciar WhatsApp Bot');
            }
        });
    </script>
</body>
</html>