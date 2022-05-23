<?php

require_once('conn.php');

header('Content-Type: text/html; charset=UTF-8');
$pattern = '/^[a-z0-9-_]{2,20}$/i';
$regname ='/^[а-яЁё]+$/iu';
$regpass = '/^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/';
$url = explode("=",$_SERVER['QUERY_STRING']);


if($url['0'] ==="name"){
    if(empty($_GET['name'])){
        $response=['massage'=>"Поле не может быть пустым",'error'=>"1"];
        header('Content-typy: application/json');
        echo json_encode($response);
    }else if(!preg_match($pattern,$_GET['name'])){
        $massage = "Никней должен состоять из латинских символов и цифр";
        $response=['massage'=>$massage,'error'=>"1"];
        header('Content-typy: application/json');
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
    } else if( R::findOne('user', 'unikname = ?', [ $_GET['name'] ])){
        $massage = "Пользователь с таким никнеймом уже существует";
        $response=['massage'=>$massage,'error'=>"1"];
        header('Content-typy: application/json');
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
    }else {
        $response=['massage'=>'','error'=>"0"];
        header('Content-typy: application/json');
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
    }
}

else if($url['0'] ==="email"){
    if(empty($_GET['email'])){
        $massage = "Поле не может быть пустым";
        $response=['massage'=>$massage,'error'=>"1"];
        header('Content-typy: application/json');
        echo json_encode($response);
    }else if(!filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)){
        $massage = "Почта введена в неверном формате";
        $response=['massage'=>$massage,'error'=>"1"];
        header('Content-typy: application/json');
        echo json_encode($response);
    }else if(R::findOne('user', 'uemail = ?', [ $_GET['email'] ])){
        $massage = "Аккаунт с такой почтой уже создан";
        $response=['massage'=>$massage,'error'=>"1"];
        header('Content-typy: application/json');
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
    }else {
        $response=['massage'=>'','error'=>"0"];
        header('Content-typy: application/json');
        echo json_encode($response);
    }
}

else if($url['0'] ==="pass"){
    if(empty($_GET['pass'])){
        $massage = "Поле не может быть пустым";
        $response=['massage'=>$massage,'error'=>"1"];
        header('Content-typy: application/json');
        echo json_encode($response);
    }else if(!preg_match($regpass,$_GET['pass'])){
        $massage = "Неправильный формат пароля";
        $response=['massage'=>$massage,'error'=>"1"];
        header('Content-typy: application/json');
        echo json_encode($response);
    }else{
        $response=['massage'=>'','error'=>"0"];
        header('Content-typy: application/json');
        echo json_encode($response);
    }
}

else if($url['0'] ==="rpass"){
    if(empty($_GET['rpass'])){
        $massage = "Поле не может быть пустым";
        $response=['massage'=>$massage,'error'=>"1"];
        header('Content-typy: application/json');
        echo json_encode($response);
    }else if($_GET['pass'] != $_GET['rpass']){
        $massage = "Пароли не совпадают";
        $response=['massage'=>$massage,'error'=>"1"];
        header('Content-typy: application/json');
        echo json_encode($response);
    }else{
        $response=['massage'=>'','error'=>"0"];
        header('Content-typy: application/json');
        echo json_encode($response);
    }
}

if($_SERVER['REQUEST_METHOD']=="POST"){
    if(empty($_POST['name'])||empty($_POST['email'])||empty($_POST['pass'])||empty($_POST['rpass']) || !preg_match($pattern,$_POST['name']) || R::findOne('user', 'unikname = ?', [ $_POST['name'] ]) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || R::findOne('user', 'uemail = ?', [ $_POST['email'] ]) || !preg_match($regpass,$_POST['pass']) || ($_POST['pass'] != $_POST['rpass']) ){
        $massage = "Проверьте правильность заполнения полей";
        $response=['massage'=>$massage,'error'=>"1"];
        header('Content-typy: application/json');
        echo json_encode($response);
    }else if(!isset($_POST['agree'])){
        $massage = "Подтвердите согласие на обработку данных";
        $response=['massage'=>$massage,'error'=>"1"];
        header('Content-typy: application/json');
        echo json_encode($response);
    }else{

        $hash = password_hash($_POST['pass'],PASSWORD_DEFAULT);
        $uid = rand(1,99999);
        while(R::findOne('user', 'uid = ?', [ $uid ])){
            $uid = rand(1,99999);
        }
        R::exec('INSERT INTO user SET uid=?,unikname=?,upassword=?,uemail=?',[$uid,$_POST['name'],$hash,$_POST['email']]);
        session_start();
        $_SESSION['user'] = [
            //Реализовать кнопку запомнить меня
            "id" => $uid
        ];


        $response=['error'=>"0"];
        header('Content-typy: application/json');
        echo json_encode($response);
    }
}

function SanitizeString($var){
    $var = strip_tags($var);
    $var = htmlentities($var);
    return stripslashes($var);
}

?>