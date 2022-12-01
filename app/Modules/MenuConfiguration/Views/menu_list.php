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
                                <?php if ($fichado === true) { ?>
                                    <span class="text-capitalize"><a title="Añadir elemento menú" href="#" onclick="loadModalContent('<?= site_url('menuconfiguration/create/1') ?>');" class="btn btn-green add-btn" data-bs-toggle="modal" data-bs-target="#ajax"><i class="ri-add-line align-bottom me-1"></i> Añadir <?= $titulo ?></a></span>
                                    <button title="Eliminar seleccionados" type="button" id="delete-selected" onclick="deleteSelected();" class="btn btn-outline-red waves-effect waves-light ms-2 d-none bulk-actions">Eliminar Seleccionados</button>
                                    <?php } ?>
                                    <div class="search-box-table ms-2">
                                        <form id="search-box" class="input-group" action="<?php echo site_url('menuconfiguration/view'); ?>" method="post">
                                        <?= csrf_field() ?>

                                            <input type="hidden" name="filter" value="<?= $filter == "" ? "" : explode("=", $filter)[1] ?>">
                                            <input type="hidden" name="title" value="<?= $custom_title == "" ? "" : explode("=", $custom_title)[1] ?>">
                                            <input title="texto buscar" type="text" class="form-control search-c border-black" placeholder="Buscar..." id="q" name="q" value="<?= $q ?>">
                                            <button title="resetear texto buscar" type="button" onclick="resetSearch();" class="btn btn-ghost-dark waves-effect waves-light"><i class="ri-close-line "></i></button>
                                            <button  title="boton buscar" type="submit" class="btn btn-outline-dark"><i class="ri-search-line search-icon"></i></button>
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
                                                        <input title="checkbox" class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                    </div>
                                                </th>
                                                <th class="sort text-capitalize ">
                                                    <a href="<?php echo site_url('menuconfiguration/view?ob=' . sentidobusquedacrd('menu_id', 'menuconfiguration.')) . $filter . $custom_title; ?>" style="color:inherit;"># <span class="block-sort"><i class="bx <?= $orden_campo == "menu_id" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a>
                                                </th>
                                                <th class="sort text-capitalize "><a title="text" href="<?php echo site_url('menuconfiguration/view?ob=' . sentidobusquedacrd('text', 'menuconfiguration.')) . $filter . $custom_title; ?>" style="color:inherit;">Texto <span class="block-sort"><i class="bx <?= $orden_campo == "text" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="sort text-capitalize "><a title="url" href="<?php echo site_url('menuconfiguration/view?ob=' . sentidobusquedacrd('url', 'menuconfiguration.')) . $filter . $custom_title; ?>" style="color:inherit;">URL <span class="block-sort"><i class="bx <?= $orden_campo == "url" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="sort text-capitalize "><a title="posicion" href="<?php echo site_url('menuconfiguration/view?ob=' . sentidobusquedacrd('position', 'menuconfiguration.')) . $filter . $custom_title; ?>" style="color:inherit;">Posición <span class="block-sort"><i class="bx <?= $orden_campo == "position" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="sort text-capitalize "><a title="parent" href="<?php echo site_url('menuconfiguration/view?ob=' . sentidobusquedacrd('parent', 'menuconfiguration.')) . $filter . $custom_title; ?>" style="color:inherit;">Parent <span class="block-sort"><i class="bx <?= $orden_campo == "parent" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="sort text-capitalize "><a title="icono" href="<?php echo site_url('menuconfiguration/view?ob=' . sentidobusquedacrd('icon', 'menuconfiguration.')) . $filter . $custom_title; ?>" style="color:inherit;">Icono <span class="block-sort"><i class="bx <?= $orden_campo == "icon" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="sort text-capitalize "><a title="mostrar en menú" href="<?php echo site_url('menuconfiguration/view?ob=' . sentidobusquedacrd('show_in_menu', 'menuconfiguration.')) . $filter . $custom_title; ?>" style="color:inherit;">¿Menú? <span class="block-sort"><i class="bx <?= $orden_campo == "show_in_menu" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="sort text-capitalize "><a title="mostrar en dashboard" href="<?php echo site_url('menuconfiguration/view?ob=' . sentidobusquedacrd('show_in_dashboard', 'menuconfiguration.')) . $filter . $custom_title; ?>" style="color:inherit;">¿Dashboard? <span class="block-sort"><i class="bx <?= $orden_campo == "show_in_dashboard" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="sort text-capitalize "><a title="Descripción"href="<?php echo site_url('menuconfiguration/view?ob=' . sentidobusquedacrd('dashboard_description', 'menuconfiguration.')) . $filter . $custom_title; ?>" style="color:inherit;">Descripción <span class="block-sort"><i class="bx <?= $orden_campo == "dashboard_description" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="sort text-capitalize "><a title="mostrar solo admin" href="<?php echo site_url('menuconfiguration/view?ob=' . sentidobusquedacrd('admin_only', 'menuconfiguration.')) . $filter . $custom_title; ?>" style="color:inherit;">Solo Administrador <span class="block-sort"><i class="bx <?= $orden_campo == "admin_only" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            <? foreach ($menuconfiguration_data as $row) { ?>
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input title="checkbox" class="form-check-input check-selection" type="checkbox" name="checkAll" value="<?= $row->menu_id ?>">
                                                        </div>
                                                    </th>

                                                    <td class="text-left "><?= $row->menu_id ?></td>
                                                    <td class=" text-left ">
                                                        <div class>
                                                            <div class="flex-grow-1 tasks_name">
                                                                <?= $row->text ?></div>
                                                            <div class="flex-shrink-0">
                                                            <?php if ($fichado === true) { ?>
                                                                <ul class="list-inline list-inline-dashed tasks-list-menu mb-0">
                                                                    <li class="list-inline-item fs-12">
                                                                        <a title="editar" href="#" onclick="loadModalContent('<?= site_url('menuconfiguration/update/' . $row->menu_id) ?>/1')" data-bs-toggle="modal" data-bs-target="#ajax">Editar</a>
                                                                    </li>
                                                                    <li class="list-inline-item fs-12">
                                                                        <a title="eliminar" href="#" onclick="deleteItem('<?= $row->menu_id ?>')" class="color-red">Eliminar</a>
                                                                    </li>
                                                                </ul>
                                                            <?php } ?>
                                                            </div>
                                                            <div>
                                                    </td>
                                                    <td class=" text-left "><a href="/<?= $row->url ?>" target="_blank"><?= $row->url ?></a></td>
                                                    <td class=" text-right "><?= $row->position ?></td>
                                                    <td class=" text-left "><?= $row->parent ?></td>
                                                    <td class=" text-left "><?= $row->icon ?></td>
                                                    <td class=" text-left "><input type="checkbox" disabled <?= $row->show_in_menu == "1" ? "checked" : "" ?> value="<?= $row->show_in_menu ?>"></td>
                                                    <td class=" text-left "><input type="checkbox" disabled <?= $row->show_in_dashboard == "1" ? "checked" : "" ?> value="<?= $row->show_in_dashboard ?>"></td>
                                                    <td class=" text-left "><a href="#" onClick="$('#t158697007').toggle()"><?= substr($row->dashboard_description, 0, 50) ?>...</a>
                                                        <div id="t158697007" style="display:none"><?= $row->dashboard_description ?></div>
                                                    </td>
                                                    <td class=" text-left "><input type="checkbox" disabled <?= $row->admin_only == "1" ? "checked" : "" ?> value="<?= $row->admin_only ?>"></td>
                                                </tr>
                                            <? } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div title="total filas" class="mb-0 flex-grow-1">
                                        <?= $total_rows > count($menuconfiguration_data) ? (count($menuconfiguration_data) . " de ") : "" ?><?= $total_rows ?> registro<?= $total_rows != 1 ? "s" : "" ?>.
                                    </div>
                                    <?php if ($total_rows > count($menuconfiguration_data)) : ?>
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
        $.post(url, {'<?= $token_name; ?>':'<?= $token_hash; ?>'}, function(result) {
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
                title: "¿Seguro que deseas eliminar los menu seleccionados?",
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
                    window.location.href = "<?= site_url("menuconfiguration/bulk_delete/") ?>" + ids.join("/");
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
            title: "¿Seguro que deseas eliminar el menu seleccionado?",
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
                window.location.href = "<?= site_url("menuconfiguration/delete/") ?>" + id;
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