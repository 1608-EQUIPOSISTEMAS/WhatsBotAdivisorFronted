<style>
    /* Modal Minimalista */
    .modal-minimal {
        border-radius: 8px;
        border: none;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    }

    .modal-header-minimal {
        border-bottom: 1px solid #f0f0f0;
        padding: 1.5rem 2rem;
        background: #fafafa;
    }

    .modal-title {
        font-size: 1.4rem;
        font-weight: 500;
        color: #2c3e50;
        margin: 0;
    }

    .modal-subtitle {
        font-size: 0.9rem;
        color: #7f8c8d;
        margin: 0.3rem 0 0 0;
    }

    .close-minimal {
        background: none;
        border: none;
        font-size: 1.5rem;
        color: #95a5a6;
        cursor: pointer;
        padding: 0;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        transition: all 0.2s ease;
    }

    .close-minimal:hover {
        background: #ecf0f1;
        color: #2c3e50;
    }

    .modal-body-minimal {
        padding: 2rem;
    }

    .modal-footer-minimal {
        border-top: 1px solid #f0f0f0;
        padding: 1.25rem 2rem;
        background: #fafafa;
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
    }

    /* Form Grid */
    .form-grid-minimal {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .form-group-minimal {
        display: flex;
        flex-direction: column;
    }

    .form-group-minimal.full-width {
        grid-column: 1 / -1;
    }

    .form-label-minimal {
        font-size: 0.9rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .form-label-minimal i {
        font-size: 1rem;
        color: #95a5a6;
    }

    .form-control-minimal {
        padding: 0.65rem 0.9rem;
        font-size: 0.95rem;
        border: 1px solid #e0e0e0;
        border-radius: 4px;
        background: white;
        color: #2c3e50;
        transition: all 0.2s ease;
        font-family: inherit;
    }

    .form-control-minimal:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
    }

    .form-control-minimal::placeholder {
        color: #bdc3c7;
    }

    .textarea-minimal {
        resize: vertical;
        min-height: 100px;
        font-family: inherit;
        line-height: 1.5;
    }

    .form-hint {
        font-size: 0.8rem;
        color: #95a5a6;
        margin-top: 0.4rem;
        display: block;
    }

    /* File Upload */
    .file-upload-minimal {
        display: flex;
        gap: 0.5rem;
    }

    .btn-upload-minimal {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.65rem 1rem;
        background: #ecf0f1;
        color: #2c3e50;
        border: 1px solid #e0e0e0;
        border-radius: 4px;
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        white-space: nowrap;
    }

    .btn-upload-minimal:hover {
        background: #3498db;
        color: white;
        border-color: #3498db;
    }

    /* Badge */
    .badge-success-minimal {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: #d4edda;
        color: #27ae60;
        padding: 0.4rem 0.8rem;
        border-radius: 4px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    /* Buttons */
    .btn-secondary-minimal {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.65rem 1.25rem;
        background: #ecf0f1;
        color: #2c3e50;
        border: 1px solid #e0e0e0;
        border-radius: 4px;
        font-size: 0.95rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-secondary-minimal:hover {
        background: #e0e0e0;
    }

    .btn-primary-minimal {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.65rem 1.5rem;
        background: #3498db;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 0.95rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-primary-minimal:hover {
        background: #2980b9;
    }

    .btn-primary-minimal:focus,
    .btn-secondary-minimal:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-grid-minimal {
            grid-template-columns: 1fr;
        }
        
        .modal-body-minimal {
            padding: 1.5rem;
        }
        
        .modal-footer-minimal {
            flex-direction: column;
        }
        
        .btn-secondary-minimal,
        .btn-primary-minimal {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<!-- Modal Editar Plan -->
<div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content modal-minimal">
            
            <!-- Modal Header -->
            <div class="modal-header modal-header-minimal">
                <div>
                    <h5 class="modal-title" id="editarModalLabel">Editar Plan</h5>
                    <p class="modal-subtitle">Actualiza la información del plan</p>
                </div>
                <button type="button" class="close-minimal" data-dismiss="modal" aria-label="Close">
                    <i class="mdi mdi-close"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body modal-body-minimal">
                <form id="formEditarPlan" enctype="multipart/form-data">
                    
                    <!-- Hidden ID -->
                    <input type="hidden" id="member-id" name="id">

                    <!-- Form Grid -->
                    <div class="form-grid-minimal">
                        
                        <!-- Nombre del Plan -->
                        <div class="form-group-minimal">
                            <label class="form-label-minimal" for="member-nombre">
                                <i class="mdi mdi-tag-outline"></i>
                                Nombre del Plan
                            </label>
                            <input 
                                type="text" 
                                class="form-control-minimal" 
                                id="member-nombre" 
                                name="nombre" 
                                placeholder="Ej: Plan Premium Black"
                                required
                            >
                        </div>

                        <!-- Precio -->
                        <div class="form-group-minimal">
                            <label class="form-label-minimal" for="member-precio">
                                <i class="mdi mdi-currency-usd"></i>
                                Precio
                            </label>
                            <input 
                                type="text" 
                                class="form-control-minimal" 
                                id="member-precio" 
                                name="precio" 
                                placeholder="Ej: $99.00/mes"
                                required
                            >
                        </div>

                        <!-- Beneficios (full width) -->
                        <div class="form-group-minimal full-width">
                            <label class="form-label-minimal" for="member-beneficio">
                                <i class="mdi mdi-star-outline"></i>
                                Beneficios del Plan
                            </label>
                            <textarea 
                                class="form-control-minimal textarea-minimal" 
                                id="member-beneficio" 
                                name="beneficio" 
                                rows="4"
                                placeholder="Describe los beneficios del plan..."
                                required
                            ></textarea>
                            <small class="form-hint">Usa saltos de línea para separar los beneficios</small>
                        </div>

                        <!-- Ruta de Imagen -->
                        <div class="form-group-minimal full-width">
                            <label class="form-label-minimal" for="member-ruta-post">
                                <i class="mdi mdi-image-outline"></i>
                                Imagen del Plan
                            </label>
                            <div class="file-upload-minimal">
                                <input 
                                    type="text" 
                                    class="form-control-minimal" 
                                    id="member-ruta-post" 
                                    name="ruta_post_display" 
                                    placeholder="Ruta de la imagen"
                                    readonly
                                >
                                <label for="upload-image" class="btn-upload-minimal">
                                    <i class="mdi mdi-cloud-upload"></i>
                                    Subir Imagen
                                </label>
                                <input 
                                    type="file" 
                                    id="upload-image" 
                                    name="imagen" 
                                    accept="image/*"
                                    style="display: none;"
                                    onchange="handleImageUpload(this)"
                                >
                            </div>
                            <small class="form-hint">Formatos: JPG, PNG, WEBP (Máx. 5MB)</small>
                            
                            <!-- Image Preview -->
                            <div id="image-preview-container" style="display: none; margin-top: 1rem;">
                                <img id="image-preview" src="" alt="Preview" style="max-width: 200px; border-radius: 6px; border: 1px solid #e8e8e8;">
                            </div>
                        </div>

                        <!-- Ruta de PDF -->
                        <div class="form-group-minimal full-width">
                            <label class="form-label-minimal" for="member-ruta-pdf">
                                <i class="mdi mdi-file-pdf-outline"></i>
                                Documento PDF
                            </label>
                            <div class="file-upload-minimal">
                                <input 
                                    type="text" 
                                    class="form-control-minimal" 
                                    id="member-ruta-pdf" 
                                    name="ruta_pdf_display" 
                                    placeholder="Ruta del PDF"
                                    readonly
                                >
                                <label for="upload-pdf" class="btn-upload-minimal">
                                    <i class="mdi mdi-cloud-upload"></i>
                                    Subir PDF
                                </label>
                                <input 
                                    type="file" 
                                    id="upload-pdf" 
                                    name="pdf" 
                                    accept=".pdf"
                                    style="display: none;"
                                    onchange="handlePdfUpload(this)"
                                >
                            </div>
                            <small class="form-hint">Formato: PDF (Máx. 10MB)</small>
                            
                            <!-- PDF Info -->
                            <div id="pdf-info" style="display: none; margin-top: 0.5rem;">
                                <span class="badge-success-minimal">
                                    <i class="mdi mdi-check-circle"></i>
                                    <span id="pdf-name"></span>
                                </span>
                            </div>
                        </div>

                    </div>

                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer modal-footer-minimal">
                <button type="button" class="btn-secondary-minimal" data-dismiss="modal">
                    <i class="mdi mdi-close"></i>
                    Cancelar
                </button>
                <button type="button" class="btn-primary-minimal" onclick="submitEditForm()">
                    <i class="mdi mdi-content-save"></i>
                    Guardar Cambios
                </button>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Cargar datos del plan con AJAX cuando se abre el modal
    $('#editarModal').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        const planId = button.data('id');
        
        if (!planId) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo obtener el ID del plan',
                confirmButtonColor: '#3498db'
            });
            return;
        }
        
        // Mostrar loading
        Swal.fire({
            title: 'Cargando...',
            text: 'Obteniendo datos del plan',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        // Obtener datos con AJAX
        $.ajax({
            url: 'acciones/black/obtener.php',
            type: 'GET',
            data: { id: planId },
            dataType: 'json',
            success: function(response) {
                Swal.close();
                
                if (response.success) {
                    const data = response.data;
                    
                    // Llenar formulario
                    $('#member-id').val(data.id);
                    $('#member-nombre').val(data.nombre);
                    $('#member-precio').val(data.precio);
                    $('#member-beneficio').val(data.beneficio);
                    $('#member-ruta-post').val(data.ruta_post);
                    $('#member-ruta-pdf').val(data.ruta_pdf);
                    
                    // Mostrar preview de imagen si existe
                    if (data.ruta_post && data.ruta_post.trim() !== '') {
                        $('#image-preview').attr('src', data.ruta_post);
                        $('#image-preview-container').show();
                    } else {
                        $('#image-preview-container').hide();
                    }
                    
                    // Reset PDF info
                    $('#pdf-info').hide();
                    
                    Toast.fire({
                        icon: 'success',
                        title: 'Datos cargados correctamente'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'No se pudieron cargar los datos',
                        confirmButtonColor: '#3498db'
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.close();
                Swal.fire({
                    icon: 'error',
                    title: 'Error de conexión',
                    text: 'No se pudo conectar con el servidor',
                    confirmButtonColor: '#3498db'
                });
            }
        });
    });

    // Handle Image Upload
    function handleImageUpload(input) {
        const file = input.files[0];
        if (file) {
            // Validate file size (5MB)
            if (file.size > 5 * 1024 * 1024) {
                Swal.fire({
                    icon: 'error',
                    title: 'Archivo muy grande',
                    text: 'La imagen no debe superar los 5MB',
                    confirmButtonColor: '#3498db'
                });
                input.value = '';
                return;
            }

            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#image-preview').attr('src', e.target.result);
                $('#image-preview-container').show();
            };
            reader.readAsDataURL(file);

            // Update path input
            $('#member-ruta-post').val(file.name);

            Toast.fire({
                icon: 'success',
                title: 'Imagen cargada: ' + file.name
            });
        }
    }

    // Handle PDF Upload
    function handlePdfUpload(input) {
        const file = input.files[0];
        if (file) {
            // Validate file size (10MB)
            if (file.size > 10 * 1024 * 1024) {
                Swal.fire({
                    icon: 'error',
                    title: 'Archivo muy grande',
                    text: 'El PDF no debe superar los 10MB',
                    confirmButtonColor: '#3498db'
                });
                input.value = '';
                return;
            }

            // Update path input
            $('#member-ruta-pdf').val(file.name);

            // Show PDF info
            $('#pdf-name').text(file.name);
            $('#pdf-info').show();

            Toast.fire({
                icon: 'success',
                title: 'PDF cargado: ' + file.name
            });
        }
    }

    // Submit form con AJAX
    function submitEditForm() {
        const form = document.getElementById('formEditarPlan');
        const formData = new FormData(form);
        
        // Validar campos requeridos
        const nombre = $('#member-nombre').val().trim();
        const precio = $('#member-precio').val().trim();
        const beneficio = $('#member-beneficio').val().trim();
        
        if (!nombre || !precio || !beneficio) {
            Swal.fire({
                icon: 'warning',
                title: 'Campos incompletos',
                text: 'Por favor completa todos los campos requeridos',
                confirmButtonColor: '#3498db'
            });
            return;
        }
        
        // Confirmar acción
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
                // Mostrar loading
                Swal.fire({
                    title: 'Guardando...',
                    text: 'Procesando los cambios',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Enviar con AJAX
                $.ajax({
                    url: 'acciones/black/editar.php',
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
                                text: response.message || 'Plan actualizado correctamente',
                                confirmButtonColor: '#3498db',
                                timer: 2000
                            }).then(() => {
                                $('#editarModal').modal('hide');
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message || 'No se pudo actualizar el plan',
                                confirmButtonColor: '#3498db'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
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