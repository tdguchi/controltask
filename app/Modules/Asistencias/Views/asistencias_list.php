<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col text-center">
                    <a href="<?= site_url("asistencias/fichar") ?>" class="btn btn-warning btn-lg text-dark">Fichar</a>
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
                                <h5 class="card-title mb-0 flex-grow-1 h5-title"><?= $titulo ?> <?= $element . ' del ' ?> <?= $p != null ? date('d-m-Y',strtotime($p)) : date('d-m-Y') ?></h5>
                                <div class="flex-shrink-0">
                                    <form id="search-box" class="input-group" action="<?php echo site_url('asistencias/view/0/' . $quien ? $quien : 1); ?>" method="post">
                                        <input id="Date" class="form-control" id="p" name="p" type="date" value="<?= $p != null ? $p : date('Y-m-d') ?>" />
                                        <button type="submit" class="btn btn-outline-dark"><i class="ri-search-line search-icon"></i></button>
                                    </form>
                                </div>
                                <div class="flex-shrink-0">
                                    <?php if (count($group_id) == 2) { ?>
                                        <span class="text-capitalize"><?php echo anchor(site_url('asistencias/view/0/1'), 'Propias', 'class="btn btn-green add-btn"'); ?></span>
                                        <span class="text-capitalize"><?php echo anchor(site_url('asistencias/view/0/2'), 'Todas', 'class="btn btn-green add-btn"'); ?></span>
                                    <?php } ?>
                                    <div class="search-box-table ms-2">
                                        <form id="search-box" class="input-group" action="<?php echo site_url('asistencias/view'); ?>" method="post">
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
                                                <th class="sort text-capitalize "><a href="<?php echo site_url('asistencias/view/0/' .$quien . '?ob=' . sentidobusquedacrd('usuario_id', 'asistencias.')) . $filter . $custom_title; ?>" style="color:inherit;">Operador <span class="block-sort"><i class="bx <?= $orden_campo == "usuario_id" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="sort text-capitalize "><a href="<?php echo site_url('asistencias/view/0/' .$quien . '?ob=' . sentidobusquedacrd('asistenciatipo_id', 'asistencias.')) . $filter . $custom_title; ?>" style="color:inherit;">Tipo De Asistencia <span class="block-sort"><i class="bx <?= $orden_campo == "asistenciatipo_id" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="sort text-capitalize "><a href="<?php echo site_url('asistencias/view/0/' .$quien . '?ob=' . sentidobusquedacrd('fechahora', 'asistencias.')) . $filter . $custom_title; ?>" style="color:inherit;">Hora <span class="block-sort"><i class="bx <?= $orden_campo == "fechahora" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="sort text-capitalize "><a href="<?php echo site_url('asistencias/view/0/' .$quien . '?ob=' . sentidobusquedacrd('comentario', 'asistencias.')) . $filter . $custom_title; ?>" style="color:inherit;">Comentario <span class="block-sort"><i class="bx <?= $orden_campo == "comentario" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            <? foreach ($asistencias_data as $row) { ?>
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input check-selection" type="checkbox" name="checkAll" value="<?= $row->asistencia_id ?>">
                                                        </div>
                                                    </th>
                                                    <td class=" text-right "><?= $row->nombre ?></td>
                                                    <td class=" text-right ">
                                                        <? if ($row->asistenciatipo_id == 0) { ?>
                                                            <span style="color:green"><i class='bx bx-exit'></i> <?= $row->tipo ?> </span>
                                                        <? } else { ?>
                                                            <span style="color:red"><i class='bx bx-exit bx-rotate-180'></i> <?= $row->tipo ?> </span>
                                                        <? } ?>
                                                    </td>
                                                    <td class=" text-left "><?= date("H:i:s", strtotime($row->fechahora)) ?></td>
                                                    <td class=" text-left "><?= $row->comentario ?></td>
                                                </tr>
                                            <? } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="mb-0 flex-grow-1">
                                        <?= $total_rows > count($asistencias_data) ? (count($asistencias_data) . " de ") : "" ?><?= $total_rows ?> registro<?= $total_rows != 1 ? "s" : ""?> . <?='Tu jornada para este dia ha sido de: ' .  gmdate("H:i:s", $totalhoras) ?>
                                    </div>
                                    <?php if ($total_rows > count($asistencias_data)) : ?>
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