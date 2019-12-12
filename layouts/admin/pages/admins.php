<?php
// page
$page = $cnt->selectDataAdmin("a_menu", "WHERE `filename`='admins'");
// conf
require_once("layouts/admin/inc/conf.php");?>
<!DOCTYPE html>
<html lang="<?=$cnt->lang?>">
    <head>
        <?php include_once("layouts/admin/inc/head.php");?>
        <title>Admins</title>
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
                            <div class="tab-container">
                                <ul class="nav nav-tabs nav-fill nav-tabs--black" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#active" role="tab">Active</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#archive" role="tab">Archive</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active fade show" id="active" role="tabpanel">
                                        <table class="table table-hover data-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Contacts</th>
                                                    <th>Photo</th>
                                                    <th>Permission</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // get data
                                                foreach($cnt->selectDataAdmin("a_admins","WHERE `status`!='2'", "all") as $admins) {
                                                    $id = $admins['id'];
                                                    $admin_id = $admins['id'];
                                                    // name
                                                    $admin_name = '';
                                                    if ($admins['name'] != '') {
                                                        $admin_name = '<li><i class="zmdi zmdi-account"></i> '.$admins['name'].'</li>';
                                                    }
                                                    // email
                                                    $admin_email = '';
                                                    if ($admins['email'] != '') {
                                                        $admin_email = '<li><i class="zmdi zmdi-email"></i> '.$admins['email'].'</li>';
                                                    }
                                                    // phone
                                                    $admin_phone = '';
                                                    if ($admins['phone'] != '') {
                                                        $admin_phone = '<li><i class="zmdi zmdi-phone"></i> '.$admins['phone'].'</li>';
                                                    }
                                                    // address
                                                    $admin_address = '';
                                                    if ($admins['address'] != '') {
                                                        $admin_address = '<li><i class="zmdi zmdi-pin"></i> '.$admins['address'].'</li>';
                                                    }
                                                    // status inactive
                                                    if($admins['status'] == '0') {
                                                        $admin_status = 'Inactive';
                                                    } 
                                                    // status active
                                                    else if($admins['status'] == '1') {
                                                        $admin_status = 'Active';
                                                    } 
                                                    // status archive (2)
                                                    else if ($admins['status'] == '2') {
                                                        $admin_status = 'Archive';
                                                    }
                                                    // error
                                                    else {
                                                        $admin_status = 'Error';
                                                    }
                                                    // permission
                                                    $admin_perm_type = $admins['perm_type'];
                                                    $admin_perm = $cnt->selectDataAdmin("a_admins_types","WHERE `id`=".$admin_perm_type."")['type_name'];
                                                    // date
                                                    $admin_reg_date = date('d.m.Y H:i', strtotime($admins['date']));
                                                    // photo
                                                    $admin_profile_src = 'no-photo.jpg';
                                                    $row_admin_profile = $cnt->selectDataAdmin("files", "WHERE `table_name`='a_admins' AND `row_id`='$id' AND `name_used`='profile'");
                                                    // check image
                                                    if ($row_admin_profile) {
                                                        $image_link = $row_admin_profile['name'].'.'.$row_admin_profile['type'];
                                                        // check file
                                                        if (file_exists("public/img/a_admins/small/$image_link")) {
                                                            $admin_profile_src = 'a_admins/small/'.$image_link;
                                                        }
                                                    }
                                                    $admin_profile_show = '<li title="Profile" data-toggle="tooltip" data-placement="top"><img src="/public/img/'.$admin_profile_src.'" width="90px"></li>';
                                                ?>
                                                <tr>
                                                    <td><?=$admin_id?></td>
                                                    <td>
                                                        <ul class="icon-list">
                                                            <?=$admin_name?>
                                                            <?=$admin_email?>
                                                            <?=$admin_phone?>
                                                            <?=$admin_address?>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <ul class="icon-list">
                                                            <?= $admin_profile_show?>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <span class="badge btn btn-outline-secondary"><?=$admin_perm?></span>
                                                    </td>
                                                    <td>
                                                        <ul class="icon-list">
                                                            <li><i class="zmdi zmdi-calendar"></i> <?=$admin_reg_date?></li>
                                                        </ul>
                                                    </td>
                                                    <td><?=$admin_status?></td>
                                                    <td>
                                                        <?php
                                                        // Admin actions
                                                        if ($cnt->Admin['id'] != $admin_id && $cnt->Admin['perm_type'] == 1) {
                                                        ?>
                                                        <a href="/admin/pages/view_profile?id=<?=$id?>" class="btn btn-light btn--raised" data-toggle="tooltip" data-placement="top" title="Edit"><i class="zmdi zmdi-edit"></i></a>
                                                        <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="archiveData" data-table="a_admins" data-id="<?=$id?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Archive"><i class="zmdi zmdi-archive"></i></a>
                                                        <a href="#" class="btn btn-danger ajax-action-confirm btn--raised" data-cmd="deleteDataAdmin" data-table="a_admins" data-id="<?=$id?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Delete"><i class="zmdi zmdi-delete"></i></a>
                                                        <?php
                                                        // only edit self data
                                                        } else {?>
                                                            <?php
                                                            if ($cnt->Admin['id'] == $admin_id) { ?>
                                                                <a href="/admin/pages/view_profile?id=<?=$admin_id?>" class="btn btn-light btn--raised"><i class="zmdi zmdi-edit"></i></a>
                                                            <?php } else {?>
                                                                <button class="btn btn-light btn--raised" disabled><i class="zmdi zmdi-edit"></i></button>
                                                            <?php }?>
                                                            <button class="btn btn-secondary" disabled><i class="zmdi zmdi-archive"></i></button>
                                                            <button class="btn btn-danger" disabled><i class="zmdi zmdi-delete"></i></button>
                                                        <?php }?>
                                                    </td>
                                                </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="archive" role="tabpanel">
                                        <table class="table table-hover data-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Contacts</th>
                                                    <th>Photo</th>
                                                    <th>Permission</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // get data
                                                foreach($cnt->selectDataAdmin("a_admins","WHERE `status`='2'", "all") as $admins) {
                                                    $id = $admins['id'];
                                                    $admin_id = $admins['id'];
                                                    // name
                                                    $admin_name = '';
                                                    if ($admins['name'] != '') {
                                                        $admin_name = '<li><i class="zmdi zmdi-account"></i> '.$admins['name'].'</li>';
                                                    }
                                                    // email
                                                    $admin_email = '';
                                                    if ($admins['email'] != '') {
                                                        $admin_email = '<li><i class="zmdi zmdi-email"></i> '.$admins['email'].'</li>';
                                                    }
                                                    // phone
                                                    $admin_phone = '';
                                                    if ($admins['phone'] != '') {
                                                        $admin_phone = '<li><i class="zmdi zmdi-phone"></i> '.$admins['phone'].'</li>';
                                                    }
                                                    // address
                                                    $admin_address = '';
                                                    if ($admins['address'] != '') {
                                                        $admin_address = '<li><i class="zmdi zmdi-pin"></i> '.$admins['address'].'</li>';
                                                    }
                                                    // status inactive
                                                    if($admins['status'] == '0') {
                                                        $admin_status = 'Inactive';
                                                    } 
                                                    // status active
                                                    else if($admins['status'] == '1') {
                                                        $admin_status = 'Active';
                                                    } 
                                                    // status archive (2)
                                                    else if ($admins['status'] == '2') {
                                                        $admin_status = 'Archive';
                                                    }
                                                    // error
                                                    else {
                                                        $admin_status = 'Error';
                                                    }
                                                    // permission
                                                    $admin_perm_type = $admins['perm_type'];
                                                    $admin_perm = $cnt->selectDataAdmin("a_admins_types","WHERE `id`=".$admin_perm_type."")['type_name'];
                                                    // date
                                                    $admin_reg_date = date('d.m.Y H:i', strtotime($admins['date']));
                                                    // photo
                                                    $admin_profile_src = 'no-photo.jpg';
                                                    $row_admin_profile = $cnt->selectDataAdmin("files", "WHERE `table_name`='a_admins' AND `row_id`='$id' AND `name_used`='profile'");
                                                    // check image
                                                    if ($row_admin_profile) {
                                                        $image_link = $row_admin_profile['name'].'.'.$row_admin_profile['type'];
                                                        // check file
                                                        if (file_exists("public/img/a_admins/small/$image_link")) {
                                                            $admin_profile_src = 'a_admins/small/'.$image_link;
                                                        }
                                                    }
                                                    $admin_profile_show = '<li title="Profile" data-toggle="tooltip" data-placement="top"><img src="/public/img/'.$admin_profile_src.'" width="90px"></li>';
                                                ?>
                                                <tr>
                                                    <td><?=$admin_id?></td>
                                                    <td>
                                                        <ul class="icon-list">
                                                            <?=$admin_name?>
                                                            <?=$admin_email?>
                                                            <?=$admin_phone?>
                                                            <?=$admin_address?>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <ul class="icon-list">
                                                            <?= $admin_profile_show?>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <span class="badge btn btn-outline-secondary"><?=$admin_perm?></span>
                                                    </td>
                                                    <td>
                                                        <ul class="icon-list">
                                                            <li><i class="zmdi zmdi-calendar"></i> <?=$admin_reg_date?></li>
                                                        </ul>
                                                    </td>
                                                    <td><?=$admin_status?></td>
                                                    <td>
                                                        <?php
                                                        // Admin actions
                                                        if ($cnt->Admin['id'] != $admin_id && $cnt->Admin['perm_type'] == 1) {
                                                        ?>
                                                        <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="removeArchive" data-table="a_admins" data-id="<?=$id?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Remove from archive"><i class="zmdi zmdi-sign-in"></i></a>
                                                        <a href="#" class="btn btn-danger ajax-action-confirm btn--raised" data-cmd="deleteDataAdmin" data-table="a_admins" data-id="<?=$id?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Delete"><i class="zmdi zmdi-delete"></i></a>
                                                        <?php
                                                        // only edit self data
                                                        } else {?>
                                                            <button class="btn btn-secondary" disabled><i class="zmdi zmdi-sign-in"></i></button>
                                                            <button class="btn btn-danger" disabled><i class="zmdi zmdi-delete"></i></button>
                                                        <?php }?>
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