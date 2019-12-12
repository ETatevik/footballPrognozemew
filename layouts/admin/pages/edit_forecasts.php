<?php 
// isset get id
if(!isset($_GET['id'])) {
    header('location: /admin/pages/forecasts');
    exit;
} else {
    $id = $_GET['id'];
}
// get page data 
$forecasts = $cnt->selectDataAdmin("f_forecasts", "WHERE `id`=".$id."");

// check page
if(!isset($forecasts['id'])) {
    header('location: /admin/pages/forecasts');
    exit;
} else {
    // status switch
    $status = $forecasts['status'];
    if ($status == '0' || $status == '2') {
        $status_checked = '';
    }
    if ($status == '1') {
        $status_checked = 'checked';
    }
}

// conf
require_once("layouts/admin/inc/conf.php");?>
<!DOCTYPE html>
<html lang="<?=$cnt->lang?>">

<head>
    <?php include_once("layouts/admin/inc/head.php");?>
    <title>Редактировать <?= $forecasts['title_ru']?></title>
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
                    <li class="breadcrumb-item"><a href="/admin/pages/forecasts">Прогнозы</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $forecasts['title_ru']?></li>
                </ol>
            </nav>
            <div class="content__inner">
                <header class="content__title">
                    <h1>Редактировать <?= $forecasts['title_ru']?></h1>
                    <small>Прогнозы</small>
                </header>
                <!-- Page Contents -->
                <div class="card">
                    <div class="card-body">
                        <form data-cmd="updateDataAdmin" data-id="<?=$forecasts['id']?>" data-table="f_forecasts">
                            <div class="row">
                                <div class="col-md-12">
                                        <label for="">Выбрать Лиги</label>
                                        <div class="form-group">
                                            <select name="f_league_id" id="get_league_teams" class="select2" data-cmd="get_league_teams">
                                                <option value="0">Выбрать лиги</option>
                                                <?php 
											    // get user
											    foreach($cnt->selectDataAdmin("f_leagues", "WHERE `status`='1'", "all") as $leagues){
												    // get data leagues
												    $l_id = $leagues['id'];
												    $l_name = $leagues['title_ru'];
                                                    $selected = '';
                                                    // check selected 
                                                    if($l_id == $forecasts['f_league_id']) {
                                                        $selected = 'selected';
                                                    }
												    ?>
                                                    <option value="<?=$l_id?>" <?=$selected?>><?=$l_name?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Выбрать Команды 1</label>
                                        <div class="form-group">
                                            <select name="f_teams[]" id="league_team_1" class="select2">
                                                <?php 
                                                // get teams    
                                                foreach($cnt->selectDataAdmin("f_teams", "WHERE `status`='1'", "all") as $t_teams) { 
                                                    $t_leauges = json_decode($t_teams['f_leagues']);   
                                                    if (in_array($t_leauges, $forecasts['f_league_id'])) {
                                                        $t_id = $f_teams['id'];
                                                        $t_title = $f_teams['title_ru'];
                                                        // check selected
                                                        $selected_1 = '';
                                                        if ($t_id == json_decode($forecasts['f_teams'])[0]) {
                                                           $selected_1 = 'selected'; 
                                                        }
                                                        echo '<option value="'.$t_id.'" '.$selected_1.'>'.$t_title.'</option>';
                                                    }    
                                                }   
                                                ?>
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
                                        <label>Заголовок RU</label>
                                        <input type="text" name="title_ru" class="form-control" value="<?=$forecasts['title_ru']?>" placeholder="Заголовок RU" required>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Заголовок EN</label>
                                        <input type="text" name="title_en" class="form-control" value="<?=$forecasts['title_en']?>" placeholder="Заголовок EN" required>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                        <label for="">Выбрать Вероятность</label>
                                        <div class="form-group">
                                            <select name="probability" id="" class="select2">
                                                <?php 
                                                    // check selected 
                                                    $selected_1 = '';
                                                    $selected_2 = '';
                                                    $selected_3 = '';
                                                    $probability = $forecasts['probability'];
                                                    if ($probability == 0) {
                                                        $selected_1 = 'selected';
                                                    }
                                                    if ($probability == 1) {
                                                        $selected_2 = 'selected';
                                                    }
                                                    if ($probability == 2) {
                                                        $selected_3 = 'selected';
                                                    }
                                                 ?>
                                                <option value="0" <?=$selected_1?>>Низкий</option>
                                                <option value="1" <?=$selected_2?>>Средний</option>
                                                <option value="2" <?=$selected_3?>>Высокий</option>
                                            </select>
                                        </div>
                                    </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Счет</label>
                                        <input type="text" name="score" class="form-control" value="<?=$forecasts['score']?>" placeholder="Счет" required>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h6>Статус</h6>
                                        <p>Неактивный / активный</p>
                                        <div class="toggle-switch toggle-switch--<?=$color_theme?>">
                                            <input type="checkbox" name="status" class="toggle-switch__checkbox" <?=$status_checked?>>
                                            <i class="toggle-switch__helper"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-<?=$color_theme?> btn--raised">Сохранить</button>
                                </div>
                                <div class="col-8 text-right">
                                    <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="archiveData" data-table="f_leagues" data-id="<?=$forecasts['id']?>" data-action="hide-btn" data-anim="bounceOut"><i class="zmdi zmdi-archive"></i>Переместить архив</a>
                                    <a href="#" class="btn btn-danger btn--raised ajax-action-confirm" data-cmd="deleteDataAdmin " data-table="f_leagues" data-id="<?=$forecasts['id']?>" data-action="hide-btn" data-anim="bounceOut">Удалить</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--Добавить вариант прогнозов -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Добавить вариант прогнозы</h4>
                        <h6 class="card-subtitle">Вариант прогнозы</h6>
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
                            <form data-cmd="insertDataAdmin" data-table="f_forecasts_options">
                                <div class="row">
                                    <input type="hidden" name="f_forecast_id" value="<?=$id?>">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Вариант 1 RU</label>
                                            <input type="text" name="option_1_ru" class="form-control" placeholder="Вариант 1 RU" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Вариант 1 EN</label>
                                            <input type="text" name="option_1_en" class="form-control" placeholder="Вариант 1 EN" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Вариант 2 RU</label>
                                            <input type="text" name="option_2_ru" class="form-control" placeholder="Вариант 2 RU" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Вариант 2 EN</label>
                                            <input type="text" name="option_2_en" class="form-control" placeholder="Вариант 2 EN" required>
                                            <i class="form-group__bar"></i>
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
                <!--Редактировать вариант прогнозов -->
                  <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Описание варианты</h4>
                        <h6 class="card-subtitle">Сохраняйте данные отдельно.</h6>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Вариант 1 RU</th>
                                    <th>Вариант 1 EN</th>
                                    <th>Вариант 2 RU</th>
                                    <th>Вариант 2 EN</th>
                                    <th>Сортировать</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // get offer types
                                $forecasts_option = '';
                                foreach($cnt->selectDataAdmin("f_forecasts_options", "WHERE 	`f_forecast_id`='$id' ORDER BY `sort`", "all") as $forecasts_option) {
                                    $forecasts_option_id = $forecasts_option['id'];
                                    $forecasts_option_1_ru = $forecasts_option['option_1_ru'];
                                    $forecasts_option_1_en = $forecasts_option['option_1_en'];
                                    $forecasts_option_2_ru = $forecasts_option['option_2_ru'];
                                    $forecasts_option_2_en = $forecasts_option['option_2_en'];
                                    $forecasts_option_sort = $forecasts_option['sort'];
                                    ?>
                                    <tr id="sort_list_<?=$forecasts_option_id?>" class="sortable" data-table="f_forecasts_options">
                                        <form data-cmd="updateDataAdmin" data-id="<?=$forecasts_option_id?>" data-table="f_forecasts_options">
                                            <td><?=$forecasts_option_id?></td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" name="option_1_ru" placeholder="Вариант 1 RU" value="<?=$forecasts_option_1_ru?>">
                                                    <i class="form-group__bar"></i>
                                                </div>
                                            </td>
                                             <td>
                                                <div class="form-group">
                                                    <input class="form-control" name="option_1_en" placeholder="Вариант 1 EN" value="<?=$forecasts_option_1_en?>">
                                                    <i class="form-group__bar"></i>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" name="option_2_ru" placeholder="Вариант 2 RU" value="<?=$forecasts_option_2_ru?>">
                                                    <i class="form-group__bar"></i>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" name="option_2_en" placeholder="Вариант 2 EN" value="<?=$forecasts_option_2_en?>">
                                                    <i class="form-group__bar"></i>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-<?=$color_theme?> btn--raised" title="Сохранить" data-toggle="tooltip" data-placement="top"><i class="zmdi zmdi-mail-send"></i></button>
                                            </td>
                                            <td>
                                                <span class="btn btn-light btn--raised handle">
                                                    <span class="result-sort"><i class="zmdi zmdi-swap-vertical"></i></span>
                                                    <?=$forecasts_option_sort?>
                                                </span>
                                            </td>
                                        </form>
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
