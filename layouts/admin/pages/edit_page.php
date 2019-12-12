<?php 
// isset get id
if(!isset($_GET['id'])) {
    header('location: /admin/pages/pages');
    exit;
} else {
    $id = $_GET['id'];
}
// get page data 
$page = $cnt->selectDataAdmin("pages", "WHERE `id`=".$id."");
// check page
if(!isset($page['id'])) {
    header('location: /admin/pages/pages');
    exit;
} else {
    // status switch
    $status = $page['status'];
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
        <title>Edit <?= $page['title_ru']?></title>  
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
                      <li class="breadcrumb-item"><a href="/admin/pages/pages">Pages</a></li>
                      <li class="breadcrumb-item active" aria-current="page"><?= $page['title_ru']?></li>
                    </ol>
                </nav>
                <div class="content__inner">
                    <header class="content__title">
                        <h1>Edit <?= $page['title_ru']?></h1>
                        <small>File path - layout / default / pages</small>
                    </header>
                    <!-- Page Contents -->
                    <div class="card">
                        <div class="card-body">
                            <form data-cmd="updateDataAdmin" data-id="<?=$page['id']?>" data-table="pages">
                            <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Filename</label>
                                            <input type="text" name="filename" class="form-control" value="<?= $page['filename']?>" placeholder="Name of .php file" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Заголовок RU</label>
                                            <input type="text" name="title_ru" class="form-control" value="<?= $page['title_ru']?>" placeholder="Title" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                        <div class="form-group">
                                            <label>Заголовок EN</label>
                                            <input type="text" name="title_en" class="form-control" value="<?= $page['title_en']?>" placeholder="Title" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Icon</label>
                                                <input type="text" name="icon" class="form-control" value="<?= $page['icon']?>" placeholder="Class name of icon">
                                                <i class="form-group__bar"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Описание RU</label>
                                                <textarea class="form-control html-editor" name="descr_ru" placeholder="Describe page"><?= $page['descr_ru']?></textarea>
                                                <i class="form-group__bar"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Описание EN</label>
                                                <textarea class="form-control html-editor" name="descr_en" placeholder="Describe page"><?= $page['descr_en']?></textarea>
                                                <i class="form-group__bar"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h6>Status</h6>
                                                <p>Inactive / active</p>
                                                <div class="toggle-switch toggle-switch--<?=$color_theme?>">
                                                    <input type="checkbox" name="status" class="toggle-switch__checkbox" <?=$status_checked?>>
                                                    <i class="toggle-switch__helper"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <button type="submit" class="btn btn-<?=$color_theme?> btn--raised">Save</button>
                                        </div>
                                        <div class="col-8 text-right">                                        
                                            <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="archiveData" data-table="pages" data-id="<?=$page['id']?>" data-action="hide-btn" data-anim="bounceOut"><i class="zmdi zmdi-archive"></i> Move the archive</a>
                                            <a href="#" class="btn btn-danger btn--raised ajax-action-confirm" data-cmd="deleteDataAdmin " data-table="pages" data-id="<?=$page['id']?>" data-action="hide-btn" data-anim="bounceOut">Delete</a>
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