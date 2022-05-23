<?php

require_once('conn.php');

header('Content-Type: text/html; charset=UTF-8');
$pattern = '/^[a-z0-9-_]{2,20}$/i';
$regname ='/^[а-яЁё]+$/iu';
$regpass = '/^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/';
$url = explode("=",$_SERVER['QUERY_STRING']);


if($url['0'] ==="login"){
    if(empty($_GET['login'])){
        $massage = "Поле не может быть пустым";
        $response=['massage'=>$massage,'error'=>"1"];
        header('Content-typy: application/json');
        echo json_encode($response);
    } else if( !(R::findOne('user', 'unikname = ?', [ $_GET['login'] ])) && !(R::findOne('user', 'uemail = ?', [ $_GET['login'] ] ))){
        $massage = "Пользователь с таким никнеймом или почтой не найден найден";
        $response=['massage'=>$massage,'error'=>"1"];
        header('Content-typy: application/json');
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
    }else {
        $response=['massage'=>'','error'=>"0"];
        header('Content-typy: application/json');
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
    }
}

if($url['0'] ==="password"){
    if(empty($_GET['password'])){
        $massage = "Поле не может быть пустым";
        $response=['massage'=>$massage,'error'=>"1"];
        header('Content-typy: application/json');
        echo json_encode($response);
    } else if(!preg_match($regpass,$_GET['password'])){
        $massage = "Неправильный формат пароля";
        $response=['massage'=>$massage,'error'=>"1"];
        header('Content-typy: application/json');
        echo json_encode($response);
    }else {
        $response=['massage'=>'','error'=>"0"];
        header('Content-typy: application/json');
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
    }
}



if($_SERVER['REQUEST_METHOD']=="POST"){
    if(empty($_POST['login']) && empty($_POST['password'])){
        $massage = "Поле не может быть пустым";
        $response=['massagel'=>$massage,'massagep'=>$massage,'error'=>"1"];
        header('Content-typy: application/json');
        echo json_encode($response);
    }else if(!(R::findOne('user', 'unikname = ?', [ $_POST['login'] ])) && !(R::findOne('user', 'uemail = ?', [ $_POST['login'] ] ))){//
        $massage = "Пользователь с таким логином не найден";
        $response=['massagel'=>$massage,'error'=>"1"];
        header('Content-typy: application/json');
        echo json_encode($response);
    }else if(R::findOne('user', 'unikname = ?', [ $_POST['login'] ] )){
        $user = R::findOne('user', 'unikname = ?', [ $_POST['login'] ]);
        if(password_verify($_POST['password'],$user->upassword)){
            session_start();
            $_SESSION['user'] = [
                //Реализовать кнопку запомнить меня
                "id" => $user->uid

            ];
            $massage = "Поле не может быть пустым";
            $response=['error'=>"0"];
            header('Content-typy: application/json');
            echo json_encode($response);
        }else{
            $massage = "Пароль не совпадает с введеным логином";
            $response=['massagel'=>"",'massagep'=>$massage,'error'=>"1"];
            header('Content-typy: application/json');
            echo json_encode($response);
        }

    }else if(R::findOne('user', 'uemail = ?', [ $_POST['login'] ] )){
       $user = R::findOne('user', 'uemail = ?', [ $_POST['login'] ]);
       if(password_verify($_POST['password'],$user->upassword)){
            session_start();
            $_SESSION['user'] = [
                //Реализовать кнопку запомнить меня
                "id" => $user->uid
            ];
            $response=['error'=>"0"];
            header('Content-typy: application/json');
            echo json_encode($response);
        }else{
            $massage = "Пароль не совпадает с введеным логином";
            $response=['massagel'=>"",'massagep'=>$massage,'error'=>"1"];
            header('Content-typy: application/json');
            echo json_encode($response);
        }
    }
}


function SanitizeString($var){
    $var = strip_tags($var);
    $var = htmlentities($var);
    return stripslashes($var);
}

?>