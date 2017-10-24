<?php
if(isset($_COOKIE['student'])) {
    unset($_COOKIE['student']);
    setcookie('student', null, -1);
}
if(isset($_COOKIE['teacher'])) {
    unset($_COOKIE['teacher']);
    setcookie('teacher', null, -1);
}
if(isset($_COOKIE['login'])) {
    unset($_COOKIE['login']);
    setcookie('login', null, -1);
}
header("Location: login.php");
