<?php
    define('__ROOT__', dirname(dirname(__FILE__)));
    require_once(__ROOT__.'/PHPscripts/conn.php');


    if(!isset($_SESSION)){
        session_start();
    }
    if(isset($_SESSION['user'])){
        $user = R::findOne('user', 'uid = ?', [ $_SESSION['user']['id'] ]);
        if($_SESSION['user']['id'] == $_GET['uid']){
            header("Location: profile.php");
        }
    }

    $people = R::findOne('user', 'uid = ?', [ $_GET['uid'] ]);
?>

<!Doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <title>Fandom | Пользователь</title>
    <link rel="stylesheet" href="../css/reset.css" />
    <link rel="stylesheet" href="../css/fonticons.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/people.css">
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
                    print('../img/noneimguser.jpg');
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

<div class="page">
    <div class="page_inner">
        <div class="container container_offset">
            <div class="page_wrappers">
                <div class="page__ans">
                    <div class="page_wrapper_left page__content">
                        <div class="page__left-item ">
                            <div class="user__icon">
                                <img src="
                                    <?php
                                        if(R::findOne('img', 'uid = ?', [ $_GET['uid'] ])) {
                                            $img = R::findOne('img', 'uid = ?', [ $_GET['uid'] ]);
                                            echo("data:image;base64,". base64_encode($img->uimg) );
                                        }else{
                                            print('../img/noneimguser.jpg');
                                        }
                                    ?>
                                "alt="" class="profile__icon">
                            </div>
                        </div>
                        <?php if( !isset($_SESSION['user']) ){ ?>
                            <div class="user__edit-content">
                                <a  class="edit__user massage__user header_sing_in" name = "massage__user">
                                    <span class="edit__btn-in massage__btn">
                                        <span class="edit__btn-content massage__btn-content">Написать сообщение</span>
                                    </span>
                                </a>
                            </div>

                        <?php }else{ ?>
                        <div class="user__edit-content">
                            <a href="" class="edit__user massage__user" name = "massage__user">
                                <span class="edit__btn-in massage__btn">
                                    <span class="edit__btn-content massage__btn-content">Написать сообщение</span>
                                </span>
                            </a>
                        </div>
                        <?php }?>
                        <?php if(!isset($_SESSION['user'])){ ?>
                            <div class="user__edit-content" >
                                <a class="edit__user massage__user header_sing_in" name = "add __user">
                                    <span class="edit__btn-in massage__btn">
                                        <span class="edit__btn-content massage__btn-content">Добавить в друзья</span>
                                    </span>
                                </a>
                            </div>
                        <?php }else if(!(R::findOne('friend', 'uid_1 = ? AND uid_2 = ? AND status = ?', [ $_SESSION['user']['id'],$_GET['uid'],1 ])) && !(R::findOne('friend', 'uid_1 = ? AND uid_2 = ? AND status = ?', [$_GET['uid'],$_SESSION['user']['id'],1 ])) && !(R::findOne('friend', 'uid_1 = ? AND uid_2 = ? AND status = ?', [ $_SESSION['user']['id'],$_GET['uid'],2 ])) && !(R::findOne('friend', 'uid_1 = ? AND uid_2 = ? AND status = ?', [$_GET['uid'],$_SESSION['user']['id'],2 ]))){   ?>
                            <div class="user__edit-content" id="add__friend">
                            <a href="" class="edit__user massage__user" name = "add __user">
                                <span class="edit__btn-in massage__btn">
                                    <span class="edit__btn-content massage__btn-content">Добавить в друзья</span>
                                </span>
                            </a>
                            </div>
                        <?php }else if(R::findOne('friend', 'uid_1 = ? AND uid_2 = ? AND status = ?', [$_GET['uid'], $_SESSION['user']['id'], 1 ])){?>
                            <div class="user__edit-content" id="exept__friend">
                                <a href="" class="edit__user massage__user exept__friend" name = "add __user">
                                    <span class="edit__btn-in massage__btn exept__friend">
                                        <span class="edit__btn-content massage__btn-content">Запрос в друзья</span>
                                    </span>
                                </a>
                            </div>
                        <?php }else if(R::findOne('friend', 'uid_1 = ? AND uid_2 = ? AND status = ?', [$_GET['uid'], $_SESSION['user']['id'], 2 ]) || R::findOne('friend', 'uid_1 = ? AND uid_2 = ? AND status = ?', [ $_SESSION['user']['id'],$_GET['uid'], 2 ])){ ?>
                            <div class="user__edit-content" id="add__friend">
                                    <span class="added__user">
                                        <span class="added__user-content">В Друзья</span>
                                    </span>
                                </a>
                            </div>
                        <?php }else{ ?>
                            <div class="user__edit-content" id="add__friend">
                            <span class="added__user">
                                <span class="added__user-content">Заявка отправлена</span>
                            </span>
                        </a>
                        </div>
                        <?php } ?>
                        <div class="border__elem"></div>
                        <div class="user_id">
                            <h2>
                                <?php
                                echo("#". $_GET['uid']);
                                ?>
                            </h2>
                        </div>
                    </div>
                    <div class="page_wrapper_main">
                        <div class="page_main-item">
                            <h1 class="page_name">
                                <?php
                                    if($people->ufirstname || $people->ulastname){
                                        echo($people->ufirstname . " " . $people->ulastname );
                                    }else{
                                        echo($people->unikname);
                                    }
                                ?>
                            </h1>
                            <h2 class="page_nikname">
                                <?php
                                      if($people->ufirstname || $people->ulastname){
                                        echo($people->unikname);
                                    }else{

                                    }
                                ?>
                            </h2>

                        </div>
                        <div class="border__elem-main"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="tippy-1" style="z-index: 9999; visibility: visible; position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(558px, 52px); opacity:0" >
    <div class="tippy_box" style="transition-duration: 200ms;" >
        <div class="tippy_content">
            <div class="menu header_dopdown">
                <a href="" class="menu_item">Вики</a>
                <a href="allusers.php" class="menu_item">Пользователи</a>
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

<input type="hidden" name="uid_1" id="uid_1" value="<?php echo($_SESSION['user']['id']); ?>">
<input type="hidden" name="uid_2" id="uid_2"value="<?php echo($_GET['uid']); ?>">


<script src="../JS/menu.js"></script>
<script src="../JS/friendadd.js"></script>
</body>
</html>