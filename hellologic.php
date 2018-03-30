<?php session_start(); ?>
<?php
if(empty($_SESSION['login'])){
    require('index.html');
}
else{
    echo "hello ".$_SESSION['login'].",  ";
}
