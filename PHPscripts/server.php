<?php

    require_once('conn.php');
    if(!empty($_GET['message'])){
        R::exec('INSERT INTO chat SET room = ?, uid_1 = ?, uid_2 = ? , massage = ?',[ $_GET['room_1'], $_GET['uid_1'], $_GET['uid_2'],$_GET['message'] ]);
        R::exec('INSERT INTO chat SET room = ?, uid_1 = ?, uid_2 = ? , massage = ?',[ $_GET['room_2'], $_GET['uid_1'], $_GET['uid_2'],$_GET['message'] ]);
        $response=['error'=>"0"];
        header('Content-typy: application/json');
        echo json_encode($response);
    }else{
        $response=['error'=>"1"];
        header('Content-typy: application/json');
        echo json_encode($response);
    }