@include('read-task')
@section('solve')

    @if(Request::segment(1)!=='lection')
    <div class="decided">
        <h2 class="h2 decided__h2">Решай</h2>
        <div class="slider-five">
            <div class="js-slider-five">


                @foreach(\App\Problem::all() as $lct)
                    <div class="slider__item">
                        <div class="slider__item-block">
                            <div class="slider__item-image">
                                <img src="/img/slider-decide-img3.jpg" alt="slider-img" class="slider__item-img">
                            </div>

                            <div class="{{ $lct->course->color }}Option slider__item-category">{{ $lct->course->title }}</div>
                            <div class="slider__item-progress slider__item-progress_yes"></div>

                            <a href="{{ url('problem/') . '/' . $lct->id . '/'  }}" class="slider-five_learn_olive">

                                <div class="slider__item-title slider__item-title_{{ $lct->course->color }}">
                                    <div class="slider__item-span">{{ $lct->title }}</div>
                                </div>
                            </a>

                            <div class="slider__item-point"><span class="slider__item-point-span">{{ $lct->score }} </span>очков</div>

                            <div class="slider__item-level {{ (empty($lct->difficulty))?App\Page::$difficultyColors[1] : App\Page::$difficultyColors[$lct->difficulty] }}Option">
                                {{ (empty($lct->difficulty))?App\Page::$difficultyNames[1] : App\Page::$difficultyNames[$lct->difficulty] }}</div>
                        </div>
                        <div class="slider__item-text">
                            <div class="slider__item-text-hidden">
                                {!! implode(' ', array_slice(explode(' ', strip_tags($lct->description)), 0, 16)) !!} ...
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    @endif

@endsection