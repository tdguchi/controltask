<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <?= view('partials/fichar') ?>
            <?php if (isset($message)) : ?>
                <div class="form-group mb-3 alert alert-success"><?= $message ?></div>
            <?php endif; ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-list-soaga">
                        <div class="card-header border-0">
                            <div class="d-flex align-items-center">
                                <h5 class="card-title mb-0 flex-grow-1 h5-title text-capitalize"><?= $titulo ?> <?= $element ?></h5>
                                <div class="flex-shrink-0">
                                    <?php if (count($group_id) == 2) { ?>
                                        <span class="text-capitalize"><?php echo anchor(site_url('tareas/view/0/1'), 'Propias', 'class="btn btn-green add-btn"'); ?></span>
                                        <span class="text-capitalize"><?php echo anchor(site_url('tareas/view/0/2'), 'Todas', 'class="btn btn-green add-btn"'); ?></span>
                                    <?php } ?>
                                    <?php if ($fichado === true) { ?>
                                        <span class="text-capitalize"><a href=" <?= site_url('tareas/create') ?>" class="btn btn-green add-btn"><i class="ri-add-line align-bottom me-1"></i> Añadir <?= $titulo ?></a></span>
                                        <span class="text-capitalize"><?php echo anchor(site_url('tareas/excel'), 'Exportar Excel', 'class="btn btn-green add-btn"'); ?></span>
                                        <button type="button" id="delete-selected" onclick="deleteSelected();" class="btn btn-outline-red waves-effect waves-light ms-2 d-none bulk-actions">Eliminar Seleccionados</button>
                                    <?php } ?>
                                    <div class="search-box-table ms-2">
                                        <form id="search-box" class="input-group" action="<?php echo site_url('tareas/view'); ?>" method="post">
                                            <?= csrf_field() ?>

                                            <input type="hidden" name="filter" value="<?= $filter == "" ? "" : explode("=", $filter)[1] ?>">
                                            <input type="hidden" name="title" value="<?= $custom_title == "" ? "" : explode("=", $custom_title)[1] ?>">
                                            <input type="text" class="form-control search-c border-black" placeholder="Buscar..." id="q" name="q" value="<?= $q ?>">
                                            <button type="button" onclick="resetSearch();" class="btn btn-ghost-dark waves-effect waves-light"><i class="ri-close-line "></i></button>
                                            <button type="submit" class="btn btn-outline-dark"><i class="ri-search-line search-icon"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="table-responsive table-card mb-1">
                                    <table class="table align-middle table-nowrap">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col" style="width: 50px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                    </div>
                                                </th>
                                                <th class="sort text-capitalize "><a href="<?php echo $accion . '?ob=' . sentidobusquedacrd('titulo', 'tareas.') . $filter . $custom_title; ?>" style="color:inherit;">Titulo <span class="block-sort"><i class="bx <?= $orden_campo == "titulo" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="sort text-capitalize "><a href="<?php echo $accion . '?ob=' . sentidobusquedacrd('proyecto_id', 'tareas.') . $filter . $custom_title; ?>" style="color:inherit;">Proyecto <span class="block-sort"><i class="bx <?= $orden_campo == "proyecto_id" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="sort text-capitalize "><a href="<?php echo $accion . '?ob=' . sentidobusquedacrd('fechaestimada', 'tareas.') . $filter . $custom_title; ?>" style="color:inherit;">Fecha Estimada <span class="block-sort"><i class="bx <?= $orden_campo == "fechaestimada" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="sort text-capitalize "><a href="<?php echo $accion . '?ob=' . sentidobusquedacrd('horasestimadas', 'tareas.') . $filter . $custom_title; ?>" style="color:inherit;"><i class='bx bx-timer fs-15'></i> Estimado <span class="block-sort"><i class="bx <?= $orden_campo == "horasestimadas" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="sort text-capitalize "><a href="<?php echo $accion . '?ob=' . sentidobusquedacrd('horasreales', 'tareas.') . $filter . $custom_title; ?>" style="color:inherit;"><i class='bx bx-timer fs-15'></i> Dedicado <span class="block-sort"><i class="bx <?= $orden_campo == "horasreales" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <? if (count($group_id) == 2) { ?>
                                                    <th class="sort text-capitalize "><a href="<?php echo $accion . '?ob=' . sentidobusquedacrd('fechacomienzo', 'tareas.') . $filter . $custom_title; ?>" style="color:inherit;">Fecha Comienzo <span class="block-sort"><i class="bx <?= $orden_campo == "fechacomienzo" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                    <th class="sort text-capitalize "><a href="<?php echo $accion . '?ob=' . sentidobusquedacrd('fecharealcierre', 'tareas.') . $filter . $custom_title; ?>" style="color:inherit;">Fecha Real Cierre <span class="block-sort"><i class="bx <?= $orden_campo == "fecharealcierre" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <? } ?>
                                                <th class="sort text-capitalize "><a href="<?php echo $accion . '?ob=' . sentidobusquedacrd('texto_estado', 'tareas.') . $filter . $custom_title; ?>" style="color:inherit;">Estado <span class="block-sort"><i class="bx <?= $orden_campo == "texto_estado" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th> Acciones </th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            <? foreach ($tareas_data as $row) { ?>
                                                <tr style="background-color:<?= ($row->estado == 1) ? '#A7FFFE"' : (($row->estado == 2) ? '#D8FAE0"' : '#FFD28E"' ) ?>>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input check-selection" type="checkbox" name="checkAll" value="<?= $row->tarea_id ?>">
                                                        </div>
                                                    </th>
                                                    <td class=" text-left ">
                                                        <div class>
                                                            <div class="flex-grow-1 tasks_name">
                                                                <a class="link-strong" href="#" onclick="loadModalContent('<?= site_url('tareas/read/' . $row->tarea_id) ?>/1')" data-bs-toggle="modal" data-bs-target="#ajax"><?= $row->titulo ?></a>
                                                            </div>
                                                            <div class="flex-shrink-0">
                                                                <ul class="list-inline list-inline-dashed tasks-list-menu mb-0">
                                                                    <li class="list-inline-item fs-12">
                                                                        <a href="#" onclick="loadModalContent('<?= site_url('tareas/read/' . $row->tarea_id) ?>/1')" data-bs-toggle="modal" data-bs-target="#ajax">Ver</a>
                                                                    </li>
                                                                    <?php if ($fichado === true && $row->estado != 2) { ?>
                                                                        <li class="list-inline-item fs-12">
                                                                            <a href="<?= site_url('tareas/update/' . $row->tarea_id) ?>">Editar</a>
                                                                        </li>
                                                                        <li class="list-inline-item fs-12">
                                                                            <a href="#" onclick="deleteItem('<?= $row->tarea_id ?>')" class="color-red">Eliminar</a>
                                                                        </li>
                                                                        <? if (count($group_id) == 2) { ?>
                                                                            <li class="list-inline-item fs-12">
                                                                            <a href="<?= site_url('tareas/cambios/') . $row->tarea_id ?>" class="color-blue">Cambios</a>
                                                                        </li>
                                                                        <? } ?>
                                                                    <?php } ?>
                                                                </ul>
                                                            </div>
                                                            <div>
                                                    </td>
                                                    <td class=" text-right "><?= $row->proyecto_titulo ?></td>
                                                    <td class=" text-left "><?= date("d/m/Y", strtotime($row->fechaestimada)) ?></td>
                                                    <td class=" text-right "><?= minutosdesplegado($row->horasestimadas) ?></td>
                                                    <td class=" text-right "><?= minutosdesplegado($row->horasreales) ?></td>
                                                    <? if (count($group_id) == 2) { ?>
                                                        <td class=" text-left "><?= date("d/m/Y H:i:s", strtotime($row->fechacomienzo)) ?></td>
                                                        <td class=" text-left "><?= date("d/m/Y H:i:s", strtotime($row->fecharealcierre)) ?></td>
                                                    <? } ?>
                                                    <td class=" text-right "><?= $row->texto_estado ?></td>
                                                    <td class=" text-right ">
                                                        <? if ($quien === '1' && $fichado === true) { ?>
                                                            <?= form_open('tareas/acciones/' . $row->tarea_id, 'id="actionForm' . $row->tarea_id . '"') ?>
                                                            <? if ($row->estado == 0) { ?>
                                                                <button type="submit" id="0" name="accion" title="Iniciar tarea" class="btn" value="0"><i class="bx bx-play fs-22"></i></button>
                                                            <? }
                                                             if ($row->estado == 1) { ?>
                                                                <a href="#" onclick="event.preventDefault(); loadModalContent('<?= site_url('worklog/update/') . $row->tarea_id ?>');" data-bs-toggle="modal" data-bs-target="#ajax" id="1" title="Pausar tarea" class="btn" value="1"><i class="bx bx-pause fs-22"></i></a>
                                                            <? }
                                                            if ($row->estado != 2) { ?>
                                                                <button type="submit" id="2" name="accion" title="Tarea acabada" class="btn" value="2"><i class="ri-calendar-check-line"></i></button>
                                                            <? } ?>
                                                            <?= form_close() ?>
                                                        <? } ?>
                                                    </td>
                                                </tr>
                                            <? } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="mb-0 flex-grow-1">
                                        <?= $total_rows > count($tareas_data) ? (count($tareas_data) . " de ") : "" ?><?= $total_rows ?> registro<?= $total_rows != 1 ? "s" : "" ?>.
                                    </div>
                                    <?php if ($total_rows > count($tareas_data)) : ?>
                                        <div class="flex-shrink-0 pagination-wrap hstack gap-2">
                                            <?= $pagination ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$token_name = csrf_token();
