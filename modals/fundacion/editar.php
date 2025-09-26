<!-- Modal Editar Bot Foundation -->
<div class="modal fade" id="editarBotModal" tabindex="-1" role="dialog" aria-labelledby="editarBotModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content modal-minimal">
            
            <!-- Modal Header -->
            <div class="modal-header modal-header-minimal">
                <div>
                    <h5 class="modal-title" id="editarBotModalLabel">Editar Configuración Bot</h5>
                    <p class="modal-subtitle">Actualiza textos, imágenes y documentos del bot foundation</p>
                </div>
                <button type="button" class="close-minimal" data-dismiss="modal" aria-label="Close">
                    <i class="mdi mdi-close"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body modal-body-minimal">
                <form id="formEditarBot" enctype="multipart/form-data">
                    
                    <!-- Hidden ID -->
                    <input type="hidden" id="bot-id" name="id">

                    <!-- Form Grid -->
                    <div class="form-grid-minimal">
                        
                        <!-- Welcome -->
                        <div class="form-group-minimal full-width">
                            <label class="form-label-minimal" for="bot-welcome">
                                <i class="mdi mdi-message-text"></i>
                                Mensaje de Bienvenida
                            </label>
                            <textarea 
                                class="form-control-minimal textarea-minimal" 
                                id="bot-welcome" 
                                name="welcome" 
                                rows="3"
                                placeholder="Mensaje de bienvenida del bot"
                            ></textarea>
                        </div>

                        <!-- Presentation Image -->
                        <div class="form-group-minimal full-width">
                            <label class="form-label-minimal">
                                <i class="mdi mdi-image"></i>
                                Imagen Presentación
                            </label>
                            <div class="file-upload-minimal">
                                <input 
                                    type="text" 
                                    class="form-control-minimal" 
                                    id="bot-presentation-route" 
                                    placeholder="Ruta de la imagen"
                                    readonly
                                >
                                <label for="upload-presentation" class="btn-upload-minimal">
                                    <i class="mdi mdi-cloud-upload"></i>
                                    Subir Imagen
                                </label>
                                <input 
                                    type="file" 
                                    id="upload-presentation" 
                                    name="presentation_image" 
                                    accept="image/*"
                                    style="display: none;"
                                    onchange="handleFileUpload(this, 'presentation-preview')"
                                >
                            </div>
                            <small class="form-hint">JPG, PNG, WEBP (Máx. 5MB)</small>
                            <div id="presentation-preview" style="display: none; margin-top: 1rem;">
                                <img src="" style="max-width: 200px; border-radius: 6px; border: 1px solid #e8e8e8;">
                            </div>
                        </div>

                        <!-- Brochure PDF -->
                        <div class="form-group-minimal">
                            <label class="form-label-minimal">
                                <i class="mdi mdi-file-pdf"></i>
                                Brochure PDF
                            </label>
                            <div class="file-upload-minimal">
                                <input 
                                    type="text" 
                                    class="form-control-minimal" 
                                    id="bot-brochure-route" 
                                    placeholder="Ruta del PDF"
                                    readonly
                                >
                                <label for="upload-brochure" class="btn-upload-minimal">
                                    <i class="mdi mdi-cloud-upload"></i>
                                    Subir PDF
                                </label>
                                <input 
                                    type="file" 
                                    id="upload-brochure" 
                                    name="brochure_pdf" 
                                    accept=".pdf"
                                    style="display: none;"
                                    onchange="handlePdfUpload(this, 'brochure-info')"
                                >
                            </div>
                            <small class="form-hint">PDF (Máx. 10MB)</small>
                            <div id="brochure-info" style="display: none; margin-top: 0.5rem;">
                                <span class="badge-success-minimal">
                                    <i class="mdi mdi-check-circle"></i>
                                    <span class="pdf-name"></span>
                                </span>
                            </div>
                        </div>

                        <!-- Modality First Image -->
                        <div class="form-group-minimal">
                            <label class="form-label-minimal">
                                <i class="mdi mdi-numeric-1-box"></i>
                                Imagen Modalidad 1
                            </label>
                            <div class="file-upload-minimal">
                                <input 
                                    type="text" 
                                    class="form-control-minimal" 
                                    id="bot-modality-first-route" 
                                    placeholder="Ruta de la imagen"
                                    readonly
                                >
                                <label for="upload-modality1" class="btn-upload-minimal">
                                    <i class="mdi mdi-cloud-upload"></i>
                                    Subir Imagen
                                </label>
                                <input 
                                    type="file" 
                                    id="upload-modality1" 
                                    name="modality_first_image" 
                                    accept="image/*"
                                    style="display: none;"
                                    onchange="handleFileUpload(this, 'modality1-preview')"
                                >
                            </div>
                            <small class="form-hint">JPG, PNG, WEBP (Máx. 5MB)</small>
                            <div id="modality1-preview" style="display: none; margin-top: 1rem;">
                                <img src="" style="max-width: 200px; border-radius: 6px; border: 1px solid #e8e8e8;">
                            </div>
                        </div>

                        <!-- Modality Second Image -->
                        <div class="form-group-minimal">
                            <label class="form-label-minimal">
                                <i class="mdi mdi-numeric-2-box"></i>
                                Imagen Modalidad 2
                            </label>
                            <div class="file-upload-minimal">
                                <input 
                                    type="text" 
                                    class="form-control-minimal" 
                                    id="bot-modality-second-route" 
                                    placeholder="Ruta de la imagen"
                                    readonly
                                >
                                <label for="upload-modality2" class="btn-upload-minimal">
                                    <i class="mdi mdi-cloud-upload"></i>
                                    Subir Imagen
                                </label>
                                <input 
                                    type="file" 
                                    id="upload-modality2" 
                                    name="modality_second_image" 
                                    accept="image/*"
                                    style="display: none;"
                                    onchange="handleFileUpload(this, 'modality2-preview')"
                                >
                            </div>
                            <small class="form-hint">JPG, PNG, WEBP (Máx. 5MB)</small>
                            <div id="modality2-preview" style="display: none; margin-top: 1rem;">
                                <img src="" style="max-width: 200px; border-radius: 6px; border: 1px solid #e8e8e8;">
                            </div>
                        </div>

                        <!-- Inversion PDF -->
                        <div class="form-group-minimal">
                            <label class="form-label-minimal">
                                <i class="mdi mdi-chart-line"></i>
                                Inversión PDF
                            </label>
                            <div class="file-upload-minimal">
                                <input 
                                    type="text" 
                                    class="form-control-minimal" 
                                    id="bot-inversion-route" 
                                    placeholder="Ruta del PDF"
                                    readonly
                                >
                                <label for="upload-inversion" class="btn-upload-minimal">
                                    <i class="mdi mdi-cloud-upload"></i>
                                    Subir PDF
                                </label>
                                <input 
                                    type="file" 
                                    id="upload-inversion" 
                                    name="inversion_pdf" 
                                    accept=".pdf"
                                    style="display: none;"
                                    onchange="handlePdfUpload(this, 'inversion-info')"
                                >
                            </div>
                            <small class="form-hint">PDF (Máx. 10MB)</small>
                            <div id="inversion-info" style="display: none; margin-top: 0.5rem;">
                                <span class="badge-success-minimal">
                                    <i class="mdi mdi-check-circle"></i>
                                    <span class="pdf-name"></span>
                                </span>
                            </div>
                        </div>

                        <!-- Sesion -->
                        <div class="form-group-minimal full-width">
                            <label class="form-label-minimal" for="bot-sesion">
                                <i class="mdi mdi-calendar-clock"></i>
                                Sesión
                            </label>
                            <textarea 
                                class="form-control-minimal textarea-minimal" 
                                id="bot-sesion" 
                                name="sesion" 
                                rows="3"
                                placeholder="Información sobre las sesiones"
                            ></textarea>
                        </div>

                        <!-- Key Words -->
                        <div class="form-group-minimal full-width">
                            <label class="form-label-minimal" for="bot-key-words">
                                <i class="mdi mdi-key"></i>
                                Palabras Clave
                            </label>
                            <textarea 
                                class="form-control-minimal textarea-minimal" 
                                id="bot-key-words" 
                                name="key_words" 
                                rows="3"
                                placeholder="Palabras clave separadas por comas o saltos de línea"
                            ></textarea>
                        </div>

                        <!-- Final Text -->
                        <div class="form-group-minimal full-width">
                            <label class="form-label-minimal" for="bot-final-text">
                                <i class="mdi mdi-text-box"></i>
                                Texto Final
                            </label>
                            <textarea 
                                class="form-control-minimal textarea-minimal" 
                                id="bot-final-text" 
                                name="final_text" 
                                rows="3"
                                placeholder="Mensaje final del bot"
                            ></textarea>
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
                <button type="button" class="btn-primary-minimal" onclick="submitBotForm()">
                    <i class="mdi mdi-content-save"></i>
                    Guardar Cambios
                </button>
            </div>

        </div>
    </div>
