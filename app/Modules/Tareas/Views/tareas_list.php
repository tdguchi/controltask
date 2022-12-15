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
                                    <?php if (count($group_id) == 2) { ?>
                                        <span class="text-capitalize"><?php echo anchor(site_url('tareas/view/0/1'), 'Propias', 'class="btn btn-green add-btn"'); ?></span>
                                        <span class="text-capitalize"><?php echo anchor(site_url('tareas/view/0/2'), 'Todas', 'class="btn btn-green add-btn"'); ?></span>
                                    <?php } ?>
                                    <?php if ($fichado === true) { ?>
                                        <span class="text-capitalize"><a href=" <?= site_url('tareas/create') ?>" class="btn btn-green add-btn"><i class="ri-add-line align-bottom me-1"></i> Añadir <?= $titulo ?></a></span>
                                        <span class="text-capitalize"><?php echo anchor(site_url('tareas/excel'), 'Exportar Excel', 'class="btn btn-green add-btn"'); ?></span>
                                        <button type="button" id="delete-selected" onclick="deleteSelected();" class="btn btn-outline-red waves-effect waves-light ms-2 d-none bulk-actions">Eliminar Seleccionados</button>
                                    <?php } ?>
                                    <div class="search-box-table ms-2">
                                        <form id="search-box" class="input-group" action="<?php echo site_url('tareas/view'); ?>" method="post">
                                            <?= csrf_field() ?>

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
    <ul class="list-group accordion" id="accordionExample">
      <li class="list-group-item accordion-item bg-info bg-opacity-25 mb-2">
        <div class="d-flex justify-content-between">
          <div>
            <h5>Poner como una lista</h5>
            <h6>Crear ControlTask</h6>
          </div>
          <div class="btn-group">
            <button class="btn btn-primary"><i class="fa fa-play"></i></button>
            <button class="btn btn-danger"><i class="fa fa-stop"></i></button>
            <button class="btn btn-secondary" onclick="updateElementClass(this)" data-bs-toggle="collapse" data-bs-target="#collapseOne"
              aria-expanded="true" aria-controls="collapseOne"><i class='bx bx-chevron-down'></i></button>
          </div>
        </div>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
          data-bs-parent="#accordionExample">
          <div class="accordion-body d-flex justify-content-between">
            <div>
              <p>Operador: Pablo</p>
              <p>Fecha: 28/12/2020</p>
              <p>Estado: En proceso</p>
              <p>Descripción: Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
            </div>
            <div>
              <h3>00:34:43</h3>
            </div>
          </div>
        </div>
      </li>
      <li class="list-group-item accordion-item bg-warning bg-opacity-25 mb-2">
        <div class="d-flex justify-content-between">
          <div>
            <h5>Añadir multiempresa</h5>
            <h6>Crear ControlTask</h6>
          </div>
          <div class="btn-group">
            <button class="btn btn-warning"><i class="fa fa-pause"></i></button>
            <button class="btn btn-danger"><i class="fa fa-stop"></i></button>
            <button class="btn btn-secondary" onclick="updateElementClass(this)" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
              aria-expanded="true" aria-controls="collapseTwo"><i class='bx bx-chevron-down'></i></button>
          </div>
        </div>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
          data-bs-parent="#accordionExample">
          <div class="accordion-body d-flex justify-content-between">
            <div>

              <p>Operador: Pablo</p>
              <p>Fecha: 26/12/2020</p>
              <p>Estado: En pausa</p>
              <p>Descripción: Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
            </div>
            <div>
              <h3>00:14:23</h3>
            </div>
          </div>
      </li>
      <li class="list-group-item accordion-item bg-success bg-opacity-25 mb-2">
        <div class="d-flex justify-content-between">
          <div>
            <h5>Crear el CRUD</h5>
            <h6>Crear la base de ControlTask</h6>
          </div>
          <div class="btn-group">
            <button class="btn btn-secondary" onclick="updateElementClass(this)" data-bs-toggle="collapse" data-bs-target="#collapseThird"
              aria-expanded="true" aria-controls="collapseThird"><i class='bx bx-chevron-down'></i></button>
          </div>
        </div>
        <div id="collapseThird" class="accordion-collapse collapse" aria-labelledby="headingThird"
          data-bs-parent="#accordionExample">
          <div class="accordion-body d-flex justify-content-between">
            <div>
              <p>Operador: Pablo</p>
              <p>Fecha: 01/12/2020</p>
              <p>Estado: Finalizada</p>
              <p>Descripción: Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
            </div>
            <div>
              <h3>04:44:22</h3>
            </div>
          </div>
      </li>
      <li class="list-group-item accordion-item bg-success bg-opacity-25 mb-2">
        <div class="d-flex justify-content-between">
          <div>
            <h5>Crear BBDD</h5>
            <h6>Crear la base de ControlTask</h6>
          </div>
          <div class="btn-group">
            <button class="btn btn-secondary" onclick="updateElementClass(this)" data-bs-toggle="collapse" data-bs-target="#collapsefour"
              aria-expanded="true" aria-controls="collapsefour"><i class='bx bx-chevron-down'></i></button>
          </div>
        </div>
        <div id="collapsefour" class="accordion-collapse collapse" aria-labelledby="headingfour"
          data-bs-parent="#accordionExample">
          <div class="accordion-body d-flex justify-content-between">
            <div>
              <p>Operador: Pablo</p>
              <p>Fecha: 01/12/2020</p>
              <p>Estado: Finalizada</p>
              <p>Descripción: Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
            </div>
            <div>
              <h3>02:17:28</h3>
            </div>
          </div>
      </li>
    </ul>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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
        $.post(url, {
        }, function(result) {
            $("#ajax .modal-content").html(result);
        });
        $('#ajax').on('hidden.bs.modal', function(e) {
            $("#ajax .modal-header").html('<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>');
            $("#ajax .modal-body").html('<div style="margin:0;position:absolute;left:50%;top:50%;-ms-transform:translate(-50%,-50%);transform:translate(-50%,-50%);"><div class="spinner-border" style="width: 5rem; height: 5rem;" role="status"><span class="visually-hidden">Cargando...</span></div></div>');
            $("#ajax .modal-footer").html("");
        });
    }
