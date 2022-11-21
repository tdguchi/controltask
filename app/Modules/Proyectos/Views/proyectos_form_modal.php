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
                            <label for="proyecto_id">Proyecto ID</label>
                            <input type="text" class="form-control" name="<?= 'proyecto_id' ?>" id="<?= 'proyecto_id' ?>" value="<?= $data_fields['proyecto_id'] ?>" readonly />

                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="titulo">Titulo</label>
                        <input type="text" class="form-control" name="<?= 'titulo' ?>" id="<?= 'titulo' ?>" value="<?= $data_fields['titulo'] ?>" required />

                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="descripcion">Descripcion</label>
                        <textarea class="form-control" rows="7" name="<?= 'descripcion' ?>" id="<?= 'descripcion' ?>" required><?= $data_fields['descripcion'] ?></textarea>

                    </div>
                </div>
                <input type="hidden" name="proyecto_id" value="<?php echo $data_fields['proyecto_id']; ?>" />
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