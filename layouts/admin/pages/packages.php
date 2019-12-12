<?php
// conf
require_once("layouts/admin/inc/conf.php");
// page
$page =  $cnt->selectDataAdmin("a_menu", "WHERE `filename`='packages'");?>
<!DOCTYPE html>
<html lang="<?=$cnt->lang?>">

<head>
    <?php include_once("layouts/admin/inc/head.php");?>
    <title>Лиги</title>
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
                <!-- Page Contents -->
                <!--SELECT ALBUM -->
                <div class="card">
                    <div class="card-body">
                        <div class="tab-container">
                            <div class="tab-content">
                                <div class="tab-pane active fade show" id="active" role="tabpanel">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Заголовок</th>
                                                <th>Тип</th>
                                                <th>Цена</th>
                                                <th>Дни</th>
                                                <th>Дата</th>
                                                <th>Статус</th>
                                                <th class="actions_admin">Действия</th>
                                                <th>Сортировать</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                // get data
                                                foreach($cnt->selectDataAdmin("f_packages", "WHERE `status`!='2' ORDER BY `sort`", "all") as $package) {
                                                    $id = $package['id'];
                                                    // title_ru
                                                    $title_ru = '';
                                                    if($package['title_ru'] != '') {
                                                        $title_ru = '<li title="Заголовок RU" data-toggle="tooltip" data-placement="top">'.$package['title_ru'].'</li>';
                                                    }
                                                    // title_en
                                                    $title_en = '';
                                                    if($package['title_en'] != '') { 
                                                        $title_en = '<li title="Заголовок EN" data-toggle="tooltip" data-placement="top">'.$package['title_en'].'</li>';
                                                    }
                                                    // type_ru
                                                    $type_ru = '';
                                                    if($package['type_ru'] != '') {
                                                        $type_ru = '<li title="Тип RU" data-toggle="tooltip" data-placement="top">'.$package['type_ru'].'</li>';
                                                    }
                                                    // type_en
                                                    $type_en = '';
                                                    if($package['type_en'] != '') { 
                                                        $type_en = '<li title="Тип EN" data-toggle="tooltip" data-placement="top">'.$package['type_en'].'</li>';
                                                    }
                                                    $price = $package['price'];
                                                    $days = $package['days'];
                                                    //get date
                                                    $date = date('Y.m.d H:i', strtotime($package['date']));
                                                    $status = $package['status'];
                                                    $sort = $package['sort'];
                                                    ?>
                                            <tr id="sort_list_<?=$id?>" class="sortable" data-table="f_packages">
                                                <td><?=$id?></td>  
                                                <td>
                                                    <ul class="icon-list">
                                                       <?=$title_ru?>
                                                       <?=$title_en?>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="icon-list">
                                                       <?=$type_ru?>
                                                       <?=$type_en?>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="icon-list">
                                                       <li><?=$price?></li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="icon-list">
                                                       <li><?=$days?></li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="icon-list">
                                                        <li><?=$date?></li>
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
                                                    <a href="/admin/pages/edit_packages?id=<?=$id?>" class="btn btn-light btn--raised" data-toggle="tooltip" data-placement="top" title="Редактировать"><i class="zmdi zmdi-edit"></i></a>
                                                </td>
                                                <td>
                                                    <span class="btn btn-light btn--raised handle">
                                                        <span class="result-sort"><i class="zmdi zmdi-swap-vertical"></i></span>
                                                        <?=$sort?>
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
                                                <th>Заголовок</th>
                                                <th>Тип</th>
                                                <th>Цена</th>
                                                <th>Дни</th>
                                                <th>Дата</th>
                                                <th>Статус</th>
                                                <th class="actions_admin">Действия</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                // get data
                                                foreach($cnt->selectDataAdmin("f_packages", "WHERE `status`='2' ORDER BY `sort`", "all") as $package) {
                                                    $id = $package['id'];
                                                    // title_ru
                                                    $title_ru = '';
                                                    if($package['title_ru'] != '') {
                                                        $title_ru = '<li title="Заголовок RU" data-toggle="tooltip" data-placement="top">'.$package['title_ru'].'</li>';
                                                    }
                                                    // title_en
                                                    $title_en = '';
                                                    if($package['title_en'] != '') { 
                                                        $title_en = '<li title="Заголовок EN" data-toggle="tooltip" data-placement="top">'.$package['title_en'].'</li>';
                                                    }
                                                    // type_ru
                                                    $type_ru = '';
                                                    if($package['type_ru'] != '') {
                                                        $type_ru = '<li title="Тип RU" data-toggle="tooltip" data-placement="top">'.$package['type_ru'].'</li>';
                                                    }
                                                    // type_en
                                                    $type_en = '';
                                                    if($package['type_en'] != '') { 
                                                        $type_en = '<li title="Тип EN" data-toggle="tooltip" data-placement="top">'.$package['type_en'].'</li>';
                                                    }
                                                    $price = $package['price'];
                                                    $days = $package['days'];
                                                    //get date
                                                    $date = date('Y.m.d H:i', strtotime($package['date']));
                                                    $status = $package['status'];
                                                    $sort = $package['sort'];
                                                    ?>
                                            <tr id="sort_list_<?=$id?>" class="sortable" data-table="f_packages">
                                                <td><?=$id?></td>  
                                                <td>
                                                    <ul class="icon-list">
                                                       <?=$title_ru?>
                                                       <?=$title_en?>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="icon-list">
                                                       <?=$type_ru?>
                                                       <?=$type_en?>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="icon-list">
                                                       <li><?=$price?></li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="icon-list">
                                                       <li><?=$days?></li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="icon-list">
                                                        <li><?=$date?></li>
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
                                                    <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="removeArchive" data-table="f_packages" data-id="<?=$id?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Удалить из архива"><i class="zmdi zmdi-sign-in"></i></a>
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
