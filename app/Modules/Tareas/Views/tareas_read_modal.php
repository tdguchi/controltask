<div class="modal-header">
	<h5 class="h5-title"><?= isset($subtitulo) ? $subtitulo : '' ?><span style="color:#ffffff"><?= isset($data_fields['nombre']) ? $data_fields['nombre'] : "" ?></span></h5>
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
	<table class="table align-middle table-nowrap table-vista mb-0">
		<tbody>

			<tr>
				<th scope="row">Tarea ID</th>
				<td><?= $data_fields['tarea_id'] ?>
			<tr>
				<th scope="row" class="font-weight-bold">Estado</th>
				<td><?= $data_fields['estado'] ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Operador</th>
				<td><?= $data_fields['usuario_nombre'] ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Usuarios Adicionales</th>
				<td><?= $data_fields['usuariosadicionales'] ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Titulo</th>
				<td><?= $data_fields['titulo'] ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Descripción</th>
				<td><a href="#" onClick="$('#t225686307').toggle()"><?= substr($data_fields['descripcion'], 0, 50) ?>...</a>
					<div id="t225686307" style="display:none"><?= $data_fields['descripcion'] ?></div>
				</td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Fecha Objetivo</th>
				<td><?= date("d/m/Y", strtotime($data_fields['fechaobjetivo'])) ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Fecha Estimada</th>
				<td><?= date("d/m/Y", strtotime($data_fields['fechaestimada'])) ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Horas Estimadas</th>
				<td><?= $data_fields['horasestimadas'] ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Fecha Comienzo</th>
				<td><?= date("d/m/Y H:i:s", strtotime($data_fields['fechacomienzo'])) ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Fecha Real Cierre</th>
				<td><?= date("d/m/Y H:i:s", strtotime($data_fields['fecharealcierre'])) ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Horas Reales</th>
				<td><?= $data_fields['horasreales'] ?></td>
			</tr>
		</tbody>
	</table>
</div>