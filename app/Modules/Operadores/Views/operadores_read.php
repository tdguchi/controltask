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
                                                <a href="<?= $from ? site_url($from) : site_url('operadores') ?>" class="btn btn-outline-black waves-effect waves-light ms-3 back-btn"><i class="ri-arrow-left-line align-bottom me-1"></i> Volver</a>
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
                                    <a href="<?php echo site_url('operadores/update/' . $data_fields['operador_id']) ?>" class="btn btn-black"><i class="ri-edit-box-line align-bottom me-1"></i><span class="d-none d-sm-inline-block text-capitalize">Editar <?= $titulo ?></span></a>
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
                                                            <th scope="row">Operador Id</th>
                                                            <td><?= $data_fields['operador_id'] ?>
                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Nombre</th>
                                                            <td><?= $data_fields['nombre'] ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Apellidos</th>
                                                            <td><?= $data_fields['apellidos'] ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Dni</th>
                                                            <td><?= $data_fields['dni'] ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Email</th>
                                                            <td><?= $data_fields['email'] ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Password</th>
                                                            <td><?= $data_fields['password'] ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Entrada Mañana</th>
                                                            <td><?= date("d/m/Y H:i:s", strtotime($data_fields['entrada_manana'])) ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Salida Mañana</th>
                                                            <td><?= date("d/m/Y H:i:s", strtotime($data_fields['salida_manana'])) ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Entrada Tarde</th>
                                                            <td><?= date("d/m/Y H:i:s", strtotime($data_fields['entrada_tarde'])) ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Salida Tarde</th>
                                                            <td><?= date("d/m/Y H:i:s", strtotime($data_fields['salida_tarde'])) ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Entrada Verano Mañana</th>
                                                            <td><?= date("d/m/Y H:i:s", strtotime($data_fields['entrada_verano_manana'])) ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Salida Verano Mañana</th>
                                                            <td><?= date("d/m/Y H:i:s", strtotime($data_fields['salida_verano_manana'])) ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Entrada Verano Tarde</th>
                                                            <td><?= date("d/m/Y H:i:s", strtotime($data_fields['entrada_verano_tarde'])) ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Salida Verano Tarde</th>
                                                            <td><?= date("d/m/Y H:i:s", strtotime($data_fields['salida_verano_tarde'])) ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Tipo</th>
                                                            <td><?= $data_fields['tipo'] ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Activado</th>
                                                            <td><input type="checkbox" disabled <?= $data_fields['activado'] == "1" ? "checked" : "" ?> value="<?= $data_fields['activado'] ?>"></td>
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