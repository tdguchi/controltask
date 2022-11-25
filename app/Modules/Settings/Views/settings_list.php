<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
        <?= view('partials/fichar') ?>
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
                                <?php if ($fichado === true) { ?>
                                    <span class="text-capitalize"><a href="#" onclick="loadModalContent('<?= site_url('settings/create/1') ?>');" class="btn btn-green add-btn" data-bs-toggle="modal" data-bs-target="#ajax"><i class="ri-add-line align-bottom me-1"></i> Añadir <?= $titulo ?></a></span>
                                    <?php } ?>
                                    <div class="search-box-table ms-2">
                                        <form id="search-box" class="input-group" action="<?php echo site_url('settings/view'); ?>" method="post">
                                        <?php csrf_field() ?>
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
                                                <th class="sort text-capitalize ">
                                                    <a href="<?php echo site_url('settings/view?ob=' . sentidobusquedacrd('key', 'settings.')) . $filter . $custom_title; ?>" style="color:inherit;">Clave <span class="block-sort"><i class="bx <?= $orden_campo == "key" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a>
                                                </th>
                                                <th class="sort text-capitalize "><a href="<?php echo site_url('settings/view?ob=' . sentidobusquedacrd('value', 'settings.')) . $filter . $custom_title; ?>" style="color:inherit;">Valor <span class="block-sort"><i class="bx <?= $orden_campo == "value" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                                <th class="sort text-capitalize "><a href="<?php echo site_url('settings/view?ob=' . sentidobusquedacrd('description', 'settings.')) . $filter . $custom_title; ?>" style="color:inherit;">Descripción <span class="block-sort"><i class="bx <?= $orden_campo == "description" ? ($orden_dir == "ASC" ? "bx-caret-up active" : "bx-caret-down active") : "bxs-sort-alt" ?>"></i></span></a></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            <? foreach ($settings_data as $row) { ?>
                                                <tr>
                                                    <td class="text-left "><?= $row->key ?> <div class="flex-shrink-0">
                                                    <?php if ($fichado === true) { ?>
                                                            <ul class="list-inline list-inline-dashed tasks-list-menu mb-0">
                                                                <li class="list-inline-item fs-12">
                                                                    <a href="#" onclick="loadModalContent('<?= site_url('settings/update/' . $row->key) ?>/1')" data-bs-toggle="modal" data-bs-target="#ajax">Editar</a>
                                                                </li>
                                                            </ul>
                                                        <?php } ?>
                                                        </div>
                                                    </td>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
$token_name = csrf_token();
$token_hash = csrf_hash();
?>
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
        $.post(url, {'<?= $token_name; ?>':'<?= $token_hash; ?>'}, function(result) {
            $("#ajax .modal-content").html(result);
        });
        $('#ajax').on('hidden.bs.modal', function(e) {
            $("#ajax .modal-header").html('<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>');
            $("#ajax .modal-body").html('<div style="margin:0;position:absolute;left:50%;top:50%;-ms-transform:translate(-50%,-50%);transform:translate(-50%,-50%);"><div class="spinner-border" style="width: 5rem; height: 5rem;" role="status"><span class="visually-hidden">Cargando...</span></div></div>');
            $("#ajax .modal-footer").html("");
        });
    }
</script>