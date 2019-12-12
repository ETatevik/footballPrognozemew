<?php
// page
$page = $cnt->selectDataAdmin("a_menu", "WHERE `filename`='users'");
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
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Добавить Пользователь</h4>
                            <h6 class="card-subtitle">Данные пользователей/клиентов по умолчанию, которые должны быть зарегистрированы.</h6>
                            <div class="actions">
                                <div class="dropdown actions__item">
                                    <i data-toggle="dropdown" class="zmdi zmdi-more-vert"></i>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="" class="dropdown-item">Обновить</a>
                                    </div>
                                </div>
                                <div class="actions__item">
                                    <i class="zmdi zmdi-plus plus_minus" data-toggle="collapse" data-target="#addUsers" aria-expanded="false" aria-controls="addUsers"></i>
                                </div>
                            </div>
                            <div class="collapse" id="addUsers">
                                <form data-cmd="insertDataAdmin" data-table="u_users">
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
                                            <div class="tab-pane active fade show " id="users" role="tabpanel">
                                                <div class="form-group">
                                                    <label>Имя</label>
                                                    <input type="text" name="name" class="form-control" placeholder="Имя или полное имя" required>
                                                    <i class="form-group__bar"></i>
                                                </div>
                                                <div class="form-group">
                                                    <label>Электронная почта</label>
                                                    <input type="text" name="email" class="form-control" placeholder="Адрес электронной почты" required>
                                                    <i class="form-group__bar"></i>
                                                </div>
                                                <div class="form-group">
                                                    <label>Телефон</label>
                                                    <input type="text" name="phone" class="form-control" placeholder="Номер телефона" required>
                                                    <i class="form-group__bar"></i>
                                                </div>
                                                <div class="form-group">
                                                    <h3 class="card-body__title">Фотография</h3>
                                                    <p>300x300px / 600x600px</p>
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-preview" data-trigger="fileinput"></div>
                                                        <a href="#" class="btn btn-danger btn--raised fileinput-exists" data-dismiss="fileinput">Удалить</a>
                                                        <span class="btn btn-file btn-<?=$color_theme?> btn--raised">
                                                           <span class="fileinput-new">Выбрать</span>
                                                           <span class="fileinput-exists">Редактировать</span>
                                                           <input type="file" name="image[photo]" data-x-small="300" data-y-small="300" data-x-large="600" data-y-large="600">
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Записи</label>
                                                    <textarea class="form-control textarea-autosize" name="notes" placeholder="Запис администратора"></textarea>
                                                    <i class="form-group__bar"></i>
                                                </div>
                                                <div class="form-group">
                                                    <h6>Статус</h6>
                                                    <p>Неактивный / активный</p>
                                                    <div class="toggle-switch toggle-switch--<?=$color_theme?>">
                                                        <input type="checkbox" name="status" class="toggle-switch__checkbox">
                                                        <i class="toggle-switch__helper"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="social_network" role="tabpanel">
                                                <?php
                                                // get social links
                                                foreach($cnt->selectDataAdmin("social_networks", "WHERE `status`='1' ORDER BY `sort`", "all") as $social){
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="zmdi zmdi-<?= $social['icon']?>"></i></span>
                                                                </div>
                                                                <input type="text" name="u_social_links[<?= $social['id']?>]" class="form-control" placeholder="<?= $social['title']?>">
                                                                <i class="form-group__bar"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php }?>
                                            </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                      
                                        <div class="col-md-12">
                                            <button class="btn btn-<?=$color_theme?> btn--raised" type="submit">Добавить</button>
                                        </div>
                                    </div>
                               </form>
                            </div>
                        </div>
                    </div>
                    <!-- Page Contents -->
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-container">
                                <ul class="nav nav-tabs nav-fill nav-tabs--black" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#active" role="tab">Активный</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#archive" role="tab">Архив</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active fade show" id="active" role="tabpanel">
                                        <table class="table table-hover data-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Контакты</th>
                                                    <th>Фотография</th>
                                                    <th>Записи</th>
                                                    <th>Дата</th>
                                                    <th>Статус</th>
                                                    <th>Действия</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // get data
                                                foreach($cnt->selectDataAdmin("u_users", "WHERE `status`!='2'", 'all') as $users) {
                                                    $id = $users['id'];
                                                    $user_id = $users['id'];
                                                    // name
                                                    $user_name = '';
                                                    if ($users['name'] != '') {
                                                        $user_name = '<li><i class="zmdi zmdi-account"></i> '.$users['name'].'</li>';
                                                    }
                                                    // email
                                                    $user_email = '';
                                                    if ($users['email'] != '') {
                                                        $user_email = '<li><i class="zmdi zmdi-email"></i> '.$users['email'].'</li>';
                                                    }
                                                    // phone
                                                    $user_phone = '';
                                                    if ($users['phone'] != '') {
                                                        $user_phone = '<li><i class="zmdi zmdi-phone"></i> '.$users['phone'].'</li>';
                                                    }
                                                    // notes
                                                    $user_notes = mb_substr(decodeText($users['notes'], true, false), 0, 255);
                                                    // status inactive
                                                    if($users['status'] == '0') {
                                                        $user_status = 'Inactive';
                                                    } 
                                                    // status active
                                                    else if($users['status'] == '1') {
                                                        $user_status = 'Active';
                                                    } 
                                                    // status archive (2)
                                                    else if ($users['status'] == '2') {
                                                        $user_status = 'Archive';
                                                    }
                                                    // error
                                                    else {
                                                        $user_status = 'Error';
                                                    }
                                                    // date
                                                    $user_reg_date = date('d.m.Y H:i', strtotime($users['date']));
                                                    // photo
                                                    $user_image_src = 'no-photo.jpg';
                                                    $row_user_image = $cnt->selectDataAdmin("files", "WHERE `table_name`='u_users' AND `row_id`='$id' AND `name_used`='photo'");
                                                    // check image
                                                    if ($row_user_image) {
                                                        $image_link = $row_user_image['name'].'.'.$row_user_image['type'];
                                                        // check file
                                                        if (file_exists("public/img/u_users/small/$image_link")) {
                                                            $user_image_src = 'u_users/small/'.$image_link;
                                                        }
                                                    }
                                                    $user_image_show = '<li title="Фотография" data-toggle="tooltip" data-placement="top"><img src="/public/img/'.$user_image_src.'" width="90px"></li>';
													// social links
													$user_sl = '';
													// check social links json
													if ($users['u_social_links'] != '') {
														$user_social_links = json_decode($users['u_social_links']);
														// get social networks
														$row_social_nerworks = $cnt->selectDataAdmin("social_networks", "WHERE `status`='1' ORDER BY `sort`", 'all');
														foreach($row_social_nerworks as $s_networks) {
															$sn_id = $s_networks['id'];
															$sn_icon = $s_networks['icon'];
															$sn_title = $s_networks['title'];
															// get user social links
															foreach($user_social_links as $sl_id => $sl_link) {
																// check user social links
																if ($sn_id == $sl_id) {
																	$user_sl .= '<a class="btn btn-light btn--raised" href="'.$sl_link.'" target="_blank" title="'.$sn_title.'" data-toggle="tooltip" data-placement="top"><i class="zmdi zmdi-'.$sn_icon.'"></i></a>';
																}
															}
														}
													}
													// check social links
													if ($user_sl) {
														$user_sl = '<li>'.$user_sl.'</li>';
													}
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?=$user_id?>
                                                    </td>
                                                    <td>
                                                        <ul class="icon-list">
                                                            <?=$user_name?>
                                                            <?=$user_email?>
                                                            <?=$user_phone?>
                                                            <?=$user_sl?>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <ul class="icon-list">
                                                            <?=$user_image_show?>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        
                                                        <button type="button" class="btn btn-light" data-placement="top" data-toggle="popover" data-trigger="hover" data-html="true" title="Описание" data-content="<?=$user_notes?>">Записи</button>
                                                    </td>
                                                    <td>
                                                        <ul class="icon-list">
                                                            <li><i class="zmdi zmdi-calendar"></i> <?=$user_reg_date?></li>
                                                        </ul>
                                                    </td>
                                                    <td><?=$user_status?></td>
                                                    <td>
                                                        <?php
                                                        // admin actions
                                                        if ($cnt->Admin['perm_type'] == 1) { ?>
                                                            <a href="/admin/pages/edit_user?id=<?=$user_id?>" class="btn btn-light btn--raised" data-toggle="tooltip" data-placement="top" title="Редактировать"><i class="zmdi zmdi-edit"></i></a>
                                                            <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="archiveData" data-table="u_users" data-id="<?=$user_id?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Архив"><i class="zmdi zmdi-archive"></i></a>
                                                            <a href="#" class="btn btn-danger ajax-action-confirm btn--raised" data-cmd="deleteDataAdmin" data-table="u_users" data-id="<?=$user_id?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Удалить"><i class="zmdi zmdi-delete"></i></a>
                                                        <?php } else {?>
                                                            <button class="btn btn-light btn--raised" disabled><i class="zmdi zmdi-edit"></i></button>
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
                                                    <th>Контакты</th>
                                                    <th>Фотография</th>
                                                    <th>Записи</th>
                                                    <th>Дата</th>
                                                    <th>Статус</th>
                                                    <th>Действия</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // get data
                                                foreach($cnt->selectDataAdmin("u_users","WHERE `status`='2'", 'all') as $users) {
                                                    $id = $users['id'];
                                                    $user_id = $users['id'];
                                                    // name
                                                    $user_name = '';
                                                    if ($users['name'] != '') {
                                                        $user_name = '<li><i class="zmdi zmdi-account"></i> '.$users['name'].'</li>';
                                                    }
                                                    // email
                                                    $user_email = '';
                                                    if ($users['email'] != '') {
                                                        $user_email = '<li><i class="zmdi zmdi-email"></i> '.$users['email'].'</li>';
                                                    }
                                                    // phone
                                                    $user_phone = '';
                                                    if ($users['phone'] != '') {
                                                        $user_phone = '<li><i class="zmdi zmdi-phone"></i> '.$users['phone'].'</li>';
                                                    }
                                                    // notes
                                                    $user_notes = mb_substr(decodeText($users['notes'], true, false), 0, 255);
                                                    // status inactive
                                                    if($users['status'] == '0') {
                                                        $user_status = 'Inactive';
                                                    } 
                                                    // status active
                                                    else if($users['status'] == '1') {
                                                        $user_status = 'Active';
                                                    } 
                                                    // status archive (2)
                                                    else if ($users['status'] == '2') {
                                                        $user_status = 'Archive';
                                                    }
                                                    // error
                                                    else {
                                                        $user_status = 'Error';
                                                    }
                                                    // date
                                                    $user_reg_date = date('d.m.Y H:i', strtotime($users['date']));
                                                    // photo
                                                    $user_image_src = 'no-photo.jpg';
                                                    $row_user_image = $cnt->selectDataAdmin("files", "WHERE `table_name`='u_users' AND `row_id`='$id' AND `name_used`='photo'");
                                                    // check image
                                                    if ($row_user_image) {
                                                        $image_link = $row_user_image['name'].'.'.$row_user_image['type'];
                                                        // check file
                                                        if (file_exists("public/img/u_users/small/$image_link")) {
                                                            $user_image_src = 'u_users/small/'.$image_link;
                                                        }
                                                    }
                                                    $user_image_show = '<li title="Фотография" data-toggle="tooltip" data-placement="top"><img src="/public/img/'.$user_image_src.'" width="90px"></li>';
													// social links
													$user_sl = '';
													// check social links json
													if ($users['u_social_links'] != '') {
														$user_social_links = json_decode($users['u_social_links']);
														// get social networks
														$row_social_nerworks = $cnt->selectDataAdmin("social_networks", "WHERE `status`='1' ORDER BY `sort`", 'all');
														foreach($row_social_nerworks as $s_networks) {
															$sn_id = $s_networks['id'];
															$sn_icon = $s_networks['icon'];
															$sn_title = $s_networks['title'];
															// get user social links
															foreach($user_social_links as $sl_id => $sl_link) {
																// check user social links
																if ($sn_id == $sl_id) {
																	$user_sl .= '<a class="btn btn-light btn--raised" href="'.$sl_link.'" target="_blank" title="'.$sn_title.'" data-toggle="tooltip" data-placement="top"><i class="zmdi zmdi-'.$sn_icon.'"></i></a>';
																}
															}
														}
													}
													// check social links
													if ($user_sl) {
														$user_sl = '<li>'.$user_sl.'</li>';
													}
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?=$user_id?>
                                                    </td>
                                                    <td>
                                                        <ul class="icon-list">
                                                            <?=$user_name?>
                                                            <?=$user_email?>
                                                            <?=$user_phone?>
                                                            <?=$user_sl?>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <ul class="icon-list">
                                                            <?=$user_image_show?>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        
                                                        <button type="button" class="btn btn-light" data-placement="top" data-toggle="popover" data-trigger="hover" data-html="true" title="Описание" data-content="<?=$user_notes?>">Записи</button>
                                                    </td>
                                                    <td>
                                                        <ul class="icon-list">
                                                            <li><i class="zmdi zmdi-calendar"></i> <?=$user_reg_date?></li>
                                                        </ul>
                                                    </td>
                                                    <td><?=$user_status?></td>
                                                    <td>
                                                        <?php
                                                        // admin actions
                                                        if ($cnt->Admin['perm_type'] == 1) {?>
                                                            <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="removeArchive" data-table="u_users" data-id="<?=$user_id?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Удалить из aрхивa"><i class="zmdi zmdi-sign-in"></i></a>
                                                            <a href="#" class="btn btn-danger ajax-action-confirm btn--raised" data-cmd="deleteDataAdmin" data-table="u_users" data-id="<?=$user_id?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Удалить"><i class="zmdi zmdi-delete"></i></a>
                                                        <?php } else {?>
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