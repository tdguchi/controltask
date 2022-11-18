<div class="modal-header">
    <h5 class="h5-title"><?= isset($subtitulo) ? $subtitulo : '' ?><span style="color:#ffffff"><?= isset($data_fields['nombre']) ? $data_fields['nombre'] : "" ?></span></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <table class="table align-middle table-nowrap table-vista mb-0">
        <tbody>

            <tr>
                <th scope="row" class="font-weight-bold">Fecha Hora</th>
                <td><?= date("d/m/Y H:i:s", strtotime($data_fields['fechahora'])) ?></td>
            </tr>

            <tr>
                <th scope="row" class="font-weight-bold">Tipo De Asistencia</th>
                <td><?= $data_fields['asistenciatipo_id'] ?></td>
            </tr>

            <tr>
                <th scope="row" class="font-weight-bold">Operador</th>
                <td><?= $data_fields['usuario_id'] ?></td>
            </tr>

            <tr>
                <th scope="row" class="font-weight-bold">Comentario</th>
                <td><?= $data_fields['comentario'] ?></td>
            </tr>
        </tbody>
    </table>
</div>