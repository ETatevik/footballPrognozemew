<?php
// conf
require_once("layouts/admin/inc/conf.php");
// page
$page =  $cnt->selectDataAdmin("a_menu", "WHERE `filename`='teams'");?>
<!DOCTYPE html>
<html lang="<?=$cnt->lang?>">
<head>
    <?php include_once("layouts/admin/inc/head.php");?>
    <title>Pages</title>
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
                        <h4 class="card-title">Добавить Команда</h4>
                        <h6 class="card-subtitle">Команды</h6>
                        <div class="actions">
                            <div class="dropdown actions__item">
                                <i data-toggle="dropdown" class="zmdi zmdi-more-vert"></i>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="" class="dropdown-item">Обновить</a>
                                </div>
                            </div>
                            <div class="actions__item">
                                <i class="zmdi zmdi-plus plus_minus" data-toggle="collapse" data-target="#pages" aria-expanded="false" aria-controls="pages"></i>
                            </div>
                        </div>
                        <div class="collapse" id="pages">
                            <form data-cmd="insertDataAdmin" data-table="f_teams">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Выбрать лиги</label>
                                        <div class="form-group">
                                            <select name="f_leagues[]" multiple id="" class="select2">
                                                <option value="0">Выбрать лиги</option>
                                                <?php 
                                                    // get services
                                                    foreach($cnt->getDataUser("f_leagues","WHERE `status`='1'","all") as $leagues){
                                                        // get data service
                                                        $id = $leagues['id'];
                                                        $title_ru = $leagues['title_ru'];
                                                    ?>
                                                <option value="<?=$id?>"><?=$title_ru?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Заголовок RU</label>
                                            <input type="text" name="title_ru" class="form-control" placeholder="Заголовок RU" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Заголовок EN</label>
                                            <input type="text" name="title_en" class="form-control" placeholder="Заголовок EN" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                         <div class="form-group">
                                                <h6>Логотип</h6>
                                                <p>80x80px</p>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-preview" data-trigger="fileinput"></div>
                                                    <a href="#" class="btn btn-danger btn--raised fileinput-exists" data-dismiss="fileinput">Удалить</a>
                                                    <span class="btn btn-file btn-<?=$color_theme?> btn--raised">
                                                        <span class="fileinput-new">Выбрать</span>
                                                        <span class="fileinput-exists">Редактировать</span>
                                                        <input type="file" name="image[logo]" data-x-small="80" data-y-small="80" accept="image/x-png">    
                                                    </span>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h6>Статус</h6>
                                            <p>Неактивный / активный</p>
                                            <div class="toggle-switch toggle-switch--<?=$color_theme?>">
                                                <input type="checkbox" name="status" class="toggle-switch__checkbox">
                                                <i class="toggle-switch__helper"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-<?=$color_theme?> btn--raised" type="submit">Добавить</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--SELECT ALBUM -->
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
                                                <th>Лиги</th>
                                                <th>Заголовок</th>
                                                <th>Логотип</th>
                                                <th>Дата</th>
                                                <th>Статус</th>
                                                <th class="actions_admin">Действия</th>
                                                <th>Сортировать</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                // get data
                                                foreach($cnt->selectDataAdmin("f_teams", "WHERE `status`!='2' ORDER BY `sort`", "all") as $team) {
                                                    // get data
                                                    $id = $team['id'];
                                                      $league = '';
                                                    if ($team['f_leagues'] != '') {
                                                        $team_league_id = json_decode($team['f_leagues']);
                                                         $row_leagues = $cnt->selectDataAdmin("f_leagues", "WHERE `status`='1' ORDER BY `sort`", 'all');
                                                        foreach($row_leagues as $leagues) {
                                                            $league_id = $leagues['id'];
                                                            $league_title = $leagues['title_ru'];
                                                        foreach($team_league_id as $t_league_id) {
                                                            // check league_id
                                                            if ($league_id == $t_league_id) {
                                                                $league .= '<a class="btn btn-light btn--raised mb-2" href="/admin/pages/edit_leagues?id='.$league_id.'" target="_blank" data-toggle="tooltip" data-placement="top">'.$league_title.'</a><br>';
                                                            }
                                                        }
                                                    }
                                                }
                                                    // title_ru
                                                    $title_ru = '';
                                                    if($team['title_ru'] != '') {
                                                        $title_ru = '<li title="Заголовок RU" data-toggle="tooltip" data-placement="top">'.$team['title_ru'].'</li>';
                                                    }
                                                    // title_en
                                                    $title_en = '';
                                                    if($team['title_en'] != '') { 
                                                        $title_en = '<li title="Заголовок EN" data-toggle="tooltip" data-placement="top">'.$team['title_en'].'</li>';
                                                    }
                                                    // get date
                                                    $date = date('Y.m.d H:i', strtotime($team['date']));
                                                    /* logo [image] */
													$logo_sm_src = 'no_photo.jpg';
													$logo_lg_src = 'no_photo.jpg';
													$row_logo = $cnt->selectDataAdmin("files", "WHERE `table_name`='f_teams' AND `row_id`='$id' AND `name_used`='logo'");
                                                    // check logo
													if ($row_logo) {
														$logo_link = $row_logo['name'].'.'.$row_logo['type'];
														// check file
														if (file_exists("public/img/f_teams/large/$logo_link")) {
															$logo_lg_src = 'f_news/large/'.$logo_link;
														}
                                                        if (file_exists("public/img/f_teams/small/$logo_link")) {
															$logo_sm_src = 'f_teams/small/'.$logo_link;
														}
													}
													$logo_show = '<li title="Логотип" data-toggle="tooltip" data-placement="top"><img src="/public/img/'.$logo_sm_src.'" width="90px"></li>';
                                                    $status = $team['status'];
                                                    $sort = $team['sort'];
                                                    ?>
                                            <tr id="sort_list_<?=$id?>" class="sortable" data-table="f_teams">
                                                <td><?= $id?></td>
                                                <td>
                                                    <ul class="icon-list">
                                                       <?=$league?>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="icon-list">
                                                        <?=$title_ru?>
                                                        <?=$title_en?>
                                                    </ul>
                                                </td>
                                                <td>
                                                   <ul class="icon-list">
                                                         <?=$logo_show?>
                                                    </ul> 
                                                </td>
                                                <td>
                                                    <ul class="icon-list">
                                                        <li><?=$date?></li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <?php
                                                    // status not active
                                                    if($status == '1') {
                                                        echo 'Active';
                                                    } 
                                                    // status archive (2)
                                                    else {
                                                        echo 'Inactive';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <!-- admin actions -->
                                                    <a href="/admin/pages/edit_teams?id=<?=$id?>" class="btn btn-light btn--raised" data-toggle="tooltip" data-placement="top" title="Редактировать"><i class="zmdi zmdi-edit"></i></a>
                                                    <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="archiveData" data-table="f_teams" data-id="<?=$id?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Архив"><i class="zmdi zmdi-archive"></i></a>
                                                    <a href="#" class="btn btn-danger btn--raised ajax-action-confirm" data-cmd="deleteDataAdmin " data-table="f_teams" data-id="<?=$id?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Удалить"><i class="zmdi zmdi-delete"></i></a>
                                                </td>
                                                <td>
                                                    <span class="btn btn-light btn--raised handle">
                                                        <span class="result-sort"><i class="zmdi zmdi-swap-vertical"></i></span>
                                                        <?= $sort?>
                                                    </span>
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
                                                <th>Лиги</th>
                                                <th>Заголовок</th>
                                                <th>Логотип</th>
                                                <th>Дата</th>
                                                <th>Статус</th>
                                                <th class="actions_admin">Действия</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                // get data
                                                foreach($cnt->selectDataAdmin("f_teams", "WHERE `status`='2' ORDER BY `sort`", "all") as $team) {
                                                     // get data
                                                    $id = $team['id'];
                                                      $league = '';
                                                    if ($team['f_leagues'] != '') {
                                                        $team_league_id = json_decode($team['f_leagues']);
                                                         $row_leagues = $cnt->selectDataAdmin("f_leagues", "WHERE `status`='1' ORDER BY `sort`", 'all');
                                                        foreach($row_leagues as $leagues) {
                                                            $league_id = $leagues['id'];
                                                            $league_title = $leagues['title_ru'];
                                                        foreach($team_league_id as $t_league_id) {
                                                            // check league_id
                                                            if ($league_id == $t_league_id) {
                                                                $league .= '<a class="btn btn-light btn--raised mb-2" href="/admin/pages/edit_leagues?id='.$league_id.'" target="_blank" data-toggle="tooltip" data-placement="top">'.$league_title.'</a><br>';
                                                            }
                                                        }
                                                    }
                                                }
                                                    // title_ru
                                                    $title_ru = '';
                                                    if($team['title_ru'] != '') {
                                                        $title_ru = '<li title="Заголовок RU" data-toggle="tooltip" data-placement="top">'.$team['title_ru'].'</li>';
                                                    }
                                                    // title_en
                                                    $title_en = '';
                                                    if($team['title_en'] != '') { 
                                                        $title_en = '<li title="Заголовок EN" data-toggle="tooltip" data-placement="top">'.$team['title_en'].'</li>';
                                                    }
                                                    // get date
                                                    $date = date('Y.m.d H:i', strtotime($team['date']));
                                                    /* logo [image] */
													$logo_sm_src = 'no_photo.jpg';
													$logo_lg_src = 'no_photo.jpg';
													$row_logo = $cnt->selectDataAdmin("files", "WHERE `table_name`='f_teams' AND `row_id`='$id' AND `name_used`='logo'");
                                                    // check logo
													if ($row_logo) {
														$logo_link = $row_logo['name'].'.'.$row_logo['type'];
														// check file
														if (file_exists("public/img/f_teams/large/$logo_link")) {
															$logo_lg_src = 'f_news/large/'.$logo_link;
														}
                                                        if (file_exists("public/img/f_teams/small/$logo_link")) {
															$logo_sm_src = 'f_teams/small/'.$logo_link;
														}
													}
													$logo_show = '<li title="Логотип" data-toggle="tooltip" data-placement="top"><img src="/public/img/'.$logo_sm_src.'" width="90px"></li>';
                                                    $status = $team['status'];
                                                    $sort = $team['sort'];
                                                    ?>
                                            <tr id="sort_list_<?=$id?>" class="sortable" data-table="f_teams">
                                                <td><?= $id?></td>
                                                <td>
                                                    <ul class="icon-list">
                                                       <?=$league?>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="icon-list">
                                                        <?=$title_ru?>
                                                        <?=$title_en?>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="icon-list">
                                                        <?=$logo_show?>
                                                        
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="icon-list">
                                                        <li><?=$date?></li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <?php
                                                            // status not active
                                                            if($status == '1') {
                                                                echo 'Active';
                                                            } 
                                                            // status archive (2)
                                                            else {
                                                                echo 'Inactive';
                                                            }
                                                            ?>
                                                </td>
                                                <td>
                                                    <!-- admin actions -->
                                                    <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="removeArchive" data-table="f_teams" data-id="<?=$id?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Удалить из архива"><i class="zmdi zmdi-sign-in"></i></a>
                                                    <a href="#" class="btn btn-danger btn--raised ajax-action-confirm" data-cmd="deleteDataAdmin " data-table="f_teams" data-id="<?=$id?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Удалить"><i class="zmdi zmdi-delete"></i></a>
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
