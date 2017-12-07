<?php
session_start();

if($_SESSION['vanish']||$_COOKIE['vanish']){
    if($_SESSION['vanish']){
        session_destroy();
    }
    if($_COOKIE['vanish']){
        setcookie("vanish",null,-1);
    }
    header("location:/?message=You+are+unvanished!");
    exit();
}

$_SESSION['vanish']=true;
setcookie("vanish","true",time()+60*60*24*30);
header("location:/?message=You+are+vanished!");