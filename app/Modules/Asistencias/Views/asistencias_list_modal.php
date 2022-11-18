    <div class="modal-header">
        <h5 class="card-title mb-0 flex-grow-1 h5-title text-capitalize"><?= $titulo ?> <?= $element ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="table-responsive">
            <table class="table align-middle table-nowrap">
                <thead class="table-light">
                    <tr>
                        <th class="text-capitalize "><a href="<?php echo site_url('asistencias/view/1?ob=' . sentidobusquedacrd('usuario_id', 'asistencias.')) . $filter . $custom_title; ?>" style="color:inherit;">Operador <span><i class="bx <?= $orden_campo == "usuario_id" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('asistencias/view/1?ob=' . sentidobusquedacrd('asistenciatipo_id', 'asistencias.')) . $filter . $custom_title; ?>" style="color:inherit;">Tipo De Asistencia <span><i class="bx <?= $orden_campo == "asistenciatipo_id" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('asistencias/view/1?ob=' . sentidobusquedacrd('fechahora', 'asistencias.')) . $filter . $custom_title; ?>" style="color:inherit;">Fecha Hora <span><i class="bx <?= $orden_campo == "fechahora" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('asistencias/view/1?ob=' . sentidobusquedacrd('comentario', 'asistencias.')) . $filter . $custom_title; ?>" style="color:inherit;">Comentario <span><i class="bx <?= $orden_campo == "comentario" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                    </tr>
                </thead>
                <tbody class="list form-check-all">
                    <? foreach ($asistencias_data as $row) { ?>
                        <tr>
                            <td class=" text-right "><?= $row->usuario_id ?></td>
                            <td class=" text-right "><?= $row->asistenciatipo_id ?></td>
                            <td class=" text-left "><?= date("d/m/Y H:i:s", strtotime($row->fechahora)) ?></td>
                            <td class=" text-left "><?= $row->comentario ?></td>
                        </tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex align-items-center">
            <div class="mb-0 flex-grow-1">
                <?= $total_rows > count($asistencias_data) ? (count($asistencias_data) . " de ") : "" ?><?= $total_rows ?> registro<?= $total_rows != 1 ? "s" : "" ?>.
            </div>
            <?php if ($total_rows > count($asistencias_data)) : ?>
                <div class="flex-shrink-0 pagination-wrap hstack gap-2">
                    <?= $pagination ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="modal-footer">
        <a href="<?= site_url('asistencias/view') . str_replace("&", "?", $filter) . $custom_title ?>" class="btn btn-outline-black waves-effect waves-light me-3">Editar</a>
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