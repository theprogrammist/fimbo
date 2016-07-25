@section('read-task')
    <script>
        // slider-five
        $owlFive = $('.js-slider-five');
        var owlFive_Settings = {
            items: 5,
            nav: true,
            mouseDrag: false,
            smartSpeed: 550,
            center: true,
            startPosition: {{ Session::get('problemSliderStart',2) }},
            //loop:true,
            //autoplay:true,
            //autoplayTimeout:5000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1,
                },
                479: {
                    items: 3,
                },
                768: {
                    items: 3,
                },
                1000: {
                    items: 5,
                }
            },
            onTranslate: fiveSlide,
        };
        $owlFive.owlCarousel(owlFive_Settings);
        function fiveSlide(event) {
            setTimeout(function () {
                $('.js-slider-five .owl-item').removeClass('one');
                $('.js-slider-five .owl-item').removeClass('two');
                $('.js-slider-five .owl-item').removeClass('three');
                $('.js-slider-five .owl-item').removeClass('four');
                $('.js-slider-five .owl-item').removeClass('five');
                $('.js-slider-five').find('.center').prev().prev().addClass('one');
                $('.js-slider-five').find('.center').prev().addClass('two');
                $('.js-slider-five').find('.center').addClass('three');
                $('.js-slider-five').find('.center').next().addClass('four');
                $('.js-slider-five').find('.center').next().next().addClass('five');
            }, 50)
        }
        $('.js-slider-five').on('click', '.owl-item', function (event) {
            var index = $(this).index();
            $(this).closest('.owl-stage').trigger('to.owl.carousel', [index, 550, true]);
        });
        fiveSlide();
    </script>

    @if(isset($problem))
        <div class="read-bg js-read-bg">
            <div class="container">
                <div class="read-task js-read-task">
                    <div class="read-task__title">Основы экономики</div>
                    <div class="read-task__dop-title">Задача 1 из 9. Расчет цены выбора</div>
                    <div class="read-task__content">
                        <div class="read-task__left-col">
                            <div class="read-task__text">
                                {!! $problem->description or '' !!}
                            </div>
                            <div class="read-task__answers">

                                <form class="read-task__answers-form" id="questionForm">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                @if($question->type == 'single')
                                    <div class="read-task__answers-title">Введите ответ:</div>
                                    <input type="url" placeholder="Введите ответ" name="single" required="" class="input content-info__input" style="margin-bottom: 35px;">
                                @elseif($question->type == 'radio')
                                    <div class="read-task__answers-title">Выберите правильный вариант ответа:</div>
                                    <div class="read-task__answers-content">
                                            <div class="read-task__answers-labels">
                                                @foreach($question->radio->texts as $i => $txt)
                                                <label class="read-task__answers-label">
                                                    <input type="radio" name="radio" class="radio read-task__answers-input" id="radio-{{$i}}" value="{{ $i }}">
                                                    <label for="radio-{{$i}}" class="read-task__answers-label-title">Вариант {{ $i }}</label>
                                                    <span class="read-task__answers-label-text">{{ $txt }} </span>
                                                </label>
                                                    @endforeach
                                            </div>
                                    </div>
                                @elseif($question->type == 'checkbox')
                                    <div class="read-task__answers-title">Выберите один или несколько вариантов ответов:</div>
                                        <div class="read-task__answers-labels">
                                            @foreach($question->checkbox->texts as $i => $txt)
                                                <label class="read-task__answers-label">
                                                    <input type="checkbox" class="read-task__answers-input" name="checkbox[]" value="{{ $i }}">
                                                    <span class="read-task__answers-label-title">Вариант {{ $i }}</span>
                                                    <span class="read-task__answers-label-text">{{ $txt }} </span>
                                                </label>
                                            @endforeach
                                        </div>
                                @endif
                                    <button class="read-task__answers-button btn js-answer" onclick="sendSolution()">дать ответ</button>
                                </form>
                            </div>
                        </div>
                        @if($problem->lections->count() != 0)
                        <div class="read-task__right-col">
                            <div class="difficult">
                                <div class="difficult__title">Если трудно, прочитай</div>
                                <div class="difficult__content">
                                    <ol class="difficult__ol">
                                        @foreach($problem->lections as $lct)
                                        <li class="difficult__li"><a href="{{ url('lection/'.$lct->id) }}" class="difficult__link">{{ $lct->title }}</a> </li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
