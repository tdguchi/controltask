<!DOCTYPE HTML>

<html>

<head>
    <meta charset="utf-8" />
    <title><?= isset($title) ? $title : 'ControlTask' ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="<?= isset($description) ? $description : '' ?>">

    <script src="<?= base_url() ?>/assets/js/jquery-3.6.0.min.js"></script>
    <!-- Layout config Js -->
    <script src="<?= base_url() ?>/assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?= base_url() ?>/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url() ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url() ?>/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?= base_url() ?>/assets/css/custom.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- JAVASCRIPT -->
    <script src="<?= base_url() ?>/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url() ?>/assets/libs/node-waves/waves.min.js"></script>
    <script src="<?= base_url() ?>/assets/libs/feather-icons/feather.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="<?= base_url() ?>/assets/js/plugins.js"></script>

    <script src="<?= base_url() ?>/assets/libs/select2/select2.min.js"></script>
    <link href="<?= base_url() ?>/assets/libs/select2/select2.min.css" id="app-style" rel="stylesheet" type="text/css" />
</head>

    <body>
    <header id="page-topbar">
        <div class="layout-width">
        <h1>Bienvenido a teconsite</h1>
        <h3>Necesitamos que configures tus horas de entrara y salida</h3>
        </div>
    </header>
    <div class="main-content">
    <div class="page-content">
    <?php if (isset($message)) : ?>
            <div class="form-group mb-3 alert alert-warning"><?= $message ?></div>
        <?php endif; ?>
        <form id="edit-form" class="container-fluid" action="<?php echo $action; ?>" method="post">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h5 class="card-title mb-0 flex-grow-1 h5-title"><?= isset($subtitulo) ? $subtitulo : '' ?><span style="color:#ffffff"><?= isset($data_fields['nombre']) ? $data_fields['nombre'] : "" ?></span></h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card mb-0 border-0">
                                        <div class="card-body p-0">
                                            <div class="form-soaga">
                                                <div class="row">
                                                <div class="col-12">
                                                        <div class="mb-1">
                                                            <label for="entrada_manana">Entrada mañana</label>
                                                            <input type="time" min="08:00" max="15:00" class="form-control" name="<?= 'entrada_manana' ?>" id="<?= 'entrada_manana' ?>" value="<?= $data_fields['entrada_manana'] ?>" required/>

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-1">
                                                            <label for="salida_manana">Salida manaña</label>
                                                            <input type="time" min="08:00" max="15:00" class="form-control" name="<?= 'salida_manana' ?>" id="<?= 'salida_manana' ?>" value="<?= $data_fields['salida_manana'] ?>" required/>

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-1">
                                                            <label for="entrada_tarde">Entrada tarde</label>
                                                            <input type="time" min="14:00" max="18:00"  class="form-control" name="<?= 'entrada_tarde' ?>" id="<?= 'entrada_tarde' ?>" value="<?= $data_fields['entrada_tarde'] ?>" required/>

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-1">
                                                            <label for="salida_tarde">Salida tarde</label>
                                                            <input type="time" min="14:00" max="18:00" class="form-control" name="<?= 'salida_tarde' ?>" id="<?= 'salida_tarde' ?>" value="<?= $data_fields['salida_tarde'] ?>" required/>

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-1">
                                                            <label for="entrada_verano_manana">Entrada verano mañana</label>
                                                            <input type="time"  class="form-control" name="<?= 'entrada_verano_manana' ?>" id="<?= 'entrada_verano_manana' ?>" value="<?= $data_fields['entrada_verano_manana'] ?>" required/>

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-1">
                                                            <label for="salida_verano_manana">Salida verano manana</label>
                                                            <input type="time" min="14:00" max="18:00" class="form-control" name="<?= 'salida_verano_manana' ?>" id="<?= 'salida_verano_manana' ?>" value="<?= $data_fields['salida_verano_manana'] ?>" required/>

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-1">
                                                            <label for="entrada_verano_tarde">Entrada verano tarde</label>
                                                            <input type="time"  class="form-control" name="<?= 'entrada_verano_tarde' ?>" id="<?= 'entrada_verano_tarde' ?>" value="<?= $data_fields['entrada_verano_tarde'] ?>" required/>

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-1">
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
