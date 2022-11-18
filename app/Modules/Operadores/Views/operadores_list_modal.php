    <div class="modal-header">
        <h5 class="card-title mb-0 flex-grow-1 h5-title text-capitalize"><?= $titulo ?> <?= $element ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="table-responsive">
            <table class="table align-middle table-nowrap">
                <thead class="table-light">
                    <tr>
                        <th class="text-capitalize "><a href="<?php echo site_url('operadores/view/1?ob=' . sentidobusquedacrd('nombre', 'operadores.')) . $filter . $custom_title; ?>" style="color:inherit;">Nombre <span><i class="bx <?= $orden_campo == "nombre" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('operadores/view/1?ob=' . sentidobusquedacrd('apellidos', 'operadores.')) . $filter . $custom_title; ?>" style="color:inherit;">Apellidos <span><i class="bx <?= $orden_campo == "apellidos" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('operadores/view/1?ob=' . sentidobusquedacrd('dni', 'operadores.')) . $filter . $custom_title; ?>" style="color:inherit;">Dni <span><i class="bx <?= $orden_campo == "dni" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('operadores/view/1?ob=' . sentidobusquedacrd('email', 'operadores.')) . $filter . $custom_title; ?>" style="color:inherit;">Email <span><i class="bx <?= $orden_campo == "email" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('operadores/view/1?ob=' . sentidobusquedacrd('tipo', 'operadores.')) . $filter . $custom_title; ?>" style="color:inherit;">Tipo <span><i class="bx <?= $orden_campo == "tipo" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                    </tr>
                </thead>
                <tbody class="list form-check-all">
                    <? foreach ($operadores_data as $row) { ?>
                        <tr>
                            <td class=" text-left "><?= $row->nombre ?></td>
                            <td class=" text-left "><?= $row->apellidos ?></td>
                            <td class=" text-left "><?= $row->dni ?></td>
                            <td class=" text-left "><?= $row->email ?></td>
                            <td class=" text-right "><?= $row->tipo ?></td>
                        </tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex align-items-center">
            <div class="mb-0 flex-grow-1">
                <?= $total_rows > count($operadores_data) ? (count($operadores_data) . " de ") : "" ?><?= $total_rows ?> registro<?= $total_rows != 1 ? "s" : "" ?>.
            </div>
            <?php if ($total_rows > count($operadores_data)) : ?>
                <div class="flex-shrink-0 pagination-wrap hstack gap-2">
                    <?= $pagination ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="modal-footer">
        <a href="<?= site_url('operadores/view') . str_replace("&", "?", $filter) . $custom_title ?>" class="btn btn-outline-black waves-effect waves-light me-3">Editar</a>
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