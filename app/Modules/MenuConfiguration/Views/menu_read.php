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
                                                <a href="<?= $from ? site_url($from) : site_url('menuconfiguration') ?>" class="btn btn-outline-black waves-effect waves-light ms-3 back-btn"><i class="ri-arrow-left-line align-bottom me-1"></i> Volver</a>
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
                                    <a href="<?php echo site_url('menuconfiguration/update/' . $data_fields['menu_id']) ?>" class="btn btn-black"><i class="ri-edit-box-line align-bottom me-1"></i><span class="d-none d-sm-inline-block text-capitalize">Editar <?= $titulo ?></span></a>
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
                                                            <th scope="row">#</th>
                                                            <td><?= $data_fields['menu_id'] ?>
                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Texto</th>
                                                            <td><?= $data_fields['text'] ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">URL</th>
                                                            <td><a href="/<?= $data_fields['url'] ?>" target="_blank"><?= $data_fields['url'] ?></a></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Posición</th>
                                                            <td><?= $data_fields['position'] ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Parent</th>
                                                            <td><? foreach ($s_parent as $c) {
                                                                    if ($c->menu_id == $data_fields['parent']) {
                                                                        echo $c->text;
                                                                    }
                                                                } ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Icono</th>
                                                            <td><?= $data_fields['icon'] ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">¿Menú?</th>
                                                            <td><input type="checkbox" disabled <?= $data_fields['show_in_menu'] == "1" ? "checked" : "" ?> value="<?= $data_fields['show_in_menu'] ?>"></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">¿Dashboard?</th>
                                                            <td><input type="checkbox" disabled <?= $data_fields['show_in_dashboard'] == "1" ? "checked" : "" ?> value="<?= $data_fields['show_in_dashboard'] ?>"></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Descripción</th>
                                                            <td><a href="#" onClick="$('#t1918374999').toggle()"><?= substr($data_fields['dashboard_description'], 0, 50) ?>...</a>
                                                                <div id="t1918374999" style="display:none"><?= $data_fields['dashboard_description'] ?></div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" class="font-weight-bold">Solo Administrador</th>
                                                            <td><input type="checkbox" disabled <?= $data_fields['admin_only'] == "1" ? "checked" : "" ?> value="<?= $data_fields['admin_only'] ?>"></td>
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