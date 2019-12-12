<?php 
// isset get id
if(!isset($_GET['id'])) {
    header('location: /admin/pages/packages');
    exit;
} else {
    $id = $_GET['id'];
}
// get page data 
$packages = $cnt->selectDataAdmin("f_packages", "WHERE `id`=".$id."");
// check pageОписание предложения
if(!isset($packages['id'])) {
    header('location: /admin/pages/pakcages');
    exit;
} else {
    // status switch
    $status = $packages['status'];
    if ($status == '0' || $status == '2') {
        $status_checked = '';
    }
    if ($status == '1') {
        $status_checked = 'checked';
    }
}
// conf
require_once("layouts/admin/inc/conf.php");?>
<!DOCTYPE html>
<html lang="<?=$cnt->lang?>">

<head>
    <?php include_once("layouts/admin/inc/head.php");?>
    <title>Редактировать <?= $packages['title_ru']?></title>
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
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/pages/packages">Пакеты</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $packages['title_ru']?></li>
                </ol>
            </nav>
            <div class="content__inner">
                <header class="content__title">
                    <h1>Редактировать <?= $packages['title_ru']?></h1>
                    <small>Пакеты</small>
                </header>
                <!-- Page Contents -->
                <div class="card">
                    <div class="card-body">
                        <form data-cmd="updateDataAdmin" data-id="<?=$packages['id']?>" data-table="f_packages">
                            <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Заголовок RU</label>
                                        <input type="text" name="title_ru" class="form-control" value="<?=$packages['title_ru']?>" placeholder="Заголовок RU" required>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Заголовок EN</label>
                                        <input type="text" name="title_en" class="form-control" value="<?=$packages['title_en']?>" placeholder="Заголовок EN" required>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Тип RU</label>
                                        <input type="text" name="type_ru" class="form-control" value="<?=$packages['type_ru']?>" placeholder="Тип RU" required>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Тип EN</label>
                                        <input type="text" name="type_en" class="form-control" value="<?=$packages['type_en']?>" placeholder="Тип EN" required>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Цена</label>
                                        <input type="number" name="price" class="form-control" value="<?=$packages['price']?>" placeholder="Цена" required>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Дни</label>
                                        <input type="number" name="days" class="form-control" value="<?=$packages['days']?>" placeholder="Дни" required>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h6>Статус</h6>
                                        <p>Неактивный / активный</p>
                                        <div class="toggle-switch toggle-switch--<?=$color_theme?>">
                                            <input type="checkbox" name="status" class="toggle-switch__checkbox" <?=$status_checked?>>
                                            <i class="toggle-switch__helper"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-<?=$color_theme?> btn--raised">Сохранить</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Описание предложения</h4>
                        <h6 class="card-subtitle">Сохраняйте данные отдельно.</h6>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Заголовок RU</th>
                                    <th>Заголовок EN</th>
                                    <th>Действия</th>
                                    <th>Сортировать</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // get offer types
                                $packages_option = '';
                                foreach($cnt->selectDataAdmin("f_packages_options", "", "all") as $packages_option) {
                                    $packages_option_id = $packages_option['id'];
                                    $packages_option_title_ru = $packages_option['title_ru'];
                                    $packages_option_title_en = $packages_option['title_en'];
                                    $packages_option_sort = $packages_option['sort'];
                                    ?>
                                    <tr id="sort_list_<?=$packages_option_id?>" class="sortable" data-table="f_packages_options">
                                        <form data-cmd="updateDataAdmin" data-id="<?=$packages_option_id?>" data-table="f_packages_options">
                                            <td><?=$packages_option_id?></td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" name="title_ru" placeholder="Заголовок RU" value="<?=$packages_option_title_ru?>">
                                                    <i class="form-group__bar"></i>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" name="title_en" placeholder="Заголовок EN" value="<?=$packages_option_title_en?>">
                                                    <i class="form-group__bar"></i>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-<?=$color_theme?> btn--raised" title="Сохранить" data-toggle="tooltip" data-placement="top"><i class="zmdi zmdi-mail-send"></i></button>
                                            </td>
                                            <td>
                                                <span class="btn btn-light btn--raised handle">
                                                    <span class="result-sort"><i class="zmdi zmdi-swap-vertical"></i></span>
                                                    <?=$packages_option_sort?>
                                                </span>
                                            </td>
                                        </form>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
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
