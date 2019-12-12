<?php
class Admin extends User {

    public $Admin;

    public function __construct() {
            parent::__construct();
            // check admin session
            if(isset($_SESSION['admin_id'])) {
              $Admin = $this->Admin = $this->selectDataAdmin("a_admins", "WHERE `id`=".$_SESSION['admin_id']." AND `status`='1'", 1);
              if(empty($Admin['id'])) {
                unset($_SESSION['admin_id']);
                unset($_SESSION['admin_email']);
            }
        }
    }

    /* Admin data */
    public function adminLogout() {
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_email']);
    }
    public function adminDataEdit() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        // check required values
        if (empty($name) || empty($email)) {
            $this->responseJson(["type"=>'danger', "title"=>'Error!', "message"=>'Please, fill out the fields.']);
            exit;
        }
        // validate email
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $this->responseJson(["type"=>'danger', "title"=>'Email error!', "message"=>'Incorrect email address.']);
            exit;
        }
        // password
        if (isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['password_confirm']) && !empty($_POST['password_confirm'])) {
            $pass = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];
            // confirm
            if ($pass == $password_confirm) {
                // update password
                $pass_hash = hash('sha512', $pass);
                $sql_update = $this->con->prepare("UPDATE `a_admins` SET `password`='$pass_hash' WHERE `id`=?");
                $sql_update->execute(array($id));
            } else {
                $this->responseJson(["type"=>'danger', "title"=>'Password error!', "message"=>'Incorrect password confirmation.']);
                exit;
            }
        }
        // permission
        if (isset($_POST['perm_type']) && !empty($_POST['perm_type'])) {
            $permission = $_POST['perm_type'];
            $sql_update_perm = $this->con->prepare("UPDATE `a_admins` SET `perm_type`='$permission' WHERE `id`=?");
            $sql_update_perm->execute(array($id));
        }
        // status
        if (isset($_POST['status']) && !empty($_POST['status'])) {
            $status = 1;
        } else {
            $status = 2;
        }
        // update data
        $sql_update = $this->con->prepare("UPDATE `a_admins` SET `name`='$name', `email`='$email', `phone`='$phone', `address`='$address', `status`='$status' WHERE `id`=?");
        $sql_update->execute(array($id));
        // update image 
        if(isset($_FILES['image'])){
            if($_FILES['image']['size'] > 0) {
                $this->editImage(/*group*/"a_admins", /*parent*/"$id", /*type*/"jpg", /*action-small*/"crop", /*action-large*/"crop", /*small-width*/"200", /*small-height*/"200", /*large-width*/"600", /*large-height*/"600");
            }
        }
        // if update
        if ($sql_update) {
            $this->responseJson(["type"=>'success', "title"=>'Saved!', "message"=>'Your data was successfully changed.']);
        } else {
            $this->responseJson(["type"=>'danger', "title"=>'Error!', "message"=>'Please, try again.']);
        }
    }

    /* Admin functions */
    public function selectDataAdmin($table = '',$query = '', $count = 1) {
        $sql = $this->con->prepare("SELECT * FROM `$table` $query");
        $sql->execute();
        // return row
        if($count == 1) {
            return $sql->fetch();
        }
        // return rows
        else if ($count == 'all') {
            return $sql->fetchAll();  
        }
    }
    public function insertDataAdmin() {
        // get data
        $fieldString= '';
        $valueString= '';
        $table = $_POST['table'];
        unset($_POST['table']);
        // images
        $x_small = ''; $y_small = ''; $action_small = 'crop';
        $x_large = ''; $y_large = ''; $action_large = 'resizeToWidth';
        $type = 'jpg'; $watermark = '';
        // x-small
        if (isset($_POST['x-small'])) {
            if(!empty($_POST['x-small'])) {
                $x_small = $_POST['x-small'];
            }
            unset($_POST['x-small']);
        }
        // y-small
        if (isset($_POST['y-small'])) {
            if(!empty($_POST['y-small'])) {
                $y_small = $_POST['y-small'];
            }
            unset($_POST['y-small']);
        }
        // action small
        if (isset($_POST['action-small'])) {
            if(!empty($_POST['action-small'])) {
                $action_small = $_POST['action-small'];
            }
            unset($_POST['action-small']);
        }
        // x-large
        if (isset($_POST['x-large'])) {
            if(!empty($_POST['x-large'])){
                $x_large = $_POST['x-large'];
            }
            unset($_POST['x-large']);
        }
        // y-large
        if (isset($_POST['y-large'])) {
            if(!empty($_POST['y-large'])){
                $y_large = $_POST['y-large'];
            }
            unset($_POST['y-large']);
        }
        // action large
        if (isset($_POST['action-large'])) {
            if(!empty($_POST['action-large'])) {
                $action_large = $_POST['action-large'];
            }
            unset($_POST['action-large']);
        }
        // watermark
        if (isset($_POST['watermark'])) {
            if(!empty($_POST['watermark'])) {
                $watermark = $_POST['watermark'];
            }
            unset($_POST['watermark']);
        }
        // image
        if (isset($_POST['image'])) {
            unset($_POST['image']);
        }
        // file
        if (isset($_POST['file'])) {
            unset($_POST['file']);
        }
        // get post data
        foreach($_POST as $field => $value) {
            $fieldString .= '`'.$field.'`,';
            $valueString .= '?,';
            if(is_array($value)){
                $new_array = [];
                foreach($value as $col_id => $col_val){
                    if($col_val != ''){
                        $new_array[$col_id] = $col_val;
                    }
                }
                $value = json_encode($new_array);
            }
            $values[] = $value;
        }
        // remove last comma
        $fieldString = rtrim($fieldString,',');
        $valueString = rtrim($valueString,',');
        // insert data
        $sql_insert = $this->con->prepare("INSERT INTO {$table} ({$fieldString}) VALUES ({$valueString})");
        $sql_insert->execute($values);
        $last_insert_id = $this->con->lastInsertId();

        
        // file
        if(isset($_FILES['file'])) {
            // any file
            if($_FILES['file']['size'] > 0) {
                $this->addFile(/*table*/"$table", /*row_id*/"$last_insert_id");
            }
        }
        // image
        if(isset($_FILES['image'])){
            if($_FILES['image']['size'] > 0) {
                // small & large
                $this->addImage(/*table*/"$table", /*row*/"$last_insert_id", /*type*/"$type", /*action-small*/"$action_small", /*action-large*/"$action_large", /*small-width*/"$x_small", /*small-height*/"$y_small", /*large-width*/"$x_large", /*large-height*/"$y_large", /*watermark*/"$watermark");  
            }     
        }
        // result
        if($sql_insert){
            // action log for admins
            $admin_id_log = $_SESSION['admin_id'];
            $log = $this->con->prepare("INSERT INTO `log_actions` (`admin_id`, `table_name`, `row_id`, `action`, `color`) VALUES (?, ?, ?, ?, ?)");
            $log->execute(array($admin_id_log, $table, $last_insert_id, 'insert', 'green'));
            // response
            $this->responseJson(["type"=>"success", "title"=>"Well Done!", "message"=>"Yo data is added!", "reload"=>"0"]);
        } else {
            $this->responseJson(["type"=>"danger", "title"=>"Error!", "message"=>"Please, try again.", "reload"=>"0"]);
        }
    }
    public function updateDataAdmin() {
        // dropzone
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $table = $_GET['table'];
            // files
            $x_small = ''; $y_small = ''; $action_small = 'crop';
            $x_large = ''; $y_large = ''; $action_large = 'resizeToWidth';
            $type = 'jpg'; $watermark = '';
            // x-small
            if (isset($_GET['x-small'])) {
                if(!empty($_GET['x-small'])) {
                    $x_small = $_GET['x-small'];
                }
                unset($_GET['x-small']);
            }
            // y-small
            if (isset($_GET['y-small'])) {
                if(!empty($_GET['y-small'])) {
                    $y_small = $_GET['y-small'];
                }
                unset($_GET['y-small']);
            }
            // action small
            if (isset($_GET['action-small'])) {
                if(!empty($_GET['action-small'])) {
                    $action_small = $_GET['action-small'];
                }
                unset($_GET['action-small']);
            }
            // x-large
            if (isset($_GET['x-large'])) {
                if(!empty($_GET['x-large'])){
                    $x_large = $_GET['x-large'];
                }
                unset($_GET['x-large']);
            }
            // y-large
            if (isset($_GET['y-large'])) {
                if(!empty($_GET['y-large'])){
                    $y_large = $_GET['y-large'];
                }
                unset($_GET['y-large']);
            }
            // action large
            if (isset($_GET['action-large'])) {
                if(!empty($_GET['action-large'])) {
                    $action_large = $_GET['action-large'];
                }
                unset($_GET['action-large']);
            }
            // watermark
            if (isset($_GET['watermark'])) {
                if(!empty($_GET['watermark'])) {
                    $watermark = $_GET['watermark'];
                }
                unset($_GET['watermark']);
            }
            // limit
            if (isset($_GET['limit'])) {
                if(!empty($_GET['limit'])) {
                    $limit = intval($_GET['limit']);
                }
                unset($_GET['limit']);
            }
        }
        // all
        else {
            $id = $_POST['id'];
        }
        // dropzone
        $photo_count = count($this->selectDataAdmin("files", "WHERE `table_name`='estate' AND `row_id`=".$id."", "all"));
        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0 && isset($_GET['id'])) {
            for($i = 0; $i < count($_FILES); $i++) {
                if($photo_count < $limit){
                    $this->addImage(/*table*/"$table", /*row_id*/"$id", /*type*/"$type", /*action-small*/"$action_small", /*action-large*/"$action_large", /*small-width*/"$x_small", /*small-height*/"$y_small", /*large-width*/"$x_large", /*large-height*/"$y_large", /*watermark*/"$watermark");
                }
                else{
                    $this->responseJson(["type"=>"danger", "title"=>"error", "message"=>"error", "reload"=>"0"]);
                }

            }
            exit;
        }
        // all
        $table = $_POST['table'];
        unset($_POST['table']);
        unset($_POST['id']);
        $fieldString= '';
        // images
        $x_small = ''; $y_small = ''; $action_small = 'crop';
        $x_large = ''; $y_large = ''; $action_large = 'resizeToWidth';
        $type = 'jpg'; $watermark = '';
        // x-small
        if (isset($_POST['x-small'])) {
            if(!empty($_POST['x-small'])) {
                $x_small = $_POST['x-small'];
            }
            unset($_POST['x-small']);
        }
        // y-small
        if (isset($_POST['y-small'])) {
            if(!empty($_POST['y-small'])) {
                $y_small = $_POST['y-small'];
            }
            unset($_POST['y-small']);
        }
        // action small
        if (isset($_POST['action-small'])) {
            if(!empty($_POST['action-small'])) {
                $action_small = $_POST['action-small'];
            }
            unset($_POST['action-small']);
        }
        // x-large
        if (isset($_POST['x-large'])) {
            if(!empty($_POST['x-large'])){
                $x_large = $_POST['x-large'];
            }
            unset($_POST['x-large']);
        }
        // y-large
        if (isset($_POST['y-large'])) {
            if(!empty($_POST['y-large'])){
                $y_large = $_POST['y-large'];
            }
            unset($_POST['y-large']);
        }
        // action large
        if (isset($_POST['action-large'])) {
            if(!empty($_POST['action-large'])) {
                $action_large = $_POST['action-large'];
            }
            unset($_POST['action-large']);
        }
        // watermark
        if (isset($_POST['watermark'])) {
            if(!empty($_POST['watermark'])) {
                $watermark = $_POST['watermark'];
            }
            unset($_POST['watermark']);
        }
        // image
        if (isset($_POST['image'])) {
            unset($_POST['image']);
        }
        // file
        if (isset($_POST['file'])) {
            unset($_POST['file']);
        }
        // get post data
        foreach($_POST as $field => $value) {
            $fieldString .= ' `'.$field.'` = ?,';
            if(is_array($value)){
               $new_array = [];
               foreach($value as $col_id => $col_val){
                   if($col_val != ''){
                       $new_array[$col_id] = $col_val;
                   }
               }
               $value = json_encode($new_array);
           }
           $values[] = $value;
        }
        // remove last comma
        $fieldString = trim($fieldString);
        $fieldString = rtrim($fieldString,',');
        // insert data
        $sql_update = $this->con->prepare("UPDATE {$table} SET {$fieldString} WHERE `id`='$id' ");
        $sql_update->execute($values);


        // image
        if(isset($_FILES['image'])){
            if($_FILES['image']['size'] > 0) {
                // small & large
                $this->editImage(/*table*/"$table", /*row*/"$id", /*type*/"$type", /*action-small*/"$action_small", /*action-large*/"$action_large", /*small-width*/"$x_small", /*small-height*/"$y_small", /*large-width*/"$x_large", /*large-height*/"$y_large", /*watermark*/"$watermark");
            }   
        }
        // upload file
        if(isset($_FILES['file'])) {
            // any file
            if($_FILES['file']['size'] > 0) {
                $this->editFile(/*table*/"$table", /*row_id*/"$id");
            }
        }
        // result
        if($sql_update){
            // action log for admins
            $admin_id = $_SESSION['admin_id'];
            $log = $this->con->prepare("INSERT INTO `log_actions` (`admin_id`, `table_name`, `row_id`, `action`, `color`) VALUES (?, ?, ?, ?, ?)");
            $log->execute(array($admin_id, $table, $id, 'update', 'blue'));
            // response
            $this->responseJson(["type"=>"success","title"=>"Well Done!!","message"=>"Your data is added!","reload"=>"0"]);
        } else {
            $this->responseJson(["type"=>"danger","title"=>"Error!!","message"=>"Please, try again.!","reload"=>"0"]);
        }
    }
    public function deleteDataAdmin() {
        // get data
        $table = $_POST['table'];
        $table_2 = '';
        $row_id = $_POST['id'];


        // get photo
        $sql_photo = $this->con->prepare("SELECT * FROM `files` WHERE `table_name`=? AND `row_id`=?");
        $sql_photo->execute(array($table, $row_id));
        // if exists
        if ($sql_photo->rowCount()) {
            $this->removeFiles(/*table*/"$table", /*row*/"$row_id");
        }
        // albums
        if($table == 'albums') {
            $table_2 = 'gallery';         
        }
        // get photo gallery
        $sql_photo = $this->con->prepare("SELECT * FROM `files` WHERE `table_name`=? AND `row_id`=?");
        $sql_photo->execute(array($table_2, $row_id));
        // if exists
        if ($sql_photo->rowCount()) {
            $this->removeFiles(/*table*/"$table_2", /*row*/"$row_id");
        }
        // delete
        $delete = $this->con->prepare("DELETE FROM `$table` WHERE `id`=?");
        $delete->execute(array($row_id));
        // result   
        if($delete) {
            // action log for admins
            $admin_id_log = $_SESSION['admin_id'];
            $log = $this->con->prepare("INSERT INTO `log_actions` (`admin_id`, `table_name`, `row_id`, `action`, `color`) VALUES (?, ?, ?, ?, ?)");
            $log->execute(array($admin_id_log, $table, $row_id, 'delete', 'red'));
            // response
            $this->responseJson(["type"=>'success', "title"=>'Well done!', "message"=>'Successfully was deleted.', "reload"=>'0']);
        } else {
            // error
            $this->responseJson(["type"=>'danger', "title"=>'Error!', "message"=>'Please, try again.', "reload"=>'0']);
        }
    }
    
    /* Archive */
    public function archiveData() {
        // get data
        $table = $_POST['table'];
        $id = $_POST['id'];
        // update data
        $sql_update = $this->con->prepare("UPDATE `$table` SET `status`='2' WHERE `id`=?");
        $sql_update->execute(array($id));


        // result
        if($sql_update) {
            // action log for admins
            $admin_id_log = $_SESSION['admin_id'];
            $log = $this->con->prepare("INSERT INTO `log_actions` (`admin_id`, `table_name`, `row_id`, `action`, `color`) VALUES (?, ?, ?, ?, ?)");
            $log->execute(array($admin_id_log, $table, $id, 'archive','gray'));
            // response
            $this->responseJson(["type"=>'success', "title"=>'Well done!', "message"=>'Successfully moved to archive.', "reload"=>'0']);
        } else {
            // error
            $this->responseJson(["type"=>'danger', "title"=>'Error!', "message"=>'Please, try again.', "reload"=>'0']);
        }
    }
    public function removeArchive() {
        // get data
        $table = $_POST['table'];
        $id = $_POST['id'];
        // update data
        $sql_update = $this->con->prepare("UPDATE `$table` SET `status`='1' WHERE `id`=?");
        $sql_update->execute(array($id));


        // result
        if($sql_update) {
            // action log for admins
            $admin_id_log = $_SESSION['admin_id'];
            $log = $this->con->prepare("INSERT INTO `log_actions` (`admin_id`, `table_name`, `row_id`, `action`, `color`) VALUES (?, ?, ?, ?, ?)");
            $log->execute(array($admin_id_log, $table, $id, 'remove from archive','gray'));
            // response
            $this->responseJson(["type"=>'success', "title"=>'Well done!', "message"=>'Successfully removed from archive.', "reload"=>'0']);
        } else {
            // error
            $this->responseJson(["type"=>'danger', "title"=>'Error!', "message"=>'Please try again.', "reload"=>'0']);
        }
    }
    
    /* Images */
    public function addImage($table = '', $row_id = '', $type = '', $action_small = 'crop', $action_large = 'resizeToWidth', $x_small = '', $y_small = '', $x_large = '', $y_large = '', $watermark = '') {
        /* Settings */
        // $table     /*  directory  name                     */
        // $row_id    /*  Form data insert (lastInsertId) id  */
        // $type      /*  Image type (.jpg, .png , etc...)    */
        // $action    /*  Image 'resize' and 'crop' action    */
        // $x_small   /*  Small image width                   */
        // $y_small   /*  Small image height                  */
        // $x_large   /*  Large image width                   */
        // $y_large   /*  Small image height                  */
        // $watermark /*  image add coordinates               */
        
        /* Not dropzone */
        if($table != 'gallery') {
            // if more files
            if(is_array($_FILES['image']['name'])) {
                $image = new SimpleImage();
                // get files from array
                foreach($_FILES['image']['name'] as $key => $value) {
                    // check file
                    if($value != '') {
                        $img_path = $_FILES['image']['name'];
                        $name_original = pathinfo($img_path[$key], PATHINFO_FILENAME);
                        $type = pathinfo($img_path[$key], PATHINFO_EXTENSION);
                        $img_path_name = md5($name_original.'_'.round(microtime(true) * 1000));
                        $img_name = $img_path_name;
                        $img_size = $_FILES['image']['size'][$key];
                        $img_preview = $img_name.'.'.$type;
                        $img_tmp_loc = $_FILES['image']['tmp_name'];
                        // .png, .gif
                        if($type != 'jpg') {
                            $image->load($img_tmp_loc[$key]);                
                            // small
                            if($x_small != '' && $image->getWidth() == $x_small && $image->getHeight() == $y_small){
                                $upload = move_uploaded_file($img_tmp_loc[$key], "public/img/$table/small/$img_preview");
                                // result
                                if(!$upload){
                                    $this->responseJson(["type"=>"danger", "title"=>"Error!", "message"=>"Image not uploaded.", "reload"=>"0"]);
                                    exit;
                                }
                            } else {
                                $this->responseJson(["type"=>"warning", "title"=>"Warning!", "message"=>"Your file size is not ".$x_small."x".$y_small."px", "reload"=>"0"]);
                                exit;
                            }
                        }
                        // ,jpg
                        else{
                            // watermark link and setting
                            $lg_watermark_url = 'public/img/watermark_large.png';
                            $sm_watermark_url = 'public/img/watermark_small.png';
                            // bottom & right 
                            $sm_watermark_x = '0';
                            $sm_watermark_y = '0';
                            $lg_watermark_x = '90';
                            $lg_watermark_y = '90';
                            /* resizeToWidth */
                            // small
                            if($action_small == 'resizeToWidth') {
                                if($x_small != '') {
                                    $image->load($img_tmp_loc[$key]);
                                    $image->resizeToWidth($x_small);
                                    // watermark
                                    //if ($watermark != '') {
                                    //  $image->watermark($sm_watermark_x, $sm_watermark_y, $sm_watermark_url);
                                    //}
                                    // save
                                    $image->save("public/img/$table/small/$img_preview");
                                }
                            }
                            // large
                            if($action_large == 'resizeToWidth') {
                                if ($x_large != '') {
                                    $image->load($img_tmp_loc[$key]);
                                    $image->resizeToWidth($x_large);
                                    // watermark
                                    if ($watermark != '') {
                                        $image->watermark($lg_watermark_x, $lg_watermark_y, $lg_watermark_url);
                                    }
                                    // save
                                    $image->save("public/img/$table/large/$img_preview");
                                }

                            }
                            /* crop */
                            // small
                            if ($action_small == 'crop') {
                                if($y_small != '' && $x_small != '') {
                                    $image->load($img_tmp_loc[$key]);
                                    $image->crop($x_small, $y_small);
                                    // watermark
                                    //if ($watermark != '') {
                                    // $image->watermark($sm_watermark_x, $sm_watermark_y, $sm_watermark_url);
                                    //}
                                    // save
                                    $image->save("public/img/$table/small/$img_preview");
                                }
                            }
                            // large
                            if ($action_large == 'crop') {
                                if ($y_large != '' && $x_large != '') {
                                    $image->load($img_tmp_loc[$key]);
                                    $image->crop($x_large, $y_large);
                                    // watermark
                                    if ($watermark != '') {
                                        $image->watermark($lg_watermark_x, $lg_watermark_y, $lg_watermark_url);
                                    }
                                    // save
                                    $image->save("public/img/$table/large/$img_preview");
                                }
                            }
                        }
                        // insert
                        $insert = $this->con->prepare("INSERT INTO `files` (`table_name`, `row_id`, `name_original`, `name_used`, `name`, `size`, `type`) VALUES (?, ?, ?, ?, ?, ?, ?)");
                        $insert->execute(array($table, $row_id, $name_original,  $key, $img_name, $img_size, $type));
                        // result
                        if (!$insert) {
                            $this->responseJson(["type"=>"danger", "title"=>"Error!", "message"=>"not uploaded data.", "reload"=>"0"]);
                            exit;
                        }

                    }
                }
            }
        }
        // dropzone
        else {
            $image = new SimpleImage();
            $img_size = $_FILES['image']['size'];
            $img_path = $_FILES['image']['name'];
            $name_original = pathinfo($img_path, PATHINFO_FILENAME);
            $img_ext = pathinfo($img_path, PATHINFO_EXTENSION);
            $img_name = round(microtime(true) * 1000);
            $img_preview = $img_name.'.'.$img_ext;
            $img_tmp_loc = $_FILES['image']['tmp_name'];
            $img_type = exif_imagetype($img_tmp_loc);
            // .png, .gif
            if($img_type != 2) {
                $image->load($img_tmp_loc);                
                // small
                if($x_small != '' && $image->getWidth() == $x_small && $image->getHeight() == $y_small){
                    $upload = move_uploaded_file($img_tmp_loc, "public/img/$table/small/$img_preview");
                    // result
                    if(!$upload){
                        $this->responseJson(["type"=>"danger", "title"=>"Error!", "message"=>"Image not uploaded.", "reload"=>"0"]);
                        exit;
                    }
                } else {
                    $this->responseJson(["type"=>"warning", "title"=>"Warning!", "message"=>"Your file size is not ".$x_small."x".$y_small."px", "reload"=>"0"]);
                    exit;
                }
                // type
                $type = $img_ext;
            }
            // .jpg
            else {
                // watermark link and setting
                $lg_watermark_url = 'public/img/watermark_large.png';
                $sm_watermark_url = 'public/img/watermark_small.png';
                // bottom & right 
                $sm_watermark_x = '0';
                $sm_watermark_y = '0';
                $lg_watermark_x = '90';
                $lg_watermark_y = '90';
                /* resizeToWidth */
                // small
                if($action_small == 'resizeToWidth') {
                    if($x_small != '') {
                        $image->load($_FILES['image']['tmp_name']);
                        $image->resizeToWidth($x_small);
                        // save
                        $image->save("public/img/$table/small/$img_preview");
                    }
                }
                // large
                if($action_large == 'resizeToWidth') {
                    if ($x_large != '') {
                        $image->load($_FILES['image']['tmp_name']);
                        $image->resizeToWidth($x_large);
                        // watermark
                        if ($watermark != '') {
                            $image->watermark($lg_watermark_x, $lg_watermark_y, $lg_watermark_url);
                        }
                        // save
                        $image->save("public/img/$table/large/$img_preview");
                    }

                }
                /* crop */
                // small
                if ($action_small == 'crop') {
                    if($y_small != '' && $x_small != '') {
                        $image->load($_FILES['image']['tmp_name']);
                        $image->crop($x_small, $y_small);
                        // save
                        $image->save("public/img/$table/small/$img_preview");
                    }
                }
                // large
                if ($action_large == 'crop') {
                    if ($y_large != '' && $x_large != '') {
                        $image->load($_FILES['image']['tmp_name']);
                        $image->crop($x_large, $y_large);
                        // watermark
                        if ($watermark != '') {
                            $image->watermark($lg_watermark_x, $lg_watermark_y, $lg_watermark_url);
                        }
                        // save
                        $image->save("public/img/$table/large/$img_preview");
                    }
                }
            }
            // insert
            $insert = $this->con->prepare("INSERT INTO `files` (`table_name`, `row_id`, `name_original`, `name`, `size`, `type`) VALUES (?, ?, ?, ?, ?, ?)");
            $insert->execute(array($table, $row_id, $name_original, $img_name, $img_size, $type));
            // result
            if (!$insert) {
                $this->responseJson(["type"=>"danger", "title"=>"Error!", "message"=>"Not inserted image data.", "reload"=>"0"]);
                exit;
            }
        }
    }
    public function editImage($table = '', $row_id = '', $type = '', $action_small = 'crop', $action_large = 'resizeToWidth', $x_small = '', $y_small = '', $x_large = '', $y_large = '', $watermark = '') {
        /* Settings */
        // $table     /*  directory  name                     */
        // $row_id    /*  Form data insert (lastInsertId) id  */
        // $type      /*  Image type (.jpg, .png , etc...)    */
        // $action    /*  Image 'resize' and 'crop' action    */
        // $x_small   /*  Small image width                   */
        // $y_small   /*  Small image height                  */
        // $x_large   /*  Large image width                   */
        // $y_large   /*  Small image height                  */
        // $watermark /*  image add coordinates               */

        // if more files
        if(is_array($_FILES['image']['name'])) {
            $image = new SimpleImage();
            // get file in key
            foreach($_FILES['image']['name'] as $key => $value) {
                // check file
                if($value != '') {
                    // check data
                    $select = $this->con->prepare("SELECT * FROM `files` WHERE `table_name`=? AND `row_id`=?AND `name_used`=?");
                    $select->execute(array($table, $row_id, $key));
                    if($select->rowCount()){
                        $file_arr = $select->fetch();
                        $old_img_name = $file_arr['name'].'.'.$file_arr['type'];
                        $img_path = $_FILES['image']['name'];
                        $name_original = pathinfo($img_path[$key], PATHINFO_FILENAME);
                        $type = pathinfo($img_path[$key], PATHINFO_EXTENSION);
                        $img_path_name = $name = md5($name_original.'_'.round(microtime(true) * 1000));
                        $img_name = $img_path_name;
                        $img_size = $_FILES['image']['size'][$key];
                        $img_preview = $img_name.'.'.$type;
                        $img_tmp_loc = $_FILES['image']['tmp_name'];
                        // .png, .gif
                        if($type != 'jpg') {
                            $image->load($img_tmp_loc[$key]);                
                            // small
                            if($x_small != '' && $image->getWidth() == $x_small && $image->getHeight() == $y_small){
                                // small
                                if(file_exists("public/img/$table/small/$old_img_name")){
                                    unlink("public/img/$table/small/$old_img_name");
                                }
                                // upload
                                $upload = move_uploaded_file($img_tmp_loc[$key], "public/img/$table/small/$img_preview");
                                // result
                                if(!$upload){
                                    $this->responseJson(["type"=>"danger", "title"=>"Error!", "message"=>"Image not uploaded.", "reload"=>"0"]);
                                    exit;
                                }
                            } else {
                                //  file size is not coincide
                                $this->responseJson(["type"=>"warning", "title"=>"Warning!", "message"=>"Your file size is not ".$x_small."x".$y_small."px", "reload"=>"0"]);
                                exit;
                            }
                            // type
                            $type = $type;
                        }
                        // .jpg
                        else {
                            // small
                            if(file_exists("public/img/$table/small/$old_img_name")){
                                unlink("public/img/$table/small/$old_img_name");
                            }
                            // large
                            if(file_exists("public/img/$table/large/$old_img_name")){
                                unlink("public/img/$table/large/$old_img_name");
                            }
                            // watermark link and setting
                            $lg_watermark_url = 'public/img/watermark_large.png';
                            $sm_watermark_url = 'public/img/watermark_small.png';
                            // bottom & right 
                            $sm_watermark_x = '0';
                            $sm_watermark_y = '0';
                            $lg_watermark_x = '0';
                            $lg_watermark_y = '0';
                            // check file
                            if ($_FILES && $_FILES['image']['size'] > 0) {
                                /* resizeToWidth */
                                // Small image
                                if($action_small == 'resizeToWidth') {
                                    if($x_small != '') {
                                        $image->load($img_tmp_loc[$key]);
                                        $image->resizeToWidth($x_small);
                                        // save
                                        $image->save("public/img/$table/small/$img_preview");
                                    }
                                }
                                // Large image
                                if($action_large == 'resizeToWidth') {
                                    if ($x_large != '') {
                                        $image->load($img_tmp_loc[$key]);
                                        $image->resizeToWidth($x_large);
                                        // watermark
                                        if ($watermark != '') {
                                            $image->watermark($lg_watermark_x, $lg_watermark_y, $lg_watermark_url);
                                        }
                                        // save
                                        $image->save("public/img/$table/large/$img_preview");
                                    }
                                }
                                /* crop */
                                // Small image
                                if ($action_small == 'crop') {
                                    if($y_small != '' && $x_small != '') {
                                        $image->load($img_tmp_loc[$key]);
                                        $image->crop($x_small, $y_small);
                                        // save
                                        $image->save("public/img/$table/small/$img_preview");
                                    }
                                }
                                // Large image
                                if ($action_large == 'crop') {
                                    if ($y_large != '' && $x_large != '') {
                                        $image->load($img_tmp_loc[$key]);
                                        $image->crop($x_large, $y_large);
                                        // watermark
                                        if ($watermark != '') {
                                            $image->watermark($lg_watermark_x, $lg_watermark_y, $lg_watermark_url);
                                        }
                                        // save
                                        $image->save("public/img/$table/large/$img_preview");
                                    }
                                }
                            }
                        }
                        // update
                        $update = $this->con->prepare("UPDATE `files` SET `name_original`=?, `name_used`=?, `name`=?, `type`=?, `size`=?, `date`=now() WHERE `id`='".$file_arr['id']."'");
                        $update->execute(array($name_original, $key, $img_name, $type, $img_size));
                        // check update 
                        if (!$update) {
                            $this->responseJson(["type"=>"danger", "title"=>"Error!", "message"=>"Not inserted image data.", "reload"=>"0"]);
                            exit;
                        }
                    }
                    // if not exists
                    else {
                        $this->addImage($table, $row_id, $type, $action_small, $action_large, $x_small, $y_small , $x_large , $y_large, $watermark);
                    }
                }
            }

        }
        // one file
        else {
            // check data
            $select = $this->con->prepare("SELECT * FROM `files` WHERE `table_name`=? AND `row_id`=?");
            $select->execute(array($table, $row_id));
            if ($select->rowCount()) {
                $photo = $select->fetch();
                $old_img_name = $photo['name'].'.'.$photo['type'];
                $image = new SimpleImage();
                $img_size = $_FILES['image']['size'];
                $img_path = $_FILES['image']['name'];
                $type = pathinfo($img_path, PATHINFO_EXTENSION);
                $img_name = round(microtime(true) * 1000);
                $img_preview = $img_name.'.'.$img_ext;
                $img_tmp_loc = $_FILES['image']['tmp_name'];
                $img_type = exif_imagetype($img_tmp_loc);
                // .png, .gif
                if($img_type != 2) {
                    $image->load($img_tmp_loc);                
                    // small
                    if($x_small != '' && $image->getWidth() == $x_small && $image->getHeight() == $y_small){
                        // small
                        if(file_exists("public/img/$table/small/$old_img_name")){
                            unlink("public/img/$table/small/$old_img_name");
                        }
                        // upload
                        $upload = move_uploaded_file($img_tmp_loc, "public/img/$table/small/$img_preview");
                        // result
                        if(!$upload){
                            $this->responseJson(["type"=>"danger", "title"=>"Error!", "message"=>"Not uploaded.", "reload"=>"0"]);
                            exit;
                        }
                    } else {
                        $this->responseJson(["type"=>"warning", "title"=>"Warning!", "message"=>"Your file is not ".$x_small."x".$y_small."", "reload"=>"0"]);
                        exit;
                    }
                    // type
                    $type = $img_ext;
                }
                // .jpg
                else {
                    // small
                    if(file_exists("public/img/$table/small/$old_img_name")){
                        unlink("public/img/$table/small/$old_img_name");
                    }
                    // large
                    if(file_exists("public/img/$table/large/$old_img_name")){
                        unlink("public/img/$table/large/$old_img_name");
                    }
                    // watermark link and setting
                    $lg_watermark_url = 'public/img/watermark_large.png';
                    $sm_watermark_url = 'public/img/watermark_small.png';
                    // bottom & right 
                    $sm_watermark_x = '0';
                    $sm_watermark_y = '0';
                    $lg_watermark_x = '0';
                    $lg_watermark_y = '0';
                    /* resizeToWidth */
                    // Small image
                    if($action_small == 'resizeToWidth') {
                        if($x_small != '') {
                            $image->load($_FILES['image']['tmp_name']);
                            $image->resizeToWidth($x_small);
                            // save
                            $image->save("public/img/$table/small/$img_preview");
                        }
                    }
                    // Large image
                    if($action_large == 'resizeToWidth') {
                        if ($x_large != '') {
                            $image->load($_FILES['image']['tmp_name']);
                            $image->resizeToWidth($x_large);
                            // watermark
                            if ($watermark != '') {
                                $image->watermark($lg_watermark_x, $lg_watermark_y, $lg_watermark_url);
                            }
                            // save
                            $image->save("public/img/$table/large/$img_preview");
                        }
                    }
                    /* crop */
                    // Small image
                    if ($action_small == 'crop') {
                        if($y_small != '' && $x_small != '') {
                            $image->load($_FILES['image']['tmp_name']);
                            $image->crop($x_small, $y_small);
                            // save
                            $image->save("public/img/$table/small/$img_preview");
                        }
                    }
                    // Large image
                    if ($action_large == 'crop') {
                        if ($y_large != '' && $x_large != '') {
                            $image->load($_FILES['image']['tmp_name']);
                            $image->crop($x_large, $y_large);
                            // watermark
                            if ($watermark != '') {
                                $image->watermark($lg_watermark_x, $lg_watermark_y, $lg_watermark_url);
                            }
                            // save
                            $image->save("public/img/$table/large/$img_preview");
                        }
                    }
                }
                // update timstamp
                $update = $this->con->prepare("UPDATE `files` SET `name`=?, `type`=?, `size`=?, `date`=now() WHERE `id`='".$photo['id']."'");
                $update->execute(array($img_name, $type, $img_size));
                // result
                if (!$update) {
                    $this->responseJson(["type"=>"danger", "title"=>"Error!", "message"=>"Not updated data.", "reload"=>"0"]);
                    exit;
                }
            }
            // if not exists
            else {
                $this->addImage($table, $row_id, $type, $action_small, $action_large, $x_small, $y_small , $x_large , $y_large, $watermark);
            }

        }
    }
    
    /* Files */
    public function addFile($table, $row_id, $name = '', $type = '', $size = '') {
        // get files
        foreach($_FILES['file']['name'] as $key => $val) {
            // check file in array
            if ($val != '') {
                // get data
                $file_path = $_FILES['file']['name'];
                $name_original = pathinfo($file_path[$key], PATHINFO_FILENAME);
                $type = pathinfo($file_path[$key], PATHINFO_EXTENSION);
                $tmp_name = $_FILES['file']['tmp_name'][$key];
                $name = md5($name_original.'_'.round(microtime(true) * 1000));
                $file = $name.'.'.$type;
                $size = $_FILES['file']['size'][$key];
                // upload
                $upload_file = move_uploaded_file($tmp_name, "public/files/$file");
                // insert
                $sql_insert = $this->con->prepare("INSERT INTO `files` (`table_name`, `row_id`, `name_original`, `name_used`, `name`, `type`, `size`) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $sql_insert->execute(array($table, $row_id, $name_original, $key, $name, $type, $size));
                // result
                if(!$sql_insert){
                    $this->responseJson(['type'=>"danger", "title"=>"Error!", "message"=>"File not uploaded."]);
                    exit;
                }
            }
        }
        
    }
    public function editFile($table, $row_id, $name='', $type='', $size='', $file = '') {
        // get files
        foreach($_FILES['file']['name'] as $key => $val) {
            // check file in array
            if($val != ''){
                // check data
                $select = $this->con->prepare("SELECT * FROM `files` WHERE `table_name`=? AND `row_id`=? AND `name_used`='$key' ");
                $select->execute(array($table, $row_id));
                // if exists
                if($select->rowCount()) {
                    // get data
                    $file_arr = $select->fetch();
                    $id = $file_arr['id'];
                    $file_path = $_FILES['file']['name'];
                    $name_original = pathinfo($file_path[$key], PATHINFO_FILENAME);
                    $type = pathinfo($file_path[$key], PATHINFO_EXTENSION);
                    $name = md5($name_original.'_'.round(microtime(true) * 1000));
                    $old_file = $file_arr['name'].'.'.$file_arr['type'];
                    $file = $name.'.'.$type;
                    $size = $_FILES['file']['size'][$key];
                    $file_tmp_name = $_FILES['file']['tmp_name'][$key];
                    // update file 
                    if(file_exists("public/files/$old_file")) {
                        unlink("public/files/$old_file");
                    }
                    // upload new file
                    $upload_file = move_uploaded_file($file_tmp_name, "public/files/$file");
                    // update data
                    $update = $this->con->prepare("UPDATE `files` SET `name_original`=?, `name_used`=?, `name`=?, `type`=?, `size`=?, `date`=now() WHERE `id`='".$id."'");
                    $update->execute(array($name_original, $key, $name, $type, $size));
                    // result
                    if(!$update){
                        $this->responseJson(['type'=>"danger","title"=>"Error!","message"=>"Pleace try again"]);
                        exit;
                    }
                }
                // if not exists
                else {
                    $this->addFile(/*table*/"$table", /*row_id*/"$row_id");
                }
            }
        }
    }
    
    /* Delete file by ID */
    public function removeFileID($table = '', $id = '') {
        // check data
        if(isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['table']) && !empty($_POST['table'])) {
            // get data
            $id = $_POST['id'];
            $table = $_POST['table'];
            



            // check data in table
            $res = $this->con->prepare("SELECT * FROM `files` WHERE `id`=?");
            $res->execute(array($id));
            // allowed type
            $type_used = ['jpg','png','gif'];
            // if exists
            if ($res->rowCount()) {
                // get file data from table
                $row_data = $res->fetch();
                $type = $row_data['type'];
                $name = $row_data['name'];
                // file
                if(!in_array($type, $type_used)){
                    if (file_exists("public/files/$name.$type")) {
                        unlink("public/files/$name.$type");
                    }
                }
                // summernote
                if ($table == 'summernote') {
                    // remove summernote image
                    if (file_exists("public/img/$table/$name.$type")) {
                        unlink("public/img/$table/$name.$type");
                    }
                }
                // image
                else {
                    // remove small image
                    if (file_exists("public/img/$table/small/$name.$type")) {
                        unlink("public/img/$table/small/$name.$type");
                    }
                    // remove large image
                    if (file_exists("public/img/$table/large/$name.$type")) {
                        unlink("public/img/$table/large/$name.$type");
                    }
                }
                // delete row by id
                $delete = $this->con->prepare("DELETE FROM `files` WHERE `id`=?");
                $delete->execute(array($id));
                // result
                if($delete) {
                    // action log for admins
                    $admin_id_log = $_SESSION['admin_id'];
                    $log = $this->con->prepare("INSERT INTO `log_actions` (`admin_id`, `table_name`, `row_id`, `action`, `color`) VALUES (?, ?, ?, ?, ?)");
                    $log->execute(array($admin_id_log, $table, $id, 'delete file id','red'));
                    // response
                    $this->responseJson(['type'=>'success', 'title'=>'Success!', 'message'=>'Your file was deleted', 'reload'=>'0']);
                }
            }
            // if not exists
            else {
                $this->responseJson(["type"=>'warning', "title"=>'Warning!', "message"=>'Can not find data.', "reload"=>'0']);
            }
        }
    }
    /* Delete file by row_id */
    public function removeFiles($table = '', $row_id = '') {
        // check data
        if(isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['table']) && !empty($_POST['table']))  {
            // get data
            $row_id = $_POST['id'];
            $table = $_POST['table'];
            // check files
            $res = $this->con->prepare("SELECT * FROM `files` WHERE `row_id`=?");
            $res->execute(array($row_id));
            $type_used = ['jpg','png','gif'];
            // if exists
            if ($res->rowCount()) {
                for($i = 0; $i < $res->rowCount(); $i++) {
                    // get file data from table
                    $row_data = $res->fetch();
                    $type = $row_data['type'];
                    $name = $row_data['name'];
                    // file
                    if(!in_array($type, $type_used)) {
                        // remove file
                        if (file_exists("public/files/$name.$type")) {
                            unlink("public/files/$name.$type");
                        }
                    }
                    // summernote
                    if ($table == 'summernote') {
                        // remove summernote image
                        if (file_exists("public/img/$table/$name.$type")) {
                            unlink("public/img/$table/$name.$type");
                        }
                    }
                    // image
                    else {
                        // dropzone albums gallery
                        if($table == 'albums') {
                            // small
                            if (file_exists("public/img/gallery/small/$name.$type")) {
                                unlink("public/img/gallery/small/$name.$type");
                            }
                            // large
                            if (file_exists("public/img/gallery/large/$name.$type")) {
                                unlink("public/img/gallery/large/$name.$type");
                            }
                        }
                        // small
                        if (file_exists("public/img/$table/small/$name.$type")) {
                            unlink("public/img/$table/small/$name.$type");
                        }
                        // large
                        if (file_exists("public/img/$table/large/$name.$type")) {
                            unlink("public/img/$table/large/$name.$type");
                        }
                    }

                }
                // delete rows
                $delete = $this->con->prepare("DELETE FROM `files` WHERE `row_id`=?");
                $delete->execute(array($row_id));
                // result
                if (!$delete) {
                    // action log for admins
                    $admin_id_log = $_SESSION['admin_id'];
                    $log = $this->con->prepare("INSERT INTO `log_actions` (`admin_id`, `table_name`, `row_id`, `action`, `color`) VALUES (?, ?, ?, ?, ?)");
                    $log->execute(array($admin_id_log, $table, $row_id, 'delete file','red'));
                    // response
                    $this->responseJson(["type"=>'danger', "title"=>'Error!', "message"=>'Please, try again.', "reload"=>'0']);
                    exit;
                }
            }
            // if not exists
            else {
                $this->responseJson(["type"=>'warning', "title"=>'Warning!', "message"=>'Can not find data.', "reload"=>'0']);
            }
        }
    }
    
    /* Sort */
    public function sortData() {
        // get data
        $sort_list = $_GET['sort_list'];
        $table = $_POST['table'];
        // get sort & id
        foreach ($sort_list as $sort => $id) {
            // update data
            $update_sort = $this->con->prepare("UPDATE `$table` SET `sort`=? WHERE `id`=?");
            $update_sort->execute(array($sort, $id));
            // result
            if (!$update_sort) {
                $this->responseJson(["type"=>'danger', "title"=>'Error!', "message"=>'Please try again', "reload"=>'0']);
                exit;
            }
        }
        // action log for admins
        $admin_id_log = $_SESSION['admin_id'];
        $log = $this->con->prepare("INSERT INTO `log_actions` (`admin_id`, `table_name`, `row_id`, `action`, `color`) VALUES (?, ?, ?, ?, ?)");
        $log->execute(array($admin_id_log, $table, 'all', 'sort file','green'));
        // response
        $this->responseJson(["type"=>'success', "title"=>'Well done!', "message"=>'Successfully sorted data.', "reload"=>'0']);
    }
    /* Themes */
    public function changeTheme() {
        // get data
        $admin_id = $this->Admin['id'];
        $color_id = $_POST['id'];
        // check admin theme
        if($this->selectDataAdmin("a_colors_theme", "WHERE `admin_id`=".$admin_id."")){
            $sql_change_theme = $this->con->prepare("UPDATE `a_colors_theme` SET `color_id`=? WHERE `admin_id`=?");
            $sql_change_theme->execute(array($color_id, $admin_id));
            // result
            if(!$sql_change_theme){
                $this->responseJson(["type"=>"danger", "title"=>"Error!", "message"=>"Please, try again.", "reload"=>"0"]);
                exit;
            }
        }
        // set admin theme
        else {
            $sql_insert = $this->con->prepare("INSERT INTO `a_colors_theme` (`admin_id`, `color_id`) VALUES (?, ?)");
            $sql_insert->execute(array($admin_id, $color_id));
            // result
            if(!$sql_insert){
                $this->responseJson(["type"=>"danger", "title"=>"Error!", "message"=>"Please, try again.", "reload"=>"0"]);
                exit;
            }
        }
        // return color
        $color = $this->selectDataAdmin("a_colors", "WHERE `id`=".$color_id."");
        echo json_encode($color);
    }
    /* Notifications */
    public function notifClear() {
        // get data
        $id = $_POST['id'];
        // clear all new notifications
        if ($id == 'all') {
            // update data
            $sql_update = $this->con->prepare("UPDATE `notifications` SET `status`='2' WHERE `status`='1'");
            $sql_update->execute();
        } else {
            // update data
            $sql_update = $this->con->prepare("UPDATE `notifications` SET `status`='2' WHERE `status`='1' AND `id`=?");
            $sql_update->execute(array($id));
        }
        // result
        if ($sql_update) {
            // action log for admins
            $admin_id_log = $_SESSION['admin_id'];
            $log = $this->con->prepare("INSERT INTO `log_actions` (`admin_id`, `table_name`, `row_id`, `action`, `color`) VALUES (?, ?, ?, ?, ?)");
            $log->execute(array($admin_id_log, 'notifications', $id, 'Notification cleared','green'));
            // response
            $this->responseJson(["type"=>'success', "title"=>'Well done!', "message"=>'Successfully cleared.']);
        } else {
            $this->responseJson(["type"=>'danger', "title"=>'Error!', "message"=>'Please, try again.']);
        }
    }
    /* Summernotes */
    public function uploadSummernoteImage() {
        // check image
        if(isset($_FILES['file'])) {
            if($_FILES['file']['size'] > 0) {
                $image = new SimpleImage();
                // get data
                $img_original = $_FILES['file']['name'];
                $img_size = $_FILES['file']['size'];
                $img_path = $_FILES['file']['name'];
                $img_pathinfo = pathinfo($img_path);
                $img_ext = $img_pathinfo['extension'];
                $img_name = md5($img_original.'_'.round(microtime(true) * 1000));
                $img_preview = $img_name.'.'.$img_ext;
                $img_tmp_loc = $_FILES['file']['tmp_name'];
                $img_type = exif_imagetype($img_tmp_loc);
                $img_url = "/public/img/summernote/$img_preview";
                $type = 'jpg';
                // .png, .gif
                if($img_type != 2) {
                    $image->load($img_tmp_loc);
                    // small
                    if($image->getWidth() <= 1200){
                        $upload = move_uploaded_file($img_tmp_loc, "public/img/summernote/$img_preview");
                        // result
                        if(!$upload){
                            $this->responseJson(["type"=>"danger", "title"=>"Error!", "message"=>"Not uploaded.", "reload"=>"0"]);
                            exit;
                        }
                    } else {
                        $this->responseJson(["type"=>"warning", "title"=>"Warning!", "message"=>"Your file width is larger, than 1200px", "reload"=>"0"]);
                        exit;
                    }
                    // type
                    $type = $img_ext;
                }
                // .jpg
                else {
                    // image data
                    $image->load($_FILES['file']['tmp_name']);
                    $image->resizeToWidth(1200);
                    // save
                    $image->save("public/img/summernote/$img_preview");
                }
                // insert data
                $insert = $this->con->prepare("INSERT INTO `files` (`table_name`, `row_id`, `name_original`, `name_used`, `name`, `type`, `size`) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $insert->execute(array("summernote", "0", $img_original, 'summernote', $img_name, $type, $img_size));
                // result
                if ($insert) {
                    // action log for admins
                    $admin_id_log = $_SESSION['admin_id'];
                    $summernote_id = $this->con->lastInsertId();
                    $log = $this->con->prepare("INSERT INTO `log_actions` (`admin_id`, `table_name`, `row_id`, `action`, `color`) VALUES (?, ?, ?, ?, ?)");
                    $log->execute(array($admin_id_log, 'summernote', $summernote_id, 'Summernote','green'));
                    // response
                    $this->responseJson(["type"=>"success", "title"=>"Well done!", "message"=>"Image uploaded.", "reload"=>$img_url]);
                } else {
                    $this->responseJson(["type"=>"danger", "title"=>"Error!", "message"=>"Image not uploaded.", "reload"=>$img_url]);
                }
            }
        }
    }
    /* Update Live */
    public function changeField() {
        // check data
        if(!empty($_POST['table_name']) && !empty($_POST['field_name']) && !empty($_POST['id'])) {
            // get data
            $table_name = $_POST['table_name'];
            $field_name = $_POST['field_name'];
            $field_value = $_POST['field_value'];
            $id = $_POST['id'];
            // update data
            $update_field = $this->con->prepare("UPDATE `$table_name` SET `$field_name`='$field_value' WHERE `id`='$id'");
            $update_field->execute();
            // result
            if (!$update_field) {
                $this->responseJson(["type"=>"danger", "title"=>"Error!", "message"=>"Field not updated.", "reload"=>"0"]);
            }
        }
    }
    
    public function notif_interval(){
        $notif = $this->con->prepare("SELECT * FROM `notifications` WHERE `status`='1'");
        $notif->execute();
        $output = '';
        $fetch_count = $notif->rowCount();
        $arr_fetch = [];
        if($fetch_count > 0){
            while($fetch_notif = $notif->fetch()){
                array_push($arr_fetch, ["subject"=>$fetch_notif['subject'],"message"=>$fetch_notif['link'],'link'=>$fetch_notif['link']]);
                
            }
            echo json_encode($arr_fetch);
        }
        
    }
    
    public function get_league_teams() {
        $league_id = $_POST['id'];
        // get teams
        $teams = $this->con->prepare("SELECT * FROM `f_teams` WHERE `status`='1' ORDER BY `sort`");
        $teams->execute();
        if ($teams->rowCount() > 0) {
            $teams_arr = [];
            while($team_row = $teams->fetch()) {
                $team_arr = [];
                $f_leagues  = json_decode($team_row['f_leagues']);
                if(in_array($league_id, $f_leagues, true)) {
                    $team_arr['id'] = $team_row['id'];
                    $team_arr['name'] = $team_row['title_ru'];
                    array_push($teams_arr, $team_arr);
                }
            }
            echo json_encode($teams_arr);
        }
    }
}