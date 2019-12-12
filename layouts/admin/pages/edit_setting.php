<?php 
// isset get id
if(!isset($_GET['id'])) {
    header('location: /admin/pages/settings');
    exit;
} else {
    $id = $_GET['id'];
}
// check page 
$pages = $cnt->selectDataAdmin("a_menu", "WHERE `id`=".$id."");
if(!isset($pages['id'])) {
    header('location: /admin/pages/settings');
    exit;
} else {
    // status switch
    $status = $pages['status'];
    if ($status == '0' || $status == '2') {
        $status_checked = '';
    }
    if ($status == '1') {
        $status_checked = 'checked';
    }
    
    $collapse = $pages['collapse'];
    if ($collapse == '0' || $collapse == '2') {
        $collapse_checked = '';
    }
    if ($collapse == '1') {
        $collapse_checked = 'checked';
    }
}
// conf
require_once("layouts/admin/inc/conf.php");?>
<!DOCTYPE html>
<html lang="<?=$cnt->lang?>">
<head>
    <?php include_once("layouts/admin/inc/head.php");?>
    <title>Edit <?=$pages['title']?></title>
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
                    <li class="breadcrumb-item"><a href="/admin/pages/settings">Settings</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $pages['title']?></li>
                </ol>
            </nav>
            <div class="content__inner">
                <header class="content__title">
                    <h1>Edit <?=$pages['title']?></h1>
                    <small><?=$pages['descr']?></small>
                </header>
                <!-- Page Contents -->
                <div class="card">
                    <div class="card-body">
                        <form data-cmd="updateDataAdmin" data-table="a_menu" data-id="<?=$pages['id']?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Sub item</label>
                                        <select class="select2" name="parent_id">
                                            <option value="0">None</option>
                                            <?php foreach($cnt->selectDataAdmin("a_menu","WHERE `status`='1' AND `collapse`='1' AND `parent_id`='0' ORDER BY `sort`","all") as $page) {
                                                if($page['id'] == $pages['parent_id']){
                                                    $selected = "selected";
                                                }
                                                else{
                                                    $selected = '';
                                                }
                                               ?>
                                            <option value="<?= $page['id']?>" <?= $selected?>><?= $page['title']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Filename</label>
                                        <input type="text" name="filename" class="form-control" value="<?= $pages['filename']?>" placeholder="Your Name" required>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control" value="<?= $pages['title']?>" placeholder="Your Title" required>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Icon</label>
                                        <input type="text" name="icon" class="form-control" value="<?= $pages['icon']?>" placeholder="Without zmdi">
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Decription</label>
                                        <textarea class="form-control textarea-autosize" name="descr" placeholder="Describe"><?= $pages['descr']?></textarea>
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h3 class="card-body__title">Collapse</h3>
                                        <div class="toggle-switch toggle-switch--<?=$color_theme?>">
                                            <input type="checkbox" name="collapse" class="toggle-switch__checkbox" <?=$collapse_checked?>>
                                            <i class="toggle-switch__helper"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-<?=$color_theme?> btn--raised">Save</button>
                                </div>
                                <div class="col-8 text-right">
                                    <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="archiveData" data-table="a_menu" data-id="<?=$pages['id']?>" data-action="hide-btn" data-anim="bounceOut"><i class="zmdi zmdi-archive"></i> Move the archive</a>
                                    <a href="#" class="btn btn-danger btn--raised ajax-action-confirm" data-cmd="deleteDataAdmin" data-table="a_menu" data-id="<?=$pages['id']?>" data-action="hide-btn" data-anim="bounceOut">Delete</a>
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
