<?php

    if(!isset($_SESSION)){
        session_start();
    }


    unset($_SESSION['user']);//Удаляем сессию текущего пользователя

    session_destroy();
    $response=['error'=>"0"];
    header('Content-typy: application/json');
    echo json_encode($response);

?>