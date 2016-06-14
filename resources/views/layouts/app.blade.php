<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Главная</title>
    <meta name="description" content="Description">
    <meta name="keywords" content="Keywords">
    <link href="<?=asset('fonts/fonts.css')?>" rel="stylesheet">
    <link href="<?=asset('css/owl.carousel.css')?>" rel="stylesheet">
    <link href="<?=asset('css/main.css')?>" rel="stylesheet">
    <link href="<?=asset('css/animate.css')?>" rel="stylesheet">
    <link href="<?=asset('css/append.css')?>" rel="stylesheet">
    <script src="<?=asset('js/libs/jquery-2.1.1.min.js')?>"></script>
    <script src="<?=asset('js/libs/html5.js')?>"></script>
    <script src="<?=asset('js/libs/owl.carousel.min.js')?>"></script>
    <script src="<?=asset('js/libs/jquery-ui.min.js')?>"></script>
    <script src="<?=asset('js/libs/jquery.formstyler.min.js')?>"></script>
    <script src="<?=asset('js/libs/jquery.validate.min.js')?>"></script>
    <script src="<?=asset('js/libs/jquery.animateNumber.min.js')?>"></script>
    <script src="<?=asset('js/libs/jquery.circliful.min.js')?>"></script>
    <script src="<?=asset('js/main.js')?>"></script>
</head>
<body>
<div class="screen1 screen1_inner">
    <div class="container">
        <div class="header header_inner">
            <a href="{{ url('/') }}" class="logo">
                <img src="<?=asset('img/logo.png')?>" alt="logo">
            </a>

            @if (Auth::guest())

                <a href="{{ url('/login') }}" class="enter js-enter">Войти</a>
                <a href="{{ url('/register') }}" class="enter js-enter">Регистрация</a>
                <div class="lang">
                    <div class="select js-lang-select">
                        <div class="active">RU</div>
                        <div class="hidden-lang js-hidden-lang"><a href="javascript:void(0);">EN</a><a href="javascript:void(0);">FR</a><a href="javascript:void(0);">GE</a>
                        </div>
                    </div>
                </div>

            @else

                <div class="profile">
                    <a href="javascript:void(0);" class="profile__link js-profile-link">
                        <span class="profile__ava">
                            <img src="<?=asset('img/ava.png')?>" alt="ava" class="profile__ava-img">
                        </span>
                        <span class="profile__name">{{ Auth::user()->name }}</span>
                    </a>
                    <div class="profile__hidden js-profile-hidden">
                        <a href="javascript:void(0);" class="profile__hidden-link profile__hidden-link_profile">Профиль</a>
                        <a href="javascript:void(0);" class="profile__hidden-link profile__hidden-link_setting">Настройки</a>
                        <a href="{{ url('/logout') }}" class="profile__hidden-link profile__hidden-link_exit">Выйти</a>
                    </div>
                </div>

                <div class="profile-bar">
                    <div class="profile-bar__active">350 очков до цели</div>
                </div>

            @endif

        </div>
    </div>
</div>
<div class="container">
    <div class="content">

        @yield('content')


    </div>
</div>
<footer>
    <div class="container">
        <div class="copir">© 2016 юный предприниматель</div>
        <ul class="footer-menu">
            <li class="footer-menu__li"><a href="javascript:void(0);" class="footer-menu__link">о нас         </a>
            </li>
            <li class="footer-menu__li"><a href="javascript:void(0);" class="footer-menu__link">написать нам          </a>
            </li>
            <li class="footer-menu__li"><a href="javascript:void(0);" class="footer-menu__link">блог          </a>
            </li>
            <li class="footer-menu__li"><a href="javascript:void(0);" class="footer-menu__link">правила          </a>
            </li>
            <li class="footer-menu__li"><a href="javascript:void(0);" class="footer-menu__link">пользовательское соглашение</a>
            </li>
        </ul>
        <div class="footer-soc">
            <a href="javascript:void(0);" class="footer-soc__link footer-soc__link_fb"></a>
            <a href="javascript:void(0);" class="footer-soc__link footer-soc__link_g"></a>
            <a href="javascript:void(0);" class="footer-soc__link footer-soc__link_tw"></a>
        </div>
    </div>
