<form id="edit-form" action="<?php echo $action; ?>" method="post">
<?= csrf_field() ?>
    <div class="modal-header">
        <h5 class="h5-title"><?= isset($subtitulo) ? $subtitulo : '' ?><span style="color:#ffffff"><?= isset($data_fields['nombre']) ? $data_fields['nombre'] : "" ?></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="form-soaga">
            <div class="row">
                <?php if (!($fun == "create")) : ?>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="key">Clave</label>
                            <input type="text" class="form-control" name="<?= 'key' ?>" id="<?= 'key' ?>" value="<?= $data_fields['key'] ?>" readonly />

                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="value">Valor</label>
                        <input type="text" class="form-control" name="<?= 'value' ?>" id="<?= 'value' ?>" value="<?= $data_fields['value'] ?>" />

                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="description">Descripción</label>
                        <input type="text" class="form-control" name="<?= 'description' ?>" id="<?= 'description' ?>" value="<?= $data_fields['description'] ?>" />

                    </div>
                </div>
                <input type="hidden" name="key" value="<?php echo $data_fields['key']; ?>" />
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" data-bs-dismiss="modal" class="btn btn-outline-black waves-effect waves-light me-3">Cancelar</a>
        <button type="submit" class="btn btn-green add-btn"><i class="ri-save-line align-bottom ms-2"></i> Guardar</button>
    </div>
</form>

<script>
    $(function() {
        $(".modal select").select2({
            dropdownParent: $('.modal')
        });
    })
</script>