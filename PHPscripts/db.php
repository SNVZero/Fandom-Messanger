<?php
$user = 'root';
$pass = '';
$db = new PDO('mysql:host=127.0.0.1;dbname=practice', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

function Add_user($uid,$ufirstname,$ulastname,$unikname,$upassword,$uemail){//Функция регистрации нового пользователя

    $uhash = password_hash($upassword,PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO users SET uid = ?, ufirstname = ?, ulastname = ?, unikname = ?, upassword = ?, uemail = ?");
    $stmt -> execute([$uid, $ufirstname, $ulastname, $unikname, $uhash, $uemail]);
}

function Edit_user($uid,$ufirstname,$ulastname,$unikname,$uemail){//Функция изменяющая личные данные пользователя

    $stmt = $db->prepare("UPDATE users SET ufirstname = ?, ulastname = ?, unikname = ?, uemail = ? WHERE uid = ?");
    $stmt -> execute([$ufirstname, $ulastname, $unikname, $uemail, $uid]);
}

function Edit_user_password($uid,$upassword){//Функция изменяющая пароль пользователя

    $uhash = password_hash($upassword,PASSWORD_DEFAULT);

    $stmt = $db->prepare("UPDATE users SET upassword = ? WHERE uid = ?");
    $stmt -> execute([$uhash, $uid]);
}

function SanitizeString($var){
    $var = strip_tags($var);
    $var = htmlentities($var);
    return stripslashes($var);
}