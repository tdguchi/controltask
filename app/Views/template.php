<!DOCTYPE html>
<html class="loading" lang="es" data-textdirection="ltr">

<head>
    <meta charset="utf-8" />
    <title><?= isset($title) ? $title : '' ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="<?= isset($description) ? $description : '' ?>">

    <script src="<?= base_url() ?>/assets/js/jquery-3.6.0.min.js"></script>
    <!-- Layout config Js -->
    <script src="<?= base_url() ?>/assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?= base_url() ?>/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url() ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url() ?>/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?= base_url() ?>/assets/css/custom.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- JAVASCRIPT -->
    <script src="<?= base_url() ?>/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
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
                    <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn" id="toggle-menu">
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
                <img src="<?= base_url() ?>/assets/images/logo-dark.png" alt="" height="22">
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