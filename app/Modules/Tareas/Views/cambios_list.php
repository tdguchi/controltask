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
                                                <th class="sort text-capitalize "><a href="<?php echo $accion . '?ob=' . sentidobusquedacrd('tarea_id', 'tasklog.'); ?>" style="color:inherit;">Tarea <span class="block-sort"><i class="bx <?= $orden_campo == "tarea_id" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="sort text-capitalize "><a href="<?php echo $accion . '?ob=' . sentidobusquedacrd('usuario_id', 'tasklog.'); ?>" style="color:inherit;">Usuario <span class="block-sort"><i class="bx <?= $orden_campo == "usuario_id" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="sort text-capitalize "><a href="<?php echo $accion . '?ob=' . sentidobusquedacrd('fechahora', 'tasklog.'); ?>" style="color:inherit;">Fecha y Hora <span class="block-sort"><i class="bx <?= $orden_campo == "fechahora" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="sort text-capitalize ">Campos cambiados</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            <? foreach ($cambios as $row) { ?>
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input check-selection" type="checkbox" name="checkAll" value="<?= $row->tarea_id ?>">
                                                        </div>
                                                    </th>
                                                    <td class=" text-left ">
                                                        <div class>
                                                            <div class="flex-grow-1 tasks_name">
                                                                <a class="link-strong" href="#" onclick="loadModalContent('<?= site_url('tareas/read/' . $row->tarea_id) ?>/1')" data-bs-toggle="modal" data-bs-target="#ajax"><?= $row->tarea_id ?></a>
                                                            </div>
                                                    </td>
                                                    <td class=" text-right "><?= $row->usuario_id ?></td>
                                                    <td class=" text-left "><?= date("d/m/Y", strtotime($row->fechahora)) ?></td>
                                                    <td class=" text-left "><?= date("d/m/Y", strtotime($row->cambiados)) ?></td>
                                                </tr>
                                            <? } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex align-items-center">
                                    <?php if ($total_rows > count($cambios)) : ?>
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
        $.post(url, {}, function(result) {
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