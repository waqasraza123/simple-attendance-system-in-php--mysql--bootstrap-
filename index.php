<?php
if(!isset($_COOKIE['login'])) {
    header('Location: login.php');
}
else{
    if(($_COOKIE['login']) == 1 && ($_COOKIE['student'])==1){
        require("student.php");
    }
    elseif(($_COOKIE['login']) == 1 && ($_COOKIE['teacher'])==1){
        require("teacher.php");
    }
}
