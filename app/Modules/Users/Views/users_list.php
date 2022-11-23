<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
        <div class="row">
            <div class="col text-center">
            <a href="<?= site_url("asistencias/fichar")?>" class="btn btn-warning btn-lg text-dark">Fichar</a>
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
                                <h5 class="card-title mb-0 flex-grow-1 h5-title text-capitalize">Usuarios</h5>
                                <div class="flex-shrink-0">
                                    <span class="text-capitalize"><?php echo anchor(site_url('users/create'), '<i class="ri-add-line align-bottom me-1"></i> Añadir Nuevo Usuario', 'class="btn btn-green add-btn"'); ?></span>
                                    <span class="text-capitalize"><a href="#" onclick="loadModalContent('<?= site_url('users/create_group') ?>');" class="btn btn-green add-btn" data-bs-toggle="modal" data-bs-target="#ajax"><i class="ri-add-line align-bottom me-1"></i> Añadir Nuevo Grupo</a></span>
                                    <div class="search-box-table ms-2">
                                        <form id="search-box" class="input-group" action="<?php echo site_url('users/view'); ?>" method="post">
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
                                                <th class="text-capitalize"><a href="<?php echo site_url('users/view?ob=' . sentidobusquedacrd('username', 'users.')) . $filter . $custom_title; ?>" style="color:inherit;">Nombre de usuario <span class="block-sort"><i class="bx <?= $orden_campo == "first_name" ? ($orden_dir == "ASC" ? "bx-caret-down active" : "bx-caret-up active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="text-capitalize"><a href="<?php echo site_url('users/view?ob=' . sentidobusquedacrd('first_name', 'users.')) . $filter . $custom_title; ?>" style="color:inherit;">Nombre <span class="block-sort"><i class="bx <?= $orden_campo == "first_name" ? ($orden_dir == "ASC" ? "bx-caret-down active" : "bx-caret-up active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="text-capitalize"><a href="<?php echo site_url('users/view?ob=' . sentidobusquedacrd('last_name', 'users.')) . $filter . $custom_title; ?>" style="color:inherit;">Apellidos <span class="block-sort"><i class="bx <?= $orden_campo == "last_name" ? ($orden_dir == "ASC" ? "bx-caret-down active" : "bx-caret-up active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="text-capitalize"><a href="<?php echo site_url('users/view?ob=' . sentidobusquedacrd('email', 'users.')) . $filter . $custom_title; ?>" style="color:inherit;">Email <span class="block-sort"><i class="bx <?= $orden_campo == "email" ? ($orden_dir == "ASC" ? "bx-caret-down active" : "bx-caret-up active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="text-capitalize">Grupos</th>
                                                <th class="text-capitalize"><a href="<?php echo site_url('users/view?ob=' . sentidobusquedacrd('active', 'users.')) . $filter . $custom_title; ?>" style="color:inherit;">Estado <span class="block-sort"><i class="bx <?= $orden_campo == "active" ? ($orden_dir == "ASC" ? "bx-caret-down active" : "bx-caret-up active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            <? foreach ($users_data as $row) { ?>
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input check-selection" type="checkbox" name="checkAll" value="<?= $row->id ?>">
                                                        </div>
                                                    </th>
                                                    <td class=" text-left">
                                                        <div class>
                                                            <div class="flex-grow-1 tasks_name">
                                                                <?php echo daFormato($row->username, 'varchar', '0-0', '', '', '') ?></div>
                                                            <div class="flex-shrink-0">
                                                                <ul class="list-inline list-inline-dashed tasks-list-menu mb-0">
                                                                    <li class="list-inline-item fs-12">
                                                                        <a href="<?= site_url('users/update/' . $row->id) ?>">Editar</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div>
                                                    </td>
                                                    <td class=" text-left"><?php echo daFormato($row->first_name, 'varchar', '0-0', '', '', '') ?></td>
                                                    <td class=" text-left"><?php echo daFormato($row->last_name, 'varchar', '0-0', '', '', '') ?></td>
                                                    <td class=" text-left"><?php echo daFormato($row->email, 'varchar', '0-0', '', '', '') ?></td>
                                                    <td class=" text-left"><?php echo daFormato($row->groups, 'varchar', '0-0', '', '', '') ?></td>
                                                    <td class=" text-left">
                                                        <div class>
                                                            <div class="flex-grow-1 tasks_name">
                                                                <?= $row->active ? "Activo" : "Inactivo" ?>
                                                            </div>
                                                            <div class="flex-shrink-0">
                                                                <ul class="list-inline list-inline-dashed tasks-list-menu mb-0">
                                                                    <li class="list-inline-item fs-12">
                                                                        <a href="<?= site_url('users/' . ($row->active ? 'deactivate/' : 'activate/') . $row->id) ?>" <?= $row->active ? 'class="color-red"' : '' ?>><?= $row->active ? "Desactivar" : "Activar" ?></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div>
                                                    </td>
                                                </tr>
                                            <? } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="mb-0 flex-grow-1">
                                        <?= $total_rows > count($users_data) ? (count($users_data) . " de ") : "" ?><?= $total_rows ?> registro<?= $total_rows != 1 ? "s" : "" ?>.
                                    </div>
                                    <?php if ($total_rows > count($users_data)) : ?>
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
    <div class="modal-dialog modal-dialog-centered modal-lg modal-soaga">
        <div class="modal-content" style="min-height:30vh;">
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