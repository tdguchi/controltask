<div class="modal-header">
	<h5 class="h5-title"><?= isset($subtitulo) ? $subtitulo : '' ?><span style="color:#ffffff"><?= isset($data_fields['nombre']) ? $data_fields['nombre'] : "" ?></span></h5>
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
	<table class="table align-middle table-wrap table-vista mb-0">
		<tbody>
			<tr>
				<th scope="row" class="font-weight-bold">Titulo</th>
				<td><?= $data_fields['titulo'] ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Descripción</th>
				<td style="word-wrap: break-word;"><?= $data_fields['descripcion'] ?></td>
			</tr>
			<tr>
				<th scope="row" class="font-weight-bold">Operador</th>
				<td><?= $data_fields['usuario_nombre'] ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Usuarios Adicionales</th>
				<td><?= $data_fields['usuariosadicionales'] ?></td>
			</tr>
			<tr <?= ($data_fields['estado'] == 1) ? 'bgcolor="#A7FFFE"' : (($data_fields['estado'] == 2) ? 'bgcolor="#D8FAE0"' : 'bgcolor=#FFD28E' ) ?>>
				<th scope="row" class="font-weight-bold">Estado</th>
				<td><?= $data_fields['texto_estado'] ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Fecha Estimada</th>
				<td><?= date("d/m/Y", strtotime($data_fields['fechaestimada'])) ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Tiempo estimado</th>
				<td><?= minutosdesplegado($data_fields['horasestimadas']) ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Tiempo dedicado</th>
				<td><?= minutosdesplegado($data_fields['horasreales']) ?></td>
			</tr>
		</tbody>
	</table>
</div>