$token_hash = csrf_hash();
?>
<script>
    function resetSearch() {
        $("#q").val("");
        $("form#search-box").submit();
    }
</script>
<div class="modal" id="ajax" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="min-height:50vh;">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div style="margin:0;position:absolute;left:50%;top:50%;-ms-transform:translate(-50%,-50%);transform:translate(-50%,-50%);">
                    <div class="spinner-border" style="width: 5rem; height: 5rem;" role="status"><span class="visually-hidden">Cargando...</span></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function loadModalContent(url) {
        $.post(url, {
        }, function(result) {
            $("#ajax .modal-content").html(result);
        });
        $('#ajax').on('hidden.bs.modal', function(e) {
            $("#ajax .modal-header").html('<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>');
            $("#ajax .modal-body").html('<div style="margin:0;position:absolute;left:50%;top:50%;-ms-transform:translate(-50%,-50%);transform:translate(-50%,-50%);"><div class="spinner-border" style="width: 5rem; height: 5rem;" role="status"><span class="visually-hidden">Cargando...</span></div></div>');
            $("#ajax .modal-footer").html("");
        });
    }
</script>
<link href="<?= base_url() ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<script src="<?= base_url() ?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script>
    function deleteSelected() {
        $("#delete-selected").prop("disabled", true);
        let ids = []
        $("input.check-selection:checked").each(function() {
            ids.push($(this).val())
        });
        if (ids.length) {
            Swal.fire({
                title: "¿Seguro que deseas eliminar los tareas seleccionados?",
                text: "¡No se podrá revertir!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
                cancelButtonClass: 'btn btn-danger w-xs mt-2',
                confirmButtonText: "Aceptar",
                cancelButtonText: "Cancelar",
                buttonsStyling: false,
                showCloseButton: true
            }).then(function(result) {
                if (result.value) {
                    window.location.href = "<?= site_url("tareas/bulk_delete/") ?>" + ids.join("/");
                } else {
                    $("#delete-selected").prop("disabled", false);
                }
            });
        } else {
            $("#delete-selected").prop("disabled", false);
        }
    }

    function deleteItem(id) {
        Swal.fire({
            title: "¿Seguro que deseas eliminar el tareas seleccionado?",
            text: "¡No se podrá revertir!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
            cancelButtonClass: 'btn btn-danger w-xs mt-2',
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            buttonsStyling: false,
            showCloseButton: true
        }).then(function(result) {
            if (result.value) {
                window.location.href = "<?= site_url("tareas/delete/") ?>" + id;
            }
        });
    }

    $(function() {
        $('table input[type=checkbox]').on('change', function() {
            if ($('table input[type=checkbox]:checked').length > 0) {
                $('.bulk-actions').removeClass('d-none');
            } else {
                $('.bulk-actions').addClass('d-none');
            }
        })
    })
</script>