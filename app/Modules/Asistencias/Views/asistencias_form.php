<div class="main-content">
    <div class="page-content">
        <form id="edit-form" class="container-fluid" action="<?php echo $action; ?>" method="post">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h5 class="card-title mb-0 flex-grow-1 h5-title"><?= isset($subtitulo) ? $subtitulo : '' ?><span style="color:#ffffff"><?= isset($data_fields['nombre']) ? $data_fields['nombre'] : "" ?></span></h5>
                            </div>
                        </div>
                        <div class="card-body">
                        <div class="row">
                                <div class="col-12">
                                    <div class="mb-12">
                                        <h3 class="h1-title">Tu último registro hoy ha sido 2: <?= $ultima->nombre?></h3>
                                    </div>
                                </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-12">
                                    <h3 class="h1-title">Necesitas registrar una entrada para poder usar la aplicación</h3>

                                        <? if ($ultima->asistenciatipo_id == 0 ) { ?>
                                            <h3 class="h1-title">¿Quieres fichar la salida?</h3>
                                        <? } else { ?>
                                            <h3 class="h1-title">¿Quieres fichar la entrada?</h3>
                                        <?}?>
                                    </div>
                                </div>
                                <input type="hidden" name="asistencia_id" value="<?php echo $data_fields['asistencia_id']; ?>" />
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card mb-0 border-0">
                                        <div class="card-body p-0">
                                            <div class="form-soaga">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="comentario">Comentario (opcional)</label>
                                                            <input type="text" class="form-control" name="<?= 'comentario' ?>" id="<?= 'comentario' ?>" value="<?= $data_fields['comentario'] ?>" />
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="asistencia_id" value="<?php echo $data_fields['asistencia_id']; ?>" />
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
                                    <a href="<?= $from ? site_url($from) : site_url('asistencias') ?>" class="btn btn-outline-black waves-effect waves-light me-3">
                                        Cancelar
                                    </a>
                                    <!-- Botón para guardar -->
                                    <button type="submit" onclick="javascript: $('.add-btn').prop('disabled', true);$('#edit-form').submit();" class="btn btn-green add-btn"><i class="ri-save-line align-bottom ms-2"></i> Registrar</button>
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