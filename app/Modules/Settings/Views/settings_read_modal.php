<div class="modal-header">
    <h5 class="h5-title"><?= isset($subtitulo) ? $subtitulo : '' ?><span style="color:#ffffff"><?= isset($data_fields['nombre']) ? $data_fields['nombre'] : "" ?></span></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <table class="table align-middle table-nowrap table-vista mb-0">
        <tbody>

            <tr>
                <th scope="row">Clave</th>
                <td><?= $data_fields['key'] ?>
            <tr>
                <th scope="row" class="font-weight-bold">Valor</th>
                <td><?= $data_fields['value'] ?></td>
            </tr>

            <tr>
                <th scope="row" class="font-weight-bold">Descripción</th>
                <td><?= $data_fields['description'] ?></td>
            </tr>
        </tbody>
    </table>
</div>