<?php 
// isset get id
if(!isset($_GET['id'])) {
    header('location: /admin/pages/slider');
    exit;
} else {
    $id = $_GET['id'];
}
// get page data 
$slider = $cnt->selectDataAdmin("f_slider", "WHERE `id`=".$id."");
// check page
if(!isset($slider['id'])) {
    header('location: /admin/pages/slider');
    exit;
} else {
    // status switch
    $status = $slider['status'];
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
    <title>Редактировать <?= $slider['title_ru']?></title>
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
                    <li class="breadcrumb-item"><a href="/admin/pages/slider">Слайдер</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $slider['title_ru']?></li>
                </ol>
            </nav>
            <div class="content__inner">
                <header class="content__title">
                    <h1>Редактировать <?= $slider['title_ru']?></h1>
                    <small>Слайдер</small>
                </header>
                <!-- Page Contents -->
                <div class="card">
                    <div class="card-body">
                        <form data-cmd="updateDataAdmin" data-id="<?=$slider['id']?>" data-table="f_slider">
                            <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Заголовок RU</label>
                                        <input type="text" name="title_ru" class="form-control" value="<?=$slider['title_ru']?>" placeholder="Заголовок RU" required>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Заголовок EN</label>
                                        <input type="text" name="title_en" class="form-control" value="<?=$slider['title_en']?>" placeholder="Заголовок EN" required>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Описание RU</label>
                                        <textarea type="text" name="descr_ru" class="form-control" placeholder="Описание RU" required><?=$slider['descr_ru']?></textarea>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Описание EN</label>
                                        <textarea type="text" name="descr_en" class="form-control" placeholder="Описание RU" required><?=$slider['descr_en']?></textarea>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Ссылка</label>
                                        <input type="text" name="link" class="form-control" value="<?=$slider['link']?>" placeholder="Ссылка" required>
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
                                <div class="col-8 text-right">
                                    <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="archiveData" data-table="f_slider" data-id="<?=$slider['id']?>" data-action="hide-btn" data-anim="bounceOut"><i class="zmdi zmdi-archive"></i>Переместить архив</a>
                                    <a href="#" class="btn btn-danger btn--raised ajax-action-confirm" data-cmd="deleteDataAdmin " data-table="f_slider" data-id="<?=$slider['id']?>" data-action="hide-btn" data-anim="bounceOut">Удалить</a>
                                </div>
                            </div>
                        </form>
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
