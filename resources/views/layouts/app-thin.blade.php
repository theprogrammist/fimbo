<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@section('html-page-title')Fimbo.ru @show</title>
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

    <script src="<?=asset('bootstrap/js/bootstrap.min.js')?>"></script>
</head>
<body>

@yield('app')

<footer>
    <div class="container">
        <div class="copir">© 2016 FIMBO.RU</div>
        <ul class="footer-menu">
            <li class="footer-menu__li"><a href="{{  url('/about_us')  }}" class="footer-menu__link">о нас         </a>
            </li>
            <li class="footer-menu__li"><a href="javascript:void(0);" class="footer-menu__link">написать нам          </a>
            </li>
            <li class="footer-menu__li"><a href="javascript:void(0);" class="footer-menu__link">блог          </a>
            </li>
            <li class="footer-menu__li"><a href="{{  url('/rules')  }}" class="footer-menu__link">правила          </a>
            </li>
            <li class="footer-menu__li"><a href="{{  url('/agreement')  }}" class="footer-menu__link">пользовательское соглашение</a>
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
        @if ($message = Session::get('error'))
            <div class="row" style="margin-bottom: 10px">
                <div class="col-xs-12">
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <h4>Ошибка</h4>
                        @if(is_array($message))
                            @foreach ($message as $m)
                                {{ $m }}
                            @endforeach
                        @else
                            {{ $message }}
                        @endif
                    </div>
                </div>
            </div>
        @endif
        @if ( $message|| ($errors->has('email')) || ($errors->has('password')) || Session::get('loginRedirect'))
            <script language="JavaScript">
                $('body').css({'overflow':'hidden'});
                $('.js-popup-wrap, .js-popup-enter').fadeIn();
                $('.js-popup-enter').addClass('open');
            </script>
        @endif
        <a href="javascript:void(0);" class="popup__close js-popup-close"></a><a href="javascript:void(0);" class="popup-enter__vk">Войти через Вконтакте</a>
        <div class="popup-enter__or">или</div>
        <form class="popup-enter__form" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}
            <input type="email" placeholder="Email" class="popup-enter__input {{ $errors->has('email') ? ' has-error' : '' }}" name="email" value="{{ old('email') }}">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            <input type="password" name="password" placeholder="Пароль" class="popup-enter__input {{ $errors->has('password') ? ' has-error' : '' }}">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            <button class="popup-enter__button">Войти</button>
        </form><a href="{{ url('/password/reset') }}" class="popup-enter__lost js-lost">Забыл(а) пароль?</a><a href="{{ url('/register') }}" class="popup-enter__reg">Зарегистрироваться!</a>
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
</div>

@yield('read-task')

</body>
</html>