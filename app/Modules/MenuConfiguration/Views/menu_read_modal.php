<div class="modal-header">
    <h5 class="h5-title"><?= isset($subtitulo) ? $subtitulo : '' ?><span style="color:#ffffff"><?= isset($data_fields['nombre']) ? $data_fields['nombre'] : "" ?></span></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <table class="table align-middle table-nowrap table-vista mb-0">
        <tbody>

            <tr>
                <th scope="row">#</th>
                <td><?= $data_fields['menu_id'] ?>
            <tr>
                <th scope="row" class="font-weight-bold">Texto</th>
                <td><?= $data_fields['text'] ?></td>
            </tr>

            <tr>
                <th scope="row" class="font-weight-bold">URL</th>
                <td><a href="/<?= $data_fields['url'] ?>" target="_blank"><?= $data_fields['url'] ?></a></td>
            </tr>

            <tr>
                <th scope="row" class="font-weight-bold">Posición</th>
                <td><?= $data_fields['position'] ?></td>
            </tr>

            <tr>
                <th scope="row" class="font-weight-bold">Parent</th>
                <td><? foreach ($s_parent as $c) {
                        if ($c->menu_id == $data_fields['parent']) {
                            echo $c->text;
                        }
                    } ?></td>
            </tr>

            <tr>
                <th scope="row" class="font-weight-bold">Icono</th>
                <td><?= $data_fields['icon'] ?></td>
            </tr>

            <tr>
                <th scope="row" class="font-weight-bold">¿Menú?</th>
                <td><input type="checkbox" disabled <?= $data_fields['show_in_menu'] == "1" ? "checked" : "" ?> value="<?= $data_fields['show_in_menu'] ?>"></td>
            </tr>

            <tr>
                <th scope="row" class="font-weight-bold">¿Dashboard?</th>
                <td><input type="checkbox" disabled <?= $data_fields['show_in_dashboard'] == "1" ? "checked" : "" ?> value="<?= $data_fields['show_in_dashboard'] ?>"></td>
            </tr>

            <tr>
                <th scope="row" class="font-weight-bold">Descripción</th>
                <td><a href="#" onClick="$('#t1073398560').toggle()"><?= substr($data_fields['dashboard_description'], 0, 50) ?>...</a>
                    <div id="t1073398560" style="display:none"><?= $data_fields['dashboard_description'] ?></div>
                </td>
            </tr>

            <tr>
                <th scope="row" class="font-weight-bold">Solo Administrador</th>
                <td><input type="checkbox" disabled <?= $data_fields['admin_only'] == "1" ? "checked" : "" ?> value="<?= $data_fields['admin_only'] ?>"></td>
            </tr>
        </tbody>
    </table>
</div>