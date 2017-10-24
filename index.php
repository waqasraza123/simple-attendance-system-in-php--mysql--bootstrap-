<?php
if(!isset($_COOKIE['login'])) {
    require("login.php");
}
else{
        require("teacher.php");
}
