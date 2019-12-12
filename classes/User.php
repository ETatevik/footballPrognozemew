<?php 
class User extends Model{
    
    public $USER;
    public function __construct(){
        parent::__construct();
        //if(isset($_SESSION['userID'])) {
        // $this->USER = $this->getUser(["id"=>$_SESSION['userID']]);
        //}
    }
    
    /* Get Data User */
    public function getDataUser($table = '', $query = '', $count = 1) {
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
    /*--- Admin ---*/
    public function adminReg() {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_hash = hash('sha512', $password);
        // check admin session
        if (empty($name) || empty($email) || empty($password)) {
            unset($_SESSION['admin_id']);
            unset($_SESSION['admin_email']);
            $this->responseJson(["type"=>'danger', "title"=>'Error!', "message"=>'Fill out the fields!']);
            exit;
        }
        // validate email
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $this->responseJson(["type"=>'danger', "title"=>'Email error!', "message"=>'Incorrect email address.']);
            exit;
        }
        // get admin
        $sql_admin = $this->con->prepare("SELECT * FROM `a_admins` WHERE `email`=?");
        $sql_admin->execute(array($email));
        // if exists
        if ($sql_admin->rowCount()) {
            $row_admin = $sql_admin->fetch();
            $id = $row_admin['id'];
            // result
            $this->responseJson(["type"=>'warning', "title"=>'Email Exists!', "message"=>'Please, login.']);
            exit;
        } else {
            // add admin
            $insert_admin = $this->con->prepare("INSERT INTO `a_admins` (`perm_type`, `email`, `password`, `name`) VALUES (?, ?, ?, ?)");
            $insert_admin->execute(array('3', $email, $password_hash, $name));
            // add notification
            $admin_id = $this->con->lastInsertId();
            $link = 'view_profile?id='.$admin_id;
            $subject = 'New admin';
            $message = $name.', '.$email;
            $insert_notif = $this->con->prepare("INSERT INTO `notifications` (`subject`, `message`, `link`) VALUES (?, ?, ?)");
            $insert_notif->execute(array($subject, $message, $link));
            // response
            $this->responseJson(["type"=>'success', "title"=>'Well done!', "message"=>'We will activate your profile soon.']);
        }
    }
    public function adminLogin() {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hash_sql = $this->con->prepare("SELECT * FROM `a_admins` WHERE `email`='$email'");
        $hash_sql->execute();
        $assoc = $hash_sql->fetch();
        $password_hash_sql = $assoc['password'];
        $password_hash = hash('sha512', $password);
        // check admin session
        if (empty($email) || empty($password_hash)) {
            unset($_SESSION['admin_id']);
            unset($_SESSION['admin_email']);
            $this->responseJson(["type"=>'danger', "title"=>'Login error!', "message"=>'Fill out the fields!']);
            exit;
        }
        // check password
        if($password_hash_sql == $password_hash){
            $id = $assoc['id'];
            $status = $assoc['status'];
            // status inactive
            if ($status == 0) {
                // result
                $this->responseJson(["type"=>'warning', "title"=>'Inactive!', "message"=>'Your profile is not active yet.']);
                exit;
            }
            // status archive
            if ($status == 2) {
                // result
                $this->responseJson(["type"=>'warning', "title"=>'Archive!', "message"=>'Your profile is archived.']);
                exit;
            }
            // register session
            $_SESSION['admin_id'] = $id;
            $_SESSION['admin_email'] = $email;
            // result
            $this->responseJson(["type"=>'success', "title"=>'Login!', "message"=>'Welcome.', "reload"=>'1']);
            exit;
        }
        // error
        else {
            unset($_SESSION['admin_id']);
            unset($_SESSION['admin_email']);
            $this->responseJson(["type"=>'warning', "title"=>'Login error!', "message"=>'Please, try again.']);
        }



//        // check admin session
//        if (empty($email) || empty($password_hash)) {
//            unset($_SESSION['admin_id']);
//            unset($_SESSION['admin_email']);
//            $this->responseJson(["type"=>'danger', "title"=>'Login error!', "message"=>'Fill out the fields!']);
//            exit;
//        }
//        // get admin
//        $sql_admin = $this->con->prepare("SELECT * FROM `a_admins` WHERE `email`=? AND `password`=?");
//        $sql_admin->execute(array($email, $password_hash));
//        // if exists
//        if ($sql_admin->rowCount()) {
//            $row_admin = $sql_admin->fetch();
//            $id = $row_admin['id'];
//            $status = $row_admin['status'];
//            // status inactive
//            if ($status == 0) {
//                // result
//                $this->responseJson(["type"=>'warning', "title"=>'Inactive!', "message"=>'Your profile is not active yet.']);
//                exit;
//            }
//            // status archive
//            if ($status == 2) {
//                // result
//                $this->responseJson(["type"=>'warning', "title"=>'Archive!', "message"=>'Your profile is archived.']);
//                exit;
//            }
//            // register session
//            $_SESSION['admin_id'] = $id;
//            $_SESSION['admin_email'] = $email;
//            // result
//            $this->responseJson(["type"=>'success', "title"=>'Login!', "message"=>'Welcome.', "reload"=>'1']);
//            exit;
//        } else {
//            unset($_SESSION['admin_id']);
//            unset($_SESSION['admin_email']);
//            $this->responseJson(["type"=>'warning', "title"=>'Login error!', "message"=>'Please, try again.']);
//        }
    }
    public function adminReset() {
        $email = $_POST['email'];
        // check admin session
        if (empty($email)) {
            unset($_SESSION['admin_id']);
            unset($_SESSION['admin_email']);
            $this->responseJson(["type"=>'danger', "title"=>'Login error!', "message"=>'Fill out the fields!']);
            exit;
        }
        // get admin
        $sql_admin = $this->con->prepare("SELECT * FROM `a_admins` WHERE `email`=?");
        $sql_admin->execute(array($email));
        // if exists
        if ($sql_admin->rowCount()) {
            $row_admin = $sql_admin->fetch();
            $id = $row_admin['id'];
            // new password
            $password = passwordGenerator(8);
            $password_hash = hash('sha512', $password);
            // update password
            $update_admin = $this->con->prepare("UPDATE `a_admins` SET `password`=? WHERE `email`='$email'");
	        $update_admin->execute(array($password_hash));
            // send email
            $subject = 'New password';
            $message = '
            <html>
                <body>
                    <div style="font: 14px/1.5 Arial, Tahoma, Verdana, sans-serif">
                        <p style="margin-bottom:10px;">Your email: '.$email.'</p>
                        <p style="margin-bottom:10px;">Your new password: '.$password.'</p>
                    </div>
                </body>
            </html>';
            $snd = sendMailSmtp($email, $subject, $message);
            // result
            if ($snd) {
                // action log
                $admin_id_log = $_SESSION['admin_id'];
                $log = $this->con->prepare("INSERT INTO `log_actions` (`admin_id`, `table_name`, `row_id`, `action`, `color`) VALUES (?, ?, ?, ?, ?)");
                $log->execute(array($admin_id_log, 'a_admins', $id, 'admin reset', 'gray'));
                // response
                $this->responseJson(["type"=>'success', "title"=>'Sent!', "message"=>'Check your email.']);
            } else {
                $this->responseJson(["type"=>'warning', "title"=>'Error!', "message"=>'Please, try again.']);
            }
        } else {
            unset($_SESSION['admin_id']);
            unset($_SESSION['admin_email']);
            $this->responseJson(["type"=>'danger', "title"=>'Not found!', "message"=>'Email does not exists.']);
        }
        exit;
    }
    /*--- Users ---*/
    public function userSubscribe() {
        // Add user
        $phone = $_POST['phone'];
        $insert_user = $this->con->prepare("INSERT INTO `u_users` (`phone`) VALUES (?)");
        $insert_user->execute(array($phone));
        // action log
        $user_id = $insert_user->lastInsertId();
        $log = $this->con->prepare("INSERT INTO `log_actions` (`user_id`, `table_name`, `row_id`, `action`, `color`) VALUES (?, ?, ?, ?, ?)");
        $log->execute(array($user_id, 'u_users', $user_id, 'subscribe', 'green'));
        // response
        $this->responseJson(["type"=>'success', "title"=>'Well done!', "message"=>'User successfully registered.']);
    }
    public function userDataEdit() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $notes = $_POST['notes'];
        // check required values
        if (empty($phone) || empty($name)) {
            $this->responseJson(["type"=>'danger', "title"=>'Error!', "message"=>'Please, fill out the fields.']);
            exit;
        }
        // status
        if (isset($_POST['status']) && !empty($_POST['status'])) {
            $status = 1;
        } else {
            $status = 2;
        }
        // update data
        $sql_update = $this->con->prepare("UPDATE `u_users` SET `name`='$name', `email`='$email', `phone`='$phone', `notes`='$notes', `status`='$status' WHERE `id`=?");
        $sql_update->execute(array($id));
        // if update
        if ($sql_update) {
            // log
            
            // response
            $this->responseJson(["type"=>'success', "title"=>'Saved!', "message"=>'Your data was successfully changed.']);
            exit;
        } else {
            $this->responseJson(["type"=>'danger', "title"=>'Error!', "message"=>'Please, try again.']);
            exit;
        }
    }

    public function logOut(){
        session_destroy();
        echo 'clear';
    }
}