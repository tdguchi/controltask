<?php

$menuModel = model('App\Modules\Menu\Models\Menu_model');
$dashboardItems = $menuModel->get_dashboard_items();

?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
        <div class="row">
            <div class="col text-center">
            <button class="btn btn-warning btn-lg text-dark">Fichar</button>
            </div>
        </div><br>
            <div class="row">
                <?php foreach ($dashboardItems as $item) : ?>
                    <?php if (count($item['children']) > 0) : ?>
                        <div class="col-lg-12 dashboard-category">
                            <h2 class="text-uppercase"><?= $item['text'] ?></h2>
                            <div class="row">
                                <?php foreach ($item['children'] as $child) : ?>
                                    <div class="col-lg-3 dashboard-element">
                                        <div class="card">
                                            <div class="card-header">
                                                <a href="<?= base_url($child['url']) ?>"><?= $child['text'] ?></a>
                                            </div>
                                            <div class="card-body">
                                                <?= $child['dashboard_description'] ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="col-lg-3 dashboard-element">
                            <div class="card">
                                <div class="card-header">
                                    <a href="<?= base_url($item['url']) ?>"><?= $item['text'] ?></a>
                                </div>
                                <div class="card-body">
                                    <?= $item['dashboard_description'] ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>