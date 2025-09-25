<?php
session_start();
// Incluir la conexión a la base de datos
require_once 'conexion/conexion.php';

// Obtener los datos de la tabla configuraciones
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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Connect Plus</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">
    
    <!-- Custom styles for better UX -->
    <style>
      .swal2-popup {
        border-radius: 15px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
      }
      
      .swal2-title {
        font-size: 1.5rem;
        font-weight: 600;
      }
      
      .swal2-content {
        font-size: 1rem;
        line-height: 1.5;
      }
      
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
      
      .status-loading {
        color: #ffc107;
        animation: pulse 2s infinite;
      }
      
      .status-connected {
        color: #28a745;
      }
      
      .status-error {
        color: #dc3545;
      }
      
      @keyframes pulse {
        0% { opacity: 1; }
        50% { opacity: 0.5; }
        100% { opacity: 1; }
      }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <?php include 'includes/header.php'; ?>

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
                        <button id="startWhatsAppBtn" class="btn btn-whatsapp btn-rounded d-flex align-items-center justify-content-center" style="color: white;">
                          <i class="mdi mdi-whatsapp mr-2"></i>
                          <span id="btnText" >Iniciar WhatsApp Bot</span>
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
                                            class="btn btn-outline-primary btn-sm btn-rounded d-flex align-items-center justify-content-center"
                                            style="min-width: 100px; transition: all 0.3s ease; box-shadow: 0 2px 4px rgba(0,123,255,0.2);"
                                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 8px rgba(0,123,255,0.3)';"
                                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(0,123,255,0.2)';"
                                            title="Editar configuración"
                                            data-toggle="modal"
                                            data-target="#editarModal"
                                            data-id="<?php echo htmlspecialchars($config['id']); ?>"
                                            data-palabra="<?php echo htmlspecialchars($config['palabra_clave']); ?>"
                                            data-mensaje="<?php echo htmlspecialchars($config['mensaje_bienvenida']); ?>"
                                          >
                                            <i class="mdi mdi-pencil-outline mr-2" style="font-size: 16px;"></i>
                                            <span style="font-weight: 500;">Editar</span>
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

    <!-- Scripts -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
    
    <script>
      // Configuración global de SweetAlert2
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      });

      // Variable global para verificar carga
      let qrLibraryLoaded = false;
      let checkingQR = false;
      let whatsappConnected = false;

      // Cargar QRCode library y esperar a que esté disponible
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
                          
                          console.log('QR generado exitosamente');
                          return true;
                      } catch (error) {
                          console.error('Error generando QR:', error);
                          return false;
                      }
                  };
                  
                  qrLibraryLoaded = true;
                  resolve();
              };
              script.onerror = () => {
                  reject(new Error('Failed to load QR library'));
              };
              document.head.appendChild(script);
          });
      }

      // Función para generar QR
      function generateQRCode(container, qrData) {
          if (qrLibraryLoaded && window.createQRCode) {
              const success = window.createQRCode(qrData, container);
              if (!success) {
                  showTextQR(container, qrData);
              }
          } else {
              showTextQR(container, qrData);
          }
      }

      // Mostrar QR como texto (fallback)
      function showTextQR(container, qrData) {
          container.innerHTML = `
              <div class="alert alert-info text-center">
                  <i class="mdi mdi-qrcode-scan mb-3" style="font-size: 2rem;"></i>
                  <p><strong>Código QR:</strong></p>
                  <textarea class="form-control" rows="4" readonly style="font-size: 10px;">${qrData}</textarea>
                  <small class="text-muted mt-2 d-block">Usa una app generadora de QR para convertir este texto en imagen</small>
              </div>`;
      }

      // Función para mostrar estado del botón
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

      // Cargar librería al iniciar
      document.addEventListener('DOMContentLoaded', function() {
          loadQRLibrary().catch(error => {
              console.warn('QR library failed to load:', error);
              Toast.fire({
                  icon: 'warning',
                  title: 'Advertencia',
                  text: 'La librería QR no se pudo cargar completamente'
              });
          });

          // Verificar estado inicial
          checkWhatsAppStatus();
      });

      // Función para verificar estado inicial de WhatsApp
      async function checkWhatsAppStatus() {
          try {
              const response = await fetch('conexion/whatsapp_proxy.php?action=status');
              const data = await response.json();
              
              if (data.status === 'connected') {
                  whatsappConnected = true;
                  updateButtonState('connected', 'WhatsApp Conectado');
                  Toast.fire({
                      icon: 'success',
                      title: 'WhatsApp ya está conectado',
                      text: 'El bot está funcionando correctamente'
                  });
              }
          } catch (error) {
              console.log('WhatsApp no está conectado inicialmente');
          }
      }

      // Evento del botón principal
      document.getElementById('startWhatsAppBtn').addEventListener('click', async function() {
          if (whatsappConnected) {
              // Si ya está conectado, preguntar si quiere desconectar
              const result = await Swal.fire({
                  title: '¿Desconectar WhatsApp?',
                  text: 'El bot de WhatsApp está actualmente conectado. ¿Deseas desconectarlo?',
                  icon: 'question',
                  showCancelButton: true,
                  confirmButtonColor: '#dc3545',
                  cancelButtonColor: '#6c757d',
                  confirmButtonText: 'Sí, desconectar',
                  cancelButtonText: 'Cancelar',
                  reverseButtons: true
              });

              if (result.isConfirmed) {
                  await stopWhatsApp();
              }
              return;
          }

          // Mostrar alerta de inicio
          Swal.fire({
              title: 'Iniciando WhatsApp Bot',
              text: 'Preparando la conexión...',
              icon: 'info',
              allowOutsideClick: false,
              showConfirmButton: false,
              didOpen: () => {
                  Swal.showLoading();
              }
          });

          updateButtonState('loading', 'Iniciando...');

          try {
              console.log('Iniciando WhatsApp...');

              const response = await fetch('conexion/whatsapp_proxy.php?action=start', {
                  method: 'POST'
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
                  // Manejar diferentes tipos de error
                  const errorTitle = result.message.includes('ya está') ? 'WhatsApp ya está activo' : 'Error de Conexión';
                  const showCleanupOption = result.message.includes('Error al iniciar') || result.message.includes('Sesión limpiada');
                  
                  const swalConfig = {
                      title: errorTitle,
                      text: result.message,
                      icon: showCleanupOption ? 'warning' : 'error',
                      confirmButtonColor: '#007bff',
                      confirmButtonText: 'Entendido'
                  };

                  // Agregar opción de limpieza si es necesario
                  if (showCleanupOption) {
                      swalConfig.showCancelButton = true;
                      swalConfig.cancelButtonColor = '#28a745';
                      swalConfig.cancelButtonText = 'Limpiar Sesión';
                      swalConfig.confirmButtonText = 'Intentar de Nuevo';
                  }

                  const alertResult = await Swal.fire(swalConfig);
                  
                  // Si eligió limpiar sesión
                  if (alertResult.dismiss === Swal.DismissReason.cancel && showCleanupOption) {
                      await cleanupSession();
                      return;
                  }
                  
                  updateButtonState('error', 'Error de Conexión');
                  
                  // Volver al estado normal después de 3 segundos
                  setTimeout(() => {
                      updateButtonState('default', 'Iniciar WhatsApp Bot');
                  }, 3000);
              }
          } catch (error) {
              Swal.fire({
                  title: 'Error del Servidor',
                  text: 'No se pudo conectar con el servidor Node.js. Verifica que esté ejecutándose en el puerto 3000.',
                  icon: 'error',
                  footer: '<small>Detalles técnicos: ' + error.message + '</small>',
                  showCancelButton: true,
                  confirmButtonColor: '#007bff',
                  cancelButtonColor: '#28a745',
                  confirmButtonText: 'Entendido',
                  cancelButtonText: 'Limpiar Sesión'
              }).then(async (result) => {
                  if (result.dismiss === Swal.DismissReason.cancel) {
                      await cleanupSession();
                  }
              });
              
              console.error('Error de conexión:', error);
              updateButtonState('error', 'Error del Servidor');
              
              // Volver al estado normal después de 5 segundos
              setTimeout(() => {
                  updateButtonState('default', 'Iniciar WhatsApp Bot');
              }, 5000);
          }
      });

      // Función para limpiar sesión manualmente
      async function cleanupSession() {
          try {
              Swal.fire({
                  title: 'Limpiando Sesión',
                  text: 'Eliminando archivos de sesión corruptos...',
                  icon: 'info',
                  allowOutsideClick: false,
                  showConfirmButton: false,
                  didOpen: () => {
                      Swal.showLoading();
                  }
              });

              const response = await fetch('conexion/whatsapp_proxy.php?action=cleanup', {
                  method: 'POST'
              });

              const result = await response.json();
              
              if (result.success) {
                  Swal.fire({
                      title: '¡Sesión Limpiada!',
                      text: 'Ahora puedes intentar conectar WhatsApp nuevamente',
                      icon: 'success',
                      confirmButtonColor: '#28a745',
                      confirmButtonText: 'Perfecto'
                  });
                  
                  updateButtonState('default', 'Iniciar WhatsApp Bot');
                  
              } else {
                  throw new Error(result.message || 'Error limpiando sesión');
              }
              
          } catch (error) {
              console.error('Error limpiando sesión:', error);
              
              Swal.fire({
                  title: 'Error en Limpieza',
                  text: 'No se pudo limpiar la sesión: ' + error.message,
                  icon: 'error',
                  confirmButtonColor: '#dc3545',
                  confirmButtonText: 'Entendido'
              });
          }
      }

      // Función para detener WhatsApp
      async function stopWhatsApp() {
          try {
              updateButtonState('loading', 'Desconectando...');
              
              const response = await fetch('conexion/whatsapp_proxy.php?action=stop', {
                  method: 'POST'
              });
              
              checkingQR = false;
              whatsappConnected = false;
              
              Toast.fire({
                  icon: 'success',
                  title: 'WhatsApp Desconectado',
                  text: 'El bot se ha desconectado correctamente'
              });
              
              updateButtonState('default', 'Iniciar WhatsApp Bot');
              $('#whatsappModal').modal('hide');
              
          } catch (error) {
              console.error('Error stopping bot:', error);
              Toast.fire({
                  icon: 'error',
                  title: 'Error',
                  text: 'Error al desconectar el bot'
              });
              $('#whatsappModal').modal('hide');
          }
      }

      async function checkForQR() {
          if (!checkingQR) return;
          
          try {
              const response = await fetch('conexion/whatsapp_proxy.php?action=status');
              const data = await response.json();
              
              console.log('Estado actual:', data);
              
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
                      
                      // Mostrar alerta de éxito y cerrar modal automáticamente
                      Swal.fire({
                          title: '¡Conectado!',
                          text: 'WhatsApp Bot está funcionando correctamente',
                          icon: 'success',
                          timer: 2000,
                          showConfirmButton: false
                      }).then(() => {
                          $('#whatsappModal').modal('hide');
                      });
                      
                      return;
                      
                  case 'disconnected':
                      document.getElementById('loadingQR').style.display = 'block';
                      document.getElementById('qrCode').style.display = 'none';
                      document.getElementById('whatsappReady').style.display = 'none';
                      updateButtonState('loading', 'Reconectando...');
                      break;
              }
              
              setTimeout(checkForQR, 2000);
              
          } catch (error) {
              console.error('Error checking QR:', error);
              
              Toast.fire({
                  icon: 'error',
                  title: 'Error de conexión',
                  text: 'Error verificando el estado de WhatsApp'
              });
              
              setTimeout(checkForQR, 3000);
          }
      }

      // Evento del botón de parar en el modal
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

      // Limpiar estado al cerrar modal
      $('#whatsappModal').on('hidden.bs.modal', function () {
          if (!whatsappConnected) {
              checkingQR = false;
              updateButtonState('default', 'Iniciar WhatsApp Bot');
          }
      });

      // Mostrar alerta si hay error PHP
      <?php if (isset($error_message)): ?>
      document.addEventListener('DOMContentLoaded', function() {
          Swal.fire({
              title: 'Error de Base de Datos',
              text: '<?php echo addslashes($error_message); ?>',
              icon: 'error',
              confirmButtonColor: '#007bff',
              confirmButtonText: 'Entendido'
          });
      });
      <?php endif; ?>
    </script>
  </body>
</html>