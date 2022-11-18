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
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" name="<?= 'name' ?>" id="<?= 'name' ?>" value="<?= $data_fields['name'] ?>" required />
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" name="<?= 'description' ?>" id="<?= 'description' ?>" value="<?= $data_fields['description'] ?>" />
                    </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $data_fields['id']; ?>" />
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" data-bs-dismiss="modal" class="btn btn-outline-black waves-effect waves-light me-3">Cancelar</a>
        <button type="submit" onclick="javascript: $('.add-btn').prop('disabled', true);$('#edit-form').submit();" class="btn btn-green add-btn"><i class="ri-save-line align-bottom ms-2"></i> Guardar</button>
    </div>
</form>