</footer>
<div class="popup-wrap js-popup-wrap">
    <div class="popup popup-enter js-popup js-popup-enter">
        <a href="javascript:void(0);" class="popup__close js-popup-close"></a><a href="javascript:void(0);" class="popup-enter__vk">Войти через Вконтакте</a>
        <div class="popup-enter__or">или</div>
        <form class="popup-enter__form">
            <input type="text" placeholder="Email" class="popup-enter__input">
            <input type="password" placeholder="Пароль" class="popup-enter__input">
            <button class="popup-enter__button">Войти</button>
        </form><a href="javascript:void(0);" class="popup-enter__lost js-lost">Забыл(а) пароль?</a><a href="{{ url('/password/reset') }}" class="popup-enter__reg">Зарегистрироваться!</a>
    </div>
    <div class="popup popup-enter popup-register js-popup js-popup-register">
        <a href="javascript:void(0);" class="popup__close js-popup-close"></a>
        <div class="popup__title">Вы зарегестрированы!</div>
    </div>
    <div class="popup popup-enter popup-lost js-popup js-popup-lost">
        <a href="javascript:void(0);" class="popup__close js-popup-close"></a>
        <div class="popup__title">Восстановление пароля</div>
        <form class="popup-enter__form">
            <input type="text" placeholder="Email" class="popup-enter__input">
            <button class="popup-enter__button">Отправить</button>
        </form>
    </div>
    <div class="popup popup-target js-popup js-popup-target">
        <a href="javascript:void(0);" class="popup__close js-popup-close"></a>
        <div class="popup__title">Добавить цель</div>
        <div class="popup__content">
            <div class="target-content">
                <div class="target-item js-targer-item">
                    <div class="target-item__image">
                        <img src="<?=asset('img/target-img.png')?>" alt="target-img">
                        <div class="target-item__discount">-50%</div>
                        <div class="target-item__point"><span>2300</span>очков</div>
                    </div>
                    <div class="target-item__name">iPad Air 2 32GB со скидкой <span class="target-item__name-span">50%</span>
                    </div>
                </div>
                <div class="target-item js-targer-item">
                    <div class="target-item__image">
                        <img src="<?=asset('img/target-img.png')?>" alt="target-img">
                        <div class="target-item__discount">-50%</div>
                        <div class="target-item__point"><span>2300</span>очков</div>
                    </div>
                    <div class="target-item__name">iPad Air 2 32GB со скидкой <span class="target-item__name-span">50%</span>
                    </div>
                </div>
                <div class="target-item js-targer-item">
                    <div class="target-item__image">
                        <img src="<?=asset('img/target-img.png')?>" alt="target-img">
                        <div class="target-item__discount">-50%</div>
                        <div class="target-item__point"><span>2300</span>очков</div>
                    </div>
                    <div class="target-item__name">iPad Air 2 32GB со скидкой <span class="target-item__name-span">50%</span>
                    </div>
                </div>
            </div><a href="javascript:void(0);" class="btn">Выбрать</a>
        </div>
    </div>
    <div class="popup popup-wrong js-popup js-popup-wrong">
        <a href="javascript:void(0);" class="popup__close js-popup-close"></a>
        <div class="popup__title">К сожалению, неверно</div>
        <div class="popup__content">
            <div class="popup-wrong__title">Это может помочь дать правильный ответ</div>
            <ul class="popup-wrong__links">
                <li><a href="javascript:void(0);" class="popup-wrong__link">1. Общество</a>
                </li>
                <li><a href="javascript:void(0);" class="popup-wrong__link">2. Блага</a>
                </li>
                <li><a href="javascript:void(0);" class="popup-wrong__link">3. Ресурсы  </a>
                </li>
            </ul><a href="javascript:void(0);" class="popup-wrong__repeat">попробовать еще раз</a>
        </div>
    </div>
    <div class="popup popup-wrong popup-correctly js-popup js-popup-wrong">
        <a href="javascript:void(0);" class="popup__close js-popup-close"></a>
        <div class="popup__title">Задача решена!</div>
        <div class="popup__content">
            <div class="popup-correctly__money">Твой капитал вырос на <span>ХХ <денег></span>
            </div>
            <div class="popup-correctly__point">
                <div class="popup-correctly__point-active">256 очков</div>
                <div class="popup-correctly__point-icon"></div>
            </div>
        </div>
    </div>
</div>
<div class="read-bg js-read-bg">
    <div class="container">
        <div class="read-task js-read-task">
            <div class="read-task__title">Основы экономики</div>
            <div class="read-task__dop-title">Задача 1 из 9. Расчет цены выбора</div>
            <div class="read-task__content">
                <div class="read-task__left-col">
                    <div class="read-task__text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                            irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae
                            ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit,
                            sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                        <img src="<?=asset('img/read-task.jpg')?>" alt="read-task">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                            irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                    </div>
                    <div class="read-task__answers">
                        <div class="read-task__answers-title">Выберите один или несколько вариантов ответов:</div>
                        <div class="read-task__answers-content">
                            <form class="read-task__answers-form">
                                <div class="read-task__answers-labels">
                                    <label class="read-task__answers-label">
                                        <input type="checkbox" class="read-task__answers-input"><span class="read-task__answers-label-title">Вариант 1</span><span class="read-task__answers-label-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit ipsum dolor sit </span>
                                    </label>
                                    <label class="read-task__answers-label">
                                        <input type="checkbox" class="read-task__answers-input"><span class="read-task__answers-label-title">Вариант 2</span><span class="read-task__answers-label-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit ipsum dolor sit </span>
                                    </label>
                                    <label class="read-task__answers-label">
                                        <input type="checkbox" class="read-task__answers-input"><span class="read-task__answers-label-title">Вариант 3</span><span class="read-task__answers-label-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit ipsum dolor sit </span>
                                    </label>
                                    <label class="read-task__answers-label">
                                        <input type="checkbox" class="read-task__answers-input"><span class="read-task__answers-label-title">Вариант 4</span><span class="read-task__answers-label-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit ipsum dolor sit </span>
                                    </label>
                                </div>
                                <button class="read-task__answers-button btn js-answer">дать ответ</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="read-task__right-col">
                    <div class="difficult">
                        <div class="difficult__title">Если трудно, прочитай</div>
                        <div class="difficult__content">
                            <ol class="difficult__ol">
                                <li class="difficult__li"><a href="javascript:void(0);" class="difficult__link">Общество</a>
                                </li>
                                <li class="difficult__li"><a href="javascript:void(0);" class="difficult__link">Блага</a>
                                </li>
                                <li class="difficult__li"><a href="javascript:void(0);" class="difficult__link">Ресурсы</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>