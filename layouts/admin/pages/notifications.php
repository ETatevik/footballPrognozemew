<?php
// page
$page = $cnt->selectDataAdmin("a_menu", "WHERE `filename`='notifications'");
// conf
require_once("layouts/admin/inc/conf.php");?>
<!DOCTYPE html>
<html lang="<?=$cnt->lang?>">
    <head>
        <?php include_once("layouts/admin/inc/head.php");?>
        <title><?=$page['title']?></title>
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
                                        <a class="nav-link active" data-toggle="tab" href="#new" role="tab">New</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#archive" role="tab">Archive</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active fade show" id="new" role="tabpanel">
                                        <table class="table table-hover data-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Subject</th>
                                                    <th>Message</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // get data
                                                foreach($cnt->getDataUser("notifications","WHERE `status`='1'", "all") as $notifs) {
                                                    ?>
                                                    <tr>
                                                        <td><?=$notifs['id']?></td>
                                                        <td>
                                                            <a class="btn btn-light btn--raised" href="<?=decodeText($notifs['link'])?>" target="_blank"><?=$notifs['subject']?></a>
                                                        </td>
                                                        <td><?=decodeText($notifs['message'])?></td>
                                                        <td>
                                                            <ul class="icon-list">
                                                                <li><i class="zmdi zmdi-calendar"></i> <?=date('d.m.Y H:i', strtotime($notifs['date']))?></li>
                                                            </ul>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            // status not active
                                                            if($notifs['status'] == '1') {
                                                                echo 'Not seen';
                                                            } 
                                                            // status archive (2)
                                                            else {
                                                                echo 'Archive';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            // admin actions
                                                            if ($cnt->Admin['perm_type'] == 1) {?>
                                                                <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="archiveData" data-table="notifications" data-id="<?=$notifs['id']?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Archive"><i class="zmdi zmdi-archive"></i></a>
                                                                <a href="#" class="btn btn-danger ajax-action-confirm btn--raised" data-cmd="deleteDataAdmin" data-table="notifications" data-id="<?=$notifs['id']?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Delete"><i class="zmdi zmdi-delete"></i></a>
                                                            <?php } else {?>
                                                                <button class="btn btn-secondary" disabled><i class="zmdi zmdi-archive"></i></button>
                                                                <button class="btn btn-danger" disabled><i class="zmdi zmdi-delete"></i></button>
                                                            <?php }?>
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
                                                    <th>Subject</th>
                                                    <th>Message</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // get data
                                                foreach($cnt->getDataUser("notifications","WHERE `status`='2'", "all") as $notifs) {
                                                    ?>
                                                    <tr>
                                                        <td><?=$notifs['id']?></td>
                                                        <td>
                                                            <a class="btn btn-light btn--raised" href="<?=decodeText($notifs['link'])?>" target="_blank"><?=$notifs['subject']?></a>
                                                        </td>
                                                        <td><?=decodeText($notifs['message'])?></td>
                                                        <td>
                                                            <ul class="icon-list">
                                                                <li><i class="zmdi zmdi-calendar"></i> <?=date('d.m.Y H:i', strtotime($notifs['date']))?></li>
                                                            </ul>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            // status not active
                                                            if($notifs['status'] == '1') {
                                                                echo 'Not seen';
                                                            } 
                                                            // status archive (2)
                                                            else {
                                                                echo 'Archive';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            // admin actions
                                                            if ($cnt->Admin['perm_type'] == 1) {?>
                                                                <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="removeArchive" data-table="notifications" data-id="<?=$notifs['id']?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Remove from archive"><i class="zmdi zmdi-sign-in"></i></a>
                                                                <a href="#" class="btn btn-danger ajax-action-confirm btn--raised" data-cmd="deleteDataAdmin" data-table="notifications" data-id="<?=$notifs['id']?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Delete"><i class="zmdi zmdi-delete"></i></a>           
                                                            <?php } else {?>
                                                                <button class="btn btn-secondary" disabled><i class="zmdi zmdi-archive"></i></button>
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