@extends('layouts.app')

@section('html-page-title')
    FIMBO.RU - УЧИСЬ
@overwrite

@section('content')

    <div class="content-full content-full_nopad">
        <div class="decided">
            <h2 class="h2 decided__h2 decided__h2_nobg">Учись</h2>
            @foreach(App\Page::whereType('lection')->whereParentId(null)->distinct()->get(['course']) as $course)
            <div class="dropdown-tab js-droptab dropdown-tab_{{ Array('econom','mat','erud')[rand(0,2)] }}"><a href="javascript:void(0);" class="dropdown-tab__link js-droptab-link"> {{ $course->course }}</a>
                <div class="dropdown-tab__content">
                    <div class="slider-five slider-five_learn slider-five_learn_{{ Array('econom','mat','erud')[rand(0,2)] }}">
                        <div class="js-slider-five">

                            @include('block.lection-slider',['courseName' => $course->course])

                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
@yield('lections')
@endsection