</script>
<link href="<?= base_url() ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<script src="<?= base_url() ?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script>
    function deleteSelected() {
        $("#delete-selected").prop("disabled", true);
        let ids = []
        $("input.check-selection:checked").each(function() {
            ids.push($(this).val())
        });
        if (ids.length) {
            Swal.fire({
                title: "¿Seguro que deseas eliminar los tareas seleccionados?",
                text: "¡No se podrá revertir!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
                cancelButtonClass: 'btn btn-danger w-xs mt-2',
                confirmButtonText: "Aceptar",
                cancelButtonText: "Cancelar",
                buttonsStyling: false,
                showCloseButton: true
            }).then(function(result) {
                if (result.value) {
                    window.location.href = "<?= site_url("tareas/bulk_delete/") ?>" + ids.join("/");
                } else {
                    $("#delete-selected").prop("disabled", false);
                }
            });
        } else {
            $("#delete-selected").prop("disabled", false);
        }
    }

    function deleteItem(id) {
        Swal.fire({
            title: "¿Seguro que deseas eliminar el tareas seleccionado?",
            text: "¡No se podrá revertir!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
            cancelButtonClass: 'btn btn-danger w-xs mt-2',
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            buttonsStyling: false,
            showCloseButton: true
        }).then(function(result) {
            if (result.value) {
                window.location.href = "<?= site_url("tareas/delete/") ?>" + id;
            }
        });
    }

    $(function() {
        $('table input[type=checkbox]').on('change', function() {
            if ($('table input[type=checkbox]:checked').length > 0) {
                $('.bulk-actions').removeClass('d-none');
            } else {
                $('.bulk-actions').addClass('d-none');
            }
        })
    })
</script>
  <script>
    function updateElementClass(elemento) {
      var i = elemento.querySelector("i");
      if (elemento.classList.contains("show")) {
        elemento.classList.remove("show");
        i.classList.remove("bx-chevron-up");
        i.classList.add("bx-chevron-down");
      } else {
        elemento.classList.add("show");
        i.classList.remove("bx-chevron-down");
        i.classList.add("bx-chevron-up");        

      }
    }
  </script>