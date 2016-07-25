@extends('layouts.app')

@include('solve')

@section('html-page-title')
    FIMBO.RU - УЧИСЬ
@overwrite

@section('content')
@yield('solve')
    <div class="content-full content-full_nopad">
        <div class="decided">
            <h2 class="h2 decided__h2 decided__h2_nobg">Учись</h2>
            <?php $i = 0;?>
            @foreach(App\Course::all() as $course)
            <?php if($course->lections->count() == 0) continue;?>
            <div class="dropdown-tab js-droptab dropdown-tab_{{ $course->color }}"><a href="javascript:void(0);" class="dropdown-tab__link js-droptab-link"> {{ $course->title }}</a>
                <div class="dropdown-tab__content">
                    <div class="slider-five slider-five_learn slider-five_learn_{{ $course->color }}">
                        <div class="js-slider-five">

                            @include('block.lection-slider',['course' => $course])

                        </div>
                    </div>
                </div>
            </div>
            @endforeach
<script>
    $(function(){
        $('.js-droptab-link').trigger('click');
    });
</script>
        </div>
    </div>
@yield('lections')
@endsection