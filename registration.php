<?php

if(isset($_POST['email']) && $_POST['email'] != '' && isset($_POST['login']) && $_POST['login'] != ''
    && isset($_POST['name']) && $_POST['name'] != '' && isset($_POST['password']) && $_POST['password'] != ''
    && isset($_POST['confirm_password']) && $_POST['confirm_password'] != ''){

    $login =(string) $_POST["login"];
    $password= (string)$_POST["password"];
    $confirm_password=(string) $_POST["confirm_password"];
    $email =(string) $_POST["email"];
    $name=(string) $_POST["name"];
}
else{
    echo json_encode("You should enter all fields");
    exit();
}
if(strcmp($password, $confirm_password) !=0 ){
    echo json_encode("Passwords do not match");
    exit();
}
//удаление тегов, пробелов и.т.д
$login = trim(htmlspecialchars(stripslashes($login)));
$email = trim(htmlspecialchars(stripslashes($email)));
$name = trim(htmlspecialchars(stripslashes($name)));
$password = trim(htmlspecialchars(stripslashes($password)));
$confirm_password = trim(htmlspecialchars(stripslashes($password)));

if (file_exists('database.xml')) {
//работает с xml с помощью simplexml
    $xml = simplexml_load_file('database.xml');

} else {
    exit('Не удалось открыть файл database.xml');
}


$users = $xml->xpath("//users/user/login[. = '{$login}']");
if(count($users) > 0) { // if found
    echo json_encode("not unique login");
    exit();
}
$users = $xml->xpath("//users/user/email[. = '{$email}']");
if(count($users) > 0) { // if found
    echo json_encode("not unique email");
    exit();
}

//генерируем динамическую соль из логина и шифр пароль
$soul = md5($login."1qaz");// шифруем    дату
$md5password= md5($password.$soul);

//добавление пользователя в файл
$addUser->addChild('name', $name);
$addUser->addChild('login', $login);
$addUser->addChild('password', $md5password);
$addUser->addChild('email', $email);
$xml->saveXML('database.xml');

echo json_encode('success');

?>