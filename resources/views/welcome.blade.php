@extends('layouts.app-thin')

@section('app')
<div class="screen1">
    <div class="container">

        <div class="header">

            @include('layouts.top')

        </div>



    <div class="header-info">
        <h2 class="h2 h2_white">здесь мб заголовок мотивационного характера</h2>
        <p class="p p_white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
            dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error
            sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed
            quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam
            quaerat voluptatem.</p>
        <div class="col12"><a href="javascript:void(0);" class="btn">поехали</a>
        </div>
    </div>
    </div>
    <div class="video">
        <div class="container">
            <div class="video__cont">
                <div class="video__iframe">
                    <img src="img/video.jpg" alt="video" class="video__iframe-img">
                </div><a href="javascript:void(0);" class="btn video__btn js-video">смотреть</a>
            </div>
        </div>
    </div>
    </div>
    <div class="screen2">
        <div class="learn">
            <div class="container">
                <h2 class="h2 learn__h2">изучай азы экономики, бизнеса и финансов</h2>
                <div class="learn__block">
                    <div class="learn__block-left">
                        <div class="learn__block-text">
                            <div class="learn__block-text-span">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
                        </div>
                    </div>
                    <div class="learn__block-right">
                        <div class="slider">
                            <div class="js-slider"><a href="javascript:void(0);" class="slider__item"><span class="slider__item-image"><img src="img/slider-img1.jpg" alt="slider-img" class="slider__item-img"></span><span class="slider__item-title slider__item-title_erud"><span class="slider__item-span">эрудиция</span></span></a>
                                <a
                                        href="javascript:void(0);" class="slider__item"><span class="slider__item-image"><img src="img/slider-img2.jpg" alt="slider-img" class="slider__item-img"></span><span class="slider__item-title slider__item-title_mat"><span class="slider__item-span">Математика</span></span>
                                </a><a href="javascript:void(0);" class="slider__item"><span class="slider__item-image"><img src="img/slider-img3.jpg" alt="slider-img" class="slider__item-img"></span><span class="slider__item-title slider__item-title_eng"><span class="slider__item-span">английский язык</span></span></a>
                                <a
                                        href="javascript:void(0);" class="slider__item"><span class="slider__item-image"><img src="img/slider-img2.jpg" alt="slider-img" class="slider__item-img"></span><span class="slider__item-title slider__item-title_mat"><span class="slider__item-span">Математика</span></span>
                                </a><a href="javascript:void(0);" class="slider__item"><span class="slider__item-image"><img src="img/slider-img1.jpg" alt="slider-img" class="slider__item-img"></span><span class="slider__item-title slider__item-title_erud"><span class="slider__item-span">эрудиция</span></span></a>
                                <a
                                        href="javascript:void(0);" class="slider__item"><span class="slider__item-image"><img src="img/slider-img3.jpg" alt="slider-img" class="slider__item-img"></span><span class="slider__item-title slider__item-title_eng"><span class="slider__item-span">английский язык</span></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="learn decide">
            <div class="container">
                <h2 class="h2 learn__h2">решай задачи и зарабатывай деньги</h2>
                <div class="learn__block">
                    <div class="learn__block-left">
                        <div class="learn__block-text">
                            <div class="learn__block-text-span">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
                        </div>
                    </div>
                    <div class="learn__block-right">
                        <div class="slider">
                            <div class="js-slider"><a href="javascript:void(0);" class="slider__item"><span class="slider__item-image"><img src="img/slider-img4.jpg" alt="slider-img" class="slider__item-img"></span><span class="slider__item-title slider__item-title_finance"><span class="slider__item-span">финансы</span></span></a>
                                <a
                                        href="javascript:void(0);" class="slider__item"><span class="slider__item-image"><img src="img/slider-img5.jpg" alt="slider-img" class="slider__item-img"></span><span class="slider__item-title slider__item-title_econom"><span class="slider__item-span">экономика</span></span>
                                </a><a href="javascript:void(0);" class="slider__item"><span class="slider__item-image"><img src="img/slider-img2.jpg" alt="slider-img" class="slider__item-img"></span><span class="slider__item-title slider__item-title_mat"><span class="slider__item-span">Математика</span></span></a>
                                <a
                                        href="javascript:void(0);" class="slider__item"><span class="slider__item-image"><img src="img/slider-img5.jpg" alt="slider-img" class="slider__item-img"></span><span class="slider__item-title slider__item-title_econom"><span class="slider__item-span">экономика</span></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="screen3">
        <div class="container">
            <h2 class="h2 h2_center">используй заработанные <деньги><br>в качестве обычных денег</h2>
            <div class="cash">
                <div class="cash__item">
                    <div class="cash__item-image">
                        <img src="img/cash1.png" alt="cash" class="cash__item-img">
                    </div><a href="javascript:void(0);" class="cash__item-title">Порадуй себя - потрать <деньги> на покупку того, о чем давно мечтал</a>
                </div>
                <div class="cash__item">
                    <div class="cash__item-image">
                        <img src="img/cash2.png" alt="cash" class="cash__item-img">
                    </div><a href="javascript:void(0);" class="cash__item-title">Удели внимание родным и друзьям - потрать <деньги> на подарки им</a>
                </div>
                <div class="cash__item">
                    <div class="cash__item-image">
                        <img src="img/cash3.png" alt="cash" class="cash__item-img">
                    </div><a href="javascript:void(0);" class="cash__item-title">Помоги другим людям - пожертвуй часть <денег> на благотворительность</a>
                </div>
            </div>
        </div>
    </div>
    <div class="screen4">
        <div class="container">
            <h2 class="h2 h2_center">Зарабатывай еще больше <br>и увеличивай свой капитал</h2>
            <div class="cash">
                <div class="cash__item">
                    <div class="cash__item-image">
                        <img src="img/cash4.png" alt="cash" class="cash__item-img">
                    </div><a href="javascript:void(0);" class="cash__item-title">Участвуя в наших турнирах</a>
                </div>
                <div class="cash__item">
                    <div class="cash__item-image">
                        <img src="img/cash5.png" alt="cash" class="cash__item-img">
                    </div><a href="javascript:void(0);" class="cash__item-title">Получая проценты с депозитов</a>
                </div>
                <div class="cash__item">
                    <div class="cash__item-image">
                        <img src="img/cash6.png" alt="cash" class="cash__item-img">
                    </div><a href="javascript:void(0);" class="cash__item-title">Помогая нам улучшить <бренд></a>
                </div>
            </div>
        </div>
    </div>
    <div class="screen5">
        <h2 class="h2">Все понятно?</h2><a href="javascript:void(0);" class="btn btn_question">начинаем!</a>
    </div>
<div class="popup js-popup js-popup-video">
    <a href="javascript:void(0);" class="popup__close js-popup-close"></a>
    <div class="popup__content-video js-video-src">
        <iframe width="100%" height="400" src="https://www.youtube.com/embed/MGEzSJIFicY" frameborder="0" allowfullscreen></iframe>
    </div>
</div>
@endsection
