<div class="main-content">
    <div class="page-content">
        <?php if (isset($message)) : ?>
            <div class="form-group mb-3 alert alert-warning"><?= $message ?></div>
        <?php endif; ?>
        <form id="edit-form" class="container-fluid" action="<?php echo $action; ?>" method="post">
        <?= csrf_field() ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h5 class="card-title mb-0 flex-grow-1 h5-title"><?= isset($subtitulo) ? $subtitulo : '' ?><?php echo daFormato(isset($data_fields['nombre']) ? $data_fields['nombre'] : "", 'varchar', '0-#ffffff', '') ?></h5>
                                <div class="flex-shrink-0">
                                    <!-- Botón para cancelar -->
                                    <a href="<?php echo site_url('users') ?>" class="btn btn-outline-black waves-effect waves-light me-3">
                                        Cancelar
                                    </a>
                                    <!-- Botón para guardar -->
                                    <button type="submit" class="btn btn-green add-btn"><i class="ri-save-line align-bottom ms-2"></i> Guardar</button>
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
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="username">Nombre de usuario</label>
                                                            <?php if (($fun == "create")) : ?>
                                                                <?= daFormatoEdit($data_fields['username'], 'username', 'Identity', 'varchar', 'varchar', 1, 0); ?>
                                                            <?php else : ?>
                                                                <input type="text" class="form-control" disabled value="<?= $data_fields['username'] ?>">
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="password">Contraseña</label>
                                                            <?= daFormatoEdit($data_fields['password'], 'password', 'Contraseña', 'varchar', 'password', 0, 0); ?>

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="repeat_password">Repetir Contraseña</label>
                                                            <?= daFormatoEdit($data_fields['password'], 'repeat_password', 'Repetir Contraseña', 'varchar', 'password', 0, 0); ?>

                                                        </div>
                                                        <?php if (($fun == "update")) : ?>
                                                            <div class="col-12">
                                                                <div class="mb-3">
                                                                    <label>Miembro de grupos</label>
                                                                </div>
                                                            </div>
                                                            <?php foreach ($groups as $g) : ?>
                                                                <div class="col-12">
                                                                    <div class="mb-3">
                                                                        <input type="checkbox" id="group_<?= $g->id ?>" name="groups[]" value="<?= $g->id ?>" <?= in_array($g->id, $active_groups) ? "checked" : "" ?>>
                                                                        <label for="group_<?= $g->id ?>"><?= $g->name ?></label>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                        <input type="hidden" name="id" value="<?php echo $data_fields['id']; ?>" />
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="first_name">Nombre</label>
                                                            <?= daFormatoEdit($data_fields['first_name'], 'first_name', 'Nombre', 'varchar', 'varchar', 1, 0); ?>

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="last_name">Apellidos</label>
                                                            <?= daFormatoEdit($data_fields['last_name'], 'last_name', 'Apellidos', 'varchar', 'varchar', 1, 0); ?>

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
                                                            <label for="company">Compañía</label>
                                                            <?= daFormatoEdit($data_fields['company'], 'company', 'Compañía', 'varchar', 'varchar', 0, 0); ?>

                                                        </div>
                                                    </div>
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label for="email">Email</label>
                                                                <?= daFormatoEdit($data_fields['email'], 'email', 'Email', 'varchar', 'varchar', 1, 0); ?>

                                                            </div>
                                                        </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="phone">Teléfono</label>
                                                            <?= daFormatoEdit($data_fields['phone'], 'phone', 'Teléfono', 'varchar', 'varchar', 0, 0); ?>

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="entrada_manana">Entrada Mañana</label>
                                                            <input type="time" min="08:00" max="15:00" class="form-control" name="<?= 'entrada_manana' ?>" id="<?= 'entrada_manana' ?>" value="<?= $data_fields['entrada_manana'] ?>" />

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="salida_manana">Salida Mañana</label>
                                                            <input type="time" min="08:00" max="15:00" class="form-control" name="<?= 'salida_manana' ?>" id="<?= 'salida_manana' ?>" value="<?= $data_fields['salida_manana'] ?>" />

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="entrada_tarde">Entrada Tarde</label>
                                                            <input type="time" min="14:00" max="18:00" class="form-control" name="<?= 'entrada_tarde' ?>" id="<?= 'entrada_tarde' ?>" value="<?= $data_fields['entrada_tarde'] ?>" />

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="salida_tarde">Salida Tarde</label>
                                                            <input type="time" min="14:00" max="18:00" class="form-control" name="<?= 'salida_tarde' ?>" id="<?= 'salida_tarde' ?>" value="<?= $data_fields['salida_tarde'] ?>" />

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="entrada_verano_manana">Entrada Verano Mañana</label>
                                                            <input type="time" min="08:00" max="16:00" class="form-control" name="<?= 'entrada_verano_manana' ?>" id="<?= 'entrada_verano_manana' ?>" value="<?= $data_fields['entrada_verano_manana'] ?>" />

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="salida_verano_manana">Salida Verano Mañana</label>
                                                            <input type="time" min="08:00" max="16:00" class="form-control" name="<?= 'salida_verano_manana' ?>" id="<?= 'salida_verano_manana' ?>" value="<?= $data_fields['salida_verano_manana'] ?>" />

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="entrada_verano_tarde">Entrada Verano Tarde</label>
                                                            <input type="time" min="14:00" max="22:00" class="form-control" name="<?= 'entrada_verano_tarde' ?>" id="<?= 'entrada_verano_tarde' ?>" value="<?= $data_fields['entrada_verano_tarde'] ?>" />

                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="salida_verano_tarde">Salida Verano Tarde</label>
                                                            <input type="time" min="14:00" max="22:00" type="text" class="form-control" name="<?= 'salida_verano_tarde' ?>" id="<?= 'salida_verano_tarde' ?>" value="<?= $data_fields['salida_verano_tarde'] ?>" />

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
                                        <!-- Botón para cancelar -->
                                        <a href="<?php echo site_url('users') ?>" class="btn btn-outline-black waves-effect waves-light me-3">
                                            Cancelar
                                        </a>
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
        $('form').on('submit', function() {
            $('.add-btn').prop('disabled', true);
        });
    });
</script>