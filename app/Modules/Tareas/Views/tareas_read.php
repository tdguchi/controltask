<div class="<?= $modal ? "" : "main-content" ?>">
    <div class="<?= $modal ? "" : "page-content page-content-top-fix" ?>">
        <div class="container-fluid">
            <?php if (!$modal) : ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card ms-n4 border-0 block-explotacion">
                            <div class="bg-light-blue border-top-grey">
                                <div class="card-body ps-4">
                                    <div class="row">
                                        <div class="col-md-auto">
                                            <div class="hstack gap-1 flex-wrap">
                                                <a href="<?= $from ? site_url($from) : site_url('tareas') ?>" class="btn btn-outline-black waves-effect waves-light ms-3 back-btn"><i class="ri-arrow-left-line align-bottom me-1"></i> Volver</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row" style="margin-top:100px;">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title mb-0 flex-grow-1 h5-title text-capitalize"><?= isset($subtitulo) ? $subtitulo : '' ?><span style="color:#ffffff"><?= isset($data_fields['nombre']) ? $data_fields['nombre'] : "" ?></span></h4>
                                <div class="flex-shrink-0">
                                    <a href="<?php echo site_url('tareas/update/' . $data_fields['tarea_id']) ?>" class="btn btn-black"><i class="ri-edit-box-line align-bottom me-1"></i><span class="d-none d-sm-inline-block text-capitalize">Editar <?= $titulo ?></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-<?= $modal ? "12" : "5" ?> col-lg-<?= $modal ? "12" : "6" ?>">
                                    <div class="card mb-0">
                                        <div class="card-body p-0">
                                            <div class="table-responsive">
                                                <table class="table align-middle table-nowrap table-vista mb-0">
                                                    <tbody>

                                                        <tr>
                                                            <th scope="row">Tarea ID</th>
                                                            <td><?= $data_fields['tarea_id'] ?>
                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Estado</th>
                                                            <td><?= $data_fields['estado'] ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Operador</th>
                                                            <td><?= $data_fields['usuario_id'] ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Usuarios Adicionales</th>
                                                            <td><?= $data_fields['usuariosadicionales'] ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Titulo</th>
                                                            <td><?= $data_fields['titulo'] ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Descripción</th>
                                                            <td><a href="#" onClick="$('#t969417540').toggle()"><?= substr($data_fields['descripcion'], 0, 50) ?>...</a>
                                                                <div id="t969417540" style="display:none"><?= $data_fields['descripcion'] ?></div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Fecha Objetivo</th>
                                                            <td><?= date("d/m/Y", strtotime($data_fields['fechaobjetivo'])) ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Fecha Estimada</th>
                                                            <td><?= date("d/m/Y", strtotime($data_fields['fechaestimada'])) ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Horas Estimadas</th>
                                                            <td><?= $data_fields['horasestimadas'] ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Fecha Comienzo</th>
                                                            <td><?= date("d/m/Y H:i:s", strtotime($data_fields['fechacomienzo'])) ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Fecha Real Cierre</th>
                                                            <td><?= date("d/m/Y H:i:s", strtotime($data_fields['fecharealcierre'])) ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Horas Reales</th>
                                                            <td><?= $data_fields['horasreales'] ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>