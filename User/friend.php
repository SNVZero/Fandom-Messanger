<?php

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/PHPscripts/conn.php');

    if(!isset($_SESSION)){
        session_start();
    }
?>

<!Doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <title>Fandom | Друзья</title>
    <link rel="stylesheet" href="/css/reset.css" />
    <link rel="stylesheet" href="/css/fonticons.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/allusers.css">
    <link rel="stylesheet" href="/css/friend.css">
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body data-page="home" >

<!--seacrh-->
<div class="search hidden animated slideInRight slower ">
    <div class="search_container">
        <div class="search_inner autocomplete animated slideInRight slower">
            <div class="search_input_warp">
                <div class="search_icon search_icon_left">
                    <i class="fa fa-search"></i>
                </div>
                <input type="text" class="search_input form_input autocomplete_input">
                <div class="search_icon search_icon_right search_icon_close">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </div>
            <div class="search_types">
                <div class="search_type search__type_active">Вики</div>
                <div class="search_type">Обсуждения</div>
                <div class="search_type">Новости</div>
                <div class="search_type">Пользователь</div>
            </div>
            <div class="search_suggestion_warp"></div><!--Варианты быстрый поиск или похожее-->
        </div>
    </div>
</div>
<!--seacrh-->

<!--header-->
<div class="header" >
    <div class="header_inner">
        <div class="header_item header_left">
            <a href="/" class="header_logo">
                <img src="/img/Fandom.png" alt="Fandom-wiki" class="feed_logo">
            </a>
        </div>
        <div class="header_item header_menu">
            <!--Каталог-->
            <div class="header_menu_item dropdown">
                <span data-dropdown aria-expanded="false" id="header_menu_dropdown">
                    <i class="fa fa-bars"></i>
                    Сообщество
                    <i class="fa fa-caret-down"></i>
                </span>
            </div>

            <!--Поиск-->
            <div class="header_menu_item" data-search-toggle>
                <span id="search_link" title="Быстрый поиск">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    Поиск
                </span>

            </div>
            <!--Обсуждения-->
            <div class="header_menu_item">
                <a href="/Forum/forum.php" title="Обсуждения">
                    <i class="fa-regular fa-comment"></i>
                    Обсуждения
                </a>
            </div>
             <!--Дополнительное-->
             <div class="header_menu_item dropdown header_button" >
                <div class="header_button_icon" data-dropdown aria-expanded="false">
                    <i class="fa-solid fa-angles-down"></i>
                </div>
                <div class="menu_template"></div>
             </div>
        </div>
        <?php if(!isset($_SESSION['user'])){ ?>
        <div class="header_item header_right_menu">
            <!--Если пользователь не залогинен-->
            <button class="button header_sing header_sing_in">Вход</button>
            <a href="/Registration/singin.php" class="button header_sing header_sing_up">Регистрация</a>
            <!--Реализовать переключение темы-->
        </div>
        <?php } ?>
        <?php if(isset($_SESSION['user'])){ ?>
        <div class="header_item header_right_menu">
        <div class="header-right-menu__item dropdown">
          <img src="
            <?php
                if(R::findOne('img', 'uid = ?', [ $_SESSION['user']['id'] ] )) {
                    $img = R::findOne('img', 'uid = ?', [ $_SESSION['user']['id'] ]);
                    echo("data:image;base64,". base64_encode($img->uimg) );
                }else{
                    print('img/noneimguser.jpg');
                }

            ?>
          "class="header-right-menu__avatar"  data-tippy-placement="bottom-end" aria-expanded="false">
          <div class="menu-template">

          </div>
        </div>
        </div>
        <?php } ?>
    </div>
</div>
<!--header-->

