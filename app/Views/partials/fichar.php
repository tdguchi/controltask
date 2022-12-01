<div class="row">
                <div class="col text-center">
                    <h4>Actualmente estás  <?= $fichado ? "dentro del sistema" : "fuera del sistema" ?></h4>
                    <h4>Es necesario estar dentro del sistema para interactuar con él</h4>
                    <a href="#" title="fichar" onclick="loadModalContent('<?= site_url('asistencias/fichar/1') ?>');" data-bs-toggle="modal" data-bs-target="#ajax" class="btn <?= $fichado ? 'btn-danger' : 'btn-success' ?> btn-lg text-dark">Fichar  <?= $fichado ? "Salida" : "Entrada" ?></a>
                </div>
            </div><br>