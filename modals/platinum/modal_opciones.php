<!-- Modal Gestionar Opciones -->
<div class="modal fade" id="editarModalopciones" tabindex="-1" role="dialog" aria-labelledby="editarModalOpcionesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content modal-ux">
            
            <div class="modal-header-ux">
                <div>
                    <h5 class="modal-title-ux" id="editarModalOpcionesLabel">Gestionar Opciones del Plan</h5>
                    <p class="modal-subtitle-ux">Configura las 4 opciones de respuesta que recibirá el usuario al consultar este plan.</p>
                </div>
                <button type="button" class="close-ux" data-dismiss="modal" aria-label="Close">
                    <i class="mdi mdi-close"></i>
                </button>
            </div>

            <div class="modal-body-ux">
                <form id="formGestionarOpciones">
                    
                    <input type="hidden" id="member-id-opciones" name="member_id">

                    <div class="form-section-ux">
                        <h3><i class="mdi mdi-format-list-numbered"></i> Opciones de Respuesta (1-4)</h3>
                        
                        <div class="form-group-ux full-width" style="margin-bottom: 1.5rem;">
                            <label class="form-label-ux">
                                <i class="mdi mdi-numeric-1-circle"></i>
                                Opción 1 <span style="color:red;">*</span>
                            </label>
                            <input type="hidden" name="opciones[0][id]" id="opcion-id-1">
                            <input type="hidden" name="opciones[0][numero]" value="1">
                            <textarea 
                                class="form-control-ux textarea-ux-lg" 
                                name="opciones[0][texto]" 
                                id="opcion-texto-1"
                                placeholder="Ej: Quiero inscribirme abonando al Contado"
                                required
                                rows="2"
                            ></textarea>
                        </div>

                        <div class="form-group-ux full-width" style="margin-bottom: 1.5rem;">
                            <label class="form-label-ux">
                                <i class="mdi mdi-numeric-2-circle"></i>
                                Opción 2 <span style="color:red;">*</span>
                            </label>
                            <input type="hidden" name="opciones[1][id]" id="opcion-id-2">
                            <input type="hidden" name="opciones[1][numero]" value="2">
                            <textarea 
                                class="form-control-ux textarea-ux-lg" 
                                name="opciones[1][texto]" 
                                id="opcion-texto-2"
                                placeholder="Ej: Quiero inscribirme abonando en Cuotas"
                                required
                                rows="2"
                            ></textarea>
                        </div>

                        <div class="form-group-ux full-width" style="margin-bottom: 1.5rem;">
                            <label class="form-label-ux">
                                <i class="mdi mdi-numeric-3-circle"></i>
                                Opción 3 <span style="color:red;">*</span>
                            </label>
                            <input type="hidden" name="opciones[2][id]" id="opcion-id-3">
                            <input type="hidden" name="opciones[2][numero]" value="3">
                            <textarea 
                                class="form-control-ux textarea-ux-lg" 
                                name="opciones[2][texto]" 
                                id="opcion-texto-3"
                                placeholder="Ej: Tengo una duda (escríbela aquí)"
                                required
                                rows="2"
                            ></textarea>
                        </div>

                        <div class="form-group-ux full-width">
                            <label class="form-label-ux">
                                <i class="mdi mdi-numeric-4-circle"></i>
                                Opción 4 <span style="color:red;">*</span>
                            </label>
                            <input type="hidden" name="opciones[3][id]" id="opcion-id-4">
                            <input type="hidden" name="opciones[3][numero]" value="4">
                            <textarea 
                                class="form-control-ux textarea-ux-lg" 
                                name="opciones[3][texto]" 
                                id="opcion-texto-4"
                                placeholder="Ej: Quiero agendar una llamada"
                                required
                                rows="2"
                            ></textarea>
                        </div>

                    </div>

                </form>
            </div>

            <div class="modal-footer-ux">
                <button type="button" class="btn-secondary-ux" data-dismiss="modal">
                    <i class="mdi mdi-close"></i>
                    Cancelar
                </button>
                <button type="button" class="btn-primary-ux" onclick="submitOpcionesForm()">
                    <i class="mdi mdi-content-save"></i>
                    Guardar Opciones
                </button>
            </div>

        </div>
    </div>
</div>

