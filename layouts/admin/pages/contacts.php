<?php
// conf
require_once("layouts/admin/inc/conf.php");
// page
$page =  $cnt->selectDataAdmin("a_menu", "WHERE `filename`='contacts'");?>
<!DOCTYPE html>
<html lang="<?=$cnt->lang?>">

<head>
    <?php include_once("layouts/admin/inc/head.php");?>
    <title>Контакты</title>
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
                <!-- Get Contacts -->
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Соц. сети</th>
                                    <th>Электронная почта</th>
                                    <th>Телефон</th>
                                    <th>Адрес</th>
                                    <th class="actions_admin">Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // get data
                                foreach($cnt->selectDataAdmin("f_contacts", "ORDER BY `id`", "all") as $contacts) {
                                    $id = $contacts['id'];
                                    $social_link = $contacts['social_links'];
                                    $phone = $contacts['phone'];
                                    $email = $contacts['email'];
                                    $address = $contacts['address'];
                                    // social links
                                    $social_links_show = '';
                                    // check social links json
                                    if ($contacts['social_links'] != '') {
                                        $social_links = json_decode($contacts['social_links']);
                                        // get social networks
                                        $row_social_nerworks = $cnt->selectDataAdmin("social_networks", "WHERE `status`='1' ORDER BY `sort`", 'all');
                                        foreach($row_social_nerworks as $s_networks) {
                                            $sn_id = $s_networks['id'];
                                            $sn_icon = $s_networks['icon'];
                                            $sn_title = $s_networks['title'];
                                            // get user social links
                                            foreach($social_links as $sl_id => $sl_link) {
                                                // check user social links
                                                if ($sn_id == $sl_id) {
                                                    $social_links_show .= '<a class="btn btn-light btn--raised" href="'.$sl_link.'" target="_blank" title="'.$sn_title.'" data-toggle="tooltip" data-placement="top"><i class="zmdi zmdi-'.$sn_icon.'"></i></a>';
                                                }
                                            }
                                        }
                                    }
                                    // check social links
                                    if ($social_links_show) {
                                        $social_links_show = '<li>'.$social_links_show.'</li>';
                                    }
                                    ?>
                                    <tr>
                                        <td><?=$id?></td>
                                        <td>
                                            <ul class="icon-list">
                                                <?=$social_links_show?>
                                            </ul>
                                        </td>
                                        <td><?=$phone?></td>
                                        <td><?=$email?></td>
                                        <td><?=$address?></td>
                                        <td>
                                            <!-- admin actions -->
                                            <a href="/admin/pages/edit_contacts?id=<?=$id?>" class="btn btn-light btn--raised" data-toggle="tooltip" data-placement="top" title="Редактировать"><i class="zmdi zmdi-edit"></i></a>
                                        </td>
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
