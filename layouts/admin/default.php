<?php
// conf
require_once("layouts/admin/inc/conf.php");?>
<!DOCTYPE html>
<html lang="<?=$cnt->lang?>">
<head>
    <title>Core Admin</title>
    <?php include_once("inc/head.php");?>
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
        <?php include_once("inc/header.php");?>
        <!-- Sidebar -->
        <?php include_once("inc/aside.php");?>
        <!-- Contents -->
        <section class="content">
            <div class="content__inner">
                <header class="content__title">
                    <h1>Home</h1>
                    <small>Важный панель данные</small>
                </header>
                <div class="row quick-stats">
                    <div class="col-sm-6 col-md-3">
                        <div class="quick-stats__item bg-blue">
                            <div class="quick-stats__info">
                                <?php $admin_count = count($cnt->getDataUser("a_admins","", "all"))?>
                                <h2><?=$admin_count?></h2>
                                <small>Администраторы</small>
                            </div>
                            <div class="quick-stats__chart sparkline-bar-stats">6,4,8,6,5,6,7,8,3,5,9,5</div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="quick-stats__item bg-amber">
                            <div class="quick-stats__info">
                                <?php $user_count = count($cnt->getDataUser("u_users","", "all"))?>
                                <h2><?=$user_count?></h2>
                                <small>Пользователи</small>
                            </div>
                            <div class="quick-stats__chart sparkline-bar-stats">6,4,8,6,5,6,7,8,3,5,9,5</div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="quick-stats__item bg-purple">
                            <div class="quick-stats__info">
                                <?php $album_count = count($cnt->getDataUser("albums","", "all"))?>
                                <h2><?=$album_count?></h2>
                                <small>Альбомы</small>
                            </div>
                            <div class="quick-stats__chart sparkline-bar-stats">6,4,8,6,5,6,7,8,3,5,9,5</div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="quick-stats__item bg-red">
                            <div class="quick-stats__info">
                                <?php $gallery_count = count($cnt->getDataUser("files","WHERE `table_name`='gallery' ", "all"))?>
                                <h2><?=$gallery_count?></h2>
                                <small>Галерея</small>
                            </div>
                            <div class="quick-stats__chart sparkline-bar-stats">6,4,8,6,5,6,7,8,3,5,9,5</div>
                        </div>
                    </div>
                </div>
                <!-- Page Contents -->

                <!-- Footer -->
                <?php include_once("inc/footer.php");?>
            </div>
        </section>
    </main>
    <?php include_once("inc/scripts.php");?>
</body>
</html>
