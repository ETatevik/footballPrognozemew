<?php
// conf
require_once("layouts/admin/inc/conf.php");?>
<!DOCTYPE html>
<html lang="<?=$cnt->lang?>">
    <head>
        <?php include_once("layouts/admin/inc/head.php");?>
        <title>Log</title>
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
                        <h1>Log</h1>
                        <small>Log from admins</small>
                    </header>
                    <!-- Page Contents -->
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Admin id</th>
                                        <th>Table name</th>
                                        <th>Row id</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // get data
                                    foreach($cnt->selectDataAdmin("log_actions","", "all") as $log) {
                                        $id = $log['id'];
                                        $admin_id = $log['admin_id'];
                                        $show_admin_id = $cnt->selectDataAdmin('a_admins',"WHERE `id`='$admin_id'")['name'];
                                        $table = $log['table_name'];
                                        $row_id = $log['row_id'];
                                        $action = $log['action'];
                                        $color = $log['color'];
                                    ?>
                                    <tr>
                                        <td><?=$id?></td>
                                        <td>
                                            <a class="btn btn-light btn--raised" href="/admin/pages/view_profile?id=<?=$admin_id?>" target="_blank"><?=$show_admin_id?></a>
                                        </td>
                                        <td><?=$table?></td>
                                        <td><?=$row_id?></td>
                                        <td><span style="color:<?=$color?>"><?=$action?></span></td>
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