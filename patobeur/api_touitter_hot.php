<?php
    $ADDR ='vide';

    // $FORW = $_SERVER['HTTP_X_FORWARDED_FOR'];
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ADDR = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ADDR = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ADDR = $_SERVER['REMOTE_ADDR'];
    }

    require_once('_Db_Class.php');
    require_once('_User_Class.php');

    $Message ='';
    $Name ='';
    $Sender ='vide';

    if (isset($_POST['name']) && isset($_POST['message'])){
        $Name='name='. $_POST['name'];
        $Message='&message='. $_POST['message'];
        $Sender = '?'.$Name.$Message;
    }
?>
