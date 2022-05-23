<?php
    define('__ROOT__', dirname(dirname(__FILE__)));
    require_once(__ROOT__.'/PHPscripts/conn.php');


    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_SESSION['user'])){
        $user = R::findOne('user', 'uid = ?', [ $_SESSION['user']['id'] ]);
        $img = R::findOne('img', 'uid = ?', [ $_SESSION['user']['id'] ]);

?>

<!Doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <title>Fandom | Редактирование</title>
    <link rel="stylesheet" href="../css/reset.css" />
    <link rel="stylesheet" href="../css/fonticons.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/edit.css">
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
            <form action="" id="form__for_edit" class="form__for_edit" >
                <div class="information__main">
                    <div class="information__main-elem">
                        <input type="text" class="user__elem" name="firstname" value="<?php print($user->ufirstname); ?>" placeholder="Имя">
                    </div>
                    <div class="information__main-elem">
                        <input type="text" class="user__elem" name="lastname" value="<?php print($user->ulastname) ?>"  placeholder="Фамилия">
                    </div>
                    <div class="information__main-elem">
                        <input type="text" class="user__elem" name="nikname" value="<?php print($user->unikname) ?>">
                    </div>
                </div>
                <div class="border__elem"></div>
                <div class="information__etc">
                    <div class="field__wrapper information__main-elem" >
                        <input  type="file" name="image" id="user_file" class="field field__file" accept="image/png, image/jpeg">
                        <label class="field__file-wrapper" for="user_file">
                            <div class="field__file-fake"><?php if($img){
                                print('Фото профиля выбрано');
                            }else{
                                print("Фото профиля не выбрано");
                            } ?></div>
                            <div class="field__file-button">Выбрать</div>
                        </label>
                    </div>
                    <div class="information__main-elem">
                        <input type="text" name="email" class="user__elem" value="<?php print($user->uemail) ?>">
                    </div>
                </div>
                <div class="border__elem"></div>
                <div class="information__footer">
                    <div class="information__main-elem">
                        <button name="edit" id = "edit" class="btn_for_edit">Сохранить изменения</button>
                    </div>
                    <div class="information__main-elem">
                        <a href="" class="edit__user">
                           <span class="edit__btn-in">
                               <span class="edit__btn-content">Изменить пароль</span>
                           </span>
                       </a>
                    </div>
                </div>
            </form>
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
                <a href="/User/friend.php?allfriend=1" class="menu_item">
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
        require_once('modal.php');
    }
?>

<script src="../JS/menu.js"></script>
<script src="../JS/fileadd.js"></script>

</body>
</html>
<?php }else
    header('Location: ../index.php');
?>