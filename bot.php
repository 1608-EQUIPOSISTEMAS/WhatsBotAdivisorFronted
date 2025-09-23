<?php
// Incluir la conexión a la base de datos
require_once 'conexion/conexion.php';

// Obtener los datos de la tabla configuraciones
try {
    $sql = "SELECT id, mensaje_bienvenida FROM configuraciones ORDER BY id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $configuraciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $configuraciones = [];
    $error_message = "Error al obtener configuraciones: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Connect Plus</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="index.html"><img src="assets/images/logo.svg" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <div class="search-field d-none d-xl-block">
            <form class="d-flex align-items-center h-100" action="#">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-transparent border-0" placeholder="Search products">
              </div>
            </form>
          </div>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item  dropdown d-none d-md-block">
              <a class="nav-link dropdown-toggle" id="reportDropdown" href="#" data-toggle="dropdown" aria-expanded="false"> Reports </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="reportDropdown">
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-file-pdf mr-2"></i>PDF </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-file-excel mr-2"></i>Excel </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-file-word mr-2"></i>doc </a>
              </div>
            </li>
            <li class="nav-item  dropdown d-none d-md-block">
              <a class="nav-link dropdown-toggle" id="projectDropdown" href="#" data-toggle="dropdown" aria-expanded="false"> Projects </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="projectDropdown">
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-eye-outline mr-2"></i>View Project </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-pencil-outline mr-2"></i>Edit Project </a>
              </div>
            </li>
            <li class="nav-item nav-language dropdown d-none d-md-block">
              <a class="nav-link dropdown-toggle" id="languageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="nav-language-icon">
                  <i class="flag-icon flag-icon-us" title="us" id="us"></i>
                </div>
                <div class="nav-language-text">
                  <p class="mb-1 text-black">English</p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="languageDropdown">
                <a class="dropdown-item" href="#">
                  <div class="nav-language-icon mr-2">
                    <i class="flag-icon flag-icon-ae" title="ae" id="ae"></i>
                  </div>
                  <div class="nav-language-text">
                    <p class="mb-1 text-black">Arabic</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <div class="nav-language-icon mr-2">
                    <i class="flag-icon flag-icon-gb" title="GB" id="gb"></i>
                  </div>
                  <div class="nav-language-text">
                    <p class="mb-1 text-black">English</p>
                  </div>
                </a>
              </div>
            </li>
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="assets/images/faces/face28.png" alt="image">
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black">Henry Klein</p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="profileDropdown" data-x-placement="bottom-end">
                <div class="p-3 text-center bg-primary">
                  <img class="img-avatar img-avatar48 img-avatar-thumb" src="assets/images/faces/face28.png" alt="">
                </div>
                <div class="p-2">
                  <h5 class="dropdown-header text-uppercase pl-2 text-dark">User Options</h5>
                  <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="#">
                    <span>Inbox</span>
                    <span class="p-0">
                      <span class="badge badge-primary">3</span>
                      <i class="mdi mdi-email-open-outline ml-1"></i>
                    </span>
                  </a>
                  <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="#">
                    <span>Profile</span>
                    <span class="p-0">
                      <span class="badge badge-success">1</span>
                      <i class="mdi mdi-account-outline ml-1"></i>
                    </span>
                  </a>
                  <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="javascript:void(0)">
                    <span>Settings</span>
                    <i class="mdi mdi-settings"></i>
                  </a>
                  <div role="separator" class="dropdown-divider"></div>
                  <h5 class="dropdown-header text-uppercase  pl-2 text-dark mt-2">Actions</h5>
                  <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="#">
                    <span>Lock Account</span>
                    <i class="mdi mdi-lock ml-1"></i>
                  </a>
                  <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="#">
                    <span>Log Out</span>
                    <i class="mdi mdi-logout ml-1"></i>
                  </a>
                </div>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-email-outline"></i>
                <span class="count-symbol bg-success"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                <h6 class="p-3 mb-0 bg-primary text-white py-4">Messages</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="assets/images/faces/face4.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
                    <p class="text-gray mb-0"> 1 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="assets/images/faces/face2.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>
                    <p class="text-gray mb-0"> 15 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="assets/images/faces/face3.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>
                    <p class="text-gray mb-0"> 18 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center">4 new messages</h6>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="mdi mdi-bell-outline"></i>
                <span class="count-symbol bg-danger"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <h6 class="p-3 mb-0 bg-primary text-white py-4">Notifications</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="mdi mdi-calendar"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                    <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-warning">
                      <i class="mdi mdi-settings"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                    <p class="text-gray ellipsis mb-0"> Update dashboard </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-info">
                      <i class="mdi mdi-link-variant"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                    <p class="text-gray ellipsis mb-0"> New admin wow! </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center">See all notifications</h6>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php include 'includes/sidebar.php'; ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Mensaje de Bienvenida </h3>
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
                        <p class="card-description"> Configuraciones del sistema</p>
                      </div>
                      <div>
                        <button id="startWhatsAppBtn" class="btn btn-success btn-rounded d-flex align-items-center justify-content-center">
                          <i class="mdi mdi-whatsapp mr-2"></i>
                          Iniciar WhatsApp Bot
                        </button>
                      </div>
                    </div>
                    
                    <?php if (isset($error_message)): ?>
                        <div class="alert alert-danger"><?php echo $error_message; ?></div>
                    <?php endif; ?>
                    
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th> ID </th>
                          <th> Mensaje de Bienvenida </th>
                          <th> Acciones </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (!empty($configuraciones)): ?>
                            <?php foreach ($configuraciones as $config): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($config['id']); ?></td>
                                    <td><?php echo htmlspecialchars($config['mensaje_bienvenida']); ?></td>
                                    <td>
                                        <a href="editar_configuracion.php?id=<?php echo urlencode($config['id']); ?>" 
                                        class="btn btn-outline-primary btn-sm btn-rounded d-flex align-items-center justify-content-center" 
                                        style="min-width: 100px; transition: all 0.3s ease; box-shadow: 0 2px 4px rgba(0,123,255,0.2);"
                                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 8px rgba(0,123,255,0.3)';"
                                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(0,123,255,0.2)';"
                                        title="Editar configuración">
                                            <i class="mdi mdi-pencil-outline mr-2" style="font-size: 16px;"></i>
                                            <span style="font-weight: 500;">Editar</span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center">No hay configuraciones disponibles</td>
                            </tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal WhatsApp QR -->
<div class="modal fade" id="whatsappModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="mdi mdi-whatsapp mr-2"></i>
                    Conectar WhatsApp
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div id="qrContainer">
                    <div id="loadingQR">
                        <div class="spinner-border text-success" role="status"></div>
                        <p class="mt-2">Generando código QR...</p>
                    </div>
                    <div id="qrCode" style="display: none;"></div>
                    <div id="whatsappReady" style="display: none;">
                        <i class="mdi mdi-check-circle text-success" style="font-size: 48px;"></i>
                        <h4 class="text-success mt-2">¡WhatsApp Conectado!</h4>
                        <p>El bot está listo para recibir mensajes</p>
                    </div>
                </div>
                <div class="mt-3">
                    <p><strong>Instrucciones:</strong></p>
                    <ol class="text-left">
                        <li>Abre WhatsApp en tu teléfono</li>
                        <li>Ve a Menú > Dispositivos vinculados</li>
                        <li>Toca "Vincular un dispositivo"</li>
                        <li>Escanea este código QR</li>
                    </ol>
                </div>
            </div>
            <div class="modal-footer">
                <button id="stopWhatsAppBtn" class="btn btn-danger">
                    Detener Bot
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="footer-inner-wraper">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard templates</a> from Bootstrapdash.com</span>
              </div>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    
    <!-- Cargar QRCode library de manera síncrona -->
    <script>

// Configuración dinámica de URLs
const CONFIG = {
    baseUrl: 'https://whatsbotadivisor.onrender.com',
};

// Estado de la aplicación
let appState = {
    checkingQR: false,
    retryCount: 0,
    lastError: null,
    connectionStartTime: null,
    lastQrData: null
};

// Utilidad para hacer requests con timeout
async function fetchWithTimeout(url, options = {}, timeout = CONFIG.timeoutMs) {
    const controller = new AbortController();
    const id = setTimeout(() => controller.abort(), timeout);
    
    try {
        const response = await fetch(url, {
            ...options,
            signal: controller.signal
        });
        clearTimeout(id);
        return response;
    } catch (error) {
        clearTimeout(id);
        throw error;
    }
}

// Función mejorada para cargar librería QR
function loadQRLibrary() {
    return new Promise((resolve) => {
        // Verificar si ya está cargada
        if (typeof qrcode !== 'undefined') {
            window.qrLibraryLoaded = true;
            resolve(true);
            return;
        }
        
        const script = document.createElement('script');
        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/qrcode-generator/1.4.4/qrcode.min.js';
        script.async = true;
        script.onload = () => {
            window.qrLibraryLoaded = true;
            
            // Definir función global para crear QR
            window.createQRCode = function(text, container) {
                try {
                    container.innerHTML = '';
                    const qr = qrcode(0, 'M');
                    qr.addData(text);
                    qr.make();
                    
                    const div = document.createElement('div');
                    div.innerHTML = qr.createImgTag(5, 10);
                    container.appendChild(div);
                    
                    return true;
                } catch (error) {
                    console.error('Error generando QR:', error);
                    return false;
                }
            };
            
            resolve(true);
        };
        script.onerror = () => {
            console.warn('QR library failed to load, using fallback');
            window.qrLibraryLoaded = false;
            resolve(false);
        };
        document.head.appendChild(script);
        
        // Timeout para no esperar indefinidamente
        setTimeout(() => resolve(false), 5000);
    });
}

// Función optimizada para generar QR con fallback a servicio online
function generateQRCode(container, qrData) {
    if (!container || !qrData) return;
    
    // Evitar regenerar el mismo QR
    if (qrData === appState.lastQrData) return;
    appState.lastQrData = qrData;
    
    try {
        // Intentar usar la librería local si está disponible
        if (window.qrLibraryLoaded && window.createQRCode) {
            const success = window.createQRCode(qrData, container);
            if (success) {
                console.log('QR generado con librería local');
                return;
            }
        }
    } catch (error) {
        console.error('Error con librería local:', error);
    }
    
    // Fallback: Usar servicio de QR online (más rápido en Render)
    container.innerHTML = `
        <div class="qr-container">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodeURIComponent(qrData)}" 
                 alt="QR Code" 
                 class="img-fluid"
                 style="max-width: 100%; height: auto; border: 2px solid #28a745; padding: 10px; background: white;">
            <p class="text-muted mt-3">
                <i class="mdi mdi-qrcode-scan"></i> Escanea este código con WhatsApp
            </p>
        </div>
    `;
    console.log('QR generado con servicio online');
}

// Función para mostrar estado visual
function updateStatusIndicator(status, message) {
    // Actualizar botón principal
    const startBtn = document.getElementById('startWhatsAppBtn');
    if (startBtn) {
        switch(status) {
            case 'connecting':
                startBtn.innerHTML = '<i class="mdi mdi-loading mdi-spin mr-2"></i>Conectando...';
                startBtn.disabled = true;
                break;
            case 'connected':
                startBtn.innerHTML = '<i class="mdi mdi-whatsapp mr-2"></i>WhatsApp Conectado';
                startBtn.classList.remove('btn-success');
                startBtn.classList.add('btn-outline-success');
                startBtn.disabled = false;
                break;
            case 'error':
                startBtn.innerHTML = '<i class="mdi mdi-whatsapp mr-2"></i>Iniciar WhatsApp Bot';
                startBtn.classList.add('btn-success');
                startBtn.classList.remove('btn-outline-success');
                startBtn.disabled = false;
                break;
        }
    }
    
    // Mostrar mensaje temporal si hay
    if (message) {
        console.log(`[${status.toUpperCase()}] ${message}`);
    }
}

// Función principal para iniciar WhatsApp
async function startWhatsApp() {
    try {
        // Resetear estado
        appState.checkingQR = false;
        appState.retryCount = 0;
        appState.connectionStartTime = Date.now();
        appState.lastQrData = null;
        
        // Mostrar modal
        $('#whatsappModal').modal('show');
        updateStatusIndicator('connecting', 'Iniciando conexión...');
        
        // Pre-cargar librería QR mientras se conecta
        loadQRLibrary();
        
        // UI inicial
        document.getElementById('loadingQR').style.display = 'block';
        document.getElementById('qrCode').style.display = 'none';
        document.getElementById('whatsappReady').style.display = 'none';
        document.getElementById('qrCode').innerHTML = '';
        
        console.log(`🚀 Conectando a: ${CONFIG.baseUrl}`);
        
        // Iniciar servidor con timeout más largo para Render
        const response = await fetchWithTimeout(
            `${CONFIG.baseUrl}/start-whatsapp`,
            { 
                method: 'POST',
                headers: { 'Content-Type': 'application/json' }
            },
            20000 // 20 segundos para Render
        );
        
        if (!response.ok) {
            throw new Error(`HTTP ${response.status}`);
        }
        
        const result = await response.json();
        console.log('✅ Respuesta del servidor:', result);
        
        if (result.success) {
            appState.checkingQR = true;
            // Esperar un poco antes de empezar polling
            setTimeout(() => checkForQR(), 1500);
        } else {
            throw new Error(result.message || 'Error desconocido');
        }
        
    } catch (error) {
        console.error('❌ Error:', error);
        appState.lastError = error.message;
        
        let errorMsg = 'Error al conectar';
        if (error.name === 'AbortError') {
            errorMsg = 'El servidor está tardando mucho. Intenta de nuevo en unos segundos.';
        } else if (error.message.includes('Failed to fetch')) {
            errorMsg = 'No se puede conectar al servidor. Verifica que esté activo.';
        } else {
            errorMsg = error.message;
        }
        
        updateStatusIndicator('error', errorMsg);
        
        // Mostrar error en el modal
        document.getElementById('loadingQR').innerHTML = `
            <div class="alert alert-warning">
                <i class="mdi mdi-alert mr-2"></i>${errorMsg}
            </div>
            <button class="btn btn-primary mt-2" onclick="retryConnection()">
                <i class="mdi mdi-refresh mr-2"></i>Reintentar
            </button>
        `;
        
        // Auto-retry si es timeout
        if (error.name === 'AbortError' && appState.retryCount < CONFIG.maxRetries) {
            appState.retryCount++;
            setTimeout(() => {
                console.log(`Reintento ${appState.retryCount}/${CONFIG.maxRetries}...`);
                startWhatsApp();
            }, 3000);
        }
    }
}

// Función para reintentar conexión
function retryConnection() {
    appState.retryCount = 0;
    startWhatsApp();
}

// Función optimizada para verificar QR
async function checkForQR() {
    if (!appState.checkingQR) return;
    
    try {
        const response = await fetchWithTimeout(
            `${CONFIG.baseUrl}/get-qr`,
            { method: 'GET' },
            5000 // 5 segundos para polling
        );
        
        if (!response.ok) {
            throw new Error(`HTTP ${response.status}`);
        }
        
        const data = await response.json();
        
        // Log solo si hay cambios
        if (data.status !== window.lastStatus) {
            console.log('📊 Estado:', data.status, data.memory ? `| RAM: ${data.memory}` : '');
            window.lastStatus = data.status;
        }
        
        switch(data.status) {
            case 'generating_qr':
                document.getElementById('loadingQR').style.display = 'block';
                document.getElementById('qrCode').style.display = 'none';
                document.getElementById('whatsappReady').style.display = 'none';
                document.getElementById('loadingQR').innerHTML = `
                    <div class="spinner-border text-success" role="status"></div>
                    <p class="mt-2">Generando código QR...</p>
                    <small class="text-muted">Tiempo: ${Math.round((Date.now() - appState.connectionStartTime) / 1000)}s</small>
                `;
                break;
                
            case 'waiting_scan':
                if (data.qr) {
                    document.getElementById('loadingQR').style.display = 'none';
                    document.getElementById('qrCode').style.display = 'block';
                    document.getElementById('whatsappReady').style.display = 'none';
                    
                    const qrContainer = document.getElementById('qrCode');
                    generateQRCode(qrContainer, data.qr);
                }
                break;
                
            case 'connected':
                document.getElementById('loadingQR').style.display = 'none';
                document.getElementById('qrCode').style.display = 'none';
                document.getElementById('whatsappReady').style.display = 'block';
                
                updateStatusIndicator('connected', '¡Conectado exitosamente!');
                appState.checkingQR = false;
                
                // Auto-cerrar modal después de 3 segundos
                setTimeout(() => {
                    $('#whatsappModal').modal('hide');
                }, 3000);
                return;
                
            case 'disconnected':
                document.getElementById('loadingQR').style.display = 'block';
                document.getElementById('loadingQR').innerHTML = `
                    <div class="alert alert-info">
                        <i class="mdi mdi-information mr-2"></i>
                        WhatsApp desconectado. Iniciando reconexión...
                    </div>
                `;
                document.getElementById('qrCode').style.display = 'none';
                document.getElementById('whatsappReady').style.display = 'none';
                break;
        }
        
        // Resetear contador si todo va bien
        if (data.status !== 'disconnected') {
            appState.retryCount = 0;
        }
        
        // Polling adaptativo - más lento cuando está esperando scan
        const nextInterval = data.status === 'waiting_scan' ? 4000 : CONFIG.pollInterval;
        setTimeout(checkForQR, nextInterval);
        
    } catch (error) {
        console.error('Error checking QR:', error);
        
        // Manejar errores de red con reintentos
        if (appState.retryCount < CONFIG.maxRetries) {
            appState.retryCount++;
            console.log(`Reconectando... (${appState.retryCount}/${CONFIG.maxRetries})`);
            setTimeout(checkForQR, 5000);
        } else {
            updateStatusIndicator('error', 'Conexión perdida');
            appState.checkingQR = false;
            
            document.getElementById('loadingQR').innerHTML = `
                <div class="alert alert-danger">
                    <i class="mdi mdi-wifi-off mr-2"></i>
                    Conexión perdida con el servidor
                </div>
                <button class="btn btn-primary mt-2" onclick="retryConnection()">
                    <i class="mdi mdi-refresh mr-2"></i>Reintentar
                </button>
            `;
        }
    }
}

// Función para detener WhatsApp
async function stopWhatsApp() {
    try {
        appState.checkingQR = false;
        
        await fetchWithTimeout(
            `${CONFIG.baseUrl}/stop-whatsapp`,
            { method: 'POST' },
            5000
        );
        
        updateStatusIndicator('error', 'WhatsApp detenido');
        $('#whatsappModal').modal('hide');
        
    } catch (error) {
        console.error('Error stopping bot:', error);
        $('#whatsappModal').modal('hide');
    }
}

// Event Listeners cuando el DOM está listo
document.addEventListener('DOMContentLoaded', function() {
    console.log('🔧 Configuración: ', CONFIG);
    
    // Pre-cargar librería QR
    loadQRLibrary().then(loaded => {
        console.log('📚 Librería QR:', loaded ? 'Cargada' : 'Usando fallback');
    });
    
    // Verificar estado inicial del servidor
    fetchWithTimeout(`${CONFIG.baseUrl}/health`, {}, 3000)
        .then(res => res.json())
        .then(data => {
            console.log('✅ Servidor activo:', data);
            if (data.whatsappStatus === 'connected') {
                updateStatusIndicator('connected', 'Ya conectado');
            }
        })
        .catch(err => {
            console.warn('⚠️ Servidor no responde:', err.message);
            console.log('💡 Asegúrate de que el servidor Node.js esté corriendo');
        });
    
    // Botón iniciar
    const startBtn = document.getElementById('startWhatsAppBtn');
    if (startBtn) {
        startBtn.addEventListener('click', startWhatsApp);
    }
    
    // Botón detener  
    const stopBtn = document.getElementById('stopWhatsAppBtn');
    if (stopBtn) {
        stopBtn.addEventListener('click', stopWhatsApp);
    }
    
    // Limpiar al cerrar modal
    $('#whatsappModal').on('hidden.bs.modal', function () {
        appState.checkingQR = false;
        appState.connectionStartTime = null;
        appState.lastQrData = null;
    });
    
    // Hacer funciones globales para debug
    window.appState = appState;
    window.CONFIG = CONFIG;
});
    </script>
  </body>
</html>