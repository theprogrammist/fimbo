@extends('layouts.app')

@section('html-page-title')
    Личный кабинет - FIMBO.RU
@overwrite

@section('content')

    <div class="content-left content-left_cabinet">
        <div class="cab-profile white-bg">
            <div class="cab-profile-top-info">
                <div class="cab-profile__ava">
                    <img src="img/ava.jpg" alt="ava" class="cab-profile__ava-img">
                </div>
                <div class="cab-profile__name-progress">
                    <div class="cab-profile__name">Иван Петродворецкий</div>
                    <div class="cab-profile__progress">
                        <div class="cab-profile__progress-title">Профиль заполнен на <span>20%</span>
                        </div>
                        <div class="cab-profile__progress-bar">
                            <div class="cab-profile__progress-bar-active"></div>
                        </div>
                    </div>
                </div>
                <div class="cab-profile__age">17 лет</div>
                <div class="cab-profile__city">Москва</div><a href="javascript:void(0);" class="cab-profile__more">Узнать больше информации</a>
            </div>
            <div class="cab-profile-info">
                <div class="cab-profile-info__item cab-profile-info__item_point">
                    <div data-number="5000" class="cab-profile-info__point-all js-point-all">5000</div>
                    <div class="cab-profile-info__text">очков всего</div>
                </div>
                <div class="cab-profile-info__item cab-profile-info__item_date">
                    <div data-number="1500" class="cab-profile-info__point-month js-point-month">1500</div>
                    <div class="cab-profile-info__text">очков за месяц</div>
                </div>
                <div class="cab-profile-info__item cab-profile-info__item_rub">
                    <div data-number="5000" class="cab-profile-info__rub js-rub">5000</div>
                    <div class="cab-profile-info__text">рублей</div><a href="javascript:void(0);" class="cab-profile-info__rub-spend btn">потратить</a>
                </div>
                <div class="cab-profile-info__item cab-profile-info__item_decide">
                    <div data-number="25" class="cab-profile-info__decide js-decide">25</div>
                    <div class="cab-profile-info__text">задач решено на протяжении 5 последних дней</div>
                </div>
                <div class="cab-profile-info__item cab-profile-info__item_date">
                    <div data-number="175" class="cab-profile-info__decide js-decide-month">175</div>
                    <div class="cab-profile-info__text">задач решено
                        <br>за последний месяц</div>
                </div>
                <div class="cab-profile-info__item cab-profile-info__item_active-pers">
                    <div class="cab-profile-info__icon-active"></div>
                    <div class="cab-profile-info__text">Активный участник</div>
                </div>
            </div>
        </div>
        <div class="cab-profile-rating white-bg">
            <div class="cab-profile-rating-slider">
                <div class="js-cab-profile-rating">
                    <div class="cab-profile-rating__item">
                        <div class="cab-profile-rating__ava">
                            <img src="img/ava1.jpg" alt="ava">
                        </div>
                        <div class="cab-profile-rating__point">344<span class="cab-profile-rating__text">очков</span>
                        </div>
                    </div>
                    <div class="cab-profile-rating__item">
                        <div class="cab-profile-rating__ava">
                            <img src="img/ava2.jpg" alt="ava">
                        </div>
                        <div class="cab-profile-rating__point">422<span class="cab-profile-rating__text">очков</span>
                        </div>
                    </div>
                    <div class="cab-profile-rating__item">
                        <div class="cab-profile-rating__ava">
                            <img src="img/ava3.jpg" alt="ava">
                        </div>
                        <div class="cab-profile-rating__point">502<span class="cab-profile-rating__text">очков</span>
                        </div>
                    </div>
                    <div class="cab-profile-rating__item">
                        <div class="cab-profile-rating__ava">
                            <img src="img/ava.jpg" alt="ava">
                        </div>
                        <div class="cab-profile-rating__point">537<span class="cab-profile-rating__text">очков</span>
                        </div>
                    </div>
                    <div class="cab-profile-rating__item">
                        <div class="cab-profile-rating__ava">
                            <img src="img/ava4.jpg" alt="ava">
                        </div>
                        <div class="cab-profile-rating__point">589<span class="cab-profile-rating__text">очков</span>
                        </div>
                    </div>
                    <div class="cab-profile-rating__item">
                        <div class="cab-profile-rating__ava">
                            <img src="img/ava1.jpg" alt="ava">
                        </div>
                        <div class="cab-profile-rating__point">685<span class="cab-profile-rating__text">очков</span>
                        </div>
                    </div>
                    <div class="cab-profile-rating__item">
                        <div class="cab-profile-rating__ava">
                            <img src="img/ava2.jpg" alt="ava">
                        </div>
                        <div class="cab-profile-rating__point">784<span class="cab-profile-rating__text">очков</span>
                        </div>
                    </div>
                    <div class="cab-profile-rating__item">
                        <div class="cab-profile-rating__ava">
                            <img src="img/ava.jpg" alt="ava">
                        </div>
                        <div class="cab-profile-rating__point">790<span class="cab-profile-rating__text">очков</span>
                        </div>
                    </div>
                    <div class="cab-profile-rating__item">
                        <div class="cab-profile-rating__ava">
                            <img src="img/ava3.jpg" alt="ava">
                        </div>
                        <div class="cab-profile-rating__point">822<span class="cab-profile-rating__text">очков</span>
                        </div>
                    </div>
                    <div class="cab-profile-rating__item">
                        <div class="cab-profile-rating__ava">
                            <img src="img/ava4.jpg" alt="ava">
                        </div>
                        <div class="cab-profile-rating__point">850<span class="cab-profile-rating__text">очков</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="target white-bg js-target">
            <div class="target-top">
                <div class="target-title">Ближайшая цель</div><a href="javascript:void(0);" class="target-add btn js-target-add">добавить цель</a>
            </div>
            <div class="target-content">
                <div class="target-item">
                    <div class="target-item__image">
                        <img src="img/target-img.png" alt="target-img">
                        <div class="target-item__discount">-50%</div>
                    </div>
                    <div class="target-item__name">iPad Air 2 32GB со скидкой <span class="target-item__name-span">50%</span>
                    </div>
                </div>
                <div class="target-item">
                    <div class="target-item__image">
                        <img src="img/target-img.png" alt="target-img">
                        <div class="target-item__discount">-50%</div>
                    </div>
                    <div class="target-item__name">iPad Air 2 32GB со скидкой <span class="target-item__name-span">50%</span>
                    </div>
                </div>
                <div class="target-item">
                    <div class="target-item__image">
                        <img src="img/target-img.png" alt="target-img">
                        <div class="target-item__discount">-50%</div>
                    </div>
                    <div class="target-item__name">iPad Air 2 32GB со скидкой <span class="target-item__name-span">50%</span>
                    </div>
                </div>
            </div>
            <div class="target-last js-target-last">
                <div class="target-last__item target-last__item_title">Осталось до цели</div>
                <div class="target-last__item target-last__item_decide">
                    <div data-dimension="65" data-width="3" data-percent="65" data-fgcolor="#ff8c75" class="target-last__icon target-last__icon_decide circlestat js-circlestat"></div>
                    <div data-number="75" class="target-last__number js-target-decide">75</div>
                    <div class="target-last__text">задач</div>
                </div>
                <div class="target-last__item target-last__item_point">
                    <div data-dimension="65" data-width="3" data-percent="75" data-fgcolor="#6f62d7" class="target-last__icon target-last__icon_point circlestat js-circlestat"></div>
                    <div data-number="350" class="target-last__number js-target-point">350</div>
                    <div class="target-last__text">очков</div>
                </div>
                <div class="target-last__item target-last__item_day">
                    <div data-dimension="65" data-width="3" data-percent="35" data-fgcolor="#24a0ff" class="target-last__icon target-last__icon_day circlestat js-circlestat"></div>
                    <div data-number="15" class="target-last__number js-target-day">15</div>
                    <div class="target-last__text">дней без перерывов</div>
                </div>
            </div>
        </div>
        <div class="target-done white-bg">
            <div class="target-done__title"><span>Достигнутые цели</span>
            </div>
            <div class="target-content target-content_done">
                <div class="target-item">
                    <div class="target-item__image">
                        <img src="img/target-img.png" alt="target-img">
                        <div class="target-item__discount">-50%</div>
                    </div>
                    <div class="target-item__name">iPad Air 2 32GB со скидкой <span class="target-item__name-span">50%</span>
                    </div>
                    <div class="target-item__finish">Достигнута <span class="target-item__finish-date">15 января 2015</span>
                    </div>
                </div>
                <div class="target-item">
                    <div class="target-item__image">
                        <img src="img/target-img.png" alt="target-img">
                        <div class="target-item__discount">-50%</div>
                    </div>
                    <div class="target-item__name">iPad Air 2 32GB со скидкой <span class="target-item__name-span">50%</span>
                    </div>
                    <div class="target-item__finish">Достигнута <span class="target-item__finish-date">15 января 2015</span>
                    </div>
                </div>
                <div class="target-item">
                    <div class="target-item__image">
                        <img src="img/target-img.png" alt="target-img">
                        <div class="target-item__discount">-50%</div>
                    </div>
                    <div class="target-item__name">iPad Air 2 32GB со скидкой <span class="target-item__name-span">50%</span>
                    </div>
                    <div class="target-item__finish">Достигнута <span class="target-item__finish-date">15 января 2015</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="tournament">
            <div class="tournament__title"><span>Истории турниров</span>
            </div>
            <div class="tournament-content">
                <div class="tournament__item">
                    <div class="tournament__item-title tournament__item-title_erud"><span>Битва эрудиции</span>
                        <div class="tournament__item-cup">31</div>
                    </div>
                    <div class="tournament__item-content">
                        <div class="tournament__item-date">29 сентября 2015</div>
                        <div class="tournament__item-people">2000 участников</div>
                        <div class="tournament__item-place">31 место</div>
                    </div>
                </div>
                <div class="tournament__item">
                    <div class="tournament__item-title tournament__item-title_erud"><span>Битва эрудиции</span>
                        <div class="tournament__item-cup">4</div>
                    </div>
                    <div class="tournament__item-content">
                        <div class="tournament__item-date">29 сентября 2015</div>
                        <div class="tournament__item-people">2000 участников</div>
                        <div class="tournament__item-place">31 место</div>
                    </div>
                </div>
                <div class="tournament__item">
                    <div class="tournament__item-title tournament__item-title_erud"><span>Битва эрудиции</span>
                        <div class="tournament__item-cup">2</div>
                    </div>
                    <div class="tournament__item-content">
                        <div class="tournament__item-date">29 сентября 2015</div>
                        <div class="tournament__item-people">2000 участников</div>
                        <div class="tournament__item-place">31 место</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-right js-content-right">
        <div class="decide-today">
            <div class="decide-today__title">Задачи на сегодня</div>
            <div class="decide-today__content"><a href="javascript:void(0);" class="decide-today__link decide-today__link_erud">эрудиция </a><a href="javascript:void(0);" class="decide-today__link decide-today__link_mat">математика </a><a href="javascript:void(0);" class="decide-today__link decide-today__link_eng">английский язык </a>
                <a
                        href="javascript:void(0);" class="decide-today__link decide-today__link_finance">финансы</a><a href="javascript:void(0);" class="decide-today__link decide-today__link_econom"> экономика </a>
            </div>
        </div>
        <a href="javascript:void(0);" class="banner">
            <img src="img/banner1.png" alt="banner" class="banner__img"><span class="banner__text">10 удивительных фильмов 2015 года</span>
        </a>
        <a href="javascript:void(0);" class="banner banner_ads">
            <img src="img/banner2.png" alt="banner" class="banner__img"><span class="banner__text"><span class="banner__text-span">Скоро олимпиада!</span>Вступительный взнос 5000 очков</span>
        </a>
    </div>

@endsection