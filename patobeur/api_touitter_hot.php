<?php
require_once('_Db_Class.php');
require_once('_Db_User.php');
    $message='';
    $name='';

    if (isset($_POST['name'])){
        $name='?name='. $_POST['name'];
    }
    if (isset($_POST['message'])){
        $message='&message='. $_POST['message'];
    }
    if (isset($_GET['name'])){
        $name='?name='. $_POST['name'];
    }
    if (isset($_GET['message'])){
        $message='&message='. $_GET['message'];
    }
    
    //$user_login = new USER();



















    
    function getdatafromouterspace($url){
        if ($data = file_get_contents($url)) {
            return $data;
        }
    }
    $retourtouitter = getdatafromouterspace($poster);
?>
