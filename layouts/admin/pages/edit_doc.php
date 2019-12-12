<?php 
// isset get id
if(!isset($_GET['id'])) {
    header('location: /admin/pages/docs');
    exit;
} else {
    $id = $_GET['id'];
}
// check admin 
$docs = $cnt->selectDataAdmin("a_docs", "WHERE `id`=".$id." ", 1);
if(!isset($docs['id'])) {
    header('location: /admin/pages/docs');
    exit;
} else {
    // status switch
    $status = $docs['status'];
    if ($status == '0' || $status == '2') {
        $status_checked = '';
    }
    if ($status == '1') {
        $status_checked = 'checked';
    }
    
    $album_photo_data = $cnt->getDataUser("files", "WHERE `table_name`='a_docs' AND `row_id`='$id'");
    
    $file_path = $album_photo_data['name_original'].'.'.$album_photo_data['type'];
}
// page
$page =  $cnt->selectDataAdmin("a_menu", "WHERE `filename`='docs'");
// conf
require_once("layouts/admin/inc/conf.php");
?>
<!DOCTYPE html>
<html lang="<?=$cnt->lang?>">
    <head>
        <?php include_once("layouts/admin/inc/head.php");?>
        <title>Edit <?= $docs['title']?></title>
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
                        <li class="breadcrumb-item"><a href="/admin/pages/docs"><?= $page['title']?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $docs['title']?></li>
                    </ol>
                </nav>
                <div class="content__inner">
                    <header class="content__title">
                        <h1>Edit <?=$docs['title']?></h1>
                        <small><?=$page['descr']?></small>
                    </header>
                    <!-- Page Contents -->
                    <div class="card">
                        <div class="card-body">
                            <form data-cmd="updateDataAdmin" data-table="a_docs" data-id="<?=$docs['id']?>">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="title" value="<?=$docs['title']?>" class="form-control text-counter" data-min-length="3" data-max-length="100" placeholder="Title" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control html-editor" name="descr" data-html="true" placeholder="Description"><?=$docs['descr']?></textarea>
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                    <?php 
                                    // pdf data
                                    $type_file = ['jpg','png','gif'];
                                    $file_show = '';
                                    $file_exists = 'new';
                                    $file_exists_text = '';
                                    // check pdf
                                    $file = $cnt->selectDataAdmin("files", "WHERE `table_name`='a_docs' AND `row_id`='$id' AND `name_used`='doc'");
                                    if($file) {
                                        if(!in_array($file['type'], $type_file)) {
                                            // pdf data
                                            $file_show = $file['name_original'].'.'.$file['type'];
                                            $file_path = $file['name'].'.'.$file['type'];
                                            $file_exists = 'exists';
                                            // check file
                                            if (!file_exists('public/files/'.$file_path)) {
                                                $file_exists_text = '<span class="text-red">(not found)</span>';
                                            }
                                        }
                                    }
                                    ?>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h6>Doc</h6>
                                            <p>.pdf <?=$file_exists_text?></p>
                                            <div class="fileinput fileinput-<?=$file_exists?>" data-provides="fileinput">
                                                <span class="btn btn-dark btn-file btn--raised btn-<?=$color_theme?>">
                                                    <span class="fileinput-new">Select file</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type="file" name="file[doc]" accept="application/pdf">
                                                </span>
                                                <span class="fileinput-filename"><?=$file_show?></span>
                                                <a href="#" class="fileinput__close fileinput-exists ajax-action-confirm" data-dismiss="fileinput" data-cmd="removeFileId" data-table="a_docs" data-id="<?=$file['id']?>" data-action="hide-row" data-animation="bounceOut">
                                                    <i class="zmdi zmdi-close-circle"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                    // zip data
                                    $type_file = ['jpg','png','gif'];
                                    $file_show = '';
                                    $file_exists = 'new';
                                    $file_exists_text = '';
                                    // check zip
                                    $file = $cnt->selectDataAdmin("files", "WHERE `table_name`='a_docs' AND `row_id`='$id' AND `name_used`='example'");
                                    if($file) {
                                        if(!in_array($file['type'], $type_file)) {
                                            // zip data
                                            $file_show = $file['name_original'].'.'.$file['type'];
                                            $file_path = $file['name'].'.'.$file['type'];
                                            $file_exists = 'exists';
                                            // check file
                                            if (!file_exists('public/files/'.$file_path)) {
                                                $file_exists_text = '<span class="text-red">(not found)</span>';
                                            }
                                        }
                                    }
                                    ?>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h6>Example</h6>
                                            <p>.zip <?=$file_exists_text?></p>
                                            <div class="fileinput fileinput-<?= $file_exists?>" data-provides="fileinput">
                                                <span class="btn btn-dark btn-file btn--raised btn-<?=$color_theme?>">
                                                    <span class="fileinput-new">Select file</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type="file" name="file[example]" accept="application/x-zip-compressed">
                                                </span>
                                                <span class="fileinput-filename"><?=$file_show?></span>
                                                <a href="#" class="fileinput__close fileinput-exists ajax-action-confirm" data-dismiss="fileinput" data-cmd="removeFileId" data-table="a_docs" data-id="<?=$file['id']?>" data-action="hide-row" data-animation="bounceOut">
                                                    <i class="zmdi zmdi-close-circle"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    // icon data
                                    $type_file = ['jpg','png','gif'];
                                    $photo_src = 'no_photo.jpg';
                                    $file_exists = 'new';
                                    $file_exists_text = '';
                                    // check icon
                                    $photo = $cnt->selectDataAdmin("files", "WHERE `table_name`='a_docs' AND `row_id`=".$docs['id']." AND `name_used`='icon'");
                                    if ($photo) {
                                        if(in_array($photo['type'], $type_file)) {
                                            // icon data
                                            $path_file = $photo['name'].'.'.$photo['type'];
                                            $file_exists = 'exists';
                                            // check file
                                            if (!file_exists("public/img/a_docs/small/$path_file")) {
                                                $file_exists_text = '<span class="text-red">(not found)</span>';
                                            } else {
                                                $photo_src = 'a_docs/small/'.$path_file;
                                            }
                                        }
                                    }
                                    ?>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h6>Icon</h6>
                                            <p>167x167px <?=$file_exists_text?></p>
                                            <div class="fileinput fileinput-<?=$file_exists?>" data-provides="fileinput">
                                                <div class="fileinput-preview" data-trigger="fileinput">
                                                    <img src="/public/img/<?=$photo_src?>" width="90px">
                                                </div>
                                                <a href="#" class="btn btn-danger ajax-action-confirm btn--raised fileinput-exists" data-dismiss="fileinput" data-cmd="removeFileId" data-table="a_docs" data-id="<?=$photo['id']?>" data-action="hide-row" data-animation="bounceOut">Remove</a>
                                                <span class="btn btn-file btn-<?=$color_theme?> btn--raised">
                                                    <span class="fileinput-new">Select</span>
                                                    <span class="fileinput-exists">Edit</span>
                                                    <input type="file" name="image[icon]" data-x-small="167" data-y-small="167" data-x-large="600" data-y-large="600" accept="image/x-png">
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    // image data
                                    $type_file = ['jpg','png','gif'];
                                    $photo_src = 'no_photo.jpg';
                                    $file_exists = 'new';
                                    $file_exists_text = '';
                                    // check image
                                    $photo = $cnt->selectDataAdmin("files", "WHERE `table_name`='a_docs' AND `row_id`=".$docs['id']." AND `name_used`='image'");
                                    if ($photo) {
                                        if(in_array($photo['type'], $type_file)) {
                                            // image data
                                            $path_file = $photo['name'].'.'.$photo['type'];
                                            $file_exists = 'exists';
                                            // check file
                                            if (!file_exists("public/img/a_docs/small/$path_file")) {
                                                $file_exists_text = '<span class="text-red">(not found)</span>';
                                            } else {
                                                $photo_src = 'a_docs/small/'.$path_file;
                                            }
                                        }
                                    }
                                    ?>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h6>Image</h6>
                                            <p>161x161px / 900px <?= $file_exists_text?></p>
                                            <div class="fileinput fileinput-<?=$file_exists?>" data-provides="fileinput">
                                                <div class="fileinput-preview" data-trigger="fileinput">
                                                    <img src="/public/img/<?=$photo_src?>" width="90px">
                                                </div>
                                                <a href="#" class="btn btn-danger ajax-action-confirm btn--raised fileinput-exists" data-dismiss="fileinput" data-cmd="removeFileId" data-table="a_docs" data-id="<?=$photo['id']?>" data-action="hide-row" data-animation="bounceOut">Remove</a>
                                                <span class="btn btn-file btn-<?=$color_theme?> btn--raised">
                                                    <span class="fileinput-new">Select</span>
                                                    <span class="fileinput-exists">Edit</span>
                                                    <input type="file" name="image[image]" data-x-small="161" data-y-small="161" data-x-large="600" data-y-large="600" accept="image/jpeg, image/x-png, image/gif">
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h6>Status</h6>
                                            <p>Inactive / active</p>
                                            <div class="toggle-switch toggle-switch--<?=$color_theme?>">
                                                <input type="checkbox" name="status" class="toggle-switch__checkbox" <?=$status_checked?>>
                                                <i class="toggle-switch__helper"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <button type="submit" class="btn btn-<?=$color_theme?> btn--raised">Save</button>
                                    </div>
                                    <div class="col-8 text-right">
                                        <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="archiveData" data-table="a_docs" data-id="<?=$docs['id']?>" data-action="hide-btn" data-anim="bounceOut"><i class="zmdi zmdi-archive"></i> Move the archive</a>
                                        <a href="#" class="btn btn-danger ajax-action-confirm btn--raised" data-cmd="deleteDataAdmin" data-table="a_docs" data-id="<?=$docs['id']?>" data-action="hide-btn" data-anim="bounceOut">Delete</a>
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
