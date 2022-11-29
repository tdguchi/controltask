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
                            <a href="<?php echo site_url('proyectos/view/1?ob=' . sentidobusquedacrd('proyecto_id', 'proyectos.')) . $filter . $custom_title; ?>" style="color:inherit;">Proyecto ID <span><i class="bx <?= $orden_campo == "proyecto_id" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a>
                        </th>
                        <th class="text-capitalize "><a href="<?php echo site_url('proyectos/view/1?ob=' . sentidobusquedacrd('titulo', 'proyectos.')) . $filter . $custom_title; ?>" style="color:inherit;">Titulo <span><i class="bx <?= $orden_campo == "titulo" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('proyectos/view/1?ob=' . sentidobusquedacrd('descripcion', 'proyectos.')) . $filter . $custom_title; ?>" style="color:inherit;">Descripcion <span><i class="bx <?= $orden_campo == "descripcion" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                    </tr>
                </thead>
                <tbody class="list form-check-all">
                    <? foreach ($proyectos_data as $row) { ?>
                        <tr>

                            <td class="text-left "><?= $row->proyecto_id ?></td>
                            <td class=" text-left ">
                                <div class>
                                    <div class="flex-grow-1 tasks_name">
                                        <?= $row->titulo ?>
                            </td>
                            <td class=" text-left "><a href="#" onClick="$('#t1728541090').toggle()"><?= substr($row->descripcion, 0, 50) ?>...</a>
                                <div id="t1728541090" style="display:none"><?= $row->descripcion ?></div>
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
    <div class="modal-footer">
        <a href="<?= site_url('proyectos/view') . str_replace("&", "?", $filter) . $custom_title ?>" class="btn btn-outline-black waves-effect waves-light me-3">Editar</a>
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