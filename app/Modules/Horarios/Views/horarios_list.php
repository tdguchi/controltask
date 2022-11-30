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
                                <h5 class="card-title mb-0 flex-grow-1 h5-title text-capitalize"><?= $titulo ?> <?= $element ?><?= " para " . $username ?> </h5>
                                <div class="flex-shrink-0">
                                    <?php if ($fichado === true && count($group_id) == 2) { ?>
                                        <span class="text-capitalize"><a href="#" onclick="loadModalContent('<?= site_url('horarios/create/1') ?>');" class="btn btn-green add-btn" data-bs-toggle="modal" data-bs-target="#ajax"><i class="ri-add-line align-bottom me-1"></i> Añadir <?= $titulo ?></a></span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="table-responsive table-card mb-1">
                                    <table class="table align-middle table-nowrap table-striped">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="sort text-capitalize "><a href="<?php echo site_url('horarios/view?ob=' . sentidobusquedacrd('entrada_manana', 'horarios.')) . $filter . $custom_title; ?>" style="color:inherit;">Entrada mañana<span class="block-sort"><i class="bx <?= $orden_campo == "entrada_manana" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="sort text-capitalize "><a href="<?php echo site_url('horarios/view?ob=' . sentidobusquedacrd('salida_manana', 'horarios.')) . $filter . $custom_title; ?>" style="color:inherit;">Salida mañana<span class="block-sort"><i class="bx <?= $orden_campo == "salida_manana" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="sort text-capitalize "><a href="<?php echo site_url('horarios/view?ob=' . sentidobusquedacrd('entrada_tarde', 'horarios.')) . $filter . $custom_title; ?>" style="color:inherit;">Entrada tarde<span class="block-sort"><i class="bx <?= $orden_campo == "entrada_tarde" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="sort text-capitalize "><a href="<?php echo site_url('horarios/view?ob=' . sentidobusquedacrd('salida_tarde', 'horarios.')) . $filter . $custom_title; ?>" style="color:inherit;">Salida tarde<span class="block-sort"><i class="bx <?= $orden_campo == "salida_tarde" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class=" text-center ">Configurar</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                        <tr></tr>
                                            <? foreach ($horarios_data as $row) { ?>
                                                <? if ($verano != null && $invierno != null ) { ?>
                                                <tr style="background-color:<?= ($row->id == $verano->horario_id) ? '#FFD28E;' : (($row->id == $invierno->horario_id) ? '#A7FFFE;' : '#D9D9D9;' )?>">
                                                <? } else if ($verano == null && $invierno != null) { ?>
                                                <tr style="background-color:<?= ($row->id == $invierno->horario_id) ? '#A7FFFE;' : '#D9D9D9;' ?>">
                                                <? } else if ($verano != null && $invierno  == null) { ?>
                                                <tr style="background-color:<?= ($row->id == $verano->horario_id) ? '#FFD28E;' : '#D9D9D9;' ?>">
                                                <? } ?>
                                                    <td class=" text-center "><?= date('H:i',strtotime($row->entrada_manana)) ?></td>
                                                    <td class=" text-center "><?= date('H:i',strtotime($row->salida_manana)) ?></td>
                                                    <td class=" text-center "><?= date('H:i',strtotime($row->entrada_tarde)) ?></td>
                                                    <td class=" text-center "><?= date('H:i',strtotime($row->salida_tarde)) ?></td>
                                                <? if ($fichado === true && count($group_id) == 2) { ?>
                                                    <td class=" text-center ">
                                                        <a href="<? echo site_url('horarios/asignar/') . $row->id . '/0/' . $user_id ?>" class="btn btn-primary btn-sm">Verano</a>
                                                        <a href="<? echo site_url('horarios/asignar/') . $row->id . '/1/' . $user_id ?>" class="btn btn-danger btn-sm">Invierno</a>
                                                    </td>
                                                <?php } ?>
                                                </tr>
                                            <? } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="mb-0 flex-grow-1">
                                        <?= $total_rows > count($horarios_data) ? (count($horarios_data) . " de ") : "" ?><?= $total_rows ?> registro<?= $total_rows != 1 ? "s" : "" ?>.
                                    </div>
                                    <?php if ($total_rows > count($horarios_data)) : ?>
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
            '<?= $token_name; ?>': '<?= $token_hash; ?>'
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
                title: "¿Seguro que deseas eliminar los horarios seleccionados?",
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
                    window.location.href = "<?= site_url("horarios/bulk_delete/") ?>" + ids.join("/");
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
            title: "¿Seguro que deseas eliminar el horarios seleccionado?",
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
                window.location.href = "<?= site_url("horarios/delete/") ?>" + id;
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