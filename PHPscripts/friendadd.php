<?php
    require_once('conn.php');
    if(!(R::findOne('friend', 'uid_1 = ? AND uid_2 = ? AND status = ?', [$_GET['uid_1'], $_GET['uid_2'], 1 ])) && !(R::findOne('friend', 'uid_1 = ? AND uid_2 = ? AND status = ?', [$_GET['uid_2'], $_GET['uid_1'], 1 ]))){
        R::exec('INSERT INTO friend SET uid_1 = ?, uid_2 = ?, status = ?',[ $_GET['uid_1'], $_GET['uid_2'], 1]);
        $response=['error'=>"0"];
        header('Content-typy: application/json');
        echo json_encode($response);
    }

    if(R::findOne('friend', 'uid_1 = ? AND uid_2 = ? AND status = ?', [$_GET['uid_2'], $_GET['uid_1'], 1 ])){
        R::exec('UPDATE  friend SET status = ? WHERE uid_1 = ? AND uid_2 = ?',[ 2, $_GET['uid_2'], $_GET['uid_1']  ]);
        R::exec('INSERT INTO friend SET uid_1 = ?, uid_2 = ?, status = ?',[ $_GET['uid_1'], $_GET['uid_2'], 2]);
        $response=['error'=>"0"];
        header('Content-typy: application/json');
        echo json_encode($response);
    }