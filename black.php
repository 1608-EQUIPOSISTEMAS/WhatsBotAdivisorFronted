<?php
session_start();


// Incluir la conexión a la base de datos
require_once 'conexion/conexion.php';

// Obtener los datos de la tabla members (solo id)
try {
    $sql = "SELECT id, nombre, ruta_post, beneficio, ruta_pdf, precio FROM members where id = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $members = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $nombreplan = htmlspecialchars($members[0]['nombre']);
} catch (PDOException $e) {
    $members = [];
    $error_message = "Error al obtener members: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Connect Plus - <?php echo isset($nombreplan) ? $nombreplan : 'Plan'; ?></title>
    
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
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Simple Header */
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

        .page-subtitle {
            color: #7f8c8d;
            font-size: 1rem;
            margin-top: 0.5rem;
            font-weight: 400;
        }

        /* Clean breadcrumb */
        .breadcrumb-simple {
            font-size: 0.9rem;
            color: #95a5a6;
            margin-top: 1rem;
        }

        .breadcrumb-simple a {
            color: #3498db;
            text-decoration: none;
        }

        .breadcrumb-simple a:hover {
            text-decoration: underline;
        }

        /* Main Card Container */
        .plan-container {
            background: white;
            border-radius: 8px;
            border: 1px solid #e8e8e8;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        /* Plan Header - Minimal */
        .plan-header {
            padding: 2rem;
            border-bottom: 1px solid #f0f0f0;
            text-align: center;
        }

        .plan-name {
            font-size: 2.2rem;
            font-weight: 200;
            color: #2c3e50;
            margin: 0;
            letter-spacing: -0.02em;
        }

        .plan-id-badge {
            display: inline-block;
            background: #ecf0f1;
            color: #7f8c8d;
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.85rem;
            margin-top: 0.8rem;
            font-weight: 500;
        }

        /* Information Grid - Minimal */
        .info-section {
            padding: 2rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
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
            font-family: 'SF Mono', Monaco, 'Cascadia Code', 'Consolas', monospace;
            font-size: 0.9rem;
            color: #34495e;
            background: #f8f8f8;
            border-left-color: #95a5a6;
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

        /* Action Footer */
        .action-footer {
            padding: 1.5rem 2rem;
            background: #fcfcfc;
            border-top: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stats-row {
            display: flex;
            gap: 2rem;
        }

        .stat {
            text-align: left;
        }

        .stat-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .stat-label {
            font-size: 0.8rem;
            color: #95a5a6;
            margin-top: 0.2rem;
        }

        /* Clean Button */
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

        .btn-minimal:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        /* Empty State */
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

        .empty-state h3 {
            font-weight: 400;
            color: #7f8c8d;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: #95a5a6;
            margin-bottom: 2rem;
        }

        /* Error Alert - Minimal */
        .alert-minimal {
            background: #fdf2f2;
            border: 1px solid #f5b7b1;
            color: #c0392b;
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 2rem;
            font-size: 0.95rem;
        }

        .alert-minimal i {
            margin-right: 0.5rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .content-wrapper {
                padding: 1rem;
            }

            .plan-name {
                font-size: 1.8rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .action-footer {
                flex-direction: column;
                gap: 1.5rem;
                align-items: stretch;
            }

            .stats-row {
                justify-content: center;
            }
        }

        /* SweetAlert Customization */
        .swal2-popup {
            border-radius: 8px;
            font-family: inherit;
        }

        .swal2-title {
            font-weight: 500;
            color: #2c3e50;
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
                    
                    <!-- Simple Header -->
                    <div class="page-header">
                        <h1 class="page-title">Gestión de Planes</h1>
                        <div class="breadcrumb-simple">
                            <a href="#">Dashboard</a> / <a href="#">Planes</a> / Plan Actual
                        </div>
                    </div>

                    <!-- Error Message -->
                    <?php if (isset($error_message)): ?>
                        <div class="alert-minimal">
                            <i class="mdi mdi-alert-circle"></i>
                            <strong>Error:</strong> <?php echo htmlspecialchars($error_message); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Main Content -->
                    <?php if (!empty($members)): ?>
                        <?php $member = $members[0]; ?>
                        
                        <div class="plan-container">
                            <!-- Plan Header -->
                            <div class="plan-header">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                  <h2 class="plan-name" style="margin: 0;"><?php echo htmlspecialchars($member['nombre']); ?></h2>
                                  <span class="plan-id-badge" style="display:none;">ID: <?php echo htmlspecialchars($member['id']); ?></span>
                                  <button 
                                    class="btn-minimal"
                                    data-toggle="modal"
                                    data-target="#editarModal"
                                    data-id="<?php echo htmlspecialchars($member['id']); ?>"
                                    data-nombre="<?php echo htmlspecialchars($member['nombre']); ?>"
                                    data-precio="<?php echo htmlspecialchars($member['precio']); ?>"
                                    data-ruta-post="<?php echo htmlspecialchars($member['ruta_post']); ?>"
                                    data-beneficio="<?php echo htmlspecialchars($member['beneficio']); ?>"
                                    data-ruta-pdf="<?php echo htmlspecialchars($member['ruta_pdf']); ?>"
                                    style="margin-left: auto;"
                                  >
                                    <i class="mdi mdi-pencil"></i>
                                    Editar Plan
                                  </button>
                                </div>
                            </div>

                            <!-- Information Section -->
                            <div class="info-section">
                                <div class="info-grid">
                                    
                                    <!-- Benefits -->
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="mdi mdi-star-outline"></i>
                                            Beneficios
                                        </div>
                                        <div class="info-content">
                                            <?php echo nl2br(htmlspecialchars($member['beneficio'])); ?>
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="mdi mdi-currency-usd"></i>
                                            precio
                                        </div>
                                        <div class="info-content">
                                            <?php echo nl2br(htmlspecialchars($member['precio'])); ?>
                                        </div>
                                    </div>

                                    <!-- Image Route -->
                                    <div class="info-item" style="grid-column: span 2; display: grid; grid-template-columns: 1fr 1fr; gap: 3rem;">
                                      <!-- Imagen del Plan -->
                                      <div>
                                        <div class="info-label">
                                          <i class="mdi mdi-folder-image"></i>
                                          Imagen del Plan
                                        </div>
                                        <div class="info-content">
                                          <div class="file-path"><?php echo htmlspecialchars($member['ruta_post']); ?></div>
                                          <div class="file-preview">
                                            <img 
                                              src="<?php echo htmlspecialchars($member['ruta_post']); ?>" 
                                              alt="Vista previa del plan"
                                              class="image-preview"
                                              loading="lazy"
                                              onerror="this.parentElement.innerHTML='<div class=\'file-error\'><i class=\'mdi mdi-image-broken\'></i><span>Imagen no encontrada</span></div>'"
                                            >
                                          </div>
                                        </div>
                                      </div>
                                      <!-- Documento PDF -->
                                      <div>
                                        <div class="info-label">
                                          <i class="mdi mdi-file-document-outline"></i>
                                          Documento PDF
                                        </div>
                                        <div class="info-content">
                                          <div class="file-path"><?php echo htmlspecialchars($member['ruta_pdf']); ?></div>
                                          <div class="file-actions">
                                            <a href="<?php echo htmlspecialchars($member['ruta_pdf']); ?>" 
                                               target="_blank" 
                                               class="file-action-btn view-btn"
                                               title="Ver PDF">
                                              <i class="mdi mdi-eye"></i>
                                              Ver PDF
                                            </a>
                                            <a href="<?php echo htmlspecialchars($member['ruta_pdf']); ?>" 
                                               download 
                                               class="file-action-btn download-btn"
                                               title="Descargar PDF">
                                              <i class="mdi mdi-download"></i>
                                              Descargar
                                            </a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Action Footer -->
                            <div class="action-footer">
                            </div>
                        </div>

                    <?php else: ?>
                        <!-- Empty State -->
                        <div class="empty-state">
                            <i class="mdi mdi-package-variant-closed"></i>
                            <h3>Plan no encontrado</h3>
                            <p>No se encontró el plan con ID = 1 en la base de datos.</p>
                            <button class="btn-minimal">
                                <i class="mdi mdi-plus"></i>
                                Crear Nuevo Plan
                            </button>
                        </div>
                    <?php endif; ?>

                </div>
                
                <?php include 'includes/footer.php'; ?>
            </div>
        </div>
    </div>

    <?php include 'modals/black/editar.php'; ?>

    <!-- Scripts -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
    
    <script>
        // Simple Toast Configuration
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });

        // Database error handler
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

        // Modal handler
        $('#editarModal').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget);
            const modal = $(this);
            
            // Populate modal fields
            modal.find('#member-id').val(button.data('id'));
            modal.find('#member-nombre').val(button.data('nombre'));
            modal.find('#member-ruta-post').val(button.data('ruta-post'));
            modal.find('#member-beneficio').val(button.data('beneficio'));
            modal.find('#member-precio').val(button.data('precio'));
            modal.find('#member-ruta-pdf').val(button.data('ruta-pdf'));
            
            Toast.fire({
                icon: 'info',
                title: 'Cargando datos del plan...'
            });
        });

        // Form submission handler
        function handleEditSubmit(event) {
            event.preventDefault();
            
            Swal.fire({
                title: '¿Guardar cambios?',
                text: 'Se actualizará la configuración del plan',
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
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Simulate save process
                    setTimeout(() => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Cambios guardados correctamente'
                        });
                        
                        $('#editarModal').modal('hide');
                        
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }, 1500);
                }
            });
        }

        // Image preview functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Image click to enlarge
            const imagePreview = document.querySelector('.image-preview');
            if (imagePreview) {
                imagePreview.addEventListener('click', function() {
                    Swal.fire({
                        imageUrl: this.src,
                        imageAlt: 'Vista ampliada del plan',
                        showConfirmButton: false,
                        showCloseButton: true,
                        customClass: {
                            popup: 'image-modal-popup',
                            image: 'image-modal-content'
                        }
                    });
                });
            }

            // File action button interactions
            const actionButtons = document.querySelectorAll('.file-action-btn');
            actionButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (this.classList.contains('view-btn')) {
                        Toast.fire({
                            icon: 'info',
                            title: 'Abriendo PDF...'
                        });
                    } else if (this.classList.contains('download-btn')) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Iniciando descarga...'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>