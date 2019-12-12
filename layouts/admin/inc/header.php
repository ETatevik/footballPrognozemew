<header class="header">
    <div class="navigation-trigger hidden-xl-up" data-ma-action="aside-open" data-ma-target=".sidebar">
        <div class="navigation-trigger__inner">
            <i class="navigation-trigger__line"></i>
            <i class="navigation-trigger__line"></i>
            <i class="navigation-trigger__line"></i>
        </div>
    </div>
    <div class="header__logo hidden-sm-down">
        <h1>
            <a href="/admin/">PCFootball Admin</a>
            <a href="/" target="_blank" class="website">PCFootball.store</a>
        </h1>
    </div>
    <!-- Other Header Contents -->
    <ul class="top-nav">
        <li class="dropdown top-nav__notifications">
            <a href="" data-toggle="dropdown"<?php if($notif_count > 0) {?> class="top-nav__notify"<?php }?>> 
                <i class="zmdi zmdi-notifications"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu--block">
                <div class="listview listview--hover">
                    <div class="listview__header">
                        Notifications <span><?php if ($notif_count) { echo '<span class="notif_counter">'.$notif_count.'</span>'; }?></span>
                        <?php //if ($notif_count) {?>
                        <div class="actions">
                            <a href="#" class="actions__item zmdi zmdi-check-all clear_notifications" data-animation="bounceOut" data-ma-action="notifications-clear"></a>
                        </div>
                        <?php// }?>
                    </div>
                    <div class="listview__scroll scrollbar-inner" id="notifications__updates">
                        <?php foreach($cnt->getDataUser("notifications","WHERE `status`='1'", "all") as $notify) {?>
                            <a href="/admin/<?=$notify['link']?>" class="listview__item">
                                <div class="listview__content">
                                    <div class="listview__heading"><?=$notify['subject']?></div>
                                    <p><?=$notify['message']?></p>
                                </div>
                            </a>
                        <?php }?>
                    </div>
                    <div class="p-1"></div>
                </div>
            </div>
        </li>
    </ul>
</header>