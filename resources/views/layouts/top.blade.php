<a href="{{ url('/') }}" class="logo">
    <img src="<?=asset('img/logo.png')?>" alt="logo">
</a>

@if (Auth::guest())

    <a href="javascript:void(0);" class="enter js-enter">Войти</a>
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
            <a href="{{ url('/cabinet') }}" class="profile__hidden-link profile__hidden-link_profile">Профиль</a>
            <a href="{{ url('settings') }}" class="profile__hidden-link profile__hidden-link_setting">Настройки</a>
            <a href="{{ url('/logout') }}" class="profile__hidden-link profile__hidden-link_exit">Выйти</a>
        </div>
    </div>

    <div class="profile-bar">
            <div class="profile-bar__active" style="    text-transform: initial;
    font-size: 16px;
    letter-spacing: 3px;">{{  Auth::user()->account->balance }} &nbsp; Monetto</div>
    </div>

@endif