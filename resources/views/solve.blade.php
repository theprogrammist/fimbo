@include('read-task')
@section('solve')

    @if(Request::segment(1)!=='lection')
    <div class="decided">
        <h2 class="h2 decided__h2">Решай</h2>
        <div class="slider-five">
            <div class="js-slider-five">


                @foreach(\App\Problem::all() as $prblm)
                    <div class="slider__item">
                        <div class="slider__item-block">
                            <div class="slider__item-image">
                                <img src="/img/slider-decide-img3.jpg" alt="slider-img" class="slider__item-img">
                            </div>

                            <div class="{{ $prblm->course->color }}Option slider__item-category">{{ $prblm->course->title }}</div>
                            <div class="slider__item-progress slider__item-progress_{{

                                (
                                    (Auth::user()->problems->find($prblm->id))
                                    &&
                                    !(Auth::user()->problems->find($prblm->id)->pivot->success)
                                    &&
                                    ( Auth::user()->problems->find($prblm->id)->pivot->attempt >= $prblm->attempts )
                                ) ? 'no' : 'yes'

                            }}"></div>

                            <a href="{{ url('problem/') . '/' . $prblm->id . '/'  }}" class="slider-five_learn_olive">

                                <div class="slider__item-title slider__item-title_{{ $prblm->course->color }}">
                                    <div class="slider__item-span">{{ $prblm->title }}</div>
                                </div>
                            </a>

                            <div class="slider__item-point"><span class="slider__item-point-span">{{ $prblm->score }} </span>очков</div>

                            <div class="slider__item-level {{ (empty($prblm->difficulty))?App\Page::$difficultyColors[1] : App\Page::$difficultyColors[$prblm->difficulty] }}Option">
                                {{ (empty($prblm->difficulty))?App\Page::$difficultyNames[1] : App\Page::$difficultyNames[$prblm->difficulty] }}</div>

                            @if(Auth::user()->problems->find($prblm->id)
                                && !(Auth::user()->problems->find($prblm->id)->pivot->success)
                                && ( Auth::user()->problems->find($prblm->id)->pivot->attempt >= $prblm->attempts )
                               )

                                <div class="slider__item-blocked">
                                    <div class="slider__item-blocked-text">Эта задача была {{

                                        (Auth::user()->problems->find($prblm->id)->pivot->attempt == 2) ? 'дважды' : ''

                                    }} решена неверно.
                                        <br>Решать её ещё раз нельзя.
                                        <br>Переходи к следующей.</div>
                                </div>
                            @elseif(Auth::user()->problems->find($prblm->id) && (Auth::user()->problems->find($prblm->id)->pivot->success))
                            <div class="slider__item-blocked">
                                <div class="slider__item-blocked-text">Эта задача успешно решена.</div>
                            </div>
                            @endif


                        </div>
                        <div class="slider__item-text">
                            <div class="slider__item-text-hidden">
                                {{ $prblm->annotation }}
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    @endif

@endsection