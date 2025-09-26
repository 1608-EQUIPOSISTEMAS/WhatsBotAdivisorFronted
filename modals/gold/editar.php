<style>
    /* VARIABLES DE DISEÑO CENTRALIZADAS */
    :root {
        --color-secondary: #6b7280;
        --color-background: #ffffff;
        --color-background-header: #f8fafc;
        --color-border: #e5e7eb;
        --color-text-main: #1f2937;
        --color-text-subtle: #6b7280;
        --color-success: #10b981;
        --radius-base: 10px;
        --shadow-elevation: 0 10px 30px rgba(0, 0, 0, 0.08);
    }

    /* Modal Reset & Base */
    .modal-ux {
        border-radius: var(--radius-base);
        border: none;
        box-shadow: var(--shadow-elevation);
        overflow: hidden;
        background-color: var(--color-background);
    }

    /* Header: Limpio y Separado */
    .modal-header-ux {
        border-bottom: 1px solid var(--color-border);
        padding: 1.5rem 2rem;
        background: var(--color-background-header);
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .modal-title-ux {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--color-text-main);
        margin: 0;
    }

    .modal-subtitle-ux {
        font-size: 1rem;
        color: var(--color-text-subtle);
        margin: 0.3rem 0 0 0;
    }

    /* Close Button */
    .close-ux {
        background: none;
        border: none;
        font-size: 1.7rem;
        color: var(--color-text-subtle);
        cursor: pointer;
        padding: 0.5rem;
        transition: all 0.2s ease;
        border-radius: 50%;
        margin: -0.5rem; /* Ajuste para el espaciado del header */
    }

    .close-ux:hover {
        color: var(--color-text-main);
        background-color: #f3f4f6;
    }

    /* Body & Footer */
    .modal-body-ux {
        padding: 2rem;
    }

    .modal-footer-ux {
        border-top: 1px solid var(--color-border);
        padding: 1.25rem 2rem;
        background: var(--color-background-header);
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    /* Form Structure: Separación de Información Básica y Archivos */
    .form-section-ux {
        margin-bottom: 2rem;
        padding: 1.5rem;
        border: 1px solid var(--color-border);
        border-radius: var(--radius-base);
        background-color: #fcfcfc;
    }

    .form-section-ux h3 {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--color-text-main);
        margin-bottom: 1.5rem;
        border-bottom: 2px solid var(--color-border);
        padding-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .form-grid-ux {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .form-group-ux {
        display: flex;
        flex-direction: column;
    }

    .form-group-ux.full-width {
        grid-column: 1 / -1;
    }

    /* Labels */
    .form-label-ux {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--color-text-main);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-label-ux i {
        font-size: 1.1rem;
        color: var(--color-primary);
    }

    /* Inputs/Textareas */
    .form-control-ux {
        padding: 0.75rem 1rem;
        font-size: 1rem;
        border: 1px solid var(--color-border);
        border-radius: 6px;
        background: var(--color-background);
        color: var(--color-text-main);
        transition: all 0.2s ease;
        font-family: inherit;
    }

    .form-control-ux:focus {
        outline: none;
        border-color: var(--color-primary);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    }

    .form-control-ux::placeholder {
        color: #9ca3af;
    }

    /* Textareas grandes como se solicitó */
    .textarea-ux-lg {
        resize: vertical;
        min-height: 120px;
        line-height: 1.6;
    }

    #member-beneficio.textarea-ux-lg {
        min-height: 180px; /* Aún más grande para beneficios */
    }

    .form-hint-ux {
        font-size: 0.85rem;
        color: var(--color-text-subtle);
        margin-top: 0.5rem;
        display: block;
    }

    /* File Upload Area */
    .file-upload-wrapper {
        display: flex;
        gap: 1rem;
        align-items: center;
        border: 1px dashed var(--color-border);
        padding: 1rem;
        border-radius: 6px;
        background-color: #f9faff;
    }
    
    .file-input-display {
        flex-grow: 1;
        background: #ffffff;
        cursor: text;
    }

    .btn-upload-ux {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.25rem;
        background: var(--color-primary);
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 0.95rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        flex-shrink: 0;
    }

    .btn-upload-ux:hover {
        background: #2563eb;
    }

    /* Previews */
    .preview-container-ux {
        margin-top: 1rem;
        padding: 0.75rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        display: flex;
        align-items: center;
        gap: 1rem;
        background-color: #ffffff;
    }

    .image-preview-ux {
        max-width: 100px;
        height: auto;
        border-radius: 4px;
        object-fit: cover;
    }
    
    .badge-file-ux {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: #d1fae5;
        color: var(--color-success);
        padding: 0.5rem 1rem;
        border-radius: 4px;
        font-size: 0.9rem;
        font-weight: 500;
    }

    /* Buttons */
    .btn-secondary-ux {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        background: #f3f4f6;
        color: var(--color-text-main);
        border: 1px solid var(--color-border);
        border-radius: 6px;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-secondary-ux:hover {
        background: #e5e7eb;
    }

    .btn-primary-ux {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.75rem;
        background: var(--color-primary);
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-primary-ux:hover {
        background: #2563eb;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-grid-ux {
            grid-template-columns: 1fr;
        }
        
        .modal-body-ux, .modal-header-ux, .modal-footer-ux {
            padding: 1rem;
        }
        
        .modal-footer-ux {
            flex-direction: column-reverse;
            gap: 0.75rem;
        }
        
        .btn-secondary-ux,
        .btn-primary-ux {
            width: 100%;
            justify-content: center;
        }

        .file-upload-wrapper {
            flex-direction: column;
            align-items: stretch;
        }

        .btn-upload-ux {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content modal-ux">
            
            <div class="modal-header-ux">
                <div>
                    <h5 class="modal-title-ux" id="editarModalLabel">Editar Plan de Suscripción</h5>
                    <p class="modal-subtitle-ux">Administra la información clave, precio y beneficios de este plan.</p>
                </div>
                <button type="button" class="close-ux" data-dismiss="modal" aria-label="Close">
                    <i class="mdi mdi-close"></i>
                </button>
            </div>

            <div class="modal-body-ux">
                <form id="formEditarPlan" enctype="multipart/form-data">
                    
                    <input type="hidden" id="member-id" name="id">

                    <div class="form-section-ux">
                        <h3><i class="mdi mdi-information-outline"></i> Detalles del Plan</h3>

                        <div class="form-grid-ux">
                            
                            <div class="form-group-ux">
                                <label class="form-label-ux" for="member-nombre">
                                    <i class="mdi mdi-tag-outline"></i>
                                    Nombre del Plan <span style="color:red;">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    class="form-control-ux" 
                                    id="member-nombre" 
                                    name="nombre" 
                                    placeholder="Ej: Plan Premium Black"
                                    required
                                >
                            </div>

                            <div class="form-group-ux">
                                <label class="form-label-ux" for="member-precio">
                                    <i class="mdi mdi-currency-usd"></i>
                                    Precio y Frecuencia <span style="color:red;">*</span>
                                </label>
                                <textarea
                                    class="form-control-ux textarea-ux-lg"
                                    id="member-precio"
                                    name="precio"
                                    placeholder="Ej: $99.00 / mes"
                                    required
                                    rows="3"
                                ></textarea>
                                <small class="form-hint-ux">Texto exacto de cómo se mostrará el precio.</small>
                            </div>

                            <div class="form-group-ux full-width">
                                <label class="form-label-ux" for="member-beneficio">
                                    <i class="mdi mdi-star-outline"></i>
                                    Lista de Beneficios <span style="color:red;">*</span>
                                </label>
                                <textarea 
                                    class="form-control-ux textarea-ux-lg" 
                                    id="member-beneficio" 
                                    name="beneficio" 
                                    rows="8"
                                    placeholder="Escribe cada beneficio en una línea separada. Esto mejora la legibilidad."
                                    required
                                ></textarea>
                                <small class="form-hint-ux">El campo es grande para facilitar la edición de listas extensas.</small>
                            </div>

                        </div>
                    </div>

                    <div class="form-section-ux">
                        <h3><i class="mdi mdi-attachment"></i> Archivos Multimedia</h3>
                        
                        <div class="form-group-ux full-width" style="margin-bottom: 1.5rem;">
                            <label class="form-label-ux" for="member-ruta-post">
                                <i class="mdi mdi-image-outline"></i>
                                Imagen de Portada (Opcional)
                            </label>
                            <div class="file-upload-wrapper">
                                <input 
                                    type="text" 
                                    class="form-control-ux file-input-display" 
                                    id="member-ruta-post" 
                                    name="ruta_post_display" 
                                    placeholder="Ruta actual o nombre del nuevo archivo..."
                                    readonly
                                >
                                <label for="upload-image" class="btn-upload-ux">
                                    <i class="mdi mdi-cloud-upload"></i>
                                    Seleccionar Imagen
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
                            <small class="form-hint-ux">Formatos: JPG, PNG, WEBP (Máx. 5MB). La nueva imagen reemplazará la anterior.</small>
                            
                            <div id="image-preview-container" class="preview-container-ux" style="display: none;">
                                <img id="image-preview" src="" alt="Preview" class="image-preview-ux">
                                <p class="form-hint-ux" style="margin:0; color:var(--color-text-main);">**Imagen Cargada/Actual**</p>
                            </div>
                        </div>

                        <div class="form-group-ux full-width">
                            <label class="form-label-ux" for="member-ruta-pdf">
                                <i class="mdi mdi-file-pdf-outline"></i>
                                Documento PDF de Especificación (Opcional)
                            </label>
                            <div class="file-upload-wrapper">
                                <input 
                                    type="text" 
                                    class="form-control-ux file-input-display" 
                                    id="member-ruta-pdf" 
                                    name="ruta_pdf_display" 
                                    placeholder="Ruta actual o nombre del nuevo archivo PDF..."
                                    readonly
                                >
                                <label for="upload-pdf" class="btn-upload-ux">
                                    <i class="mdi mdi-cloud-upload"></i>
                                    Seleccionar PDF
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
                            <small class="form-hint-ux">Formato: PDF (Máx. 10MB). Deja el campo vacío y no subas nada para eliminar la referencia.</small>
                            
                            <div id="pdf-info" class="preview-container-ux" style="display: none;">
                                <span class="badge-file-ux">
                                    <i class="mdi mdi-check-circle"></i>
                                    <span id="pdf-name"></span>
                                </span>
                            </div>
                        </div>

                    </div>

                </form>
            </div>

            <div class="modal-footer-ux">
                <button type="button" class="btn-secondary-ux" data-dismiss="modal">
                    <i class="mdi mdi-close"></i>
                    Cancelar
                </button>
                <button type="button" class="btn-primary-ux" onclick="submitEditForm()">
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
        
        // --- LIMPIEZA INICIAL ---
        $('#image-preview-container').hide();
        $('#image-preview').attr('src', '');
        $('#pdf-info').hide();
        $('#pdf-name').text('');
        // También limpiamos los inputs de archivo por si acaso
        $('#upload-image').val('');
        $('#upload-pdf').val('');
        
        if (!planId) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo obtener el ID del plan',
                confirmButtonColor: '#3b82f6'
            });
            return;
        }
        
        // Mostrar loading con el nuevo color primario
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
            url: 'acciones/members/obtener.php',
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
                    } 
                    
                    // Mostrar info de PDF si existe
                    if (data.ruta_pdf && data.ruta_pdf.trim() !== '') {
                        // Usamos el nombre del archivo (simplificado si es una ruta)
                        const pdfName = data.ruta_pdf.substring(data.ruta_pdf.lastIndexOf('/') + 1);
                        $('#pdf-name').text(pdfName || 'Documento enlazado');
                        $('#pdf-info').show();
                    } 
                    
                    // Llama a Toast si está definido globalmente
                    if (typeof Toast !== 'undefined') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Datos cargados correctamente'
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'No se pudieron cargar los datos',
                        confirmButtonColor: '#3b82f6'
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.close();
                Swal.fire({
                    icon: 'error',
                    title: 'Error de conexión',
                    text: 'No se pudo conectar con el servidor',
                    confirmButtonColor: '#3b82f6'
                });
            }
        });
    });

    // Handle Image Upload
    function handleImageUpload(input) {
        const file = input.files[0];
        if (file) {
            if (file.size > 5 * 1024 * 1024) {
                Swal.fire({
                    icon: 'error',
                    title: 'Archivo muy grande',
                    text: 'La imagen no debe superar los 5MB',
                    confirmButtonColor: '#3b82f6'
                });
                input.value = '';
                // Restaurar el valor de la ruta si existía
                if ($('#member-id').val()) {
                     // Aquí podrías recargar el valor original de la ruta si lo tuvieras guardado
                } else {
                     $('#member-ruta-post').val('');
                }
                $('#image-preview-container').hide();
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                $('#image-preview').attr('src', e.target.result);
                $('#image-preview-container').show();
            };
            reader.readAsDataURL(file);

            // Update path input with file name
            $('#member-ruta-post').val(file.name);

            if (typeof Toast !== 'undefined') {
                Toast.fire({
                    icon: 'success',
                    title: 'Imagen cargada: ' + file.name
                });
            }
        }
    }

    // Handle PDF Upload
    function handlePdfUpload(input) {
        const file = input.files[0];
        if (file) {
            if (file.size > 10 * 1024 * 1024) {
                Swal.fire({
                    icon: 'error',
                    title: 'Archivo muy grande',
                    text: 'El PDF no debe superar los 10MB',
                    confirmButtonColor: '#3b82f6'
                });
                input.value = '';
                // Restaurar el valor de la ruta si existía
                if ($('#member-id').val()) {
                    // Aquí podrías recargar el valor original de la ruta si lo tuvieras guardado
                } else {
                    $('#member-ruta-pdf').val('');
                }
                $('#pdf-info').hide();
                return;
            }

            // Update path input with file name
            $('#member-ruta-pdf').val(file.name);

            // Show PDF info
            $('#pdf-name').text(file.name);
            $('#pdf-info').show();

            if (typeof Toast !== 'undefined') {
                Toast.fire({
                    icon: 'success',
                    title: 'PDF cargado: ' + file.name
                });
            }
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
                text: 'Por favor completa todos los campos marcados con (*)',
                confirmButtonColor: '#3b82f6'
            });
            return;
        }
        
        // Confirmar acción
        Swal.fire({
            title: '¿Guardar cambios?',
            text: 'Se actualizará la configuración del plan en la base de datos.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3b82f6',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Sí, Guardar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Mostrar loading
                Swal.fire({
                    title: 'Guardando...',
                    text: 'Procesando los cambios y subiendo archivos...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Enviar con AJAX
                $.ajax({
                    url: 'acciones/members/editar.php',
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
                                title: '¡Actualizado!',
                                text: response.message || 'Plan actualizado correctamente.',
                                confirmButtonColor: '#3b82f6',
                                timer: 2000
                            }).then(() => {
                                $('#editarModal').modal('hide'); 
                                location.reload(); 
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message || 'No se pudo actualizar el plan. Revisa la consola.',
                                confirmButtonColor: '#3b82f6'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error de Servidor',
                            text: 'Ocurrió un error al intentar comunicar con el servidor (' + status + ').',
                            confirmButtonColor: '#3b82f6'
                        });
                    }
                });
            }
        });
    }
</script>