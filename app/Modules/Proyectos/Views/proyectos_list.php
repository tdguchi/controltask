<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
        <div class="row">
            <div class="col text-center">
            <button class="btn btn-warning btn-lg text-dark">Fichar</button>
            </div>
        </div><br>
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
                                    <span class="text-capitalize"><a href="#" onclick="loadModalContent('<?= site_url('proyectos/create/1') ?>');" class="btn btn-green add-btn" data-bs-toggle="modal" data-bs-target="#ajax"><i class="ri-add-line align-bottom me-1"></i> Añadir <?= $titulo ?></a></span>
                                    <span class="text-capitalize"><?php echo anchor(site_url('proyectos/excel'), 'Exportar Excel', 'class="btn btn-green add-btn"'); ?></span>
                                    <button type="button" id="delete-selected" onclick="deleteSelected();" class="btn btn-outline-red waves-effect waves-light ms-2 d-none bulk-actions">Eliminar Seleccionados</button>
                                    <div class="search-box-table ms-2">
                                        <form id="search-box" class="input-group" action="<?php echo site_url('proyectos/view'); ?>" method="post">
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
                                                <th class="sort text-capitalize "><a href="<?php echo site_url('proyectos/view?ob=' . sentidobusquedacrd('titulo', 'proyectos.')) . $filter . $custom_title; ?>" style="color:inherit;">Titulo <span class="block-sort"><i class="bx <?= $orden_campo == "titulo" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="sort text-capitalize "><a href="<?php echo site_url('proyectos/view?ob=' . sentidobusquedacrd('descripcion', 'proyectos.')) . $filter . $custom_title; ?>" style="color:inherit;">Descripcion <span class="block-sort"><i class="bx <?= $orden_campo == "descripcion" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            <? foreach ($proyectos_data as $row) { ?>
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input check-selection" type="checkbox" name="checkAll" value="<?= $row->proyecto_id ?>">
                                                        </div>
                                                    </th>
                                                    <td class=" text-left ">
                                                        <div class>
                                                            <div class="flex-grow-1 tasks_name">
                                                                <a class="link-strong" href="#" onclick="loadModalContent('<?= site_url('proyectos/read/' . $row->proyecto_id) ?>/1')" data-bs-toggle="modal" data-bs-target="#ajax"><?= $row->titulo ?></a>
                                                            </div>
                                                            <div class="flex-shrink-0">
                                                                <ul class="list-inline list-inline-dashed tasks-list-menu mb-0">
                                                                    <li class="list-inline-item fs-12">
                                                                        <a href="#" onclick="loadModalContent('<?= site_url('proyectos/read/' . $row->proyecto_id) ?>/1')" data-bs-toggle="modal" data-bs-target="#ajax">Ver</a>
                                                                    </li>
                                                                    <li class="list-inline-item fs-12">
                                                                        <a href="#" onclick="loadModalContent('<?= site_url('proyectos/update/' . $row->proyecto_id) ?>/1')" data-bs-toggle="modal" data-bs-target="#ajax">Editar</a>
                                                                    </li>
                                                                    <li class="list-inline-item fs-12">
                                                                        <a href="#" onclick="deleteItem('<?= $row->proyecto_id ?>')" class="color-red">Eliminar</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div>
                                                    </td>
                                                    <td class=" text-left "><a href="#" onClick="$('#t698460462').toggle()"><?= substr($row->descripcion, 0, 50) ?>...</a>
                                                        <div id="t698460462" style="display:none"><?= $row->descripcion ?></div>
                                                    </td>
                                                </tr>
                                            <? } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="mb-0 flex-grow-1">
                                        <?= $total_rows > count($proyectos_data) ? (count($proyectos_data) . " de ") : "" ?><?= $total_rows ?> registro<?= $total_rows != 1 ? "s" : "" ?>.
                                    </div>
                                    <?php if ($total_rows > count($proyectos_data)) : ?>
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
                title: "¿Seguro que deseas eliminar los proyectos seleccionados?",
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
                    window.location.href = "<?= site_url("proyectos/bulk_delete/") ?>" + ids.join("/");
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
            title: "¿Seguro que deseas eliminar el proyectos seleccionado?",
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
                window.location.href = "<?= site_url("proyectos/delete/") ?>" + id;
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