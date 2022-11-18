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
                            <a href="<?php echo site_url('menuconfiguration/view/1?ob=' . sentidobusquedacrd('menu_id', 'menuconfiguration.')) . $filter . $custom_title; ?>" style="color:inherit;"># <span><i class="bx <?= $orden_campo == "menu_id" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a>
                        </th>
                        <th class="text-capitalize "><a href="<?php echo site_url('menuconfiguration/view/1?ob=' . sentidobusquedacrd('text', 'menuconfiguration.')) . $filter . $custom_title; ?>" style="color:inherit;">Texto <span><i class="bx <?= $orden_campo == "text" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('menuconfiguration/view/1?ob=' . sentidobusquedacrd('url', 'menuconfiguration.')) . $filter . $custom_title; ?>" style="color:inherit;">URL <span><i class="bx <?= $orden_campo == "url" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('menuconfiguration/view/1?ob=' . sentidobusquedacrd('position', 'menuconfiguration.')) . $filter . $custom_title; ?>" style="color:inherit;">Posición <span><i class="bx <?= $orden_campo == "position" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('menuconfiguration/view/1?ob=' . sentidobusquedacrd('parent', 'menuconfiguration.')) . $filter . $custom_title; ?>" style="color:inherit;">Parent <span><i class="bx <?= $orden_campo == "parent" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('menuconfiguration/view/1?ob=' . sentidobusquedacrd('icon', 'menuconfiguration.')) . $filter . $custom_title; ?>" style="color:inherit;">Icono <span><i class="bx <?= $orden_campo == "icon" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('menuconfiguration/view/1?ob=' . sentidobusquedacrd('show_in_menu', 'menuconfiguration.')) . $filter . $custom_title; ?>" style="color:inherit;">¿Menú? <span><i class="bx <?= $orden_campo == "show_in_menu" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('menuconfiguration/view/1?ob=' . sentidobusquedacrd('show_in_dashboard', 'menuconfiguration.')) . $filter . $custom_title; ?>" style="color:inherit;">¿Dashboard? <span><i class="bx <?= $orden_campo == "show_in_dashboard" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('menuconfiguration/view/1?ob=' . sentidobusquedacrd('dashboard_description', 'menuconfiguration.')) . $filter . $custom_title; ?>" style="color:inherit;">Descripción <span><i class="bx <?= $orden_campo == "dashboard_description" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                        <th class="text-capitalize "><a href="<?php echo site_url('menuconfiguration/view/1?ob=' . sentidobusquedacrd('admin_only', 'menuconfiguration.')) . $filter . $custom_title; ?>" style="color:inherit;">Solo Administrador <span><i class="bx <?= $orden_campo == "admin_only" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                    </tr>
                </thead>
                <tbody class="list form-check-all">
                    <? foreach ($menuconfiguration_data as $row) { ?>
                        <tr>

                            <td class="text-left "><?= $row->menu_id ?></td>
                            <td class=" text-left ">
                                <div class>
                                    <div class="flex-grow-1 tasks_name">
                                        <?= $row->text ?>
                            </td>
                            <td class=" text-left "><a href="/<?= $row->url ?>" target="_blank"><?= $row->url ?></a></td>
                            <td class=" text-right "><?= $row->position ?></td>
                            <td class=" text-left "><?= $row->parent ?></td>
                            <td class=" text-left "><?= $row->icon ?></td>
                            <td class=" text-left "><input type="checkbox" disabled <?= $row->show_in_menu == "1" ? "checked" : "" ?> value="<?= $row->show_in_menu ?>"></td>
                            <td class=" text-left "><input type="checkbox" disabled <?= $row->show_in_dashboard == "1" ? "checked" : "" ?> value="<?= $row->show_in_dashboard ?>"></td>
                            <td class=" text-left "><a href="#" onClick="$('#t808800402').toggle()"><?= substr($row->dashboard_description, 0, 50) ?>...</a>
                                <div id="t808800402" style="display:none"><?= $row->dashboard_description ?></div>
                            </td>
                            <td class=" text-left "><input type="checkbox" disabled <?= $row->admin_only == "1" ? "checked" : "" ?> value="<?= $row->admin_only ?>"></td>
                        </tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex align-items-center">
            <div class="mb-0 flex-grow-1">
                <?= $total_rows > count($menuconfiguration_data) ? (count($menuconfiguration_data) . " de ") : "" ?><?= $total_rows ?> registro<?= $total_rows != 1 ? "s" : "" ?>.
            </div>
            <?php if ($total_rows > count($menuconfiguration_data)) : ?>
                <div class="flex-shrink-0 pagination-wrap hstack gap-2">
                    <?= $pagination ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="modal-footer">
        <a href="<?= site_url('menuconfiguration/view') . str_replace("&", "?", $filter) . $custom_title ?>" class="btn btn-outline-black waves-effect waves-light me-3">Editar</a>
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