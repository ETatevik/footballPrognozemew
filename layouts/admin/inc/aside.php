<?php
// admin photo
$a_user_photo_src = 'no-photo.jpg';
// check photo
$row_a_user_photo = $cnt->getDataUser("files", "WHERE `table_name`='a_admins' AND `row_id`=".$cnt->Admin['id']."");
if ($row_a_user_photo) {
    $a_user_photo_name = $row_a_user_photo['name'].'.'.$row_a_user_photo['type'];
    $a_user_photo_date = strtotime($row_a_user_photo['date']);
    // check file
    if (file_exists('public/img/a_admins/small/'.$a_user_photo_name)) {
        $a_user_photo_src = 'a_admins/small/'.$a_user_photo_name;
    }
}
?>
<aside class="sidebar">
    <div class="scrollbar-inner">
        <div class="user">
            <div class="user__info" data-toggle="dropdown">
                <img class="user__img" src="/public/img/<?=$a_user_photo_src?>">
                <div>
                    <div class="user__name"><?=$cnt->Admin['name']?></div>
                    <div class="user__email"><?=$cnt->Admin['email']?></div>
                </div>
            </div>

            <div class="dropdown-menu">
                <a class="dropdown-item" href="/admin/pages/view_profile">View Profile</a>
                <a class="dropdown-item clearStorage" href="?cmd=adminLogout">Logout</a>
            </div>
        </div>
        <ul class="navigation">
            <li class="<?php if ($url->PAGE == 'default') {?>navigation__active<?php }?>"><a href="/admin"><i class="zmdi zmdi-home"></i> Home</a></li>
           <?php
            // get collapse
            foreach($cnt->selectDataAdmin("a_menu","WHERE `status`='1' AND `parent_id`='0' ORDER BY `sort`","all") as $menu){
                // active menu
                $menu_active = '';
                $menu_icon = 'zmdi-plus';
                // check collapse
                if ($menu['collapse'] == 1) {
                    // check active
                    foreach($cnt->selectDataAdmin("a_menu","WHERE `status`='1' AND `collapse`='0' AND `parent_id`=".$menu['id']." ORDER BY `sort`","all") as $sub_menu_parent){
                        if ($url->PAGE == $sub_menu_parent['filename']) {
                            $menu_active = 'navigation__sub--active navigation__sub--toggled';
                            $menu_icon = 'zmdi-minus';
                        }
                    }
                    ?>
                    <li class="navigation__sub <?=$menu_active?>">
                        <a href="#"><i class="zmdi zmdi-<?=$menu['icon']?>"></i> <?=$menu['title']?> <i class="zmdi <?=$menu_icon?> plus-minus"></i></a>
                        <ul>
                            <?php
                            // get sub menus
                            foreach($cnt->selectDataAdmin("a_menu","WHERE `status`='1' AND `collapse`='0' AND `parent_id`=".$menu['id']." ORDER BY `sort`","all") as $sub_menu){
                                // active
                                if ($url->PAGE == $sub_menu['filename']) {
                                    $sub_menu_active = 'class="navigation__active"';
                                } else {
                                    $sub_menu_active = '';
                                }
                                ?>
                                <li <?=$sub_menu_active?>><a href="/admin/pages/<?=$sub_menu['filename']?>"><?=$sub_menu['title']?></a></li>
                            <?php }?>
                        </ul>
                        
                    </li>
                <?php } else {
                    // chck active
                    if ($url->PAGE == $menu['filename']) {
                        $menu_active = 'class="navigation__active"';
                    }
                    ?>
                    <li <?=$menu_active?>>
                        <a href="/admin/pages/<?=$menu['filename']?>"><i class="zmdi zmdi-<?=$menu['icon']?>"></i> <?=$menu['title']?></a>
                    </li>
            <?php }
            }
            ?>
            <!-- Sub Menu ----
            <li class="navigation__sub">
                <a href=""><i class="zmdi zmdi-view-list"></i> Tables</a>
                <ul>
                    <li><a href="html-table.html">HTML Table</a></li>
                    <li><a href="data-table.html">Data Table</a></li>
                </ul>
            </li> -->
        </ul>
    </div>
</aside>