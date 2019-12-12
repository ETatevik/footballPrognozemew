<?php
// conf
require_once("layouts/admin/inc/conf.php");
?>
<!DOCTYPE html>
<html lang="<?=$cnt->lang?>">
<head>
    <?php include_once("layouts/admin/inc/head.php");?>
    <title>Настройки</title>
</head>
<body data-ma-theme="<?=$color_theme?>">
    <main class="main">
        <!-- Page loader -->
        <div class="page-loader">
            <div class="page-loader__spinner">
                <svg viewBox="25 25 50 50">
                    <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
                </svg>
            </div>
        </div>
        <!-- Header -->
        <?php include_once("layouts/admin/inc/header.php");?>
        <!-- Sidebar -->
        <?php include_once("layouts/admin/inc/aside.php");?>
        <!-- Contents -->
        <section class="content">
            <div class="content__inner">
                <header class="content__title">
                    <h1>Настройки</h1>
                    <small>Левое меню, тема, и т.д....</small>
                </header>
                <!-- Pages -->
                <div class="card">
                    <div class="card-body">
                        <div class="tab-container">
                            <ul class="nav nav-tabs nav-fill nav-tabs--black" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#active" role="tab">Активный</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#archive" role="tab">Архив</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active fade show" id="active" role="tabpanel">
                                    <table class="table table-hover data-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Коллапс</th>
                                                <th>Родитель</th>
                                                <th>Заголовок</th>
                                                <th>Описание</th>
                                                <th>Статус Редактор</th>
                                                <th>Статус Гость</th>
                                                <th>Статус</th>
                                                <th class="actions_admin">Действия</th>
                                                <th>Сортировать</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // get data
                                            foreach($cnt->selectDataAdmin("a_menu","WHERE `status`!='2' ORDER BY `sort`", "all") as $pages) {
                                                // collapse
                                                if ($pages['collapse'] == 1) {
                                                    $collapse = '<i class="zmdi zmdi-check"></i>';
                                                } else {
                                                    $collapse = '';
                                                }
                                                ?>
                                                <tr id="sort_list_<?=$pages['id']?>" class="sortable" data-table="a_menu">
                                                <td><?= $pages['id']?></td>
                                                <td><?=$collapse?></td>
                                                <td><?=$cnt->selectDataAdmin("a_menu","WHERE `id`=".$pages['parent_id']."", 1)['title']?></td>
                                                <td>
                                                    <ul class="icon-list">
                                                        <li>
                                                            <?php
                                                                    // check data
                                                                    if ($pages['filename'] != 'none' && file_exists('layouts/admin/pages/'.$pages['filename'].'.php')) {?>
                                                            <a href="/admin/pages/<?=$pages['filename']?>" class="btn btn-light btn--raised"><i class="zmdi zmdi-<?=$pages['icon']?>"></i> <?=$pages['title']?></a>
                                                            <?php } else {?>
                                                            <i class="zmdi zmdi-<?=$pages['icon']?>"></i> <?=$pages['title']?>
                                                            <?php }?>
                                                        </li>
                                                        <li class="text-muted"><?=$pages['filename']?></li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <?php
                                                            // check data
                                                            if ($pages['descr'] != '') {
                                                                ?>
                                                    <button type="button" class="btn btn-light  btn--raised" data-placement="top" data-toggle="popover" data-trigger="hover" title="Description" data-content="<?=decodeText($pages['descr'], true, false)?>">Описание</button>
                                                    <?php }?>
                                                </td>
                                                <td>
                                                    <?php if($pages['status_editor'] != 0){?>
                                                    <div class="form-group">
                                                        <div class="toggle-switch toggle-switch--<?=$color_theme?>">
                                                            <input type="checkbox" name="status_editor" class="toggle-switch__checkbox editor" checked data-cmd="changeField" data-table="a_menu" data-id="<?= $pages['id']?>">
                                                            <i class="toggle-switch__helper"></i>
                                                        </div>
                                                    </div>
                                                    <?php }else{?>
                                                    <div class="form-group">
                                                        <div class="toggle-switch toggle-switch--<?=$color_theme?>">
                                                            <input type="checkbox" name="status_editor" class="toggle-switch__checkbox editor" unchecked data-cmd="changeField" data-table="a_menu" data-id="<?= $pages['id']?>">
                                                            <i class="toggle-switch__helper"></i>
                                                        </div>
                                                    </div>
                                                    <?php }?>
                                                </td>
                                                <td>
                                                    <?php if($pages['status_guest'] != 0){?>
                                                    <div class="form-group">
                                                        <div class="toggle-switch toggle-switch--<?=$color_theme?>">
                                                            <input type="checkbox" name="status_guest" class="toggle-switch__checkbox" checked data-cmd="changeField" data-table="a_menu" data-id="<?= $pages['id']?>">
                                                            <i class="toggle-switch__helper"></i>
                                                        </div>
                                                    </div>
                                                    <?php }else{?>
                                                    <div class="form-group">
                                                        <div class="toggle-switch toggle-switch--<?=$color_theme?>">
                                                            <input type="checkbox" name="status_guest" class="toggle-switch__checkbox" unchecked data-cmd="changeField" data-table="a_menu" data-id="<?= $pages['id']?>">
                                                            <i class="toggle-switch__helper"></i>
                                                        </div>
                                                    </div>
                                                    <?php }?>
                                                </td>
                                                <td>
                                                    <?php
                                                    // status not active
                                                    if($pages['status'] == '1') {
                                                        echo 'Aктивный';
                                                    } 
                                                    // status archive (2)
                                                    else {
                                                        echo 'Неактивный';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <!-- admin actions -->
                                                    <a href="/admin/pages/edit_setting?id=<?=$pages['id']?>" class="btn btn-light btn--raised" data-toggle="tooltip" data-placement="top" title="Редактировать"><i class="zmdi zmdi-edit"></i></a>
                                                    <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="archiveData" data-table="a_menu" data-id="<?=$pages['id']?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Архив"><i class="zmdi zmdi-archive"></i></a>
                                                    <a href="#" class="btn btn-danger ajax-action-confirm btn--raised" data-cmd="deleteDataAdmin" data-table="a_menu" data-id="<?=$pages['id']?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Удалить"><i class="zmdi zmdi-delete"></i></a>
                                                </td>
                                                <td>
                                                    <span class="btn btn-light handle btn--raised">
                                                        <span class="result-sort"><i class="zmdi zmdi-swap-vertical"></i></span>
                                                        <?= $pages['sort']?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane archive fade show" id="archive" role="tabpanel">
                                    <table class="table table-hover data-table">
                                        <thead>
                                            <tr>
                                               <th>#</th>
                                                <th>Коллапс</th>
                                                <th>Родитель</th>
                                                <th>Заголовок</th>
                                                <th>Описание</th>
                                                <th>Статус Редактор</th>
                                                <th>Статус Гость</th>
                                                <th>Статус</th>
                                                <th class="actions_admin">Действия</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // get data
                                            foreach($cnt->selectDataAdmin("a_menu","WHERE `status`='2'", "all") as $pages) {
                                                ?>
                                                <tr>
                                                    <td><?= $pages['id']?></td>
                                                    <td><?=$collapse?></td>
                                                    <td><?=$cnt->selectDataAdmin("a_menu","WHERE `id`=".$pages['parent_id']."", 1)['title']?></td>
                                                    <td>
                                                        <ul class="icon-list">
                                                            <li>
                                                                <?php
                                                                // check data
                                                                if ($pages['filename'] != 'none' && file_exists('layouts/admin/pages/'.$pages['filename'].'.php')) {
                                                                    ?>
                                                                    <a href="/admin/pages/<?=$pages['filename']?>" class="btn btn-light btn--raised"><i class="zmdi zmdi-<?=$pages['icon']?>"></i> <?=$pages['title']?></a>
                                                                    <?php } else {?>
                                                                    <i class="zmdi zmdi-<?=$pages['icon']?>"></i> <?=$pages['title']?>
                                                                <?php }?>
                                                            </li>
                                                            <li class="text-muted"><?=$pages['filename']?></li>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        // check data
                                                        if ($pages['descr'] != '') {
                                                            ?>
                                                            <button type="button" class="btn btn-<?=$color_theme?> btn--raised" data-placement="top" data-toggle="popover" data-trigger="hover" title="Description" data-content="<?=decodeText($pages['descr'], true, false)?>">Description</button>
                                                        <?php }?>
                                                    </td>
                                                    <td>
                                                        <?php if($pages['status_editor'] != 0){?>
                                                        <div class="form-group">
                                                            <div class="toggle-switch toggle-switch--<?=$color_theme?>">
                                                                <input type="checkbox" name="status_editor" class="toggle-switch__checkbox editor" checked data-cmd="changeField" data-table="a_menu" data-id="<?= $pages['id']?>">
                                                                <i class="toggle-switch__helper"></i>
                                                            </div>
                                                        </div>
                                                        <?php }else{?>
                                                        <div class="form-group">
                                                            <div class="toggle-switch toggle-switch--<?=$color_theme?>">
                                                                <input type="checkbox" name="status_editor" class="toggle-switch__checkbox editor" unchecked data-cmd="changeField" data-table="a_menu" data-id="<?= $pages['id']?>">
                                                                <i class="toggle-switch__helper"></i>
                                                            </div>
                                                        </div>
                                                        <?php }?>
                                                    </td>
                                                    <td>
                                                        <?php if($pages['status_guest'] != 0){?>
                                                        <div class="form-group">
                                                            <div class="toggle-switch toggle-switch--<?=$color_theme?>">
                                                                <input type="checkbox" name="status_guest" class="toggle-switch__checkbox" checked data-cmd="changeField" data-table="a_menu" data-id="<?= $pages['id']?>">
                                                                <i class="toggle-switch__helper"></i>
                                                            </div>
                                                        </div>
                                                        <?php }else{?>
                                                        <div class="form-group">
                                                            <div class="toggle-switch toggle-switch--<?=$color_theme?>">
                                                                <input type="checkbox" name="status_guest" class="toggle-switch__checkbox" unchecked data-cmd="changeField" data-table="a_menu" data-id="<?= $pages['id']?>">
                                                                <i class="toggle-switch__helper"></i>
                                                            </div>
                                                        </div>
                                                        <?php }?>
                                                    </td>
                                               <td>
                                                    <?php
                                                    // status not active
                                                    if($pages['status'] == '1') {
                                                        echo 'Aктивный';
                                                    } 
                                                    // status archive (2)
                                                    else {
                                                        echo 'Неактивный';
                                                    }
                                                    ?>
                                                </td>
                                                    <td>
                                                    <!-- admin actions -->
                                                    <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="archiveData" data-table="a_menu" data-id="<?=$pages['id']?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Архив"><i class="zmdi zmdi-archive"></i></a>
                                                    <a href="#" class="btn btn-danger ajax-action-confirm btn--raised" data-cmd="deleteDataAdmin" data-table="a_menu" data-id="<?=$pages['id']?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Удалить"><i class="zmdi zmdi-delete"></i></a>
                                                </td>
                                                </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add theme -->
                <!-- Footer -->
                <?php include_once("layouts/admin/inc/footer.php");?>
            </div>
        </section>
    </main>
    <?php include_once("layouts/admin/inc/scripts.php");?>
</body>

</html>
