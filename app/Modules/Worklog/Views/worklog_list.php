<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
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
                                    <span class="text-capitalize"><?php echo anchor(site_url('worklog/excel'), 'Exportar Excel', 'class="btn btn-green add-btn"'); ?></span>
                                    <div class="search-box-table ms-2">
                                        <form id="search-box" class="input-group" action="<?php echo site_url('worklog/view'); ?>" method="post">
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
                                                <th class="sort text-capitalize ">
                                                    <a href="<?php echo site_url('worklog/view?ob=' . sentidobusquedacrd('worklog_id', 'worklog.')) . $filter . $custom_title; ?>" style="color:inherit;">Worklog ID <span class="block-sort"><i class="bx <?= $orden_campo == "worklog_id" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a>
                                                </th>
                                                <th class="sort text-capitalize "><a href="<?php echo site_url('worklog/view?ob=' . sentidobusquedacrd('tarea_id', 'worklog.')) . $filter . $custom_title; ?>" style="color:inherit;">Tarea ID <span class="block-sort"><i class="bx <?= $orden_campo == "tarea_id" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="sort text-capitalize "><a href="<?php echo site_url('worklog/view?ob=' . sentidobusquedacrd('usuario_id', 'worklog.')) . $filter . $custom_title; ?>" style="color:inherit;">Operador <span class="block-sort"><i class="bx <?= $orden_campo == "usuario_id" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="sort text-capitalize "><a href="<?php echo site_url('worklog/view?ob=' . sentidobusquedacrd('fechainicio', 'worklog.')) . $filter . $custom_title; ?>" style="color:inherit;">Fecha Inicio <span class="block-sort"><i class="bx <?= $orden_campo == "fechainicio" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="sort text-capitalize "><a href="<?php echo site_url('worklog/view?ob=' . sentidobusquedacrd('fechacierre', 'worklog.')) . $filter . $custom_title; ?>" style="color:inherit;">Fecha Cierre <span class="block-sort"><i class="bx <?= $orden_campo == "fechacierre" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="sort text-capitalize "><a href="<?php echo site_url('worklog/view?ob=' . sentidobusquedacrd('comentario', 'worklog.')) . $filter . $custom_title; ?>" style="color:inherit;">Comentario <span class="block-sort"><i class="bx <?= $orden_campo == "comentario" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            <? foreach ($worklog_data as $row) { ?>
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input check-selection" type="checkbox" name="checkAll" value="<?= $row->worklog_id ?>">
                                                        </div>
                                                    </th>

                                                    <td class="text-left "><?= $row->worklog_id ?> <div class="flex-shrink-0">
                                                            <ul class="list-inline list-inline-dashed tasks-list-menu mb-0">
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td class=" text-right "><?= $row->tarea_id ?></td>
                                                    <td class=" text-right "><?= $row->usuario_id ?></td>
                                                    <td class=" text-left "><?= date("H:i:s", strtotime($row->fechainicio)) ?></td>
                                                    <td class=" text-left "><?= date("H:i:s", strtotime($row->fechacierre)) ?></td>
                                                    <td class=" text-left "><?= $row->comentario ?></td>
                                                </tr>
                                            <? } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="mb-0 flex-grow-1">
                                        <?= $total_rows > count($worklog_data) ? (count($worklog_data) . " de ") : "" ?><?= $total_rows ?> registro<?= $total_rows != 1 ? "s" : "" ?>.
                                    </div>
                                    <?php if ($total_rows > count($worklog_data)) : ?>
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