<?php
session_start();

// Incluir la conexión a la base de datos
require_once 'conexion/conexion.php';

// Obtener los datos de bot_foundation
try {
    $sql = "SELECT id, welcome, presentation_route, brochure_route, modality_first_route, modality_second_route, sesion, inversion_route, key_words, final_text FROM bot_foundation WHERE id = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $bot = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $bot = null;
    $error_message = "Error al obtener datos: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Connect Plus - Bot Foundation</title>
    
    <!-- CSS Dependencies -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">
    
    <!-- Minimalist Custom Styles -->
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background-color: #fafafa;
            color: #2c3e50;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .content-wrapper {
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 3rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 300;
            color: #2c3e50;
            margin: 0;
            letter-spacing: -0.02em;
        }

        .breadcrumb-simple {
            font-size: 0.9rem;
            color: #95a5a6;
            margin-top: 1rem;
        }

        .breadcrumb-simple a {
            color: #3498db;
            text-decoration: none;
        }

        .bot-container {
            background: white;
            border-radius: 8px;
            border: 1px solid #e8e8e8;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .bot-header {
            padding: 2rem;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .bot-title {
            font-size: 1.8rem;
            font-weight: 300;
            color: #2c3e50;
            margin: 0;
        }

        .info-section {
            padding: 2rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 1.5rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .info-item.full-width {
            grid-column: 1 / -1;
        }

        .info-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: #7f8c8d;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .info-label i {
            font-size: 1rem;
            color: #bdc3c7;
        }

        .info-content {
            font-size: 1rem;
            color: #2c3e50;
            line-height: 1.6;
            background: #f9f9f9;
            padding: 1rem;
            border-radius: 4px;
            border-left: 3px solid #e0e0e0;
        }

        .info-content.code {
            font-family: 'SF Mono', Monaco, monospace;
            font-size: 0.9rem;
            color: #34495e;
            background: #f8f8f8;
        }

        /* File Components */
        .file-path {
            font-family: 'SF Mono', Monaco, 'Cascadia Code', 'Consolas', monospace;
            font-size: 0.85rem;
            color: #7f8c8d;
            background: #f5f5f5;
            padding: 0.5rem 0.75rem;
            border-radius: 3px;
            margin-bottom: 1rem;
            border: 1px solid #e8e8e8;
        }

        .file-preview {
            margin-top: 1rem;
        }

        .image-preview {
            max-width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #e8e8e8;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            transition: transform 0.2s ease;
        }

        .image-preview:hover {
            transform: scale(1.02);
            cursor: pointer;
        }

        .file-error {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #e74c3c;
            background: #fdf2f2;
            padding: 1rem;
            border-radius: 4px;
            border: 1px solid #f5b7b1;
            font-size: 0.9rem;
        }

        .file-error i {
            font-size: 1.2rem;
        }

        .file-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        .file-action-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            border: 1px solid #e8e8e8;
            background: white;
        }

        .file-action-btn:hover {
            text-decoration: none;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .view-btn {
            color: #3498db;
            border-color: #3498db;
        }

        .view-btn:hover {
            background: #3498db;
            color: white;
        }

        .download-btn {
            color: #27ae60;
            border-color: #27ae60;
        }

        .download-btn:hover {
            background: #27ae60;
            color: white;
        }

        .btn-minimal {
            background: #3498db;
            color: white;
            border: none;
            padding: 0.7rem 1.5rem;
            border-radius: 4px;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-minimal:hover {
            background: #2980b9;
            color: white;
        }

        .alert-minimal {
            background: #fdf2f2;
            border: 1px solid #f5b7b1;
            color: #c0392b;
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 2rem;
            font-size: 0.95rem;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 8px;
            border: 1px solid #e8e8e8;
        }

        .empty-state i {
            font-size: 3rem;
            color: #bdc3c7;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .content-wrapper {
                padding: 1rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .bot-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="container-scroller">
        <?php include 'includes/header.php'; ?>
        <div class="container-fluid page-body-wrapper">
            <?php include 'includes/sidebar.php'; ?>
            
            <div class="main-panel">
                <div class="content-wrapper" style="background: none;">
                    
                    <div class="page-header">
                        <h1 class="page-title">Configuración Bot Foundation</h1>
                        <div class="breadcrumb-simple">
                            <a href="#">Dashboard</a> / <a href="#">Bot</a> / Foundation
                        </div>
                    </div>

                    <?php if (isset($error_message)): ?>
                        <div class="alert-minimal">
                            <i class="mdi mdi-alert-circle"></i>
                            <strong>Error:</strong> <?php echo htmlspecialchars($error_message); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($bot): ?>
                        <div class="bot-container">
                            <div class="bot-header">
                                <h2 class="bot-title">Configuración del Bot</h2>
                                <button 
                                    class="btn-minimal"
                                    data-toggle="modal"
                                    data-target="#editarBotModal"
                                    data-id="<?php echo htmlspecialchars($bot['id']); ?>"
                                >
                                    <i class="mdi mdi-pencil"></i>
                                    Editar Configuración
                                </button>
                            </div>

                            <div class="info-section">
                                <div class="info-grid">
                                    
                                    <!-- Welcome -->
                                    <div class="info-item full-width">
                                        <div class="info-label">
                                            <i class="mdi mdi-message-text"></i>
                                            Mensaje de Bienvenida
                                        </div>
                                        <div class="info-content">
                                            <?php echo nl2br(htmlspecialchars($bot['welcome'])); ?>
                                        </div>
                                    </div>

                                    <!-- Presentation Image -->
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="mdi mdi-image"></i>
                                            Imagen Presentación
                                        </div>
                                        <div class="info-content">
                                            <div class="file-path"><?php echo htmlspecialchars($bot['presentation_route']); ?></div>
                                            <div class="file-preview">
                                                <img 
                                                    src="<?php echo htmlspecialchars($bot['presentation_route']); ?>" 
                                                    alt="Presentación"
                                                    class="image-preview"
                                                    loading="lazy"
                                                    onerror="this.parentElement.innerHTML='<div class=\'file-error\'><i class=\'mdi mdi-image-broken\'></i><span>Imagen no encontrada</span></div>'"
                                                >
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Brochure PDF -->
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="mdi mdi-file-pdf"></i>
                                            Brochure PDF
                                        </div>
                                        <div class="info-content">
                                            <div class="file-path"><?php echo htmlspecialchars($bot['brochure_route']); ?></div>
                                            <div class="file-actions">
                                                <a href="<?php echo htmlspecialchars($bot['brochure_route']); ?>" 
                                                   target="_blank" 
                                                   class="file-action-btn view-btn"
                                                   title="Ver PDF">
                                                    <i class="mdi mdi-eye"></i>
                                                    Ver
                                                </a>
                                                <a href="<?php echo htmlspecialchars($bot['brochure_route']); ?>" 
                                                   download 
                                                   class="file-action-btn download-btn"
                                                   title="Descargar PDF">
                                                    <i class="mdi mdi-download"></i>
                                                    Descargar
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modality First Image -->
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="mdi mdi-numeric-1-box"></i>
                                            Imagen Modalidad 1
                                        </div>
                                        <div class="info-content">
                                            <div class="file-path"><?php echo htmlspecialchars($bot['modality_first_route']); ?></div>
                                            <div class="file-preview">
                                                <img 
                                                    src="<?php echo htmlspecialchars($bot['modality_first_route']); ?>" 
                                                    alt="Modalidad 1"
                                                    class="image-preview"
                                                    loading="lazy"
                                                    onerror="this.parentElement.innerHTML='<div class=\'file-error\'><i class=\'mdi mdi-image-broken\'></i><span>Imagen no encontrada</span></div>'"
                                                >
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modality Second Image -->
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="mdi mdi-numeric-2-box"></i>
                                            Imagen Modalidad 2
                                        </div>
                                        <div class="info-content">
                                            <div class="file-path"><?php echo htmlspecialchars($bot['modality_second_route']); ?></div>
                                            <div class="file-preview">
                                                <img 
                                                    src="<?php echo htmlspecialchars($bot['modality_second_route']); ?>" 
                                                    alt="Modalidad 2"
                                                    class="image-preview"
                                                    loading="lazy"
                                                    onerror="this.parentElement.innerHTML='<div class=\'file-error\'><i class=\'mdi mdi-image-broken\'></i><span>Imagen no encontrada</span></div>'"
                                                >
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Inversion PDF -->
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="mdi mdi-chart-line"></i>
                                            Inversión PDF
                                        </div>
                                        <div class="info-content">
                                            <div class="file-path"><?php echo htmlspecialchars($bot['inversion_route']); ?></div>
                                            <div class="file-actions">
                                                <a href="<?php echo htmlspecialchars($bot['inversion_route']); ?>" 
                                                   target="_blank" 
                                                   class="file-action-btn view-btn"
                                                   title="Ver PDF">
                                                    <i class="mdi mdi-eye"></i>
                                                    Ver
                                                </a>
                                                <a href="<?php echo htmlspecialchars($bot['inversion_route']); ?>" 
                                                   download 
                                                   class="file-action-btn download-btn"
                                                   title="Descargar PDF">
                                                    <i class="mdi mdi-download"></i>
                                                    Descargar
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Sesion -->
                                    <div class="info-item full-width">
                                        <div class="info-label">
                                            <i class="mdi mdi-calendar-clock"></i>
                                            Sesión
                                        </div>
                                        <div class="info-content">
                                            <?php echo nl2br(htmlspecialchars($bot['sesion'])); ?>
                                        </div>
                                    </div>

                                    <!-- Key Words -->
                                    <div class="info-item full-width">
                                        <div class="info-label">
                                            <i class="mdi mdi-key"></i>
                                            Palabras Clave
                                        </div>
                                        <div class="info-content">
                                            <?php echo nl2br(htmlspecialchars($bot['key_words'])); ?>
                                        </div>
                                    </div>

                                    <!-- Final Text -->
                                    <div class="info-item full-width">
                                        <div class="info-label">
                                            <i class="mdi mdi-text-box"></i>
                                            Texto Final
                                        </div>
                                        <div class="info-content">
                                            <?php echo nl2br(htmlspecialchars($bot['final_text'])); ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    <?php else: ?>
                        <div class="empty-state">
                            <i class="mdi mdi-robot-confused"></i>
                            <h3>Configuración no encontrada</h3>
                            <p>No se encontró la configuración del bot en la base de datos.</p>
                        </div>
                    <?php endif; ?>

                </div>
                
                <?php include 'includes/footer.php'; ?>
            </div>
        </div>
    </div>

    <?php include 'modals/fundacion/editar.php'; ?>

    <!-- Scripts -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
    
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });

        <?php if (isset($error_message)): ?>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Error de Conexión',
                text: '<?php echo addslashes($error_message); ?>',
                icon: 'error',
                confirmButtonColor: '#3498db',
                confirmButtonText: 'Entendido'
            });
        });
        <?php endif; ?>

        // Submit form con AJAX
function submitBotForm() {
    const form = document.getElementById('formEditarBot');
    const formData = new FormData(form);
    
    Swal.fire({
        title: '¿Guardar cambios?',
        text: 'Se actualizará la configuración del bot',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3498db',
        cancelButtonColor: '#95a5a6',
        confirmButtonText: 'Guardar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Guardando...',
                text: 'Procesando los cambios',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            $.ajax({
                url: 'acciones/fundacion/editar.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    Swal.close();
                    
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Guardado!',
                            text: response.message || 'Configuración actualizada correctamente',
                            confirmButtonColor: '#3498db',
                            timer: 2000
                        }).then(() => {
                            $('#editarBotModal').modal('hide');
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message || 'No se pudo actualizar',
                            confirmButtonColor: '#3498db'
                        });
                    }
                },
                error: function() {
                    Swal.close();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de conexión',
                        text: 'No se pudo conectar con el servidor',
                        confirmButtonColor: '#3498db'
                    });
                }
            });
        }
    });
}
    </script>
</body>
</html>