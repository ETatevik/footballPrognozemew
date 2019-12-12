<?php 
// isset get id
if(!isset($_GET['id'])) {
    header('location: /admin/pages/settings');
    exit;
} else {
    $id = $_GET['id'];
}
// check data 
$colors = $cnt->selectDataAdmin("a_colors", "WHERE `id`=".$id."");
if(!isset($colors['id'])) {
    header('location: /admin/pages/settings');
    exit;
} else {
    // status switch
    $status = $colors['status'];
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
    <title>Edit <?=$colors['color']?></title>
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
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/pages/settings">Settings</a></li>
                        <?php $colors = $cnt->selectDataAdmin("a_colors","WHERE `id`=".$id." ", 1);?>
                        <li class="breadcrumb-item active" aria-current="page"><span style="width:38px;display:-webkit-inline-box;height:10px" class="bg-<?= $colors['color']?>"> </span></li>
                    </ol>
                </nav>
                <div class="content__inner">
                    <header class="content__title">
                        <h1>Edit <?=$colors['color']?></h1>
                        <small>Theme color.</small>
                    </header>
                    <!-- Page Contents -->
                    <div class="card">
                        <div class="card-body">
                            <form data-cmd="updateDataAdmin" data-table="a_colors" data-id="<?=$colors['id']?>">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Color</label>
                                            <input type="text" name="color" class="form-control" placeholder="Color" value="<?= $colors['color']?>" required disabled>
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
                                        <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="archiveData" data-table="a_colors" data-id="<?=$colors['id']?>" data-action="hide-btn" data-anim="bounceOut"><i class="zmdi zmdi-archive"></i> Move the archive</a>
                                        <a href="#" class="btn btn-danger btn--raised ajax-action-confirm" data-cmd="deleteDataAdmin" data-table="a_colors" data-id="<?=$colors['id']?>" data-action="hide-btn" data-anim="bounceOut">Delete</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Footer -->
                    <?php include_once("layouts/admin/inc/footer.php");?>
                </div>
            </div>
        </section>
    </main>
    <?php include_once("layouts/admin/inc/scripts.php");?>
</body>

</html>
