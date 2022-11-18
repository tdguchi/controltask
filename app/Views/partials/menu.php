<?php

$menuModel = model('App\Modules\Menu\Models\Menu_model');
$menuItems = $menuModel->get_menu_items();

function in_url($link_url)
{
    $url_segments = explode('/', current_url());
    return in_array($link_url, $url_segments);
}

?>

<div id="scrollbar">
    <div class="container-fluid">
        <ul class="navbar-nav lateral-menu" id="navbar-nav">
            <?php foreach ($menuItems as $item) : ?>
                <?
                $collapse = 'collapse';
                $expanded = 'false';
                $active = ($item['url'] && in_url($item['url']) !== false) ? 'active' : '';
                $activechild = '';
                foreach ($item['children'] as $child) {
                    if ($child['url'] && in_url($child['url']) !== false) {
                        $expanded = 'true';
                        $collapse = 'collapse show';
                    }
                }
                ?>
                <li class="nav-item">
                    <?php if (count($item['children']) > 0) : ?>
                        <a class="nav-link menu-link <?= $active ?>" href="#sidebar<?= $item['id'] ?>" data-bs-toggle="collapse" role="button" aria-expanded="<?= $expanded ?>" aria-controls="sidebar<?= $item['id'] ?>">
                            <i class="<?= $item['icon'] ?>"></i><span><?= $item['text'] ?></span>
                        </a>
                        <div class="<?= $collapse ?> menu-dropdown" id="sidebar<?= $item['id'] ?>">
                            <ul class="nav nav-sm flex-column">
                                <?php foreach ($item['children'] as $child) : ?>
                                    <?php
                                    $activechild = ($child['url'] && in_url($child['url']) !== false) ? 'active' : '';
                                    ?>
                                    <li class="nav-item">
                                        <a href="<?= base_url($child['url']) ?>" class="nav-link <?= $activechild ?>"> <?= $child['text'] ?> <i class="<?= $child['icon'] ?>"></i></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php else : ?>
                        <a href="<?= base_url($item['url']) ?>" class="nav-link <?= $active ?>"><i class="<?= $item['icon'] ?>"></i><?= $item['text'] ?></a>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>