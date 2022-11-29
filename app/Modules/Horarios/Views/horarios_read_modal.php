<div class="modal-header">
    <h5 class="h5-title"><?= isset($subtitulo) ? $subtitulo : '' ?><span style="color:#ffffff"><?= isset($data_fields['nombre']) ? $data_fields['nombre'] : "" ?></span></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <table class="table align-middle table-nowrap table-vista mb-0">
        <tbody>

            <tr>
                <th scope="row">Proyecto ID</th>
                <td><?= $data_fields['proyecto_id'] ?>
            <tr>
                <th scope="row" class="font-weight-bold">Titulo</th>
                <td><?= $data_fields['titulo'] ?></td>
            </tr>

            <tr>
                <th scope="row" class="font-weight-bold">Descripcion</th>
                <td><a href="#" onClick="$('#t1521736875').toggle()"><?= substr($data_fields['descripcion'], 0, 50) ?>...</a>
                    <div id="t1521736875" style="display:none"><?= $data_fields['descripcion'] ?></div>
                </td>
            </tr>
        </tbody>
    </table>
</div>