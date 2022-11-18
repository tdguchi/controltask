<form id="edit-form" action="<?php echo $action; ?>" method="post">
    <div class="modal-header">
        <h5 class="h5-title"><?= isset($subtitulo) ? $subtitulo : '' ?><span style="color:#ffffff"><?= isset($data_fields['nombre']) ? $data_fields['nombre'] : "" ?></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="form-soaga">
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="fechahora">Fecha Hora</label>
                        <input type="text" class="form-control" name="<?= 'fechahora' ?>" id="<?= 'fechahora' ?>" value="<?= $data_fields['fechahora'] ?>" />

                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="asistenciatipo_id">Tipo De Asistencia</label>
                        <input type="number" class="form-control" name="<?= 'asistenciatipo_id' ?>" id="<?= 'asistenciatipo_id' ?>" value="<?= $data_fields['asistenciatipo_id'] ?>" />

                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="usuario_id">Operador</label>
                        <input type="number" class="form-control" name="<?= 'usuario_id' ?>" id="<?= 'usuario_id' ?>" value="<?= $data_fields['usuario_id'] ?>" />

                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="comentario">Comentario</label>
                        <input type="text" class="form-control" name="<?= 'comentario' ?>" id="<?= 'comentario' ?>" value="<?= $data_fields['comentario'] ?>" />

                    </div>
                </div>
                <input type="hidden" name="asistencia_id" value="<?php echo $data_fields['asistencia_id']; ?>" />
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" data-bs-dismiss="modal" class="btn btn-outline-black waves-effect waves-light me-3">Cancelar</a>
        <button type="submit" onclick="javascript: $('.add-btn').prop('disabled', true);$('#edit-form').submit();" class="btn btn-green add-btn"><i class="ri-save-line align-bottom ms-2"></i> Guardar</button>
    </div>
</form>

<script>
    $(function() {
        $(".modal select").select2({
            dropdownParent: $('.modal')
        });
    })
</script>