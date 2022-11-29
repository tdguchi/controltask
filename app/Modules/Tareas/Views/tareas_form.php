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
                                <h5 class="card-title mb-0 flex-grow-1 h5-title"><?= isset($subtitulo) ? $subtitulo : '' ?><span style="color:#ffffff"><?= isset($data_fields['nombre']) ? $data_fields['nombre'] : "" ?></span></h5>
                                <div class="flex-shrink-0">
                                    <!-- Botón para cancelar -->
                                    <a href="<?= $from ? site_url($from) : site_url('tareas') ?>" class="btn btn-outline-black waves-effect waves-light me-3">
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
                                                                <label for="tarea_id">Tarea ID</label>
                                                                <input type="text" class="form-control" name="<?= 'tarea_id' ?>" id="<?= 'tarea_id' ?>" value="<?= $data_fields['tarea_id'] ?>" readonly />

                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="proyecto_id">Proyecto</label>
                                                            <select class="form-select" name="<?= 'proyecto_id' ?>" id="<?= 'proyecto_id' ?>" required>
                                                                <option value="<?= isset($data_fields['proyecto_id']) ? $data_fields['proyecto_id'] : "" ?>"><?= isset($data_fields['proyecto_titulo']) ? $data_fields['proyecto_titulo'] : "Seleccione" ?></option>
                                                                <?php foreach ($listado_proyectos as $proyecto) : ?>
                                                                    <option value="<?= $proyecto->proyecto_id ?>"><?= $proyecto->titulo ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label for="usuario_id">Operador</label>
                                                                <select class="form-select" name="<?= 'usuario_id' ?>" id="<?= 'usuario_id' ?>" required>
                                                                    <option value="<?= isset($data_fields['usuario_id']) ? $data_fields['usuario_id'] : "" ?>"><?= isset($data_fields['usuario_nombre']) ? $data_fields['usuario_nombre'] : "Seleccione" ?></option>
                                                                    <?php foreach ($listado_usuarios as $usuario) : ?>
                                                                        <option value="<?= $usuario->id ?>"><?= $usuario->first_name ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label for="usuariosadicionales">Usuarios Adicionales</label>
                                                                <input type="text" class="form-control" name="<?= 'usuariosadicionales' ?>" id="<?= 'usuariosadicionales' ?>" value="<?= $data_fields['usuariosadicionales'] ?>" />

                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label for="titulo">Titulo</label>
                                                                <input type="text" class="form-control" name="<?= 'titulo' ?>" id="<?= 'titulo' ?>" value="<?= $data_fields['titulo'] ?>" required />

                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label for="descripcion">Descripción</label>
                                                                <textarea class="form-control" rows="7" name="<?= 'descripcion' ?>" id="<?= 'descripcion' ?>" required><?= $data_fields['descripcion'] ?></textarea>

                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label for="fechaestimada">Fecha Estimada</label>
                                                                <input type="date" class="form-control" name="<?= 'fechaestimada' ?>" id="<?= 'fechaestimada' ?>" value="<?= date_create()->format('Y-m-d') ?>" required />

                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label for="horasestimadas">Horas Estimadas (minutos)</label>
                                                                <input type="number" class="form-control" name="<?= 'horasestimadas' ?>" id="<?= 'horasestimadas' ?>" value="<?= $data_fields['horasestimadas'] ?>" required />

                                                            </div>
                                                        </div>
                                                        <?php if (!($fun == "create")) : ?>
                                                            <div class="col-12">
                                                                <div class="mb-3">
                                                                    <label for="fechacomienzo">Fecha Comienzo</label>
                                                                    <input type="text" class="form-control" name="<?= 'fechacomienzo' ?>" id="<?= 'fechacomienzo' ?>" value="<?= $data_fields['fechacomienzo'] ?>" readonly />

                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="mb-3">
                                                                    <label for="fecharealcierre">Fecha Real Cierre</label>
                                                                    <input type="text" class="form-control" name="<?= 'fecharealcierre' ?>" id="<?= 'fecharealcierre' ?>" value="<?= $data_fields['fecharealcierre'] ?>" readonly />

                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="mb-3">
                                                                    <label for="horasreales">Horas Reales (minutos)</label>
                                                                    <input type="number" class="form-control" name="<?= 'horasreales' ?>" id="<?= 'horasreales' ?>" value="<?= $data_fields['horasreales'] ?>" readonly/>
                                                                <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="tarea_id" value="<?php echo $data_fields['tarea_id']; ?>" />
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
                                        <a href="<?= $from ? site_url($from) : site_url('tareas') ?>" class="btn btn-outline-black waves-effect waves-light me-3">
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