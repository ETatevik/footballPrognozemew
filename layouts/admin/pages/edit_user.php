<?php 
// get id
if(!isset($_GET['id'])) {
    header('location: /admin/pages/users');
    exit;
} else {
    $id = $_GET['id'];
}
// check user 
$user = $cnt->selectDataAdmin("u_users","WHERE `id`='$id'", 1);
if(!isset($user['id'])) {
    header('location: /admin/pages/users');
    exit;
} else {
    // status switch
    $status = $user['status'];
    if ($status == '0' || $status == '2') {
        $status_checked = '';
    }
    if ($status == '1') {
        $status_checked = 'checked';
    }
    
}
// photo data
$type_file = ['jpg','png','gif'];
$photo_src = 'no-photo.jpg';
$file_exists = 'new';
$file_exists_text = '';
// check icon
$photo = $cnt->selectDataAdmin("files", "WHERE `table_name`='u_users' AND `row_id`=".$user['id']." AND `name_used`='photo'");
if ($photo) {
if(in_array($photo['type'], $type_file)) {
// photo data
$path_file = $photo['name'].'.'.$photo['type'];
$file_exists = 'exists';
// check file
if (!file_exists("public/img/u_users/small/$path_file")) {
$file_exists_text = '<span class="text-red">(not found)</span>';
} else {
$photo_src = 'u_users/small/'.$path_file;
}
}
}
                                    
// page
$page =  $cnt->selectDataAdmin("a_menu","WHERE `filename`='users'",1);
// conf
require_once("layouts/admin/inc/conf.php");?>
<!DOCTYPE html>
<html lang="<?=$cnt->lang?>">
    <head>
        <?php include_once("layouts/admin/inc/head.php");?>
        <title>Edit <?=$user['name']?></title>  
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
                          <li class="breadcrumb-item"><a href="/admin/pages/users"><?=$page['title']?></a></li>
                          <li class="breadcrumb-item active" aria-current="page"><?=$user['name']?></li>
                        </ol>
                   </nav>
                <div class="content__inner">
                    <header class="content__title">
                        <h1>Редактировать <?=$user['name']?></h1>
                        <small><?=$page['descr']?></small>
                    </header>
                    <!-- Page Contents -->
                    <div class="card">
                        <div class="card-body">
                            <form data-cmd="updateDataAdmin" data-table="u_users" data-id="<?=$id?>">
                               <div class="tab-container">
                                    <ul class="nav nav-tabs  nav-tabs--black" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#users" role="tab">Данные пользователя</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#social_network" role="tab">Социальные ссылка</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active fade show" id="users" role="tabpanel">
                                            <div class="form-group">
                                                <label>Имя</label>
                                                <input type="text" name="name" value="<?=$user['name']?>" class="form-control" placeholder="Имя" required>
                                                <i class="form-group__bar"></i>
                                            </div>
                                            <div class="form-group">
                                                <label>Электронная почта</label>
                                                <input type="email" name="email" value="<?=$user['email']?>" class="form-control" placeholder="Адрес электронной почты">
                                                <i class="form-group__bar"></i>
                                            </div>
                                            <div class="form-group">
                                                <label>Телефон</label>
                                                    <input type="text" name="phone" value="<?=$user['phone']?>" class="form-control" placeholder="Номер телефона" required>
                                                <i class="form-group__bar"></i>
                                            </div>
                                            <div class="form-group">
                                                <label>Запис</label>
                                                <textarea class="form-control textarea-autosize" name="notes"><?=$user['notes']?></textarea>
                                                <i class="form-group__bar"></i>
                                            </div>
                                            <div class="form-group">
                                                <h3 class="card-body__title">Фотография</h3>
                                                <p>300x300px / 600x600px <?= $file_exists_text?></p>
                                                <div class="fileinput fileinput-<?= $file_exists?>" data-provides="fileinput">
                                                    <div class="fileinput-preview" data-trigger="fileinput">
                                                        <img src="/public/img/<?=$photo_src?>">
                                                    </div>
                                                    <a href="#" class="btn btn-danger btn--raised ajax-action-confirm fileinput-exists" data-dismiss="fileinput" data-cmd="removeFileId" data-table="u_users" data-id="<?=$photo['id']?>" data-action="hide-row" data-animation="bounceOut">Удалить</a>
                                                    <span class="btn-file btn btn-<?=$color_theme?> btn--raised">
                                                       <span class="fileinput-new">Выбрать</span>
                                                       <span class="fileinput-exists">Редактировать</span>
                                                       <input type="file" name="image[photo]" data-x-small="300" data-y-small="300" data-x-large="600" data-y-large="600" data-action-large="crop">
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h6>Статус</h6>
                                                <p>Неактивный / активный</p>
                                                <div class="toggle-switch toggle-switch--<?=$color_theme?>">
                                                    <input type="checkbox" name="status" class="toggle-switch__checkbox" <?=$status_checked?>>
                                                    <i class="toggle-switch__helper"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="social_network" role="tabpanel">
                                            <?php 
                                                // current user social links
                                                $user_social_json = $user['u_social_links'];
                                                $user_social_array = json_decode($user_social_json);
                                                $links_val = [];
                                                $i = 0;
                                                // get all social data
                                                foreach($cnt->selectDataAdmin('social_networks', 'ORDER BY `sort`', 'all') as $social_net) {
                                                    $links_val[$i] = '';
                                                    // check data
                                                    if ($user_social_array) {
                                                        // parse current user social links
                                                        foreach($user_social_array as $s_id => $s_value) {
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
                                                                <input type="text" name="u_social_links[<?= $social_net['id']?>]" class="form-control" placeholder="<?= $social_net['title']?>" value="<?= $links_val[$i]?>">
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
                                    <div class="col-8 text-right">
                                        <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="archiveData" data-table="u_users" data-id="<?=$user['id']?>" data-action="hide-btn" data-anim="bounceOut"><i class="zmdi zmdi-archive"></i>Переместить архив</a>
                                        <a href="#" class="btn btn-danger btn--raised ajax-action-confirm" data-cmd="deleteDataAdmin" data-table="u_users" data-id="<?=$user['id']?>" data-action="hide-btn" data-anim="bounceOut">Удалить</a>
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