<form id="edit-form" action="<?php echo $action; ?>" method="post">
    <div class="modal-header">
        <h5 title="<?= isset($data_fields['nombre']) ? $data_fields['nombre'] : "" ?>" class="h5-title"><?= isset($subtitulo) ? $subtitulo : '' ?><span style="color:#ffffff"><?= isset($data_fields['nombre']) ? $data_fields['nombre'] : "" ?></span></h5>
        <button title="Cerrar" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div><?= isset($data_fields['nombre']) ? $data_fields['nombre'] : "" ?>
    <div class="modal-body">
        <div class="form-soaga">
            <div class="row">
                <div class="col-12">
                    <h4 title="<?= $texto ?>"><?= $texto ?></h4>
                    <div class="mb-3">
                        <label title="Etiqueta comentario" for="comentario">Comentario</label>
                        <input title="Input comentario" type="text" class="form-control" name="<?= 'comentario' ?>" id="<?= 'comentario' ?>" value="<?= $data_fields['comentario'] ?>" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a title="Cancelar" href="#" data-bs-dismiss="modal" class="btn btn-outline-black waves-effect waves-light me-3">Cancelar</a>
        <button title="Guardar" type="submit" class="btn btn-green add-btn"><i class="ri-save-line align-bottom ms-2"></i> Guardar</button>
    </div>
</form>

<script>
    $(function() {
        $(".modal select").select2({
            dropdownParent: $('.modal')
        });
    })
</script>