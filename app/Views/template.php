<!DOCTYPE html>
<html class="loading" lang="es" data-textdirection="ltr">

<head>
    <meta charset="utf-8" />
    <title><?= isset($title) ? $title : 'ControlTask' ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="<?= isset($description) ? $description : '' ?>">

    <script src="<?= base_url() ?>/assets/js/jquery-3.6.0.min.js"></script>
    <!-- Layout config Js -->
    <script src="<?= base_url() ?>/assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css"
    integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">
        <!-- Icons Css -->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="<?= base_url() ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url() ?>/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?= base_url() ?>/assets/css/custom.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- JAVASCRIPT -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url() ?>/assets/libs/node-waves/waves.min.js"></script>
    <script src="<?= base_url() ?>/assets/libs/feather-icons/feather.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="<?= base_url() ?>/assets/js/plugins.js"></script>
    <script src="<?= base_url() ?>/assets/libs/select2/select2.min.js"></script>
    <link href="<?= base_url() ?>/assets/libs/select2/select2.min.css" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body>
    <header id="page-topbar">
        <div class="layout-width">
            <div class="navbar-header">
                <div class="d-flex align-items-center">
                    <button title="esconder o mostrar el menú" type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn" id="toggle-menu">
                        <i class="bx bx-menu"></i>
                    </button>
                    <?= view('partials/breadcrumb') ?>
                </div>
                <div class="d-flex align-items-center">
                    <?= view('partials/user_menu') ?>
                </div>
            </div>
        </div>
    </header>

    <div class="app-menu navbar-menu">
        <div style="height:61px;text-align:center;border-bottom:1px solid #dee2e6;display:flex;justify-content:center;align-items:center;">
            <a href="<?= base_url() ?>">
                <img alt="logo controltask" src="<?= base_url() ?>/assets/images/logo-light.png" alt="" height="22">
            </a>
        </div>
        <?= view('partials/menu'); ?>
    </div>
    <div id="layout-wrapper">
        <?= view($main); ?>
    </div>

    <script src="<?= base_url() ?>/assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/pages/dashboard-crm.init.js"></script>
    <script src="<?= base_url() ?>/assets/libs/list.js/list.min.js"></script>
    <script src="<?= base_url() ?>/assets/libs/list.pagination.js/list.pagination.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/pages/tasks-list.init.js"></script>
    <script src="<?= base_url() ?>/assets/js/app.js"></script>
    <script src="<?= base_url() ?>/assets/js/custom.js"></script>
</body>

</html>