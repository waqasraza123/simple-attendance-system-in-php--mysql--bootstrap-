<?php
if(isset($_COOKIE['student']) && isset($_COOKIE['teacher'])  && isset($_COOKIE['login'])){
    unset($_COOKIE['student']);
    unset($_COOKIE['teacher']);
    unset($_COOKIE['login']);

    setcookie('student', null, -1);
    setcookie('teacher', null, -1);
    setcookie('login', null, -1);

    header("Location: login.php");
}