<script>
// ✅ FUNCIÓN GLOBAL - Accesible desde onclick
function submitOpcionesForm() {
    const form = document.getElementById('formGestionarOpciones');
    const formData = new FormData(form);
    
    let vacios = false;
    for (let i = 1; i <= 4; i++) {
        if (!$(`#opcion-texto-${i}`).val().trim()) {
            vacios = true;
            break;
        }
    }
    
    if (vacios) {
        Swal.fire({
            icon: 'warning',
            title: 'Campos incompletos',
            text: 'Por favor completa las 4 opciones',
            confirmButtonColor: '#3b82f6'
        });
        return;
    }
    
    Swal.fire({
        title: '¿Guardar opciones?',
        text: 'Se actualizarán las 4 opciones de respuesta para este plan.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3b82f6',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Sí, Guardar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Guardando...',
                text: 'Procesando opciones...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            $.ajax({
                url: 'acciones/members/guardar_opciones.php',
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
                            text: response.message || 'Opciones actualizadas correctamente.',
                            confirmButtonColor: '#3b82f6',
                            timer: 2000
                        }).then(() => {
                            $('#editarModalopciones').modal('hide');
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message || 'No se pudieron guardar las opciones',
                            confirmButtonColor: '#3b82f6'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.close();
                    
                    let errorDetails = `
                        <div style="text-align: left; font-size: 0.9em;">
                            <p><strong>Estado HTTP:</strong> ${xhr.status}</p>
                            <p><strong>Mensaje:</strong> ${status}</p>
                            <p><strong>Error:</strong> ${error}</p>
                            <p><strong>URL:</strong> acciones/members/guardar_opciones.php</p>
                            <hr>
                            <p><strong>Respuesta del servidor:</strong></p>
                            <pre style="background: #f3f4f6; padding: 10px; border-radius: 5px; overflow-x: auto; max-height: 200px;">${xhr.responseText || 'Sin respuesta'}</pre>
                        </div>
                    `;
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de Servidor',
                        html: errorDetails,
                        confirmButtonColor: '#3b82f6',
                        width: '600px'
                    });
                    
                    console.error('Error AJAX completo:', {
                        status: xhr.status,
                        statusText: status,
                        error: error,
                        response: xhr.responseText,
                        url: 'acciones/members/guardar_opciones.php'
                    });
                }
            });
        }
    });
}

$(document).ready(function() {
    // Cargar opciones cuando se abre el modal
    $('#editarModalopciones').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        const memberId = button.data('id');
        
        if (!memberId) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo obtener el ID del plan',
                confirmButtonColor: '#3b82f6'
            });
            return;
        }
        
        $('#member-id-opciones').val(memberId);
        
        Swal.fire({
            title: 'Cargando...',
            text: 'Obteniendo opciones del plan',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        $.ajax({
            url: 'acciones/members/obtener_opciones.php',
            type: 'GET',
            data: { member_id: memberId },
            dataType: 'json',
            success: function(response) {
                Swal.close();
                
                if (response.success) {
                    for (let i = 1; i <= 4; i++) {
                        $(`#opcion-id-${i}`).val('');
                        $(`#opcion-texto-${i}`).val('');
                    }
                    
                    if (response.data && response.data.length > 0) {
                        response.data.forEach(opcion => {
                            const num = opcion.opcion_numero;
                            $(`#opcion-id-${num}`).val(opcion.id);
                            $(`#opcion-texto-${num}`).val(opcion.opcion_texto);
                        });
                    }
                    
                    if (typeof Toast !== 'undefined') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Opciones cargadas correctamente'
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Sin opciones',
                        text: 'Este plan aún no tiene opciones configuradas. Puedes crearlas ahora.',
                        confirmButtonColor: '#3b82f6'
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.close();
                
                let errorDetails = `
                    <div style="text-align: left; font-size: 0.9em;">
                        <p><strong>Estado HTTP:</strong> ${xhr.status}</p>
                        <p><strong>Mensaje:</strong> ${status}</p>
                        <p><strong>Error:</strong> ${error}</p>
                        <p><strong>URL:</strong> acciones/members/obtener_opciones.php</p>
                        <hr>
                        <p><strong>Respuesta del servidor:</strong></p>
                        <pre style="background: #f3f4f6; padding: 10px; border-radius: 5px; overflow-x: auto; max-height: 200px;">${xhr.responseText || 'Sin respuesta'}</pre>
                    </div>
                `;
                
                Swal.fire({
                    icon: 'error',
                    title: 'Error de Conexión',
                    html: errorDetails,
                    confirmButtonColor: '#3b82f6',
                    width: '600px'
                });
                
                console.error('Error AJAX completo:', {
                    status: xhr.status,
                    statusText: status,
                    error: error,
                    response: xhr.responseText,
                    url: 'acciones/members/obtener_opciones.php'
                });
            }
        });
    });
});
</script>