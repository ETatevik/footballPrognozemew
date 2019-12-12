<?php
// page
$page = $cnt->selectDataAdmin("a_menu", "WHERE `filename`='social_networks'");
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
                <!-- Page Contents -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add social network</h4>
                        <h6 class="card-subtitle">Add social network with icon, link and description.</h6>
                        <div class="actions">
                            <div class="dropdown actions__item">
                                <i data-toggle="dropdown" class="zmdi zmdi-more-vert"></i>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="" class="dropdown-item">Refresh</a>
                                </div>
                            </div>
                            <div class="actions__item">
                                <i class="zmdi zmdi-plus plus_minus" data-toggle="collapse" data-target="#addSocialNetworks" aria-expanded="false" aria-controls="addSocialNetworks"></i>
                            </div>
                        </div>
                        <div class="collapse" id="addSocialNetworks">
                            <form data-cmd="insertDataAdmin" data-table="social_networks">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="title" class="form-control" placeholder="Social network name" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control textarea-autosize" name="descr" placeholder="Describe social network"></textarea>
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Icon</label>
                                            <input type="text" name="icon" class="form-control" placeholder="Class name only">
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Link</label>
                                            <input type="text" name="link" class="form-control" placeholder="Website link">
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h6>Status</h6>
                                            <p>Inactive / active</p>
                                            <div class="toggle-switch toggle-switch--<?=$color_theme?>">
                                                <input type="checkbox" name="status" class="toggle-switch__checkbox">
                                                <i class="toggle-switch__helper"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-<?=$color_theme?> btn--raised" type="submit">Add</button>
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
                                    <a class="nav-link active" data-toggle="tab" href="#active" role="tab">Active</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#archive" role="tab">Archive</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active fade show" id="active" role="tabpanel">
                                    <table class="table table-hover data-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Link</th>
                                                <th>Status</th>
                                                <th class="actions_admin">Action</th>
                                                <th>Sort</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                // get data
                                                foreach($cnt->selectDataAdmin("social_networks","WHERE `status`!='2'", "all") as $social) {
                                                ?>
                                            <tr id="sort_list_<?=$social['id']?>" class="sortable" data-table="social_networks">
                                                <td><?= $social['id']?></td>
                                                <td><?= $social['title']?></td>
                                                <td>
                                                    <button type="button" class="btn btn-light" data-placement="top" data-toggle="popover" data-trigger="hover" data-html="true" title="Description" data-content="<?=mb_substr(decodeText($social['descr'], true, false), 0, 255).'...'?>">Description</button>
                                                </td>
                                                <td>
                                                    <?php if ($social['link']) {?>
                                                    <a class="btn btn-light btn--raised" href="<?= $social['link']?>" target="_blank"><i class="zmdi zmdi-<?=$social['icon']?>"></i></a>
                                                    <?php } else {?>
                                                    <i class="zmdi zmdi-<?=$social['icon']?>"></i>
                                                    <?php }?>
                                                </td>
                                                <td>
                                                    <?php
                                                        // status not active
                                                        if($social['status'] == '1') {
                                                            echo 'Active';
                                                        } 
                                                        // status archive (2)
                                                        else {
                                                            echo 'inactive';
                                                        }
                                                        ?>
                                                </td>
                                                <td>
                                                    <!-- admin actions -->
                                                    <a href="/admin/pages/edit_social_network?id=<?=$social['id']?>" class="btn btn-light btn--raised" data-toggle="tooltip" data-placement="top" title="Edit"><i class="zmdi zmdi-edit"></i></a>
                                                    <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="archiveData" data-table="social_networks" data-id="<?=$social['id']?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Archive"><i class="zmdi zmdi-archive"></i></a>
                                                    <a href="#" class="btn btn-danger ajax-action-confirm btn--raised" data-cmd="deleteDataAdmin" data-table="social_networks" data-id="<?=$social['id']?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Delete"><i class="zmdi zmdi-delete"></i></a>
                                                </td>
                                                <td>
                                                    <span class="btn btn-light handle btn--raised">
                                                        <span class="result-sort"><i class="zmdi zmdi-swap-vertical"></i></span>
                                                        <?=$social['sort']?>
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
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Link</th>
                                                <th>Status</th>
                                                <th class="actions_admin">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                // get data
                                                foreach($cnt->selectDataAdmin("social_networks","WHERE `status`='2'", "all") as $social) {
                                                ?>
                                            <tr>
                                                <td><?= $social['id']?></td>
                                                <td><?= $social['title']?></td>
                                                <td>
                                                    <button type="button" class="btn btn-light" data-placement="top" data-toggle="popover" data-trigger="hover" data-html="true" title="Description" data-content="<?=mb_substr(decodeText($social['descr'], true, false), 0, 255).'...'?>">Description</button>
                                                </td>
                                                <td>
                                                    <?php if ($social['link']) {?>
                                                    <a class="btn btn-light btn--raised" href="<?= $social['link']?>" target="_blank"><i class="zmdi zmdi-<?=$social['icon']?>"></i></a>
                                                    <?php } else {?>
                                                    <i class="zmdi zmdi-<?=$social['icon']?>"></i>
                                                    <?php }?>
                                                </td>
                                                <td>
                                                    <?php
                                                        // status not active
                                                        if($social['status'] == '1') {
                                                            echo 'Active';
                                                        } 
                                                        // status archive (2)
                                                        else {
                                                            echo 'inactive';
                                                        }
                                                        ?>
                                                </td>
                                                <td>
                                                    <!-- admin actions -->
                                                    <a href="#" class="btn btn-secondary btn--raised ajax-action-confirm" data-cmd="removeArchive" data-table="social_networks" data-id="<?=$social['id']?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Remove from archive"><i class="zmdi zmdi-sign-in"></i></a>
                                                    <a href="#" class="btn btn-danger ajax-action-confirm btn--raised" data-cmd="deleteDataAdmin" data-table="social_networks" data-id="<?=$social['id']?>" data-action="hide-row" data-anim="bounceOut" data-toggle="tooltip" data-placement="top" title="Delete"><i class="zmdi zmdi-delete"></i></a>
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
