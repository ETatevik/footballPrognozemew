<?php 
// isset get id
if(!isset($_GET['id'])) {
    header('location: /admin/pages/teams');
    exit;
} else {
    $id = $_GET['id'];
}
// get page data 
$team = $cnt->selectDataAdmin("f_teams", "WHERE `id`=".$id."");
// check page
if(!isset($team['id'])) {
    header('location: /admin/pages/teams');
    exit;
} else {
    // status switch
    $status = $team['status'];
    if ($status == '0' || $status == '2') {
        $status_checked = '';
    }
    if ($status == '1') {
        $status_checked = 'checked';
    }
    // json 
    $json_league = json_decode($team['f_leagues']);
}
// conf
require_once("layouts/admin/inc/conf.php");?>
<!DOCTYPE html>
<html lang="<?=$cnt->lang?>">

<head>
    <?php include_once("layouts/admin/inc/head.php");?>
    <title>Редактировать <?= $team['title_ru']?></title>
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
                    <li class="breadcrumb-item"><a href="/admin/pages/team">Лиги</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $team['title_ru']?></li>
                </ol>
            </nav>
            <div class="content__inner">
                <header class="content__title">
                    <h1>Редактировать <?= $team['title_ru']?></h1>
                    <small>Лиги</small>
                </header>
                <!-- Page Contents -->
                <div class="card">
                    <div class="card-body">
                        <form data-cmd="updateDataAdmin" data-id="<?=$team['id']?>" data-table="f_teams">
                            <div class="row">
                                <div class="col-md-12">
                                        <label for="">Выбрать лиги</label>
                                        <div class="form-group">
                                            <select name="f_leagues[]" multiple id="" class="select2">
                                                <option value="0">Выбрать лиги</option>
                                                <?php 
                                                   // get json
                                                   foreach($cnt->selectDataAdmin("f_leagues","WHERE `status`='1'","all") as $league){
                                                   // chack exists json in service id
                                                   $selected = '';
                                                   if(in_array($league['id'],$json_league)){
                                                       $selected = 'selected';
                                                   }
                                               ?>
                                               <option value="<?=$league['id']?>" <?=$selected?>><?=$league['title_ru']?></option>
                                               <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                 <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Заголовок RU</label>
                                        <input type="text" name="title_ru" class="form-control" value="<?=$team['title_ru']?>" placeholder="Заголовок RU" required>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                                 <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Заголовок EN</label>
                                        <input type="text" name="title_en" class="form-control" value="<?=$team['title_en']?>" placeholder="Заголовок EN" required>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                                <?php
								// image data
								$type_file = ['jpg','png','gif'];
								$photo_sm_src = 'no_photo.jpg';
								$file_exists = 'new';
								$file_exists_text = '';
								// check logo
								$logo = $cnt->selectDataAdmin("files", "WHERE `table_name`='f_teams' AND `row_id`=".$team['id']." AND `name_used`='logo'");
								if ($logo) {
									if(in_array($logo['type'], $type_file)) {
										// image data
										$path_file = $logo['name'].'.'.$logo['type'];
										$file_exists = 'exists';
										// check file
                                        if (!file_exists("public/img/f_teams/small/$path_file")) {
											$file_exists_text = '<span class="text-red">(not found)</span>';
										} else {
											$photo_sm_src = 'f_teams/small/'.$path_file;
										}
									}
								}
								?>
                                <div class="col-md-12">
									<div class="form-group">
										<h6>Логотип</h6>
										<p>80x80px <?= $file_exists_text?></p>
										<div class="fileinput fileinput-<?=$file_exists?>" data-provides="fileinput">
											<div class="fileinput-preview" data-trigger="fileinput">
												<img src="/public/img/<?=$photo_sm_src?>" width="90px">
											</div>
											<a href="#" class="btn btn-danger ajax-action-confirm btn--raised fileinput-exists" data-dismiss="fileinput" data-cmd="removeFileId" data-table="f_teams" data-id="<?=$logo['id']?>" data-action="hide-row" data-animation="bounceOut">Удалить</a>
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
                                            <input type="checkbox" name="status" class="toggle-switch__checkbox" <?=$status_checked?>>
                                            <i class="toggle-switch__helper"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-<?=$color_theme?> btn--raised">Сохранить</button>
                                </div>
                                <div class="col-8 text-right">
                                    <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="archiveData" data-table="f_teams" data-id="<?=$team['id']?>" data-action="hide-btn" data-anim="bounceOut"><i class="zmdi zmdi-archive"></i>Переместить архив</a>
                                    <a href="#" class="btn btn-danger btn--raised ajax-action-confirm" data-cmd="deleteDataAdmin " data-table="f_teams" data-id="<?=$team['id']?>" data-action="hide-btn" data-anim="bounceOut">Удалить</a>
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
