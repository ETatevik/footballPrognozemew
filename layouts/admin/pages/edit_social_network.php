<?php 
// isset get id
if(!isset($_GET['id'])) {
    header('location: /admin/pages/social_networks');
    exit;
} else {
    $id = $_GET['id'];
}
// check admin 
$social = $cnt->selectDataAdmin("social_networks", "WHERE `id`=".$id." ", 1);
if(!isset($social['id'])) {
    header('location: /admin/pages/social_networks');
    exit;
} else {
    // status switch
    $status = $social['status'];
    if ($status == '0' || $status == '2') {
        $status_checked = '';
    }
    if ($status == '1') {
        $status_checked = 'checked';
    }
}
// page
$page =  $cnt->selectDataAdmin("a_menu", "WHERE `filename`='social_networks'");
// conf
require_once("layouts/admin/inc/conf.php");
?>
<!DOCTYPE html>
<html lang="<?=$cnt->lang?>">
    <head>
        <?php include_once("layouts/admin/inc/head.php");?>
        <title>Edit <?= $social['title']?></title>  
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
                      <li class="breadcrumb-item"><a href="/admin/pages/social_networks"><?= $page['title']?></a></li>
                      <li class="breadcrumb-item active" aria-current="page"><?= $social['title']?></li>
                    </ol>
                </nav>
                <div class="content__inner">
                    <header class="content__title">
                        <h1>Edit <?=$social['title']?></h1>
                        <small><?=$page['descr']?></small>
                    </header>
                    <!-- Page Contents -->
                    <div class="card">
                        <div class="card-body">
                            <form data-cmd="updateDataAdmin" data-table="social_networks" data-id="<?=$social['id']?>" >
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="title" value="<?=$social['title']?>"  class="form-control" placeholder="Social network name" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>  
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control textarea-autosize" name="descr" placeholder="Describe social network"><?=$social['descr']?></textarea>
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Icon</label>
                                            <input type="text" name="icon" value="<?=$social['icon']?>" class="form-control" placeholder="Class name only" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>  
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Link</label>
                                            <input type="text" name="link" value="<?=$social['link']?>"  class="form-control" placeholder="Website link">
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
                                        <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="archiveData" data-table="social_networks" data-id="<?=$social['id']?>" data-action="hide-btn" data-anim="bounceOut"><i class="zmdi zmdi-archive"></i> Move the archive</a>
                                        <a href="#" class="btn btn-danger ajax-action-confirm btn--raised" data-cmd="deleteDataAdmin" data-table="social_networks" data-id="<?=$social['id']?>" data-action="hide-btn" data-anim="bounceOut">Delete</a>
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