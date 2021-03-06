<?php

require_once("../model/Membro.class.php");
session_start();

if(isset($_POST['loginAttempt'])){
    $login = $_POST['login'];
    $senha = $_POST['password'];
    unset($_POST['loginAttempt']);
    $member = new Membro($login, $senha);
    $user = $member->auth();
    if($user){
        $_SESSION['auth'] = true;
        $_SESSION['uid'] = $user['id'];
        header("location:../view/painel.php");
    } else {
        header("location:../view/login.php?valid=false");
    }
}

if(isset($_POST['logoff'])){
    unset($_SESSION['auth']);
    unset($_POST['logoff']);
    session_destroy();
    header("location:../view/login.php");
}



?>