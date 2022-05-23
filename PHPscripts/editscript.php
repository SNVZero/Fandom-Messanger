<?php


require_once('conn.php');


if(!isset($_SESSION)){
    session_start();
}
$regname ='/^[а-яЁё]+$/iu';
$pattern = '/^[a-z0-9-_]{2,20}$/i';

if($_SERVER['REQUEST_METHOD']=="POST"){
    $uid = $_SESSION['user']['id'];
        if(R::findOne('img', 'uid = ?', [ $uid ])){
            $img = (file_get_contents($_FILES['image']['tmp_name']));
            R::exec('UPDATE img SET uimg=? WHERE uid =?',[ $img, $uid  ]);

        }else{
            $img = (file_get_contents($_FILES['image']['tmp_name']));
            R::exec('INSERT INTO img SET uid=? ,uimg=?',[ $uid,$img ]);
            $massage = "Профиль успешно сохранен";
            $response=['massage'=>$massage,'error'=>"0"];
            header('Content-typy: application/json');
            echo json_encode($response);
        }
        R::exec('UPDATE user SET ufirstname=?, ulastname=?, unikname=?, uemail=? WHERE uid =?',[ $_POST['firstname'],$_POST['lastname'],
        $_POST['nikname'], $_POST['email'], $uid  ]);
        $massage = "Профиль успешно сохранен";
        $response=['massage'=>$massage,'error'=>"0"];
        header('Content-typy: application/json');
        echo json_encode($response);

}