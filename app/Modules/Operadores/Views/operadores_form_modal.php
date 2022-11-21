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