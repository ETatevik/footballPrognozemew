<?php
// conf
require_once("layouts/admin/inc/conf.php");
// page
$page =  $cnt->selectDataAdmin("a_menu", "WHERE `filename`='forecasts'");?>
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
                        <h4 class="card-title">Добавить прогнозы</h4>
                        <h6 class="card-subtitle">Прогнозы</h6>
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
                            <form data-cmd="insertDataAdmin" data-table="f_forecasts">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Выбрать Лиги</label>
                                        <div class="form-group">
                                            <select name="f_league_id" id="get_league_teams" class="select2" data-cmd="get_league_teams"> 
                                                <option value="0">Выбрать лиги</option>
                                                <?php 
											    foreach($cnt->selectDataAdmin("f_leagues", "WHERE `status`='1'", "all") as $leagues){
												    // get data leagues
												    $id = $leagues['id'];
												    $name = $leagues['title_ru'];
												    ?>
                                                    <option value="<?=$id?>"><?=$name?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Выбрать Команды 1</label>
                                        <div class="form-group">
                                            <select name="f_teams[]" id="league_team_1" class="select2">
                                                <option value="0">Select команды 1</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Выбрать Команды 2</label>
                                        <div class="form-group">
                                            <select name="f_teams[]" id="league_team_2" class="select2">
                                                <option value="0">Select команды 2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h6>Бесплатный</h6>
                                            <p>Оплаченный / Бесплатный</p>
                                            <div class="toggle-switch toggle-switch--<?=$color_theme?>">
                                                <input type="checkbox" name="free" class="toggle-switch__checkbox">
                                                <i class="toggle-switch__helper"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Выбрать Вероятность</label>
                                        <div class="form-group">
                                            <select name="probability" id="" class="select2">
                                                <option disabled selected>Выбрать Вероятность</option>
                                                <option value="0">Низкий</option>
                                                <option value="1">Средний</option>
                                                <option value="2">Высокий</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Счет</label>
                                        <div class="form-group">
                                            <input type="text" name="score" class="form-control" placeholder="Счет" required>
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
                                            <label>Описание RU</label>
                                            <textarea name="descr_ru" class="html-editor form-control" placeholder="Описание RU" required></textarea>
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Описание EN</label>
                                            <textarea name="descr_en" class="html-editor form-control" placeholder="Описание EN" required></textarea>
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                            <label>Дата начала</label>
                                            <input type="text" name='date_start' class="form-control datetime-picker hidden-sm-down" placeholder="Pick a date & time">
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
                                                <th>Команда</th>
                                                <th>Бесплатный</th>
                                                <th>Успех</th>
                                                <th>Вероятность</th>
                                                <th>Счет</th>
                                                <th>Заголовок</th>
                                                <th>Описание</th>
                                                <th>Дата</th>
                                                <th>Статус</th>
                                                <th class="actions_admin">Действия</th>
                                                <th>Сортировать</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                // get data
                                                foreach($cnt->selectDataAdmin("f_forecasts", "WHERE `status`!='2' ORDER BY `sort`", "all") as $forecasts) {
                                                    // get data
                                                    $id = $forecasts['id'];
                                                    $league_id = $forecasts['f_league_id'];
                                                    $league = $cnt->selectDataAdmin("f_leagues", "WHERE  `status`='1' AND `id`='$league_id'");
                                                    // check league 
                                                    if ($league) {
                                                        $league_name = $league['title_ru'];
                                                    }else {
                                                        $league_name = '';
                                                    }
                                                    $teams = json_decode($forecasts['f_teams']);
                                           
                                                    $teams_show = '';
                                                    if(count($teams)) {
                                                        foreach($teams as $team_id) {
                                                            // get team title
                                                            $team_row = $cnt->selectDataAdmin("f_teams", "WHERE `id`='$team_id'");
                                                            if($team_row) {
                                                                $team_title = $team_row['title_ru'];
                                                                $teams_show .= '<li>
                                                                    <a href="/admin/pages/edit_team?id='.$team_id.'" class="btn btn-light btn--raised">'.$team_title.'</a>
                                                                </li>';
                                                            }
                                                        }
                                                    }
                                                    if ($teams_show == '') {
                                                        $teams_show = '<i class="zmdi zmdi-close"></i>';
                                                    }
                                                    // check free
                                                    if ($forecasts['free'] == '1') {
                                                        $free = '<i class="zmdi zmdi-check"></i>';
                                                    }else {
                                                        $free = '<i class="zmdi zmdi-close"></i>';
                                                    }
                                                    // check success
                                                    if ($forecasts['success'] == '1') {
                                                        $success = '<i class="zmdi zmdi-check"></i>';
                                                    }else {
                                                        $success = '<i class="zmdi zmdi-close"></i>';
                                                    }
                                                    // check probability
                                                    if ($forecasts['probability'] == '0') {
                                                        $probability = 'Низкий';
                                                    }else if ($forecasts['probability'] == '1') {
                                                        $probability = 'Средний';
                                                    }else {
                                                        $probability = 'Высокая';
                                                    }
                                                    $score = $forecasts['score'];
                                                    // title_ru
                                                    $title_ru = '';
                                                    if($forecasts['title_ru'] != '') {
                                                        $title_ru = '<li title="Title RU" data-toggle="tooltip" data-placement="top">'.$forecasts['title_ru'].'</li>';
                                                    }
                                                    // title_en
                                                    $title_en = '';
                                                    if($forecasts['title_en'] != '') { 
                                                        $title_en = '<li title="Title EN" data-toggle="tooltip" data-placement="top">'.$forecasts['title_en'].'</li>';
                                                    }
                                                    $descr_ru = mb_substr($forecasts['descr_ru'], 0, 255).'...';
                                                    $descr_en = mb_substr($forecasts['descr_en'], 0, 255).'...';
                                                    // get date
                                                    $date_start = date('Y.m.d H:i', strtotime($forecasts['date_start']));
                                                    $date = date('Y.m.d H:i', strtotime($forecasts['date']));
                                                    $status = $forecasts['status'];
                                                    $sort = $forecasts['sort'];
                                                    ?>
                                            <tr id="sort_list_<?=$id?>" class="sortable" data-table="f_forecasts">
                                                <td><?= $id?></td>
                                                <td>
                                                    <ul class="icon-list">
                                                        <li>
                                                            <a href="/admin/pages/edit_leagues?id=<?=$league_id?>" class="btn btn-light btn--raised"><?=$league_name?></a>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="icon-list">
                                                        <?=$teams_show?>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <?=$free?>
                                                </td>
                                                <td>
                                                   <?=$success?>
                                                </td>
                                                <td>
                                                   <?=$probability?>
                                                </td>
                                                <td>
                                                    <?=$score?>
                                                </td>
                                                <td>
                                                <ul class="icon-list">
                                                    <li><?=$title_ru?></li>
                                                    <li><?=$title_en?></li>
                                                </ul>
                                                </td>
                                                <td>
                                                   <ul class="icon-list">
                                                        <?php
                                                        // check data
                                                        if ($descr_ru != '' || $descr_en != '') {
                                                        ?>
                                                        <li>
                                                            <button type="button" class="btn btn-light mb-2" data-placement="top" data-toggle="popover" data-trigger="hover" title="Описание RU" data-content="<?=$descr_ru?>">Описание RU</button>
                                                        </li>
                                                        <li>
                                                            <button type="button" class="btn btn-light" data-placement="top" data-toggle="popover" data-trigger="hover" title="Описание EN" data-content="<?=$descr_en?>">Описание EN</button>
                                                        </li>
                                                        <?php }?>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="icon-list">
                                                        <li>
                                                            <button type="button" class="btn btn-light mb-2" data-placement="top" data-toggle="popover" data-trigger="hover" title="Дата начала" data-content="<?=$date_start?>">Дата начала</button>
                                                        </li>
                                                         <li>
                                                            <button type="button" class="btn btn-light mb-2" data-placement="top" data-toggle="popover" data-trigger="hover" title="Дата" data-content="<?=$date?>">Дата</button>
                                                        </li>
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
                                                    <a href="/admin/pages/edit_forecasts?id=<?=$id?>" class="btn btn-light btn--raised" data-toggle="tooltip" data-placement="top" title="Edit"><i class="zmdi zmdi-edit"></i></a>
                                                    <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="archiveData" data-table="f_forecasts" data-id="<?=$id?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Archive"><i class="zmdi zmdi-archive"></i></a>
                                                    <a href="#" class="btn btn-danger btn--raised ajax-action-confirm" data-cmd="deleteDataAdmin " data-table="f_forecasts" data-id="<?=$id?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Delete"><i class="zmdi zmdi-delete"></i></a>
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
                                                <th>Команда</th>
                                                <th>Бесплатный</th>
                                                <th>Успех</th>
                                                <th>Вероятность</th>
                                                <th>Счет</th>
                                                <th>Заголовок</th>
                                                <th>Описание</th>
                                                <th>Дата</th>
                                                <th>Статус</th>
                                                <th class="actions_admin">Действия</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                // get data
                                                foreach($cnt->selectDataAdmin("f_forecasts", "WHERE `status`='2' ORDER BY `sort`", "all") as $forecasts) {
                                                    // get data
                                                    $id = $forecasts['id'];
                                                    $league_id = $forecasts['f_league_id'];
                                                    $league = $cnt->selectDataAdmin("f_leagues", "WHERE  `status`='1' AND `id`='$league_id'");
                                                    // check league 
                                                    if ($league) {
                                                        $league_name = $league['title_ru'];
                                                    }else {
                                                        $league_name = '';
                                                    }
                                                    $teams = json_decode($forecasts['f_teams']);
                                           
                                                    $teams_show = '';
                                                    if(count($teams)) {
                                                        foreach($teams as $team_id) {
                                                            // get team title
                                                            $team_row = $cnt->selectDataAdmin("f_teams", "WHERE `id`='$team_id'");
                                                            if($team_row) {
                                                                $team_title = $team_row['title_ru'];
                                                                $teams_show .= '<li>
                                                                    <a href="/admin/pages/edit_team?id='.$team_id.'" class="btn btn-light btn--raised">'.$team_title.'</a>
                                                                </li>';
                                                            }
                                                        }
                                                    }
                                                    if ($teams_show == '') {
                                                        $teams_show = '<i class="zmdi zmdi-close"></i>';
                                                    }
                                                    // check free
                                                    if ($forecasts['free'] == '1') {
                                                        $free = '<i class="zmdi zmdi-check"></i>';
                                                    }else {
                                                        $free = '<i class="zmdi zmdi-close"></i>';
                                                    }
                                                    // check success
                                                    if ($forecasts['success'] == '1') {
                                                        $success = '<i class="zmdi zmdi-check"></i>';
                                                    }else {
                                                        $success = '<i class="zmdi zmdi-close"></i>';
                                                    }
                                                    // check probability
                                                    if ($forecasts['probability'] == '0') {
                                                        $probability = 'Низкий';
                                                    }else if ($forecasts['probability'] == '1') {
                                                        $probability = 'Средний';
                                                    }else {
                                                        $probability = 'Высокий';
                                                    }
                                                    $score = $forecasts['score'];
                                                    // title_ru
                                                    $title_ru = '';
                                                    if($forecasts['title_ru'] != '') {
                                                        $title_ru = '<li title="Title RU" data-toggle="tooltip" data-placement="top">'.$forecasts['title_ru'].'</li>';
                                                    }
                                                    // title_en
                                                    $title_en = '';
                                                    if($forecasts['title_en'] != '') { 
                                                        $title_en = '<li title="Title EN" data-toggle="tooltip" data-placement="top">'.$forecasts['title_en'].'</li>';
                                                    }
                                                    $descr_ru = mb_substr($forecasts['descr_ru'], 0, 255).'...';
                                                    $descr_en = mb_substr($forecasts['descr_en'], 0, 255).'...';
                                                    // get date
                                                    $date_start = date('Y.m.d H:i', strtotime($forecasts['date_start']));
                                                    $date = date('Y.m.d H:i', strtotime($forecasts['date']));
                                                    $status = $forecasts['status'];
                                                    ?>
                                            <tr id="sort_list_<?=$id?>" class="sortable" data-table="f_forecasts">
                                                <td><?= $id?></td>
                                                <td>
                                                    <ul class="icon-list">
                                                        <li>
                                                            <a href="/admin/pages/edit_leagues?id=<?=$league_id?>" class="btn btn-light btn--raised"><?=$league_name?></a>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="icon-list">
                                                        <?=$teams_show?>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <?=$free?>
                                                </td>
                                                <td>
                                                   <?=$success?>
                                                </td>
                                                <td>
                                                   <?=$probability?>
                                                </td>
                                                <td>
                                                    <?=$score?>
                                                </td>
                                                <td>
                                                <ul class="icon-list">
                                                    <li><?=$title_ru?></li>
                                                    <li><?=$title_en?></li>
                                                </ul>
                                                </td>
                                                <td>
                                                   <ul class="icon-list">
                                                        <?php
                                                        // check data
                                                        if ($descr_ru != '' || $descr_en != '') {
                                                        ?>
                                                        <li>
                                                            <button type="button" class="btn btn-light mb-2" data-placement="top" data-toggle="popover" data-trigger="hover" title="Описание RU" data-content="<?=$descr_ru?>">Описание RU</button>
                                                        </li>
                                                        <li>
                                                            <button type="button" class="btn btn-light" data-placement="top" data-toggle="popover" data-trigger="hover" title="Описание EN" data-content="<?=$descr_en?>">Описание EN</button>
                                                        </li>
                                                        <?php }?>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="icon-list">
                                                        <li>
                                                            <button type="button" class="btn btn-light mb-2" data-placement="top" data-toggle="popover" data-trigger="hover" title="Дата начала" data-content="<?=$date_start?>">Дата начала</button>
                                                        </li>
                                                         <li>
                                                            <button type="button" class="btn btn-light mb-2" data-placement="top" data-toggle="popover" data-trigger="hover" title="Дата" data-content="<?=$date?>">Дата</button>
                                                        </li>
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
                                                    <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="removeArchive" data-table="f_forecasts" data-id="<?=$id?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Remove from archive"><i class="zmdi zmdi-sign-in"></i></a>
                                                    <a href="#" class="btn btn-danger btn--raised ajax-action-confirm" data-cmd="deleteDataAdmin " data-table="f_forecasts" data-id="<?=$id?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Delete"><i class="zmdi zmdi-delete"></i></a>
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
