<?php
session_start();
//файл с пользовательскими обработчиками событий сессии( ! не работает)
//include 'session/session.php';

if( isset($_POST['login']) && $_POST['login'] != '' && isset($_POST['password']) && $_POST['password'] != '') {
    $login = (string) $_POST["login"];
    $password = (string)$_POST["password"];
}
else{
    echo json_encode("You should enter all fields");
    exit();
}

$login = trim(htmlspecialchars(stripslashes($login)));
$password = trim(htmlspecialchars(stripslashes($password)));
if (file_exists('database.xml')) {

    $xml = simplexml_load_file('database.xml');

} else {
    exit('Не удалось открыть файл database.xml');
}
//генерируем динамическую соль из логина и шифр пароль
$soul = md5($login."1qaz");// шифруем    дату
$md5password= md5($password.$soul);


$users = $xml->xpath("//users/user/login[. = '{$login}']");
if(count($users) === 0) { // if not found
    echo json_encode("This login does not exist");
    exit();
}
$users = $xml->xpath("//users/user/password[. = '{$md5password}']");
if(count($users) === 0) {
    echo json_encode("incorrect password");
    exit();
}
//созд сессии и куков
$_SESSION['login']=$login;
session_write_close();
setcookie("login",    $login, time()+9999999);
setcookie("password",    $password, time()+9999999);
$users = $xml->xpath("//users/user/login[. = '{$login}']");

$xml->saveXML('database.xml');




echo json_encode('success');

?>