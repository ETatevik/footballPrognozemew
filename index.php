<?php
// start all sessions
session_start();
// display all errors
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
// functions
require_once('inc/functions.php');

// check secure data
if(!empty($_POST)){
    $_POST = checkVariable($_POST);
}
if(!empty($_GET)){
    $_GET = checkVariable($_GET);
}

// load class by name
spl_autoload_register(function ($class) {
    if (strpos($class, '\\')) {
        $class_array = explode('\\', $class);
        $class_name = array_pop($class_array);
        $class_path = str_replace('\\', '/', $class).'.php';
    } else {
        $class_name = $class;
        $class_path = $class.'.php';
    }
    if (is_file("classes/$class_path")) {
        require "classes/$class_path";
    } else if (is_file("inc/lib/$class_path")) {
        require "inc/lib/$class_path";
    } else {
        exit("Error loading: $class_name");
    }
});

// url settings
$url = new Url();

// pages
if (is_dir("layouts/".$url->PATH) && !is_file("layouts/".$url->PATH.".php") && !empty($url->PAGE)) {
    header("Location: /".$url->PATH."/");
    exit;
}

// languages
if(isset($url->GET['lang'])){
    $_SESSION['lang'] = $url->GET['lang'];
    header("Location: /".$url->PATH);
    exit;
}
if(!isset($_SESSION['lang'])){
    $_SESSION['lang'] = 'hy';
}

// path
if(isset($url->DIR[0]) && $url->DIR[0] == 'admin') {
    $cnt = new Admin();
    
    $cnt->currency = 'AMD';
    $cnt->lang = 'hy';
    $cnt->val = require "inc/languages/hy.php";
    
    if (isset($url->GET['cmd']) && ( (!isset($_SESSION['admin_id']) && ($url->GET['cmd'] == 'adminReg' || $url->GET['cmd'] == 'adminLogin' || $url->GET['cmd'] == 'adminReset')) || (isset($_SESSION['admin_id']) && isset($_SESSION['admin_email'])))) {
        $cnt->{$url->GET['cmd']}();
        if (isset($url->GET['backUrl'])) {
            header("Location: ".urldecode($url->GET['backUrl']));
            exit;
        } else if ($url->type=='ajax'){
            exit;
        } else {
            header("Location: /".$url->PATH."");
            exit;
        }
    }
    
    if (isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])) {
        // check admin status
        
        // go to page
        if (!is_file("layouts/".$url->PATH.".php")) {
            $url->PAGE = 'default';
            require "layouts/admin/".$url->PAGE.".php";
        } else {
            require "layouts/".$url->PATH.".php";
        }
    } else {       
        require "layouts/admin/login.php";
    }
} else {
    $cnt = new User();
    
//    $cnt->currency = $_SESSION['currency'];
    $cnt->lang = $_SESSION['lang'];
    
    if($_SESSION['lang'] == 'hy' || $_SESSION['lang'] == 'en') {
        $cnt->val = require "inc/languages/".$_SESSION['lang'].".php";
    } else {
        $cnt->val = require "inc/languages/hy.php";
    }
    
    if (isset($url->GET['cmd'])) {
        $cnt->{$url->GET['cmd']}();
        if (isset($url->GET['backUrl'])) {
            header("Location: ".urldecode($url->GET['backUrl']));
            exit;
        } else if ($url->type=='ajax') {
            exit;
        } else {
            header("Location: /".$url->PATH."");
            exit;
        }
    }
    
    if (isset($url->DIR[0]) && ($url->DIR[0]=="overlay" || $url->DIR[0]=="load") && ($url->type != "ajax")) {
        exit;
    }
    if (isset($url->DIR[0]) && $url->DIR[0]=="inc") {
        exit;
    }
//    if (isset($url->DIR[0]) && $url->DIR[0]=="profile" && empty($_SESSION["userID"])) {
//        header("Location: /login");
//        exit;
//    }
    // check file
    if (!is_file("layouts/default/".$url->PATH.".php")) {
        if (!empty($url->DIR_STR) && is_file("layouts/default/".$url->DIR_STR."default.php")) {
            $url->PATH = $url->DIR_STR."default";
        } else {
            if(!empty($url->PATH)){
                header("HTTP/1.0 404 Not Found");
            }
            $url->PAGE = "";
            $url->DIR_STR = "";
            $url->PATH = "default";
        }
    }
    // include file
    require_once("layouts/default/".$url->PATH.".php");
}
?>