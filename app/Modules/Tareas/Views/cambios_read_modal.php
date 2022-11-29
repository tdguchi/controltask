<div class="modal-header">
	<h5 class="h5-title"><span style="color:#ffffff"></span></h5>
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
	<table class="table align-middle table-nowrap table-vista mb-0">
		<tbody>
			<tr>
				<h4>Cambios realizados a la tarea: <?= $titulo ?></h4>
			</tr>
			<tr>
				<th scope="row" class="font-weight-bold">Campo modificado</th>
				<th scope="row" class="font-weight-bold">Valor anterior</th>
				<th scope="row" class="font-weight-bold">Valor nuevo</th>
			</tr>
			<?
			array_map(function($key, $v1, $v2){
				echo '<tr>';
				echo '<td>' . $key . '</td>';
				echo '<td>' . $v1 . '</td>';
				echo '<td>' . $v2 . '</td>';
				echo '</tr>';
			},array_keys($originales), $originales, $cambiados);
			 ?>


			
		</tbody>
	</table>
</div>