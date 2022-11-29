<form id="edit-form" action="<?php echo $action; ?>" method="post">
<?= csrf_field() ?>
    <div class="modal-header">
        <h5 class="h5-title"><span style="color:#ffffff">Añadir un nuevo horario</span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="form-soaga">
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="titulo">Entrada Mañana</label>
                        <input type="time" class="form-control" name="<?= 'entrada_manana' ?>" id="<?= 'entrada_manana' ?>" value="<?= $data_fields['entrada_manana'] ?>" required />

                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="titulo">Salida Mañana</label>
                        <input type="time" class="form-control" name="<?= 'salida_manana' ?>" id="<?= 'salida_manana' ?>" value="<?= $data_fields['salida_manana'] ?>" required />

                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="titulo">Entrada Tarde</label>
                        <input type="time" class="form-control" name="<?= 'entrada_tarde' ?>" id="<?= 'entrada_tarde' ?>" value="<?= $data_fields['entrada_tarde'] ?>" required />

                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="titulo">Salida Tarde</label>
                        <input type="time" class="form-control" name="<?= 'salida_tarde' ?>" id="<?= 'salida_tarde' ?>" value="<?= $data_fields['salida_tarde'] ?>" required />

                    </div>
                </div>
                <input type="hidden" name="horario_id" value="<?php echo $data_fields['horario_id']; ?>" />
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