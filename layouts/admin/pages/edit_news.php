<?php 
// isset get id
if(!isset($_GET['id'])) {
    header('location: /admin/pages/news');
    exit;
} else {
    $id = $_GET['id'];
}
// get page data 
$news = $cnt->selectDataAdmin("f_news", "WHERE `id`=".$id."");
// check page
if(!isset($news['id'])) {
    header('location: /admin/pages/news');
    exit;
} else {
    // status switch
    $status = $news['status'];
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
    <title>Редактировать <?= $news['title_ru']?></title>
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
                    <li class="breadcrumb-item"><a href="/admin/pages/news">Новости</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $news['title_ru']?></li>
                </ol>
            </nav>
            <div class="content__inner">
                <header class="content__title">
                    <h1>Редактировать <?= $news['title_ru']?></h1>
                    <small><?= $news['descr_ru']?></small>
                </header>
                <!-- Page Contents -->
                <div class="card">
                    <div class="card-body">
                        <form data-cmd="updateDataAdmin" data-id="<?=$news['id']?>" data-table="f_news">
                            <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Заголовок RU</label>
                                        <input type="text" name="title_ru" class="form-control" value="<?=$news['title_ru']?>" placeholder="Заголовок RU" required>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                                 <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Заголовок EN</label>
                                        <input type="text" name="title_en" class="form-control" value="<?=$news['title_en']?>" placeholder="Заголовок EN" required>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Описание RU</label>
                                        <textarea name="descr_ru" class="form-control html-editor" placeholder="Заголовок EN" required><?=$news['descr_ru']?></textarea>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                                  <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Описание EN</label>
                                        <textarea name="descr_en" class="form-control html-editor"     placeholder="Заголовок EN" required><?=$news['descr_en']?></textarea>
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                                <?php
								// image data
								$type_file = ['jpg','png','gif'];
								$photo_sm_src = 'no_photo.jpg';
								$file_exists = 'new';
								$file_exists_text = '';
								// check image
								$photo = $cnt->selectDataAdmin("files", "WHERE `table_name`='f_news' AND `row_id`=".$news['id']." AND `name_used`='image'");
								if ($photo) {
									if(in_array($photo['type'], $type_file)) {
										// image data
										$path_file = $photo['name'].'.'.$photo['type'];
										$file_exists = 'exists';
										// check file
                                        if (!file_exists("public/img/f_news/small/$path_file")) {
											$file_exists_text = '<span class="text-red">(not found)</span>';
										} else {
											$photo_sm_src = 'f_news/small/'.$path_file;
										}
									}
								}
								?>
                                <div class="col-md-12">
									<div class="form-group">
										<h6>Изображение</h6>
										<p>70x70px / 300x200px <?= $file_exists_text?></p>
										<div class="fileinput fileinput-<?=$file_exists?>" data-provides="fileinput">
											<div class="fileinput-preview" data-trigger="fileinput">
												<img src="/public/img/<?=$photo_sm_src?>" width="90px">
											</div>
											<a href="#" class="btn btn-danger ajax-action-confirm btn--raised fileinput-exists" data-dismiss="fileinput" data-cmd="removeFileId" data-table="f_news" data-id="<?=$photo['id']?>" data-action="hide-row" data-animation="bounceOut">Удалить</a>
											<span class="btn btn-file btn-<?=$color_theme?> btn--raised">
												<span class="fileinput-new">Выбрать</span>
												<span class="fileinput-exists">Редактировать</span>
												<input type="file" name="image[image]" data-x-small="70" data-y-small="70" data-x-large="300" data-y-large="300" data-action-large="crop" accept="image/jpeg">
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
                                    <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="archiveData" data-table="f_news" data-id="<?=$news['id']?>" data-action="hide-btn" data-anim="bounceOut"><i class="zmdi zmdi-archive"></i> Переместить архив</a>
                                    <a href="#" class="btn btn-danger btn--raised ajax-action-confirm" data-cmd="deleteDataAdmin " data-table="f_news" data-id="<?=$news['id']?>" data-action="hide-btn" data-anim="bounceOut">Удалить</a>
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
