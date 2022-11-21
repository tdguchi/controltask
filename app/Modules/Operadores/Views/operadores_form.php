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
                                    <a href="<?= $from ? site_url($from) : site_url('operadores') ?>" class="btn btn-outline-black waves-effect waves-light me-3">
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
                                                                <label for="operador_id">Operador Id</label>
                                                                <input type="text" class="form-control" name="<?= 'operador_id' ?>" id="<?= 'operador_id' ?>" value="<?= $data_fields['operador_id'] ?>" readonly />

                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="nombre">Nombre</label>
                                                            <input type="text" class="form-control" name="<?= 'nombre' ?>" id="<?= 'nombre' ?>" value="<?= $data_fields['nombre'] ?>" required />

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="apellidos">Apellidos</label>
                                                            <input type="text" class="form-control" name="<?= 'apellidos' ?>" id="<?= 'apellidos' ?>" value="<?= $data_fields['apellidos'] ?>" required />

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="dni">Dni</label>
                                                            <input type="text" class="form-control" name="<?= 'dni' ?>" id="<?= 'dni' ?>" value="<?= $data_fields['dni'] ?>" required />

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="email">Email</label>
                                                            <input type="text" class="form-control" name="<?= 'email' ?>" id="<?= 'email' ?>" value="<?= $data_fields['email'] ?>" required />

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="password">Password</label>
                                                            <input type="text" class="form-control" name="<?= 'password' ?>" id="<?= 'password' ?>" value="<?= $data_fields['password'] ?>" required />

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="entrada_manana">Entrada Mañana</label>
                                                            <input type="text" class="form-control" name="<?= 'entrada_manana' ?>" id="<?= 'entrada_manana' ?>" value="<?= $data_fields['entrada_manana'] ?>" required />

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="salida_manana">Salida Mañana</label>
                                                            <input type="text" class="form-control" name="<?= 'salida_manana' ?>" id="<?= 'salida_manana' ?>" value="<?= $data_fields['salida_manana'] ?>" required />

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="entrada_tarde">Entrada Tarde</label>
                                                            <input type="text" class="form-control" name="<?= 'entrada_tarde' ?>" id="<?= 'entrada_tarde' ?>" value="<?= $data_fields['entrada_tarde'] ?>" required />

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="salida_tarde">Salida Tarde</label>
                                                            <input type="text" class="form-control" name="<?= 'salida_tarde' ?>" id="<?= 'salida_tarde' ?>" value="<?= $data_fields['salida_tarde'] ?>" required />

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="entrada_verano_manana">Entrada Verano Mañana</label>
                                                            <input type="text" class="form-control" name="<?= 'entrada_verano_manana' ?>" id="<?= 'entrada_verano_manana' ?>" value="<?= $data_fields['entrada_verano_manana'] ?>" />

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="salida_verano_manana">Salida Verano Mañana</label>
                                                            <input type="text" class="form-control" name="<?= 'salida_verano_manana' ?>" id="<?= 'salida_verano_manana' ?>" value="<?= $data_fields['salida_verano_manana'] ?>" />

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="entrada_verano_tarde">Entrada Verano Tarde</label>
                                                            <input type="text" class="form-control" name="<?= 'entrada_verano_tarde' ?>" id="<?= 'entrada_verano_tarde' ?>" value="<?= $data_fields['entrada_verano_tarde'] ?>" />

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="salida_verano_tarde">Salida Verano Tarde</label>
                                                            <input type="text" class="form-control" name="<?= 'salida_verano_tarde' ?>" id="<?= 'salida_verano_tarde' ?>" value="<?= $data_fields['salida_verano_tarde'] ?>" />

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="tipo">Tipo</label>
                                                            <input type="number" class="form-control" name="<?= 'tipo' ?>" id="<?= 'tipo' ?>" value="<?= $data_fields['tipo'] ?>" required />

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="activado">Activado</label>
                                                            <input type="checkbox" name="<?= 'activado' ?>" id="<?= 'activado' ?>" value="1" <?= $data_fields['activado'] == "1" ? "checked" : "" ?> required>

                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="operador_id" value="<?php echo $data_fields['operador_id']; ?>" />
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
                                    <a href="<?= $from ? site_url($from) : site_url('operadores') ?>" class="btn btn-outline-black waves-effect waves-light me-3">
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