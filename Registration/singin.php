<!Doctype html>
<html>
    <head>
        <title>
            Fandom | Регистрация
        </title>
        <meta http-equiv="Content-type" content="text/html;charset=utf-8" />

        <link rel="stylesheet" href="../css/fonticons.css">
        <link rel="stylesheet" href="../css/reset.css" />
        <link rel="stylesheet" href="../css/singin.css">


    </head>

    <body>
        <form action="" id="form" class="form__body">
            <div class="form_wrap">
                <div class="container">
                    <div class="container__inner">
                        <div class="content">
                            <div class="content__title">
                                <h2>Регистрация</h2>
                            </div>
                            <div class="border__content"></div>
                            <div class="main__content">
                                <div class="main__content-elem">
                                    <input type="text" class="contnent__elem" placeholder ="Никнейм" id = "name" name= "name">
                                    <span class="form__field-icon">
                                        <i class="fa-solid fa-circle-user"></i>
                                    </span>
                                    <div style ="width:0px " class ="for_error">
                                        <p class="valid">
                                    </div>
                                </div>
                                <div class="main__content-elem">
                                    <input type="email" class="contnent__elem" placeholder ="Почта" id = "email" name="email">
                                    <span class="form__field-icon">
                                        <i class="fa-solid fa-envelope"></i>
                                    </span>
                                    <div style ="width:0px" class ="for_error">
                                        <p class="valid">
                                    </div>
                                </div>
                                <div class="main__content-elem">
                                    <input type="password" class="contnent__elem" placeholder ="Пароль"  id = "pass" name="pass">
                                    <span class="form__field-icon">
                                        <i class="fa-solid fa-lock"></i>
                                    </span>
                                    <div style ="width:0px " class ="for_error">
                                        <p class="valid">
                                    </div>
                                </div>
                                <div class="main__content-elem">
                                    <input type="password" class="contnent__elem" placeholder ="Повторите пароль"  id = "rpass" name="rpass">
                                    <span class="form__field-icon">
                                        <i class="fa-solid fa-lock"></i>
                                    </span>
                                    <div style ="width:0px " class ="for_error">
                                        <p class="valid">
                                    </div>
                                </div>
                            </div>
                            <div class="border__content"></div>
                            <div class="footer__content">
                            <div class="footer__content-elem">
                                <label class="control control__checkbox">
                                    <input type="checkbox" checked="checked" name="agree" id="agree" class="agree__input">
                                    <span class="control__indicator control__indicator_checkbox"></span>
                                    <span class="control__text">Согласен на обработку данных</span>
                                </label>
                            </div>
                                <div class="footer__content-elem">
                                    <button class="button__footer button__footet-singin" id ="send" name="send">Зарегистрироваться</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="../JS/singin.js"></script>
    </body>

</html>