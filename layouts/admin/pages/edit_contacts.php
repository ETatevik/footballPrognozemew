<?php 
// isset get id
if(!isset($_GET['id'])) {
    header('location: /admin/pages/contacts');
    exit;
} else {
    $id = $_GET['id'];
}
// get page data 
$contact = $cnt->selectDataAdmin("f_contacts", "WHERE `id`=".$id."");
// check page
if(!isset($contact['id'])) {
    header('location: /admin/pages/contacts');
    exit;
}
// conf
require_once("layouts/admin/inc/conf.php");?>
<!DOCTYPE html>
<html lang="<?=$cnt->lang?>">
    <head>
        <?php include_once("layouts/admin/inc/head.php");?>
        <title>Редактировать контакты</title>  
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
                      <li class="breadcrumb-item"><a href="/admin/pages/contacts">Контакты</a></li>
                    </ol>
                </nav>
                <div class="content__inner">
                    <header class="content__title">
                        <h1>Редактировать контакты</h1>
                        <small>Все данные паказываются на сайте.</small>
                    </header>
                    <!-- Page Contents -->
                    <div class="card">
                        <div class="card-body">
                            <form data-cmd="updateDataAdmin" data-id="<?=$contact['id']?>" data-table="f_contacts">
                                <div class="tab-container">
                                    <ul class="nav nav-tabs  nav-tabs--black" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#users" role="tab">Основные данные</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#social_network" role="tab">Соц. сети</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active fade show" id="users" role="tabpanel">
                                            <div class="form-group">
                                                <label>Телефон</label>
                                                <input type="text" name="phone" class="form-control" value="<?= $contact['phone']?>" placeholder="Телефон" required>
                                                <i class="form-group__bar"></i>
                                            </div>
                                            <div class="form-group">
                                                <label>Эл. почта</label>
                                                <input type="email" name="email" class="form-control" value="<?=$contact['email']?>" placeholder="Email" required>
                                                <i class="form-group__bar"></i>
                                            </div>
                                            <div class="form-group">
                                                <label>Адрес</label>
                                                <input type="text" name="address" class="form-control" value="<?= $contact['address']?>" placeholder="Адрес" required>
                                                <i class="form-group__bar"></i>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="social_network" role="tabpanel">
                                            <?php 
                                            // social links
                                            $social_json = $contact['social_links'];
                                            $social_array = json_decode($social_json);
                                            $links_val = [];
                                            $i = 0;
                                            // get all social data
                                            foreach($cnt->selectDataAdmin("social_networks", "WHERE `status`='1' ORDER BY `sort`", 'all') as $social_net) {
                                                $links_val[$i] = '';
                                                // check data
                                                if ($social_array) {
                                                    // parse current user social links
                                                    foreach($social_array as $s_id => $s_value) {
                                                        if($social_net['id'] == $s_id){
                                                            $links_val[$i] = $s_value;
                                                        }
                                                    }
                                                }
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="zmdi zmdi-<?= $social_net['icon']?>"></i></span>
                                                            </div>
                                                            <input type="text" name="social_links[<?= $social_net['id']?>]" class="form-control" placeholder="<?= $social_net['title']?>" value="<?= $links_val[$i]?>">
                                                            <i class="form-group__bar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                        </div>
                                   </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <button type="submit" class="btn btn-<?=$color_theme?> btn--raised">Сохранить</button>
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