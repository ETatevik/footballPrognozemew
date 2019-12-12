<?php 
// isset get id
if(!isset($_GET['id'])) {
    $id = $cnt->Admin['id'];
} else {
    $id = $_GET['id'];
}
// check admin 
$admin = $cnt->selectDataAdmin("a_admins", "WHERE `id`='$id'");
// check data
if ($admin) {
    // status switch
    $status = $admin['status'];
    if ($status == '0' || $status == '2') {
        $status_checked = '';
    }
    if ($status == '1') {
        $status_checked = 'checked';
    }
} else {
    header('location: /admin/pages/admins');
    exit;
}
$type_file = ['jpg','png','gif'];
$photo_src = 'no-photo.jpg';
$file_exists = 'new';
$photo = $cnt->selectDataAdmin("files", "WHERE `table_name`='a_admins' AND `row_id`=".$admin['id']." AND `name_used`='profile'");
   $file_type = $photo['type'];
    if(in_array($file_type,$type_file)){
        $name = $photo['name'];
        $type = $file_type;
        $path_file = $name.'.'.$type;
        if ($photo) {
            $photo_name = $photo['name'].'.'.$photo['type'];
            // check file
            if (file_exists("public/img/a_admins/small/$photo_name")) {
                $photo_src = 'a_admins/small/'.$photo_name;
                $file_exists = 'exists';
            }
        }
    }
// page
$page = $cnt->selectDataAdmin("a_menu", "WHERE `filename`='admins'");
// conf
require_once("layouts/admin/inc/conf.php");
?>
<!DOCTYPE html>
<html lang="<?=$cnt->lang?>">

<head>
    <?php include_once("layouts/admin/inc/head.php");?>
    <title>Edit <?=$admin['name']?></title>
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
                    <li class="breadcrumb-item"><a href="/admin/pages/admins"><?= $page['title']?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?=$admin['name']?></li>
                </ol>
            </nav>
            <div class="content__inner">
                <header class="content__title">
                    <h1>Edit <?=$admin['name']?></h1>
                    <small><?=$page['descr']?></small>
                </header>
                <!-- Page Contents -->
                <form data-cmd="adminDataEdit"  data-id="<?=$admin['id']?>">
                    <div class="card profile">
                        <div class="profile__img">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview" data-trigger="fileinput">
                                    <img src="/public/img/<?=$photo_src?>">
                                </div>
                                <span class="btn btn-file zmdi zmdi-camera profile__img__edit">
                                    <span class="fileinput-new"></span>
                                    <span class="fileinput-exists"></span>
                                    <input type="file" name="image[profile]" data-x-small="200" data-y-small="200" data-x-large="600" data-y-large="600" data-action-large="crop" title="200x200px / 600x600px" data-toggle="tooltip" data-placement="top">
                                </span>
                            </div>
                        </div>
                        <div class="profile__info">
                            <h5><?=$admin['name']?></h5>
                            <ul class="icon-list">
                                <li><i class="zmdi zmdi-account"></i> <?=$cnt->selectDataAdmin("a_admins_types","WHERE  `id`=".$admin['perm_type']."")['type_name']?></li>
                                <?php if($admin['phone'] != '') {?>
                                <li><i class="zmdi zmdi-phone"></i> <?=$admin['phone']?></li>
                                <?php } if ($admin['email'] != '') {?>
                                <li><i class="zmdi zmdi-email"></i> <?=$cnt->Admin['email']?></li>
                                <?php } if ($admin['address'] != '') {?>
                                <li><i class="zmdi zmdi-pin"></i> <?=$cnt->Admin['address']?></li>
                                <?php }?>
                                <li><i class="zmdi zmdi-calendar"></i> <?=date('d.m.Y H:i', strtotime($cnt->Admin['date']))?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit profile</h4>
                            <h6 class="card-subtitle">Here you can change the data.</h6>
                            <div class="actions">
                                <div class="dropdown actions__item">
                                    <i data-toggle="dropdown" class="zmdi zmdi-more-vert"></i>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="" class="dropdown-item">Refresh</a>
                                    </div>
                                </div>
                                <div class="actions__item">
                                    <i class="zmdi zmdi-plus plus_minus" data-toggle="collapse" data-target="#addCats" aria-expanded="false" aria-controls="addCats"></i>
                                </div>
                            </div>
                            <div class="collapse" id="addCats">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" value="<?=$admin['name']?>" class="form-control" placeholder="First name or full name" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" value="<?=$admin['email']?>" class="form-control" placeholder="Email address">
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="phone" value="<?=$admin['phone']?>" class="form-control" placeholder="Phone number" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" name="address" value="<?=$admin['address']?>" class="form-control" placeholder="Home address" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                </div>
                                <?php if($cnt->Admin['id'] == $admin['id']) {?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off">
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Confirm password</label>
                                            <input type="password" name="password_confirm" class="form-control" placeholder="Confirm password" autocomplete="off">
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h6>Permission</h6>
                                            <?php foreach($cnt->selectDataAdmin('a_admins_types','','all') as $adminType) {?>
                                            <div class="radio radio--inline radio-<?=$color_theme?>">
                                                <input type="radio" name="perm_type" value="<?=$adminType['id']?>" id="perm_<?=$adminType['type_name']?>" <?php if($adminType['id'] == $admin['perm_type']) {?> checked <?php }?>>
                                                <label class="radio__label " for="perm_<?=$adminType['type_name']?>"><?=$adminType['type_name']?></label>
                                            </div>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h6>Status</h6>
                                            <p>Inactive / active</p>
                                            <div class="toggle-switch toggle-switch--<?=$color_theme?>">
                                                <input type="checkbox" name="status" class="toggle-switch__checkbox" <?=$status_checked?>>
                                                <i class="toggle-switch__helper"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <button type="submit" class="btn btn-<?=$color_theme?> btn--raised">Save</button>
                                    </div>
                                    <?php if($cnt->Admin['id'] != $admin['id']) {?>
                                    <div class="col-8 text-right">
                                        <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="archiveData" data-table="a_admins" data-id="<?=$admin['id']?>" data-action="hide-btn" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Move the archive"><i class="zmdi zmdi-archive"></i> Move the archive</a>
                                        <a href="#" class="btn btn-danger ajax-action-confirm btn--raised" data-cmd="deleteDataAdmin" data-table="a_admins" data-id="<?=$admin['id']?>" data-action="hide-btn" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Delete"><i class="zmdi zmdi-delete"></i> Delete</a>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Footer -->
                <?php include_once("layouts/admin/inc/footer.php");?>
            </div>
        </section>
    </main>
    <?php include_once("layouts/admin/inc/scripts.php");?>
</body>

</html>
