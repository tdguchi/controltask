<form id="edit-form" action="<?php echo $action; ?>" method="post">
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
                            <label for="menu_id">#</label>
                            <input type="text" class="form-control" name="<?= 'menu_id' ?>" id="<?= 'menu_id' ?>" value="<?= $data_fields['menu_id'] ?>" readonly />

                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="text">Texto</label>
                        <input type="text" class="form-control" name="<?= 'text' ?>" id="<?= 'text' ?>" value="<?= $data_fields['text'] ?>" />

                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="url">URL</label>
                        <input type="text" class="form-control" name="<?= 'url' ?>" id="<?= 'url' ?>" value="<?= $data_fields['url'] ?>" />

                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="position">Posición</label>
                        <input type="number" class="form-control" name="<?= 'position' ?>" id="<?= 'position' ?>" value="<?= $data_fields['position'] ?>" />

                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="parent">Padre</label>
                        <select class="form-control" name="parent" id="parent">
                            <option value=''>Seleccionar Parent</option><? foreach ($s_parent as $c) {
                                                                        ?>
                                <option value="<?= $c->menu_id ?>" <?= $c->menu_id == $data_fields['parent'] ? 'selected="selected"' : '' ?>><?= $c->text ?></option>
                            <?
                                                                        } ?>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="icon">Icono</label>
                        <input type="text" class="form-control" name="<?= 'icon' ?>" id="<?= 'icon' ?>" value="<?= $data_fields['icon'] ?>" />

                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="show_in_menu">¿Menú?</label>
                        <input type="checkbox" name="<?= 'show_in_menu' ?>" id="<?= 'show_in_menu' ?>" value="1" <?= $data_fields['show_in_menu'] == "1" ? "checked" : "" ?>>

                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="show_in_dashboard">¿Dashboard?</label>
                        <input type="checkbox" name="<?= 'show_in_dashboard' ?>" id="<?= 'show_in_dashboard' ?>" value="1" <?= $data_fields['show_in_dashboard'] == "1" ? "checked" : "" ?>>

                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="dashboard_description">Descripción</label>
                        <textarea class="form-control" rows="7" name="<?= 'dashboard_description' ?>" id="<?= 'dashboard_description' ?>"><?= $data_fields['dashboard_description'] ?></textarea>

                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="admin_only">Solo Administrador</label>
                        <input type="checkbox" name="<?= 'admin_only' ?>" id="<?= 'admin_only' ?>" value="1" <?= $data_fields['admin_only'] == "1" ? "checked" : "" ?>>

                    </div>
                </div>
                <input type="hidden" name="menu_id" value="<?php echo $data_fields['menu_id']; ?>" />
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