</div>

<style>
/* Modal Styles */
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
    max-height: 70vh;
    overflow-y: auto;
}

.modal-footer-minimal {
    border-top: 1px solid #f0f0f0;
    padding: 1.25rem 2rem;
    background: #fafafa;
    display: flex;
    justify-content: flex-end;
    gap: 0.75rem;
}

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
    min-height: 80px;
    font-family: inherit;
    line-height: 1.5;
}

.form-hint {
    font-size: 0.8rem;
    color: #95a5a6;
    margin-top: 0.4rem;
    display: block;
}

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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
// Cargar datos del bot con AJAX
$('#editarBotModal').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget);
    const botId = button.data('id');
    
    if (!botId) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudo obtener el ID',
            confirmButtonColor: '#3498db'
        });
        return;
    }
    
    Swal.fire({
        title: 'Cargando...',
        text: 'Obteniendo configuración del bot',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
    $.ajax({
        url: 'acciones/fundacion/obtener.php',
        type: 'GET',
        data: { id: botId },
        dataType: 'json',
        success: function(response) {
            Swal.close();
            
            if (response.success) {
                const data = response.data;
                
                // Llenar campos de texto
                $('#bot-id').val(data.id);
                $('#bot-welcome').val(data.welcome);
                $('#bot-sesion').val(data.sesion);
                $('#bot-key-words').val(data.key_words);
                $('#bot-final-text').val(data.final_text);
                
                // Mostrar rutas actuales
                $('#bot-presentation-route').val(data.presentation_route);
                $('#bot-brochure-route').val(data.brochure_route);
                $('#bot-modality-first-route').val(data.modality_first_route);
                $('#bot-modality-second-route').val(data.modality_second_route);
                $('#bot-inversion-route').val(data.inversion_route);
                
                // Mostrar previews de imágenes existentes
                if (data.presentation_route) {
                    $('#presentation-preview img').attr('src', data.presentation_route);
                    $('#presentation-preview').show();
                }
                if (data.modality_first_route) {
                    $('#modality1-preview img').attr('src', data.modality_first_route);
                    $('#modality1-preview').show();
                }
                if (data.modality_second_route) {
                    $('#modality2-preview img').attr('src', data.modality_second_route);
                    $('#modality2-preview').show();
                }
                
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
});

// Handle File Upload (Images)
function handleFileUpload(input, previewId) {
    const file = input.files[0];
    if (file) {
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

        const reader = new FileReader();
        reader.onload = function(e) {
            $('#' + previewId + ' img').attr('src', e.target.result);
            $('#' + previewId).show();
        };
        reader.readAsDataURL(file);

        Toast.fire({
            icon: 'success',
            title: 'Imagen cargada: ' + file.name
        });
    }
}

// Handle PDF Upload
function handlePdfUpload(input, infoId) {
    const file = input.files[0];
    if (file) {
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

        $('#' + infoId + ' .pdf-name').text(file.name);
        $('#' + infoId).show();

        Toast.fire({
            icon: 'success',
            title: 'PDF cargado: ' + file.name
        });
    }
}

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
});
</script>