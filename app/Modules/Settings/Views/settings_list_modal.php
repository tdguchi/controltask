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
                            <a href="<?php echo site_url('settings/view/1?ob=' . sentidobusquedacrd('key', 'settings.')) . $filter . $custom_title; ?>" style="color:inherit;">Clave <span><i class="bx <?= $orden_campo == "key" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a>
                        </th>
                        <th class="text-capitalize "><a href="<?php echo site_url('settings/view/1?ob=' . sentidobusquedacrd('value', 'settings.')) . $filter . $custom_title; ?>" style="color:inherit;">Valor <span><i class="bx <?= $orden_campo == "value" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('settings/view/1?ob=' . sentidobusquedacrd('description', 'settings.')) . $filter . $custom_title; ?>" style="color:inherit;">Descripción <span><i class="bx <?= $orden_campo == "description" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                    </tr>
                </thead>
                <tbody class="list form-check-all">
                    <? foreach ($settings_data as $row) { ?>
                        <tr>

                            <td class="text-left "><?= $row->key ?></td>
                            <td class=" text-left "><?= $row->value ?></td>
                            <td class=" text-left "><?= $row->description ?></td>
                        </tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex align-items-center">
            <div class="mb-0 flex-grow-1">
                <?= $total_rows > count($settings_data) ? (count($settings_data) . " de ") : "" ?><?= $total_rows ?> registro<?= $total_rows != 1 ? "s" : "" ?>.
            </div>
            <?php if ($total_rows > count($settings_data)) : ?>
                <div class="flex-shrink-0 pagination-wrap hstack gap-2">
                    <?= $pagination ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="modal-footer">
        <a href="<?= site_url('settings/view') . str_replace("&", "?", $filter) . $custom_title ?>" class="btn btn-outline-black waves-effect waves-light me-3">Editar</a>
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