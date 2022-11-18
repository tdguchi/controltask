    <div class="modal-header">
        <h5 class="card-title mb-0 flex-grow-1 h5-title text-capitalize"><?= $titulo ?> <?= $element ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="table-responsive">
            <table class="table align-middle table-nowrap">
                <thead class="table-light">
                    <tr>
                        <th class="text-capitalize ">
                            <a href="<?php echo site_url('worklog/view/1?ob=' . sentidobusquedacrd('worklog_id', 'worklog.')) . $filter . $custom_title; ?>" style="color:inherit;">Worklog ID <span><i class="bx <?= $orden_campo == "worklog_id" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a>
                        </th>
                        <th class="text-capitalize "><a href="<?php echo site_url('worklog/view/1?ob=' . sentidobusquedacrd('tarea_id', 'worklog.')) . $filter . $custom_title; ?>" style="color:inherit;">Tarea ID <span><i class="bx <?= $orden_campo == "tarea_id" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('worklog/view/1?ob=' . sentidobusquedacrd('usuario_id', 'worklog.')) . $filter . $custom_title; ?>" style="color:inherit;">Operador <span><i class="bx <?= $orden_campo == "usuario_id" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('worklog/view/1?ob=' . sentidobusquedacrd('fechainicio', 'worklog.')) . $filter . $custom_title; ?>" style="color:inherit;">Fecha Inicio <span><i class="bx <?= $orden_campo == "fechainicio" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('worklog/view/1?ob=' . sentidobusquedacrd('fechacierre', 'worklog.')) . $filter . $custom_title; ?>" style="color:inherit;">Fecha Cierre <span><i class="bx <?= $orden_campo == "fechacierre" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('worklog/view/1?ob=' . sentidobusquedacrd('comentario', 'worklog.')) . $filter . $custom_title; ?>" style="color:inherit;">Comentario <span><i class="bx <?= $orden_campo == "comentario" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                    </tr>
                </thead>
                <tbody class="list form-check-all">
                    <? foreach ($worklog_data as $row) { ?>
                        <tr>

                            <td class="text-left "><?= $row->worklog_id ?></td>
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
    <div class="modal-footer">
        <a href="<?= site_url('worklog/view') . str_replace("&", "?", $filter) . $custom_title ?>" class="btn btn-outline-black waves-effect waves-light me-3">Editar</a>
    </div>
    <script>
        $('.modal-body a').on('click', function(e) {
            e.preventDefault();
            let aElement = $(e.target);
            while (!aElement.is("a")) {
                aElement = aElement.parent();
            }
            loadModalContent($(aElement).attr("href"));
        })
    </script>