<!--Главная страница-->
<div class="page">
    <div class="page_inner">
        <div class="container container_offset">

            <div class="users__wrapper">
                <?php if($_GET['allfriend']=='1'){?>
                <div class="frind__title">
                    <h1 class="friend__title-content" >Все Друзья</h1>
                    <a href="friend.php?sent=1" class="friend__title-content friend__title-btn">Отправленные заявки</a>
                    <a href="friend.php?requests=1" class="friend__title-content friend__title-btn">Запросы в друзья</a>
                <?php }else if($_GET['sent'] == '1'){ ?>
                    <div class="frind__title">
                    <h1 class="friend__title-content" >Отправленные Запросы</h1>
                    <a href="friend.php?allfriend=1" class="friend__title-content friend__title-btn">Все друзья</a>
                    <a href="friend.php?requests=1" class="friend__title-content friend__title-btn">Запросы в друзья</a>
                <?php }else if($_GET['requests'] == '1'){ ?>
                    <div class="frind__title">
                    <h1 class="friend__title-content" >Запросы в друзья</h1>
                    <a href="friend.php?allfriend=1" class="friend__title-content friend__title-btn">Все друзья</a>
                    <a href="friend.php?sent=1" class="friend__title-content friend__title-btn">Отправленные Запросы</a>
                <?php } ?>
                </div>
                <?php
                    if($_GET['allfriend']=='1'){
                        if(R::findOne('friend', 'uid_1 = ? AND status = ?', [ $_SESSION['user']['id'], 2 ])){
                            $user= R::find('friend', 'uid_1 = ? AND status = ?', [ $_SESSION['user']['id'], 2 ]);
                            $index =1;
                            $count =1;
                            while($count <= count($user)){
                                if(R::findOne('user', 'uid = ?', [ $user[$index]->uid_2 ])){
                                    $friend = R::findOne('user', 'uid = ?', [ $user[$index]->uid_2 ]);
                                            echo('  <div class="users__content">
                                            <a href="users.php?uid='. $user[$index]->uid_2 . '" class="go-to__user">
                                                <span >

                                                    <div class="users__data">
                                                        <div class="count users__elem">
                                                            <h1>'.$count .'</h1>
                                                        </div>
                                                        <div class="users__icon users__elem">
                                                        <img src="'
                                            );
                                            if( $img = R::findOne('img', 'uid = ?', [ $user[$index]->uid_2 ])) {
                                                $img = R::findOne('img', 'uid = ?', [ $user[$index]->uid_2 ]);
                                                echo("data:image;base64,". base64_encode($img->uimg) );
                                            }else{
                                                print('../img/noneimguser.jpg');
                                            }
                                            echo(' "alt="" class="user__icon">
                                            </div>
                                            <div class="users__elem">
                                                <h1 class="users__name">'
                                            );
                                            if( $friend->ufirstname ||  $friend->ulastname){
                                                echo( $friend->ufirstname . " " .  $friend->ulastname );
                                            }else{
                                                echo( $friend->unikname);
                                            }
                                            echo('</h1>
                                                    </div>
                                                                    </div>
                                                                </span>
                                                            </a>
                                                        </div>');
                                    $index++;
                                    $count++;
                                }else{
                                    $index++;
                                }

                            }
                        }
                    }else if($_GET['sent']=='1'){
                        if(R::findOne('friend', 'uid_1 = ? AND status = ?', [ $_SESSION['user']['id'], 1 ])){
                            $user= R::find('friend', 'uid_1 = ? AND status = ?', [ $_SESSION['user']['id'], 1 ]);
                            $index =1;
                            $count =1;
                            while($count <= count($user)){
                                if(R::findOne('user', 'uid = ?', [ $user[$index]->uid_2 ])){
                                    $friend = R::findOne('user', 'uid = ?', [ $user[$index]->uid_2 ]);
                                            echo('  <div class="users__content">
                                            <a href="users.php?uid='. $user[$index]->uid_2 . '" class="go-to__user">
                                                <span >

                                                    <div class="users__data">
                                                        <div class="count users__elem">
                                                            <h1>'.$count .'</h1>
                                                        </div>
                                                        <div class="users__icon users__elem">
                                                        <img src="'
                                            );
                                            if( $img = R::findOne('img', 'uid = ?', [ $user[$index]->uid_2 ])) {
                                                $img = R::findOne('img', 'uid = ?', [ $user[$index]->uid_2 ]);
                                                echo("data:image;base64,". base64_encode($img->uimg) );
                                            }else{
                                                print('../img/noneimguser.jpg');
                                            }
                                            echo(' "alt="" class="user__icon">
                                            </div>
                                            <div class="users__elem">
                                                <h1 class="users__name">'
                                            );
                                            if( $friend->ufirstname ||  $friend->ulastname){
                                                echo( $friend->ufirstname . " " .  $friend->ulastname );
                                            }else{
                                                echo( $friend->unikname);
                                            }
                                            echo('</h1>
                                                    </div>
                                                                    </div>
                                                                </span>
                                                            </a>
                                                        </div>');
                                    $index++;
                                    $count++;
                                }else{
                                    $index++;
                                }

                            }
                        }

                    }else if($_GET['requests']=='1'){
                        if(R::findOne('friend', 'uid_2 = ? AND status = ?', [ $_SESSION['user']['id'], 1 ])){
                            $user= R::find('friend', 'uid_2 = ? AND status = ?', [ $_SESSION['user']['id'], 1 ]);
                            $index =1;
                            $count =1;
                            while($count <= count($user)){
                                if(R::findOne('user', 'uid = ?', [ $user[$index]->uid_1 ])){
                                    $friend = R::findOne('user', 'uid = ?', [ $user[$index]->uid_1 ]);
                                            echo('  <div class="users__content">
                                            <a href="users.php?uid='. $user[$index]->uid_1 . '" class="go-to__user">
                                                <span >

                                                    <div class="users__data">
                                                        <div class="count users__elem">
                                                            <h1>'.$count .'</h1>
                                                        </div>
                                                        <div class="users__icon users__elem">
                                                        <img src="'
                                            );
                                            if( $img = R::findOne('img', 'uid = ?', [ $user[$index]->uid_1 ])) {
                                                $img = R::findOne('img', 'uid = ?', [ $user[$index]->uid_1 ]);
                                                echo("data:image;base64,". base64_encode($img->uimg) );
                                            }else{
                                                print('../img/noneimguser.jpg');
                                            }
                                            echo(' "alt="" class="user__icon">
                                            </div>
                                            <div class="users__elem">
                                                <h1 class="users__name">'
                                            );
                                            if( $friend->ufirstname ||  $friend->ulastname){
                                                echo( $friend->ufirstname . " " .  $friend->ulastname );
                                            }else{
                                                echo( $friend->unikname);
                                            }
                                            echo('</h1>
                                                    </div>
                                                                    </div>
                                                                </span>
                                                            </a>
                                                        </div>');
                                    $index++;
                                    $count++;
                                }else{
                                    $index++;
                                }

                            }
                        }
                    }
                ?>

            </div>
        </div>
    </div>
</div>


<div id="tippy-1" style="z-index: 9999; visibility: visible; position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(558px, 52px); opacity:0" >
    <div class="tippy_box" style="transition-duration: 200ms;" >
        <div class="tippy_content">
            <div class="menu header_dopdown">
                <a href="" class="menu_item">Вики</a>
                <a href="User/allusers.php" class="menu_item">Пользователи</a>
                <a href="" class="menu_item">Новости</a>
                <div class="menu_divider"></div>
                <a href="" class="menu_item">Случайное вики</a>
            </div>
        </div>
    </div>
</div>

<div id="tippy-2" style="z-index: 9999; visibility: visible; position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(950px, 52px);" >
    <div class="tippy_box"style="transition-duration: 200ms;" >
        <div class="tippy_content">
            <div class="menu header_dopdown">
                <a href="" class="menu_item">Объявления</a>
                <a href="" class="menu_item">О нас</a>
            </div>
        </div>
    </div>
</div>

<div id="tippy-4" style="z-index: 9999; visibility: visible; position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(1158px, 52px); opacity:0" >
    <div class="tippy_box" style="transition-duration: 200ms;" >
        <div class="tippy_content">
            <div class="menu header_dopdown">
                <a href="/User/profile.php" class="menu_item">
                <i class="fa fa-user fa-fw"></i>
                    Мой профиль
                </a>
                <a href="" class="menu_item">
                <i class="fa fa-bell fa-fw"></i>
                    Уведомления</a>
                <a href="" class="menu_item">
                <i class="fa fa-comment fa-fw"></i>
                    Мои обсуждения</a>
                <a href="" class="menu_item">
                <i class="fa fa-envelope fa-fw"></i>
                    Личные сообщения</a>
                <a href="/User/friend.php" class="menu_item">
                <i class="fa fa-users fa-fw"></i>
                    Список друзей</a>
                <a href="" class="menu_item">
                <i class="fa fa-user-times fa-fw"></i>
                    Черный список</a>
                <div class="menu_divider"></div>
                <a class="menu_item text-danger btn__logout">
                <i class="fa fa-sign-out fa-fw"></i>
                    Выход</a>


            </div>
        </div>
    </div>
</div>

<?php

    if(!isset($_SESSION['user'])){
        require_once('../modal.php');
    }
?>

<script src="/JS/menu.js"></script>

</body>
</html>