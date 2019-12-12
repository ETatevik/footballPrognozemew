<?php
// conf
require_once("layouts/admin/inc/conf.php");
// page
$page =  $cnt->selectDataAdmin("a_menu", "WHERE `filename`='pages'");?>
<!DOCTYPE html>
<html lang="<?=$cnt->lang?>">
    <head>
        <?php include_once("layouts/admin/inc/head.php");?>
        <title>Pages</title>
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
                        <h1><?=$page['title']?></h1>
                        <small><?=$page['descr']?></small>
                    </header>
                    <!--SELECT ALBUM -->
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
                                                    <th>Заголовок</th>
                                                    <th>Описание</th>
                                                    <th>Статус</th>
                                                    <th class="actions_admin">Действия</th>
                                                    <th>Сортировать</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // get data
                                                foreach($cnt->selectDataAdmin("pages", "WHERE `status`!='2' ORDER BY `sort`", "all") as $pages) {
                                                    $id = $pages['id'];
                                                    $filename = $pages['filename'];
                                                    $icon = $pages['icon'];
                                                    // check title_ru
                                                    $title_ru = '';
                                                    if ($pages['title_ru'] != '') {
                                                         $title_ru = '<li title="Заголовок RU" data-toggle="tooltip" data-placement="top">
                                                                        <?php
                                                                        if ($filename != "none" && file_exists("layouts/admin/pages/".$filename.".php")) {?>
                                                                        <?php } else {?>
                                                                        <i class="zmdi zmdi-'.$pages['icon'].'"></i>'.$pages['title_ru'].'
                                                                        <?php }?>
                                                                    </li>';                                                                       
                                                                    }
                                                    // check title_en
                                                    $title_en = '';
                                                    if ($pages['title_en'] != '') {
                                                         $title_en =  '<li title="Заголовок EN" data-toggle="tooltip" data-placement="top">
                                                                            <?php
                                                                            if ($filename != "none" && file_exists("layouts/admin/pages/".$filename.".php")) {?>
                                                                            <?php } else {?>
                                                                            <i class="zmdi zmdi-"></i>'.$pages['title_en'].'
                                                                            <?php }?>
                                                                        </li>';                
                                                                        }
                                                    $descr_ru = mb_substr($pages['descr_ru'], 0, 255).'...';
                                                    $descr_en = mb_substr($pages['descr_en'], 0, 255).'...';
                                                    $status = $pages['status'];
                                                    $sort = $pages['sort'];
                                                    ?>
                                                    <tr id="sort_list_<?=$id?>" class="sortable" data-table="pages">
                                                        <td><?= $id?></td>
                                                        <td>
                                                            <ul class="icon-list">
                                                                <?=$title_ru?>
                                                                <?=$title_en?>
                                                                <li class="text-muted"><?=$filename?></li>
                                                            </ul>
                                                        </td>
                                                        <td>
                                                           <ul class="icon-list">
                                                                <?php
                                                                // check data
                                                                if ($descr_ru != '' || $descr_en != '') {
                                                                ?>
                                                                <li><button type="button" class="btn btn-light" data-placement="top" data-toggle="popover" data-trigger="click" data-html="true" title="Описание RU" data-content="<?=$descr_ru?>">Описание RU</button></li>
                                                                <li><button type="button" class="btn btn-light" data-placement="top" data-toggle="popover" data-trigger="click" data-html="true" title="Описание EN" data-content="<?=$descr_en?>">Описание EN</button></li>
                                                                <?php }?>
                                                            </ul>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            // status not active
                                                            if($status == '1') {
                                                                echo 'Active';
                                                            } 
                                                            // status archive (2)
                                                            else {
                                                                echo 'Inactive';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <!-- admin actions -->
                                                            <a href="/admin/pages/edit_page?id=<?=$id?>" class="btn btn-light btn--raised" data-toggle="tooltip" data-placement="top" title="Редактировать"><i class="zmdi zmdi-edit"></i></a>
                                                            <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="archiveData" data-table="pages" data-id="<?=$id?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Архив"><i class="zmdi zmdi-archive"></i></a>
                                                            <a href="#" class="btn btn-danger btn--raised ajax-action-confirm" data-cmd="deleteDataAdmin " data-table="pages" data-id="<?=$id?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Удалить"><i class="zmdi zmdi-delete"></i></a>
                                                        </td>
                                                        <td>
                                                            <span class="btn btn-light btn--raised handle">
                                                                <span class="result-sort"><i class="zmdi zmdi-swap-vertical"></i></span>
                                                                <?= $sort?>
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
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                    <th class="actions_admin">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // get data
                                                foreach($cnt->selectDataAdmin("pages","WHERE `status`='2'", "all") as $pages) {
                                                    $id = $pages['id'];
                                                    $filename = $pages['filename'];
                                                    $icon = $pages['icon'];
                                                    // check title_ru
                                                    $title_ru = '';
                                                    if ($pages['title_ru'] != '') {
                                                         $title_ru = '<li title="Заголовок RU" data-toggle="tooltip" data-placement="top">
                                                                        <?php
                                                                        if ($filename != "none" && file_exists("layouts/admin/pages/".$filename.".php")) {?>
                                                                        <?php } else {?>
                                                                        <i class="zmdi zmdi-'.$pages['icon'].'"></i>'.$pages['title_ru'].'
                                                                        <?php }?>
                                                                    </li>';                                                                       
                                                                    }
                                                    // check title_en
                                                    $title_en = '';
                                                    if ($pages['title_en'] != '') {
                                                         $title_en =  '<li title="Заголовок EN" data-toggle="tooltip" data-placement="top">
                                                                            <?php
                                                                            if ($filename != "none" && file_exists("layouts/admin/pages/".$filename.".php")) {?>
                                                                            <?php } else {?>
                                                                            <i class="zmdi zmdi-"></i>'.$pages['title_en'].'
                                                                            <?php }?>
                                                                        </li>';                
                                                                        }
                                                    $descr_ru = mb_substr($pages['descr_ru'], 0, 255).'...';
                                                    $descr_en = mb_substr($pages['descr_ru'], 0, 255).'...';
                                                    $status = $pages['status'];
                                                    $sort = $pages['sort'];
                                                    ?>
                                                    <tr id="sort_list_<?=$id?>" class="sortable" data-table="pages">
                                                        <td><?= $id?></td>
                                                        <td>
                                                            <ul class="icon-list">
                                                                <?=$title_ru?>
                                                                <?=$title_en?>
                                                                <li class="text-muted"><?=$filename?></li>
                                                            </ul>
                                                        </td>
                                                        <td>
                                                           <ul class="icon-list">
                                                                <?php
                                                                // check data
                                                                if ($descr_ru != '' || $descr_en != '') {
                                                                ?>
                                                                <li><button type="button" class="btn btn-light" data-placement="top" data-toggle="popover" data-trigger="click" data-html="true" title="Описание RU" data-content="<?=$descr_ru?>">Описание RU</button></li>
                                                                <li><button type="button" class="btn btn-light" data-placement="top" data-toggle="popover" data-trigger="click" data-html="true" title="Описание EN" data-content="<?=$descr_en?>">Описание EN</button></li>
                                                                <?php }?>
                                                            </ul>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            // status not active
                                                            if($status == '1') {
                                                                echo 'Active';
                                                            } 
                                                            // status archive (2)
                                                            else {
                                                                echo 'Inactive';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <!-- admin actions -->
                                                            <a href="#" class="btn btn-secondary ajax-action-confirm" data-cmd="removeArchive" data-table="pages" data-id="<?=$id?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Удалить из архива"><i class="zmdi zmdi-sign-in"></i></a>
                                                            <a href="#" class="btn btn-danger ajax-action-confirm" data-cmd="deleteDataAdmin " data-table="pages" data-id="<?=$id?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Удалить"><i class="zmdi zmdi-delete"></i></a>
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
                    <!-- Footer -->
                    <?php include_once("layouts/admin/inc/footer.php");?>
                </div>
            </section>
        </main>
        <?php include_once("layouts/admin/inc/scripts.php");?>
    </body>
</html>
