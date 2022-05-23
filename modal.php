<!Doctype html>
<html>
<head>
</head>
    <body>
        <form action="" id="form">
            <div class="popup" id="popup">
                <div class="popup__body">
                    <div class="popup__content">
                        <div class="popup__close close-popup">
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                        <div class="popup__title">Авторизация</div>
                        <div class="popup__text">
                            <div class = "form_field">
                                <div class="form_input-wrap">
                                    <input type="text" name="login" id = "login" class="login__elem form_input" placeholder="Логин (Никнейм или почта)">
                                    <span class = "form__field-icon">
                                        <i class="fa-solid fa-circle-user"></i>
                                    </span>
                                    <div style ="width:0px " class ="for_error for_login">
                                            <p class="valid">
                                    </div>
                                </div>
                            </div>
                            <div class = "form_field">
                                <div class="remove_password">
                                    <a href="" >Забыли пароль?</a>
                                </div>
                                <div class="form_input-wrap">
                                    <input type="password" name="password" id="password"  class="login__elem form_input" placeholder="Пароль">
                                    <span class="form__field-icon">
                                        <i class="fa-solid fa-lock"></i>
                                    </span>
                                    <div style ="width:0px " class ="for_error for_pass">
                                            <p class="valid">
                                    </div>
                                </div>
                                <div class="form_input-wrap form_input-wrap_checkbox">
                                    <label class="control control__checkbox">
                                        <input type="checkbox" checked="checked" name="remember" id="remember" class="agree__input">
                                        <span class="control__indicator control__indicator_checkbox"></span>
                                        <span class="control__text">Запомнить меня</span>
                                    </label>
                                </div>
                            </div>
                            <div class = "form_footer">
                                <input type="submit" class="popup__btn" name="login" id="login_btn" value="Войти">
                                <a href="" class="link_default">Регистрация</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script src="/JS/modal.js"></script>
        <script src="/JS/login.js"></script>
    </body>
</html>
