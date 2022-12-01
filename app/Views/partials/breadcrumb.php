<?php

$menuModel = model('App\Modules\Menu\Models\Menu_model');
$cur_url = substr(uri_string(), 0, strpos(uri_string(), "/"));
if (!$cur_url) {
    $cur_url = substr(uri_string(), 0);
}

$menuElement = $cur_url ? $menuModel->get_by_url($cur_url) : false;
$parentElement = $menuElement ? $menuModel->get_by_id($menuElement->parent) : '';
?>

<a title="Ir a principal" href="<?= base_url() ?>"><i class="ri-home-3-fill"></i></a>

<?php if ($parentElement) : ?>
    / <?= $parentElement->text ?>
<?php endif; ?>
<?php if ($menuElement) : ?>
    / <?= $menuElement->text ?>
<?php endif; ?>