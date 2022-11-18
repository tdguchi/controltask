<div class="modal-header">
	<h5 class="h5-title"><?= isset($subtitulo) ? $subtitulo : '' ?><span style="color:#ffffff"><?= isset($data_fields['nombre']) ? $data_fields['nombre'] : "" ?></span></h5>
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
	<table class="table align-middle table-nowrap table-vista mb-0">
		<tbody>

			<tr>
				<th scope="row">Operador Id</th>
				<td><?= $data_fields['operador_id'] ?>
			<tr>
				<th scope="row" class="font-weight-bold">Nombre</th>
				<td><?= $data_fields['nombre'] ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Apellidos</th>
				<td><?= $data_fields['apellidos'] ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Dni</th>
				<td><?= $data_fields['dni'] ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Email</th>
				<td><?= $data_fields['email'] ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Password</th>
				<td><?= $data_fields['password'] ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Entrada Mañana</th>
				<td><?= date("d/m/Y H:i:s", strtotime($data_fields['entrada_manana'])) ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Salida Mañana</th>
				<td><?= date("d/m/Y H:i:s", strtotime($data_fields['salida_manana'])) ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Entrada Tarde</th>
				<td><?= date("d/m/Y H:i:s", strtotime($data_fields['entrada_tarde'])) ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Salida Tarde</th>
				<td><?= date("d/m/Y H:i:s", strtotime($data_fields['salida_tarde'])) ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Entrada Verano Mañana</th>
				<td><?= date("d/m/Y H:i:s", strtotime($data_fields['entrada_verano_manana'])) ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Salida Verano Mañana</th>
				<td><?= date("d/m/Y H:i:s", strtotime($data_fields['salida_verano_manana'])) ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Entrada Verano Tarde</th>
				<td><?= date("d/m/Y H:i:s", strtotime($data_fields['entrada_verano_tarde'])) ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Salida Verano Tarde</th>
				<td><?= date("d/m/Y H:i:s", strtotime($data_fields['salida_verano_tarde'])) ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Tipo</th>
				<td><?= $data_fields['tipo'] ?></td>
			</tr>

			<tr>
				<th scope="row" class="font-weight-bold">Activado</th>
				<td><input type="checkbox" disabled <?= $data_fields['activado'] == "1" ? "checked" : "" ?> value="<?= $data_fields['activado'] ?>"></td>
			</tr>
		</tbody>
	</table>
</div>