<script>
    function sendSolution() {


            $.ajax({
                type: "POST",
                url: '{{ action('ProblemController@solution', $problem->id) }}',
                data: $('#questionForm').serialize(),
                success: function(resp) {
                    console.log(resp = JSON.parse(resp));

                    if(resp.message == 'success') {
                        $('body').css({'overflow': 'hidden'});
                        $('.js-popup-target:has(.js-popup-success), .js-popup-success').fadeIn();
                        $('.js-popup-enter').addClass('open');
                    } else if(resp.message == 'only_one_attempt') {
                        $('body').css({'overflow':'hidden'});
                        $('.js-popup-register').find('.popup__title').text('Вы уже решали эту задачу, для нее предусмотрена только одна попытка.');
                        $('.js-popup-wrap, .js-popup-register').fadeIn();
                        $('.js-popup-enter').addClass('open');
                    } else if(resp.message == 'attempt_exhausted') {
                        $('body').css({'overflow':'hidden'});
                        $('.js-popup-register').find('.popup__title').text('Вы уже исчерпали попытки решения этой задачи.');
                        $('.js-popup-wrap, .js-popup-register').fadeIn();
                        $('.js-popup-enter').addClass('open');
                    } else {
                        $('body').css({'overflow': 'hidden'});
                        $('.js-popup-target:has(.js-popup-wrong), .js-popup-wrong').fadeIn();
                        $('.js-popup-enter').addClass('open');
                        if(resp.retry == 'no') {
                            $('#tryAgain').remove();
                        }
                    }
                    window.scrollTo(undefined,undefined);
                },
                error: function($resp) {
                    $('body').css({'overflow':'hidden'});
                    $('.js-popup-register').find('.popup__title').text('Что-то пошло не так, попробуйте повтороить попытку через несколько минут/'.$resp);
                    $('.js-popup-wrap, .js-popup-register').fadeIn();
                    $('.js-popup-enter').addClass('open');
                }
            })
    }
</script>
        <div class="popup popup-target js-popup js-popup-target">
            <div class="popup popup-wrong js-popup js-popup-wrong">
                <a href="javascript:void(0);" class="popup__close js-popup-close"></a>

                <div class="popup__title">К сожалению, неверно</div>
                <div class="popup__content">
                    @if($problem->lections->count() != 0)
                        <div class="popup-wrong__title">Это может помочь дать правильный ответ</div>
                        <ul class="popup-wrong__links">
                            @foreach($problem->lections as $i =>$lct)
                                <li><a href="{{ url('lection/'.$lct->id) }}" class="popup-wrong__link">{{$i+1}}
                                        . {{ $lct->title }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                    <a href="javascript:void(0);" id="tryAgain" onclick="tryAgain()" class="popup-wrong__repeat">попробовать еще раз</a>
                </div>
                <script>
                    function tryAgain() {
                        $(".js-popup.open .js-popup-close").trigger('click');
                        window.location.href = "{{ action('ProblemController@show', $problem->id) }}";
                    }
                </script>
            </div>
            <div class="popup popup-wrong popup-correctly js-popup js-popup-success">
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


        <script>
            @if($success)
                $('body').css({'overflow':'hidden'});
                $('.js-popup-register').find('.popup__title').text('Задача уже была вами успешно решена.');
                $('.js-popup-wrap, .js-popup-register').fadeIn();
                $('.js-popup-enter').addClass('open');
            @elseif($retry === false && $success === false)
                $('body').css({'overflow':'hidden'});
                $('.js-popup-register').find('.popup__title').text('Количество попыток решения исчерпано.');
                $('.js-popup-wrap, .js-popup-register').fadeIn();
                $('.js-popup-enter').addClass('open');
            @else
                $('body').css({'overflow': 'hidden'});
                $('.js-read-bg, .js-read-task').fadeIn();
                $('.js-popup-enter').addClass('open');
            @endif;
        </script>
    @endif
@endsection