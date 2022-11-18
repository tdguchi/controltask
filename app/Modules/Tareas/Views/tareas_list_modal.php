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
                            <a href="<?php echo site_url('tareas/view/1?ob=' . sentidobusquedacrd('tarea_id', 'tareas.')) . $filter . $custom_title; ?>" style="color:inherit;">Tarea ID <span><i class="bx <?= $orden_campo == "tarea_id" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a>
                        </th>
                        <th class="text-capitalize "><a href="<?php echo site_url('tareas/view/1?ob=' . sentidobusquedacrd('proyecto_id', 'tareas.')) . $filter . $custom_title; ?>" style="color:inherit;">Proyecto <span><i class="bx <?= $orden_campo == "proyecto_id" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('tareas/view/1?ob=' . sentidobusquedacrd('titulo', 'tareas.')) . $filter . $custom_title; ?>" style="color:inherit;">Titulo <span><i class="bx <?= $orden_campo == "titulo" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('tareas/view/1?ob=' . sentidobusquedacrd('descripcion', 'tareas.')) . $filter . $custom_title; ?>" style="color:inherit;">Descripción <span><i class="bx <?= $orden_campo == "descripcion" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('tareas/view/1?ob=' . sentidobusquedacrd('fechaobjetivo', 'tareas.')) . $filter . $custom_title; ?>" style="color:inherit;">Fecha Objetivo <span><i class="bx <?= $orden_campo == "fechaobjetivo" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('tareas/view/1?ob=' . sentidobusquedacrd('fechaestimada', 'tareas.')) . $filter . $custom_title; ?>" style="color:inherit;">Fecha Estimada <span><i class="bx <?= $orden_campo == "fechaestimada" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('tareas/view/1?ob=' . sentidobusquedacrd('horasestimadas', 'tareas.')) . $filter . $custom_title; ?>" style="color:inherit;">Horas Estimadas <span><i class="bx <?= $orden_campo == "horasestimadas" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('tareas/view/1?ob=' . sentidobusquedacrd('fechacomienzo', 'tareas.')) . $filter . $custom_title; ?>" style="color:inherit;">Fecha Comienzo <span><i class="bx <?= $orden_campo == "fechacomienzo" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('tareas/view/1?ob=' . sentidobusquedacrd('fecharealcierre', 'tareas.')) . $filter . $custom_title; ?>" style="color:inherit;">Fecha Real Cierre <span><i class="bx <?= $orden_campo == "fecharealcierre" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('tareas/view/1?ob=' . sentidobusquedacrd('horasreales', 'tareas.')) . $filter . $custom_title; ?>" style="color:inherit;">Horas Reales <span><i class="bx <?= $orden_campo == "horasreales" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('tareas/view/1?ob=' . sentidobusquedacrd('estado', 'tareas.')) . $filter . $custom_title; ?>" style="color:inherit;">Estado <span><i class="bx <?= $orden_campo == "estado" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                    </tr>
                </thead>
                <tbody class="list form-check-all">
                    <? foreach ($tareas_data as $row) { ?>
                        <tr>

                            <td class="text-left "><?= $row->tarea_id ?></td>
                            <td class=" text-right "><?= $row->proyecto_id ?></td>
                            <td class=" text-left ">
                                <div class>
                                    <div class="flex-grow-1 tasks_name">
                                        <?= $row->titulo ?>
                            </td>
                            <td class=" text-left "><a href="#" onClick="$('#t1493232147').toggle()"><?= substr($row->descripcion, 0, 50) ?>...</a>
                                <div id="t1493232147" style="display:none"><?= $row->descripcion ?></div>
                            </td>
                            <td class=" text-left "><?= date("d/m/Y", strtotime($row->fechaobjetivo)) ?></td>
                            <td class=" text-left "><?= date("d/m/Y", strtotime($row->fechaestimada)) ?></td>
                            <td class=" text-right "><?= $row->horasestimadas ?></td>
                            <td class=" text-left "><?= date("d/m/Y H:i:s", strtotime($row->fechacomienzo)) ?></td>
                            <td class=" text-left "><?= date("d/m/Y H:i:s", strtotime($row->fecharealcierre)) ?></td>
                            <td class=" text-right "><?= $row->horasreales ?></td>
                            <td class=" text-right "><?= $row->estado ?></td>
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
    <div class="modal-footer">
        <a href="<?= site_url('tareas/view') . str_replace("&", "?", $filter) . $custom_title ?>" class="btn btn-outline-black waves-effect waves-light me-3">Editar</a>
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