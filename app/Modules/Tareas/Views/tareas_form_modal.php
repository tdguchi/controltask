<form id="edit-form" action="<?php echo $action; ?>" method="post">
<?= csrf_field() ?>
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
                            <label for="tarea_id">Tarea ID</label>
                            <input type="text" class="form-control" name="<?= 'tarea_id' ?>" id="<?= 'tarea_id' ?>" value="<?= $data_fields['tarea_id'] ?>" readonly />

                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="proyecto_id">Proyecto</label>
                        <select class="form-select" name="<?= 'proyecto_id' ?>" id="<?= 'proyecto_id' ?>" required>
                            <option value="<?= isset($data_fields['proyecto_id']) ? $data_fields['proyecto_id']: "" ?>"><?isset($data_fields['proyecto_titulo'])?$data_fields['proyecto_titulo']:"Seleccione"?></option>
                            <?php foreach ($listado_proyectos as $proyecto) : ?>
                                <option value="<?= $proyecto->proyecto_id ?>"><?= $proyecto->titulo ?></option>
                            <?php endforeach; ?>
                        </select>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="usuario_id">Operador</label>
                        <select class="form-select" name="<?= 'usuario_id' ?>" id="<?= 'usuario_id' ?>" required>
                            <option value="<?= isset($data_fields['usuario_id'])? $data_fields['usuario_id']: "" ?>"><?= isset($data_fields['usuario_nombre'])?$data_fields['usuario_nombre']:"Seleccione"?></option>
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
                        <label for="fechaobjetivo">Fecha Objetivo</label>
                        <input type="date" class="form-control" name="<?= 'fechaobjetivo' ?>" id="<?= 'fechaobjetivo' ?>" value="1970-01-01" required />

                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="fechaestimada">Fecha Estimada</label>
                        <input type="date" class="form-control" name="<?= 'fechaestimada' ?>" id="<?= 'fechaestimada' ?>" value="1970-01-01" required />

                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="horasestimadas">Horas Estimadas</label>
                        <input type="number" class="form-control" name="<?= 'horasestimadas' ?>" id="<?= 'horasestimadas' ?>" value="<?= $data_fields['horasestimadas'] ?>" required />

                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="fechacomienzo">Fecha Comienzo</label>
                        <input type="text" class="form-control" name="<?= 'fechacomienzo' ?>" id="<?= 'fechacomienzo' ?>" value="<?= $data_fields['fechacomienzo'] ?>" />

                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="fecharealcierre">Fecha Real Cierre</label>
                        <input type="text" class="form-control" name="<?= 'fecharealcierre' ?>" id="<?= 'fecharealcierre' ?>" value="<?= $data_fields['fecharealcierre'] ?>" />

                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="horasreales">Horas Reales</label>
                        <input type="number" class="form-control" name="<?= 'horasreales' ?>" id="<?= 'horasreales' ?>" value="<?= $data_fields['horasreales'] ?>" />

                    </div>
                </div>
                <input type="hidden" name="tarea_id" value="<?php echo $data_fields['tarea_id']; ?>" />
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