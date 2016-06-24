@extends('layouts.app-thin')

@if($page->title)
    @section('html-page-title'){{  $page->title  }}@overwrite
@endif

@section('app')
<div class="screen1">
    <div class="container">

        <div class="header">

            @include('layouts.top')

        </div>


    <div class="header-info">
        <h2 class="h2 h2_white">{!! $page->contentHash->title !!}</h2>
        <p class="p p_white">{!! $page->contentHash->undertitle !!}</p>
        <div class="col12"><a href="{{ url('/register') }}" class="btn">поехали</a>
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
                <h2 class="h2 learn__h2">{!! $page->contentHash->learn !!}</h2>
                <div class="learn__block">
                    <div class="learn__block-left">
                        <div class="learn__block-text">
                            <div class="learn__block-text-span">{!! $page->contentHash->learnbubble !!}</div>
                        </div>
                    </div>
                    <div class="learn__block-right">
                        <div class="slider">
                            <div class="js-slider">
                                @if (property_exists($page->contentHash, 'learnbanner'))
                                    <?php
                                        $classes = ['none'=>'']; //'erud'=>'эрудиция','mat'=>'Математика','eng'=>'английский язык'];
                                        $keys = array_keys($classes);
                                        end($keys);
                                    ?>
                                    @foreach ($page->contentHash->learnbanner as $banner)
                                            <?php $k=next($keys)?:reset($keys);?>
                                        <a href="javascript:void(0);" class="slider__item"><span class="slider__item-image"><img src="{{  url('/images/'.$banner)  }}" alt="slider-img" class="slider__item-img"></span><!--span class="slider__item-title slider__item-title_{{ $k }}"><span class="slider__item-span">{{ $classes[$k] }}</span></span--></a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="learn decide">
            <div class="container">
                <h2 class="h2 learn__h2">{!! $page->contentHash->solve !!}</h2>
                <div class="learn__block">
                    <div class="learn__block-left">
                        <div class="learn__block-text">
                            <div class="learn__block-text-span">{!! $page->contentHash->solvebubble !!}</div>
                        </div>
                    </div>
                    <div class="learn__block-right">
                        <div class="slider">
                            <div class="js-slider">
                                @if (property_exists($page->contentHash, 'solvebanner'))
                                    <?php
                                        $classes = ['none'=>'']; //'finance'=>'финансы','econom'=>'экономика','mat'=>'Математика'];
                                        $keys = array_keys($classes);
                                        end($keys);
                                    ?>
                                    @foreach ($page->contentHash->solvebanner as $banner)
                                            <?php $k=next($keys)?:reset($keys);?>
                                        <a href="javascript:void(0);" class="slider__item"><span class="slider__item-image"><img src="{{  url('/images/'.$banner)  }}" alt="slider-img" class="slider__item-img"></span><!--span class="slider__item-title slider__item-title_{{ $k }}"><span class="slider__item-span">{{ $classes[$k] }}</span></span--></a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="screen3">
        <div class="container">
            <h2 class="h2 h2_center">{!! $page->contentHash->use !!}</h2>
            <div class="cash">
                <div class="cash__item">
                    <div class="cash__item-image">
                        <img src="img/cash1.png" alt="cash" class="cash__item-img">
                    </div><a href="javascript:void(0);" class="cash__item-title">{!! $page->contentHash->useicontext1 !!}</a>
                </div>
                <div class="cash__item">
                    <div class="cash__item-image">
                        <img src="img/cash2.png" alt="cash" class="cash__item-img">
                    </div><a href="javascript:void(0);" class="cash__item-title">{!! $page->contentHash->useicontext2 !!}</a>
                </div>
                <div class="cash__item">
                    <div class="cash__item-image">
                        <img src="img/cash3.png" alt="cash" class="cash__item-img">
                    </div><a href="javascript:void(0);" class="cash__item-title">{!! $page->contentHash->useicontext3 !!}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="screen4">
        <div class="container">
            <h2 class="h2 h2_center">{!! $page->contentHash->earn !!}</h2>
            <div class="cash">
                <div class="cash__item">
                    <div class="cash__item-image">
                        <img src="img/cash4.png" alt="cash" class="cash__item-img">
                    </div><a href="javascript:void(0);" class="cash__item-title">{!! $page->contentHash->earnicontext1 !!}</a>
                </div>
                <div class="cash__item">
                    <div class="cash__item-image">
                        <img src="img/cash5.png" alt="cash" class="cash__item-img">
                    </div><a href="javascript:void(0);" class="cash__item-title">{!! $page->contentHash->earnicontext2 !!}</a>
                </div>
                <div class="cash__item">
                    <div class="cash__item-image">
                        <img src="img/cash6.png" alt="cash" class="cash__item-img">
                    </div><a href="javascript:void(0);" class="cash__item-title">{!! $page->contentHash->earnicontext3 !!}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="screen5">
        <h2 class="h2">Все понятно?</h2><a href="{{ url('/register') }}" class="btn btn_question">начинаем!</a>
    </div>
<div class="popup js-popup js-popup-video">
    <a href="javascript:void(0);" class="popup__close js-popup-close"></a>
    <div class="popup__content-video js-video-src">
        <iframe width="100%" height="400" src="{{ $page->contentHash->youtubelink?:'https://www.youtube.com/embed/MGEzSJIFicY' }}" frameborder="0" allowfullscreen></iframe>
    </div>
</div>
@endsection
