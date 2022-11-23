<!DOCTYPE HTML>

<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title></title>
    </head>

    <body>
    <div class="main-content">
    <div class="page-content">
    <?php if (isset($message)) : ?>
            <div class="form-group mb-3 alert alert-warning"><?= $message ?></div>
        <?php endif; ?>
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
                                <div class="col-lg-4">
                                    <div class="card mb-0 border-0">
                                        <div class="card-body p-0">
                                            <div class="form-soaga">
                                                <div class="row">
                                                <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="entrada_manana">Entrada manaña</label>
                                                            <input type="time" min="08:00" max="15:00" class="form-control" name="<?= 'entrada_manana' ?>" id="<?= 'entrada_manana' ?>" value="<?= $data_fields['entrada_manana'] ?>" required/>

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="salida_manana">Salida manaña</label>
                                                            <input type="time" min="08:00" max="15:00" class="form-control" name="<?= 'salida_manana' ?>" id="<?= 'salida_manana' ?>" value="<?= $data_fields['salida_manana'] ?>" required/>

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="entrada_tarde">Entrada tarde</label>
                                                            <input type="time" min="14:00" max="18:00"  class="form-control" name="<?= 'entrada_tarde' ?>" id="<?= 'entrada_tarde' ?>" value="<?= $data_fields['entrada_tarde'] ?>" required/>

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="salida_tarde">Salida tarde</label>
                                                            <input type="time" min="14:00" max="18:00" class="form-control" name="<?= 'salida_tarde' ?>" id="<?= 'salida_tarde' ?>" value="<?= $data_fields['salida_tarde'] ?>" required/>

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="entrada_verano_manana">Entrada verano mañana</label>
                                                            <input type="time"  class="form-control" name="<?= 'entrada_verano_manana' ?>" id="<?= 'entrada_verano_manana' ?>" value="<?= $data_fields['entrada_verano_manana'] ?>" required/>

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="salida_verano_manana">Salida verano manana</label>
                                                            <input type="time" min="14:00" max="18:00" class="form-control" name="<?= 'salida_verano_manana' ?>" id="<?= 'salida_verano_manana' ?>" value="<?= $data_fields['salida_verano_manana'] ?>" required/>

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="entrada_verano_tarde">Entrada verano tarde</label>
                                                            <input type="time"  class="form-control" name="<?= 'entrada_verano_tarde' ?>" id="<?= 'entrada_verano_tarde' ?>" value="<?= $data_fields['entrada_verano_tarde'] ?>" required/>

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="salida_verano_tarde">Salida verano tarde</label>
                                                            <input type="time"  class="form-control" name="<?= 'salida_verano_tarde' ?>" id="<?= 'salida_verano_tarde' ?>" value="<?= $data_fields['salida_verano_tarde'] ?>" required/>

                                                        </div>
                                                    </div>
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
                                     <!-- Botón para guardar -->
                                    <button type="submit" class="btn btn-green add-btn"><i class="ri-save-line align-bottom ms-2"></i> Guardar</button>
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

    </body>

</html>
