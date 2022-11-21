<div class="main-content">
    <div class="page-content">
        <form id="edit-form" class="container-fluid" action="<?php echo $action; ?>" method="post">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h5 class="card-title mb-0 flex-grow-1 h5-title"><?= isset($subtitulo) ? $subtitulo : '' ?><span style="color:#ffffff"><?= isset($data_fields['nombre']) ? $data_fields['nombre'] : "" ?></span></h5>
                                <div class="flex-shrink-0">
                                    <!-- Botón para cancelar -->
                                    <a href="<?= $from ? site_url($from) : site_url('settings') ?>" class="btn btn-outline-black waves-effect waves-light me-3">
                                        Cancelar
                                    </a>
                                    <!-- Botón para guardar -->
                                    <button type="submit" onclick="javascript: $('.add-btn').prop('disabled', true);$('#edit-form').submit();" class="btn btn-green add-btn"><i class="ri-save-line align-bottom ms-2"></i> Guardar</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card mb-0 border-0">
                                        <div class="card-body p-0">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-end">
                                <div class="flex-shrink-0">
                                    <!-- Botón para cancelar -->
                                    <a href="<?= $from ? site_url($from) : site_url('settings') ?>" class="btn btn-outline-black waves-effect waves-light me-3">
                                        Cancelar
                                    </a>
                                    <!-- Botón para guardar -->
                                    <button type="submit" onclick="javascript: $('.add-btn').prop('disabled', true);$('#edit-form').submit();" class="btn btn-green add-btn"><i class="ri-save-line align-bottom ms-2"></i> Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(function() {
        $("select").select2();
    })
</script>