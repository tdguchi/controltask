<?php
try {
    $ionAuth = new \IonAuth\Libraries\IonAuth();
    $user = $ionAuth->user()->row();
} catch (Error $e) {
    $user = false;
}
?>
<?php if ($user) : ?>
    <div class="dropdown header-item topbar-user">
        <button title="Dropdown usuario" type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="d-flex align-items-center">
                <i class="bx bx-user fs-22"></i>
                <span class="text-start ms-xl-2">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?= $user->first_name ?> <?= $user->last_name ?></span>
                </span>
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <a title="Cambiar contraseña" class="dropdown-item" href="<?= base_url('auth/change_password') ?>"><i class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Cambiar contraseña</span></a>
            <a title="Cerrar sesión" class="dropdown-item" href="<?= base_url('auth/logout') ?>"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Cerrar Sesión</span></a>
        </div>
    </div>
<?php endif; ?>