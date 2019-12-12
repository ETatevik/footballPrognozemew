<?php
// notifications counter
$notif_count = count($cnt->getDataUser("notifications", "WHERE `status`='1'", "all"));
// theme color
$color_theme = 'teal';
// get admin color
$color_admin = $cnt->selectDataAdmin("a_colors_theme", "WHERE `admin_id`=".$cnt->Admin['id']."");
if ($color_admin) {
    // get color
    $color_row = $cnt->selectDataAdmin("a_colors", "WHERE `id`=".$color_admin['color_id']."");
    if($color_row) {
        $color_theme = $color_row['color'];
    }
}
?>