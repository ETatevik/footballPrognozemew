<?php
// conf
require_once("layouts/admin/inc/conf.php");
// page
$page =  $cnt->selectDataAdmin("a_menu", "WHERE `filename`='slider'");?>
<!DOCTYPE html>
<html lang="<?=$cnt->lang?>">

<head>
    <?php include_once("layouts/admin/inc/head.php");?>
    <title>Слайдер</title>
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
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Добавить слайдер</h4>
                        <h6 class="card-subtitle">слайдер</h6>
                        <div class="actions">
                            <div class="dropdown actions__item">
                                <i data-toggle="dropdown" class="zmdi zmdi-more-vert"></i>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="" class="dropdown-item">Обновить</a>
                                </div>
                            </div>
                            <div class="actions__item">
                                <i class="zmdi zmdi-plus plus_minus" data-toggle="collapse" data-target="#pages" aria-expanded="false" aria-controls="pages"></i>
                            </div>
                        </div>
                        <div class="collapse" id="pages">
                            <form data-cmd="insertDataAdmin" data-table="f_slider">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Заголовок RU</label>
                                            <input type="text" name="title_ru" class="form-control" placeholder="Заголовок RU" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Заголовок EN</label>
                                            <input type="text" name="title_en" class="form-control" placeholder="Заголовок EN" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Описание RU</label>
                                            <textarea type="text" name="descr_ru" class="form-control html-editor" placeholder="Описание RU" required></textarea>
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Описание EN</label>
                                            <textarea type="text" name="descr_en" class="form-control html-editor" placeholder="Описание EN" required></textarea>
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Ссылка</label>
                                            <input type="text" name="link" class="form-control" placeholder="Ссылка" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h6>Изображение</h6>
                                            <p>1207x496px</p>
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-preview" data-trigger="fileinput"></div>
                                                <a href="#" class="btn btn-danger btn--raised fileinput-exists" data-dismiss="fileinput">Удалить</a>
                                                <span class="btn btn-file btn-<?=$color_theme?> btn--raised">
                                                    <span class="fileinput-new">Выбрать</span>
                                                    <span class="fileinput-exists">Редактировать</span>
                                                    <input type="file" name="image[slide]" data-x-large="1207" data-y-large="496" data-action-large="crop" accept="image/jpeg">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h6>Статус</h6>
                                            <p>Неактивный / активный</p>
                                            <div class="toggle-switch toggle-switch--<?=$color_theme?>">
                                                <input type="checkbox" name="status" class="toggle-switch__checkbox">
                                                <i class="toggle-switch__helper"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-<?=$color_theme?> btn--raised" type="submit">Добавить</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Заголовок</th>
                                                <th>Описание</th>
                                                <th>Ссылка</th>
                                                <th>Изображение</th>
                                                <th>Дата</th>
                                                <th>Статус</th>
                                                <th class="actions_admin">Действия</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                // get data
                                                foreach($cnt->selectDataAdmin("f_slider", "WHERE `status`!='2' ORDER BY `sort`", "all") as $slider) {
                                                    $id = $slider['id'];
                                                    // title_ru
                                                    $title_ru = '';
                                                    if($slider['title_ru'] != '') {
                                                        $title_ru = '<li title="Заголовок RU" data-toggle="tooltip" data-placement="top">'.$slider['title_ru'].'</li>';
                                                    }
                                                    // title_en
                                                    $title_en = '';
                                                    if($slider['title_en'] != '') { 
                                                        $title_en = '<li title="Заголовок EN" data-toggle="tooltip" data-placement="top">'.$slider['title_en'].'</li>';
                                                    }
                                                    // get descr_ru
                                                    $descr_ru = mb_substr($slider['descr_ru'], 0, 255).'...';
                                                    // get descr_ru
                                                    $descr_en = mb_substr($slider['descr_en'], 0, 255).'...';
                                                    // get link
                                                    $link = $slider['link'];
                                                    // get image 
													$image_lg_src = 'no_photo.jpg';
                                                    $row_image = $cnt->selectDataAdmin("files", "WHERE `table_name`='f_slider' AND `row_id`='$id' AND `name_used`='slide'");
													// check image
													if ($row_image) {
														$image_link = $row_image['name'].'.'.$row_image['type'];
														// check file
														if (file_exists("public/img/f_slider/large/$image_link")) {
															$image_lg_src = 'f_slider/large/'.$image_link;
														}
													}
													$image_show = '<li title="Слайдер изображение" data-toggle="tooltip" data-placement="top"><img src="/public/img/'.$image_lg_src.'" width="90px"></li>';
                                                    // get date
                                                    $date = date('Y.m.d H:i', strtotime($slider['date']));
                                                    $status = $slider['status'];
                                                    $sort = $slider['sort'];
                                                    ?>
                                            <tr id="sort_list_<?=$id?>" class="sortable" data-table="f_slider">
                                                <td><?=$id?></td>  
                                                <td>
                                                    <ul class="icon-list">
                                                       <?=$title_ru?>
                                                       <?=$title_en?>
                                                    </ul>
                                                </td>
                                                 <td>
                                                   <ul class="icon-list">
                                                        <?php
                                                            // check data
                                                            if ($descr_ru != '' || $descr_en != '') {
                                                            ?>
                                                                <li><button type="button" class="btn btn-light mb-2" data-placement="top" data-toggle="popover" data-trigger="hover" data-html="true" title="Описание RU" data-content="<?=$descr_ru?>">Описание RU</button></li>
                                                                <li><button type="button" class="btn btn-light" data-placement="top" data-toggle="popover" data-trigger="hover" data-html="true" title="Описание EN" data-content="<?=$descr_en?>">Описание EN</button></li>
                                                        <?php }?>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <a href="<?=$link?>" target="_blank"><li class="btn btn-light btn--raised"><i class="zmdi zmdi-link"></i></li></a>
                                                </td>
                                                <td>
                                                    <ul class="icon-list">
                                                        <?=$image_show?>
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
                                                    <a href="/admin/pages/edit_slider?id=<?=$id?>" class="btn btn-light btn--raised" data-toggle="tooltip" data-placement="top" title="Редактировать"><i class="zmdi zmdi-edit"></i></a>
                                                    <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="archiveData" data-table="f_slider" data-id="<?=$id?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Архив"><i class="zmdi zmdi-archive"></i></a>
                                                    <a href="#" class="btn btn-danger btn--raised ajax-action-confirm" data-cmd="deleteDataAdmin " data-table="f_slider" data-id="<?=$id?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Удалить"><i class="zmdi zmdi-delete"></i></a>
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
                                                <th>Описание</th>
                                                <th>Ссылка</th>
                                                <th>Дата</th>
                                                <th>Статус</th>
                                                <th class="actions_admin">Действия</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                // get data
                                                foreach($cnt->selectDataAdmin("f_slider", "WHERE `status`='2' ORDER BY `sort`", "all") as $slider) {
                                                    $id = $slider['id'];
                                                    // title_ru
                                                    $title_ru = '';
                                                    if($slider['title_ru'] != '') {
                                                        $title_ru = '<li title="Заголовок RU" data-toggle="tooltip" data-placement="top">'.$slider['title_ru'].'</li>';
                                                    }
                                                    // title_en
                                                    $title_en = '';
                                                    if($slider['title_en'] != '') { 
                                                        $title_en = '<li title="Заголовок EN" data-toggle="tooltip" data-placement="top">'.$slider['title_en'].'</li>';
                                                    }
                                                    // get descr_ru
                                                    $descr_ru = mb_substr($slider['descr_ru'], 0, 255).'...';
                                                    // get descr_ru
                                                    $descr_en = mb_substr($slider['descr_en'], 0, 255).'...';
                                                    // get link
                                                    $link = $slider['link'];
                                                    // get date
                                                    $date = date('Y.m.d H:i', strtotime($slider['date']));
                                                    $status = $slider['status'];
                                                    ?>
                                            <tr id="sort_list_<?=$id?>" class="sortable" data-table="f_slider">
                                                <td><?=$id?></td>  
                                                <td>
                                                    <ul class="icon-list">
                                                       <?=$title_ru?>
                                                       <?=$title_en?>
                                                    </ul>
                                                </td>
                                                  <td>
                                                       <ul class="icon-list">
                                                            <?php
                                                                // check data
                                                                if ($descr_ru != '' || $descr_en != '') {
                                                                ?>
                                                                    <li>
                                                                        <button type="button" class="btn btn-light mb-2" data-placement="top" data-toggle="popover" data-trigger="click" data-html="true" title="Описание RU" data-content="<?=$descr_ru?>">Описание RU</button>
                                                                    </li>
                                                                    <li>
                                                                        <button type="button" class="btn btn-light" data-placement="top" data-toggle="popover" data-trigger="click" data-html="true" title="Описание EN" data-content="<?=$descr_en?>">Описание EN</button>
                                                                    </li>
                                                            <?php }?>
                                                        </ul>
                                                </td>
                                                <td>
                                                    <a href="<?=$link?>" target="_blank"><li class="btn btn-light btn--raised"><i class="zmdi zmdi-link"></i></li></a>
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
                                                    <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="removeArchive" data-table="f_slider" data-id="<?=$id?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Удалить из архива"><i class="zmdi zmdi-sign-in"></i></a>
                                                    <a href="#" class="btn btn-danger btn--raised ajax-action-confirm" data-cmd="deleteDataAdmin " data-table="f_slider" data-id="<?=$id?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Удалить"><i class="zmdi zmdi-delete"></i></a>
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
