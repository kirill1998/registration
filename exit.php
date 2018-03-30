<?php session_start();
include 'session/session.php';
unset($_SESSION['login']);
setcookie("login",    "", time()-9999999);
setcookie("password",    "", time()-9999999);
require('index.html');